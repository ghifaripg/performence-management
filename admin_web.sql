-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2025 at 03:38 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` bigint UNSIGNED NOT NULL,
  `department_name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `department_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_username`) VALUES
(1, 'Admin', 'Admin'),
(2, 'IT & Management System Department', 'ITMS'),
(3, 'Finance Department', 'Finance'),
(4, 'Human Capital Department', 'HC');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `form_iku`
--

CREATE TABLE `form_iku` (
  `id` bigint UNSIGNED NOT NULL,
  `iku_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sasaran_id` int NOT NULL,
  `iku_atasan` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_iku_id` bigint UNSIGNED NOT NULL,
  `target` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_multi_point` tinyint(1) NOT NULL DEFAULT '0',
  `base` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stretch` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `satuan` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `polaritas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bobot` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_iku`
--

INSERT INTO `form_iku` (`id`, `iku_id`, `sasaran_id`, `iku_atasan`, `isi_iku_id`, `target`, `is_multi_point`, `base`, `stretch`, `satuan`, `polaritas`, `bobot`) VALUES
(15, 'IKUITMS_2025', 1, 'EBITDA', 21, NULL, 0, '10', '12', '%', 'maximize', 2.00),
(16, 'IKUITMS_2025', 2, NULL, 22, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(20, 'IKUITMS_2025', 2, NULL, 26, NULL, 0, NULL, NULL, NULL, 'maximize', NULL),
(21, 'IKUITMS_2025', 3, 'Test 1', 27, NULL, 0, NULL, NULL, NULL, 'maximize', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_kontrak_manajemen`
--

CREATE TABLE `form_kontrak_manajemen` (
  `id` bigint UNSIGNED NOT NULL,
  `sasaran_id` int NOT NULL,
  `kpi_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `milestone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `esgc` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `polaritas` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bobot` decimal(5,2) DEFAULT NULL,
  `du` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dk` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `do` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL
) ;

--
-- Dumping data for table `form_kontrak_manajemen`
--

INSERT INTO `form_kontrak_manajemen` (`id`, `sasaran_id`, `kpi_name`, `target`, `satuan`, `milestone`, `esgc`, `polaritas`, `bobot`, `du`, `dk`, `do`) VALUES
(1, 1, 'KPI 1', '1', '1', '1', 'S', 'minimize', 3.00, 'R', 'O', 'S'),
(2, 1, 'KPI 2', '2', '2', '2', 'S', 'minimize', 3.00, 'S', 'S', 'R'),
(3, 1, 'KPI 3', '3', '3', '3', 'C', 'minimize', 4.00, 'O', 'O', 'R'),
(4, 2, 'KPI 1', '1', '1', '1', 'G', 'minimize', 2.00, 'S', 'O', 'O'),
(5, 2, 'KPI 2', '2', '2', '2', 'G', 'maximize', 2.00, 'R', 'O', 'O'),
(6, 2, 'KPI 3', '3', '3', '3', 'C', 'maximize', 4.00, 'O', 'R', 'O'),
(7, 3, 'KPI 1', '1', '1', '1', 'C', 'minimize', 3.00, 'O', 'O', 'R'),
(8, 3, 'KPI 2', '2', '2', '2', 'S', 'maximize', 3.00, 'S', 'R', 'O'),
(9, 4, 'KPI 1', '1', '1', '1', 'E', 'maximize', 3.00, 'S', 'O', 'O'),
(10, 4, 'KPI 2', '2', '2', '2', 'G', 'minimize', 3.00, 'S', 'O', 'O'),
(11, 5, 'KPI 1', '1', '1', '1', 'E', 'maximize', 3.00, 'R', 'S', 'O'),
(12, 5, 'KPI 2', '2', '2', '2', 'C', 'maximize', 3.00, 'O', 'O', 'O'),
(13, 5, 'KPI 3', '3', '3', '3', 'G', 'minimize', 3.00, 'S', 'O', 'R');

-- --------------------------------------------------------

--
-- Table structure for table `iku`
--

CREATE TABLE `iku` (
  `iku_id` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `department_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` bigint NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iku`
--

INSERT INTO `iku` (`iku_id`, `department_name`, `tahun`, `created_by`) VALUES
('IKUAdmin_2025', 'Admin', 2025, 'Admin'),
('IKUITMS_2025', 'ITMS', 2025, 'ITMS User 1');

-- --------------------------------------------------------

--
-- Table structure for table `iku_point`
--

CREATE TABLE `iku_point` (
  `id` bigint UNSIGNED NOT NULL,
  `form_iku_id` bigint UNSIGNED NOT NULL,
  `point_name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `base` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stretch` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `satuan` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `polaritas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bobot` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iku_point`
--

INSERT INTO `iku_point` (`id`, `form_iku_id`, `point_name`, `base`, `stretch`, `satuan`, `polaritas`, `bobot`) VALUES
(9, 16, 'a. Corporate. - laporan profil risiko..', 'Juli & Des', NULL, 'bulan', 'minimize', 9.00),
(10, 16, 'b. Unit Kerja (identifikasi & mitigasi risisiko)', '100', NULL, '%', 'maximize', 2.00),
(11, 20, 'a. Kontrak Manajemen, Evaluasi Iku dan Monitoring', '100', NULL, '%', 'maximize', 10.00),
(12, 20, 'b. Pengumpulan Evaluasi IKU', '15', NULL, 'Tanggal', 'minimize', 3.00),
(13, 21, 'a. aaa', '2', NULL, '2', 'maximize', 3.00),
(14, 21, 'b. bbbb', '1', NULL, '%', 'maximize', 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `isi_iku`
--

CREATE TABLE `isi_iku` (
  `id` bigint UNSIGNED NOT NULL,
  `iku` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `proker` text COLLATE utf8mb4_general_ci NOT NULL,
  `pj` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `isi_iku`
--

INSERT INTO `isi_iku` (`id`, `iku`, `proker`, `pj`) VALUES
(21, 'Pengendalian Biaya Cost Center, Konsultan, Rapat, Consumable', 'Mengendalikan Biaya Cost Center, Biaya Konsultan.....', 'Manager'),
(22, '4. Pengelolaan Risiko:', '1. Koordinasi Identifikasi, Mitigasi, Risiko Coorporate dan Unit Kerja.\r\n2. Develop /Revisi....', 'Manager, Management System Group'),
(24, '2', '2', '2'),
(26, 'Pengelolaan Performance Management', '1. Koordinasi...\r\n2. Monitoring..\r\n3. Menyiapkan..', 'HR'),
(27, 'Test 1', '1. 13\r\n2. 13\r\n3. 13', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontrak_manajemen`
--

CREATE TABLE `kontrak_manajemen` (
  `kontrak_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `year` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak_manajemen`
--

INSERT INTO `kontrak_manajemen` (`kontrak_id`, `year`) VALUES
('KM_2024', 2024),
('KM_2025', 2025);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progres`
--

CREATE TABLE `progres` (
  `id` bigint NOT NULL,
  `iku_id` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('pending','accept','reject') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `need_discussion` tinyint(1) DEFAULT '0',
  `meeting_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progres`
--

INSERT INTO `progres` (`id`, `iku_id`, `user_id`, `status`, `need_discussion`, `meeting_date`, `notes`, `created_at`) VALUES
(11, 'IKUITMS_2025', 2, 'pending', NULL, '2025-02-19', NULL, '2025-02-19 07:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `sasaran_strategis`
--

CREATE TABLE `sasaran_strategis` (
  `id` int NOT NULL,
  `kontrak_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `position` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sasaran_strategis`
--

INSERT INTO `sasaran_strategis` (`id`, `kontrak_id`, `name`, `position`) VALUES
(1, 'KM_2025', 'Nilai Ekonomi dan Sosial Untuk Indonesia', 0),
(2, 'KM_2025', 'Inovasi Model Bisnis', 0),
(3, 'KM_2025', 'Kepemimpinan Teknologi', 0),
(4, 'KM_2025', 'Peningkatan Investasi', 0),
(5, 'KM_2025', 'Pengembangan Talenta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0sHRtztq6w6I6An2ZB2vUTnudLiMIsQp5mewsJQg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTTVMWFV6UUZXOGFTcmtmRGFKQUhadWFwQjdkREpBNkIzbHdwYkNONSI7czo3OiJzdWNjZXNzIjtzOjI0OiJMb2dnZWQgb3V0IHN1Y2Nlc3NmdWxseS4iO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YToxOntpOjA7czo3OiJzdWNjZXNzIjt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9nb3V0Ijt9fQ==', 1739948097),
('j6ikKDwzf8bknC5DxXRb98SKlsUOeH48fZO5twRk', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNG1wdTJieHgwQ25vaUtQeHgyanNvTnJkM2lsVThMOEZsTTl0YmhEciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pa3UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1739955209),
('Ni0mIq9cmYDKZLiB19Vl6GjFewONQ5gPppQciy3j', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicUx6TjRHS1paUzNFdjMyTDdEaWFMSDE1dmdidmpqMHRGUnY0aVNkOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lZGl0LWlrdS8yMT9fdG9rZW49cUx6TjRHS1paUzNFdjMyTDdEaWFMSDE1dmdidmpqMHRGUnY0aVNkOCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1740020803),
('pLk4BxERdPH1UY8rvCESw6AfydXigDxLc9VNnaSt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnVEV0hpVzI0TDF0dTZIM3l6NXhTeGVwTXJUek1nbDdWT0lEMUE3dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3JtLWlrdSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739948096);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `password`, `created_at`, `updated_at`, `username`, `department_id`) VALUES
(1, 'Admin', '$2y$12$DCGZEXK/TseJDQSfnJan.OVTT5Votu17jKSyaIOOVWrZly6GTTNGu', '2025-02-03 12:54:14', '2025-02-03 12:54:14', 'admin', 1),
(2, 'ITMS User 1', '$2y$12$WvmBiQXpNCRS.oSwpIcdnuvgwhkL1/2X07pdOfUqCdpNAqlZbVvSS', '2025-02-05 13:37:16', '2025-02-17 18:56:55', 'art', 2),
(3, 'Finance User 1\r\n', '$2y$12$oQk4e93Fs.FH3v/2lDPqtuYKu472fHFs1IYTMMk5tMdTDWxnVbIsG', '2025-02-10 14:28:52', '2025-02-10 14:28:52', 'patrick', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_iku`
--
ALTER TABLE `form_iku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iku_id` (`isi_iku_id`),
  ADD KEY `fk_iku_id` (`iku_id`),
  ADD KEY `fk_iku_sasaran_id` (`sasaran_id`);

--
-- Indexes for table `form_kontrak_manajemen`
--
ALTER TABLE `form_kontrak_manajemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sasaran_id` (`sasaran_id`);

--
-- Indexes for table `iku`
--
ALTER TABLE `iku`
  ADD PRIMARY KEY (`iku_id`),
  ADD KEY `iku_ibfk_1` (`created_by`);

--
-- Indexes for table `iku_point`
--
ALTER TABLE `iku_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_iku_id` (`form_iku_id`);

--
-- Indexes for table `isi_iku`
--
ALTER TABLE `isi_iku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrak_manajemen`
--
ALTER TABLE `kontrak_manajemen`
  ADD PRIMARY KEY (`kontrak_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progres_ibfk_1` (`iku_id`),
  ADD KEY `progres_ibfk_2` (`user_id`);

--
-- Indexes for table `sasaran_strategis`
--
ALTER TABLE `sasaran_strategis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kontrak_id` (`kontrak_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`nama`),
  ADD KEY `iku_department_ibfk_1` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_iku`
--
ALTER TABLE `form_iku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `form_kontrak_manajemen`
--
ALTER TABLE `form_kontrak_manajemen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iku_point`
--
ALTER TABLE `iku_point`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `isi_iku`
--
ALTER TABLE `isi_iku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `progres`
--
ALTER TABLE `progres`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sasaran_strategis`
--
ALTER TABLE `sasaran_strategis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_iku`
--
ALTER TABLE `form_iku`
  ADD CONSTRAINT `fk_iku_id` FOREIGN KEY (`iku_id`) REFERENCES `iku` (`iku_id`),
  ADD CONSTRAINT `fk_iku_sasaran_id` FOREIGN KEY (`sasaran_id`) REFERENCES `sasaran_strategis` (`id`),
  ADD CONSTRAINT `form_iku_ibfk_1` FOREIGN KEY (`isi_iku_id`) REFERENCES `isi_iku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `form_kontrak_manajemen`
--
ALTER TABLE `form_kontrak_manajemen`
  ADD CONSTRAINT `form_kontrak_manajemen_ibfk_1` FOREIGN KEY (`sasaran_id`) REFERENCES `sasaran_strategis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `iku`
--
ALTER TABLE `iku`
  ADD CONSTRAINT `iku_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`nama`) ON DELETE CASCADE;

--
-- Constraints for table `iku_point`
--
ALTER TABLE `iku_point`
  ADD CONSTRAINT `iku_point_ibfk_1` FOREIGN KEY (`form_iku_id`) REFERENCES `form_iku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `progres`
--
ALTER TABLE `progres`
  ADD CONSTRAINT `progres_ibfk_1` FOREIGN KEY (`iku_id`) REFERENCES `iku` (`iku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progres_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sasaran_strategis`
--
ALTER TABLE `sasaran_strategis`
  ADD CONSTRAINT `sasaran_strategis_ibfk_1` FOREIGN KEY (`kontrak_id`) REFERENCES `kontrak_manajemen` (`kontrak_id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `iku_department_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
