<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Page Title  -->
    <title>@yield('title')</title>
    <!-- StyleSheets  -->
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/dashlite.css') }}">

      <style>

        .dataTables_filter{
            padding-bottom:20px;
            float: right;

        }
        .dataTables_paginate ul {
            float: right;
        }
    </style>



</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('partials.sidebar')
            <div class="nk-wrap ">
                @include('partials.header')
                <div class="nk-content ">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm">

    </div>




    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>


</body>

</html>
