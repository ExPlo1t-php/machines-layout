<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="/assets/images/Logo-white.png" type="image/x-icon">
        <title>@yield('title', 'Layout | Unknown')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/assets/fontawesome/css/all.css">

        <!-- Custom style -->
        <link rel="stylesheet" href="/css/tips.css">
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
        <link rel="stylesheet" href="/css/draggable.css">
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
        {{-- <script src="../path/to/flowbite/dist/flowbite.js"></script> --}}
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
        {{-- 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
        <script src="../path/to/flowbite/dist/flowbite.js"></script>
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/delete.js"></script>
        <script src="/js/hideStuff.js"></script> --}}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <!-- Scripts -->
        <script src="/js/delete.js"></script>
        <script src="/js/hideStuff.js"></script>
        {{-- Sortable JS --}}
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script src="/js/draggable.js"></script>
    </body>
</html>
