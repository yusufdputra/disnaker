-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2021 pada 18.23
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipck-disnaker`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lama` int(11) NOT NULL,
  `tanggal_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyetuju` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`id`, `nip`, `alasan`, `tujuan`, `lama`, `tanggal_cuti`, `penyetuju`, `jenis`, `status`, `pesan`, `created_at`, `updated_at`) VALUES
(5, '1122111', 'jalan-jalan', 'duri', 7, '21/Jan/2021,22/Jan/2021,25/Jan/2021,26/Jan/2021,27/Jan/2021,28/Jan/2021,29/Jan/2021', '01010271000465', 'Cuti Tahunan', 'tolak', '-', '2021-01-19 17:18:37', '2021-01-19 10:19:50'),
(6, '1122111', 'Melahirkan', 'Melahirkan', 30, '01/Jun/2021,-,01/Jul/2021', '010102710004659', 'Cuti Melahirkan', 'Selesai', NULL, '2021-01-19 10:19:03', '2021-01-19 10:21:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Kelompok Jabatan Fungsional', '2021-01-19 15:47:04', '2021-01-19 15:47:05'),
(2, 'Sub Bagian Umum', '2021-01-19 15:49:49', '2021-01-19 15:49:50'),
(3, 'Bidang Hubungan Industrial', '2021-01-19 15:50:22', '2021-01-19 15:50:23'),
(4, 'Seksi Syarat Kerja dan Organisasi', '2021-01-19 15:50:53', '2021-01-19 15:50:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2020_11_25_141458_users_migrate', 1),
(7, '2020_11_25_231528_cuti', 1),
(8, '2020_11_25_232159_sisa_cuti', 1),
(9, '2021_01_19_153915_jabatan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sisa_cuti`
--

CREATE TABLE `sisa_cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sisa_cuti`
--

INSERT INTO `sisa_cuti` (`id`, `nip`, `sisa`, `tahun`, `created_at`, `updated_at`) VALUES
(5, '1122111', 12, 2021, '2021-01-19 10:18:02', '2021-01-19 10:21:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bagian` int(11) DEFAULT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nip`, `password`, `nama`, `jabatan`, `bagian`, `golongan`, `jenis_kelamin`, `alamat`, `no_hp`, `status`, `created_at`, `updated_at`) VALUES
(1, '1165110046', '$2y$10$jwnBby6V538LOu2OimPxSOv8czVYERaDe5hhnve0JdIXC.sIBgJU6', 'Admin', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '01010271000465', '$2y$10$qciMNO2WJ7xYzo6hK39Yp.Axnx6dBwMnNWQui2lYvSuCYA1Mq6lWO', 'Yusuf Dwi Putra', 'Kasubag', NULL, 'I', 'lk', 'Jl. durian', '0823512412', NULL, '2021-01-19 09:32:02', '2021-01-19 09:32:02'),
(7, '010102710004659', '$2y$10$RS6hSmafQmPhDvUGYhyWpOVMrEcU6ZlR18BU9KQA0JKTzeRzNmbYi', 'Nindi', 'Sekretaris', NULL, 'I', 'pr', 'Jl. palu', '0823512412', NULL, '2021-01-19 09:38:46', '2021-01-19 09:38:46'),
(8, '1122111', '$2y$10$/KRyp.2kW4wlP1IWnwDGyOJUPijA8ONRJMR939byb0lJ1EKApAcYW', 'Gina', 'Anggota', 2, 'v', 'pr', NULL, NULL, 'Pegawai Tetap', '2021-01-19 10:18:02', '2021-01-19 10:18:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sisa_cuti`
--
ALTER TABLE `sisa_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `sisa_cuti`
--
ALTER TABLE `sisa_cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
