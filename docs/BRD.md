# BUSINESS REQUIREMENTS DOCUMENT (BRD)

# **HIPPAMS V2.1**

## HIPPAM & PAMSIMAS MANAGEMENT SYSTEM

**Developer / Provider:** Faisal Group
**Produk:** HIPPAMS
**Model:** SaaS Multi-Tenant
**Platform:** Web Responsive + PWA
**Target:** HIPPAM, PAMSIMAS, BUMDes/unit pengelola air
**Status:** **FINAL — DEVELOPMENT READY**

---

# 1. EXECUTIVE SUMMARY

**HIPPAMS** adalah platform digital untuk mengelola seluruh operasional HIPPAM/PAMSIMAS dalam satu sistem.

HIPPAMS dirancang sebagai **multi-tenant**, sehingga dapat digunakan oleh banyak organisasi secara bersamaan.

Setiap HIPPAM/PAMSIMAS memiliki:

* Data pelanggan sendiri
* Tarif sendiri
* Data meter sendiri
* Tagihan sendiri
* Pembayaran sendiri
* Petugas sendiri
* Bendahara sendiri
* Pengawas sendiri
* Keuangan sendiri
* Laporan sendiri
* Halaman cek tagihan sendiri

Sementara **Super Admin** mengelola seluruh platform.

### Siklus utama sistem

**Pelanggan → Meter → Pemakaian → Tarif → Tagihan → Pembayaran → Kwitansi → Setoran → Keuangan → Laporan → Transparansi**

Apabila pelanggan menunggak:

**1 bulan → Monitoring**

**2 bulan → Surat Teguran**

**3 bulan → Surat Pencabutan**

**Pencabutan → Status Nonaktif**

---

# 2. IDENTITAS PRODUK

| Item             | Detail                              |
| ---------------- | ----------------------------------- |
| Nama Produk      | **HIPPAMS**                         |
| Kepanjangan      | HIPPAM & PAMSIMAS Management System |
| Provider         | **Faisal Group**                    |
| Model            | SaaS Multi-Tenant                   |
| Platform         | Web + PWA                           |
| Target           | HIPPAM/PAMSIMAS/BUMDes              |
| Pembayaran V1    | Tunai melalui Petugas/Kolektor      |
| Portal Pelanggan | Cek tagihan tanpa login             |
| WhatsApp         | Tidak digunakan pada core V1        |
| Printer          | Thermal 58/80 mm                    |
| Multi-role       | Ya                                  |
| Multi-tarif      | Ya                                  |
| Multi-tenant     | Ya                                  |

---

# 3. TENANT PERTAMA

Implementasi awal:

## **HIPPAM SUMBER URIP**

**Desa Bulurejo**
**Kecamatan Rengel**
**Kabupaten Tuban**
**Jawa Timur**

Data awal:

**±840 pelanggan**

Contoh kode:

* `UM-2026-001`
* `SO-2026-001`
* `IN-2026-001`

---

# 4. LATAR BELAKANG

Pengelolaan HIPPAM/PAMSIMAS umumnya membutuhkan pencatatan:

* Pelanggan
* Meter air
* Tagihan
* Pembayaran
* Piutang
* Keuangan
* Petugas
* Laporan

Jika dilakukan secara manual, dapat terjadi:

* Kesalahan pencatatan meter
* Perhitungan tagihan tidak konsisten
* Kesulitan mengetahui tunggakan
* Rekap pembayaran lambat
* Kesulitan melakukan kontrol keuangan
* Kurangnya transparansi
* Sulit memantau pekerjaan petugas

HIPPAMS dirancang untuk mengintegrasikan seluruh proses tersebut.

---

# 5. TUJUAN

## Tujuan utama

1. Digitalisasi administrasi HIPPAM/PAMSIMAS.
2. Memudahkan pengelolaan pelanggan.
3. Memudahkan pencatatan meter.
4. Mengotomatisasi perhitungan pemakaian.
5. Mengotomatisasi tagihan.
6. Mengelola tarif berdasarkan jenis pelanggan.
7. Mengelola pembayaran.
8. Mengelola kolektor.
9. Mencetak struk thermal.
10. Mengelola piutang.
11. Mengelola surat teguran.
12. Mengelola surat pencabutan.
13. Mengelola keuangan.
14. Meningkatkan transparansi.
15. Menyediakan pengawasan.
16. Memungkinkan pelanggan mengecek tagihan tanpa login.
17. Menjadi platform yang dapat dijual ke banyak HIPPAM/PAMSIMAS.

---

# 6. KONSEP MULTI-TENANT

HIPPAMS menggunakan konsep:

> **Satu platform — banyak organisasi.**

Contoh:

```text
                         HIPPAMS CLOUD
                              │
                      ┌───────┴───────┐
                      │  SUPER ADMIN  │
                      └───────┬───────┘
                              │
             ┌────────────────┼────────────────┐
             │                │                │
        HIPPAM A          HIPPAM B         PAMSIMAS C
             │                │                │
          ADMIN A          ADMIN B          ADMIN C
```

Setiap tenant mempunyai database logis/data yang terisolasi.

---

# 7. TENANT ISOLATION

Ini merupakan **requirement kritis**.

Setiap data operasional wajib memiliki:

`tenant_id`

Contoh:

```text
Pelanggan
├── id
├── tenant_id
├── kode_pelanggan
├── nama
└── alamat
```

### Aturan

Admin HIPPAM A:

❌ Tidak dapat melihat HIPPAM B.

Bendahara HIPPAM A:

❌ Tidak dapat melihat keuangan HIPPAM B.

Petugas HIPPAM A:

❌ Tidak dapat mengakses pelanggan HIPPAM B.

Pengawas HIPPAM A:

❌ Tidak dapat mengakses laporan HIPPAM B.

Super Admin:

✓ Dapat mengelola seluruh tenant sesuai kewenangannya.

---

# 8. HIERARKI ROLE

```text
SUPER ADMIN
     │
     ├── TENANT A
     │     └── ADMIN TENANT
     │          ├── BENDAHARA
     │          ├── PETUGAS LAPANGAN
     │          └── PENGAWAS
     │
     ├── TENANT B
     │     └── ADMIN TENANT
     │
     └── TENANT C
           └── ADMIN TENANT
```

Pelanggan tidak mempunyai akun login.

Pelanggan menggunakan:

**Portal Cek Tagihan Publik.**

---

# 9. SUPER ADMIN

Super Admin adalah pengelola platform HIPPAMS/Faisal Group.

## Dashboard

Menampilkan:

* Total tenant
* Tenant aktif
* Tenant nonaktif
* Tenant suspend
* Total pelanggan
* Total user
* Total transaksi
* Penggunaan sistem
* Storage
* Subscription

## Super Admin dapat:

* Membuat tenant
* Mengedit tenant
* Mengaktifkan tenant
* Menonaktifkan tenant
* Suspend tenant
* Membuat Admin Tenant
* Reset Admin Tenant
* Mengatur paket
* Mengatur fitur
* Melihat statistik platform
* Melihat audit platform

Super Admin tidak digunakan untuk operasional harian setiap tenant.

---

# 10. DATA TENANT

Field:

* ID Tenant
* Kode Tenant
* Nama organisasi
* Jenis organisasi
* Desa
* Kecamatan
* Kabupaten
* Provinsi
* Alamat
* Logo
* Kontak
* Status
* Paket layanan
* Tanggal mulai
* Masa berlaku

---

# 11. KODE TENANT

Contoh:

`HSU001`
HIPPAM Sumber Urip

`HPA002`
HIPPAM Desa A

`PMS003`
PAMSIMAS Desa B

Kode harus unik.

---

# 12. ADMIN TENANT

Admin Tenant adalah administrator masing-masing HIPPAM/PAMSIMAS.

Admin dapat mengelola:

* Pelanggan
* Meter
* Tarif
* Tagihan
* Pembayaran
* Kolektor
* Setoran
* Keuangan
* Laporan
* User
* Penagihan
* Surat
* Transparansi
* Profil tenant

---

# 13. MANAJEMEN USER

Admin Tenant dapat membuat:

### Bendahara

### Petugas Lapangan

### Pengawas

Form:

```text
TAMBAH PENGGUNA

Nama:
[________________]

Username:
[________________]

Password:
[________________]

Role:
[ BENDAHARA ▼ ]

Status:
[ AKTIF ▼ ]

[ SIMPAN ]
```

Admin dapat:

* Tambah
* Edit
* Aktifkan
* Nonaktifkan
* Reset password
* Ubah role
* Melihat aktivitas

---

# 14. BENDAHARA

## Akses

* Dashboard keuangan
* Pembayaran
* Setoran
* Pemasukan
* Pengeluaran
* Kas
* Saldo
* Piutang
* Laporan

## Tidak dapat

* Membuat user
* Mengubah role
* Mengubah tenant
* Mengubah konfigurasi platform
* Menghapus transaksi permanen

---

# 15. PETUGAS LAPANGAN / KOLEKTOR

Petugas menangani:

### Cek meter

### Pembayaran

### Kolektor

### Setoran

Menu:

```text
BERANDA
CEK METER
PEMBAYARAN
PELANGGAN
RIWAYAT
SETORAN
PROFIL
```

---

# 16. PENGAWAS

Mode:

# **READ ONLY**

Dapat melihat:

* Dashboard
* Pelanggan
* Meter
* Tagihan
* Pembayaran
* Piutang
* Pemasukan
* Pengeluaran
* Saldo
* Subsidi
* Laporan
* Audit tertentu

Tidak dapat mengubah data.

---

# 17. PORTAL PELANGGAN

Pelanggan **tidak perlu login**.

Tidak ada:

* Username
* Password
* Registrasi

Pelanggan cukup memasukkan:

# KODE PELANGGAN

---

# 18. CEK TAGIHAN TANPA LOGIN

Tampilan:

```text
┌─────────────────────────────────┐
│             HIPPAMS             │
│ HIPPAM & PAMSIMAS MANAGEMENT    │
│                                 │
│        CEK TAGIHAN AIR          │
│                                 │
│ Kode Pelanggan                  │
│ [ UM-2026-001                ]  │
│                                 │
│       [ CEK TAGIHAN ]           │
└─────────────────────────────────┘
```

---

# 19. HASIL CEK TAGIHAN

```text
TAGIHAN AIR

Kode       : UM-2026-001
Nama       : BUDI SANTOSO
Periode    : AGUSTUS 2026

Meter Awal : 100
Meter Akhir: 125
Pemakaian  : 25 m³

Tarif      : Rp2.000/m³

TOTAL
Rp50.000

STATUS
🔴 BELUM BAYAR
```

---

# 20. DATA PUBLIK YANG DITAMPILKAN

Pelanggan dapat melihat:

* Kode pelanggan
* Nama
* Periode
* Meter awal
* Meter akhir
* Pemakaian
* Tarif
* Subsidi
* Total tagihan
* Status pembayaran
* Riwayat tagihan terbatas

Tidak menampilkan informasi sensitif.

---

# 21. KEAMANAN PORTAL PUBLIK

Karena tanpa login, wajib menggunakan:

* Rate limiting
* CAPTCHA jika diperlukan
* Request throttling
* Monitoring akses
* Tidak ada pencarian berdasarkan nama
* Tidak ada daftar seluruh pelanggan
* Kode pelanggan sebagai parameter utama

---

# 22. QR CEK TAGIHAN

Setiap pelanggan dapat memiliki QR.

QR mengarah ke:

**Halaman cek tagihan tenant + kode pelanggan.**

QR dapat dicetak pada:

* Kartu pelanggan
* Buku pembayaran
* Stiker meter
* Struk

---

# 23. DATA PELANGGAN

Data dibuat sederhana sesuai kebutuhan:

| Field            | Detail               |
| ---------------- | -------------------- |
| ID Pelanggan     | Otomatis             |
| Kode Pelanggan   | Otomatis             |
| Nama Pelanggan   | Wajib                |
| Alamat           | Wajib                |
| Status Pelanggan | Aktif/Nonaktif       |
| Jenis Pelanggan  | Umum/Sosial/Industri |
| Keterangan       | Opsional             |

---

# 24. KODE PELANGGAN

Kode dibedakan berdasarkan jenis.

### UMUM

`UM-2026-001`

### SOSIAL

`SO-2026-001`

### INDUSTRI

`IN-2026-001`

Nomor urut berdasarkan:

**Tenant + Jenis + Tahun**

---

# 25. STATUS PELANGGAN

* Aktif
* Nonaktif
* Dicabut

Pelanggan nonaktif/dicabut tidak dibuatkan tagihan baru.

---

# 26. JENIS PELANGGAN

Default:

### UMUM

Rp2.000/m³

### SOSIAL

15 m³/bulan gratis.

Di atas 15 m³:

Rp2.000/m³ untuk kelebihan.

### INDUSTRI

Rp1.500/m³.

---

# 27. ENGINE TARIF

Tarif harus configurable.

Tidak boleh hard-coded.

Admin Tenant dapat mengatur:

* Tarif
* Batas gratis
* Tarif kelebihan
* Tanggal berlaku

Contoh:

```text
JENIS
SOSIAL

BATAS GRATIS
15 m³

TARIF KELEBIHAN
Rp2.000/m³
```

---

# 28. PERHITUNGAN UMUM

Rumus:

**Pemakaian × Tarif**

Contoh:

20 m³ × Rp2.000

= **Rp40.000**

---

# 29. PERHITUNGAN SOSIAL

### ≤15 m³

Tagihan:

**Rp0**

### >15 m³

Rumus:

**(Pemakaian − 15) × Tarif Kelebihan**

Contoh 20 m³:

**5 × Rp2.000 = Rp10.000**

---

# 30. SUBSIDI SOSIAL

Sistem wajib mencatat nilai subsidi.

Contoh:

15 m³ × Rp2.000

= **Rp30.000**

Tagihan pelanggan:

**Rp0**

Laporan:

**Subsidi Sosial = Rp30.000**

---

# 31. INDUSTRI

Default:

**Rp1.500/m³**

Contoh:

100 m³ × Rp1.500

= **Rp150.000**

---

# 32. MODUL METER AIR

Data:

* ID
* Tenant
* Pelanggan
* Periode
* Meter awal
* Meter akhir
* Pemakaian
* Foto meter
* Petugas
* Tanggal input

Formula:

**Pemakaian = Meter Akhir − Meter Awal**

---

# 33. ALUR CEK METER

```text
PETUGAS
   ↓
CARI PELANGGAN
   ↓
METER SEBELUMNYA
   ↓
INPUT METER SEKARANG
   ↓
FOTO METER
   ↓
SISTEM HITUNG PEMAKAIAN
   ↓
SIMPAN
```

---

# 34. VALIDASI METER

Jika:

**Meter Akhir < Meter Awal**

maka input ditolak.

Koreksi harus:

* Dilakukan user berwenang
* Memerlukan alasan
* Tercatat Audit Log

---

# 35. MODUL TAGIHAN

Tagihan berdasarkan:

**Tenant + Pelanggan + Periode + Pemakaian + Tarif**

Field:

* Nomor tagihan
* Kode pelanggan
* Jenis
* Periode
* Meter awal
* Meter akhir
* Pemakaian
* Tarif
* Subsidi
* Total
* Status

Status:

* Belum Bayar
* Sebagian
* Lunas
* Void

---

# 36. GENERATE TAGIHAN

Admin dapat:

* Generate satu pelanggan
* Generate batch
* Generate satu periode

Contoh:

**Generate Tagihan September 2026**

Sistem membuat tagihan seluruh pelanggan aktif yang memenuhi kondisi periode tersebut.

---

# 37. MODUL PEMBAYARAN

Metode V1:

# **TUNAI**

Pembayaran dilakukan melalui:

**Petugas Lapangan/Kolektor**

Alur:

```text
PELANGGAN
   ↓
PETUGAS
   ↓
CEK TAGIHAN
   ↓
TERIMA PEMBAYARAN
   ↓
INPUT
   ↓
KWITANSI
   ↓
SETORAN
   ↓
BENDAHARA
```

---

# 38. KWITANSI

Nomor otomatis:

`HSU/2026/000001`

Isi:

* Nomor
* Kode pelanggan
* Nama
* Jenis
* Periode
* Meter
* Pemakaian
* Tagihan
* Dibayar
* Kembalian
* Tanggal
* Petugas
* Status

---

# 39. STRUK THERMAL

Mendukung:

* 58 mm
* 80 mm
* Bluetooth printer
* USB printer jika didukung perangkat

Contoh:

```text
================================
          HIPPAMS
      HIPPAM SUMBER URIP
================================

BUKTI PEMBAYARAN

No      : HSU/2026/000001
Kode    : UM-2026-001
Nama    : BUDI SANTOSO

Periode : AGUSTUS 2026

Meter Awal  : 100
Meter Akhir : 125
Pemakaian   : 25 m³

Tagihan     : Rp50.000
Dibayar     : Rp50.000

STATUS      : LUNAS

Petugas:
AGUS

--------------------------------
Terima kasih
================================
```

---

# 40. MODUL KOLEKTOR

Dashboard petugas:

* Jumlah transaksi
* Total penerimaan
* Total disetor
* Belum disetor
* Selisih

Setiap transaksi terkait:

**Tenant + Petugas + Pelanggan + Tagihan**

---

# 41. SETORAN

Status:

* Belum Disetor
* Menunggu Konfirmasi
* Diterima
* Ada Selisih

Bendahara melakukan konfirmasi.

---

# 42. MODUL PENAGIHAN

Menu:

```text
PENAGIHAN
├── Semua Tunggakan
├── 1 Bulan
├── 2 Bulan
├── 3 Bulan+
├── Surat Teguran
├── Surat Pencabutan
├── Riwayat Surat
└── Riwayat Pencabutan
```

---

# 43. SISTEM TUNGGAKAN

Sistem otomatis menghitung jumlah bulan tagihan yang belum lunas.

Contoh:

```text
Juni       BELUM BAYAR
Juli       BELUM BAYAR
Agustus    BELUM BAYAR
```

Total:

**3 bulan tunggakan**

---

# 44. ATURAN DEFAULT TUNGGAKAN

| Tunggakan          | Tindakan             |
| ------------------ | -------------------- |
| 1 bulan            | Monitoring           |
| **2 bulan**        | **Surat Teguran**    |
| **3 bulan**        | **Surat Pencabutan** |
| Setelah pencabutan | **Nonaktif/Dicabut** |

Aturan dapat dikonfigurasi per tenant.

---

# 45. TUNGGAKAN 1 BULAN

Status:

**MENUNGGAK 1 BULAN**

Sistem:

* Menambah piutang.
* Menampilkan pada dashboard.
* Memasukkan ke daftar monitoring.

Belum otomatis menerbitkan surat teguran.

---

# 46. TUNGGAKAN 2 BULAN

Ketika pelanggan memiliki dua periode tagihan belum lunas:

Status:

# **TEGURAN**

Sistem menyediakan:

**Surat Teguran Pembayaran**

---

# 47. SURAT TEGURAN

Isi:

* Kop tenant
* Logo
* Nomor surat
* Tanggal
* Nama pelanggan
* Kode pelanggan
* Alamat
* Periode tunggakan
* Total tunggakan
* Keterangan
* Tanda tangan pihak berwenang

Contoh:

```text
SURAT TEGURAN PEMBAYARAN

Nomor:
ST/HSU/2026/00001

Kepada:
BUDI SANTOSO

Kode:
UM-2026-001

Tunggakan:
2 Bulan

Total:
Rp90.000

Mohon melakukan pembayaran
atas tunggakan tersebut sesuai
ketentuan yang berlaku.
```

---

# 48. STATUS SURAT

Surat memiliki status:

* Draft
* Diterbitkan
* Diberikan
* Selesai

Riwayat disimpan.

---

# 49. TUNGGAKAN 3 BULAN

Jika mencapai tiga periode belum lunas:

Status:

# **PENCABUTAN**

Sistem menyediakan:

**Surat Pencabutan**

---

# 50. SURAT PENCABUTAN

Isi:

* Kop tenant
* Logo
* Nomor surat
* Tanggal
* Nama pelanggan
* Kode pelanggan
* Alamat
* Total tunggakan
* Periode tunggakan
* Dasar tindakan
* Tanggal pelaksanaan
* Petugas
* Tanda tangan
* Keterangan

---

# 51. PELAKSANAAN PENCABUTAN

Pencabutan harus memiliki proses konfirmasi.

```text
SURAT PENCABUTAN
       ↓
PETUGAS MELAKSANAKAN
       ↓
KONFIRMASI
       ↓
CATAT TANGGAL
       ↓
CATAT PETUGAS
       ↓
STATUS PELANGGAN
DICABUT
```

Bukti dapat berupa:

* Foto
* Catatan
* Tanggal
* Nama petugas

---

# 52. STATUS DICABUT

Setelah pencabutan dikonfirmasi:

**Aktif → Dicabut**

Pelanggan tidak dibuatkan tagihan baru.

Histori lama tetap tersimpan.

---

# 53. PEMBAYARAN SETELAH SURAT

Jika pelanggan membayar setelah surat teguran:

Sistem otomatis memperbarui:

**Piutang berkurang**

Jika lunas:

**Status tagihan = LUNAS**

Riwayat surat tetap tersimpan.

---

# 54. AKTIVASI KEMBALI

Pelanggan yang sudah dicabut dapat diproses untuk:

**Aktivasi Kembali**

Jika kebijakan tenant mengizinkan.

Data:

* Tanggal aktivasi
* Petugas
* Pembayaran tunggakan
* Biaya sambung kembali jika ada
* Keterangan

Aturan dapat dikonfigurasi tenant.

---

# 55. CEK TAGIHAN PELANGGAN DENGAN TUNGGAKAN

Jika dua bulan:

```text
⚠ PERHATIAN

Anda memiliki tunggakan
selama 2 bulan.

Total:
Rp90.000

STATUS:
SURAT TEGURAN
```

Jika tiga bulan:

```text
⚠ PERHATIAN

Anda memiliki tunggakan
selama 3 bulan.

Total:
Rp135.000

STATUS:
SURAT PENCABUTAN
```

---

# 56. MODUL PEMASUKAN

Sumber:

* Pembayaran pelanggan
* Pendapatan lain

Field:

* Nomor
* Tanggal
* Kategori
* Sumber
* Keterangan
* Nominal
* User

---

# 57. MODUL PENGELUARAN

Kategori:

* Listrik
* Pompa
* Perbaikan
* Material
* Honor
* Operasional
* Transportasi
* Administrasi
* Lain-lain

Field:

* Nomor
* Tanggal
* Kategori
* Keterangan
* Nominal
* Bukti
* User

---

# 58. KAS DAN SALDO

Formula:

**Saldo Akhir = Saldo Awal + Pemasukan − Pengeluaran**

Saldo dihitung per tenant.

---

# 59. PIUTANG

Piutang otomatis berasal dari:

**Tagihan − Pembayaran**

Dashboard:

* Total piutang
* Piutang 1 bulan
* Piutang 2 bulan
* Piutang 3 bulan+
* Piutang berdasarkan jenis
* Piutang berdasarkan wilayah
* Piutang berdasarkan pelanggan

---

# 60. DASHBOARD ADMIN TENANT

Menampilkan:

### Pelanggan

* Total
* Umum
* Sosial
* Industri
* Aktif
* Nonaktif
* Dicabut

### Meter

* Sudah cek
* Belum cek
* Total pemakaian

### Tagihan

* Total
* Lunas
* Belum bayar
* Piutang

### Penagihan

* Tunggakan 1 bulan
* Tunggakan 2 bulan
* Tunggakan 3 bulan
* Surat teguran
* Surat pencabutan

### Keuangan

* Pemasukan
* Pengeluaran
* Saldo
* Subsidi

---

# 61. DASHBOARD BENDAHARA

Menampilkan:

* Pemasukan hari ini
* Pemasukan bulan ini
* Pengeluaran
* Saldo
* Setoran petugas
* Selisih setoran
* Piutang
* Surplus

---

# 62. DASHBOARD PETUGAS

Menampilkan:

* Target cek meter
* Sudah cek
* Belum cek
* Pembayaran hari ini
* Total penerimaan
* Belum setor
* Setoran

---

# 63. DASHBOARD PENGAWAS

Menampilkan:

* Total pelanggan
* Pemakaian
* Tagihan
* Pembayaran
* Piutang
* Pemasukan
* Pengeluaran
* Saldo
* Subsidi
* Tunggakan
* Surat teguran
* Surat pencabutan

Mode:

**READ ONLY**

---

# 64. DASHBOARD SUPER ADMIN

Menampilkan:

* Total tenant
* Tenant aktif
* Tenant nonaktif
* Tenant suspend
* Total pelanggan
* Total user
* Total transaksi
* Statistik penggunaan
* Subscription
* Storage

---

# 65. WEBSITE PUBLIK TENANT

Setiap tenant dapat mempunyai halaman:

* Beranda
* Profil
* Cek Tagihan
* Tarif
* Transparansi
* Pengumuman
* Kontak

---

# 66. TRANSPARANSI PUBLIK

Tenant dapat memilih data yang ditampilkan:

* Jumlah pelanggan
* Pemakaian
* Pemasukan
* Pengeluaran
* Saldo
* Surplus
* Subsidi sosial
* Laporan bulanan
* Laporan tahunan

Data pribadi pelanggan tidak boleh ditampilkan.

---

# 67. LAPORAN PELANGGAN

* Semua pelanggan
* Umum
* Sosial
* Industri
* Aktif
* Nonaktif
* Dicabut

---

# 68. LAPORAN METER

* Periode
* Petugas
* Pemakaian
* Belum cek
* Meter tidak valid
* Koreksi meter

---

# 69. LAPORAN TAGIHAN

* Total tagihan
* Lunas
* Belum bayar
* Sebagian
* Piutang
* Berdasarkan jenis
* Berdasarkan periode

---

# 70. LAPORAN PENAGIHAN

* Tunggakan 1 bulan
* Tunggakan 2 bulan
* Tunggakan 3 bulan
* Surat teguran
* Surat pencabutan
* Pelanggan dicabut
* Aktivasi kembali

---

# 71. LAPORAN KEUANGAN

* Pemasukan
* Pengeluaran
* Saldo
* Surplus
* Piutang
* Setoran kolektor
* Subsidi sosial

---

# 72. EXPORT

Semua laporan dapat:

* Excel
* PDF
* Print

Dokumen surat dapat:

* PDF
* Print

---

# 73. IMPORT DATA

Import pelanggan melalui Excel.

Format:

| Kode | Nama | Alamat | Status | Jenis | Keterangan |
| ---- | ---- | ------ | ------ | ----- | ---------- |

Sistem:

1. Upload
2. Validasi
3. Preview
4. Deteksi duplikat
5. Import
6. Laporan hasil

---

# 74. AUDIT LOG

Mencatat:

* Login
* Logout
* Login gagal
* Tambah user
* Edit user
* Reset password
* Perubahan role
* Tambah pelanggan
* Edit pelanggan
* Input meter
* Koreksi meter
* Generate tagihan
* Pembayaran
* Void
* Pemasukan
* Pengeluaran
* Setoran
* Perubahan tarif
* Surat teguran
* Surat pencabutan
* Pencabutan pelanggan
* Aktivasi kembali

---

# 75. TRANSAKSI KEUANGAN

Transaksi tidak boleh dihapus permanen.

Jika salah:

# **VOID**

Wajib:

* Alasan
* User
* Waktu
* Data lama
* Data baru

---

# 76. DATABASE UTAMA

## `tenants`

* id
* tenant_code
* name
* organization_type
* village
* district
* regency
* province
* address
* logo
* status
* package_id
* created_at
* updated_at

## `users`

* id
* tenant_id
* name
* username
* password_hash
* role
* status
* last_login
* created_at
* updated_at

## `pelanggan`

* id
* tenant_id
* kode_pelanggan
* nama
* alamat
* status
* jenis_pelanggan
* keterangan
* created_at
* updated_at

## `meter`

* id
* tenant_id
* pelanggan_id
* periode
* meter_awal
* meter_akhir
* pemakaian
* foto_meter
* petugas_id
* created_at

## `tarif`

* id
* tenant_id
* jenis_pelanggan
* tarif
* batas_gratis
* tarif_kelebihan
* effective_date
* status

## `tagihan`

* id
* tenant_id
* pelanggan_id
* periode
* meter_awal
* meter_akhir
* pemakaian
* tarif
* subsidi
* total
* status

## `pembayaran`

* id
* tenant_id
* pelanggan_id
* tagihan_id
* nomor_kwitansi
* nominal
* tanggal
* petugas_id
* status

## `setoran`

* id
* tenant_id
* petugas_id
* tanggal
* jumlah_transaksi
* total_penerimaan
* total_setoran
* selisih
* status

## `pemasukan`

* id
* tenant_id
* tanggal
* kategori
* sumber
* keterangan
* nominal
* user_id

## `pengeluaran`

* id
* tenant_id
* tanggal
* kategori
* keterangan
* nominal
* bukti
* user_id

---

# 77. DATABASE PENAGIHAN

## `surat_penagihan`

```text
id
tenant_id
pelanggan_id
jenis_surat
nomor_surat
tanggal_surat
total_tunggakan
jumlah_bulan
status
dibuat_oleh
diberikan_pada
keterangan
created_at
updated_at
```

Jenis surat:

* Teguran
* Pencabutan

---

## `pencabutan`

```text
id
tenant_id
pelanggan_id
tanggal_pencabutan
alasan
total_tunggakan
petugas_id
bukti
keterangan
created_at
```

---

## `pengaturan_penagihan`

```text
id
tenant_id
teguran_bulan
pencabutan_bulan
status
```

Default:

```text
teguran_bulan = 2
pencabutan_bulan = 3
```

---

# 78. BUSINESS RULE

### BR-001

Setiap tenant memiliki ID unik.

### BR-002

Setiap data operasional memiliki `tenant_id`.

### BR-003

Tenant tidak dapat melihat tenant lain.

### BR-004

Super Admin dapat mengelola seluruh tenant.

### BR-005

Admin Tenant dapat membuat Bendahara, Petugas, dan Pengawas.

### BR-006

Pengawas bersifat read-only.

### BR-007

Pelanggan tidak membutuhkan login.

### BR-008

Cek tagihan menggunakan kode pelanggan.

### BR-009

Kode Umum menggunakan prefix `UM`.

### BR-010

Kode Sosial menggunakan prefix `SO`.

### BR-011

Kode Industri menggunakan prefix `IN`.

### BR-012

Kode pelanggan harus unik.

### BR-013

Tarif dapat berbeda antar-tenant.

### BR-014

Default Umum Rp2.000/m³.

### BR-015

Default Sosial maksimal 15 m³ gratis.

### BR-016

Kelebihan Sosial dihitung Rp2.000/m³.

### BR-017

Default Industri Rp1.500/m³.

### BR-018

Pemakaian = Meter Akhir − Meter Awal.

### BR-019

Meter akhir tidak boleh lebih kecil dari meter awal.

### BR-020

Pembayaran V1 dilakukan tunai melalui petugas/kolektor.

### BR-021

Setiap pembayaran memiliki nomor kwitansi unik.

### BR-022

Transaksi keuangan tidak dihapus permanen.

### BR-023

Transaksi salah menggunakan status VOID.

### BR-024

Sistem menghitung jumlah periode tunggakan.

### BR-025

Tunggakan 1 bulan masuk monitoring.

### BR-026

Default tunggakan 2 bulan menghasilkan Surat Teguran.

### BR-027

Default tunggakan 3 bulan menghasilkan Surat Pencabutan.

### BR-028

Surat pencabutan tidak otomatis berarti sambungan sudah dicabut secara fisik.

### BR-029

Pencabutan fisik harus dikonfirmasi oleh petugas/Admin.

### BR-030

Setelah pencabutan dikonfirmasi, pelanggan menjadi `DICABUT`.

### BR-031

Pelanggan dicabut tidak dibuatkan tagihan baru.

### BR-032

Pembayaran mengurangi nilai piutang.

### BR-033

Surat dan pencabutan masuk histori.

### BR-034

Semua tindakan penting masuk Audit Log.

### BR-035

Aturan 2/3 bulan dapat dikonfigurasi per tenant.

---

# 79. PENTING — LOGIKA SURAT

Developer **tidak boleh langsung mengubah pelanggan menjadi dicabut hanya karena mencapai tiga bulan tunggakan.**

Alur harus:

**3 bulan tunggakan**

↓

**Sistem memberi status “Siap Surat Pencabutan”**

↓

**Surat Pencabutan diterbitkan**

↓

**Petugas melaksanakan tindakan**

↓

**Admin/Petugas melakukan konfirmasi**

↓

**Status pelanggan = DICABUT**

Ini mencegah kesalahan otomatis dalam tindakan lapangan.

---

# 80. PAKET SAAS

Contoh:

### BASIC

≤500 pelanggan

### STANDARD

≤2.000 pelanggan

### PROFESSIONAL

≤5.000 pelanggan

### ENTERPRISE

Custom

Harga ditentukan Super Admin.

---

# 81. FEATURE CONTROL

Super Admin dapat menentukan fitur berdasarkan paket.

| Fitur         |   Basic  | Standard | Pro |
| ------------- | :------: | :------: | :-: |
| Pelanggan     |     ✓    |     ✓    |  ✓  |
| Meter         |     ✓    |     ✓    |  ✓  |
| Tagihan       |     ✓    |     ✓    |  ✓  |
| Pembayaran    |     ✓    |     ✓    |  ✓  |
| Penagihan     |     ✓    |     ✓    |  ✓  |
| Surat         |     ✓    |     ✓    |  ✓  |
| Keuangan      |     ✓    |     ✓    |  ✓  |
| Thermal       |     ✓    |     ✓    |  ✓  |
| Transparansi  |     ✓    |     ✓    |  ✓  |
| Multi Petugas | Terbatas |     ✓    |  ✓  |
| API           |     -    |     -    |  ✓  |
| White Label   |     -    |     ✓    |  ✓  |

---

# 82. WHITE LABEL

Paket tertentu dapat menggunakan:

* Logo sendiri
* Nama sendiri
* Warna sendiri
* Kop laporan
* Kop surat
* Kop struk
* Domain/custom URL

Contoh:

**HIPPAM SUMBER URIP**

atau

**PAMSIMAS DESA MAKMUR**

---

# 83. PWA / MOBILE

Aplikasi harus:

* Mobile-first
* Responsive
* PWA
* Bisa dipasang di Android
* Kamera untuk foto meter
* Printer thermal Bluetooth
* Loading cepat
* Form sederhana

---

# 84. NOTIFIKASI

Core V1:

**Tidak menggunakan WhatsApp otomatis.**

Arsitektur dapat disiapkan untuk:

* WhatsApp
* SMS
* Email
* Push notification

Tetapi fitur tersebut bukan requirement wajib versi awal.

---

# 85. ALUR LENGKAP SISTEM

```text
                     DATA PELANGGAN
                           │
                           ▼
                       CEK METER
                           │
                           ▼
                       PEMAKAIAN
                           │
                           ▼
                       ENGINE TARIF
                           │
                           ▼
                        TAGIHAN
                           │
             ┌─────────────┴─────────────┐
             │                           │
          BAYAR                       BELUM BAYAR
             │                           │
             ▼                           ▼
         KWITANSI                  TUNGGAKAN
             │                           │
             ▼                     ┌─────┴─────┐
         SETORAN                    │           │
             │                    1 BULAN    2 BULAN
             ▼                      │           │
        BENDAHARA                   │       TEGURAN
             │                      │           │
             ▼                      │        3 BULAN
      PEMASUKAN/KAS                 │           │
             │                      │      PENCABUTAN
             │                      │           │
             └──────────┬───────────┘           ▼
                        │                    KONFIRMASI
                        ▼                        │
                     LAPORAN                     ▼
                        │                     DICABUT
                        ▼
                  TRANSPARANSI
```

---

# 86. ALUR PELANGGAN

```text
WEBSITE
   ↓
KODE PELANGGAN
   ↓
CEK TAGIHAN
   ↓
TAGIHAN
   ↓
LUNAS / BELUM BAYAR
   ↓
JIKA MENUNGGAK
   ↓
INFORMASI TUNGGAKAN
```

**Tanpa login.**

---

# 87. ALUR TENANT BARU

```text
SUPER ADMIN
     ↓
BUAT TENANT
     ↓
PROFIL ORGANISASI
     ↓
PILIH PAKET
     ↓
BUAT ADMIN TENANT
     ↓
AKTIFKAN
     ↓
ADMIN LOGIN
     ↓
SETTING TARIF
     ↓
IMPORT PELANGGAN
     ↓
GENERATE TAGIHAN
     ↓
SIAP OPERASIONAL
```

---

# 88. ACCEPTANCE CRITERIA — PLATFORM

* [ ] Super Admin dapat membuat tenant.
* [ ] Tenant memiliki kode unik.
* [ ] Tenant dapat diaktifkan/nonaktifkan.
* [ ] Admin Tenant dapat dibuat.
* [ ] Data tenant terisolasi.
* [ ] Paket dapat ditentukan.
* [ ] Feature control berjalan.

---

# 89. ACCEPTANCE CRITERIA — USER

* [ ] Admin dapat membuat Bendahara.
* [ ] Admin dapat membuat Petugas.
* [ ] Admin dapat membuat Pengawas.
* [ ] Username unik.
* [ ] Password aman.
* [ ] User nonaktif tidak dapat login.
* [ ] Role tidak dapat diakses di luar kewenangan.

---

# 90. ACCEPTANCE CRITERIA — PELANGGAN

* [ ] Data pelanggan dapat ditambahkan.
* [ ] Kode otomatis.
* [ ] UM/SO/IN berbeda.
* [ ] Kode unik.
* [ ] Import Excel.
* [ ] Status aktif/nonaktif/dicabut.

---

# 91. ACCEPTANCE CRITERIA — METER

* [ ] Meter awal otomatis.
* [ ] Meter akhir dapat diinput.
* [ ] Pemakaian otomatis.
* [ ] Foto meter tersimpan.
* [ ] Meter mundur ditolak.
* [ ] Koreksi tercatat.

---

# 92. ACCEPTANCE CRITERIA — TAGIHAN

* [ ] Tagihan dapat dibuat batch.
* [ ] Tarif otomatis.
* [ ] Subsidi sosial otomatis.
* [ ] Status tagihan otomatis.
* [ ] Piutang otomatis.
* [ ] Tagihan dapat dicek tanpa login.

---

# 93. ACCEPTANCE CRITERIA — PEMBAYARAN

* [ ] Petugas dapat menerima pembayaran.
* [ ] Pembayaran tercatat.
* [ ] Kwitansi otomatis.
* [ ] Nomor kwitansi unik.
* [ ] Struk thermal dapat dicetak.
* [ ] Pembayaran mengurangi piutang.

---

# 94. ACCEPTANCE CRITERIA — PENAGIHAN

* [ ] Sistem menghitung tunggakan.
* [ ] 1 bulan masuk monitoring.
* [ ] 2 bulan menghasilkan status Surat Teguran.
* [ ] Surat dapat dibuat PDF.
* [ ] Surat dapat dicetak.
* [ ] 3 bulan menghasilkan status Surat Pencabutan.
* [ ] Surat pencabutan dapat dicetak.
* [ ] Pencabutan harus dikonfirmasi.
* [ ] Status berubah menjadi DICABUT setelah konfirmasi.
* [ ] Histori tersimpan.

---

# 95. ACCEPTANCE CRITERIA — KEUANGAN

* [ ] Pemasukan tercatat.
* [ ] Pengeluaran tercatat.
* [ ] Setoran tercatat.
* [ ] Selisih dapat diketahui.
* [ ] Saldo otomatis.
* [ ] Laporan tersedia.
* [ ] Transaksi tidak dapat dihapus permanen.

---

# 96. ACCEPTANCE CRITERIA — PENGAWAS

* [ ] Dapat login.
* [ ] Dapat melihat dashboard.
* [ ] Dapat melihat laporan.
* [ ] Dapat melihat keuangan.
* [ ] Dapat melihat penagihan.
* [ ] Tidak dapat mengubah data.

---

# 97. ACCEPTANCE CRITERIA — PORTAL PUBLIK

* [ ] Tidak membutuhkan login.
* [ ] Kode pelanggan dapat digunakan untuk pencarian.
* [ ] Tagihan ditampilkan dengan benar.
* [ ] Status pembayaran ditampilkan.
* [ ] Tunggakan ditampilkan.
* [ ] Data pelanggan lain tidak dapat diakses.
* [ ] Rate limiting aktif.

---

# 98. ACCEPTANCE CRITERIA — THERMAL

* [ ] Mendukung 58 mm.
* [ ] Mendukung 80 mm.
* [ ] Nama tenant otomatis.
* [ ] Logo tenant dapat digunakan.
* [ ] Nomor kwitansi otomatis.
* [ ] Struk dapat dicetak dari perangkat petugas.

---

# 99. ROADMAP DEVELOPMENT

## PHASE 1 — CORE PLATFORM

* Super Admin
* Tenant
* Admin Tenant
* Login
* Role permission
* Tenant isolation

## PHASE 2 — OPERASIONAL

* Pelanggan
* Meter
* Tarif
* Tagihan
* Pembayaran
* Kolektor
* Setoran

## PHASE 3 — KEUANGAN

* Pemasukan
* Pengeluaran
* Kas
* Saldo
* Piutang
* Laporan

## PHASE 4 — PENAGIHAN

* Monitoring tunggakan
* Surat teguran
* Surat pencabutan
* Pencabutan
* Aktivasi kembali

## PHASE 5 — PELANGGAN

* Website publik
* Cek tagihan tanpa login
* QR pelanggan

## PHASE 6 — DOKUMEN

* PDF
* Thermal
* Surat
* Excel

## PHASE 7 — KOMERSIAL

* Subscription
* Paket
* Feature control
* White label

## PHASE 8 — FUTURE

* QRIS
* Payment Gateway
* WhatsApp
* API
* Native Android/iOS

---

# 100. STRUKTUR PRODUK FINAL

```text
                         HIPPAMS
                           │
                     FAISAL GROUP
                           │
                     SUPER ADMIN
                           │
       ┌───────────────────┼───────────────────┐
       │                   │                   │
    HIPPAM A            HIPPAM B           PAMSIMAS C
       │                   │                   │
    ADMIN A             ADMIN B             ADMIN C
       │                   │                   │
 ┌─────┼─────┐       ┌─────┼─────┐       ┌─────┼─────┐
 │     │     │       │     │     │       │     │     │
BEND  PET   PENG    BEND  PET   PENG    BEND  PET   PENG
 │     │     │       │     │     │       │     │     │
 └─────┴─────┘       └─────┴─────┘       └─────┴─────┘
       │                   │                   │
   DATABASE A          DATABASE B          DATABASE C
       │                   │                   │
       └───────────────────┼───────────────────┘
                           │
                    WEBSITE PUBLIK
                           │
                    CEK TAGIHAN
                     TANPA LOGIN
```

---

# 101. MODEL BISNIS

HIPPAMS dijual sebagai **SaaS**.

Target pasar:

* HIPPAM
* PAMSIMAS
* BUMDes
* Desa
* Unit pengelola air

Sumber pendapatan:

* Setup
* Langganan bulanan
* Langganan tahunan
* Paket berdasarkan jumlah pelanggan
* White label
* Custom domain
* Integrasi
* Support
* Maintenance

---

# 102. BRANDING

# **HIPPAMS**

### HIPPAM & PAMSIMAS Management System

### Tagline

> **Kelola Air, Kelola Kepercayaan.**

### Developer

# **FAISAL GROUP**

---

# 103. KONSEP RILIS PRODUK

HIPPAMS versi rilis harus mempunyai enam lapisan utama:

### 1. PLATFORM

**Super Admin & Multi-Tenant**

### 2. OPERASIONAL

**Pelanggan, Meter, Tarif, Tagihan**

### 3. PEMBAYARAN

**Kolektor, Pembayaran, Kwitansi, Thermal**

### 4. KEUANGAN

**Pemasukan, Pengeluaran, Kas, Saldo**

### 5. PENAGIHAN

**Piutang → Teguran → Pencabutan**

### 6. PELANGGAN

**Website → Cek Tagihan Tanpa Login**

---

# 104. RINGKASAN FINAL UNTUK DEVELOPER

## HIPPAMS harus mampu:

**SUPER ADMIN**
→ Mengelola banyak HIPPAM/PAMSIMAS.

**ADMIN TENANT**
→ Mengelola organisasinya.

**BENDAHARA**
→ Mengelola keuangan dan setoran.

**PETUGAS**
→ Cek meter + pembayaran + kolektor.

**PENGAWAS**
→ Monitoring read-only.

**PELANGGAN**
→ Cek tagihan melalui website **tanpa login**.

**SISTEM**
→ Menghitung meter dan tarif otomatis.

**SOSIAL**
→ Maksimal 15 m³ gratis, kelebihan Rp2.000/m³.

**UMUM**
→ Default Rp2.000/m³.

**INDUSTRI**
→ Default Rp1.500/m³.

**TUNGGAKAN**
→ 1 bulan monitoring.

**2 BULAN**
→ Surat Teguran.

**3 BULAN**
→ Surat Pencabutan.

**PENCABUTAN**
→ Harus dikonfirmasi petugas/Admin sebelum status berubah menjadi Dicabut.

**PEMBAYARAN**
→ Tunai melalui petugas/kolektor.

**BUKTI**
→ Struk thermal 58/80 mm.

**KEUANGAN**
→ Pemasukan + Pengeluaran + Saldo + Piutang.

**TRANSPARANSI**
→ Laporan publik yang dapat dikonfigurasi.

**MULTI-TENANT**
→ Data setiap HIPPAM/PAMSIMAS wajib terisolasi.

---

# 105. STATUS DOKUMEN

## **HIPPAMS V2.1**

### **FINAL — DEVELOPMENT READY**

**Produk:** HIPPAMS
**Platform:** Multi-Tenant SaaS
**Provider:** Faisal Group
**Target:** HIPPAM & PAMSIMAS

> **Satu platform untuk banyak HIPPAM/PAMSIMAS, dengan pengelolaan pelanggan, meter, tagihan, pembayaran, keuangan, penagihan, transparansi, dan cek tagihan publik dalam satu sistem.**