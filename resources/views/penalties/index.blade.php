<x-app-layout>

    <x-slot name="header"></x-slot>

    <div class="container">

        <div class="flex items-center justify-between">
            <h2 class="text-bold text-2xl text-black">Manage Penalties</h2>
            <a href="{{ route('penalties.create') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Create Penalty</button></a>
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
                    <th class="text-white">Penalty ID</th>
                    <th class="text-white">Amount (RM)</th>
                    <th class="text-white">Remark</th>
                    <th class="text-white">Status</th>
                    <th class="text-white">Borrow Record</th>
                    <th class="text-white">Student Info</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($penalties->count() > 0)
                    @foreach ($penalties as $penalty)
                        <tr>
                            <td class="text-black">{{ $penalty->id }}</td>
                            <td class="text-black">{{ $penalty->amount }}</td>
                            <td class="text-black">{{ $penalty->remark }}</td>
                            <td class="text-black">
                                @if ($penalty->status == 'Pending')
                                    <span class="badge badge-outline">{{ $penalty->status }}</span>
                                @elseif ($penalty->status == 'Paid')
                                    <span class="badge badge-primary badge-outline">{{ $penalty->status }}</span>
                                @else
                                    <span class="badge badge-secondary badge-outline">{{ $penalty->status }}</span>
                                @endif
                            </td>
                            <td class="text-black">
                                REF NO: <b>{{ $penalty->borrowRecord->ref_number }}</b>
                                <div class="my-2" style="height: 1px; width: 100%; background: #d5d0d0;"></div>
                                Start Date: <b>{{ $penalty->borrowRecord->borrow_start_date }}</b> <br>
                                Due Date:  <b>{{ $penalty->borrowRecord->borrow_end_date }}</b>
                                <div class="my-2" style="height: 1px; width: 100%; background: #d5d0d0;"></div>
                                Book Borrowed:
                                <ul>
                                    @foreach ($penalty->borrowRecord->borrowItems as $item)
                                        <li class="mb-3"><b>{{ $loop->iteration }}.</b> <b>{{ $item->book->title }}</b> (ISBN: {{ $item->book->isbn }})</li>
                                    @endforeach
                                </ul>
                            </td>


                            <td class="text-black">
                                <p class="mb-2"><b>Student ID</b> {{ $penalty->borrowRecord->student->student_id }}</p>
                                <p><b>Student Name</b> {{ $penalty->borrowRecord->student->name }}</p>
                            </td>


                            <td class="text-black">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('penalties.edit', $penalty->id) }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Edit</button></a>
                                    <form action="{{ route('penalties.destroy', $penalty->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-fit min-h-fit py-2 px-4 btn btn-error text-white" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-black">No penalty records found</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $('.alert .btn-clear').click(function() {
            $(this).closest('.alert').hide();
        });
    });
</script>
