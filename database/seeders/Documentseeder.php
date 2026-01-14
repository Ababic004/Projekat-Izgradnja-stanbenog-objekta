<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\Project;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();

        if (!$project) {
            return;
        }

        Document::create([
            'project_id' => $project->id,
            'title' => 'Građevinska dozvola',
            'type' => 'dozvola',
            'issued_at' => now()->subMonths(3),
        ]);

        Document::create([
            'project_id' => $project->id,
            'title' => 'Tehnička dokumentacija',
            'type' => 'tehnicka',
            'issued_at' => now()->subMonth(),
        ]);
    }
}
