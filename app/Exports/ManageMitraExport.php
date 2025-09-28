<?php

namespace App\Exports;

use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ManageMitraExport
{
    protected $type;
    protected $sub_type;
    protected $search;

    public function __construct($type = null, $sub_type = null, $search= null)
    {
        $this->type = $type;
        $this->sub_type = $sub_type;
        $this->search = $search;
    }

    public function export()
    {
        // Path ke tempate
        $templatePath = storage_path('app/templates/temp-export-mitra.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // Type and Sub Type yang digunakan
        $types    = ['internal', 'eksternal'];
        $subTypes = ['institusi', 'ormawa_hmps', 'ormawa_ukm', 'ukmbs', 'komunitas'];

        // Base query
        $query = ManageMitra::select(
            'id',
            'logo',
            'name',
            'type',
            'sub_type',
            'url'
        );

        // Filter type n sub_type
        if ($this->type && in_array($this->type, $types)) {
            $query->where('type', $this->type);
        } else {
            $query->whereIn('type', $types);
        }

        // Filter Search
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('name', 'like', "%{$word}%")
                        ->orWhere('type', 'like', "%{$word}%")
                        ->orWhere('sub_type', 'like', "%{$word}%")
                        ->orWhere('url', 'like', "%{$word}%");
                    });
                }
            });
        }

        // 📌 Urutan khusus
        $orderSubType = [
            'institusi'   => 1,
            'ormawa_hmps' => 2,
            'ormawa_ukm'  => 3,
            'ukmbs'       => 4,
            'komunitas'   => 5,
        ];

        $query->orderByRaw("
            CASE 
                WHEN type = 'internal' THEN 1
                WHEN type = 'eksternal' THEN 2
                ELSE 3
            END
        ")->orderByRaw("
            CASE sub_type
                WHEN 'institusi' THEN 1
                WHEN 'ormawa_hmps' THEN 2
                WHEN 'ormawa_ukm' THEN 3
                WHEN 'ukmbs' THEN 4
                WHEN 'komunitas' THEN 5
                ELSE 6
            END
        ")->orderBy('name', 'asc');

        $mitras = $query->get();
        // dd($mitras);

        // ================== 📊 Hitung total mitra ==================
        $totals = [
            'internal'      => $mitras->where('type', 'internal')->count(),
            'institusi'     => $mitras->where('sub_type', 'institusi')->count(),
            'ormawa_hmps'   => $mitras->where('sub_type', 'ormawa_hmps')->count(),
            'ormawa_ukm'    => $mitras->where('sub_type', 'ormawa_ukm')->count(),
            'eksternal'     => $mitras->where('type', 'eksternal')->count(),
            'ukmbs'         => $mitras->where('sub_type', 'ukmbs')->count(),
            'komunitas'     => $mitras->where('sub_type', 'komunitas')->count(),
            'all'           => $mitras->count(),
        ];

        // ================== 📝 Tulis ke cell sesuai mapping ==================
        $sheet->setCellValue('K7',  $totals['internal']);
        $sheet->setCellValue('K8',  $totals['institusi']);
        $sheet->setCellValue('K9',  $totals['ormawa_hmps']);
        $sheet->setCellValue('K10', $totals['ormawa_ukm']);
        $sheet->setCellValue('K11', $totals['eksternal']);
        $sheet->setCellValue('K12', $totals['ukmbs']);
        $sheet->setCellValue('K13', $totals['komunitas']);
        $sheet->setCellValue('K14', $totals['all']);

        // ================== 📝 Isi data ==================
        $startRow = 8;
        $sheet->getColumnDimension('B')->setWidth(15); 
        foreach ($mitras as $i => $mitra) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1); // NO urut

            // ================== Logo ==================
            if ($mitra->logo) {
                $logoPath = storage_path('app/public/' . $mitra->logo);
                if (file_exists($logoPath)) {
                    $drawing = new Drawing();
                    $drawing->setName($mitra->name);
                    $drawing->setDescription("Logo " . $mitra->name);
                    $drawing->setPath($logoPath);
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

            // ================== Nama ==================
            $sheet->setCellValue('C' . $row, $mitra->name);

            // ================== Type & Sub-Type (Label) ==================
            $typeLabels = [
                'internal'  => 'Internal',
                'eksternal' => 'Eksternal',
            ];
            $subTypeLabels = [
                'institusi'   => 'Institusi',
                'ormawa_hmps' => 'Ormawa HMPS',
                'ormawa_ukm'  => 'Ormawa UKM',
                'ukmbs'       => 'UKMBS',
                'komunitas'   => 'Komunitas',
            ];

            $sheet->setCellValue('D' . $row, $typeLabels[$mitra->type] ?? $mitra->type);
            $sheet->setCellValue('E' . $row, $subTypeLabels[$mitra->sub_type] ?? $mitra->sub_type);

            // ================== URL Name sebagai hyperlink ==================
            if (!empty($mitra->url)) {
                $sheet->setCellValue("F{$row}", $mitra->name); // tulis nama lagi
                $sheet->getCell("F{$row}")
                    ->getHyperlink()
                    ->setUrl($mitra->url)
                    ->setTooltip("Klik untuk buka {$mitra->name}");
            } else {
                $sheet->setCellValue("F{$row}", '-');
            }
        }


        // ================== 💾 Save & Download ==================
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Kalau ada search, tambahkan ke name file
        $searchLabel = $this->search 
            ? '-Cari-' . str_replace(' ', '-', $this->search) 
            : '';

        $dateFormatted = Carbon::now()->format('Ymd_His');

        $tempFile = $tempDir . '/Export-Mitra' . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();

    }
}
