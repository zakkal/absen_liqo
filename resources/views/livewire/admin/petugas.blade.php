<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    {{-- NOTIFIKASI --}}
    @if (session()->has('success'))
        <div class="fixed top-4 right-4 z-[9999] animate-bounce">
            <div class="bg-indigo-600 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-indigo-400">
                <i class="bi bi-check-circle-fill"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="font-jakarta pb-10">
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div class="space-y-1">
                <h2 class="text-3xl font-black text-gray-800 tracking-tight">Daftar Petugas</h2>
                <div class="flex items-center gap-2 text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full w-fit border border-indigo-100">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Manajemen Roster</span>
                </div>
            </div>
            <button wire:click="$set('showCreate', true)" class="flex items-center justify-center gap-3 px-8 py-4 bg-[#00796B] hover:bg-[#004D40] text-white rounded-2xl font-bold shadow-lg shadow-emerald-900/20 transition-all transform hover:scale-[1.02] active:scale-95 group">
                <i class="bi bi-person-plus-fill group-hover:scale-110 transition-transform"></i>
                <span>Tambah Penugasan</span>
            </button>
        </div>

        {{-- LIST DATA (CARD STYLE - VERSION 2) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse ($petugas as $index => $item)
                <div class="bg-white rounded-[45px] p-8 md:p-10 border border-gray-100 shadow-sm hover:shadow-2xl hover:border-indigo-100 transition-all group relative overflow-hidden flex flex-col h-full">
                    {{-- Decorative Circle --}}
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-1000"></div>
                    
                    <div class="relative grow">
                        {{-- Card Header --}}
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-indigo-600 text-white rounded-3xl flex items-center justify-center shadow-lg shadow-indigo-600/30">
                                    <i class="bi bi-calendar-event text-2xl"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] block">Pertemuan</span>
                                    <span class="text-xl font-black text-gray-800 tracking-tight">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="openEdit({{ $item->id }})" class="w-11 h-11 bg-sky-50 text-sky-600 rounded-2xl hover:bg-sky-600 hover:text-white transition-all flex items-center justify-center shadow-sm border border-sky-100">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button wire:click="openDelete({{ $item->id }})" class="w-11 h-11 bg-rose-50 text-rose-600 rounded-2xl hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center shadow-sm border border-rose-100">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Roles Grid (2 Columns Layout - Req 2) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-5 bg-gray-50 rounded-[30px] border border-gray-100 group-hover:bg-white transition-all">
                                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest block mb-2">Pembukaan</span>
                                <span class="text-base font-bold text-gray-700">{{ $item->pembukaan }}</span>
                            </div>
                            <div class="p-5 bg-gray-50 rounded-[30px] border border-gray-100 group-hover:bg-white transition-all">
                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest block mb-2">Tilawah</span>
                                <span class="text-base font-bold text-gray-700">{{ $item->tilawah }}</span>
                            </div>
                            <div class="p-5 bg-gray-50 rounded-[30px] border border-gray-100 group-hover:bg-white transition-all">
                                <span class="text-[9px] font-black text-purple-500 uppercase tracking-widest block mb-2">Kultum</span>
                                <span class="text-base font-bold text-gray-700">{{ $item->kultum }}</span>
                            </div>
                            <div class="p-5 bg-gray-50 rounded-[30px] border border-gray-100 group-hover:bg-white transition-all">
                                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest block mb-2">Materi</span>
                                <span class="text-base font-bold text-gray-700">{{ $item->materi }}</span>
                            </div>
                            <div class="p-5 bg-gray-50 rounded-[30px] border border-gray-100 group-hover:bg-white transition-all">
                                <span class="text-[9px] font-black text-orange-500 uppercase tracking-widest block mb-2">Diskusi</span>
                                <span class="text-base font-bold text-gray-700">{{ $item->diskusi }}</span>
                            </div>
                            <div class="p-5 bg-gray-50 rounded-[30px] border border-gray-100 group-hover:bg-white transition-all">
                                <span class="text-[9px] font-black text-cyan-500 uppercase tracking-widest block mb-2">Qodoya</span>
                                <span class="text-base font-bold text-gray-700">{{ $item->qodoya }}</span>
                            </div>
                            <div class="p-6 bg-gray-50 rounded-[32px] border border-gray-100 group-hover:bg-white transition-all sm:col-span-2 text-center border-dashed">
                                <span class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] block mb-2">Doa Penutup</span>
                                <span class="text-lg font-black text-gray-800 tracking-wider">{{ $item->doa_penutup }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-2 bg-white rounded-[50px] p-24 text-center border-2 border-dashed border-gray-100 shadow-inner">
                    <div class="w-24 h-24 bg-indigo-50 text-indigo-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="bi bi-people-fill text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Data Petugas Kosong</h3>
                    <p class="text-gray-400 text-sm mt-3 max-w-sm mx-auto leading-relaxed">Kelola dan atur roster petugas halaqah di sini.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- MODAL CREATE --}}
    @if ($showCreate)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in font-jakarta">
            <div class="bg-white rounded-[50px] shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all animate-zoom-in border border-white/20 flex flex-col max-h-[90vh]">
                <div class="bg-[#00796B] px-8 py-8 text-white flex justify-between items-center relative overflow-hidden shrink-0">
                    <div class="absolute -right-20 -top-20 w-60 h-60 bg-white/10 rounded-full"></div>
                    <div class="relative">
                        <h2 class="text-3xl font-black tracking-tight leading-none">Input Petugas</h2>
                        <p class="text-emerald-100 text-[10px] font-bold uppercase tracking-[0.2em] mt-3 opacity-80">Siapkan Petugas Pertemuan</p>
                    </div>
                    <button wire:click="$set('showCreate', false)" class="relative w-14 h-14 rounded-3xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all text-white backdrop-blur-md">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <div class="p-8 md:p-12 space-y-8 overflow-y-auto grow custom-scrollbar">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.3em] border-b border-emerald-100 pb-2">Bagian Awal</h4>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Pembukaan</label>
                                <input type="text" wire:model="pembukaan" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-emerald-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 shadow-inner" placeholder="...">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Tilawah</label>
                                <input type="text" wire:model="tilawah" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-emerald-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 shadow-inner" placeholder="...">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Kultum</label>
                                <input type="text" wire:model="kultum" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-emerald-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 shadow-inner" placeholder="...">
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.3em] border-b border-indigo-100 pb-2">Bagian Inti</h4>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Materi</label>
                                <input type="text" wire:model="materi" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-indigo-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 shadow-inner" placeholder="...">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Diskusi</label>
                                <input type="text" wire:model="diskusi" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-indigo-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 shadow-inner" placeholder="...">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Qodoya</label>
                                <input type="text" wire:model="qodoya" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-indigo-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 shadow-inner" placeholder="...">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 pt-4 text-center">
                        <h4 class="text-[10px] font-black text-rose-600 uppercase tracking-[0.3em] border-b border-rose-100 pb-2">Penutup</h4>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Doa Penutup</label>
                            <input type="text" wire:model="doa_penutup" class="w-full px-8 py-5 bg-rose-50 border-2 border-transparent rounded-[32px] focus:border-rose-600 focus:bg-white focus:ring-0 transition-all font-black text-rose-700 shadow-inner text-center" placeholder="Nama Petugas">
                        </div>
                    </div>
                </div>

                <div class="px-8 py-8 bg-gray-50 flex gap-4 shrink-0 border-t border-gray-100/50">
                    <button wire:click="$set('showCreate', false)" class="flex-1 px-8 py-5 bg-white border-2 border-gray-100 rounded-[28px] font-bold text-gray-400 hover:text-gray-600 transition-all uppercase tracking-widest text-[10px]">Batalkan</button>
                    <button wire:click="create" class="flex-[2] px-8 py-5 bg-[#00796B] rounded-[28px] font-black text-white shadow-xl shadow-emerald-900/20 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest">Simpan Data</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL EDIT --}}
    @if ($editId)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in font-jakarta">
            <div class="bg-white rounded-[50px] shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all animate-zoom-in border border-white/20 flex flex-col max-h-[90vh]">
                <div class="bg-sky-700 px-8 py-8 text-white flex justify-between items-center relative overflow-hidden shrink-0">
                    <div class="absolute -right-20 -top-20 w-60 h-60 bg-white/10 rounded-full"></div>
                    <div class="relative">
                        <h2 class="text-3xl font-black tracking-tight leading-none">Update Petugas</h2>
                        <p class="text-sky-100 text-[10px] font-bold uppercase tracking-[0.2em] mt-3 opacity-80">Roster Update</p>
                    </div>
                    <button wire:click="$set('editId', null)" class="relative w-14 h-14 rounded-3xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all text-white backdrop-blur-md">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <div class="p-8 md:p-12 space-y-8 overflow-y-auto grow custom-scrollbar">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-sky-600 uppercase tracking-[0.3em] border-b border-sky-100 pb-2">Bagian Awal</h4>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Pembukaan</label>
                                <input type="text" wire:model="pembukaan" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Tilawah</label>
                                <input type="text" wire:model="tilawah" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Kultum</label>
                                <input type="text" wire:model="kultum" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700">
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-sky-600 uppercase tracking-[0.3em] border-b border-sky-100 pb-2">Bagian Inti</h4>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Materi</label>
                                <input type="text" wire:model="materi" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Diskusi</label>
                                <input type="text" wire:model="diskusi" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Qodoya</label>
                                <input type="text" wire:model="qodoya" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6 pt-4 text-center">
                        <h4 class="text-[10px] font-black text-sky-600 uppercase tracking-[0.3em] border-b border-sky-100 pb-2">Bagian Penutup</h4>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Doa Penutup</label>
                            <input type="text" wire:model="doa_penutup" class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:border-sky-600 focus:bg-white focus:ring-0 transition-all font-bold text-gray-700 text-center">
                        </div>
                    </div>
                </div>

                <div class="px-8 py-8 bg-gray-50 flex gap-4 shrink-0 border-t border-gray-100/50">
                    <button wire:click="$set('editId', null)" class="flex-1 px-8 py-5 bg-white border-2 border-gray-100 rounded-[28px] font-bold text-gray-400 hover:text-gray-600 transition-all uppercase tracking-widest text-[10px]">Batal</button>
                    <button wire:click="update" class="flex-[2] px-8 py-5 bg-sky-700 rounded-[28px] font-black text-white shadow-xl shadow-sky-900/20 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest">Update Data</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL DELETE --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in font-jakarta">
            <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-sm overflow-hidden p-10 text-center transform transition-all animate-zoom-in">
                <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                    <i class="bi bi-person-x-fill text-4xl"></i>
                </div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight leading-none">Hapus Jadwal?</h2>
                <p class="text-gray-400 mt-4 text-xs font-bold leading-relaxed px-4">Seluruh data penugasan ini akan dihapus permanen. Lanjutkan?</p>

                <div class="flex flex-col gap-3 mt-10">
                    <button wire:click="delete" class="w-full py-4 bg-rose-600 text-white rounded-2xl font-black shadow-xl shadow-rose-900/30 hover:bg-rose-700 active:scale-95 transition-all text-xs uppercase tracking-widest">Ya, Hapus Sekarang</button>
                    <button wire:click="$set('deleteId', null)" class="w-full py-4 bg-gray-50 text-gray-500 rounded-2xl font-bold border border-gray-100 hover:bg-gray-100 transition-all text-[10px] uppercase tracking-widest">Batalkan</button>
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .animate-fade-in { animation: fadeIn 0.3s ease-out; }
        .animate-zoom-in { animation: zoomIn 0.3s ease-out; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</div>
