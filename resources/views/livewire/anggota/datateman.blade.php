<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom font for a clean look */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>

        

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