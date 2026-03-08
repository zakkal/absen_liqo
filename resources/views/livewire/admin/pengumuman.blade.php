<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    {{-- NOTIFIKASI --}}
    @if (session()->has('success'))
        <div class="fixed top-4 right-4 z-[9999] animate-bounce">
            <div class="bg-emerald-600 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-emerald-400">
                <i class="bi bi-check-circle-fill"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="font-jakarta pb-10">
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div class="space-y-1">
                <h2 class="text-3xl font-black text-gray-800 tracking-tight">Pengumuman</h2>
                <div class="flex items-center gap-2 text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Portal Informasi Admin</span>
                </div>
            </div>
            <button wire:click="$set('showCreate', true)" class="flex items-center justify-center gap-3 px-8 py-4 bg-[#00796B] hover:bg-[#004D40] text-white rounded-2xl font-bold shadow-lg shadow-emerald-900/20 transition-all transform hover:scale-[1.02] active:scale-95 group">
                <i class="bi bi-plus-lg group-hover:rotate-90 transition-transform"></i>
                <span>Buat Pengumuman</span>
            </button>
        </div>

        {{-- LIST DATA (CARD STYLE) --}}
        <div class="grid grid-cols-1 gap-6">
            @forelse ($informasi as $index => $item)
                <div class="bg-white rounded-[28px] p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-100 transition-all group relative">
                    {{-- Status Badge (Mobile Top Right) --}}
                    <div class="absolute top-5 right-5 flex md:hidden gap-2">
                        <div class="px-4 py-1.5 {{ $item->is_active ? 'text-emerald-500 border-emerald-500' : 'text-rose-500 border-rose-500' }} rounded-full text-[9px] font-black uppercase tracking-widest border border-[1.5px]">
                            {{ $item->is_active ? 'Aktif' : 'Draft' }}
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-5 md:gap-7 items-stretch">
                        {{-- Date Pill --}}
                        <div class="shrink-0 flex flex-col items-center justify-center bg-slate-50 text-slate-300 rounded-[24px] w-full md:w-28 py-6 md:py-8 transition-colors group-hover:bg-emerald-50 group-hover:text-emerald-400">
                            <span class="text-[2.2rem] font-black leading-none mb-1">{{ $item->created_at->format('d') }}</span>
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-center leading-tight">
                                {{ $item->created_at->format('M') }}<br>{{ $item->created_at->format('Y') }}
                            </span>
                        </div>

                        {{-- Content Section --}}
                        <div class="grow flex flex-col py-1 mt-2 md:mt-1 w-full pl-0 md:pl-2">
                            <div class="flex items-center gap-2.5 mb-2.5 mt-2 md:mt-0">
                                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">{{ $item->created_at->diffForHumans() }}</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">Official Post</span>
                            </div>
                            
                            <h3 class="text-xl md:text-[22px] font-black text-slate-800 tracking-tight uppercase mb-2">
                                {{ $item->judul }}
                            </h3>
                            
                            <div class="text-slate-500 text-[13px] md:text-sm leading-relaxed font-medium text-left pr-0 md:pr-4" style="white-space: pre-wrap;">{{ $item->isi }}</div>
                            
                            <div class="mt-4 md:mt-auto pt-2">
                                <button wire:click="toggleStatus({{ $item->id }})" class="flex items-center gap-2.5 bg-white px-4 py-2 rounded-full border-[1.5px] border-slate-100 hover:border-emerald-200 transition-all group/toggle shadow-sm w-fit">
                                    <div class="relative inline-flex h-[14px] w-7 items-center rounded-full transition-colors {{ $item->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                        <span class="inline-block h-2.5 w-2.5 transform rounded-full bg-white transition-transform {{ $item->is_active ? 'translate-x-[14px]' : 'translate-x-[2px]' }}"></span>
                                    </div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest group-hover/toggle:text-emerald-500">{{ $item->is_active ? 'Hide Info' : 'Show Info' }}</span>
                                </button>
                            </div>
                        </div>

                        {{-- Action Sidebar --}}
                        <div class="shrink-0 flex flex-col w-full md:w-[110px] justify-between md:pl-6 mt-4 md:mt-0 gap-3 md:gap-0 relative">
                            {{-- Status Badge (Desktop) --}}
                            <div class="hidden md:flex justify-end pt-1">
                                <div class="px-4 py-1.5 {{ $item->is_active ? 'text-emerald-500 border-emerald-500' : 'text-rose-500 border-rose-500' }} rounded-full text-[9px] font-black uppercase tracking-widest border border-[1.5px]">
                                    {{ $item->is_active ? 'Aktif' : 'Draft' }}
                                </div>
                            </div>

                            <div class="flex md:flex-col gap-2.5 w-full mt-auto mb-1">
                                <button wire:click="openEdit({{ $item->id }})" class="w-full py-2.5 md:py-3 bg-[#f8fafc] text-sky-500 rounded-xl md:rounded-2xl hover:bg-sky-50 transition-all font-black text-[9px] md:text-[10px] uppercase tracking-widest flex items-center justify-center gap-2">
                                    <i class="bi bi-pencil-square text-[11px] md:text-[12px]"></i>
                                    <span>Edit</span>
                                </button>
                                <button wire:click="openDelete({{ $item->id }})" class="w-full py-2.5 md:py-3 bg-[#fff1f2] text-rose-500 rounded-xl md:rounded-2xl hover:bg-rose-50 transition-all font-black text-[9px] md:text-[10px] uppercase tracking-widest flex items-center justify-center gap-2">
                                    <i class="bi bi-trash-fill text-[11px] md:text-[12px]"></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[50px] p-24 text-center border-2 border-dashed border-gray-100 shadow-inner">
                    <div class="w-24 h-24 bg-emerald-50 text-emerald-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="bi bi-megaphone-fill text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Belum Ada Pengumuman</h3>
                    <p class="text-gray-400 text-sm mt-3 max-w-sm mx-auto leading-relaxed">Kelola semua informasi yang ingin Anda sampaikan kepada anggota di sini.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- MODAL CREATE --}}
    @if ($showCreate)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-xl overflow-hidden transform transition-all animate-zoom-in border border-white/20 flex flex-col max-h-[90vh]">
                <div class="bg-[#00796B] px-8 py-8 text-white flex justify-between items-center relative overflow-hidden shrink-0">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
                    <div class="relative">
                        <h2 class="text-2xl font-black tracking-tight leading-none">Buat Info</h2>
                        <p class="text-emerald-100 text-[10px] font-bold uppercase tracking-[0.2em] mt-2 opacity-80">Publikasikan Pengumuman Baru</p>
                    </div>
                    <button wire:click="$set('showCreate', false)" class="relative w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all text-white backdrop-blur-md">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="p-10 space-y-8 overflow-y-auto flex-1">
                    <div>
                        <label class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-3 block px-1">Judul Strategis</label>
                        <input type="text" wire:model="judul" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-emerald-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-800 shadow-inner" placeholder="Contoh: Info Halaqah Terupdate">
                        @error('judul') <span class="text-rose-500 text-[10px] mt-2 font-bold block px-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-3 block px-1">Narasi Lengkap</label>
                        <textarea wire:model="isi" rows="6" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[32px] focus:border-emerald-600 focus:bg-white focus:ring-0 transition-all font-medium text-gray-700 shadow-inner" placeholder="Tuliskan isi pengumuman secara detail..."></textarea>
                        @error('isi') <span class="text-rose-500 text-[10px] mt-2 font-bold block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between p-7 bg-emerald-50 rounded-[32px] border border-emerald-100">
                        <div>
                            <span class="text-sm font-black text-emerald-900 block leading-none">Visibilitas Publik</span>
                            <span class="text-[10px] text-emerald-500 font-bold uppercase tracking-widest mt-2 block">Langsung tampil di feed anggota?</span>
                        </div>
                        <button wire:click="$toggle('is_active')" class="relative inline-flex h-8 w-14 items-center rounded-full transition-colors {{ $is_active ? 'bg-emerald-600' : 'bg-gray-300' }}">
                            <span class="inline-block h-6 w-6 transform rounded-full bg-white transition-transform {{ $is_active ? 'translate-x-7' : 'translate-x-1' }}"></span>
                        </button>
                    </div>
                </div>

                <div class="px-10 py-8 bg-gray-50 flex gap-4 shrink-0">
                    <button wire:click="$set('showCreate', false)" class="flex-1 px-8 py-5 bg-white border-2 border-gray-100 rounded-[28px] font-bold text-gray-400 hover:text-gray-600 transition-all uppercase tracking-widest text-[10px]">Tutup</button>
                    <button wire:click="create" class="flex-[2] px-8 py-5 bg-[#00796B] rounded-[28px] font-black text-white shadow-xl shadow-emerald-900/20 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest">Terbitkan</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL EDIT --}}
    @if ($editId)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-xl overflow-hidden transform transition-all animate-zoom-in border border-white/20 flex flex-col max-h-[90vh]">
                <div class="bg-sky-700 px-8 py-8 text-white flex justify-between items-center relative overflow-hidden shrink-0">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
                    <div class="relative">
                        <h2 class="text-2xl font-black tracking-tight leading-none">Edit Pengumuman</h2>
                        <p class="text-sky-100 text-[10px] font-bold uppercase tracking-[0.2em] mt-2 opacity-80">Modifikasi Informasi Terbit</p>
                    </div>
                    <button wire:click="$set('editId', null)" class="relative w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all text-white backdrop-blur-md">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="p-10 space-y-8 overflow-y-auto flex-1">
                    <div>
                        <label class="text-[10px] font-black text-sky-600 uppercase tracking-[0.2em] mb-3 block px-1">Judul Update</label>
                        <input type="text" wire:model="judul" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-800 shadow-inner">
                        @error('judul') <span class="text-rose-500 text-[10px] mt-2 font-bold block px-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="text-[10px] font-black text-sky-600 uppercase tracking-[0.2em] mb-3 block px-1">Narasi Lengkap</label>
                        <textarea wire:model="isi" rows="6" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[32px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-medium text-gray-700 shadow-inner"></textarea>
                        @error('isi') <span class="text-rose-500 text-[10px] mt-2 font-bold block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between p-7 bg-sky-50 rounded-[32px] border border-sky-100">
                        <div>
                            <span class="text-sm font-black text-sky-900 block leading-none">Visibilitas Publik</span>
                            <span class="text-[10px] text-sky-500 font-bold uppercase tracking-widest mt-2 block">Tetap tampilkan di anggota?</span>
                        </div>
                        <button wire:click="$toggle('is_active')" class="relative inline-flex h-8 w-14 items-center rounded-full transition-colors {{ $is_active ? 'bg-sky-600' : 'bg-gray-300' }}">
                            <span class="inline-block h-6 w-6 transform rounded-full bg-white transition-transform {{ $is_active ? 'translate-x-7' : 'translate-x-1' }}"></span>
                        </button>
                    </div>
                </div>

                <div class="px-10 py-8 bg-gray-50 flex gap-4 shrink-0">
                    <button wire:click="$set('editId', null)" class="flex-1 px-8 py-5 bg-white border-2 border-gray-100 rounded-[28px] font-bold text-gray-400 hover:text-gray-600 transition-all uppercase tracking-widest text-[10px]">Batal</button>
                    <button wire:click="update" class="flex-[2] px-8 py-5 bg-sky-700 rounded-[28px] font-black text-white shadow-xl shadow-sky-900/20 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest">Update Data</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL DELETE --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-sm overflow-hidden p-10 text-center transform transition-all animate-zoom-in">
                <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                    <i class="bi bi-trash3-fill text-4xl"></i>
                </div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight leading-none">Hapus Data?</h2>
                <p class="text-gray-400 mt-4 text-xs font-bold leading-relaxed px-4">Informasi yang dihapus tidak dapat dikembalikan. Lanjutkan proses penghapusan?</p>

                <div class="flex flex-col gap-3 mt-10">
                    <button wire:click="delete" class="w-full py-4 bg-rose-600 text-white rounded-2xl font-black shadow-xl shadow-rose-900/30 hover:scale-[1.02] active:scale-95 transition-all text-xs uppercase tracking-widest">Ya, Hapus Sekarang</button>
                    <button wire:click="$set('deleteId', null)" class="w-full py-4 bg-gray-50 text-gray-500 rounded-2xl font-bold border border-gray-100 hover:bg-gray-100 transition-all text-[10px] uppercase tracking-widest">Urungkan</button>
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .animate-fade-in { animation: fadeIn 0.3s ease-out; }
        .animate-zoom-in { animation: zoomIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    </style>
</div>
