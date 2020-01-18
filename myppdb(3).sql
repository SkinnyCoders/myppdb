-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2020 pada 06.42
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myppdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_masuk`
--

CREATE TABLE `biaya_masuk` (
  `id_biaya_masuk` int(11) NOT NULL,
  `id_jalur_pendaftaran` int(11) NOT NULL,
  `id_program_studi` int(11) NOT NULL,
  `jenis_biaya_masuk` varchar(30) NOT NULL,
  `jumlah_biaya_masuk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_ulang`
--

CREATE TABLE `daftar_ulang` (
  `id_daftar_ulang` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `batas_daftar_ulang` date NOT NULL,
  `status` enum('sudah','belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_berkas`
--

CREATE TABLE `data_berkas` (
  `id_berkas` int(11) NOT NULL,
  `pas_foto` varchar(255) DEFAULT NULL,
  `ijazah_terakhir` varchar(255) DEFAULT NULL,
  `skhun` varchar(255) DEFAULT NULL,
  `kartu_keluarga` varchar(255) DEFAULT NULL,
  `keterangan_sehat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_berkas`
--

INSERT INTO `data_berkas` (`id_berkas`, `pas_foto`, `ijazah_terakhir`, `skhun`, `kartu_keluarga`, `keterangan_sehat`) VALUES
(11, 'e5bdbac01b0976f03f0eaa976d509a0f.jpg', '7fde116a16b477774747e925f1db9adb.pdf', 'db3203a99b987b12fa02b24ba833ff60.pdf', '76f664196755a609ddd8a335b188a3c1.pdf', 'f8414a6c2297e3714b449af7dd6187fb.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_diri`
--

CREATE TABLE `data_diri` (
  `id_data_diri` int(11) NOT NULL,
  `nama_lengkap` varchar(45) NOT NULL,
  `nisn` int(33) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat_rumah` varchar(500) DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_diri`
--

INSERT INTO `data_diri` (`id_data_diri`, `nama_lengkap`, `nisn`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat_rumah`, `agama`, `no_hp`) VALUES
(1, 'Agus', 542387482, 'jakarta', '2020-01-01', 'P', 'jln kemangi', 'islam', '083871467467'),
(2, 'bambang', 12345, 'jakarta', '2020-01-01', 'L', 'fwefwef', 'fwefwef', '32543245');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ortu`
--

CREATE TABLE `data_ortu` (
  `id_ortu` int(11) NOT NULL,
  `nama_ortu_ayah` varchar(50) NOT NULL,
  `pekerjaan_ortu_ayah` varchar(255) NOT NULL,
  `alamat_ortu_ayah` varchar(355) NOT NULL,
  `no_hp_ortu_ayah` varchar(13) NOT NULL,
  `nama_ortu_ibu` varchar(50) NOT NULL,
  `pekerjaan_ortu_ibu` varchar(255) NOT NULL,
  `alamat_ortu_ibu` varchar(355) NOT NULL,
  `no_hp_ortu_ibu` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_ortu`
--

INSERT INTO `data_ortu` (`id_ortu`, `nama_ortu_ayah`, `pekerjaan_ortu_ayah`, `alamat_ortu_ayah`, `no_hp_ortu_ayah`, `nama_ortu_ibu`, `pekerjaan_ortu_ibu`, `alamat_ortu_ibu`, `no_hp_ortu_ibu`) VALUES
(1, 'befew', 'fewfwe', 'fewfwe', 'fewfwefwe', 'fewfwefw', 'fewfe', 'fewfwe', '35345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_sekolah_asal`
--

CREATE TABLE `data_sekolah_asal` (
  `id_data_sekolah_asal` int(11) NOT NULL,
  `nama_sekolah_asal` varchar(60) NOT NULL,
  `tahun_masuk_sekolah_asal` date NOT NULL,
  `tahun_lulus_sekolah_asal` date NOT NULL,
  `alamat_sekolah_asal` varchar(255) NOT NULL,
  `no_telp_sekolah_asal` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_sekolah_asal`
--

INSERT INTO `data_sekolah_asal` (`id_data_sekolah_asal`, `nama_sekolah_asal`, `tahun_masuk_sekolah_asal`, `tahun_lulus_sekolah_asal`, `alamat_sekolah_asal`, `no_telp_sekolah_asal`) VALUES
(1, 'ffffwe', '2020-01-07', '2020-01-05', 'fefwefwefwe', '435345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `pertanyaan` varchar(50) NOT NULL,
  `jawaban` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(33) NOT NULL,
  `deskripsi_fasilitas` varchar(255) NOT NULL,
  `foto_fasilitas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_tes_seleksi`
--

CREATE TABLE `hasil_tes_seleksi` (
  `id_hasil_tes_seleksi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_tes_seleksi` int(11) NOT NULL,
  `nilai_benar` int(11) NOT NULL,
  `nilai_akhir` varchar(11) NOT NULL,
  `status` enum('lulus','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` int(11) NOT NULL,
  `judul_informasi` varchar(255) NOT NULL,
  `deskripsi_informasi` varchar(320) NOT NULL,
  `tgl_informasi` datetime NOT NULL,
  `file_informasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pendaftaran`
--

CREATE TABLE `jadwal_pendaftaran` (
  `id_jadwal_pendaftaran` int(11) NOT NULL,
  `id_jalur_pendaftaran` int(11) NOT NULL,
  `nama_jadwal` varchar(33) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jalur_pendaftaran`
--

CREATE TABLE `jalur_pendaftaran` (
  `id_jalur_pendaftaran` int(11) NOT NULL,
  `nama_jalur_pendaftaran` varchar(33) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `persyaratan` varchar(255) NOT NULL,
  `status_jalur_pendaftaran` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jalur_pendaftaran`
--

INSERT INTO `jalur_pendaftaran` (`id_jalur_pendaftaran`, `nama_jalur_pendaftaran`, `keterangan`, `persyaratan`, `status_jalur_pendaftaran`) VALUES
(1, 'Reguler', 'Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Ea Quaerat Minima Enim Tempore Doloribus Quod, Illum, Modi Asperiores Nobis Recusandae Explicabo Optio, Quo Rem Mollitia Placeat Quasi. Unde, Voluptate Tenetur.', '[\"lorem1\",\"lorem2\",\"lorem3\",\"lorem4\",\"lorem5\"]', 'true');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi_tes_seleksi`
--

CREATE TABLE `konfigurasi_tes_seleksi` (
  `id_konfigurasi_tes_seleksi` int(11) NOT NULL,
  `id_program_studi` int(11) NOT NULL,
  `id_tes_seleksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfigurasi_tes_seleksi`
--

INSERT INTO `konfigurasi_tes_seleksi` (`id_konfigurasi_tes_seleksi`, `id_program_studi`, `id_tes_seleksi`) VALUES
(1, 4, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kouta_pendaftaran`
--

CREATE TABLE `kouta_pendaftaran` (
  `id_kouta_pendaftaran` int(11) NOT NULL,
  `id_program_studi` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `jumlah` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kouta_pendaftaran`
--

INSERT INTO `kouta_pendaftaran` (`id_kouta_pendaftaran`, `id_program_studi`, `id_tahun_ajaran`, `jumlah`) VALUES
(2, 4, 3, 200),
(3, 4, 4, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `jenis_pembayaran` varchar(40) NOT NULL,
  `batas_pembayaran` date NOT NULL,
  `status_pembayaran` enum('belum','menunggu','lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencabutan`
--

CREATE TABLE `pencabutan` (
  `id_pencabutan` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `tgl_pencabutan` datetime NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencadangan`
--

CREATE TABLE `pencadangan` (
  `id_pencadangan` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `status_pencadangan` enum('true','false') NOT NULL DEFAULT 'true',
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_jalur_pendaftaran` int(11) NOT NULL,
  `id_program_studi` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `status_kelengkapan_data` enum('lengkap','belum') NOT NULL,
  `status_kelengkapan_berkas` enum('lengkap','belum') NOT NULL,
  `status_verifikasi_data` enum('sudah','belum') NOT NULL,
  `status_verifikasi_berkas` enum('sudah','belum') NOT NULL,
  `status_kelulusan` enum('lulus','tidak_lulus') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_jalur_pendaftaran`, `id_program_studi`, `id_tahun_ajaran`, `no_pendaftaran`, `status_kelengkapan_data`, `status_kelengkapan_berkas`, `status_verifikasi_data`, `status_verifikasi_berkas`, `status_kelulusan`) VALUES
(2, 1, 4, 3, '00001', 'belum', 'belum', 'belum', 'belum', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_pengguna` varchar(42) NOT NULL,
  `foto_pengguna` varchar(50) NOT NULL,
  `email_pengguna` varchar(42) NOT NULL,
  `password` varchar(65) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_registrasi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_status` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `id_role`, `nama_pengguna`, `foto_pengguna`, `email_pengguna`, `password`, `jenis_kelamin`, `tgl_registrasi`, `login_status`) VALUES
(16, 1, 'warsito', 'ff76c02a50f46ff427845b5a5aa448fe.png', 'warsito@gmail.com', '$2y$10$h9mcPmvPPrC56POJO4DFwOk6vTLsRmYfJfvS2IvJ0.DuGIiTSoANG', 'L', '2019-12-24 00:52:45', 'false'),
(17, 2, 'Rizki Ristanto', 'default.png', 'laughzsec@gmail.com', '$2y$10$2v/AQbXR9.rvcV2uaKA3Z.McQqVt53plfUvwyH1/UDI0zbf/w2QNK', 'L', '2019-12-24 01:47:47', 'true'),
(20, 3, 'Desta', '79771849ba432dff347dda5a10097d09.png', 'desta@gmail.com', '$2y$10$BSnyWaILR2l5AeN6M/YX5OhMfSR.r6FVrk5XPJAbqmdFcneaHxjhu', 'L', '2020-01-14 16:28:38', 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `nama_penghargaan` varchar(255) NOT NULL,
  `deskripsi_penghargaan` varchar(255) NOT NULL,
  `foto_penghargaan` varchar(255) NOT NULL,
  `tanggal_penghargaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penghargaan`
--

INSERT INTO `penghargaan` (`id_penghargaan`, `nama_penghargaan`, `deskripsi_penghargaan`, `foto_penghargaan`, `tanggal_penghargaan`) VALUES
(6, 'Penghargaan 4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labor', 'a6c29f09a039b76b0f12405cde20a5fe.png', '12/31/2019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_data_diri` int(11) NOT NULL,
  `id_ortu` int(11) DEFAULT NULL,
  `id_berkas` int(11) DEFAULT NULL,
  `id_sekolah_asal` int(11) DEFAULT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username_peserta` varchar(30) NOT NULL,
  `email_peserta` varchar(50) NOT NULL,
  `password_peserta` varchar(65) NOT NULL,
  `status_akun` enum('belum','aktif','tidak_aktif') NOT NULL,
  `login_status` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_data_diri`, `id_ortu`, `id_berkas`, `id_sekolah_asal`, `id_pendaftaran`, `id_role`, `username_peserta`, `email_peserta`, `password_peserta`, `status_akun`, `login_status`) VALUES
(4, 1, 1, 11, 1, 2, 4, 'bambang', 'bambang@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'aktif', 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petunjuk_pendaftaran`
--

CREATE TABLE `petunjuk_pendaftaran` (
  `id_petunjuk_pendaftaran` int(11) NOT NULL,
  `gambar` varchar(33) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id_profile_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(30) NOT NULL,
  `logo_sekolah` varchar(150) NOT NULL,
  `profil_sekolah` varchar(500) NOT NULL,
  `visi_sekolah` varchar(256) NOT NULL,
  `misi_sekolah` varchar(256) NOT NULL,
  `nama_kepala_sekolah` varchar(33) NOT NULL,
  `foto_kepala_sekolah` varchar(150) NOT NULL,
  `sambutan_kepala_sekolah` varchar(500) NOT NULL,
  `alamat_sekolah` varchar(256) NOT NULL,
  `kontak_sekolah` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id_profile_sekolah`, `nama_sekolah`, `logo_sekolah`, `profil_sekolah`, `visi_sekolah`, `misi_sekolah`, `nama_kepala_sekolah`, `foto_kepala_sekolah`, `sambutan_kepala_sekolah`, `alamat_sekolah`, `kontak_sekolah`) VALUES
(5, 'SMK Muhammadiyah Mlati', '60c7cd3dacfc42c7878f0b42690609dc.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep', '[\"lorem1\",\"lorem2\",\"lorem3\",\"lorem4\"]', 'Dr. H. Warsito, PHd', 'c9262b7a1f6eb23e9981758722827897.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in re', 'lorem', '{\"telp\":\"08573278473\",\"email\":\"laughzsec@gmail.com\",\"social\":\"facebook.com\\/smkgwa\"}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_studi`
--

CREATE TABLE `program_studi` (
  `id_program_studi` int(11) NOT NULL,
  `nama_program_studi` varchar(33) NOT NULL,
  `akreditasi_program_studi` varchar(33) NOT NULL,
  `deskripsi_program_studi` text NOT NULL,
  `foto_program_studi` varchar(60) DEFAULT NULL,
  `slug` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `program_studi`
--

INSERT INTO `program_studi` (`id_program_studi`, `nama_program_studi`, `akreditasi_program_studi`, `deskripsi_program_studi`, `foto_program_studi`, `slug`) VALUES
(4, 'komputer jaringan 3', 'b', 'dfwfwef', NULL, 'komputer-jaringan-3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Kepala Sekolah'),
(2, 'Admin'),
(3, 'Operator'),
(4, 'Peserta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_tes_seleksi`
--

CREATE TABLE `soal_tes_seleksi` (
  `id_soal_tes_seleksi` int(11) NOT NULL,
  `id_tes_seleksi` int(11) NOT NULL,
  `soal_tes_seleksi` varchar(255) NOT NULL,
  `file_tes` varchar(255) DEFAULT NULL,
  `jawaban_a` varchar(60) NOT NULL,
  `jawaban_b` varchar(60) NOT NULL,
  `jawaban_c` varchar(60) NOT NULL,
  `jawaban_d` varchar(60) NOT NULL,
  `jawaban_benar` enum('a','b','c','d') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_tes_seleksi`
--

INSERT INTO `soal_tes_seleksi` (`id_soal_tes_seleksi`, `id_tes_seleksi`, `soal_tes_seleksi`, `file_tes`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`) VALUES
(16, 1, 'tes soal 2', '5b9890ea6daea3a5e8c7a8043eb08e71.PNG', '2', '3', '4', '5', 'd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `tahun_mulai` varchar(11) NOT NULL,
  `tahun_akhir` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_mulai`, `tahun_akhir`) VALUES
(3, '2019', '2020'),
(4, '2020', '2021'),
(6, '2022', '2023'),
(7, '2023', '2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes_seleksi`
--

CREATE TABLE `tes_seleksi` (
  `id_tes_seleksi` int(11) NOT NULL,
  `nama_tes_seleksi` varchar(255) NOT NULL,
  `deskripsi_tes_seleksi` text NOT NULL,
  `bobot_tes` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tes_seleksi`
--

INSERT INTO `tes_seleksi` (`id_tes_seleksi`, `nama_tes_seleksi`, `deskripsi_tes_seleksi`, `bobot_tes`) VALUES
(1, 'ddffwef', 'efefewf', 80),
(3, 'komputer jaringan', 'dawdfafa', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_seleksi`
--

CREATE TABLE `token_seleksi` (
  `id_token_seleksi` int(11) NOT NULL,
  `id_konfigurasi_seleksi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `token` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `token_seleksi`
--

INSERT INTO `token_seleksi` (`id_token_seleksi`, `id_konfigurasi_seleksi`, `id_peserta`, `token`) VALUES
(13, 1, 4, '0cSByRmE9ZY6ef8P7QqW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_masuk`
--
ALTER TABLE `biaya_masuk`
  ADD PRIMARY KEY (`id_biaya_masuk`),
  ADD KEY `id_jalur_pendaftaran` (`id_jalur_pendaftaran`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indeks untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD PRIMARY KEY (`id_daftar_ulang`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indeks untuk tabel `data_diri`
--
ALTER TABLE `data_diri`
  ADD PRIMARY KEY (`id_data_diri`);

--
-- Indeks untuk tabel `data_ortu`
--
ALTER TABLE `data_ortu`
  ADD PRIMARY KEY (`id_ortu`);

--
-- Indeks untuk tabel `data_sekolah_asal`
--
ALTER TABLE `data_sekolah_asal`
  ADD PRIMARY KEY (`id_data_sekolah_asal`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indeks untuk tabel `hasil_tes_seleksi`
--
ALTER TABLE `hasil_tes_seleksi`
  ADD PRIMARY KEY (`id_hasil_tes_seleksi`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_tes_seleksi` (`id_tes_seleksi`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `jadwal_pendaftaran`
--
ALTER TABLE `jadwal_pendaftaran`
  ADD PRIMARY KEY (`id_jadwal_pendaftaran`),
  ADD KEY `id_jalur_pendaftaran` (`id_jalur_pendaftaran`);

--
-- Indeks untuk tabel `jalur_pendaftaran`
--
ALTER TABLE `jalur_pendaftaran`
  ADD PRIMARY KEY (`id_jalur_pendaftaran`);

--
-- Indeks untuk tabel `konfigurasi_tes_seleksi`
--
ALTER TABLE `konfigurasi_tes_seleksi`
  ADD PRIMARY KEY (`id_konfigurasi_tes_seleksi`),
  ADD KEY `id_program_studi` (`id_program_studi`),
  ADD KEY `id_tes_seleksi` (`id_tes_seleksi`);

--
-- Indeks untuk tabel `kouta_pendaftaran`
--
ALTER TABLE `kouta_pendaftaran`
  ADD PRIMARY KEY (`id_kouta_pendaftaran`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `pencabutan`
--
ALTER TABLE `pencabutan`
  ADD PRIMARY KEY (`id_pencabutan`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indeks untuk tabel `pencadangan`
--
ALTER TABLE `pencadangan`
  ADD PRIMARY KEY (`id_pencadangan`),
  ADD KEY `pencadangan_ibfk_1` (`id_pendaftaran`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_jalur_pendaftaran` (`id_jalur_pendaftaran`),
  ADD KEY `id_program_studi` (`id_program_studi`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`),
  ADD KEY `peserta_ibfk_4` (`id_berkas`),
  ADD KEY `peserta_ibfk_5` (`id_data_diri`),
  ADD KEY `id_sekolah_asal` (`id_sekolah_asal`),
  ADD KEY `id_ortu` (`id_ortu`);

--
-- Indeks untuk tabel `petunjuk_pendaftaran`
--
ALTER TABLE `petunjuk_pendaftaran`
  ADD PRIMARY KEY (`id_petunjuk_pendaftaran`);

--
-- Indeks untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id_profile_sekolah`);

--
-- Indeks untuk tabel `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_program_studi`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `soal_tes_seleksi`
--
ALTER TABLE `soal_tes_seleksi`
  ADD PRIMARY KEY (`id_soal_tes_seleksi`),
  ADD KEY `id_tes_seleksi` (`id_tes_seleksi`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `tes_seleksi`
--
ALTER TABLE `tes_seleksi`
  ADD PRIMARY KEY (`id_tes_seleksi`);

--
-- Indeks untuk tabel `token_seleksi`
--
ALTER TABLE `token_seleksi`
  ADD PRIMARY KEY (`id_token_seleksi`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_konfigurasi_seleksi` (`id_konfigurasi_seleksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_masuk`
--
ALTER TABLE `biaya_masuk`
  MODIFY `id_biaya_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  MODIFY `id_daftar_ulang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `data_diri`
--
ALTER TABLE `data_diri`
  MODIFY `id_data_diri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_ortu`
--
ALTER TABLE `data_ortu`
  MODIFY `id_ortu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_sekolah_asal`
--
ALTER TABLE `data_sekolah_asal`
  MODIFY `id_data_sekolah_asal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_tes_seleksi`
--
ALTER TABLE `hasil_tes_seleksi`
  MODIFY `id_hasil_tes_seleksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_pendaftaran`
--
ALTER TABLE `jadwal_pendaftaran`
  MODIFY `id_jadwal_pendaftaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jalur_pendaftaran`
--
ALTER TABLE `jalur_pendaftaran`
  MODIFY `id_jalur_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi_tes_seleksi`
--
ALTER TABLE `konfigurasi_tes_seleksi`
  MODIFY `id_konfigurasi_tes_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kouta_pendaftaran`
--
ALTER TABLE `kouta_pendaftaran`
  MODIFY `id_kouta_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pencabutan`
--
ALTER TABLE `pencabutan`
  MODIFY `id_pencabutan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pencadangan`
--
ALTER TABLE `pencadangan`
  MODIFY `id_pencadangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `petunjuk_pendaftaran`
--
ALTER TABLE `petunjuk_pendaftaran`
  MODIFY `id_petunjuk_pendaftaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id_profile_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id_program_studi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `soal_tes_seleksi`
--
ALTER TABLE `soal_tes_seleksi`
  MODIFY `id_soal_tes_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tes_seleksi`
--
ALTER TABLE `tes_seleksi`
  MODIFY `id_tes_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `token_seleksi`
--
ALTER TABLE `token_seleksi`
  MODIFY `id_token_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biaya_masuk`
--
ALTER TABLE `biaya_masuk`
  ADD CONSTRAINT `biaya_masuk_ibfk_1` FOREIGN KEY (`id_jalur_pendaftaran`) REFERENCES `jalur_pendaftaran` (`id_jalur_pendaftaran`),
  ADD CONSTRAINT `biaya_masuk_ibfk_2` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Ketidakleluasaan untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD CONSTRAINT `daftar_ulang_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`);

--
-- Ketidakleluasaan untuk tabel `hasil_tes_seleksi`
--
ALTER TABLE `hasil_tes_seleksi`
  ADD CONSTRAINT `hasil_tes_seleksi_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `hasil_tes_seleksi_ibfk_2` FOREIGN KEY (`id_tes_seleksi`) REFERENCES `tes_seleksi` (`id_tes_seleksi`);

--
-- Ketidakleluasaan untuk tabel `jadwal_pendaftaran`
--
ALTER TABLE `jadwal_pendaftaran`
  ADD CONSTRAINT `jadwal_pendaftaran_ibfk_1` FOREIGN KEY (`id_jalur_pendaftaran`) REFERENCES `jalur_pendaftaran` (`id_jalur_pendaftaran`);

--
-- Ketidakleluasaan untuk tabel `konfigurasi_tes_seleksi`
--
ALTER TABLE `konfigurasi_tes_seleksi`
  ADD CONSTRAINT `konfigurasi_tes_seleksi_ibfk_1` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`),
  ADD CONSTRAINT `konfigurasi_tes_seleksi_ibfk_2` FOREIGN KEY (`id_tes_seleksi`) REFERENCES `tes_seleksi` (`id_tes_seleksi`);

--
-- Ketidakleluasaan untuk tabel `kouta_pendaftaran`
--
ALTER TABLE `kouta_pendaftaran`
  ADD CONSTRAINT `kouta_pendaftaran_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`),
  ADD CONSTRAINT `kouta_pendaftaran_ibfk_2` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`);

--
-- Ketidakleluasaan untuk tabel `pencabutan`
--
ALTER TABLE `pencabutan`
  ADD CONSTRAINT `pencabutan_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`);

--
-- Ketidakleluasaan untuk tabel `pencadangan`
--
ALTER TABLE `pencadangan`
  ADD CONSTRAINT `pencadangan_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_jalur_pendaftaran`) REFERENCES `jalur_pendaftaran` (`id_jalur_pendaftaran`),
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`),
  ADD CONSTRAINT `pendaftaran_ibfk_3` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`);

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `peserta_ibfk_3` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE,
  ADD CONSTRAINT `peserta_ibfk_4` FOREIGN KEY (`id_berkas`) REFERENCES `data_berkas` (`id_berkas`),
  ADD CONSTRAINT `peserta_ibfk_5` FOREIGN KEY (`id_data_diri`) REFERENCES `data_diri` (`id_data_diri`),
  ADD CONSTRAINT `peserta_ibfk_6` FOREIGN KEY (`id_sekolah_asal`) REFERENCES `data_sekolah_asal` (`id_data_sekolah_asal`),
  ADD CONSTRAINT `peserta_ibfk_7` FOREIGN KEY (`id_ortu`) REFERENCES `data_ortu` (`id_ortu`);

--
-- Ketidakleluasaan untuk tabel `soal_tes_seleksi`
--
ALTER TABLE `soal_tes_seleksi`
  ADD CONSTRAINT `soal_tes_seleksi_ibfk_1` FOREIGN KEY (`id_tes_seleksi`) REFERENCES `tes_seleksi` (`id_tes_seleksi`);

--
-- Ketidakleluasaan untuk tabel `token_seleksi`
--
ALTER TABLE `token_seleksi`
  ADD CONSTRAINT `token_seleksi_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `token_seleksi_ibfk_2` FOREIGN KEY (`id_konfigurasi_seleksi`) REFERENCES `konfigurasi_tes_seleksi` (`id_konfigurasi_tes_seleksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
