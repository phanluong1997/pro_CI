-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 22, 2020 lúc 03:44 AM
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
-- Cấu trúc bảng cho bảng `tbl_withdraw`
--

CREATE TABLE `tbl_withdraw` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `amount` double NOT NULL,
  `amount_receive` float NOT NULL,
  `amount_eth` float NOT NULL,
  `wallet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_withdraw`
--

INSERT INTO `tbl_withdraw` (`id`, `userID`, `amount`, `amount_receive`, `amount_eth`, `wallet`, `note`, `status`, `date`) VALUES
(3, 23, 250, 230, 2.4, 'FDHGFJNGH', '123', 1, '2020-09-21 00:00:00'),
(4, 26, 170, 150, 2.4, 'phanluong', 'destroy', 2, '2020-09-22 00:00:00'),
(6, 30, 2500, 2400, 2.4, '9635411', '123', 0, '2020-09-22 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_withdraw`
--
ALTER TABLE `tbl_withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_withdraw`
--
ALTER TABLE `tbl_withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
