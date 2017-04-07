-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2017 at 04:39 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii_begin`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '7', 1470714995),
('Author', '6', 1470715026);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, NULL, NULL, NULL, 1470714995, 1470714995),
('Author', 1, NULL, NULL, NULL, 1470714995, 1470714995),
('Editer', 1, NULL, NULL, NULL, 1470714995, 1470714995),
('manageAll', 2, 'Quản lý tất cả', NULL, NULL, 1470714995, 1470714995),
('managePost', 2, 'Tạo và chỉnh sửa bài viết', NULL, NULL, 1470714995, 1470714995),
('manageUser', 2, 'Chỉnh sửa và tạo người dùng', NULL, NULL, 1470714995, 1470714995);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'Author'),
('Admin', 'Editer'),
('Admin', 'manageAll'),
('Admin', 'managePost'),
('Admin', 'manageUser'),
('Author', 'managePost'),
('Editer', 'Author'),
('Editer', 'managePost'),
('Editer', 'manageUser');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_tab` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `date_begin` int(11) NOT NULL,
  `date_end` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `name`, `url`, `value`, `position`, `new_tab`, `date_begin`, `date_end`, `type`, `banner_order`) VALUES
(1, 'Top Her', 'http://nhadathd.vl/', '', 'top_header', 'current_tab', 1471903200, 1472162400, 'images', 0),
(2, 'Right header ', 'http://b.nhadathd.vl/', '', 'top_header_left', 'open_tab', -3600, -3600, 'images', 0),
(3, 'right_footer', '#', '', 'right_footer', 'current_tab', 0, 0, 'images', 0),
(4, 'sidebarightcentrer', '', '', 'sidebar_right_centrer', 'current_tab', 0, 0, 'images', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `title`, `description`, `type`) VALUES
(1, 0, 'Tin nổi bật', '', 'posts'),
(2, 0, 'Tin xem nhiều', '', 'posts'),
(3, 0, 'Liên kết nổi bật', '', 'posts'),
(4, 3, 'Khu đô thị tuệ tinh', '', 'posts'),
(5, 0, 'Tin Tức', '', 'posts'),
(6, 5, 'Tin thị trường', '', 'posts'),
(7, 5, 'Chính sách - quy hoạch', '', 'posts'),
(8, 5, 'Tin dự án', '', 'posts'),
(9, 5, 'BDS Thế giới', '', 'posts'),
(10, 5, 'Thị trường vật liệu xây dựng', '', 'posts'),
(13, 0, 'Phong thủy', '', 'posts'),
(14, 0, 'Bds Bán', '', 'batdongsan'),
(15, 0, 'Bds Cho thuê', '', 'batdongsan'),
(16, 14, 'Bán căn hộ chung cư', '', 'batdongsan'),
(17, 14, 'Tất cả các loại nhà bán', '', 'batdongsan'),
(18, 17, 'Bán nhà riêng', '', 'batdongsan'),
(19, 0, 'Bán biệt thự liền kề', '', 'batdongsan'),
(20, 15, 'Cho thuê căn hộ chung cư', '', 'batdongsan'),
(21, 0, 'Không gian sống', '', 'posts'),
(22, 0, 'Nội thất', '', 'posts'),
(23, 0, 'Nhà đẹp', '', 'posts');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'baseUrl', 'http://localhost/begin/backend/web/'),
(2, 'nameApp', 'Begin'),
(3, 'diadiemdefault', '{"tinh":"30","huyen_id":"288","xa":""}'),
(4, 'categorynewuser', '["6","8","18","1","21","2"]');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `author_id`, `title`, `description`, `alt`, `url`, `status`, `create_at`, `update_at`) VALUES
(35, 7, 'logo', '', '', 'uploads/images/2016/08/logo.png', 0, '2016-08-12 21:39:54', '0000-00-00 00:00:00'),
(36, 7, 'banner', '', '', 'uploads/images/2016/08/banner.gif', 0, '2016-08-13 00:36:23', '0000-00-00 00:00:00'),
(37, 7, 'quangcao', '', '', 'uploads/images/2016/08/quangcao.gif', 0, '2016-08-13 11:27:50', '0000-00-00 00:00:00'),
(48, 7, 'cay-canh-1', '', '', 'uploads/images/2016/09/cay-canh-1.jpg', 0, '2016-09-13 14:40:59', '0000-00-00 00:00:00'),
(50, 7, 'cay-canh-5', '', '', 'uploads/images/2016/09/cay-canh-5.jpg', 0, '2016-09-13 14:41:15', '0000-00-00 00:00:00'),
(51, 7, 'vong-deo-tay-4', '', '', 'uploads/images/2016/09/vong-deo-tay-4.jpg', 0, '2016-09-13 14:41:21', '0000-00-00 00:00:00'),
(52, 7, 'vong-deo-tay-5', '', '', 'uploads/images/2016/09/vong-deo-tay-5.jpg', 0, '2016-09-13 14:41:27', '0000-00-00 00:00:00'),
(54, 7, 'cay-canh', '', '', 'uploads/images/2016/09/cay-canh.jpg', 0, '2016-09-13 18:10:40', '0000-00-00 00:00:00'),
(57, 7, '11261661_895480870487130_8638260627910861365_n', '', '', 'uploads/images/2017/03/11261661_895480870487130_8638260627910861365_n.jpg', 0, '2017-03-06 16:37:57', '0000-00-00 00:00:00'),
(58, 7, '10474727_739055926129626_8372302982240567744_n', '', '', 'uploads/images/2017/03/10474727_739055926129626_8372302982240567744_n.jpg', 0, '2017-03-07 10:18:56', '0000-00-00 00:00:00'),
(59, 7, '10474727_739055926129626_8372302982240567744_n', '', '', 'uploads/images/2017/03/10474727_739055926129626_8372302982240567744_n-1.jpg', 0, '2017-03-07 10:19:11', '0000-00-00 00:00:00'),
(60, 7, '17094097_1827745897477013_1942299462_n', '', '', 'uploads/images/2017/03/17094097_1827745897477013_1942299462_n.jpg', 0, '2017-03-07 10:19:11', '0000-00-00 00:00:00'),
(61, 7, '16832184_389197528117141_1044341205007191760_n', '', '', 'uploads/images/2017/03/16832184_389197528117141_1044341205007191760_n.jpg', 0, '2017-03-07 10:19:12', '0000-00-00 00:00:00'),
(62, 7, '11261661_895480870487130_8638260627910861365_n', '', '', 'uploads/images/2017/03/11261661_895480870487130_8638260627910861365_n-1.jpg', 0, '2017-03-07 10:19:12', '0000-00-00 00:00:00'),
(63, 7, '11261661_895480870487130_8638260627910861365_n', '', '', 'uploads/images/2017/03/11261661_895480870487130_8638260627910861365_n-2.jpg', 0, '2017-03-07 10:22:05', '0000-00-00 00:00:00'),
(64, 7, '16832184_389197528117141_1044341205007191760_n', '', '', 'uploads/images/2017/03/16832184_389197528117141_1044341205007191760_n-1.jpg', 0, '2017-03-07 10:22:05', '0000-00-00 00:00:00'),
(65, 7, '17094097_1827745897477013_1942299462_n', '', '', 'uploads/images/2017/03/17094097_1827745897477013_1942299462_n-1.jpg', 0, '2017-03-07 10:22:05', '0000-00-00 00:00:00'),
(66, 7, '10474727_739055926129626_8372302982240567744_n', '', '', 'uploads/images/2017/03/10474727_739055926129626_8372302982240567744_n-2.jpg', 0, '2017-03-07 10:22:06', '0000-00-00 00:00:00'),
(67, 7, 'IMG_3755.PNG', '', '', 'uploads/images/2017/03/IMG_3755.PNG.jpg', 0, '2017-03-07 10:38:06', '0000-00-00 00:00:00'),
(68, 7, 'IMG_3755.PNG', '', '', 'uploads/images/2017/03/IMG_3755.PNG-1.jpg', 0, '2017-03-07 10:38:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_order` int(11) NOT NULL,
  `new_tab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `name`, `value`, `table_name`, `type`, `menu_order`, `new_tab`) VALUES
(1, 0, 'Main', '', '', 'HEADERMENU', 0, 0),
(94, 0, 'Header menu', '', '', 'SIDEBARMENU', 0, 0),
(107, 0, 'SIDEBAR MENU', '', '', '', 0, 0),
(129, 107, 'Tin nổi bật', '1', 'category', '', 0, 0),
(130, 107, 'Trang chủ', 'http://localhost/nhadathd/backend/web/index.php?r=posts%2Fmenu%2Findex&id=107', 'linktinh', '', 0, 0),
(379, 0, 'Footer Menu', '', '', 'FOOTERMENU', 0, 0),
(380, 379, 'Giới thiệu', '#', 'linktinh', '', 0, 0),
(473, 1, 'Trang chủ', '/', 'linktinh', 'Main', 0, 0),
(474, 1, 'Bds Bán', '14', 'category', 'Main', 0, 0),
(475, 474, 'Tất cả các loại nhà bán', '17', 'category', 'Main', 1, 0),
(476, 474, 'Bán căn hộ chung cư', '16', 'category', 'Main', 2, 0),
(477, 474, 'Tin xem nhiều', '2', 'category', 'Main', 3, 0),
(478, 477, 'Tin xem nhiều', '2', 'category', 'Main', 1, 0),
(479, 477, 'Khu đô thị tuệ tinh', '4', 'category', 'Main', 2, 0),
(480, 1, 'Bds Cho thuê', '15', 'category', 'Main', 0, 0),
(481, 1, 'Không gian sống', '21', 'category', 'Main', 0, 0),
(482, 481, 'Nội thất', '22', 'category', 'Main', 1, 0),
(483, 481, 'Tin thị trường', '6', 'category', 'Main', 2, 0),
(484, 481, 'Nhà đẹp', '23', 'category', 'Main', 3, 0),
(485, 481, 'Tin dự án', '8', 'category', 'Main', 4, 0),
(486, 94, 'Tin nổi bật', '1', 'category', 'Header menu', 0, 0),
(487, 94, 'Tin xem nhiều', '2', 'category', 'Header menu', 0, 0),
(488, 94, 'Liên kết nổi bật', '3', 'category', 'Header menu', 0, 0),
(489, 94, 'Khu đô thị tuệ tinh', '4', 'category', 'Header menu', 0, 0),
(490, 94, 'Tin Tức', '5', 'category', 'Header menu', 0, 0),
(491, 94, 'Tin thị trường', '6', 'category', 'Header menu', 0, 0),
(492, 94, 'Chính sách - quy hoạch', '7', 'category', 'Header menu', 0, 0),
(493, 94, 'BDS Thế giới', '9', 'category', 'Header menu', 0, 0),
(494, 94, 'Thị trường vật liệu xây dựng', '10', 'category', 'Header menu', 0, 0),
(495, 94, 'Phong thủy', '13', 'category', 'Header menu', 0, 0),
(496, 94, 'Bds Bán', '14', 'category', 'Header menu', 0, 0),
(497, 94, 'Bds Cho thuê', '15', 'category', 'Header menu', 0, 0),
(498, 94, 'Bán căn hộ chung cư', '16', 'category', 'Header menu', 0, 0),
(499, 94, 'Tất cả các loại nhà bán', '17', 'category', 'Header menu', 0, 0),
(500, 94, 'Bán nhà riêng', '18', 'category', 'Header menu', 0, 0),
(501, 94, 'Bán biệt thự liền kề', '19', 'category', 'Header menu', 0, 0),
(502, 94, 'Cho thuê căn hộ chung cư', '20', 'category', 'Header menu', 0, 0),
(503, 94, 'Tin dự án', '8', 'category', 'Header menu', 0, 0),
(504, 94, 'Tin dự án', '8', 'category', 'Header menu', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1468548537),
('m140506_102106_rbac_init', 1468548541);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `title`, `description`, `status`, `views`, `create_at`, `update_at`, `slug`, `type`) VALUES
(1, 7, 'Khó khăn chuyển nhượng một phần dự án', '<p><img src="http://nhadathd.vl/uploads/images/2017/03/11261661_895480870487130_8638260627910861365_n.jpg" /></p>\r\n', '2', 11, '2016-07-17 04:05:18', '0000-00-00 00:00:00', 'kho-khan', 'post'),
(3, 7, 'Savills: Thị trường bán lẻ Hà Nội hoạt động ế ẩm', '<p>Savills: Thị trường b&aacute;n lẻ H&agrave; Nội hoạt động ế ẩm</p>\r\n', '5', 0, '2016-07-17 08:38:29', '0000-00-00 00:00:00', 'savills-thi-truong-ban-le-ha-noi-hoat-dong-e-am', 'post'),
(4, 7, 'Hà Nội: Sẽ có thêm 22.000 căn hộ mới', '<p><span style="color:rgb(34, 34, 34); font-family:menlo,monospace; font-size:11px">H&agrave; Nội: Sẽ c&oacute; th&ecirc;m 22.000 căn hộ mới</span></p>\r\n', '5', 0, '2016-07-17 09:30:35', '0000-00-00 00:00:00', 'ha-noi-se-co-them-22000-can-ho-moi-1', 'post'),
(5, 7, 'Thị trường bất động sản Việt Nam bị xếp hạng minh bạch thấp', '<h2 style="text-align:justify">Theo Jones Lang LaSalle (JLL), chỉ số minh bạch th&ocirc;ng tin (RETI) của thị trường bất động sản Việt Nam năm 2016 xếp thứ 68 trong số 109 quốc gia được khảo s&aacute;t. Xếp hạng n&agrave;y đưa Việt Nam v&agrave;o nh&oacute;m c&oacute; độ minh bạch thấp, khiến việc định gi&aacute; gặp nhiều kh&oacute; khăn.</h2>\r\n\r\n<div class="nd-content" style="margin: 10px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; font-stretch: normal; line-height: 20px; font-family: arial; text-align: justify; color: rgb(0, 0, 0);">\r\n<p>Theo đơn vị n&agrave;y, sau hơn 20 năm h&igrave;nh th&agrave;nh v&agrave; ph&aacute;t triển, th&ocirc;ng tin tr&ecirc;n thị trường bất động sản Việt Nam vẫn bị xếp hạng thấp. Việc kh&oacute; tiếp cận c&aacute;c th&ocirc;ng tin về quy hoạch v&agrave; thiếu cơ sở dữ liệu về thị trường l&agrave; một r&agrave;o cản lớn cho việc x&aacute;c định gi&aacute; trị của bất động sản.</p>\r\n\r\n<p>Nh&agrave; đầu tư kh&ocirc;ng phải l&uacute;c n&agrave;o cũng c&oacute; đầy đủ th&ocirc;ng tin v&agrave; am hiểu t&iacute;nh năng, cấu tr&uacute;c của bất động sản. Điều n&agrave;y dẫn đến c&aacute;c quyết định được đưa ra trong t&igrave;nh trạng thiếu th&ocirc;ng tin, kh&ocirc;ng phản &aacute;nh đ&uacute;ng gi&aacute; trị thực của bất động sản. Hầu hết cơ sở dữ liệu được c&aacute;c c&ocirc;ng ty tự x&acirc;y dựng v&agrave; ph&acirc;n t&iacute;ch để sử dụng nội bộ, ch&iacute;nh v&igrave; thế m&agrave; c&aacute;c nguồn dữ liệu n&agrave;y thiếu t&iacute;nh tổng hợp v&agrave; thống nhất. Trong khi đ&oacute; việc định gi&aacute; bất động sản cần phải c&oacute; nguồn th&ocirc;ng tin đ&aacute;ng tin cậy v&agrave; đầy đủ, đồng thời về mặt ph&aacute;p l&yacute; của dự &aacute;n phải minh bạch v&agrave; r&otilde; r&agrave;ng.</p>\r\n\r\n<p>Việc định gi&aacute; bất động sản thương mại như cao ốc văn ph&ograve;ng, kh&aacute;ch sạn hoặc khu b&aacute;n lẻ thường gặp kh&oacute; khăn trong việc x&aacute;c định tỷ suất vốn h&oacute;a v&agrave; tỷ suất chiết khấu. Nửa đầu năm 2016, đơn vị n&agrave;y ghi nhận kh&aacute; nhiều giao dịch bất động sản c&oacute; gi&aacute; trị giao dịch lớn v&agrave; đang hoạt động kinh doanh tốt tại thị trường Việt Nam. Việc ph&acirc;n t&iacute;ch những giao dịch n&agrave;y sẽ mang lại những th&ocirc;ng tin quan trọng để c&oacute; thể x&aacute;c định gi&aacute; trị thị trường một c&aacute;ch ch&iacute;nh x&aacute;c nhất.</p>\r\n</div>\r\n', '5', 0, '2016-07-24 03:38:40', '0000-00-00 00:00:00', 'thi-truong-bat-dong-san-viet-nam-bi-xep-hang-minh-bach-thap', 'post'),
(6, 7, 'Phân khúc nhà ở 1 tỷ đồng có khả năng bùng nổ', '<h2 style="text-align:justify">D&ograve;ng vốn t&iacute;n dụng ưu đ&atilde;i hỗ trợ cho người vay vốn mua nh&agrave; ở thu nhập thấp đang c&oacute; xu hướng trở lại sau một loạt động th&aacute;i mới từ ch&iacute;nh s&aacute;ch.</h2>\r\n\r\n<div class="nd-content" style="margin: 10px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; font-stretch: normal; line-height: 20px; font-family: arial; text-align: justify; color: rgb(0, 0, 0);">\r\n<p>Để mua căn hộ dưới 1 tỷ đồng, người d&acirc;n được hỗ trợ vay vốn ưu đ&atilde;i với l&atilde;i suất 5%/năm, thời hạn vay 15 năm, mức vay tối đa 80% gi&aacute; trị căn hộ từ g&oacute;i 30 ngh&igrave;n tỷ. V&igrave; thế, kh&aacute;ch h&agrave;ng chỉ cần c&oacute; v&agrave;i trăm triệu đồng l&agrave; c&oacute; thể mua một căn hộ. Dự &aacute;n ra mắt thị trường lu&ocirc;n &ldquo;ch&aacute;y h&agrave;ng&rdquo;.</p>\r\n\r\n<p>Theo ghi nhận từ một số c&ocirc;ng ty nghi&ecirc;n cứu thị trường, qu&yacute; 2/2016, ph&acirc;n kh&uacute;c n&agrave;y c&oacute; sự sụt giảm đ&aacute;ng kể, thay v&agrave;o đ&oacute; l&agrave; ph&acirc;n kh&uacute;c trung v&agrave; cao cấp chiếm lĩnh thị trường. Nguy&ecirc;n nh&acirc;n được cho l&agrave; &ldquo;tắc&rdquo; nguồn vốn t&iacute;n dụng v&igrave; thay đổi ch&iacute;nh s&aacute;ch g&oacute;i t&iacute;n dụng 30 ngh&igrave;n tỷ. Trong khi đ&oacute;, nhu cầu nh&agrave; ở dưới 1 tỷ đồng tại c&aacute;c đ&ocirc; thị lớn như H&agrave; Nội lại rất cao.</p>\r\n\r\n<p>Theo nguy&ecirc;n Thứ trưởng Bộ X&acirc;y dựng Nguyễn Trần Nam, ở Việt Nam số người c&oacute; thu nhập tốt, ở nh&agrave; cao của rộng chỉ chiếm 20%, 80% l&agrave; những người c&oacute; thu nhập vừa v&agrave; thấp. Tuy nhi&ecirc;n, hiện nay thị trường đang mất c&acirc;n đối cung cầu, thiếu căn hộ gi&aacute; rẻ v&agrave; trung b&igrave;nh, thừa căn hộ cao cấp.</p>\r\n\r\n<p>Trong khi, nguồn cung ở ph&acirc;n kh&uacute;c n&agrave;y trước đ&acirc;y ra đến đ&acirc;u b&aacute;n hết đến đ&oacute;. Cung căn hộ dưới 1 tỷ đồng lu&ocirc;n ở t&igrave;nh trạng khan hiếm, n&oacute;i như &ocirc;ng Nguyễn Trần Nam, do c&oacute; nhiều DN địa ốc lựa chọn ph&acirc;n kh&uacute;c cao cấp v&igrave; c&oacute; lợi nhuận cao hơn, nh&agrave; b&igrave;nh d&acirc;n lại &iacute;t chủ đầu tư lựa chọn.</p>\r\n\r\n<p>Thực tế, hiện nay thị trường H&agrave; Nội cũng kh&ocirc;ng c&oacute; nhiều dự &aacute;n nh&agrave; ở b&igrave;nh d&acirc;n được ph&aacute;t triển một c&aacute;ch b&agrave;i bản, c&oacute; chất lượng sống tốt. Kh&aacute; nhiều khu nh&agrave; ở gi&aacute; thấp mới đi v&agrave;o hoạt động nhưng đ&atilde; xảy ra t&igrave;nh trạng ch&aacute;y nổ, mất điện, mất nước, xuống cấp&hellip;như khu nh&agrave; ở Xa La, Kim Văn Kim Lũ, Linh Đ&agrave;m, Đại Thanh.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, một số chủ đầu tư lại đặc biệt ch&uacute; trọng đến chất lượng, m&ocirc;i trường sống ở những khu đ&ocirc; thị nh&agrave; gi&aacute; thấp. Đơn cử như khu T&acirc;n T&acirc;y Đ&ocirc; (Đan Phượng), KĐT</p>\r\n</div>\r\n', '5', 0, '2016-07-25 02:15:01', '0000-00-00 00:00:00', 'phan-khuc-nha-o-1-ty-dong-co-kha-nang-bung-no', 'post'),
(7, 7, 'Mua bán nhà ở xã hội bất hợp pháp vẫn ngang nhiên hoạt động', '<p><span style="color:rgb(0, 0, 0); font-family:arial; font-size:14px">Để an cư lạc nghiệp tại th&agrave;nh phố lớn l&agrave; điều ao ước của những c&aacute;n bộ, vi&ecirc;n chức l&acirc;u năm, của nhiều thanh ni&ecirc;n ngoại tỉnh mới ra trường đi l&agrave;m. Thấu hiểu nhu cầu n&agrave;y, Ch&iacute;nh phủ đ&atilde; ban h&agrave;nh Nghị định, c&aacute;c chương tr&igrave;nh ph&aacute;t triển&nbsp;nh&agrave; ở x&atilde; hội&nbsp;nhằm gi&uacute;p người thu nhập thấp c&oacute; thể sở hữu một căn nh&agrave;. Một ch&iacute;nh s&aacute;ch mang lại kỳ vọng hiện thực h&oacute;a ng&ocirc;i nh&agrave; mơ ước cho rất nhiều người d&acirc;n.&nbsp;Tuy vậy, qu&aacute; tr&igrave;nh ph&acirc;n bố nh&agrave; ở x&atilde; hội lại c&oacute; những điều bất thường.</span></p>\r\n', '5', 0, '2016-07-25 02:16:38', '0000-00-00 00:00:00', 'mua-ban-nha-o-xa-hoi-bat-hop-phap-van-ngang-nhien-hoat-dong', 'post'),
(8, 7, 'Bất động sản nông nghiệp có thể bứt phá cuối năm 2016', '<h2 style="text-align:justify">Nh&agrave; đất nội th&agrave;nh, đất l&agrave;m n&ocirc;ng nghiệp v&agrave; bất động sản quanh c&aacute;c khu c&ocirc;ng nghiệp được dự b&aacute;o sẽ l&agrave; những k&ecirc;nh đầu tư s&ocirc;i động, c&oacute; tốc độ tăng tốc nhanh trong những th&aacute;ng cuối năm 2016.</h2>\r\n', '5', 0, '2016-07-25 02:19:33', '0000-00-00 00:00:00', 'bat-dong-san-nong-nghiep-co-the-but-pha-cuoi-nam-2016', 'post'),
(9, 7, 'Thị trường địa ốc Tp.HCM xuất hiện dấu hiệu bất ổn', '<h2 style="text-align:justify">Theo Hiệp hội BĐS Tp.HCM (HoREA) số lượng giao dịch bất động sản chững lại v&agrave; c&oacute; dấu hiệu lệch pha sang ph&acirc;n kh&uacute;c bất động sản cao cấp trong khi thiếu sản phẩm căn hộ b&igrave;nh d&acirc;n quy m&ocirc; vừa v&agrave; nhỏ, c&oacute; 1-2 ph&ograve;ng ngủ, c&oacute; gi&aacute; b&aacute;n vừa t&uacute;i tiền</h2>\r\n', '5', 0, '2016-07-25 02:21:37', '0000-00-00 00:00:00', 'thi-truong-dia-oc-tphcm-xuat-hien-dau-hieu-bat-on', 'post'),
(10, 7, 'Nhộn nhịp đổi chủ các dự án bất động sản', '<h2 style="text-align:justify">Thị trường BĐS đang chứng kiến một cuộc đổi chủ mạnh mẽ ở c&aacute;c dự &aacute;n BĐS, khiến lĩnh vực n&agrave;y trở th&agrave;nh &ldquo;miếng b&aacute;nh&rdquo; của những &ldquo;tay chơi&rdquo; mới nổi.</h2>\r\n', '5', 0, '2016-07-25 02:23:01', '0000-00-00 00:00:00', 'nhon-nhip-doi-chu-cac-du-an-bat-dong-san', 'post'),
(11, 7, 'Đầu tư BĐS nghỉ dưỡng liệu có phải “gà đẻ trứng vàng”?', '<h2 style="text-align:justify">Cam kết lợi nhuận chia theo tỷ lệ 80%:20%, biệt thự nghỉ dưỡng, kh&aacute;ch sạn mini gần đ&acirc;y được c&aacute;c chủ đầu tư quảng b&aacute; rầm rộ. Nhưng liệu n&oacute; c&oacute; phải l&agrave; &ldquo;g&agrave; đẻ trứng v&agrave;ng&rdquo; hay l&agrave; bất động sản &ldquo;h&aacute;i ra tiền&rdquo; như quảng c&aacute;o?</h2>\r\n', '5', 0, '2016-07-25 02:24:52', '0000-00-00 00:00:00', 'dau-tu-bds-nghi-duong-lieu-co-phai-“ga-de-trung-vang”', 'post'),
(21, 7, 'Thời điểm “lên ngôi” của bất động sản nghỉ dưỡng', '<h2 style="text-align:justify">C&aacute;c chuy&ecirc;n gia đầu ng&agrave;nh về kinh tế v&agrave; bất động sản (BĐS) đều cho rằng, hiện đang l&agrave; thời điểm thuận lợi cho việc đầu tư bất động sản ở ph&acirc;n kh&uacute;c n&agrave;y.</h2>\r\n', '5', 0, '2016-07-25 08:45:24', '0000-00-00 00:00:00', 'thoi-diem-“len-ngoi”-cua-bat-dong-san-nghi-duong-7', 'post'),
(22, 7, 'Tp.HCM: Dự án căn hộ ồ ạt đổ bộ trên đại lộ Phạm Văn Đồng', '<h2 style="text-align:justify">H&agrave;ng chục dự &aacute;n nh&agrave; ở, trong đ&oacute; &iacute;t nhất hơn 10 c&ocirc;ng tr&igrave;nh nh&agrave; cao tầng đang đua nhau mọc l&ecirc;n quanh trục đường nội đ&ocirc; đẹp nhất Tp.HCM được đầu tư x&acirc;y dựng 340 triệu USD - Phạm Văn Đồng.</h2>\r\n', '5', 0, '2016-07-25 08:47:33', '0000-00-00 00:00:00', 'tphcm-du-an-can-ho-o-at-do-bo-tren-dai-lo-pham-van-dong', 'post'),
(23, 7, 'Đà Nẵng: Thị trường bất động sản, xây dựng phát triển nhanh', '<h2 style="text-align:justify">Từ đầu năm 2015, thị trường bất động sản (BĐS) Đ&agrave; Nẵng đ&atilde; c&oacute; nhiều chuyển biến t&iacute;ch cực. Điều n&agrave;y dẫn đến hoạt động x&acirc;y dựng ở đ&acirc;y cũng n&oacute;ng theo. Những c&ocirc;ng tr&igrave;nh nh&agrave; cao tầng từ năm 2015 đến nay mọc l&ecirc;n nhiều hơn, nhất l&agrave; dọc c&aacute;c tuyến đường ven biển v&agrave; khu vực gần biển.</h2>\r\n', '5', 0, '2016-07-25 08:48:48', '0000-00-00 00:00:00', 'da-nang-thi-truong-bat-dong-san-xay-dung-phat-trien-nhanh-1', 'post'),
(24, 7, 'Thị trường bất động sản phục hồi nhẹ trong nửa đầu năm', '<h2 style="text-align:justify">Theo B&aacute;o c&aacute;o kinh tế vĩ m&ocirc; Qu&yacute; 2/2016 của Viện Nghi&ecirc;n cứu kinh tế v&agrave; ch&iacute;nh s&aacute;ch (VEPR), 6 th&aacute;ng đầu năm, thị trường bất động sản (BĐS) phục hồi nhẹ.</h2>\r\n', '5', 0, '2016-07-25 08:52:41', '0000-00-00 00:00:00', 'thi-truong-bat-dong-san-phuc-hoi-nhe-trong-nua-dau-nam-1', 'post'),
(25, 7, '6 tháng đầu năm, kinh doanh bất động sản thu hút gần 100.000 tỷ đồng', '<h2 style="text-align:justify">Trong 6 th&aacute;ng đầu năm, với 1.354 doanh nghiệp th&agrave;nh lập mới, số vốn đạt 107.909 tỷ đồng, bất động sản đang l&agrave; ng&agrave;nh c&oacute; sức thu h&uacute;t vốn lớn nhất hiện nay.</h2>\r\n', '5', 0, '2016-07-25 09:16:01', '0000-00-00 00:00:00', '6-thang-dau-nam-kinh-doanh-bat-dong-san-thu-hut-gan-100000-ty-dong', 'post'),
(26, 7, 'Trang chủ', '<p>Trang chủ</p>\r\n', '1', 0, '2016-07-26 02:28:51', '0000-00-00 00:00:00', 'trang-chu-1', 'page'),
(27, 7, 'Nhà ở xã hội: có nên để chủ đầu tư toàn quyền xét duyệt', '<h2 style="text-align:justify">Nhiều &yacute; kiến cho rằng, việc giao cho chủ đầu tư to&agrave;n quyền x&eacute;t duyệt đang l&agrave; kẽ hở lớn cho việc lợi dụng ch&iacute;nh s&aacute;ch nh&agrave; ở x&atilde; hội (NƠXH) k&eacute;o theo việc để lọt những trường hợp người gi&agrave;u tranh phần người ngh&egrave;o</h2>\r\n', '5', 0, '2016-07-26 04:31:36', '0000-00-00 00:00:00', 'nha-o-xa-hoi-co-nen-de-chu-dau-tu-toan-quyen-xet-duyet', 'post'),
(28, 7, '1', '<p>1</p>\r\n', '5', 0, '2016-09-17 18:25:54', '0000-00-00 00:00:00', '1', 'post'),
(29, 7, '1', '<p>1</p>\r\n', '5', 0, '2016-09-17 18:26:50', '0000-00-00 00:00:00', '1', 'post'),
(30, 7, 'Ngắm ngôi nhà ống có thiết kế độc đáo của cặp vợ chồng kiến trúc sư', '<h2 style="text-align:justify">Ng&ocirc;i nh&agrave; ống n&agrave;y nằm tại th&agrave;nh phố Rotterdam (H&agrave; Lan), c&oacute; diện t&iacute;ch 68m2 v&agrave; thu h&uacute;t mọi &aacute;nh nh&igrave;n của người qua đường bởi thiết kế v&ocirc; c&ugrave;ng độc đ&aacute;o, ho&agrave;n to&agrave;n kh&aacute;c biệt so với những ng&ocirc;i nh&agrave; b&ecirc;n cạnh.</h2>\r\n\r\n<div class="nd-content" style="margin: 10px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; font-stretch: normal; line-height: 20px; font-family: arial; text-align: justify; color: rgb(0, 0, 0);">\r\n<p>Chủ sở hữu v&agrave; cũng l&agrave; t&aacute;c giả thiết kế của ng&ocirc;i&nbsp;nh&agrave; ống n&agrave;y l&agrave; cặp vợ chồng kiến tr&uacute;c sư trẻ người H&agrave; Lan Gwendolyn Huisman v&agrave; Marijn Boterman. Họ&nbsp;đ&atilde; thiết kế kh&ocirc;ng gian sống của m&igrave;nh với&nbsp;3 tầng nh&agrave; c&oacute;&nbsp;hệ thống th&ocirc;ng gi&oacute; v&agrave; lấy &aacute;nh s&aacute;ng v&ocirc; c&ugrave;ng th&ocirc;ng minh.</p>\r\n\r\n<p>Giống như c&aacute;c ng&ocirc;i nh&agrave; ống kh&aacute;c, ng&ocirc;i nh&agrave; n&agrave;y c&oacute; nhược điểm hẹp v&agrave;&nbsp;s&acirc;u (k&iacute;ch thước 3,5mx20m), xung quanh l&agrave; những ng&ocirc;i nh&agrave; cao tầng san s&aacute;t nhau. Đ&acirc;y l&agrave; một th&aacute;ch thức&nbsp;cho cặp vợ chồng trẻ trong việc đưa&nbsp;&aacute;nh s&aacute;ng v&agrave; gi&oacute; trời v&agrave;o nh&agrave;.</p>\r\n\r\n<p>Bằng việc d&ugrave;ng những vi&ecirc;n gạch đan xen nhau để&nbsp;tạo th&agrave;nh c&aacute;c&nbsp;lỗ th&ocirc;ng gi&oacute; tự nhi&ecirc;n nơi mặt tiền, kết hợp với 2 cửa sổ k&iacute;nh lớn, ng&ocirc;i nh&agrave; vẫn&nbsp;bảo đảm vấn đề th&ocirc;ng gi&oacute; vừa mang &aacute;nh s&aacute;ng tự nhi&ecirc;n tr&agrave;n ngập c&aacute;c kh&ocirc;ng gian.</p>\r\n\r\n<p>Kh&ocirc;ng gian b&ecirc;n trong nh&agrave; ống được thiết kế kh&aacute;&nbsp;đơn giản, nhẹ nh&agrave;ng nhưng v&ocirc; c&ugrave;ng tiện nghi cho người sử dụng. Mọi khu vực chức năng cũng được bố tr&iacute; ri&ecirc;ng biệt. Điểm ấn tượng nhất của ng&ocirc;i nh&agrave; ch&iacute;nh l&agrave;&nbsp;chiếc v&otilde;ng lưới cạnh cửa sổ. Đ&acirc;y l&agrave; kh&ocirc;ng gian thư gi&atilde;n, ngắm cảnh của hai vợ chồng sau một ng&agrave;y l&agrave;m việc căng thẳng.</p>\r\n\r\n<p>C&ugrave;ng ngắm to&agrave;n bộ kh&ocirc;ng gian sống tuyệt đẹp của cặp đ&ocirc;i n&agrave;y.</p>\r\n\r\n<p style="text-align:center"><img alt="Ngôi nhà ống nổi bật" src="http://img.dothi.net/2017/03/03/0Ln61R5F/48-f9ea.jpg" style="border:0px; height:281px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Ngôi nhà ống mang nổi bật với những ô cửa kính nằm giữa khu phố yên tĩnh." /><br />\r\n<em>Ng&ocirc;i nh&agrave; ống nổi bật với những &ocirc; cửa k&iacute;nh nằm&nbsp;giữa khu phố y&ecirc;n tĩnh.</em></p>\r\n\r\n<p style="text-align:center"><img alt="Toàn bộ mặt tiền của ngôi nhà ống" src="http://img.dothi.net/2017/03/03/0Ln61R5F/10-3b91.jpg" style="border:0px; height:861px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Toàn bộ mặt tiền của ngôi nhà ống được ốp gạch đen và xếp so le để tạo thành những ô cửa lớn. Những ô trống này có vai trò quan trọng trong việc đảm bảo chức năng thông gió và ánh sáng cho ngôi nhà" /><br />\r\n<em>To&agrave;n bộ mặt tiền của ng&ocirc;i nh&agrave; ống được ốp gạch đen v&agrave; xếp so le để&nbsp;tạo<br />\r\nth&agrave;nh những &ocirc; cửa lớn. Những &ocirc; trống n&agrave;y&nbsp;c&oacute; vai tr&ograve; quan trọng trong<br />\r\nviệc&nbsp;đảm bảo chức năng th&ocirc;ng gi&oacute; v&agrave; &aacute;nh s&aacute;ng cho ng&ocirc;i nh&agrave;.</em></p>\r\n\r\n<p style="text-align:center"><img alt="nhà ống của kiến trúc sư" src="http://img.dothi.net/2017/03/03/0Ln61R5F/66-ceeb.jpg" style="border:0px; height:750px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Hai cửa sổ kính cao sát trần được thiết kế đua về phía trước giúp tận dụng ánh sáng tự nhiên, giúp chủ nhân thư giãn, ngắm cảnh bên ngoài" /><br />\r\n<em>Hai cửa sổ k&iacute;nh cao s&aacute;t trần được thiết kế&nbsp;đua về ph&iacute;a trước gi&uacute;p tận dụng<br />\r\n&aacute;nh s&aacute;ng tự nhi&ecirc;n, gi&uacute;p chủ nh&acirc;n thư gi&atilde;n, ngắm cảnh b&ecirc;n ngo&agrave;i.</em></p>\r\n\r\n<p style="text-align:center"><img alt="Mặt sau của nhà ống giáp " src="http://img.dothi.net/2017/03/03/0Ln61R5F/70-12f6.jpg" style="border:0px; height:333px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Mặt sau của nhà ống giáp với vườn cũng được thiết kế với những  ​ô cửa kính tương tự" /><br />\r\n<em>Mặt sau của nh&agrave; ống&nbsp;gi&aacute;p với vườn cũng được thiết kế với những<br />\r\n&ocirc; cửa k&iacute;nh tương tự.</em></p>\r\n\r\n<p style="text-align:center"><img alt="Bên trong ngôi nhà ống được " src="http://img.dothi.net/2017/03/03/0Ln61R5F/56-4989.jpg" style="border:0px; height:333px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Bên trong ngôi nhà ống được thiết kế khá đơn giản với trần xi măng. Tầng 1 gồm phòng khách rộng, bếp, khu vệ sinh" /><br />\r\n<em>B&ecirc;n trong ng&ocirc;i nh&agrave; ống được thiết kế kh&aacute; đơn giản với trần xi măng. Tầng 1<br />\r\ngồm ph&ograve;ng kh&aacute;ch rộng, bếp, khu vệ sinh.</em></p>\r\n\r\n<p style="text-align:center"><img alt="Góc bếp nhỏ trong ngôi nhà ống" src="http://img.dothi.net/2017/03/03/0Ln61R5F/32-a21a.jpg" style="border:0px; height:732px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Góc bếp nhỏ trong ngôi nhà ống được tô điểm bởi những chiếc ghế nhiều màu sắc đơn giản" /><br />\r\n<em>G&oacute;c bếp nhỏ trong ng&ocirc;i nh&agrave; ống&nbsp;được t&ocirc; điểm bởi những chiếc<br />\r\nghế nhiều m&agrave;u sắc đơn giản</em></p>\r\n\r\n<p style="text-align:center"><img alt="Ngôi nhà không hề màu mè" src="http://img.dothi.net/2017/03/03/0Ln61R5F/53-cb2b.jpg" style="border:0px; height:342px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Ngôi nhà không hề màu mè trong thiết kế, thậm chí còn vô cùng tối giản  nhưng mọi góc của ngôi nhà đều khiến người nhìn cảm thấy được sự  ​thân thiện, yên bình" /><br />\r\n<em>Ng&ocirc;i nh&agrave; kh&ocirc;ng hề m&agrave;u m&egrave; trong thiết kế, thậm ch&iacute; c&ograve;n&nbsp;v&ocirc; c&ugrave;ng tối giản<br />\r\nnhưng mọi g&oacute;c của&nbsp;ng&ocirc;i nh&agrave; đều khiến người nh&igrave;n cảm thấy được sự<br />\r\nth&acirc;n thiện, y&ecirc;n b&igrave;nh.</em></p>\r\n\r\n<p style="text-align:center"><img alt="Không gian tầng 2 của nhà ống" src="http://img.dothi.net/2017/03/03/0Ln61R5F/42-df2c.jpg" style="border:0px; height:750px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Không gian tầng 2 của nhà ống là nơi làm việc, góc đọc sách và thư giãn cho chủ nhà" /><br />\r\n<em>Kh&ocirc;ng gian tầng 2 của nh&agrave; ống&nbsp;l&agrave; nơi l&agrave;m việc, g&oacute;c đọc s&aacute;ch v&agrave; thư gi&atilde;n<br />\r\ncho chủ nh&agrave;.</em></p>\r\n\r\n<p style="text-align:center"><img alt="trang trí cho ngôi nhà ống" src="http://img.dothi.net/2017/03/03/0Ln61R5F/01-d1ee.jpg" style="border:0px; height:364px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Chủ nhà đặt những cây xương rồng nhỏ xinh cạnh khu vực cầu thang để trang trí cho ngôi nhà ống" /><br />\r\n<em>Chủ nh&agrave; đặt những c&acirc;y xương rồng nhỏ xinh&nbsp;cạnh khu vực cầu thang để&nbsp;<br />\r\ntrang tr&iacute; cho ng&ocirc;i nh&agrave; ống</em></p>\r\n\r\n<p style="text-align:center"><img alt="trên tầng 2 của ngôi nhà " src="http://img.dothi.net/2017/03/03/0Ln61R5F/41-94c5.jpg" style="border:0px; height:333px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Chiếc võng lưới tuyệt đẹp được bố trí trên tầng 2 của ngôi nhà là nơi nghỉ ngơi, ngắm cảnh khu vườn phía sau" /><br />\r\n<em>Chiếc v&otilde;ng lưới tuyệt đẹp được bố tr&iacute; tr&ecirc;n tầng 2 của ng&ocirc;i nh&agrave; l&agrave; nơi&nbsp;nghỉ ngơi,<br />\r\nngắm cảnh khu vườn ph&iacute;a sau.</em></p>\r\n\r\n<p style="text-align:center"><img alt="tầng 3 của ngôi nhà ống" src="http://img.dothi.net/2017/03/03/0Ln61R5F/20170303081402866328-01d3.jpg" style="border:0px; height:804px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Phòng ngủ và phòng tắm thoáng sáng được chủ nhà đưa lên tầng 3 của ngôi nhà ống" /><br />\r\n<em>Ph&ograve;ng ngủ v&agrave; ph&ograve;ng tắm tho&aacute;ng s&aacute;ng được chủ nh&agrave; đưa l&ecirc;n tầng 3<br />\r\ncủa ng&ocirc;i nh&agrave; ống</em></p>\r\n\r\n<p style="text-align:center"><img alt="Phòng tắm của ngôi nhà" src="http://img.dothi.net/2017/03/03/0Ln61R5F/47-fc9f.jpg" style="border:0px; height:328px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Phòng tắm của ngôi nhà tràn ngập ánh sáng mặt trời nhờ hệ thống trần kính. Toàn bộ căn phòng được sơn màu xanh tạo cảm giác tươi mát" /><br />\r\n<em>Ph&ograve;ng tắm của ng&ocirc;i nh&agrave;&nbsp;tr&agrave;n ngập &aacute;nh s&aacute;ng mặt trời nhờ hệ thống trần<br />\r\nk&iacute;nh. To&agrave;n bộ căn ph&ograve;ng được sơn m&agrave;u xanh tạo cảm gi&aacute;c tươi m&aacute;t.&nbsp;</em></p>\r\n</div>\r\n\r\n<div class="nd-source" style="margin: 20px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 18px; text-align: right; color: rgb(49, 49, 49); font-family: Arial;"><em><em>(Theo Tri thức trẻ)</em>&nbsp;</em></div>\r\n', '5', 0, '2017-03-03 07:56:18', '0000-00-00 00:00:00', 'ngam-ngoi-nha-ong-co-thiet-ke-doc-dao-cua-cap-vo-chong-kien-truc-su', 'post'),
(31, 7, 'Ngắm lâu đài đẹp mê hồn được cải tạo từ nhà máy bỏ hoang', '<h2 style="text-align:justify">V&agrave;o năm 1973, kiến tr&uacute;c sư Ricardo Bofill đ&atilde; mua lại một nh&agrave; m&aacute;y xi măng bỏ hoang ở Barcelona, T&acirc;y Ban Nha v&agrave; sau đ&oacute; đ&atilde; biến n&oacute; trở th&agrave;nh một l&acirc;u đ&agrave;i nguy nga, tr&aacute;ng lệ.</h2>\r\n\r\n<div class="nd-content" style="margin: 10px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; font-stretch: normal; line-height: 20px; font-family: arial; text-align: justify; color: rgb(0, 0, 0);">\r\n<p style="text-align:center"><img alt="một tòa lâu đài đẹp lung linh" src="http://img.dothi.net/2017/03/01/0Ln61R5F/48-723e.jpg" style="border:0px; height:289px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Từ một &quot;cỗ máy gây ô nhiễm&quot; trong thời kì Thế chiến II, nhà máy xi măng bỏ hoang này đã được kiến trúc sư Ricardo Bofill biến thành một tòa lâu đài đẹp lung linh" /><br />\r\n<em>Từ một &quot;cỗ m&aacute;y g&acirc;y &ocirc; nhiễm&quot; trong thời k&igrave; Thế chiến II, nh&agrave; m&aacute;y xi măng bỏ<br />\r\nhoang n&agrave;y&nbsp;đ&atilde; được kiến tr&uacute;c sư Ricardo Bofill biến th&agrave;nh một&nbsp;t&ograve;a l&acirc;u đ&agrave;i<br />\r\nđẹp lung linh.</em></p>\r\n\r\n<p style="text-align:center"><img alt="lâu đài lung linh" src="http://img.dothi.net/2017/03/01/0Ln61R5F/10-6350.jpg" style="border:0px; height:400px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Ngay sau khi mua lại nhà máy bỏ không, kiến trúc sư Bofill đã bắt tay ngay vào công việc cải tạo lại nó" /><br />\r\n<em>Ngay sau khi mua lại nh&agrave; m&aacute;y&nbsp;bỏ kh&ocirc;ng, kiến tr&uacute;c sư Bofill đ&atilde; bắt tay<br />\r\nngay v&agrave;o c&ocirc;ng việc cải tạo lại n&oacute;</em></p>\r\n\r\n<p style="text-align:center"><img alt="Tòa lâu đài được đặt tên là La fábrica" src="http://img.dothi.net/2017/03/01/0Ln61R5F/66-96a6.jpg" style="border:0px; height:583px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:600px" title="Tòa lâu đài được đặt tên là La fábrica" /><br />\r\n<em>T&ograve;a l&acirc;u đ&agrave;i được đặt t&ecirc;n l&agrave;&nbsp;La f&aacute;brica</em></p>\r\n\r\n<p style="text-align:center"><img alt="gần gũi với thiên nhiên cho tòa lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/70-aeea.jpg" style="border:0px; height:637px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Cây cối mọc dại xung quanh nhà máy đã tạo ra nét cổ kính, gần gũi với thiên nhiên cho tòa lâu đài" /><br />\r\n<em>C&acirc;y cối mọc dại xung quanh nh&agrave; m&aacute;y đ&atilde; tạo ra&nbsp;n&eacute;t cổ k&iacute;nh, gần gũi<br />\r\nvới thi&ecirc;n nhi&ecirc;n cho t&ograve;a l&acirc;u đ&agrave;i</em></p>\r\n\r\n<p style="text-align:center"><img alt="Nội thất bên trong lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/56-6761.jpg" style="border:0px; height:492px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Nội thất bên trong lâu đài rất sang trọng và hiện đại" /><br />\r\n<em>Nội thất b&ecirc;n trong l&acirc;u đ&agrave;i rất sang trọng v&agrave; hiện đại</em></p>\r\n\r\n<p style="text-align:center"><img src="http://img.dothi.net/2017/03/01/0Ln61R5F/32-31de.jpg" style="border:0px; height:341px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" /><br />\r\n<em>Kiến tr&uacute;c sư đ&atilde;&nbsp;tận dụng mọi kh&ocirc;ng gian&nbsp;để trồng c&acirc;y, từ khu&ocirc;n vi&ecirc;n<br />\r\nxung quanh cho tới cả n&oacute;c của l&acirc;u đ&agrave;i.</em></p>\r\n\r\n<p style="text-align:center"><img alt="sang trọng bên trong lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/53-175f.jpg" style="border:0px; height:497px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Phòng ngủ đơn giản nhưng sang trọng bên trong lâu đài" /><br />\r\n<em>Ph&ograve;ng ngủ đơn giản nhưng sang trọng b&ecirc;n trong l&acirc;u đ&agrave;i</em></p>\r\n\r\n<p style="text-align:center"><img alt="nguyên bản ban đầu của lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/42-67c8.jpg" style="border:0px; height:335px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Phòng đọc sách với tông trắng hòa quyện ăn ý với màu vàng xám đặc trưng của nhà máy xi măng - nguyên bản ban đầu của lâu đài" /><br />\r\n<em>Ph&ograve;ng đọc s&aacute;ch với t&ocirc;ng trắng h&ograve;a quyện ăn &yacute; với m&agrave;u v&agrave;ng x&aacute;m đặc trưng<br />\r\ncủa nh&agrave; m&aacute;y xi măng - nguy&ecirc;n bản ban đầu của l&acirc;u đ&agrave;i</em></p>\r\n\r\n<p style="text-align:center"><img alt="lâu đài lung linh" src="http://img.dothi.net/2017/03/01/0Ln61R5F/01-7ba3.jpg" style="border:0px; height:337px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Những đường ống của nhà máy xi măng trước đây được kiến trúc sư giữ lại nguyên vẹn" /><br />\r\n<em>Những đường ống của nh&agrave; m&aacute;y xi măng trước đ&acirc;y&nbsp;được kiến tr&uacute;c sư<br />\r\ngiữ lại nguy&ecirc;n vẹn</em></p>\r\n\r\n<p style="text-align:center"><img alt="Tòa lâu đài có rất nhiều " src="http://img.dothi.net/2017/03/01/0Ln61R5F/41-5e16.jpg" style="border:0px; height:701px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Tòa lâu đài có rất nhiều không gian riêng dành cho việc thư giãn" /><br />\r\n<em>T&ograve;a l&acirc;u đ&agrave;i c&oacute; rất nhiều kh&ocirc;ng gian ri&ecirc;ng d&agrave;nh cho việc thư gi&atilde;n</em></p>\r\n\r\n<p style="text-align:center"><img alt="bên trong lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/20170301111614314328-bbbe.jpg" style="border:0px; height:366px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Một góc phòng làm việc nho nhỏ bên trong lâu đài" /><br />\r\n<em>Một g&oacute;c ph&ograve;ng l&agrave;m việc nho nhỏ b&ecirc;n trong l&acirc;u đ&agrave;i</em></p>\r\n\r\n<p style="text-align:center"><img alt="Cây cỏ dại phủ xanh toàn lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/47-60ea.jpg" style="border:0px; height:748px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Cây cỏ dại phủ xanh toàn lâu đài" /><br />\r\n<em>C&acirc;y cỏ dại phủ xanh to&agrave;n l&acirc;u đ&agrave;i</em></p>\r\n\r\n<p style="text-align:center"><img alt="Toàn cảnh tòa lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/19-7f09.jpg" style="border:0px; height:402px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Toàn cảnh tòa lâu đài nhìn từ bên ngoài" /><br />\r\n<em>To&agrave;n cảnh t&ograve;a l&acirc;u đ&agrave;i nh&igrave;n từ b&ecirc;n ngo&agrave;i</em></p>\r\n\r\n<p style="text-align:center"><img alt="Lâu đài có rất nhiều cửa kính" src="http://img.dothi.net/2017/03/01/0Ln61R5F/88-4003.jpg" style="border:0px; height:666px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Lâu đài có rất nhiều cửa kính để không gian ngập tràn ánh sáng" /><br />\r\n<em>L&acirc;u đ&agrave;i c&oacute; rất nhiều cửa k&iacute;nh để kh&ocirc;ng gian ngập tr&agrave;n &aacute;nh s&aacute;ng</em></p>\r\n\r\n<p style="text-align:center"><img alt="Cây leo bao phủ tường bên ngoài lâu đài" src="http://img.dothi.net/2017/03/01/0Ln61R5F/81-3639.jpg" style="border:0px; height:819px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Cây leo bao phủ tường bên ngoài lâu đài tạo ra nét cổ kính cho không gian" /><br />\r\n<em>C&acirc;y leo bao phủ tường b&ecirc;n ngo&agrave;i l&acirc;u đ&agrave;i tạo ra n&eacute;t cổ k&iacute;nh cho kh&ocirc;ng gian</em></p>\r\n\r\n<p style="text-align:center"><img alt="Lâu đài tràn ngập màu xanh" src="http://img.dothi.net/2017/03/01/0Ln61R5F/54-545d.jpg" style="border:0px; height:773px; margin:0px; outline:0px; padding:0px; vertical-align:baseline; width:500px" title="Lâu đài tràn ngập màu xanh, rất gần gũi với thiên nhiên " /><br />\r\n<em>L&acirc;u đ&agrave;i tr&agrave;n ngập m&agrave;u xanh, rất&nbsp;gần gũi với thi&ecirc;n nhi&ecirc;n&nbsp;</em></p>\r\n</div>\r\n\r\n<div class="nd-source" style="margin: 20px 0px 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; line-height: 18px; text-align: right; color: rgb(49, 49, 49); font-family: Arial;"><em><em>(Theo Tiền phong Online)</em>&nbsp;</em></div>\r\n', '5', 0, '2017-03-03 08:04:53', '0000-00-00 00:00:00', 'ngam-lau-dai-dep-me-hon-duoc-cai-tao-tu-nha-may-bo-hoang', 'post'),
(32, 7, 'Khó khăn chuyển nhượng một phần dự án', '', '5', 0, '2017-03-17 02:56:48', '0000-00-00 00:00:00', '', 'post'),
(33, 7, 'Khó khăn chuyển nhượng một phần dự án', '', '5', 0, '2017-03-17 02:57:16', '0000-00-00 00:00:00', '', 'post'),
(34, 7, 'Khó khăn chuyển nhượng một phần dự án', '', '5', 0, '2017-03-17 02:59:28', '0000-00-00 00:00:00', '', 'post');

-- --------------------------------------------------------

--
-- Table structure for table `post_relationships`
--

DROP TABLE IF EXISTS `post_relationships`;
CREATE TABLE `post_relationships` (
  `post_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `post_table` varchar(22) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_relationships`
--

INSERT INTO `post_relationships` (`post_id`, `table_id`, `table_name`, `post_table`) VALUES
(1, 1, 'category', 'duan'),
(1, 1, 'category', 'posts'),
(1, 2, 'category', 'duan'),
(1, 3, 'category', 'duan'),
(1, 6, 'category', 'posts'),
(1, 6, 'tags', 'posts'),
(1, 7, 'tags', 'batdongsan'),
(1, 17, 'category', 'batdongsan'),
(1, 21, 'category', 'posts'),
(1, 23, 'images', 'duan'),
(1, 35, 'images', 'banner'),
(1, 54, 'images', 'batdongsan'),
(1, 57, 'slider', 'batdongsan'),
(1, 58, 'slider', 'batdongsan'),
(1, 63, 'slider', 'batdongsan'),
(2, 5, 'images', 'duan'),
(2, 36, 'images', 'banner'),
(2, 65, 'slider', 'batdongsan'),
(2, 67, 'slider', 'batdongsan'),
(2, 68, 'slider', 'batdongsan'),
(3, 1, 'category', 'posts'),
(3, 2, 'category', 'posts'),
(3, 2, 'images', 'duan'),
(3, 6, 'category', 'posts'),
(3, 8, 'tags', 'posts'),
(3, 21, 'category', 'posts'),
(3, 21, 'images', 'batdongsan'),
(3, 35, 'images', 'banner'),
(4, 1, 'category', 'posts'),
(4, 2, 'category', 'posts'),
(4, 3, 'images', 'duan'),
(4, 6, 'category', 'posts'),
(4, 7, 'tags', 'batdongsan'),
(4, 17, 'category', 'batdongsan'),
(4, 21, 'category', 'posts'),
(4, 37, 'images', 'banner'),
(5, 1, 'category', 'posts'),
(5, 6, 'category', 'posts'),
(5, 16, 'category', 'batdongsan'),
(5, 21, 'category', 'posts'),
(6, 6, 'category', 'posts'),
(6, 6, 'tags', 'posts'),
(6, 7, 'tags', 'batdongsan'),
(6, 8, 'category', 'posts'),
(6, 16, 'category', 'batdongsan'),
(6, 21, 'category', 'posts'),
(6, 56, 'images', 'posts'),
(7, 1, 'category', 'posts'),
(7, 6, 'category', 'posts'),
(7, 8, 'images', 'posts'),
(7, 25, 'images', 'batdongsan'),
(8, 1, 'category', 'posts'),
(8, 6, 'category', 'posts'),
(8, 27, 'images', 'batdongsan'),
(8, 57, 'images', 'posts'),
(9, 6, 'category', 'posts'),
(9, 8, 'category', 'posts'),
(9, 28, 'images', 'batdongsan'),
(10, 6, 'category', 'posts'),
(10, 7, 'tags', 'batdongsan'),
(10, 11, 'images', 'posts'),
(10, 16, 'category', 'batdongsan'),
(11, 6, 'category', 'posts'),
(11, 12, 'images', 'posts'),
(11, 16, 'category', 'batdongsan'),
(11, 66, 'images', 'batdongsan'),
(12, 7, 'tags', 'batdongsan'),
(12, 16, 'category', 'batdongsan'),
(13, 16, 'category', 'batdongsan'),
(13, 25, 'images', 'batdongsan'),
(14, 15, 'images', 'batdongsan'),
(14, 18, 'category', 'batdongsan'),
(15, 16, 'category', 'batdongsan'),
(15, 24, 'images', 'batdongsan'),
(16, 10, 'images', 'batdongsan'),
(16, 16, 'category', 'batdongsan'),
(17, 7, 'tags', 'batdongsan'),
(17, 18, 'category', 'batdongsan'),
(21, 6, 'category', 'posts'),
(21, 52, 'images', 'posts'),
(22, 6, 'category', 'posts'),
(22, 15, 'images', 'posts'),
(23, 21, 'category', 'posts'),
(23, 52, 'images', 'posts'),
(24, 6, 'category', 'posts'),
(24, 17, 'images', 'posts'),
(25, 6, 'category', 'posts'),
(25, 18, 'images', 'posts'),
(26, 6, 'category', 'posts'),
(27, 6, 'category', 'posts'),
(27, 19, 'images', 'posts'),
(29, 1, 'category', 'posts'),
(29, 56, 'images', 'posts'),
(30, 6, 'category', 'posts'),
(30, 22, 'category', 'posts'),
(30, 56, 'images', 'posts'),
(31, 6, 'category', 'posts'),
(31, 23, 'category', 'posts'),
(31, 49, 'images', 'posts'),
(33, 7, 'tags', 'posts'),
(34, 7, 'tags', 'posts');

-- --------------------------------------------------------

--
-- Table structure for table `slug`
--

DROP TABLE IF EXISTS `slug`;
CREATE TABLE `slug` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slug`
--

INSERT INTO `slug` (`id`, `table_id`, `table_name`, `value`, `status`, `orders`) VALUES
(20, 1, 'category', 'tin-noi-bat-moi-1', 0, 0),
(21, 2, 'category', 'tin-xem-nhieu', 0, 0),
(22, 3, 'category', 'lien-ket-noi-bat', 0, 0),
(23, 4, 'category', 'khu-do-thi-tue-tinh', 0, 0),
(24, 5, 'category', 'tin-tuc', 0, 0),
(25, 6, 'category', 'tin-thi-truong', 0, 0),
(26, 7, 'category', 'chinh-sach---quy-hoach', 0, 0),
(27, 8, 'category', 'tin-du-an', 0, 0),
(28, 9, 'category', 'bds-the-gioi', 0, 0),
(29, 10, 'category', 'thi-truong-vat-lieu-xay-dung', 0, 0),
(30, 13, 'category', 'phong-thuy', 0, 0),
(31, 14, 'category', 'bds-ban', 0, 0),
(32, 15, 'category', 'bds-cho-thue', 0, 0),
(33, 16, 'category', 'ban-can-ho-chung-cu', 0, 0),
(34, 17, 'category', 'tat-ca-cac-loai-nha-ban', 0, 0),
(35, 18, 'category', 'ban-nha-rieng', 0, 0),
(36, 19, 'category', 'ban-biet-thu-lien-ke', 0, 0),
(37, 20, 'category', 'cho-thue-can-ho-chung-cu', 0, 0),
(38, 21, 'category', 'khong-gian-song', 0, 0),
(39, 22, 'category', 'noi-that', 0, 0),
(40, 23, 'category', 'nha-dep', 0, 0),
(17880, 1, 'posts', '231313', 0, 0),
(17881, 3, 'posts', 'savills-thi-truong-ban-le-ha-noi-hoat-dong-e-am-1', 0, 0),
(17882, 4, 'posts', 'ha-noi-se-co-them-22000-can-ho-moi', 0, 0),
(17883, 5, 'posts', 'thi-truong-bat-dong-san-viet-nam-bi-xep-hang-minh-bach-thap', 0, 0),
(17884, 6, 'posts', 'phan-khuc-nha-o-1-ty-dong-co-kha-nang-bung-no', 0, 0),
(17885, 7, 'posts', 'mua-ban-nha-o-xa-hoi-bat-hop-phap-van-ngang-nhien-hoat-dong', 0, 0),
(17886, 8, 'posts', 'bat-dong-san-nong-nghiep-co-the-but-pha-cuoi-nam-2016', 0, 0),
(17887, 9, 'posts', 'thi-truong-dia-oc-tphcm-xuat-hien-dau-hieu-bat-on', 0, 0),
(17888, 10, 'posts', 'nhon-nhip-doi-chu-cac-du-an-bat-dong-san', 0, 0),
(17889, 11, 'posts', 'dau-tu-bds-nghi-duong-lieu-co-phai-“ga-de-trung-vang”', 0, 0),
(17890, 21, 'posts', 'thoi-diem-“len-ngoi”-cua-bat-dong-san-nghi-duong', 0, 0),
(17891, 22, 'posts', 'tphcm-du-an-can-ho-o-at-do-bo-tren-dai-lo-pham-van-dong', 0, 0),
(17892, 23, 'posts', 'da-nang-thi-truong-bat-dong-san-xay-dung-phat-trien-nhanh', 0, 0),
(17893, 24, 'posts', 'thi-truong-bat-dong-san-phuc-hoi-nhe-trong-nua-dau-nam', 0, 0),
(17894, 25, 'posts', '6-thang-dau-nam-kinh-doanh-bat-dong-san-thu-hut-gan-100000-ty-dong', 0, 0),
(17895, 26, 'posts', 'trang-chu', 0, 0),
(17896, 27, 'posts', 'nha-o-xa-hoi-co-nen-de-chu-dau-tu-toan-quyen-xet-duyet', 0, 0),
(17897, 28, 'posts', '1', 0, 0),
(17898, 29, 'posts', '1-1490024231', 0, 0),
(17899, 30, 'posts', 'ngam-ngoi-nha-ong-co-thiet-ke-doc-dao-cua-cap-vo-chong-kien-truc-su', 0, 0),
(17900, 31, 'posts', 'ngam-lau-dai-dep-me-hon-duoc-cai-tao-tu-nha-may-bo-hoang', 0, 0),
(17901, 32, 'posts', 'kho-khan-chuyen-nhuong-mot-phan-du-an-1490024231', 0, 0),
(17902, 33, 'posts', 'kho-khan-chuyen-nhuong-mot-phan-du-an-1490024231', 0, 0),
(17903, 34, 'posts', 'kho-khan-chuyen-nhuong-mot-phan-du-an-1490024231', 0, 0),
(17904, 8, 'tags', '13254', 0, 0),
(17905, 10, 'tags', 'co-giao-dien12', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `description`, `slug`) VALUES
(6, 'Tiêu điểm', '', 'tieu-diem-1'),
(7, '', '', ''),
(8, 'bản giao diện', '', ''),
(9, 'Khu đất', '', ''),
(10, 'có giao diện', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `taxonomy`
--

DROP TABLE IF EXISTS `taxonomy`;
CREATE TABLE `taxonomy` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taxonomy`
--

INSERT INTO `taxonomy` (`id`, `table_id`, `table_name`, `type`, `value`) VALUES
(1, 1, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(5, 3, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(6, 4, 'posts', 'SEOBAIVIET', '{"seo_title":"a","seo_description":"tu\\u1ea5n anh","seo_keyword":"","fb_title":"","fb_description":""}'),
(8, 1, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(9, 1, 'duan', 'SEOBAIVIET', '{"seo_title":"Khu \\u0111\\u00f4 th\\u1ecb tu\\u1ec7 t\\u0129nh","seo_description":"Khu \\u0111\\u00f4 th\\u1ecb tu\\u1ec7 t\\u0129nh","seo_keyword":"","fb_title":"","fb_description":""}'),
(10, 2, 'duan', 'SEOBAIVIET', '{"seo_title":"Nam H\\u1ea3i d\\u01b0\\u01a1ng","seo_description":"Nam H\\u1ea3i d\\u01b0\\u01a1ng","seo_keyword":"","fb_title":"","fb_description":""}'),
(12, 3, 'duan', 'SEOBAIVIET', '{"seo_title":"D\\u1ef1 \\u00e1n T\\u00e2y Nam c\\u01b0\\u1eddng","seo_description":"D\\u1ef1 \\u00e1n T\\u00e2y Nam c\\u01b0\\u1eddng","seo_keyword":"","fb_title":"","fb_description":""}'),
(14, 4, 'duan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"D\\u1ef1 \\u00e1n \\u0110\\u00f4ng Nam c\\u01b0\\u1eddng D\\u1ef1 \\u00e1n \\u0110\\u00f4ng Nam c\\u01b0\\u1eddng","seo_keyword":"","fb_title":"","fb_description":""}'),
(16, 5, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Theo Jones Lang LaSalle (JLL), ch\\u1ec9 s\\u1ed1 minh b\\u1ea1ch th\\u00f4ng tin (RETI) c\\u1ee7a th\\u1ecb tr\\u01b0\\u1eddng b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n Vi\\u1ec7t Nam n\\u0103m 2016 x\\u1ebfp th\\u1ee9 68 trong s\\u1ed1 109 qu\\u1ed1c gia \\u0111\\u01b0\\u1ee3c kh\\u1ea3o s\\u00e1t. X\\u1ebfp h\\u1ea1ng n\\u00e0y \\u0111\\u01b0a Vi\\u1ec7t Nam v\\u00e0o nh\\u00f3m c\\u00f3 \\u0111\\u1ed9 minh b\\u1ea1ch th\\u1ea5p, khi\\u1ebfn vi\\u1ec7c \\u0111\\u1ecbnh gi\\u00e1 g\\u1eb7p nhi\\u1ec1u kh\\u00f3 kh\\u0103n.","seo_keyword":"","fb_title":"","fb_description":""}'),
(18, 6, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"D\\u00f2ng v\\u1ed1n t\\u00edn d\\u1ee5ng \\u01b0u \\u0111\\u00e3i h\\u1ed7 tr\\u1ee3 cho ng\\u01b0\\u1eddi vay v\\u1ed1n mua nh\\u00e0 \\u1edf thu nh\\u1eadp th\\u1ea5p \\u0111ang c\\u00f3 xu h\\u01b0\\u1edbng tr\\u1edf l\\u1ea1i sau m\\u1ed9t lo\\u1ea1t \\u0111\\u1ed9ng th\\u00e1i m\\u1edbi t\\u1eeb ch\\u00ednh s\\u00e1ch.\\r\\n\\r\\n","seo_keyword":"","fb_title":"","fb_description":""}'),
(20, 7, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"\\u0110\\u1ec3 an c\\u01b0 l\\u1ea1c nghi\\u1ec7p t\\u1ea1i th\\u00e0nh ph\\u1ed1 l\\u1edbn l\\u00e0 \\u0111i\\u1ec1u ao \\u01b0\\u1edbc c\\u1ee7a nh\\u1eefng c\\u00e1n b\\u1ed9, vi\\u00ean ch\\u1ee9c l\\u00e2u n\\u0103m, c\\u1ee7a nhi\\u1ec1u thanh ni\\u00ean ngo\\u1ea1i t\\u1ec9nh m\\u1edbi ra tr\\u01b0\\u1eddng \\u0111i l\\u00e0m. Th\\u1ea5u hi\\u1ec3u nhu c\\u1ea7u n\\u00e0y, Ch\\u00ednh ph\\u1ee7 \\u0111\\u00e3 ban h\\u00e0nh Ngh\\u1ecb \\u0111\\u1ecbnh, c\\u00e1c ch\\u01b0\\u01a1ng tr\\u00ecnh ph\\u00e1t tri\\u1ec3n nh\\u00e0 \\u1edf x\\u00e3 h\\u1ed9i nh\\u1eb1m gi\\u00fap ng\\u01b0\\u1eddi thu nh\\u1eadp th\\u1ea5p c\\u00f3 th\\u1ec3 s\\u1edf h\\u1eefu m\\u1ed9t c\\u0103n nh\\u00e0. M\\u1ed9t ch\\u00ednh s\\u00e1ch mang l\\u1ea1i k\\u1ef3 v\\u1ecdng hi\\u1ec7n th\\u1ef1c h\\u00f3a ng\\u00f4i nh\\u00e0 m\\u01a1 \\u01b0\\u1edbc cho r\\u1ea5t nhi\\u1ec1u ng\\u01b0\\u1eddi d\\u00e2n. Tuy v\\u1eady, qu\\u00e1 tr\\u00ecnh ph\\u00e2n b\\u1ed1 nh\\u00e0 \\u1edf x\\u00e3 h\\u1ed9i l\\u1ea1i c\\u00f3 nh\\u1eefng \\u0111i\\u1ec1u b\\u1ea5t th\\u01b0\\u1eddng.","seo_keyword":"","fb_title":"","fb_description":""}'),
(22, 8, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Nh\\u00e0 \\u0111\\u1ea5t n\\u1ed9i th\\u00e0nh, \\u0111\\u1ea5t l\\u00e0m n\\u00f4ng nghi\\u1ec7p v\\u00e0 b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n quanh c\\u00e1c khu c\\u00f4ng nghi\\u1ec7p \\u0111\\u01b0\\u1ee3c d\\u1ef1 b\\u00e1o s\\u1ebd l\\u00e0 nh\\u1eefng k\\u00eanh \\u0111\\u1ea7u t\\u01b0 s\\u00f4i \\u0111\\u1ed9ng, c\\u00f3 t\\u1ed1c \\u0111\\u1ed9 t\\u0103ng t\\u1ed1c nhanh trong nh\\u1eefng th\\u00e1ng cu\\u1ed1i n\\u0103m 2016.","seo_keyword":"","fb_title":"","fb_description":""}'),
(24, 9, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Theo Hi\\u1ec7p h\\u1ed9i B\\u0110S Tp.HCM (HoREA) s\\u1ed1 l\\u01b0\\u1ee3ng giao d\\u1ecbch b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n ch\\u1eefng l\\u1ea1i v\\u00e0 c\\u00f3 d\\u1ea5u hi\\u1ec7u l\\u1ec7ch pha sang ph\\u00e2n kh\\u00fac b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n cao c\\u1ea5p trong khi thi\\u1ebfu s\\u1ea3n ph\\u1ea9m c\\u0103n h\\u1ed9 b\\u00ecnh d\\u00e2n quy m\\u00f4 v\\u1eeba v\\u00e0 nh\\u1ecf, c\\u00f3 1-2 ph\\u00f2ng ng\\u1ee7, c\\u00f3 gi\\u00e1 b\\u00e1n v\\u1eeba t\\u00fai ti\\u1ec1n","seo_keyword":"","fb_title":"","fb_description":""}'),
(26, 10, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Th\\u1ecb tr\\u01b0\\u1eddng B\\u0110S \\u0111ang ch\\u1ee9ng ki\\u1ebfn m\\u1ed9t cu\\u1ed9c \\u0111\\u1ed5i ch\\u1ee7 m\\u1ea1nh m\\u1ebd \\u1edf c\\u00e1c d\\u1ef1 \\u00e1n B\\u0110S, khi\\u1ebfn l\\u0129nh v\\u1ef1c n\\u00e0y tr\\u1edf th\\u00e0nh \\u201cmi\\u1ebfng b\\u00e1nh\\u201d c\\u1ee7a nh\\u1eefng \\u201ctay ch\\u01a1i\\u201d m\\u1edbi n\\u1ed5i.","seo_keyword":"","fb_title":"","fb_description":""}'),
(28, 11, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Cam k\\u1ebft l\\u1ee3i nhu\\u1eadn chia theo t\\u1ef7 l\\u1ec7 80%:20%, bi\\u1ec7t th\\u1ef1 ngh\\u1ec9 d\\u01b0\\u1ee1ng, kh\\u00e1ch s\\u1ea1n mini g\\u1ea7n \\u0111\\u00e2y \\u0111\\u01b0\\u1ee3c c\\u00e1c ch\\u1ee7 \\u0111\\u1ea7u t\\u01b0 qu\\u1ea3ng b\\u00e1 r\\u1ea7m r\\u1ed9. Nh\\u01b0ng li\\u1ec7u n\\u00f3 c\\u00f3 ph\\u1ea3i l\\u00e0 \\u201cg\\u00e0 \\u0111\\u1ebb tr\\u1ee9ng v\\u00e0ng\\u201d hay l\\u00e0 b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n \\u201ch\\u00e1i ra ti\\u1ec1n\\u201d nh\\u01b0 qu\\u1ea3ng c\\u00e1o?","seo_keyword":"","fb_title":"","fb_description":""}'),
(31, 13, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(33, 15, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(34, 16, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(35, 17, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(43, 5, 'duan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(45, 6, 'duan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(48, 7, 'duan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(51, 21, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"C\\u00e1c chuy\\u00ean gia \\u0111\\u1ea7u ng\\u00e0nh v\\u1ec1 kinh t\\u1ebf v\\u00e0 b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n (B\\u0110S) \\u0111\\u1ec1u cho r\\u1eb1ng, hi\\u1ec7n \\u0111ang l\\u00e0 th\\u1eddi \\u0111i\\u1ec3m thu\\u1eadn l\\u1ee3i cho vi\\u1ec7c \\u0111\\u1ea7u t\\u01b0 b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n \\u1edf ph\\u00e2n kh\\u00fac n\\u00e0y.","seo_keyword":"","fb_title":"","fb_description":""}'),
(54, 22, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"H\\u00e0ng ch\\u1ee5c d\\u1ef1 \\u00e1n nh\\u00e0 \\u1edf, trong \\u0111\\u00f3 \\u00edt nh\\u1ea5t h\\u01a1n 10 c\\u00f4ng tr\\u00ecnh nh\\u00e0 cao t\\u1ea7ng \\u0111ang \\u0111ua nhau m\\u1ecdc l\\u00ean quanh tr\\u1ee5c \\u0111\\u01b0\\u1eddng n\\u1ed9i \\u0111\\u00f4 \\u0111\\u1eb9p nh\\u1ea5t Tp.HCM \\u0111\\u01b0\\u1ee3c \\u0111\\u1ea7u t\\u01b0 x\\u00e2y d\\u1ef1ng 340 tri\\u1ec7u USD - Ph\\u1ea1m V\\u0103n \\u0110\\u1ed3ng.","seo_keyword":"","fb_title":"","fb_description":""}'),
(57, 23, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"T\\u1eeb \\u0111\\u1ea7u n\\u0103m 2015, th\\u1ecb tr\\u01b0\\u1eddng b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n (B\\u0110S) \\u0110\\u00e0 N\\u1eb5ng \\u0111\\u00e3 c\\u00f3 nhi\\u1ec1u chuy\\u1ec3n bi\\u1ebfn t\\u00edch c\\u1ef1c. \\u0110i\\u1ec1u n\\u00e0y d\\u1eabn \\u0111\\u1ebfn ho\\u1ea1t \\u0111\\u1ed9ng x\\u00e2y d\\u1ef1ng \\u1edf \\u0111\\u00e2y c\\u0169ng n\\u00f3ng theo. Nh\\u1eefng c\\u00f4ng tr\\u00ecnh nh\\u00e0 cao t\\u1ea7ng t\\u1eeb n\\u0103m 2015 \\u0111\\u1ebfn nay m\\u1ecdc l\\u00ean nhi\\u1ec1u h\\u01a1n, nh\\u1ea5t l\\u00e0 d\\u1ecdc c\\u00e1c tuy\\u1ebfn \\u0111\\u01b0\\u1eddng ven bi\\u1ec3n v\\u00e0 khu v\\u1ef1c g\\u1ea7n bi\\u1ec3n.","seo_keyword":"","fb_title":"","fb_description":""}'),
(60, 24, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Theo B\\u00e1o c\\u00e1o kinh t\\u1ebf v\\u0129 m\\u00f4 Qu\\u00fd 2\\/2016 c\\u1ee7a Vi\\u1ec7n Nghi\\u00ean c\\u1ee9u kinh t\\u1ebf v\\u00e0 ch\\u00ednh s\\u00e1ch (VEPR), 6 th\\u00e1ng \\u0111\\u1ea7u n\\u0103m, th\\u1ecb tr\\u01b0\\u1eddng b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n (B\\u0110S) ph\\u1ee5c h\\u1ed3i nh\\u1eb9.","seo_keyword":"","fb_title":"","fb_description":""}'),
(63, 25, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Trong 6 th\\u00e1ng \\u0111\\u1ea7u n\\u0103m, v\\u1edbi 1.354 doanh nghi\\u1ec7p th\\u00e0nh l\\u1eadp m\\u1edbi, s\\u1ed1 v\\u1ed1n \\u0111\\u1ea1t 107.909 t\\u1ef7 \\u0111\\u1ed3ng, b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n \\u0111ang l\\u00e0 ng\\u00e0nh c\\u00f3 s\\u1ee9c thu h\\u00fat v\\u1ed1n l\\u1edbn nh\\u1ea5t hi\\u1ec7n nay.","seo_keyword":"","fb_title":"","fb_description":""}'),
(65, 26, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(68, 27, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Nhi\\u1ec1u \\u00fd ki\\u1ebfn cho r\\u1eb1ng, vi\\u1ec7c giao cho ch\\u1ee7 \\u0111\\u1ea7u t\\u01b0 to\\u00e0n quy\\u1ec1n x\\u00e9t duy\\u1ec7t \\u0111ang l\\u00e0 k\\u1ebd h\\u1edf l\\u1edbn cho vi\\u1ec7c l\\u1ee3i d\\u1ee5ng ch\\u00ednh s\\u00e1ch nh\\u00e0 \\u1edf x\\u00e3 h\\u1ed9i (N\\u01a0XH) k\\u00e9o theo vi\\u1ec7c \\u0111\\u1ec3 l\\u1ecdt nh\\u1eefng tr\\u01b0\\u1eddng h\\u1ee3p ng\\u01b0\\u1eddi gi\\u00e0u tranh ph\\u1ea7n ng\\u01b0\\u1eddi ngh\\u00e8o","seo_keyword":"","fb_title":"","fb_description":""}'),
(74, 1, 'category', 'SEOBAIVIET', '{"seo_title":"1","seo_description":"Tin n\\u1ed5i b\\u1eadt","seo_keyword":"","fb_title":"","fb_description":""}'),
(76, 6, 'category', 'SEOBAIVIET', '{"seo_title":"","seo_description":"Tin th\\u1ecb tr\\u01b0\\u1eddng","seo_keyword":"","fb_title":"","fb_description":""}'),
(81, 2, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(85, 3, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(88, 4, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"B\\u00e1n g\\u1ea5p 2 d\\u00e3y nh\\u00e0 tr\\u1ecd 18 ph\\u00f2ng di\\u1ec7n t\\u00edch 260m2, \\u0111ang thu\\u00ea k\\u00edn, SH ri\\u00eang, thu nh\\u1eadp 19 tr\\/th\\u00e1ng","seo_keyword":"","fb_title":"","fb_description":""}'),
(91, 5, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(93, 6, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(97, 7, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(100, 8, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(103, 9, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(106, 10, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(120, 11, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(122, 12, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(124, 13, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(126, 15, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(128, 16, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(130, 16, 'category', 'SEOBAIVIET', '{"seo_title":"B\\u00e1n c\\u0103n h\\u1ed9 chung c\\u01b0","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(135, 35, 'images', 'CHITIETHINHANH', '{"size":"4.79 KB","thumbnail200":"","imagename":"logo.png","width":204,"height":46,"type":"png","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/08\\/"}'),
(136, 36, 'images', 'CHITIETHINHANH', '{"size":"74.45 KB","thumbnail200":"","imagename":"banner.gif","width":728,"height":90,"type":"gif","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/08\\/"}'),
(137, 37, 'images', 'CHITIETHINHANH', '{"size":"56.15 KB","thumbnail200":"","imagename":"quangcao.gif","width":300,"height":250,"type":"gif","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/08\\/"}'),
(138, 18, 'category', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(139, 14, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(150, 48, 'images', 'CHITIETHINHANH', '{"size":"136.93 KB","url":"uploads\\/images\\/2016\\/09\\/","thumbnail150":"cay-canh-1-thumbnail150x150.jpg","thumbnail200":"cay-canh-1-thumbnail200x200.jpg","imagename":"cay-canh-1.jpg","width":720,"height":960,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/09\\/"}'),
(152, 50, 'images', 'CHITIETHINHANH', '{"size":"104.32 KB","url":"uploads\\/images\\/2016\\/09\\/","thumbnail150":"cay-canh-5-thumbnail150x150.jpg","thumbnail200":"cay-canh-5-thumbnail200x200.jpg","imagename":"cay-canh-5.jpg","width":960,"height":720,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/09\\/"}'),
(153, 51, 'images', 'CHITIETHINHANH', '{"size":"51.96 KB","url":"uploads\\/images\\/2016\\/09\\/","thumbnail150":"vong-deo-tay-4-thumbnail150x150.jpg","thumbnail200":"vong-deo-tay-4-thumbnail200x200.jpg","imagename":"vong-deo-tay-4.jpg","width":960,"height":540,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/09\\/"}'),
(154, 52, 'images', 'CHITIETHINHANH', '{"size":"61.28 KB","url":"uploads\\/images\\/2016\\/09\\/","thumbnail150":"vong-deo-tay-5-thumbnail150x150.jpg","thumbnail200":"vong-deo-tay-5-thumbnail200x200.jpg","imagename":"vong-deo-tay-5.jpg","width":960,"height":625,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/09\\/"}'),
(156, 54, 'images', 'CHITIETHINHANH', '{"size":"91.35 KB","url":"uploads\\/images\\/2016\\/09\\/","thumbnail150":"cay-canh-thumbnail150x150.jpg","thumbnail200":"cay-canh-thumbnail200x200.jpg","imagename":"cay-canh.jpg","width":718,"height":914,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2016\\/09\\/"}'),
(159, 28, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(160, 29, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(162, 21, 'category', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(165, 30, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(166, 31, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(170, 57, 'images', 'CHITIETHINHANH', '{"size":"54.90 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"11261661_895480870487130_8638260627910861365_n-thumbnail150x150.jpg","thumbnail200":"11261661_895480870487130_8638260627910861365_n-thumbnail200x200.jpg","imagename":"11261661_895480870487130_8638260627910861365_n.jpg","width":960,"height":360,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(171, 58, 'images', 'CHITIETHINHANH', '{"size":"106.12 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"10474727_739055926129626_8372302982240567744_n-thumbnail150x150.jpg","thumbnail200":"10474727_739055926129626_8372302982240567744_n-thumbnail200x200.jpg","imagename":"10474727_739055926129626_8372302982240567744_n.jpg","width":960,"height":720,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(172, 59, 'images', 'CHITIETHINHANH', '{"size":"106.12 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"10474727_739055926129626_8372302982240567744_n-1-thumbnail150x150.jpg","thumbnail200":"10474727_739055926129626_8372302982240567744_n-1-thumbnail200x200.jpg","imagename":"10474727_739055926129626_8372302982240567744_n-1.jpg","width":960,"height":720,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(173, 60, 'images', 'CHITIETHINHANH', '{"size":"119.63 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"17094097_1827745897477013_1942299462_n-thumbnail150x150.jpg","thumbnail200":"17094097_1827745897477013_1942299462_n-thumbnail200x200.jpg","imagename":"17094097_1827745897477013_1942299462_n.jpg","width":922,"height":615,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(174, 61, 'images', 'CHITIETHINHANH', '{"size":"90.69 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"16832184_389197528117141_1044341205007191760_n-thumbnail150x150.jpg","thumbnail200":"16832184_389197528117141_1044341205007191760_n-thumbnail200x200.jpg","imagename":"16832184_389197528117141_1044341205007191760_n.jpg","width":720,"height":520,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(175, 62, 'images', 'CHITIETHINHANH', '{"size":"54.90 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"11261661_895480870487130_8638260627910861365_n-1-thumbnail150x150.jpg","thumbnail200":"11261661_895480870487130_8638260627910861365_n-1-thumbnail200x200.jpg","imagename":"11261661_895480870487130_8638260627910861365_n-1.jpg","width":960,"height":360,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(176, 63, 'images', 'CHITIETHINHANH', '{"size":"54.90 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"11261661_895480870487130_8638260627910861365_n-2-thumbnail150x150.jpg","thumbnail200":"11261661_895480870487130_8638260627910861365_n-2-thumbnail200x200.jpg","imagename":"11261661_895480870487130_8638260627910861365_n-2.jpg","width":960,"height":360,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(177, 64, 'images', 'CHITIETHINHANH', '{"size":"90.69 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"16832184_389197528117141_1044341205007191760_n-1-thumbnail150x150.jpg","thumbnail200":"16832184_389197528117141_1044341205007191760_n-1-thumbnail200x200.jpg","imagename":"16832184_389197528117141_1044341205007191760_n-1.jpg","width":720,"height":520,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(178, 65, 'images', 'CHITIETHINHANH', '{"size":"119.63 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"17094097_1827745897477013_1942299462_n-1-thumbnail150x150.jpg","thumbnail200":"17094097_1827745897477013_1942299462_n-1-thumbnail200x200.jpg","imagename":"17094097_1827745897477013_1942299462_n-1.jpg","width":922,"height":615,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(179, 66, 'images', 'CHITIETHINHANH', '{"size":"106.12 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"10474727_739055926129626_8372302982240567744_n-2-thumbnail150x150.jpg","thumbnail200":"10474727_739055926129626_8372302982240567744_n-2-thumbnail200x200.jpg","imagename":"10474727_739055926129626_8372302982240567744_n-2.jpg","width":960,"height":720,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(180, 67, 'images', 'CHITIETHINHANH', '{"size":"220.40 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"IMG_3755.PNG-thumbnail150x150.jpg","thumbnail200":"IMG_3755.PNG-thumbnail200x200.jpg","imagename":"IMG_3755.PNG.jpg","width":675,"height":1200,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(181, 68, 'images', 'CHITIETHINHANH', '{"size":"220.40 KB","url":"uploads\\/images\\/2017\\/03\\/","thumbnail150":"IMG_3755.PNG-1-thumbnail150x150.jpg","thumbnail200":"IMG_3755.PNG-1-thumbnail200x200.jpg","imagename":"IMG_3755.PNG-1.jpg","width":675,"height":1200,"type":"jpg","path":"\\/Applications\\/XAMPP\\/xamppfiles\\/htdocs\\/nhadathd\\/frontend\\/web\\/uploads\\/images\\/2017\\/03\\/"}'),
(184, 33, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(185, 34, 'posts', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(186, 17, 'batdongsan', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(187, 8, 'tags', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}'),
(188, 10, 'tags', 'SEOBAIVIET', '{"seo_title":"","seo_description":"","seo_keyword":"","fb_title":"","fb_description":""}');

-- --------------------------------------------------------

--
-- Table structure for table `trangthai`
--

DROP TABLE IF EXISTS `trangthai`;
CREATE TABLE `trangthai` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `thuoc_tinh` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `value_min` int(11) NOT NULL DEFAULT '0',
  `value_max` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trangthai`
--

INSERT INTO `trangthai` (`id`, `ten`, `type`, `thuoc_tinh`, `value_min`, `value_max`) VALUES
(1, 'Đã hoàn thành', 'batdongsan', 'trang_thai', 0, 0),
(2, 'Đang rao bán', 'batdongsan', 'trang_thai', 0, 0),
(4, 'Đang rao bán', 'batdongsan', 'trang_thai', 0, 0),
(5, 'Công khai', 'status', '', 0, 0),
(6, 'Bản nháp', 'status', '', 0, 0),
(7, 'Thùng rác', 'filerindex5', 'status,1', 0, 0),
(8, 'Xóa', 'filerindex5', '-1', 0, 0),
(9, 'Xóa', 'images', '-1', 0, 0),
(10, 'Tốp 1 trang chủ', 'postorder', '', 0, 0),
(11, 'Mặc định', 'postorder', '', 0, 0),
(13, 'Đông', 'huong', '', 0, 0),
(14, 'Triệu/m²', 'donvi', '', 0, 0),
(15, 'Thỏa thuận', 'donvi', '', 0, 0),
(16, 'Có sổ đỏ', 'hopdong', '', 0, 0),
(17, 'Images', 'type_banner', 'images', 0, 0),
(18, 'Top header', 'position_banner', 'top_header', 0, 0),
(20, 'Trang hiện tại', 'open_new_tab', 'current_tab', 0, 0),
(21, 'Mở trang mới', 'open_new_tab', 'open_tab', 0, 0),
(22, 'Top right header', 'position_banner', 'top_header_left', 0, 0),
(23, 'Logo footer', 'position_banner', 'right_footer', 0, 0),
(24, 'Side bar left center', 'position_banner', 'sidebar_right_centrer', 0, 0),
(25, 'Không xác định', 'dientichdat', '-1', 0, 0),
(26, '<= 30m2', 'dientichdat', '0', 0, 30),
(27, '< 500 triệu', 'giadat', '0', 0, 500000000),
(28, 'Khôi phục', 'filerindex1', 'status,5', 0, 0),
(29, 'Bản nháp', 'filerindex5', 'status,2', 0, 0),
(30, 'Khôi phục', 'filerindex2', 'status,5', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `mobile`, `password`, `password_hash`, `password_reset_token`, `email`, `auth_key`, `created_at`, `updated_at`, `status`, `role_id`) VALUES
(6, 'anhntk54', '1', '1', '$2y$13$.doOnursjI45ON/o4yltQOF/I.7yfvapiYKUbuaFVc.LnAL4MpADi', '', '1', '', '2016-03-17 08:10:08', '0000-00-00 00:00:00', 1, 0),
(7, 'admin', '1', '123456', '$2y$13$tdTvwUG/CwDObkKbfreEG.qxURlrQhZ5lgG/UgYIKWWi4.4r0Qxvq', '', 'a@gmail.com', '', '2016-05-04 04:13:23', '0000-00-00 00:00:00', 1, 1),
(8, 'anhntk55', '1', '123456', '$2y$13$m1KWgbfyyRfsukmgYsikDeaslnuIVzvwqWFQGjm9FJoaqMC4sfq8G', '', 'a@gmail.com', '', '2016-07-15 07:59:15', '0000-00-00 00:00:00', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_relationships`
--
ALTER TABLE `post_relationships`
  ADD PRIMARY KEY (`post_id`,`table_id`,`table_name`,`post_table`);

--
-- Indexes for table `slug`
--
ALTER TABLE `slug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxonomy`
--
ALTER TABLE `taxonomy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trangthai`
--
ALTER TABLE `trangthai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `slug`
--
ALTER TABLE `slug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17906;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `taxonomy`
--
ALTER TABLE `taxonomy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
--
-- AUTO_INCREMENT for table `trangthai`
--
ALTER TABLE `trangthai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
