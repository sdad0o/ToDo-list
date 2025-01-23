<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();
        $editing = request()->has('edit') ? request()->edit : null;
        return view('index', compact('todos', 'editing'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            // Remove 'is_completed' since new tasks shouldn't be completed by default
        ]);

        Todo::create($validated);
        return redirect()->route('todos.index')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'task' => 'required|string|max:255'
        ]);

        $todo->update($validated);
        return redirect()->route('index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return back()->with('success', 'Task deleted successfully!');
    }

    public function toggleComplete(Todo $todo)
    {
        $todo->update(['is_completed' => !$todo->is_completed]);
        return back()->with('success', 'Status updated!');
    }
}
