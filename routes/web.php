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

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth.403', 'role:student|teacher|admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('layouts.layoutadmin');
    })->name('admin.home');

    Route::controller(ProjectController::class)
        ->prefix('projects')
        ->name('projects.')
        ->group(function () {
            Route::get('/', 'index')->name('index')->middleware('permission:index project');
            Route::get('/create', 'create')->name('create')->middleware('permission:create project');
            Route::post('/', 'store')->name('store')->middleware('permission:create project');
            Route::get('/{project}', 'show')->name('show')->middleware('permission:show project');
            Route::get('/{project}/edit', 'edit')->name('edit')->middleware('permission:edit project');
            Route::match(['put', 'patch'], '/{project}', 'update')->name('update')->middleware('permission:edit project');
            Route::get('/{project}/delete', 'delete')->name('delete')->middleware('permission:delete project');
            Route::delete('/{project}', 'destroy')->name('destroy')->middleware('permission:delete project');
        });
});

// Tasks routes are publicly accessible per Opdracht 19
Route::prefix('admin')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/tasks/{task}/delete', [TaskController::class, 'delete'])
        ->name('tasks.delete');
});

Route::get('/projects', [OpenProjectController::class, 'index'])
    ->name('open.projects.index');

require __DIR__ . '/auth.php';
