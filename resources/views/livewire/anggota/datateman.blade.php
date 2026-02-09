<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom font for a clean look */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>

        <!-- 1. Online Users Section -->
        <div class="mb-8" wire:poll.10s>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4 border-b pb-2 flex items-center gap-2">
                <span class="flex h-3 w-3 rounded-full bg-green-500 animate-pulse"></span>
                Anggota Sedang Online
            </h2>
            
            <div class="flex overflow-x-auto pb-4 gap-4 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent" style="scrollbar-width: thin; -ms-overflow-style: none;">
                <style>
                    /* Custom scrollbar styling for Chrome/Safari/Edge */
                    .overflow-x-auto::-webkit-scrollbar {
                        height: 6px;
                    }
                    .overflow-x-auto::-webkit-scrollbar-thumb {
                        background-color: #e5e7eb;
                        border-radius: 10px;
                    }
                    .overflow-x-auto::-webkit-scrollbar-track {
                        background-color: transparent;
                    }
                </style>
                
                @foreach($users as $user)
                    <div class="flex-none w-40 bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center relative overflow-hidden transition-all hover:shadow-md snap-start">
                        @if($user->isOnline())
                            <div class="absolute top-2 right-2 flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </div>
                        @else
                            <div class="absolute top-2 right-2 h-2 w-2 rounded-full bg-gray-300"></div>
                        @endif

                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3 border-2 {{ $user->isOnline() ? 'border-green-100' : 'border-gray-50' }}">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full rounded-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                        
                        <h3 class="text-xs font-semibold text-gray-900 truncate w-full">{{ $user->name }}</h3>
                        <p class="text-[10px] text-gray-500 mt-1 whitespace-nowrap">
                            {{ $user->isOnline() ? 'Sedang Aktif' : ($user->last_activity ? $user->last_activity->diffForHumans() : 'Offline') }}
                        </p>
                    </div>
                @endforeach
            </div>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex items-center gap-2">
                                {{ $data->nama }}
                                @if($data->user && $data->user->isOnline())
                                    <span class="flex h-2 w-2 rounded-full bg-green-500"></span>
                                @endif
                            </td>

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