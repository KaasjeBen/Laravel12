<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Project> */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $name = Str::limit($this->faker->unique()->sentence(3), 45, '');
        if (strlen($name) < 5) {
            $name = $name . str_repeat('x', 5 - strlen($name));
        }

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
        ];
    }

    public function create($attributes = [], ?\Illuminate\Database\Eloquent\Model $parent = null)
    {
        return Project::unguarded(fn() => parent::create($attributes, $parent));
    }
}
