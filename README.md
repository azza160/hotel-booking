# Dokumentasi Proyek Sistem Pemesanan Hotel & Paket Liburan 🏨✈️

## 1. Pendahuluan
Sistem ini adalah platform berbasis web untuk pemesanan hotel dan paket liburan, dikembangkan menggunakan PHP, HTML, CSS, Bootstrap, dan JavaScript. Pengguna dapat melihat daftar hotel, paket liburan, dan galeri foto sebelum melakukan pemesanan. Tersedia juga dashboard admin untuk mengelola seluruh data di dalam sistem.

## 2. Alur Pengguna
### 🧑‍💻 Pengguna Umum (User)
- 🔎 **Mengakses Landing Page**
  - Melihat hotel, paket liburan, serta galeri foto.
- 🏨 **Melihat Detail Hotel**
  - Informasi yang tersedia: tipe kamar, fasilitas, galeri hotel.
  - Login diperlukan untuk melakukan pemesanan.
- 🌍 **Melihat & Memesan Paket Liburan**
  - Detail paket tersedia, tetapi harus login sebelum memesan.
- 🔑 **Login & Registrasi**
  - Registrasi dengan email, username, dan password.
  - Verifikasi email sebelum bisa login.
- 🛏️ **Pemesanan Kamar Hotel**
  - Mengisi formulir pemesanan: Nama, Tipe Kamar, Check-in, Check-out.
  - Konfirmasi pembayaran via email.
- ✈️ **Pemesanan Paket Liburan**
  - Proses serupa dengan pemesanan kamar hotel.

### 🛠️ Admin
- 🔐 **Login Admin**
  - Email: azza@gmail.com | Username: admin | Password: 123
- 📊 **Akses Dashboard**
  - Mengelola data: hotel, paket liburan, pengguna, transaksi.

## 3. Teknologi yang Digunakan
- **Backend**: PHP 🐃
- **Frontend**: HTML, CSS, Bootstrap 🎨, JavaScript ⚡
- **Library**:
  - Bootstrap (UI responsif)
  - PHPMailer (Email verifikasi & pembayaran)
- **Tools**:
  - VS Code 🖥️, XAMPP 🖥️, Web Browser 🌍

## 4. Tahapan Pengembangan
1. 🎨 **Perancangan UI/UX**
2. 🛠️ **Pengembangan Backend** (Database, API, sistem login & booking)
3. 🎨 **Pengembangan Frontend** (HTML, CSS, Bootstrap, JavaScript)
4. 💻 **Integrasi & Pengujian**
5. 🌐 **Deployment**

## 5. Struktur Database (Tabel Utama)
- **users** (Data pengguna) 👤
- **hotels** (Data hotel) 🏨
- **rooms** (Data kamar hotel) 🛏️
- **bookings** (Data pemesanan kamar) 📝
- **travel_packages** (Data paket liburan) ✈️
- **package_bookings** (Data pemesanan paket) ✅

## 6. Cara Instalasi di XAMPP
Berikut langkah-langkah instalasi agar sistem ini dapat dijalankan di lingkungan lokal dengan XAMPP:

### 6.1. Persyaratan Sistem
- XAMPP (versi terbaru direkomendasikan)
- PHP 7.x atau lebih tinggi
- Web browser (Chrome, Firefox, Edge, dll.)

### 6.2. Langkah Instalasi
1. **Unduh & Instal XAMPP**
   - Download dari https://www.apachefriends.org/download.html
   - Instal dan jalankan Apache & MySQL melalui XAMPP Control Panel.

2. **Salin Proyek ke Direktori XAMPP**
   - Pindahkan folder proyek ke dalam direktori `htdocs` di dalam folder instalasi XAMPP.
     ```
     C:\xampp\htdocs\hotel-booking
     ```

3. **Konfigurasi Database**
   - Buka `phpMyAdmin` melalui browser: http://localhost/phpmyadmin/
   - Buat database baru, misalnya `hotel_booking`.
   - Import file database yang disertakan (`hotel_booking.sql`).

4. **Konfigurasi File Koneksi Database**
   - Buka file `config.php` (atau `database.php`, sesuai dengan proyek Anda).
   - Sesuaikan pengaturan koneksi database:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "hotel_booking";
     ```

5. **Menjalankan Aplikasi**
   - Pastikan Apache & MySQL sedang berjalan di XAMPP Control Panel.
   - Buka browser dan akses: `http://localhost/hotel-booking/`

## 7. Fitur Tambahan yang Bisa Dikembangkan
- ✅ **Live Chat Support** 💬
- ✅ **Rating & Review** ⭐
- ✅ **Notifikasi Email & SMS** 📩📱
- ✅ **Beragam Metode Pembayaran** 💳

## 8. Penutup
Proyek ini dikembangkan oleh 1 developer menggunakan PHP & Bootstrap. Dokumentasi ini dibuat agar mudah dipahami dan dapat membantu dalam pengembangan lebih lanjut.

🚀 Selamat menggunakan sistem pemesanan hotel & paket liburan ini! 🏨✈️🎉

