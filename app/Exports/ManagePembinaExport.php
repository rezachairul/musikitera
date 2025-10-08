<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_anggota\ManagePembina;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ManagePembinaExport
{
    protected $search;

    public function __construct($search= null)
    {
        $this->search = $search;
    }

    public function export()
    {
        // Path ke tempate
        $templatePath = storage_path('app/templates/manajemen_anggota/temp-export-pembina.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // Base query
        $query = ManagePembina::select(
            'id',
            'nama',
            'foto',
            'nip_nidn',
            'jabatan',
            'awal_periode',
            'akhir_periode',
            'program_studi',
            'kontak',
        );

        // Filter Search
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama', 'like', "%{$word}%")
                        ->orWhere('nip_nidn', 'like', "%{$word}%")
                        ->orWhere('jabatan', 'like', "%{$word}%")
                        ->orWhere('awal_periode', 'like', "%{$word}%")
                        ->orWhere('akhir_periode', 'like', "%{$word}%")
                        ->orWhere('program_studi', 'like', "%{$word}%")
                        ->orWhere('kontak', 'like', "%{$word}%");
                    });
                }
            });
        }

        $query->orderBy('awal_periode', 'asc');

        $manage_pembinas = $query->get();
        // dd($manage_pembinas);

        // ================== 📝 Isi data ==================
        $startRow = 8;
        $sheet->getColumnDimension('B')->setWidth(15); 
        foreach ($manage_pembinas as $i => $manage_pembina) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1); // NO urut (bukan ID langsung)

            // Foto (jika ada)
            if ($manage_pembina->foto) {
                $fotoPath = storage_path('app/public/' . $manage_pembina->foto);
                if (file_exists($fotoPath)) {
                    $drawing = new Drawing();
                    $drawing->setName($manage_pembina->nama);
                    $drawing->setDescription("Foto Pembina" . $manage_pembina->nama);
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
                $sheet->setCellValue("B{$row}", $manage_pembina->nama);
            }

            $sheet->setCellValue('C' . $row, $manage_pembina->nama);
            
            $sheet->setCellValueExplicit(
                'D' . $row, 
                $manage_pembina->nip_nidn, 
                DataType::TYPE_STRING
            );

            $sheet->setCellValue('E' . $row, $manage_pembina->jabatan);

             // Periode (format dd-mm-yyyy)
            $awalPeriode = $manage_pembina->awal_periode ? Carbon::parse($manage_pembina->awal_periode)->format('d-m-Y') : '-';
            $akhirPeriode = $manage_pembina->akhir_periode ? Carbon::parse($manage_pembina->akhir_periode)->format('d-m-Y') : '-';

             $sheet->setCellValue('F' . $row, $awalPeriode);
            $sheet->setCellValue('G' . $row, $akhirPeriode);
            $sheet->setCellValue('H' . $row, $manage_pembina->program_studi);
            $sheet->setCellValue('I' . $row, $manage_pembina->kontak);          
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

        $tempFile = $tempDir . '/Export-Pembina' . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
