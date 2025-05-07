-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 06:13 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikosipi`
--

-- --------------------------------------------------------

--
-- Table structure for table `aksi`
--

CREATE TABLE `aksi` (
  `id_aksi` int(11) NOT NULL,
  `id_data_kategori` int(11) NOT NULL,
  `kategori_aksi` varchar(100) NOT NULL,
  `tanggal_aksi` date NOT NULL,
  `pesan_aksi` varchar(250) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `tgl_acc` date NOT NULL,
  `nama_admin` varchar(100) NOT NULL DEFAULT 'Sedang Diverifikasi',
  `status_aksi` varchar(100) NOT NULL DEFAULT 'Sedang Diverifikasi',
  `status_verifikasi` varchar(100) NOT NULL DEFAULT 'Pending',
  `pesan_admin` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aksi`
--

INSERT INTO `aksi` (`id_aksi`, `id_data_kategori`, `kategori_aksi`, `tanggal_aksi`, `pesan_aksi`, `nama_pegawai`, `tgl_acc`, `nama_admin`, `status_aksi`, `status_verifikasi`, `pesan_admin`) VALUES
(3, 3, 'Nonaktifkan Anggota', '2024-06-09', 'Jito pernah bermasalah di berbagai koperasi soal hutangnya yang tidak lunas. Berikut koperasi yang pernah jadi korban jito\r\n\r\n1. Koperasi Karep\r\n2. Koperasi Bahagia\r\n\r\nTolong blacklist saja untuk nama jito hartati', 'Muh Riza Zulfahnur', '2024-06-06', 'Ardan Anjung Kusuma', 'Ditolak', 'Diterima', ''),
(4, 3, 'Nonaktifkan Anggota', '2024-06-03', 'Tolong review lagi pak, jito orangnya tidak bertanggung jawab dalam melunasi hutangnya. Biar lebih enak silahkan kontak CP dibawah ini, humas koperasi yang pernah menjadi korban jito : \r\n\r\n1. Koperasi Karep (0812496023954)\r\n2. Koperasi Bahagia (08582', 'Dina Lisuardi', '0000-00-00', 'Ardan Anjung Kusuma', 'Berhasil', 'Diterima', ''),
(7, 6, 'Nonaktifkan Anggota', '2024-06-02', 'Ahmad Kholil terlibat dalam kasus penipuan pada koperasi ABC', 'Dina Lisuardi', '0000-00-00', 'Ardan Anjung Kusuma', 'Ditolak', 'Diterima', ''),
(10, 4, 'Nonaktifkan Anggota', '2024-06-01', 'Siti pernah kasus pada beberapa koperasi ', 'Ardan Anjung Kusuma', '0000-00-00', 'Sedang Diverifikasi', 'Sedang Diverifikasi', 'Pending', ''),
(11, 5, 'Nonaktifkan Anggota', '2024-06-01', 'Coba', 'Administrator', '0000-00-00', 'Sedang Diverifikasi', 'Sedang Diverifikasi', 'Pending', ''),
(14, 7, 'Hapus Setoran', '2024-06-06', 'Salah Input', 'Yudya H S', '2024-06-08', 'Administrator', 'Berhasil', 'Diterima', 'Permintaan telah Diverifikasi Admin'),
(15, 11, 'Hapus Setoran', '2024-06-03', 'Salah Input', 'Administrator', '2024-06-09', 'Administrator', 'Berhasil', 'Diterima', 'Permintaan telah Diverifikasi Admin'),
(16, 9, 'Hapus Setoran', '2024-06-03', 'Salah Input', 'Administrator', '2024-06-09', 'Administrator', 'Ditolak', 'Ditolak', 'Maish Terdapat tunggakan'),
(28, 9, 'Hapus Angsuran', '2024-06-09', 'Coba Terus', 'Administrator', '0000-00-00', 'Sedang Diverifikasi', 'Sedang Diverifikasi', 'Pending', ''),
(29, 4, 'Hapus Angsuran', '2024-06-10', 'Coba', 'Administrator', '0000-00-00', 'Sedang Diverifikasi', 'Sedang Diverifikasi', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik_anggota` bigint(20) NOT NULL,
  `nama_anggota` varchar(200) NOT NULL,
  `alamat_anggota` varchar(200) NOT NULL,
  `no_telp_anggota` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status_anggota` varchar(200) NOT NULL DEFAULT 'Tidak Aktif',
  `tanggal_keanggotaan` varchar(100) NOT NULL DEFAULT 'Belum Menjadi Anggota',
  `foto_ktp_anggota` varchar(500) NOT NULL DEFAULT 'Belum Diupload',
  `foto_selfie_ktp_anggota` varchar(500) NOT NULL DEFAULT 'Belum Diupload'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nik_anggota`, `nama_anggota`, `alamat_anggota`, `no_telp_anggota`, `username`, `email`, `password`, `status_anggota`, `tanggal_keanggotaan`, `foto_ktp_anggota`, `foto_selfie_ktp_anggota`) VALUES
(1, 9247197013354, 'Anggi', 'Jl. Mawar Merah 21 Bojonenegoro', '085687921257', 'anggi1', 'anggi@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Aktif', '27-10-2020', '21052024060434anime.png', '21052024060434415518.jpg'),
(2, 2847429742424, 'Jasmin Putri', 'Jl. Melati 105 Kalitidu, Bojonegoro', '085125891250', 'jasmin', 'jasmin@gmail.com', 'c677901e8baa1f96025f0938a4cd0423', 'Dinonaktifkan', '05-11-2020', 'example-ktp-1.jpg', 'example-with-ktp-1.jpg'),
(3, 284204897424, 'Jito Hartati', 'Jl. Grogol 21 Bojonegoro', '0812385794223', 'jito', 'jito@gmail.com', '28d8024451d991a899aaf3a4875c8cfa', 'Dinonaktifkan', 'Belum Menjadi Anggota', '17102020132043example-ktp-1.jpg', '17102020132043img-kyc-sample-2.png'),
(4, 1937973826424, 'Siti Aisyah', 'Jl. Mawar 15 Malang', '081254219520', 'siti', 'siti@gmail.com', '8230f9cb6dd627a92fdd0c6f282affd2', 'Aktif', '2024-06-05', '01112020165639example-ktp-1.jpg', '01112020165639example-with-ktp-1.jpg'),
(5, 9247294729492, 'Andi Muhibin', 'Jl. Anggrek 12 Kapas, Bojonegoro', '081289742951', 'andi', 'andi@gmail.com', '03339dc0dff443f15c254baccde9bece', 'Tidak Aktif', 'Belum Menjadi Anggota', 'Belum Diupload', 'Belum Diupload'),
(6, 86428642546343, 'Ahmad Kholil', 'Jl. Bambu Hijau 65 Bojonegoro', '085212345681', 'kholil', 'kholil@gmail.com', '9b5c59c7139392bdd6134e0d063df564', 'Sedang Diverifikasi', 'Belum Menjadi Anggota', '29102020163957ktp_examplektp-00.jpg', '29102020163957imgkyc_sample-kyc21.png'),
(7, 824782552323, 'John Doe', 'Jl. Anggrek 12 Bojonegoro', '085212495829', 'john', 'johndoe@gmail.com', '6e0b7076126a29d5dfcbd54835387b7b', 'Aktif', '03-11-2020', '03112020010050example-ktp-1.jpg', '03112020010050img-kyc-sample-2.png'),
(8, 924727653223, 'Satine Zaneta', 'Jl. Merak 25 Bojonegoro', '08521232187', 'satine', 'satine@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Aktif', '19-05-2024', '', '03112020010050img-kyc-sample-2.png'),
(9, 113913971937, 'Yudya', 'GTA', '08982358513', '', 'yudyasukma2@gmail.com', '', 'Sedang Diverifikasi', 'Belum Menjadi Anggota', '0406202415092001112020165639example-ktp-1.jpg', '0406202415092001112020165639example-with-ktp-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran_detail`
--

CREATE TABLE `angsuran_detail` (
  `id_angsuran_detail` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal_angsuran` date NOT NULL,
  `angsuran_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran_detail`
--

INSERT INTO `angsuran_detail` (`id_angsuran_detail`, `id_pinjaman`, `id_pegawai`, `tanggal_angsuran`, `angsuran_pembayaran`) VALUES
(14, 7, 1, '2024-06-11', 'Rp 525,000.00'),
(15, 7, 1, '2024-06-11', 'Rp 525,000.00'),
(16, 7, 1, '2024-06-11', 'Rp 525,000.00'),
(17, 7, 1, '2024-06-11', 'Rp 525,000.00'),
(18, 7, 1, '2024-06-11', 'Rp 525,000.00'),
(19, 7, 1, '2024-06-11', 'Rp 525,000.00'),
(20, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(21, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(22, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(23, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(24, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(25, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(26, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(27, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(28, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(29, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(30, 8, 1, '2024-06-11', 'Rp 437,500.00'),
(31, 8, 1, '2024-06-11', 'Rp 437,500.00');

-- --------------------------------------------------------

--
-- Table structure for table `lupa_password`
--

CREATE TABLE `lupa_password` (
  `id_lupa_password` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `pertanyaankeamanan1` text NOT NULL,
  `pertanyaankeamanan2` text NOT NULL,
  `jawabankeamanan1` text NOT NULL,
  `jawabankeamanan2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lupa_password`
--

INSERT INTO `lupa_password` (`id_lupa_password`, `id_anggota`, `pertanyaankeamanan1`, `pertanyaankeamanan2`, `jawabankeamanan1`, `jawabankeamanan2`) VALUES
(1, 1, 'Apa angka favorit anda?(Contoh: 29)', 'Siapakah teman masa kecil anda?', '89', 'Riza Zulfahnur'),
(2, 2, 'Di kota manakah ayah dan ibu anda bertemu?', 'Apa hobby anda?', 'Paris', 'Berkuda'),
(4, 3, 'Apa angka favorit anda?(Contoh: 29)', 'Apa hobby anda?', '12', 'Mancing'),
(6, 5, 'Siapakah teman masa kecil anda?', 'Apa hobby anda?', 'Handrik', 'Bermain Gitar'),
(7, 4, 'Apa nama belakang ibu anda?', 'Apa hobby anda?', 'Aisyah', 'Membaca'),
(8, 6, 'Apa angka favorit anda?(Contoh: 29)', 'Siapakah guru terfavorit anda?', '10', 'Sujak'),
(9, 7, 'Apa nama belakang ibu anda?', 'Apa hobby anda?', 'Doe', 'Bersepeda'),
(10, 8, 'Apa angka favorit anda?(Contoh: 29)', 'Siapakah nama hewan peliharaan anda?', '29', 'Poki');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nik_pegawai` bigint(20) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `alamat_pegawai` varchar(200) NOT NULL,
  `no_telp_pegawai` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kategori` int(1) NOT NULL DEFAULT 2,
  `foto_pegawai` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nik_pegawai`, `nama_pegawai`, `alamat_pegawai`, `no_telp_pegawai`, `username`, `email`, `password`, `kategori`, `foto_pegawai`) VALUES
(1, 0, 'Administrator', 'Banjarejo', '085212342321', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, ''),
(2, 0, 'Dina Lisuardi', 'Banjarejo', '081235896824', 'dina', 'dina@gmail.com', 'f093c0fed979519fbc43d772b76f5c86', 2, ''),
(3, 0, 'Muh Riza Zulfahnur', 'Kalitidu', '085212396501', 'riza', 'riza@gmail.com', '41a44352a6f3cd3b45282acbce50927c', 2, ''),
(6, 3515131203990007, 'Yudya H S', 'GTA', '089530583955', 'yudya', 'yudyasukma2@gmail.com', '1bbd886460827015e5d605ed44252251', 2, '6648059e82439.png'),
(7, 1234567890123455, 'Prass', 'Masangan', '0301839724745', 'prass123', 'Prass@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0, '19052024052033ava.png');

-- --------------------------------------------------------

--
-- Table structure for table `penarikan_simpanan`
--

CREATE TABLE `penarikan_simpanan` (
  `id_penarikan` int(11) NOT NULL,
  `id_simpanan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `nominal_total_penarikan` int(25) NOT NULL,
  `total_akhir_simpanan` int(25) NOT NULL DEFAULT 0,
  `tanggal_permintaan_penarikan` date NOT NULL,
  `tgl_acc_penarikan` date NOT NULL,
  `status_penarikan` varchar(20) NOT NULL DEFAULT 'Belum Diverifikasi',
  `verifikasi_pegawai` varchar(50) NOT NULL DEFAULT 'Belum Diverifikasi',
  `verifikasi_admin` varchar(50) NOT NULL DEFAULT 'Belum Diverifikasi',
  `pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penarikan_simpanan`
--

INSERT INTO `penarikan_simpanan` (`id_penarikan`, `id_simpanan`, `id_pegawai`, `id_anggota`, `nominal_total_penarikan`, `total_akhir_simpanan`, `tanggal_permintaan_penarikan`, `tgl_acc_penarikan`, `status_penarikan`, `verifikasi_pegawai`, `verifikasi_admin`, `pesan`) VALUES
(1, 1, 1, 2, 5650000, 0, '2020-11-09', '2024-06-06', 'Ditolak', 'Ditolak', 'Ditolak', 'Coba'),
(5, 3, 1, 2, 5000000, 0, '2024-06-06', '2024-06-06', 'Berhasil', 'Diterima', 'Diterima', 'Pengajuan telah Diverifikasi dan Diterima, Anggota dapat mengambil uang simpanannya di koperasi');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_pinjaman`
--

CREATE TABLE `pengajuan_pinjaman` (
  `id_pengajuan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `total_pengajuan_pinjaman` bigint(20) NOT NULL,
  `alasan_pinjaman` varchar(250) NOT NULL,
  `jml_tempo_angsuran` varchar(50) NOT NULL,
  `jml_angsuran_perbulan` varchar(50) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status_pengajuan` varchar(50) NOT NULL DEFAULT 'Sedang Diverifikasi',
  `verifikasi_pegawai` varchar(50) NOT NULL DEFAULT 'Sedang Diverifikasi',
  `verifikasi_admin` varchar(50) NOT NULL DEFAULT 'Pending',
  `tgl_acc_pengajuan` date NOT NULL,
  `pesan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan_pinjaman`
--

INSERT INTO `pengajuan_pinjaman` (`id_pengajuan`, `id_anggota`, `id_pegawai`, `total_pengajuan_pinjaman`, `alasan_pinjaman`, `jml_tempo_angsuran`, `jml_angsuran_perbulan`, `tanggal_pengajuan`, `status_pengajuan`, `verifikasi_pegawai`, `verifikasi_admin`, `tgl_acc_pengajuan`, `pesan`) VALUES
(7, 1, 1, 3000000, 'Modal Warkop', '6', 'Rp 525,000.00', '2024-06-11', 'Berhasil', 'Diterima', 'Diterima', '2024-06-11', 'Pengajuan telah diverifikasi dan diterima Admin, anda bisa mengambil uang pinjaman di koperasi'),
(8, 7, 1, 1000000, 'Modal Juga', '3', 'Rp 350,000.00', '2024-06-11', 'Ditolak', 'Ditolak', 'Ditolak', '2024-06-11', 'Masih Ada Tunggakan'),
(9, 4, 1, 4000000, 'Modal Lagi', '12', 'Rp 350,000.00', '2024-06-11', 'Ditolak', 'Diterima', 'Ditolak', '2024-06-11', 'Coba'),
(10, 1, 1, 5000000, 'Modal Lagi', '12', 'Rp 437,500.00', '2024-06-11', 'Berhasil', 'Diterima', 'Diterima', '2024-06-11', 'Pengajuan telah diverifikasi dan diterima Admin, anda bisa mengambil uang pinjaman di koperasi');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `judul` text NOT NULL,
  `header_gambar` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_post` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `id_pegawai`, `judul`, `header_gambar`, `isi`, `tanggal_post`) VALUES
(8, 1, 'Kategori Member KSP Mitra Artha', '28102020161609categori.jpg', 'Berikut merupakan penjelasan status member :\r\n\r\n1. Aktif  : Member aktif yang bisa mengakses semua fitur website member\r\n2. Tidak Aktif : Member yang belum verifikasi data diri, harus melakukan upload file KTP dan Foto Diri Bersama KTP.\r\n3. Dinonaktifkan : Member tidak valid (Ditolak menjadi anggota koperasi)\r\n4. Sedang Diverifikasi : Member sudah mengupload data diri dan tinggal menunggu verifikasi dari pegawai.\r\n5. Verifikasi Ulang : Member diminta untuk memverifikasi ulang data diri yang telah diajukan sebelumnya. (Kemungkinan file ada yang blur dll sehingga pegawai kesusahan untuk melakukan verifikasi)', '28-10-2020'),
(12, 1, 'Tentang KSP Mitra Artha', '03112020051350Screenshot_2.jpg', 'Alamat : Jl. Gajah Mada No.114, Sukorejo Lor, Sukorejo, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur 62115\r\nNo Telp : +62353882673\r\n<a href=\"https://goo.gl/maps/WBPu2YR3yiyHNuW87\">Klik disini untuk Google Maps</a>\r\n\r\nJam Operasional : \r\n<ul>\r\n<li>Senin (08.00–16.00)</li>\r\n<li>Selasa (08.00–16.00)</li>\r\n<li>Rabu (08.00–16.00)</li>\r\n<li>Kamis (08.00–16.00)</li>\r\n<li>Jumat (08.00–16.00)</li>\r\n<li>Sabtu (08.00–16.00)</li>\r\n<li>Minggu (Tutup)</li>\r\n</ul>', '03-11-2020');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status_pinjaman` varchar(50) NOT NULL DEFAULT 'Belum Lunas',
  `tanggal_pelunasan` varchar(50) NOT NULL,
  `tanggal_meminjam` date NOT NULL,
  `total_pinjaman` varchar(50) NOT NULL,
  `angsuran_bulanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_anggota`, `id_pengajuan`, `id_pegawai`, `status_pinjaman`, `tanggal_pelunasan`, `tanggal_meminjam`, `total_pinjaman`, `angsuran_bulanan`) VALUES
(7, 1, 7, 1, 'Sudah Lunas', '11 Desember 2024', '2024-06-11', 'Rp 3.000.000', 'Rp 525,000.00'),
(8, 1, 10, 1, 'Sudah Lunas', '11 Juni 2025', '2024-06-11', 'Rp 5.000.000', 'Rp 437,500.00');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jumlah_simpanan_pokok` bigint(20) NOT NULL,
  `tgl_transaksi_sp` date NOT NULL,
  `jumlah_simpanan_wajib` bigint(20) NOT NULL,
  `status_simpanan` varchar(200) NOT NULL DEFAULT 'Belum Ditarik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `id_anggota`, `id_pegawai`, `jumlah_simpanan_pokok`, `tgl_transaksi_sp`, `jumlah_simpanan_wajib`, `status_simpanan`) VALUES
(1, 1, 1, 5000000, '2024-06-03', 1770000, 'Belum Ditarik'),
(2, 7, 1, 6000000, '2024-05-01', 130000, 'Belum Ditarik'),
(3, 2, 1, 0, '2024-04-09', 0, 'Sudah Ditarik'),
(6, 4, 1, 5000000, '2024-06-05', 100000, 'Belum Ditarik');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_detail`
--

CREATE TABLE `simpanan_detail` (
  `id_simpanan_detail` int(11) NOT NULL,
  `id_simpanan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jumlah_setor_tunai` int(20) NOT NULL,
  `tanggal_setor_tunai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan_detail`
--

INSERT INTO `simpanan_detail` (`id_simpanan_detail`, `id_simpanan`, `id_pegawai`, `jumlah_setor_tunai`, `tanggal_setor_tunai`) VALUES
(1, 1, 2, 50000, '2020-10-27'),
(4, 2, 3, 30000, '2020-11-03'),
(9, 1, 1, 300000, '2024-05-22'),
(10, 1, 1, 120000, '2024-05-22'),
(11, 1, 1, 0, '2024-05-22'),
(12, 1, 1, 1200000, '2024-05-22'),
(13, 6, 1, 100000, '2024-06-07'),
(14, 2, 1, 100000, '2024-06-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aksi`
--
ALTER TABLE `aksi`
  ADD PRIMARY KEY (`id_aksi`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `angsuran_detail`
--
ALTER TABLE `angsuran_detail`
  ADD PRIMARY KEY (`id_angsuran_detail`),
  ADD KEY `pinjaman_detail_ibfk_1` (`id_pinjaman`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `lupa_password`
--
ALTER TABLE `lupa_password`
  ADD PRIMARY KEY (`id_lupa_password`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `penarikan_simpanan`
--
ALTER TABLE `penarikan_simpanan`
  ADD PRIMARY KEY (`id_penarikan`),
  ADD KEY `id_simpanan` (`id_simpanan`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `pengajuan_pinjaman`
--
ALTER TABLE `pengajuan_pinjaman`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `pinjaman_ibfk_1` (`id_anggota`),
  ADD KEY `id_pengajuan` (`id_pengajuan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_simpanan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `simpanan_detail`
--
ALTER TABLE `simpanan_detail`
  ADD PRIMARY KEY (`id_simpanan_detail`),
  ADD KEY `id_simpanan` (`id_simpanan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aksi`
--
ALTER TABLE `aksi`
  MODIFY `id_aksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `angsuran_detail`
--
ALTER TABLE `angsuran_detail`
  MODIFY `id_angsuran_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `lupa_password`
--
ALTER TABLE `lupa_password`
  MODIFY `id_lupa_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penarikan_simpanan`
--
ALTER TABLE `penarikan_simpanan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengajuan_pinjaman`
--
ALTER TABLE `pengajuan_pinjaman`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `simpanan_detail`
--
ALTER TABLE `simpanan_detail`
  MODIFY `id_simpanan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `angsuran_detail`
--
ALTER TABLE `angsuran_detail`
  ADD CONSTRAINT `angsuran_detail_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `angsuran_detail_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lupa_password`
--
ALTER TABLE `lupa_password`
  ADD CONSTRAINT `lupa_password_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penarikan_simpanan`
--
ALTER TABLE `penarikan_simpanan`
  ADD CONSTRAINT `penarikan_simpanan_ibfk_2` FOREIGN KEY (`id_simpanan`) REFERENCES `simpanan` (`id_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_pinjaman`
--
ALTER TABLE `pengajuan_pinjaman`
  ADD CONSTRAINT `pengajuan_pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjaman_ibfk_2` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan_pinjaman` (`id_pengajuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simpanan_detail`
--
ALTER TABLE `simpanan_detail`
  ADD CONSTRAINT `simpanan_detail_ibfk_1` FOREIGN KEY (`id_simpanan`) REFERENCES `simpanan` (`id_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `simpanan_detail_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
