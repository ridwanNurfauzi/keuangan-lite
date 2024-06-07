<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Keuangan Lite') }}</title>

    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="#" class="flex ms-2 md:me-24">
                            <span class="self-center text-green-800 text-lg font-bold sm:text-xl whitespace-nowrap">
                                Keuangan Lite
                            </span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ms-3">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
                <ul class="space-y-2 font-medium">
                    <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i
                            class="bi bi-graph-up-arrow w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                        <span class="ms-3">Dashboard</span>
                    </x-side-nav-link>
                    <x-side-nav-link :href="route('cashflows.index')" :active="in_array(Route::current()->getName(), [
                        'cashflows.index',
                        'cashflows.create',
                        'cashflows.edit',
                        'cashflows.show',
                    ])">
                        <i
                            class="bi bi-database w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                        <span class="ms-3">Cashflow</span>
                    </x-side-nav-link>
                    <x-side-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <i
                            class="bi bi-person-fill w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                        <span class="ms-3">Profil</span>
                    </x-side-nav-link>
                    <x-side-nav-link :href="'javascript:logout()'"
                        :active="false">
                        <i
                            class="bi bi-box-arrow-right w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                        <span class="ms-3">Logout</span>
                    </x-side-nav-link>
                    <form action="{{ route('logout') }}" method="post" name="logout">
                        @csrf
                    </form>
                </ul>
            </div>
        </aside>

        <div class="p-4 sm:ml-64">
            <div class="rounded-lg mt-14">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    @if (session()->has('session-flash.msg'))
                        <div class="mt-4">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <x-alert :msg="session()->get('session-flash.msg')" :color="session()->get('session-flash.color')"></x-alert>
                            </div>
                        </div>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <x-loading-panel></x-loading-panel>

    <script>
        function logout(){
            document.forms['logout'].submit();
        }
    </script>

    @vite('resources/js/app.ts')
    @isset($scripts)
        {{ $scripts }}
    @endisset
</body>

</html>
