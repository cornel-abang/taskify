@extends('layouts.app')

@section('title', 'Taskify - Register')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endsection

@section('content')
    <div class="register-container">
        <h1>Nice to see you here..</h1>
        <div class="intro">
            <p>Welcome to Taskify, your personal task manager.</p>
            <p>Register to start organizing your tasks with ease.</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <small class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <small class="invalid-feedback" role="alert">
                        {{ $errors->first('email') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @if ($errors->has('password'))
                    <small class="invalid-feedback" role="alert">
                        {{ $errors->first('password') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="actions">
                <button type="submit" class="btn">Register</button>
            </div>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
@endsection
