<!DOCTYPE html>
<!-- Login -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    .logo-color{
        color: darkslateblue;
    }

    .logo-font{
        font-weight: 900;
        font-size:larger;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema Laur</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-fileicon-saltstack class="w-20 h-20 fill-current" color="darkred"/>
            </a>
            <h2 align="center" class="mt-6 text-x1 leading-tight logo-font">LAUR</h2>
        </div>
        <p align="center" class="text-gray-400">Controle de estoque e vendas</p>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
            @if(Route::currentRouteName() == 'login')
            <div align="left">
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Cadastrar-se</a>
            </div>
            @else
               
            @endif

        </div>
    </div>
</body>

</html>