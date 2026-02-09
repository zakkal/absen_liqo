<div class="mb-8">
    <!-- Header Dashboard -->
    

    <!-- Stats Cards Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        <!-- Card 1: Total Hadir (Blue) -->
        <div class="bg-blue-500 rounded-2xl p-4 md:p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-[10px] md:text-sm font-semibold tracking-wide uppercase mb-1 md:mb-2 text-opacity-80">HADIR</p>
                <h3 class="text-2xl md:text-4xl font-bold text-white">{{ $hadirCount }}</h3>
            </div>
            <div class="bg-white/20 rounded-xl w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                <i class="bi bi-person-check text-white text-xl md:text-2xl"></i>
            </div>
        </div>

        <!-- Card 2: Izin/Sakit (Green) -->
        <div class="bg-emerald-500 rounded-2xl p-4 md:p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-[10px] md:text-sm font-semibold tracking-wide uppercase mb-1 md:mb-2 text-opacity-80">IZIN/SAKIT</p>
                <h3 class="text-2xl md:text-4xl font-bold text-white">{{ $izinSakitCount }}</h3>
            </div>
            <div class="bg-white/20 rounded-xl w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                <i class="bi bi-envelope-open text-white text-xl md:text-2xl"></i>
            </div>
        </div>

        <!-- Card 3: Belum Absen (Red) -->
        <div class="bg-red-500 rounded-2xl p-4 md:p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-[10px] md:text-sm font-semibold tracking-wide uppercase mb-1 md:mb-2 text-opacity-80">BELUM ABSEN</p>
                <h3 class="text-2xl md:text-4xl font-bold text-white">{{ $belumAbsen }}</h3>
            </div>
            <div class="bg-white/20 rounded-xl w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                <i class="bi bi-clock-history text-white text-xl md:text-2xl"></i>
            </div>
        </div>

        <!-- Card 4: Total Anggota (Purple) -->
        <div class="bg-violet-500 rounded-2xl p-4 md:p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-[10px] md:text-sm font-semibold tracking-wide uppercase mb-1 md:mb-2 text-opacity-80">TOTAL USER</p>
                <h3 class="text-2xl md:text-4xl font-bold text-white">{{ $totalAnggota }}</h3>
            </div>
            <div class="bg-white/20 rounded-xl w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                <i class="bi bi-people text-white text-xl md:text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- 1. Online Users Section -->
    <div class="mb-8" wire:poll.15s>
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <span class="flex h-3 w-3 rounded-full bg-green-500 animate-pulse"></span>
            Anggota Online
        </h2>
        
        <div class="flex overflow-x-auto pb-4 gap-4 snap-x snap-mandatory hide-scrollbar" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>
                .hide-scrollbar::-webkit-scrollbar { display: none; }
            </style>
            
            @foreach($users as $user)
                <div class="flex-none w-32 bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center relative snap-start">
                    @if($user->isOnline())
                        <div class="absolute top-2 right-2 flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </div>
                    @else
                        <div class="absolute top-2 right-2 h-2 w-2 rounded-full bg-gray-200"></div>
                    @endif

                    <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mb-2 border-2 {{ $user->isOnline() ? 'border-green-100' : 'border-gray-50' }}">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full rounded-full object-cover">
                        @else
                            <i class="bi bi-person text-gray-400 text-xl"></i>
                        @endif
                    </div>
                    
                    <h3 class="text-[10px] font-bold text-gray-800 truncate w-full">{{ $user->name }}</h3>
                    <p class="text-[8px] text-gray-500 mt-0.5 uppercase tracking-tighter">
                        {{ $user->isOnline() ? 'Online' : ($user->last_activity ? $user->last_activity->diffForHumans() : 'Offline') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Line Chart -->
        <div class="lg:col-span-2 bg-white p-5 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-base font-bold text-gray-800 mb-4 px-1">Tren Kehadiran Mingguan</h3>
            <div id="chart-trend" wire:ignore></div>
        </div>

        <!-- Donut Chart -->
        <div class="bg-white p-5 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-base font-bold text-gray-800 mb-4 px-1">Komposisi Pekan Ini</h3>
            <div id="chart-composition" wire:ignore class="flex justify-center"></div>
        </div>
    </div>

    <script>
        var trendChart = null;
        var compositionChart = null;

        function renderCharts() {
            // Destroy existing charts to prevent duplication
            if (trendChart) trendChart.destroy();
            if (compositionChart) compositionChart.destroy();

            // Clear containers just in case
            document.querySelector("#chart-trend").innerHTML = "";
            document.querySelector("#chart-composition").innerHTML = "";

            // Trend Chart (Line/Area)
            var trendOptions = {
                series: [{ 
                    name: "Jumlah Hadir", 
                    data: @json($trendData) 
                }],
                chart: { 
                    height: 300, 
                    type: 'area', 
                    toolbar: { show: false }, 
                    zoom: { enabled: false }, 
                    fontFamily: 'Inter, sans-serif',
                    sparkline: { enabled: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 4, colors: ['#3b82f6'] },
                xaxis: { 
                    categories: @json($trendLabels),
                    labels: { style: { colors: '#94a3b8', fontSize: '11px' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: { style: { colors: '#94a3b8', fontSize: '11px' } }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    padding: { left: 10, right: 10 }
                },
                markers: {
                    size: 5,
                    colors: ['#3b82f6'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: { size: 7 }
                },
                fill: { 
                    type: "gradient", 
                    gradient: { 
                        shadeIntensity: 1, 
                        opacityFrom: 0.45, 
                        opacityTo: 0.05, 
                        stops: [0, 100] 
                    } 
                },
                tooltip: {
                    theme: 'light',
                    y: { formatter: function (val) { return val + " Anggota" } }
                }
            };
            trendChart = new ApexCharts(document.querySelector("#chart-trend"), trendOptions);
            trendChart.render();

            // Composition Chart (Donut)
            var compositionOptions = {
                series: [{{ $hadirCount }}, {{ $izinSakitCount }}, {{ $belumAbsen }}],
                labels: ['Hadir', 'Izin/Sakit', 'Belum Absen'],
                colors: ['#3b82f6', '#10b981', '#ef4444'],
                chart: { 
                    type: 'donut', 
                    height: 300, 
                    fontFamily: 'Inter, sans-serif' 
                },
                plotOptions: { 
                    pie: { 
                        donut: { 
                            size: '75%',
                            labels: {
                                show: true,
                                name: { show: true, fontSize: '14px', fontWeight: 600, color: '#64748b', offsetY: -10 },
                                value: { show: true, fontSize: '24px', fontWeight: 700, color: '#1e293b', offsetY: 16 },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: '#64748b',
                                    formatter: function (w) { return {{ $totalAnggota }} }
                                }
                            }
                        } 
                    } 
                },
                legend: { 
                    position: 'bottom',
                    fontSize: '12px',
                    fontWeight: 500,
                    labels: { colors: '#64748b' },
                    markers: { radius: 12, offsetX: -4 }
                },
                dataLabels: { enabled: false },
                stroke: { width: 0 }
            };
            compositionChart = new ApexCharts(document.querySelector("#chart-composition"), compositionOptions);
            compositionChart.render();
        }

        // Run on initial load and Livewire navigation
        document.addEventListener('livewire:navigated', renderCharts);
        document.addEventListener('DOMContentLoaded', renderCharts);

        // Run when Livewire component is updated (for wire:poll)
        document.addEventListener('livewire:init', () => {
            Livewire.on('chartUpdated', () => {
                renderCharts();
            });
        });
    </script>


</div>
