<div>
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
                                   <p>kerjakan!!</p>
                                   
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
