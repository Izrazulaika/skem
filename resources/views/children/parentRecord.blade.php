<x-app-layout>

    <x-slot name="header"></x-slot>

    <div class="container">

        <div class="flex items-center justify-between">
            <h2 class="text-bold text-2xl text-black">View Children's Borrow</h2>
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
                    <th class="text-white">Reference Number</th>
                    <th class="text-white">Borrow Date</th>
                    <th class="text-white">Due Date</th>
                    <th class="text-white">Student Info</th>
                    <th class="text-white">Borrowed Books</th>
                    <th class="text-white">Status</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($borrowRecords->count() > 0)
                    @foreach ($borrowRecords as $record)
                        <tr>
                            <td class="text-black">
                                <div class="flex items-center">
                                    <b>{{ $record->ref_number }}</b>
                                    @if ($record->borrow_status == 'In Borrowed' && \Carbon\Carbon::parse($record->borrow_end_date)->isPast())
                                        <span class="badge bg-red-500 text-white border-red-500 py-1 px-2 ml-2">Late</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-black text-nowrap">{{ $record->borrow_start_date }}</td>
                            <td class="text-black text-nowrap">{{ $record->borrow_end_date }}</td>

                            <td class="text-black">
                                <p class="mb-2"><b>Student ID</b> {{ $record->student->student_id }}</p>
                                <p><b>Student Name</b> {{ $record->student->name }}</p>
                            </td>

                            <td class="text-black">
                                @if ($record->borrow_status == 'In Borrowed')
                                    <span class="badge bg-blue-500 text-white border-blue-500 py-3">In Borrowed</span>
                                @elseif ($record->borrow_status == 'Returned')
                                    <span class="badge bg-green-500 text-white border-green-500 py-3">Returned</span>
                                @else
                                    <span class="badge bg-red-500 text-white border-red-500 py-3">Penalty</span>
                                @endif

                            </td>
                            <td class="text-black">
                                <ul>
                                    @foreach ($record->borrowItems as $item)
                                        <li class="mb-3"><b>{{ $loop->iteration }}.</b> <b>{{ $item->book->title }}</b> (ISBN: {{ $item->book->isbn }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-black">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('children.recordDetail', $record->id) }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">View</button></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-black">No borrow records found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="flex items-center justify-between mt-4">
            <div class="pagination-info text-gray-500">
                Showing {{ $borrowRecords->firstItem() }} to {{ $borrowRecords->lastItem() }} of {{ $borrowRecords->total() }} results
            </div>
            <div class="pagination-links">
                <div class="join">
                    <a href="{{ $borrowRecords->onFirstPage() ? '#' : route('categories.index', ['page' => 1]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $borrowRecords->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angles-left class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $borrowRecords->previousPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $borrowRecords->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angle-left class="w-[14px] h-[14px]"/>
                    </a>

                    @php
                        $currentPage = $borrowRecords->currentPage();
                        $halfMaxLinks = 4;
                        $start = max(1, $currentPage - $halfMaxLinks);
                        $end = min($start + 7, $borrowRecords->lastPage());
                        if ($end === $borrowRecords->lastPage()) {
                            $start = max(1, $end - 7);
                        }
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <a href="{{ $i === $currentPage ? '#' : route('book.index', ['page' => $i]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $i === $currentPage ? 'btn-info bg-blue-500 border-gray-200 text-white hover:bg-blue-500' : 'btn bg-white text-black hover:text-white hover:bg-blue-400 ' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="{{ $borrowRecords->nextPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $borrowRecords->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
                        <x-fas-angles-right class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $borrowRecords->hasMorePages() ? route('book.index', ['page' => $borrowRecords->lastPage()]) : '#' }}" class="join-item btn min-h-fit h-fit py-3  border-gray-200 {{ $borrowRecords->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
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
