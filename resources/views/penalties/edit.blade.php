<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="container">
        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Edit Penalty</h2>
                    <a href="{{ route('penalties.index') }}">
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

                <form action="{{ route('penalties.update', $penalty->id) }}" method="POST" class="form-group">
                    @csrf
                    @method('PUT')

                    <label for="amount" class="text-black">Amount:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-dollar-sign class="w-4 h-4 opacity-70 text-black"/>
                        <input type="number" class="grow text-black" placeholder="Amount" name="amount" value="{{ $penalty->amount }}" required />
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                    <br />

                    <label for="remark" class="text-black">Remark:</label>
                    <textarea class="textarea textarea-bordered w-full bg-white mt-2 text-black" name="remark" placeholder="Remark" required>{{ $penalty->remark }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('remark')" />
                    <br />
                    <br />
                    <label for="status" class="text-black">Status:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-toggle-on class="w-4 h-4 opacity-70 text-black"/>
                        <select name="status" class="grow text-black bg-white" required>
                            <option value="Pending" {{ $penalty->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Paid" {{ $penalty->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Waived" {{ $penalty->status == 'Waived' ? 'selected' : '' }}>Waived</option>
                        </select>
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    <br />

                    <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-3">Update Penalty</button>
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
