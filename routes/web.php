<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect root URL straight to the task list
Route::redirect('/', '/tasks');

// Full CRUD (index, create, store, edit, update, destroy) for tasks
Route::resource('tasks', TaskController::class);

// Extra route: quick one-click status toggle (Pending <-> Completed)
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');
