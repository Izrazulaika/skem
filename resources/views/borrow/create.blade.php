<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="container">

        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Add New Borrow</h2>
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

                <label for="student_id" class="text-black">Search Student ID:</label>
                <div class="flex items-center w-full gap-2 mb-3">
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2 w-full">
                        <x-fas-layer-group class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Enter Student ID" name="student_id" id="student_id" />
                    </label>
                    <button type="button" id="searchButton" class="btn btn-info btn-md bg-blue-500 text-white mt-1">Search</button>
                </div>
                <hr/>
                <div id="studentInfo" style="display: none;">

                    <form action="{{ route('borrow.store') }}" method="POST" class="form-group">
                        @csrf
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-black text-lg"><b>Borrow Information</b></h1>
                                <p>Please fill & select required field</p>
                            </div>
                            <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-4">Create</button>
                        </div>

                        <input type="hidden" id="sid" name="sid"/>
                        <div class="mt-3">
                            <label for="parent_name" class="text-black">Parent Name:</label>
                            <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                <x-fas-person-breastfeeding class="w-4 h-4 opacity-70 text-black"/>
                                <input type="text" id="parent_name" class="grow text-black" placeholder="Parent Name" name="parent_name" readonly />
                            </label>
                        </div>

                        <div class="mt-3">
                            <label for="student_name" class="text-black">Student Name:</label>
                            <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                <x-fas-user class="w-4 h-4 opacity-70 text-black"/>
                                <input type="text" id="student_name" class="grow text-black" placeholder="Name" name="student_name" readonly />
                            </label>
                        </div>

                        <div class="mt-3">
                            <label for="student_standard" class="text-black">Student Standard:</label>
                            <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                <x-fas-layer-group class="w-4 h-4 opacity-70 text-black"/>
                                <input type="text" id="student_standard" class="grow text-black" placeholder="Student Standard" name="student_standard" readonly />
                            </label>
                        </div>

                        <div class="mt-3">
                            <label for="borrow_date" class="text-black">Borrow Date:</label>
                            <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                <x-fas-calendar-day class="w-4 h-4 opacity-70 text-black"/>
                                <input type="text" class="grow text-black" value="{{ \Carbon\Carbon::today()->toDateString() }}" name="borrow_date" id="borrow_date" readonly />
                            </label>
                        </div>

                        <div class="mt-3">
                            <label for="due_date" class="text-black">Due Date:</label>
                            <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                                <x-fas-calendar-day class="w-4 h-4 opacity-70 text-black"/>
                                <input type="date" class="grow text-black" name="due_date" id="due_date" min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" required />
                            </label>
                        </div>

                        <div class="mt-5">
                            <h3 class="text-lg text-black mb-3">Books List Available <span id="standard-text"></span></h3>
                            <table class="table-auto w-full border-collapse border border-gray-400 table">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 text-black p-2">
                                            <div class="flex items-center justify-center">
                                                <input type="checkbox" id="selectAllBooks" class="checkbox checkbox-sm border-blue-400 [--chkbg:theme(colors.blue.600)] [--chkfg:white]">
                                            </div>
                                        </th>
                                        <th class="border border-gray-300 text-black p-2">Title</th>
                                        <th class="border border-gray-300 text-black p-2">ISBN</th>
                                        <th class="border border-gray-300 text-black p-2">Category</th>
                                    </tr>
                                </thead>
                                <tbody id="booksList">
                                    <tr>
                                        <td colspan="4" class="border border-gray-300 text-black p-2">No Book Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div id="noStudentFound" style="display: none;" class="text-black mt-3">
                    No student found.
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

        $('#searchButton').click(function() {
            var studentId = $('#student_id').val();

            $.ajax({
                url: "{{ route('borrow.searchStudent') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    student_id: studentId
                },
                success: function(response) {
                    if (response.success) {
                        $('#studentInfo').show();
                        $('#noStudentFound').hide();
                        onStudentSearchSuccess(response);
                    } else {
                        $('#studentInfo').hide();
                        $('#noStudentFound').show();
                    }
                },
                error: function() {
                    $('#studentInfo').hide();
                    $('#noStudentFound').show();
                }
            });
        });

        function onStudentSearchSuccess(response) {
            if (response.success) {
                // Display student data
                $('#parent_name').val(response.student.parent.name);
                $('#student_name').val(response.student.name);
                $('#sid').val(response.student.id);
                $('#student_standard').val(`Standard ` + response.student.standard);
                $('#standard-text').html(`(Standard ${response.student.standard})`);

                // Fetch books based on student's standard
                fetchBooks(`Standard ${response.student.standard}`);
            } else {
                // Handle no student found case
                alert(response.message);
            }
        }

        function fetchBooks(standard) {
            $.ajax({
                url: "{{ route('borrow.bookList') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    standard: standard
                },
                success: function(books) {
                    let booksList = $('#booksList');
                    booksList.empty();

                    if (books.length > 0) {
                        books.forEach(function(book) {
                            booksList.append(
                                `<tr>
                                    <td class="border border-gray-300 p-2">
                                        <div class="flex items-center justify-center">
                                            <input type="checkbox" name="book_ids[]" class="checkbox checkbox-sm border-blue-400 [--chkbg:theme(colors.blue.600)] [--chkfg:white] book-checkbox" value="${book.id}">
                                        </div>
                                    </td>
                                    <td class="border border-gray-300 text-black p-2">${book.title}</td>
                                    <td class="border border-gray-300 text-black p-2">${book.isbn}</td>
                                    <td class="border border-gray-300 text-black p-2">${book.category_name ? book.category_name : 'No Category'}</td>
                                </tr>`
                            );
                        });

                        // Attach event listener for select all checkbox
                        $('#selectAllBooks').prop('checked', false).off('change').on('change', function() {
                            $('.book-checkbox').prop('checked', this.checked);
                        });
                    } else {
                        booksList.append(
                            `<tr>
                                <td colspan="4" class="border border-gray-300 text-black p-2">No Book Data</td>
                            </tr>`
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching books:', error);
                    let booksList = $('#booksList');
                    booksList.empty();
                    booksList.append(
                        `<tr>
                            <td colspan="4" class="border border-gray-300 text-black p-2">Error fetching book data</td>
                        </tr>`
                    );
                }
            });
        }
    });
</script>
