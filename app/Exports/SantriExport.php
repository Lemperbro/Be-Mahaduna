<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SantriExport implements FromView
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {

        return view('excel-template.santri', [
            'data' => $this->data
        ]);
    }

}
