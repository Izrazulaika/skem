<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkemText</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #003d7f;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .school-name {
            font-size: 1.5rem;
            font-weight: bold;
        }
        nav {
            display: flex;
            gap: 15px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #FF2D20;
        }
        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .main-banner {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 40px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 800px;
        }
        .banner-text {
            text-align: center;
            margin-bottom: 20px;
        }
        .banner-text h1 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 10px;
        }
        .banner-text p {
            margin-bottom: 20px;
        }
        .banner-buttons a {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 10px;
            transition: background 0.3s ease;
        }
        .banner-buttons a:hover {
            background: #0056b3;
        }
        .swiper-container {
            width: 100%;
            max-width: 500px;
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 auto;
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .about-us {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-width: 45%;
            margin: 20px auto;
            text-align: center;
        }
        .about-us h2 {
            margin-bottom: 10px;
            color: #007bff;
        }
        .about-us p {
            margin-bottom: 5px;
        }
        .info-boxes {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .info-box {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1;
            min-width: 45%;
            box-sizing: border-box;
        }
        .info-box h3 {
            margin-bottom: 10px;
            color: #007bff;
        }
        footer {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: fixed;
            left: 0;
            bottom: 0;
            margin: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <header>
        <div class="school-name">SK KEMEDAK TEXTBOOK MANAGEMENT SYSTEM</div>
        <nav>
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register Admin</a>
                @endif
            @endauth
        </nav>
    </header>
    <div class="content">
        <div class="main-banner">
            <div class="banner-text">
                <h1>SISTEM SKEMTEXT</h1>
                <p>SKEMTEXT ialah satu sistem untuk menguruskan urusan <br> peminjaman dan pemulangan buku teks pelajar
                bagi <br> memudahkan urusan guru, pelajar dan ibubapa.</p>
            </div>
            <div class="swiper-container">
            <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="pictures/school.jpg" alt="Slide 1"></div>
                    <div class="swiper-slide"><img src="pictures/school2.jpg" alt="Slide 2"></div>
                    <div class="swiper-slide"><img src="pictures/school3.jpg" alt="Slide 3"></div>
                    <div class="swiper-slide"><img src="pictures/school4.jpg" alt="Slide 4"></div>
                    <div class="swiper-slide"><img src="pictures/school5.jpg" alt="Slide 5"></div>
                    <div class="swiper-slide"><img src="pictures/school6.jpg" alt="Slide 6"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="about-us">
        <h2>Info Sekolah</h2>
            <p>Sekolah Kebangsaan Kemedak <br> Karung Berkunci 525, 85009, Segamat, Johor</p>
            <p>+60-79371541</p>
            <p>Facebook: <a href="https://facebook.com/skkemedak.segamatjohor" target="_blank">facebook.com/skkemedak</a></p>
            <div class="info-boxes">
                <div class="info-box">
                    <h3>Visi Sekolah</h3>
                    <p>Pendidikan Berkualiti Insan Terdidik Negara Sejahtera</p>
                </div>
                <div class="info-box">
                    <h3>Misi Sekolah</h3>
                    <p>Melestarikan Sistem Pendidikan Yang Berkualiti Untuk Membangunkan Potensi
                        Individu Bagi Memenuhi Aspirasi Negara
                    </p>
                </div>
                <div class="info-box">
                    <h3>Matlamat Sekolah</h3>
                    <p>Sekolah Kebangsaan Kemedak cemerlang dari segi pengurusan pentadbirannya,
                        kurikulum, pengurusan HEM, kokurikulum dan keceriannya, seterusnya menjadikan
                        sekolah ini salah sebuah sekolah yang terunggul luar bandar serta dihormati
                        di daerah Segamat.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        SkemText &copy; 2024 All Rights Reserved
    </footer>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>
</body>
</html>
