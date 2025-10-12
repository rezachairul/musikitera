<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_konten\ManageCTA;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ManageCTAExport
{
    protected $filterProdi;
    protected $search;

    public function __construct($filterProdi = 'all', $search = '')
    {
        $this->filterProdi = $filterProdi;
        $this->search = $search;
    }

    public function export()
    {
        // 📄 Path ke template (pastikan file ada)
        $templatePath = storage_path('app/templates/manajemen_konten/temp-export-cta.xlsx');
        if (!file_exists($templatePath)) {
            abort(404, 'Template export tidak ditemukan di: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // ================== 🔍 Query utama ==================
        $query = ManageCTA::select(
            'id',
            'foto_pendaftar',
            'nama_lengkap',
            'nim',
            'angkatan',
            'program_studi',
            'alamat_asli',
            'alamat_domisili',
            'nomor_telepon',
            'instagram',
            'alasan_gabung',
            'minat',
            'created_at'
        );

        // Filter Prodi
        if ($this->filterProdi !== 'all') {
            $query->where('program_studi', $this->filterProdi);
        }

        // Filter Search (multi keyword)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama_lengkap', 'like', "%{$word}%")
                            ->orWhere('nim', 'like', "%{$word}%")
                            ->orWhere('program_studi', 'like', "%{$word}%")
                            ->orWhere('minat', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Urutkan terbaru
        $query->orderBy('created_at', 'desc');
        $ctas = $query->get();

        // ================== 📊 Total ==================
        $totalPendaftar = $ctas->count();
        $sheet->setCellValue('O6', $totalPendaftar);

        // ================== 📝 Isi data ==================
        $startRow = 8;
        $sheet->getColumnDimension('B')->setWidth(15); // kolom foto

        foreach ($ctas as $i => $cta) {
            $row = $startRow + $i;

            $sheet->setCellValue('A' . $row, $i + 1); // No urut

            // ===== Foto Pendaftar =====
            if ($cta->foto_pendaftar) {
                $fotoPath = storage_path('app/public/' . $cta->foto_pendaftar);
                if (file_exists($fotoPath)) {
                    $drawing = new Drawing();
                    $drawing->setName($cta->nama_lengkap);
                    $drawing->setDescription("Foto Pendaftar - " . $cta->nama_lengkap);
                    $drawing->setPath($fotoPath);
                    $drawing->setCoordinates("B{$row}");
                    $drawing->setWidth(50);
                    $drawing->setHeight(50);
                    $drawing->setOffsetX(5);
                    $drawing->setOffsetY(5);
                    $drawing->setWorksheet($sheet);

                    $sheet->getRowDimension($row)->setRowHeight(60);
                } else {
                    $sheet->setCellValue("B{$row}", 'No Image');
                }
            } else {
                $sheet->setCellValue("B{$row}", 'No Image');
            }

            // ===== Data Teks =====
            $sheet->setCellValue('C' . $row, $cta->nama_lengkap);
            $sheet->setCellValueExplicit('D' . $row, $cta->nim, DataType::TYPE_STRING);
            $sheet->setCellValue('E' . $row, $cta->angkatan);
            $sheet->setCellValue('F' . $row, $cta->program_studi);
            $sheet->setCellValue('G' . $row, $cta->alamat_asli);
            $sheet->setCellValue('H' . $row, $cta->alamat_domisili);
            $sheet->setCellValueExplicit('I' . $row, $cta->nomor_telepon, DataType::TYPE_STRING);
            $sheet->setCellValue('J' . $row, $cta->instagram);
            $sheet->setCellValue('K' . $row, $cta->alasan_gabung);
            $sheet->setCellValue('L' . $row, $cta->minat);
        }

        // ================== 💾 Simpan file ==================
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Label nama file
        $prodiName = $this->filterProdi !== 'all' 
            ? str_replace(' ', '-', $this->filterProdi)
            : 'Semua-Prodi';

        $searchLabel = $this->search 
            ? '-Cari-' . str_replace(' ', '-', $this->search)
            : '';

        $dateFormatted = Carbon::now()->format('Ymd_His');
        $tempFile = $tempDir . '/Export-Data-Pendaftar-' . $prodiName . $searchLabel . '-' . $dateFormatted . '.xlsx';

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return file download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}