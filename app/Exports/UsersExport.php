<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UsersExport
{
    protected $role;
    protected $search;

    public function __construct($role = null, $search = null)
    {
        $this->role   = $role;
        $this->search = $search;
    }

    public function export()
    {
        // Path ke template
        $templatePath = storage_path('app/templates/temp-export-user.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Template file not found: ' . $templatePath);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet       = $spreadsheet->getActiveSheet();

        // 🔧 Roles yang digunakan
        $roles = ['admin', 'bph', 'dpo', 'pembina'];

        // Base query
        $query = User::select('id', 'name', 'email', 'role');

        // Filter role
        if ($this->role && in_array($this->role, $roles)) {
            $query->where('role', $this->role);
        } else {
            $query->whereIn('role', $roles);
        }

        // 🔍 Filter search (multi keyword, AND)
        if ($this->search) {
            $keywords = preg_split('/\s+/', (string) $this->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q2) use ($word) {
                        $q2->where('name', 'like', "%{$word}%")
                           ->orWhere('email', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Order by role priority + name
        $query->orderByRaw("
            CASE 
                WHEN role = 'admin' THEN 1
                WHEN role = 'bph' THEN 2
                WHEN role = 'dpo' THEN 3
                WHEN role = 'pembina' THEN 4
                ELSE 5
            END
        ")->orderBy('name');

        $users = $query->get();
        // dd($users);

        // ================== 📊 Hitung total ==================
        $totals = [
            'all'     => $users->count(),
            'admin'   => $users->where('role', 'admin')->count(),
            'bph'     => $users->where('role', 'bph')->count(),
            'dpo'     => $users->where('role', 'dpo')->count(),
            'pembina' => $users->where('role', 'pembina')->count(),
        ];

        // Tulis ke cell template
        $sheet->setCellValue('D25', ': ' . $totals['all']     . ' Orang');
        $sheet->setCellValue('D26', ': ' . $totals['admin']   . ' Orang');
        $sheet->setCellValue('D27', ': ' . $totals['bph']     . ' Orang');
        $sheet->setCellValue('D28', ': ' . $totals['dpo']     . ' Orang');
        $sheet->setCellValue('D29', ': ' . $totals['pembina'] . ' Orang');

        // ================== 📝 Isi data ==================
        $startRow = 8;
        foreach ($users as $i => $user) {
            $row = $startRow + $i;
            $sheet->setCellValue('B' . $row, $i + 1); // NO urut (bukan ID langsung)
            $sheet->setCellValue('C' . $row, $user->name);
            $sheet->setCellValueExplicit('D' . $row, $user->email, DataType::TYPE_STRING);
            $roleLabels = [
                'admin'   => 'Administrator',
                'bph'     => 'Badan Pengurus',
                'dpo'     => 'Dewan Pengawas',
                'pembina' => 'Pembina',
            ];
            $roleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);
            $sheet->setCellValue('E' . $row, $roleLabel);
        }

        // ================== 💾 Save & Download ==================
        $tempDir = storage_path('app/public/exports');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // 🔥 Label nama file
        $roleLabels = [
            'admin'   => 'Administrator',
            'bph'     => 'Badan-Pengurus',
            'dpo'     => 'Dewan-Pengawas',
            'pembina' => 'Pembina',
        ];

        $roleName = $this->role && isset($roleLabels[$this->role]) 
            ? $roleLabels[$this->role] 
            : 'Semua-Role';

        // Kalau ada search, tambahkan ke nama file
        $searchLabel = $this->search 
            ? '-Cari-' . str_replace(' ', '-', $this->search) 
            : '';

        $dateFormatted = Carbon::now()->format('Ymd_His');

        $tempFile = $tempDir . '/Export-User-' . $roleName . $searchLabel . '-' . $dateFormatted . '.xlsx';

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Return response download
        return response()->download($tempFile)->deleteFileAfterSend();
    }
}
