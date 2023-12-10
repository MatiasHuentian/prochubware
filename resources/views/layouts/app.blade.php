<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-32x32.png') }}" sizes="32x32">
        <link rel="icon" href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-192x192.png') }}" sizes="192x192">
        <link rel="apple-touch-icon" href="href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-180x180.png') }}">
        <meta name="msapplication-TileImage" content="href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-270x270.png') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        {{-- <div class="min-h-screen bg-gray-100"> --}}
        <div class="min-h-screen bg-awesome-purple">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

        @livewireScripts
    </body>
</html>
