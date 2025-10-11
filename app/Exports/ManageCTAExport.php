<?php

namespace App\Exports;

use App\Models\admin\bph\manajemen_konten\ManageCTA;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ManageCTAExport 
{
    protected $filterProdi;
    protected $search;

    public function __construct($filterProdi = 'all', $search = '')
    {
        $this->filterProdi = $filterProdi;
        $this->search = $search;
    }

    public function export()
    {
        // 
    }
}
