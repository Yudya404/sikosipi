# 🏦 Sistem Informasi Koperasi Simpan Pinjam

Sistem Informasi ini dibangun menggunakan **CodeIgniter 3** (CI3) dan ditujukan untuk membantu pengelolaan simpan pinjam anggota koperasi 
secara efisien dan terstruktur. Sistem ini mendukung fitur-fitur inti seperti 
manajemen simpanan, pinjaman, anggota, pegawai, dan tampilan dashboard yang informatif.

## 📌 Spesifikasi Proyek

| 💻 Komponen         | 🛠️ Teknologi                                                                 |
|---------------------|------------------------------------------------------------------------------|
| ⚙️ Framework        | ![CI3](https://img.shields.io/badge/CodeIgniter-3-red?logo=codeigniter) CodeIgniter 3 |
| 🧠 Bahasa Pemrograman | ![PHP](https://img.shields.io/badge/PHP-8.1-blue?logo=php) PHP v8.1                      |
| 🛢️ Database         | ![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?logo=mysql&logoColor=white) MariaDB |
| 🌐 Web Server       | ![Apache](https://img.shields.io/badge/Apache-2.4-darkred?logo=apache) Apache (via XAMPP) |
| 🧮 Basis Data       | ![RDBMS](https://img.shields.io/badge/RDBMS-Relational-blue) RDBMS                        |

---

## 📊 Menu Utama

### 1. 📍 Dashboard
Menampilkan ringkasan data simpanan, pinjaman, anggota aktif, dan notifikasi.

![Dashboard Screenshot](screenshots/dashboard.png)

---

### 2. 💰 Simpanan
- Entri dan manajemen data simpanan anggota (pokok dan wajib)
- Riwayat dan laporan simpanan per anggota
- Permintaan hapus setoran anggota yang terlanjur terentri.
- Penarikan simpanan anggota.

![Simpanan Screenshot](screenshots/simpanan.png)

---

### 3. 💳 Pinjaman
- Daftra Pinjaman
- Pengajuan dan verifikasi pinjaman
- Status dan histori pembayaran pinjaman
- Laporan

![Pinjaman Screenshot](screenshots/pinjaman.png)

---

### 4. 👥 Anggota
- Manajemen data anggota koperasi
- Aktivasi/deaktivasi status anggota
- Pencarian dan filter anggota

![Anggota Screenshot](screenshots/anggota.png)

---

### 5. 👤 Pegawai
- Manajemen akun pegawai (admin/operator)
- Hak akses dan aktivitas pegawai

![Pegawai Screenshot](screenshots/pegawai.png)

---

## 🚀 Cara Menjalankan Aplikasi

1. Clone repositori ini atau salin ke direktori `htdocs` di XAMPP:
   git clone https://github.com/username/sikosipi.git
   
2. Buat database baru di phpMyAdmin dan impor file SQL (jika tersedia) di folder database/.

3. Atur konfigurasi database di application/config/database.php:
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'sikosipi',
	
4. Jalankan melalui browser:
	http://localhost/sikosipi/
	

🧑‍💻 Kontribusi
Pull request dan saran pengembangan sangat disambut! Jangan ragu untuk fork dan modifikasi proyek ini.

📃 Lisensi
Proyek ini bersifat open-source dan dapat digunakan untuk pembelajaran atau pengembangan lebih lanjut. 
Silakan cantumkan kredit kepada pengembang asli bila digunakan secara publik.

🙋‍♂️ Kontak Pengembang
📧 Email: [yudyasukma2@gmail.com]



