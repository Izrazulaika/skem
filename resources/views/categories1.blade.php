<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f7f7f7;
            font-weight: bold;
            color: #555;
        }
        .button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .success-message {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error-message {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 10px;
        }
        /* Header Style */
        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .school-name {
            font-size: 2.0rem;
            font-weight: bold;
            color: #fff;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: flex-end;
        }
        nav a {
            margin-left: 15px;
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #FF2D20;
        }
        /* Footer Style */
        footer {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<header>
        <div class="school-name">SKEMTEXT</div>
        <nav>
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </nav>
    </header>
        <div class="container">
            <h2>Categories</h2>

            <!-- View Categories -->
            @if (count($categories) > 0)
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.index') }}" class="button">View</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="button">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>No categories found.</p>
            @endif

            <!-- Add Category Form -->
            <form action="{{ route('categories.store') }}" method="POST" class="form-group">
                @csrf
                <label for="category_name" class="form-label">Category Name:</label>
                <input type="text" id="category_name" name="category_name" class="form-input">
                @error('category_name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <button type="submit" class="button mt-2">Add Category</button>
            </form>

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif
        </div>
    <footer>
        SkemText &copy; 2024 All Rights Reserved
    </footer>
</body>
</html>
