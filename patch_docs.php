<?php
$file = 'docs/Buku_Panduan_Lengkap_BILLPAMS.html';
if (file_exists($file)) {
    $content = file_get_contents($file);
    
    $insert = '

        <h3>2.1 Kredensial Login Default (Data Demo / Instalasi)</h3>
        <p>Berdasarkan data awal instalasi (<i>Database Seeder</i>), Anda dapat menggunakan akun-akun berikut untuk menguji coba berbagai fitur sistem tanpa perlu membuatnya dari nol. Seluruh akun di bawah (kecuali Super Admin) otomatis tergabung pada satu desa bernama <strong>HIPPAM Sumber Urip</strong>.</p>
        
        <table>
            <thead>
                <tr>
                    <th>Peran</th>
                    <th>Nama Akun</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Link Akses</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Super Admin</strong></td>
                    <td>Super Administrator</td>
                    <td><code>superadmin</code></td>
                    <td><code>password</code></td>
                    <td>/super/login</td>
                </tr>
                <tr>
                    <td><strong>Admin Tenant</strong></td>
                    <td>Admin Sumber Urip</td>
                    <td><code>admin_su</code></td>
                    <td><code>password</code></td>
                    <td>/login</td>
                </tr>
                <tr>
                    <td><strong>Bendahara</strong></td>
                    <td>Siti Bendahara</td>
                    <td><code>bendahara_su</code></td>
                    <td><code>password</code></td>
                    <td>/login</td>
                </tr>
                <tr>
                    <td><strong>Petugas</strong></td>
                    <td>Budi Petugas Catat</td>
                    <td><code>petugas_su</code></td>
                    <td><code>password</code></td>
                    <td>/login</td>
                </tr>
            </tbody>
        </table>
        
        <div class="alert">
            <strong>Catatan Keamanan:</strong> Harap ganti password atau hapus akun-akun demonstrasi di atas apabila sistem sudah mulai digunakan secara resmi oleh masyarakat (Naik ke tahap Production Data Asli).
        </div>
        
        <h3>2.2 Wewenang Masing-Masing Peran</h3>
';
    
    // Replace the text
    $content = str_replace('<p>Aplikasi ini membagi penggunanya ke dalam beberapa tingkatan (Peran) untuk menjaga keamanan data operasional. Berikut adalah rincian masing-masing peran:</p>', $insert . '<p>Berikut adalah rincian wewenang untuk masing-masing peran di atas serta peran tambahan lainnya:</p>', $content);
    
    file_put_contents($file, $content);
    echo "Patched $file\n";
}
