<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="container">
        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Add New User</h2>
                    <a href="{{ route('users.index') }}">
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

                <form action="{{ route('users.store') }}" method="POST" class="form-group">
                    @csrf

                    <label for="name" class="text-black">User Name:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-user class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Name" name="name" required />

                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />

                    <br />
                    <label for="email" class="text-black">Email:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-envelope class="w-4 h-4 opacity-70 text-black"/>
                        <input type="email" class="grow text-black" placeholder="Email" name="email" required />

                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    <br />
                    <label for="password" class="text-black">Password:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-lock class="w-4 h-4 opacity-70 text-black"/>
                        <input type="password" class="grow text-black" placeholder="Password" name="password" required />

                    </label>

                    <br />
                    <label for="password_confirmation" class="text-black">Confirm Password:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-lock class="w-4 h-4 opacity-70 text-black"/>
                        <input type="password" class="grow text-black" placeholder="Confirm Password" name="password_confirmation" required />
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />

                    <br />
                    <label for="phone_number" class="text-black">Phone Number:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-phone class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Phone Number" name="phone_number" />
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />

                    <br />
                    <label for="role" class="text-black">Role:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-user-tag class="w-4 h-4 opacity-70 text-black"/>
                        <select name="role" class="grow text-black bg-white" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="parent">Parent</option>
                        </select>
                    </label>

                    <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-3">Add User</button>
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
