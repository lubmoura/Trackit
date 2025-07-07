<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Trackit') }}</title>

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #63b1c5; 
                overflow-x: hidden; 
            }
            html, body {
                height: 100%; 
            }

            .full-background-zelda {
                background-image: url('https://images7.alphacoders.com/125/thumb-1920-1251235.jpg');
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat; 
                min-height: 100vh; 
                display: flex; 
                flex-direction: column; 
                justify-content: center; 
                align-items: center; 
                padding: 1rem; 
                box-sizing: border-box; 
                position: relative; 
            }

            .full-background-zelda::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.4); 
                z-index: 0; 
            }

            .form-card-bootstrap-transparent {
                background-color: rgba(0, 0, 0, 0.6); 
                backdrop-filter: blur(5px); 
                border-radius: 0.75rem; 
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2); 
                padding: 2.5rem; 
                width: 100%; 
                max-width: 450px; 
                color: white; 
                position: relative; 
                z-index: 1; 
            }

            .form-card-bootstrap-transparent .form-label {
                color: #e0e0e0; 
            }
            .form-card-bootstrap-transparent .form-control {
                background-color: rgba(255, 255, 255, 0.1); 
                border: 1px solid rgba(255, 255, 255, 0.3); 
                color: white; 
            }
            .form-card-bootstrap-transparent .form-control::placeholder {
                color: rgba(255, 255, 255, 0.6); 
            }
            .form-card-bootstrap-transparent .form-control:focus {
                background-color: rgba(255, 255, 255, 0.15);
                border-color: #85d7e5; 
                box-shadow: 0 0 0 0.25rem rgba(102, 187, 106, 0.25); 
            }
            .form-card-bootstrap-transparent .text-danger {
                color: #ff8a80 !important; 
            }
            .form-card-bootstrap-transparent .btn-danger {
                background-color: #82d8df; 
                border-color: #80c8da;
            }
            .form-card-bootstrap-transparent .btn-danger:hover {
                background-color: #80c8da;
                border-color: #80c8da;
            }
            .form-card-bootstrap-transparent a {
                color: #80c8da; !important; 
            }
            .form-card-bootstrap-transparent a:hover {
                color: #80c8da; !important;
            }
            .form-card-bootstrap-transparent .form-check-label {
                color: #80c8da;
            }
        </style>
    </head>
    <body>
        <div class="full-background-zelda">
            <div style="z-index: 1;"> 
            </div>

            <div class="form-card-bootstrap-transparent">
                {{ $slot }}
            </div>
        </div>
        
@stack('scripts')

    </body>
</html>