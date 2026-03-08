<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; }
        h1, h2, h3, h4, h5, h6, .sidebar-link, .menu-title { font-family: 'Plus Jakarta Sans', sans-serif !important; font-weight: 700 !important; }
        
        /* Emerald Theme Overrides */
        .sidebar-wrapper .menu .sidebar-item.active > .sidebar-link {
            background-color: #00796B !important;
            box-shadow: 0 4px 12px rgba(0, 121, 107, 0.25) !important;
        }
        .btn-primary { background-color: #00796B !important; border-color: #00796B !important; }
        .btn-primary:hover { background-color: #004D40 !important; border-color: #004D40 !important; }
        .badge.bg-light-primary { background-color: #e0f2f1 !important; color: #00796B !important; }
        .text-primary { color: #00796B !important; }
        .sidebar-wrapper .menu .sidebar-link i { color: #00796B; }
        .sidebar-wrapper .menu .sidebar-item.active .sidebar-link i { color: #fff !important; }
        
        /* Smoother Sidebar */
        .sidebar-wrapper { border-right: 1px solid #f1f5f9; }
        .sidebar-title { font-size: 0.7rem !important; letter-spacing: 1px; color: #94a3b8 !important; text-transform: uppercase; }

        .profile-card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .profile-card-hover:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0, 121, 107, 0.15) !important; }
    </style>
    @livewireStyles
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active shadow-xl" style="background: white; z-index: 9999;">

                <div class="sidebar-header" style="padding: 1.25rem 1.5rem 0.5rem;">
                    <!-- Mobile View Header & Toggler -->
                    <div class="d-flex justify-content-between align-items-center mb-3 d-xl-none">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-shaded" style="color: #00796B; font-size: 1.4rem;"></i>
                            <span class="fw-bolder" style="color: #00796B; font-size: 1.1rem; letter-spacing: 0.5px;">HALAQAH</span>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-block text-dark fs-4"><i class="bi bi-x-circle-fill"></i></a>
                        </div>
                    </div>
                    
                    <!-- Profile Section -->
                    <a href="{{ route('profile') }}" class="d-flex align-items-center text-decoration-none mt-xl-0 mt-2">
                        <div class="flex-shrink-0 me-3">
                            @if(Auth::user()->profile_photo)
                                <div class="rounded-circle overflow-hidden d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border: 2px solid #00796B; padding: 2px; background-color: white;">
                                    <img class="rounded-circle d-block" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                </div>
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #00796B; color: white;">
                                    <i class="bi bi-person-fill fs-3"></i>
                                </div>
                            @endif
                        </div>
                        <div class="overflow-hidden w-100">
                            <h6 class="fw-bold mb-1 text-dark text-truncate" style="font-size: 0.95rem; line-height: 1.2;">{{ Auth::user()->name }}</h6>
                            <div class="d-flex align-items-center mt-1">
                                <span class="badge rounded-pill" style="background-color: #e0f2f1; color: #00796B; font-size: 0.65rem; font-weight: 600; padding: 0.35em 0.6em;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 5px; color: #10b981; vertical-align: middle;"></i> LIQO KELAPA DUA
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="sidebar-menu" style="margin-top: 0.5rem;">
                    <ul class="menu" style="margin-top: 0;">
                        <li class="sidebar-title" style="margin-top: 0.5rem;">Menu</li>


                        <li class="sidebar-item {{ (request()->routeIs('hadir') || request()->routeIs('admin.kehadiran')) ? 'active' : '' }}">
                            <a href="{{ Auth::user()->role === 'admin' ? route('admin.kehadiran') : route('hadir') }}" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>Absen</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{request()->routeIs('datatemen') ? 'active' : ''}}">
                            <a href="{{route('datatemen')}}" class='sidebar-link'>
                                  <i class="bi bi-people-fill"></i>
                                <span>Data Teman</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ (request()->routeIs('umum') || request()->routeIs('pengumuman')) ? 'active' : '' }}">
                            <a href="{{ Auth::user()->role === 'admin' ? route('pengumuman') : route('umum') }}" class='sidebar-link'>
                               <i class="bi bi-megaphone"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ (request()->routeIs('tugas') || request()->routeIs('admin.petugas')) ? 'active' : '' }}">
                            <a href="{{ Auth::user()->role === 'admin' ? route('admin.petugas') : route('tugas') }}" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Petugas</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ (request()->routeIs('anggota.muthabaah') || request()->routeIs('admin.muthabaah')) ? 'active' : '' }}">
                            <a href="{{ Auth::user()->role === 'admin' ? route('admin.muthabaah') : route('anggota.muthabaah') }}" class='sidebar-link'>
                                <i class="bi bi-calendar-check-fill"></i>
                                <span>Muthaba'ah</span>
                            </a>
                        </li>

                        <li class="sidebar-title" style="margin-top: 0.5rem;">Akun</li>
                        <li class="sidebar-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <a href="{{ route('profile') }}" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <livewire:admin.logout />
                            @else
                                <livewire:anggota.logout />
                            @endif
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                @hasSection ('title')
                    <h3>@yield('title')</h3>
                @endif
            </div>

            <div class="page-content">
                {{ $slot ?? '' }}
                @yield('content')
                <p class="text-end mt-4 text-muted small">created by zakkal❤️</p>
            </div>

        </div>
    </div>
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    @livewireScripts
</body>

</html>