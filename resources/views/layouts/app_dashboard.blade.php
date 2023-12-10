<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-32x32.png') }}"
        sizes="32x32">
    <link rel="icon" href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-192x192.png') }}"
        sizes="192x192">
    <link rel="apple-touch-icon"
        href="href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-180x180.png') }}">
    <meta name="msapplication-TileImage"
        content="href="{{ asset('images/icons/cropped-Municipalidad-de-Recoleta-iconpaok-270x270.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>{{ __('panel.site_title') }}</title>
</head>

<body class="text-blueGray-700 bg-blueGray-800 antialiased">
    <main>
        @yield('content')
    </main>
</body>

</html>
