<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\Task;

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\\Contracts\\Console\\Kernel')->bootstrap();

Artisan::call('migrate:fresh');
Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
Artisan::call('db:seed', ['--class' => 'UserSeeder']);
Artisan::call('db:seed', ['--class' => 'ActivitySeeder']);
Artisan::call('db:seed', ['--class' => 'ProjectSeeder']);
Artisan::call('db:seed', ['--class' => 'TaskSeeder']);

echo 'max=' . Task::max('id') . PHP_EOL;
