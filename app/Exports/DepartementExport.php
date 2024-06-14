<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartementExport implements FromCollection, WithHeadings
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Departement name' => $item->name,
                'Employee count' => $item->Employee->count(),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Departement name',
            'Employee Count',
        ];
    }
}
