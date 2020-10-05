-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 05, 2020 lúc 03:15 AM
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
-- Cấu trúc bảng cho bảng `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `wallet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_wallet`
--

INSERT INTO `tbl_wallet` (`id`, `userID`, `wallet`, `date`, `status`, `create_at`, `update_at`) VALUES
(33, 132, 'ZA123456cccc', '2020-09-19 09:04:45', 1, '2020-09-19 09:04:45', '2020-09-19 09:04:45'),
(35, 126, 'ACVSF1', '2020-10-01 08:59:15', 1, '2020-10-01 08:59:15', '2020-10-01 08:59:15'),
(36, 125, 'ACVSF123', '2020-10-01 08:59:21', 1, '2020-10-01 08:59:21', '2020-10-01 08:59:21'),
(37, 127, 'ACVSF2134', '2020-10-01 08:59:26', 1, '2020-10-01 08:59:26', '2020-10-01 08:59:26'),
(38, 129, 'ACVSF12123', '2020-10-01 08:59:32', 1, '2020-10-01 08:59:32', '2020-10-01 08:59:32'),
(39, 131, 'ACVSF12123213', '2020-10-01 08:59:41', 1, '2020-10-01 08:59:41', '2020-10-01 08:59:41'),
(40, 133, 'ACSVSF1PT14', '2020-10-01 08:59:46', 1, '2020-10-01 08:59:46', '2020-10-01 08:59:46'),
(41, 0, 'ASSDQWQ', '2020-10-01 08:59:52', 1, '2020-10-01 08:59:52', '2020-10-01 08:59:52'),
(42, 0, 'TEST1', '2020-10-01 10:43:39', 1, '2020-10-01 10:43:39', '2020-10-01 10:43:39'),
(43, 0, 'TEST2', '2020-10-01 14:25:07', 1, '2020-10-01 14:25:07', '2020-10-01 14:25:07'),
(44, 0, 'TEST3', '2020-10-01 14:25:14', 1, '2020-10-01 14:25:14', '2020-10-01 14:25:14');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
