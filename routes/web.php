<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Main Todo List Interface
Route::redirect('/', '/todos');  // Redirect root to todos index

// Todo Resource Routes
Route::resource('todos', TodoController::class)->parameters([
    'todos' => 'todo'  // Explicit route model binding
]);

// Toggle Completion Status
Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggleComplete'])
    ->name('todos.toggle');
