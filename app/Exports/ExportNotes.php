<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportNotes implements FromCollection,WithHeadings
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
                'date' => $item->date,
                'note' => $item->description
            ];
        });
    }

    public function headings(): array
    {
        return [
            'note',
            'date',
        ];
    }
}
