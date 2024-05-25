<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkemText</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'figtree', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #FFFFED;
        }
        header {
            background-color: #ffffff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between; /* Center horizontally */
            align-items: center; /* Center vertically */
        }
        .school-name {
            font-size: 2.0rem;
            font-weight: bold;
            color: #333333;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: flex-end;
        }
        nav a {
            margin-left: 15px;
            color: #333333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #FF2D20;
        }
        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        footer {
            background-color: #333333;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .system-info {
            margin-top: 20px;
            text-align: center;
        }
        .system-info img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            max-height: 500px;
        }
    </style>
</head>
<body>
    <header>
        <div class="school-name">SKEMTMS</div>
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
    <div class="content">
        <!-- Placeholder image and system explanation -->
        <div class="system-info">
            <img src="pictures/school.jpg" alt="Sekolah">
            <p>SKEMTEXT ialah satu sistem untuk menguruskan urusan peminjaman dan pemulangan buku teks pelajar</p>
        </div>
    </div>
    <footer>
        SkemText &copy; 2024 All Rights Reserved
    </footer>
</body>
</html>
