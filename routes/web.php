<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;


// Main Todo List Interface
Route::redirect('/', '/login');  // Redirect root to todos index

// Todo Resource Routes
Route::resource('todos', TodoController::class)->parameters([
    'todos' => 'todo'  // Explicit route model binding
]);

// Toggle Completion Status
Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggleComplete'])
    ->name('todos.toggle');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
