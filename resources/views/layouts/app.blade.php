<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DASEK') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </head>

    <body class="bg-gray-100">
        <livewire:toasts />

        <div class="flex h-screen" x-data="{ sidebarOpen: false }">
            <div x-show="sidebarOpen" x-cloak x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden"
                @click="sidebarOpen = false">
            </div>

            <div class="fixed left-0 top-0 z-40 h-screen w-64 transform bg-gray-800 p-4 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0"
                :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }" x-cloak>

                <div class="mb-8 flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="mr-2 h-6 w-6 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <h2 class="text-lg font-bold">{{ config('app.name') }}</h2>
                    </div>
                    <button @click="sidebarOpen = false" type="button"
                        class="rounded-md p-1 text-gray-400 hover:bg-gray-700 hover:text-white lg:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <nav class="space-y-2">
                    <a href="/dashboard"
                        class="{{ request()->is('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                        @click="sidebarOpen = false">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Dashboard
                    </a>

                    @if (Auth::user()->hasRole('Super Admin'))
                        <a href="/kelas"
                            class="{{ request()->is('kelas*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            Kelas
                        </a>

                        <a href="/siswa"
                            class="{{ request()->is('siswa*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                            Siswa
                        </a>

                        <a href="/guru"
                            class="{{ request()->is('guru*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Guru
                        </a>

                        <a href="/walimurid"
                            class="{{ request()->is('walimurid*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-accessible">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1" />
                                <circle cx="12" cy="7.5" r=".5" fill="currentColor" />
                            </svg>
                            Wali Murid
                        </a>

                        <a href="/listkelassiswa"
                            class="{{ request()->is('listkelassiswa*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            List Kelas & Siswa
                        </a>
                        <a href="/listkelasguru"
                            class="{{ request()->is('listkelasguru*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            List Kelas & Guru
                        </a>
                        <a href="/listkelaslengkap"
                            class="{{ request()->is('listkelaslengkap*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                            @click="sidebarOpen = false">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                                </path>
                            </svg>
                            List Kelas Lengkap
                        </a>
                    @endif

                    <a href="/settings"
                        class="{{ request()->is('settings*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150"
                        @click="sidebarOpen = false">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </nav>

                <div class="absolute bottom-4 left-4 right-4">
                    <div class="flex items-center rounded-lg bg-gray-700 p-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-sm font-medium text-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="ml-3 min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs text-gray-300">
                                {{ Auth::user()->role ? Auth::user()->role->name : 'No Role' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-1 flex-col lg:ml-0">
                <header class="border-b bg-white shadow-sm">
                    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center">
                            <button @click="sidebarOpen = true" type="button"
                                class="rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 lg:hidden">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <h1 class="ml-2 text-lg font-semibold text-gray-900 sm:text-xl lg:ml-0">
                                Hello, {{ Auth::user()->name }}
                                <span
                                    class="text-sm text-gray-500">({{ Auth::user()->role ? Auth::user()->role->name : 'No Role' }})</span>
                            </h1>
                        </div>

                        <div class="flex items-center space-x-4">
                            <button type="button"
                                class="rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-3.5-3.5 3.5-3.5H15V7H9v3H4l3.5 3.5L4 17h5v3h6v-3z"></path>
                                </svg>
                            </button>

                            <livewire:auth.logout />
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-auto bg-gray-50 p-4 sm:p-6">
                    @yield('content')
                    {{ $slot ?? '' }}
                </main>
            </div>
        </div>

        @livewireScripts
        @livewireScriptConfig

    </body>

</html>
