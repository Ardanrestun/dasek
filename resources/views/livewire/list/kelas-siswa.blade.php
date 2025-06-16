<div class="space-y-6">
    <div class="flex flex-col justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Kelas & Siswa</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola dan lihat daftar kelas beserta siswa-siswanya</p>
        </div>
    </div>

    <div class="rounded-lg bg-white p-6 shadow-sm">
        <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
            <div class="max-w-md flex-1">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="w-full rounded-md border border-gray-300 py-2 pl-10 pr-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Cari kelas atau siswa...">
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan:</label>
                <select wire:model.live="perPage" id="perPage"
                    class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            Kelas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            Nama Siswa
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            NISN
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            NIS
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            Jenis Kelamin
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($kelasWithSiswa as $kelas)
                        @if ($kelas->siswa->count() > 0)
                            @foreach ($kelas->siswa as $index => $siswa)
                                <tr class="transition-colors duration-150 hover:bg-gray-50">

                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($index === 0)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100">
                                                        <svg class="h-5 w-5 text-blue-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $kelas->nama_kelas }}</div>
                                                    <div class="text-sm text-gray-500">{{ $kelas->siswa_count }} siswa
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="{{ $siswa->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-600' : 'bg-pink-100 text-pink-600' }} flex h-8 w-8 items-center justify-center rounded-full">
                                                    @if ($siswa->jenis_kelamin === 'Laki-laki')
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    @else
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $siswa->nama_siswa }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $siswa->tempat_lahir }},
                                                    {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $siswa->nisn }}</div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $siswa->nis }}</div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span
                                            class="{{ $siswa->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                            {{ $siswa->jenis_kelamin }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                        @if ($index === 0)
                                            <button wire:click="showDetail('{{ $kelas->id }}')"
                                                class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition-colors duration-150 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Detail Kelas
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $kelas->nama_kelas }}
                                            </div>
                                            <div class="text-sm text-gray-500">0 siswa</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500" colspan="4">
                                    <span class="italic">Belum ada siswa di kelas ini</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                    <button wire:click="showDetail('{{ $kelas->id }}')"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-xs font-semibold text-white shadow-sm transition-colors duration-150 hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                        <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Detail Kelas
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        @if ($search)
                                            Tidak ditemukan kelas atau siswa dengan pencarian "{{ $search }}"
                                        @else
                                            Belum ada data kelas dan siswa.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kelasWithSiswa->hasPages())
            <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                {{ $kelasWithSiswa->links() }}
            </div>
        @endif
    </div>

    @if ($showDetailModal && $selectedKelas)
        <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-black bg-opacity-50 p-4">
            <div class="flex max-h-[90vh] w-full max-w-6xl flex-col rounded-lg bg-white shadow-xl">
                <div class="flex-shrink-0 border-b border-gray-200 px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Detail Kelas
                                    {{ $selectedKelas->nama_kelas }}</h3>
                                <p class="text-sm text-gray-500">{{ $selectedKelas->siswa->count() }} siswa terdaftar
                                </p>
                            </div>
                        </div>
                        <button wire:click="closeDetailModal"
                            class="text-gray-400 transition-colors hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto px-4 py-4 sm:px-6">
                    @if ($selectedKelas->siswa->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="sticky top-0 z-10 bg-gray-50">
                                    <tr>
                                        <th
                                            class="bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            No
                                        </th>
                                        <th
                                            class="bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Nama Siswa
                                        </th>
                                        <th
                                            class="bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            NISN
                                        </th>
                                        <th
                                            class="bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            NIS
                                        </th>
                                        <th
                                            class="bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Jenis Kelamin
                                        </th>
                                        <th
                                            class="bg-gray-50 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            TTL
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($selectedKelas->siswa as $index => $siswa)
                                        <tr class="transition-colors hover:bg-gray-50">
                                            <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div
                                                        class="{{ $siswa->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-600' : 'bg-pink-100 text-pink-600' }} flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full">
                                                        @if ($siswa->jenis_kelamin === 'Laki-laki')
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                </path>
                                                            </svg>
                                                        @else
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                </path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div class="ml-3 min-w-0 flex-1">
                                                        <div class="truncate text-sm font-medium text-gray-900">
                                                            {{ $siswa->nama_siswa }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">
                                                {{ $siswa->nisn }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">
                                                {{ $siswa->nis }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3">
                                                <span
                                                    class="{{ $siswa->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                                    {{ $siswa->jenis_kelamin }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                <div class="max-w-xs">
                                                    <div class="truncate">{{ $siswa->tempat_lahir }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada siswa</h3>
                            <p class="mt-1 text-sm text-gray-500">Kelas ini belum memiliki siswa yang terdaftar.</p>
                        </div>
                    @endif
                </div>

                <div class="flex flex-shrink-0 items-center justify-between border-t bg-gray-50 px-4 py-3 sm:px-6">
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $selectedKelas->siswa->count() }} siswa
                    </div>
                    <div class="flex space-x-3">
                        <button wire:click="closeDetailModal"
                            class="rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-300 transition-colors hover:bg-gray-50">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
