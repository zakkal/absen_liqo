<?php

namespace App\Livewire\Anggota;

use App\Models\Informasi;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Pengumuman extends Component
{
    public $pengumumans;

    public function mount() 
    {
        $this->pengumumans = Informasi::latest()->get();
    }

    public function render()
    {
        return view('livewire.anggota.pengumuman');
    }
}
