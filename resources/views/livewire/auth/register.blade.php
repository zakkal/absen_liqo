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
            </form>
        </div>
    </div>
</div>