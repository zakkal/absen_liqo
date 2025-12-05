<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Kehadiran;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('layouts.beranda')]
class Grafik extends Component
{
    public $totalAnggota;
    public $hadirCount;
    public $izinSakitCount;
    public $belumAbsen;
    public $trendLabels = [];
    public $trendData = [];

    public function mount()
    {
        $today = Carbon::today();

        // 1. Total Anggota
        $this->totalAnggota = User::where('role', 'anggota')->count();

        // 2. Statistik Hari Ini
        $kehadiranHariIni = Kehadiran::whereDate('created_at', $today)->get();
        
        $this->hadirCount = $kehadiranHariIni->where('status', 'Hadir')->count();
        $this->izinSakitCount = $kehadiranHariIni->whereIn('status', ['Izin', 'Sakit'])->count();
        
        $sudahAbsenTotal = $kehadiranHariIni->count();
        $this->belumAbsen = max(0, $this->totalAnggota - $sudahAbsenTotal);

        // 3. Data Tren 7 Hari Terakhir
        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();
        
        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);
        
        foreach ($period as $date) {
            $this->trendLabels[] = $date->format('d M');
            $this->trendData[] = Kehadiran::whereDate('created_at', $date)->count();
        }
    }

    public function render()
    {
        return view('livewire.admin.grafik');
    }
}
