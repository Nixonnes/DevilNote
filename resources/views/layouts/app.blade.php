<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col dark:bg-amber-600">


            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow dark:bg-amber-600">
                    <div class="max-w-8xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <div class="flex flex-row">



                <div class=" p-2 w-56 min-h-dvh bg-amber-500 border-r border-black rounded dark:bg-black dark:text-white">
                    <div class="p-3 mt-48 font-semibold text-lg">
                        <div class="flex justify-center p-4 w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                            <a href="{{route('notes.create')}}">Новая заметка</a>
                        </div>
                        <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                            <a href="{{route('user.notes', ['user_id' => Auth::id()])}}">Мои заметки</a>
                        </div>
                        <div class="flex justify-center w-full p-4 hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                            <a href="#">Сообщества</a>
                        </div>
                        <div class="flex justify-center p-4  w-full hover:bg-amber-900 rounded-lg  active:bg-gray-500">
                            <a href="{{route('categories.index')}}">Категории</a>
                        </div>

                    </div>

                </div>

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>
        </div>
    </body>
</html>
