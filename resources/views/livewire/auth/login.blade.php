@section('title', 'Sign in to your account')

{{-- Perbaikan: Semua konten dibungkus dalam SATU elemen <div> root --}}
<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    {{-- Bagian 1: Logo dan Teks Atas --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Logo Placeholder (Diubah menjadi Geometris dan Berwarna Teal) -->
        <a href="{{ route('home') }}" class="block text-center">
            {{-- Menggunakan SVG logo geometris: bentuk jajaran genjang, lingkaran, dan persegi kecil --}}
            <svg class="w-auto h-16 mx-auto text-teal-600" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 6 L44 26 L24 46 L4 26 Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="2"/>
                <circle cx="24" cy="24" r="10" fill="currentColor" fill-opacity="0.9"/>
                <path d="M20 20 L28 20 L28 28 L20 28 Z" fill="#FFFFFF"/>
            </svg>
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Sign in to your account
        </h2>
        
        @if (Route::has('register'))
            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                Or
                <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    create a new account
                </a>
            </p>
        @endif
    </div>

    {{-- Bagian 2: Formulir Login --}}
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        {{-- Notifikasi sukses sementara dari Livewire --}}
        @if (session()->has('success_message'))
            <div class="bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success_message') }}</span>
            </div>
        @endif
        
        {{-- Menambahkan kelas 'geometric-form-card' untuk estetika Liqo --}}
        <div class="px-4 py-8 bg-white shadow-xl geometric-form-card sm:rounded-lg sm:px-10">
            
            <form wire:submit.prevent="authenticate">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                        Email address
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        {{-- Ganti fokus warna blue ke teal --}}
                        <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                        Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        {{-- Ganti fokus warna blue ke teal --}}
                        <input wire:model.lazy="password" id="password" type="password" required 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-teal focus:border-teal-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        {{-- Ganti checkbox warna indigo ke teal --}}
                        <input wire:model.lazy="remember" id="remember" type="checkbox" class="form-checkbox w-4 h-4 text-teal-600 transition duration-150 ease-in-out border-gray-300 rounded" />
                        <label for="remember" class="block ml-2 text-sm text-gray-900 leading-5">
                            Remember
                        </label>
                    </div>

                    <div class="text-sm leading-5">
                        {{-- Ganti tautan warna indigo ke teal --}}
                        <a href="{{ route('password.request') }}" class="font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        {{-- Ganti tombol warna indigo ke teal --}}
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-md hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:ring-teal active:bg-teal-700 transition duration-150 ease-in-out">
                            Sign in
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>