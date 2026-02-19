<?php

namespace App\Livewire\Anggota;

use App\Models\Informasi;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Pengumuman extends Component
{
    public function render()
    {
        $pengumumans = Informasi::where('is_active', true)
            ->latest()
            ->get();

        return view('livewire.anggota.pengumuman', [
            'pengumumans' => $pengumumans,
        ]);
    }
}
