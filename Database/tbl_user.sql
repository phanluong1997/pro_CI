-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 23, 2020 lúc 05:19 AM
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
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `verify` tinyint(4) NOT NULL,
  `walletUSD` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `text_pass`, `type`, `fullname`, `phone`, `salt`, `active`, `verify`, `walletUSD`, `created_at`, `updated_at`) VALUES
(23, 'hieu.optech@gmail.com', '6c38f9ebed8db9d281263f2eb400917c86b55df2', '123456', 'admin', 'Đặng Lê Phúc Thảo', '0768033984', 'aQdXYx&8', 1, 0, 0, '2020-09-18 17:25:32', '2020-09-19 08:44:19'),
(26, 'phucthao205@gmail.com', '4590361f9b32a751dc6591a170677ac7c59e766f', '123456', 'admin', 'Nguyễn Quỳnh Hương', '0768033984', 'XrUsLmX8', 1, 0, 0, '2020-09-19 08:33:46', '2020-09-22 11:24:58'),
(31, 'chuongml999@gmail.com', 'e2c4c1fe612ca0091118653941e06c4c25482f58', '123456', 'user', 'Luong96345', '0358240661', '&WuQky4P', 1, 1, 951, '2020-09-22 10:31:20', '2020-09-22 13:45:41'),
(32, 'phanluong1992@gmail.com', '538de1396cbed13abf4e2e015e142c81e8e59bb9', '123456', 'user', 'testuser1', '132465564123', '?paJ9z!?', 1, 0, 0, '2020-09-22 16:41:59', '2020-09-22 16:41:59'),
(33, 'phanluong1989@gmail.com', 'cae94918739db434744d158e34304b01734b24de', '5413210', 'user', 'fgjghkjhgkhjl', '132138541332', 'NLKpEWan', 1, 0, 0, '2020-09-22 16:42:20', '2020-09-22 16:42:20');

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
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
