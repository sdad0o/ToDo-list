@extends('layouts.app')
@section('content')
<div class="layout">
    <div class="container-todo">
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <h3 for="new-task">Add Item</h3>
            <input id="new-task" name="task" type="text" required>
            <button type="submit">Add</button>
            @error('task')
                <div class="error">{{ $message }}</div>
            @enderror
        </form>
        {{-- ------------------- incomplete -------------------------------- --}}
        <h3>Todo</h3>
        <ul id="incomplete-tasks">
            @foreach ($todos->where('is_completed', false) as $todo)
                <li>
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="toggle-form">
                        @csrf @method('PATCH')
                        {{-- <input type="checkbox" onchange="this.form.submit()"> --}}
                        <div class="checkbox-wrapper-31">
                            <input onchange="this.form.submit()" type="checkbox">
                            <svg viewBox="0 0 35.6 35.6">
                                <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                            </svg>
                        </div>
                    </form>

                    <span class="task-text">{{ $todo->task }}</span>

                    <a href="#" class="show-modal" data-id="{{ $todo->id }}"
                        data-task="{{ $todo->task }}">Edit</a>

                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        {{-- <button type="submit">Delete</button> --}}
                        <button type="submit" class="bin-button">
                            <svg class="bin-top" viewBox="0 0 39 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line y1="5" x2="39" y2="5" stroke="white" stroke-width="4">
                                </line>
                                <line x1="12" y1="1.5" x2="26.0357" y2="1.5" stroke="white"
                                    stroke-width="3"></line>
                            </svg>
                            <svg class="bin-bottom" viewBox="0 0 33 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_8_19" fill="white">
                                    <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                    </path>
                                </mask>
                                <path
                                    d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"
                                    fill="white" mask="url(#path-1-inside-1_8_19)"></path>
                                <path d="M12 6L12 29" stroke="white" stroke-width="4"></path>
                                <path d="M21 6V29" stroke="white" stroke-width="4"></path>
                            </svg>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
        {{-- ------------------------------------------------ --}}
        <h3>Completed</h3>
        <ul id="completed-tasks">
            @foreach ($todos->where('is_completed', true) as $todo)
                <li class="completed">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" style="display: inline;">
                        @csrf @method('PATCH')
                        {{-- <input type="checkbox" checked onchange="this.form.submit()"> --}}
                        <div class="checkbox-wrapper-31">
                            <input checked type="checkbox"onchange="this.form.submit()">
                            <svg viewBox="0 0 35.6 35.6">
                                <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                            </svg>
                        </div>
                    </form>

                    {{ $todo->task }}

                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display: inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="bin-button">
                            <svg class="bin-top" viewBox="0 0 39 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line y1="5" x2="39" y2="5" stroke="white" stroke-width="4">
                                </line>
                                <line x1="12" y1="1.5" x2="26.0357" y2="1.5" stroke="white"
                                    stroke-width="3"></line>
                            </svg>
                            <svg class="bin-bottom" viewBox="0 0 33 39" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_8_19" fill="white">
                                    <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                    </path>
                                </mask>
                                <path
                                    d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"
                                    fill="white" mask="url(#path-1-inside-1_8_19)"></path>
                                <path d="M12 6L12 29" stroke="white" stroke-width="4"></path>
                                <path d="M21 6V29" stroke="white" stroke-width="4"></path>
                            </svg>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

    <div class="modal hidden">
        <button class="close-modal">&times;</button>
        <h1>Edit the task 💪🏽</h1>
        <form id="edit-task-form" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" id="task-id">
            <input type="text" name="task" id="task-input" required>
            <button type="submit">Update</button>
        </form>
    </div>
    <div class="overlay hidden"></div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
@endsection
