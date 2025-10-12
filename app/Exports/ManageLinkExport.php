<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_konten\Link;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class ManageLinkExport
{
    protected $search;
    protected $filterKategori;

    public function __construct($search = null, $filterKategori = 'all')
    {
        $this->search = $search;
        $this->filterKategori = $filterKategori;
    }

    public function export()
    {
        // Path ke template file
        $templatePath = storage_path('app/templates/manajemen_konten/temp-export-link.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Base Query
        $query = Link::select('id', 'nama_link', 'url', 'kategori', 'deskripsi', 'status', 'created_at');

        // 🔍 Filter Pencarian
        if (!empty($this->search)) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama_link', 'like', "%{$word}%")
                          ->orWhere('url', 'like', "%{$word}%")
                          ->orWhere('deskripsi', 'like', "%{$word}%");
                    });
                }
            });
        }

        // 🎯 Filter Kategori
        if ($this->filterKategori !== 'all') {
            $query->where('kategori', $this->filterKategori);
        }

        // Urutkan berdasarkan waktu pembuatan
        $query->orderBy('created_at', 'asc');
        $links = $query->get();

        // ================== 📝 Total ==================
        $totalLink = $links->count();
        $sheet->setCellValue('I6', "Total Link: {$totalLink}");

        // ================== 📝 Isi Data ==================
        $startRow = 8;
        foreach ($links as $i => $link) {
            $row = $startRow + $i;

            $sheet->setCellValue('A' . $row, $i + 1); // No Urut
            $sheet->setCellValueExplicit('B' . $row, $link->nama_link, DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C' . $row, $link->url, DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $link->kategori_label ?? '-');
            $sheet->setCellValue('E' . $row, $link->deskripsi ?? '-');

            // Badge status (aktif/nonaktif)
            $statusLabel = $link->status == 1 ? 'Aktif' : 'Nonaktif';
            $sheet->setCellValue('F' . $row, $statusLabel);
        }

        // ================== 💾 Save & Download ==================
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Nama file dinamis
        $searchLabel = $this->search 
            ? '-Cari-' . str_replace(' ', '-', $this->search) 
            : '';
        $kategoriLabel = $this->filterKategori !== 'all'
            ? '-Kategori-' . str_replace(' ', '-', $this->filterKategori)
            : '';

        $dateFormatted = Carbon::now()->format('Ymd_His');
        $tempFile = $tempDir . '/Export-Link' . $searchLabel . $kategoriLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan ke file sementara
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Download & hapus setelah terkirim
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}