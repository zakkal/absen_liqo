<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">
    @livewireStyles
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo ">
                            <a href="index.html"><img class="w-[190px] h-auto pr-[55%] pt-[0px]" src="data:image/png;base64,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" alt="Logo" srcset=""></a>
                       <div class="logo text-black fw-bold text-lg">
                          Halo, {{ Auth::user()->name }}
                             </div>

                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title pt-2">Menu</li>
{{-- 
                        <li class="sidebar-item {{request()->routeIs('grafik') ? 'active' : ''}}">
                            <a href="{{route('grafik')}}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Grafik</span>
                            </a> --}}

                        <li class="sidebar-item {{request()->routeIs('admin.kehadiran') ? 'active' : ''}}">
                            <a href="{{route('admin.kehadiran')}}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>

                                <span>Data Murid</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{request()->routeIs('pengumuman') ? 'active' : ''}}">
                            <a href="{{route('pengumuman')}}" class='sidebar-link'>
                                  <i class="bi bi-megaphone"></i>

                                <span>Pengumuman</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{request()->routeIs('admin.petugas') ? 'active' : ''}}">
                            <a href="{{route('admin.petugas')}}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Petugas</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <livewire:admin.logout />
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
                <p class="text-end">created by zakkal❤️</p>
                {{ $slot ?? '' }}
                @yield('content')
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