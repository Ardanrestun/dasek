<div class="w-full max-w-md">
    <div class="rounded-lg bg-white p-6 shadow-md">
        <div class="mb-6 text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Selamat Datang</h2>
            <p class="text-sm text-gray-600">Silakan masuk ke akun Anda</p>
        </div>

        <form wire:submit="login">
            <div class="mb-4">
                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                    <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                        </path>
                    </svg>
                    Email
                </label>
                <input type="email" id="email" wire:model="email"
                    class="@error('email') border-red-500 focus:ring-red-500 @else focus:ring-blue-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 transition-colors focus:outline-none focus:ring-2"
                    placeholder="Masukkan email Anda">
                @error('email')
                    <span class="mt-1 flex items-center text-sm text-red-500">
                        <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                    <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Password
                </label>
                <input type="password" id="password" wire:model="password"
                    class="@error('password') border-red-500 focus:ring-red-500 @else focus:ring-blue-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 transition-colors focus:outline-none focus:ring-2"
                    placeholder="Masukkan password Anda">
                @error('password')
                    <span class="mt-1 flex items-center text-sm text-red-500">
                        <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" wire:model="remember"
                        class="mr-2 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <button type="submit"
                class="relative w-full rounded-md bg-blue-600 px-4 py-2 text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                wire:loading.attr="disabled" wire:target="login">

                <span wire:loading.remove wire:target="login" class="flex items-center justify-center">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Masuk
                </span>

                <span wire:loading wire:target="login" class="flex items-center justify-center">
                    <svg class="mr-2 h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>
        </form>

        <div class="mt-6 rounded-lg bg-gray-50 p-4">
            <h4 class="mb-2 text-sm font-medium text-gray-700">Demo Credentials:</h4>
            <div class="space-y-1 text-xs text-gray-600">
                <div><strong>Admin:</strong> admin@school.com / password123</div>
                <div><strong>Guru:</strong> ahmad.wijaya@school.com / password123</div>
                <div><strong>Siswa:</strong> siswa1@school.com / password123</div>
            </div>
        </div>
    </div>
</div>
