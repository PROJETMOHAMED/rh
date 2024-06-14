<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AttendanceEmployeesExport implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        if (!is_array($this->data)) {
            $this->data = [];
        }
        return view('excel.employeesAttendances', [
            'employees' => $this->data['employees'] ?? [],
            'dates' => $this->data['dates'] ?? [],
        ]);
    }
}
