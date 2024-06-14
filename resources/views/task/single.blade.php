@extends('layouts.app')

@section('title', 'Taskify - Task details')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/single.css') }}">
@endsection

@section('content')
        <header>
            <h1>Task Details</h1>
            <a href="{{ route('tasks.index') }}" class="btn back-btn">Back to Tasks</a>
        </header>

        <main>
            <div class="task-details">
                <h2>{{ $task->title }}</h2>
                <p>{{ $task->description }}</p>
                <div class="status-tag {{ $task->status->value }}">
                    <i class="icon fas {{ $task->status->labelIcon() }}"></i>
                    {{ ucfirst($task->status->label()) }}
                </div>

                <div class="user-details">
                    <h3>Assigned User</h3>
                    <p><strong>Name:</strong> {{ $task->user->name }}</p>
                    <p><strong>Email:</strong> {{ $task->user->email }}</p>
                </div>

                <div class="last-updated">
                    <p>Last updated: {{ $task->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </main>
@endsection
