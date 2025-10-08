<?php

namespace App\Exports;

use App\Models\admin\bph\publikasi_informasi\ManageKegiatan;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ManageKegiatanExport
{
    protected $filterKategori;
    protected $filterStatus;
    protected $search;

    public function __construct($filterKategori = null, $filterStatus = null, $search = null)
    {
        $this->filterKategori = $filterKategori;
        $this->filterStatus   = $filterStatus;
        $this->search         = $search;
    }

    public function export()
    {
        // ================== 📄 Path Template ==================
        $templatePath = storage_path('app/templates/publikasi_informasi/temp-export-kegiatan.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file tidak ditemukan: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // ================== 🔍 Query Data ==================
        $query = ManageKegiatan::select(
            'id',
            'nama_kegiatan',
            'deskripsi',
            'kategori',
            'tanggal_mulai',
            'tanggal_selesai',
            'jam_mulai',
            'jam_selesai',
            'lokasi',
            'poster',
            'lampiran_path',
            'status',
            'is_highlight'
        );

        // 🗂️ Filter kategori
        if ($this->filterKategori && $this->filterKategori !== 'all') {
            $query->where('kategori', $this->filterKategori);
        }

        // ⚙️ Filter status
        if ($this->filterStatus && $this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        // 🔍 Filter pencarian (multi keyword)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('nama_kegiatan', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%")
                        ->orWhere('kategori', 'like', "%{$word}%")
                        ->orWhere('tanggal_mulai', 'like', "%{$word}%")
                        ->orWhere('tanggal_selesai', 'like', "%{$word}%")
                        ->orWhere('jam_mulai', 'like', "%{$word}%")
                        ->orWhere('jam_selesai', 'like', "%{$word}%")
                        ->orWhere('lokasi', 'like', "%{$word}%")
                        ->orWhere('status', 'like', "%{$word}%");
                }
            });
        }

        $kegiatans = $query->orderBy('created_at', 'desc')->get();

        // ================== 📊 Hitung Total ==================
        $totalKegiatan = $kegiatans->count();
        $sheet->setCellValue('P6', $totalKegiatan);

        // ================== 🏷️ Status Label ==================
        $statusLabels = [
            'draft'     => 'Draft',
            'published' => 'Dipublikasikan',
            'done'      => 'Selesai',
        ];

        // ================== 📝 Isi Data ==================
        $startRow = 8;

        foreach ($kegiatans as $i => $kegiatan) {
            $row = $startRow + $i;

            // No urut
            $sheet->setCellValue("A{$row}", $i + 1);

            // Nama & deskripsi
            $sheet->setCellValue("B{$row}", $kegiatan->nama_kegiatan);
            $sheet->setCellValue("C{$row}", $kegiatan->deskripsi);
            $sheet->setCellValue("D{$row}", $kegiatan->kategori);

            // Tanggal & waktu
            $sheet->setCellValue("E{$row}", $kegiatan->tanggal_mulai);
            $sheet->setCellValue("F{$row}", $kegiatan->tanggal_selesai);
            $sheet->setCellValue("G{$row}", $kegiatan->jam_mulai);
            $sheet->setCellValue("H{$row}", $kegiatan->jam_selesai);
            $sheet->setCellValue("I{$row}", $kegiatan->lokasi);

            // ================== 🖼 Poster ==================
            if ($kegiatan->poster) {
                $posterPath = storage_path('app/public/' . $kegiatan->poster);
                if (file_exists($posterPath)) {
                    $drawing = new Drawing();
                    $drawing->setName($kegiatan->nama_kegiatan);
                    $drawing->setDescription("Poster " . $kegiatan->nama_kegiatan);
                    $drawing->setPath($posterPath);
                    $drawing->setCoordinates("J{$row}");
                    $drawing->setWidth(50);
                    $drawing->setHeight(50);
                    $drawing->setOffsetX(5);
                    $drawing->setOffsetY(5);
                    $drawing->setWorksheet($sheet);

                    $sheet->getRowDimension($row)->setRowHeight(60);
                } else {
                    $sheet->setCellValue("J{$row}", 'No Image');
                }
            } else {
                $sheet->setCellValue("J{$row}", 'No Image');
            }

            // Lampiran path
            $sheet->setCellValueExplicit("K{$row}", $kegiatan->lampiran_path ?? '-', DataType::TYPE_STRING);

            // Status label (mengacu ke daftar label)
            $statusLabel = $statusLabels[$kegiatan->status] ?? ucfirst($kegiatan->status);
            $sheet->setCellValue("L{$row}", $statusLabel);

            // Highlight label
            $highlightLabel = $kegiatan->is_highlight ? 'Ya' : 'Tidak';
            $sheet->setCellValue("M{$row}", $highlightLabel);
        }

        // ================== 💾 Simpan & Download ==================
        $exportDir = storage_path('app/public/exports');
        if (!file_exists($exportDir)) {
            mkdir($exportDir, 0777, true);
        }

        $kategoriLabel = $this->filterKategori && $this->filterKategori !== 'all'
            ? ucfirst($this->filterKategori)
            : 'Semua-Kategori';

        $statusLabel = $this->filterStatus && $this->filterStatus !== 'all'
            ? ucfirst($this->filterStatus)
            : 'Semua-Status';

        $searchLabel = $this->search ? '-Cari-' . str_replace(' ', '-', $this->search) : '';
        $timestamp = Carbon::now()->format('Ymd_His');

        $filename = "Export-Kegiatan-{$kategoriLabel}-{$statusLabel}{$searchLabel}-{$timestamp}.xlsx";
        $filePath = $exportDir . '/' . $filename;

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend();
    }
}
