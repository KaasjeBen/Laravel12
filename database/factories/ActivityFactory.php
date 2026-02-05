<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Activity> */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $name = Str::limit($this->faker->unique()->word(), 25, '');
        if (strlen($name) < 3) {
            $name .= 'task';
        }

        return [
            'name' => $name,
        ];
    }

    public function create($attributes = [], ?\Illuminate\Database\Eloquent\Model $parent = null)
    {
        return Activity::unguarded(fn() => parent::create($attributes, $parent));
    }
}
