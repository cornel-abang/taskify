@extends('layouts.app')

@section('title', 'Taskify - Edit task')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/edit.css') }}">
@endsection

@section('content')
        <header>
            <h1>Edit Task</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
        </header>

        <main>
            <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                    @if ($errors->has('title'))
                        <small class="invalid-feedback" role="alert">
                            {{ $errors->first('title') }}
                        </small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required>{{ old('description', $task->description) }}</textarea>
                    @if ($errors->has('description'))
                        <small class="invalid-feedback" role="alert">
                            {{ $errors->first('description') }}
                        </small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        @foreach (\App\Enums\TaskStatusEnum::toSelectOptions() as $option => $label)
                            <option value="{{ $option }}" {{ old('status', $task->status->value) == $option ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <small class="invalid-feedback" role="alert">
                            {{ $errors->first('status') }}
                        </small>
                    @endif
                </div>

                <button type="submit" class="btn">Update Task</button>
            </form>
        </main>
@endsection
