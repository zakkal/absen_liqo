<div class="font-jakarta pb-20">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>

    {{-- Top Mobile Header Style --}}
    <div class="mb-8 px-2">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-1 block">Update Terbaru</span>
                <h2 class="text-3xl font-black text-gray-800 tracking-tighter">Pengumuman</h2>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 border border-emerald-100 shadow-sm">
                <i class="bi bi-bell-fill animate-swing"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 px-1">
        @forelse ($pengumumans as $item)
            <div class="glass-card rounded-[35px] overflow-hidden shadow-lg shadow-gray-200/50 border-none group animate-fade-up">
                {{-- Decorative Top Line --}}
                <div class="h-2 w-full bg-gradient-to-r from-emerald-400 to-[#00796B]"></div>
                
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-emerald-600/30">
                            <span class="text-lg font-black leading-none">{{ $item->created_at->format('d') }}</span>
                            <span class="text-[8px] font-bold uppercase">{{ $item->created_at->format('M') }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-800 leading-tight">{{ $item->judul }}</h3>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 rounded-3xl p-5 border border-gray-100/50 relative">
                        <i class="bi bi-quote absolute top-2 right-4 text-emerald-100 text-3xl"></i>
                        <p class="text-gray-600 text-sm leading-relaxed font-medium relative z-10 whitespace-pre-wrap truncate-multi-4">
                            {{ $item->isi }}
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-emerald-600">A</div>
                            <div class="w-8 h-8 rounded-full bg-sky-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-sky-600">D</div>
                            <div class="w-8 h-8 rounded-full bg-emerald-600 border-2 border-white flex items-center justify-center text-[10px] font-bold text-white">M</div>
                        </div>
                        <span class="text-[9px] font-black text-emerald-600 uppercase tracking-[0.2em] bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">Info Halaqah</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-[40px] p-20 text-center border-2 border-dashed border-emerald-100 flex flex-col items-center">
                <div class="w-24 h-24 bg-emerald-50 text-emerald-200 rounded-full flex items-center justify-center mb-6 shadow-inner">
                    <i class="bi bi-inbox-fill text-4xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-800 tracking-tight">Belum Ada Kabar</h3>
                <p class="text-gray-400 text-xs mt-2 max-w-[200px] leading-relaxed">Admin belum memposting pengumuman baru hari ini.</p>
            </div>
        @endforelse
    </div>

    <style>
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-up { animation: fadeUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) both; }
        .truncate-multi-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        @keyframes swing {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(10deg); }
            30% { transform: rotate(-10deg); }
            50% { transform: rotate(5deg); }
            70% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }
        .animate-swing { animation: swing 2s ease-in-out infinite; transform-origin: top center; }
    </style>
</div>