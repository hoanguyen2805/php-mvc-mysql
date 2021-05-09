-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2021 lúc 01:14 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phonestore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'laptop'),
(1, 'phone'),
(2, 'tablet');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `category_id`, `image`) VALUES
(1, 'acer aspire a7', 19000000, 3, 'assets/images/products/161962375460897f4a4da2f.jpg'),
(2, 'apple macbook air 2017', 18000000, 3, 'assets/images/products/161962378060897f6397d55.jpg'),
(3, 'macbook pro 2020 m1', 38000000, 3, 'assets/images/products/161962384660897fa58e1ba.jpg'),
(4, 'dell vostro 235577', 28900000, 3, 'assets/images/products/161962386960897fbd43abb.jpg'),
(5, 'huawei t10s', 5600000, 2, 'assets/images/products/161962388760897fcedb837.jpg'),
(6, 'ipad 4 cellular', 12000000, 2, 'assets/images/products/161962391160897fe6be8d7.jpg'),
(7, 'ipad mini 7 inch', 12000000, 2, 'assets/images/products/16196239646089801c4604c.jpg'),
(8, 'ipad pro 12 inch', 15960000, 2, 'assets/images/products/161962399060898035b5e9e.jpg'),
(9, 'iphone 12', 30000000, 1, 'assets/images/products/16196240166089804f7fc21.jpg'),
(10, 'lenovo tab m10', 3500000, 2, 'assets/images/products/16196240396089806748335.jpg'),
(11, 'oppo a15', 7500000, 1, 'assets/images/products/16196240616089807ca1931.jpg'),
(12, 'oppo a74', 7200000, 1, 'assets/images/products/16196240776089808d66d79.jpg'),
(13, 'realmi 8', 7600000, 1, 'assets/images/products/16196240956089809f41bf7.jpg'),
(14, 'samsung galaxy tab a7', 9900000, 2, 'assets/images/products/1619624124608980bc41a5c.jpg'),
(15, 'xiaomi mi 11 lite', 12000000, 1, 'assets/images/products/1619624143608980cece6a4.jpg'),
(16, 'xiaomi redmi note 10', 14000000, 1, 'assets/images/products/1619624163608980e2d9d43.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `recovery_code`
--

CREATE TABLE `recovery_code` (
  `email` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `birthDay` date NOT NULL,
  `avatar` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullName`, `email`, `username`, `password`, `birthDay`, `avatar`, `isAdmin`) VALUES
(1, 'ADMINISTRATOR', 'admin@gmail.com', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-10', 'assets/images/users/161959406160890b4d26385.png', 1),
(2, 'Tạ Bá Phú', 'nhocconmoilon1995@gmail.com', 'baphu', 'fbade9e36a3f36d3d676c1b808451dd7', '2021-04-14', 'assets/images/users/161959409360890b6d06ddd.png', 0),
(3, 'Nguyễn Văn Hòa', 'hoanguyen280598@gmail.com', 'vanhoa', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-20', 'assets/images/users/161959412260890b89bfa15.png', 0),
(4, 'Đặng Văn Bảo Hưng', 'vanhoa280598@gmail.com', 'baohung', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-16', 'assets/images/users/161959415460890baa45291.png', 0),
(5, 'Huỳnh Anh Tuấn', 'hoanguyen98.nta@gmail.com', 'anhtuan', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-09', 'assets/images/users/161959419360890bd0ceaac.png', 0),
(6, 'Trương Thị Mỹ Trinh', 'mytrinh@gmail.com', 'mytrinh', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-10', 'assets/images/users/161959423060890bf593a58.png', 0),
(7, 'Nguyễn Văn Bình', 'vanbinh@gmail.com', 'vanbinh', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-07', 'assets/images/users/161959424960890c0954c44.png', 0),
(8, 'Trần Quang Duy', 'onlylight0209@gmail.com', 'quangduy', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-13', 'assets/images/users/161959438960890c950c245.png', 0),
(9, 'Võ Nguyễn Hoàng Phi', 'hoangphi@gmail.com', 'hoangphi', '81dc9bdb52d04dc20036dbd8313ed055', '2021-04-14', 'assets/images/users/161959442260890cb5cbf6c.png', 0),
(10, 'Trần Cẩm Nga', 'ngatran@gmail.com', 'camnga98', '81dc9bdb52d04dc20036dbd8313ed055', '2021-05-19', 'assets/images/users/162047995060968fce01b64.png', 0),
(11, 'Đoàn Thị Bảo Linh', 'baolinh@gmail.com', 'linhdoan', '81dc9bdb52d04dc20036dbd8313ed055', '2021-05-12', 'assets/images/users/162047997960968feb12f4e.png', 0),
(12, 'Ung Thị Thùy Oanh', 'thuyoanh@gmail.com', 'oanhthuy', '81dc9bdb52d04dc20036dbd8313ed055', '2021-05-13', 'assets/images/users/16204800106096900a0f580.png', 0),
(13, 'Lý Thu Thủy', 'thuthuy@gmail.com', 'thuthuy', '81dc9bdb52d04dc20036dbd8313ed055', '2021-05-13', 'assets/images/users/16204800346096902253b92.png', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name_category` (`name`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Chỉ mục cho bảng `recovery_code`
--
ALTER TABLE `recovery_code`
  ADD PRIMARY KEY (`email`,`token`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username_user` (`username`) USING BTREE,
  ADD UNIQUE KEY `unique_email_user` (`email`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
