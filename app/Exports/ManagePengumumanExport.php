<?php

namespace App\Exports;

use App\Models\admin\bph\publikasi_informasi\ManagePengumuman;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManagePengumumanExport
{
    protected $filterSifat;
    protected $filterStatus;
    protected $search;

    public function __construct($filterSifat = null, $filterStatus = null, $search = null)
    {
        $this->filterSifat    = $filterSifat;
        $this->filterStatus   = $filterStatus;
        $this->search         = $search;
    }

    public function export()
    {
        return ManagePengumuman::all();
    }
}
