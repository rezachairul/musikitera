<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_konten\Hero;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ManageHeroExport
{
    protected $search;

    public function __construct($search= null)
    {
        $this->search = $search;
    }

    public function export()
    {
        // Path ke tempate
        $templatePath = storage_path('app/templates/manajemen_konten/temp-export-hero.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // Base query
        $query = Hero::select(
            'id',
            'quote_1',
            'quote_2',
            'image',
        );

        // Filter Search
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('quote_1', 'like', "%{$word}%")
                        ->orWhere('quote_1', 'like', "%{$word}%");
                    });
                }
            });
        }

        $query->orderBy('created_at', 'asc');

        $heroes = $query->get();
        // dd($heroes);
    
    // ================== 📝 Isi data ==================
        $startRow = 8;
        $sheet->getColumnDimension('B')->setWidth(15); 
        foreach ($heroes as $i => $hero) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1); // NO urut (bukan ID langsung)

            // Image (jika ada)
            if ($hero->image) {
                $fotoPath = storage_path('app/public/' . $hero->image);
                if (file_exists($fotoPath)) {
                    $drawing = new Drawing();
                    $drawing->setDescription("Foto Hero");
                    $drawing->setPath($fotoPath);

                    $drawing->setCoordinates("B{$row}");

                    // ukuran foto biar seragam
                    $drawing->setWidth(50);   // lebar px
                    $drawing->setHeight(50);  // tinggi px

                    $drawing->setOffsetX(5); // jarak dari kiri cell
                    $drawing->setOffsetY(5); // jarak dari atas cell
                    $drawing->setWorksheet($sheet);

                    // sesuaikan tinggi baris
                    $sheet->getRowDimension($row)->setRowHeight(60);
                } else {
                    $sheet->setCellValue("B{$row}",  'No Image');
                }
            } else {
                $sheet->setCellValue("B{$row}", '');
            }

            $sheet->setCellValue('C' . $row, $hero->quote_1);
            $sheet->setCellValue('D' . $row, $hero->quote_2);

        }

        // ================== 💾 Save & Download ==================
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Kalau ada search, tambahkan ke nama file
        $searchLabel = $this->search 
            ? '-Cari-' . str_replace(' ', '-', $this->search) 
            : '';

        $dateFormatted = Carbon::now()->format('Ymd_His');

        $tempFile = $tempDir . '/Export-Hero' . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
