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
                <div class="bg-white rounded-[32px] p-6 md:p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:border-emerald-100 transition-all group relative overflow-hidden">
                    {{-- Status Badge (Top Right) --}}
                    <div class="absolute top-0 right-10 flex gap-2">
                        <div class="px-4 py-2 {{ $item->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} rounded-b-2xl text-[10px] font-black uppercase tracking-widest border-x border-b border-current opacity-40 group-hover:opacity-100 transition-opacity">
                            {{ $item->is_active ? 'Aktif' : 'Draft' }}
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        {{-- Date Section --}}
                        <div class="shrink-0 flex md:flex-col items-center justify-center bg-gray-50 text-gray-400 rounded-[28px] p-5 w-full md:w-24 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                            <span class="text-3xl font-black leading-none">{{ $item->created_at->format('d') }}</span>
                            <span class="text-[10px] font-black uppercase tracking-widest mt-2">{{ $item->created_at->format('M Y') }}</span>
                        </div>

                        {{-- Content Section --}}
                        <div class="grow space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $item->created_at->diffForHumans() }}</span>
                                <div class="w-1 h-1 rounded-full bg-gray-200"></div>
                                <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Official Post</span>
                            </div>
                            
                            <h3 class="text-2xl font-black text-gray-800 tracking-tight group-hover:text-[#00796B] transition-colors leading-tight">
                                {{ $item->judul }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 md:line-clamp-3 font-medium">
                                {{ $item->isi }}
                            </p>
                            
                            <div class="flex items-center gap-4 pt-2">
                                <button wire:click="toggleStatus({{ $item->id }})" class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-full border border-gray-100 hover:bg-emerald-50 hover:border-emerald-100 transition-all">
                                    <div class="relative inline-flex h-4 w-8 items-center rounded-full transition-colors {{ $item->is_active ? 'bg-emerald-600' : 'bg-gray-300' }}">
                                        <span class="inline-block h-2 w-2 transform rounded-full bg-white transition-transform {{ $item->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                    </div>
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $item->is_active ? 'Hide Info' : 'Show Info' }}</span>
                                </button>
                            </div>
                        </div>

                        {{-- Action Sidebar --}}
                        <div class="shrink-0 flex md:flex-col gap-3 w-full md:w-auto mt-6 md:mt-0 pt-6 md:pt-0 border-t md:border-t-0 md:border-l border-gray-50 md:pl-8 justify-end">
                            <button wire:click="openEdit({{ $item->id }})" class="flex-1 md:flex-none p-4 bg-sky-50 text-sky-600 rounded-2xl hover:bg-sky-600 hover:text-white transition-all shadow-sm flex items-center justify-center gap-3 font-black text-xs uppercase tracking-widest">
                                <i class="bi bi-pencil-square"></i>
                                <span class="md:hidden lg:inline">Edit</span>
                            </button>
                            <button wire:click="openDelete({{ $item->id }})" class="flex-1 md:flex-none p-4 bg-rose-50 text-rose-600 rounded-2xl hover:bg-rose-600 hover:text-white transition-all shadow-sm flex items-center justify-center gap-3 font-black text-xs uppercase tracking-widest">
                                <i class="bi bi-trash-fill"></i>
                                <span class="md:hidden lg:inline">Hapus</span>
                            </button>
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
