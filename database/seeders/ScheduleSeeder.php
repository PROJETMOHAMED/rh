<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daysData = [
            ['day' => 'Lundi', 'from' => '09:00:00', 'to' => '18:00:00', 'step' => 30, 'stop_from' => '13:00:00', 'stop_to' => '14:00:00'],
            ['day' => 'Mardi', 'from' => '09:00:00', 'to' => '18:00:00', 'step' => 30, 'stop_from' => '13:00:00', 'stop_to' => '14:00:00'],
            ['day' => 'Mercredi', 'from' => '09:00:00', 'to' => '18:00:00', 'step' => 30, 'stop_from' => '13:00:00', 'stop_to' => '14:00:00'],
            ['day' => 'Jeudi', 'from' => '09:00:00', 'to' => '18:00:00', 'step' => 30, 'stop_from' => '13:00:00', 'stop_to' => '14:00:00'],
            ['day' => 'Vendredi', 'from' => '09:00:00', 'to' => '18:00:00', 'step' => 30, 'stop_from' => '13:00:00', 'stop_to' => '14:00:00'],
            ['day' => 'Samedi', 'from' => '09:00:00', 'to' => '13:00:00', 'step' => 30, 'stop_from' => '13:00:00', 'stop_to' => '13:00:00'],
        ];

        // Insert data into the database
        foreach ($daysData as $dayData) {
            Schedule::create([
                'day' => $dayData['day'],
                'from' => $dayData['from'],
                'to' => $dayData['to'],
                'stop_from' => $dayData['stop_from'],
                'stop_to' => $dayData['stop_to'],
            ]);
        }
    }
}
