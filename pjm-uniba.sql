-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Feb 2024 pada 02.58
-- Versi server: 8.0.30
-- Versi PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjm-uniba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_divisis`
--

CREATE TABLE `anggota_divisis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_footers`
--

CREATE TABLE `content_footers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `g_map` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisis`
--

CREATE TABLE `divisis` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_divisi_id` bigint UNSIGNED NOT NULL,
  `anggota_divisi_id` bigint UNSIGNED NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_dokumen_id` bigint UNSIGNED NOT NULL,
  `nama_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_divisis`
--

CREATE TABLE `kategori_divisis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_dokumens`
--

CREATE TABLE `kategori_dokumens` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_media`
--

CREATE TABLE `kategori_media` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_personalias`
--

CREATE TABLE `kategori_personalias` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_personalias`
--

INSERT INTO `kategori_personalias` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Tugas Kepala PJM adalah:', '2024-01-29 20:21:44', '2024-01-29 20:21:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_struktur_organisasis`
--

CREATE TABLE `kategori_struktur_organisasis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_struktur_organisasis`
--

INSERT INTO `kategori_struktur_organisasis` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Divisi Akreditasi', '2024-01-29 20:12:23', '2024-01-29 20:12:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_tupoksi_pjms`
--

CREATE TABLE `kategori_tupoksi_pjms` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kategori_media_id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_12_20_034848_create_setting_web_profiles_table', 1),
(5, '2023_12_22_062430_create_profiles_table', 1),
(6, '2023_12_23_020109_create_kategori_personalias_table', 1),
(7, '2023_12_23_052709_create_petugas_personalias_table', 1),
(8, '2023_12_24_061131_create_personalias_table', 1),
(9, '2023_12_24_140253_create_kategori_tupoksi_pjms_table', 1),
(10, '2023_12_24_140736_create_tupoksi_pjms_table', 1),
(11, '2023_12_25_070802_create_kategori_struktur_organisasis_table', 1),
(12, '2023_12_25_070856_create_struktur_organisasis_table', 1),
(13, '2023_12_25_182035_create_visi_misi_tujuans_table', 1),
(14, '2023_12_26_041949_create_kategori_divisis_table', 1),
(15, '2023_12_26_042122_create_anggota_divisis_table', 1),
(16, '2023_12_27_041622_create_divisis_table', 1),
(17, '2023_12_27_075050_create_kategori_dokumens_table', 1),
(18, '2023_12_28_074659_create_dokumens_table', 1),
(19, '2024_01_25_032616_create_setting_halaman_utamas_table', 1),
(20, '2024_01_25_144344_create_kategori_media_table', 1),
(21, '2024_01_25_144550_create_media_table', 1),
(22, '2024_01_29_041223_create_content_footers_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personalias`
--

CREATE TABLE `personalias` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_personalia_id` bigint UNSIGNED NOT NULL,
  `personalia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personalias`
--

INSERT INTO `personalias` (`id`, `kategori_personalia_id`, `personalia`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mengkoordinasikan seluruh kegiatan PJM Undiksha, baik ke dalam maupun ke luar lembaga.', '2024-01-29 20:22:33', '2024-01-29 20:22:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas_personalias`
--

CREATE TABLE `petugas_personalias` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_anggota_personalia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petugas_personalias`
--

INSERT INTO `petugas_personalias` (`id`, `nama_anggota_personalia`, `pangkat`, `jurusan`, `email`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Rachmat Hikam', 'Ketua Personalia', 'Teknik Informatika', 'admin@gmail.com', '1706585081_bg_jasakirim.jpg', '2024-01-29 20:24:41', '2024-01-29 20:24:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `profile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profiles`
--

INSERT INTO `profiles` (`id`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'Sistem Penjaminan Mutu Uniba dilakukan dalam Bidang Akademik yang terdiri dari bidang Pendidikan, Penelitian, dan Pengabdian pada Masyarakat.', '2024-01-29 20:07:15', '2024-01-29 20:07:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_halaman_utamas`
--

CREATE TABLE `setting_halaman_utamas` (
  `id` bigint UNSIGNED NOT NULL,
  `gambar_slide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_web_profiles`
--

CREATE TABLE `setting_web_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_sidebar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_organisasis`
--

CREATE TABLE `struktur_organisasis` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_struktur_id` bigint UNSIGNED NOT NULL,
  `nama_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `struktur_organisasis`
--

INSERT INTO `struktur_organisasis` (`id`, `kategori_struktur_id`, `nama_anggota`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rachmat Hikam', 'Ketua Struktur Organisasi', '1706584364_bg_jasakirim.jpg', '2024-01-29 20:12:44', '2024-01-29 20:12:44'),
(2, 1, 'Prof.Dr. Kadek Suranata, S.Pd., M.Pd., Kons.', 'Staff IT', '1706584454_jasa_kirim.png', '2024-01-29 20:14:14', '2024-01-29 20:14:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tupoksi_pjms`
--

CREATE TABLE `tupoksi_pjms` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_tupoksi_id` bigint UNSIGNED NOT NULL,
  `isi_tupoksi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin PJM Uniba', 'admin_pjm@unibamadura.ac.id', NULL, '$2y$10$ynCGlh3o5XY3.P.788bb1u7SelpnbZWFNk8EC2yOD7EKxyO/AIS5m', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi_misi_tujuans`
--

CREATE TABLE `visi_misi_tujuans` (
  `id` bigint UNSIGNED NOT NULL,
  `visi_misi_tujuan` enum('visi','misi','tujuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `visi_misi_tujuans`
--

INSERT INTO `visi_misi_tujuans` (`id`, `visi_misi_tujuan`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'visi', 'Menjadi pusat layanan mutu yang unggul dalam mewujudkan budaya mutu berlandaskan falsafah Tri Hita Karana.', '2024-01-29 20:08:08', '2024-01-29 20:08:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota_divisis`
--
ALTER TABLE `anggota_divisis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `content_footers`
--
ALTER TABLE `content_footers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `divisis`
--
ALTER TABLE `divisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `divisis_kategori_divisi_id_foreign` (`kategori_divisi_id`),
  ADD KEY `divisis_anggota_divisi_id_foreign` (`anggota_divisi_id`);

--
-- Indeks untuk tabel `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumens_kategori_dokumen_id_foreign` (`kategori_dokumen_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kategori_divisis`
--
ALTER TABLE `kategori_divisis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_dokumens`
--
ALTER TABLE `kategori_dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_media`
--
ALTER TABLE `kategori_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_personalias`
--
ALTER TABLE `kategori_personalias`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_struktur_organisasis`
--
ALTER TABLE `kategori_struktur_organisasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_tupoksi_pjms`
--
ALTER TABLE `kategori_tupoksi_pjms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`),
  ADD KEY `media_kategori_media_id_foreign` (`kategori_media_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personalias`
--
ALTER TABLE `personalias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personalias_kategori_personalia_id_foreign` (`kategori_personalia_id`);

--
-- Indeks untuk tabel `petugas_personalias`
--
ALTER TABLE `petugas_personalias`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting_halaman_utamas`
--
ALTER TABLE `setting_halaman_utamas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting_web_profiles`
--
ALTER TABLE `setting_web_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `struktur_organisasis_kategori_struktur_id_foreign` (`kategori_struktur_id`);

--
-- Indeks untuk tabel `tupoksi_pjms`
--
ALTER TABLE `tupoksi_pjms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tupoksi_pjms_kategori_tupoksi_id_foreign` (`kategori_tupoksi_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `visi_misi_tujuans`
--
ALTER TABLE `visi_misi_tujuans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota_divisis`
--
ALTER TABLE `anggota_divisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `content_footers`
--
ALTER TABLE `content_footers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `divisis`
--
ALTER TABLE `divisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_divisis`
--
ALTER TABLE `kategori_divisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_dokumens`
--
ALTER TABLE `kategori_dokumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_media`
--
ALTER TABLE `kategori_media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_personalias`
--
ALTER TABLE `kategori_personalias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori_struktur_organisasis`
--
ALTER TABLE `kategori_struktur_organisasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori_tupoksi_pjms`
--
ALTER TABLE `kategori_tupoksi_pjms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `personalias`
--
ALTER TABLE `personalias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `petugas_personalias`
--
ALTER TABLE `petugas_personalias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `setting_halaman_utamas`
--
ALTER TABLE `setting_halaman_utamas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting_web_profiles`
--
ALTER TABLE `setting_web_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tupoksi_pjms`
--
ALTER TABLE `tupoksi_pjms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `visi_misi_tujuans`
--
ALTER TABLE `visi_misi_tujuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `divisis`
--
ALTER TABLE `divisis`
  ADD CONSTRAINT `divisis_anggota_divisi_id_foreign` FOREIGN KEY (`anggota_divisi_id`) REFERENCES `anggota_divisis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `divisis_kategori_divisi_id_foreign` FOREIGN KEY (`kategori_divisi_id`) REFERENCES `kategori_divisis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumens`
--
ALTER TABLE `dokumens`
  ADD CONSTRAINT `dokumens_kategori_dokumen_id_foreign` FOREIGN KEY (`kategori_dokumen_id`) REFERENCES `kategori_dokumens` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_kategori_media_id_foreign` FOREIGN KEY (`kategori_media_id`) REFERENCES `kategori_media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `personalias`
--
ALTER TABLE `personalias`
  ADD CONSTRAINT `personalias_kategori_personalia_id_foreign` FOREIGN KEY (`kategori_personalia_id`) REFERENCES `kategori_personalias` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  ADD CONSTRAINT `struktur_organisasis_kategori_struktur_id_foreign` FOREIGN KEY (`kategori_struktur_id`) REFERENCES `kategori_struktur_organisasis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tupoksi_pjms`
--
ALTER TABLE `tupoksi_pjms`
  ADD CONSTRAINT `tupoksi_pjms_kategori_tupoksi_id_foreign` FOREIGN KEY (`kategori_tupoksi_id`) REFERENCES `kategori_tupoksi_pjms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
