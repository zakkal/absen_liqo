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
    public $users = [];

    public function mount()
    {
        $this->users = User::all();

        // Tentukan hari Jumat terakhir (atau hari ini jika Jumat)
        $today = Carbon::today();
        if ($today->isFriday()) {
            $latestFriday = $today;
        } else {
            $latestFriday = $today->previous(Carbon::FRIDAY);
        }

        // 1. Total Anggota
        $this->totalAnggota = User::where('role', 'anggota')->count();

        // 2. Statistik Jumat Terakhir
        $kehadiranLatest = Kehadiran::whereDate('created_at', $latestFriday)->get();
        
        $this->hadirCount = $kehadiranLatest->where('status', 'Hadir')->count();
        $this->izinSakitCount = $kehadiranLatest->whereIn('status', ['Izin', 'Sakit'])->count();
        
        $sudahAbsenTotal = $kehadiranLatest->count();
        $this->belumAbsen = max(0, $this->totalAnggota - $sudahAbsenTotal);

        // 3. Data Tren 5 Jumat Terakhir
        $this->trendLabels = [];
        $this->trendData = [];
        
        // Loop 5 minggu ke belakang
        for ($i = 4; $i >= 0; $i--) {
            $date = $latestFriday->copy()->subWeeks($i);
            $this->trendLabels[] = $date->format('d M');
            // Menghitung jumlah yang 'Hadir' pada tanggal tersebut
            $this->trendData[] = Kehadiran::whereDate('created_at', $date)
                                          ->where('status', 'Hadir')
                                          ->count();
        }
    }

    public function render()
    {
        return view('livewire.admin.grafik');
    }
}
