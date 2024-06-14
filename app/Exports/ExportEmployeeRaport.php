<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportEmployeeRaport implements FromView
{
    protected $employee;

    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    public function view(): View
    {
        // if (!is_array($this->employee)) {
        //     $this->employee = [];
        // }
        $employee = $this->employee;
        return view('excel.employeeRaport',compact('employee'));
    }
}
