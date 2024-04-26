<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>@yield('title') - Mi Tienda NIKKEN</title>
        @stack('SEO')

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#00aba9">
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
        <meta name="msapplication-TileColor" content="#00aba9">
        <meta name="msapplication-config" content="{{ asset('assets/img/favicon/browserconfig.xml') }}">
        <meta name="theme-color" content="#ffffff">

        @stack('styles')
    </head>

    <body>
        <div class="bg-white position-fixed top-0 end-0 bottom-0 start-0" id="preloader">
            <div class="bg-white position-fixed top-50 start-50 translate-middle">
                <img src="{{ asset('assets/img/general/loading.gif') }}" alt="Mi Tienda NIKKEN">
            </div>
        </div>

        @yield('content')

        @vite([ 'resources/js/app.js' ])
        @stack('scripts')

        <x-general.tools.toast />
    </body>
</html>
