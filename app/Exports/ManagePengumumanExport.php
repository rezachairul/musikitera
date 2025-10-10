<?php

namespace App\Exports;

use App\Models\admin\bph\publikasi_informasi\ManagePengumuman;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ManagePengumumanExport
{
    protected $filterSifat;
    protected $filterStatus;
    protected $search;

    public function __construct($filterSifat = null, $filterStatus = null, $search = null)
    {
        $this->filterSifat  = $filterSifat;
        $this->filterStatus = $filterStatus;
        $this->search       = $search;
    }

    public function export()
    {
        // ================== 📄 Path Template ==================
        $templatePath = storage_path('app/templates/publikasi_informasi/temp-export-pengumuman.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file tidak ditemukan: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // ================== 🔍 Query Data ==================
        $query = ManagePengumuman::select(
            'id',
            'judul',
            'isi',
            'sifat',
            'tanggal_pengumuman',
            'gambar',
            'gambar_path',
            'file_dokumen',
            'file_dokumen_path',
            'status',
            'user_id'
        )->with('user');

        // 🧩 Filter sifat
        if ($this->filterSifat && $this->filterSifat !== 'all') {
            $query->where('sifat', $this->filterSifat);
        }

        // 🧩 Filter status
        if ($this->filterStatus && $this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        // 🔍 Filter pencarian (multi keyword)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('judul', 'like', "%{$word}%")
                        ->orWhere('isi', 'like', "%{$word}%")
                        ->orWhere('sifat', 'like', "%{$word}%")
                        ->orWhere('status', 'like', "%{$word}%");
                }
            });
        }

        $pengumumans = $query->orderBy('created_at', 'desc')->get();

        // ================== 📊 Total ==================
        $totalPengumuman = $pengumumans->count();
        $sheet->setCellValue('L6', $totalPengumuman); // contoh posisi total

        // ================== 🏷️ Status Label ==================
        $statusLabels = [
            'draft'   => 'Draft',
            'publish' => 'Dipublikasikan',
            'arsip'   => 'Arsip',
        ];

        // ================== 📝 Isi Data ==================
        $startRow = 8;
        foreach ($pengumumans as $i => $p) {
            $row = $startRow + $i;

            // Nomor urut
            $sheet->setCellValue("A{$row}", $i + 1);

            // Judul, isi, sifat, tanggal
            $sheet->setCellValue("B{$row}", $p->judul);
            $sheet->setCellValue("C{$row}", strip_tags($p->isi));
            $sheet->setCellValue("D{$row}", $p->sifat);
            $sheet->setCellValue("E{$row}", $p->tanggal_pengumuman ? Carbon::parse($p->tanggal_pengumuman)->format('d-m-Y') : '-');

            // ================== 🖼 Gambar ==================
            if ($p->gambar_path && file_exists(storage_path('app/public/' . $p->gambar_path))) {
                $drawing = new Drawing();
                $drawing->setName($p->judul);
                $drawing->setDescription("Gambar Pengumuman " . $p->judul);
                $drawing->setPath(storage_path('app/public/' . $p->gambar_path));
                $drawing->setCoordinates("F{$row}");
                $drawing->setWidth(50);
                $drawing->setHeight(50);
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWorksheet($sheet);

                $sheet->getRowDimension($row)->setRowHeight(60);
            } else {
                $sheet->setCellValue("F{$row}", 'No Image');
            }

            // File dokumen
            $sheet->setCellValueExplicit("G{$row}", $p->file_dokumen ?? '-', DataType::TYPE_STRING);

            // Status
            $statusLabel = $statusLabels[$p->status] ?? ucfirst($p->status);
            $sheet->setCellValue("H{$row}", $statusLabel);

            // Dibuat oleh (nama user)
            $sheet->setCellValue("I{$row}", $p->user->name ?? '-');
        }

        // ================== 💾 Simpan & Download ==================
        $exportDir = storage_path('app/public/exports');
        if (!file_exists($exportDir)) {
            mkdir($exportDir, 0777, true);
        }

        $sifatLabel = $this->filterSifat && $this->filterSifat !== 'all'
            ? ucfirst($this->filterSifat)
            : 'Semua-Sifat';

        $statusLabel = $this->filterStatus && $this->filterStatus !== 'all'
            ? ucfirst($this->filterStatus)
            : 'Semua-Status';

        $searchLabel = $this->search ? '-Cari-' . str_replace(' ', '-', $this->search) : '';
        $timestamp = Carbon::now()->format('Ymd_His');

        $filename = "Export-Pengumuman-{$sifatLabel}-{$statusLabel}{$searchLabel}-{$timestamp}.xlsx";
        $filePath = $exportDir . '/' . $filename;

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend();
    }
}
