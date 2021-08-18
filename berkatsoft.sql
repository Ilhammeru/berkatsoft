-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 05:25 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berkatsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(34, '2014_10_12_100000_create_password_resets_table', 1),
(35, '2019_08_19_000000_create_failed_jobs_table', 1),
(36, '2021_08_16_034942_user_table', 1),
(37, '2021_08_16_035417_product_table', 1),
(38, '2021_08_16_040145_sales_table', 1);

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product`, `status`, `price`, `stock`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'beras', 1, 23000, 1300, '2021-08-17 20:18:28', '2021-08-17 20:25:26', 1, 1, NULL),
(2, 'Kangkung', 1, 2000, 250, '2021-08-17 20:18:28', '2021-08-17 20:25:26', 1, 1, NULL),
(3, 'cabai rawit merah', 1, 75000, 3400, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(4, 'cabe merah besar', 1, 17000, 230, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(5, 'terasi', 1, 1200, 1000, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(6, 'kunyit', 1, 10000, 3255, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(7, 'jahe merah', 1, 33000, 2200, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(8, 'pekak', 1, 19000, 2000, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(9, 'serai', 1, 5000, 1000, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(10, 'tomat daging', 1, 44000, 3300, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(11, 'tomat masak', 1, 2000, 1200, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(12, 'jeruk limau', 1, 33000, 35000, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, 1, NULL),
(13, 'Bawang putih', 1, 20000, NULL, '2021-08-17 20:22:14', '2021-08-17 20:22:14', 2, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `product_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT json_array() CHECK (json_valid(`product_id`)),
  `detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT json_array() CHECK (json_valid(`detail`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `date`, `customer_id`, `product_id`, `detail`, `created_at`, `updated_at`) VALUES
(1, '2021-08-17 20:25:26', 3, '[\"2\",\"1\"]', '[{\"id\":\"2\",\"qty\":\"250\",\"price\":\"2000\",\"total\":500,\"name\":\"Kangkung\"},{\"id\":\"1\",\"qty\":\"1000\",\"price\":\"23000\",\"total\":23000,\"name\":\"beras\"}]', '2021-08-17 20:25:26', '2021-08-17 20:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL,
  `detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT json_array() CHECK (json_valid(`detail`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `detail`, `status`, `created_at`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 'ilhammeru', '$2y$10$omyb/rHMKaB80aQn3dMRLOdI0xRTY0q/4IB1uQZUnNlwumjX8dxRm', 1, '{\"email\":\"gumilang.dev@gmail.com\",\"phone\":\"085795327357\",\"address\":\"\"}', 1, '2021-08-17 20:18:28', '2021-08-17 20:18:28', 1, NULL),
(2, 'admin', '$2y$10$L7.hkOvUS2c5TiUQaU8WZexqoKFXutRN82ALdUpTRAapJIRMRQ.9i', 2, '{\"email\":\"admin@gmail.com\",\"phone\":\"\",\"address\":\"\"}', 1, '2021-08-17 20:18:29', '2021-08-17 20:18:29', 1, NULL),
(3, 'customer', '$2y$10$M0ec2iPAQu2g2P/hLofvgOn8pYgkhi.iCdtLxgk3B1fSWuuM8rwPi', 1, '{\"email\":\"customer@gmail.com\",\"phone\":\"\",\"address\":\"\"}', 1, '2021-08-17 20:18:29', '2021-08-17 20:18:29', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
