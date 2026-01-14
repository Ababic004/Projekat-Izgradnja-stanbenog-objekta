<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Project::create([
            'name' => 'Stambeni kompleks "Zeleni Bulevar"',
            'location' => 'Novi Beograd',
            'status' => 'aktivno',
            'start_date' => '2024-01-15',
            'end_date' => '2025-12-30',
            'budget_eur' => 3500000,
        ]);

        Project::create([
            'name' => 'Poslovna zgrada "City Center"',
            'location' => 'Centar',
            'status' => 'aktivno',
            'start_date' => '2024-03-01',
            'end_date' => '2025-08-15',
            'budget_eur' => 2800000,
        ]);
    }
}
