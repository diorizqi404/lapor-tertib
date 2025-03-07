# Lapor Tertib

LaporTertib merupakan sistem informasi pencatatan pelanggaran siswa berbasis website yang dapat digunakan gratis oleh beberapa sekolah (multi tenant).

## Teknologi yang Digunakan

- Laravel 11
- Livewire 3
- MySQL
- Tailwind CSS (Preline UI)
- ApexCharts
- WAHA (Whatsapp HTTP API)
- SMTP Gmail

## Tools yang Digunakan saat Pengembangan

- Visual Studio Code
- Laragon
- HeidiSQL
- VPS/Docker (untuk Whatsapp API)

## Requirements

Sebelum menjalankan proyek ini, pastikan sistem Anda telah menginstal:

- PHP >= 8.2
- Composer
- MySQL atau MariaDB
- Node.js & npm
- URL Whatsapp API

## Cara Menjalankan di Lokal

1. Clone repositori ini:

   ```sh
   git clone https://github.com/diorizqi404/lapor-tertib.git
   cd lapor-tertib
   ```

2. Instal dependensi:

   ```sh
   composer install
   npm install && npm run dev
   ```

3. Buat file `.env`:

   ```sh
   cp .env.example .env
   ```

4. Atur konfigurasi database di file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Atur konfigurasi smtp di file `.env`:

   ```env
   MAIL_MAILER=log
   MAIL_SCHEME=null
   MAIL_HOST=127.0.0.1
   MAIL_PORT=2525
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_FROM_ADDRESS="<hello@example.com>"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

6. Atur konfigurasi whatsapp api url di file `.env`:

   ```
   WA_API_URL=
   ```

7. Jalankan migrasi dan seed database:

   ```sh
   php artisan migrate --seed
   ```

8. Jalankan aplikasi:

   ```sh
   php artisan serve
   ```

## Import Database

Jika ingin menggunakan data awal yang telah disiapkan, import file SQL berikut ke database Anda:

```sh
mysql -u root -p nama_database < lapor_tertib.sql
```

## Repository GitHub

- Profil GitHub: [https://github.com/diorizqi404](https://github.com/diorizqi404)
- Repository: [https://github.com/diorizqi404/lapor-tertib](https://github.com/diorizqi404/lapor-tertib)
