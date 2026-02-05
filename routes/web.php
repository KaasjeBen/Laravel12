<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Open\ProjectController as OpenProjectController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.layoutpublic');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin', function () {
    return view('layouts.layoutadmin');
})->name('admin.home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::prefix('admin')->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::get('/projects/{project}/delete', [ProjectController::class, 'delete'])
        ->name('projects.delete');

    Route::resource('tasks', TaskController::class);
    Route::get('/tasks/{task}/delete', [TaskController::class, 'delete'])
        ->name('tasks.delete');
});

Route::get('/projects', [OpenProjectController::class, 'index'])
    ->name('open.projects.index');

require __DIR__ . '/auth.php';
