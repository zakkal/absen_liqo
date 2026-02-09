<div class="font-jakarta">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="max-w-6xl mx-auto p-0">
        <header class="mb-1 text-center md:text-left">
            <div class="inline-flex items-center gap-1.5 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100 mb-1">
                <span class="w-1 h-1 bg-teal-500 rounded-full animate-pulse"></span>
                <span class="text-teal-700 text-[8px] font-black tracking-widest uppercase">E-Presensi Halaqah</span>
            </div>
            <h1 class="text-xl md:text-3xl font-black text-slate-800 tracking-tight leading-none">Presensi <span class="text-teal-600">Hari Ini</span></h1>
        </header>

        {{-- Notifications --}}
        @if(session()->has('success') || session()->has('error'))
        <div class="mb-3">
            @if(session()->has('success'))
            <div class="p-3 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl shadow-sm flex items-center gap-2 animate-fade-in" role="alert">
                <i class="bi bi-check-circle-fill text-lg"></i>
                <div class="text-[11px] font-bold">{{ session('success') }}</div> 
            </div>
            @endif
            @if(session()->has('error'))
            <div class="p-3 bg-rose-50 border border-rose-100 text-rose-700 rounded-xl shadow-sm flex items-center gap-2 animate-fade-in" role="alert">
                <i class="bi bi-exclamation-circle-fill text-lg"></i>
                <div class="text-[11px] font-bold">{{ session('error') }}</div> 
            </div>
            @endif
        </div>
        @endif

        {{-- Form Section --}}
        <div class="bg-white p-4 md:p-6 rounded-[1.5rem] shadow-xl shadow-slate-200/40 mb-5 border border-slate-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-teal-50 rounded-bl-full -z-0 opacity-40"></div>
            
            @if($alreadySubmitted)
                <div class="text-center py-2 md:py-4 relative z-10">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-2 border-2 border-white shadow-md">
                        <i class="bi bi-person-check-fill text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-lg font-black text-slate-800 mb-0.5">Presensi Diterima!</h3>
                    <p class="text-slate-500 text-[10px] md:text-xs max-w-sm mx-auto">Anda sudah absen pada <br><span class="font-bold text-teal-600">{{ now()->translatedFormat('d F Y') }}</span>.</p>
                </div>
            @else
            <form wire:submit.prevent="simpan" class="space-y-6 relative z-10">
                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Name (Readonly) --}}
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Identitas Diri</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="bi bi-person-fill"></i></span>
                            <input type="text" value="{{ auth()->user()->name }}" readonly class="w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl font-bold text-slate-700 focus:outline-none cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Status Selection --}}
                    <div>
                        <label class="text-xs font-bold text-teal-600 uppercase tracking-widest mb-2 block">Status Kehadiran</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-teal-600"><i class="bi bi-check2-circle"></i></span>
                            <select wire:model="status" class="w-full pl-12 pr-4 py-4 bg-teal-50/50 border-2 border-teal-100 rounded-2xl font-bold text-teal-900 focus:ring-2 focus:ring-teal-500 focus:border-transparent appearance-none transition-all">
                                <option value="">Pilih Kehadiran</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                            </select>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-teal-400 pointer-events-none"><i class="bi bi-chevron-down"></i></span>
                        </div>
                        @error('status') <span class="text-rose-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 block">Keterangan Tambahan</label>
                    <textarea wire:model="keterangan" rows="3" placeholder="Tuliskan alasan jika Izin/Sakit..." class="w-full p-4 bg-slate-50 border-2 border-slate-50 rounded-2xl font-medium text-slate-700 focus:bg-white focus:border-teal-500 transition-all focus:outline-none"></textarea>
                    @error('keterangan') <span class="text-rose-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="group w-full md:w-auto px-10 py-4 bg-teal-600 text-white font-black rounded-2xl shadow-xl shadow-teal-600/20 hover:bg-teal-700 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                    KIRIM PRESENSI
                    <i class="bi bi-send-fill text-sm group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
            @endif
        </div>

        {{-- History Table --}}
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h2 class="text-xl md:text-2xl font-black text-slate-800 mb-6 flex items-center gap-3">
                <span class="w-2 h-8 bg-teal-500 rounded-full"></span>
                Riwayat Presensi Terbaru
            </h2>
            
            <div class="overflow-x-auto -mx-4 md:mx-0">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">No.</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest hidden md:table-cell">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($kehadirans as $data)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-700">{{ $data->nama }}</div>
                                    <div class="md:hidden text-[10px] text-slate-400 mt-0.5">{{ $data->created_at->format('d M, H:i') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $style = match($data->status) {
                                            'Hadir' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'Izin' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            'Sakit' => 'bg-rose-100 text-rose-700 border-rose-200',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 text-[10px] font-black rounded-full border {{ $style }}">{{ strtoupper($data->status) }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium hidden md:table-cell">
                                    {{ $data->created_at->translatedFormat('d F Y, H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-10">
                                    <div class="text-slate-300 mb-2"><i class="bi bi-inbox text-4xl"></i></div>
                                    <p class="text-sm font-bold text-slate-400 tracking-wide">Belum ada riwayat presensi.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</div>