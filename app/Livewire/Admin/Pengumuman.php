<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Informasi;
use Livewire\Attributes\Layout;

#[Layout('layouts.beranda')]
class Pengumuman extends Component
{
    public $judul, $isi, $is_active = true;
    public $editId = null;
    public $deleteId = null;
    public $showCreate = false;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'is_active' => 'boolean',
    ];

    public function render()
    {
        $informasi = Informasi::latest()->get();
        
        return view('livewire.admin.pengumuman', [
            'informasi' => $informasi
        ]);
    }

    public function create()
    {
        $this->validate();

        Informasi::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
            'is_active' => $this->is_active,
        ]);

        $this->reset(['judul', 'isi', 'is_active', 'showCreate']);
        session()->flash('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function openEdit($id)
    {
        $info = Informasi::findOrFail($id);
        
        $this->editId = $id;
        $this->judul = $info->judul;
        $this->isi = $info->isi;
        $this->is_active = $info->is_active;
    }

    public function update()
    {
        $this->validate();

        $info = Informasi::findOrFail($this->editId);
        $info->update([
            'judul' => $this->judul,
            'isi' => $this->isi,
            'is_active' => $this->is_active,
        ]);

        $this->reset(['judul', 'isi', 'is_active', 'editId']);
        session()->flash('success', 'Pengumuman berhasil diperbarui!');
    }

    public function openDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        Informasi::findOrFail($this->deleteId)->delete();
        
        $this->reset('deleteId');
        session()->flash('success', 'Pengumuman berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $info = Informasi::findOrFail($id);
        $info->is_active = !$info->is_active;
        $info->save();
    }
}
