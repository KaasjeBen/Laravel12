<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure activities exist so tasks can be attached
        if (Activity::count() === 0) {
            $this->call(ActivitySeeder::class);
        }

        // Create at least 5 projects
        $projects = Project::factory()->count(5)->create();

        $activities = Activity::pluck('id')->all();

        // Each project gets 2-3 tasks
        foreach ($projects as $project) {
            Task::factory()
                ->count(rand(2, 3))
                ->create([
                    'project_id' => $project->id,
                    'activity_id' => Arr::random($activities),
                ]);
        }
    }
}
