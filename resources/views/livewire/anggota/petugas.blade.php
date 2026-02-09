<div class="font-jakarta">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="row animate-fade-in">
        <div class="col-12">
            <div class="card shadow-xl border-0 rounded-[2.5rem] overflow-hidden">
                <div class="card-header bg-teal-700 py-5 px-4 md:px-8 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-white mb-1 fw-black tracking-tight">Jadwal Petugas</h4>
                            <p class="text-teal-100/70 mb-0 small uppercase tracking-widest font-bold">Amanah adalah bentuk kemuliaan</p>
                        </div>
                        <div class="p-2 bg-white/10 rounded-2xl border border-white/20">
                            <i class="bi bi-calendar-check text-white fs-4"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    {{-- Desktop View --}}
                    <div class="table-responsive d-none d-lg-block">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-slate-50/80">
                                <tr>
                                    <th class="ps-4 py-4 xsmall fw-black text-slate-400 uppercase tracking-widest border-0">No.</th>
                                    <th class="py-4 xsmall fw-black text-slate-400 uppercase tracking-widest border-0">Aktivitas & Petugas</th>
                                    <th class="py-4 xsmall fw-black text-slate-400 uppercase tracking-widest border-0">Tanggal</th>
                                    <th class="pe-4 py-4 xsmall fw-black text-slate-400 uppercase tracking-widest border-0 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($petugas as $index => $item)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="ps-4 py-4">
                                        <span class="p-2 px-3 bg-slate-100 text-slate-500 rounded-xl fw-black small shadow-sm">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="py-4">
                                        <div class="d-grid grid-cols-2 gap-x-4 gap-y-2" style="grid-template-columns: repeat(2, 1fr);">
                                            <div class="p-2 bg-emerald-50 rounded-2xl border border-emerald-100">
                                                <small class="text-slate-400 xsmall fw-bold d-block uppercase mb-1">Materi</small>
                                                <span class="fw-black text-emerald-900 small d-block">{{ $item->materi ?: '—' }}</span>
                                                <small class="text-emerald-600/70 xsmall">{{ $item->kultum ?: 'Kultum' }}</small>
                                            </div>
                                            <div class="p-2 bg-indigo-50 rounded-2xl border border-indigo-100">
                                                <small class="text-slate-400 xsmall fw-bold d-block uppercase mb-1">Tilawah & Doa</small>
                                                <span class="fw-black text-indigo-900 small d-block">{{ $item->tilawah ?: '—' }}</span>
                                                <small class="text-indigo-600/70 xsmall">{{ $item->doa_penutup ?: 'Doa' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <span class="fw-black text-slate-700 small d-block">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                                        <span class="text-slate-400 xsmall uppercase tracking-tighter">{{ $item->created_at->translatedFormat('l') }}</span>
                                    </td>
                                    <td class="pe-4 py-4 text-end text-slate-400 italic xsmall">
                                       Siapkan Dirimu!
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10 scale-95 transition-all opacity-80">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100 shadow-inner">
                                            <i class="bi bi-calendar-x text-slate-300 fs-1"></i>
                                        </div>
                                        <h5 class="fw-black text-slate-800 mb-1">Belum Ada Jadwal</h5>
                                        <p class="text-slate-400 small mb-0">Jadwal tugas akan muncul di sini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile View --}}
                    <div class="d-lg-none p-4 bg-slate-50/50">
                        @forelse ($petugas as $index => $item)
                        <div class="card border-0 shadow-sm rounded-3xl mb-4 overflow-hidden border border-white hover:shadow-md transition-all">
                            <div class="card-header bg-white py-3 px-4 border-bottom border-slate-50 d-flex justify-content-between align-items-center">
                                <span class="badge bg-teal-50 text-teal-700 rounded-pill px-3 fw-black xsmall uppercase tracking-widest">JADWAL #{{ $index + 1 }}</span>
                                <span class="fw-black text-slate-700 small">{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="p-3 bg-emerald-50 rounded-2xl border border-emerald-100 d-flex gap-3 align-items-center">
                                            <span class="p-2 bg-white text-emerald-600 rounded-xl shadow-sm"><i class="bi bi-book"></i></span>
                                            <div>
                                                <small class="text-slate-400 xsmall fw-black uppercase tracking-widest d-block">Materi Utama</small>
                                                <span class="fw-black text-slate-800 small">{{ $item->materi ?: 'TBA' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-slate-100/50 rounded-2xl border border-slate-100">
                                            <small class="text-slate-400 xsmall fw-bold d-block mb-1">TILAWAH</small>
                                            <span class="fw-black text-slate-700 small">{{ $item->tilawah ?: '—' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-slate-100/50 rounded-2xl border border-slate-100">
                                            <small class="text-slate-400 xsmall fw-bold d-block mb-1">KULTUM</small>
                                            <span class="fw-black text-slate-700 small">{{ $item->kultum ?: '—' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-slate-100/50 rounded-2xl border border-slate-100">
                                            <small class="text-slate-400 xsmall fw-bold d-block mb-1">DISKUSI</small>
                                            <span class="fw-black text-slate-700 small">{{ $item->diskusi ?: '—' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-slate-100/50 rounded-2xl border border-slate-100">
                                            <small class="text-slate-400 xsmall fw-bold d-block mb-1"> DOA</small>
                                            <span class="fw-black text-slate-700 small">{{ $item->doa_penutup ?: '—' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-slate-200"></i>
                            <p class="text-slate-400 small mt-2">Kosong.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .xsmall { font-size: 10px; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</div>

