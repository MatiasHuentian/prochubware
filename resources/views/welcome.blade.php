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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body class="antialiased ">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-awesome-purple selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Panel de control</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Iniciar
                        sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrar</a>
                    @endif
                @endauth
            </div>
        @endif


        <div class="max-w-7xl mx-auto p-4 lg:p-8">
            <div class="pb-12 pt-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                            <h1 class="mt-1 text-xxl font-medium text-gray-900">
                                Bienvenido a PROCHUBWARE
                            </h1>

                            <p class="mt-6 text-gray-500 leading-relaxed">
                                Bienvenido a PROCHUBWARE, la solución innovadora que te ayuda a optimizar la gestión de
                                procesos en tu empresa. PROCHUBWARE es más que un sistema web, es una oportunidad para
                                alcanzar nuevos niveles de eficiencia, transparencia y mejora continua. <br>

                            </p>
                        </div>

                        <div
                            class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            <div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 5v14m0 0l-5-5m5 5l5-5M18 10H6a3 3 0 010-6h12a3 3 0 010 6z" />
                                    </svg>
                                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                        Simplificando la Gestión Empresarial con Agilidad y Eficiencia
                                    </h2>
                                </div>

                                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                    Descubre un entorno donde la administración empresarial se vuelve más sencilla,
                                    donde la información se organiza de forma eficaz, y donde cada usuario puede acceder
                                    a los procesos que realmente le interesa. PROCHUBWARE es más que un software, es la
                                    herramienta que te permite documentar y mejorar los procesos de forma ágil y
                                    flexible.
                                </p>
                            </div>

                            <div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                    </svg>

                                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                        Potencia Tu Gestión con una Interfaz Intuitiva y Personalizada
                                    </h2>
                                </div>

                                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                    Con una interfaz amigable y funcionalidades avanzadas, PROCHUBWARE te permite
                                    almacenar, gestionar y mejorar los procesos de forma dinámica. Desde el jefe de
                                    Gestión de Calidad hasta los diferentes departamentos, cada usuario tiene un acceso
                                    personalizado, garantizando que la información se comparta de forma precisa y
                                    segura.
                                </p>

                            </div>

                            <div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                    </svg>

                                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                        Navegando Hacia la Administración Inteligente y Proactiva
                                    </h2>
                                </div>

                                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                    Explora una plataforma pensada para la mejora continua, donde cada cambio queda
                                    registrado, cada paso es evaluado, y cada decisión se fundamenta con datos.
                                    PROCHUBWARE es más que una solución, es el camino hacia una administración más
                                    inteligente y proactiva.
                                </p>
                            </div>

                            <div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 5v14m0 0l-5-5m5 5l5-5M18 10H6a3 3 0 010-6h12a3 3 0 010 6z" />
                                    </svg>

                                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                        Uniendo Eficiencia e Innovación para el Futuro de Recoleta
                                    </h2>
                                </div>

                                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                    Acompáñanos en este viaje, donde la eficiencia y la innovación se unen para impulsar
                                    el futuro de las entidades públicas. PROCHUBWARE: Transformando la Gestión,
                                    Empoderando el Futuro
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
