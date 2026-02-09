<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom font for a clean look */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 font-inter">
        <header class="mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800">Pencatatan Kehadiran Anggota</h1>
            <p class="text-gray-500 mt-1">Gunakan formulir ini untuk mencatat status kehadiran hari ini.</p>
        </header>

        <!-- Bagian Notifikasi (Simulasi Livewire Session Flash) -->
        <div class="mb-6">
            @if(session()->has('success'))
            <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p> 
            </div>
            @endif
            @if(session()->has('error'))
            <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg shadow-md" role="alert">
                <p class="font-bold">Perhatian!</p>
                <p>{{ session('error') }}</p> 
            </div>
            @endif
        </div>

        <!-- 1. Formulir Pengabsenan -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border border-gray-100">
            @if($alreadySubmitted)
                <div class="text-center py-8">
                    <div class="bg-blue-50 text-blue-700 p-6 rounded-xl border border-blue-100 inline-block">
                        <i class="bi bi-check2-circle fs-1 mb-3 d-block"></i>
                        <h3 class="text-xl font-bold mb-2">Presensi Hari Ini Selesai</h3>
                        <p class="mb-0">Terima kasih, Anda sudah mencatatkan kehadiran pada <strong>{{ now()->translatedFormat('d F Y') }}</strong>.</p>
                    </div>
                </div>
            @else
            <h2 class="text-2xl font-semibold text-gray-700 mb-4 border-b pb-2">Formulir Absensi</h2>
            
            <!-- Formulir Livewire, terikat ke fungsi simpan() -->
            <form wire:submit.prevent="simpan" class="space-y-4">
                
                <!-- Input Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Anggota</label>
                    <input 
                        type="text"
                        value="{{ auth()->user()->name }}"
                        readonly
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                    >
                </div>

                <!-- Input Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Kehadiran</label>
                    <select 
                        id="status" 
                        wire:model="status" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white appearance-none transition duration-150"
                    >
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                    </select>
                    <div class="text-red-500 text-xs mt-1">
                        @error('status') {{ $message }} @enderror
                    </div>
                </div>

                <!-- Input Keterangan -->
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                    <textarea 
                        id="keterangan" 
                        wire:model="keterangan" 
                        rows="2" 
                        placeholder="Contoh: Keterangan Izin/Sakit, atau catatan lainnya"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                    ></textarea>
                    <div class="text-red-500 text-xs mt-1">
                        @error('keterangan') {{ $message }} @enderror
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                >
                    Simpan Kehadiran
                </button>
            </form>
            @endif
        </div>

     



        <!-- 2. Daftar Kehadiran -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4 border-b pb-2">Daftar Kehadiran Terbaru</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Anggota
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                Waktu Absen
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kehadirans as $key => $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $data->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $color = match($data->status) {
                                        'Hadir' => 'green',
                                        'Izin' => 'yellow',
                                        'Sakit' => 'red',
                                        default => 'blue'
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
                                    {{ $data->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate">
                                {{ $data->keterangan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if ($kehadirans->isEmpty())
            <div class="text-center py-10 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5V3m4 2V3m-4 8h.01M17 11h.01M17 15h.01M12 15h.01M12 11h.01M12 18a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data kehadiran</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai mencatat kehadiran anggota menggunakan formulir di atas.</p>
            </div>
            @endif
        </div>

    </div>
</div>