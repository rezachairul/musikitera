<?php

namespace App\Exports;

use App\Models\admin\bph\kerjasama_mitra\ManageKerjasama;
use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ManageKerjasamaExport
{
    protected $filterJenis;
    protected $filterStatus;
    protected $search;

    public function __construct($filterJenis = null, $filterStatus = null, $search= null)
    {
        $this->filterJenis = $filterJenis;
        $this->filterStatus = $filterStatus;
        $this->search = $search;
    }

    public function export()
    {
        return ManageKerjasama::all();
    }
}
