<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\{Task, User, Project, Activity};
use Illuminate\Support\Facades\View;

echo "Starting count: " . Task::count() . PHP_EOL;

$task = Task::factory()->create([
    'enddate' => null,
    'user_id' => User::first()->id,
    'project_id' => Project::first()->id,
    'activity_id' => Activity::first()->id,
]);

$taskWithEnddate = Task::factory()->create([
    'enddate' => '2025-12-31',
    'user_id' => User::first()->id,
    'project_id' => Project::first()->id,
    'activity_id' => Activity::first()->id,
]);

echo "New tasks ids: {$task->id}, {$taskWithEnddate->id}" . PHP_EOL;

$totalTasks = Task::count();
$tasksPerPage = 15;
$lastPage = (int) ceil($totalTasks / $tasksPerPage);

$tasks = Task::with(['user', 'project', 'activity', 'labels'])
    ->orderBy('id')
    ->paginate($tasksPerPage, ['*'], 'page', $lastPage);

$html = View::make('admin.tasks.index', ['tasks' => $tasks])->render();

$pattern = '/<tr[^>]*>.*?' . preg_quote((string) $task->id, '/') . '.*?<\/tr>/s';
if (preg_match($pattern, $html, $matches)) {
    $row = $matches[0];
    $dateCount = preg_match_all('/\d{4}-\d{2}-\d{2}/', $row);
    echo "DateCount={$dateCount}" . PHP_EOL;
    echo $row . PHP_EOL;
} else {
    echo "Row not found" . PHP_EOL;
}
