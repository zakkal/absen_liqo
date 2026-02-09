<div class="row">
    <div class="col-12 col-lg-8">
        <!-- Checklist Section -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-primary py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-white mb-0 fw-bold">Muthaba'ah Harian</h4>
                        <p class="text-white-50 mb-0">Istiqomah adalah kunci keberkahan</p>
                    </div>
                    <div class="bg-white p-2 rounded-3 shadow-sm">
                        <input type="date" wire:model.live="date" class="form-control border-0 fw-bold text-primary p-0" style="width: auto;">
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Progress Section -->
                <div class="mb-5">
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <h6 class="fw-bold text-muted mb-0">Progress Hari Ini</h6>
                        <span class="badge bg-primary rounded-pill px-3">{{ round($progress) }}%</span>
                    </div>
                    <div class="progress" style="height: 12px; border-radius: 10px; background-color: #f0f2f5;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" 
                             style="width: {{ $progress }}%; border-radius: 10px;" 
                             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Sunnah Rawatib Section -->
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-stars text-warning me-2"></i>Sunnah Rawatib</h5>
                    
                    <h6 class="text-muted small fw-bold mb-2">QOBLIYAH (Sebelum)</h6>
                    <div class="row g-2 mb-3">
                        @foreach(['shubuh' => 'Subuh', 'zuhur' => 'Zuhur', 'ashar' => 'Ashar', 'maghrib' => 'Maghrib', 'isya' => 'Isya'] as $key => $label)
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="p-2 rounded-3 border text-center transition-all {{ $this->{'q_'.$key} ? 'bg-light-primary border-primary' : 'bg-light border-transparent' }}">
                                <div class="form-check p-0 m-0">
                                    <input class="form-check-input d-none" type="checkbox" id="q_{{ $key }}" wire:model.live="q_{{ $key }}">
                                    <label class="form-check-label w-100 cursor-pointer py-1" for="q_{{ $key }}">
                                        <span class="d-block small fw-bold">{{ $label }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <h6 class="text-muted small fw-bold mb-2">BA'DIYAH (Sesudah)</h6>
                    <div class="row g-2">
                        @foreach(['zuhur' => 'Zuhur', 'maghrib' => 'Maghrib', 'isya' => 'Isya'] as $key => $label)
                        <div class="col-4 col-md-4 col-lg-2">
                            <div class="p-2 rounded-3 border text-center transition-all {{ $this->{'b_'.$key} ? 'bg-light-success border-success' : 'bg-light border-transparent' }}">
                                <div class="form-check p-0 m-0">
                                    <input class="form-check-input d-none" type="checkbox" id="b_{{ $key }}" wire:model.live="b_{{ $key }}">
                                    <label class="form-check-label w-100 cursor-pointer py-1" for="b_{{ $key }}">
                                        <span class="d-block small fw-bold">{{ $label }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sunnah Muakkadah & Murojaah Section -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="p-3 rounded-4 border {{ $sholat_dhuha ? 'bg-light-primary border-primary' : 'bg-light' }}">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch p-0 me-3">
                                        <input class="form-check-input ms-0" type="checkbox" wire:model.live="sholat_dhuha" style="width: 40px; height: 20px;">
                                    </div>
                                    <span class="fw-bold">Sholat Dhuha</span>
                                </div>
                                <div class="input-group input-group-sm" style="width: 100px;">
                                    <input type="number" class="form-control" wire:model.lazy="dhuha_rakaat" placeholder="Rakaat" min="0">
                                    <span class="input-group-text small">Rkt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-3 rounded-4 border {{ $sholat_tahajud ? 'bg-light-primary border-primary' : 'bg-light' }}">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch p-0 me-3">
                                        <input class="form-check-input ms-0" type="checkbox" wire:model.live="sholat_tahajud" style="width: 40px; height: 20px;">
                                    </div>
                                    <span class="fw-bold">Tahajud/Witir</span>
                                </div>
                                <div class="input-group input-group-sm" style="width: 100px;">
                                    <input type="number" class="form-control" wire:model.lazy="tahajud_rakaat" placeholder="Rakaat" min="0">
                                    <span class="input-group-text small">Rkt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 rounded-4 border {{ $murojaah ? 'bg-light-primary border-primary' : 'bg-light' }}">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch p-0 me-3">
                                        <input class="form-check-input ms-0" type="checkbox" wire:model.live="murojaah" style="width: 40px; height: 20px;">
                                    </div>
                                    <span class="fw-bold">Muroja'ah Al-Qur'an</span>
                                </div>
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="number" class="form-control" wire:model.lazy="murojaah_halaman" placeholder="0" min="0">
                                    <span class="input-group-text small">Halaman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div>
                    <label class="form-label fw-bold text-muted small">MUHASABAH (Evaluasi Diri)</label>
                    <textarea class="form-control rounded-4 border-light bg-light" wire:model.lazy="notes" 
                              rows="3" placeholder="Tuliskan evaluasi dirimu hari ini..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekap Section -->
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold mb-0">Rekap Aktivitas</h5>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills nav-fill bg-light m-3 rounded-3 p-1" id="rekapTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-3 py-2 small fw-bold" id="weekly-tab" data-bs-toggle="tab" data-bs-target="#weekly" type="button" role="tab">Mingguan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3 py-2 small fw-bold" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button" role="tab">Bulanan</button>
                    </li>
                </ul>
                <div class="tab-content" id="rekapTabContent">
                    <div class="tab-pane fade show active p-3" id="weekly" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="small text-muted border-0">Tanggal</th>
                                        <th class="small text-muted border-0 text-center">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekap_mingguan as $item)
                                    <tr>
                                        <td class="small fw-semibold border-0">{{ $item->date->format('d M') }}</td>
                                        <td class="border-0 text-center">
                                            @php
                                                $p_items = [
                                                    $item->q_shubuh, $item->q_zuhur, $item->q_ashar, $item->q_maghrib, $item->q_isya,
                                                    $item->b_zuhur, $item->b_maghrib, $item->b_isya,
                                                    $item->sholat_dhuha, $item->sholat_tahajud, $item->murojaah
                                                ];
                                                $done = count(array_filter($p_items));
                                                $perc = ($done / count($p_items)) * 100;
                                            @endphp
                                            <div class="progress" style="height: 6px; width: 60px; margin: 0 auto;" title="{{ round($perc) }}%">
                                                <div class="progress-bar bg-{{ $perc == 100 ? 'success' : ($perc >= 50 ? 'primary' : 'warning') }}" style="width: {{ $perc }}%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-muted small">Belum ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="monthly" role="tabpanel">
                         <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover align-middle text-center">
                                <thead>
                                    <tr>
                                        <th class="small text-muted border-0 text-start">Tgl</th>
                                        <th class="small text-muted border-0">Dh</th>
                                        <th class="small text-muted border-0">Th</th>
                                        <th class="small text-muted border-0">Mr</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekap_bulanan as $item)
                                    <tr>
                                        <td class="small fw-semibold border-0 text-start">{{ $item->date->format('d/m') }}</td>
                                        <td class="border-0">
                                            <i class="bi bi-circle-fill {{ $item->sholat_dhuha ? 'text-success' : 'text-light' }}" style="font-size: 0.6rem;"></i>
                                        </td>
                                        <td class="border-0">
                                            <i class="bi bi-circle-fill {{ $item->sholat_tahajud ? 'text-success' : 'text-light' }}" style="font-size: 0.6rem;"></i>
                                        </td>
                                        <td class="border-0">
                                            <i class="bi bi-circle-fill {{ $item->murojaah ? 'text-success' : 'text-light' }}" style="font-size: 0.6rem;"></i>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted small">Belum ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .transition-all { transition: all 0.2s ease; }
        .cursor-pointer { cursor: pointer; }
        .bg-light-primary { background-color: #ebf3ff; }
        .bg-light-success { background-color: #e6fffa; }
        .border-transparent { border-color: transparent; }
        .nav-pills .nav-link { color: #6c757d; }
        .nav-pills .nav-link.active { background-color: #fff; color: #435ebe; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</div>
