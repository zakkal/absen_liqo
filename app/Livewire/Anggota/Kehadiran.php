<?php

namespace App\Livewire\Anggota;

use App\Models\Kehadiran as ModelsKehadiran;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.dashboard')]
class Kehadiran extends Component
{
    public $status;
    public $keterangan;
    public $alreadySubmitted = false;
public $user;
    public $kehadirans = [];

    public function mount()
    {
        $this->checkStatus();
    }

    public function checkStatus()
    {
        $this->alreadySubmitted = ModelsKehadiran::where('user_id', Auth::id())
            ->whereDate('created_at', now()->toDateString())
            ->exists();
    }

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
        $this->checkStatus();

        if ($this->alreadySubmitted) {
            session()->flash('error', 'Anda sudah mengisi kehadiran hari ini.');
            return;
        }

        $this->validate([
            'status' => 'required',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // SIMPAN DATA DENGAN user_id
        ModelsKehadiran::create([
            'nama' => Auth::user()->name,
            'status' => $this->status,
            'keterangan' => $this->keterangan ?? '',
            'user_id' => Auth::id()
        ]);

        session()->flash('success', 'Data kehadiran berhasil disimpan!');
        
        $this->checkStatus();
        $this->reset(['status', 'keterangan']);

        return redirect()->route('hadir'); // Stay on page to see success/status
    }
}


