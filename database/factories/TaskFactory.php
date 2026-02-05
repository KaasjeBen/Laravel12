<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends Factory<Task> */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $begindate = Carbon::instance($this->faker->dateTimeBetween('-1 month', '+1 month'));
        $enddate = (clone $begindate)->addDays($this->faker->numberBetween(10, 30));

        return [
            'task' => $this->faker->sentence(12),
            'begindate' => $begindate->toDateString(),
            'enddate' => $enddate->toDateString(),
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'activity_id' => Activity::factory(),
        ];
    }

    public function create($attributes = [], ?\Illuminate\Database\Eloquent\Model $parent = null)
    {
        return Task::unguarded(fn() => parent::create($attributes, $parent));
    }
}
