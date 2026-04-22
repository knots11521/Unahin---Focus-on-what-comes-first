<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Unahin') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="app-shell bg-white dark:bg-[#0d1117] text-slate-900 dark:text-slate-100 font-sans antialiased overflow-x-hidden transition-colors duration-300 flex flex-col min-h-screen">
    <x-about-page />
</body>

</html>
