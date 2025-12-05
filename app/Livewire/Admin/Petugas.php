<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Petugas as ModelsPetugas;
use Livewire\Attributes\Layout;

#[Layout('layouts.beranda')]
class Petugas extends Component
{
    public $pembukaan, $tilawah, $kultum, $materi, $diskusi, $qodoya, $doa_penutup;
    public $editId = null;
    public $deleteId = null;
    public $showCreate = false;

    protected $rules = [
        'pembukaan' => 'required|string|max:255',
        'tilawah' => 'required|string|max:255',
        'kultum' => 'required|string|max:255',
        'materi' => 'required|string|max:255',
        'diskusi' => 'required|string|max:255',
        'qodoya' => 'required|string|max:255',
        'doa_penutup' => 'required|string|max:255',
    ];

    public function render()
    {
        $petugas = ModelsPetugas::latest()->get();
        
        return view('livewire.admin.petugas', [
            'petugas' => $petugas
        ]);
    }

    public function create()
    {
        $this->validate();

        ModelsPetugas::create([
            'pembukaan' => $this->pembukaan,
            'tilawah' => $this->tilawah,
            'kultum' => $this->kultum,
            'materi' => $this->materi,
            'diskusi' => $this->diskusi,
            'qodoya' => $this->qodoya,
            'doa_penutup' => $this->doa_penutup,
        ]);

        $this->reset(['pembukaan', 'tilawah', 'kultum', 'materi', 'diskusi', 'qodoya', 'doa_penutup', 'showCreate']);
        session()->flash('success', 'Data petugas berhasil ditambahkan!');
    }

    public function openEdit($id)
    {
        $petugas = ModelsPetugas::findOrFail($id);
        
        $this->editId = $id;
        $this->pembukaan = $petugas->pembukaan;
        $this->tilawah = $petugas->tilawah;
        $this->kultum = $petugas->kultum;
        $this->materi = $petugas->materi;
        $this->diskusi = $petugas->diskusi;
        $this->qodoya = $petugas->qodoya;
        $this->doa_penutup = $petugas->doa_penutup;
    }

    public function update()
    {
        $this->validate();

        $petugas = ModelsPetugas::findOrFail($this->editId);
        $petugas->update([
            'pembukaan' => $this->pembukaan,
            'tilawah' => $this->tilawah,
            'kultum' => $this->kultum,
            'materi' => $this->materi,
            'diskusi' => $this->diskusi,
            'qodoya' => $this->qodoya,
            'doa_penutup' => $this->doa_penutup,
        ]);

        $this->reset(['pembukaan', 'tilawah', 'kultum', 'materi', 'diskusi', 'qodoya', 'doa_penutup', 'editId']);
        session()->flash('success', 'Data petugas berhasil diperbarui!');
    }

    public function openDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        ModelsPetugas::findOrFail($this->deleteId)->delete();
        
        $this->reset('deleteId');
        session()->flash('success', 'Data petugas berhasil dihapus!');
    }
}
