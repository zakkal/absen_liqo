<div class="mb-8">
    <!-- Header Dashboard -->
    

    <!-- Stats Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Total Hadir (Blue) -->
        <div class="bg-blue-500 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-sm font-semibold tracking-wide uppercase mb-2">TOTAL HADIR</p>
                <h3 class="text-4xl font-bold text-white">{{ $hadirCount }}</h3>
            </div>
            <div class="bg-white rounded-2xl w-12 h-12 shadow-sm"></div>
        </div>

        <!-- Card 2: Izin/Sakit (Green) -->
        <div class="bg-emerald-500 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-sm font-semibold tracking-wide uppercase mb-2">TOTAL IZIN/SAKIT</p>
                <h3 class="text-4xl font-bold text-white">{{ $izinSakitCount }}</h3>
            </div>
            <div class="bg-white rounded-2xl w-12 h-12 shadow-sm"></div>
        </div>

        <!-- Card 3: Belum Absen (Red) -->
        <div class="bg-red-500 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-sm font-semibold tracking-wide uppercase mb-2">TOTAL BELUM ABSEN</p>
                <h3 class="text-4xl font-bold text-white">{{ $belumAbsen }}</h3>
            </div>
            <div class="bg-white rounded-2xl w-12 h-12 shadow-sm"></div>
        </div>

        <!-- Card 4: Total Anggota (Purple) -->
        <div class="bg-violet-500 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-white text-sm font-semibold tracking-wide uppercase mb-2">TOTAL ANGGOTA</p>
                <h3 class="text-4xl font-bold text-white">{{ $totalAnggota }}</h3>
            </div>
            <div class="bg-white rounded-2xl w-12 h-12 shadow-sm"></div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Line Chart: Tren Kehadiran -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-800">Tren Kehadiran</h3>
                <p class="text-sm text-gray-500">Jumlah kehadiran dalam 7 hari terakhir</p>
            </div>
            <div id="chart-trend"></div>
        </div>

        <!-- Donut Chart: Komposisi Hari Ini -->
        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-800">Komposisi Hari Ini</h3>
                <p class="text-sm text-gray-500">Persentase status kehadiran</p>
            </div>
            <div id="chart-composition" class="flex justify-center"></div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // 1. Line Chart (Tren)
            var trendOptions = {
                series: [{
                    name: "Jumlah Hadir",
                    data: @json($trendData)
                }],
                chart: {
                    height: 300,
                    type: 'area', // Area chart looks nicer
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                    zoom: { enabled: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: @json($trendLabels),
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { show: true },
                grid: {
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } }, 
                    xaxis: { lines: { show: false } },
                    padding: { top: 0, right: 0, bottom: 0, left: 10 }
                },
                colors: ['#3b82f6'], // Blue
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                tooltip: {
                    y: { formatter: function (val) { return val + " Anggota" } }
                }
            };
            var trendChart = new ApexCharts(document.querySelector("#chart-trend"), trendOptions);
            trendChart.render();

            // 2. Donut Chart (Komposisi)
            var compositionOptions = {
                series: [{{ $hadirCount }}, {{ $izinSakitCount }}, {{ $belumAbsen }}],
                labels: ['Hadir', 'Izin/Sakit', 'Belum Absen'],
                colors: ['#3b82f6', '#10b981', '#ef4444'], // Blue, Green, Red
                chart: {
                    type: 'donut',
                    height: 320,
                    fontFamily: 'Inter, sans-serif'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function (w) {
                                        return {{ $totalAnggota }};
                                    }
                                }
                            }
                        }
                    }
                },
                legend: { position: 'bottom' },
                dataLabels: { enabled: false },
                stroke: { show: false }
            };
            var compositionChart = new ApexCharts(document.querySelector("#chart-composition"), compositionOptions);
            compositionChart.render();
        });
    </script>
</div>
