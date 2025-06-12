<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DATA SEKOLAH') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>

    <body class="bg-gradient-to-br from-blue-50 to-indigo-100 font-sans antialiased">
        <livewire:toasts />

        <div class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>

        @livewireScripts
        @livewireScriptConfig

    </body>

</html>
