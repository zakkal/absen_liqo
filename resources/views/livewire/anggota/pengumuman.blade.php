<div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
            <h4 class="card-title mb-0">Daftar Pengumuman</h4>
            <!-- <button wire:click="$set('showCreate', true)" class="btn btn-primary btn-sm icon icon-left">
                <i class="bi bi-plus"></i> Buat Pengumuman
            </button> -->
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
                        @forelse ($pengumumans as $index => $item)
                            <tr>
                                <td class="text-bold-500">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $item->judul }}</td>
                                <td>{{ Str::limit($item->isi, 50) }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input cursor-pointer" type="checkbox" 
                                            wire:click="#" 
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
                                        <p> pengemuman dari admin!! </p>
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