<div class="font-jakarta">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    @if($viewMode === 'list')
    <div class="row animate-fade-in">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white py-4 border-0">
                    <div class="d-flex flex-column lg:flex-row justify-content-between align-items-start lg:align-items-center gap-4">
                        <div>
                            <h4 class="fw-bold mb-1 text-dark">Monitoring Muthaba'ah</h4>
                            <p class="text-muted mb-0 small">Pantau progres ibadah harian seluruh anggota</p>
                        </div>
                        <div class="d-flex flex-column sm:flex-row gap-2 w-100 lg:w-auto">
                            <div class="d-flex gap-2 w-100 sm:w-auto">
                                <select wire:model.live="filter" class="form-select rounded-pill border-light shadow-sm small-select" style="min-width: 140px;">
                                    <option value="all">Semua Anggota</option>
                                    <option value="filled">Sudah Mengisi</option>
                                    <option value="empty">Belum Mengisi</option>
                                </select>
                                <input type="date" wire:model.live="date" class="form-control rounded-pill border-light shadow-sm small-select">
                            </div>
                            <div class="position-relative w-100">
                                <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control rounded-pill border-light shadow-sm ps-5" placeholder="Cari nama members...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    {{-- Desktop View --}}
                    <div class="table-responsive d-none d-lg-block">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0 small fw-bold text-muted uppercase tracking-wider">Anggota</th>
                                    <th class="py-3 border-0 small fw-bold text-muted text-center uppercase tracking-wider">Rawatib</th>
                                    <th class="py-3 border-0 small fw-bold text-muted text-center uppercase tracking-wider">Dhuha</th>
                                    <th class="py-3 border-0 small fw-bold text-muted text-center uppercase tracking-wider">Tahajud</th>
                                    <th class="py-3 border-0 small fw-bold text-muted text-center uppercase tracking-wider">Quran</th>
                                    <th class="py-3 border-0 small fw-bold text-muted text-center uppercase tracking-wider">Progress</th>
                                    <th class="pe-4 py-3 border-0 small fw-bold text-muted text-end uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($users as $user)
                                @php
                                    $m = $user->muthabaahs->first();
                                    $rawatib_items = $m ? [$m->q_shubuh, $m->q_zuhur, $m->q_ashar, $m->q_maghrib, $m->q_isya, $m->b_zuhur, $m->b_maghrib, $m->b_isya] : [];
                                    $done_rawatib = count(array_filter($rawatib_items));
                                    
                                    $p_items = $m ? [
                                        $m->q_shubuh, $m->q_zuhur, $m->q_ashar, $m->q_maghrib, $m->q_isya,
                                        $m->b_zuhur, $m->b_maghrib, $m->b_isya,
                                        $m->sholat_dhuha, $m->sholat_tahajud, $m->murojaah
                                    ] : [];
                                    $done = count(array_filter($p_items));
                                    $perc = count($p_items) > 0 ? ($done / count($p_items)) * 100 : 0;
                                @endphp
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md me-3 bg-light-primary rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary overflow-hidden shadow-sm" style="width: 40px; height: 40px;">
                                                @if($user->profile_photo)
                                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    {{ substr($user->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block small mb-0">{{ $user->name }}</span>
                                                <span class="text-muted xsmall">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $done_rawatib == 8 ? 'bg-success' : ($done_rawatib > 0 ? 'bg-primary' : 'bg-light text-muted') }} rounded-pill px-2">
                                            {{ $done_rawatib }}/8
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($m && $m->sholat_dhuha)
                                            <span class="xsmall fw-bold text-success"><i class="bi bi-check2-circle me-1"></i>{{ $m->dhuha_rakaat }} Rkt</span>
                                        @else
                                            <i class="bi bi-dash text-light"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($m && $m->sholat_tahajud)
                                            <span class="xsmall fw-bold text-info"><i class="bi bi-check2-circle me-1"></i>{{ $m->tahajud_rakaat }} Rkt</span>
                                        @else
                                            <i class="bi bi-dash text-light"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($m && $m->murojaah)
                                            <span class="xsmall fw-bold text-primary"><i class="bi bi-book me-1"></i>{{ $m->murojaah_halaman }} Hal</span>
                                        @else
                                            <i class="bi bi-dash text-light"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="progress rounded-pill bg-light" style="height: 6px; width: 60px; margin: 0 auto;">
                                            <div class="progress-bar rounded-pill bg-{{ $perc == 100 ? 'success' : ($perc >= 50 ? 'primary' : 'warning') }}" style="width: {{ $perc }}%"></div>
                                        </div>
                                        <span class="xsmall fw-bold text-muted">{{ round($perc) }}%</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button wire:click="selectUser({{ $user->id }})" class="btn btn-sm btn-light-primary rounded-pill px-3 fw-bold transition-transform hover-scale">
                                            <i class="bi bi-graph-up me-1"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center py-5 text-muted">Data kosong untuk filter ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile View Cards --}}
                    <div class="d-lg-none p-4 space-y-4 bg-light/30">
                        @forelse($users as $user)
                        @php
                            $m = $user->muthabaahs->first();
                            $p_items = $m ? [
                                $m->q_shubuh, $m->q_zuhur, $m->q_ashar, $m->q_maghrib, $m->q_isya,
                                $m->b_zuhur, $m->b_maghrib, $m->b_isya,
                                $m->sholat_dhuha, $m->sholat_tahajud, $m->murojaah
                            ] : [];
                            $done = count(array_filter($p_items));
                            $perc = count($p_items) > 0 ? ($done / count($p_items)) * 100 : 0;
                        @endphp
                        <div class="card border-0 shadow-sm rounded-4 transition-transform hover-scale" wire:click="selectUser({{ $user->id }})">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-md me-3 bg-light-primary rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary" style="width: 45px; height: 45px;">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        @else
                                            {{ substr($user->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold text-dark mb-0">{{ $user->name }}</h6>
                                        <div class="progress rounded-pill mt-2" style="height: 4px;">
                                            <div class="progress-bar bg-teal-600" style="width: {{ $perc }}%"></div>
                                        </div>
                                    </div>
                                    <div class="ms-3 text-end">
                                        <span class="d-block fw-bold text-teal-700 small">{{ round($perc) }}%</span>
                                        <span class="xsmall text-muted">Progres</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between pt-2 border-top">
                                    <div class="text-center">
                                        <span class="xsmall text-muted d-block">Rawatib</span>
                                        <span class="fw-bold small {{ $m ? 'text-dark' : 'text-light' }}">{{ count(array_filter([$m->q_shubuh ?? null, $m->q_zuhur ?? null, $m->q_ashar ?? null, $m->q_maghrib ?? null, $m->q_isya ?? null, $m->b_zuhur ?? null, $m->b_maghrib ?? null, $m->b_isya ?? null])) }}/8</span>
                                    </div>
                                    <div class="text-center">
                                        <span class="xsmall text-muted d-block">Dhuha</span>
                                        <span class="fw-bold small {{ $m && $m->sholat_dhuha ? 'text-success' : 'text-light' }}">{{ $m->dhuha_rakaat ?? 0 }} R</span>
                                    </div>
                                    <div class="text-center">
                                        <span class="xsmall text-muted d-block">Quran</span>
                                        <span class="fw-bold small {{ $m && $m->murojaah ? 'text-primary' : 'text-light' }}">{{ $m->murojaah_halaman ?? 0 }} H</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 text-muted bg-white rounded-4 border border-dashed">No data.</div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Detail / Rekap View -->
    <div class="row animate-fade-in-up">
        <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
            <button wire:click="backToList" class="btn btn-light-secondary rounded-pill shadow-sm px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
            <h5 class="fw-extrabold mb-0 text-dark">Rekap {{ $selectedUser->name }}</h5>
        </div>
        
        <div class="col-12 col-xl-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 overflow-hidden">
                <div class="bg-teal-700 p-4 text-center text-white">
                    <div class="avatar avatar-xl bg-white/20 rounded-circle d-flex align-items-center justify-content-center fw-bold text-white mx-auto mb-3 shadow-lg overflow-hidden border border-white/30" style="width: 100px; height: 100px; font-size: 2.5rem;">
                        @if($selectedUser->profile_photo)
                            <img src="{{ asset('storage/' . $selectedUser->profile_photo) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ substr($selectedUser->name, 0, 1) }}
                        @endif
                    </div>
                    <h5 class="fw-bold mb-1">{{ $selectedUser->name }}</h5>
                    <p class="text-white/70 small mb-0">{{ $selectedUser->email }}</p>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-4 d-flex align-items-center gap-3">
                                <span class="avatar avatar-sm bg-teal-100 text-teal-700 rounded-3 p-2"><i class="bi bi-whatsapp"></i></span>
                                <div>
                                    <small class="text-muted d-block fw-bold xsmall uppercase">WhatsApp</small>
                                    <span class="fw-bold text-dark">{{ $selectedUser->no_wa ?? 'Belum diset'  }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-4 d-flex align-items-center gap-3">
                                <span class="avatar avatar-sm bg-amber-100 text-amber-700 rounded-3 p-2"><i class="bi bi-shield-lock"></i></span>
                                <div>
                                    <small class="text-muted d-block fw-bold xsmall uppercase">Hak Akses</small>
                                    <span class="badge bg-amber-100 text-dark rounded-pill px-3">{{ strtoupper($selectedUser->role) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white py-4 border-0 d-flex flex-column sm:flex-row justify-content-between align-items-start sm:align-items-center gap-3">
                    <h5 class="fw-bold mb-0 text-dark">Statistik Bulan {{ now()->translatedFormat('F') }}</h5>
                    <div class="badge bg-light-primary text-primary px-3 py-2 rounded-pill d-flex align-items-center gap-2">
                        <i class="bi bi-calendar3"></i>
                        Live Monitoring
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="small fw-bold text-muted border-0 text-start ps-4">Tanggal</th>
                                    <th class="small fw-bold text-muted border-0">Rawatib</th>
                                    <th class="small fw-bold text-muted border-0">Dhuha</th>
                                    <th class="small fw-bold text-muted border-0">Tahajud</th>
                                    <th class="small fw-bold text-muted border-0">Quran</th>
                                    <th class="small fw-bold text-muted border-0 text-end pe-4">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rekap_bulanan as $item)
                                @php
                                    $p_items = [
                                        $item->q_shubuh, $item->q_zuhur, $item->q_ashar, $item->q_maghrib, $item->q_isya,
                                        $item->b_zuhur, $item->b_maghrib, $item->b_isya,
                                        $item->sholat_dhuha, $item->sholat_tahajud, $item->murojaah
                                    ];
                                    $done = count(array_filter($p_items));
                                    $perc = ($done / count($p_items)) * 100;
                                    $rawatibs = count(array_filter([$item->q_shubuh, $item->q_zuhur, $item->q_ashar, $item->q_maghrib, $item->q_isya, $item->b_zuhur, $item->b_maghrib, $item->b_isya]));
                                @endphp
                                <tr>
                                    <td class="ps-4 text-start">
                                        <span class="fw-bold text-dark small">{{ $item->date->format('d M') }}</span>
                                        <span class="text-muted xsmall d-block">{{ $item->date->translatedFormat('l') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $rawatibs == 8 ? 'bg-success' : ($rawatibs > 0 ? 'bg-primary' : 'bg-light text-muted') }} rounded-pill" style="font-size: 0.65rem;">{{ $rawatibs }}/8</span>
                                    </td>
                                    <td><i class="bi bi-circle-fill {{ $item->sholat_dhuha ? 'text-success' : 'text-light opacity-50' }}" style="font-size: 0.7rem;"></i></td>
                                    <td><i class="bi bi-circle-fill {{ $item->sholat_tahajud ? 'text-info' : 'text-light opacity-50' }}" style="font-size: 0.7rem;"></i></td>
                                    <td><i class="bi bi-circle-fill {{ $item->murojaah ? 'text-primary' : 'text-light opacity-50' }}" style="font-size: 0.7rem;"></i></td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <div class="progress bg-light" style="height: 4px; width: 35px;">
                                                <div class="progress-bar bg-teal-600" style="width: {{ $perc }}%"></div>
                                            </div>
                                            <span class="xsmall fw-bold text-muted">{{ round($perc) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-5 text-muted small">Belum ada aktivitas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .hover-scale { transition: transform 0.2s; cursor: pointer; }
        .hover-scale:hover { transform: translateY(-2px); }
        .xsmall { font-size: 10px; }
        .small-select { height: 38px; font-size: 0.8rem; font-weight: 500; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.4s ease-out; }
    </style>
</div>

