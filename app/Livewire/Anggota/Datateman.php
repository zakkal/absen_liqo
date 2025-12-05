<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use App\Models\Kehadiran;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Datateman extends Component
{
    public $kehadirans;
    // public $totalTeman;
    // public $totalHadir;
    // public $totalIzin;
    // public $totalSakit;
    
    public function render()
    {
        return view('livewire.anggota.datateman');
    }

    public function mount(){
        $this->kehadirans = Kehadiran::latest()->get();
        // $this->totalTeman = $this->kehadirans->count();
        // $this->totalHadir = $this->kehadirans->where('status', 'Hadir')->count();
        // $this->totalIzin = $this->kehadirans->where('status', 'Izin')->count();
        // $this->totalSakit = $this->kehadirans->where('status', 'Sakit')->count();
    }
}
