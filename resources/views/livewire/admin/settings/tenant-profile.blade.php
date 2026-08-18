<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Profil BILLPAMS / Organisasi</h2>
                <p class="text-sm text-slate-500 mt-1">Data ini akan muncul pada Kop Surat Penagihan dan Struk Kwitansi Thermal.</p>
            </div>
            <div class="hidden sm:block">
                @if($currentLogo)
                    <img src="{{ Storage::url($currentLogo) }}" alt="Logo Tenant" class="h-16 w-16 object-contain rounded-full border border-slate-300 bg-white p-1">
                @else
                    <div class="h-16 w-16 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center">
                        <span class="text-slate-400 text-xs text-center">No<br>Logo</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="p-6">
            <form wire:submit.prevent="simpanProfil">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Organisasi <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="name" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: BILLPAMS TIRTA MAKMUR">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Bentuk Organisasi <span class="text-red-500">*</span></label>
                            <select wire:model="organization_type" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="HIPPAM">HIPPAM (Himpunan Penduduk Pemakai Air Minum)</option>
                                <option value="PAMSIMAS">PAMSIMAS</option>
                                <option value="BUMDES">BUMDes (Badan Usaha Milik Desa)</option>
                                <option value="KPSPAM">KPSPAM</option>
                                <option value="SAB">SAB (Sarana Air Bersih)</option>
                                <option value="LAINNYA">Lainnya</option>
                            </select>
                            @error('organization_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Logo Organisasi</label>
                            <input type="file" wire:model="logo" accept="image/png, image/jpeg" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border rounded-lg">
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 2MB. Resolusi kotak (1:1) disarankan.</p>
                            <div wire:loading wire:target="logo" class="text-sm text-blue-500 mt-1">Mengunggah gambar...</div>
                            @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan (Alamat) -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Desa / Kelurahan</label>
                                <input type="text" wire:model="village" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Nama Desa">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Kecamatan</label>
                                <input type="text" wire:model="district" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Kecamatan">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Kabupaten / Kota</label>
                                <input type="text" wire:model="regency" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Kab/Kota">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Provinsi</label>
                                <input type="text" wire:model="province" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Provinsi">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap / Jalan</label>
                            <textarea wire:model="address" rows="3" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Jl. Raya Desa No. 123..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition shadow-sm" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="simpanProfil">Simpan Perubahan</span>
                        <span wire:loading wire:target="simpanProfil">Menyimpan...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
