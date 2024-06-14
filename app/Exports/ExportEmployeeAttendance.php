<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportEmployeeAttendance implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Employee Name' => $item->employee->full_name,
                'Employee Email' => $item->employee->email,
                'Attendance Status' => $item->status == 1 ? "absenc" : "Retard",
                'Reason' => $item->reason,
            ];
        });
    }
    public function styles(Worksheet $sheet)
    {
        $statusColumn = 'C'; // Assuming 'Attendance Status' is the third column
        $lastRow = $sheet->getHighestRow();

        // Set styles conditionally for each cell in the 'Attendance Status' column
        for ($row = 2; $row <= $lastRow; $row++) {
            $statusCell = $statusColumn . $row;
            $statusValue = $sheet->getCell($statusCell)->getValue();

            $fillColor = $statusValue == "absenc" ? 'FF0000' : 'FFBC00'; 

            // Set fill color
            $sheet->getStyle($statusCell)->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle($statusCell)->getFill()->getStartColor()->setARGB($fillColor);
        }
    }
    public function headings(): array
    {
        return [
            'Employee Name',
            'Employee Email',
            'Attendance Status',
            'Reason',
        ];
    }
}
