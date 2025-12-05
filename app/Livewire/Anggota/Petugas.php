<?php

namespace App\Livewire\Anggota;

use App\Models\Petugas as PetugasModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.dashboard')]
class Petugas extends Component
{
    public $petugas;
    public function render()
    {
        return view('livewire.anggota.petugas');
    }

    public function mount()
    {
        $this->petugas = PetugasModel::latest()->get();
    }
}
