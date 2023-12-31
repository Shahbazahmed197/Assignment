<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->

        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
            <link id="skin-default" rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/dashlite.css') }}">
<style>
    .user-avatar img:first-child {
        height: 100%;
        width:100%;
        object-fit: fill;
    }
</style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col pt-4 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            @include('partials.header')
            @yield('content')
        </div>
        <script src="{{ asset('js/theme.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        @if(isset($errors))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                NioApp.Toast('{{ $errors->first() }}', 'error');
            });
        </script>
        @endif
        @if(session('status'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var successMessage = @json(session('status'));
                    NioApp.Toast(successMessage, 'success');
                });
            </script>
            @endif
    </body>
</html>
