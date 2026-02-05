<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            ['id' => 1, 'name' => 'Todo'],
            ['id' => 2, 'name' => 'Doing'],
            ['id' => 3, 'name' => 'Testing'],
            ['id' => 4, 'name' => 'Verify'],
            ['id' => 5, 'name' => 'Done'],
        ];

        foreach ($records as $record) {
            Activity::updateOrCreate(['id' => $record['id']], ['name' => $record['name']]);
        }
    }
}
