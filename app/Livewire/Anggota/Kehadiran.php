<?php

namespace App\Livewire\Anggota;

use App\Models\Kehadiran as ModelsKehadiran;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.dashboard')]
class Kehadiran extends Component
{
    public $nama;
    public $status;
    public $keterangan;

    public $kehadirans = [];

    public function render()
    {
        // AMBIL HANYA DATA MILIK USER YANG LOGIN
        $this->kehadirans = ModelsKehadiran::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.anggota.kehadiran');
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // SIMPAN DATA DENGAN user_id
        ModelsKehadiran::create([
            'nama' => $this->nama,
            'status' => $this->status,
            'keterangan' => $this->keterangan ?? '',
            'user_id' => Auth::id()  // <-- WAJIB kalau mau filter per user
        ]);

        $this->reset(['nama', 'status', 'keterangan']);

        session()->flash('success', 'Data kehadiran berhasil disimpan!');
    }
}
