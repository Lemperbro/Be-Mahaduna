<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MonitoringExport implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {

        return view('excel-template.monitoring', [
            'data' => $this->data
        ]);
    }
}
