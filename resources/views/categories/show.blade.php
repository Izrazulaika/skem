<h1>Category Details</h1>
<p>Name: {{ $category->name }}</p>

<h2>Subjects</h2>
<ul>
    @foreach ($category->subjects as $subject)
        <li>{{ $subject->name }}</li>
    @endforeach
</ul>
