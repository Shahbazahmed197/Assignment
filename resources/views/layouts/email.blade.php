<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- StyleSheets  -->
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-email.css')}}">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">

@yield('content')
    <script src="{{ asset('js/bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
