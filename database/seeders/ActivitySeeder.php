<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Todo', 'Doing', 'Testing', 'Verify', 'Done'];
        foreach ($names as $name) {
            Activity::firstOrCreate(['name' => $name]);
        }
    }
}
