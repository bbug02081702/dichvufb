-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 18, 2021 lúc 06:19 PM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VND` varchar(10) COLLATE utf8_unicode_ci DEFAULT '0',
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT '@gmail.com',
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT '0123456789',
  `level` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'member',
  `chietkhau` varchar(3) COLLATE utf8_unicode_ci DEFAULT '0',
  `kichhoat` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'fail',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `VND`, `fullname`, `email`, `phone`, `level`, `chietkhau`, `kichhoat`, `avatar`, `ip`, `token`, `confirm_code`, `created_at`) VALUES
(93, 'hovancuong', '7fc60c629dd8b3fb826671f30436a1ee', '0', 'hovancuong', 'hovancuong@gmail.com', '089898989', 'member', '0', 'fail', 'data/none.jpg', '0', '1V7n27k0wgSYaFMOT5BxjTI0T7zwZJ', '267914', '1631824498'),
(92, 'okvnss', '0c434e8d42f742a9baa0962a8a46d9ce', '0', 'Okvnssss', 'okjgh@hmail.com', '049944646', 'member', '0', 'fail', 'data/none.jpg', '0', 'kquf7imPiv6UmC2TIopwttqYms1XAK', '302394', '1631805345'),
(91, 'dothevi', 'e10adc3949ba59abbe56e057f20f883e', '0', 'Đỗ thế vĩ', 'dothevi76@gmail.com', '0388080299', 'member', '0', 'fail', 'https://lequocdat.com/data/a0bd18c004d230ba26793437d96275dd.jpeg', '0', 'r5pQkguDnM9g5QHJ0EJMF2OgK4zHqP', '803056', '1631801294'),
(90, 'levanhoa', 'b8944ee60d9e3417508278ec3654093c', '0', 'Lê Văn Hoà', 'levanthiet1979vts@gmail.com', '0389649561', 'member', '0', 'fail', 'data/none.jpg', '0', 'JqOW7C4b8nmRP3JwJibO4GFyX692s6', '951325', '1631771509'),
(89, 'nhathuy1008071', '6699776d9a21343dce78ea8c28964a21', '0', 'Lê Nhật Huy', 'nhathuy10082007ff@gmail.com', '0368866145', 'member', '0', 'fail', 'data/none.jpg', '0', 'y6x135cJCLLOas3LcxUu8uywZVFZdu', '835030', '1631765948'),
(88, 'lol123', '4297f44b13955235245b2497399d7a93', '0', 'Nguyen van lol', 'concac@gmail.com', '0785248503', 'member', '0', 'fail', 'data/none.jpg', '0', '6s4epO3XPy2g8oUmCJEeUhcYdyCJF3', '356461', '1631731272'),
(87, 'taismileok', 'e00fb22188e2e3461b94108791da4b36', '0', 'Jskksns ', 'hakin@gmail.com', '036563565', 'member', '0', 'fail', 'data/none.jpg', '0', 'hpcQ1nfBcoKpi51IQzDee66fXBm3eY', '321331', '1631632478'),
(86, 'nam123', '25f9e794323b453885f5181f1b624d0b', '0', 'NamNguyen', 'namnguyen@gmail.com', '0964375215', 'member', '0', 'fail', 'data/none.jpg', '0', 'hXIXHkox453d76OmYxBdJrRhXvAI9X', '756413', '1631622534'),
(85, 'nxnxnns', '2b7f770f23399b7511da2b4de43e782d', '0', 'shsjjs', 'shsjjs@jsja.zjs', '0123456789', 'member', '0', 'fail', 'data/none.jpg', '0', 'I0Av76oaPkdfj78kIHxag3bponRRip', '319983', '1631613429'),
(84, 'jsjsjsjs', 'e584f3add0c146f19b69bc78f6d8835e', '0', 'nguyen van c', 'quocje@gmail.com', '034345894', 'member', '0', 'fail', 'data/none.jpg', '0', '1L2ATT1g8FLJ8am1vwKFr78FBZjEyp', '456217', '1631579753'),
(83, 'longklhd123', '1e28f2b95ce1d4a9998d5b0835eaa271', '0', 'Lê Đức Long', 'longnghien2kt@gmail.com', '0899290775', 'member', '0', 'fail', 'data/none.jpg', '0', 'n1LRlISktZkxcASXoXIriUWkD2kiMT', '150234', '1631539580'),
(82, 'thangle', '6a2dd74a1765c99331c31fa029eeccd6', '0', 'Nguyen van long', 'long00fa@gmail.com', '0388533762', 'member', '0', 'fail', 'data/none.jpg', '0', 'xOTzTVuADgBuGNw9URgho8KTN5XNIC', '111464', '1631531587'),
(81, 'chuminhhieu', '2a8187056bf580617382cbff1ed82284', '0', 'chuminhhieu', 'cmhnst1@gmail.com', '0845555928', 'member', '0', 'fail', 'data/none.jpg', '0', 'mndDo0Mr3rVzpRaxuOUdKbjsh6tSfR', '229795', '1631515951'),
(80, 'qweki123', '1728efbda81692282ba642aafd57be3a', '0', 'Ngọc Thiện', 'kyky652000@gmail.com', '0931171044', 'member', '0', 'fail', 'data/none.jpg', '0', 'Mps4uVJRf6kAK09fMefi8MuLMWhFpX', '408173', '1631504081'),
(79, 'quoctrinh', '34b811f9db377b439675b1e4c2bc999b', '0', 'Nguyễn Văn Trịnh', 'nvt.21590@gmail.com', '0987654321', 'member', '0', 'fail', 'data/none.jpg', '0', 'PKVQYRAGUA7bHGl7hcaWlh47Cr5mTf', '547677', '1631501864'),
(78, 'anhloc', 'bbe35189a136d18b564aba56c23d5641', '0', 'Nguyễn ', 'nguyeng5925@gmail.com', '0968548491', 'member', '0', 'fail', 'data/none.jpg', '0', 'IcUlY8fxEzKumr23eFyofP2sX1WJpt', '193040', '1631501550'),
(77, 'nhathuy100807', '6699776d9a21343dce78ea8c28964a21', '0', 'Huy Rosi', 'nhathuy15616@gmail.com', '0368866141', 'member', '0', 'fail', 'data/none.jpg', '0', 'HIyld4sqxlolIxMDqCoXMkynEVudzT', '481919', '1631498679'),
(76, 'abcde12345', 'ab56b4d92b40713acc5af89985d4b786', '0', 'Dang Hoang Minh', 'abc@gmail.com', '0973369021', 'member', '0', 'fail', 'data/none.jpg', '0', 'Q1O5Dg9Yz9A4SyXaIqnHxMzVO7ZbgF', '173784', '1631467176'),
(75, 'test01', '0e698a8ffc1a0af622c7b4db3cb750cc', '989000', 'Tài Khoản Thử Nghiệm', 'test@lequocdat.com', '0865328450', 'member', '0', 'fail', 'data/none.jpg', '0', 'sQjTvB09Gq7vHFMo9j2KuBo9Q4KkLo', '932631', '1631454680'),
(74, 'admin1', 'cd70465e32cfb0cd986eccccda60cb81', '960000', 'Lê Quốc Đạt', 'admin@lequocdat.com', '0777488444', 'admin', '0', 'fail', 'data/none.jpg', '0', 'Hqu7RFLpsqCGVOpYSs46gx5iPiLFWW', '297626', '1631454428'),
(94, 'hoàng', '7b67607d7e6bf4971f1bd619e1fb386d', '0', 'hoangquyhoangquy', 'dinhminhhoang18021994@gmail.com', '0963180294', 'member', '0', 'fail', 'data/none.jpg', '0', 'f8R2aYS6dDuehKgZ2ZZBempLa9I3Yn', '856977', '1631839033'),
(95, 'xxxxxxxxxx', '336311a016184326ddbdd61edd4eeb52', '0', 'xxxxxxxxxx', 'xxxxxxxxxx@gmail.com', '0902316531', 'member', '0', 'fail', 'data/none.jpg', '0', 'Mt8N0VtmxrQBzIqmwip8CNC7qAbg9K', '939272', '1631840102'),
(96, 'golikevn125', '897d5e0aa4a745df28caae2e591bd3bd', '0', 'Nguyễn Văn A', 'buomemokf@gmail.com', '0907097443', 'member', '0', 'fail', 'data/none.jpg', '0', '5aMGHNEwPu0skL1giuN3I7nxCi7Cjx', '880581', '1631843658'),
(97, 'lecongvinh', 'bad732170a9a9f5d3a7522065d225aaf', '0', 'Lê Công Vinh', 'vinhtienle789@gmail.com', '0886226561', 'member', '0', 'fail', 'data/none.jpg', '0', 'CMen8ERF7iaTYggquTdlJRK7F0d7Rv', '984774', '1631858371'),
(98, 'azpm02', 'fbe40ae1fdd91bfb98184e6c4cf6879e', '0', 'Nguyên minh tâm', 'thuyk097@gmail.com', '0375474821', 'member', '0', 'fail', 'data/none.jpg', '0', '2Qo1ShpQhb0d3Q083gaYtGf6G3Bicr', '423653', '1631899554'),
(99, 'tranvantrung', '83b6f542b578ba77da2f66fe69f09638', '0', 'Trần văn trung', 'trunglonelymanu@gmail.com', '0978100947', 'member', '0', 'fail', 'data/none.jpg', '0', 'Fkuwlj0Sd2yDBIvQt3C1wiU6rBmZvf', '270798', '1631900747'),
(100, 'dphong09', 'e10adc3949ba59abbe56e057f20f883e', '0', 'Pham Duy Phong', 'dphong09@gmail.com', '0399360833', 'member', '0', 'fail', 'data/none.jpg', '0', '3XIUwcLjmZPFocW8s9H8sc5oC8ykiW', '033526', '1631931161'),
(101, 'phuoclatao1333', '92fbdc9f1aafc2ce2450bb07b459fc11', '0', 'Dương minh  ', 'minhphuoc13505@gmail.com', '0816416001', 'member', '0', 'fail', 'data/none.jpg', '0', 'YbiMfSVQRUge9lj7dcAevlXFVMiw22', '115489', '1631944715');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_momo`
--

CREATE TABLE `api_momo` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TrixID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `price` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0',
  `number` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_thesieure`
--

CREATE TABLE `api_thesieure` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TrixID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `content` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'fail'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hop_thu_ho_tro`
--

CREATE TABLE `hop_thu_ho_tro` (
  `id` int(11) NOT NULL,
  `TrixID` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung` text COLLATE utf8_unicode_ci,
  `trangthai` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_dang_nhap`
--

CREATE TABLE `lich_su_dang_nhap` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `napthe`
--

CREATE TABLE `napthe` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telco` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ma_giao_dich` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `replay_ho_tro`
--

CREATE TABLE `replay_ho_tro` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TrixID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung` text COLLATE utf8_unicode_ci,
  `ngay` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `ico` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `momo_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `momo_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `momo_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT '''#''',
  `momo_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT '#',
  `bank_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_callback` text COLLATE utf8_unicode_ci,
  `mode_server_s7` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ON',
  `bank_chi_nhanh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_content` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `background`, `logo`, `title`, `content`, `ico`, `momo_name`, `momo_number`, `momo_image`, `momo_key`, `bank_name`, `bank_type`, `bank_number`, `bank_image`, `card_key`, `card_callback`, `mode_server_s7`, `bank_chi_nhanh`, `bank_content`) VALUES
(1, 'data/372c73817b91dfdce895f70400329336.jpg', 'data/20d3a47ba91b39ff7c6b392de1f94520.png', 'Hay like fb', 'Hệ thống dịch vụ mạng xã hội Facebook | Youtube | Instagram | TikTok ', 'data/b08e48c540a58f973b149316f6fac9aa.png', 'Nguyễ Xuân Tài', '0364289473', 'data/bec1f7054051f1cb7af27c44d9f94bf5.jpg', 'null', 'NGUYEN XUAN TAI', 'Mb Bank', '0364289473', 'data/e5a196faf04ad5a4a7710c48598ede76.jpg', 'NGUYEN XUAN TAI', 'NULL', 'OFF', '182 Lê Duẩn, tp. Vinh', 'NULL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_bank`
--

CREATE TABLE `table_bank` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_name` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_price` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `table_chi_nhanh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_bill`
--

CREATE TABLE `table_bill` (
  `id` int(11) NOT NULL,
  `TrixID` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `by_user` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(6) COLLATE utf8_unicode_ci DEFAULT '0',
  `amount_start` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0',
  `amount_success` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0',
  `price` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0',
  `trangthai` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'xuly',
  `note_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note_admin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_bill`
--

INSERT INTO `table_bill` (`id`, `TrixID`, `uid`, `slug`, `service`, `by_user`, `amount`, `amount_start`, `amount_success`, `price`, `trangthai`, `note_user`, `note_admin`, `created_at`) VALUES
(53, 'gLsPBdrNkhAb', 'posts/201680741657602', 'tang-like-facebook', '[ Lên sau 40p ] + [ Nhập Link ] - [ Nhập id không chạy được ] - [ Không chạy cho group + bài share ]', 'admin1', '4000', '0', '0', '16000', 'Waiting', '', '', '1631881373'),
(54, 'UBS9GZnJW4y7', 'posts/201680741657602', 'tang-like-facebook', '[ Lên sau 40p ] + [ Nhập Link ] - [ Nhập id không chạy được ] - [ Không chạy cho group + bài share ]', 'admin1', '1000', '0', '0', '4000', 'Waiting', '', '', '1631881714');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_chi_tieu`
--

CREATE TABLE `table_chi_tieu` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `price_default` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `price_change` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `price_present` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_chi_tieu`
--

INSERT INTO `table_chi_tieu` (`id`, `username`, `message`, `price_default`, `price_change`, `price_present`, `created_at`) VALUES
(72, 'admin1', 'admin1, Vừa đặt đơn hàng [tang-like-facebook] với giá 16.000đ, Được giảm giá: 0%', '980000', '16000', '996000', '1631881373'),
(73, 'admin1', 'admin1, Vừa đặt đơn hàng [tang-like-facebook] với giá 4.000đ, Được giảm giá: 0%', '964000', '4000', '968000', '1631881714');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_chuyen_tien`
--

CREATE TABLE `table_chuyen_tien` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `by_user` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_user` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_history`
--

CREATE TABLE `table_history` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT '#',
  `amount` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0',
  `price` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_history`
--

INSERT INTO `table_history` (`id`, `username`, `message`, `uid`, `amount`, `price`, `created_at`, `type`) VALUES
(89, 'admin1', 'admin1, Vừa đặt đơn hàng [tang-like-facebook] với giá 16.000đ, Được giảm giá: 0%', 'https://www.facebook.com/lequocdat2076/posts/201680741657602', '4000', '16000', '1631761574', 'tang-like-facebook'),
(90, 'admin1', 'admin1, Vừa đặt đơn hàng [tang-like-facebook] với giá 4.000đ, Được giảm giá: 0%', 'https://m.facebook.com/story.php?story_fbid=201680741657602&id=100054470316074', '1000', '4000', '1631768923', 'tang-like-facebook'),
(91, 'admin1', 'admin1, Vừa đặt đơn hàng [tang-like-facebook] với giá 16.000đ, Được giảm giá: 0%', 'https://www.facebook.com/lequocdat2076/posts/201680741657602', '4000', '16000', '1631881373', 'tang-like-facebook'),
(92, 'admin1', 'admin1, Vừa đặt đơn hàng [tang-like-facebook] với giá 4.000đ, Được giảm giá: 0%', 'https://www.facebook.com/lequocdat2076/posts/201680741657602', '1000', '4000', '1631881714', 'tang-like-facebook');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_momo`
--

CREATE TABLE `table_momo` (
  `id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_napthe`
--

CREATE TABLE `table_napthe` (
  `id` int(11) NOT NULL,
  `card_code` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_serial` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_price` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_type` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_notification_website`
--

CREATE TABLE `table_notification_website` (
  `id` int(11) NOT NULL,
  `noidung` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_notification_website`
--

INSERT INTO `table_notification_website` (`id`, `noidung`, `trangthai`, `created_at`) VALUES
(14, '<p>Hệ thống auto nạp thẻ cào tạm thời ngừng hoạt động.Các dịch vụ khác vẫn hoạt động bình thường. Mọi vấn đề thắc mắc xin vui lòng liên hệ admin - Zalo: 0364289473</p>\n\n<p>Fb:&nbsp;<a href="https://www.facebook.com/vietmabug"</p>', 'show', '1631454918');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_rut_tien`
--

CREATE TABLE `table_rut_tien` (
  `id` int(11) NOT NULL,
  `table_loai` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_chi_nhanh` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_price` varchar(10) COLLATE utf8_unicode_ci DEFAULT '0',
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_service`
--

CREATE TABLE `table_service` (
  `id` int(11) NOT NULL,
  `service` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_service`
--

INSERT INTO `table_service` (`id`, `service`, `slug`, `banner`, `content`, `trangthai`) VALUES
(12, 'Facebook Buff', 'facebook-buff', 'data/281b8cf8787ae7217eab9f0a0b00b5f5.png', '<p>.</p>\n', 'show'),
(13, 'Tiktok Buff', 'tiktok-buff', 'data/605afb6b62013f6726bb5f485b431c3e.png', '<p>.</p>\n', 'show'),
(14, 'Youtube Buff', 'youtube-buff', 'data/3dc0f645212371cfab4b392bab3fa974.png', '<p>.</p>\n', 'show'),
(15, 'Instagram Buff', 'instagram-buff', 'data/c415a5233bdd7bed66ccc611d5cec411.png', '<p>..</p>\n', 'show'),
(16, 'Shopee Buff', 'shopee-buff', 'data/daa90aa7a4b1ad984e79420d2cb65e44.png', '<p>...</p>\n', 'show'),
(17, 'Lazada Buff', 'lazada-buff', 'data/778f2182aa1f29164d230ef567b0ac17.png', '<p>...</p>\n', 'show');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_service_menu`
--

CREATE TABLE `table_service_menu` (
  `id` int(11) NOT NULL,
  `type` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_service_menu`
--

INSERT INTO `table_service_menu` (`id`, `type`, `service`, `slug`, `banner`, `trangthai`) VALUES
(37, 'tang-like-facebook', 'Tăng like facebook', 'facebook-buff', 'data/f2e72813c18c24ef3cde323546e0bc57.png', 'show'),
(38, 'tang-follow-facebook', 'Tăng follow facebook', 'facebook-buff', 'data/372f5273054cf6ce008bbdd371bf63c3.png', 'show'),
(39, 'tang-like-page-facebook', 'Tăng like page facebook', 'facebook-buff', 'data/4dffe10d45d987e35323a1c1c256461b.png', 'show'),
(40, 'tang-mat-live-facebook', 'Tăng mắt live facebook', 'facebook-buff', 'data/a5cc169b5362a5d989b38b0c0cea4175.png', 'show'),
(41, 'tang-view-video-facebook', 'Tăng view video facebook', 'facebook-buff', 'data/cd9717d6f3e817eb538d4429bc447d6d.png', 'show'),
(42, 'tang-follow-tiktok', 'Tăng follow tiktok', 'tiktok-buff', 'data/81f0ccce37a33f8c58f7d6bb34920d3b.png', 'show'),
(43, 'tang-tym-tiktok', 'Tăng tym tiktok', 'tiktok-buff', 'data/93b0255b1934d763f54f42aa611dcbcb.png', 'show'),
(44, 'tang-view-tiktok', 'Tăng view tiktok', 'tiktok-buff', 'data/e885598bfc0c71a6e8123a71aef043c4.png', 'show'),
(45, 'tang-like-youtube', 'Tăng like youtube', 'youtube-buff', 'data/01c07fc8b87c86494b08d96bc1591def.png', 'show'),
(46, 'tang-view-youtube', 'Tăng view youtube', 'youtube-buff', 'data/fb196bf96a510a06023f1eb00d4ed467.png', 'show'),
(47, 'tang-sub-youtube', 'Tăng sub youtube', 'youtube-buff', 'data/3474374d12c5c76f1fd0955f082f9e99.png', 'show'),
(48, 'tang-like-instagram', 'Tăng like instagram', 'instagram-buff', 'data/610fd72bb40bc4f9ba4aba3acb7ea0f8.png', 'show'),
(49, 'tang-binh-luan-instagram', 'Tăng bình luận instagram', 'instagram-buff', 'data/29ce25885ac38ac6507cafcebf66f224.png', 'show'),
(50, 'tang-follow-instagram', 'Tăng follow instagram', 'instagram-buff', 'data/bb1bfcda5c5ffb6872cd313bd80ba3dc.png', 'show'),
(51, 'tang-theo-doi-shopee', 'Tăng theo dõi shopee', 'shopee-buff', 'data/b64b39dcced7f111cda31c1505bf8a60.png', 'show'),
(52, 'tang-view-san-pham', 'Tăng view sản phẩm', 'shopee-buff', 'data/fbe8af8324acb0fcbf62c7b18c241165.png', 'show'),
(53, 'tang-danh-gia-don-hang', 'Tăng đánh giá đơn hàng', 'shopee-buff', 'data/9be389601e37c6519f7af6e65520eb57.png', 'show'),
(55, 'tang-danh-gia-lazadamall', 'Tăng đánh giá lazadamall', 'lazada-buff', 'data/4e9947ec0e302915139fde2fe580ed03.jpg', 'show'),
(56, 'ma-giam-gia-lazada', 'Mã giảm giá lazada', 'lazada-buff', 'data/3223020aeb5fe47676eb27c82a5dde5a.png', 'show');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_service_server`
--

CREATE TABLE `table_service_server` (
  `id` int(11) NOT NULL,
  `type` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(1000) COLLATE utf8_unicode_ci DEFAULT '0',
  `server` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_default` varchar(12) COLLATE utf8_unicode_ci DEFAULT '0',
  `price_daily` varchar(12) COLLATE utf8_unicode_ci DEFAULT '0',
  `price_ctv` varchar(12) COLLATE utf8_unicode_ci DEFAULT '0',
  `amount_min` varchar(10) COLLATE utf8_unicode_ci DEFAULT '1',
  `amount_max` varchar(10) COLLATE utf8_unicode_ci DEFAULT '1000',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `table_service_server`
--

INSERT INTO `table_service_server` (`id`, `type`, `slug`, `server`, `price_default`, `price_daily`, `price_ctv`, `amount_min`, `amount_max`, `content`, `trangthai`) VALUES
(33, '-len-sau-40p----nhap-link-----nhap-id-khong-chay-duoc-----khong-chay-cho-group--bai-share-', 'tang-like-facebook', '[ Lên sau 40p ] + [ Nhập Link ] - [ Nhập id không chạy được ] - [ Không chạy cho group + bài share ]', '4', '4', '4', '100', '100000', '<p>[ L</p>\n', 'show'),
(34, 'like-bam-tay--nhap-id-', 'tang-like-facebook', ' Like bấm tay [ Nhập id ] ', '25', '25', '25', '100', '100000', '<p>.</p>\n', 'show'),
(35, 'like-nhanh--toc-do-cuc-nhanh--co-tut---nhap-id-', 'tang-like-facebook', ' Like Nhanh [ Tốc Độ Cực Nhanh + Có tụt - Nhập id ] ', '9', '9', '9', '100', '100000', '<p>..</p>\n', 'show'),
(36, 'follow--toc-do-3k-1-ngay----len-sau-1h----bao-hanh-30-ngay-', 'tang-theo-doi', 'Follow [ Tốc độ 3k 1 Ngày ] + [ Lên sau 1h ] + [ Bảo hành 30 ngày ]', '7', '7', '7', '100', '10000000', '<p>Follow [ Tốc độ 3k /1 Ng</p>\n', 'show'),
(37, 'follow-nhanh--toc-do-on-dinh---done-50kngay---bao-hanh-30-ngay-', 'tang-theo-doi', 'Follow nhanh [ Tốc độ ổn định - Done 50kngày] + [ Bảo hành 30 ngày ]', '14', '14', '14', '100', '10000000', '<p>Follow nhanh [ Tốc độ ổn định - Done 50k/ng</p>\n', 'show'),
(38, 'sieu-toc---max-25k-1-luot----done-15p----bao-hanh-30-ngay-', 'tang-theo-doi', ' [Siêu Tốc] + [ Max 25k 1 Lượt ] + [ Done 15p ] + [ Bảo Hành 30 Ngày ]', '25', '25', '25', '100', '10000000', '<p>.</p>\n', 'show'),
(39, 'follow---nguoi-dung-that-bam-tay----bao-hanh-30-ngay-', 'tang-theo-doi', 'Follow  [ Người dùng thật bấm tay ] + [ Bảo hành 30 ngày ]', '40', '40', '40', '100', '10000000', '<p>Follow</p>\n', 'show'),
(42, 'view-that-lay-trending--co-the-kem-ca-like-va-tuong-tac----dat-tren-100k-de-nang-cao-ti-le-len-xu-huong-', 'tang-view-tiktok', 'View Thật Lấy Trending [ Có thể kèm cả like và tương tác ] + [ Đặt trên 100k để nâng cao tỉ lệ lên xu hướng ]', '3', '3', '3', '1', '10000000', '<p>View Thật Lấy Trending [ C</p>\n', 'show'),
(43, 'view-re-chat-luong-cao-sieu-toc', 'tang-view-tiktok', 'View rẻ Chất lượng cao siêu tốc', '5', '5', '5', '1', '10000000', '<p>View rẻ Chất lượng cao si</p>\n', 'show'),
(44, 'view-gia-re-len-sieu-toc-khong-bao-hanh', 'tang-view-tiktok', 'View giá rẻ lên siêu tốc không bảo hành', '1', '1', '1', '1', '100000000', '<p>View gi</p>\n', 'show'),
(45, 'follow-tiktok-viet---done-1kngay---bao-hanh-30-ngay', 'tang-follow-tiktok', 'Follow tiktok việt - (Done 1kNgày) - Bảo hành 30 ngày', '40', '40', '40', '1', '10000000', '<p>Follow tiktok việt - (Done 1k/Ng</p>\n', 'show'),
(46, 'follow-gia-re---done-500-1kngay---khong-bao-hanh', 'tang-follow-tiktok', 'Follow giá rẻ - (Done 500-1kNgày) - Không bảo hành', '12', '12', '12', '1', '10000000', '<p>Follow gi</p>\n', 'show'),
(47, 'len-sau-30p-done-20k24h-max-20k1-ngay---khong-bao-hanh', 'tang-tym-tiktok', 'Lên sau 30p (Done 20k24h) Max 20k1 Ngày - không bảo hành', '15', '15', '15', '1', '100000000', '<p>L</p>\n', 'show'),
(48, 'like-follow-page--co-tut--bao-hanh-30-ngay----bao-hanh-auto-', 'tang-like-page', ' Like Follow Page [ Có tụt + Bảo hành 30 ngày ] + [ Bảo hành auto ]', '14', '14', '14', '1', '10000000', '<p>.</p>\n', 'show');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `id` int(11) NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `api_momo`
--
ALTER TABLE `api_momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `api_thesieure`
--
ALTER TABLE `api_thesieure`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hop_thu_ho_tro`
--
ALTER TABLE `hop_thu_ho_tro`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lich_su_dang_nhap`
--
ALTER TABLE `lich_su_dang_nhap`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `napthe`
--
ALTER TABLE `napthe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `replay_ho_tro`
--
ALTER TABLE `replay_ho_tro`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_bank`
--
ALTER TABLE `table_bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_bill`
--
ALTER TABLE `table_bill`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_chi_tieu`
--
ALTER TABLE `table_chi_tieu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_chuyen_tien`
--
ALTER TABLE `table_chuyen_tien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_history`
--
ALTER TABLE `table_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_momo`
--
ALTER TABLE `table_momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_napthe`
--
ALTER TABLE `table_napthe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_notification_website`
--
ALTER TABLE `table_notification_website`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_rut_tien`
--
ALTER TABLE `table_rut_tien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_service`
--
ALTER TABLE `table_service`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_service_menu`
--
ALTER TABLE `table_service_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_service_server`
--
ALTER TABLE `table_service_server`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `api_momo`
--
ALTER TABLE `api_momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `api_thesieure`
--
ALTER TABLE `api_thesieure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hop_thu_ho_tro`
--
ALTER TABLE `hop_thu_ho_tro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_dang_nhap`
--
ALTER TABLE `lich_su_dang_nhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `napthe`
--
ALTER TABLE `napthe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `replay_ho_tro`
--
ALTER TABLE `replay_ho_tro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_bank`
--
ALTER TABLE `table_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_bill`
--
ALTER TABLE `table_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `table_chi_tieu`
--
ALTER TABLE `table_chi_tieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `table_chuyen_tien`
--
ALTER TABLE `table_chuyen_tien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_history`
--
ALTER TABLE `table_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `table_momo`
--
ALTER TABLE `table_momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `table_napthe`
--
ALTER TABLE `table_napthe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `table_notification_website`
--
ALTER TABLE `table_notification_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `table_rut_tien`
--
ALTER TABLE `table_rut_tien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_service`
--
ALTER TABLE `table_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `table_service_menu`
--
ALTER TABLE `table_service_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `table_service_server`
--
ALTER TABLE `table_service_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
