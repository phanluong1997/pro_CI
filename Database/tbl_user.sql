-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 10:56 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2020_mt7`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_account` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(12) NOT NULL,
  `referentID` tinyint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_front` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_back` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `verify` tinyint(4) NOT NULL,
  `is_enabled_2fa` tinyint(4) NOT NULL,
  `google_auth_code` text COLLATE utf8_unicode_ci NOT NULL,
  `walletUSD` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `text_pass`, `type_account`, `type`, `code`, `referentID`, `fullname`, `phone`, `salt`, `avatar`, `card_front`, `card_back`, `status`, `active`, `verify`, `is_enabled_2fa`, `google_auth_code`, `walletUSD`, `created_at`, `updated_at`) VALUES
(23, 'hieu.optech@gmail.com', '6c38f9ebed8db9d281263f2eb400917c86b55df2', '123456', '', 'admin', 0, 0, 'Đặng Lê Phúc Thảo', '0768033984', 'aQdXYx&8', '', '', '', 1, 1, 0, 0, '', 500, '2020-09-18 17:25:32', '2020-09-19 08:44:19'),
(101, 'phucthao@gmail.com', '50e9906d665a04c4024822b399c6034f24eab151', '205456789', '0', 'user', 88040524, 0, 'Đặng Lê Phúc Thảo', '096410475891', 'hzZce!Cu', '', '', '', 1, 1, 1, 0, '', 5916, '2020-09-25 16:23:08', '2020-09-28 14:35:13'),
(109, 'phucthao1@gmail.com', 'f106f0dd3d30001a2aefb1ee8a78a4680506887b', '123456789', '0', 'user', 49222579, 0, 'Huong', '123456789', '47h!ADTA', '4_thumb.png', '13_thumb.png', '11_thumb.png', 1, 1, 1, 0, '', 2950, '2020-09-25 17:27:15', '2020-09-30 09:32:06'),
(111, 'phucthao2@gmail.com', 'd82a7ecd538b9a338059c06fac7470630778b734', '123456789', '0', 'user', 76323634, 109, 'Đặng Lê Phúc Thảo 2', '123456789', 'tewd88zu', '', '', '', 1, 1, 0, 0, '', 5000, '2020-09-26 09:27:49', '2020-09-29 18:03:09'),
(113, 'phucthao3@gmail.com', '944658ea411b4eb9cac07566078921205e2b3507', '205456789', '0', 'user', 51501558, 122, 'Đặng Lê Phúc Thảo 3', '07680339843', 'GyQ9!Lud', '', '', '', 1, 1, 0, 0, '', 1, '2020-09-28 11:24:30', '2020-09-29 18:01:33'),
(120, 'phucthao205@gmail.com', '', '', '1', 'user', 11375130, 109, 'Anh Luong', '0768033984', '', '', '', '', 1, 1, 0, 0, '', 0, '2020-09-29 17:21:02', '2020-09-29 17:25:10'),
(121, 'phucthao4@gmail.com', '6ab1eb24bf85ea49218a5cebbdcf52ade6be1475', '123456789', '0', 'user', 35329475, 120, 'Đặng Lê Phúc Thảo 4', '123456789', 'NL7zD=bD', '', '', '', 1, 1, 0, 0, '', 0, '2020-09-29 17:25:25', '2020-09-29 17:26:37'),
(123, 'doc.optech@gmail.com', '5b19dcbaf907a6017d5873a9ec1c2bd96a0b02c2', '16082013', '1', 'user', 60584258, 0, 'Doc Optech', '0848301302', 'mkDcphu+', '', '', '', 1, 1, 0, 1, '{\"secret\":\"F7RVQ4MMHAHABAUK\",\"qrCodeUrl\":\"https:\\/\\/chart.googleapis.com\\/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2Fdoc.optech%40gmail.com%3Fsecret%3DF7RVQ4MMHAHABAUK%26issuer%3DMoneyGaming\"}', 340, '2020-09-30 11:15:40', '2020-09-30 15:11:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
