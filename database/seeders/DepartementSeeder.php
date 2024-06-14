<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $departments = [
            'Human Resources',
            'Finance',
            'Marketing',
            'Informatique',
            'Operations',
        ];

        // Create departments
        foreach ($departments as $department) {
            Departement::create(['name' => $department]);
        }
    }
}
