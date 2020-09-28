-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2020 at 09:39 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electwri_writers`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `message_id`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 4, 'test1.png', NULL, NULL),
(2, 4, 'test2.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Category 1', 'category-1', '2019-01-03 17:24:37', '2019-01-03 17:24:37'),
(2, NULL, 1, 'Category 2', 'category-2', '2019-01-03 17:24:37', '2019-01-03 17:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `completed_jobs`
--

CREATE TABLE `completed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_detail_id` int(11) DEFAULT NULL,
  `writer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `payment_status_id` int(11) DEFAULT NULL,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `completed_jobs`
--

INSERT INTO `completed_jobs` (`id`, `order_detail_id`, `writer_id`, `product_id`, `payment_status_id`, `files`, `created_at`, `updated_at`) VALUES
(1, 2, 306, 8, 1, '1599733995Early and Middle Adulthood.docx', '2020-09-09 07:33:15', '2020-09-09 07:33:15'),
(3, 3, 306, 8, 1, '1599735938Early and Middle Adulthood.docx', '2020-09-10 08:05:38', '2020-09-10 08:05:38'),
(5, 5, 4, 17, 1, '1599852914Early and Middle Adulthood.docx', '2020-09-11 16:35:14', '2020-09-11 16:35:14'),
(7, 7, 306, 28, 1, '16008615325f665b0119040.docx', '2020-09-23 08:45:32', '2020-09-23 08:45:32'),
(8, 8, 306, 13, 1, '16008618635f6990f746a3e.docx', '2020-09-23 08:51:03', '2020-09-23 08:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'locale', 'text', 'Locale', 0, 1, 1, 1, 1, 0, NULL, 12),
(12, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(13, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(14, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(15, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(16, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(17, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(18, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(19, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(20, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(21, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(22, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(23, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(24, 4, 'parent_id', 'select_dropdown', 'Parent', 0, 0, 1, 1, 1, 1, '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', 2),
(25, 4, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{\"default\":1}', 3),
(26, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 4),
(27, 4, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 5),
(28, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, NULL, 6),
(29, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(30, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(31, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, NULL, 2),
(32, 5, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, NULL, 3),
(33, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 4),
(34, 5, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 5),
(35, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 6),
(36, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(37, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(38, 5, 'meta_description', 'text_area', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 9),
(39, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 10),
(40, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(41, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 12),
(42, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 13),
(43, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, NULL, 14),
(44, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, NULL, 15),
(45, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(46, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, NULL, 2),
(47, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 3),
(48, 6, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 4),
(49, 6, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 5),
(50, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(51, 6, 'meta_description', 'text', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 7),
(52, 6, 'meta_keywords', 'text', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 8),
(53, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(54, 6, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 0, NULL, 10),
(55, 6, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(56, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, NULL, 12),
(57, 7, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(60, 7, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(61, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(64, 9, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(65, 9, 'format', 'text', 'Format', 0, 1, 1, 1, 1, 1, '{}', 2),
(66, 9, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(67, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(80, 16, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(81, 16, 'language', 'text', 'Language', 0, 1, 1, 1, 1, 1, '{}', 2),
(82, 16, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(83, 16, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(84, 17, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(85, 17, 'space', 'text', 'Space', 0, 1, 1, 1, 1, 1, '{}', 2),
(86, 17, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(87, 17, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(88, 18, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(89, 18, 'status', 'text', 'Status', 0, 1, 1, 1, 1, 1, '{}', 2),
(90, 18, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(91, 18, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(114, 21, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(115, 21, 'classification', 'text', 'Classification', 0, 1, 1, 1, 1, 1, '{}', 2),
(116, 21, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(117, 21, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(143, 26, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(144, 26, 'period', 'text', 'Period', 0, 1, 1, 1, 1, 1, '{}', 2),
(145, 26, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(146, 26, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(155, 28, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(158, 28, 'price', 'number', 'Price', 0, 1, 1, 1, 1, 1, '{}', 6),
(159, 28, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 9),
(160, 28, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 10),
(161, 28, 'product_belongsto_paper_classification_relationship', 'relationship', 'Classification', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\PaperClassification\",\"table\":\"paper_classifications\",\"type\":\"belongsTo\",\"column\":\"classification_id\",\"key\":\"id\",\"label\":\"classification\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(162, 28, 'product_belongsto_paper_preiod_relationship', 'relationship', 'Period', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\PaperPeriod\",\"table\":\"paper_periods\",\"type\":\"belongsTo\",\"column\":\"period_id\",\"key\":\"id\",\"label\":\"period\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(163, 29, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(164, 29, 'period', 'text', 'Period', 0, 1, 1, 1, 1, 1, '{}', 2),
(165, 29, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 3),
(166, 29, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(167, 7, 'type', 'text', 'Type', 0, 1, 1, 1, 1, 1, '{}', 2),
(168, 28, 'classification_id', 'text', 'Classification', 0, 1, 1, 1, 1, 1, '{}', 2),
(169, 28, 'period_id', 'text', 'Period', 0, 1, 1, 1, 1, 1, '{}', 4),
(170, 28, 'job_price', 'number', 'Job Price', 1, 1, 1, 1, 1, 1, '{}', 7),
(171, 28, 'penalty_price', 'number', 'Penalty Price', 1, 1, 1, 1, 1, 1, '{}', 8),
(172, 30, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(173, 30, 'order_detail_id', 'text', 'Order Detail Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(174, 30, 'writer_id', 'text', 'Writer Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(175, 30, 'product_id', 'text', 'Product Id', 0, 1, 1, 1, 1, 1, '{}', 5),
(176, 30, 'payment_status_id', 'text', 'Payment Status Id', 0, 1, 1, 1, 1, 1, '{}', 6),
(177, 30, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 8),
(178, 30, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 9),
(179, 30, 'completed_job_belongsto_user_relationship', 'relationship', 'Writer', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"writer_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4),
(180, 30, 'completed_job_belongsto_payment_status_relationship', 'relationship', 'payment_statuses', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\PaymentStatus\",\"table\":\"payment_statuses\",\"type\":\"belongsTo\",\"column\":\"payment_status_id\",\"key\":\"id\",\"label\":\"status\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(181, 31, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(182, 31, 'order_detail_id', 'text', 'Order Detail Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(183, 31, 'writer_id', 'text', 'Writer Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(184, 31, 'product_id', 'text', 'Product Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(185, 31, 'payment_status_id', 'text', 'Payment Status Id', 1, 1, 1, 1, 1, 1, '{}', 5),
(186, 31, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(187, 31, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(188, 32, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(189, 32, 'order_detail_id', 'text', 'Order Detail Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(190, 32, 'writer_id', 'text', 'Writer Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(191, 32, 'product_id', 'text', 'Product Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(192, 32, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(193, 32, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(194, 33, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(195, 33, 'reviewer_id', 'text', 'Reviewer Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(196, 33, 'completed_job_id', 'text', 'Completed Job Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(197, 33, 'review_status_id', 'text', 'Review Status Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(198, 33, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(199, 33, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(200, 30, 'files', 'text', 'Files', 1, 1, 1, 1, 1, 1, '{}', 6),
(209, 35, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(210, 35, 'sender_id', 'text', 'Sender Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(211, 35, 'reciever_id', 'text', 'Reciever Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(212, 35, 'subject', 'text', 'Subject', 0, 1, 1, 1, 1, 1, '{}', 4),
(213, 35, 'message', 'rich_text_box', 'Message', 0, 1, 1, 1, 1, 1, '{}', 5),
(214, 35, 'message_status_id', 'text', 'Message Status Id', 0, 1, 1, 1, 1, 1, '{}', 6),
(215, 35, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(216, 35, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(240, 41, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(241, 41, 'user_id', 'hidden', 'User Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(242, 41, 'total_qty', 'text', 'Total Qty', 1, 1, 1, 1, 1, 1, '{}', 4),
(243, 41, 'total_price', 'text', 'Total Price', 0, 1, 1, 1, 1, 1, '{}', 5),
(244, 41, 'payment_status_id', 'hidden', 'Payment Status Id', 0, 0, 0, 0, 0, 0, '{}', 6),
(245, 41, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 8),
(246, 41, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 9),
(247, 42, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(248, 42, 'review_id', 'text', 'Review Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(249, 42, 'writer_id', 'text', 'Writer Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(250, 42, 'amount_payable', 'text', 'Amount Payable', 1, 1, 1, 1, 1, 1, '{}', 4),
(251, 42, 'comments', 'text', 'Comments', 0, 1, 1, 1, 1, 1, '{}', 5),
(252, 42, 'payment_status_id', 'text', 'Payment Status Id', 1, 1, 1, 1, 1, 1, '{}', 6),
(253, 42, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(254, 42, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(255, 41, 'order_belongsto_user_relationship', 'relationship', 'Client', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\user\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"attachments\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(256, 41, 'order_belongsto_payment_status_relationship', 'relationship', 'Payment Status', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\PaymentStatus\",\"table\":\"payment_statuses\",\"type\":\"belongsTo\",\"column\":\"payment_status_id\",\"key\":\"id\",\"label\":\"status\",\"pivot_table\":\"attachments\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', '', '', 1, 0, NULL, '2019-01-03 17:24:25', '2019-01-03 17:24:25'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2019-01-03 17:24:26', '2019-01-03 17:24:26'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, NULL, '2019-01-03 17:24:26', '2019-01-03 17:24:26'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, '', '', 1, 0, NULL, '2019-01-03 17:24:36', '2019-01-03 17:24:36'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '', '', 1, 0, NULL, '2019-01-03 17:24:37', '2019-01-03 17:24:37'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '', '', 1, 0, NULL, '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(7, 'paper_types', 'paper-types', 'Paper Type', 'Paper Types', NULL, 'App\\PaperType', NULL, NULL, 'These are the types of papers that can be written by the Writers', 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-05 02:03:36', '2019-01-06 08:28:29'),
(9, 'paper_formats', 'paper-formats', 'Paper Format', 'Paper Formats', NULL, 'App\\PaperFormat', NULL, NULL, 'Paper formats', 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-05 06:53:58', '2019-01-05 06:53:58'),
(16, 'paper_languages', 'paper-languages', 'Paper Language', 'Paper Languages', NULL, 'App\\PaperLanguage', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-05 07:16:05', '2019-01-05 07:16:05'),
(17, 'paper_spacings', 'paper-spacings', 'Paper Spacing', 'Paper Spacings', NULL, 'App\\PaperSpacing', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-05 07:16:22', '2019-01-05 07:16:22'),
(18, 'project_statuses', 'project-statuses', 'Project Status', 'Project Statuses', NULL, 'App\\ProjectStatus', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-05 07:16:44', '2019-01-05 07:16:44'),
(21, 'paper_classifications', 'paper-classifications', 'Paper Classification', 'Paper Classifications', NULL, 'App\\PaperClassification', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-06 06:39:53', '2019-01-06 06:39:53'),
(26, 'paper_preiods', 'paper-preiods', 'Paper Preiod', 'Paper Preiods', NULL, 'App\\PaperPreiod', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-06 07:31:08', '2019-01-06 07:31:08'),
(28, 'products', 'products', 'Product', 'Products', 'voyager-list', 'App\\Product', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-06 08:08:45', '2019-01-14 08:42:25'),
(29, 'paper_periods', 'paper-periods', 'Paper Period', 'Paper Periods', NULL, 'App\\PaperPeriod', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-06 08:17:20', '2019-01-06 08:17:20'),
(30, 'completed_jobs', 'completed-jobs', 'Completed Job', 'Completed Jobs', NULL, 'App\\CompletedJob', NULL, '\\App\\Http\\Controllers\\Voyager\\CompletedJobController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-16 05:05:43', '2019-02-01 17:44:29'),
(31, 'deffered_jobs', 'deffered-jobs', 'Deffered Job', 'Deffered Jobs', NULL, 'App\\DefferedJob', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-28 06:19:20', '2019-01-28 06:19:20'),
(32, 'picked_jobs', 'picked-jobs', 'Picked Job', 'Picked Jobs', NULL, 'App\\PickedJob', NULL, '\\App\\Http\\Controllers\\Voyager\\PickedJobController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-01-28 06:19:53', '2019-04-04 17:36:24'),
(33, 'reviews', 'reviews', 'Review', 'Reviews', NULL, 'App\\Review', NULL, '\\App\\Http\\Controllers\\Voyager\\ReviewController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-02-01 17:10:30', '2019-02-07 05:42:24'),
(35, 'messages', 'messages', 'Message', 'Messages', NULL, 'App\\Message', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-02-21 00:06:29', '2019-02-21 00:06:29'),
(41, 'orders', 'orders', 'Order', 'Orders', NULL, 'App\\Order', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-02-27 16:51:56', '2019-04-10 11:52:52'),
(42, 'payables', 'payables', 'Payable', 'Payables', NULL, 'App\\Payable', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-02-27 18:34:57', '2019-02-27 18:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `deffered_jobs`
--

CREATE TABLE `deffered_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_detail_id` int(11) DEFAULT NULL,
  `writer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `payment_status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-01-03 17:24:27', '2019-01-03 17:24:27'),
(2, 'main_menu', '2019-01-30 01:47:16', '2019-01-30 01:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2019-01-03 17:24:27', '2019-01-03 17:24:27', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 13, '2019-01-03 17:24:27', '2019-02-27 16:52:46', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, 17, 1, '2019-01-03 17:24:27', '2019-01-05 02:26:18', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 17, 2, '2019-01-03 17:24:27', '2019-01-05 02:26:18', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 11, '2019-01-03 17:24:27', '2019-02-27 16:52:46', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2019-01-03 17:24:27', '2019-01-05 02:20:18', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2019-01-03 17:24:27', '2019-01-05 02:20:18', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2019-01-03 17:24:28', '2019-01-05 02:20:18', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2019-01-03 17:24:28', '2019-01-05 02:20:18', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 12, '2019-01-03 17:24:28', '2019-02-27 16:52:46', 'voyager.settings.index', NULL),
(11, 1, 'Categories', '', '_self', 'voyager-categories', NULL, NULL, 9, '2019-01-03 17:24:36', '2019-02-27 16:52:46', 'voyager.categories.index', NULL),
(12, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 6, '2019-01-03 17:24:38', '2019-02-27 16:52:46', 'voyager.posts.index', NULL),
(13, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, NULL, 8, '2019-01-03 17:24:39', '2019-02-27 16:52:46', 'voyager.pages.index', NULL),
(14, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2019-01-03 17:24:42', '2019-01-05 02:20:18', 'voyager.hooks', NULL),
(15, 1, 'Paper Types', '', '_self', NULL, '#000000', 16, 1, '2019-01-05 02:03:37', '2019-01-05 02:50:37', 'voyager.paper-types.index', 'null'),
(16, 1, 'Configurations', '', '_self', 'voyager-character', '#000000', NULL, 10, '2019-01-05 02:20:02', '2019-02-27 16:52:46', NULL, ''),
(17, 1, 'User Management', '', '_self', 'voyager-group', '#000000', NULL, 2, '2019-01-05 02:25:56', '2019-01-05 02:26:11', NULL, ''),
(19, 1, 'Paper Formats', '', '_self', NULL, NULL, 16, 2, '2019-01-05 06:53:58', '2019-01-06 06:40:45', 'voyager.paper-formats.index', NULL),
(23, 1, 'Paper Languages', '', '_self', NULL, NULL, 16, 3, '2019-01-05 07:16:05', '2019-01-06 06:40:45', 'voyager.paper-languages.index', NULL),
(24, 1, 'Paper Spacings', '', '_self', NULL, NULL, 16, 5, '2019-01-05 07:16:23', '2019-01-05 07:26:56', 'voyager.paper-spacings.index', NULL),
(27, 1, 'E-Commerce', '', '_self', 'voyager-basket', '#000000', NULL, 5, '2019-01-06 05:37:49', '2019-01-28 06:30:19', NULL, ''),
(31, 1, 'Paper Classifications', '', '_self', NULL, NULL, 16, 4, '2019-01-06 06:39:53', '2019-01-06 06:40:45', 'voyager.paper-classifications.index', NULL),
(38, 1, 'Products', 'admin/products', '_self', 'voyager-bag', '#000000', NULL, 3, '2019-01-06 08:08:45', '2019-01-28 06:30:19', NULL, ''),
(39, 1, 'Paper Periods', '', '_self', NULL, NULL, 16, 6, '2019-01-06 08:17:20', '2019-01-28 06:02:03', 'voyager.paper-periods.index', NULL),
(40, 1, 'Completed Jobs', '', '_self', NULL, NULL, 42, 2, '2019-01-16 05:05:43', '2019-01-28 06:21:19', 'voyager.completed-jobs.index', NULL),
(42, 1, 'Jobs Management', '', '_self', 'voyager-list', '#000000', NULL, 4, '2019-01-28 06:10:10', '2019-01-28 06:31:20', NULL, ''),
(43, 1, 'Deffered Jobs', '', '_self', NULL, NULL, 42, 3, '2019-01-28 06:19:20', '2019-01-28 06:21:19', 'voyager.deffered-jobs.index', NULL),
(44, 1, 'Picked Jobs', '', '_self', NULL, NULL, 42, 1, '2019-01-28 06:19:54', '2019-01-28 06:21:19', 'voyager.picked-jobs.index', NULL),
(45, 2, 'Home', '', '_self', NULL, '#000000', NULL, 1, '2019-01-30 01:47:40', '2019-03-06 06:04:15', NULL, ''),
(46, 2, 'Our Services', '/our-services', '_self', NULL, '#000000', NULL, 2, '2019-01-30 01:48:58', '2020-07-23 06:52:33', NULL, ''),
(47, 1, 'Reviews', '', '_self', NULL, NULL, 42, 4, '2019-02-01 17:10:31', '2019-02-01 17:11:13', 'voyager.reviews.index', NULL),
(49, 1, 'Messages', '', '_self', 'voyager-mail', '#000000', NULL, 7, '2019-02-21 00:06:30', '2019-02-27 16:52:46', 'voyager.messages.index', 'null'),
(53, 1, 'Orders', '', '_self', NULL, NULL, 27, 1, '2019-02-27 16:51:56', '2019-02-27 16:52:57', 'voyager.orders.index', NULL),
(54, 1, 'Payables', '', '_self', NULL, NULL, 27, 2, '2019-02-27 18:34:58', '2019-02-27 18:35:17', 'voyager.payables.index', NULL),
(55, 2, 'Guarantees', '/guarantees', '_blank', NULL, '#000000', NULL, 14, '2020-04-01 06:28:38', '2020-04-01 06:29:53', NULL, ''),
(56, 2, 'How It Works', '/how-it-works', '_self', NULL, '#000000', NULL, 15, '2020-07-23 06:51:40', '2020-07-23 06:51:40', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `reciever_id` int(11) DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `message_status_id` int(11) DEFAULT NULL,
  `attachment` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `subject`, `message`, `message_status_id`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 4, 5, 'test', 'test message', 1, '0', '2019-03-06 09:08:31', '2020-09-10 16:22:19'),
(2, 5, 2, 'Quote: Looking for Web App Developers.', 'test', 2, '0', '2019-03-06 09:09:56', '2019-03-06 09:09:56'),
(3, 2, 5, 'test message to writer', '<p>test response</p>', 1, '0', '2019-03-06 09:11:13', '2020-09-10 16:22:36'),
(4, 1, 1, 'test', 'test test test', 2, '0', '2020-09-10 16:14:28', '2020-09-10 16:14:28'),
(5, 6, 4, 'Hi', 'Get additional files.', 1, '0', '2020-09-11 16:10:20', '2020-09-11 16:39:40'),
(6, 6, 4, 'Thanks.', 'Thank you.', 1, '0', '2020-09-11 16:37:42', '2020-09-11 16:39:24'),
(7, 4, 6, 'Hello', 'Give me your details to work for you on the side.', 1, '0', '2020-09-11 16:42:48', '2020-09-11 16:43:18'),
(8, 329, 306, 'Re-uploading of document', 'Hi! I edited the previous document I sent and I hope you\'ll use this newly uploaded one as your reference instead. Please also note that I have a 650 word limit. Thank you!', 2, '0', '2020-09-19 19:00:14', '2020-09-19 19:00:14'),
(9, 302, 332, 'FOLLOW UP', 'Hello Diya,   \r\n          \r\nIts Ray we talked earlier.\r\nWe\'ve been expecting from you, did you manage to make your order?\r\nIf you need further assistance, kindly let us know and we will be glad to assist you at any time.\r\n\r\nRegards\r\nRay.', 2, '0', '2020-09-22 09:59:20', '2020-09-22 09:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `message_statuses`
--

CREATE TABLE `message_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_statuses`
--

INSERT INTO `message_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'read', NULL, NULL),
(2, 'unread', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2016_01_01_000000_create_pages_table', 2),
(24, '2016_01_01_000000_create_posts_table', 2),
(25, '2016_02_15_204651_create_categories_table', 2),
(26, '2017_04_11_000000_alter_post_nullable_fields_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `payment_status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_qty`, `total_price`, `payment_status_id`, `created_at`, `updated_at`) VALUES
(1, 5, '1', 90, 2, '2019-04-08 02:46:35', '2019-04-08 02:46:35'),
(2, 322, '1', 40, 2, '2020-09-09 12:49:57', '2020-09-09 12:49:57'),
(3, 322, '1', 30, 2, '2020-09-10 01:12:53', '2020-09-10 01:12:53'),
(4, 6, '1', 120, 2, '2020-09-11 10:14:32', '2020-09-11 10:14:32'),
(5, 6, '1', 350, 2, '2020-09-11 10:14:32', '2020-09-11 10:14:32'),
(6, 6, '1', 77, 2, '2020-09-11 10:16:45', '2020-09-11 10:16:45'),
(7, 329, '1', 10, 2, '2020-09-19 16:24:49', '2020-09-19 16:24:49'),
(8, 322, '1', 20, 2, '2020-09-22 02:51:51', '2020-09-22 02:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `uniqueId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_detail_status_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `pages` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `format_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `sources` int(11) DEFAULT NULL,
  `spacing_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `files` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `uniqueId`, `order_id`, `product_id`, `order_detail_status_id`, `quantity`, `pages`, `subject`, `type_id`, `format_id`, `language_id`, `sources`, `spacing_id`, `description`, `files`, `deadline`, `created_at`, `updated_at`) VALUES
(1, '5caae03b47d35', 1, 6, 3, 1, 2, 'Test testing 123', 6, 3, 1, 3, 1, 'Paper details', '', '2019-04-08 11:44:38', '2019-04-08 02:46:35', '2019-04-10 10:23:49'),
(2, '5f58f9a58d294', 2, 8, 3, 1, 4, 'Late adulthood death', 1, 1, 1, 3, 2, 'Paper details', '1599666362inbound6048688886627328449.jpg', '2020-09-09 21:44:52', '2020-09-09 12:49:57', '2020-09-09 07:34:15'),
(3, '5f59a7c58bc30', 3, 8, 3, 1, 3, 'Early and Middle Adulthood', 1, 1, 1, 2, 2, 'dose not need to be the 1050 words 875 is fine thus i said 3 pages', '1599711075Screenshot_20200909-203054_Gallery.jpg', '2020-09-11 10:07:44', '2020-09-10 01:12:53', '2020-09-10 08:08:03'),
(4, '5caae03b47d37', 4, 16, 2, 1, 7, 'Help Content Writing 1', 1, 1, 1, 2, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Help.pdf', '2020-09-23 13:18:20', '2020-09-11 10:18:20', '2020-09-12 05:50:00'),
(5, '5caae03b47d38', 5, 17, 3, 1, 7, 'Help Content Writing 2', 1, 1, 1, 2, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Help.pdf', '2020-09-22 13:18:20', '2020-09-11 10:18:20', '2020-09-11 16:36:04'),
(6, '5caae03b47d39', 6, 18, 2, 1, 7, 'Help Content Writing 3', 1, 1, 1, 2, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Help.pdf', '2020-09-26 13:26:52', '2020-09-11 10:26:52', '2020-09-13 03:31:09'),
(7, '5f665b0119040', 7, 28, 3, 1, 1, 'Common App Essay for schools I will be applying to', 2, 1, 1, 0, 1, 'I am from the Philippines and attached here is my admission essay for Common App. I\'ve been searching all over the internet for cheap alternatives to have this proofread and checked because I come from a low income family. I hope you can help criticize and improve my essay, and hopefully increase my chances of getting accepted. Thank you so much!', '1600543311Common App.docx', '2020-09-30 19:15:55', '2020-09-19 16:24:49', '2020-09-23 08:53:01'),
(8, '5f6990f746a3e', 8, 13, 3, 1, 2, 'Strategic Management Journal Part 1', 1, 1, 1, 0, 2, 'If you have any questions email me at moisesbvasquez001@gmail.com \r\n\r\nAssignment Content\r\n\r\nRead the Strategic Management Project Background document.\r\n\r\n\r\n\r\nReview the resources listed at the end of this assignment along with the terms and concepts discussed this week to prepare for this assignment:\r\n\r\nstrategic management\r\ncompetitive advantage\r\nstrategic plan\r\nmission statement\r\nvision statement\r\ncore values statement\r\nAFI\r\n\r\n\r\nCreate a Word document and title it Strategic Management Research Journal Part 1.\r\n\r\n \r\n\r\nWrite a 500- to 700-word response to the following prompts as your journal entry:\r\n\r\nJustify the guiding principles required for preparing effective statements that describe the mission, vision, and the core values of an organization as covered in the assigned reading. \r\nCompare whether Caterpillar Inc.’s mission, vision, and core values conform to the guiding principles in the text and support organizational strategic planning principles as justified in prompt #1. Refer to the Caterpillar Inc. website listed in the Resources section below.\r\nAssess what Caterpillar Inc.’s current competitive advantages and disadvantages are by considering their business partners, allies, and general operations. Research the assignment resources listed below. Based on your research, evaluate Caterpillar’s current competitive advantages and disadvantages.\r\nNote: You will use information from this entry in your Strategic Management Research Project Presentation due in Week 5.', '1600753850Screenshot_20200921-224339_Office Editor.jpg', '2020-09-30 17:49:40', '2020-09-22 02:51:51', '2020-09-23 08:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail_statuses`
--

CREATE TABLE `order_detail_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail_statuses`
--

INSERT INTO `order_detail_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', NULL, NULL),
(2, 'Processing', NULL, NULL),
(3, 'Complete', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Our Services', 'Elect Writing is designed to get you the extra help you need in completing your next university essay. We match the best academic writers, qualified across an enormous range of subjects and grades, to requests for help from students just like you. Writing in perfect English, our writers will create a custom piece of work designed just for you and to help you reach the grade you require.', '<div class=\"row\">\r\n<div class=\"col-sm-8\">\r\n<h2 class=\"border-bottom mt-4\">Why Choose Our Essay Writing Service</h2>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: \'Open Sans\', sans-serif; font-size: 15.2px;\">Using an essay writing service is one of the best ways to improve your own academic writing skills and to do better at university. Whether you&rsquo;re studying in the US, UK or any other country; at undergraduate, masters or a different level; returning to education after a long break or just struggling with a specific topic, we can help!</p>\r\n<p class=\"mb-3 mb-md-5\" style=\"box-sizing: border-box; margin-top: 0px; color: #212529; font-family: \'Open Sans\', sans-serif; font-size: 15.2px; margin-bottom: 3rem !important;\">We think the best way to highlight the quality of our essay writing service is to show you our work &ndash; it speaks for itself! We&rsquo;ve produced some fantastic samples that show you exactly the kind of work you&rsquo;ll receive when ordering from us. Take a look at our sample essays&nbsp;<span style=\"font-size: 15.2px;\">&nbsp;</span><span style=\"font-size: 15.2px;\">prepared at undergraduate and master\'s level across a range of grades and subjects.</span></p>\r\n</div>\r\n<div class=\"col-sm-4\">\r\n<h2 class=\"border-bottom mt-4\">Contact Us</h2>\r\n<address><strong>Start Bootstrap</strong> <br />1460 Westwood Blvd<br />Los Angeles, California</address><address><abbr title=\"Phone\">P:</abbr>&nbsp;(310) 919-5473 <br /> <abbr title=\"Email\">E:</abbr> <a href=\"mailto:#\">info@electwriting.com</a></address></div>\r\n</div>\r\n<h2 class=\"border-bottom\">Our Services</h2>\r\n<h4 class=\"MsoNormal\"><span style=\"text-decoration: underline;\"><strong>Online Classes</strong></span></h4>\r\n<p class=\"MsoNormal\">For a class that is <strong>less than 10 weeks</strong> we charge as follows:</p>\r\n<p class=\"MsoNormal\">1. <strong>$800</strong> for a guaranteed grade of <strong>(A or A-)</strong></p>\r\n<p class=\"MsoNormal\">2. <strong>$600</strong> for a guaranteed grade of <strong>(B+, B or B-)</strong></p>\r\n<p class=\"MsoNormal\">3. Any class with a grade of C+ or less will not be charged and the payment made refunded to the&nbsp;client.</p>\r\n<p class=\"MsoNormal\">For a class that is <strong>more than 10 weeks</strong> we charge as follows:</p>\r\n<p class=\"MsoNormal\">1. <strong>$1,000</strong> for a guaranteed grade of <strong>A or A</strong>-.</p>\r\n<p class=\"MsoNormal\">2. <strong>$800</strong> for a guaranteed grade of <strong>B+, B or B-</strong>.</p>\r\n<p class=\"MsoNormal\">3. Any class with a grade of C+ or less will not be charged and the deposit refunded to the&nbsp;client.</p>\r\n<p class=\"MsoNormal\"><strong>NB.</strong> <strong>Before the beginning of the class the client needs to pay at least $400 (for a class that is 10 weeks or less) or $500 (for a class that is more than 10 weeks) and complete the balance at the midway point of the class.</strong></p>\r\n<h4 class=\"MsoNormal\"><span style=\"text-decoration: underline;\"><strong>Dissertation</strong></span></h4>\r\n<p class=\"MsoNormal\">A dissertation is a larger piece of work on a subject of your choice that is typically completed at the end of a university course - either in an undergraduate or master\'s degree or as your PhD thesis.</p>\r\n<p class=\"MsoNormal\">Dissertations usually aim to fill a gap in the student\'s knowledge about a topic or else offer a new take on an old topic.</p>\r\n<p class=\"MsoNormal\">Your dissertation is likely to be the toughest project you will encounter in your degree and often forms a large part of your overall grade.</p>\r\n<p class=\"MsoNormal\">Our Dissertation Writing Service is specifically designed to help you read, write and research to the best of your ability..</p>\r\n<p class=\"MsoNormal\">&nbsp;</p>', 'pages/February2019/bMhXdIWrEqpkJdE3HhZv.png', 'our-services', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2019-01-03 17:24:39', '2020-07-23 06:53:37'),
(2, 1, 'Guarantees', 'Providing quality work is core to our beliefs, which is why we will strive to give you exactly that, and more! We know that your education is worth far more than just the cost of your order – all the work we produce is written by individually selected industry experts, including barristers, doctors, lecturers and nurses to name a few. What you get from us is a promise to produce the best possible work to aid you in your learning - simple!', '<p>&nbsp;</p>\r\n<p class=\"MsoNormal\"><strong><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Plagiarism-free, every time</span></strong></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Every piece of work we deliver comes with a dedicated plagiarism report. Not only is all work we produce plagiarism free, but we\'ll prove it, too. Just like industry-approved Turnitin, our plagiarism scanner will scan against online resources, as well as our own database of previous work, to check for any similarities. </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><strong><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Always on Time</span></strong></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">We stand firm by our commitment to deliver your work on time. So much so that, even if we are a minute late, the work is on us - it\'s free! Throughout the journey we will maintain regular contact with you and we have a panel of dedicated writers on standby, just in case any problems arise. We guarantee you peace of mind every time!</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><strong><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Written to Standard</span></strong></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">We\'re extremely proud of our work - all of our assignments go through a stringent quality checking process from start to finish. So, as soon as our writers have completed your work, it is proofread, checked for any errors and given a thorough plagiarism scan. We don\'t stop there - we produce a beautiful quality report and will check all the points that you requested have been clearly covered before we finally release your assignment! </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><strong><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Perfectly Written Work</span></strong></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Every order placed is unique &ndash; just like you. That&rsquo;s why you can be certain you&rsquo;ll receive an excellently written, bespoke, fully referenced and perfectly matched model answer for you. We never re-use or re-sell any model answer we have created, it&rsquo;s tailor made just for you.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><strong><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Quality, Verified</span></strong></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Our in-house team of experts &ndash; the Quality Control team &ndash; review every model answer individually. Every piece of work is personally inspected before delivery to you and any corrections made before the work is delivered.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><strong><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">In-depth Plagiarism Scan</span></strong></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',\'serif\';\">Every order we deliver comes with a complimentary plagiarism scan that shows the uniqueness of the work we produce. We scan the order against the whole internet, proving no content has been copied from anywhere else and that your model answer is 100% unique.</span></p>\r\n<div class=\"col-sm-6 col-md-4 mb-4 mb-md-0\" style=\"box-sizing: border-box; position: relative; width: 379.984px; padding-right: 15px; padding-left: 15px; flex: 0 0 33.3333%; max-width: 33.3333%; color: #212529; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif; font-size: 16px; margin-bottom: 0px !important;\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>', 'pages/April2020/aRH90papkY4eljmAwtMN.png', 'guarantees', 'guarantees', 'guarantees', 'ACTIVE', '2020-04-01 06:15:51', '2020-07-23 07:31:50'),
(3, 1, 'How It Works', 'At Elect Writing, we connect students like you to expert writers, who will help ensure you succeed in your education and career. An experience with Elect Writing,is like no other. We help students achieve better marks by providing you with a perfectly written model answer that aims to give you everything you need to do just that.\r\n\r\nWe walk with you, every step of the way, making sure you get the help and support you need with your studies. Students who work with Elect Writing, can improve their grades, learn more and gain better writing skills – becoming better, more well-rounded students. Learn more about how we work hand in hand with you to boost your grades!', '<h2 class=\"text-center\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2; font-size: 2rem; color: #212529; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif; text-align: center !important;\">How Elect Writing Works</h2>\r\n<p class=\"text-center mb-5\" style=\"box-sizing: border-box; margin-top: 0px; color: #212529; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif; font-size: 16px; margin-bottom: 3rem !important; text-align: center !important;\">At Elect Writing, we like to keep things simple and transparent. Every step of our process is clear and open and has been perfected over 10+ years to make sure you get the very best quality work and exactly what you&rsquo;ve requested. Nobody else has been in the industry as long as we have &ndash; and in our opinion, nobody does it better!</p>\r\n<ol class=\"list-unstyled\" style=\"box-sizing: border-box; margin-bottom: 1rem; margin-top: 0px; padding-left: 50px; list-style: none; counter-reset: b 0; color: #212529; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif; font-size: 16px;\">\r\n<li style=\"box-sizing: border-box; position: relative; counter-increment: b 1;\">\r\n<h3 class=\"h4\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2; font-size: 1.5rem;\">1. Tell us what you need</h3>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem;\">We can help with virtually any type of work you&rsquo;re completing. Choose from one of our writing services and give us your requirements, from word length to level required. Our in-house experts will review your order request and make sure we have everything we need to do a fantastic job.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; position: relative; counter-increment: b 1;\">\r\n<h3 class=\"h4\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2; font-size: 1.5rem;\">2. We\'ll find you the perfect writer</h3>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem;\">An expert writer will be individually chosen based on your requirements and then assigned to help with your order. They&rsquo;ll create you a bespoke model answer that covers every aspect of your requirements &ndash; perfectly detailed, expertly referenced and always tailored to you.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; position: relative; counter-increment: b 1;\">\r\n<h3 class=\"h4\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.2; font-size: 1.5rem;\">3. Download the work</h3>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem;\">Our in-house academics ensure the work is at the highest quality, no ifs or buts. They go through every sentence of the work, from top to bottom, making sure there are no mistakes and that everything meets your requirements.</p>\r\n</li>\r\n</ol>', 'pages/July2020/oShbQSEOB7fR3ENtXPdC.png', 'how-it-works', 'how it works', 'how it works', 'ACTIVE', '2020-07-23 06:49:33', '2020-07-23 07:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `paper_classifications`
--

CREATE TABLE `paper_classifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `classification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_classifications`
--

INSERT INTO `paper_classifications` (`id`, `classification`, `created_at`, `updated_at`) VALUES
(1, 'High School', '2019-01-06 06:44:12', '2019-01-06 06:44:12'),
(2, 'Diploma', '2019-01-06 06:44:21', '2019-01-06 06:44:21'),
(3, 'Under Graduate', '2019-01-06 06:44:33', '2019-01-06 06:44:33'),
(4, 'Masters', '2019-01-06 06:44:41', '2019-01-06 06:44:41'),
(5, 'Doctorate', '2019-01-06 06:45:01', '2019-01-06 06:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `paper_formats`
--

CREATE TABLE `paper_formats` (
  `id` int(10) UNSIGNED NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_formats`
--

INSERT INTO `paper_formats` (`id`, `format`, `created_at`, `updated_at`) VALUES
(1, 'APA', '2019-01-05 07:42:53', '2019-01-05 07:42:53'),
(2, 'MLA', '2019-01-05 07:43:01', '2019-01-05 07:43:01'),
(3, 'Chicago', '2019-01-05 07:43:12', '2019-01-05 07:43:12'),
(4, 'Harvard', '2019-01-05 07:43:23', '2019-01-05 07:43:23'),
(5, 'Oxford', '2019-01-05 07:43:31', '2019-01-05 07:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `paper_languages`
--

CREATE TABLE `paper_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_languages`
--

INSERT INTO `paper_languages` (`id`, `language`, `created_at`, `updated_at`) VALUES
(1, 'English-US', '2019-01-05 07:44:02', '2019-01-05 07:44:02'),
(2, 'English-UK', '2019-01-05 07:44:16', '2019-01-05 07:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `paper_periods`
--

CREATE TABLE `paper_periods` (
  `id` int(10) UNSIGNED NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_periods`
--

INSERT INTO `paper_periods` (`id`, `period`, `created_at`, `updated_at`) VALUES
(1, '3 Hours', '2019-01-06 07:32:23', '2019-01-06 07:32:23'),
(2, '6 Hours', '2019-01-06 07:32:33', '2019-01-06 07:32:33'),
(3, '12 Hours', '2019-01-06 07:32:55', '2019-01-06 07:32:55'),
(4, '18 Hours', '2019-01-06 07:33:04', '2019-01-06 07:33:04'),
(5, '24 Hours', '2019-01-06 07:33:14', '2019-01-06 07:33:14'),
(6, '48 Hours', '2019-01-06 07:33:34', '2019-01-06 07:33:34'),
(7, '3 Days', '2019-01-06 07:33:43', '2019-01-06 07:33:43'),
(8, '4 Days', '2019-01-06 07:34:14', '2019-01-06 07:34:14'),
(9, '5 Days', '2019-01-06 07:34:23', '2019-01-06 07:34:23'),
(10, '6 Days', '2019-01-06 07:34:32', '2019-01-06 07:34:32'),
(11, '7 Days', '2019-01-06 07:34:39', '2019-01-06 07:34:39'),
(12, '8 Days', '2019-01-06 07:34:48', '2019-01-06 07:34:48'),
(13, '10 Days', '2019-01-06 07:34:56', '2019-01-06 07:34:56'),
(14, '14 Days', '2019-01-06 07:35:05', '2019-01-06 07:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `paper_spacings`
--

CREATE TABLE `paper_spacings` (
  `id` int(10) UNSIGNED NOT NULL,
  `space` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_spacings`
--

INSERT INTO `paper_spacings` (`id`, `space`, `created_at`, `updated_at`) VALUES
(1, '1 Single Space', '2019-01-05 07:44:57', '2019-01-05 07:44:57'),
(2, 'Double Space', '2019-01-05 07:45:07', '2019-01-05 07:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `paper_types`
--

CREATE TABLE `paper_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_types`
--

INSERT INTO `paper_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Essay (Any Type)', '2019-01-05 02:08:12', '2019-01-05 02:08:12'),
(2, 'Admission Essay', '2019-01-05 02:09:12', '2019-01-05 02:09:12'),
(3, 'Annotated Bibliography', '2019-01-05 02:09:42', '2019-01-05 02:09:42'),
(4, 'Argumentative Essay', '2019-01-05 02:10:02', '2019-01-05 02:10:02'),
(5, 'Article review', '2019-01-05 02:10:35', '2019-01-05 02:10:35'),
(6, 'Book/Movie Review', '2019-01-05 02:12:00', '2019-01-05 02:13:07'),
(7, 'Business Plan', '2019-01-05 02:13:28', '2019-01-05 02:13:28'),
(8, 'Case Study', '2019-01-05 02:13:45', '2019-01-05 02:13:45'),
(9, 'Course Work', '2019-01-05 02:14:01', '2019-01-05 02:14:01'),
(10, 'Creative Writting', '2019-01-05 02:14:17', '2019-01-05 02:14:17'),
(11, 'Critical Thinking', '2019-01-05 02:14:34', '2019-01-05 02:14:34'),
(12, 'Presentation or Speech', '2019-01-05 02:14:55', '2019-01-05 02:14:55'),
(13, 'Research Paper', '2019-01-05 02:15:10', '2019-01-05 02:15:10'),
(14, 'Research Proposal', '2019-01-05 02:15:30', '2019-01-05 02:15:30'),
(15, 'Term Paper', '2019-01-05 02:15:45', '2019-01-05 02:15:45'),
(16, 'Thesis/Dessertation Chapter', '2019-01-05 02:16:18', '2019-01-05 02:16:18'),
(17, 'Other', '2019-01-05 02:16:31', '2019-01-05 02:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payables`
--

CREATE TABLE `payables` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `amount_payable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `payment_status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payables`
--

INSERT INTO `payables` (`id`, `order_detail_id`, `review_id`, `writer_id`, `amount_payable`, `comments`, `payment_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, '38', 'Approved for payment', 1, '2019-04-10 10:23:49', '2019-04-10 10:23:49'),
(2, 2, 2, 306, '12', 'Approved for payment', 1, '2020-09-10 07:34:15', '2020-09-10 07:34:15'),
(3, 3, 3, 306, '9', 'Approved for payment', 1, '2020-09-10 08:08:03', '2020-09-10 08:08:03'),
(4, 5, 5, 4, '21', 'Approved for payment', 2, '2020-09-11 16:36:00', '2020-09-11 16:48:50'),
(5, 8, 7, 306, '6', 'Approved for payment', 1, '2020-09-23 08:52:46', '2020-09-23 08:52:46'),
(6, 7, 8, 306, '3', 'Approved for payment', 1, '2020-09-23 08:53:01', '2020-09-23 08:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Unpaid', NULL, NULL),
(2, 'Paid', NULL, NULL),
(3, 'Blocked', NULL, NULL),
(4, 'Penalty', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(2, 'browse_bread', NULL, '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(3, 'browse_database', NULL, '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(4, 'browse_media', NULL, '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(5, 'browse_compass', NULL, '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(6, 'browse_menus', 'menus', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(7, 'read_menus', 'menus', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(8, 'edit_menus', 'menus', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(9, 'add_menus', 'menus', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(10, 'delete_menus', 'menus', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(11, 'browse_roles', 'roles', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(12, 'read_roles', 'roles', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(13, 'edit_roles', 'roles', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(14, 'add_roles', 'roles', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(15, 'delete_roles', 'roles', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(16, 'browse_users', 'users', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(17, 'read_users', 'users', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(18, 'edit_users', 'users', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(19, 'add_users', 'users', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(20, 'delete_users', 'users', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(21, 'browse_settings', 'settings', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(22, 'read_settings', 'settings', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(23, 'edit_settings', 'settings', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(24, 'add_settings', 'settings', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(25, 'delete_settings', 'settings', '2019-01-03 17:24:29', '2019-01-03 17:24:29'),
(26, 'browse_categories', 'categories', '2019-01-03 17:24:36', '2019-01-03 17:24:36'),
(27, 'read_categories', 'categories', '2019-01-03 17:24:36', '2019-01-03 17:24:36'),
(28, 'edit_categories', 'categories', '2019-01-03 17:24:37', '2019-01-03 17:24:37'),
(29, 'add_categories', 'categories', '2019-01-03 17:24:37', '2019-01-03 17:24:37'),
(30, 'delete_categories', 'categories', '2019-01-03 17:24:37', '2019-01-03 17:24:37'),
(31, 'browse_posts', 'posts', '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(32, 'read_posts', 'posts', '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(33, 'edit_posts', 'posts', '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(34, 'add_posts', 'posts', '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(35, 'delete_posts', 'posts', '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(36, 'browse_pages', 'pages', '2019-01-03 17:24:39', '2019-01-03 17:24:39'),
(37, 'read_pages', 'pages', '2019-01-03 17:24:39', '2019-01-03 17:24:39'),
(38, 'edit_pages', 'pages', '2019-01-03 17:24:39', '2019-01-03 17:24:39'),
(39, 'add_pages', 'pages', '2019-01-03 17:24:39', '2019-01-03 17:24:39'),
(40, 'delete_pages', 'pages', '2019-01-03 17:24:39', '2019-01-03 17:24:39'),
(41, 'browse_hooks', NULL, '2019-01-03 17:24:42', '2019-01-03 17:24:42'),
(42, 'browse_paper_types', 'paper_types', '2019-01-05 02:03:36', '2019-01-05 02:03:36'),
(43, 'read_paper_types', 'paper_types', '2019-01-05 02:03:36', '2019-01-05 02:03:36'),
(44, 'edit_paper_types', 'paper_types', '2019-01-05 02:03:36', '2019-01-05 02:03:36'),
(45, 'add_paper_types', 'paper_types', '2019-01-05 02:03:36', '2019-01-05 02:03:36'),
(46, 'delete_paper_types', 'paper_types', '2019-01-05 02:03:36', '2019-01-05 02:03:36'),
(52, 'browse_paper_formats', 'paper_formats', '2019-01-05 06:53:58', '2019-01-05 06:53:58'),
(53, 'read_paper_formats', 'paper_formats', '2019-01-05 06:53:58', '2019-01-05 06:53:58'),
(54, 'edit_paper_formats', 'paper_formats', '2019-01-05 06:53:58', '2019-01-05 06:53:58'),
(55, 'add_paper_formats', 'paper_formats', '2019-01-05 06:53:58', '2019-01-05 06:53:58'),
(56, 'delete_paper_formats', 'paper_formats', '2019-01-05 06:53:58', '2019-01-05 06:53:58'),
(72, 'browse_paper_languages', 'paper_languages', '2019-01-05 07:16:05', '2019-01-05 07:16:05'),
(73, 'read_paper_languages', 'paper_languages', '2019-01-05 07:16:05', '2019-01-05 07:16:05'),
(74, 'edit_paper_languages', 'paper_languages', '2019-01-05 07:16:05', '2019-01-05 07:16:05'),
(75, 'add_paper_languages', 'paper_languages', '2019-01-05 07:16:05', '2019-01-05 07:16:05'),
(76, 'delete_paper_languages', 'paper_languages', '2019-01-05 07:16:05', '2019-01-05 07:16:05'),
(77, 'browse_paper_spacings', 'paper_spacings', '2019-01-05 07:16:23', '2019-01-05 07:16:23'),
(78, 'read_paper_spacings', 'paper_spacings', '2019-01-05 07:16:23', '2019-01-05 07:16:23'),
(79, 'edit_paper_spacings', 'paper_spacings', '2019-01-05 07:16:23', '2019-01-05 07:16:23'),
(80, 'add_paper_spacings', 'paper_spacings', '2019-01-05 07:16:23', '2019-01-05 07:16:23'),
(81, 'delete_paper_spacings', 'paper_spacings', '2019-01-05 07:16:23', '2019-01-05 07:16:23'),
(82, 'browse_project_statuses', 'project_statuses', '2019-01-05 07:16:44', '2019-01-05 07:16:44'),
(83, 'read_project_statuses', 'project_statuses', '2019-01-05 07:16:44', '2019-01-05 07:16:44'),
(84, 'edit_project_statuses', 'project_statuses', '2019-01-05 07:16:44', '2019-01-05 07:16:44'),
(85, 'add_project_statuses', 'project_statuses', '2019-01-05 07:16:44', '2019-01-05 07:16:44'),
(86, 'delete_project_statuses', 'project_statuses', '2019-01-05 07:16:44', '2019-01-05 07:16:44'),
(92, 'browse_paper_classifications', 'paper_classifications', '2019-01-06 06:39:53', '2019-01-06 06:39:53'),
(93, 'read_paper_classifications', 'paper_classifications', '2019-01-06 06:39:53', '2019-01-06 06:39:53'),
(94, 'edit_paper_classifications', 'paper_classifications', '2019-01-06 06:39:53', '2019-01-06 06:39:53'),
(95, 'add_paper_classifications', 'paper_classifications', '2019-01-06 06:39:53', '2019-01-06 06:39:53'),
(96, 'delete_paper_classifications', 'paper_classifications', '2019-01-06 06:39:53', '2019-01-06 06:39:53'),
(117, 'browse_paper_preiods', 'paper_preiods', '2019-01-06 07:31:08', '2019-01-06 07:31:08'),
(118, 'read_paper_preiods', 'paper_preiods', '2019-01-06 07:31:08', '2019-01-06 07:31:08'),
(119, 'edit_paper_preiods', 'paper_preiods', '2019-01-06 07:31:08', '2019-01-06 07:31:08'),
(120, 'add_paper_preiods', 'paper_preiods', '2019-01-06 07:31:08', '2019-01-06 07:31:08'),
(121, 'delete_paper_preiods', 'paper_preiods', '2019-01-06 07:31:08', '2019-01-06 07:31:08'),
(127, 'browse_products', 'products', '2019-01-06 08:08:45', '2019-01-06 08:08:45'),
(128, 'read_products', 'products', '2019-01-06 08:08:45', '2019-01-06 08:08:45'),
(129, 'edit_products', 'products', '2019-01-06 08:08:45', '2019-01-06 08:08:45'),
(130, 'add_products', 'products', '2019-01-06 08:08:45', '2019-01-06 08:08:45'),
(131, 'delete_products', 'products', '2019-01-06 08:08:45', '2019-01-06 08:08:45'),
(132, 'browse_paper_periods', 'paper_periods', '2019-01-06 08:17:20', '2019-01-06 08:17:20'),
(133, 'read_paper_periods', 'paper_periods', '2019-01-06 08:17:20', '2019-01-06 08:17:20'),
(134, 'edit_paper_periods', 'paper_periods', '2019-01-06 08:17:20', '2019-01-06 08:17:20'),
(135, 'add_paper_periods', 'paper_periods', '2019-01-06 08:17:20', '2019-01-06 08:17:20'),
(136, 'delete_paper_periods', 'paper_periods', '2019-01-06 08:17:20', '2019-01-06 08:17:20'),
(137, 'browse_completed_jobs', 'completed_jobs', '2019-01-16 05:05:43', '2019-01-16 05:05:43'),
(138, 'read_completed_jobs', 'completed_jobs', '2019-01-16 05:05:43', '2019-01-16 05:05:43'),
(139, 'edit_completed_jobs', 'completed_jobs', '2019-01-16 05:05:43', '2019-01-16 05:05:43'),
(140, 'add_completed_jobs', 'completed_jobs', '2019-01-16 05:05:43', '2019-01-16 05:05:43'),
(141, 'delete_completed_jobs', 'completed_jobs', '2019-01-16 05:05:43', '2019-01-16 05:05:43'),
(142, 'browse_deffered_jobs', 'deffered_jobs', '2019-01-28 06:19:20', '2019-01-28 06:19:20'),
(143, 'read_deffered_jobs', 'deffered_jobs', '2019-01-28 06:19:20', '2019-01-28 06:19:20'),
(144, 'edit_deffered_jobs', 'deffered_jobs', '2019-01-28 06:19:20', '2019-01-28 06:19:20'),
(145, 'add_deffered_jobs', 'deffered_jobs', '2019-01-28 06:19:20', '2019-01-28 06:19:20'),
(146, 'delete_deffered_jobs', 'deffered_jobs', '2019-01-28 06:19:20', '2019-01-28 06:19:20'),
(147, 'browse_picked_jobs', 'picked_jobs', '2019-01-28 06:19:53', '2019-01-28 06:19:53'),
(148, 'read_picked_jobs', 'picked_jobs', '2019-01-28 06:19:53', '2019-01-28 06:19:53'),
(149, 'edit_picked_jobs', 'picked_jobs', '2019-01-28 06:19:53', '2019-01-28 06:19:53'),
(150, 'add_picked_jobs', 'picked_jobs', '2019-01-28 06:19:53', '2019-01-28 06:19:53'),
(151, 'delete_picked_jobs', 'picked_jobs', '2019-01-28 06:19:53', '2019-01-28 06:19:53'),
(152, 'browse_reviews', 'reviews', '2019-02-01 17:10:30', '2019-02-01 17:10:30'),
(153, 'read_reviews', 'reviews', '2019-02-01 17:10:30', '2019-02-01 17:10:30'),
(154, 'edit_reviews', 'reviews', '2019-02-01 17:10:30', '2019-02-01 17:10:30'),
(155, 'add_reviews', 'reviews', '2019-02-01 17:10:30', '2019-02-01 17:10:30'),
(156, 'delete_reviews', 'reviews', '2019-02-01 17:10:30', '2019-02-01 17:10:30'),
(157, 'browse_payments', 'payments', '2019-02-07 06:44:28', '2019-02-07 06:44:28'),
(158, 'read_payments', 'payments', '2019-02-07 06:44:28', '2019-02-07 06:44:28'),
(159, 'edit_payments', 'payments', '2019-02-07 06:44:28', '2019-02-07 06:44:28'),
(160, 'add_payments', 'payments', '2019-02-07 06:44:28', '2019-02-07 06:44:28'),
(161, 'delete_payments', 'payments', '2019-02-07 06:44:28', '2019-02-07 06:44:28'),
(162, 'browse_messages', 'messages', '2019-02-21 00:06:29', '2019-02-21 00:06:29'),
(163, 'read_messages', 'messages', '2019-02-21 00:06:29', '2019-02-21 00:06:29'),
(164, 'edit_messages', 'messages', '2019-02-21 00:06:29', '2019-02-21 00:06:29'),
(165, 'add_messages', 'messages', '2019-02-21 00:06:29', '2019-02-21 00:06:29'),
(166, 'delete_messages', 'messages', '2019-02-21 00:06:29', '2019-02-21 00:06:29'),
(182, 'browse_orders', 'orders', '2019-02-27 16:51:56', '2019-02-27 16:51:56'),
(183, 'read_orders', 'orders', '2019-02-27 16:51:56', '2019-02-27 16:51:56'),
(184, 'edit_orders', 'orders', '2019-02-27 16:51:56', '2019-02-27 16:51:56'),
(185, 'add_orders', 'orders', '2019-02-27 16:51:56', '2019-02-27 16:51:56'),
(186, 'delete_orders', 'orders', '2019-02-27 16:51:56', '2019-02-27 16:51:56'),
(187, 'browse_payables', 'payables', '2019-02-27 18:34:58', '2019-02-27 18:34:58'),
(188, 'read_payables', 'payables', '2019-02-27 18:34:58', '2019-02-27 18:34:58'),
(189, 'edit_payables', 'payables', '2019-02-27 18:34:58', '2019-02-27 18:34:58'),
(190, 'add_payables', 'payables', '2019-02-27 18:34:58', '2019-02-27 18:34:58'),
(191, 'delete_payables', 'payables', '2019-02-27 18:34:58', '2019-02-27 18:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(45, 1),
(46, 1),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(55, 1),
(56, 1),
(72, 1),
(72, 2),
(73, 1),
(73, 2),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(77, 2),
(78, 1),
(78, 2),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(85, 1),
(86, 1),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(95, 1),
(96, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(132, 2),
(133, 1),
(133, 2),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(137, 2),
(138, 1),
(138, 2),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(152, 2),
(153, 1),
(153, 2),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1);

-- --------------------------------------------------------

--
-- Table structure for table `picked_jobs`
--

CREATE TABLE `picked_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_detail_id` int(11) DEFAULT NULL,
  `writer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `picked_jobs`
--

INSERT INTO `picked_jobs` (`id`, `order_detail_id`, `writer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(9, 4, 4, 16, '2020-09-12 05:50:00', '2020-09-12 05:50:00'),
(11, 6, 4, 18, '2020-09-13 03:31:09', '2020-09-13 03:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Lorem Ipsum Post', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/post1.jpg', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(2, 1, NULL, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/post2.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(3, 1, NULL, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/post3.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2019-01-03 17:24:38', '2019-01-03 17:24:38'),
(4, 1, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/post4.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2019-01-03 17:24:38', '2019-01-03 17:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `classification_id` int(11) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penalty_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `classification_id`, `period_id`, `price`, `job_price`, `penalty_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '10.00', '3', '1', '2017-11-21 01:10:11', '2020-04-13 23:23:47'),
(2, 2, 1, '10.00', '3', '1', '2019-01-03 17:24:37', '2020-04-13 22:11:03'),
(3, 3, 1, '10.00', '3', '1', '2017-11-20 11:13:00', '2020-04-14 00:58:33'),
(4, 4, 1, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 22:57:47'),
(5, 5, 1, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 22:58:20'),
(6, 1, 2, '10.00', '3', '1', '2017-11-20 11:13:00', '2020-04-14 00:57:08'),
(7, 2, 2, '10.00', '3', '1', '2017-11-20 12:36:34', '2020-04-14 00:54:21'),
(8, 3, 2, '10.00', '3', '1', '2017-11-20 11:45:14', '2020-04-14 00:57:58'),
(9, 4, 2, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 22:58:59'),
(10, 5, 2, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 22:59:32'),
(11, 1, 3, '10.00', '3', '1', '2017-11-20 12:36:34', '2020-04-14 00:54:53'),
(12, 2, 3, '10.00', '3', '1', '2017-11-20 12:36:34', '2020-04-14 00:55:20'),
(13, 3, 3, '10.00', '3', '1', '2017-11-20 11:13:00', '2020-04-14 00:56:37'),
(14, 4, 3, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:01:51'),
(15, 5, 3, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:02:42'),
(16, 1, 4, '10.00', '3', '1', '2017-11-20 12:36:35', '2020-04-14 00:52:18'),
(17, 2, 4, '10.00', '3', '1', '2017-11-21 01:10:11', '2020-04-13 23:24:17'),
(18, 3, 4, '10.00', '3', '1', '2017-11-20 11:46:58', '2020-04-14 00:55:54'),
(19, 4, 4, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:03:17'),
(20, 5, 4, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:03:52'),
(21, 1, 5, '10.00', '3', '1', '2017-11-21 01:10:11', '2020-04-13 23:24:48'),
(22, 2, 5, '10.00', '3', '1', '2017-11-21 01:10:11', '2020-04-14 00:45:19'),
(23, 3, 5, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:04:22'),
(24, 4, 5, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:04:52'),
(25, 5, 5, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:05:48'),
(26, 1, 6, '10.00', '3', '1', '2017-11-21 01:10:11', '2020-04-14 00:46:09'),
(27, 2, 6, '10.00', '3', '1', '2017-11-21 01:10:12', '2020-04-13 23:21:50'),
(28, 3, 6, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:08:03'),
(29, 4, 6, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:08:40'),
(30, 5, 6, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:09:53'),
(31, 1, 7, '10.00', '3', '1', '2017-11-21 01:10:12', '2020-04-13 23:23:22'),
(32, 2, 7, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:13:53'),
(33, 3, 7, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:14:48'),
(34, 4, 7, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:15:32'),
(35, 5, 7, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:15:58'),
(36, 1, 8, '10.00', '3', '1', '2017-11-20 12:36:35', '2020-04-14 00:53:22'),
(37, 2, 8, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:16:25'),
(38, 3, 8, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:18:05'),
(39, 4, 8, '10.00', '3', '1', '2017-11-22 04:00:00', '2020-04-13 23:18:55'),
(40, 5, 8, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:17:11'),
(41, 1, 9, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:17:47'),
(42, 2, 9, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:18:42'),
(43, 3, 9, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:20:19'),
(44, 4, 9, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:21:42'),
(45, 5, 9, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:22:13'),
(46, 1, 10, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:22:55'),
(47, 2, 10, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:23:27'),
(48, 3, 10, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:23:57'),
(49, 4, 10, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:37:25'),
(50, 5, 10, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:37:54'),
(51, 1, 11, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:38:24'),
(52, 2, 11, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:39:20'),
(53, 3, 11, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:43:04'),
(54, 4, 11, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:43:38'),
(55, 5, 11, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:45:52'),
(56, 1, 12, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:46:52'),
(57, 2, 12, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:47:40'),
(58, 3, 12, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:48:38'),
(59, 4, 12, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:49:55'),
(60, 5, 12, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:50:37'),
(61, 1, 13, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:51:23'),
(62, 2, 13, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:54:00'),
(63, 3, 13, '10.00', '3', '1', '2017-11-22 04:00:01', '2020-04-13 22:57:05'),
(64, 4, 13, '10.00', '3', '1', '2017-11-22 04:00:02', '2020-04-13 21:43:28'),
(65, 5, 13, '10.00', '3', '1', '2017-11-22 04:00:02', '2020-04-13 22:11:55'),
(66, 1, 14, '10.00', '3', '1', '2017-11-22 04:00:02', '2020-04-13 22:12:52'),
(67, 2, 14, '10.00', '3', '1', '2017-11-21 07:51:50', '2020-04-13 23:19:54'),
(68, 3, 14, '10.00', '3', '1', '2017-11-22 04:00:02', '2020-04-13 22:14:01'),
(69, 4, 14, '10.00', '3', '1', '2017-11-22 04:00:02', '2020-04-13 22:15:59'),
(70, 5, 14, '10.00', '3', '1', '2017-11-20 11:45:26', '2020-04-14 00:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `rejects`
--

CREATE TABLE `rejects` (
  `id` int(10) UNSIGNED NOT NULL,
  `review_id` int(11) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rejects`
--

INSERT INTO `rejects` (`id`, `review_id`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rejected for correction', '2019-04-04 17:42:57', '2019-04-04 17:42:57'),
(2, 3, 'Rejected for correction', '2019-04-08 03:01:11', '2019-04-08 03:01:11'),
(3, 3, 'Rejected for correction', '2019-04-08 03:06:05', '2019-04-08 03:06:05'),
(4, 3, 'Rejected for correction', '2019-04-08 03:08:56', '2019-04-08 03:08:56'),
(5, 4, 'Rejected for correction', '2020-09-11 16:29:01', '2020-09-11 16:29:01'),
(6, 6, 'Rejected for correction', '2020-09-23 08:49:27', '2020-09-23 08:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `completed_job_id` int(11) DEFAULT NULL,
  `review_status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `reviewer_id`, `completed_job_id`, `review_status_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, '2019-04-10 10:23:44', '2019-04-10 10:23:44'),
(2, 3, 1, 1, '2020-09-10 07:34:02', '2020-09-10 07:34:02'),
(3, 3, 3, 1, '2020-09-10 08:07:04', '2020-09-10 08:07:04'),
(4, 1, 4, 3, '2020-09-11 16:28:27', '2020-09-11 16:29:01'),
(5, 1, 5, 1, '2020-09-11 16:35:42', '2020-09-11 16:35:42'),
(6, 1, 6, 3, '2020-09-23 08:47:41', '2020-09-23 08:49:27'),
(7, 1, 8, 1, '2020-09-23 08:52:41', '2020-09-23 08:52:41'),
(8, 1, 7, 1, '2020-09-23 08:52:57', '2020-09-23 08:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `review_statuses`
--

CREATE TABLE `review_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_statuses`
--

INSERT INTO `review_statuses` (`id`, `review`, `created_at`, `updated_at`) VALUES
(1, 'pending', NULL, NULL),
(2, 'approved', NULL, NULL),
(3, 'rejected', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2019-01-03 17:24:28', '2019-01-03 17:24:28'),
(2, 'Editor', 'Editor', '2019-01-03 17:24:28', '2019-01-04 07:21:30'),
(3, 'Writer', 'Writer', '2019-01-04 07:22:37', '2019-01-04 07:22:37'),
(4, 'Client', 'Client', '2019-01-04 11:14:50', '2019-01-04 11:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Elect Writing', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Precisely Where Vision Meets Intellect', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings/November2019/EPwcP9HwZVmRV7ko5Ouu.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 6, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 4, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Elect Writing', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Writers\' Paradise. Precisely Where Vision Meets Intellect', '', 'text', 1, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 2, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', 'settings/January2019/n39Wp2G3vFyMvIrhIIYH.png', '', 'image', 3, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 5, 'Admin'),
(11, 'site.site_about', 'about', 'Elect Writing is designed to get you the extra help you need in completing your next essay. We match the best academic writers, qualified across an enormous range of subjects and grades to help you. Writing in perfect English, our writers will create a custom piece of work designed just for you and to help you reach the level you require.', NULL, 'text_area', 4, 'Site'),
(13, 'social-media.google', 'Google', NULL, NULL, 'text', 7, 'Social media'),
(14, 'social-media.facebook', 'Facebook', 'https://www.facebook.com/electwriting/', NULL, 'text', 8, 'Social media'),
(15, 'social-media.twitter', 'Twitter', 'https://twitter.com/ElectWriting', NULL, 'text', 9, 'Social media'),
(16, 'social-media.instagram', 'Instagram', 'https://www.instagram.com/electwritingofficial/', NULL, 'text', 10, 'Social media'),
(17, 'social-media.linkedin', 'LinkedIn', NULL, NULL, 'text', 11, 'Social media'),
(19, 'contacts.email', 'Email address', 'info@electwriting.com', NULL, 'text', 12, 'Contacts'),
(20, 'contacts.office_number', 'Official phone number', '+ 01 (310) 919-5473', NULL, 'text', 13, 'Contacts'),
(21, 'contacts.mobile_number', 'Mobile phone number', '+ 01 (310) 919-5473', NULL, 'text', 14, 'Contacts'),
(22, 'contacts.address1', 'Physical address', '1460 Westwood Blvd, Los Angeles, California', NULL, 'text', 15, 'Contacts'),
(23, 'products.essay', 'Essays', 'Essays', NULL, 'text', 16, 'Products'),
(24, 'products.speech', 'Speech', 'Speech', NULL, 'text', 17, 'Products'),
(25, 'products.research', 'Research', 'Research', NULL, 'text', 18, 'Products'),
(26, 'products.course_work', 'Course Work', 'Course Work', NULL, 'text', 19, 'Products'),
(27, 'bank.details', 'Details', '<p>Bank account details</p>\r\n<dl class=\"param\">\r\n<dt>BANK:</dt>\r\n<dd>THE WORLD BANK</dd>\r\n</dl>\r\n<dl class=\"param\">\r\n<dt>Account number:</dt>\r\n<dd>12345678912345</dd>\r\n</dl>\r\n<dl class=\"param\">\r\n<dt>IBAN:</dt>\r\n<dd>123456789</dd>\r\n</dl>', NULL, 'rich_text_box', 20, 'Bank'),
(28, 'site.jumbotron', 'Jumbotron', '<h2>Everything you need to know about the art of Writing. Free!</h2>\r\n<p class=\"lead\">Subscribe here in below and start learning.<br />We are ready for you!</p>', NULL, 'rich_text_box', 21, 'Site'),
(29, 'site.home', 'Home', '<h2 class=\"text-center\">Get Your Paper Written By A Professional Writer.</h2>\r\n<p><span style=\"color: #222222; font-family: Arial, Helvetica, sans-serif; font-size: small;\">Place an order today and experience writers with the highest satisfaction rates, lowest prices on the market, security, confidentiality, and money back guarantee!</span></p>', NULL, 'rich_text_box', 22, 'Site'),
(30, 'site.terms', 'terms', '<ul>\r\n<li>Point one</li>\r\n<li>Point two</li>\r\n<li>Point three</li>\r\n<li>And all</li>\r\n</ul>', NULL, 'rich_text_box', 23, 'Site');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) NOT NULL,
  `fee` double NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `trans_id`, `client_id`, `type`, `amount`, `currency`, `fee`, `sender`, `receiver`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, '5ca62dc282a63', 5, 'paypal Deposit', 120, 'USD', 0, 'bgcreations123@gmail.com', 'bgcreations123ewallet@gmail.com', 'approved', 'Your transaction description', '2019-04-04 13:16:02', '2019-04-04 13:16:02'),
(2, '5ca6605065cf0', 5, 'paypal Deposit', 56, 'USD', 0, 'bgcreations123@gmail.com', 'bgcreations123ewallet@gmail.com', 'approved', 'Your transaction description', '2019-04-04 16:51:44', '2019-04-04 16:51:44'),
(3, '5caae03b5aa0c', 5, 'paypal Deposit', 90, 'USD', 0, 'bgcreations123@gmail.com', 'bgcreations123ewallet@gmail.com', 'approved', 'Your transaction description', '2019-04-08 02:46:35', '2019-04-08 02:46:35'),
(4, '5f58f9a58d8e6', 322, 'paypal Deposit', 40, 'USD', 0, 'moisesbvasquez001@gmail.com', 'akangoarthur@gmail.com', 'approved', 'Your transaction description', '2020-09-09 12:49:57', '2020-09-09 12:49:57'),
(5, '5f59a7c58c574', 322, 'paypal Deposit', 30, 'USD', 0, 'moisesbvasquez001@gmail.com', 'akangoarthur@gmail.com', 'approved', 'Your transaction description', '2020-09-10 01:12:53', '2020-09-10 01:12:53'),
(6, '5f665b011afc6', 329, 'paypal Deposit', 10, 'USD', 0, 'ruthkwongyap@gmail.com', 'akangoarthur@gmail.com', 'approved', 'Your transaction description', '2020-09-19 16:24:49', '2020-09-19 16:24:49'),
(7, '5f6990f74739c', 322, 'paypal Deposit', 20, 'USD', 0, 'moisesbvasquez001@gmail.com', 'akangoarthur@gmail.com', 'approved', 'Your transaction description', '2020-09-22 02:51:51', '2020-09-22 02:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2019-01-03 17:24:39', '2019-01-03 17:24:39'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2019-01-03 17:24:40', '2019-01-03 17:24:40'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2019-01-03 17:24:41', '2019-01-03 17:24:41'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2019-01-03 17:24:41', '2019-01-03 17:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@admin.com', 'users/January2019/go43OuhWdWMynevOCa7P.jpg', NULL, '$2y$10$HH/ojpzJ0QV5jTHjN22hO.tNhYTacWN0.9VkiTk94zn1BhAkKLi42', 'jA5ZGpCfuJxnonytV2In74bssbQEPcLO7vhdGrT8dh9lCl9p28m8ryZLjSBe', '{\"locale\":\"en\"}', '2019-01-03 17:24:37', '2019-01-04 07:26:46'),
(2, 1, 'Gabriel Okumu Jumah', 'bgcreations123@gmail.com', 'users/January2019/BgZtcM5rFddpysXzDuGp.jpg', NULL, '$2y$10$hHoDCzWxemWuBwnJ83CMe.FwWkDs.2Ovoo6f00yoaihFsP5VCQ80O', 'aefMmCqQJuJAzKNcSEF1xU2uYbk5pDStodo4c9n1Bdj4YVn6n6cyiiMuINnk', '{\"locale\":\"en\"}', '2019-01-04 07:20:02', '2019-01-04 07:25:47'),
(3, 2, 'Eddy Murphy', 'editor@editor.com', 'users/January2019/YrBm68vR3epN6U8ccYSL.jpg', NULL, '$2y$10$OpfCk93sfo9vu..LOVrm5.sq/swrM6bkXzas0s/4pyRleUOcTMf22', 'pZHY714JtRrwmKXWbZk5qaZCk5lR9nqmYpNrUO7xdoCUth6ZGzoePuSpgZa0', '{\"locale\":\"en\"}', '2019-01-04 07:24:21', '2019-01-04 07:26:15'),
(4, 3, 'Rian Wryt', 'writer@writer.com', 'users/January2019/UGkHQqfsPbeZbUtjq5SW.jpeg', NULL, '$2y$10$NqPFxoIMHFDUriZagtsskurUrkK4G7eirbn5xMiWbtf./hN2F/bSS', 'r1SE2Js0hUntVFrPzoTZKfPET8zM9bKmNhKlDP4o4g7PZcms0fLZhaY9yGLM', '{\"locale\":\"en\"}', '2019-01-04 07:25:02', '2019-01-07 04:36:31'),
(5, 4, 'Evelyn Darlyne', 'eve@gmail.com', 'users/January2019/suW6CO5WPca6X5qBfAVW.jpg', NULL, '$2y$10$q2Qc.2ylq/G9izfohU9IdOQmgKDKjJoMnLFiP/bg5gL7tX0iNnHJ.', 'yhCEj37EhL8Pt0zAWQMJK0Vn54bFDpoDXrolqflp1HclS2YmbkcbIldYu2Yu', '{\"locale\":\"en\"}', '2019-01-04 11:17:46', '2019-01-08 04:56:19'),
(6, 4, 'Michael Jesse', 'user@user.com', 'users/February2019/fyQ8g2tJd4xYXyMle7Rx.png', NULL, '$2y$10$RWZynqSFGLwJYwDWbiQSHeXCCchshipt2TKTWShE3l6PPiYZhQXj2', 'CvphB3D6I4QoU6LbWUD3oUu7PiuF9eSXrIH8i9T4gnlROebqTUZNqL43jHQ8', '{\"locale\":\"en\"}', '2019-02-07 10:27:43', '2019-02-07 10:58:13'),
(7, 4, 'Beaulah Torphy', 'roberthedetniemi@gmail.com', 'users/default.png', NULL, '$2y$10$TfAuglGdxnOps1HFlaNzBu.KmuHgpij63DX1QXD7g2niqQLKSGgcK', NULL, NULL, '2020-01-08 19:03:30', '2020-01-08 19:03:30'),
(8, 4, 'Bud Moore', 'sm69th@yahoo.com', 'users/default.png', NULL, '$2y$10$.e9P4LQeEtno4zkzlyGun.LljyyzdrPk1z7NonKZhOEL9KvTvYj.G', NULL, NULL, '2020-01-09 04:20:53', '2020-01-09 04:20:53'),
(9, 4, 'Harmon Torp', 'info@goodbuygear.com', 'users/default.png', NULL, '$2y$10$bSnYEFfrxfwZNi0q1Z6XceglXKj5aOfMx7L.bUUYTL7E6..fNRZpW', NULL, NULL, '2020-01-09 12:20:01', '2020-01-09 12:20:01'),
(10, 4, 'Ms. Dock Heidenreich', 'lwade@oxy.edu', 'users/default.png', NULL, '$2y$10$SHmdOHZqG6mnSa.maeR4MeLEWcxhoHzawPRE7qXsekJF3oHUK.7Ga', NULL, NULL, '2020-01-10 07:47:50', '2020-01-10 07:47:50'),
(11, 4, 'Issac Williamson', 'verena-1997@web.de', 'users/default.png', NULL, '$2y$10$n48Htn3nv4y/vGTmCwIgH.DzVQtxCNAoF89xTvcXKikC9HwGIhTXC', NULL, NULL, '2020-01-17 10:56:50', '2020-01-17 10:56:50'),
(12, 4, 'Jettie Kulas', 'repromedsa@gmail.com', 'users/default.png', NULL, '$2y$10$JiRAngCEUbEVVYpuvRMQVONc2g.2Syv6FCppoA31uDzaI8Fntauqe', NULL, NULL, '2020-01-18 03:41:32', '2020-01-18 03:41:32'),
(13, 4, 'Mrs. Robin Kulas', 'michaelfcellucci@gmail.com', 'users/default.png', NULL, '$2y$10$LU0WI7I0wPEvG1b0ddjc4OG6.gDJTm5fJN9rtJbUSNJKdYP079foK', NULL, NULL, '2020-01-18 14:22:37', '2020-01-18 14:22:37'),
(14, 4, 'Citlalli Lueilwitz I', 'repromed.adelaide@gmail.com', 'users/default.png', NULL, '$2y$10$IFL0AVtSwwN10u9sWE18fuu/mp5uKDpbWlqIyX8m.R2oKSOUsPEkm', NULL, NULL, '2020-01-20 19:19:58', '2020-01-20 19:19:58'),
(15, 4, 'Abigale Walter Jr.', 'dennishawk59@yahoo.com', 'users/default.png', NULL, '$2y$10$NY5dLx9IvFxZ6UbLYmMsu.KK8kvab/PIYUsVAwdlUu6agZPOWvXKa', NULL, NULL, '2020-01-24 12:20:42', '2020-01-24 12:20:42'),
(16, 4, 'Russ Yundt IV', 'bach@sea.nildram.co.uk', 'users/default.png', NULL, '$2y$10$XuqRToLaVlsVaOMF3FZneuz64NnWQ9EnhY0T3QcLbIpbL1TGw3wQm', NULL, NULL, '2020-01-25 06:01:00', '2020-01-25 06:01:00'),
(17, 4, 'Gene Rempel', 'etienneecs@gmail.com', 'users/default.png', NULL, '$2y$10$gnGbPkqa8igy/rVFFe6ffeZPERur7AEa6B0FE7wMopVakk/AHvd/e', NULL, NULL, '2020-01-25 17:51:39', '2020-01-25 17:51:40'),
(18, 4, 'Duane Jones', 'usedcellphone.pay@gmail.com', 'users/default.png', NULL, '$2y$10$FPRw7aFOnkZcfo3earcYhe8oF19/vCGVO14Af3eG3yBh9Lj/6oArS', NULL, NULL, '2020-01-28 16:27:13', '2020-01-28 16:27:13'),
(19, 4, 'Jeromy Dooley', 'rholladay@gmail.com', 'users/default.png', NULL, '$2y$10$.EpjmckEiH.GrG5tY2AN3uOzI0rv1Enwrh/CiyEmJmsN5JfCC0xwy', NULL, NULL, '2020-01-31 07:55:46', '2020-01-31 07:55:47'),
(20, 4, 'Sofia', 'youngtarey1@gmail.com', 'users/default.png', NULL, '$2y$10$xSD5yW1rfCUxuvok3PxHnOVreFxnb5UINZg0Vh9BXxKoe7wF2tSQO', NULL, NULL, '2020-02-03 15:51:17', '2020-02-03 15:51:17'),
(21, 4, 'Felton Buckridge', 'markfrichardson@yahoo.com', 'users/default.png', NULL, '$2y$10$zjfqjcGn2sP9FWf5/By.bOO1oG5m8njwDsfLEZ3/voSC9qGjiaf.2', NULL, NULL, '2020-02-05 06:29:36', '2020-02-05 06:29:37'),
(22, 4, 'Alvera O\'Conner II', 'jsmedic@hotmail.com', 'users/default.png', NULL, '$2y$10$Mzk.zmUS0qNcIntatr7buOs4zeQFNSyzKF93g7vL4wYrO88CY54te', NULL, NULL, '2020-02-07 16:50:33', '2020-02-07 16:50:33'),
(23, 4, 'Jaycee McKenzie', 'idohair2@ptd.net', 'users/default.png', NULL, '$2y$10$TD3HeIXKlTah8/cuVflUUOU/ujmWbpnojuWFjP5X94zIpxxoJ.gaW', NULL, NULL, '2020-02-13 02:46:37', '2020-02-13 02:46:37'),
(24, 4, 'Theresia Rau', 'dawnb2uk@hotmail.co.uk', 'users/default.png', NULL, '$2y$10$aCoRRuvqUw/a/cR6DlKyg.FEovdDAh2TvkAqCkkjl1bOUsbU5AsPC', NULL, NULL, '2020-02-13 18:55:24', '2020-02-13 18:55:24'),
(25, 4, 'Betsy Conn', 'rickhodgman@gmail.com', 'users/default.png', NULL, '$2y$10$Lz7PXaq8XUr.sJqWGF91wOrcYn6igkfSxc5pE5BPwUDZi6Dc/Xzfq', NULL, NULL, '2020-02-13 19:54:17', '2020-02-13 19:54:18'),
(26, 4, 'Katherine Schmeler', 'alexthiemann@yahoo.com', 'users/default.png', NULL, '$2y$10$CufMX1VjmScJoibK0ZA8mOYh6CKzHX/okpN37uOxSULC1elbPzGge', NULL, NULL, '2020-02-17 10:02:47', '2020-02-17 10:02:47'),
(27, 4, 'Patsy Sauer', 'trix67@gmail.com', 'users/default.png', NULL, '$2y$10$UQ/VbhsL1nLEm0IOOGvWXuNdGM7B.Tvl31s3jqekzpvd6UwwB/2C6', NULL, NULL, '2020-02-18 22:23:41', '2020-02-18 22:23:42'),
(28, 4, 'Mozelle Haag', 'sukajoel12@gmail.com', 'users/default.png', NULL, '$2y$10$hDgnD3p6e1qM28O1tqKbnOsQTpyvpuolCXBqkbOp8getxAmC5urAm', NULL, NULL, '2020-02-19 18:43:12', '2020-02-19 18:43:12'),
(29, 4, 'Yvonne Berge', 'andrea.healy@yahoo.com', 'users/default.png', NULL, '$2y$10$E.n3Vgno8Nu07YKoWcPABe2Lrjy1G4qUkQekeABDoaC9eRzeMoNEC', NULL, NULL, '2020-02-21 01:59:25', '2020-02-21 01:59:25'),
(30, 4, 'Mikayla Hettinger', 'nwilhelms@gmail.com', 'users/default.png', NULL, '$2y$10$XZs.sgDkcWpBfqcDi9RT0OxOhvnREk1JqRpFH6pPpSg/dbBp2F.RG', NULL, NULL, '2020-02-27 23:57:13', '2020-02-27 23:57:13'),
(59, 4, 'Cyrus Jakubowski IV', 'harley81@arcor.de', 'users/default.png', NULL, '$2y$10$B/Xp3dNbZKgB/Xdk99uHwOvinIDz7bjo42nCiKlI.QafKflq2OOpW', NULL, NULL, '2020-03-17 10:51:52', '2020-03-17 10:51:52'),
(83, 4, 'Hettie Donnelly', 'boba.franjic@gmail.com', 'users/default.png', NULL, '$2y$10$Ij7M7phMOS.wKlVugW3X0OV6c41qWFbDcxYeNEqnEAfGhMoXSyfbK', NULL, NULL, '2020-03-22 18:05:35', '2020-03-22 18:05:35'),
(118, 4, 'Myles Goldner', 'ersmd@aol.com', 'users/default.png', NULL, '$2y$10$qxPX0IUcR/JHxbs3v/Vjx.Qfra/Q0LDtpYvTYaSA6iVqi6z8ti6DS', NULL, NULL, '2020-03-31 12:23:02', '2020-03-31 12:23:02'),
(152, 4, 'Friedrich Moore Sr.', 'tera2366@gmail.com', 'users/default.png', NULL, '$2y$10$CdHP00M/VgEjNdeRMDuhWOmlqjrv9G9jS61GmmiBNUGRGHHP0WQna', NULL, NULL, '2020-04-21 00:29:25', '2020-04-21 00:29:25'),
(190, 4, 'Brittany Lindgren', 'chlupach4@hotmail.com', 'users/default.png', NULL, '$2y$10$xahMSBlZMvB5zM/7nr1/nON29vNsLLNo6cS3fwFhcY4zw.C/qmxHW', NULL, NULL, '2020-04-28 21:24:59', '2020-04-28 21:24:59'),
(206, 4, 'Rahul Torp', 'audriana.babyerik@gmail.com', 'users/default.png', NULL, '$2y$10$xFp3MHco6M6vwtm7M8l7Mu9rMNd5J7Ip9oDJk7chtORK8ywvp1LhS', NULL, NULL, '2020-05-01 04:31:08', '2020-05-01 04:31:08'),
(226, 4, 'Clement Stiedemann', 'accounts.receivable_usa@carel.com', 'users/default.png', NULL, '$2y$10$VuzKVbycmWFyuJ3GR9jp/edSegPSLKT87KkFl.edtcn.fjl.9Lvei', NULL, NULL, '2020-05-07 20:25:03', '2020-05-07 20:25:03'),
(247, 4, 'Dr. Kurtis Hahn', 'jrs71785@yahoo.com', 'users/default.png', NULL, '$2y$10$wOiZIzSoLxUxjJN7anUw8O2j8ej5Qe15pQRnRpwxFgUmMd.ZleYKe', NULL, NULL, '2020-05-13 16:15:20', '2020-05-13 16:15:20'),
(255, 4, 'Renee Wilkinson', 'office@acrodanceteachersassociation.com', 'users/default.png', NULL, '$2y$10$EivACb0OiYzFHCb3gHAIkOwO1fbaqFWy.Jz9HRx9wQNMjcAp0aLtW', NULL, NULL, '2020-05-14 16:39:17', '2020-05-14 16:39:17'),
(257, 4, 'Miss Kavon Predovic', 'hamm1@att.net', 'users/default.png', NULL, '$2y$10$9Nh4hNPgAlBdqUkydc5ijOuFi2375e9/e0/RTK6WyP.Dp70byn2m.', NULL, NULL, '2020-05-16 12:42:45', '2020-05-16 12:42:45'),
(267, 4, 'Dr. Eva Collier', 'naomiruth83@hotmail.com', 'users/default.png', NULL, '$2y$10$ghl8oy10D08vrGjzcAQBjuRn8Oc7loTHHr4hKhr6E3ZY4K.txY61q', NULL, NULL, '2020-05-19 04:39:29', '2020-05-19 04:39:29'),
(275, 4, 'Bonnie Collins MD', 'psskeens@aol.com', 'users/default.png', NULL, '$2y$10$3oQyqLRswbGPlqPAYlTzDebBsxmdcoema0SbcZoo1S06BdYUeVKl2', NULL, NULL, '2020-05-21 22:56:05', '2020-05-21 22:56:05'),
(276, 4, 'Reyes Roberts', 'cbuchanan10@hotmail.co.uk', 'users/default.png', NULL, '$2y$10$jK7EV/o6S1lsbtVdbJhOFup3FCmkLoqoMM0yTbgI3Z6U86hzmm7.S', NULL, NULL, '2020-05-22 05:46:02', '2020-05-22 05:46:02'),
(280, 4, 'Meggie Breitenberg', 'bbrockmann@sbcglobal.net', 'users/default.png', NULL, '$2y$10$Zpqxi3WEOipP68e/r4QWlO2zd/CinPAwaEAg5545HP/4nb56gS3I.', NULL, NULL, '2020-05-22 16:28:39', '2020-05-22 16:28:39'),
(284, 4, 'Viva Macejkovic MD', 'daveyhazel@aol.co.uk', 'users/default.png', NULL, '$2y$10$nv4g6HF5HEgFQhZB4l.cSeYDdHI8d68/j/mKVbPTjKGTSeUqHX2D2', NULL, NULL, '2020-05-23 11:56:31', '2020-05-23 11:56:31'),
(293, 4, 'Jamarcus O\'Reilly', 'colojerez18@yahoo.com', 'users/default.png', NULL, '$2y$10$kAch8wEyKoHqzA5bz6YBKOXcZjIHhVS6/ehgqtw6xlrPm2z8U7pia', NULL, NULL, '2020-05-25 20:39:46', '2020-05-25 20:39:46'),
(294, 4, 'Brigitte Wiza', 'alice-8@hotmail.co.uk', 'users/default.png', NULL, '$2y$10$/j8uFpoKiFnL8IKIsrN0vOURlXWCb9R3MQLdA.J4TBy0CWO1PbTcy', NULL, NULL, '2020-05-25 21:16:48', '2020-05-25 21:16:48'),
(295, 4, 'Carolina Sipes', 'skmackay1@gmail.com', 'users/default.png', NULL, '$2y$10$xS0oKuZCxzg3HxbUDYfNNuUG.mcCZn6CYAk53.ks0qkIs2MsAt6Sy', NULL, NULL, '2020-05-25 22:57:33', '2020-05-25 22:57:33'),
(296, 4, 'Susan Doyle', 'susandoyle1@gmail.com', 'users/default.png', NULL, '$2y$10$pa0w1ZvYZHELcHXTRU.go.Lsj2Y.bkEAESby5nOA1AYGnvdmNNhoW', '5FeWbLhpSWWbEJ73gwyemKTwXd6HsFhIKvra7D7MKl4FU62HgyDyiyJRGBuU', NULL, '2020-07-23 10:23:29', '2020-07-23 10:23:29'),
(297, 4, 'Jeremy West', 'jwestward@yahoo.com', 'users/default.png', NULL, '$2y$10$EnuNFCAF698gSUB02ma8DuGJOO0rufx5Ws9tjyranxocsXD7DNWwO', NULL, NULL, '2020-07-23 10:46:23', '2020-07-23 10:46:23'),
(298, 4, 'Susan Doyle', 'sdoyle@yahoo.com', 'users/default.png', NULL, '$2y$10$ZAUkzbH0sYXtcDyOyIiSRuyhcTQ07GYScjnjftiGVlyBjFXZ/u5S.', NULL, NULL, '2020-07-23 10:54:29', '2020-07-23 10:54:29'),
(299, 4, 'Zahriah', 'zahriahemurak@gmail.com', 'users/default.png', NULL, '$2y$10$1RQWnyxpCNfFE5FIw64zv.YmqjZUF7YPl4dMQOcLK2JD41zN77KlS', NULL, NULL, '2020-07-23 23:47:21', '2020-07-23 23:47:21'),
(300, 4, 'wICidKSJa', 'gervaislindsey638@gmail.com', 'users/default.png', NULL, '$2y$10$AW./.YmObVdwTIwAJ3dTQ.Qplhum.RHGw.Ptyl5HLWfl5jAGbQ4QC', NULL, NULL, '2020-08-06 00:32:17', '2020-08-06 00:32:17'),
(301, 4, 'Lexi Gibson', '2142576419@tmomail.com', 'users/default.png', NULL, '$2y$10$VUBmlMtaTxmaTJCAKFDVluQ17nC/R7iRDra1nBSWy1OfL3tFoVs5.', NULL, NULL, '2020-08-06 21:51:57', '2020-08-06 21:51:57'),
(302, 3, 'Raymond', 'raychir198@gmail.com', 'users/default.png', NULL, '$2y$10$et.eJMaMnVSe0qyGL1.jQe9o7843FW0Hq8lNFEpPkb6F.poy9blUq', 'kcYJ24piAWeRSJosL1SjnnVyqozFohR1G147oZc4NGTi2dMZ9FGj6jalpGz8', '{\"locale\":\"en\"}', '2020-08-07 03:10:11', '2020-08-19 17:18:21'),
(303, 3, 'catherine kavata', 'catherinekavata24@gmail.com', 'users/default.png', NULL, '$2y$10$lyYFVyP5i69fCs6uu1Kgb.I3u6r8qDsIT17VcEfw8UkXiY.tD16ly', '9AuWPXyFgkKaZxaFaQFm3Jzg6KkB5XW3vRJfewKIgsI9S2keaBbJgjJ92SFT', '{\"locale\":\"en\"}', '2020-08-07 04:05:07', '2020-08-19 17:17:21'),
(305, 4, 'Mekhi Adams', 'valentina.a@web.de', 'users/default.png', NULL, '$2y$10$juw52WLdlxaitxfo.S79I.rj49VPC9pjytkEH9nRByNfSrPgZd7q6', NULL, NULL, '2020-08-12 08:31:44', '2020-08-12 08:31:44'),
(306, 3, 'Michael Nguti', 'ngutymichael@gmail.com', 'users/default.png', NULL, '$2y$10$VJE3LbyUZoETbprWJ8h0feGjDPeIsm41O.BCX2854J2JFQFtqAo9u', '0BsfQO8cUDRcT18tyDuITv14L5B1AudFc6HgKsCDxsQlWULihJVGLO02Wz30', '{\"locale\":\"en\"}', '2020-08-12 08:51:32', '2020-08-12 08:51:32'),
(307, 3, 'Martin Mwova', 'martinmwova789@gmail.com', 'users/default.png', NULL, '$2y$10$9nsbKHKfGdaOJMP7/R/sLuzwrhiLbY0U9.NqH.hEIvaIacYsI9f.e', NULL, '{\"locale\":\"en\"}', '2020-08-12 09:11:22', '2020-08-12 09:11:22'),
(308, 3, 'Everlyn Kemunto', 'kemuntoeverlyne@gmail.com', 'users/default.png', NULL, '$2y$10$dVRXChfp6VGHRhkqrTD9pOWg07h0GDMWigB9io7pAHlmB0KPUCTZa', 'MA7jTi190UELkq5jKhs6YVJcQcQsXY23FgzF9XE6CFfYWq7N8BtecQjFSUCW', '{\"locale\":\"en\"}', '2020-08-12 09:16:08', '2020-08-12 09:16:08'),
(309, 3, 'David Onkwani', 'donkwani@yahoo.com', 'users/default.png', NULL, '$2y$10$fRxb0DOuARDxhBZIp9hxkezpsm3ea.1iGllt7BD4J8m2ka9GC8O2q', 'VqTnARJHQ28KkFWf0wUDLBZGo2a4viGgu9N8svfyZuBCOHsQPbVq10QFILG5', '{\"locale\":\"en\"}', '2020-08-12 09:23:25', '2020-08-12 09:23:25'),
(310, 1, 'Garvin Francis', 'ahonogarvin@gmail.com', 'users/default.png', NULL, '$2y$10$Rm/SkBL0.xg19p6EFqadTu2VZ7qCJTGNP8CAPU.MfNGduu3Qm0rfS', 'Z5TTKhXYZo6sqKntuGC9hKdxjoFHF9nMlXcUMkFZ6e2Z1RgCv1OkQbZ8IxjS', '{\"locale\":\"en\"}', '2020-08-13 17:56:06', '2020-08-13 17:57:16'),
(311, 4, 'Eleonore Kuphal', 'mikeredmond@cox.net', 'users/default.png', NULL, '$2y$10$H7h2bPgH6mzi5h9YiYfU5Oc3g/PBleNIPEWIFAJbH6hUSs22lnEWi', NULL, NULL, '2020-08-14 18:07:26', '2020-08-14 18:07:26'),
(312, 4, 'Lonie Satterfield', 'j2et21tie@gmail.com', 'users/default.png', NULL, '$2y$10$yIFww0rLhTq0jiCToTNKAu7vA7iu1kL5OIkZdRMLF5DkyEk0lPM2S', NULL, NULL, '2020-08-16 10:27:40', '2020-08-16 10:27:40'),
(313, 4, 'Tonylee Masilva', 'tonyl6367@gmail.com', 'users/default.png', NULL, '$2y$10$9/bCoUdKsakOS5OxTMgPN.UxNZvoVBtwg3MyHlnTG.9KyScY1NEb.', NULL, NULL, '2020-08-18 03:52:52', '2020-08-18 03:52:52'),
(314, 4, 'Ursula Goldner', 'alyssa.ayala98@icloud.com', 'users/default.png', NULL, '$2y$10$hGjbjL4b0mBhz4yVwTH0KOZ9lu.HckIXo4YOZCVxzy4vaafxJ.sE6', NULL, NULL, '2020-08-19 13:45:48', '2020-08-19 13:45:48'),
(315, 4, 'Diya Girish Kumar', 'diyagk2006@gmail.com', 'users/default.png', NULL, '$2y$10$INnzANMuNwonaz/o59Ccou2p3QhWvt.9PRyo/APwKjaAAKlPzl2hu', NULL, NULL, '2020-08-21 19:19:35', '2020-08-21 19:19:35'),
(316, 4, 'eddy mwendwa', 'eddiealbamwendwa@gmail.com', 'users/default.png', NULL, '$2y$10$WJIXHgovY0dCKlkM7X01j.ESJaNUlLMMNflK6AmMdb/y26aQ1i9Wa', NULL, NULL, '2020-08-22 18:09:43', '2020-08-22 18:09:43'),
(317, 4, 'Dentor', 'gnatukkarina0@gmail.com', 'users/default.png', NULL, '$2y$10$gtdEUUbVYLHigaEIoKJnAe3VQnBRrTjaZSAMOMbHLTFEDdX6IEHJ6', NULL, NULL, '2020-08-27 13:46:19', '2020-08-27 13:46:19'),
(318, 4, 'Miss Matilda Will', 'sfolson940@gmail.com', 'users/default.png', NULL, '$2y$10$t8/PvEuXy60Zgl79LFYjbOAx/YSAfW3CVsoqOv6J.1QmQgyV9qneG', NULL, NULL, '2020-08-31 08:41:31', '2020-08-31 08:41:31'),
(319, 4, 'Heloise Daugherty DDS', 'wedjanaljafar@gmail.com', 'users/default.png', NULL, '$2y$10$iqCi87J/xkVdtC.Xr6eLsu5NHUwowKXTuduVVhDDTUnK6X8INGKUK', NULL, NULL, '2020-09-02 23:35:18', '2020-09-02 23:35:18'),
(320, 4, 'Miss Laurence Klein', 'zachary.g.mcdonald@gmail.com', 'users/default.png', NULL, '$2y$10$ju3wmQxATNGMTkbav95GYeqRB7H.BmO4jZXY84vXgNDoLj8Jh/IpK', NULL, NULL, '2020-09-03 18:49:01', '2020-09-03 18:49:01'),
(321, 4, 'Osborne Doyle', 'leann.hilton@yahoo.com', 'users/default.png', NULL, '$2y$10$jlIl9T3lrgYOqSKjxVUL/uJVZV30Kk8b.aht0pueW1fPgL3LPrF1S', NULL, NULL, '2020-09-04 00:44:54', '2020-09-04 00:44:54'),
(322, 4, 'Moises Vasquez', 'moisesbvasquez001@gmail.com', 'users/default.png', NULL, '$2y$10$zajimeIjcLwPFrzrrVCWXeROxF0qgG3nzGnpEQjF3ameZcBBBJ/jm', NULL, NULL, '2020-09-09 12:38:22', '2020-09-09 12:38:22'),
(323, 4, 'Bennett Rippin', 'misslis314@aol.com', 'users/default.png', NULL, '$2y$10$kZr.OiN3moDT8/YMZCe51uWNvj26eqBu0mRhBUr5QhDOEhfxxuwTy', NULL, NULL, '2020-09-11 03:54:11', '2020-09-11 03:54:11'),
(324, 4, 'Zakary Mayer', 'tsundararaman@worldbank.org', 'users/default.png', NULL, '$2y$10$1QF6Fy8A.LR6z/oMScGeNOX6huLxvtAfWhqPcEDe5WDuQjDb.pA7C', NULL, NULL, '2020-09-11 11:31:38', '2020-09-11 11:31:38'),
(325, 4, 'Mikaeel', 'mikaeelebr@gmail.com', 'users/default.png', NULL, '$2y$10$9zUic8NoNdOJKjOO8HPYNufkdyLoieBuRwK71QPwQ2IZFActEjrku', NULL, NULL, '2020-09-13 09:32:34', '2020-09-13 09:32:34'),
(326, 4, 'Ms. Vaughn Reinger', 'jenkins.dee43@gmail.com', 'users/default.png', NULL, '$2y$10$84ARv1gnJl.8sdWfnedcKuQ.XsjqNNjoRfl2it9DpnREIgB4Xi2am', NULL, NULL, '2020-09-14 16:10:30', '2020-09-14 16:10:30'),
(327, 4, 'Madyson Frami', 'leannhilton@hiltonmgmt.com', 'users/default.png', NULL, '$2y$10$SUEErPkCVaFV7jF0E49jBesigJBoeVzj5mPZsyAeom01hdokiL2.i', NULL, NULL, '2020-09-15 23:54:47', '2020-09-15 23:54:47'),
(328, 4, 'Elvera Walsh II', 'jvstokes@albertus.edu', 'users/default.png', NULL, '$2y$10$zsE/n9wj8s9yjGbGS1NlGe.kPOCqc/SNFErlNYxLDJq62nqWj6BV.', NULL, NULL, '2020-09-16 22:53:51', '2020-09-16 22:53:51'),
(329, 4, 'Siegourny Yap', 'yapxsiegourny@gmail.com', 'users/default.png', NULL, '$2y$10$w2OR8P6fk4jB1AS.J4xf2OwDSZJUu7EZADkv7uDsVm.sp2Fg.hh0O', NULL, NULL, '2020-09-19 16:15:23', '2020-09-19 16:15:23'),
(330, 1, 'Margaret Mwasi', 'peggymwasi@gmail.com', 'users/default.png', NULL, '$2y$10$v9H.vJb4pCAEV8c5z.mSeucdWWfro4QxYrWLzolXsPbyZqD/LWbs6', NULL, '{\"locale\":\"en\"}', '2020-09-21 06:33:16', '2020-09-21 06:33:16'),
(331, 1, 'Griffin Musila', 'musilagriffin@gmail.com', 'users/default.png', NULL, '$2y$10$du.bch1VmPKqjavSmlU5P.9479WoLI5yvZuGiDAV0m7dENNKuodHC', NULL, '{\"locale\":\"en\"}', '2020-09-21 06:34:45', '2020-09-21 06:34:45'),
(332, 4, 'Diya Nair', 'diya.bahrain@gmail.com', 'users/default.png', NULL, '$2y$10$5yPEAfoMT53TYvvGCu9r5OxDFmjcdfeUMEi8.y1PEJT/4KBcpd.Sq', NULL, NULL, '2020-09-22 09:42:05', '2020-09-22 09:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 2),
(4, 3),
(5, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_jobs`
--
ALTER TABLE `completed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deffered_jobs`
--
ALTER TABLE `deffered_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_statuses`
--
ALTER TABLE `message_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail_statuses`
--
ALTER TABLE `order_detail_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_classifications`
--
ALTER TABLE `paper_classifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_formats`
--
ALTER TABLE `paper_formats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_languages`
--
ALTER TABLE `paper_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_periods`
--
ALTER TABLE `paper_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_spacings`
--
ALTER TABLE `paper_spacings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_types`
--
ALTER TABLE `paper_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payables`
--
ALTER TABLE `payables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picked_jobs`
--
ALTER TABLE `picked_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejects`
--
ALTER TABLE `rejects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_statuses`
--
ALTER TABLE `review_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `completed_jobs`
--
ALTER TABLE `completed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `deffered_jobs`
--
ALTER TABLE `deffered_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message_statuses`
--
ALTER TABLE `message_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_detail_statuses`
--
ALTER TABLE `order_detail_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paper_classifications`
--
ALTER TABLE `paper_classifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paper_formats`
--
ALTER TABLE `paper_formats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paper_languages`
--
ALTER TABLE `paper_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paper_periods`
--
ALTER TABLE `paper_periods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paper_spacings`
--
ALTER TABLE `paper_spacings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paper_types`
--
ALTER TABLE `paper_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payables`
--
ALTER TABLE `payables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `picked_jobs`
--
ALTER TABLE `picked_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `rejects`
--
ALTER TABLE `rejects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review_statuses`
--
ALTER TABLE `review_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
