/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - weddingorganizersaw2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`weddingorganizersaw2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `weddingorganizersaw2`;

/*Table structure for table `about_us` */

DROP TABLE IF EXISTS `about_us`;

CREATE TABLE `about_us` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `why_us_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `why_us_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `why_us_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_project` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_vendor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_members` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `about_us` */

insert  into `about_us`(`id`,`mission`,`mission_title`,`mission_desc`,`mission_image`,`why_us_title`,`why_us_desc`,`why_us_image`,`total_project`,`total_vendor`,`team_members`,`created_at`,`updated_at`) values 
(1,'Menciptakan Kenangan Tak Terlupakan','Menciptakan Kenangan Tak Terlupakan','<p>Kami di Alucia Wedding Organizer percaya bahwa pernikahan bukan hanya sekedar acara, tetapi juga perayaan cinta yang penuh makna. Kami ada untuk membantu Anda menjadikan setiap momen lebih bermakna. ✨</p>','about_us/ReVHeAHmaiBkfa0fPLqZVe3lbk8Mm4VFM5A0CvDJ.jpg','Menjadi Mitra yang Dapat Diandalkan','<p>Membantu pasangan mewujudkan impian pernikahan mereka dengan solusi yang inovatif, fleksibel, dan berorientasi pada kepuasan pelanggan.</p>','about_us/zQMOhxncpyx4DQmnmFcyDoiq08hNNuSJVzPkbZ3W.jpg','100','20','50','2024-11-23 14:00:36','2024-11-23 14:00:36');

/*Table structure for table `applicant_scores` */

DROP TABLE IF EXISTS `applicant_scores`;

CREATE TABLE `applicant_scores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `criteria_id` bigint unsigned NOT NULL,
  `periode_id` bigint unsigned NOT NULL,
  `sub_criteria_id` bigint unsigned DEFAULT NULL,
  `raw_score` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_scores_application_id_foreign` (`application_id`),
  KEY `applicant_scores_criteria_id_foreign` (`criteria_id`),
  KEY `applicant_scores_sub_criteria_id_foreign` (`sub_criteria_id`),
  KEY `applicant_scores_ibfk_1` (`periode_id`),
  CONSTRAINT `applicant_scores_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applicant_scores_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applicant_scores_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applicant_scores_sub_criteria_id_foreign` FOREIGN KEY (`sub_criteria_id`) REFERENCES `sub_criteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `applicant_scores` */

insert  into `applicant_scores`(`id`,`application_id`,`criteria_id`,`periode_id`,`sub_criteria_id`,`raw_score`,`created_at`,`updated_at`) values 
(33,13,14,11,37,80,'2025-02-20 23:00:48','2025-02-20 23:00:48'),
(34,13,15,11,42,80,'2025-02-20 23:00:48','2025-02-20 23:00:48'),
(35,13,16,11,49,40,'2025-02-20 23:00:48','2025-02-20 23:00:48'),
(36,13,17,11,51,100,'2025-02-20 23:00:48','2025-02-20 23:00:48'),
(37,13,18,11,60,40,'2025-02-20 23:00:48','2025-02-20 23:00:48'),
(38,13,19,11,33,60,'2025-02-20 23:00:48','2025-02-20 23:00:48'),
(39,12,14,11,37,80,'2025-02-20 23:01:19','2025-02-20 23:01:19'),
(40,12,15,11,41,100,'2025-02-20 23:01:19','2025-02-20 23:01:19'),
(41,12,16,11,47,80,'2025-02-20 23:01:19','2025-02-20 23:01:19'),
(42,12,17,11,54,40,'2025-02-20 23:01:19','2025-02-20 23:01:19'),
(43,12,18,11,56,100,'2025-02-20 23:01:19','2025-02-20 23:01:19'),
(44,12,19,11,31,100,'2025-02-20 23:01:19','2025-02-20 23:01:19'),
(45,11,14,11,37,80,'2025-02-20 23:02:50','2025-02-20 23:02:50'),
(46,11,15,11,43,60,'2025-02-20 23:02:50','2025-02-20 23:02:50'),
(47,11,16,11,46,100,'2025-02-20 23:02:50','2025-02-20 23:02:50'),
(48,11,17,11,53,60,'2025-02-20 23:02:50','2025-02-20 23:02:50'),
(49,11,18,11,60,40,'2025-02-20 23:02:50','2025-02-20 23:02:50'),
(50,11,19,11,31,100,'2025-02-20 23:02:50','2025-02-20 23:02:50'),
(51,14,14,11,39,40,'2025-02-20 23:03:28','2025-02-20 23:03:28'),
(52,14,15,11,42,80,'2025-02-20 23:03:28','2025-02-20 23:03:28'),
(53,14,16,11,47,80,'2025-02-20 23:03:28','2025-02-20 23:03:28'),
(54,14,17,11,51,100,'2025-02-20 23:03:28','2025-02-20 23:03:28'),
(55,14,18,11,61,20,'2025-02-20 23:03:28','2025-02-20 23:03:28'),
(56,14,19,11,32,80,'2025-02-20 23:03:28','2025-02-20 23:03:28'),
(57,15,14,11,36,100,'2025-02-20 23:05:57','2025-02-20 23:05:57'),
(58,15,15,11,43,60,'2025-02-20 23:05:57','2025-02-20 23:05:57'),
(59,15,16,11,50,20,'2025-02-20 23:05:57','2025-02-20 23:05:57'),
(60,15,17,11,52,80,'2025-02-20 23:05:57','2025-02-20 23:05:57'),
(61,15,18,11,60,40,'2025-02-20 23:05:57','2025-02-20 23:05:57'),
(62,15,19,11,31,100,'2025-02-20 23:05:57','2025-02-20 23:05:57'),
(63,16,14,11,37,80,'2025-02-20 23:13:43','2025-02-20 23:13:43'),
(64,16,15,11,44,40,'2025-02-20 23:13:43','2025-02-20 23:13:43'),
(65,16,16,11,47,80,'2025-02-20 23:13:43','2025-02-20 23:13:43'),
(66,16,17,11,53,60,'2025-02-20 23:13:43','2025-02-20 23:13:43'),
(67,16,18,11,56,100,'2025-02-20 23:13:43','2025-02-20 23:13:43'),
(68,16,19,11,32,80,'2025-02-20 23:13:43','2025-02-20 23:13:43');

/*Table structure for table `applications` */

DROP TABLE IF EXISTS `applications`;

CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total_score` decimal(5,2) DEFAULT '0.00',
  `status` enum('pending','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `user_id` bigint unsigned NOT NULL,
  `periode_id` bigint unsigned NOT NULL,
  `vacancy_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_user_id_foreign` (`user_id`),
  KEY `applications_vacancy_id_foreign` (`vacancy_id`),
  KEY `periode_id` (`periode_id`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applications_vacancy_id_foreign` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `applications` */

insert  into `applications`(`id`,`total_score`,`status`,`user_id`,`periode_id`,`vacancy_id`,`created_at`,`updated_at`) values 
(11,0.00,'pending',12,11,6,'2025-02-20 11:11:43','2025-02-20 11:11:43'),
(12,0.00,'pending',11,11,6,'2025-02-20 11:12:07','2025-02-20 11:12:07'),
(13,0.00,'pending',10,11,6,'2025-02-20 11:12:35','2025-02-20 11:12:35'),
(14,0.00,'pending',13,11,6,'2025-02-20 11:14:49','2025-02-20 11:14:49'),
(15,0.00,'pending',14,11,6,'2025-02-20 11:16:36','2025-02-20 11:16:36'),
(16,0.00,'pending',15,11,6,'2025-02-20 11:18:07','2025-02-20 11:18:07');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `criteria` */

DROP TABLE IF EXISTS `criteria`;

CREATE TABLE `criteria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_criteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` bigint unsigned NOT NULL,
  `bobot` int NOT NULL,
  `jenis_criteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periode_id` (`periode_id`),
  CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `criteria` */

insert  into `criteria`(`id`,`nama_criteria`,`periode_id`,`bobot`,`jenis_criteria`,`created_at`,`updated_at`) values 
(14,'Seleksi berkas',11,10,'benefit','2025-02-18 04:19:32','2025-02-18 04:19:32'),
(15,'Komunikasi yg baik',11,20,'benefit','2025-02-18 04:19:58','2025-02-18 04:19:58'),
(16,'ramah',11,15,'benefit','2025-02-18 04:20:12','2025-02-18 04:20:12'),
(17,'memecahkan masalah',11,15,'benefit','2025-02-18 04:21:37','2025-02-18 04:21:37'),
(18,'cepat beradaptasi',11,15,'benefit','2025-02-18 04:22:07','2025-02-18 04:22:07'),
(19,'Kreativitas dalam merancang konsep',11,25,'benefit','2025-02-18 04:22:27','2025-02-18 04:22:27'),
(20,'Seleksi berkas',11,10,'benefit','2025-02-22 01:21:39','2025-02-22 01:21:39'),
(21,'Komunikasi yg baik',11,20,'benefit','2025-02-22 01:21:39','2025-02-22 01:21:39'),
(22,'ramah',11,15,'benefit','2025-02-22 01:21:39','2025-02-22 01:21:39'),
(23,'memecahkan masalah',11,15,'benefit','2025-02-22 01:21:39','2025-02-22 01:21:39'),
(24,'cepat beradaptasi',11,15,'benefit','2025-02-22 01:21:39','2025-02-22 01:21:39'),
(25,'Kreativitas dalam merancang konsep',11,25,'benefit','2025-02-22 01:21:39','2025-02-22 01:21:39'),
(26,'Coba',12,2,'benefit','2025-02-22 01:29:07','2025-02-22 01:29:07'),
(27,'Coba',13,2,'benefit','2025-02-22 01:29:39','2025-02-22 01:29:39'),
(28,'Seleksi berkas',13,10,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(29,'Komunikasi yg baik',13,20,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(30,'ramah',13,15,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(31,'memecahkan masalah',13,15,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(32,'cepat beradaptasi',13,15,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(33,'Kreativitas dalam merancang konsep',13,25,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(34,'Seleksi berkas',13,10,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(35,'Komunikasi yg baik',13,20,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(36,'ramah',13,15,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(37,'memecahkan masalah',13,15,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(38,'cepat beradaptasi',13,15,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50'),
(39,'Kreativitas dalam merancang konsep',13,25,'benefit','2025-02-22 01:29:50','2025-02-22 01:29:50');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `hero_page_contents` */

DROP TABLE IF EXISTS `hero_page_contents`;

CREATE TABLE `hero_page_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `welcome_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `hero_page_contents` */

insert  into `hero_page_contents`(`id`,`welcome_text`,`content_text`,`image_path1`,`image_path2`,`image_path3`,`image_path4`,`image_path5`,`created_at`,`updated_at`) values 
(1,'Selamat datang di Alucia Wedding Organizer','<p>mitra sempurna untuk hari istimewa Anda! Kami hadir untuk mewujudkan impian pernikahan Anda menjadi kenyataan dengan sentuhan keindahan, keanggunan, dan profesionalisme. Bersama kami, perjalanan menuju momen terindah dalam hidup Anda akan menjadi pengalaman yang tak terlupakan</p>','hero_images/md1sb4HsMuro6QEQm7eKkWIbIHkKLqJAKaEmZMLp.jpg','hero_images/B69w2hQYGA57p7XqragpCx2GTrepsF660x5Mwehu.jpg','hero_images/r1Y4EI9Xcm1xyqFjQGIOfF5KJ4bS7VeKZVTOMbJM.jpg',NULL,NULL,'2024-11-23 13:52:44','2024-11-23 13:52:44');

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `matriks_keputusan` */

DROP TABLE IF EXISTS `matriks_keputusan`;

CREATE TABLE `matriks_keputusan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `periode_id` bigint unsigned NOT NULL,
  `applicant_id` bigint unsigned NOT NULL,
  `criteria_id` bigint unsigned NOT NULL,
  `hasil` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matriks_keputusan_vacancy_id_foreign` (`periode_id`),
  KEY `matriks_keputusan_applicant_id_foreign` (`applicant_id`),
  KEY `matriks_keputusan_criteria_id_foreign` (`criteria_id`),
  CONSTRAINT `matriks_keputusan_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `matriks_keputusan_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE,
  CONSTRAINT `matriks_keputusan_vacancy_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `matriks_keputusan` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2024_10_08_025423_create_vacancies_table',1),
(5,'2024_10_08_025754_create_criteria_table',1),
(6,'2024_10_09_014303_create_sub_criteria_table',1),
(7,'2024_10_09_024330_create_applications_table',1),
(8,'2024_10_10_021508_create_applicant_scores_table',1),
(9,'2024_10_26_090835_create_hero_page_contents_table',1),
(10,'2024_10_30_153512_create_portfolios_table',1),
(11,'2024_10_30_153714_create_portfolio_details_table',1),
(12,'2024_11_04_022746_create_about_us_table',1),
(13,'2024_11_05_035945_create_testimonials_table',1),
(14,'2024_11_07_030949_create_services_table',1),
(15,'2024_11_10_041800_create_wedding_packages_table',1),
(16,'2024_12_01_131555_create_application_scores_table',2),
(17,'2024_12_20_020305_create_matriks_keputusan_table',3),
(18,'2024_12_21_152027_create_pengumuman_table',4);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pengumuman` */

DROP TABLE IF EXISTS `pengumuman`;

CREATE TABLE `pengumuman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `desc_pengumuman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengumuman` */

insert  into `pengumuman`(`id`,`desc_pengumuman`,`created_at`,`updated_at`) values 
(1,'<p>Berdasarkan hasil dari tes anda , anda dinyatakan lulus ke tahap berikutnya. Silahkan membawa berkas pada tanggal xx-xx-xxxx. <strong>Berkas yang harus dilampirkan<br></strong></p>\r\n<ul>\r\n<li><strong>Pas Foto 4x6<br></strong></li>\r\n<li><strong>Fotocpy KTP<br></strong></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Silahkan datang ke kantor kami untuk seleksi berikutnya</p>','2024-12-22 02:50:19','2024-12-30 13:02:07');

/*Table structure for table `periode` */

DROP TABLE IF EXISTS `periode`;

CREATE TABLE `periode` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vacancy_id` bigint unsigned NOT NULL,
  `tanggal_periode` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vacancy_id` (`vacancy_id`),
  CONSTRAINT `periode_ibfk_1` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `periode` */

insert  into `periode`(`id`,`vacancy_id`,`tanggal_periode`,`status`,`created_at`,`updated_at`) values 
(11,6,'2025-02-01',1,'2025-02-18 04:19:05','2025-02-20 11:11:21'),
(12,7,'2025-03-01',0,'2025-02-22 01:28:52','2025-02-22 01:28:52'),
(13,6,'2025-03-01',0,'2025-02-22 01:29:28','2025-02-22 01:29:28');

/*Table structure for table `portfolio_details` */

DROP TABLE IF EXISTS `portfolio_details`;

CREATE TABLE `portfolio_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `portfolio_id` bigint unsigned NOT NULL,
  `detail_image1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_image2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_image3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_image4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_details_portfolio_id_foreign` (`portfolio_id`),
  CONSTRAINT `portfolio_details_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `portfolio_details` */

insert  into `portfolio_details`(`id`,`portfolio_id`,`detail_image1`,`detail_image2`,`detail_image3`,`detail_image4`,`created_at`,`updated_at`) values 
(2,1,'portfolio-detail/0LlIRpNjxW1NpePL20NmkgrEdNas5VSNIZ6JJ7lJ.png','portfolio-detail/BSb0X82w4ApbzYL9nIqlPLENcqLa64aIq04G7quU.png','portfolio-detail/0pV8kTqa8iPijrDImqLLgLNiJx7PLWHyf7DwZD2X.png','portfolio-detail/mQDzPNyFR31T4XkL6WNGjP6TNLWqK0zRA5ojUPPr.png','2025-01-04 10:28:41','2025-01-04 10:28:41');

/*Table structure for table `portfolios` */

DROP TABLE IF EXISTS `portfolios`;

CREATE TABLE `portfolios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `portfolio_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_maps_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_detail_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `portfolios` */

insert  into `portfolios`(`id`,`portfolio_title`,`portfolio_thumbnail`,`client_name`,`google_maps_url`,`portfolio_detail_desc`,`project_date`,`created_at`,`updated_at`) values 
(1,'Porto 1','portfolio_thumbnail/5VVQXbzKjEGmIjzmwNIzkcZDyjs5gDvzHLiyXQIK.png','Client1','<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3986.812752569114!2d113.93670824705201!3d-2.224086120426895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1735985704329!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','<p>fsdafsdf</p>','2025-01-04','2025-01-04 10:15:31','2025-01-04 10:15:31');

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_title_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_title_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_title_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_title_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_title_5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_title_6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_service_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_service_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_service_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_service_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_service_5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text_5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_service_6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text_6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `services` */

insert  into `services`(`id`,`service_title`,`service_desc`,`icon_title_1`,`icon_title_2`,`icon_title_3`,`icon_title_4`,`icon_title_5`,`icon_title_6`,`icon_service_1`,`service_text_1`,`icon_service_2`,`service_text_2`,`icon_service_3`,`service_text_3`,`icon_service_4`,`service_text_4`,`icon_service_5`,`service_text_5`,`icon_service_6`,`service_text_6`,`created_at`,`updated_at`) values 
(1,'Layanan Kami','<p>Kami membantu Anda merancang setiap detail pernikahan, mulai dari tema, pemilihan lokasi, vendor, hingga susunan acara. Dengan perencanaan yang matang, kami memastikan acara berjalan lancar sesuai visi Anda.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-23 14:02:33','2024-11-23 14:02:33');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('IVV3JoANTTGBD3z8e7EqImNc1iMxGUnbK2N8wk7S',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEI3Wk9Yc1dkekdhM1dsNTZYejJnWEhRalZ5SE9JNE80clRlYkQzdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwtcGVyaW9kZS92YWNhbmN5LzYvcGVyaW9kZS8xMyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1740187791),
('yEZTtpRrSX5A6xAoOFSJhYgkzgsJOoJMuZTWQSDe',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUEFTM0xXSXozQjhsNjZiSEdVcXlFUW05VzE5eDZEaDhXaWdTY3lFUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwtcGVyaW9kZS92YWNhbmN5LzYvcGVyaW9kZS8xMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1740179416);

/*Table structure for table `sub_criteria` */

DROP TABLE IF EXISTS `sub_criteria`;

CREATE TABLE `sub_criteria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `criteria_id` bigint unsigned NOT NULL,
  `sub_criteria_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_criteria_criteria_id_foreign` (`criteria_id`),
  CONSTRAINT `sub_criteria_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_criteria` */

insert  into `sub_criteria`(`id`,`criteria_id`,`sub_criteria_name`,`value`,`created_at`,`updated_at`) values 
(31,19,'Sangat Kreatif',100,'2025-02-18 04:23:10','2025-02-18 04:29:28'),
(32,19,'Kreatif',80,'2025-02-18 04:23:18','2025-02-18 04:29:38'),
(33,19,'Cukup Kreatif',60,'2025-02-18 04:23:29','2025-02-18 04:29:44'),
(34,19,'Kurang Kreatif',40,'2025-02-18 04:23:39','2025-02-18 04:29:54'),
(35,19,'Tidak Kreatif',20,'2025-02-18 04:23:47','2025-02-18 04:30:00'),
(36,14,'Sangat Lengkap',100,'2025-02-18 04:24:44','2025-02-18 04:24:44'),
(37,14,'Lengkap',80,'2025-02-18 04:24:51','2025-02-18 04:24:51'),
(38,14,'Cukup Lengkap',60,'2025-02-18 04:25:00','2025-02-18 04:25:00'),
(39,14,'Kurang Lengkap',40,'2025-02-18 04:25:10','2025-02-18 04:25:10'),
(40,14,'Tidak Lengkap',20,'2025-02-18 04:25:18','2025-02-18 04:25:18'),
(41,15,'Sangat Baik',100,'2025-02-18 04:25:37','2025-02-18 04:25:37'),
(42,15,'Baik',80,'2025-02-18 04:25:46','2025-02-18 04:25:46'),
(43,15,'Cukup Baik',60,'2025-02-18 04:25:57','2025-02-18 04:25:57'),
(44,15,'Kurang Baik',40,'2025-02-18 04:26:06','2025-02-18 04:26:06'),
(45,15,'Sangat buruk',20,'2025-02-18 04:26:15','2025-02-18 04:26:15'),
(46,16,'Sangat Ramah',100,'2025-02-18 04:26:43','2025-02-18 04:26:43'),
(47,16,'Ramah',80,'2025-02-18 04:26:50','2025-02-18 04:26:50'),
(48,16,'Cukup Ramah',60,'2025-02-18 04:27:00','2025-02-18 04:27:00'),
(49,16,'Kurang Ramah',40,'2025-02-18 04:27:09','2025-02-18 04:27:09'),
(50,16,'Tidak Ramah',20,'2025-02-18 04:27:16','2025-02-18 04:27:16'),
(51,17,'Sangat Baik',100,'2025-02-18 04:27:37','2025-02-18 04:27:37'),
(52,17,'Baik',80,'2025-02-18 04:27:44','2025-02-18 04:27:44'),
(53,17,'Cukup Baik',60,'2025-02-18 04:27:57','2025-02-18 04:27:57'),
(54,17,'Kurang Baik',40,'2025-02-18 04:28:07','2025-02-18 04:28:07'),
(55,17,'Sangat Buruk',20,'2025-02-18 04:28:15','2025-02-18 04:28:15'),
(56,18,'Sangat Baik',100,'2025-02-18 04:28:32','2025-02-18 04:28:32'),
(57,18,'Baik',80,'2025-02-18 04:28:40','2025-02-18 04:28:40'),
(58,18,'Baik',80,'2025-02-18 04:28:40','2025-02-18 04:28:40'),
(59,18,'Cukup Baik',60,'2025-02-18 04:28:47','2025-02-18 04:28:47'),
(60,18,'Kurang Baik',40,'2025-02-18 04:28:57','2025-02-18 04:28:57'),
(61,18,'Sangat Buruk',20,'2025-02-18 04:29:08','2025-02-18 04:29:08');

/*Table structure for table `testimonials` */

DROP TABLE IF EXISTS `testimonials`;

CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `testimonials` */

insert  into `testimonials`(`id`,`testimonial_image`,`testimonial_customer_name`,`testimonial_desc`,`created_at`,`updated_at`) values 
(1,'testimonial_image/TZFh7Fk6twtxx8keyJWCR5z4pYf6AIzXz8LdTKht.png','Testi1','<p>Mantap</p>','2025-01-04 10:30:16','2025-01-04 10:30:16');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pernikahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran_ijazah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran_cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran_keterangan_sehat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran_skck` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`alamat`,`foto`,`tempat_lahir`,`tanggal_lahir`,`jenis_kelamin`,`agama`,`status_pernikahan`,`provinsi`,`kota`,`no_hp`,`pendidikan_terakhir`,`jurusan`,`lampiran_ijazah`,`lampiran_cv`,`lampiran_keterangan_sehat`,`lampiran_ktp`,`lampiran_skck`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin@gmail.com','2024-11-23 09:19:25','$2y$12$JHLMroUdf68vvxPIm1khtu6Tg349dBucLLHIqgDZp9nXw621IUwya','superadmin','',NULL,'','','','','','','','0','','',NULL,NULL,NULL,NULL,NULL,'kXWImteIHQXksiPHp1vqcahKArGcZCfsksOSdoQIusPnPgbPqDSCTCQlsC6B','2024-11-23 09:19:25','2024-11-23 09:19:25'),
(6,'Tes Ubah3','admin1@gmail.com',NULL,'$2y$12$TJ64Y5K2A5RUlQ11k1wBc.HvJREr11fAO7mmLJeLZLQd7fSozBuXq','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 13:44:19','2025-01-31 00:07:59'),
(7,'admin321','admin2@gmail.com',NULL,'$2y$12$vJCHtIVLoi1eqfC8WfxbSO19D2mPIXEd4zRtYlvc4k2IeZ3WNcgxe','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 13:44:34','2025-01-31 13:46:46'),
(10,'Tia','tia@gmail.com',NULL,'$2y$12$yTijStCi6etdjWIWAMnTt.KbnFjhTISIWIIDNZnLLRCfvMahO2kDG','user','rahasia','foto-lamaran/G5GDKuK6fGmBl5hBuVh6rOXMV5U8sDB0h7KkxtYr.png','Bogor Jabar','2025-02-18','Perempuan','kristen_protestan','belum_menikah','Kalimantan Tengah','Palangka Raya','098139021','SMP','Teknik keteknikan','lampiran/lampiran-ijazah/sBDEGqjFsjbmN1knIH7RniDgzCJTX4zx6ox5PW68.png','lampiran/lampiran-cv/RUlK8bv9VO4qfxwQVcT51NhJkn8KiGpOQvJE0ja4.png','lampiran/lampiran-keterangan-sehat/zWdSyqxpE4FlGblzUK6Y3wh3qoMkZlRC0qDBOprD.png','lampiran/lampiran-ktp/JWtQb6d4yMf3QuYNAmVv5ZcO6G0c8xitTVrqzlrX.png','lampiran/lampiran-skck/1U0jxtpCqH8JmPfv4xGoOzzhYxZexLFggYPfKG9u.png',NULL,'2025-02-18 04:45:58','2025-02-18 04:46:49'),
(11,'Zefanya','Zefanya@gmail.com',NULL,'$2y$12$9cY70XtqEBCZsBp9Fi4A6.uy.Y2mqg05SL8ADlPo.dGZSkkrD6YYm','user','Jl Seth Adjie Komp Palapa','foto-lamaran/D1kFIMsLpVKTcBIb2IWuLAGHPWuavPEZO6wcQrqL.png','Bogor','2025-02-28','Laki-Laki','kristen_katolik','belum_menikah','Kalimantan Tengah','Palangka Raya','082251644179','D4','Rahasai','lampiran/lampiran-ijazah/tWca1VVbjDa5sKcOHDiMYR7wxdw7veCppLyrmhrO.png','lampiran/lampiran-cv/Q9CkC3vTstQ5qBSSHWa5cMe3Wmfx0EyJu4iMtDaq.png','lampiran/lampiran-keterangan-sehat/EjOIkPa33MXhls8Dv1eoZsROi9mMCiMJPHzKIiOV.png','lampiran/lampiran-ktp/tfKj6oKryUnXAeWlai9c85wEp4zxzZBuGfzfLO2J.png','lampiran/lampiran-skck/OJBkN2V7w7gX9UQNoeNC5I4JJ5IDEc6OFTJ2b8ZY.png',NULL,'2025-02-18 04:47:17','2025-02-18 04:48:02'),
(12,'Yosia','yosia@gmail.com',NULL,'$2y$12$LkG3007LO0iPc9nei0kWgOD2a1r9dquMPSncmzXqWljA7NiI1DVHi','user','rahasia','foto-lamaran/2SxEBzMG7TZ3fwTORmYt5DJkaU6ToQbV0ZbMmhnd.png','Rumah','2025-02-20','Laki-Laki','kristen_katolik','belum_menikah','Kalimantan Tengah','Palangka Raya','0823892130','S2','Seni Budaya','lampiran/lampiran-ijazah/JXDpkclBY6UqMjCH9G8yxYdgRyDGTyKw9G6g7w7W.png','lampiran/lampiran-cv/ViRiraKcf7odHqwypjz924nfhCy9UKFmuTaIck7T.png','lampiran/lampiran-keterangan-sehat/04AISWoOYnwkeWwsrnIHI0xVml6EZQzbNjyqRl4s.png','lampiran/lampiran-ktp/c1f5HK8PwualGY7NkeGR7I93gnV91uGhhYuTZSmG.png','lampiran/lampiran-skck/f7By2BWjHtOlv4fTvrC3fHrWVHicR7rDyFPeLgcI.png',NULL,'2025-02-20 11:08:55','2025-02-20 11:10:15'),
(13,'mirna','mirna@gmail.com',NULL,'$2y$12$b2jWZadEMOWsJeqwNBxawOlvSaLO1vZ3jQ3sefBgkncG.IE5rfVFq','user','rahasia','foto-lamaran/cAZ66rM11UDGiKmcCNNfl5uuaD6CiJvAB3IftpJo.png','Sampit','2025-02-20','Laki-Laki','kristen_katolik','belum_menikah','Kalimantan Tengah','Palangka Raya','082983929120','S2','Seni Budaya','lampiran/lampiran-ijazah/w4NvaEDqBw3liYgnl4sDkO2KN3OMDVWvAzafUJoh.png','lampiran/lampiran-cv/oFxXsypCWC1ecwmdaNqdsOR58WLbKE64J6tjnOxr.png','lampiran/lampiran-keterangan-sehat/43DsG7krxGlFd1eYFnjprxzx30UMrs6LN2T0JBCN.png','lampiran/lampiran-ktp/STqeg2FvVtg4RnpAyWP3kdNWAOUlazQVRa8NerMn.png','lampiran/lampiran-skck/W5dugoRxROMZST3XEeCnQKodzGLQ98xW4IKbCb0x.png',NULL,'2025-02-20 11:13:37','2025-02-20 11:14:39'),
(14,'puput','puput@gmail.com',NULL,'$2y$12$dpYJlnJmTeKevysr5J5JSOA8vqMhopX2W..A8WGjF2Nb021Zm6dWC','user','Rahasia','foto-lamaran/z5w6Vtw9fRUPoWChUw5Lp7icWfUju7Ux2KQ1HHwq.png','Sampit','2025-02-20','Laki-Laki','kristen_protestan','belum_menikah','Kalimantan Tengah','Palangka Raya','0823892130','S1','Seni Budaya','lampiran/lampiran-ijazah/M9qR160NGyYZdstLXS6GQgsFnpMPlD4vkUKg9c7Z.png','lampiran/lampiran-cv/lAYutNJWOxeoihRPvveyeFgHoXCQKk5dftK6Ci3J.png','lampiran/lampiran-keterangan-sehat/KEPWix5fq4f7gefRlqaQoasno4OVL8TwPrCbvO2b.png','lampiran/lampiran-ktp/GFrlokjaeX34psIBAWhdpTsPNH9v6hQAkIwKYFFt.png','lampiran/lampiran-skck/hmNYllVjnuDeLlpZ6wahUighFTSnIJQHZKO2gMSO.png',NULL,'2025-02-20 11:15:15','2025-02-20 11:16:27'),
(15,'Abi','abi@gmail.com',NULL,'$2y$12$Wplnv0zEEJlOVXNa77l9PeXXtYeAJ5phT1DNkIruxpcDr8YE74tVm','user','rahasia','foto-lamaran/Eoqtd8zBPex5RYGDtl0hah2h68BZ3JoQcCdI5qQM.png','Sampit','2025-02-20','Laki-Laki','kristen_protestan','belum_menikah','Kalimantan Tengah','Palangka Raya','082983929120','D4','Seni Budaya','lampiran/lampiran-ijazah/emNXEhnk0FVIkrmQAImK8rJm8xBUvc1ENo2exVyu.png','lampiran/lampiran-cv/hFRV46mHfUx89eH0J96vU1qHMR3RDohBXqSsp2H6.png','lampiran/lampiran-keterangan-sehat/zbv7926l3ptluO3Jnd4SHRJzGDJNC4rkAiuPehcd.png','lampiran/lampiran-ktp/19AwDcJ7olOqK5SrMEEpzfaT5LjMC920niUh0YZh.png','lampiran/lampiran-skck/kKiLQriI8archkR2JpO0WA5P6WgkNWSkePfw3HKu.png',NULL,'2025-02-20 11:17:01','2025-02-20 11:18:02');

/*Table structure for table `vacancies` */

DROP TABLE IF EXISTS `vacancies`;

CREATE TABLE `vacancies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul_lowongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_lowongan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas_persyaratan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vacancies` */

insert  into `vacancies`(`id`,`judul_lowongan`,`deskripsi_lowongan`,`berkas_persyaratan`,`created_at`,`updated_at`) values 
(6,'Tes','<p>Tes</p>','berkas_persyaratan/0nobh1EqRj3vdnNFoBnKqu3U21SPGq88YQkeENvZ.png','2025-02-18 04:19:05','2025-02-18 04:19:05'),
(7,'Pertanyaan2','<p>fsdfsd</p>','berkas_persyaratan/MIWA320ylIP8CTCTBLFc5bdVpSnLyU0wtJZ9brXX.png','2025-02-22 01:28:52','2025-02-22 01:28:52');

/*Table structure for table `wedding_packages` */

DROP TABLE IF EXISTS `wedding_packages`;

CREATE TABLE `wedding_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `package_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `features` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_recommend` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wedding_packages` */

insert  into `wedding_packages`(`id`,`package_title`,`price`,`features`,`is_active`,`is_recommend`,`created_at`,`updated_at`) values 
(1,'Paket1',2312312.00,'[\"asdfsdafsdfa\"]',1,1,'2025-01-04 10:31:10','2025-01-04 10:31:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
