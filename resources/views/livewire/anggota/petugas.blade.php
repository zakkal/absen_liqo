<div class="font-jakarta pb-24">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .timeline-line {
            position: absolute;
            left: 27px;
            top: 40px;
            bottom: 30px;
            width: 2px;
            background: linear-gradient(to bottom, #10b981 0%, #e2e8f0 100%);
            z-index: 0;
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; opacity: 0; }
    </style>

    {{-- Mobile Header --}}
    <div class="mb-10 px-2 flex items-end justify-between">
        <div class="animate-fade-in" style="animation-delay: 100ms">
            <h2 class="text-4xl font-black text-gray-800 tracking-tighter">Timeline</h2>
            <p class="text-emerald-600 font-bold text-[10px] uppercase tracking-[0.3em] mt-1 ml-1">Halaqah Petugas</p>
        </div>
        <div class="bg-emerald-600 w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30 animate-fade-in" style="animation-delay: 200ms">
            <i class="bi bi-stack text-lg"></i>
        </div>
    </div>

    @forelse ($petugas as $index => $item)
        <div class="mb-20 last:mb-0 relative {{ $index > 0 ? 'opacity-50 grayscale-[0.3]' : '' }} animate-fade-in" style="animation-delay: {{ 300 + ($index * 100) }}ms">
            {{-- Date Divider --}}
            <div class="flex items-center gap-4 mb-10">
                <div class="bg-gray-900 text-white px-7 py-3 rounded-[24px] font-black text-sm shadow-xl flex items-center gap-3 border border-gray-700">
                    <i class="bi bi-calendar3 text-emerald-400"></i>
                    {{ $item->created_at->format('d M Y') }}
                </div>
                <div class="h-[2px] grow bg-gray-100 rounded-full"></div>
            </div>

            <div class="relative pl-14 space-y-6">
                {{-- Vertical Line --}}
                <div class="timeline-line"></div>

                {{-- Roles List --}}
                @php
                    $duties = [
                        ['title' => 'Pembukaan', 'name' => $item->pembukaan, 'icon' => 'bi-megaphone-fill', 'color' => 'bg-emerald-600'],
                        ['title' => 'Tilawah Al-Qur\'an', 'name' => $item->tilawah, 'icon' => 'bi-book-half', 'color' => 'bg-blue-600'],
                        ['title' => 'Kultum / Tazkiyah', 'name' => $item->kultum, 'icon' => 'bi-chat-heart-fill', 'color' => 'bg-purple-600'],
                        ['title' => 'Penyampaian Materi', 'name' => $item->materi, 'icon' => 'bi-journal-check', 'color' => 'bg-sky-600'],
                        ['title' => 'Diskusi / Tanya Jawab', 'name' => $item->diskusi, 'icon' => 'bi-people-fill', 'color' => 'bg-orange-600'],
                        ['title' => 'Qodoya / Masalah', 'name' => $item->qodoya, 'icon' => 'bi-lightbulb-fill', 'color' => 'bg-indigo-600'],
                    ];
                @endphp

                @foreach($duties as $step => $duty)
                    <div class="relative group animate-fade-in" style="animation-delay: {{ 400 + ($step * 50) }}ms">
                        <div class="absolute -left-[56px] top-1 w-14 h-14 {{ $duty['color'] }} text-white rounded-[20px] flex items-center justify-center shadow-lg border-4 border-white z-10 group-hover:scale-110 transition-transform">
                            <i class="bi {{ $duty['icon'] }} text-lg"></i>
                        </div>
                        <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm group-hover:shadow-md transition-all group-hover:border-emerald-100">
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] block mb-1">{{ $duty['title'] }}</span>
                            <h4 class="text-lg font-black text-gray-800 leading-tight">{{ $duty['name'] }}</h4>
                        </div>
                    </div>
                @endforeach
                
                {{-- Final Step: Doa --}}
                <div class="relative group animate-fade-in" style="animation-delay: 800ms">
                    <div class="absolute -left-[56px] top-1 w-14 h-14 bg-rose-600 text-white rounded-full flex items-center justify-center shadow-xl shadow-rose-600/30 z-10 border-4 border-white group-hover:rotate-12 transition-transform">
                        <i class="bi bi-balloon-heart-fill text-xl"></i>
                    </div>
                    <div class="bg-rose-50/50 rounded-[35px] p-7 border border-rose-100 group-hover:bg-rose-50 transition-colors">
                        <span class="text-[9px] font-black text-rose-500 uppercase tracking-[0.3em] block mb-2">Doa Penutup</span>
                        <h4 class="text-2xl font-black text-rose-950 tracking-tight">{{ $item->doa_penutup }}</h4>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-[60px] p-24 text-center border-4 border-dashed border-gray-50 shadow-inner flex flex-col items-center">
            <div class="w-32 h-32 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mb-8">
                <i class="bi bi-calendar2-minus text-6xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-800 tracking-tight">Timeline Kosong</h3>
            <p class="text-gray-400 text-xs mt-3 uppercase tracking-widest font-black leading-relaxed">Admin belum merilis jadwal pekan ini</p>
        </div>
    @endforelse
</div>
