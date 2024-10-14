<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('Catharsis Empire', 'Catharsis Empire') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-black text-white">
        <div class="min-h-screen flex flex-col">
            <!-- Navbar -->
            @include('components.navbar')
            
            <!-- Main Content -->
            <div class="flex flex-1">
                <!-- Sidebar -->
                @include('components.sidebar')

                <!-- Content Area -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-black">
                    <!-- Container for dashboard content -->
                    <div class="container mx-auto px-6 py-8">
                        <!-- Section for dashboard content -->
                        @yield('content')
                    </div>
                </main>
            </div>

            <!-- Footer -->
            @include('components.footer')
        </div>
    </body>
</html>
