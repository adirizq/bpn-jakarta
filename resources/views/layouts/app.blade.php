<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Inventarisasi Arsip BPN Kanwil Jakarta</title>
        <!-- Favicon -->
        <link href="{{ asset('img/logo-polos.png') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- Data Tables -->
        <link rel="stylesheet" type="text/css" href="{{ asset('argon/vendor/data-tables/datatables.min.css') }}"/>

        <style>
            .form-control {
                color: black;
                font-style: bold;
            }

            .form-control:focus {
                color: black;
                font-style: bold;
            }

            td {
                border-top: 0 !important;
                font-size: 1rem !important;
            }

            .ts-12 {
                font-size: 12px;
            }

            .text-sk-num {
                font-size: 16px; 
                color:black;
            }

            #dataTable_processing {
                border: 0 !important;
                background-color: transparent !important;
            }

            #dataTable_filter label {
                width: 100%;
            }

            #dataTable_filter label input {
                width: 100%;
                margin: 0;
                height: calc(2.75rem + 2px) !important;
                padding: .625rem .75rem !important;
                font-size: 1rem !important;
                border-radius: .375rem !important;
                margin-bottom: 1rem;
                background-color: white !important;
                box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%) !important;
                border: 1px solid rgba(0, 0, 0, .05) !important;
            }

            #dataTable_wrapper .row .col-sm-12 {
                padding: 0 !important;
            }

            .wrap-text {
                max-width: calc(100vw - 6rem - 30px);
                white-space: nowrap !important; 
                overflow: hidden !important; 
                text-overflow: ellipsis !important;
            }

            .floating-btn {
                width: 50px;
                height: 50px;
                background: #5e72e4;
                display: flex;
                border-radius: 50%;
                font-size: 35px;
                align-items: center;
                justify-content: center;
                color: white;
                box-shadow: 0px 5px 2rem rgba(0, 0, 0, 0.25) !important;
                position: fixed;
                right: 0;
                bottom: 0;
                margin: 20px;
            }

            .floating-btn:active{
                background: #324cdd;
            }
        </style>

    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @auth()
                @include('layouts.navbars.navbar')
            @endauth
            
            @yield('content')
        </div>

        <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>