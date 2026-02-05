<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        if (Activity::count() === 0) {
            $this->call(ActivitySeeder::class);
        }

        if (Project::count() === 0) {
            $this->call(ProjectSeeder::class);
        }

        if (Label::count() === 0) {
            $this->call(LabelSeeder::class);
        }

        $user = User::first() ?? User::factory()->create();
        $activities = Activity::all();
        $projects = Project::all();
        $labels = Label::all();

        Task::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id,
                'project_id' => $projects->random()->id,
                'activity_id' => $activities->random()->id,
            ])
            ->each(function (Task $task) use ($labels) {
                $task->labels()->sync($labels->random(rand(1, min(3, $labels->count()))));
            });
    }
}
