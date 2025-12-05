<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <!-- Grafik Kehadiran -->
    <livewire:admin.grafik />

    <!-- Daftar Kehadiran -->
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mt-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 border-b pb-2">Daftar Kehadiran Terbaru</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anggota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Absen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($kehadirans as $data)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $data->nama }}</td>
                        <td class="px-6 py-4">
                            @php
                                $color = match($data->status) {
                                    'Hadir' => 'green',
                                    'Izin' => 'yellow',
                                    'Sakit' => 'blue',
                                    'Alpha' => 'red',
                                    default => 'blue'
                                };
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">{{ $data->status }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $data->keterangan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $data->created_at }}</td>
                        <td class="px-6 py-4 text-sm flex gap-2">
                            <button wire:click="openEdit({{ $data->id }})" class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600">Edit</button>
                            <button wire:click="openDelete({{ $data->id }})" class="px-3 py-1 bg-red-500 text-white rounded-lg text-xs hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($kehadirans->isEmpty())
            <div class="text-center py-10 text-gray-500">
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data kehadiran</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai mencatat kehadiran anggota menggunakan formulir di atas.</p>
            </div>
        @endif
    </div>

    <!-- Modal Edit -->
    @if ($editId !== null)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Edit Kehadiran</h2>

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium">Nama</label>
                    <input type="text" wire:model="nama" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring">
                </div>

                <div>
                    <label class="text-sm font-medium">Status</label>
                    <select wire:model="status" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring">
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button wire:click="$set('editId', null)" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
               <button wire:click="update" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Hapus</button>
        </div>
    </div>
    @endif

    <!-- Modal Delete -->
    @if ($deleteId !== null)
    <div class="固定 inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-sm text-center">
            <h2 class="text-lg font-semibold text-red-600">Hapus Data?</h2>
            <p class="text-gray-600 mt-2">Data yang dihapus tidak dapat dikembalikan.</p>

            <div class="flex justify-center gap-3 mt-5">
                <button wire:click="$set('deleteId', null)" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
                <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>