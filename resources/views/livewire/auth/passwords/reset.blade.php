@section('title', 'Atur Ulang Password')

<div class="min-h-screen bg-[#F8FAFC] flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-jakarta">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}" class="flex justify-center group">
            <div class="w-20 h-20 bg-white rounded-[28px] shadow-xl shadow-emerald-900/10 flex items-center justify-center border border-emerald-50 group-hover:scale-110 transition-transform duration-500">
                 <i class="bi bi-key-fill text-4xl text-[#00796B]"></i>
            </div>
        </a>

        <h2 class="mt-8 text-4xl font-black text-center text-gray-800 tracking-tighter leading-tight">
            Atur Password Baru
        </h2>
        <p class="mt-3 text-center text-gray-400 font-medium px-6">
            Langkah terakhir untuk mengamankan kembali akun Anda.
        </p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-12 px-6 shadow-2xl shadow-emerald-900/5 sm:rounded-[45px] sm:px-12 border border-emerald-50 relative overflow-hidden">
             {{-- Decorative Element --}}
             <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-emerald-50 rounded-full opacity-50"></div>

            <form wire:submit.prevent="resetPassword" class="space-y-7 relative z-10">
                <input wire:model="token" type="hidden">

                <div>
                    <label for="email" class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-3 ml-1">
                        Konfirmasi Email
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center">
                            <i class="bi bi-envelope text-gray-300"></i>
                        </div>
                        <input wire:model.lazy="email" id="email" type="email" required autofocus 
                            class="block w-full pl-14 pr-5 py-5 bg-gray-50 border-2 border-transparent rounded-[24px] text-gray-800 font-bold placeholder-gray-300 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner" 
                        />
                    </div>
                    @error('email') <p class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-3 ml-1">
                        Password Baru
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center">
                            <i class="bi bi-lock-fill text-gray-300 group-focus-within:text-emerald-500"></i>
                        </div>
                        <input wire:model.lazy="password" id="password" type="password" required 
                            class="block w-full pl-14 pr-5 py-5 bg-gray-50 border-2 border-transparent rounded-[24px] text-gray-800 font-bold focus:outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner"
                            placeholder="••••••••"
                        />
                    </div>
                    @error('password') <p class="mt-2 text-xs text-rose-500 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-3 ml-1">
                        Ulangi Password Baru
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center">
                            <i class="bi bi-shield-check text-gray-300 group-focus-within:text-emerald-500"></i>
                        </div>
                        <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required 
                            class="block w-full pl-14 pr-5 py-5 bg-gray-50 border-2 border-transparent rounded-[24px] text-gray-800 font-bold focus:outline-none focus:border-emerald-500 focus:bg-white transition-all shadow-inner"
                            placeholder="••••••••"
                        />
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-5 px-6 border border-transparent rounded-[24px] shadow-xl text-sm font-black text-white bg-[#00796B] hover:bg-[#004D40] focus:outline-none focus:ring-4 focus:ring-emerald-500/20 transition-all transform hover:scale-[1.02] active:scale-95 uppercase tracking-widest">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
