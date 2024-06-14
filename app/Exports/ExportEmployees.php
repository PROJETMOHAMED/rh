<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportEmployees implements FromCollection, WithHeadings
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
                'firstname' => $item->firstname,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'date_debut' => $item->date_debut,
                'date_fin' => $item->date_fin,
                'status' => ($item->status == 1) ? "termine" : (($item->status == 2) ? "abondone" : (($item->status == 3) ? "en cours" : "")),
                'piece_identite' => $item->piece_identite,
                'adresse' => $item->adresse,
                'departement_id' => $item->departement->name,
                'type' => $item->ContratType->name
            ];
        });
    }

    public function headings(): array
    {
        return [
            'firstname',
            'last_name',
            'email',
            'phone',
            'date_debut',
            'date_fin',
            'status',
            'piece_identite',
            'adresse',
            'departement_id',
            'type'
        ];
    }
}
