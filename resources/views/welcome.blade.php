<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liqo Kelapa Dua: Jembatan Ilmu & Ukhuwah (Desain Geometris)</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* -- 0. Variabel Warna dan Font Geometris -- */
        :root {
            --color-primary: #00796B; /* Hijau Toska/Tua - Aksen Utama */
            --color-secondary: #FFD700; /* Emas - Aksen Sekunder */
            --color-background-light: #F5F5F5; /* Krem / Abu-abu Terang */
            --color-text-dark: #333333; /* Teks Gelap */
            --font-sans: 'Poppins', sans-serif; /* Font Bersih Modern */
            --padding-section: 80px;
        }

        /* -- Reset & Dasar -- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            line-height: 1.6;
            background-color: white;
            color: var(--color-text-dark);
        }

        /* -- Komponen Geometris Dasar (Button) -- */
        .btn-cta {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--color-primary);
            color: white;
            text-decoration: none;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background-color 0.3s;
            /* Sudut sedikit membulat untuk modernitas, tapi tetap tegas */
            border-radius: 4px;
        }

        .btn-cta:hover {
            background-color: #004D40; /* Warna lebih gelap saat hover */
        }

        /* Pseudo-class untuk efek visual "geometris" pada tombol */
        .geometric-button {
            border: 2px solid var(--color-primary);
            position: relative;
            overflow: hidden;
        }

        /* -- 1. Navbar -- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background-color: white; /* Dasar */
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-geometric {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
        }

        .nav-links a {
            text-decoration: none;
            color: var(--color-text-dark);
            margin-left: 20px;
            padding: 5px 0;
            transition: color 0.3s, border-bottom 0.3s;
        }

        .nav-links a:hover {
            color: var(--color-primary);
            border-bottom: 2px solid var(--color-secondary); /* Garis aksen geometris */
        }

        .nav-links .btn-cta {
            margin-left: 30px;
        }

        /* -- 2. Hero Section (Penerapan Pola Geometris) -- */
        .hero-section {
            padding: var(--padding-section) 5%;
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: var(--color-background-light);
            /* Implementasi Pola Geometris Sederhana (misal: garis diagonal samar) */
            background-image: linear-gradient(135deg, var(--color-background-light) 50%, rgba(0, 0, 0, 0.05) 50%);
            background-size: 20px 20px; /* Jarak antar pola */
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--color-text-dark);
            max-width: 800px;
        }

        .hero-content .subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }

        .hero-features {
            display: flex;
            gap: 30px;
            margin-top: 50px;
        }

        /* Card Geometris pada Hero */
        .feature-card {
            padding: 20px;
            background-color: white;
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            width: 200px;
            position: relative;
            overflow: hidden;
            border: 1px solid #eee; /* Garis tegas */
        }

        .feature-card .icon {
            font-size: 2rem;
            color: var(--color-primary);
            margin-bottom: 10px;
            display: block;
        }

        /* -- 3. About & Benefits -- */
        .about-section {
            padding: var(--padding-section) 5%;
            text-align: center;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        /* Card Geometris pada Benefit */
        .benefit-card {
            padding: 30px;
            border: 2px solid var(--color-primary); /* Border tegas geometris */
            background-color: var(--color-background-light);
            border-radius: 0; /* Tanpa pembulatan untuk kesan geometris tegas */
            transition: transform 0.3s, background-color 0.3s;
            text-align: left;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .benefit-card h3 {
            color: var(--color-primary);
            margin-bottom: 10px;
        }

        /* -- 4. Schedule & Location (Penambahan CSS sederhana) -- */
        .schedule-location-section {
            padding: var(--padding-section) 5%;
            background-color: #fcfcfc;
            display: flex;
            justify-content: space-around;
            gap: 30px;
        }

        .detail-card {
            flex: 1;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* -- 6. Footer -- */
        .footer {
            padding: 20px 5%;
            background-color: var(--color-text-dark);
            color: white;
            text-align: center;
            font-size: 0.9rem;
        }

        /* -- Responsif Dasar (Mobile) -- */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px 5%;
            }

            .nav-links {
                margin-top: 10px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-links a {
                margin: 5px 10px;
            }

            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-features {
                flex-direction: column;
                gap: 15px;
            }

            .schedule-location-section {
                flex-direction: column;
            }
        }

    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo-geometric">Liqo Kelapa Dua</div>
        <nav class="nav-links">
            <a href="#about">Tentang</a>
            <a href="#schedule">Jadwal</a>
            <a href="#location">Lokasi</a>
            @auth
    @if (Auth::user()->role === 'admin')
        <a href="{{ route('admin.kehadiran') }}" class="btn-cta geometric-button">DASHBOARD</a>
    @elseif (Auth::user()->role === 'anggota')
        <a href="{{ route('hadir') }}" class="btn-cta geometric-button">DASHBOARD</a>
     @endif
        <a href="{{ route('datatemen') }}" class="btn-cta geometric-button">DASHBOARD</a>
  
@else
    <a href="{{route('register')}}" class="btn-cta geometric-button">DAFTAR SEKARANG</a>
    <a href="{{route('login')}}" class="btn-cta geometric-button">MASUK</a>
@endauth

        </nav>
    </header>

    <section id="hero" class="hero-section geometric-pattern-bg">
        <div class="hero-content">
            <h1>Liqo Kelapa Dua: Jembatan Ilmu & Ukhuwah</h1>
            <p class="subtitle">Bergabunglah dalam Majelis Ilmu Rutin di Kelapa Dua untuk memperdalam pemahaman Islam dan mempererat tali persaudaraan.</p>
            <a href="#contact" class="btn-cta primary-cta geometric-button">DAFTAR SEKARANG & HADIR</a>
        </div>
        <div class="hero-features">
            <div class="feature-card geometric-shape">
                <i class="icon">📅</i>
                <p>Rutin & Terjadwal</p>
            </div>
            <div class="feature-card geometric-shape">
                <i class="icon">📚</i>
                <p>Tema Relevan</p>
            </div>
            <div class="feature-card geometric-shape">
                <i class="icon">🤲</i>
                <p>Lingkungan Kondusif</p>
            </div>
        </div>
    </section>

    <section id="about" class="about-section">
        <h2>Kenapa Anda Harus Bergabung?</h2>
        <div class="benefits-grid">
            <div class="benefit-card geometric-shape">
                <h3>Peningkatan Ilmu</h3>
                <p>Memahami Tafsir, Fiqih, atau Sirah dari sumber yang kredibel dan sahih.</p>
            </div>
            <div class="benefit-card geometric-shape">
                <h3>Lingkar Pergaulan Saleh</h3>
                <p>Mendapatkan teman dan sahabat yang saling mendukung dalam ketaatan.</p>
            </div>
            <div class="benefit-card geometric-shape">
                <h3>Ketenangan Hati</h3>
                <p>Mengisi hati dengan Dzikrullah dan ilmu, menjauhkan dari hiruk pikuk dunia.</p>
            </div>
            <div class="benefit-card geometric-shape">
                <h3>Amal Jariyah</h3>
                <p>Setiap langkah menuju majelis ilmu dihitung sebagai amal yang dicatat.</p>
            </div>
        </div>
    </section>

    <section id="schedule" class="schedule-location-section">
        <div class="detail-card">
            <h3>Waktu Rutin</h3>
            <p>Setiap **minggu**</p>
            <p>Pukul **12.00- 03.00 WIB**</p>
            <p class="subtitle" style="margin-top: 10px;">Format: Kajian Tematik & Tanya Jawab</p>
        </div>
       
        <div class="detail-card">
            <h3>Pemateri</h3>
            <p>**Ustadz [Ustadz fadli]**</p>
            <p>Pengasuh Liqo Rutin & Praktisi Fiqih</p>
        </div>
    </section>

    <footer id="contact" class="footer">
        <p>Hubungi Kami: WA [085810544838] | IG: @LiqoKelapaDua</p>
        <p style="margin-top: 5px;">&copy; 2025 Liqo Kelapa Dua. Dikelola oleh Komunitas [liqo kelapa dua]</p>
    </footer>

</body>
</html>