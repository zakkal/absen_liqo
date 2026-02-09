<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use App\Models\Kehadiran;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Datateman extends Component
{
    public $kehadirans;
    public $users;
    
    public function render()
    {
        return view('livewire.anggota.datateman');
    }

    public function mount(){
        $this->kehadirans = Kehadiran::with('user')->latest()->get();
        $this->users = \App\Models\User::all();
    }


}
