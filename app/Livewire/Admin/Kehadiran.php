<?php

namespace App\Livewire\Admin;
use App\Models\Kehadiran as KehadiranModel;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.beranda')]

class Kehadiran extends Component
{
    public $kehadirans;

    // Untuk modal edit
    public $editId, $nama, $status;

    // Untuk modal delete
    public $deleteId;

   public function mount (){
    if (!Auth::check()) {
        return redirect()->route ('login');
    }
$this -> kehadirans = kehadiranModel::latest()->get();

       
   }

    // 🔹 Buka modal edit
    public function openEdit($id)
    {
        $data = KehadiranModel::find($id);

        $this->editId = $data->id;
        $this->nama   = $data->nama;
        $this->status = $data->status;
    }

    // 🔹 Update data
    public function update()
    {
        $this->validate([
            'nama'   => 'required',
            'status' => 'required',
        ]);

        KehadiranModel::where('id', $this->editId)->update([
            'nama'   => $this->nama,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Data updated successfully.');
        return redirect()->route('admin.kehadiran');
    }


    // 🔹 Buka modal delete
    public function openDelete($id)
    {
        $this->deleteId = $id;
    }

    // 🔹 Hapus data
    public function delete()
    {
        KehadiranModel::where('id', $this->deleteId)->delete();

        session()->flash('success', 'Data deleted successfully.');
        return redirect()->route('admin.kehadiran');
    }


    public function render()
    {
        return view('livewire.admin.kehadiran', [
            'kehadirans' => $this->kehadirans,
        ]);
    }
}