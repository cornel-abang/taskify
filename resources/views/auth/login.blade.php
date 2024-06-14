@extends('layouts.app')

@section('title', 'Taskify - Login')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection

@section('content')
    <div class="login-container">
        <h1>Hello..</h1>
        <div class="intro">
            <p>Welcome to Taskify, your personal task manager.</p>
            <p>Stay organized and <span class="highlight">productive</span> with our simple and intuitive interface.</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
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
                @if ($errors->has('email'))
                    <small class="invalid-feedback" role="alert">
                        {{ $errors->first('email') }}
                    </small>
                @endif
            </div>
            <div class="actions">
                <button type="submit" class="btn">Login</button>
                {{-- <a href="{{ route('password.request') }}">Forgot password?</a> --}}
            </div>
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
@endsection
