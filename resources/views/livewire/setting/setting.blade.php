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

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Pengaturan Akun</h2>
        <p class="mt-1 text-sm text-gray-600">Kelola informasi profil dan keamanan akun Anda.</p>
    </div>

    <div class="mb-6">
        <nav class="flex space-x-8" aria-label="Tabs">
            <button wire:click="setActiveTab('profile')"
                class="{{ $activeTab === 'profile' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} whitespace-nowrap border-b-2 px-1 py-2 text-sm font-medium">
                Profil
            </button>
            <button wire:click="setActiveTab('password')"
                class="{{ $activeTab === 'password' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} whitespace-nowrap border-b-2 px-1 py-2 text-sm font-medium">
                Ubah Password
            </button>
        </nav>
    </div>

    @if ($activeTab === 'profile')
        <div class="rounded-lg bg-white p-6 shadow">
            <h3 class="mb-4 text-lg font-medium text-gray-900">Informasi Profil</h3>

            <form wire:submit="updateProfile" class="space-y-6">
                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                        Nama Lengkap
                    </label>
                    <input wire:model="name" type="text" id="name"
                        class="@error('name') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input wire:model="email" type="email" id="email"
                        class="@error('email') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan email">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Role
                    </label>
                    <input type="text" value="{{ auth()->user()->role->name ?? 'Tidak ada role' }}" readonly
                        class="block w-full rounded-md border-gray-300 bg-gray-50 px-3 py-2 text-gray-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    @endif

    @if ($activeTab === 'password')
        <div class="rounded-lg bg-white p-6 shadow">
            <h3 class="mb-4 text-lg font-medium text-gray-900">Ubah Password</h3>
            <p class="mb-6 text-sm text-gray-600">
                Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.
            </p>

            <form wire:submit="updatePassword" class="space-y-6">
                <div>
                    <label for="current_password" class="mb-2 block text-sm font-medium text-gray-700">
                        Password Saat Ini
                    </label>
                    <input wire:model="current_password" type="password" id="current_password"
                        class="@error('current_password') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan password saat ini">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                        Password Baru
                    </label>
                    <input wire:model="password" type="password" id="password"
                        class="@error('password') border-red-300 @enderror block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Masukkan password baru">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                        Konfirmasi Password Baru
                    </label>
                    <input wire:model="password_confirmation" type="password" id="password_confirmation"
                        class="block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Konfirmasi password baru">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
