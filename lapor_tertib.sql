-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table lapor_tertib.schools
CREATE TABLE IF NOT EXISTS `schools` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `schools_name_unique` (`name`),
  UNIQUE KEY `schools_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.schools: ~3 rows (approximately)
INSERT INTO `schools` (`id`, `name`, `email`, `address`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 'Default School', 'default@example.com', 'Default Address', '0000000000', NULL, '2025-02-21 01:21:07', '2025-02-21 01:21:07'),
	(2, 'SMK Negeri 2 Surabaya', 'official@smkn2sby.sch', 'JL Tentara Genie Pelajara', '0315343708', 'profile_photos/4kFL9wdkDkwlBFbJJ4mW4v8S4ut985hJOZUfSmEf.jpg', '2025-02-21 01:21:07', '2025-02-21 01:34:02'),
	(3, 'SMK Negeri 1 Surabaya', 'official@smkn1sby.sch.id', 'JL SMEA', '0812345678', NULL, '2025-02-21 03:22:53', '2025-02-21 03:36:21');

-- Dumping structure for table lapor_tertib.academic_years
CREATE TABLE IF NOT EXISTS `academic_years` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `academic_years_school_id_foreign` (`school_id`),
  CONSTRAINT `academic_years_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.academic_years: ~6 rows (approximately)
INSERT INTO `academic_years` (`id`, `school_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, '2019-07-15', '2020-06-19', 'inactive', NULL, '2025-02-21 01:42:47'),
	(2, 2, '2020-07-15', '2021-06-19', 'inactive', '2025-02-21 01:42:47', '2025-02-21 01:43:09'),
	(3, 2, '2021-07-15', '2022-06-19', 'inactive', '2025-02-21 01:43:09', '2025-02-21 01:43:18'),
	(4, 2, '2022-07-15', '2023-06-19', 'inactive', '2025-02-21 01:43:18', '2025-02-21 02:21:48'),
	(5, 2, '2023-07-15', '2024-06-19', 'inactive', '2025-02-21 02:21:48', '2025-02-21 02:21:55'),
	(6, 2, '2024-07-15', '2025-06-19', 'active', '2025-02-21 02:21:55', '2025-02-21 02:21:55'),
	(7, 3, '2024-07-15', '2025-06-13', 'active', '2025-02-21 03:28:55', '2025-02-21 03:28:55');

-- Dumping structure for table lapor_tertib.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.cache: ~11 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('1b6453892473a467d07372d45eb05abc2031647a', 'i:1;', 1740105604),
	('1b6453892473a467d07372d45eb05abc2031647a:timer', 'i:1740105604;', 1740105604),
	('77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:2;', 1740105494),
	('77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1740105494;', 1740105494),
	('902ba3cda1883801594b6e1b452790cc53948fda', 'i:1;', 1740105239),
	('902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1740105239;', 1740105239),
	('ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'i:2;', 1740105673),
	('ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4:timer', 'i:1740105673;', 1740105673),
	('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1740125084),
	('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1740125084;', 1740125084),
	('fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 'i:1;', 1740108319),
	('fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f:timer', 'i:1740108319;', 1740108319);

-- Dumping structure for table lapor_tertib.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.cache_locks: ~0 rows (approximately)

-- Dumping structure for table lapor_tertib.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_school_id_foreign` (`school_id`),
  CONSTRAINT `departments_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.departments: ~5 rows (approximately)
INSERT INTO `departments` (`id`, `school_id`, `name`, `initial`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Rekayasa Perangkat Lunak', 'RPL', NULL, NULL),
	(2, 2, 'Teknik Jaringan Komputer dan Telekomunikasi', 'TJKT', NULL, NULL),
	(3, 2, 'Teknik Elektronika Industri', 'TEI', NULL, NULL),
	(4, 2, 'Teknik Instalasi Tenaga Listrik', 'TITL', NULL, NULL),
	(5, 2, 'Teknik Pemesinan', 'TPM', NULL, NULL),
	(6, 3, 'Rekayasa Perangkat Lunak', 'RPL', '2025-02-21 03:29:16', '2025-02-21 03:29:16');

-- Dumping structure for table lapor_tertib.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table lapor_tertib.grades
CREATE TABLE IF NOT EXISTS `grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grades_school_id_foreign` (`school_id`),
  CONSTRAINT `grades_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.grades: ~5 rows (approximately)
INSERT INTO `grades` (`id`, `school_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 2, '10', NULL, NULL),
	(2, 2, '11', NULL, NULL),
	(3, 2, '12', NULL, NULL),
	(4, 3, '10', '2025-02-21 03:29:28', '2025-02-21 03:29:28'),
	(5, 3, '11', '2025-02-21 03:29:30', '2025-02-21 03:29:30'),
	(6, 3, '12', '2025-02-21 03:29:33', '2025-02-21 03:29:33');

	-- Dumping structure for table lapor_tertib.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `grade_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_school_id_foreign` (`school_id`),
  KEY `classes_department_id_foreign` (`department_id`),
  KEY `classes_grade_id_foreign` (`grade_id`),
  CONSTRAINT `classes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `classes_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE,
  CONSTRAINT `classes_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.classes: ~45 rows (approximately)
INSERT INTO `classes` (`id`, `school_id`, `department_id`, `grade_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 1, '1', NULL, NULL),
	(2, 2, 2, 1, '1', NULL, NULL),
	(3, 2, 3, 1, '1', NULL, NULL),
	(4, 2, 4, 1, '1', NULL, NULL),
	(5, 2, 5, 1, '1', NULL, NULL),
	(6, 2, 1, 2, '1', NULL, NULL),
	(7, 2, 2, 2, '1', NULL, NULL),
	(8, 2, 3, 2, '1', NULL, NULL),
	(9, 2, 4, 2, '1', NULL, NULL),
	(10, 2, 5, 2, '1', NULL, NULL),
	(11, 2, 1, 3, '1', NULL, NULL),
	(12, 2, 2, 3, '1', NULL, NULL),
	(13, 2, 3, 3, '1', NULL, NULL),
	(14, 2, 4, 3, '1', NULL, NULL),
	(15, 2, 5, 3, '1', NULL, NULL),
	(16, 2, 1, 1, '2', NULL, NULL),
	(17, 2, 2, 1, '2', NULL, NULL),
	(18, 2, 3, 1, '2', NULL, NULL),
	(19, 2, 4, 1, '2', NULL, NULL),
	(20, 2, 5, 1, '2', NULL, NULL),
	(21, 2, 1, 2, '2', NULL, NULL),
	(22, 2, 2, 2, '2', NULL, NULL),
	(23, 2, 3, 2, '2', NULL, NULL),
	(24, 2, 4, 2, '2', NULL, NULL),
	(25, 2, 5, 2, '2', NULL, NULL),
	(26, 2, 1, 3, '2', NULL, NULL),
	(27, 2, 2, 3, '2', NULL, NULL),
	(28, 2, 3, 3, '2', NULL, NULL),
	(29, 2, 4, 3, '2', NULL, NULL),
	(30, 2, 5, 3, '2', NULL, NULL),
	(31, 2, 1, 1, '3', NULL, NULL),
	(32, 2, 2, 1, '3', NULL, NULL),
	(33, 2, 3, 1, '3', NULL, NULL),
	(34, 2, 4, 1, '3', NULL, NULL),
	(35, 2, 5, 1, '3', NULL, NULL),
	(36, 2, 1, 2, '3', NULL, NULL),
	(37, 2, 2, 2, '3', NULL, NULL),
	(38, 2, 3, 2, '3', NULL, NULL),
	(39, 2, 4, 2, '3', NULL, NULL),
	(40, 2, 5, 2, '3', NULL, NULL),
	(41, 2, 1, 3, '3', NULL, NULL),
	(42, 2, 2, 3, '3', NULL, NULL),
	(43, 2, 3, 3, '3', NULL, NULL),
	(44, 2, 4, 3, '3', NULL, NULL),
	(45, 2, 5, 3, '3', NULL, NULL),
	(46, 3, 6, 6, '1', '2025-02-21 03:29:48', '2025-02-21 03:29:48');

-- Dumping structure for table lapor_tertib.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.jobs: ~0 rows (approximately)

-- Dumping structure for table lapor_tertib.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.job_batches: ~0 rows (approximately)

-- Dumping structure for table lapor_tertib.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000001_create_cache_table', 1),
	(2, '0001_01_01_000002_create_jobs_table', 1),
	(3, '2025_01_08_210505_create_schools_table', 1),
	(4, '2025_01_08_211945_create_users_table', 1),
	(5, '2025_01_27_131012_create_academic', 1),
	(6, '2025_01_30_193553_create_academic_years_table', 1),
	(7, '2025_01_31_230765_create_students_table', 1),
	(8, '2025_01_31_231253_create_violation_categories_table', 1),
	(9, '2025_02_03_123129_create_violations_table', 1),
	(10, '2025_02_12_075245_create_punishments_table', 1),
	(11, '2025_02_12_075255_create_settings_table', 1);

-- Dumping structure for table lapor_tertib.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table lapor_tertib.punishments
CREATE TABLE IF NOT EXISTS `punishments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_point` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `punishments_school_id_foreign` (`school_id`),
  CONSTRAINT `punishments_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.punishments: ~7 rows (approximately)
INSERT INTO `punishments` (`id`, `school_id`, `name`, `min_point`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Surat Peringatan 1', 20, NULL, NULL),
	(2, 2, 'Surat Peringatan 2', 40, NULL, NULL),
	(3, 2, 'Skorsing 3 Hari', 60, NULL, NULL),
	(4, 2, 'Skorsing 7 Hari', 75, NULL, NULL),
	(5, 2, 'Skorsing 14 Hari', 100, NULL, NULL),
	(6, 2, 'Skorsing 10 Hari', 90, NULL, NULL),
	(7, 3, 'Surat Peringatan Pertama', 25, '2025-02-21 03:36:02', '2025-02-21 03:36:02');

-- Dumping structure for table lapor_tertib.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('3NfgUfHnI1poM3rY4qRvFhBSTrcsTMQgRB3IgYOR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY2Myb0Ezd0xRZ3ROSEx2NDFhY2pqTUREcUpPcDk0R0NVTktHcHMwZiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3ZlcmlmeS1lbWFpbCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE4OiJmbGFzaGVyOjplbnZlbG9wZXMiO2E6MDp7fX0=', 1740181679),
	('6LCCIpMsN0OvpkBvTyiQbCggF4TkhWhYKzcNCxEZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidm9BdTBpVkppUmlTUUhMS2U1TlFiS2trelU4ckRvTEZJZVB6eW9UaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2Rhc2hib2FyZC92aW9sYXRpb25zIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTg6ImZsYXNoZXI6OmVudmVsb3BlcyI7YTowOnt9fQ==', 1740181045);

-- Dumping structure for table lapor_tertib.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `message_template` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_school_id_foreign` (`school_id`),
  CONSTRAINT `settings_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.settings: ~0 rows (approximately)
INSERT INTO `settings` (`id`, `school_id`, `message_template`, `created_at`, `updated_at`) VALUES
	(1, 2, '["student_name","teacher_name","violation_name"]', NULL, NULL);

-- Dumping structure for table lapor_tertib.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `class_id` bigint unsigned NOT NULL,
  `academic_year_id` bigint unsigned NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `students_school_id_foreign` (`school_id`),
  KEY `students_class_id_foreign` (`class_id`),
  KEY `students_academic_year_id_foreign` (`academic_year_id`),
  CONSTRAINT `students_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.students: ~7 rows (approximately)
INSERT INTO `students` (`id`, `school_id`, `class_id`, `academic_year_id`, `nis`, `name`, `gender`, `photo`, `parent_phone`, `created_at`, `updated_at`) VALUES
	(11, 2, 11, 6, '202201', 'Diandra Cahya', 'L', NULL, '085198362542', '2025-02-21 01:47:38', '2025-02-21 02:21:55'),
	(14, 2, 16, 6, '202401', 'Renjiro Daffarel', 'L', NULL, '085198362542', '2025-02-21 02:22:20', '2025-02-21 02:22:20'),
	(15, 2, 8, 6, '202301', 'Putri Azzura', 'P', NULL, '085198362542', '2025-02-21 02:22:39', '2025-02-21 02:22:39'),
	(16, 2, 1, 6, '202402', 'Cantika Putri', 'P', NULL, '085198362542', '2025-02-21 02:23:08', '2025-02-21 02:23:08'),
	(17, 2, 37, 6, '202302', 'Atthallah Ramadhan', 'L', NULL, '085198362542', '2025-02-21 02:23:37', '2025-02-21 02:23:37'),
	(18, 2, 4, 6, '202403', 'Ardiansyah Fitrah', 'L', NULL, '085198362542', '2025-02-21 07:43:27', '2025-02-21 07:43:27'),
	(19, 2, 8, 6, '202405', 'Fian', 'L', NULL, '085198362542', '2025-02-21 07:51:25', '2025-02-21 07:51:25'),
	(20, 2, 2, 6, '202501', 'Raharjo', 'L', NULL, '085198362542', '2025-02-21 08:01:40', '2025-02-21 08:01:40');

-- Dumping structure for table lapor_tertib.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `role` enum('superadmin','admin','teacher') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teacher',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_school_id_foreign` (`school_id`),
  CONSTRAINT `users_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.users: ~8 rows (approximately)
INSERT INTO `users` (`id`, `school_id`, `role`, `name`, `email`, `phone`, `gender`, `photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'superadmin', 'Super Admin', 'superadmin@example.com', '1234567890', 'L', NULL, NULL, '$2y$12$TFdphw3YT/Y9OGjoNhOmpucqPhPLFDbbb5xbWyrlNvL0UhNz5J4xG', NULL, '2025-02-21 01:21:07', '2025-02-21 01:21:07'),
	(2, 2, 'admin', 'Pak Rizqi', 'rizqiii.dio@gmail.com', '0812345678', 'L', NULL, '2025-02-21 01:21:08', '$2y$12$/VGDqitbBUAHNkzNIjYreeszAQa3fPaB1vnj3u458sUu0sWpDTgVW', NULL, '2025-02-21 01:21:08', '2025-02-21 01:33:46'),
	(3, 2, 'teacher', 'Agus Winardi', 'agus@example.com', '0812345671', 'L', NULL, '2025-02-21 01:21:08', '$2y$12$3PJOg77ZYnSDWon1SdE0EuCZ5kbL/0JZOV3au5R.kvO/HB7i/Vu6u', NULL, '2025-02-21 01:21:08', '2025-02-21 02:34:38'),
	(4, 2, 'teacher', 'Eny Haryati', 'eny@example.com', '0812345672', 'P', NULL, '2025-02-21 01:21:08', '$2y$12$kmZgUHSl7nxjq8YGbcw65e9D57jG8vQbeyw/XIZEr.VvcrvhYdn7W', NULL, '2025-02-21 01:21:08', '2025-02-21 01:21:08'),
	(5, 2, 'teacher', 'Yudho Pramono', 'yudho@example.com', '0812345673', 'L', NULL, '2025-02-21 01:21:08', '$2y$12$WFuANs0X/UEcdYeD/XRyMuuC2lMEo/mp9hdhUP2SBU9OPQBcvlVQm', NULL, '2025-02-21 01:21:08', '2025-02-21 01:21:08'),
	(6, 2, 'teacher', 'Lestari Putri', 'lestari@example.com', '0812345674', 'P', NULL, '2025-02-21 01:21:08', '$2y$12$p6Tg8TAXVdZRd3QI12sq/.g0vF/vwFMEsf41VlJCTk1kDNvTXvwOW', NULL, '2025-02-21 01:21:08', '2025-02-21 01:21:08'),
	(7, 2, 'teacher', 'Hendro Purwoko', 'hendro@example.com', '0812345675', 'L', NULL, '2025-02-21 01:21:09', '$2y$12$ZPWUQsdP5DjXMrLCAPkI5.eCeyaVcxZmT965A8uXTJ0XSM5rR.KQi', NULL, '2025-02-21 01:21:09', '2025-02-21 01:21:09'),
	(8, 3, 'admin', 'Pak Budi', 'dev404.intern@gmail.com', '0812345678', NULL, NULL, '2025-02-21 03:24:19', '$2y$12$VTEM1n6NSnJ2pioT4GHwk.ar6CTMjBENAwpmQL56Frd/nVXnY9O3y', NULL, '2025-02-21 03:22:53', '2025-02-21 03:24:19'),
	(9, 3, 'teacher', 'Budi Susanto', 'budi@example.com', '0812345678', 'L', NULL, '2025-02-21 03:28:16', '$2y$12$gdsJJFiCmbHXw8o/Ik0UGOHmlIyAEPNr9kcTdIwEcr4IEru.R6fya', NULL, '2025-02-21 03:28:16', '2025-02-21 03:28:16');

-- Dumping structure for table lapor_tertib.violation_categories
CREATE TABLE IF NOT EXISTS `violation_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `violation_categories_school_id_foreign` (`school_id`),
  CONSTRAINT `violation_categories_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.violation_categories: ~8 rows (approximately)
INSERT INTO `violation_categories` (`id`, `school_id`, `name`, `point`, `description`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Terlambat', 10, 'Terlambat masuk sekolah', NULL, NULL),
	(2, 2, 'Atribut Tidak Lengkap', 5, 'Tidak menggunakan seragam lengkap', NULL, NULL),
	(3, 2, 'Meninggalkan Kelas saat Jam Pelajaran', 7, 'Meninggalkan kelas tanpa izin saat jam pelajaran', NULL, NULL),
	(4, 2, 'Rambut Panjang', 4, 'Rambut panjang melebihi telinga (bagi laki-laki)', NULL, NULL),
	(5, 2, 'Berjudi', 50, 'Berjudi di lingkungan sekolah', NULL, NULL),
	(6, 2, 'Merokok', 40, 'Merokok di lingkungan sekolah', NULL, NULL),
	(7, 2, 'Membawa Senjata Tajam', 75, 'Membawa senjata tajam ke sekolah', NULL, NULL),
	(8, 2, 'Menggunakan Narkoba', 200, 'Menggunakan narkoba di lingkungan sekolah', NULL, NULL),
	(9, 3, 'Datang Terlambat', 10, 'Datang tidak tepat waktu', '2025-02-21 03:35:25', '2025-02-21 03:35:25');

	-- Dumping structure for table lapor_tertib.violations
CREATE TABLE IF NOT EXISTS `violations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `student_id` bigint unsigned NOT NULL,
  `violation_category_id` bigint unsigned DEFAULT NULL,
  `teacher_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `violation_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `violations_school_id_foreign` (`school_id`),
  KEY `violations_teacher_id_foreign` (`teacher_id`),
  KEY `violations_student_id_foreign` (`student_id`),
  KEY `violations_violation_category_id_foreign` (`violation_category_id`),
  CONSTRAINT `violations_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  CONSTRAINT `violations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `violations_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `violations_violation_category_id_foreign` FOREIGN KEY (`violation_category_id`) REFERENCES `violation_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lapor_tertib.violations: ~17 rows (approximately)
INSERT INTO `violations` (`id`, `school_id`, `teacher_id`, `student_id`, `violation_category_id`, `teacher_name`, `violation_category_name`, `datetime`, `description`, `point`, `photo`, `created_at`, `updated_at`) VALUES
	(2, 2, 2, 11, 1, 'Pak Rizqi', 'Terlambat', '2025-02-10 06:48:00', 'Terlambat masuk sekolah', 10, 'violation_photos/UJj9Bcj246mOhL0RyWwl3lXQEDjBBylWK6O2CBKi.jpg', '2025-02-21 01:48:55', '2025-02-21 01:48:55'),
	(3, 2, 7, 16, 2, 'Hendro Purwoko', 'Atribut Tidak Lengkap', '2025-02-11 06:40:00', 'Tidak memakai sepatu', 5, 'violation_photos/mXZos0j8k5EeSfUTlSwyvK7hZk4mY5eSiPvy8mfP.jpg', '2025-02-21 02:33:03', '2025-02-21 02:33:03'),
	(4, 2, 3, 14, 1, 'Agus Winardi', 'Terlambat', '2025-02-12 07:36:00', 'Datang ke sekolah terlambat', 10, 'violation_photos/uJel849gS2NxmUFjma3rAG95YnT1zUjNSOrXXYT7.jpg', '2025-02-21 02:37:17', '2025-02-21 02:37:17'),
	(5, 2, 3, 15, 3, 'Agus Winardi', 'Meninggalkan Kelas saat Jam Pelajaran', '2025-02-12 10:37:00', 'Meninggalkan kelas ke kantin', 7, 'violation_photos/0sul5f1XQPdiaHCFY9DyyFfd4HUql9Uh3KmoMhgB.jpg', '2025-02-21 02:38:09', '2025-02-21 02:38:09'),
	(6, 2, 4, 17, 4, 'Eny Haryati', 'Rambut Panjang', '2025-02-14 09:38:00', 'Rambut panjang melebih batas', 4, 'violation_photos/VSKh6qgCsgGsXesiSMkwQQOtY2TRVMUdlg6rMeYl.jpg', '2025-02-21 02:39:07', '2025-02-21 02:39:07'),
	(7, 2, 5, 11, 2, 'Yudho Pramono', 'Atribut Tidak Lengkap', '2025-02-14 09:39:00', 'Tidak memakai hasduk', 5, 'violation_photos/pfBwkLwMsaDAH0dV9aWs9hQF0hFJpJHve1dw1Lep.jpg', '2025-02-21 02:40:17', '2025-02-21 02:40:17'),
	(8, 2, 5, 16, 1, 'Yudho Pramono', 'Terlambat', '2025-02-13 09:40:00', 'terlambat datang', 10, 'violation_photos/i4TLum9aW36hLTMlhTVnkCuWRloMFuI4c8ogXSId.jpg', '2025-02-21 02:41:12', '2025-02-21 02:41:12'),
	(9, 2, 2, 11, 1, 'Pak Rizqi', 'Terlambat', '2025-02-21 10:44:00', 'Datang terlambat tidak pada waktunya', 10, 'violation_photos/xaZcT364EA1166lIP2ktfmNZG7sEyWAWVoVV6GvB.jpg', '2025-02-21 03:45:01', '2025-02-21 03:45:01'),
	(10, 2, 2, 16, 1, 'Pak Rizqi', 'Terlambat', '2025-02-21 07:46:00', 'Ddatang terlambat tidak pada waktunya', 10, 'violation_photos/T5xTFvIsfNKWJx2FIXg0cZkFKk748gFS35WX2pXK.jpg', '2025-02-21 03:46:47', '2025-02-21 03:46:47'),
	(12, 2, 2, 17, 2, 'Pak Rizqi', 'Atribut Tidak Lengkap', '2025-01-21 14:07:00', 'Tidak menggunakan hasduk', 5, 'violation_photos/rTlrdQylGVqnhNbpiKtZURkJLueqKpNHlhfQ7SPr.jpg', '2025-02-21 07:07:49', '2025-02-21 07:07:49'),
	(15, 2, 2, 17, 2, 'Pak Rizqi', 'Atribut Tidak Lengkap', '2025-01-27 14:10:00', 'tidak menggunakan hasduk', 5, 'violation_photos/kW6LB1uy5INJRLQf1rRGKvAdBcUSEnHi4AjZZ1oE.jpg', '2025-02-21 07:11:13', '2025-02-21 07:11:13'),
	(16, 2, 2, 15, 3, 'Pak Rizqi', 'Meninggalkan Kelas saat Jam Pelajaran', '2025-01-28 14:13:00', 'Tidur di kelas', 7, 'violation_photos/QMhc6lgheZouZMmUj8RaqHsXQ2hTIFHl1OGT0STT.jpg', '2025-02-21 07:14:06', '2025-02-21 07:14:06'),
	(17, 2, 2, 11, 7, 'Pak Rizqi', 'Membawa Senjata Tajam', '2024-05-06 14:22:00', 'membawa celurit', 0, 'violation_photos/Nw0ebNQXimK3h6IDrxq6hEL3IJjWx6JjFM93BMPv.jpg', '2025-02-21 07:24:14', '2025-02-21 07:58:36'),
	(18, 2, 2, 18, 6, 'Pak Rizqi', 'Merokok', '2025-01-31 14:44:00', 'Merokok di lingkungan depan sekolah', 40, 'violation_photos/b5C6hTs366DMkwgK4hZU4lpIOpYCyPs4Oy35pC9x.jpg', '2025-02-21 07:44:43', '2025-02-21 07:44:43'),
	(19, 2, 2, 14, 4, 'Pak Rizqi', 'Rambut Panjang', '2025-02-04 14:45:00', 'Rambut panjang sekali', 4, 'violation_photos/lFvGXTVagUKbacv4ZnS4fJE1EfHQom3mZyTsm3Ce.jpg', '2025-02-21 07:46:00', '2025-02-21 07:46:00'),
	(20, 2, 2, 19, 1, 'Pak Rizqi', 'Terlambat', '2024-01-08 14:51:00', 'terlambat lama', 0, 'violation_photos/1ztFp4gXb1ch36wSVvWPNxmpCL4rH7N6fdhVC5ou.jpg', '2025-02-21 07:52:06', '2025-02-21 07:58:36'),
	(21, 2, 2, 11, 5, 'Pak Rizqi', 'Berjudi', '2024-04-03 14:56:00', 'melakukan judi game', 0, 'violation_photos/GInrC0ZRvbQs2FyHKrraHDNRmaOB7X9FTArjI5Ke.jpg', '2025-02-21 07:56:31', '2025-02-21 07:58:36'),
	(22, 2, 2, 19, 1, 'Pak Rizqi', 'Terlambat', '2025-02-12 15:03:00', 'terlambat', 10, 'violation_photos/XzdpVna9l2ePYwA7Uao7uO6A3wThUWHn4BHVhZDY.jpg', '2025-02-21 08:04:06', '2025-02-21 08:04:06');


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
