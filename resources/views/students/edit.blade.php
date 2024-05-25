<!-- resources/views/students/edit.blade.php -->
<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="container">
        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Edit Student</h2>
                    <a href="{{ route('students.index') }}">
                        <button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Back</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div role="alert" class="alert alert-success">
                        <x-fas-circle-check class="w-4 h-4 text-white"/>
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="btn-clear float-right" aria-label="Close">
                            <x-fas-circle-xmark class="w-4 h-4 text-white"/>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div role="alert" class="alert alert-error">
                        <x-fas-circle-exclamation class="w-4 h-4 text-white"/>
                        <span class="text-white">{{ session('error') }}</span>
                        <button type="button" class="btn-clear float-right" aria-label="Close">
                            <x-fas-circle-xmark class="w-4 h-4 text-white"/>
                        </button>
                    </div>
                @endif

                <form action="{{ route('students.update', $student->id) }}" method="POST" class="form-group">
                    @csrf
                    @method('PATCH')

                    <label for="student_id" class="text-black">Student ID:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-id-card-clip class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Student ID" name="student_id" value="{{ old('student_id', $student->student_id) }}" required />
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('student_id')" />
                    <br />

                    <label for="name" class="text-black">Student Name:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-user class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Name" name="name" value="{{ old('name', $student->name) }}" required />
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    <br />

                    <label for="standard" class="text-black">Standard:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-turn-up class="w-4 h-4 opacity-70 text-black"/>
                        <select name="standard" class="grow text-black bg-white" required>
                            <option value="">Select Standard</option>
                            <option value="1" {{ $student->standard == 1 ? 'selected' : '' }}>Standard 1</option>
                            <option value="2" {{ $student->standard == 2 ? 'selected' : '' }}>Standard 2</option>
                            <option value="3" {{ $student->standard == 3 ? 'selected' : '' }}>Standard 3</option>
                            <option value="4" {{ $student->standard == 4 ? 'selected' : '' }}>Standard 4</option>
                            <option value="5" {{ $student->standard == 5 ? 'selected' : '' }}>Standard 5</option>
                            <option value="6" {{ $student->standard == 6 ? 'selected' : '' }}>Standard 6</option>
                        </select>
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('standard')" />
                    <br />

                    <label for="parent_id" class="text-black">Parent:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-user-tag class="w-4 h-4 opacity-70 text-black"/>
                        <select name="parent_id" class="grow text-black bg-white" required>
                            <option value="">Select Parent</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $student->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('parent_id')" />
                    <br />

                    <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-3">Update Student</button>
                </form>
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
