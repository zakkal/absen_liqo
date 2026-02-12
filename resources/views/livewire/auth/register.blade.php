@section('title', 'Create a new account')

{{-- SATU ELEMEN ROOT untuk Livewire --}}
<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    {{-- Bagian 1: Logo dan Teks Atas --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Logo Placeholder (Geometris dan Berwarna Teal) -->
        <a href="{{ route('home') }}" class="block text-center">
            <svg class="w-auto h-16 mx-auto text-teal-600" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 6 L44 26 L24 46 L4 26 Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="2"/>
                <circle cx="24" cy="24" r="10" fill="currentColor" fill-opacity="0.9"/>
                <path d="M20 20 L28 20 L28 28 L20 28 Z" fill="#FFFFFF"/>
            </svg>
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Create a new account
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            Or
            <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                sign in to your account
            </a>
        </p>
    </div>

    {{-- Bagian 2: Formulir Pendaftaran --}}
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        {{-- Notifikasi sukses sementara dari Livewire --}}
        @if (session()->has('success_message'))
            <div class="bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success_message') }}</span>
            </div>
        @endif
        
        {{-- Menambahkan kelas 'geometric-form-card' untuk estetika Liqo --}}
        <div class="px-4 py-8 bg-white shadow-xl geometric-form-card sm:rounded-lg sm:px-10">
            
            <form wire:submit.prevent="register">
                {{-- Field: Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                        Name
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        {{-- Fokus warna teal --}}
                        <input wire:model.lazy="name" id="name" type="text" required autofocus 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Field: Email --}}
                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                        Email address
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        {{-- Fokus warna teal --}}
                        <input wire:model.lazy="email" id="email" type="email" required 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Field: No WA --}}
                <div class="mt-6">
                    <label for="no_wa" class="block text-sm font-medium text-gray-700 leading-5">
                        WhatsApp Number
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="no_wa" id="no_wa" type="tel" required 
                            placeholder="Contoh: 081234567890"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('no_wa') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('no_wa')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Field: Password --}}
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                        Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        {{-- Fokus warna teal --}}
                        <input wire:model.lazy="password" id="password" type="password" required 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Field: Confirm Password --}}
                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                        Confirm Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        {{-- Fokus warna teal --}}
                        <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required 
                            class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 appearance-none rounded-md focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        {{-- Tombol submit warna teal --}}
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-md hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:ring-teal active:bg-teal-700 transition duration-150 ease-in-out">
                            Register
                        </button>
                    </span>
                </div>

                <div class="mt-6 relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm leading-5">
                        <span class="px-2 bg-white text-gray-400 font-bold uppercase tracking-widest text-[10px]">Atau Daftar Dengan</span>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('google.login') }}" class="w-full flex justify-center items-center gap-3 px-4 py-3 bg-white border-2 border-gray-100 rounded-xl font-bold text-gray-600 hover:bg-gray-50 hover:border-teal-100 transition-all transform hover:scale-[1.01] active:scale-95 shadow-sm">
                        <svg class="w-5 h-5" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        </svg>
                        <span class="text-sm">Daftar dengan Google</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>