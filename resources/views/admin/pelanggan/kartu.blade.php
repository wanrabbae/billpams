<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Pelanggan - {{ $pelanggan->kode_pelanggan }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body {
                background: white;
                margin: 0;
            }
            .no-print {
                display: none;
            }
            .card-container {
                box-shadow: none !important;
                border: 1px solid #ccc;
            }
        }
        /* Standard ID Card Size (CR80) */
        .id-card {
            width: 8.56cm; /* 85.6mm */
            height: 5.398cm; /* 53.98mm */
        }
    </style>
</head>
<body class="bg-slate-100 flex flex-col items-center justify-center min-h-screen py-8">

    <div class="mb-6 no-print space-x-4">
        <a href="{{ route('admin.pelanggan.index') }}" class="text-blue-600 hover:underline">&larr; Kembali</a>
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow">
            Cetak Kartu
        </button>
    </div>

    <!-- Front Card -->
    <div class="id-card bg-white rounded-xl shadow-lg relative overflow-hidden flex flex-col card-container border border-slate-200">
        <!-- Header -->
        <div class="bg-blue-600 text-white p-2 flex items-center shadow-sm">
            @if($tenant->logo)
                <img src="{{ Storage::url($tenant->logo) }}" alt="Logo" class="h-8 w-8 bg-white rounded-full p-0.5 object-contain mr-2">
            @else
                <div class="h-8 w-8 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold text-xs mr-2">
                    {{ substr($tenant->name, 0, 1) }}
                </div>
            @endif
            <div>
                <div class="text-[10px] uppercase font-bold leading-tight">{{ $tenant->name }}</div>
                <div class="text-[8px] opacity-80 leading-tight">Desa {{ $tenant->village ?? '...' }} - Kec. {{ $tenant->district ?? '...' }}</div>
            </div>
        </div>

        <!-- Body -->
        <div class="flex-1 p-3 flex">
            <!-- Left Data -->
            <div class="flex-1 flex flex-col justify-center">
                <div class="mb-2">
                    <div class="text-[8px] text-slate-500 uppercase tracking-wider font-semibold">No. Pelanggan</div>
                    <div class="font-mono text-sm font-bold text-slate-800">{{ $pelanggan->kode_pelanggan }}</div>
                </div>
                <div class="mb-2">
                    <div class="text-[8px] text-slate-500 uppercase tracking-wider font-semibold">Nama</div>
                    <div class="text-xs font-bold text-slate-800 uppercase leading-tight">{{ $pelanggan->nama }}</div>
                </div>
                <div>
                    <div class="text-[8px] text-slate-500 uppercase tracking-wider font-semibold">Golongan</div>
                    <div class="text-xs font-bold text-slate-800 uppercase">{{ $pelanggan->jenis_pelanggan }}</div>
                </div>
            </div>

            <!-- Right QR -->
            <div class="w-20 flex flex-col items-center justify-center border-l border-slate-100 pl-3">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $pelanggan->kode_pelanggan }}" alt="QR Code" class="w-16 h-16 object-contain">
                <div class="text-[7px] text-center text-slate-400 mt-1">SCAN UNTUK BAYAR</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-slate-50 text-center py-1 text-[7px] text-slate-400 border-t border-slate-100">
            Harap tunjukkan kartu ini kepada petugas saat pembayaran.
        </div>
    </div>

</body>
</html>
