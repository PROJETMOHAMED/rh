<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records to start fresh
        // Type::truncate();

        // Define your categories with parent-child relationships
        $types = [
            [
                'name' => 'Stage',
                'children' => [
                    ['name' => 'Stage PFE'],
                    ['name' => 'Stage PFA'],
                    ['name' => 'Stage d\'été'],
                    ['name' => 'Stage professionnel'],
                    ['name' => 'Stage de recherche'],
                    ['name' => 'Stage de perfectionnement'],
                    ['name' => 'Stage ouvrier'],
                ],
            ],
            [
                'name' => 'Employment Contract',
                'children' => [
                    ['name' => 'CDI (Contrat à Durée Indéterminée)'],
                    ['name' => 'CDD (Contrat à Durée Déterminée)'],
                    ['name' => 'Intérim'],
                    ['name' => 'Freelance'],
                    ['name' => 'Apprenticeship Contract'],
                    ['name' => 'Temporary Contract'],
                    ['name' => 'Zero-Hour Contract'],
                ],
            ],
            // Add more categories as needed
        ];


        // Seed the categories table
        foreach ($types as $item) {
            $parentType = Type::create(['name' => $item['name']]);

            foreach ($item['children'] as $child) {
                Type::create([
                    'name' => $child['name'],
                    'parent_id' => $parentType->id,
                ]);
            }
        }
    }
}
