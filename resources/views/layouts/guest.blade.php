<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-32x32.png') }}"
        sizes="32x32">
    <link rel="icon" href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-192x192.png') }}"
        sizes="192x192">
    <link rel="apple-touch-icon"
        href="href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-180x180.png') }}">
    <meta name="msapplication-TileImage"
        content="href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-270x270.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>

</html>
