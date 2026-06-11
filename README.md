# BeysWear Fashion Management System

BeysWear Fashion Management System adalah aplikasi web berbasis Laravel yang digunakan untuk membantu pengelolaan toko fashion, mulai dari manajemen produk, transaksi penjualan, stok varian produk, hingga laporan penjualan.

---

# Fitur Utama

- Login dan autentikasi user
- Role admin dan kasir
- CRUD produk
- Upload foto produk
- Auto generate kode barang
- Manajemen varian produk (ukuran & warna)
- Sistem transaksi multi-item
- Cetak struk transaksi
- Dashboard statistik
- Laporan penjualan mingguan dan bulanan
- Katalog customer
- Live search menggunakan AJAX
- Dark mode dan preferensi tampilan
- Soft delete produk

---

# Teknologi yang Digunakan

- Laravel 13
- PHP 8
- MySQL
- HTML5
- CSS3
- JavaScript
- AJAX / Fetch API

---

# Cara Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/username/beyswear.git
````

Masuk ke folder project:

```bash
cd beyswear
```

---

# 2. Install Dependency

```bash
composer install
```

---

# 3. Copy File Environment

```bash
cp .env.example .env
```

---

# 4. Generate Application Key

```bash
php artisan key:generate
```

---

# 5. Atur Database

Buka file `.env`, lalu ubah bagian database sesuai konfigurasi MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tm-pweb
DB_USERNAME=root
DB_PASSWORD=
```

---

# 6. Jalankan Migration

```bash
php artisan migrate
```

---

# 7. Jalankan Seeder

```bash
php artisan db:seed
```

Seeder digunakan untuk menambahkan data awal produk dan varian produk.

---

# 8. Link Storage

Agar foto produk dapat tampil:

```bash
php artisan storage:link
```

---

# 9. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```txt
http://127.0.0.1:8000
```

---

# Akun Login

## Admin

```txt
Email    : admin123@gmail.com
Password : admin123
```

## Kasir

```txt
Email    : berlianaprilly24@gmail.com
Password : berli123
```

---

# Struktur Fitur

## Admin

* Mengelola produk
* Mengelola user
* Melihat laporan
* Mengelola transaksi

## Kasir

* Mengelola transaksi
* Melihat produk

## Customer

* Melihat katalog produk
* Booking melalui WhatsApp

---

# Struktur Database

Tabel utama:

* users
* produks
* produk_varians
* transaksis
* detail_transaksi

---

# Catatan

* Format foto yang didukung:

  * JPG
  * JPEG
  * PNG
  * WEBP

* Database menggunakan MySQL.

* Sistem menggunakan session authentication Laravel.

---

# Developer

BeysWear Fashion Management System
Dikembangkan untuk memenuhi tugas Pemrograman Web.
