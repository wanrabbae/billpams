<div class="p-8">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800">Masuk ke Akun</h2>
        <p class="text-slate-500 text-sm mt-1">Masukkan username dan password Anda</p>
    </div>

    <form wire:submit="login">
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
            <input type="text" id="username" wire:model="username" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Masukkan username" required>
            @error('username') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input type="password" id="password" wire:model="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Masukkan password" required>
            @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-lg transition duration-200" wire:loading.attr="disabled">
            <span wire:loading.remove>Masuk</span>
            <span wire:loading>Memproses...</span>
        </button>
    </form>
</div>
