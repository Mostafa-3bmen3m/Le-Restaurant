<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="h-full font-sans antialiased text-gray-100 bg-gray-900" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-40 lg:hidden" aria-hidden="true"
        @click="sidebarOpen = false"></div>

    <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-gray-800 px-6 pb-4 overflow-y-auto lg:hidden border-r border-gray-700">
        <div class="flex h-16 shrink-0 items-center">
            <span
                class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">RestaurantAdmin</span>
        </div>
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        @include('layouts.admin-navigation-links')
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-800 border-r border-gray-700 px-6 pb-4">
            <div class="flex h-16 shrink-0 items-center">
                <span
                    class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">RestaurantAdmin</span>
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            @include('layouts.admin-navigation-links')
                        </ul>
                    </li>
                    <li class="mt-auto">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-300 hover:bg-gray-700 hover:text-purple-400 w-full text-left transition-all duration-200">
                                <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-purple-400" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Log out
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="lg:pl-72">
        <div
            class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-700 bg-gray-800 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" class="-m-2.5 p-2.5 text-gray-300 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <div class="flex flex-1"></div>
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <span class="text-sm font-semibold leading-6 text-gray-100">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <main class="py-10 bg-gray-900 min-h-screen">
            <div class="px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>