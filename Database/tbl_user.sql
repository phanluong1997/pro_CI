-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 24, 2020 lúc 12:47 PM
-- Phiên bản máy phục vụ: 10.1.32-MariaDB
-- Phiên bản PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `2020_mt7`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_account` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `verify` tinyint(4) NOT NULL,
  `walletUSD` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `text_pass`, `type_account`, `type`, `fullname`, `phone`, `salt`, `status`, `active`, `verify`, `walletUSD`, `created_at`, `updated_at`) VALUES
(23, 'hieu.optech@gmail.com', '6c38f9ebed8db9d281263f2eb400917c86b55df2', '123456', '', 'admin', 'Đặng Lê Phúc Thảo', '0768033984', 'aQdXYx&8', 1, 1, 0, 0, '2020-09-18 17:25:32', '2020-09-19 08:44:19'),
(71, 'phucthao205@gmail.com', '', '', '1', 'user', 'Thảo Phúc 205 GG', '0768033984', '', 1, 1, 0, 0, '2020-09-24 15:43:36', '2020-09-24 15:43:46'),
(72, 'phucthao@gmail.com', '0478217bd3c229a790539d217fdacb0f7a97563f', '', '0', 'user', 'Đặng Lê Phúc Thảo', '0768033984', '/RwUqmW/', 1, 1, 0, 0, '2020-09-24 16:15:27', '2020-09-24 16:17:00'),
(73, 'phucthao1@gmail.com', '3bc3dec3e2695ed47c6146a4dea985af75b03177', '', '0', 'user', 'Đặng Lê Phúc Thảo 1', '123456789', 'Cp/&rgYm', 1, 1, 0, 0, '2020-09-24 17:44:16', '2020-09-24 17:46:11');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
