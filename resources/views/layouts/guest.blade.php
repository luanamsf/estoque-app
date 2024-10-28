<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    <style>
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            /* Espaçamento entre logo e formulário */
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
        <div class="login-container">
            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <img src="/images/Logo_cinza_3.png" alt="Logo Laur" class="h-12 w-auto">
                </div>
                {{ $slot }}
                @if(Route::currentRouteName() == 'login')
                <div align="left" class="mt-4">
                    <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Cadastrar-se
                    </a>
                </div>
                @endif
            </div>
            <!-- Texto centralizado abaixo do login -->
            <div class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                <a href="https://github.com/luanamsf" class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    By LuanaFigueiredo
                </a>
            </div>
        </div>
    </div>
</body>

</html>
