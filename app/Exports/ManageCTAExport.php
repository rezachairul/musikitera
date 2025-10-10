<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_konten\ManageCTA;
use Maatwebsite\Excel\Concerns\FromCollection;

class ManageCTAExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ManageCTA::all();
    }
}
