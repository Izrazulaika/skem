<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" media="print" onload="this.media='all'">


    <link rel="stylesheet" href="{{ asset('css/school.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased overflow-x-hidden">
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar -->


        <aside class="bg-blue-300 shadow-lg h-full w-64 fixed left-0 top-0" style="color: black;">
            <!-- Sidebar content here -->
            <div class="flex items-center justify-center pt-5 pb-5 px-4 border-b bg-blue-600">
                <img src="{{ asset('pictures/skemlogo.png') }}" alt="Logo" class="h-8 mr-2">
                <h2 class="font-semibold text-xl leading-tight text-white">
                    {{ __('SKEMTEXT') }}
                </h2>
            </div>
            <ul class="p-4">
                <li>
                    <a href="{{ route('dashboard') }}"  class="transition-all flex items-center gap-2 py-3 text-blue-900 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('dashboard') ? 'bg-blue-100' : '' }}">
                        <x-fas-house class="w-4 h-4 text-blue-900"/>
                        Dashboard
                    </a>
                </li>
                @if(Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('categories.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('categories.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-layer-group class="w-4 h-4 text-blue-900"/>
                        Manage Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('book.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('book.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-book class="w-4 h-4 text-blue-900"/>
                        Manage Books
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('users.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-users class="w-4 h-4 text-blue-900"/>
                        Manage Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('students.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-graduation-cap class="w-4 h-4 text-blue-900"/>
                        Manage Students
                    </a>
                </li>
                <li>
                    <a href="{{ route('borrow.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('borrow.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-book-open class="w-4 h-4 text-blue-900"/>
                        Manage Borrow
                    </a>
                </li>

                <li>
                    <a href="{{ route('penalties.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('penalties.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-sack-dollar class="w-4 h-4 text-blue-900"/>
                        Manage Penalties
                    </a>
                </li>
                <li>
                    <a href="{{ route('report.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('report.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-file class="w-4 h-4 text-blue-900"/>
                        Report
                    </a>
                </li>
                @endif
                @if(Auth::user()->role == 'parent')
                <li>
                    <a href="{{ route('children.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('children.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-child class="w-4 h-4 text-blue-900"/>
                        My Children
                    </a>
                </li>
                <li>
                    <a href="{{ route('children.parentBorrows') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('children.parentBorrows') ? 'bg-blue-100' : '' }}">
                        <x-fas-book-open class="w-4 h-4 text-blue-900"/>
                        Borrow Records
                    </a>
                </li>
                <li>
                    <a href="{{ route('penalties-parent.index') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->routeIs('penalties-parent.index') ? 'bg-blue-100' : '' }}">
                        <x-fas-sack-dollar class="w-4 h-4 text-blue-900"/>
                        View Penalties
                    </a>
                </li>

                @endif
                <!-- Add more sidebar links as needed -->
                <li>
                    <a href="{{ route('profile.edit') }}" class="transition-all flex items-center gap-2 text-blue-900 py-3 font-bold hover:bg-yellow-400 px-2 rounded-[10px] hover:text-black {{ request()->is('profile*') ? 'bg-blue-100' : '' }}">
                        <x-fas-circle-user class="w-4 h-4 text-blue-900"/>
                        My Profile
                    </a>
                </li>
            </ul>
        </aside>


        <!-- Page Content -->
        <div class="ml-64">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-blue-500 text-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <!-- Logo and title -->
                    <div class="flex items-center hidden">
                        <img src="{{ asset('pictures/skemlogo.png') }}" alt="Logo" class="h-8 mr-2">
                        <h2 class="font-semibold text-xl leading-tight text-white">
                            {{ __('SKEMTEXT') }}
                        </h2>
                    </div>
                        <!-- Log out link -->
                        <nav class="ml-auto">
                        @auth
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                class="text-gray-200 hover:text-gray-300">
                                {{ __('Log out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                        </nav>
                    </div>
                </header>
            @endif

            <!-- Main Content -->
            <main class="py-8 px-4 pb-20">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-blue-500 text-white py-4 text-center fixed left-0 bottom-0 w-full">
                SkemText &copy; 2024 All Rights Reserved
            </footer>
        </div>

    </div>
</body>
</html>
