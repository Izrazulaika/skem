<x-app-layout>

    <x-slot name="header"></x-slot>
    <div class="container">

        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Borrow Record</h2>
                    <a href="{{ route('borrow.index') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Back</button></a>
                </div>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div role="alert" class="alert alert-success">
                        <x-fas-circle-check class="w-4 h-4 text-white"/>
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="btn-clear float-right" aria-label="Close"><x-fas-circle-xmark class="w-4 h-4 text-white"/></button>
                    </div>
                @endif
                @if (session('error'))
                    <div role="alert" class="alert alert-error">
                        <x-fas-circle-exclamation class="w-4 h-4 text-white"/>
                        <span class="text-white">{{ session('error') }}</span>
                        <button type="button" class="btn-clear float-right" aria-label="Close"><x-fas-circle-xmark class="w-4 h-4 text-white"/></button>
                    </div>
                @endif



                <div id="studentInfo">

                    <form action="{{ route('borrow.update', $borrow->id) }}" method="POST" class="form-group">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-black text-lg"><b>Borrow Information</b></h1>
                                <p>Check details below</p>
                            </div>
                            <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-4">Save</button>
                        </div>

                        <hr class="mt-[10px] mb-[20px]" />

                        <p class="text-black"><b>Record Details</b></p>
                        <div class="grid grid-cols-2 gap-2">


                            <div class="mt-3">
                                <label for="ref_no" class="text-black">Reference No:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-book-open class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="ref_no" class="grow text-black" placeholder="Ref No" name="ref_no" value="{{ $borrow->ref_number }}" readonly />
                                </label>
                            </div>

                            <div class="mt-3">
                                <label for="borrow_start_date" class="text-black">Borrow Date:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-calendar-day class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="date" class="grow text-black" value="{{ $borrow->borrow_start_date }}" name="borrow_start_date" id="borrow_start_date" />
                                </label>
                                <x-input-error class="mt-2" :messages="$errors->get('borrow_start_date')" />
                            </div>


                            <div class="mt-3">
                                <label for="borrow_end_date" class="text-black">Due Date:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-calendar-day class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="date" class="grow text-black" name="borrow_end_date" id="borrow_end_date"  value="{{ $borrow->borrow_end_date }}"   />
                                </label>
                                <x-input-error class="mt-2" :messages="$errors->get('borrow_end_date')" />
                            </div>

                            <div class="mt-3">
                                <label for="borrow_status" class="text-black">Status:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-bookmark class="w-4 h-4 opacity-70 text-black"/>
                                    <select required name="borrow_status" class="grow bg-transparent text-black">
                                        <option value="In Borrowed" {{ $borrow->borrow_status == 'In Borrowed' ? 'selected' : '' }}>In Borrowed</option>
                                        <option value="Returned" {{ $borrow->borrow_status == 'Returned' ? 'selected' : '' }}>Returned</option>
                                        <option value="Penalty" {{ $borrow->borrow_status == 'Penalty' ? 'selected' : '' }}>Penalty</option>
                                    </select>

                                </label>
                                <x-input-error class="mt-2" :messages="$errors->get('borrow_status')" />

                            </div>

                        </div>

                        <div class="mt-5">
                            <h3 class="text-lg text-black mb-3">Borrowed Book</h3>
                            <table class="table-auto w-full border-collapse border border-gray-400 table">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 text-black p-2">Title</th>
                                        <th class="border border-gray-300 text-black p-2">ISBN</th>
                                        <th class="border border-gray-300 text-black p-2">Category</th>
                                    </tr>
                                </thead>
                                <tbody id="booksList">
                                    @foreach ($borrow->borrowItems as $item)
                                        <tr>
                                            <td class="border border-gray-300 text-black p-2">{{ $item->book->title }}</td>
                                            <td class="border border-gray-300 text-black p-2">{{ $item->book->isbn }}</td>
                                            <td class="border border-gray-300 text-black p-2">{{ $item->book->category->name }}</td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <hr class="my-[30px]" />

                        <p class="text-black"><b>Student Information</b></p>
                        <div class="grid grid-cols-2 gap-2">

                            <div class="mt-3">
                                <label for="student_id" class="text-black">Student ID:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-id-card class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="student_id" class="grow text-black" placeholder="Name" name="student_id" value="{{$borrow->student->student_id}}" readonly />
                                </label>
                            </div>

                            <div class="mt-3">
                                <label for="student_name" class="text-black">Student Name:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-user class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="student_name" class="grow text-black" placeholder="Name" name="student_name"  value="{{$borrow->student->name}}"  readonly />
                                </label>
                            </div>

                            <div class="mt-3">
                                <label for="student_standard" class="text-black">Student Standard:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-layer-group class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="student_standard" class="grow text-black" placeholder="Student Standard" name="student_standard"  value="Standard {{$borrow->student->standard}}"  readonly />
                                </label>
                            </div>

                        </div>

                        <hr class="my-[30px]" />

                        <p class="text-black"><b>Parent Information</b></p>
                        <div class="grid grid-cols-2 gap-2">

                            <div class="mt-3">
                                <label for="parent_name" class="text-black">Parent Name:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-person-breastfeeding class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="parent_name" class="grow text-black" placeholder="Parent Name" name="parent_name" value="{{$borrow->student->parent->name}}" readonly />
                                </label>
                            </div>

                            <div class="mt-3">
                                <label for="parent_email" class="text-black">Parent Email:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-envelope class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="parent_email" class="grow text-black" placeholder="Parent Email" name="parent_email" value="{{$borrow->student->parent->email}}" readonly />
                                </label>
                            </div>

                            <div class="mt-3">
                                <label for="parent_contact" class="text-black">Parent Contact:</label>
                                <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                    <x-fas-mobile class="w-4 h-4 opacity-70 text-black"/>
                                    <input type="text" id="parent_contact" class="grow text-black" placeholder="Parent Contact" name="parent_contact" value="{{$parentDetail?->phone_number}}" readonly />
                                </label>
                            </div>

                        </div>


                    </form>
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
