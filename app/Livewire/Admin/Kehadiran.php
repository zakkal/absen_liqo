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
      
        $this->status = $data->status;
    }

    // 🔹 Update data
    public function update()
    {
        KehadiranModel::where('id', $this->editId)->update([
            'nama'   => $this->nama,
            'status' => $this->status,
        ]);

        $this->mount(); // refresh
return redirect()->route('admin.kehadiran');
        session()->flash('success', 'Data updated successfully.');
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

        $this->mount(); // refresh

        session()->flash('success', 'Data deleted successfully.');
        return redirect()->route('admin.kehadiran')->with('succsess, data berhasil di tambahkan');
    }


    public function render()
    {
        return view('livewire.admin.kehadiran', [
            'kehadirans' => $this->kehadirans,
        ]);
    }
}