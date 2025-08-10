# Sistem Akademik

Sistem Akademik adalah aplikasi web berbasis **PHP (native)** yang digunakan untuk manajemen data akademik. Proyek ini mencakup fitur dasar seperti CRUD untuk data mahasiswa, dosen, mata kuliah, dan laporan, serta sistem registrasi dan login.

##  Fitur

- Autentikasi pengguna (Login/Register)
- CRUD data:
  - Mahasiswa
  - Dosen
  - Mata kuliah
  - Laporan/Transkrip (folder `laporan`)
- Database MySQL (`uts.sql`)
- Struktur modular dengan folder seperti: `mahasiswa`, `dosen`, `matkul`, `dashboard`, dll.

##  Installation

1. Clone repository ini:
   ```bash
   git clone https://github.com/cherrylnh17/Sistem-Akademik.git
   cd Sistem-Akademik
Siapkan database MySQL dan jalankan file uts.sql untuk membuat tabel dan data contoh.

Sesuaikan konfigurasi koneksi database di file koneksi/koneksi.php.

Jalankan aplikasi dengan meletakkannya di web server lokal (misalnya XAMPP, MAMP, Laragon), kemudian akses http://localhost/Sistem-Akademik/.

Struktur Projek (highlight) Sistem-Akademik/<br>
├── koneksi/           # File koneksi database<br>
├── mahasiswa/         # CRUD data mahasiswa<br>
├── dosen/             # CRUD data dosen<br>
├── matkul/            # CRUD data mata kuliah<br>
├── laporan/           # Folder laporan/transkrip<br>
├── dashboard/         # Halaman dashboard umum<br>
├── index.php          # Halaman utama<br>
├── prosesRegist.php   # Proses registrasi pengguna<br>
├── verifLogin.php     # Proses autentikasi pengguna<br>
├── destroy.php        # Logout / penghapusan sesi<br>
├── uts.sql            # Skrip SQL untuk setup database<br>
├── .gitignore<br>
├── css/, js/, img/    # Aset frontend<br>
Cara Penggunaan
Buka aplikasi di browser.

Register (jika sistem mendukung), atau login dengan akun yang tersedia.

Akses panel dashboard — dari sini:

Tambah/edit/hapus data mahasiswa, dosen, dan mata kuliah.

Buat dan cetak laporan akademik melalui modul laporan.

Kontributor
Developer: cherrylnh17 (GitHub repository owner)
