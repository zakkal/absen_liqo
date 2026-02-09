<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Muthabaah as MuthabaahModel;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.beranda')]

class Muthabaah extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $date;
    public $search = '';
    public $filter = 'all'; // all, filled, empty

    // Recap Properties
    public $selectedUser = null;
    public $viewMode = 'list'; // list, detail
    public $rekap_mingguan = [];
    public $rekap_bulanan = [];

    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    public function selectUser($userId)
    {
        $this->selectedUser = User::with('muthabaahs')->find($userId);
        $this->viewMode = 'detail';
        $this->loadUserRekap();
    }

    public function backToList()
    {
        $this->viewMode = 'list';
        $this->selectedUser = null;
    }

    public function loadUserRekap()
    {
        if (!$this->selectedUser) return;

        $this->rekap_mingguan = MuthabaahModel::where('user_id', $this->selectedUser->id)
            ->where('date', '>=', now()->subDays(6))
            ->orderBy('date', 'desc')
            ->get();

        $this->rekap_bulanan = MuthabaahModel::where('user_id', $this->selectedUser->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->orderBy('date', 'desc')
            ->get();
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingDate() { $this->resetPage(); }
    public function updatingFilter() { $this->resetPage(); }

    public function render()
    {
        $query = User::where('name', 'like', '%' . $this->search . '%')
            ->where('role', 'anggota');

        if ($this->filter === 'filled') {
            $query->whereHas('muthabaahs', function ($q) {
                $q->where('date', $this->date);
            });
        } elseif ($this->filter === 'empty') {
            $query->whereDoesntHave('muthabaahs', function ($q) {
                $q->where('date', $this->date);
            });
        }

        $users = $query->with(['muthabaahs' => function ($query) {
                $query->where('date', $this->date);
            }])
            ->paginate(10);

        return view('livewire.admin.muthabaah', [
            'users' => $users
        ]);
    }
}
