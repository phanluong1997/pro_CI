-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 01, 2020 lúc 11:46 AM
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
-- Cấu trúc bảng cho bảng `tbl_game`
--

CREATE TABLE `tbl_game` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_game`
--

INSERT INTO `tbl_game` (`id`, `name`, `des`, `image`, `thumb`, `link`, `publish`, `created_at`, `updated_at`) VALUES
(8, 'luong', 'Chơi tới bến', 'photo_2020-10-01_16-22-271.jpg', 'photo_2020-10-01_16-22-271_thumb.jpg', 'ghfjghykùyhlkjl', 1, '2020-10-01 16:25:07', '2020-10-01 16:25:07'),
(10, 'Xuc Xac', 'Chơi tới bến', 'photo_2020-10-01_16-22-272.jpg', 'photo_2020-10-01_16-22-272_thumb.jpg', 'optech.com', 1, '2020-10-01 16:25:15', '2020-10-01 16:25:15'),
(11, 'League of Legends', 'Chơi tới bến', 'photo_2020-10-01_16-22-27.jpg', 'photo_2020-10-01_16-22-27_thumb.jpg', 'optech.com', 1, '2020-10-01 16:24:49', '2020-10-01 16:24:49'),
(12, 'Liên Quân', 'Chơi tới bến', 'photo_2020-10-01_16-22-21.jpg', 'photo_2020-10-01_16-22-21_thumb.jpg', 'optech.com', 1, '2020-10-01 16:24:58', '2020-10-01 16:24:58'),
(13, 'luong', 'Chơi tới bến', 'photo_2020-10-01_16-22-273.jpg', 'photo_2020-10-01_16-22-273_thumb.jpg', 'optech.vn', 1, '2020-10-01 16:43:54', '2020-10-01 16:43:54');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_game`
--
ALTER TABLE `tbl_game`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_game`
--
ALTER TABLE `tbl_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
