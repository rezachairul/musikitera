<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_konten\Link;
use Maatwebsite\Excel\Concerns\FromCollection;

class ManageLinkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Link::all();
    }
}
