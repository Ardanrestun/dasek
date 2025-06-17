<div>
    @if (session()->has('message'))
        <div class="mb-4 rounded-md bg-green-50 p-4">
            <div class="text-sm text-green-700">
                {{ session('message') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 rounded-md bg-red-50 p-4">
            <div class="text-sm text-red-700">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Manajemen Wali Murid</h2>
        <button wire:click="create"
            class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:w-auto">
            Tambah Wali Murid
        </button>
    </div>

    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="relative flex-1 sm:max-w-md">
            <input wire:model.live="search" type="text" placeholder="Cari wali murid atau siswa"
                class="block w-full rounded-md border-gray-300 py-2 pl-10 pr-3 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan:</label>
            <select wire:model.live="perPage" id="perPage"
                class="rounded-md border-gray-300 py-1 pl-3 pr-8 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="text-sm text-gray-700">data per halaman</span>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 sm:px-6">
                        Nama Wali Murid
                    </th>
                    <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 sm:px-6">
                        Nama Siswa
                    </th>
                    <th
                        class="hidden px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 sm:table-cell sm:px-6">
                        Hubungan
                    </th>
                    <th
                        class="hidden px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 lg:table-cell lg:px-6">
                        Jenis Kelamin
                    </th>
                    <th
                        class="hidden px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 lg:table-cell lg:px-6">
                        No. Telepon
                    </th>
                    <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 sm:px-6">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($waliMurid as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-4 text-sm font-medium text-gray-900 sm:px-6">
                            <div class="max-w-[150px] truncate sm:max-w-none">{{ $item->nama_walimurid }}</div>
                            <div class="mt-1 text-xs text-gray-500 sm:hidden">
                                {{ $item->hubungan }}
                            </div>
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 sm:px-6">
                            <div class="max-w-[150px] truncate sm:max-w-none">
                                {{ $item->siswa->nama_siswa ?? 'Belum ada siswa' }}
                            </div>
                        </td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell sm:px-6">
                            {{ $item->hubungan }}
                        </td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell lg:px-6">
                            {{ $item->jenis_kelamin }}
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell lg:px-6">
                            <div class="max-w-[150px] truncate">{{ $item->no_telepon ?? '-' }}</div>
                        </td>
                        <td class="px-3 py-4 text-sm font-medium sm:px-6">
                            <div class="flex flex-col gap-1 sm:flex-row sm:gap-2">
                                <button wire:click="show('{{ $item->id }}')"
                                    class="text-left text-blue-600 hover:text-blue-900">
                                    Detail
                                </button>
                                <button wire:click="edit('{{ $item->id }}')"
                                    class="text-left text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </button>
                                <button wire:click="confirmDelete('{{ $item->id }}')"
                                    class="text-left text-red-600 hover:text-red-900">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            Tidak ada data wali murid ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-gray-700">
            Menampilkan {{ $waliMurid->firstItem() ?? 0 }} sampai {{ $waliMurid->lastItem() ?? 0 }}
            dari {{ $waliMurid->total() }} hasil
        </div>
        <div>
            {{ $waliMurid->links() }}
        </div>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-black bg-opacity-50 p-4">
            <div class="w-full max-w-4xl rounded-lg bg-white shadow-xl">
                <form wire:submit="store">
                    <div class="px-4 py-4 sm:px-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $editMode ? 'Edit Wali Murid' : 'Tambah Wali Murid' }}
                            </h3>
                            <button wire:click="closeModal" type="button" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-900">Data Wali Murid</h4>

                                <div>
                                    <label for="nama_walimurid" class="mb-1 block text-sm font-medium text-gray-700">
                                        Nama Wali Murid
                                    </label>
                                    <input wire:model="nama_walimurid" type="text" id="nama_walimurid"
                                        class="@error('nama_walimurid') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('nama_walimurid')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="hubungan" class="mb-1 block text-sm font-medium text-gray-700">
                                        Hubungan
                                    </label>
                                    <select wire:model="hubungan" id="hubungan"
                                        class="@error('hubungan') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Hubungan</option>
                                        <option value="Ayah" {{ $hubungan === 'Ayah' ? 'selected' : '' }}>Ayah
                                        </option>
                                        <option value="Ibu" {{ $hubungan === 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                        <option value="Wali" {{ $hubungan === 'Wali' ? 'selected' : '' }}>Wali
                                        </option>
                                        <option value="Kakek" {{ $hubungan === 'Kakek' ? 'selected' : '' }}>Kakek
                                        </option>
                                        <option value="Nenek" {{ $hubungan === 'Nenek' ? 'selected' : '' }}>Nenek
                                        </option>
                                        <option value="Paman" {{ $hubungan === 'Paman' ? 'selected' : '' }}>Paman
                                        </option>
                                        <option value="Bibi" {{ $hubungan === 'Bibi' ? 'selected' : '' }}>Bibi
                                        </option>
                                        <option value="Lainnya" {{ $hubungan === 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('hubungan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_kelamin" class="mb-1 block text-sm font-medium text-gray-700">
                                        Jenis Kelamin
                                    </label>
                                    <select wire:model="jenis_kelamin" id="jenis_kelamin"
                                        class="@error('jenis_kelamin') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ $jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ $jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-900">Data Kontak & Lainnya</h4>

                                <div>
                                    <label for="no_telepon" class="mb-1 block text-sm font-medium text-gray-700">
                                        No. Telepon
                                    </label>
                                    <input wire:model="no_telepon" type="text" id="no_telepon"
                                        class="@error('no_telepon') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('no_telepon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="pekerjaan" class="mb-1 block text-sm font-medium text-gray-700">
                                        Pekerjaan
                                    </label>
                                    <input wire:model="pekerjaan" type="text" id="pekerjaan"
                                        class="@error('pekerjaan') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('pekerjaan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="siswa_id" class="mb-1 block text-sm font-medium text-gray-700">
                                        Nama Siswa
                                    </label>
                                    <select wire:model="siswa_id" id="siswa_id"
                                        class="@error('siswa_id') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Siswa</option>
                                        @foreach ($siswaList as $siswa)
                                            <option value="{{ $siswa->id }}"
                                                {{ $siswa_id === $siswa->id ? 'selected' : '' }}>
                                                {{ $siswa->nama_siswa }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('siswa_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t bg-gray-50 px-4 py-3 sm:flex-row sm:justify-end sm:px-6">
                        <button wire:click="closeModal" type="button"
                            class="w-full rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 sm:w-auto">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-500 sm:w-auto">
                            {{ $editMode ? 'Perbarui' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($showDetailModal && $selectedWaliMurid)
        <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-black bg-opacity-50 p-4">
            <div class="w-full max-w-4xl rounded-lg bg-white shadow-xl">
                <div class="px-4 py-4 sm:px-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">
                            Detail Wali Murid: {{ $selectedWaliMurid->nama_walimurid }}
                        </h3>
                        <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <h4 class="mb-4 font-medium text-gray-900">Data Pribadi</h4>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama Wali Murid</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->nama_walimurid }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Hubungan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->hubungan }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->jenis_kelamin }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Pekerjaan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->pekerjaan ?? '-' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->no_telepon ?? '-' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h4 class="mb-4 font-medium text-gray-900">Data Siswa</h4>
                            <dl class="space-y-3">
                                @if ($selectedWaliMurid->siswa)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Nama Siswa</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $selectedWaliMurid->siswa->nama_siswa }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">NISN</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->siswa->nisn }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">NIS</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $selectedWaliMurid->siswa->nis }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $selectedWaliMurid->siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
                                        </dd>
                                    </div>
                                @else
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Data Siswa</dt>
                                        <dd class="mt-1 text-sm text-gray-900">Belum ada siswa terkait</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end border-t bg-gray-50 px-4 py-3 sm:px-6">
                    <button wire:click="closeDetailModal"
                        class="rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($showDeleteConfirm)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="mx-4 w-full max-w-sm rounded-lg bg-white shadow-lg">
                <div class="p-6">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-center text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                    <p class="mb-6 text-center text-sm text-gray-600">
                        Apakah Anda yakin ingin menghapus data wali murid ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="flex space-x-3">
                        <button wire:click="cancelDelete"
                            class="flex-1 rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button wire:click="delete"
                            class="flex-1 rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
