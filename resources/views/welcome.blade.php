<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liqo Kelapa Dua - Jembatan Ilmu & Ukhuwah</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tailwind CSS (via CDN for rapid development) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00796B',
                        secondary: '#FFD700',
                        dark: '#1e293b',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        html { scroll-behavior: smooth; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#00796B 0.5px, transparent 0.5px), radial-gradient(#00796B 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.05;
        }

        .btn-premium {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 121, 107, 0.3);
        }

        .card-premium {
            transition: all 0.4s ease;
        }
        .card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 text-dark font-sans">

    <!-- Navbar -->
    <nav class="glass-nav fixed top-0 w-full z-[1000] px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg transform rotate-3">
                    <svg width="24" height="24" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 40L50 25L75 40V65L50 80L25 65V40Z" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M50 25V80" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-primary">Liqo Kelapa Dua</span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#about" class="text-sm font-semibold hover:text-primary transition-colors">Tentang</a>
                <a href="#schedule" class="text-sm font-semibold hover:text-primary transition-colors">Jadwal</a>
                <a href="#location" class="text-sm font-semibold hover:text-primary transition-colors">Lokasi</a>
                
                @auth
                    <!-- Single Balanced Dashboard Button -->
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.kehadiran') }}" class="bg-primary text-white px-6 py-2.5 rounded-full font-bold text-sm btn-premium flex items-center gap-2">
                             <i class="bi bi-grid-fill"></i> DASHBOARD ADMIN
                        </a>
                    @else
                        <a href="{{ route('hadir') }}" class="bg-primary text-white px-6 py-2.5 rounded-full font-bold text-sm btn-premium flex items-center gap-2">
                            <i class="bi bi-person-badge"></i> DASHBOARD ANGGOTA
                        </a>
                    @endif
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-primary hover:opacity-80 transition-opacity">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-md btn-premium">
                             Daftar Sekarang
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="md:hidden text-2xl" onclick="toggleMobileMenu()">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden fixed inset-0 bg-white z-[2000] p-8 flex flex-col gap-6">
        <div class="flex justify-between items-center mb-4">
             <span class="text-xl font-bold text-primary">Menu</span>
             <button onclick="toggleMobileMenu()" class="text-3xl"><i class="bi bi-x"></i></button>
        </div>
        <a href="#about" onclick="toggleMobileMenu()" class="text-2xl font-bold">Tentang</a>
        <a href="#schedule" onclick="toggleMobileMenu()" class="text-2xl font-bold">Jadwal</a>
        <a href="#location" onclick="toggleMobileMenu()" class="text-2xl font-bold">Lokasi</a>
        <hr>
        @auth
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.kehadiran') }}" class="bg-primary text-white p-4 rounded-2xl text-center font-bold">DASHBOARD ADMIN</a>
            @else
                <a href="{{ route('hadir') }}" class="bg-primary text-white p-4 rounded-2xl text-center font-bold">DASHBOARD ANGGOTA</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="text-center font-bold text-primary text-lg">Masuk</a>
            <a href="{{ route('register') }}" class="bg-primary text-white p-4 rounded-2xl text-center font-bold">Daftar Sekarang</a>
        @endauth
    </div>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 px-6 overflow-hidden">
        <div class="hero-pattern absolute inset-0 -z-10"></div>
        
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-full border border-emerald-100 animate-bounce">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    <span class="text-emerald-700 text-xs font-bold tracking-wider uppercase">Majelis Ilmu & Ukhuwah</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-slate-900 tracking-tight">
                    Jembatan <span class="text-primary">Ilmu</span> & <br>
                    Tali <span class="text-primary italic">Persaudaraan</span>
                </h1>
                
                <p class="text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Bergabunglah dalam Majelis Ilmu Rutin di Kelapa Dua untuk memperdalam pemahaman Islam dan mempererat tali persaudaraan dalam lingkungan yang kondusif.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.kehadiran') : route('hadir') }}" class="bg-primary text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:shadow-primary/30 transition-all btn-premium text-center">
                            Masuk Ke Dashboard <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:shadow-primary/30 transition-all btn-premium text-center">
                            Gabung Sekarang <i class="bi bi-plus-lg ms-2"></i>
                        </a>
                    @endauth
                    <a href="#schedule" class="bg-white text-slate-900 border border-slate-200 px-8 py-4 rounded-2xl font-bold hover:bg-slate-50 transition-all text-center">
                        Lihat Jadwal
                    </a>
                </div>

                <!-- Stats -->
                <div class="flex justify-center lg:justify-start gap-12 pt-8">
                    <div>
                        <h4 class="text-2xl font-extrabold text-primary">Rutin</h4>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Sertiap Minggu</p>
                    </div>
                    <div class="border-l border-slate-200 pl-12 text-left">
                        <h4 class="text-2xl font-extrabold text-primary">30+</h4>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Anggota Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Hero Illustration / Image Area -->
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4 pt-12">
                        <div class="bg-white p-4 rounded-3xl shadow-xl card-premium border border-slate-100">
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-4">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Waktu</p>
                            <h4 class="font-bold text-slate-800">Setiap Minggu</h4>
                        </div>
                        <div class="bg-primary p-6 rounded-3xl shadow-2xl card-premium text-white transform -rotate-3">
                             <div class="flex items-center gap-4 mb-4">
                                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p class="text-xs font-bold uppercase tracking-widest opacity-80">Motivasi</p>
                             </div>
                             <p class="text-lg font-medium leading-snug">"Sebaik-baik kalian adalah yang mempelajari Al-Qur'an dan mengajarkannya."</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-3xl shadow-xl card-premium border border-slate-100 transform rotate-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 bg-emerald-500 rounded-full animate-pulse"></div>
                                <span class="font-bold text-slate-800">Sedang Berlangsung</span>
                            </div>
                            <p class="text-sm text-slate-500">Majelis ilmu bersama Ustadz Fadli dimulai pukul 12.00 WIB.</p>
                        </div>
                        <div class="bg-amber-400 p-6 rounded-3xl shadow-xl card-premium">
                            <div class="w-12 h-12 bg-white/30 text-white rounded-2xl flex items-center justify-center text-2xl mb-4">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <p class="text-xs font-bold text-amber-900 uppercase tracking-widest">Lokasi</p>
                            <h4 class="font-bold text-amber-900">Masjid Kelapa Dua</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About / Benefits Section -->
    <section id="about" class="py-24 px-6 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">Kenapa Harus Bergabung?</h2>
            <p class="text-slate-500 max-w-2xl mx-auto font-medium">Banyak keutamaan yang bisa didapatkan saat kita melangkahkan kaki ke majelis ilmu.</p>
        </div>

        <div class="max-w-7xl mx-auto grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-gray-50 p-8 rounded-[32px] border border-slate-100 card-premium">
                <div class="w-14 h-14 bg-primary text-white rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-lg">
                    <i class="bi bi-journal-check"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Peningkatan Ilmu</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Memahami Tafsir, Fiqih, atau Sirah dari sumber yang kredibel dan sahih.</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-gray-50 p-8 rounded-[32px] border border-slate-100 card-premium">
                <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-lg">
                    <i class="bi bi-people"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Ukhuwah Islamiyah</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Mendapatkan teman dan sahabat yang saling mendukung dalam ketaatan.</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-gray-50 p-8 rounded-[32px] border border-slate-100 card-premium">
                <div class="w-14 h-14 bg-blue-500 text-white rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-lg">
                    <i class="bi bi-brightness-high"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Ketenangan Hati</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Mengisi hati dengan Dzikrullah dan ilmu, menjauhkan dari hiruk pikuk dunia.</p>
            </div>
            <!-- Card 4 -->
            <div class="bg-gray-50 p-8 rounded-[32px] border border-slate-100 card-premium">
                <div class="w-14 h-14 bg-amber-500 text-white rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-lg">
                    <i class="bi bi-award"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Amal Jariyah</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Setiap langkah menuju majelis ilmu dihitung sebagai amal yang dicatat.</p>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section id="schedule" class="py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-primary rounded-[40px] p-8 md:p-16 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                
                <div class="grid md:grid-cols-2 gap-12 relative z-10">
                    <div>
                        <span class="bg-white/20 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6 inline-block">Jadwal & Agenda</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-8 gap-2 flex items-center">
                            Waktu Rutin 
                        </h2>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-lg">Setiap Minggu</p>
                                    <p class="text-white/70 text-sm">Update rutin setiap hari libur</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-lg">12.00 - 15.00 WIB</p>
                                    <p class="text-white/70 text-sm">Kajian Tematik & Tanya Jawab</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                        <i class="bi bi-person-circle text-4xl mb-4 block"></i>
                        <h4 class="text-2xl font-bold mb-1">Ustadz Fadli</h4>
                        <p class="text-white/60 mb-6 font-medium tracking-wide">Pengasuh Liqo & Praktisi Fiqih</p>
                        <p class="text-sm italic leading-relaxed">"Ilmu itu ibarat binatang buruan, dan tulisan adalah pengikatnya. Maka ikatlah buruanmu dengan tali yang kuat."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple Footer -->
    <footer id="location" class="bg-slate-900 py-16 px-6 text-white text-center">
        <div class="max-w-7xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row justify-center items-center gap-8 mb-4">
                <a href="https://wa.me/085810544838" target="_blank" class="flex items-center gap-3 text-white/80 hover:text-white transition-colors">
                    <i class="bi bi-whatsapp text-2xl"></i>
                    <span class="font-bold">0858-1054-4838</span>
                </a>
                <a href="#" class="flex items-center gap-3 text-white/80 hover:text-white transition-colors">
                    <i class="bi bi-instagram text-2xl"></i>
                    <span class="font-bold">@LiqoKelapaDua</span>
                </a>
            </div>
            <div class="w-20 h-1 bg-primary/30 mx-auto rounded-full"></div>
            <p class="text-white/40 text-sm">
                &copy; 2025 Liqo Kelapa Dua. Dikelola oleh Komunitas Peduli Ilmu.<br>
                <span class="mt-4 block font-bold text-[10px] tracking-widest uppercase">Created by Zakkal ❤️</span>
            </p>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>