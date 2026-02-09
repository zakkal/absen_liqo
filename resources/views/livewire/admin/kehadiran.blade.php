<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <!-- Grafik Kehadiran -->
    <livewire:admin.grafik />

    <!-- Daftar Kehadiran -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mt-6 font-jakarta">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4 border-b pb-4">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Daftar Kehadiran Terbaru</h2>
            <div class="text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full border border-gray-100 italic w-fit">
                Menampilkan data kehadiran real-time
            </div>
        </div>

        <div class="overflow-x-auto -mx-4 md:mx-0">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">No.</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Anggota</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest hidden md:table-cell">Keterangan</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest md:table-cell">Waktu</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($kehadirans as $data)
                        <tr class="hover:bg-teal-50/30 transition-colors">
                            <td class="px-4 py-4 text-sm text-gray-500 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4">
                                <span class="text-sm font-bold text-gray-800">{{ $data->nama }}</span>
                                <div class="md:hidden text-[10px] text-gray-400 mt-0.5 truncate max-w-[120px]">{{ $data->keterangan }}</div>
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $colors = match($data->status) {
                                        'Hadir' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
                                        'Izin' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'dot' => 'bg-amber-500'],
                                        'Sakit' => ['bg' => 'bg-sky-100', 'text' => 'text-sky-700', 'dot' => 'bg-sky-500'],
                                        'Alpha' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'dot' => 'bg-rose-500'],
                                        default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'dot' => 'bg-gray-500']
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex items-center gap-1.5 text-[10px] md:text-xs leading-5 font-bold rounded-full {{ $colors['bg'] }} {{ $colors['text'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }}"></span>
                                    {{ $data->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 hidden md:table-cell">
                                <div class="truncate max-w-[150px] lg:max-w-xs" title="{{ $data->keterangan }}">{{ $data->keterangan ?: '-' }}</div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-700">{{ $data->created_at->format('H:i') }}</span>
                                    <span class="text-[10px] text-gray-400">{{ $data->created_at->format('d M') }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex justify-end gap-2 text-sm">
                                    <button wire:click="openEdit({{ $data->id }})" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button wire:click="openDelete({{ $data->id }})" class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($kehadirans->isEmpty())
            <div class="text-center py-16 bg-gray-50/50 rounded-2xl border-2 border-dashed border-gray-100 mt-4">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100 text-gray-300">
                    <i class="bi bi-inbox fs-2"></i>
                </div>
                <h3 class="text-base font-bold text-gray-800">Tidak Ada Data Kehadiran</h3>
                <p class="text-sm text-gray-500 mt-1">Data yang dicatat anggota akan muncul di sini.</p>
            </div>
        @endif
    </div>

    <!-- Modal Edit -->
    @if ($editId !== null)
    <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in font-jakarta">
        <div class="bg-white rounded-[32px] shadow-2xl w-full max-w-md overflow-hidden transform transition-all animate-zoom-in">
            <div class="bg-teal-700 px-6 py-5 text-white flex justify-between items-center">
                <h2 class="text-lg font-bold">Edit Kehadiran</h2>
                <button wire:click="$set('editId', null)" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-all text-white">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 block">Nama Anggota</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400"><i class="bi bi-person"></i></span>
                        <input type="text" wire:model="nama" class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-semibold text-gray-700" placeholder="Nama lengkap">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 block">Status Kehadiran</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400"><i class="bi bi-check2-circle"></i></span>
                        <select wire:model="status" class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-teal-600 transition-all font-semibold text-gray-700 appearance-none">
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                        <span class="absolute right-4 top-3 text-gray-400 pointer-events-none"><i class="bi bi-chevron-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5 bg-gray-50 flex flex-col md:flex-row gap-3">
                <button wire:click="$set('editId', null)" class="flex-1 px-6 py-3 bg-white border border-gray-200 rounded-2xl font-bold text-gray-600 hover:bg-gray-100 transition-all">Batal</button>
                <button wire:click="update" class="flex-1 px-6 py-3 bg-teal-700 rounded-2xl font-bold text-white shadow-lg hover:shadow-teal-700/30 hover:scale-[1.02] active:scale-95 transition-all">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Delete -->
    @if ($deleteId !== null)
    <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in font-jakarta">
        <div class="bg-white rounded-[32px] shadow-2xl w-full max-w-sm overflow-hidden p-8 text-center animate-zoom-in">
            <div class="w-20 h-20 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="bi bi-exclamation-triangle fs-1"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Hapus Data?</h2>
            <p class="text-gray-500 mt-2 text-sm">Data yang dihapus tidak dapat <br>dikembalikan lagi.</p>

            <div class="flex flex-col gap-3 mt-8">
                <button wire:click="delete" class="w-full py-3 bg-rose-600 text-white rounded-2xl font-bold shadow-lg shadow-rose-600/30 hover:bg-rose-700 transition-all">Ya, Hapus Sekarang</button>
                <button wire:click="$set('deleteId', null)" class="w-full py-3 bg-gray-50 text-gray-500 rounded-2xl font-bold border border-gray-100 hover:bg-gray-100 transition-all">Batalkan</button>
            </div>
        </div>
    </div>
    @endif

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .animate-fade-in { animation: fadeIn 0.2s ease-out; }
        .animate-zoom-in { animation: zoomIn 0.2s ease-out; }
    </style>
</div>