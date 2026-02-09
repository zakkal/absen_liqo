<div>
    @if($viewMode === 'list')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-4 border-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h4 class="fw-bold mb-0">Monitoring Muthaba'ah</h4>
                            <p class="text-muted mb-0 small">Pantau amalan ibadah seluruh anggota</p>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <select wire:model.live="filter" class="form-select rounded-3 border-light shadow-sm" style="width: auto;">
                                <option value="all">Semua Anggota</option>
                                <option value="filled">Sudah Mengisi</option>
                                <option value="empty">Belum Mengisi</option>
                            </select>
                            <input type="date" wire:model.live="date" class="form-control rounded-3 border-light shadow-sm" style="width: auto;">
                            <input type="text" wire:model.liv e.debounce.300ms="search" class="form-control rounded-3 border-light shadow-sm" placeholder="Cari nama members...">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 border-0 small text-muted">Anggota</th>
                                    <th class="py-3 border-0 small text-muted text-center">Sunnah Rawatib</th>
                                    <th class="py-3 border-0 small text-muted text-center">Dhuha</th>
                                    <th class="py-3 border-0 small text-muted text-center">Tahajud</th>
                                    <th class="py-3 border-0 small text-muted text-center">Murojaah</th>
                                    <th class="py-3 border-0 small text-muted text-center">Progress</th>
                                    <th class="py-3 border-0 small text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <td class="px-4 py-3 border-bottom border-light">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md me-3 bg-light-primary rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary overflow-hidden shadow-sm" style="width: 40px; height: 40px;">
                                                @if($user->profile_photo)
                                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    {{ substr($user->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block small">{{ $user->name }}</span>
                                                <span class="text-muted small" style="font-size: 0.65rem;">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center border-bottom border-light">
                                        <span class="badge {{ $done_rawatib == 8 ? 'bg-success' : ($done_rawatib > 0 ? 'bg-primary' : 'bg-light text-muted') }}" style="font-size: 0.7rem;">
                                            {{ $done_rawatib }}/8
                                        </span>
                                    </td>
                                    <td class="text-center border-bottom border-light">
                                        @if($m && $m->sholat_dhuha)
                                            <span class="small fw-bold text-success">{{ $m->dhuha_rakaat }} Rkt</span>
                                        @else
                                            <i class="bi bi-x-circle text-light"></i>
                                        @endif
                                    </td>
                                    <td class="text-center border-bottom border-light">
                                        @if($m && $m->sholat_tahajud)
                                            <span class="small fw-bold text-info">{{ $m->tahajud_rakaat }} Rkt</span>
                                        @else
                                            <i class="bi bi-x-circle text-light"></i>
                                        @endif
                                    </td>
                                    <td class="text-center border-bottom border-light">
                                        @if($m && $m->murojaah)
                                            <span class="small fw-bold text-primary">{{ $m->murojaah_halaman }} Hal</span>
                                        @else
                                            <i class="bi bi-x-circle text-light"></i>
                                        @endif
                                    </td>
                                    <td class="text-center border-bottom border-light">
                                        <div class="progress" style="height: 6px; width: 60px; margin: 0 auto;">
                                            <div class="progress-bar bg-{{ $perc == 100 ? 'success' : ($perc >= 50 ? 'primary' : 'warning') }}" style="width: {{ $perc }}%"></div>
                                        </div>
                                        <small class="text-muted" style="font-size: 0.6rem;">{{ round($perc) }}%</small>
                                    </td>
                                    <td class="border-bottom border-light">
                                        <button wire:click="selectUser({{ $user->id }})" class="btn btn-sm btn-light-primary rounded-pill px-3">
                                            <i class="bi bi-graph-up me-1"></i> Rekap
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                            Tidak ada data untuk tanggal ini
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
    <div class="row">
        <div class="col-12 mb-4">
            <button wire:click="backToList" class="btn btn-light-secondary rounded-pill shadow-sm">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
            </button>
        </div>
        <div class="col-12 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="avatar avatar-xl bg-light-primary rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary mx-auto mb-3 shadow overflow-hidden" style="width: 80px; height: 80px; font-size: 2rem;">
                        @if($selectedUser->profile_photo)
                            <img src="{{ asset('storage/' . $selectedUser->profile_photo) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ substr($selectedUser->name, 0, 1) }}
                        @endif
                    </div>
                    <h5 class="fw-bold mb-1">{{ $selectedUser->name }}</h5>
                    <p class="text-muted small mb-0">{{ $selectedUser->email }}</p>
                    <hr class="my-4 opacity-10">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded-3">
                                <small class="text-muted d-block">W/A</small>
                                <span class="fw-bold small">{{ $selectedUser->no_wa ?? '-'  }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded-3">
                                <small class="text-muted d-block">Role</small>
                                <span class="badge bg-primary rounded-pill small" style="font-size: 0.6rem;">{{ strtoupper($selectedUser->role) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Statistik Ibadah</h5>
                    <span class="badge bg-light-primary text-primary px-3 rounded-pill">Bulan {{ now()->translatedFormat('F') }}</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="small text-muted border-0 text-start ps-4">Tanggal</th>
                                    <th class="small text-muted border-0">Rawatib</th>
                                    <th class="small text-muted border-0">Dhuha</th>
                                    <th class="small text-muted border-0">Tahajud</th>
                                    <th class="small text-muted border-0">Quran</th>
                                    <th class="small text-muted border-0 text-end pe-4">Progress</th>
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
                                    <td class="small fw-semibold border-0 text-start ps-4">{{ $item->date->format('d/m/Y') }}</td>
                                    <td class="border-0">
                                        <span class="badge {{ $rawatibs == 8 ? 'bg-success' : ($rawatibs > 0 ? 'bg-primary' : 'bg-light text-muted') }}" style="font-size: 0.6rem;">{{ $rawatibs }}/8</span>
                                    </td>
                                    <td class="border-0">
                                        <i class="bi bi-circle-fill {{ $item->sholat_dhuha ? 'text-success' : 'text-light' }}" style="font-size: 0.6rem;"></i>
                                    </td>
                                    <td class="border-0">
                                        <i class="bi bi-circle-fill {{ $item->sholat_tahajud ? 'text-success' : 'text-light' }}" style="font-size: 0.6rem;"></i>
                                    </td>
                                    <td class="border-0">
                                        <i class="bi bi-circle-fill {{ $item->murojaah ? 'text-success' : 'text-light' }}" style="font-size: 0.6rem;"></i>
                                    </td>
                                    <td class="border-0 text-end pe-4">
                                        <div class="progress" style="height: 4px; width: 40px; display: inline-block; vertical-align: middle;">
                                            <div class="progress-bar bg-{{ $perc == 100 ? 'success' : ($perc >= 50 ? 'primary' : 'warning') }}" style="width: {{ $perc }}%"></div>
                                        </div>
                                        <small class="text-muted ms-1" style="font-size: 0.6rem;">{{ round($perc) }}%</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted small">Belum ada aktivitas terekam.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
