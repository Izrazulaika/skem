<x-app-layout>

    <x-slot name="header"></x-slot>

    <div class="container">

        <div class="flex items-center justify-between">
            <h2 class="text-bold text-2xl text-black">Users</h2>
            <a href="{{ route('users.create') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Add</button></a>
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
                    <th class="text-white">Email</th>
                    <th class="text-white">Phone Number</th>
                    <th class="text-white">Role</th>
                    <th class="text-white">Created At</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)

                    @foreach ($users as $b)
                        <tr>
                            <td>
                                <p class="text-black"> {{ $b->name }}</p>
                            </td>
                            <td>
                                <p class="text-black"> {{ $b->email }}</p>
                            </td>
                            <td>
                                <p class="text-black">{{ $b->userDetail && $b->userDetail?->phone_number ? $b->userDetail->phone_number : '-'}}</p>
                            </td>

                            <td>
                                @if($b->role == 'admin')
                                    <span class="badge badge-success text-white">Admin</span>
                                @else
                                    <span class="badge text-white">Parent</span>
                                @endif
                            </td>
                            <td>
                                <p class="text-black"> {{ $b->created_at }}</p>
                            </td>


                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('users.edit', $b->id) }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Edit</button></a>
                                    <form action="{{ route('users.destroy', $b->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-fit min-h-fit py-2 px-4 btn btn-error text-white" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </div>
            <div class="pagination-links">
                <div class="join">
                    <a href="{{ $users->onFirstPage() ? '#' : route('categories.index', ['page' => 1]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $users->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angles-left class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $users->previousPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $users->onFirstPage() ? 'bg-blue-900 text-gray-400 hover:bg-blue-900' : 'btn-info bg-blue-500 text-white hover:bg-blue-500' }}">
                        <x-fas-angle-left class="w-[14px] h-[14px]"/>
                    </a>

                    @php
                        $currentPage = $users->currentPage();
                        $halfMaxLinks = 4;
                        $start = max(1, $currentPage - $halfMaxLinks);
                        $end = min($start + 7, $users->lastPage());
                        if ($end === $users->lastPage()) {
                            $start = max(1, $end - 7);
                        }
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <a href="{{ $i === $currentPage ? '#' : route('book.index', ['page' => $i]) }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $i === $currentPage ? 'btn-info bg-blue-500 border-gray-200 text-white hover:bg-blue-500' : 'btn bg-white text-black hover:text-white hover:bg-blue-400 ' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="{{ $users->nextPageUrl() }}" class="join-item btn min-h-fit h-fit py-3 border-gray-200 {{ $users->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
                        <x-fas-angles-right class="w-[14px] h-[14px]"/>
                    </a>

                    <a href="{{ $users->hasMorePages() ? route('book.index', ['page' => $users->lastPage()]) : '#' }}" class="join-item btn min-h-fit h-fit py-3  border-gray-200 {{ $users->hasMorePages() ? 'btn-info bg-blue-500 text-white hover:bg-blue-500 ' : 'bg-blue-900 text-gray-400 hover:bg-blue-900' }}">
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
