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
            <h4 class="card-title mb-0">Daftar Pengumuman</h4>
            <button wire:click="$set('showCreate', true)" class="btn btn-primary btn-sm icon icon-left">
                <i class="bi bi-plus"></i> Buat Pengumuman
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-sm font-semibold">No.</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Judul</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Isi Pengumuman</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold text-center">Status</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold">Tanggal</th>
                            <th class="text-uppercase text-secondary text-sm font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($informasi as $index => $item)
                            <tr>
                                <td class="text-bold-500">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $item->judul }}</td>
                                <td>{{ Str::limit($item->isi, 50) }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input cursor-pointer" type="checkbox" 
                                            wire:click="toggleStatus({{ $item->id }})" 
                                            {{ $item->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light-secondary text-secondary">
                                        {{ $item->created_at->format('d M Y') }}
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
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-megaphone fs-1 text-muted mb-2"></i>
                                        <p class="text-muted">Belum ada pengumuman.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    @if ($showCreate)
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 p-4" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-lg" style="background: white; border-radius: 1rem; width: 100%; max-width: 32rem; display: flex; flex-direction: column;">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0 text-white">Buat Pengumuman Baru</h5>
                    <button wire:click="$set('showCreate', false)" class="btn-close btn-close-white"></button>
                </div>

                {{-- Body --}}
                <div class="p-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" wire:model="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Info Halaqoh Pekan Ini">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea wire:model="isi" class="form-control @error('isi') is-invalid @enderror" rows="4" placeholder="Tulis isi pengumuman di sini..."></textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" wire:model="is_active" id="createActive">
                        <label class="form-check-label" for="createActive">Aktifkan Pengumuman</label>
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
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-lg" style="background: white; border-radius: 1rem; width: 100%; max-width: 32rem; display: flex; flex-direction: column;">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b d-flex justify-content-between align-items-center bg-info text-white">
                    <h5 class="mb-0 text-white">Edit Pengumuman</h5>
                    <button wire:click="$set('editId', null)" class="btn-close btn-close-white"></button>
                </div>

                {{-- Body --}}
                <div class="p-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" wire:model="judul" class="form-control @error('judul') is-invalid @enderror">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea wire:model="isi" class="form-control @error('isi') is-invalid @enderror" rows="4"></textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" wire:model="is_active" id="editActive">
                        <label class="form-check-label" for="editActive">Aktifkan Pengumuman</label>
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
                    <h3 class="mb-2 fw-bold text-dark">Hapus Pengumuman?</h3>
                    <p class="text-muted mb-4">Pengumuman yang dihapus tidak dapat dikembalikan.</p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <button wire:click="$set('deleteId', null)" class="btn btn-light border px-4">Batal</button>
                        <button wire:click="delete" class="btn btn-danger px-4">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
