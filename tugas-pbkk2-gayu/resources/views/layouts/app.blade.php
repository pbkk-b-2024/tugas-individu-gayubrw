<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.css', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-black text-white">
    <div class="min-h-screen flex flex-col">
        @include('components.navbar')
        <div class="flex flex-1">
            @include('components.sidebar')
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-black">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
        @include('components.footer')
    </div>
</body>
</html>