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
                        {{ __('SKEMTEXT') }}
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
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
                <!-- Card with Total Books -->
                @if(Auth::user()->role == 'admin')
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-md font-semibold text-blue-700">Total Books</h3>
                            <x-fas-book class="w-[20px] h-[20px] opacity-70 text-blue-700"/>
                        </div>
                        <p class="mb-0 text-3xl text-blue-700 text-left mt-3">{{ $totalBooks }}</p>
                    </div>
                </div>
                <!-- Card with Total Students -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-md font-semibold text-blue-700">Total Students</h3>
                            <x-fas-id-card-clip class="w-[20px] h-[20px] opacity-70 text-blue-700"/>
                        </div>
                        <p class="mb-0 text-3xl text-blue-700 text-left mt-3">{{ $totalStudents }}</p>
                    </div>
                </div>
                @endif
                <!-- Card with Books In Borrowed -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-md font-semibold text-blue-700">Borrowed Record</h3>
                            <x-fas-book-open class="w-[20px] h-[20px] opacity-70 text-blue-700"/>
                        </div>
                        <p class="mb-0 text-3xl text-blue-700 text-left mt-3">{{ $booksInBorrowed }}</p>
                    </div>
                </div>
                <!-- Card with Books Late Return -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-md font-semibold text-blue-700">Late Return</h3>
                            <x-fas-triangle-exclamation class="w-[20px] h-[20px] opacity-70 text-blue-700"/>
                        </div>
                        <p class="mb-0 text-3xl text-blue-700 text-left mt-3">{{ $booksLateReturn }}</p>
                    </div>
                </div>
                <!-- Add more cards for different categories -->
            </div>
        </div>
    </div>
</x-app-layout>
