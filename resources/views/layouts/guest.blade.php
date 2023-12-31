<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="../../../">
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
        <!-- Page Title  -->
        <title>@yield('title') | DashLite Admin Template</title>
        <link rel="shortcut icon" href="./images/favicon.png">
        <!-- StyleSheets  -->
        <link id="skin-default" rel="stylesheet" href="{{ asset('css/theme.css') }}">
        <link id="skin-default" rel="stylesheet" href="{{ asset('css/dashlite.css') }}">
    </head>
    <body class="nk-body bg-white npc-general pg-auth">
        @yield('content')
        <script src="{{ asset('js/bundle.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
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
</html>
