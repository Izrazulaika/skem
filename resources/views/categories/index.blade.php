<x-app-layout>

    <x-slot name="header"></x-slot>

    <div class="container">

        <div class="flex items-center justify-between">
            <h2 class="text-bold text-2xl text-black">Categories</h2>
            <a href="{{ route('categories.create') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Add</button></a>
        </div>

        @if (session('success'))
            <div role="alert" class="alert alert-success mt-3">
                <x-fas-circle-check class="w-4 h-4 text-white"/>
                <span class="text-white">{{ session('success') }}</span>
                <button type="button" class="btn-clear float-right" aria-label="Close"><x-fas-circle-xmark class="w-4 h-4 text-white"/></button>
            </div>
        @endif
        @if (session('error'))
            <div role="alert" class="alert alert-error mt-3">
                <x-fas-circle-exclamation class="w-4 h-4 text-white"/>
                <span class="text-white">{{ session('error') }}</span>
                <button type="button" class="btn-clear float-right" aria-label="Close"><x-fas-circle-xmark class="w-4 h-4 text-white"/></button>
            </div>
        @endif

        <table class="table mt-4 border">
            <thead class="bg-blue-500">
                <tr>
                    <th class="text-white">Name</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($categories) > 0)
                    {{-- @php $count = 1; @endphp --}}
                    @foreach ($categories as $category)
                        <tr>
                            {{-- <td><p class="text-black"> {{ $count }}</p></td> --}}
                            <td>
                                <p class="text-black"> {{ $category->name }}</p>
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Edit</button></a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-fit min-h-fit py-2 px-4 btn btn-error text-white" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        {{-- @php $count++; @endphp --}}
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-black">No Data</td>
                    </tr>
                @endif
            </tbody>

        </table>

        <div class="flex items-center justify-between mt-4">
            <div class="pagination-info text-gray-500">
                Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
            </div>
            <div class="pagination-links">
                <div class="join">
                    <a href="{{ $categories->onFirstPage() ? '#' : route('categories.index', ['page' => 1]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $categories->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angles-left class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $categories->previousPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $categories->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angle-left class="w-[14px] h-[14px]"/>
                    </a>

                    @php
                        $currentPage = $categories->currentPage();
                        $halfMaxLinks = 4;
                        $start = max(1, $currentPage - $halfMaxLinks);
                        $end = min($start + 7, $categories->lastPage());
                        if ($end === $categories->lastPage()) {
                            $start = max(1, $end - 7);
                        }
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <a href="{{ $i === $currentPage ? '#' : route('categories.index', ['page' => $i]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $i === $currentPage ? 'btn-info bg-blue-500 border-gray-200 text-white hover:bg-blue-500' : 'btn bg-white text-black hover:text-white hover:bg-blue-400 ' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="{{ $categories->nextPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $categories->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
                        <x-fas-angles-right class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $categories->hasMorePages() ? route('categories.index', ['page' => $categories->lastPage()]) : '#' }}" class="join-item btn min-h-fit h-fit py-3  border-gray-200 {{ $categories->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
                        <x-fas-angles-right class="w-[14px] h-[14px]"/>
                    </a>
                </div>
            </div>
        </div>

    </div>


</x-app-layout>
<script>
    $(document).ready(function() {
        $('.alert .btn-clear').click(function() {
            $(this).closest('.alert').hide();
        });
    });


</script>
