-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 02, 2025 lúc 04:52 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_booking`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `order_info` text NOT NULL,
  `transaction_no` varchar(50) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  `pay_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(15) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`id`, `order_id`, `amount`, `order_info`, `transaction_no`, `bank_code`, `pay_date`, `status`, `customer_name`, `customer_email`, `customer_phone`, `note`, `room_id`, `check_in`, `check_out`, `created_at`) VALUES
(3, '2025040202204927', 2997000.00, 'Thanh toan GD:2025040202204927', '14885552', 'NCB', '2025-04-02 02:21:09', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', 'rtbtyuvyrcvtyjrytjvrtujt', 24, '0000-00-00', '0000-00-00', '2025-04-01 19:21:08'),
(4, '2025040203075639', 1998000.00, 'Thanh toan GD:2025040203075639', '14885561', 'NCB', '2025-04-02 03:08:22', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', 'rsgagerge', 23, '0000-00-00', '0000-00-00', '2025-04-01 20:08:28'),
(5, '2025040203164294', 8991000.00, 'Thanh toan GD:2025040203164294', '14885562', 'NCB', '2025-04-02 03:17:08', 'Success', 'Van DU', 'vincent2k3vd@gmail.com', '4643645345', 'ưaefawefawefwe', 23, '0000-00-00', '0000-00-00', '2025-04-01 20:17:13'),
(6, '2025040203263659', 999000.00, 'Thanh toan GD:2025040203263659', '14885572', 'NCB', '2025-04-02 03:26:55', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', 'rtyrtggaersgef', 23, '0000-00-00', '0000-00-00', '2025-04-01 20:27:54'),
(7, '2025040203263659', 999000.00, 'Thanh toan GD:2025040203263659', '14885572', 'NCB', '2025-04-02 03:26:55', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', 'rtyrtggaersgef', 25, '0000-00-00', '0000-00-00', '2025-04-01 20:28:52'),
(8, '2025040203263659', 999000.00, 'Thanh toan GD:2025040203263659', '14885572', 'NCB', '2025-04-02 03:26:55', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', 'rtyrtggaersgef', 23, '0000-00-00', '0000-00-00', '2025-04-01 20:29:56'),
(9, '2025040203263659', 999000.00, 'Thanh toan GD:2025040203263659', '14885572', 'NCB', '2025-04-02 03:26:55', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', 'rtyrtggaersgef', 23, '0000-00-00', '0000-00-00', '2025-04-01 20:30:07'),
(10, '2025040203302747', 1998000.00, 'Thanh toan GD:2025040203302747', '14885575', 'NCB', '2025-04-02 03:30:54', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', '1234567', 23, '0000-00-00', '0000-00-00', '2025-04-01 20:30:55'),
(11, '2025040203302747', 1998000.00, 'Thanh toan GD:2025040203302747', '14885575', 'NCB', '2025-04-02 03:30:54', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', '1234567', 28, '2025-04-02', '2025-04-04', '2025-04-01 20:31:35'),
(12, '2025040203302747', 1998000.00, 'Thanh toan GD:2025040203302747', '14885575', 'NCB', '2025-04-02 03:30:54', 'Success', 'Van Du', 'vincent2k3vd@gmail.com', '0339455501', '1234567', 23, '2025-04-02', '2025-04-04', '2025-04-01 20:31:40'),
(13, '2025040214590380', 2997000.00, 'Thanh toan GD:2025040214590380', '14886536', 'NCB', '2025-04-02 14:59:36', 'Success', 'Đoàn Van Dự', 'vincentD@gmail.com', '0339455501', 'Tôi check in sao 18:00 nhá', 23, '2025-04-02', '2025-04-05', '2025-04-02 07:59:33'),
(14, '2025040221462775', 300000.00, 'Thanh toan GD:2025040221462775', '14887400', 'NCB', '2025-04-02 21:48:04', 'Success', 'Tăng Nguyễn Tuấn Khoa', 'tuankhoa542003@gmail.com', '0336967745', '', 24, '2025-04-03', '2025-04-06', '2025-04-02 14:48:04'),
(15, '2025040221462775', 300000.00, 'Thanh toan GD:2025040221462775', '14887400', 'NCB', '2025-04-02 21:48:04', 'Success', 'Tăng Nguyễn Tuấn Khoa', 'tuankhoa542003@gmail.com', '0336967745', '', 24, '2025-04-03', '2025-04-06', '2025-04-02 14:48:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `phone`, `email`, `iframe`) VALUES
(1, 'Thu Duc, Ho Chi Minh', 'asd', ' 84332953945', 'pmq28434@gmail.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1528801.3827216914!2d-75.083395!3d41.548892!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b:0xc80b8f06e177fe62!2sNew York, NY, USA!5e0!3m2!1sen!2sbd!4v1743234478560!5m2!1sen!2sbd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(300) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(9, 'bi-wifi', 'Wifi', 'asdadadsd'),
(11, 'bi-tv', 'Television', 'asdsadasdad'),
(12, 'bi-snow', 'Air Conditioner', 'asdasd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(8, 'Balcony'),
(9, 'Kitchen'),
(10, 'Bedroom');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(23, 'Room 10', 58, 999, 2, 2, 3, 'ALLLLL', 1, 0),
(24, 'Deluxe II', 45, 100, 2, 5, 2, 'edfgpauergvegvafuvdflvibd', 1, 0),
(25, 'Deluxe', 45, 100, 2, 2, 1, '0', 1, 1),
(26, 'Room 2', 45, 100, 2, 2, 1, '0', 1, 1),
(27, 'Normal 1', 650, 999, 2, 2, 5, '0', 1, 1),
(28, 'Deluxe III', 72, 789, 2, 3, 2, '0', 1, 0),
(29, 'Deluxe IV', 99, 1200, 3, 6, 1, '0', 1, 0),
(30, 'Small Room 1', 150, 10, 1, 2, 1, 'smaall', 1, 0),
(31, 'Standard Room', 30, 800000, 10, 2, 1, 'Cozy room with city view', 0, 0),
(32, 'Superior Room', 35, 1200000, 8, 2, 2, 'Modern room with a large balcony', 0, 0),
(33, 'Deluxe Room', 40, 1500000, 5, 2, 1, 'Spacious room with sea view', 0, 0),
(34, 'Suite', 50, 2500000, 3, 3, 2, 'Luxury suite with a jacuzzi', 0, 0),
(35, 'Family Room', 45, 1800000, 6, 4, 2, 'Perfect for families, includes a mini-kitchen', 0, 0),
(36, 'Presidential Suite', 80, 5000000, 2, 4, 3, 'Exclusive suite with private butler service', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(69, 23, 9),
(70, 23, 11),
(71, 23, 12),
(74, 28, 9),
(75, 28, 11),
(77, 24, 12),
(78, 29, 9),
(79, 29, 11),
(80, 29, 12),
(84, 30, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(65, 23, 9),
(66, 23, 10),
(69, 28, 9),
(71, 24, 8),
(72, 29, 8),
(73, 29, 9),
(74, 29, 10),
(78, 30, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(14, 23, '8.png', 1),
(16, 24, '2.png', 1),
(18, 28, '3.png', 1),
(19, 23, '4.png', 1),
(20, 24, '5.png', 1),
(21, 24, '6.png', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(200) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'LETMECOOK', 'asdsaddsd', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(6, 'TANG LE TUAN KHOA', 'IMG_29356.png'),
(7, 'DOAN MINH DU', 'IMG_66552.png'),
(8, 'NGUYEN HONG QUAN', 'IMG_77000.png'),
(9, 'PHAN MINH QUOC', 'IMG_97815.png'),
(10, 'NGUYEN THANH LUAN', 'IMG_49041.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phonenum` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `dob`, `password`, `token`) VALUES
(4, 'Tăng Nguyễn Tuấn Khoa', 'tuankhoa542003@gmail.com', '61 My Khanh street, Phuoc Hoa hamlet, Phuoc Hiep commune, Cu Chi district', '0336967745', '2025-04-02', '$2y$10$vJZZeTzSuUkvp/uUJaXRrO0CUN/fuMRlWCFXnbWfHEumAH1mq127O', '606af166679a7510c9c72d5f39e9d45f');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` varchar(500) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `message`, `subject`, `date`, `seen`) VALUES
(5, 'dsf', 'asd@email.com', 'asd', 'ggdf', '2025-03-30', 0),
(6, 'dsf', 'asd@email.com', 'asd', 'asddsa', '2025-03-30', 0),
(7, 'dsf', 'asd@email.com', 'asd', 'asdsadasd', '2025-03-30', 0),
(8, 'dsf', 'asd@email.com', 'asd', 'asdsada', '2025-03-30', 0),
(9, 'dsf', 'asd@email.com', 'asd', 'asdsdsadasdasda', '2025-03-30', 0),
(10, 'dsf', 'asd@email.com', 'asd', 'asdsadsadasdasd', '2025-03-30', 0),
(11, 'dsf', 'asd@email.com', 'asd', 'asddasdasdasd', '2025-03-30', 0),
(12, 'dsf', 'asd@email.com', 'asd', 'asdaddsadasdad', '2025-03-30', 0),
(13, 'dsf', 'asd@email.com', 'asd', 'asddsadasd', '2025-03-30', 0),
(14, 'dsf', 'asd@email.com', 'asd', 'asdadsd', '2025-03-30', 0),
(15, 'dsf', 'asd@email.com', 'asd', 'asdasddad', '2025-03-30', 0),
(16, 'dsf', 'asd@email.com', 'asd', 'asd', '2025-03-30', 0),
(17, 'dsf', 'asd@email.com', 'asd', 'asdasdsd', '2025-03-30', 0),
(18, 'dsf', 'asd@email.com', 'asd', 'asdsaasd', '2025-03-30', 0),
(19, 'dsf', 'asd@email.com', 'asd', 'asdadsadsd', '2025-03-30', 0),
(20, 'dsf', 'asd@email.com', 'asd', 'asdadasdasd', '2025-03-30', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Chỉ mục cho bảng `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `room id 2` (`room_id`);

--
-- Chỉ mục cho bảng `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_images_ibfk_1` (`room_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id 2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
