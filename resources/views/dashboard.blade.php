<x-app-layout>
    <!-- Sidebar -->
    

    <!-- Main content -->
    <x-slot name="header">
        <header class="bg-blue-500 text-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <!-- Logo and title -->
                <div class="flex items-center">
                    <img src="{{ asset('pictures/skemlogo.png') }}" alt="Logo" class="h-8 mr-2">
                    <h2 class="font-semibold text-xl leading-tight">
                        {{ __('SKEMTMS') }}
                    </h2>
                </div>

                <!-- Log Out link -->
                <nav>
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
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Card with Borrowed Books -->
                <div class="bg-green-500 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold mb-4 text-white">Borrowed Books</h3>
                        <!-- List of Borrowed Books -->
                        <ul class="text-white">
                            <li>Book 1</li>
                            <li>Book 2</li>
                            <li>Book 3</li>
                        </ul>
                    </div>
                </div>
                <!-- Add more cards for different categories -->
            </div>
        </div>
    </div>
</x-app-layout>
