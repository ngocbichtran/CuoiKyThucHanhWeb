-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 23, 2025 at 04:58 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thuchanhweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `DESCRIPTION` text,
  `ACTIVE_FLAG` int NOT NULL DEFAULT '1',
  `CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `TYPE`, `DESCRIPTION`, `ACTIVE_FLAG`, `CREATE_DATE`, `UPDATE_DATE`, `deleted_at`) VALUES
(105, 'Laptop', '123', 1, '2025-12-15 06:23:30', '2025-12-23 04:41:30', NULL),
(106, 'Cục Sạc', 'ok', 1, '2025-12-15 07:11:58', '2025-12-15 07:11:58', '2025-12-15 10:09:25'),
(107, 'Laptop213', 'dsa', 1, '2025-12-23 04:46:16', '2025-12-23 04:46:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_23_062550_add_google_id_to_users_table', 2),
(5, '2025_11_28_154308_create_products_table', 2),
(6, '2025_11_29_073921_create_categories_table', 2),
(14, '2025_11_30_112254_add_deleted_at_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` decimal(15,2) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_orders_user` (`user_id`),
  KEY `fk_orders_product` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `name`, `so_luong`, `don_gia`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 0, 'Áo thun Unisex', 2, 150000.00, 5, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(2, 0, 'Giày Sneaker Trắng', 1, 650000.00, 3, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(3, 0, 'Balo Laptop 15 inch', 1, 320000.00, 7, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(4, 0, 'Ốp lưng iPhone 12', 3, 90000.00, 9, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(5, 0, 'Tai nghe Bluetooth', 1, 250000.00, 3, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(6, 0, 'Sạc nhanh 20W', 2, 180000.00, 6, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(7, 0, 'Bình giữ nhiệt 500ml', 1, 210000.00, 8, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(8, 0, 'Kem chống nắng SPF50', 2, 125000.00, 4, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(9, 0, 'Mũ lưỡi trai đen', 1, 95000.00, 10, '2025-12-01 05:29:06', '2025-12-01 05:29:06', NULL, 0),
(10, 0, 'Áo khoác hoodie', 1, 350000.00, 11, '2025-12-01 05:29:06', '2025-12-01 01:16:02', NULL, 1),
(11, 1, 'Smartphone X', 1, 0.00, 4, '2025-11-30 22:50:37', '2025-12-01 01:15:24', NULL, 1),
(12, 1, 'Smartphone X', 4, 0.00, 4, '2025-11-30 22:50:43', '2025-12-01 01:14:57', NULL, 1),
(13, 1, 'Smartphone X', 1, 560.00, 4, '2025-11-30 22:52:01', '2025-12-01 01:14:56', NULL, 1),
(14, 1, 'Smartphone X', 3, 560.00, 4, '2025-11-30 22:55:42', '2025-12-01 01:14:55', NULL, 1),
(15, 1, 'Smartphone X', 3, 560.00, 4, '2025-11-30 22:58:12', '2025-12-01 01:14:53', NULL, 1),
(16, 2, 'Laptop Pro', 10, 0.00, 4, '2025-11-30 22:58:30', '2025-12-01 01:07:00', NULL, 1),
(17, 1, 'Smartphone X', 45, 560.00, 4, '2025-11-30 23:01:09', '2025-12-01 01:06:58', NULL, 1),
(18, 3, 'T-Shirt Cotton', 1, 0.00, 4, '2025-12-01 01:16:48', '2025-12-01 01:16:48', NULL, 0),
(19, 3, 'T-Shirt Cotton', 1, 0.00, 14, '2025-12-13 07:21:02', '2025-12-13 07:21:02', NULL, 0),
(20, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-13 09:04:09', '2025-12-13 09:04:09', NULL, 0),
(21, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-13 16:12:43', '2025-12-15 07:13:27', NULL, 1),
(22, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 01:40:24', '2025-12-15 07:13:22', NULL, 1),
(23, 3, 'T-Shirt Cotton', 1, 111.00, 14, '2025-12-14 02:16:02', '2025-12-14 02:16:02', NULL, 0),
(24, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:16:28', '2025-12-14 03:16:28', NULL, 0),
(25, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:17:12', '2025-12-14 03:17:12', NULL, 0),
(26, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:18:31', '2025-12-14 03:18:31', NULL, 0),
(27, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:46:20', '2025-12-14 03:46:20', NULL, 0),
(28, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:52:46', '2025-12-14 03:52:46', NULL, 0),
(29, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:53:05', '2025-12-15 07:05:06', NULL, 1),
(30, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:53:25', '2025-12-14 03:53:25', NULL, 0),
(31, 26, 'Smartphone X', 1, 100000000.00, 14, '2025-12-14 03:53:57', '2025-12-14 03:53:57', NULL, 0),
(32, 3, 'T-Shirt Cotton', 1, 111.00, 14, '2025-12-14 03:54:32', '2025-12-15 06:12:58', NULL, 1),
(33, 27, 'T-Shirt Cotton', 3, 1234567.00, 14, '2025-12-14 05:28:09', '2025-12-14 16:04:07', NULL, 1),
(34, 27, 'T-Shirt Cotton', 5, 1234567.00, 14, '2025-12-14 05:34:28', '2025-12-14 05:34:58', NULL, 1),
(35, 27, 'T-Shirt Cotton', 1, 1234567.00, 15, '2025-12-15 07:14:09', '2025-12-23 04:46:35', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ngocbich@gmail.com', '$2y$12$uZlXohc8cCiuU83bpSYG7OeAd0cqvCGK6PpxdxVE1ORJjfiMNVxGq', '2025-11-28 08:00:51'),
('haonguyen27042004@gmail.com', '$2y$12$gv2771nitvk9OohgC1ZI1.lG9exy3dDzIDnwaTVwkbHZS59ncuo7a', '2025-11-28 08:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

DROP TABLE IF EXISTS `product_info`;
CREATE TABLE IF NOT EXISTS `product_info` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CATE_ID` int NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` text,
  `IMG_URL` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ACTIVE_FLAG` int NOT NULL DEFAULT '1',
  `CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `PRICE` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `cateIDproductinfo_foreign_key` (`CATE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`ID`, `CATE_ID`, `NAME`, `DESCRIPTION`, `IMG_URL`, `ACTIVE_FLAG`, `CREATE_DATE`, `UPDATE_DATE`, `deleted_at`, `PRICE`) VALUES
(3, 105, 'T-Shirt Cotton', 'Áo thun 100% cotton ok', 'https://tse1.mm.bing.net/th/id/OIP._xoZRQW9Iqnf1uP6RzaFvAHaFj?pid=Api&P=0&h=180', 1, '2025-12-01 01:17:41', '2025-12-15 06:56:27', '2025-12-15 22:33:31', 113),
(25, 105, 'Smartphone X', 'ok', 'https://tse1.mm.bing.net/th/id/OIP._xoZRQW9Iqnf1uP6RzaFvAHaFj?pid=Api&P=0&h=180', 0, '2025-12-13 08:28:42', '2025-12-15 06:56:31', NULL, 0),
(26, 105, 'Smartphone X', 'tt', 'https://tse1.mm.bing.net/th/id/OIP._xoZRQW9Iqnf1uP6RzaFvAHaFj?pid=Api&P=0&h=180', 1, '2025-12-13 08:32:59', '2025-12-15 07:12:54', NULL, 200),
(27, 101, 'T-Shirt Cotton', 'ok', 'https://tse1.mm.bing.net/th/id/OIP._xoZRQW9Iqnf1uP6RzaFvAHaFj?pid=Api&P=0&h=180', 1, '2025-12-14 05:17:45', '2025-12-14 05:17:45', '2025-12-23 11:46:25', 1234567),
(28, 101, 'T-Shirt Cotton', 'ok', 'https://tse1.mm.bing.net/th/id/OIP._xoZRQW9Iqnf1uP6RzaFvAHaFj?pid=Api&P=0&h=180', 0, '2025-12-14 05:18:00', '2025-12-14 05:35:49', '2025-12-15 13:18:44', 1111),
(29, 105, 'iphone', NULL, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_744_1_29.png', 1, '2025-12-23 04:43:01', '2025-12-23 04:46:01', NULL, 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`, `google_id`, `deleted_at`) VALUES
(22, 'ngocbich', 'ngocbich345444@gmail.com', NULL, '$2y$12$.T/LVRDTkB512FFV5GMuI.x0wv/wmfoDSbsNB4i8aEa9HXp6LwSEa', NULL, 'admin', '2025-12-23 04:28:25', '2025-12-23 04:56:18', NULL, '2025-12-23 04:56:18'),
(21, 'ngocbich', 'ngocbich22222@gmail.com', NULL, '$2y$12$dSROga82d0C0OnX5yzlvzeIJw3YasCLaLlt7FnmEgTXnZrRFiVFeq', NULL, 'user', '2025-12-23 04:22:59', '2025-12-23 04:56:35', NULL, NULL),
(23, 'Hào HÀO', 'haonguyen27042004@gmail.com', NULL, '$2y$12$o9KIQ53UHJKV98vvw1aPleFyic0r.1yVit7So59ZjBRfnn8kKiIcu', NULL, 'admin', '2025-12-23 04:40:16', '2025-12-23 04:40:16', '103932584692793527440', NULL),
(20, 'ngocbich12', 'ngocbich3453@gmail.com', NULL, '$2y$12$sfT/KZp4dAv6g3SSz/rM5euNULCMWMucG0WehxPYbtoSm2VYj3XV.', NULL, 'user', '2025-12-23 04:04:00', '2025-12-23 04:57:01', NULL, NULL),
(19, 'Ngọc Bích Trần', 'ngocbich542004@gmail.com', NULL, '$2y$12$A7L8MhcclqEsiTKMjUSAke0WZURk2dnNc3JF4n8LeaX7aAPqe4fkS', NULL, 'admin', '2025-12-23 03:49:15', '2025-12-23 03:49:15', '107483547410970401580', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
