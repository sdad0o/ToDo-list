<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ToDoo</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <form action="{{ route('todos.store') }}" method="POST">
      @csrf
      <label for="new-task">Add Item</label>
      <input id="new-task" name="task" type="text" required>
      <button type="submit">Add</button>
      @error('task')
      <div class="error">{{ $message }}</div>
    @enderror
    </form>

    <h3>Todo</h3>
    <ul id="incomplete-tasks">
      @foreach($todos->where('is_completed', false) as $todo)
      <li>
      <form action="{{ route('todos.toggle', $todo) }}" method="POST" style="display: inline;">
        @csrf @method('PATCH')
        <input type="checkbox" onchange="this.form.submit()">
      </form>

      @if($editing === $todo->id)
      <form class="edit-form" action="{{ route('todos.update', $todo) }}" method="POST">
      @csrf @method('PATCH')
      <input type="text" name="task" value="{{ old('task', $todo->task) }}">
      <button type="submit">Save</button>
      <a href="{{ route('todos.index') }}">Cancel</a>
      </form>
    @else
      {{ $todo->task }}
      <a href="{{ route('todos.index', ['edit' => $todo->id]) }}">Edit</a>
    @endif

      <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display: inline;">
        @csrf @method('DELETE')
        <button type="submit">Delete</button>
      </form>
      </li>
    @endforeach
    </ul>

    <h3>Completed</h3>
    <ul id="completed-tasks">
      @foreach($todos->where('is_completed', true) as $todo)
      <li class="completed">
      <form action="{{ route('todos.toggle', $todo) }}" method="POST" style="display: inline;">
        @csrf @method('PATCH')
        <input type="checkbox" checked onchange="this.form.submit()">
      </form>

      {{ $todo->task }}

      <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display: inline;">
        @csrf @method('DELETE')
        <button type="submit">Delete</button>
      </form>
      </li>
    @endforeach
    </ul>
  </div>
</body>

</html>