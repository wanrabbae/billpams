<div>
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('logo_billpam.png') }}" alt="BILLPAMS Logo" class="h-10 w-auto">
                <div>
                    <span class="font-bold text-xl text-blue-700 leading-none block">BILLPAM</span>
                    <span class="text-[10px] text-slate-500 block">Sistem Manajemen HIPPAM & PAMSIMAS</span>
                </div>
            </div>
            <!-- Links -->
            <div class="hidden md:flex space-x-8 text-sm font-medium text-slate-600">
                <a href="#beranda" class="text-blue-700 border-b-2 border-blue-700 pb-1">Beranda</a>
                <a href="#cek-tagihan" class="hover:text-blue-700">Cek Tagihan</a>
                <a href="#fitur-layanan" class="hover:text-blue-700">Informasi</a>
                <a href="#fitur-layanan" class="hover:text-blue-700">Layanan</a>
                <a href="#cta-section" class="hover:text-blue-700">Kontak</a>
            </div>
            <!-- Buttons -->
            <div class="flex space-x-3">
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Login Admin
                </a>
                <a href="#" class="hidden sm:inline-block px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left content -->
            <div class="lg:col-span-7">
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Kelola Air Bersih<br>
                    Lebih Mudah dengan<br>
                    <span class="text-blue-700">BILLPAM</span>
                </h1>
                <p class="text-lg text-slate-600 mb-10 max-w-lg">
                    Sistem manajemen modern untuk HIPPAM & PAMSIMAS yang transparan, cepat, dan terpercaya.
                </p>
                
                <!-- Stats -->
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3 bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex-1">
                        <div class="bg-blue-100 p-2 rounded-lg text-blue-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                        </div>
                        <div>
                            <div class="font-bold text-slate-900 text-lg leading-tight">2.100+</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase tracking-wide">Pelanggan Aktif</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex-1">
                        <div class="bg-blue-100 p-2 rounded-lg text-blue-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <div class="font-bold text-slate-900 text-lg leading-tight">1.250+</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase tracking-wide">Tagihan Bulan Ini</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex-1">
                        <div class="bg-blue-100 p-2 rounded-lg text-blue-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <div class="font-bold text-slate-900 text-lg leading-tight">98.5%</div>
                            <div class="text-[10px] text-slate-500 font-medium uppercase tracking-wide">Tingkat Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right content (Card Check Tagihan) -->
            <div class="lg:col-span-5 relative" id="cek-tagihan">
                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] p-8 border border-slate-100 relative z-10">
                    <h3 class="text-xl font-bold text-slate-900 mb-1">Cek Tagihan Pelanggan</h3>
                    <p class="text-sm text-slate-500 mb-6">Masukkan ID Pelanggan untuk melihat tagihan Anda</p>
                    
                    <form wire:submit="cekTagihan">
                        <div class="space-y-4">
                            <div>
                                <select wire:model="tenant_id" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm text-slate-700 shadow-sm">
                                    <option value="">-- Pilih HIPPAM/Desa Anda --</option>
                                    @foreach($tenants as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->village }})</option>
                                    @endforeach
                                </select>
                                @error('tenant_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="relative shadow-sm rounded-lg">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <input type="text" wire:model="kode_pelanggan" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm placeholder:text-slate-400" placeholder="Masukkan ID Pelanggan">
                            </div>
                            @error('kode_pelanggan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            
                            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg transition mt-2 flex justify-center items-center shadow-md shadow-blue-500/30" wire:loading.attr="disabled">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                <span wire:loading.remove wire:target="cekTagihan">Cek Tagihan</span>
                                <span wire:loading wire:target="cekTagihan">Mencari...</span>
                            </button>
                            
                            @if($errorMessage)
                                <div class="p-3 mt-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg">
                                    {{ $errorMessage }}
                                </div>
                            @endif
                        </div>
                    </form>
                    
                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-start text-[11px] text-slate-500 leading-relaxed">
                        <svg class="h-4 w-4 text-slate-400 mr-2 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p>ID Pelanggan biasanya tercantum pada struk pembayaran atau hubungi petugas desa setempat.</p>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center text-xs text-slate-600 font-medium">
                            <svg class="h-4 w-4 mr-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            Butuh bantuan?
                        </div>
                        <a href="#" class="text-[11px] font-semibold text-green-700 bg-green-50 px-3 py-1.5 rounded-full border border-green-200 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.898-4.45 9.898-9.898 0-5.448-4.45-9.898-9.898-9.898-5.448 0-9.898 4.45-9.898 9.898 0 2.115.601 3.716 1.597 5.392l-.995 3.633 3.704-.999zm1.319-4.831c.214-.028.468.04.707.135 1.116.442 2.766 1.258 3.018 1.488.239.219.349.52.128.875-.24.382-.494.675-.858 1.092-.262.3-.64.382-1.01.218-1.282-.57-3.14-1.34-4.858-3.058-1.718-1.718-2.488-3.576-3.058-4.858-.164-.37-.082-.748.218-1.01.417-.364.71-.618 1.092-.858.355-.221.656-.111.875.128.23.252 1.046 1.902 1.488 3.018.095.239.163.493.135.707-.035.253-.163.493-.326.656-.164.164-.37.288-.632.441.284.808 1.077 1.884 1.884 1.077.153-.262.277-.468.441-.632.163-.163.403-.291.656-.326z"/></svg>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                
                <!-- Modal/Section Hasil Query (Tampil jika ada hasil) -->
                @if($pelanggan)
                <div class="absolute top-0 left-0 w-full h-full bg-white z-20 rounded-2xl p-6 overflow-y-auto shadow-2xl border-2 border-blue-400">
                    <button wire:click="$set('pelanggan', null)" class="mb-4 text-sm text-slate-500 hover:text-blue-700 font-medium flex items-center bg-slate-50 px-3 py-1 rounded-md">
                        &larr; Kembali
                    </button>
                    <div class="bg-blue-50 border border-blue-100 px-4 py-3 flex justify-between items-center rounded-lg mb-4">
                        <h3 class="font-bold text-blue-900 text-sm">Detail Pelanggan</h3>
                        <span class="px-2 py-1 text-[10px] font-semibold rounded-full {{ $pelanggan->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ strtoupper($pelanggan->status) }}
                        </span>
                    </div>
                    
                    <p class="text-xl font-extrabold text-slate-900 leading-tight">{{ $pelanggan->nama }}</p>
                    <p class="text-sm text-slate-500 mb-4">{{ $pelanggan->kode_pelanggan }} - {{ $pelanggan->alamat }}</p>

                    @if($tunggakanBulan >= 2)
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg text-xs">
                            <strong>Peringatan!</strong> Anda menunggak {{ $tunggakanBulan }} bulan.
                        </div>
                    @endif

                    @if($tagihanTerbaru)
                        <div class="border-t border-slate-100 pt-4">
                            <h4 class="font-semibold text-slate-800 mb-2 text-sm">Bulan: {{ date('F Y', strtotime($tagihanTerbaru->periode)) }}</h4>
                            <div class="grid grid-cols-2 gap-2 mb-4 text-xs">
                                <div class="bg-slate-50 border border-slate-100 p-2 rounded text-slate-500">M.Awal: <strong class="text-slate-800">{{ $tagihanTerbaru->meter_awal }}</strong></div>
                                <div class="bg-slate-50 border border-slate-100 p-2 rounded text-slate-500">M.Akhir: <strong class="text-slate-800">{{ $tagihanTerbaru->meter_akhir }}</strong></div>
                                <div class="bg-slate-50 border border-slate-100 p-2 rounded col-span-2 text-slate-500">Pemakaian: <strong class="text-blue-700 text-base">{{ $tagihanTerbaru->pemakaian }} m³</strong></div>
                            </div>

                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4 flex justify-between items-center border border-blue-200">
                                <div>
                                    <p class="text-slate-600 text-xs font-medium">Total Tagihan</p>
                                    <p class="text-2xl font-black text-blue-900">Rp {{ number_format($tagihanTerbaru->total, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    @if($tagihanTerbaru->status === 'lunas')
                                        <span class="bg-green-500 text-white px-3 py-1.5 rounded-md text-[11px] font-bold shadow-sm">LUNAS</span>
                                    @else
                                        <span class="bg-red-500 text-white px-3 py-1.5 rounded-md text-[11px] font-bold shadow-sm">BELUM BAYAR</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-slate-500 text-center mt-6">Belum ada riwayat tagihan.</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Fitur Layanan -->
    <div class="bg-white py-16" id="fitur-layanan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Fitur Layanan BILLPAM</h2>
                <div class="w-24 h-1 bg-blue-700 mx-auto rounded"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 1 -->
                <div class="border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition bg-white relative group">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors">
                        <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Cek Tagihan</h3>
                    <p class="text-sm text-slate-500 mb-4">Cek tagihan bulan berjalan dengan cepat dan mudah.</p>
                    <a href="#" class="text-sm font-semibold text-blue-700 flex items-center">Cek Sekarang <span class="ml-1">&rarr;</span></a>
                </div>
                <!-- 2 -->
                <div class="border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition bg-white relative group">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-emerald-600 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Riwayat Pembayaran</h3>
                    <p class="text-sm text-slate-500 mb-4">Lihat riwayat pembayaran dan status transaksi Anda.</p>
                    <a href="#" class="text-sm font-semibold text-blue-700 flex items-center">Lihat Sekarang <span class="ml-1">&rarr;</span></a>
                </div>
                <!-- 3 -->
                <div class="border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition bg-white relative group">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-amber-500 transition-colors">
                        <svg class="w-6 h-6 text-amber-600 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Informasi</h3>
                    <p class="text-sm text-slate-500 mb-4">Dapatkan informasi terbaru seputar layanan dan pengumuman.</p>
                    <a href="#" class="text-sm font-semibold text-blue-700 flex items-center">Lihat Sekarang <span class="ml-1">&rarr;</span></a>
                </div>
                <!-- 4 -->
                <div class="border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition bg-white relative group">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-colors">
                        <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Hubungi Kami</h3>
                    <p class="text-sm text-slate-500 mb-4">Hubungi kami untuk bantuan atau laporan masalah.</p>
                    <a href="#" class="text-sm font-semibold text-blue-700 flex items-center">Hubungi Sekarang <span class="ml-1">&rarr;</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" id="cta-section">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- CTA 1 -->
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8 flex items-center">
                <div class="w-1/4 mr-6 hidden sm:block text-center">
                    <div class="bg-blue-600 text-white p-4 rounded-full inline-block">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Lihat Demo BILLPAM</h3>
                    <p class="text-sm text-slate-600 mb-6">Ingin melihat bagaimana sistem BILLPAM bekerja? Coba demo sekarang dan rasakan kemudahannya!</p>
                    <div class="flex flex-wrap gap-3">
                        <button class="bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-blue-800 flex items-center shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                            Lihat Demo
                        </button>
                        <button class="bg-white border border-slate-300 text-slate-700 text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-slate-50">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
            </div>
            <!-- CTA 2 -->
            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-8 flex items-center">
                <div class="w-1/4 mr-6 hidden sm:block text-center">
                    <div class="bg-emerald-600 text-white p-4 rounded-full inline-block">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Daftarkan HIPPAM Anda</h3>
                    <p class="text-sm text-slate-600 mb-6">Bergabunglah bersama HIPPAM & PAMSIMAS lainnya yang telah menggunakan sistem BILLPAM.</p>
                    <div class="flex flex-wrap gap-3">
                        <button class="bg-emerald-600 text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-emerald-700 flex items-center shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            Daftar Sekarang
                        </button>
                        <button class="bg-white border border-slate-300 text-slate-700 text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-slate-50 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Informasi Pendaftaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8" id="footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('logo_billpam.png') }}" alt="Logo" class="h-10 w-auto">
                        <div>
                            <span class="font-bold text-xl text-slate-900 leading-none block">BILLPAM</span>
                            <span class="text-[10px] text-slate-500 block">Sistem Manajemen HIPPAM & PAMSIMAS</span>
                        </div>
                    </div>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-slate-400 hover:text-blue-600"><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" /></svg></a>
                        <a href="#" class="text-slate-400 hover:text-blue-400"><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg></a>
                        <a href="#" class="text-slate-400 hover:text-pink-600"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-slate-900 mb-4 text-sm">Layanan</h4>
                    <ul class="space-y-3 text-sm text-slate-500">
                        <li><a href="#" class="hover:text-blue-600">Cek Tagihan</a></li>
                        <li><a href="#" class="hover:text-blue-600">Informasi</a></li>
                        <li><a href="#" class="hover:text-blue-600">Layanan</a></li>
                        <li><a href="#" class="hover:text-blue-600">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-slate-900 mb-4 text-sm">Bantuan</h4>
                    <ul class="space-y-3 text-sm text-slate-500">
                        <li><a href="#" class="hover:text-blue-600">FAQ</a></li>
                        <li><a href="#" class="hover:text-blue-600">Panduan Penggunaan</a></li>
                        <li><a href="#" class="hover:text-blue-600">Hubungi Kami</a></li>
                    </ul>
                </div>
                
                <div class="lg:col-span-1">
                    <h4 class="font-bold text-slate-900 mb-4 text-sm">Kontak</h4>
                    <ul class="space-y-3 text-sm text-slate-500">
                        <li class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> via WhatsApp</li>
                        <li class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> info@billpam.com</li>
                        <li class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg> www.billpam.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-slate-200">
                <div class="text-sm text-slate-500 mb-4 md:mb-0">
                    &copy; {{ date('Y') }} BILLPAM. All rights reserved.
                </div>
                <!-- PSE Badge -->
                <div>
                    <img src="{{ asset('pse_badge.jpg') }}" alt="Terdaftar PSE Kominfo" class="h-28 w-auto drop-shadow-sm">
                </div>
            </div>
        </div>
    </footer>
</div>
