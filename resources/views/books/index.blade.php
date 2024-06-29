<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="container">
        <div class="flex items-center justify-between">
            <h2 class="text-bold text-2xl text-black">Books</h2>
            <a href="{{ route('book.create') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Add</button></a>
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
                    <th class="text-white">Category</th>
                    <th class="text-white">Subject</th>
                    <th class="text-white">ISBN</th>
                    <th class="text-white">Title</th>
                    <th class="text-white">Record Date</th>
                    <th class="text-white">Status</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($book) > 0)

                    @foreach ($book as $b)
                        <tr>
                            <td>
                                <p class="text-black text-nowrap"> {{ $b->category->name }}</p>
                            </td>
                            <td>
                                <p class="text-black"> {{ $b->subject }}</p>
                            </td>
                            <td>
                                <p class="text-black"> {{ $b->isbn }}</p>
                            </td>
                            <td>
                                <p class="text-black"> {{ $b->title }}</p>
                            </td>
                            <td>
                                <p class="text-black text-nowrap"> {{ $b->record_date }}</p>
                            </td>
                            <td>
                                @if($b->status == 'active')
                                    <span class="badge badge-success text-white">Active</span>
                                @else
                                    <span class="badge badge-error text-white">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('book.edit', $b->id) }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Edit</button></a>
                                    <form action="{{ route('book.destroy', $b->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-fit min-h-fit py-2 px-4 btn btn-error text-white" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

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
                Showing {{ $book->firstItem() }} to {{ $book->lastItem() }} of {{ $book->total() }} results
            </div>
            <div class="pagination-links">
                <div class="join">
                    <a href="{{ $book->onFirstPage() ? '#' : route('categories.index', ['page' => 1]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $book->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angles-left class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $book->previousPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $book->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angle-left class="w-[14px] h-[14px]"/>
                    </a>

                    @php
                        $currentPage = $book->currentPage();
                        $halfMaxLinks = 4;
                        $start = max(1, $currentPage - $halfMaxLinks);
                        $end = min($start + 7, $book->lastPage());
                        if ($end === $book->lastPage()) {
                            $start = max(1, $end - 7);
                        }
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <a href="{{ $i === $currentPage ? '#' : route('book.index', ['page' => $i]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $i === $currentPage ? 'btn-info bg-blue-500 border-gray-200 text-white hover:bg-blue-500' : 'btn bg-white text-black hover:text-white hover:bg-blue-400 ' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="{{ $book->nextPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $book->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
                        <x-fas-angles-right class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $book->hasMorePages() ? route('book.index', ['page' => $book->lastPage()]) : '#' }}" class="join-item btn min-h-fit h-fit py-3  border-gray-200 {{ $book->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
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
