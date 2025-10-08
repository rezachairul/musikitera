<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AnggotaExport
{
    protected $status;
    protected $search;

    public function __construct($status = null, $search= null)
    {
        $this->status = $status;
        $this->search = $search;
    }

    public function export()
    {
        // Path ke tempate
        $templatePath = storage_path('app/templates/manajemen_anggota/temp-export-data-anggota.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // Status yang digunakan
        $statuses = ['graduate', 'on_going', 'drop_out', 'exit'];

        // Base query
        $query = AnggotaAktif::select(
            'id',
            'nama',
            'nim',
            'angkatan',
            'prodi',
            'nomor_urut',
            'pendiri',
            'angkatan_ukm',
            'organisasi',
            'status'
        );

        // Filter status
        if ($this->status && in_array($this->status, $statuses)) {
            $query->where('status', $this->status);
        } else {
            $query->whereIn('status', $statuses);
        }

        // Filter Search
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama', 'like', "%{$word}%")
                        ->orWhere('nim', 'like', "%{$word}%")
                        ->orWhere('nia', 'like', "%{$word}%")
                        ->orWhere('prodi', 'like', "%{$word}%");
                    });
                }
            });
        }

        // urutan: pendiri dulu, lalu berdasarkan nomor urut
        $query->orderByDesc('pendiri')
                ->orderBy('nomor_urut');

        $anggota_aktifs = $query->get();
        // dd($anggota_aktifs);

        // ================== 📊 Hitung total ==================
        $totals = [
            'all'      => $anggota_aktifs->count(),
            'graduate' => $anggota_aktifs->where('status', 'graduate')->count(),
            'on_going' => $anggota_aktifs->where('status', 'on_going')->count(),
            'drop_out' => $anggota_aktifs->where('status', 'drop_out')->count(),
            'exit'     => $anggota_aktifs->where('status', 'exit')->count(),
        ];

        // Tulis ke cell tempplate
        $sheet->setCellValue('L7', $totals['graduate']);
        $sheet->setCellValue('L8', $totals['on_going']);
        $sheet->setCellValue('L9', $totals['drop_out']);
        $sheet->setCellValue('L10', $totals['exit']);
        $sheet->setCellValue('L11', $totals['all']);

        // ================== 📝 Isi data ==================
        $startRow = 7;
        foreach ($anggota_aktifs as $i => $anggota_aktif) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1); // NO urut (bukan ID langsung)
            $sheet->setCellValue('B' . $row, $anggota_aktif->nama);
            $sheet->setCellValue('C' . $row, $anggota_aktif->nim);
            $sheet->setCellValue('D' . $row, $anggota_aktif->angkatan);
            $sheet->setCellValue('E' . $row, $anggota_aktif->prodi);
            $sheet->setCellValueExplicit(
                'F' . $row,
                $anggota_aktif->nia, // ini panggil accessor getNiaAttribute()
                \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
            );
            $statusLabels = [
                'graduate'  => 'Lulus',
                'on_going'  => 'Aktif perkuliahan',
                'drop_out'  => 'Drop Out',
                'exit'      => 'Keluar',
            ];
            $statusLabel = $statusLabels[$anggota_aktif->status] ?? ucfirst($anggota_aktif->status);
            $sheet->setCellValue('G' . $row, $statusLabel);
        }

        // ================== 💾 Save & Download ==================
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Label nama file
        $statusLabels = [
            'graduate'  => 'Lulus',
            'on_going'  => 'Aktif perkuliahan',
            'drop_out'  => 'Drop Out',
            'exit'      => 'Keluar',
        ];

        $statusName = $this->status && isset($statusLabels[$this->status]) 
            ? $statusLabels[$this->status] 
            : 'Semua-status';

        // Kalau ada search, tambahkan ke nama file
        $searchLabel = $this->search 
            ? '-Cari-' . str_replace(' ', '-', $this->search) 
            : '';

        $dateFormatted = Carbon::now()->format('Ymd_His');

        $tempFile = $tempDir . '/Export-Data-Anggota-' . $statusName . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
