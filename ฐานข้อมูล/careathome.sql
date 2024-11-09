-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 09:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `careathome`
--

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(10) NOT NULL COMMENT 'Primary Key',
  `package_name` varchar(100) NOT NULL COMMENT 'ชื่อแพคเกจ',
  `package_description` text NOT NULL COMMENT 'รายละเอียดของแพคเกจ',
  `cost` int(11) NOT NULL COMMENT 'ราคาของแพคเกจ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_name`, `package_description`, `cost`) VALUES
(1, 'Basic Care', 'บริการดูแลพื้นฐาน สำหรับผู้สูงอายุ', 3000),
(2, 'Home Visit', 'บริการดูแลที่บ้าน พร้อมตรวจสุขภาพเบื้องต้น', 5000),
(3, 'Premium Care', 'บริการดูแลครบวงจรพร้อมติดตามผลสุขภาพ', 7000),
(4, 'Monthly Checkup', 'ตรวจสุขภาพรายเดือน พร้อมคำแนะนำจากผู้เชี่ยวชาญ', 4000),
(5, 'Daily Monitoring', 'บริการดูแลและตรวจเช็คสภาพทุกวัน', 10000),
(6, 'Exercise Package', 'โปรแกรมการออกกำลังกายที่เหมาะสมสำหรับผู้สูงอายุ', 4500),
(7, 'Therapy Session', 'แพ็คเกจการบำบัดและฟื้นฟูเฉพาะทาง', 6000),
(8, 'Medication Support', 'ช่วยเหลือการให้ยาและติดตามอาการ', 3500),
(10, '24/7 Emergency Care', 'บริการดูแลฉุกเฉินตลอด 24 ชั่วโมง', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `patient_id` int(10) NOT NULL COMMENT 'Primary Key',
  `user_id` int(11) NOT NULL COMMENT 'Foreign Key to Users',
  `fullname` varchar(50) NOT NULL,
  `patient_info` text NOT NULL COMMENT 'ข้อมูลส่วนตัวของคนไข้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`patient_id`, `user_id`, `fullname`, `patient_info`) VALUES
(2, 17, 'ตาของนาย 7', 'ผู้สูงอายุหญิง อายุ 80 ปี มีอาการปวดเข่าและประสบปัญหาเรื่องการเคลื่อนไหว'),
(7, 46, 'ทดสอบ ๆ ', '              ทดสอบ ๆ ทดสอบ ๆ ทดสอบ ๆ ทดสอบ ๆ '),
(8, 3, 'ป๋า', 'อายุ 100 ปี              ');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `thread_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(5, 17, 2, 'ผมแนะนำให้มีพยาบาลประจำบ้านครับ', '2024-11-05 13:30:01', '2024-11-05 13:30:01'),
(6, 18, 2, 'การพาไปพบแพทย์เป็นสิ่งที่สำคัญครับ', '2024-11-05 13:30:01', '2024-11-05 13:30:01'),
(9, 17, 2, 'ก็ดีเหมือนกันนะ', '2024-11-05 13:41:44', '2024-11-05 13:41:44'),
(10, 17, 2, 'ดีสุด ๆ', '2024-11-05 13:41:49', '2024-11-05 13:41:49'),
(11, 18, 2, 'โคตรแจ๋ว', '2024-11-05 13:42:04', '2024-11-05 13:42:04'),
(12, 18, 2, 'ทดสอบใหม่ดู\r\n', '2024-11-05 13:53:27', '2024-11-05 13:53:27'),
(13, 19, 2, 'ได้ไหมละ', '2024-11-05 13:53:43', '2024-11-05 13:53:43'),
(14, 19, 2, 'ลองเบิ๋งง', '2024-11-05 13:53:48', '2024-11-05 13:53:48'),
(15, 21, 2, 'สุดยอดจ้า', '2024-11-05 13:54:04', '2024-11-05 13:54:04'),
(17, 19, 2, 'ไไไไไ', '2024-11-07 04:11:15', '2024-11-07 04:11:15'),
(18, 19, 2, 'ๅๅๅๅ', '2024-11-07 04:11:19', '2024-11-07 04:11:19'),
(25, 34, 2, 'ดดดดดด', '2024-11-08 02:01:54', '2024-11-08 02:01:54'),
(26, 21, 2, 'แจ่ม ๆ', '2024-11-09 07:34:29', '2024-11-09 07:34:29'),
(27, 17, 2, 'เห็นด้วยนะ', '2024-11-09 07:35:10', '2024-11-09 07:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pr`
--

INSERT INTO `pr` (`id`, `title`, `date`, `details`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'บริการดูแลผู้สูงอายุ', '2024-11-05', 'เรามีบริการดูแลผู้สูงอายุที่บ้านเพื่อความสะดวกสบายและปลอดภัยสำหรับผู้สูงอายุของคุณ ด้วยทีมงานที่มีคุณภาพและประสบการณ์.', 27, '2024-11-05 09:24:54', '2024-11-05 09:35:51'),
(4, 'บริการดูแลคนไข้ที่บ้าน', '2024-11-05', 'บริการดูแลคนไข้ที่บ้านเพื่อการฟื้นฟูและการรักษาที่ต่อเนื่อง โดยทีมแพทย์และพยาบาลที่มีความเชี่ยวชาญ.', 25, '2024-11-05 09:24:54', '2024-11-05 09:25:14'),
(14, 'บริการดูแลผู้สูงอายุ', '2024-11-01', 'เรามีบริการดูแลผู้สูงอายุที่บ้าน พร้อมทีมงานมืออาชีพที่สามารถให้การดูแลที่เหมาะสมและปลอดภัย.', 26, '2024-11-05 09:43:16', '2024-11-05 09:43:46'),
(15, 'การตรวจสุขภาพประจำปีสำหรับผู้สูงอายุ', '2024-11-02', 'ตรวจสุขภาพประจำปีช่วยให้ผู้สูงอายุสามารถตรวจสอบสุขภาพและป้องกันปัญหาสุขภาพได้อย่างทันท่วงที.', 25, '2024-11-05 09:43:16', '2024-11-05 09:43:46'),
(16, 'บริการดูแลคนไข้ที่บ้าน', '2024-11-03', 'เรามีบริการดูแลคนไข้ที่บ้าน สำหรับผู้ที่ต้องการการดูแลพิเศษจากทีมแพทย์และพยาบาล.', 11, '2024-11-05 09:43:16', '2024-11-05 09:43:46'),
(17, 'การฟื้นฟูสมรรถภาพผู้สูงอายุ', '2024-11-04', 'การฟื้นฟูสมรรถภาพสำหรับผู้สูงอายุเป็นสิ่งสำคัญเพื่อให้มีคุณภาพชีวิตที่ดี.', 4, '2024-11-05 09:43:16', '2024-11-05 09:43:46'),
(24, 'ทดสอบ ๆ', '2024-11-07', 'ทดสอบ ๆทดสอบ ๆทดสอบ ๆ', 2, '2024-11-07 08:31:53', '2024-11-07 08:31:53'),
(25, 'ข่าวดี ลดราคาอย่างหนัก', '2024-11-07', 'ลดอีหลี ๆ', 2, '2024-11-07 08:39:44', '2024-11-07 08:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `service_ratings`
--

CREATE TABLE `service_ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_ratings`
--

INSERT INTO `service_ratings` (`rating_id`, `user_id`, `rating`, `feedback`, `created_at`) VALUES
(35, 30, 3, 'มีบางส่วนที่ต้องปรับปรุง แต่โดยรวมถือว่าใช้ได้', '2024-11-05 12:26:07'),
(36, 24, 5, 'บริการรวดเร็วทันใจ พนักงานเป็นกันเอง', '2024-11-05 12:26:07'),
(38, 23, 4, 'ดี แต่มีบางจุดที่สามารถพัฒนาเพิ่มเติมได้', '2024-11-05 12:26:07'),
(39, 31, 5, 'บริการดีมาก พนักงานน่ารักทุกคน', '2024-11-05 12:26:07'),
(92, 3, 5, 'แจ่มเลยครับ', '2024-11-09 07:43:37'),
(93, 3, 3, 'ปานกลางนะผมว่า', '2024-11-09 07:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(17, 6, 'คำถามเกี่ยวกับการดูแลผู้สูงอายุ', 'ใครมีคำแนะนำในการดูแลผู้สูงอายุบ้างครับ?', '2024-11-05 13:27:57', '2024-11-05 13:27:57'),
(18, 17, 'บริการช่วยเหลือผู้สูงอายุ', 'มีบริการไหนที่แนะนำให้ช่วยเหลือผู้สูงอายุได้บ้าง?', '2024-11-05 13:27:57', '2024-11-05 13:27:57'),
(19, 2, 'ทดสอบ ๆ', 'ทดสอบ ๆ', '2024-11-05 13:50:44', '2024-11-05 13:50:44'),
(21, 2, 'เทสๆเด้อเทสๆเด้อเทสๆเด้อ', 'เทสๆเด้อเทสๆเด้อเทสๆเด้อ', '2024-11-05 13:51:27', '2024-11-05 13:51:27'),
(22, 2, 'ได้ยุบ่', 'ได้ยุบ่', '2024-11-07 04:11:31', '2024-11-07 04:11:31'),
(23, 2, 'qqqq', 'qqqq', '2024-11-07 04:13:04', '2024-11-07 04:13:04'),
(24, 2, 'qqq', 'qqq', '2024-11-07 04:13:28', '2024-11-07 04:13:28'),
(33, 46, 'ต้องการคนดูแลผู้สูงอายุโรคหัวใจ', 'ต้องการด่วนมาก ๆ', '2024-11-08 01:40:47', '2024-11-08 01:40:47'),
(34, 2, 'ดดด', 'ดดดด', '2024-11-08 02:01:50', '2024-11-08 02:01:50'),
(35, 2, 'ลดโค้ดแล้ว', 'ลดโค้ดแล้ว', '2024-11-09 07:36:23', '2024-11-09 07:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL COMMENT 'Primary Key',
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน (เข้ารหัสไว้)',
  `role` enum('admin','user','staff','') NOT NULL COMMENT 'บทบาทของผู้ใช้งาน',
  `fullname` varchar(100) NOT NULL COMMENT 'ชื่อเต็มของผู้ใช้งาน',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู่ของผู้ใช้งาน',
  `telephone` varchar(15) NOT NULL COMMENT 'เบอร์โทรศัพท์ของผู้ใช้งาน (เช่น +66 123456789)',
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่และเวลาของการกระทำล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role`, `fullname`, `address`, `telephone`, `action_timestamp`) VALUES
(2, 'w.wimonput@gmail.com', 'admin', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'admin', 'Mr.Wutipong Wimonput', '415555', '0946672645', '2024-11-06 13:50:03'),
(3, 'w.wimonput@gmail.com', 'user', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'นายวุฒิพงศ์ วิมลพัชร ัyesir', '187 หมู่ 7 บ้าน ก่อ ถนน กัน ทรลักษณ์, ตำบล แสนสุข', '0910171373', '2024-11-09 07:47:11'),
(4, 'admin1@example.com', 'admin1', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'admin', 'Admin User One', '123 Admin St.', '012-345-6789', '2024-11-06 02:35:53'),
(5, 'admin2@example.com', 'admin2', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'admin', 'Admin User Two', '456 Admin Ave.', '012-987-6543', '2024-11-06 02:35:53'),
(6, 'user1@example.com', 'user1', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User One', '789 User Rd.555555555555', '013-456-7890', '2024-11-06 02:35:53'),
(7, 'user2@example.com', 'user2', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Two', '321 User St.', '013-654-3210', '2024-11-06 02:35:53'),
(16, 'user6@example.com', 'user6', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Six', '100 User Rd.', '013-123-4561', '2024-11-06 02:35:53'),
(17, 'user7@example.com', 'user7', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Seven', '101 User Rd.', '013-123-4562', '2024-11-06 02:35:53'),
(19, 'user9@example.com', 'user9', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Nine', '103 User Rd.', '013-123-4564', '2024-11-06 02:35:53'),
(20, 'user10@example.com', 'user10', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Ten', '104 User Rd.', '013-123-4565', '2024-11-06 02:35:53'),
(21, 'user11@example.com', 'user11', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Eleven', '105 User Rd.', '013-123-4566', '2024-11-06 02:35:53'),
(22, 'user12@example.com', 'user12', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Twelve', '106 User Rd.', '013-123-4567', '2024-11-06 02:35:53'),
(23, 'user13@example.com', 'user13', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Thirteen', '107 User Rd.', '013-123-4568', '2024-11-06 02:35:53'),
(24, 'user14@example.com', 'user14', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Fourteen', '108 User Rd.', '013-123-4569', '2024-11-06 02:35:53'),
(28, 'user15@example.com', 'user15', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Fifteen', '109 User Rd.', '013-123-4570', '2024-11-06 02:35:53'),
(29, 'user16@example.com', 'user16', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Sixteen', '110 User Rd.', '013-123-4571', '2024-11-06 02:35:53'),
(30, 'user17@example.com', 'user17', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Seventeen', '111 User Rd.', '013-123-4572', '2024-11-06 02:35:53'),
(31, 'user18@example.com', 'user18', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Eighteen', '112 User Rd.', '013-123-4573', '2024-11-06 02:35:53'),
(33, 'user20@example.com', 'user20', '$2y$10$wYC4ZoVJjpkHMhOGxE01/.co3ELHpPY1BmWu2XTl6xSR8U9knSEX6', 'user', 'User Twenty', '114 User Rd.', '013-123-4575', '2024-11-06 02:35:53'),
(45, '555@gmail.com', 'user555', '$2y$10$BgYXodntsS.TYMswlBZnxeS1poLf8pYB39dBjcrBSUJ9fs148uYxe', 'user', 'okpdddd11111199999', 'okpdddd', '000000000000', '2024-11-08 01:57:47'),
(46, 'w.wimonput@gmail.com', 'user999', '$2y$10$k.4wKDF0rRNxmvOKUNpII.pHK8US9z.Ggxp7ozBzd2V8YXWj6hzhK', 'user', 'Mr.Wutipong Wimonput', '4151111', '0946672645', '2024-11-08 01:56:39'),
(48, '111@gmail.com', 'yourboyhaha', '$2y$10$ZsxBthK3u8/x4.2aMjc.QeZoQ04Azx1AMN5pcBs.sSEBV9b/L7DvO', 'user', '', '', '', '2024-11-09 05:52:59'),
(49, '222@gmail.com', 'qqq', '$2y$10$ri0UvhDcg3V7S.X9S0i0Fe3tFrq05GXkdQPn0nbjRMbyEp56T/W..', 'user', '', '', '', '2024-11-09 05:54:57'),
(51, 'ooqqqo@gmail.com', 'hahahah', '$2y$10$BTG1xNXP5P5L1CCZXTB8G.GcdENsZtkF7Ik5PpqYOp6oiGohY9Nu2', 'user', 'qqqq', 'qqqqq', 'qqqq', '2024-11-09 07:05:25'),
(52, '111@gmail.com', 'user123', '$2y$10$caaK5EJRJL.HISHMx0Kl8OlqptdnM2wxtw5hz92QvTfSGg08y8vI.', 'user', 'นายวุฒิพงศ์ วิมลพัชร', '415 หมู่ 20 ตำบลแสนสุข', '0910171373', '2024-11-09 06:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_package`
--

CREATE TABLE `user_package` (
  `user_package_id` int(10) NOT NULL COMMENT 'Primary Key',
  `user_id` int(10) NOT NULL COMMENT 'Foreign Key to Users',
  `package_id` int(10) NOT NULL COMMENT 'Foreign Key to Package'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_package`
--

INSERT INTO `user_package` (`user_package_id`, `user_id`, `package_id`) VALUES
(4, 33, 1),
(98, 3, 6),
(99, 3, 2),
(100, 3, 3),
(101, 3, 5),
(107, 52, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `userid_patient` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posts_ibfk_1` (`thread_id`),
  ADD KEY `posts_ibfk_2` (`user_id`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `service_ratings`
--
ALTER TABLE `service_ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_user_rating` (`user_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `threads_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_package`
--
ALTER TABLE `user_package`
  ADD PRIMARY KEY (`user_package_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `patient_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `service_ratings`
--
ALTER TABLE `service_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_package`
--
ALTER TABLE `user_package`
  MODIFY `user_package_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD CONSTRAINT `userid_patient` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`thread_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `service_ratings`
--
ALTER TABLE `service_ratings`
  ADD CONSTRAINT `fk_user_rating` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_package`
--
ALTER TABLE `user_package`
  ADD CONSTRAINT `package_id` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
