<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $no_wa;
    public $photo;
    public $current_photo;
    public $isIncomplete = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->no_wa = $user->no_wa;
        $this->current_photo = $user->profile_photo;

        // Persistent check for incomplete profile
        $isNameDefault = str_starts_with($user->name, 'User ') && strlen($user->name) <= 10;
        $isWaIncomplete = empty($user->no_wa) || strlen($user->no_wa) < 10;
        
        if (($isWaIncomplete || $isNameDefault || empty($user->name)) && !$user->hasRole('admin')) {
            $this->isIncomplete = true;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'no_wa' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $user = Auth::user();
        $data = [
            'name' => $this->name,
            'no_wa' => $this->no_wa,
        ];

        if ($this->photo) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $this->photo->store('profile-photos', 'public');
            $data['profile_photo'] = $path;
            $this->current_photo = $path;
        }

        $user->update($data);

        if (!empty($user->no_wa) && !empty($user->name) && !str_starts_with($user->name, 'User ')) {
            session()->flash('message', 'Profil berhasil dilengkapi.');
            
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.kehadiran');
            }
            
            return redirect()->route('hadir');
        }

        session()->flash('message', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        $layout = Auth::user()->role === 'admin' ? 'layouts.beranda' : 'layouts.dashboard';
        return view('livewire.profile')->layout($layout);
    }
}
