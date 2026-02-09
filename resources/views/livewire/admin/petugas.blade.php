<div class="font-jakarta">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    {{-- NOTIFIKASI --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4 d-flex align-items-center" role="alert" style="background-color: #d1fae5; color: #065f46;">
            <i class="bi bi-check-circle-fill fs-5 me-2"></i> 
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- CARD UTAMA --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-4 px-4 border-0">
            <div class="d-flex flex-column md:flex-row justify-content-between align-items-start md:align-items-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1 text-dark">Manajemen Petugas</h4>
                    <p class="text-muted small mb-0">Atur pembagian tugas untuk setiap pertemuan</p>
                </div>
                <button wire:click="$set('showCreate', true)" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-flex align-items-center gap-2 transition-transform hover-scale">
                    <i class="bi bi-plus-lg"></i> Tambah Petugas
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            {{-- Desktop View --}}
            <div class="table-responsive d-none d-xl-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">No.</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Pembukaan</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Tilawah</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Kultum</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Materi</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Diskusi</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Qodoya</th>
                            <th class="py-3 text-uppercase text-muted border-0 tracking-wider" style="font-size: 0.7rem;">Tanggal</th>
                            <th class="pe-4 py-3 text-uppercase text-muted border-0 tracking-wider text-center" style="font-size: 0.7rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($petugas as $index => $item)
                            <tr>
                                <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $item->pembukaan }}</td>
                                <td>{{ $item->tilawah }}</td>
                                <td>{{ $item->kultum }}</td>
                                <td>{{ $item->materi }}</td>
                                <td>{{ $item->diskusi }}</td>
                                <td>{{ $item->qodoya }}</td>
                                <td>
                                    <span class="badge bg-light-primary text-primary rounded-pill px-3" style="font-size: 0.7rem;">
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button wire:click="openEdit({{ $item->id }})" class="btn btn-sm btn-light-info rounded-3 p-2" title="Edit">
                                            <i class="bi bi-pencil-square text-info"></i>
                                        </button>
                                        <button wire:click="openDelete({{ $item->id }})" class="btn btn-sm btn-light-danger rounded-3 p-2" title="Hapus">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center py-5 text-muted">Belum ada data petugas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile/Tablet Card View --}}
            <div class="d-xl-none p-4 space-y-4 bg-light/30">
                @forelse ($petugas as $index => $item)
                    <div class="card border-0 shadow-sm rounded-4 mb-3 overflow-hidden">
                        <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill px-3">#{{ $index + 1 }}</span>
                            <span class="text-muted small fw-bold">{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="card-body pt-0 pb-3">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="text-[10px] fw-bold text-muted uppercase">Pembukaan</label>
                                    <p class="mb-0 fw-bold text-dark small">{{ $item->pembukaan }}</p>
                                </div>
                                <div class="col-6">
                                    <label class="text-[10px] fw-bold text-muted uppercase">Tilawah</label>
                                    <p class="mb-0 text-dark small">{{ $item->tilawah }}</p>
                                </div>
                                <div class="col-6">
                                    <label class="text-[10px] fw-bold text-muted uppercase">Kultum</label>
                                    <p class="mb-0 text-dark small">{{ $item->kultum }}</p>
                                </div>
                                <div class="col-6">
                                    <label class="text-[10px] fw-bold text-muted uppercase">Materi</label>
                                    <p class="mb-0 text-dark small">{{ $item->materi }}</p>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-top d-flex justify-content-end gap-2">
                                <button wire:click="openEdit({{ $item->id }})" class="btn btn-info btn-sm rounded-pill px-3 text-white">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                                <button wire:click="openDelete({{ $item->id }})" class="btn btn-danger btn-sm rounded-pill px-3">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted bg-white rounded-4 border border-dashed">
                        <i class="bi bi-folder-x fs-1 d-block mb-2 opacity-25"></i>
                        Belum ada data petugas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    @if ($showCreate)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex justify-center items-center z-[9999] p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden w-full max-w-2xl transform transition-all animate-zoom-in" style="background: white; border-radius: 2rem; width: 100%; max-width: 42rem; max-height: 90vh; display: flex; flex-direction: column;">
                <div class="px-6 py-4 border-b d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0 text-white fw-bold">Tambah Petugas</h5>
                    <button wire:click="$set('showCreate', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="p-6 overflow-y-auto" style="overflow-y: auto;">
                    <div class="row g-4">
                        @foreach(['pembukaan', 'tilawah', 'kultum', 'materi', 'diskusi', 'qodoya', 'doa_penutup'] as $field)
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold uppercase tracking-wide">{{ str_replace('_', ' ', $field) }} <span class="text-danger">*</span></label>
                            <input type="text" wire:model="{{ $field }}" class="form-control rounded-3 py-2 bg-light border-0 @error($field) is-invalid @enderror" placeholder="Nama petugas">
                            @error($field) <div class="invalid-feedback xsmall">{{ $message }}</div> @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="px-6 py-4 border-top bg-light d-flex justify-content-end gap-2">
                    <button wire:click="$set('showCreate', false)" class="btn btn-outline-secondary rounded-pill px-4">Batal</button>
                    <button wire:click="create" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm transition-transform hover-scale">Simpan Data</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL EDIT --}}
    @if ($editId)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex justify-center items-center z-[9999] p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden w-full max-w-2xl transform transition-all animate-zoom-in" style="background: white; border-radius: 2rem; width: 100%; max-width: 42rem; max-height: 90vh; display: flex; flex-direction: column;">
                <div class="px-6 py-4 border-b d-flex justify-content-between align-items-center bg-info text-white">
                    <h5 class="mb-0 text-white fw-bold">Edit Petugas</h5>
                    <button wire:click="$set('editId', null)" class="btn-close btn-close-white"></button>
                </div>
                <div class="p-6 overflow-y-auto" style="overflow-y: auto;">
                    <div class="row g-4">
                        @foreach(['pembukaan', 'tilawah', 'kultum', 'materi', 'diskusi', 'qodoya', 'doa_penutup'] as $field)
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold uppercase tracking-wide">{{ str_replace('_', ' ', $field) }} <span class="text-danger">*</span></label>
                            <input type="text" wire:model="{{ $field }}" class="form-control rounded-3 py-2 bg-light border-0 @error($field) is-invalid @enderror">
                            @error($field) <div class="invalid-feedback xsmall">{{ $message }}</div> @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="px-6 py-4 border-top bg-light d-flex justify-content-end gap-2">
                    <button wire:click="$set('editId', null)" class="btn btn-outline-secondary rounded-pill px-4">Batal</button>
                    <button wire:click="update" class="btn btn-info text-white rounded-pill px-5 fw-bold shadow-sm transition-transform hover-scale">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL DELETE --}}
    @if ($deleteId)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex justify-center items-center z-[9999] p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden w-full max-w-md p-8 text-center transform transition-all animate-zoom-in" style="background: white; border-radius: 2.5rem; width: 100%; max-width: 28rem;">
                <div class="mb-4 text-danger animate-bounce-slow">
                    <i class="bi bi-exclamation-circle-fill" style="font-size: 5rem;"></i>
                </div>
                <h3 class="mb-2 fw-extrabold text-dark">Hapus Data?</h3>
                <p class="text-muted mb-4 px-4">Data petugas yang dihapus tidak dapat dipulihkan kembali ke sistem.</p>
                <div class="d-flex flex-column gap-2 px-4">
                    <button wire:click="delete" class="btn btn-danger rounded-pill py-3 fw-bold shadow-lg shadow-danger/30 transition-transform hover-scale">Ya, Hapus Sekarang</button>
                    <button wire:click="$set('deleteId', null)" class="btn btn-light border-0 rounded-pill py-3 fw-bold text-muted">Batalkan</button>
                </div>
            </div>
        </div>
    @endif

    <style>
        .hover-scale:hover { transform: scale(1.03); }
        .xsmall { font-size: 11px; }
        @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .animate-zoom-in { animation: zoomIn 0.25s ease-out; }
        @keyframes bounceSlow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .animate-bounce-slow { animation: bounceSlow 2s infinite ease-in-out; }
    </style>
</div>

