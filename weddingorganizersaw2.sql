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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `applicant_scores` */

insert  into `applicant_scores`(`id`,`application_id`,`criteria_id`,`periode_id`,`sub_criteria_id`,`raw_score`,`created_at`,`updated_at`) values 
(21,6,10,2,30,70,'2025-02-09 13:45:58','2025-02-09 13:45:58'),
(22,6,11,2,29,40,'2025-02-09 13:45:58','2025-02-09 13:45:58'),
(23,6,12,2,28,10,'2025-02-09 13:45:58','2025-02-09 13:45:58'),
(24,6,13,2,25,30,'2025-02-09 13:45:58','2025-02-10 03:42:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `applications` */

insert  into `applications`(`id`,`total_score`,`status`,`user_id`,`periode_id`,`vacancy_id`,`created_at`,`updated_at`) values 
(6,0.00,'pending',2,2,3,'2025-02-09 14:45:32','2025-02-10 07:17:27'),
(7,0.00,'pending',2,7,3,'2025-02-10 07:17:27','2025-02-10 07:17:27');

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
  `bobot` decimal(8,2) NOT NULL,
  `jenis_criteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periode_id` (`periode_id`),
  CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `criteria` */

insert  into `criteria`(`id`,`nama_criteria`,`periode_id`,`bobot`,`jenis_criteria`,`created_at`,`updated_at`) values 
(7,'Seleksi Berkas',7,3.00,'benefit','2025-02-06 23:13:27','2025-02-07 13:47:59'),
(8,'Umur',7,5.00,'cost','2025-02-07 12:54:38','2025-02-07 13:43:31'),
(9,'Pengalaman',7,1.00,'benefit','2025-02-07 12:54:57','2025-02-07 13:47:48'),
(10,'Crit1',2,3.00,'benefit','2025-02-09 12:50:38','2025-02-09 12:50:38'),
(11,'Crit2',2,3.00,'benefit','2025-02-09 12:50:54','2025-02-09 12:50:54'),
(12,'Crit3',2,4.00,'cost','2025-02-09 12:51:04','2025-02-09 12:51:04'),
(13,'Crit5',2,8.00,'benefit','2025-02-09 12:51:20','2025-02-09 12:56:56');

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
  CONSTRAINT `matriks_keputusan_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `periode` */

insert  into `periode`(`id`,`vacancy_id`,`tanggal_periode`,`status`,`created_at`,`updated_at`) values 
(2,3,'2025-02-01',1,'2025-02-05 01:42:53','2025-02-05 04:10:41'),
(7,3,'2026-02-01',1,'2025-02-05 02:14:39','2025-02-06 13:15:25');

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
('awHPOJKX3Jbj3jaBQHRy9zgp5wTuhGT9xMv6smZ7',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiejZhb3p6elVtMEF4S0RXdFJwWUhmeGZqaGpXV2RqQURtTUx0Z0xqcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5ndW11bWFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1739172033),
('dLEMdFZNKwqmB6ougmLODjlEwxzVFN1N11HI57so',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUldSUHRnSGJnWUUwaGxqMVRKSHNPY1pvRkxHU3dpNXVBMW81WHdNdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9oaXR1bmctc2F3LzMvcGVyaW9kZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1739244940),
('Kbd1Q9hUr8Lv3Wkc210GPgZAJ8Ywv02LWcYfJkxn',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidDhKeVFkdEtZRW5zZW5sd1lVQVpyTzFGTmUyNVNDcldaRkloVTdLRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwtcGVyaW9kZS92YWNhbmN5LzMvcGVyaW9kZS83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1739249570),
('uhxVuP49FAqvExGHglHY6UuNpgsSW2LveUg3Qo9E',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidE1JVVA1Y0RweTZ2c1RUdzl4WW5UazU3bDBMUFlxcjdVYUN4RThNOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9oaXR1bmctc2F3LzMvcGVyaW9kZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1739173391),
('VH72RJBXom02M1lWVsMGvUaDmF66SCgxZ0Th9Su5',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibldyVzVmQjFYeDd5QW82dEl2NnZ6SUh2UHgxWFFwNDJORWtRQXJKbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9oaXR1bmctc2F3LzMvcGVyaW9kZS8yL3BlbmlsYWlhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1739317263);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_criteria` */

insert  into `sub_criteria`(`id`,`criteria_id`,`sub_criteria_name`,`value`,`created_at`,`updated_at`) values 
(24,8,'D (0 - 30)',30,'2025-02-08 00:26:51','2025-02-08 00:26:51'),
(25,13,'Sub 1 - 2',30,'2025-02-09 13:35:15','2025-02-09 13:35:15'),
(26,13,'Sub 3',40,'2025-02-09 13:35:25','2025-02-09 13:35:25'),
(27,13,'Sub 4',50,'2025-02-09 13:36:04','2025-02-09 13:36:04'),
(28,12,'tes1',10,'2025-02-09 13:36:27','2025-02-09 13:36:27'),
(29,11,'tes2',40,'2025-02-09 13:36:42','2025-02-09 13:36:42'),
(30,10,'tes4',70,'2025-02-09 13:37:00','2025-02-09 13:37:00');

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
  `asal_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`alamat`,`foto`,`tempat_lahir`,`tanggal_lahir`,`jenis_kelamin`,`agama`,`status_pernikahan`,`provinsi`,`kota`,`no_hp`,`asal_sekolah`,`jurusan`,`lampiran_ijazah`,`lampiran_cv`,`lampiran_keterangan_sehat`,`lampiran_ktp`,`lampiran_skck`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin@gmail.com','2024-11-23 09:19:25','$2y$12$JHLMroUdf68vvxPIm1khtu6Tg349dBucLLHIqgDZp9nXw621IUwya','superadmin','',NULL,'','','','','','','','0','','',NULL,NULL,NULL,NULL,NULL,'LS50l1kIPj74iLqF4p6AVeHEOCw528T98NSEVYN5MEKvZPj0X9XSDu0FfFHP','2024-11-23 09:19:25','2024-11-23 09:19:25'),
(2,'User','user@gmail.com','2024-11-23 09:19:26','$2y$12$xk0H8oguLlqmNceoS87pueHN2Hh0QG.AeiM79/umTz64DlvnlyTNq','user','rahasia','foto-lamaran/bLveAGFaK15B5aUx28lRv81e25vtxyterjvMSpjC.png','Bogor','1999-11-05','Laki-Laki','kristen_protestan','menikah','Kalimantan Tengah','Palangka Raya','098139021','Rahasia','Rahasai','lampiran/lampiran-ijazah/XhpFDJ4VnDP3E2LUf86ivWTRb2iVS5u6oIKhxdWQ.png','lampiran/lampiran-cv/MPOEZS75KPUwdbcbQEX7E5kdHwfgI4JrJI1GU3Wf.png','lampiran/lampiran-keterangan-sehat/D2MmOwshWR1X6hnomzAupkIkvp4fLRLY3zuArFQM.png','lampiran/lampiran-ktp/1kcPGOSEluvWaTM4F4sNXytJQ4w1o9O6z2UKVRDs.png','lampiran/lampiran-skck/inHd432o5BngalzFzS4C13MynjSt03CJNIgWWnIF.png','a5fnKmpb0rJ3edktgdDsyRpD4zZmHqRqBJw6lzoWXVDs9qBNkFSFk0Na112k','2024-11-23 09:19:26','2025-02-10 07:12:08'),
(6,'Tes Ubah3','admin1@gmail.com',NULL,'$2y$12$TJ64Y5K2A5RUlQ11k1wBc.HvJREr11fAO7mmLJeLZLQd7fSozBuXq','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 13:44:19','2025-01-31 00:07:59'),
(7,'admin321','admin2@gmail.com',NULL,'$2y$12$vJCHtIVLoi1eqfC8WfxbSO19D2mPIXEd4zRtYlvc4k2IeZ3WNcgxe','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 13:44:34','2025-01-31 13:46:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vacancies` */

insert  into `vacancies`(`id`,`judul_lowongan`,`deskripsi_lowongan`,`berkas_persyaratan`,`created_at`,`updated_at`) values 
(1,'Lowongan MC (Master Clan bukan master of ceremony)','<p>Untuk mengatasi kondisi di mana gambar pada <code>AboutUs</code> tidak tersedia (null atau kosong), Anda dapat menggunakan pengecekan dengan ternary operator atau fungsi <code>isset</code>/<code>empty</code>. Misalnya, Anda bisa menggunakan gambar default jika <code>mission_image</code> kosong.</p>','berkas_persyaratan/5uFZkAvsQ3xsfV66zIESgdlk7ERaRFAnIoI7SWF4.jpg','2024-11-23 13:45:20','2024-11-23 13:45:20'),
(2,'Tes Lowongan 2','<p>Lowongan2</p>','berkas_persyaratan/5yKamvzZoJLZZK9EStXYvxcZKJLGJ4NDjmiSjkEj.pdf','2024-11-25 00:22:30','2024-11-25 00:22:30'),
(3,'tes','<p>fafsa</p>','berkas_persyaratan/OrLGKrJxAStAdYO9pHeCvpjsQ2iSQUce7OZEVCfs.png','2025-02-04 03:19:43','2025-02-04 03:19:43');

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
