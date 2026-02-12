@section('title', 'Lupa Password')

<div class="min-h-screen bg-[#F8FAFC] flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-jakarta">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}" class="flex justify-center group">
            <div class="w-20 h-20 bg-white rounded-[28px] shadow-xl shadow-emerald-900/10 flex items-center justify-center border border-emerald-50 group-hover:scale-110 transition-transform duration-500">
                 <i class="bi bi-shield-lock-fill text-4xl text-[#00796B]"></i>
            </div>
        </a>

        <h2 class="mt-8 text-4xl font-black text-center text-gray-800 tracking-tighter leading-tight">
            Lupa Password?
        </h2>
        <p class="mt-3 text-center text-gray-400 font-medium px-6">
            Jangan khawatir, kami akan mengirimkan instruksi pemulihan ke email Anda.
        </p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-12 px-6 shadow-2xl shadow-emerald-900/5 sm:rounded-[45px] sm:px-12 border border-emerald-50 relative overflow-hidden">
            {{-- Decorative Element --}}
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-50 rounded-full opacity-50"></div>
            
            @if ($emailSentMessage)
                <div class="rounded-[30px] bg-emerald-50 p-8 border border-emerald-100 text-center animate-fade-in relative z-10">
                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg shadow-emerald-500/30">
                        <i class="bi bi-check-lg text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-emerald-900 mb-2">Email Terkirim!</h3>
                    <p class="text-sm font-medium text-emerald-700 leading-relaxed">
                        {{ $emailSentMessage }}
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('login') }}" class="text-emerald-600 font-black text-sm uppercase tracking-widest hover:text-emerald-700 transition-colors">
                            Kembali ke Login
                        </a>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="sendResetPasswordLink" class="space-y-8 relative z-10">
                    <div>
                        <label for="email" class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-3 ml-1">
                            Alamat Email Terdaftar
                        </label>

                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <i class="bi bi-envelope-fill text-gray-300 group-focus-within:text-emerald-500 transition-colors text-lg"></i>
                            </div>
                            <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus 
                                class="block w-full pl-14 pr-5 py-5 bg-gray-50 border-2 border-transparent rounded-[24px] text-gray-800 font-bold placeholder-gray-300 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner" 
                                placeholder="nama@email.com"
                            />
                        </div>

                        @error('email')
                            <p class="mt-3 text-xs text-rose-500 font-bold ml-1 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-5 px-6 border border-transparent rounded-[24px] shadow-xl text-sm font-black text-white bg-[#00796B] hover:bg-[#004D40] focus:outline-none focus:ring-4 focus:ring-emerald-500/20 transition-all transform hover:scale-[1.02] active:scale-95 uppercase tracking-widest">
                            Kirim Link Reset
                        </button>
                    </div>

                    <div class="pt-4 text-center border-t border-gray-50">
                        <p class="text-sm font-bold text-gray-400">
                            Ingat password Anda? 
                            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 ml-1 transition-colors">
                                Masuk Disini
                            </a>
                        </p>
                    </div>
                </form>
            @endif
        </div>

        <p class="mt-10 text-center text-xs text-gray-400 font-bold uppercase tracking-[0.3em]">
            &copy; {{ date('Y') }} Halaqah Team
        </p>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
        .animate-shake { animation: shake 0.3s ease-in-out; }
    </style>
</div>
