<?php

namespace App\Exports;

use App\Models\admin\bph\publikasi_informasi\ManageDokumen;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ManageDokumenExport
{
    protected $filterKategori;
    protected $filterStatus;
    protected $search;

    public function __construct($filterKategori = null, $filterStatus, $search = null)
    {
        $this->filterKategori   = $filterKategori;
        $this->filterStatus     = $filterStatus;
        $this->search = $search;
    }
    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-dokumen.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // 🔧 Kategori yang digunakan

        // Status yang digunakan

        // Base query
        $query = ManageDokumen::select('id', 'judul', 'kategori', 'file_path', 'is_active', 'deskripsi', 'year_published');

        // Filter 
        // 🗂 Filter kategori
        if ($this->filterKategori && $this->filterKategori !== 'all') {
            $query->where('kategori', $this->filterKategori);
        }

        // ⚙️ Filter status
        if ($this->filterStatus && $this->filterStatus !== 'all') {
            $query->where('is_active', $this->filterStatus);
        }

        // 🔍 Filter pencarian (multi keyword)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q2) use ($word) {
                        $q2->where('judul', 'like', "%{$word}%")
                           ->orWhere('kategori', 'like', "%{$word}%")
                           ->orWhere('is_active', 'like', "%{$word}%")
                           ->orWhere('deskripsi', 'like', "%{$word}%");
                    });
                }
            });
        }

        $manage_dokumens = $query->orderBy('created_at', 'desc')->get();
        // dd($manage_dokumens);

        // ================== 📊 Hitung total ==================
        $totalSOP     = $manage_dokumens->where('kategori', 'SOP')->count();
        $totalMoU     = $manage_dokumens->where('kategori', 'MoU')->count();
        $totalFormat  = $manage_dokumens->where('kategori', 'Format')->count();
        $totalAll     = $manage_dokumens->count();

        // Tulis ke cell template
        $sheet->setCellValue('J7', $totalSOP);
        $sheet->setCellValue('J8', $totalMoU);
        $sheet->setCellValue('J9', $totalFormat);
        $sheet->setCellValue('J10', $totalAll);

        // ================== 📝 Isi data ==================

        $startRow = 7;
        foreach ($manage_dokumens as $i => $manage_dokumen) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1); // No urut
            $sheet->setCellValue('B' . $row, $manage_dokumen->judul);
            $sheet->setCellValue('C' . $row, $manage_dokumen->deskripsi);
            $sheet->setCellValue('D' . $row, $manage_dokumen->kategori);
            $sheet->setCellValueExplicit('E' . $row, $manage_dokumen->file_path, DataType::TYPE_STRING);
            $statusLabel = $manage_dokumen->is_active ? 'Aktif' : 'Non-Aktif';
            $sheet->setCellValue('F' . $row, $statusLabel);
        }

        // ================== 💾 Simpan & Download ==================
        $exportDir = storage_path('app/public/exports');
        if (!file_exists($exportDir)) {
            mkdir($exportDir, 0777, true);
        }

        $kategoriLabel = $this->filterKategori && $this->filterKategori !== 'all'
            ? $this->filterKategori
            : 'Semua-Kategori';

        $statusLabel = $this->filterStatus && $this->filterStatus !== 'all'
            ? ($this->filterStatus == 1 ? 'Aktif' : 'Non-Aktif')
            : 'Semua-Status';

        $searchLabel = $this->search ? '-Cari-' . str_replace(' ', '-', $this->search) : '';
        $timestamp = Carbon::now()->format('Ymd_His');

        $filename = "Export-Dokumen-{$kategoriLabel}-{$statusLabel}{$searchLabel}-{$timestamp}.xlsx";
        $filePath = $exportDir . '/' . $filename;

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Return response download
        return response()->download($filePath)->deleteFileAfterSend();
    }
}
