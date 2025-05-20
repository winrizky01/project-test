# Test Project WRA
# Dokumentasi Aplikasi

## Informasi Login User

| Username                | Password   | Role         |
|-------------------------|------------|--------------|
| development@gmail.com   | 12345678   | Super Admin  |
| admin@gmail.com         | 12345678   | Admin        |
| approval_1@gmail.com    | 12345678   | Approval     |
| approval_2@gmail.com    | 12345678   | Approval     |

> **Catatan:** Silahkan jalankan perintah http://127.0.0.1:8000/register, untuk create user (tergantung port yang anda jalankan).

---

## Informasi Sistem

- **Versi Database:** MySQL 8.0 (atau sesuaikan)
- **Versi PHP:** 8.3.6
- **Framework:** Laravel 12
- **Frontend:** Blade Templates (adminlte3)

---

## Panduan Penggunaan Aplikasi

1. **Login**  
   Masuk menggunakan username dan password yang telah disediakan.

2. **Create Master Kendaraan**
   - Pilih menu `Kendaraan`.
   - Isi formulir kendaraan.
   - Submit formulir untuk menyimpan data.

3. **Create Master Driver**
   - Pilih menu `Driver`.
   - Isi formulir driver.
   - Submit formulir untuk menyimpan data.

4. **Booking Kendaraan**  
   - Pilih menu `Pesanan`.
   - Isi formulir pesanan kendaraan sesuai kebutuhan.
   - Submit formulir untuk menyimpan data pesanan.

5. **Approval Booking**  
   - Role `approver` dan `superadmin` dapat mengakses halaman persetujuan.
   - Cek daftar persetujuan yang berstatus `pending`.
   - Lakukan approve atau reject sesuai kebutuhan.

6. **Monitoring**  
   - Cek laporan penggunaan kendaraan pada dashboard.
   - Saat ini menggunakan filter bulan berjalan yang terhardcode (tidak bisa diubah langsung dari UI).
   - Fitur monitoring berdasarkan kendaran dalam setiap hari.

7. **Export Data**  
   - Pada halaman data laporan, gunakan tombol `Export Excel` untuk mengunduh data dalam format Excel.

---

## Informasi Tambahan

- Pastikan environment (`.env`) sudah diatur sesuai server produksi, bila belum ada `env-example` sebagai contoh.
- Jalankan perintah `composer install` untuk instalasi awal.
- Jalankan `php artisan key:generate` untuk menghasilkan application key.
- Jalankan `php artisan migrate` untuk menjalankan migrasi database.
- Untuk menjalankan aplikasi lokal, gunakan `php artisan serve`.

---

Terima kasih telah menggunakan aplikasi ini.

