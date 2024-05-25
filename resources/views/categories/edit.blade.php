{{-- <h1>Edit Category</h1>
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <label for="name">Category Name:</label>
    <input type="text" id="category_name" name="category_name" value="{{ $category->name }}">
    <button type="submit">Update Category</button>
</form> --}}


<x-app-layout>

    <x-slot name="header"></x-slot>
    <div class="container">



        <div class="card w-full base-100 mt-5 mb-5 border border-gray-300">
            <div class="card-title bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                <div class="flex items-center justify-between w-full">
                    <h2 class="text-bold text-xl text-white">Edit Category</h2>
                    <a href="{{ route('categories.index') }}" ><button class="h-fit min-h-fit py-2 px-4 btn btn-info text-white">Back</button></a>
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



                <form action="{{ route('categories.update', $category->id) }}" method="POST" class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="category_name" class="text-black">Category Name:</label>
                    <label class="input input-bordered bg-white flex items-center gap-2 mt-2">
                        <x-fas-layer-group class="w-4 h-4 opacity-70 text-black"/>
                        <input type="text" class="grow text-black" placeholder="Category Name" name="category_name" value="{{ $category->name }}" />
                    </label>

                    <button type="submit" class="btn btn-info btn-md bg-blue-500 text-white mt-3">Save</button>
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


