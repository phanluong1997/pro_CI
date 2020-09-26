-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 25, 2020 lúc 12:32 PM
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
  `code` int(12) NOT NULL,
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

INSERT INTO `tbl_user` (`id`, `email`, `password`, `text_pass`, `type_account`, `type`, `code`, `fullname`, `phone`, `salt`, `status`, `active`, `verify`, `walletUSD`, `created_at`, `updated_at`) VALUES
(23, 'hieu.optech@gmail.com', '6c38f9ebed8db9d281263f2eb400917c86b55df2', '123456', '', 'admin', 0, 'Đặng Lê Phúc Thảo', '0768033984', 'aQdXYx&8', 1, 1, 0, 0, '2020-09-18 17:25:32', '2020-09-19 08:44:19'),
(101, 'phucthao@gmail.com', '55ecf81f613728811f0287ea58012980a552e3e4', '123456789', '0', 'user', 88040524, 'Đặng Lê Phúc Thảo', '0768033984', '9sEF/bjk', 1, 1, 1, 3000, '2020-09-25 16:23:08', '2020-09-25 16:27:15'),
(108, 'phucthao205@gmail.com', 'aee8ab37c52970b551e51c9b3167528a8a06240c', '123456789', '1', 'user', 54572576, 'Thảo Phúc 205456', '123456789', 'NnqW92aS', 1, 1, 0, 0, '2020-09-25 17:25:07', '2020-09-25 17:25:32'),
(109, 'phucthao1@gmail.com', 'f106f0dd3d30001a2aefb1ee8a78a4680506887b', '123456789', '0', 'user', 49222579, 'PHUC THAO GG1', '123456789', '47h!ADTA', 1, 1, 1, 3050, '2020-09-25 17:27:15', '2020-09-25 17:29:16'),
(110, 'phuc.thao61@gmail.com', '3ecdb1db01b8d0ff9388d8cae9c1e2be4c0ed30b', '205456789', '1', 'user', 95167860, 'Thảo Phúc 205 GG', '1234567789', '+ztsv3E+', 1, 1, 0, 0, '2020-09-25 17:30:34', '2020-09-25 17:32:16');

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
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
