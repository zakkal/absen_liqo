<?php

namespace App\Livewire\Anggota;

use Livewire\Component;

use App\Models\Muthabaah as MuthabaahModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Muthabaah extends Component
{
    public $date;
    
    // Checkboxes
    public $sholat_dhuha = false;
    public $sholat_tahajud = false;
    public $murojaah = false;
    
    public $q_shubuh = false;
    public $q_zuhur = false;
    public $q_ashar = false;
    public $q_maghrib = false;
    public $q_isya = false;
    
    public $b_zuhur = false;
    public $b_maghrib = false;
    public $b_isya = false;
    
    // Numbers
    public $dhuha_rakaat = 0;
    public $tahajud_rakaat = 0;
    public $murojaah_halaman = 0;
    
    public $notes;
    public $progress = 0;
    
    public $rekap_mingguan = [];
    public $rekap_bulanan = [];

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->loadToday();
        $this->loadRekap();
    }

    public function loadToday()
    {
        $data = MuthabaahModel::where('user_id', Auth::id())
            ->where('date', $this->date)
            ->first();

        if ($data) {
            $this->sholat_dhuha = $data->sholat_dhuha;
            $this->sholat_tahajud = $data->sholat_tahajud;
            $this->murojaah = $data->murojaah;
            $this->q_shubuh = $data->q_shubuh;
            $this->q_zuhur = $data->q_zuhur;
            $this->q_ashar = $data->q_ashar;
            $this->q_maghrib = $data->q_maghrib;
            $this->q_isya = $data->q_isya;
            $this->b_zuhur = $data->b_zuhur;
            $this->b_maghrib = $data->b_maghrib;
            $this->b_isya = $data->b_isya;
            $this->dhuha_rakaat = $data->dhuha_rakaat;
            $this->tahajud_rakaat = $data->tahajud_rakaat;
            $this->murojaah_halaman = $data->murojaah_halaman;
            $this->notes = $data->notes;
        } else {
            $this->reset([
                'sholat_dhuha', 'sholat_tahajud', 'murojaah',
                'q_shubuh', 'q_zuhur', 'q_ashar', 'q_maghrib', 'q_isya',
                'b_zuhur', 'b_maghrib', 'b_isya',
                'dhuha_rakaat', 'tahajud_rakaat', 'murojaah_halaman',
                'notes'
            ]);
        }
        $this->calculateProgress();
    }

    public function updated($propertyName)
    {
        $fields = [
            'sholat_dhuha', 'sholat_tahajud', 'murojaah',
            'q_shubuh', 'q_zuhur', 'q_ashar', 'q_maghrib', 'q_isya',
            'b_zuhur', 'b_maghrib', 'b_isya',
            'dhuha_rakaat', 'tahajud_rakaat', 'murojaah_halaman',
            'notes', 'date'
        ];

        if (in_array($propertyName, $fields)) {
            if ($propertyName == 'date') {
                $this->loadToday();
            } else {
                $this->save();
            }
        }
    }

    public function save()
    {
        MuthabaahModel::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $this->date],
            [
                'sholat_dhuha' => $this->sholat_dhuha,
                'sholat_tahajud' => $this->sholat_tahajud,
                'murojaah' => $this->murojaah,
                'q_shubuh' => $this->q_shubuh,
                'q_zuhur' => $this->q_zuhur,
                'q_ashar' => $this->q_ashar,
                'q_maghrib' => $this->q_maghrib,
                'q_isya' => $this->q_isya,
                'b_zuhur' => $this->b_zuhur,
                'b_maghrib' => $this->b_maghrib,
                'b_isya' => $this->b_isya,
                'dhuha_rakaat' => filter_var($this->dhuha_rakaat, FILTER_VALIDATE_INT) ?: 0,
                'tahajud_rakaat' => filter_var($this->tahajud_rakaat, FILTER_VALIDATE_INT) ?: 0,
                'murojaah_halaman' => filter_var($this->murojaah_halaman, FILTER_VALIDATE_INT) ?: 0,
                'notes' => $this->notes,
            ]
        );

        $this->calculateProgress();
        $this->loadRekap();
    }

    public function calculateProgress()
    {
        $items = [
            $this->q_shubuh, $this->q_zuhur, $this->q_ashar, $this->q_maghrib, $this->q_isya,
            $this->b_zuhur, $this->b_maghrib, $this->b_isya,
            $this->sholat_dhuha, $this->sholat_tahajud, $this->murojaah
        ];
        $done = count(array_filter($items));
        $this->progress = ($done / count($items)) * 100;
    }

    public function loadRekap()
    {
        // Weekly Rekap (last 7 days)
        $this->rekap_mingguan = MuthabaahModel::where('user_id', Auth::id())
            ->where('date', '>=', Carbon::now()->subDays(6))
            ->orderBy('date', 'desc')
            ->get();

        // Monthly Rekap (current month)
        $this->rekap_bulanan = MuthabaahModel::where('user_id', Auth::id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->orderBy('date', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.anggota.muthabaah');
    }
}
