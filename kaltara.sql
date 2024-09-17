-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kaltara
CREATE DATABASE IF NOT EXISTS `kaltara` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kaltara`;

-- Dumping structure for table kaltara.association
CREATE TABLE IF NOT EXISTS `association` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formed_date` date NOT NULL,
  `association_type_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_number` int NOT NULL,
  `orgatization_structure_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `association_association_type_id_foreign` (`association_type_id`),
  KEY `association_district_id_foreign` (`district_id`),
  CONSTRAINT `association_association_type_id_foreign` FOREIGN KEY (`association_type_id`) REFERENCES `association_type` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `association_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.association: ~0 rows (approximately)
/*!40000 ALTER TABLE `association` DISABLE KEYS */;
/*!40000 ALTER TABLE `association` ENABLE KEYS */;

-- Dumping structure for table kaltara.association_type
CREATE TABLE IF NOT EXISTS `association_type` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.association_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `association_type` DISABLE KEYS */;
INSERT INTO `association_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Badan Usaha', '2022-01-09 00:31:00', '2022-01-09 00:31:01'),
	(2, 'Profesi', '2022-01-09 00:31:10', '2022-01-09 00:31:10');
/*!40000 ALTER TABLE `association_type` ENABLE KEYS */;

-- Dumping structure for table kaltara.business_entity
CREATE TABLE IF NOT EXISTS `business_entity` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `business_type_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `association_id` bigint unsigned NOT NULL,
  `certified_workers_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_entity_business_type_id_foreign` (`business_type_id`),
  KEY `business_entity_district_id_foreign` (`district_id`),
  KEY `business_entity_association_id_foreign` (`association_id`),
  CONSTRAINT `business_entity_association_id_foreign` FOREIGN KEY (`association_id`) REFERENCES `association` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `business_entity_business_type_id_foreign` FOREIGN KEY (`business_type_id`) REFERENCES `business_type` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `business_entity_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.business_entity: ~0 rows (approximately)
/*!40000 ALTER TABLE `business_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_entity` ENABLE KEYS */;

-- Dumping structure for table kaltara.business_type
CREATE TABLE IF NOT EXISTS `business_type` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.business_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `business_type` DISABLE KEYS */;
INSERT INTO `business_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Jasa Perencana Konstruksi', '2022-01-05 10:38:26', '2022-01-05 10:38:27'),
	(2, 'Jasa Pelaksana Konstruksi', '2022-01-05 10:38:36', '2022-01-05 10:38:36'),
	(3, 'Jasa Pengawas Konstruksi', '2022-01-05 10:38:44', '2022-01-05 10:38:44');
/*!40000 ALTER TABLE `business_type` ENABLE KEYS */;

-- Dumping structure for table kaltara.certification
CREATE TABLE IF NOT EXISTS `certification` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `registration_start_date` datetime NOT NULL,
  `registration_end_date` datetime NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.certification: ~0 rows (approximately)
/*!40000 ALTER TABLE `certification` DISABLE KEYS */;
/*!40000 ALTER TABLE `certification` ENABLE KEYS */;

-- Dumping structure for table kaltara.certification_participant
CREATE TABLE IF NOT EXISTS `certification_participant` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `certification_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_level_id` bigint unsigned NOT NULL,
  `ska_classification_id` bigint unsigned NOT NULL,
  `sub_classification_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_classification_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_id` bigint unsigned NOT NULL,
  `school_diploma_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_letter_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certification_participant_certification_id_foreign` (`certification_id`),
  KEY `certification_participant_jobs_id_foreign` (`jobs_id`),
  KEY `certification_participant_district_id_foreign` (`district_id`),
  KEY `certification_participant_education_level_id_foreign` (`education_level_id`),
  KEY `certification_participant_ska_classification_id_foreign` (`ska_classification_id`),
  KEY `certification_participant_qualification_id_foreign` (`qualification_id`),
  CONSTRAINT `certification_participant_certification_id_foreign` FOREIGN KEY (`certification_id`) REFERENCES `certification` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `certification_participant_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `certification_participant_education_level_id_foreign` FOREIGN KEY (`education_level_id`) REFERENCES `education_level` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `certification_participant_jobs_id_foreign` FOREIGN KEY (`jobs_id`) REFERENCES `jobs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `certification_participant_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualification` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `certification_participant_ska_classification_id_foreign` FOREIGN KEY (`ska_classification_id`) REFERENCES `ska_classification` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.certification_participant: ~0 rows (approximately)
/*!40000 ALTER TABLE `certification_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `certification_participant` ENABLE KEYS */;

-- Dumping structure for table kaltara.content
CREATE TABLE IF NOT EXISTS `content` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content_type_id` bigint unsigned NOT NULL,
  `content_status_id` bigint unsigned NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `published_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_content_type_id_foreign` (`content_type_id`),
  KEY `content_content_status_id_foreign` (`content_status_id`),
  CONSTRAINT `content_content_status_id_foreign` FOREIGN KEY (`content_status_id`) REFERENCES `content_status` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `content_content_type_id_foreign` FOREIGN KEY (`content_type_id`) REFERENCES `content_type` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.content: ~15 rows (approximately)
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` (`id`, `content_type_id`, `content_status_id`, `views`, `published_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 0, '2021-12-26 17:02:46', '2021-12-26 17:02:46', '2021-12-26 17:02:46'),
	(2, 1, 3, 0, '2021-12-26 17:05:13', '2021-12-26 17:05:13', '2021-12-26 17:05:13'),
	(3, 1, 3, 0, '2021-12-26 17:07:45', '2021-12-26 17:07:45', '2021-12-26 17:07:45'),
	(4, 1, 3, 0, '2021-12-26 17:09:05', '2021-12-26 17:09:05', '2021-12-26 18:37:01'),
	(5, 2, 3, 0, '2021-12-27 16:30:23', '2021-12-27 16:30:23', '2021-12-27 16:30:23'),
	(6, 3, 3, 0, '2021-12-27 16:30:23', '2021-12-27 16:30:23', '2021-12-27 16:30:23'),
	(7, 2, 3, 0, '2021-12-27 16:35:53', '2021-12-27 16:35:53', '2021-12-27 17:02:35'),
	(8, 3, 3, 0, '2021-12-27 16:35:53', '2021-12-27 16:35:53', '2021-12-27 16:35:53'),
	(9, 3, 3, 0, '2021-12-27 16:58:51', '2021-12-27 16:58:51', '2021-12-27 16:58:51'),
	(10, 3, 3, 0, '2021-12-27 16:58:51', '2021-12-27 16:58:51', '2021-12-27 16:58:51'),
	(11, 3, 3, 0, '2021-12-27 16:58:51', '2021-12-27 16:58:51', '2021-12-27 16:58:51'),
	(12, 2, 3, 0, '2021-12-28 03:14:33', '2021-12-28 03:14:33', '2021-12-28 03:14:33'),
	(13, 3, 3, 0, '2021-12-28 03:14:33', '2021-12-28 03:14:33', '2021-12-28 03:14:33'),
	(14, 1, 3, 0, '2021-12-28 03:45:06', '2021-12-28 03:45:06', '2021-12-28 03:45:06'),
	(15, 1, 3, 0, '2021-12-28 03:49:05', '2021-12-28 03:49:05', '2021-12-28 03:49:05');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;

-- Dumping structure for table kaltara.content_status
CREATE TABLE IF NOT EXISTS `content_status` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.content_status: ~4 rows (approximately)
/*!40000 ALTER TABLE `content_status` DISABLE KEYS */;
INSERT INTO `content_status` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Draft', '2021-12-26 23:27:38', '2021-12-26 23:27:38'),
	(2, 'Scheduled', '2021-12-26 23:29:02', '2021-12-26 23:29:02'),
	(3, 'Published', '2021-12-26 23:29:11', '2021-12-26 23:29:11'),
	(4, 'Deleted', '2021-12-27 02:12:36', '2021-12-27 02:12:36');
/*!40000 ALTER TABLE `content_status` ENABLE KEYS */;

-- Dumping structure for table kaltara.content_type
CREATE TABLE IF NOT EXISTS `content_type` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.content_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `content_type` DISABLE KEYS */;
INSERT INTO `content_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Post', '2021-12-26 23:29:29', '2021-12-26 23:29:29'),
	(2, 'Gallery', '2021-12-27 04:08:29', '2021-12-27 04:08:30'),
	(3, 'Photo', '2021-12-27 04:08:35', '2021-12-27 04:08:35');
/*!40000 ALTER TABLE `content_type` ENABLE KEYS */;

-- Dumping structure for table kaltara.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.district: ~5 rows (approximately)
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Kota Tarakan', '2021-12-31 02:09:29', '2021-12-31 02:09:30'),
	(2, 'Kabupaten Bulungan', '2021-12-31 02:09:41', '2021-12-31 02:09:41'),
	(3, 'Kabupaten Nunukan', '2021-12-31 02:09:48', '2021-12-31 02:09:48'),
	(4, 'Kabupaten Tana Tidun', '2021-12-31 02:10:02', '2021-12-31 02:10:02'),
	(5, 'Kabupaten Malinau', '2021-12-31 02:10:10', '2021-12-31 02:10:10');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;

-- Dumping structure for table kaltara.education_level
CREATE TABLE IF NOT EXISTS `education_level` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.education_level: ~8 rows (approximately)
/*!40000 ALTER TABLE `education_level` DISABLE KEYS */;
INSERT INTO `education_level` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'SD', '2021-12-31 02:10:21', '2021-12-31 02:10:21'),
	(2, 'SMP', '2021-12-31 02:10:24', '2021-12-31 02:10:25'),
	(3, 'SMA', '2021-12-31 02:10:27', '2021-12-31 02:10:28'),
	(4, 'D3', '2021-12-31 02:10:37', '2021-12-31 02:10:37'),
	(5, 'S1', '2021-12-31 02:10:45', '2021-12-31 02:10:45'),
	(6, 'S2', '2021-12-31 02:10:49', '2021-12-31 02:10:49'),
	(7, 'S3', '2021-12-31 02:10:52', '2021-12-31 02:10:52'),
	(8, 'Lainnya', '2021-12-31 02:11:02', '2021-12-31 02:11:02');
/*!40000 ALTER TABLE `education_level` ENABLE KEYS */;

-- Dumping structure for table kaltara.expert_data
CREATE TABLE IF NOT EXISTS `expert_data` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_level_id` bigint unsigned NOT NULL,
  `ska_classification_id` bigint unsigned NOT NULL,
  `sub_classification_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_classification_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expert_data_jobs_id_foreign` (`jobs_id`),
  KEY `expert_data_district_id_foreign` (`district_id`),
  KEY `expert_data_education_level_id_foreign` (`education_level_id`),
  KEY `expert_data_ska_classification_id_foreign` (`ska_classification_id`),
  KEY `expert_data_qualification_id_foreign` (`qualification_id`),
  CONSTRAINT `expert_data_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `expert_data_education_level_id_foreign` FOREIGN KEY (`education_level_id`) REFERENCES `education_level` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `expert_data_jobs_id_foreign` FOREIGN KEY (`jobs_id`) REFERENCES `jobs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `expert_data_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualification` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `expert_data_ska_classification_id_foreign` FOREIGN KEY (`ska_classification_id`) REFERENCES `ska_classification` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.expert_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `expert_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `expert_data` ENABLE KEYS */;

-- Dumping structure for table kaltara.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table kaltara.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_download` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table kaltara.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_content_id_foreign` (`content_id`),
  CONSTRAINT `gallery_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.gallery: ~3 rows (approximately)
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`id`, `content_id`, `title`, `description`, `cover_path`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Uji Kompetensi', 'Uji Kompetensi Tukang Bangunan Umum, Las, Alat Berat, dan Pembesian', 'upload/gallery/1/photo/61c9ea2072e88.jpg', '2021-12-27 16:30:23', '2021-12-27 17:00:34'),
	(2, 7, 'Sertifikasi', 'SERTIFIKASI KAB.NUNUKAN', 'upload/gallery/2/photo/61ca836bc12c8.jpg', '2021-12-27 16:35:53', '2021-12-28 03:24:27'),
	(3, 12, 'SIBIMA', 'SIBIMA UBT', 'upload/gallery/3/photo/61ca8119a89e7.jpg', '2021-12-28 03:14:33', '2021-12-28 03:14:33');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;

-- Dumping structure for table kaltara.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.jobs: ~10 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'ASN', '2021-12-31 02:11:18', '2021-12-31 02:11:19'),
	(2, 'Tenaga Ahli Konstruksi', '2021-12-31 02:11:27', '2021-12-31 02:11:27'),
	(3, 'Tenaga Terampil Konstruksi', '2021-12-31 02:11:42', '2021-12-31 02:11:42'),
	(4, 'Pengawas Pelaksana', '2021-12-31 02:11:57', '2021-12-31 02:11:57'),
	(5, 'Mahasiswa', '2021-12-31 02:12:04', '2021-12-31 02:12:04'),
	(6, 'ASN', '2021-12-31 02:12:08', '2021-12-31 02:12:08'),
	(7, 'Tenaga Pendidik', '2022-01-09 01:25:54', '2022-01-09 01:25:54'),
	(8, 'Profesional', '2022-01-09 01:26:01', '2022-01-09 01:26:01'),
	(9, 'Tenaga Kerja Konstruksi', '2022-01-09 01:26:09', '2022-01-09 01:26:09'),
	(10, 'Lainnya', '2022-01-09 01:26:31', '2022-01-09 01:26:31');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table kaltara.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.migrations: ~24 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2021_12_17_161108_create_permission_tables', 2),
	(6, '2021_12_17_161407_create_permission_group', 3),
	(7, '2018_08_08_100000_create_telescope_entries_table', 4),
	(10, '2021_12_17_170239_add_approval_user', 5),
	(12, '2021_12_21_033105_create_content', 6),
	(14, '2021_12_21_034126_create_post', 7),
	(15, '2021_12_26_073017_create_pages', 8),
	(17, '2021_12_26_081419_add_photo_user', 9),
	(18, '2021_12_26_172247_add_slug_post', 10),
	(19, '2021_12_26_200038_create_gallery', 11),
	(21, '2021_12_28_032547_create_post_category', 12),
	(22, '2021_12_28_154812_edit_page', 13),
	(23, '2021_12_28_171107_create_file', 14),
	(24, '2021_12_30_174846_create_certification', 15),
	(25, '2021_12_31_070717_update_certification', 16),
	(26, '2022_01_01_111018_edit_certificatino', 17),
	(28, '2022_01_02_032039_create_training', 18),
	(30, '2022_01_04_064412_create_business_entity', 19),
	(32, '2022_01_05_032055_create_association', 20),
	(33, '2022_01_08_173000_create_data_tenaga', 21),
	(34, '2022_01_08_180540_create_skilled_data', 22);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table kaltara.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table kaltara.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.model_has_roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\User', 1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table kaltara.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.pages: ~15 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `slug`, `body`, `created_at`, `updated_at`) VALUES
	(1, 'VIsi dan Misi', 'visi-dan-misi', NULL, '2021-12-28 15:38:14', '2021-12-28 17:00:39'),
	(2, 'Struktur Organisasi', 'struktur-organisasi', NULL, '2021-12-28 16:45:22', '2021-12-28 16:49:43'),
	(3, 'Tupoksi', 'tupoksi', NULL, '2021-12-28 16:46:11', '2021-12-28 16:46:11'),
	(4, 'Renstra', 'renstra', NULL, '2021-12-28 16:46:21', '2021-12-28 16:46:21'),
	(5, 'TPJK', 'tpjk', NULL, '2021-12-28 16:46:27', '2021-12-28 16:46:27'),
	(6, 'Peraturan', 'peraturan', NULL, '2021-12-28 16:50:13', '2021-12-28 17:29:52'),
	(7, 'NSPK', 'nspk', NULL, '2021-12-28 16:50:23', '2021-12-28 16:50:23'),
	(8, 'HSPK', 'hspk', NULL, '2021-12-28 16:50:30', '2021-12-28 16:50:30'),
	(9, 'KPDBU', 'kpdbu', NULL, '2021-12-28 16:50:46', '2021-12-28 17:03:18'),
	(10, 'Tertip Usaha & Perizinan', 'tertip-usaha-perizinan', NULL, '2021-12-28 16:52:42', '2021-12-28 16:52:42'),
	(11, 'Tertip Penyelenggaraan', 'tertip-penyelenggaraan', NULL, '2021-12-28 16:52:57', '2021-12-28 16:52:57'),
	(12, 'Tertip Pemanfaatan Jasa', 'tertip-pemanfaatan-jasa', NULL, '2021-12-28 16:53:10', '2021-12-28 16:53:10'),
	(13, 'Alokasi Anggaran', 'alokasi-anggaran', NULL, '2021-12-28 16:53:50', '2021-12-28 16:53:50'),
	(14, 'TPJK', 'tpjk', NULL, '2021-12-28 16:53:56', '2021-12-28 16:53:56'),
	(15, 'FJK', 'fjk', NULL, '2021-12-28 16:54:01', '2021-12-28 16:54:01');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table kaltara.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table kaltara.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission_group_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `permissions_permission_group_id_foreign` (`permission_group_id`),
  CONSTRAINT `permissions_permission_group_id_foreign` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.permissions: ~45 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `permission_group_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 2, 'View Post', 'web', '2021-12-26 15:01:16', '2021-12-26 15:01:16'),
	(2, 2, 'Create Post', 'web', '2021-12-26 16:07:50', '2021-12-26 16:07:50'),
	(3, 2, 'Edit Post', 'web', '2021-12-26 18:15:08', '2021-12-26 18:15:08'),
	(4, 3, 'View Gallery', 'web', '2021-12-27 04:04:42', '2021-12-27 04:04:42'),
	(5, 2, 'Delete Post', 'web', '2021-12-27 04:06:05', '2021-12-27 04:06:05'),
	(6, 3, 'Create Gallery', 'web', '2021-12-27 04:08:55', '2021-12-27 04:08:55'),
	(7, 3, 'Edit Gallery', 'web', '2021-12-27 16:41:13', '2021-12-27 16:41:13'),
	(8, 4, 'View Page', 'web', '2021-12-28 05:09:24', '2021-12-28 05:09:24'),
	(9, 4, 'Create Page', 'web', '2021-12-28 05:14:17', '2021-12-28 05:14:17'),
	(10, 4, 'Edit Page', 'web', '2021-12-28 15:40:55', '2021-12-28 15:40:55'),
	(11, 4, 'Delete Page', 'web', '2021-12-28 15:43:25', '2021-12-28 15:43:25'),
	(12, 5, 'View File', 'web', '2021-12-28 17:15:46', '2021-12-28 17:15:46'),
	(13, 5, 'Create File', 'web', '2021-12-28 17:15:51', '2021-12-28 17:15:51'),
	(14, 5, 'Edit File', 'web', '2021-12-28 17:15:59', '2021-12-28 17:15:59'),
	(15, 5, 'Delete File', 'web', '2021-12-28 17:16:17', '2021-12-28 17:16:17'),
	(16, 1, 'View User', 'web', '2021-12-30 20:01:22', '2021-12-30 20:01:22'),
	(17, 1, 'Create User', 'web', '2021-12-30 20:01:32', '2021-12-30 20:01:32'),
	(18, 1, 'Edit User', 'web', '2021-12-30 20:01:39', '2021-12-30 20:01:39'),
	(19, 1, 'Delete User', 'web', '2021-12-30 20:01:46', '2021-12-30 20:01:46'),
	(20, 6, 'View Role', 'web', '2021-12-31 02:42:02', '2021-12-31 02:42:02'),
	(21, 6, 'Create Role', 'web', '2021-12-31 02:42:08', '2021-12-31 02:42:08'),
	(22, 6, 'Edit Role', 'web', '2021-12-31 02:42:14', '2021-12-31 02:42:14'),
	(23, 6, 'Delete Role', 'web', '2021-12-31 02:42:19', '2021-12-31 02:42:19'),
	(24, 7, 'View Certification', 'web', '2021-12-31 08:17:14', '2021-12-31 08:17:14'),
	(25, 7, 'Create Certification', 'web', '2021-12-31 08:17:21', '2021-12-31 08:17:21'),
	(26, 7, 'Edit Certification', 'web', '2021-12-31 08:17:26', '2021-12-31 08:17:26'),
	(27, 7, 'Delete Certification', 'web', '2021-12-31 08:17:31', '2021-12-31 08:17:31'),
	(28, 7, 'View Participant Certification', 'web', '2021-12-31 08:17:49', '2021-12-31 08:17:49'),
	(29, 8, 'View Training', 'web', '2022-01-02 04:38:27', '2022-01-02 04:38:27'),
	(30, 8, 'Create Training', 'web', '2022-01-02 04:38:34', '2022-01-02 04:38:34'),
	(31, 8, 'Edit Training', 'web', '2022-01-02 04:38:38', '2022-01-02 04:38:38'),
	(32, 8, 'Delete Training', 'web', '2022-01-02 04:38:43', '2022-01-02 04:38:43'),
	(33, 8, 'View Participant Training', 'web', '2022-01-02 04:39:09', '2022-01-02 04:39:09'),
	(34, 9, 'View Business Entity', 'web', '2022-01-04 07:41:33', '2022-01-04 07:41:33'),
	(35, 9, 'Create Business Entity', 'web', '2022-01-04 07:41:42', '2022-01-04 07:41:42'),
	(36, 9, 'Edit Business Entity', 'web', '2022-01-04 07:41:48', '2022-01-04 07:41:48'),
	(37, 9, 'Delete Business Entity', 'web', '2022-01-04 07:41:57', '2022-01-04 07:41:57'),
	(38, 10, 'View Association', 'web', '2022-01-08 16:32:07', '2022-01-08 16:32:07'),
	(39, 10, 'Create Association', 'web', '2022-01-08 16:32:12', '2022-01-08 16:32:12'),
	(40, 10, 'Edit Association', 'web', '2022-01-08 16:32:17', '2022-01-08 16:32:17'),
	(41, 10, 'Delete Association', 'web', '2022-01-08 16:32:24', '2022-01-08 16:32:24'),
	(42, 11, 'View ES Data', 'web', '2022-01-08 17:36:13', '2022-01-08 17:36:13'),
	(43, 11, 'Create ES Data', 'web', '2022-01-08 17:36:28', '2022-01-08 17:36:28'),
	(44, 11, 'Edit ES Data', 'web', '2022-01-08 17:36:33', '2022-01-08 17:36:33'),
	(45, 11, 'Delete ES Data', 'web', '2022-01-08 17:36:38', '2022-01-08 17:36:38');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table kaltara.permission_group
CREATE TABLE IF NOT EXISTS `permission_group` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.permission_group: ~11 rows (approximately)
/*!40000 ALTER TABLE `permission_group` DISABLE KEYS */;
INSERT INTO `permission_group` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'User Management', '2021-12-17 16:57:55', '2021-12-17 16:57:55'),
	(2, 'Post', '2021-12-26 14:48:55', '2021-12-26 14:48:55'),
	(3, 'Gallery', '2021-12-27 04:03:20', '2021-12-27 04:03:20'),
	(4, 'Page', '2021-12-28 05:09:12', '2021-12-28 05:09:12'),
	(5, 'File', '2021-12-28 17:15:31', '2021-12-28 17:15:31'),
	(6, 'Role', '2021-12-31 02:41:48', '2021-12-31 02:41:48'),
	(7, 'Certification', '2021-12-31 08:16:58', '2021-12-31 08:16:58'),
	(8, 'Training', '2022-01-02 04:38:12', '2022-01-02 04:38:12'),
	(9, 'Business Entity', '2022-01-04 07:41:12', '2022-01-04 07:41:12'),
	(10, 'Association', '2022-01-08 16:31:57', '2022-01-08 16:31:57'),
	(11, 'Expert Skilled Data', '2022-01-08 17:35:52', '2022-01-08 17:35:52');
/*!40000 ALTER TABLE `permission_group` ENABLE KEYS */;

-- Dumping structure for table kaltara.photo
CREATE TABLE IF NOT EXISTS `photo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint unsigned NOT NULL,
  `gallery_id` bigint unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_content_id_foreign` (`content_id`),
  KEY `photo_gallery_id_foreign` (`gallery_id`),
  CONSTRAINT `photo_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `photo_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.photo: ~6 rows (approximately)
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` (`id`, `content_id`, `gallery_id`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, NULL, 'upload/gallery/1/photo/61c9ea2072e88.jpg', '2021-12-27 16:30:23', '2021-12-27 16:30:24'),
	(2, 8, 2, NULL, 'upload/gallery/2/photo/61ca836bc12c8.jpg', '2021-12-27 16:35:53', '2021-12-28 03:24:27'),
	(3, 9, 1, NULL, 'upload/gallery/1/photo/61c9f0cb91250.jpg', '2021-12-27 16:58:51', '2021-12-27 16:58:51'),
	(4, 10, 1, NULL, 'upload/gallery/1/photo/61c9f0cb9736a.jpg', '2021-12-27 16:58:51', '2021-12-27 16:58:51'),
	(5, 11, 1, NULL, 'upload/gallery/1/photo/61c9f0cbc80ce.jpg', '2021-12-27 16:58:51', '2021-12-27 16:58:51'),
	(6, 13, 3, NULL, 'upload/gallery/3/photo/61ca8119a89e7.jpg', '2021-12-28 03:14:33', '2021-12-28 03:14:33');
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;

-- Dumping structure for table kaltara.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint unsigned NOT NULL,
  `post_category_id` bigint unsigned DEFAULT NULL,
  `creator_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `featured_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_content_id_foreign` (`content_id`),
  KEY `post_creator_id_foreign` (`creator_id`),
  KEY `post_post_category_id_foreign` (`post_category_id`),
  CONSTRAINT `post_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `post_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `post_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `post_category` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.post: ~6 rows (approximately)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `content_id`, `post_category_id`, `creator_id`, `title`, `slug`, `excerpt`, `body`, `featured_image_path`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 'Sosialisasi Distance Learning SIBIMA dan Sertifikasi Tenaga Terampil Konstruksi Bidang Elektrikal Universitas Borneo Tarakan', 'sosialisasi-distance-learning-sibima-dan-sertifikasi-tenaga-terampil-konstruksi-bidang-elektrikal-universitas-borneo-tarakan', NULL, '<p>Pada tanggal 11 April 2019 telah dilaksanakan Sosialisasi Distance Learning SIBIMA (Sistem Informasi Belajar intensif Mandiri) Bidang Konstruksi dan Sertifikasi Tenaga Terampil Bidang Elektrikal di Fakultas Teknik Universitas Borneo Tarakan yang merupakan hasil kerjasama antara Dinas PUPR-PERKIM, UBT dan Balai Penerapan Teknologi Konstruksi Kementrian PUPR. Kegiatan ini diikuti kurang lebih 400 peserta yang berasal dari mahasiswa dan alumni UBT serta peserta umum yang memenuhi persyaratan yang telah ditentukan.</p>\r\n<p>Kegiatan Sosialisasi Distance Learning SIBIMA (Sistem Informasi Belajar intensif Mandiri) Bidang Konstruksi dan Sertifikasi Tenaga Terampil Bidang Elektrikal dilakukan bersamaan dengan tempat yang berbeda. Kegiatan Sertifikasi Tenaga Terampil Bidang Elektrikal melibatkan seluruh mahasiswa jurusan Teknik elektro di Universitas Borneo Tarakan. Seluruh peserta melakukan uji praktek dengan membuat rangkaian listrik sesuai dengan soal uji yang telah ditentukan oleh Assesor. Tidak hanya melakukan uji praktek saja, assessor juga melakukan verifikasi data dan wawancara kepada seluruh peserta sebagai salah satu persyaratan sertifikasi kompetensi. Kegiatan sertifikasi tenaga terampil ini masih akan berlanjut sampai hari Jumat tanggal 12 April 2019.</p>\r\n<p>Distance Learning SIBIMA Bidang Konstruksi merupakan program yang dikelola oleh Balai Penerapan Teknologi Konstruksi, Direktorat Jendral Bina Konstruksi, Kementrian PUPR. Yang dimaksudkan dengan &nbsp;Distance Learning adalah pelatihan jarak jauh menggunakan sistem yang beralamatkan pada sibima.pu.go.id. Dengan adanya pelatihan jarak jauh ini maka akan memberikan kemudahan dari pelaksanaan pelatihan yang lebih efektif dan efisien baik dari segi dana dan waktu. Kegiatan pelatihan akan dimulai dengan sosialisasi dan registrasi peserta untuk mendapatkan akses kedalam kelas online, sisanya peserta akan belajar mandiri dalam jangka waktu yang telah ditentukan yaitu 30 hari. Sertifikat pelatihan langsung diunduh oleh peserta yang berhasil menyelesaikan pelatihan dalam kurun waktu tersebut.</p>\r\n<p>Sama halnya dengan yang telah dilakukan di UNIKALTAR, program yang dilakukan oleh Bidang Jasa Konstruksi Dinas PUPR-PERKIM Provinsi Kalimantan Utara ini juga dilanjutkan dengan fasilitas untuk Sertifikasi Tenaga Ahli (SKA) gratis bagi peserta DL-SIBIMA yang dinyatakan lulus dan mendapatkan sertifikat. Pada tahun 2019 ini Bidang Jasa Konstruksi Dinas PUPR-PERKIM fokus pada target pelajar/ mahasiswa dalam percepatan sertifikasi tenaga konstruksi dengan tujuan peningkatan penyerapan tenaga kerja konstruksi lokal di Provinsi Kalimantan Utara.</p>', '/uploads/post/2021/12/26/IMG_3391.jpg', '2021-12-26 17:02:46', '2021-12-26 18:26:40'),
	(2, 2, 1, 1, 'Surat Edaran Gubernur Kalimantan Utara tentang Kewajiban Tenaga Kerja', 'surat-edaran-gubernur-kalimantan-utara-tentang-kewajiban-tenaga-kerja', NULL, '<p><img src="http://kaltara.test/uploads/post/2021/12/26/download.jpg" alt="" width="1654" height="2337" /></p>', '/uploads/post/2021/12/26/download.jpg', '2021-12-26 17:05:13', '2021-12-26 18:28:21'),
	(3, 3, 1, 1, 'Sertifikasi Tenaga Terampil Konstruksi Kabupaten Nunukan', 'sertifikasi-tenaga-terampil-konstruksi-kabupaten-nunukan', NULL, '<p style="font-weight: 400;">Pada tanggal 2 Mei 2019 telah dilaksanakan Sertifikasi Tenaga Terampil Konstruksi Bidang Sipil, Arsitektur, Mekanikal dan Elektrikal di Politeknik Negeri Nunukan yang diikuti kurang lebih 210 peserta yang berasal dari mahasiswa, alumni dan masyarakat umum. Kegiatan ini merupakan hasil kerjasama antara Dinas PUPR-PERKIM Provinsi Kalimantan Utara, DInas PUPRPKP Kabupaten Nunukan, Politeknik Negeri Nunukan dan Balai Jasa Konstruksi Wilayah V Banjarmasin.</p>\r\n<p style="font-weight: 400;">Kegiatan sertifikasi ini menghasilkan beberapa produk sesuai dengan masing-masing bidang sertifikasi. Hasil dari uji kompetensi bidang mekanikal dengan sub klasifikasi pekerjaan las diuji untuk membuat meja, kursi, rak helm. Untuk bidang arsitektur dengan sub klasifikasi pekerjaan batu, kayu dan besi diuji dengan membuat pos jaga dan pemasangan keramik masjid Darussalam yang berada didepan Politeknik Negeri Nunukan. Sedangkan bidang elektrikal diuji dengan membuat rangkaian listrik sesuai dengan soal uji yang telah ditentukan oleh assessor. Berbeda dengan ketiga bidang lainnya, Bidang Sipil melakukan uji sertifikasi dengan subklasifikasi Pengawas Jalan dan Pelaksana Jalan yang merupakan peserta dari PTT Dinas PUPRPKP, KOTAKU dan peserta umum.</p>\r\n<p style="font-weight: 400;">Berdasarkan sambutan Ketua PDD Politeknik Negeri Nunukan, Bapak Arka Viddy, Phd. &ldquo;saya sangat senang dengan adanya kegiatan ini, selain sebagai wadah untuk menguji kemampuan juga sekaligus mendapatkan sertifikat yang nantinya menjadi bukti kompetensi untuk bekerja&rdquo;. Dilanjutkan dengan pembukaan kegiatan oleh Kepala Dinas PUPRPKP Kabupaten Nunukan Ir. Sufyang, mewakili Bupati Nunukan.</p>\r\n<p style="font-weight: 400;">Tahun 2019 ini bidang Jasa Konstruksi baik di tingkat provinsi maupun kabupaten/ kota bekerjasama untuk terus meningkatkan eksistensinya dengan tujuan terciptanya kerjasama yang baik antara pemerintah dan seluruh tenaga kerja konstruksi untuk melaksanakan percepatan sertifikasi tenaga kerja konstruksi di Provinsi Kalimantan Utara. Dengan adanya kegiatan sertifikasi tenaga terampil konstruksi ini diharapkan dapat memicu kesadaran masyarakat konstruksi mengenai pentingnya sertifikasi tenaga kerja.</p>', '/uploads/post/2021/12/26/IMG_3742.jpg', '2021-12-26 17:07:45', '2021-12-26 18:28:26'),
	(4, 4, 1, 1, 'Sosialisasi Distance Learning SIBIMA UNIKALTAR', 'sosialisasi-distance-learning-sibima-unikaltar', NULL, '<p style="font-weight: 400;">Pada tanggal 19 Maret 2019 telah dilaksanakan&nbsp;<strong>Sosialisasi&nbsp;<em>Distance Learning</em>&nbsp;SIBIMA (Sistem Informasi Belajar intensif Mandiri)</strong>&nbsp;Bidang Konstruksi di Auditorium UNIKALTAR yang merupakan hasil kerjasama antara Dinas PUPR-PERKIM dan UNIKALTAR. Kegiatan ini diikuti oleh 137 peserta yang berasal dari mahasiswa dan alumni UNIKALTAR serta peserta umum yang memenuhi persyaratan yang telah ditentukan.</p>\r\n<p style="font-weight: 400;"><em>Distance Learning</em>&nbsp;SIBIMA Bidang Konstruksi merupakan program yang dikelola oleh Balai Penerapan Teknologi Konstruksi, Direktorat Jendral Bina Konstruksi, Kementrian PUPR. Yang dimaksudkan dengan&nbsp;&nbsp;<em>Distance Learning&nbsp;</em>adalah pelatihan jarak jauh menggunakan sistem yang beralamatkan pada sibima.pu.go.id. Dengan adanya pelatihan jarak jauh ini maka akan memberikan kemudahan dari pelaksanaan pelatihan yang lebih efektif dan efisien baik dari segi dana dan waktu. Kegiatan pelatihan akan dimulai dengan sosialisasi dan registrasi peserta untuk mendapatkan akses kedalam kelas online, sisanya peserta akan belajar mandiri dalam jangka waktu yang telah ditentukan yaitu 30 hari. Sertifikat pelatihan langsung diunduh oleh peserta yang berhasil menyelesaikan pelatihan dalam kurun waktu tersebut.</p>\r\n<p style="font-weight: 400;">Pelaksanaan DL-SIBIMA melibatkan banyak pihak, antara lain LPJK, Perguruan tinggi, Asosiasi dan Pemerintah Provinsi. Peserta yang lulus DL-SIBIMA akan mendapatkan Sertifikat Pelatihan SIBIMA dengan waktu pembelajaran setara 50 jam. Manfaat utama Sertifikat Pelatihan DL-SIBIMA bagi masyarakat antara lain Sertifikat DL-SIBIMA memiliki nilai 25 poin SKPK yang berguna untuk CPD bagi pemegang SKA dan dapat digunakan untuk mengikuti uji kompetensi Ahli Muda tanpa harus magang 1 tahun bagi&nbsp;<em>freshgraduate.</em></p>\r\n<p style="font-weight: 400;">Program yang dilakukan oleh Bidang Jasa Konstruksi Dinas PUPR-PERKIM Provinsi Kalimantan Utara ini tidak sebatas pelatihan jarak jauh itu saja. Namun dilanjutkan dengan fasilitas untuk Sertifikasi Tenaga Ahli (SKA) gratis bagi peserta DL-SIBIMA yang dinyatakan lulus dan mendapatkan sertifikat. Tujuan utama dari DL-SIBIMA dan Sertifikasi Gratis ini tidak lain adalah untuk menggenjot percepatan sertifikasi tenaga kerja konstruksi di Provinsi Kalimantan Utara yang pada tahun 2019 ini Bidang Jasa Konstruksi memiliki target sebanyak 700 tenaga kerja konstruksi yang tersertifikasi.</p>', '/uploads/post/2021/12/26/IMG-20190320-WA0006.jpg', '2021-12-26 17:09:05', '2021-12-26 18:28:32'),
	(5, 14, 2, 1, 'Pengumpulan Kekurangan Berkas Peserta Sertifikasi Tenaga Ahli Program DL-SIBIMA UNIKALTAR', 'pengumpulan-kekurangan-berkas-peserta-sertifikasi-tenaga-ahli-program-dl-sibima-unikaltar', NULL, '<p><img src="http://kaltara.test/uploads/post/2021/12/28/download.png" alt="" width="680" height="623" /></p>\r\n<p>Bagi peserta yang namanya tercantum dibawah harap segera melengkapi berkas&nbsp;<strong>paling lambat Senin, 13 Mei 2019.</strong></p>\r\n<p>Alamat Pengumpulan : Ruangan Bidang Jasa Konstruksi, Dinas PUPR-PERKIM Lantai 3, Jalan Agathis, Tanjung Selor</p>', '', '2021-12-28 03:45:06', '2021-12-28 03:45:06'),
	(6, 15, 2, 1, 'Pembekalan untuk admin pengguna aplikasi SIMJAKIDA PUPR Kalimantan Utara dalam melakukan entry data', 'pembekalan-untuk-admin-pengguna-aplikasi-simjakida-pupr-kalimantan-utara-dalam-melakukan-entry-data', NULL, '<p style="text-align: center;"><span style="font-size: 24pt;"><strong>SIMJAKIDA training akan dilaksanakan pada hari jumat tgl 20 okt 2017</strong></span></p>', '', '2021-12-28 03:49:05', '2021-12-28 03:49:05');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Dumping structure for table kaltara.post_category
CREATE TABLE IF NOT EXISTS `post_category` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.post_category: ~2 rows (approximately)
/*!40000 ALTER TABLE `post_category` DISABLE KEYS */;
INSERT INTO `post_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'News', '2021-12-28 11:31:09', '2021-12-28 11:31:09'),
	(2, 'Announcement', '2021-12-28 11:31:14', '2021-12-28 11:31:14');
/*!40000 ALTER TABLE `post_category` ENABLE KEYS */;

-- Dumping structure for table kaltara.qualification
CREATE TABLE IF NOT EXISTS `qualification` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.qualification: ~6 rows (approximately)
/*!40000 ALTER TABLE `qualification` DISABLE KEYS */;
INSERT INTO `qualification` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Muda', '2021-12-31 02:12:30', '2021-12-31 02:12:31'),
	(2, 'Madya', '2021-12-31 02:12:34', '2021-12-31 02:12:34'),
	(3, 'Utama', '2021-12-31 02:12:38', '2021-12-31 02:12:38'),
	(4, 'Tingkat I', '2022-01-09 01:29:03', '2022-01-09 01:29:04'),
	(5, 'Tingkat II', '2022-01-09 01:29:11', '2022-01-09 01:29:12'),
	(6, 'Tingkat III', '2022-01-09 01:29:16', '2022-01-09 01:29:16');
/*!40000 ALTER TABLE `qualification` ENABLE KEYS */;

-- Dumping structure for table kaltara.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.roles: ~4 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'web', '2021-12-17 16:53:37', '2021-12-17 16:53:37'),
	(2, 'Adminprov', 'web', '2021-12-17 16:58:24', '2021-12-17 16:58:24'),
	(3, 'Admin Kab/Kota', 'web', '2021-12-17 16:59:51', '2021-12-17 16:59:51'),
	(4, 'Audit', 'web', '2021-12-17 17:00:19', '2021-12-17 17:00:19');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table kaltara.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.role_has_permissions: ~6 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(22, 2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table kaltara.ska_classification
CREATE TABLE IF NOT EXISTS `ska_classification` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.ska_classification: ~6 rows (approximately)
/*!40000 ALTER TABLE `ska_classification` DISABLE KEYS */;
INSERT INTO `ska_classification` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Arsitektur', '2021-12-31 02:12:52', '2021-12-31 02:12:52'),
	(2, 'Sipil', '2021-12-31 02:13:02', '2021-12-31 02:13:03'),
	(3, 'Mekanikal', '2021-12-31 02:13:07', '2021-12-31 02:13:07'),
	(4, 'Elektrikal', '2021-12-31 02:13:15', '2021-12-31 02:13:15'),
	(5, 'Tata Lingkungan', '2021-12-31 02:13:24', '2021-12-31 02:13:24'),
	(6, 'Manajemen Pelaksana', '2021-12-31 02:13:37', '2021-12-31 02:13:38');
/*!40000 ALTER TABLE `ska_classification` ENABLE KEYS */;

-- Dumping structure for table kaltara.skilled_data
CREATE TABLE IF NOT EXISTS `skilled_data` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_level_id` bigint unsigned NOT NULL,
  `skt_classification_id` bigint unsigned NOT NULL,
  `sub_classification_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_classification_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skilled_data_jobs_id_foreign` (`jobs_id`),
  KEY `skilled_data_district_id_foreign` (`district_id`),
  KEY `skilled_data_education_level_id_foreign` (`education_level_id`),
  KEY `skilled_data_skt_classification_id_foreign` (`skt_classification_id`),
  KEY `skilled_data_qualification_id_foreign` (`qualification_id`),
  CONSTRAINT `skilled_data_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `skilled_data_education_level_id_foreign` FOREIGN KEY (`education_level_id`) REFERENCES `education_level` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `skilled_data_jobs_id_foreign` FOREIGN KEY (`jobs_id`) REFERENCES `jobs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `skilled_data_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualification` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `skilled_data_skt_classification_id_foreign` FOREIGN KEY (`skt_classification_id`) REFERENCES `skt_classification` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.skilled_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `skilled_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `skilled_data` ENABLE KEYS */;

-- Dumping structure for table kaltara.skt_classification
CREATE TABLE IF NOT EXISTS `skt_classification` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.skt_classification: ~6 rows (approximately)
/*!40000 ALTER TABLE `skt_classification` DISABLE KEYS */;
INSERT INTO `skt_classification` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Arsitektur', '2022-01-09 02:47:41', '2022-01-09 02:47:41'),
	(2, 'Sipil', '2022-01-09 02:47:46', '2022-01-09 02:47:46'),
	(3, 'Mekanikal', '2022-01-09 02:47:51', '2022-01-09 02:47:51'),
	(4, 'Elektrikal', '2022-01-09 02:47:55', '2022-01-09 02:47:55'),
	(5, 'Tata Lingkungan', '2022-01-09 02:47:58', '2022-01-09 02:47:59'),
	(6, 'Bidang Lain-lain', '2022-01-09 02:48:03', '2022-01-09 02:48:03');
/*!40000 ALTER TABLE `skt_classification` ENABLE KEYS */;

-- Dumping structure for table kaltara.telescope_entries
CREATE TABLE IF NOT EXISTS `telescope_entries` (
  `sequence` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB AUTO_INCREMENT=42851 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.telescope_entries: ~2 rows (approximately)
/*!40000 ALTER TABLE `telescope_entries` DISABLE KEYS */;
INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
	(42849, '954f2a31-c729-48d0-b611-131c3931ec04', '954f2a31-d321-4fcc-9902-c3f43aa65039', 'ca870c9fd72ecfd2819c7f7a7df2de54', 0, 'exception', '{"class":"LogicException","file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Routing\\\\Route.php","line":1150,"message":"Unable to prepare route [comingsoon] for serialization. Uses Closure.","context":null,"trace":[{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Console\\\\RouteCacheCommand.php","line":62},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":36},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Util.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":93},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Container.php","line":596},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":134},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Command\\\\Command.php","line":298},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":121},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Concerns\\\\CallsCommands.php","line":56},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Concerns\\\\CallsCommands.php","line":28},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Console\\\\OptimizeCommand.php","line":31},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":36},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Util.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":93},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Container.php","line":596},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":134},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Command\\\\Command.php","line":298},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":121},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Application.php","line":1005},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Application.php","line":299},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Application.php","line":171},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Application.php","line":93},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Console\\\\Kernel.php","line":129},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\artisan","line":37}],"line_preview":{"1141":"     * Prepare the route instance for serialization.","1142":"     *","1143":"     * @return void","1144":"     *","1145":"     * @throws \\\\LogicException","1146":"     *\\/","1147":"    public function prepareForSerialization()","1148":"    {","1149":"        if ($this->action[\'uses\'] instanceof Closure) {","1150":"            throw new LogicException(\\"Unable to prepare route [{$this->uri}] for serialization. Uses Closure.\\");","1151":"        }","1152":"","1153":"        $this->compileRoute();","1154":"","1155":"        unset($this->router, $this->container);","1156":"    }","1157":"","1158":"    \\/**","1159":"     * Dynamically access route parameters.","1160":"     *"},"hostname":"DBL","occurrences":1}', '2022-01-08 20:07:08'),
	(42850, '954f2a4c-c540-41d1-8fed-34a48eba979e', '954f2a4c-d0e3-49a7-b434-ff3f5da746ad', 'ca870c9fd72ecfd2819c7f7a7df2de54', 1, 'exception', '{"class":"LogicException","file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Routing\\\\Route.php","line":1150,"message":"Unable to prepare route [comingsoon] for serialization. Uses Closure.","context":null,"trace":[{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Console\\\\RouteCacheCommand.php","line":62},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":36},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Util.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":93},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Container.php","line":596},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":134},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Command\\\\Command.php","line":298},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":121},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Concerns\\\\CallsCommands.php","line":56},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Concerns\\\\CallsCommands.php","line":28},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Console\\\\OptimizeCommand.php","line":31},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":36},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Util.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":93},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\BoundMethod.php","line":37},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Container\\\\Container.php","line":596},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":134},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Command\\\\Command.php","line":298},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Command.php","line":121},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Application.php","line":1005},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Application.php","line":299},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\symfony\\\\console\\\\Application.php","line":171},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Console\\\\Application.php","line":93},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Console\\\\Kernel.php","line":129},{"file":"D:\\\\DBL\\\\Project\\\\webserver\\\\project\\\\kaltara\\\\artisan","line":37}],"line_preview":{"1141":"     * Prepare the route instance for serialization.","1142":"     *","1143":"     * @return void","1144":"     *","1145":"     * @throws \\\\LogicException","1146":"     *\\/","1147":"    public function prepareForSerialization()","1148":"    {","1149":"        if ($this->action[\'uses\'] instanceof Closure) {","1150":"            throw new LogicException(\\"Unable to prepare route [{$this->uri}] for serialization. Uses Closure.\\");","1151":"        }","1152":"","1153":"        $this->compileRoute();","1154":"","1155":"        unset($this->router, $this->container);","1156":"    }","1157":"","1158":"    \\/**","1159":"     * Dynamically access route parameters.","1160":"     *"},"hostname":"DBL","occurrences":2}', '2022-01-08 20:07:26');
/*!40000 ALTER TABLE `telescope_entries` ENABLE KEYS */;

-- Dumping structure for table kaltara.telescope_entries_tags
CREATE TABLE IF NOT EXISTS `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.telescope_entries_tags: ~0 rows (approximately)
/*!40000 ALTER TABLE `telescope_entries_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `telescope_entries_tags` ENABLE KEYS */;

-- Dumping structure for table kaltara.telescope_monitoring
CREATE TABLE IF NOT EXISTS `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.telescope_monitoring: ~0 rows (approximately)
/*!40000 ALTER TABLE `telescope_monitoring` DISABLE KEYS */;
/*!40000 ALTER TABLE `telescope_monitoring` ENABLE KEYS */;

-- Dumping structure for table kaltara.training
CREATE TABLE IF NOT EXISTS `training` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_start_date` datetime NOT NULL,
  `registration_end_date` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `is_active` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.training: ~0 rows (approximately)
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
/*!40000 ALTER TABLE `training` ENABLE KEYS */;

-- Dumping structure for table kaltara.training_participant
CREATE TABLE IF NOT EXISTS `training_participant` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `training_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobs_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_level_id` bigint unsigned NOT NULL,
  `certification` enum('SKA','SKT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_participant_training_id_foreign` (`training_id`),
  KEY `training_participant_jobs_id_foreign` (`jobs_id`),
  KEY `training_participant_district_id_foreign` (`district_id`),
  KEY `training_participant_education_level_id_foreign` (`education_level_id`),
  CONSTRAINT `training_participant_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `training_participant_education_level_id_foreign` FOREIGN KEY (`education_level_id`) REFERENCES `education_level` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `training_participant_jobs_id_foreign` FOREIGN KEY (`jobs_id`) REFERENCES `jobs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `training_participant_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.training_participant: ~0 rows (approximately)
/*!40000 ALTER TABLE `training_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `training_participant` ENABLE KEYS */;

-- Dumping structure for table kaltara.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_profile_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint DEFAULT NULL,
  `approved_by` bigint NOT NULL DEFAULT '0',
  `approved_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kaltara.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `birth_date`, `gender`, `address`, `phone_number`, `photo_profile_path`, `is_approved`, `approved_by`, `approved_at`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'superadmin@gmail.com', NULL, '$2y$10$1BMyPCjviKIAKyGx6EvOw.kCWhuEVuRDWsbTxFhWHjP1D6QJ3n.EC', '1995-06-27', 'm', 'Surabaya', '085791832391', 'upload/user/1/photo/61c84c68892ee.png', 1, 0, '2021-12-18 01:55:27', 'QDenJufdpEKat1mAACEwqOESzcFoR2g9NOosF2ADounK4FASdF0pY9RBPWxP', '2021-12-17 17:55:19', '2021-12-26 15:08:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
