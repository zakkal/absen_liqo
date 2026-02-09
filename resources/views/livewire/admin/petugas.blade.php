<div>
    
    {{-- NOTIFIKASI --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- CARD UTAMA --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
            <h4 class="card-title mb-0">Daftar Petugas</h4>
            <button wire:click="$set('showCreate', true)" class="btn btn-primary btn-sm icon icon-left">
                <i class="bi bi-plus"></i> Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-sm font-semibold">No.</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Pembukaan</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Tilawah</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Kultum</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Materi</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Diskusi</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Qodoya</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Doa Penutup</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Tanggal</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($petugas as $index => $item)
                            <tr>
                                <td class="text-bold-500">{{ $index + 1 }}</td>
                                <td>{{ $item->pembukaan }}</td>
                                <td>{{ $item->tilawah }}</td>
                                <td>{{ $item->kultum }}</td>
                                <td>{{ $item->materi }}</td>
                                <td>{{ $item->diskusi }}</td>
                                <td>{{ $item->qodoya }}</td>
                                <td>{{ $item->doa_penutup }}</td>
                                <td>
                                    <span class="badge bg-light-secondary text-secondary">
                                        {{ $item->created_at->format('Y-m-d') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button wire:click="openEdit({{ $item->id }})" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button wire:click="openDelete({{ $item->id }})" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-folder-x fs-1 text-muted mb-2"></i>
                                        <p class="text-muted">Belum ada data petugas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE (Custom Overlay untuk Livewire) --}}
    @if ($showCreate)
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-2xl" style="background: white; border-radius: 1rem; width: 100%; max-width: 42rem; max-height: 90vh; display: flex; flex-direction: column;">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0 text-white">Tambah Data Petugas</h5>
                    <button wire:click="$set('showCreate', false)" class="btn-close btn-close-white"></button>
                </div>

                {{-- Body --}}
                <div class="p-6 overflow-y-auto" style="overflow-y: auto;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Pembukaan <span class="text-danger">*</span></label>
                            <input type="text" wire:model="pembukaan" class="form-control @error('pembukaan') is-invalid @enderror" placeholder="Nama petugas">
                            @error('pembukaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tilawah <span class="text-danger">*</span></label>
                            <input type="text" wire:model="tilawah" class="form-control @error('tilawah') is-invalid @enderror" placeholder="Nama petugas">
                            @error('tilawah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kultum <span class="text-danger">*</span></label>
                            <input type="text" wire:model="kultum" class="form-control @error('kultum') is-invalid @enderror" placeholder="Nama petugas">
                            @error('kultum') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Materi <span class="text-danger">*</span></label>
                            <input type="text" wire:model="materi" class="form-control @error('materi') is-invalid @enderror" placeholder="Nama petugas">
                            @error('materi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Diskusi <span class="text-danger">*</span></label>
                            <input type="text" wire:model="diskusi" class="form-control @error('diskusi') is-invalid @enderror" placeholder="Nama petugas">
                            @error('diskusi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Qodoya <span class="text-danger">*</span></label>
                            <input type="text" wire:model="qodoya" class="form-control @error('qodoya') is-invalid @enderror" placeholder="Nama petugas">
                            @error('qodoya') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Doa Penutup <span class="text-danger">*</span></label>
                            <input type="text" wire:model="doa_penutup" class="form-control @error('doa_penutup') is-invalid @enderror" placeholder="Nama petugas">
                            @error('doa_penutup') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 border-top bg-light d-flex justify-content-end gap-2">
                    <button wire:click="$set('showCreate', false)" class="btn btn-light border">Batal</button>
                    <button wire:click="create" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL EDIT --}}
    @if ($editId)
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-2xl" style="background: white; border-radius: 1rem; width: 100%; max-width: 42rem; max-height: 90vh; display: flex; flex-direction: column;">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b d-flex justify-content-between align-items-center bg-info text-white">
                    <h5 class="mb-0 text-white">Edit Data Petugas</h5>
                    <button wire:click="$set('editId', null)" class="btn-close btn-close-white"></button>
                </div>

                {{-- Body --}}
                <div class="p-6 overflow-y-auto" style="overflow-y: auto;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Pembukaan <span class="text-danger">*</span></label>
                            <input type="text" wire:model="pembukaan" class="form-control @error('pembukaan') is-invalid @enderror">
                            @error('pembukaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tilawah <span class="text-danger">*</span></label>
                            <input type="text" wire:model="tilawah" class="form-control @error('tilawah') is-invalid @enderror">
                            @error('tilawah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kultum <span class="text-danger">*</span></label>
                            <input type="text" wire:model="kultum" class="form-control @error('kultum') is-invalid @enderror">
                            @error('kultum') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Materi <span class="text-danger">*</span></label>
                            <input type="text" wire:model="materi" class="form-control @error('materi') is-invalid @enderror">
                            @error('materi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Diskusi <span class="text-danger">*</span></label>
                            <input type="text" wire:model="diskusi" class="form-control @error('diskusi') is-invalid @enderror">
                            @error('diskusi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Qodoya <span class="text-danger">*</span></label>
                            <input type="text" wire:model="qodoya" class="form-control @error('qodoya') is-invalid @enderror">
                            @error('qodoya') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Doa Penutup <span class="text-danger">*</span></label>
                            <input type="text" wire:model="doa_penutup" class="form-control @error('doa_penutup') is-invalid @enderror">
                            @error('doa_penutup') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 border-top bg-light d-flex justify-content-end gap-2">
                    <button wire:click="$set('editId', null)" class="btn btn-light border">Batal</button>
                    <button wire:click="update" class="btn btn-info text-white">Perbarui</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL DELETE --}}
    @if ($deleteId)
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-md" style="background: white; border-radius: 1rem; width: 100%; max-width: 28rem;">
                
                <div class="p-5 text-center">
                    <div class="mb-4 text-danger">
                        <i class="bi bi-exclamation-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="mb-2 fw-bold text-dark">Hapus Data?</h3>
                    <p class="text-muted mb-4">Data yang dihapus tidak dapat dikembalikan lagi.</p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <button wire:click="$set('deleteId', null)" class="btn btn-light border px-4">Batal</button>
                        <button wire:click="delete" class="btn btn-danger px-4">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
