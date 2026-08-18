<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat {{ ucfirst($jenis) }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; line-height: 1.5; color: #333; margin: 0; padding: 20px 40px; }
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; }
        .kop-surat h1 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .kop-surat p { margin: 5px 0 0 0; font-size: 14px; }
        .info-surat { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .info-surat div { display: inline-block; width: 49%; vertical-align: top; }
        .text-right { text-align: right; }
        .isi-surat { text-align: justify; margin-bottom: 30px; }
        .rincian { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .rincian th, .rincian td { border: 1px solid #000; padding: 8px; text-align: left; }
        .rincian th { background-color: #f2f2f2; }
        .ttd { width: 100%; margin-top: 50px; }
        .ttd-box { width: 40%; float: right; text-align: center; }
        .ttd-space { height: 80px; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>PENGELOLA AIR BERSIH (BILLPAMS)</h1>
        <h1>{{ strtoupper($tenant->name) }}</h1>
        <p>{{ $tenant->address }}, {{ $tenant->village }}, Kec. {{ $tenant->district }}</p>
        <p>{{ $tenant->regency }}, Provinsi {{ $tenant->province }}</p>
    </div>

    <div class="info-surat">
        <div>
            Nomor: {{ $nomor_surat }}<br>
            Hal: <strong>{{ $jenis === 'teguran' ? 'Peringatan Tunggakan Pembayaran' : 'Pemberitahuan Pencabutan Saluran' }}</strong>
        </div>
        <div class="text-right">
            {{ $tenant->village }}, {{ $tanggal }}
        </div>
    </div>

    <div class="isi-surat">
        <p>Kepada Yth.,<br>
        Bapak/Ibu/Sdr <strong>{{ $pelanggan->nama }}</strong><br>
        (ID: {{ $pelanggan->kode_pelanggan }})<br>
        Di {{ $pelanggan->alamat }}</p>

        <p>Dengan hormat,</p>
        
        @if($jenis === 'teguran')
            <p>Berdasarkan catatan administrasi kami, Bapak/Ibu sampai dengan saat ini belum melunasi tagihan rekening air selama <strong>{{ $tunggakan_bulan }} bulan</strong> berturut-turut. Kami memohon kerjasama Bapak/Ibu untuk segera menyelesaikan tunggakan tersebut guna kelancaran operasional BILLPAMS.</p>
        @else
            <p>Berdasarkan catatan kami dan Surat Teguran yang telah dikirimkan sebelumnya, Bapak/Ibu belum melunasi tunggakan rekening air selama <strong>{{ $tunggakan_bulan }} bulan</strong>. Sesuai dengan peraturan yang berlaku, maka dengan berat hati kami memberitahukan bahwa sambungan air bersih ke rumah Bapak/Ibu akan <strong>DICABUT SEMENTARA</strong> oleh petugas lapangan kami.</p>
        @endif

        <p>Berikut adalah rincian tagihan yang belum terbayarkan:</p>

        <table class="rincian">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Periode Tagihan</th>
                    <th>Pemakaian (m³)</th>
                    <th>Jumlah Tagihan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggan->tagihans as $index => $tagihan)
                <tr>
                    <td style="text-align:center;">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($tagihan->periode)->format('F Y') }}</td>
                    <td style="text-align:right;">{{ $tagihan->pemakaian }} m³</td>
                    <td style="text-align:right;">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right;">TOTAL TUNGGAKAN</th>
                    <th style="text-align:right;">Rp {{ number_format($total_tunggakan, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        @if($jenis === 'teguran')
            <p>Apabila Bapak/Ibu telah melakukan pembayaran sebelum surat ini diterima, mohon abaikan surat ini. Jika tunggakan mencapai 3 bulan, maka sambungan air akan dicabut secara otomatis tanpa pemberitahuan lebih lanjut.</p>
        @else
            <p>Untuk penyambungan kembali, Bapak/Ibu diwajibkan melunasi seluruh tunggakan beserta biaya penyambungan kembali (administrasi) sesuai ketentuan yang berlaku. Petugas eksekusi lapangan akan mencatat proses ini dalam sistem.</p>
        @endif

        <p>Demikian surat ini kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <div class="ttd clearfix">
        <div class="ttd-box">
            Pengurus BILLPAMS<br>
            <strong>{{ $tenant->name }}</strong>
            <div class="ttd-space"></div>
            ( _____________________ )<br>
            Ketua / Bendahara
        </div>
    </div>

</body>
</html>
