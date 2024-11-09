<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','ЦПУСВО.рф')</title>
    @stack('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/svo/css.css"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/svo/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/svo/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/svo/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/svo/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/svo/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/svo/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/svo/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/svo/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/svo/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/svo/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/svo/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/svo/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/svo/favicon/favicon-16x16.png">
    <link rel="manifest" href="/svo/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ff5555">
    <meta name="msapplication-TileImage" content="/svo/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ff5555">

</head>
<body>

@include('layouts/header')

<main class="min-h-[75vh]">
    @yield('content')
    {{ $slot }}
</main>

@include('layouts/footer')

@livewireScripts
@stack('scripts')
</body>
</html>
