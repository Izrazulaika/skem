<h2>Subjects</h2>

<!-- View Subjects -->
@if (count($subjects) > 0)
    <table>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->category->name }}</td>
                <td>
                    <a href="{{ route('subjects.edit', $subject->id) }}">Edit</a>
                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endif

<!-- Add Subject Form -->
<form action="{{ route('subjects.store') }}" method="POST">
    @csrf
    <label for="subject_name">Subject Name:</label>
    <input type="text" id="subject_name" name="subject_name">

    <label for="category_id">Category:</label>
    <select id="category_id" name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <button type="submit">Add Subject</button>
</form>
