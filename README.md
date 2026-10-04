# UIN RF Badminton Reservation

Aplikasi Laravel untuk reservasi lapangan badminton UIN Raden Fatah.

## Fitur
- Login dan registrasi pengguna
- Dashboard pengguna dan admin
- Daftar dan detail lapangan badminton
- Admin dapat menambah, mengubah, dan menghapus lapangan
- Reservasi berdasarkan tanggal, jam mulai, dan jam selesai
- Perhitungan harga otomatis berdasarkan durasi
- Pemeriksaan bentrok jadwal
- Admin dapat menyetujui atau menolak reservasi
- Riwayat reservasi pengguna

## Menjalankan aplikasi

Pastikan PHP 8.2+, Composer, Node.js/npm, dan MySQL sudah tersedia.

1. Buat database MySQL, misalnya `hotel_db`, atau ubah `DB_DATABASE` di `.env`.
2. Pastikan konfigurasi `.env` sudah benar.
3. Jalankan:

```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan optimize:clear
php artisan serve
```

4. Buka `http://127.0.0.1:8000`.

> `migrate:fresh` menghapus tabel/data database lama. Gunakan ini karena struktur database aplikasi sudah diubah dari sistem hotel menjadi sistem lapangan badminton.

## Akun admin bawaan

- Email: `admin@gmail.com`
- Password: `admin123`

Seeder membuat 3 contoh lapangan badminton.

## Catatan

Kode dan tampilan hotel lama sudah diganti dengan konsep lapangan badminton. Tabel database yang digunakan sekarang adalah `lapangans` dan `reservasis`.
