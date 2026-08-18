<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Kas Umum - {{ $bulan }}/{{ $tahun }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f3f4f6; font-weight: bold; text-align: center; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .bg-gray { background-color: #f9fafb; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Buku Kas Umum - {{ $tenant->name }}</h1>
        <p>Periode: Bulan {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }} Tahun {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="10%">Tanggal</th>
                <th width="10%">No. Ref</th>
                <th width="15%">Kategori</th>
                <th width="20%">Keterangan</th>
                <th width="15%">Pemasukan (Rp)</th>
                <th width="15%">Pengeluaran (Rp)</th>
                <th width="15%">Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-gray font-bold">
                <td colspan="4" class="text-right">SALDO AWAL</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right">{{ number_format($saldoAwal, 0, ',', '.') }}</td>
            </tr>
            @foreach($transaksi as $t)
            <tr>
                <td class="text-center">{{ \Carbon\Carbon::parse($t['tanggal'])->format('d/m/Y') }}</td>
                <td class="text-center">{{ $t['id'] }}</td>
                <td>{{ $t['kategori'] }}</td>
                <td>{{ $t['deskripsi'] }}</td>
                <td class="text-right">{{ $t['debit'] > 0 ? number_format($t['debit'], 0, ',', '.') : '-' }}</td>
                <td class="text-right">{{ $t['kredit'] > 0 ? number_format($t['kredit'], 0, ',', '.') : '-' }}</td>
                <td class="text-right">{{ number_format($t['saldo'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="font-bold bg-gray">
                <td colspan="4" class="text-right">TOTAL MUTASI / SALDO AKHIR</td>
                <td class="text-right">{{ number_format($totalMasuk, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totalKeluar, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($saldoAkhir, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    
    <div style="margin-top: 50px; text-align: right; font-size: 10pt;">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
