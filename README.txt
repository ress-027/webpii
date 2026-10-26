WEB_ALVI — PHP Native + MySQL + CSS

CARA MENJALANKAN:
1. Ekstrak folder web_alvi ke C:\xampp\htdocs\web_alvi
2. Buka XAMPP, jalankan Apache dan MySQL.
3. Buka http://localhost/phpmyadmin
4. Pilih tab Import, pilih file database.sql dari folder web_alvi, lalu klik Import.
   Alternatif: buka tab SQL dan jalankan isi database.sql.
5. Buka http://localhost/web_alvi/register.php untuk membuat akun.
6. Login melalui http://localhost/web_alvi/login.php
7. Setelah login, dashboard terbuka. Gunakan tombol Logout untuk keluar.

KONFIGURASI:
Default XAMPP: host localhost, user root, password kosong.
Jika MySQL Anda memakai password, ubah variabel $password pada config/koneksi.php.

KEAMANAN:
Password disimpan menggunakan password_hash() dan diverifikasi dengan password_verify().
Query database memakai prepared statements. Dashboard dilindungi session.
