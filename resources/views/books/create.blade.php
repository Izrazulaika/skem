<x-app-layout>

    <x-slot name="header"></x-slot>
    <div class="container">



        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Add New Book</h2>
                    <a href="{{ route('book.index') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Back</button></a>
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



                <form action="{{ route('book.store') }}" method="POST" class="form-group">
                    @csrf

                    <label for="subject" class="text-black">Subject:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-layer-group class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Subject" name="subject" required/>
                    </label>
                    <br />
                    <label for="isbn" class="text-black">ISBN:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-book class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="ISBN" name="isbn" required/>
                    </label>
                    <br />
                    <label for="title" class="text-black">Title:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-font class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Title" name="title" required/>
                    </label>

                    <br />
                    <label for="record_date" class="text-black">Record Date:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-calendar class="w-4 h-4 opacity-70 text-black"/>
                        <input type="date" class="w-full text-black" placeholder="Record Date" name="record_date" required/>
                    </label>

                    <br />
                    <label for="category_id" class="text-black">Catgeory:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-calendar class="w-4 h-4 opacity-70 text-black"/>
                        <select required name="category_id" class="grow bg-transparent">
                            <option>Select Category</option>
                            @if (count($categories) > 0)
                                @foreach ($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            @endif
                        </select>

                    </label>

                    <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-4">Add Book</button>
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


