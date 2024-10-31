<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','ЦПУСВО.рф')</title>
    @stack('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
