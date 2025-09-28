<?php

namespace App\Exports;

use App\Models\admin\bph\ManageMitra;
use Maatwebsite\Excel\Concerns\FromCollection;

class ManageMitraExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ManageMitra::all();
    }
}
