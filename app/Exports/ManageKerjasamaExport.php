<?php

namespace App\Exports;

use App\Models\admin\bph\kerjasama_mitra\ManageKerjasama;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ManageKerjasamaExport
{
    protected $filterJenis;
    protected $filterStatus;
    protected $search;

    public function __construct($filterJenis = null, $filterStatus = null, $search = null)
    {
        $this->filterJenis  = $filterJenis;
        $this->filterStatus = $filterStatus;
        $this->search       = $search;
    }

    public function export()
    {
        // ================== 📄 Path Template ==================
        $templatePath = storage_path('app/templates/kerjasama_mitra/temp-export-kerjasama.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file tidak ditemukan: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // ================== 🔍 Query Data ==================
        $query = ManageKerjasama::select(
            'id',
            'judul_kerjasama',
            'deskripsi',
            'jenis_kerjasama',
            'tanggal_mulai',
            'tanggal_selesai',
            'nama_organisasi',
            'poster',
            'file_dokumen_path',
            'status'
        );

        // Filter jenis kerjasama
        if ($this->filterJenis && $this->filterJenis !== 'all') {
            $query->where('jenis_kerjasama', $this->filterJenis);
        }

        // Filter status
        if ($this->filterStatus && $this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        // Filter pencarian
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('judul_kerjasama', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%")
                        ->orWhere('nama_organisasi', 'like', "%{$word}%")
                        ->orWhere('jenis_kerjasama', 'like', "%{$word}%")
                        ->orWhere('status', 'like', "%{$word}%");
                }
            });
        }

        $kerjasamas = $query->orderBy('created_at', 'desc')->get();

        // ================== 📊 Hitung Total ==================
        $totalKerjasama = $kerjasamas->count();
        $sheet->setCellValue('M7', $totalKerjasama);

        // ================== 🏷️ Status Label ==================
        $statusLabels = [
            'rencana'  => 'Rencana',
            'berjalan' => 'Berjalan',
            'selesai'  => 'Selesai',
        ];

        // ================== 📝 Isi Data ==================
        $startRow = 8;

        foreach ($kerjasamas as $i => $kerjasama) {
            $row = $startRow + $i;

            // No
            $sheet->setCellValue("A{$row}", $i + 1);

            // Judul & Deskripsi
            $sheet->setCellValue("B{$row}", $kerjasama->judul_kerjasama);
            $sheet->setCellValue("C{$row}", $kerjasama->deskripsi);

            // Jenis Kerjasama
            $sheet->setCellValue("D{$row}", $kerjasama->jenis_kerjasama);

            // Tanggal Mulai & Selesai
            $sheet->setCellValue("E{$row}", Carbon::parse($kerjasama->tanggal_mulai)->format('d/m/Y'));
            $sheet->setCellValue("F{$row}", $kerjasama->tanggal_selesai ? Carbon::parse($kerjasama->tanggal_selesai)->format('d/m/Y') : '-');

            // Nama Organisasi
            $sheet->setCellValue("G{$row}", $kerjasama->nama_organisasi ?? '-');

            // ================== 🖼 Poster ==================
            if ($kerjasama->poster) {
                $posterPath = storage_path('app/public/kerjasama/poster/' . $kerjasama->poster);
                if (file_exists($posterPath)) {
                    $drawing = new Drawing();
                    $drawing->setName('Poster');
                    $drawing->setDescription('Poster Kerjasama');
                    $drawing->setPath($posterPath);
                    $drawing->setCoordinates("H{$row}");
                    $drawing->setWidth(50);
                    $drawing->setHeight(50);
                    $drawing->setOffsetX(5);
                    $drawing->setOffsetY(5);
                    $drawing->setWorksheet($sheet);

                    $sheet->getRowDimension($row)->setRowHeight(60);
                } else {
                    $sheet->setCellValue("H{$row}", 'No Image');
                }
            } else {
                $sheet->setCellValue("H{$row}", 'No Image');
            }

            // ================== 📄 Dokumen ==================
            $sheet->setCellValueExplicit(
                "I{$row}",
                $kerjasama->file_dokumen_path ? basename($kerjasama->file_dokumen_path) : '-',
                DataType::TYPE_STRING
            );

            // Status
            $statusLabel = $statusLabels[$kerjasama->status] ?? ucfirst($kerjasama->status);
            $sheet->setCellValue("J{$row}", $statusLabel);
        }

        // ================== 💾 Simpan & Download ==================
        $exportDir = storage_path('app/public/exports');
        if (!file_exists($exportDir)) {
            mkdir($exportDir, 0777, true);
        }

        $jenisLabel = $this->filterJenis && $this->filterJenis !== 'all'
            ? ucfirst($this->filterJenis)
            : 'Semua-Jenis';

        $statusLabel = $this->filterStatus && $this->filterStatus !== 'all'
            ? ucfirst($this->filterStatus)
            : 'Semua-Status';

        $searchLabel = $this->search ? '-Cari-' . str_replace(' ', '-', $this->search) : '';
        $timestamp   = Carbon::now()->format('Ymd_His');

        $filename = "Export-Kerjasama-{$jenisLabel}-{$statusLabel}{$searchLabel}-{$timestamp}.xlsx";
        $filePath = $exportDir . '/' . $filename;

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend();
    }
}
