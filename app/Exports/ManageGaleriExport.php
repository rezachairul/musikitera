<?php

namespace App\Exports;


use App\Models\admin\bph\manajemen_konten\ManageGaleri;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ManageGaleriExport
{
    protected $search;
    protected $kegiatan_date;
    protected $title;

    public function __construct($search= null, $kegiatan_date= null, $title= null)
    {
        $this->search = $search;
        $this->kegiatan_date = $kegiatan_date;
        $this->title = $title;
    }

    public function export()
    {
        // Path ke tempate
        $templatePath = storage_path('app/templates/temp-export-galeri.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // Base query
        $query = ManageGaleri::select(
            'id',
            'title',
            'kegiatan_date',
            'description',
            'image',
        );

        // Filter Search
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")
                        ->orWhere('kegiatan_date', 'like', "%{$word}%")
                        ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            });
        }

        $query->orderBy('title', 'asc')
                ->orderBy('kegiatan_date', 'asc');

        $manage_galeris = $query->get();
        // dd($manage_galeris);

        // ================== 📝 Isi data ==================
        $startRow = 7;
        $sheet->getColumnDimension('B')->setWidth(15); 
        foreach ($manage_galeris as $i => $manage_galeri) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1); // NO urut (bukan ID langsung)

            // image (jika ada)
            if ($manage_galeri->image) {
                $imagePath = storage_path('app/public/' . $manage_galeri->image);
                if (file_exists($imagePath)) {
                    $drawing = new Drawing();
                    $drawing->setName($manage_galeri->title);
                    $drawing->setDescription("image galeri" . $manage_galeri->title);
                    $drawing->setPath($imagePath);

                    $drawing->setCoordinates("B{$row}");

                    // ukuran image biar seragam
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
                $sheet->setCellValue("B{$row}", $manage_galeri->title);
            }

            $sheet->setCellValue('C' . $row, $manage_galeri->title);

             // Kegiatan Date (format dd-mm-yyyy)
            $kegiatanDate = $manage_galeri->kegiatan_date ? Carbon::parse($manage_galeri->kegiatan_date)->format('d-m-Y') : '-';

             $sheet->setCellValue('D' . $row, $kegiatanDate);
            $sheet->setCellValue('E' . $row, $manage_galeri->description);         
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

        $tempFile = $tempDir . '/Export-Galeri' . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
    
}
