MVC DASAR - SISTEM ABSENSI PEGAWAI

Teknologi: PHP Native + MySQL/MariaDB, tanpa framework.

CARA MENJALANKAN
1. Ekstrak folder mvc-absensi-pegawai ke htdocs atau folder kerja.
2. Buka phpMyAdmin, import file database.sql.
3. Pastikan config/database.php sesuai username dan password MySQL Anda.
4. Buat hash password admin dengan terminal:
   php -r "echo password_hash('password', PASSWORD_DEFAULT);"
5. Salin hasil hash, lalu jalankan SQL:
   INSERT INTO users (username, password) VALUES ('admin', 'TEMPEL_HASH_DI_SINI');
6. Buka terminal di folder mvc-absensi-pegawai, jalankan:
   php -S localhost:8000 -t public
7. Buka http://localhost:8000/login
   Username: admin
   Password: password

URUTAN MVC (mengikuti modul praktikum)
1. Denah folder
2. public/index.php sebagai entry point dan routing
3. Controller
4. View
5. Hubungkan Controller -> View menggunakan ob_start() dan ob_get_clean()
6. Layout, header, navbar, footer
7. Database
8. Config database menggunakan PDO
9. Model
10. Controller memakai Model
11. Tampilkan data dari database
12. Routing beberapa halaman
13. Login, session, middleware, logout

MENU
- Dashboard
- Data Pegawai: daftar dan tambah pegawai
- Data Absensi: daftar dan catat absensi

CATATAN
- Sistem ini adalah latihan dasar. Fitur edit, hapus, laporan, validasi lanjutan,
  dan pembatasan hak akses per jabatan belum dibuat.
- Satu pegawai hanya dapat memiliki satu catatan absensi per tanggal.
- Untuk pengembangan nyata, tambahkan CSRF protection, validasi server-side,
  audit log, dan aturan jam kerja.

FITUR TAMBAHAN (VERSI INI)
- Jam keluar pegawai pada form dan daftar absensi.
- Rekap pegawai: total Hadir, Izin, Sakit, dan Alpa per pegawai.
- Laporan kehadiran: filter tanggal, pegawai, status, serta cetak/simpan PDF melalui browser.

PENTING JIKA DATABASE SUDAH PERNAH DI-IMPORT
Jalankan SQL berikut SATU KALI di phpMyAdmin > database mvc_absensi > tab SQL:
ALTER TABLE attendances ADD COLUMN check_out TIME NULL AFTER check_in;
Jangan jalankan perintah ALTER tersebut jika kolom check_out sudah ada.
Setelah itu ganti folder proyek dengan versi terbaru ini.


FITUR TAMBAHAN VERSI LENGKAP
1. Jam keluar: pada menu Data Absensi, klik tombol "Jam Keluar" pada baris pegawai yang hadir dan belum memiliki jam keluar. Waktu komputer/server akan disimpan otomatis.
2. Rekap Pegawai: buka menu Rekap Pegawai untuk melihat total Hadir, Izin, Sakit, dan Alpa per pegawai.
3. Laporan Kehadiran: buka menu Laporan Kehadiran, atur filter, lalu gunakan Cetak / Simpan PDF.

PENTING UNTUK DATABASE LAMA
Jika tabel attendances yang sudah ada belum memiliki kolom check_out, buka phpMyAdmin > database mvc_absensi > SQL lalu jalankan SATU KALI:

ALTER TABLE attendances ADD COLUMN check_out TIME NULL AFTER check_in;

Jika muncul pesan bahwa kolom check_out sudah ada, tidak perlu menjalankan perintah tersebut lagi. Jangan import ulang database.sql ke database yang sudah berisi data karena dapat mengganggu data yang ada.


FITUR CRUD USER DAN PRODUK (TAMBAHAN)
- Menu Data User: tambah, lihat, edit username/password, dan hapus user.
- Menu Data Produk: tambah, lihat, edit, dan hapus produk (nama, deskripsi, harga, stok).
- Password user disimpan menggunakan password_hash().
- Pencarian tabel menggunakan JavaScript.

PENTING UNTUK DATABASE YANG SUDAH ADA:
1. Buka phpMyAdmin, pilih database mvc_absensi.
2. Klik tab SQL.
3. Jalankan isi file database_tambahan_crud.sql (cukup sekali).
4. Jangan menghapus atau membuat ulang tabel users, employees, dan attendances karena data lama tetap dipakai.
5. Jalankan aplikasi seperti biasa: php -S localhost:8000 -t public
6. Login melalui /login, lalu gunakan menu Data User dan Data Produk.

ROUTE BARU:
/users, /users/create, /users/edit?id=ID
/products, /products/create, /products/edit?id=ID
