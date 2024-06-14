@extends('layouts.app')

@section('title', 'Taskify - Home')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endsection

@section('content')

        @if (session('success'))
            <div class="flash-message flash-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flash-message flash-error">
                {{ session('error') }}
            </div>
        @endif
        <header>
            <h1>Task Management</h1>
            <div class="actions">
                <a href="{{ route('tasks.create') }}" class="btn create-btn">Create Task</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <main>
            <div class="intro">
                <h2>Welcome to Taskify</h2>
                <p>Stay organized with our task management system. Here are your current tasks:</p>
            </div>

            <div class="system-stats">
                <h3>System Stats</h3>
                <div class="status-count">
                    <p>Total Tasks: {{ $tasks->count() }}</p>
                    <p>Completed Tasks: {{ $tasks->where('status', \App\Enums\TaskStatusEnum::COMPLETED)->count() }}</p>
                    <p>Pending Tasks: {{ $tasks->where('status', \App\Enums\TaskStatusEnum::PENDING)->count() }}</p>
                </div>
            </div>

            <div class="filter-section">
                <label for="filter_status" class="filter-label">Filter by Status:</label>
                <select name="filter_status" id="filter_status" class="filter-select" onchange="applyFilter(this.value)">
                    <option value="all" {{ $selectedStatus == 'all' ? 'selected' : '' }}>All</option>
                    <option value="{{ \App\Enums\TaskStatusEnum::COMPLETED }}" {{ $selectedStatus == \App\Enums\TaskStatusEnum::COMPLETED->value ? 'selected' : '' }}>Completed</option>
                    <option value="{{ \App\Enums\TaskStatusEnum::PENDING }}" {{ $selectedStatus == \App\Enums\TaskStatusEnum::PENDING->value ? 'selected' : '' }}>Pending</option>
                </select>
            </div><br/><br/>

            @if ($tasks->isEmpty())
                <div class="empty-state">
                    <h2>No tasks found</h2>
                    <p>You don't have any tasks at the moment. <a href="{{ route('tasks.create') }}">Create one now</a>.</p>
                </div>
            @else
                <div class="task-list">
                    @foreach ($tasks as $task)
                    <div class="task">
                        <h2>{{ $task->title }}</h2>
                        <p>{{ $task->description }}</p>
                        <span class="status {{ $task->status->value }}">
                            <i class="icon fas {{ $task->status->labelIcon() }}"></i> {{ ucfirst($task->status->label()) }}
                        </span>
                        <div class="task-actions">
                            <a href="{{ route('tasks.single', $task->id) }}" class="btn view-btn">View</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn edit-btn">Edit</a>
                            <a href="#" class="btn delete-btn" data-task-id="{{$task->id}}">Delete</a>
                            @if ($task->status->value == \App\Enums\TaskStatusEnum::COMPLETED->value)
                                <a href="{{ route('tasks.uncomplete', $task->id) }}" class="btn completed-btn">Mark as Pending</a>
                            @else
                                <a href="{{ route('tasks.complete', $task->id) }}" class="btn pending-btn">Mark as Complete</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $tasks->links() }}
                </div>
            @endif
        </main>
@endsection
