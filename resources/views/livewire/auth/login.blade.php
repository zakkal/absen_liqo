@section('title', 'Login ke Akun Anda')

<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    {{-- Tambahkan CDN Tailwind untuk jaminan tampilan di hosting --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Logo & Header --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}" class="block text-center">
            <svg class="w-auto h-20 mx-auto text-teal-600 animate-pulse" style="width: 80px; height: 80px;" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 6 L44 26 L24 46 L4 26 Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="2"/>
                <circle cx="24" cy="24" r="10" fill="currentColor" fill-opacity="0.9"/>
                <path d="M20 20 L28 20 L28 28 L20 28 Z" fill="#FFFFFF"/>
            </svg>
        </a>

        <h2 class="mt-8 text-3xl font-extrabold text-center text-gray-900 tracking-tight">
            Selamat Datang Kembali
        </h2>
        <p class="mt-2 text-sm text-center text-gray-500">
            Pilih metode login yang Anda inginkan
        </p>
    </div>

    {{-- Login Buttons Card --}}
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-10 px-6 shadow-2xl rounded-3xl border border-gray-100 sm:px-10">
            
            <div class="space-y-4">
                {{-- WhatsApp Login Button --}}
                <a href="{{ route('login.wa') }}" class="w-full flex justify-center items-center gap-4 px-4 py-4 bg-emerald-50 text-emerald-700 border-2 border-emerald-100 rounded-2xl font-bold hover:bg-emerald-100 hover:border-emerald-200 transition-all transform hover:scale-[1.02] active:scale-95 shadow-sm group">
                    <svg class="w-6 h-6 text-emerald-500 group-hover:scale-110 transition-transform" style="width: 24px; height: 24px;" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    <span class="text-lg">Login via WhatsApp</span>
                </a>

                {{-- Google Login Button --}}
                <a href="{{ route('google.login') }}" class="w-full flex justify-center items-center gap-4 px-4 py-4 bg-white text-gray-700 border-2 border-gray-100 rounded-2xl font-bold hover:bg-gray-50 hover:border-teal-200 transition-all transform hover:scale-[1.02] active:scale-95 shadow-sm group">
                    <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" style="width: 24px; height: 24px;" viewBox="0 0 48 48">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    </svg>
                    <span class="text-lg">Login via Google</span>
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-50 text-center">
                <p class="text-xs text-gray-400">
                    Dengan masuk, Anda menyetujui Ketentuan Layanan kami.
                </p>
            </div>
        </div>
        
        {{-- Back Link --}}
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-sm font-medium text-teal-600 hover:text-teal-500 transition-colors">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </div>
</div>