<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    public function run(): void
    {
        $labels = ['front-end', 'backend', 'documentation', 'bug', 'feature'];

        foreach ($labels as $label) {
            Label::firstOrCreate(['name' => $label]);
        }
    }
}
