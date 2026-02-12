@section('title', 'Login WhatsApp')

<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    {{-- Logo & Header --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="{{ route('home') }}">
            <svg class="w-auto h-16 mx-auto text-teal-600" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 6 L44 26 L24 46 L4 26 Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="2"/>
                <circle cx="24" cy="24" r="10" fill="currentColor" fill-opacity="0.9"/>
                <path d="M20 20 L28 20 L28 28 L20 28 Z" fill="#FFFFFF"/>
            </svg>
        </a>
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Login WhatsApp
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            @if($step == 1) Masukkan nomor WhatsApp Anda @else Masukkan kode OTP @endif
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10 border border-gray-100">
            
            @if($errorMessage)
                <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
                    {{ $errorMessage }}
                </div>
            @endif

            @if($step == 1)
                {{-- STEP 1: INPUT NOMOR --}}
                <form wire:submit.prevent="sendOtp">
                    <div>
                        <label for="no_wa" class="block text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">+62</span>
                            </div>
                            <input wire:model.lazy="no_wa" type="text" id="no_wa" 
                                class="block w-full pl-12 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm" 
                                placeholder="81234567890">
                        </div>
                        @error('no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all">
                            <span wire:loading.remove>Kirim OTP</span>
                            <span wire:loading>Memproses...</span>
                        </button>
                    </div>
                </form>
            @else
                {{-- STEP 2: INPUT OTP --}}
                <form wire:submit.prevent="verifyOtp">
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="otp_input" class="block text-sm font-medium text-gray-700">Kode OTP</label>
                            <button type="button" wire:click="backToStep1" class="text-xs text-teal-600 hover:text-teal-500 font-semibold underline">Ganti Nomor?</button>
                        </div>
                        <input wire:model.lazy="otp_input" type="text" id="otp_input" 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-center text-2xl tracking-[1em] font-bold" 
                            maxlength="6" placeholder="000000">
                        @error('otp_input') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <p class="mt-2 text-[10px] text-gray-400 text-center">Kode telah dikirim ke nomor WhatsApp Anda ({{ $no_wa }})</p>
                    </div>

                    <div class="mt-6">
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            <span wire:loading.remove>Verifikasi & Login</span>
                            <span wire:loading>Memverifikasi...</span>
                        </button>
                    </div>
                </form>
            @endif

            {{-- Link Lain --}}
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="px-2 bg-white text-gray-500">Atau</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-xs font-medium text-gray-700 hover:bg-gray-50">
                        Login Biasa
                    </a>
                    <a href="{{ route('google.login') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-xs font-medium text-gray-700 hover:bg-gray-50">
                        Google Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
