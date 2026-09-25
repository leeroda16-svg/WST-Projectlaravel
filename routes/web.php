<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');
Route::resource('tasks', TaskController::class);
Route::post('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status');
