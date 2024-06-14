<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Taskify')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    @include('layouts.index-ext')
</body>
</html>
