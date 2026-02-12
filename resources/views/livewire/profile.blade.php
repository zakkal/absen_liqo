<div class="font-jakarta max-w-4xl mx-auto p-4 md:p-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        @keyframes subtle-float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
        .animate-float { animation: subtle-float 3s ease-in-out infinite; }
    </style>

    {{-- Header Section --}}
    <header class="mb-8 relative">
        <div class="bg-gradient-to-r from-teal-600 to-emerald-500 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-teal-200 relative overflow-hidden">
            {{-- Decorative Circles --}}
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-emerald-300/20 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="relative group animate-float">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-white/50 shadow-xl overflow-hidden bg-white">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif ($current_photo)
                            <img src="{{ asset('storage/' . $current_photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-teal-50">
                                <i class="bi bi-person-fill text-teal-200 text-5xl"></i>
                            </div>
                        @endif
                    </div>
                    <label for="photo_input" class="absolute bottom-1 right-1 bg-white p-2 rounded-full shadow-lg cursor-pointer transform transition-transform hover:scale-110 active:scale-95">
                        <i class="bi bi-camera-fill text-teal-600"></i>
                        <input type="file" id="photo_input" wire:model="photo" class="hidden" accept="image/*">
                    </label>
                    <div wire:loading wire:target="photo" class="absolute inset-0 flex items-center justify-center bg-black/20 rounded-full">
                        <div class="spinner-border animate-spin inline-block w-6 h-6 border-2 border-white border-t-transparent rounded-full"></div>
                    </div>
                </div>

                <div class="text-center md:text-left flex-1">
                    <div class="inline-flex items-center gap-2 bg-white/20 px-3 py-1 rounded-full border border-white/30 mb-3">
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        <span class="text-white text-[10px] font-black tracking-widest uppercase">{{ auth()->user()->role === 'admin' ? 'Admin Profile' : 'Member Profile' }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-none mb-2">{{ auth()->user()->name }}</h1>
                    <p class="text-teal-50 text-sm md:text-base font-medium opacity-90">Atur informasi profil dan foto Anda di halaman ini.</p>
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                <h3 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-teal-500 rounded-full"></span>
                    Informasi Dasar
                </h3>

                @if (session()->has('status'))
                    <div class="mb-6 animate-fade-in">
                        <div class="p-4 bg-amber-50 border border-amber-100 text-amber-700 rounded-2xl flex items-center gap-3">
                            <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                            <div class="text-sm font-bold">{{ session('status') }}</div>
                        </div>
                    </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 transition-colors group-focus-within:text-teal-600">
                                <i class="bi bi-person-circle"></i>
                            </span>
                            <input type="text" wire:model="name" class="w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl font-bold text-slate-700 focus:bg-white focus:border-teal-500 transition-all focus:outline-none" placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name') <span class="text-rose-500 text-[10px] font-bold mt-1 ml-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nomor WhatsApp</label>
                        <div class="relative group">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 transition-colors group-focus-within:text-teal-600">
                                <i class="bi bi-whatsapp"></i>
                            </span>
                            <input type="text" wire:model="no_wa" class="w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl font-bold text-slate-700 focus:bg-white focus:border-teal-500 transition-all focus:outline-none" placeholder="Contoh: 08123456xxxx">
                        </div>
                        @error('no_wa') <span class="text-rose-500 text-[10px] font-bold mt-1 ml-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="group w-full md:w-auto px-10 py-4 bg-teal-600 text-white font-black rounded-2xl shadow-xl shadow-teal-600/20 hover:bg-teal-700 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                            <span wire:loading.remove wire:target="save">SIMPAN PERUBAHAN</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                <div class="spinner-border animate-spin w-4 h-4 border-2 border-white border-t-transparent rounded-full"></div>
                                MENYIMPAN...
                            </span>
                            <i class="bi bi-arrow-right text-sm group-hover:translate-x-1 transition-transform" wire:loading.remove wire:target="save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-8">
            <div class="bg-slate-900 p-8 rounded-[2rem] text-white shadow-xl shadow-slate-900/20">
                <h3 class="text-lg font-black mb-6 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-teal-400 rounded-full"></span>
                    Akun Saya
                </h3>
                
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                            <i class="bi bi-shield-lock-fill text-xl text-teal-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role</p>
                            <p class="font-black text-sm">{{ strtoupper(auth()->user()->role ?? 'Member') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                            <i class="bi bi-calendar-check text-xl text-teal-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bergabung</p>
                            <p class="font-black text-sm">{{ auth()->user()->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-emerald-50 p-6 rounded-[2rem] border border-emerald-100">
                <h4 class="font-black text-emerald-800 mb-2 flex items-center gap-2">
                    <i class="bi bi-info-circle-fill"></i>
                    Tips Profil
                </h4>
                <p class="text-emerald-700/70 text-xs leading-relaxed font-medium">
                    Gunakan foto yang jelas untuk memudahkan verifikasi kehadiran oleh petugas halaqah. Pastikan nomor WhatsApp aktif untuk mendapatkan notifikasi penting.
                </p>
            </div>
        </div>
    </div>
</div>

