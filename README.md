# Tugas 1 IF3110 Pengembangan Aplikasi Berbasis Web

## Deskripsi aplikasi web

Aplikasi Penjualan Coklat ini merupakan aplikasi berbasis web yang ditulis dalam rangka memenuhi pengerjaan 
tugas besar 1 Mata Kuliah IF3110 Pemgembangan Aplikasi Berbasis Web. Aplikasi ini merupakan sebuah platform 
untuk melakukan jual beli coklat, dan dibuat dengan menggunakan tools-tools sebagai berikut:

- HTML
- CSS
- Javascript
- PHP
- MySQL

Fitur-fitur dan halaman yang terdapat pada aplikasi ini adalah sebagai berikut:

### Login dan Registrasi Akun

Pengguna melakukan login dan/atau registrasi terlebih dahulu sebelum memasuki laman utama.
Pengguna biasa yang melakukan registrasi disebut sebagai user, dan admin (yang datanya dimasukkan
secara langsung pada database) disebut sebagai superuser.

### Dashboard Page

Halaman dashboard menampilkan gambar sepuluh coklat dengan penjualan paling tertinggi.
Selain itu, terdapat tampilan untuk menuju Transaction History Page (bagi user) dan Add New Chocolate Page (bagi superuser).

### Search

Fitur search memberikan layanan untuk melakukan pencarian, saat ini tingkat pencarian hanya sampai sejauh case-insensitive.

### Chocolate Detail Page

Menampilkan detail dari coklat yang dijual dengan rincian data-data berikut:

Nama coklat, harga, jumlah yang tersedia, jumlah yang terjual, deskripsi.

Selain itu, pada halaman ini superuser dapat menambah jumlah coklat, dan user dapat membeli coklat.


### Transaction History Page

Laman ini hanya tersedia untuk user (dilakukan validasi terlebih dahulu).
Pada laman ini terdapat tabel yang menampilkan daftar pembelian yang telah dilakukan oleh user tersebut, 
terurut dari yang paling recent.

### Add New Chocolate Page

Laman ini hanya tersedia untuk superuser (dilakukan validasi terlebih dahulu).
Pada laman ini terdapat menu untuk menambahkan coklat baru, dengan mengisi data-data coklat (nama, harga, gambar, dll.)

Sebagai tambahan, aplikasi ini juga mengimplementasikan token pada cookie yang bisa expired (waktunya terbatas).


## Daftar requirement

- PHP 7.4
- Apache 2
- Javascript (Browser supporting JS ES6)
- HTML + CSS (Browser supporting HTML, CSS) 
- MySQL 8

Sebagai alternatif, PHP + Apache + MySQL bisa diperoleh secara langsung menggunakan XAMPP.

## Cara instalasi

## Cara menjalankan Server

## Screenshot aplikasi

### Login Page

![](assets/screenshot/login.jpg)

### Logout Page

![](assets/screenshot/logout.jpg)

### Register Page

![](assets/screenshot/register.jpg)

### Dashboard Page

![](assets/screenshot/dashboard.jpg)

### Search Result Page

![](assets/screenshot/search-1.jpg)

![](assets/screenshot/search-2.jpg)

### Chocolate Detail Page

![](assets/screenshot/choco-detail-user.jpg)

![](assets/screenshot/choco-detail-user2.jpg)

![](assets/screenshot/choco-detail-superuser.jpg)

![](assets/screenshot/choco-detail-superuser2.jpg)

### Transaction History Page

![](assets/screenshot/history.jpg)

### Add New Chocolate Page

![](assets/screenshot/add-choco.jpg)

## Pembagian Tugas

Berikut pembagian tugas tiap anggota kelompok

### Frontend
1. Login                : 13518041
2. Register             : 13518041
3. Dashboard            : 13518041
4. Search Result        : 13518017
5. Choco Detail         : 13518048
6. Transaction History  : 13518048
7. Add New Chocolate    : 13518048

### Backend
1. Login                : 13518041
2. Register             : 13518041
3. Dashboard            : 13518041
4. Search Result        : 13518017, 13518048 (Pagination)
5. Choco Detail         : 13518048
6. Transaction History  : 13518017
7. Add New Chocolate    : 13518017


## About

Kelompok 9 Tugas Besar 1 IF3110 Pengembangan Aplikasi Berbasis Web

Farras | Samuel | Hengky