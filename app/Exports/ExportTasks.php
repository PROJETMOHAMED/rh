<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTasks implements FromCollection, WithHeadings
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
                'employee' => $item->employee->full_name,
                'name' => $item->name,
                'date_debut' => $item->date_debut,
                'date_fin' => $item->date_fin,
                'status' => ($item->status == 1 ? 'start' : ($item->status == 2 ? 'on work' : 'completed')),
                'link' => $item->link,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'employee',
            'name',
            'date debut',
            'date fin',
            'status',
            'link',
        ];
    }
}
