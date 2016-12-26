-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2016 at 11:18 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lava_viettoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `create_date` date NOT NULL,
  `user_post` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `date_modify` date NOT NULL,
  `date_create` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `slug`, `weight`, `status`, `create_date`, `user_post`, `parent_id`, `date_modify`, `date_create`, `user_id`) VALUES
(1, 'Banner Ngang', 'banner-ngang', 1, 1, '2014-11-23', 1, 0, '0000-00-00', NULL, 0),
(2, 'Banner Right', 'banner-right', 2, 1, '2014-11-23', 1, 0, '0000-00-00', NULL, 0),
(3, 'Banner Top', 'banner-top', 1, 1, '0000-00-00', 1, 0, '2016-03-25', '2016-03-25', 1),
(4, 'Đối tác', 'doi-tac', 1, 1, '0000-00-00', 1, 0, '0000-00-00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `article_views` int(11) NOT NULL DEFAULT '0',
  `article_status` tinyint(1) NOT NULL DEFAULT '1',
  `article_hot` tinyint(1) DEFAULT '0',
  `article_weight` int(11) NOT NULL DEFAULT '0',
  `date_modify` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `article_type` int(11) NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `choose_upload` int(1) NOT NULL DEFAULT '1',
  `alt_picture` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articledetail`
--

CREATE TABLE `articledetail` (
  `article_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT '1',
  `article_name` varchar(250) DEFAULT NULL,
  `article_link` varchar(250) DEFAULT NULL,
  `article_summary` text,
  `article_description` text,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articleterm`
--

CREATE TABLE `articleterm` (
  `article_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_weight` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '1',
  `category_top` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `category_type` int(11) NOT NULL,
  `picture` text,
  `category_hot` int(11) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL DEFAULT '0',
  `alt_picture` varchar(200) DEFAULT NULL,
  `choose_upload` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_weight`, `date_modify`, `date_create`, `category_status`, `category_top`, `user_id`, `category_type`, `picture`, `category_hot`, `level`, `alt_picture`, `choose_upload`) VALUES
(1, 1, '2016-12-23 13:34:32', '2016-12-23 13:34:32', 1, 0, 1, 2, '69cad28971aaec06301e710f1dfc14ed.png', 0, 0, '', 1),
(2, 2, '2016-12-23 13:34:45', '2016-12-23 13:34:45', 1, 0, 1, 2, 'd044210f6faaeb4af7047bb02968f81d.png', 0, 0, '', 1),
(3, 3, '2016-12-23 13:34:57', '2016-12-23 13:34:57', 1, 0, 1, 2, '3a6d835a9ce4284e913903624d959540.png', 0, 0, '', 1),
(4, 4, '2016-12-23 13:35:15', '2016-12-23 13:35:15', 1, 0, 1, 2, 'bda15c6204c967c74cdef38d54100103.png', 0, 0, '', 1),
(5, 5, '2016-12-23 13:35:27', '2016-12-23 13:35:27', 1, 0, 1, 2, 'deaba3a26837516a06321a9d7ff80058.png', 0, 0, '', 1),
(6, 6, '2016-12-23 13:35:40', '2016-12-23 13:35:40', 1, 0, 1, 2, '8b7946f473c0a6e89fa12c0126a9664d.png', 0, 0, '', 1),
(7, 7, '2016-12-23 13:35:55', '2016-12-23 13:35:55', 1, 0, 1, 2, '9b973091411a8b00e591c2076aa4d53a.png', 0, 0, '', 1),
(8, 8, '2016-12-23 13:36:07', '2016-12-23 13:36:07', 1, 0, 1, 2, '2196accbf061a9d9b987f18a1a93e162.png', 0, 0, '', 1),
(9, 9, '2016-12-23 13:36:22', '2016-12-23 13:36:22', 1, 0, 1, 2, '113202e8ae983fd7a5a04ca21203273f.png', 0, 0, '', 1),
(10, 10, '2016-12-23 13:38:12', '2016-12-23 13:37:07', 1, 0, 1, 2, '54a58f791fef270df2c1e3dc35b279fa.png', 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorydetail`
--

CREATE TABLE `categorydetail` (
  `category_id` int(11) NOT NULL,
  `country_id` int(1) NOT NULL DEFAULT '1',
  `category_name` varchar(250) DEFAULT NULL,
  `category_link` varchar(250) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorydetail`
--

INSERT INTO `categorydetail` (`category_id`, `country_id`, `category_name`, `category_link`, `active`) VALUES
(1, 1, 'Apple Store', 'apple-store', 1),
(2, 1, 'Đồng hồ thông minh', 'dong-ho-thong-minh', 1),
(3, 1, 'Vòng đeo sức khỏe', 'vong-deo-suc-khoe', 1),
(4, 1, 'Âm thanh', 'am-thanh', 1),
(5, 1, 'Thiết bị thể thao', 'thiet-bi-the-thao', 1),
(6, 1, 'Đồ chơi hi-tech', 'do-choi-hi-tech', 1),
(7, 1, 'Thời trang', 'thoi-trang', 1),
(8, 1, 'Phụ kiện', 'phu-kien', 1),
(9, 1, 'Hàng đã qua sử dụng', 'hang-da-qua-su-dung', 1),
(10, 1, 'Apple watch', 'apple-watch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_parent`
--

CREATE TABLE `category_parent` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_parent`
--

INSERT INTO `category_parent` (`category_id`, `parent_id`) VALUES
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_tmp`
--

CREATE TABLE `category_tmp` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1718408b7b3987d0893c12154dfd20173c1d72eb', '::1', 1482743744, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323734333636313b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('292ed1fd5c7eef85857ad1a486d330dc775e5d54', '::1', 1482734465, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733343230383b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('4fa0e273dcca508ca08c735bb48ad3b018f65f7a', '::1', 1482732558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733323535353b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('5f577bbb19b66c0ac9a02b55fa8a935fb98ee8d6', '::1', 1482733891, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733333630343b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('6420a1899c409e465c2aa1e8e4f3e35695575415', '::1', 1482734205, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733333930353b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('6597efc6918d282f292fb96a05854548d4e0a788', '::1', 1482733497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733333233313b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('85359b533e5632f48b753b1117adb436ddb7eb1d', '::1', 1482734802, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733343532333b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('8e656b5ab08c01c1a1533c828c8255aa22d81bb5', '::1', 1482737171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733363931333b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('9b44bec46f7f0017414fd1805c3b755cb047d3f8', '::1', 1482736587, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733363538373b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('c159e196afdae262c4bd1d226e669d03ff2ee6d0', '::1', 1482737938, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733373232323b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('d044e3bc9f0d49bde217188d47a537d9aec4e861', '::1', 1482727274, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323732373133303b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('e35423bbecd33bbe811c66edd8cf5aa9b367349e', '::1', 1482735111, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733353131313b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b),
('f83e9fd74e809d076216c88638512797b49ef5d3', '::1', 1482738230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323733383038323b61646d696e5f6c6f67696e7c4f3a383a22737464436c617373223a31363a7b733a373a22757365725f6964223b733a313a2231223b733a31343a22757365725f6c6f67696e6e616d65223b733a373a22737061646d696e223b733a31333a22757365725f70617373776f7264223b733a33323a223135343930653535646462666635386231613664383032393439313235653563223b733a393a22757365725f6e616d65223b733a31313a2253757065722041646d696e223b733a31333a22757365725f6269727468646179223b733a31303a22313938382d30392d3032223b733a393a22757365725f6e6f7465223b733a303a22223b733a31313a22757365725f737461747573223b733a313a2231223b733a393a22757365725f64617465223b733a31393a22323031322d31302d31332030393a31303a3131223b733a31313a22757365725f6d6f64696679223b733a31393a22323031322d31302d31332030393a31303a3132223b733a333a22706572223b733a32313a22613a313a7b693a303b733a343a2266756c6c223b7d223b733a31303a22757365725f656d61696c223b4e3b733a31323a22757365725f61646472657373223b4e3b733a31303a22757365725f70686f6e65223b4e3b733a343a2274797065223b733a313a2232223b733a31303a227065726d697373696f6e223b733a32303a22766965772c6164642c656469742c64656c657465223b733a383a2273746f72655f6964223b733a313a2230223b7d6163746976655f6c6f677c623a313b);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `facebook` varchar(500) NOT NULL,
  `twitter` varchar(500) DEFAULT NULL,
  `google` varchar(500) DEFAULT NULL,
  `linkin` varchar(300) NOT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `map` text,
  `LangLoc` varchar(300) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `hotline` varchar(100) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `arrange` int(1) NOT NULL DEFAULT '1',
  `page` int(11) NOT NULL DEFAULT '20',
  `copyright` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `phone`, `fax`, `email`, `facebook`, `twitter`, `google`, `linkin`, `youtube`, `map`, `LangLoc`, `favicon`, `hotline`, `website`, `arrange`, `page`, `copyright`) VALUES
(1, '0914 340 011', '', 'sale@fbs-indochina.com', 'https://www.facebook.com/giaiphapthucphamvathucuong', 'twitter.com', 'google.com', 'linkin.com', 'youtube.com', '214-216, Đường Tô Hiến Thành, P.15, Quận 10', '(10.782557, 106.6718439)', 'http://localhost:8080/lava-cms/uploads/Images/config/untitled-1.png', '0914 340 011', 'demo.com', 2, 20, '© Copyright FBS 2016. All rights reserved.');

-- --------------------------------------------------------

--
-- Table structure for table `companydetail`
--

CREATE TABLE `companydetail` (
  `id_company` int(11) NOT NULL,
  `id_country` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descriptions` text,
  `about_company` text,
  `price_contact` varchar(100) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `time_work` varchar(300) DEFAULT NULL,
  `info_contact` text,
  `note_home` text,
  `info_support` text,
  `note_2` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companydetail`
--

INSERT INTO `companydetail` (`id_company`, `id_country`, `name`, `meta_keywords`, `meta_descriptions`, `about_company`, `price_contact`, `address`, `time_work`, `info_contact`, `note_home`, `info_support`, `note_2`) VALUES
(1, 1, 'CÔNG TY TNHH GIẢI PHÁP THỰC PHẨM VÀ GIẢI KHÁT', 'CÔNG TY TNHH GIẢI PHÁP THỰC PHẨM VÀ GIẢI KHÁT', 'CÔNG TY TNHH GIẢI PHÁP THỰC PHẨM VÀ GIẢI KHÁT', '<p><strong>CÔNG TY TNHH GIẢI PHÁP THỰC PHẨM VÀ GIẢI KHÁT</strong><br />\r\nĐịa&nbsp;chỉ: &nbsp;8/18 Đường số 8, Phường 11, Quận Gò Vấp, TP Hồ Chí Minh, Việt Nam</p>\r\n\r\n<p>Email:&nbsp;sale@fbs-indochina.com<br />\r\nĐiện thoại: 0914 340 011</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>FBS CHUYÊN CUNG CẤP CÁC GIẢI PHÁP VỀ&nbsp;THIẾT BỊ - NGUYÊN LIỆU VÀ HÓA CHẤT VỆ SINH CHO NGÀNH F&amp;B.</p>\r\n', 'T2-CN: 08h:00 - 23h:00', ' 8/18 Đường số 8, Phường 11, Quận Gò Vấp, TP Hồ Chí Minh, Việt Nam', '08 - 3755 2509\r\n0903 187 496 (Mr Đại)\r\n0919 840 898 (Ms Loan)', '<p>asdasdasd</p>', '<p><strong>MÔ HÌNH KINH DOANH</strong></p>\r\n\r\n<p>Nhằm giúp khách hàng của FBS dễ dàng tìm hiểu và lựa chọn thiết bị đúng theo nhu cầu và khả năng đầu tư của mình. FBS hy vọng các mô hình dưới đây phần nào giúp quý khách tiết kiệm được thời gian tìm hiểu cũng như đây là giải pháp mà FBS mong muốn chia sẽ đến tất cả&nbsp;quý khách hàng quan tâm</p>\r\n', NULL, NULL),
(1, 2, 'FBS FOOD AND BEVERAGE SOLUTION CO., LTD', '', '', '<p><strong>CÔNG TY TNHH GIẢI PHÁP THỰC PHẨM VÀ GIẢI KHÁT</strong><br />\r\nĐịa&nbsp;chỉ: 51/34 Nguyễn Văn Nghi, Phường 7, Quận Gò Vấp, TP Hồ Chí Minh, Việt Nam<br />\r\nĐiện thoại: 0914340011</p>\r\n', 'T2-CN: 08h:00 - 23h:00', '51/34 Nguyen Van Nghi street, ward 7, Go Vap district, HCMC, Vietnam', '08 - 3755 2509\r\n0903 187 496 (Mr Đại)\r\n0919 840 898 (Ms Loan)', '', '<p><strong>BUSSINESS CONCEPT</strong></p>\r\n\r\n<p>FBS to help customers easily understand and correct selection of equipment according to the needs and possibilities for their investment. FBS hopes following models helped you save time as well as learn that this is the solution desired FBS share to all interested customers.</p>\r\n\r\n<p>&nbsp;</p>\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_extra`
--

CREATE TABLE `company_extra` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `choose_upload` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_extra`
--

INSERT INTO `company_extra` (`id`, `company_id`, `name`, `value`, `alt`, `status`, `title`, `type`, `menu`, `choose_upload`) VALUES
(1, 1, 'logo', '0dfe6cc8ec2af8238c65443cd3c7ff13.png', 'logo', 1, 'Logo', 'picture', 'site', 1),
(2, 1, 'favicon', 'uploads/Images/favicon.png', 'favicon', 1, 'Favicon', 'picture', 'site', 2);

-- --------------------------------------------------------

--
-- Table structure for table `config_language`
--

CREATE TABLE `config_language` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` date NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_language`
--

INSERT INTO `config_language` (`id`, `name`, `date_create`, `user_id`, `status`, `type`) VALUES
(1, 'lang_service', '2016-08-18', 4, 1, 1),
(2, 'lang_customer', '2016-08-18', 4, 1, 1),
(3, 'lang_contact_us', '2016-08-18', 1, 1, 1),
(4, 'lang_phone', '2016-08-18', 1, 1, 1),
(5, 'lang_office', '2016-08-18', 1, 1, 1),
(6, 'lang_home', '2016-08-18', 1, 1, 1),
(7, 'lang_model', '2016-08-18', 1, 1, 1),
(8, 'lang_product', '2016-08-18', 1, 1, 1),
(9, 'lang_brand', '2016-08-18', 1, 1, 1),
(10, 'lang_most_tag', '2016-08-18', 1, 1, 1),
(11, 'lang_full_name', '2016-08-19', 1, 1, 1),
(12, 'lang_address', '2016-08-19', 4, 1, 1),
(13, 'lang_notice', '2016-08-19', 1, 1, 1),
(14, 'lang_add_cart_successfull', '2016-08-19', 1, 1, 1),
(15, 'lang_continue_buy', '2016-08-19', 1, 1, 1),
(16, 'lang_total', '2016-08-19', 1, 1, 1),
(17, 'lang_checkout', '2016-08-19', 4, 1, 1),
(18, 'lang_empty_cart', '2016-08-19', 1, 1, 1),
(20, 'lang_price', '2016-08-19', 1, 1, 1),
(21, 'lang_final_money', '2016-08-19', 1, 1, 1),
(22, 'lang_quantity', '2016-08-19', 1, 1, 1),
(23, 'lang_info_buyer', '2016-08-19', 1, 1, 1),
(24, 'lang_buy_success', '2016-08-19', 1, 1, 1),
(25, 'lang_cart', '2016-08-19', 1, 1, 1),
(26, 'lang_video_lib', '2016-09-21', 1, 1, 1),
(27, 'lang_resource_lib', '2016-09-21', 4, 1, 1),
(28, 'lang_search', '2016-09-21', 4, 1, 1),
(29, 'lang_eqip', '2016-09-21', 4, 1, 1),
(30, 'lang_product_h', '2016-09-21', 1, 1, 1),
(31, 'lang_title', '2016-09-21', 1, 1, 1),
(32, 'lang_hotline', '2016-09-21', 1, 1, 1),
(33, 'lang_overview', '2016-10-04', 1, 1, 1),
(34, 'lang_specification', '2016-10-04', 1, 1, 1),
(35, 'lang_other_products', '2016-10-04', 1, 1, 1),
(36, 'lang_about', '2016-11-10', 1, 1, 1),
(37, 'lang_view_more', '2016-11-14', 1, 1, 1),
(38, 'lang_news', '2016-11-14', 1, 1, 1),
(39, 'lang_project', '2016-11-29', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `config_languagedetail`
--

CREATE TABLE `config_languagedetail` (
  `config_language_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `value` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(510) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_languagedetail`
--

INSERT INTO `config_languagedetail` (`config_language_id`, `country_id`, `value`, `url`) VALUES
(1, 1, 'DỊCH VỤ ++', 'khach-hang'),
(1, 2, 'SERVICES PLUS', 'service'),
(2, 1, 'KHÁCH HÀNG', 'customer'),
(2, 2, 'CUSTOMERS', 'customer'),
(3, 1, 'Liên hệ', 'contact-us'),
(3, 2, 'Contact us', 'contact-us'),
(4, 1, 'Điện thoại', '#'),
(4, 2, 'Phone', '#'),
(5, 1, 'Trụ sở chính', '#'),
(5, 2, 'Office', '#'),
(6, 1, 'Trang chủ', 'trang-chu'),
(6, 2, 'Home', 'home'),
(7, 1, 'MÔ HÌNH KINH DOANH', '#'),
(7, 2, 'MÔ HÌNH KINH DOANH', '#'),
(8, 1, 'Sản phẩm', 'san-pham'),
(8, 2, 'Sản phẩm', 'product'),
(9, 1, 'THƯƠNG HIỆU', '#'),
(9, 2, 'THƯƠNG HIỆU', '#'),
(10, 1, 'TÌM KIẾM NHIỀU NHẤT', '#'),
(10, 2, 'TÌM KIẾM NHIỀU NHẤT', '#'),
(11, 1, 'Họ tên', '#'),
(11, 2, 'Full name', '#'),
(12, 1, 'Địa chỉ', ''),
(12, 2, 'Address', ''),
(13, 1, 'Nội dung', '#'),
(13, 2, 'Note', '#'),
(14, 1, 'Thêm vào giỏ hàng thành công', '#'),
(14, 2, 'Thêm vào giỏ hàng thành công', '#'),
(15, 1, 'Tiếp tục  mua hàng', '#'),
(15, 2, 'Tiếp tục  mua hàng', '#'),
(16, 1, 'Tổng', '#'),
(16, 2, 'Tổng', '#'),
(17, 1, 'Thanh toán', '#'),
(17, 2, 'Payment', '#'),
(18, 1, 'Chưa có sản phẩm trong giỏ hàng', '#'),
(18, 2, 'Chưa có sản phẩm trong giỏ hàng', '#'),
(20, 1, 'Giá', '#'),
(20, 2, 'Giá', '#'),
(21, 1, 'Thành tiền', '#'),
(21, 2, 'Thành tiền', '#'),
(22, 1, 'Số lượng', '#'),
(22, 2, 'Số lượng', '#'),
(23, 1, 'Thông tin người mua hàng', '#'),
(23, 2, 'Thông tin người mua hàng', '#'),
(24, 1, 'Bạn đã đặt hàng thành công', '#'),
(24, 2, 'Bạn đã đặt hàng thành công', '#'),
(25, 1, 'Giỏ hàng', '#'),
(25, 2, 'Cart', '#'),
(26, 1, 'Video', '#'),
(26, 2, 'Video Library', '#'),
(27, 1, 'Thư Viện', '#'),
(27, 2, 'Resource Library', '#'),
(28, 1, 'Tìm kiếm', '#'),
(28, 2, 'Search', '#'),
(29, 1, 'THƯƠNG HIỆU', '#'),
(29, 2, 'EQUIPMENT SUPPLIERS', '#'),
(30, 1, 'Sản phẩm nổi bật', '#'),
(30, 2, 'Sản phẩm nổi bật', '#'),
(31, 1, 'Tiêu đề', '#'),
(31, 2, 'Tiêu đề', '#'),
(32, 1, 'Hotline', '#'),
(32, 2, 'Hotline', '#'),
(33, 1, 'OVERVIEW', '#'),
(33, 2, 'OVERVIEW', '#'),
(34, 1, 'SPECIFICATION', '#'),
(34, 2, 'SPECIFICATION', '#'),
(35, 1, 'OTHER PRODUCTS', '#'),
(35, 2, 'OTHER PRODUCTS', '#'),
(36, 1, 'Giới thiệu', 'gioi-thieu'),
(36, 2, 'About', 'about-us'),
(37, 1, 'Xem thêm', '#'),
(37, 2, 'Xem thêm', '#'),
(38, 1, 'Tin tức', 'tin-tuc'),
(38, 2, 'News', 'news'),
(39, 1, 'Dự án', 'du-an'),
(39, 2, 'Project', 'project');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `note` text,
  `date_reseive` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(300) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `phone` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `session_id` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `visitor` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `default` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `title`, `name`, `picture`, `status`, `default`) VALUES
(1, 'Tiếng việt', 'vn', 'vn.png', 1, 1),
(2, 'Tiếng anh', 'en', 'en.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `count_user_online`
--

CREATE TABLE `count_user_online` (
  `total` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `count_user_online`
--

INSERT INTO `count_user_online` (`total`) VALUES
(189);

-- --------------------------------------------------------

--
-- Table structure for table `email_letter`
--

CREATE TABLE `email_letter` (
  `id` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_letter`
--

INSERT INTO `email_letter` (`id`, `email`, `create_date`) VALUES
(1, '0', '2016-02-18'),
(2, 'a@yahoo.com', '2016-02-18'),
(3, 'aa@yahoo.com', '2016-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `font_awesome`
--

CREATE TABLE `font_awesome` (
  `id` int(11) NOT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `font_awesome`
--

INSERT INTO `font_awesome` (`id`, `value`) VALUES
(1, 'fa fa-bluetooth'),
(2, 'fa fa-bluetooth-b'),
(3, 'fa fa-credit-card-alt'),
(4, 'fa fa-fort-awesome'),
(5, 'fa fa-hashtag'),
(6, 'fa fa-codiepie'),
(7, 'fa fa-edge'),
(8, 'fa fa-mixcloud'),
(9, 'fa fa-modx'),
(10, 'fa fa-pause-circle'),
(11, 'fa fa-pause-circle-o'),
(12, 'fa fa-percent'),
(13, 'fa fa-product-hunt'),
(14, 'fa fa-scribd'),
(15, 'fa fa-shopping-bag'),
(16, 'fa fa-shopping-basket'),
(17, 'fa fa-stop-circle'),
(18, 'fa fa-stop-circle-o'),
(19, 'fa fa-reddit-alien'),
(20, 'fa fa-adjust'),
(21, 'fa fa-usb'),
(22, 'fa fa-archive'),
(23, 'fa fa-anchor'),
(24, 'fa fa-area-chart'),
(25, 'fa fa-arrows-h'),
(26, 'fa fa-asterisk'),
(27, 'fa fa-arrows'),
(28, 'fa fa-arrows-v'),
(29, 'fa fa-automobile'),
(30, 'fa fa-at'),
(31, 'fa fa-balance-scale'),
(32, 'fa fa-ban'),
(33, 'fa fa-bank'),
(34, 'fa fa-bar-chart'),
(35, 'fa fa-bar-chart-o'),
(36, 'fa fa-barcode'),
(37, 'fa fa-bars'),
(38, 'fa fa-battery-0'),
(39, 'fa fa-battery-2'),
(40, 'fa fa-battery-3'),
(41, 'fa fa-battery-1'),
(42, 'fa fa-battery-4'),
(43, 'fa fa-battery-empty'),
(44, 'fa fa-battery-full'),
(45, 'fa fa-battery-half'),
(46, 'fa fa-battery-quarter'),
(47, 'fa fa-battery-three-quarters'),
(48, 'fa fa-bed'),
(49, 'fa fa-beer'),
(50, 'fa fa-bell'),
(51, 'fa fa-bell-o'),
(52, 'fa fa-bell-slash'),
(53, 'fa fa-bell-slash-o'),
(54, 'fa fa-bicycle'),
(55, 'fa fa-binoculars'),
(56, 'fa fa-birthday-cake'),
(57, 'fa fa-bolt'),
(58, 'fa fa-bomb'),
(59, 'fa fa-book'),
(60, 'fa fa-bookmark-o'),
(61, 'fa fa-bookmark'),
(62, 'fa fa-briefcase'),
(63, 'fa fa-bug'),
(64, 'fa fa-building'),
(65, 'fa fa-building-o'),
(66, 'fa fa-bullhorn'),
(67, 'fa fa-bullseye'),
(68, 'fa fa-bus'),
(69, 'fa fa-cab'),
(70, 'fa fa-calculator'),
(71, 'fa fa-calendar'),
(72, 'fa fa-calendar-check-o'),
(73, 'fa fa-calendar-minus-o'),
(74, 'fa fa-calendar-o'),
(75, 'fa fa-calendar-plus-o'),
(76, 'fa fa-calendar-times-o'),
(77, 'fa fa-camera'),
(78, 'fa fa-camera-retro'),
(79, 'fa fa-car'),
(80, 'fa fa-caret-square-o-down'),
(81, 'fa fa-caret-square-o-left'),
(82, 'fa fa-caret-square-o-right'),
(83, 'fa fa-caret-square-o-up'),
(84, 'fa fa-cart-plus'),
(85, 'fa fa-cart-arrow-down'),
(86, 'fa fa-cc'),
(87, 'fa fa-certificate'),
(88, 'fa fa-check'),
(89, 'fa fa-check-circle'),
(90, 'fa fa-check-circle-o'),
(91, 'fa fa-check-square'),
(92, 'fa fa-check-square-o'),
(93, 'fa fa-child'),
(94, 'fa fa-circle-o-notch'),
(95, 'fa fa-circle-thin'),
(96, 'fa fa-circle-o'),
(97, 'fa fa-circle'),
(98, 'fa fa-clock-o'),
(99, 'fa fa-clone'),
(100, 'fa fa-close'),
(101, 'fa fa-cloud'),
(102, 'fa fa-cloud-download'),
(103, 'fa fa-cloud-upload'),
(104, 'fa fa-code'),
(105, 'fa fa-code-fork'),
(106, 'fa fa-coffee'),
(107, 'fa fa-cog'),
(108, 'fa fa-cogs'),
(109, 'fa fa-comment'),
(110, 'fa fa-comment-o'),
(111, 'fa fa-commenting'),
(112, 'fa fa-commenting-o'),
(113, 'fa fa-comments'),
(114, 'fa fa-comments-o'),
(115, 'fa fa-compass'),
(116, 'fa fa-creative-commons'),
(117, 'fa fa-copyright'),
(118, 'fa fa-crop'),
(119, 'fa fa-credit-card'),
(120, 'fa fa-crosshairs'),
(121, 'fa fa-cube'),
(122, 'fa fa-cubes'),
(123, 'fa fa-cutlery'),
(124, 'fa fa-desktop'),
(125, 'fa fa-dashboard'),
(126, 'fa fa-database'),
(127, 'fa fa-dot-circle-o'),
(128, 'fa fa-diamond'),
(129, 'fa fa-download'),
(130, 'fa fa-ellipsis-v'),
(131, 'fa fa-envelope'),
(132, 'fa fa-edit'),
(133, 'fa fa-ellipsis-h'),
(134, 'fa fa-envelope-o'),
(135, 'fa fa-exchange'),
(136, 'fa fa-exclamation'),
(137, 'fa fa-exclamation-triangle'),
(138, 'fa fa-exclamation-circle'),
(139, 'fa fa-envelope-square'),
(140, 'fa fa-eraser'),
(141, 'fa fa-external-link'),
(142, 'fa fa-external-link-square'),
(143, 'fa fa-eye'),
(144, 'fa fa-eye-slash'),
(145, 'fa fa-eyedropper'),
(146, 'fa fa-fax'),
(147, 'fa fa-feed'),
(148, 'fa fa-female'),
(149, 'fa fa-fighter-jet'),
(150, 'fa fa-file-archive-o'),
(151, 'fa fa-file-audio-o'),
(152, 'fa fa-file-code-o'),
(153, 'fa fa-file-excel-o'),
(154, 'fa fa-file-image-o'),
(155, 'fa fa-file-movie-o'),
(156, 'fa fa-file-pdf-o'),
(157, 'fa fa-file-photo-o'),
(158, 'fa fa-file-picture-o'),
(159, 'fa fa-file-powerpoint-o'),
(160, 'fa fa-file-sound-o'),
(161, 'fa fa-file-video-o'),
(162, 'fa fa-file-word-o'),
(163, 'fa fa-file-zip-o'),
(164, 'fa fa-film'),
(165, 'fa fa-filter'),
(166, 'fa fa-fire'),
(167, 'fa fa-fire-extinguisher'),
(168, 'fa fa-flag'),
(169, 'fa fa-flag-checkered'),
(170, 'fa fa-flag-o'),
(171, 'fa fa-flash'),
(172, 'fa fa-flask'),
(173, 'fa fa-folder'),
(174, 'fa fa-folder-o'),
(175, 'fa fa-folder-open'),
(176, 'fa fa-folder-open-o'),
(177, 'fa fa-frown-o'),
(178, 'fa fa-futbol-o'),
(179, 'fa fa-gavel'),
(180, 'fa fa-gears'),
(181, 'fa fa-gamepad'),
(182, 'fa fa-gear'),
(183, 'fa fa-gift'),
(184, 'fa fa-globe'),
(185, 'fa fa-glass'),
(186, 'fa fa-graduation-cap'),
(187, 'fa fa-group'),
(188, 'fa fa-hand-grab-o'),
(189, 'fa fa-hand-lizard-o'),
(190, 'fa fa-hand-paper-o'),
(191, 'fa fa-hand-peace-o'),
(192, 'fa fa-hand-pointer-o'),
(193, 'fa fa-hand-rock-o'),
(194, 'fa fa-hand-scissors-o'),
(195, 'fa fa-hand-spock-o'),
(196, 'fa fa-hand-stop-o'),
(197, 'fa fa-hdd-o'),
(198, 'fa fa-headphones'),
(199, 'fa fa-heart'),
(200, 'fa fa-heart-o'),
(201, 'fa fa-heartbeat'),
(202, 'fa fa-history'),
(203, 'fa fa-home'),
(204, 'fa fa-hotel'),
(205, 'fa fa-hourglass'),
(206, 'fa fa-hourglass-1'),
(207, 'fa fa-hourglass-2'),
(208, 'fa fa-hourglass-3'),
(209, 'fa fa-hourglass-end'),
(210, 'fa fa-hourglass-half'),
(211, 'fa fa-hourglass-start'),
(212, 'fa fa-hourglass-o'),
(213, 'fa fa-inbox'),
(214, 'fa fa-i-cursor'),
(215, 'fa fa-image'),
(216, 'fa fa-info'),
(217, 'fa fa-info-circle'),
(218, 'fa fa-institution'),
(219, 'fa fa-industry'),
(220, 'fa fa-key'),
(221, 'fa fa-keyboard-o'),
(222, 'fa fa-language'),
(223, 'fa fa-laptop'),
(224, 'fa fa-leaf'),
(225, 'fa fa-legal'),
(226, 'fa fa-lemon-o'),
(227, 'fa fa-level-down'),
(228, 'fa fa-level-up'),
(229, 'fa fa-life-bouy'),
(230, 'fa fa-life-buoy'),
(231, 'fa fa-life-ring'),
(232, 'fa fa-life-saver'),
(233, 'fa fa-lightbulb-o'),
(234, 'fa fa-line-chart'),
(235, 'fa fa-location-arrow'),
(236, 'fa fa-lock'),
(237, 'fa fa-magic'),
(238, 'fa fa-magnet'),
(239, 'fa fa-mail-forward'),
(240, 'fa fa-mail-reply'),
(241, 'fa fa-mail-reply-all'),
(242, 'fa fa-male'),
(243, 'fa fa-map'),
(244, 'fa fa-map-marker'),
(245, 'fa fa-map-o'),
(246, 'fa fa-map-pin'),
(247, 'fa fa-map-signs'),
(248, 'fa fa-meh-o'),
(249, 'fa fa-microphone'),
(250, 'fa fa-microphone-slash'),
(251, 'fa fa-minus'),
(252, 'fa fa-minus-circle'),
(253, 'fa fa-minus-square'),
(254, 'fa fa-minus-square-o'),
(255, 'fa fa-mobile'),
(256, 'fa fa-mobile-phone'),
(257, 'fa fa-money'),
(258, 'fa fa-moon-o'),
(259, 'fa fa-mortar-board'),
(260, 'fa fa-motorcycle'),
(261, 'fa fa-mouse-pointer'),
(262, 'fa fa-music'),
(263, 'fa fa-navicon'),
(264, 'fa fa-newspaper-o'),
(265, 'fa fa-object-group'),
(266, 'fa fa-object-ungroup'),
(267, 'fa fa-paint-brush'),
(268, 'fa fa-paper-plane'),
(269, 'fa fa-paper-plane-o'),
(270, 'fa fa-paw'),
(271, 'fa fa-pencil'),
(272, 'fa fa-pencil-square'),
(273, 'fa fa-pencil-square-o'),
(274, 'fa fa-phone'),
(275, 'fa fa-phone-square'),
(276, 'fa fa-photo'),
(277, 'fa fa-picture-o'),
(278, 'fa fa-pie-chart'),
(279, 'fa fa-plane'),
(280, 'fa fa-plug'),
(281, 'fa fa-plus'),
(282, 'fa fa-plus-circle'),
(283, 'fa fa-plus-square'),
(284, 'fa fa-plus-square-o'),
(285, 'fa fa-power-off'),
(286, 'fa fa-print'),
(287, 'fa fa-puzzle-piece'),
(288, 'fa fa-qrcode'),
(289, 'fa fa-question'),
(290, 'fa fa-question-circle'),
(291, 'fa fa-quote-left'),
(292, 'fa fa-quote-right'),
(293, 'fa fa-random'),
(294, 'fa fa-recycle'),
(295, 'fa fa-refresh'),
(296, 'fa fa-registered'),
(297, 'fa fa-remove'),
(298, 'fa fa-reorder'),
(299, 'fa fa-reply-all'),
(300, 'fa fa-reply'),
(301, 'fa fa-retweet'),
(302, 'fa fa-road'),
(303, 'fa fa-rocket'),
(304, 'fa fa-rss'),
(305, 'fa fa-rss-square'),
(306, 'fa fa-search'),
(307, 'fa fa-search-minus'),
(308, 'fa fa-search-plus'),
(309, 'fa fa-send'),
(310, 'fa fa-server'),
(311, 'fa fa-send-o'),
(312, 'fa fa-share'),
(313, 'fa fa-share-alt'),
(314, 'fa fa-share-alt-square'),
(315, 'fa fa-share-square'),
(316, 'fa fa-share-square-o'),
(317, 'fa fa-ship'),
(318, 'fa fa-shield'),
(319, 'fa fa-shopping-cart'),
(320, 'fa fa-sign-in'),
(321, 'fa fa-signal'),
(322, 'fa fa-sitemap'),
(323, 'fa fa-sign-out'),
(324, 'fa fa-smile-o'),
(325, 'fa fa-sliders'),
(326, 'fa fa-sort'),
(327, 'fa fa-soccer-ball-o'),
(328, 'fa fa-sort-alpha-asc'),
(329, 'fa fa-sort-alpha-desc'),
(330, 'fa fa-sort-amount-asc'),
(331, 'fa fa-sort-amount-desc'),
(332, 'fa fa-sort-asc'),
(333, 'fa fa-sort-desc'),
(334, 'fa fa-sort-down'),
(335, 'fa fa-sort-numeric-asc'),
(336, 'fa fa-sort-up'),
(337, 'fa fa-sort-numeric-desc'),
(338, 'fa fa-spinner'),
(339, 'fa fa-space-shuttle'),
(340, 'fa fa-spoon'),
(341, 'fa fa-square'),
(342, 'fa fa-square-o'),
(343, 'fa fa-star'),
(344, 'fa fa-star-half'),
(345, 'fa fa-star-half-empty'),
(346, 'fa fa-star-half-full'),
(347, 'fa fa-star-half-o'),
(348, 'fa fa-star-o'),
(349, 'fa fa-sticky-note'),
(350, 'fa fa-sticky-note-o'),
(351, 'fa fa-street-view'),
(352, 'fa fa-suitcase'),
(353, 'fa fa-sun-o'),
(354, 'fa fa-support'),
(355, 'fa fa-tablet'),
(356, 'fa fa-tachometer'),
(357, 'fa fa-tag'),
(358, 'fa fa-tags'),
(359, 'fa fa-tasks'),
(360, 'fa fa-taxi'),
(361, 'fa fa-television'),
(362, 'fa fa-thumb-tack'),
(363, 'fa fa-terminal'),
(364, 'fa fa-thumbs-down'),
(365, 'fa fa-thumbs-o-down'),
(366, 'fa fa-thumbs-o-up'),
(367, 'fa fa-thumbs-up'),
(368, 'fa fa-ticket'),
(369, 'fa fa-times'),
(370, 'fa fa-times-circle'),
(371, 'fa fa-times-circle-o'),
(372, 'fa fa-tint'),
(373, 'fa fa-toggle-down'),
(374, 'fa fa-toggle-left'),
(375, 'fa fa-toggle-off'),
(376, 'fa fa-toggle-on'),
(377, 'fa fa-toggle-right'),
(378, 'fa fa-toggle-up'),
(379, 'fa fa-trademark'),
(380, 'fa fa-trash'),
(381, 'fa fa-trash-o'),
(382, 'fa fa-tree'),
(383, 'fa fa-trophy'),
(384, 'fa fa-truck'),
(385, 'fa fa-tty'),
(386, 'fa fa-tv'),
(387, 'fa fa-umbrella'),
(388, 'fa fa-university'),
(389, 'fa fa-unlock'),
(390, 'fa fa-unlock-alt'),
(391, 'fa fa-unsorted'),
(392, 'fa fa-upload'),
(393, 'fa fa-user'),
(394, 'fa fa-user-plus'),
(395, 'fa fa-user-secret'),
(396, 'fa fa-user-times'),
(397, 'fa fa-users'),
(398, 'fa fa-video-camera'),
(399, 'fa fa-volume-down'),
(400, 'fa fa-volume-off'),
(401, 'fa fa-volume-up'),
(402, 'fa fa-warning'),
(403, 'fa fa-wheelchair'),
(404, 'fa fa-wifi'),
(405, 'fa fa-wrench'),
(406, 'fa fa-hand-o-down'),
(407, 'fa fa-hand-o-left'),
(408, 'fa fa-hand-o-right'),
(409, 'fa fa-hand-o-up'),
(410, 'fa fa-ambulance'),
(411, 'fa fa-train'),
(412, 'fa fa-subway'),
(413, 'fa fa-mars-double'),
(414, 'fa fa-mars-stroke'),
(415, 'fa fa-mars'),
(416, 'fa fa-mars-stroke-v'),
(417, 'fa fa-genderless'),
(418, 'fa fa-intersex'),
(419, 'fa fa-mars-stroke-h'),
(420, 'fa fa-mercury'),
(421, 'fa fa-neuter'),
(422, 'fa fa-transgender'),
(423, 'fa fa-transgender-alt'),
(424, 'fa fa-venus'),
(425, 'fa fa-venus-double'),
(426, 'fa fa-venus-mars'),
(427, 'fa fa-file'),
(428, 'fa fa-file-o'),
(429, 'fa fa-file-text'),
(430, 'fa fa-file-text-o'),
(431, 'fa fa-cc-amex'),
(432, 'fa fa-cc-diners-club'),
(433, 'fa fa-cc-jcb'),
(434, 'fa fa-cc-mastercard'),
(435, 'fa fa-cc-stripe'),
(436, 'fa fa-cc-paypal'),
(437, 'fa fa-cc-visa'),
(438, 'fa fa-cc-discover'),
(439, 'fa fa-google-wallet'),
(440, 'fa fa-bitcoin'),
(441, 'fa fa-btc'),
(442, 'fa fa-cny'),
(443, 'fa fa-paypal'),
(444, 'fa fa-dollar'),
(445, 'fa fa-eur'),
(446, 'fa fa-euro'),
(447, 'fa fa-gbp'),
(448, 'fa fa-gg'),
(449, 'fa fa-gg-circle'),
(450, 'fa fa-ils'),
(451, 'fa fa-inr'),
(452, 'fa fa-jpy'),
(453, 'fa fa-krw'),
(454, 'fa fa-rmb'),
(455, 'fa fa-rouble'),
(456, 'fa fa-ruble'),
(457, 'fa fa-rub'),
(458, 'fa fa-shekel'),
(459, 'fa fa-rupee'),
(460, 'fa fa-sheqel'),
(461, 'fa fa-try'),
(462, 'fa fa-turkish-lira'),
(463, 'fa fa-usd'),
(464, 'fa fa-won'),
(465, 'fa fa-yen'),
(466, 'fa fa-align-center'),
(467, 'fa fa-align-justify'),
(468, 'fa fa-align-left'),
(469, 'fa fa-align-right'),
(470, 'fa fa-bold'),
(471, 'fa fa-chain-broken'),
(472, 'fa fa-clipboard'),
(473, 'fa fa-chain'),
(474, 'fa fa-columns'),
(475, 'fa fa-copy'),
(476, 'fa fa-cut'),
(477, 'fa fa-dedent'),
(478, 'fa fa-floppy-o'),
(479, 'fa fa-files-o'),
(480, 'fa fa-font'),
(481, 'fa fa-italic'),
(482, 'fa fa-link'),
(483, 'fa fa-list-alt'),
(484, 'fa fa-indent'),
(485, 'fa fa-header'),
(486, 'fa fa-list'),
(487, 'fa fa-list-ol'),
(488, 'fa fa-list-ul'),
(489, 'fa fa-outdent'),
(490, 'fa fa-paperclip'),
(491, 'fa fa-paragraph'),
(492, 'fa fa-paste'),
(493, 'fa fa-repeat'),
(494, 'fa fa-rotate-left'),
(495, 'fa fa-save'),
(496, 'fa fa-rotate-right'),
(497, 'fa fa-scissors'),
(498, 'fa fa-strikethrough'),
(499, 'fa fa-subscript'),
(500, 'fa fa-text-height'),
(501, 'fa fa-table'),
(502, 'fa fa-text-width'),
(503, 'fa fa-superscript'),
(504, 'fa fa-th'),
(505, 'fa fa-th-large'),
(506, 'fa fa-th-list'),
(507, 'fa fa-underline'),
(508, 'fa fa-angle-double-down'),
(509, 'fa fa-undo'),
(510, 'fa fa-angle-double-right'),
(511, 'fa fa-unlink'),
(512, 'fa fa-angle-double-up'),
(513, 'fa fa-angle-double-left'),
(514, 'fa fa-angle-left'),
(515, 'fa fa-angle-right'),
(516, 'fa fa-angle-up'),
(517, 'fa fa-angle-down'),
(518, 'fa fa-arrow-circle-down'),
(519, 'fa fa-arrow-circle-left'),
(520, 'fa fa-arrow-circle-o-down'),
(521, 'fa fa-arrow-circle-o-left'),
(522, 'fa fa-arrow-circle-o-right'),
(523, 'fa fa-arrow-circle-o-up'),
(524, 'fa fa-arrow-circle-right'),
(525, 'fa fa-arrow-circle-up'),
(526, 'fa fa-arrow-down'),
(527, 'fa fa-arrow-left'),
(528, 'fa fa-arrow-up'),
(529, 'fa fa-arrow-right'),
(530, 'fa fa-caret-right'),
(531, 'fa fa-caret-down'),
(532, 'fa fa-caret-left'),
(533, 'fa fa-arrows-alt'),
(534, 'fa fa-chevron-circle-down'),
(535, 'fa fa-chevron-circle-left'),
(536, 'fa fa-chevron-circle-right'),
(537, 'fa fa-caret-up'),
(538, 'fa fa-chevron-down'),
(539, 'fa fa-chevron-circle-up'),
(540, 'fa fa-chevron-right'),
(541, 'fa fa-chevron-up'),
(542, 'fa fa-chevron-left'),
(543, 'fa fa-long-arrow-left'),
(544, 'fa fa-long-arrow-right'),
(545, 'fa fa-long-arrow-up'),
(546, 'fa fa-eject'),
(547, 'fa fa-long-arrow-down'),
(548, 'fa fa-expand'),
(549, 'fa fa-compress'),
(550, 'fa fa-fast-backward'),
(551, 'fa fa-fast-forward'),
(552, 'fa fa-forward'),
(553, 'fa fa-pause'),
(554, 'fa fa-backward'),
(555, 'fa fa-play-circle'),
(556, 'fa fa-play'),
(557, 'fa fa-play-circle-o'),
(558, 'fa fa-step-forward'),
(559, 'fa fa-step-backward'),
(560, 'fa fa-youtube-play'),
(561, 'fa fa-500px'),
(562, 'fa fa-stop'),
(563, 'fa fa-adn'),
(564, 'fa fa-android'),
(565, 'fa fa-amazon'),
(566, 'fa fa-angellist'),
(567, 'fa fa-apple'),
(568, 'fa fa-behance'),
(569, 'fa fa-behance-square'),
(570, 'fa fa-bitbucket'),
(571, 'fa fa-bitbucket-square'),
(572, 'fa fa-black-tie'),
(573, 'fa fa-buysellads'),
(574, 'fa fa-chrome'),
(575, 'fa fa-connectdevelop'),
(576, 'fa fa-css3'),
(577, 'fa fa-codepen'),
(578, 'fa fa-deviantart'),
(579, 'fa fa-delicious'),
(580, 'fa fa-dashcube'),
(581, 'fa fa-digg'),
(582, 'fa fa-contao'),
(583, 'fa fa-dribbble'),
(584, 'fa fa-dropbox'),
(585, 'fa fa-drupal'),
(586, 'fa fa-empire'),
(587, 'fa fa-expeditedssl'),
(588, 'fa fa-facebook'),
(589, 'fa fa-facebook-square'),
(590, 'fa fa-facebook-official'),
(591, 'fa fa-facebook-f'),
(592, 'fa fa-firefox'),
(593, 'fa fa-fonticons'),
(594, 'fa fa-flickr'),
(595, 'fa fa-forumbee'),
(596, 'fa fa-foursquare'),
(597, 'fa fa-ge'),
(598, 'fa fa-get-pocket'),
(599, 'fa fa-git'),
(600, 'fa fa-github'),
(601, 'fa fa-github-alt'),
(602, 'fa fa-github-square'),
(603, 'fa fa-gittip'),
(604, 'fa fa-git-square'),
(605, 'fa fa-google-plus'),
(606, 'fa fa-google'),
(607, 'fa fa-google-plus-square'),
(608, 'fa fa-gratipay'),
(609, 'fa fa-hacker-news'),
(610, 'fa fa-houzz'),
(611, 'fa fa-html5'),
(612, 'fa fa-instagram'),
(613, 'fa fa-internet-explorer'),
(614, 'fa fa-ioxhost'),
(615, 'fa fa-joomla'),
(616, 'fa fa-jsfiddle'),
(617, 'fa fa-lastfm'),
(618, 'fa fa-lastfm-square'),
(619, 'fa fa-leanpub'),
(620, 'fa fa-linkedin'),
(621, 'fa fa-linkedin-square'),
(622, 'fa fa-linux'),
(623, 'fa fa-maxcdn'),
(624, 'fa fa-meanpath'),
(625, 'fa fa-medium'),
(626, 'fa fa-odnoklassniki'),
(627, 'fa fa-odnoklassniki-square'),
(628, 'fa fa-opencart'),
(629, 'fa fa-opera'),
(630, 'fa fa-openid'),
(631, 'fa fa-pagelines'),
(632, 'fa fa-optin-monster'),
(633, 'fa fa-pied-piper-alt'),
(634, 'fa fa-pinterest'),
(635, 'fa fa-pied-piper'),
(636, 'fa fa-pinterest-p'),
(637, 'fa fa-pinterest-square'),
(638, 'fa fa-qq'),
(639, 'fa fa-ra'),
(640, 'fa fa-rebel'),
(641, 'fa fa-reddit-square'),
(642, 'fa fa-renren'),
(643, 'fa fa-reddit'),
(644, 'fa fa-safari'),
(645, 'fa fa-sellsy'),
(646, 'fa fa-shirtsinbulk'),
(647, 'fa fa-simplybuilt'),
(648, 'fa fa-skyatlas'),
(649, 'fa fa-soundcloud'),
(650, 'fa fa-skype'),
(651, 'fa fa-spotify'),
(652, 'fa fa-slideshare'),
(653, 'fa fa-stack-exchange'),
(654, 'fa fa-slack'),
(655, 'fa fa-stack-overflow'),
(656, 'fa fa-steam'),
(657, 'fa fa-steam-square'),
(658, 'fa fa-stumbleupon'),
(659, 'fa fa-stumbleupon-circle'),
(660, 'fa fa-tencent-weibo'),
(661, 'fa fa-trello'),
(662, 'fa fa-tripadvisor'),
(663, 'fa fa-tumblr'),
(664, 'fa fa-twitch'),
(665, 'fa fa-tumblr-square'),
(666, 'fa fa-twitter'),
(667, 'fa fa-twitter-square'),
(668, 'fa fa-viacoin'),
(669, 'fa fa-vimeo'),
(670, 'fa fa-vimeo-square'),
(671, 'fa fa-vk'),
(672, 'fa fa-weibo'),
(673, 'fa fa-wechat'),
(674, 'fa fa-vine'),
(675, 'fa fa-whatsapp'),
(676, 'fa fa-wikipedia-w'),
(677, 'fa fa-weixin'),
(678, 'fa fa-windows'),
(679, 'fa fa-wordpress'),
(680, 'fa fa-xing'),
(681, 'fa fa-xing-square'),
(682, 'fa fa-y-combinator'),
(683, 'fa fa-y-combinator-square'),
(684, 'fa fa-yahoo'),
(685, 'fa fa-yc'),
(686, 'fa fa-yc-square'),
(687, 'fa fa-yelp'),
(688, 'fa fa-youtube'),
(689, 'fa fa-youtube-square'),
(690, 'fa fa-h-square'),
(691, 'fa fa-hospital-o'),
(692, 'fa fa-medkit'),
(693, 'fa fa-user-md'),
(694, 'fa fa-stethoscope');

-- --------------------------------------------------------

--
-- Table structure for table `imagealbum`
--

CREATE TABLE `imagealbum` (
  `album_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagealbum`
--

INSERT INTO `imagealbum` (`album_id`, `image_id`) VALUES
(1, 1),
(3, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `imagedetail`
--

CREATE TABLE `imagedetail` (
  `image_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT '1',
  `images_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `images_link` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `images_summary` varchar(500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `imagedetail`
--

INSERT INTO `imagedetail` (`image_id`, `country_id`, `images_name`, `images_link`, `images_summary`) VALUES
(1, 1, '#', '', ''),
(2, 1, '#', '', ''),
(4, 1, '#', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) NOT NULL DEFAULT '0',
  `primary` int(1) NOT NULL DEFAULT '0',
  `value` varchar(20) DEFAULT NULL,
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `alt` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `date_create`, `user_id`, `status`, `weight`, `primary`, `value`, `tmp_id`, `alt`) VALUES
(1, '379da18dae6942e9945c20e063cd5236.png', NULL, 1, 1, 1, 0, 'banner', 0, ''),
(2, 'e8b78c26463b9458977512ac1c6a497f.jpg', NULL, 1, 1, 1, 0, 'banner', 0, ''),
(3, '1686aba27dd5c7ad91caa93f66484527.jpg', NULL, NULL, 1, 0, 0, 'item', 1, ''),
(4, '2c102f0b3933d7926b7e1a9c2ab99202.png', NULL, 1, 1, 1, 0, 'banner', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_code` varchar(150) DEFAULT NULL,
  `item_view` int(11) NOT NULL DEFAULT '0',
  `item_status` tinyint(1) NOT NULL DEFAULT '1',
  `item_weight` int(11) NOT NULL DEFAULT '0',
  `date_create` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_type` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `value` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `number` int(11) NOT NULL DEFAULT '0',
  `choose_upload` int(1) NOT NULL DEFAULT '1',
  `picture` varchar(300) DEFAULT NULL,
  `alt_picture` varchar(200) DEFAULT NULL,
  `item_hot` int(11) NOT NULL,
  `promotion` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_code`, `item_view`, `item_status`, `item_weight`, `date_create`, `user_id`, `item_type`, `supplier_id`, `value`, `price`, `number`, `choose_upload`, `picture`, `alt_picture`, `item_hot`, `promotion`) VALUES
(1, 'P_71ACL_1', 0, 1, 1, '2016-12-23 08:58:32', 1, 0, 0, 0, 130000, 1, 1, '3b141500b635db3b10621b14aae0511d.jpg', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemdetail`
--

CREATE TABLE `itemdetail` (
  `item_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT '1',
  `item_name` varchar(250) DEFAULT NULL,
  `item_link` varchar(250) DEFAULT NULL,
  `item_description` text,
  `active` int(1) NOT NULL DEFAULT '1',
  `item_summary` text,
  `item_info` text,
  `item_video` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemdetail`
--

INSERT INTO `itemdetail` (`item_id`, `country_id`, `item_name`, `item_link`, `item_description`, `active`, `item_summary`, `item_info`, `item_video`) VALUES
(1, 1, 'Apple Watch Sport 42mm Series 2 - Gold - Caramel Nylon Band', 'apple-watch-sport-42mm-series-2-gold-caramel-nylon-band', '<p>werwer</p>', 1, '<p>fwer</p>\r\n', NULL, '<p>werwer</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`category_id`, `item_id`) VALUES
(10, 1),
(7, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_doc`
--

CREATE TABLE `item_doc` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `doc_name` varchar(300) DEFAULT NULL,
  `doc_file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_status`
--

CREATE TABLE `item_status` (
  `id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_status`
--

INSERT INTO `item_status` (`id`, `weight`, `status`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_statusdetail`
--

CREATE TABLE `item_statusdetail` (
  `item_status_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `item_status_name` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_statusdetail`
--

INSERT INTO `item_statusdetail` (`item_status_id`, `country_id`, `item_status_name`) VALUES
(1, 1, 'Mới'),
(2, 1, 'Nổi bật');

-- --------------------------------------------------------

--
-- Table structure for table `item_tmp`
--

CREATE TABLE `item_tmp` (
  `item_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `hot` int(1) NOT NULL DEFAULT '0',
  `picture` varchar(200) DEFAULT NULL,
  `sale` int(1) NOT NULL DEFAULT '0',
  `hot_tour` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locationdetail`
--

CREATE TABLE `locationdetail` (
  `location_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `location_name` varchar(250) DEFAULT NULL,
  `location_link` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location_tmp`
--

CREATE TABLE `location_tmp` (
  `location_id` int(11) NOT NULL DEFAULT '0',
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meta_seo`
--

CREATE TABLE `meta_seo` (
  `id` int(11) NOT NULL,
  `name_seo` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(180) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_descriptions` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meta_seo`
--

INSERT INTO `meta_seo` (`id`, `name_seo`, `meta_keywords`, `meta_descriptions`, `country_id`, `tmp_id`, `value`) VALUES
(1, '', '', '', 1, 10, 'category'),
(2, '', '', '', 1, 1, 'item');

-- --------------------------------------------------------

--
-- Table structure for table `od_order`
--

CREATE TABLE `od_order` (
  `id` int(11) NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `buyer_id` int(11) NOT NULL DEFAULT '0',
  `code_booking` varchar(30) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `landline` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `notice` varchar(300) DEFAULT NULL,
  `require_special` varchar(300) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `ship` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `od_order_item`
--

CREATE TABLE `od_order_item` (
  `id_order` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `p_name` varchar(200) DEFAULT NULL,
  `options` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_history`
--

CREATE TABLE `online_history` (
  `users_id` int(11) DEFAULT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `online_history`
--

INSERT INTO `online_history` (`users_id`, `last_login`) VALUES
(1, 1482397505),
(1, 1482474770),
(1, 1482718185),
(1, 1482743663);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name_vn` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `name_en` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_img`
--

CREATE TABLE `other_img` (
  `item_id` int(11) NOT NULL,
  `img_id` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supportdetail`
--

CREATE TABLE `supportdetail` (
  `support_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `support_name` varchar(250) DEFAULT NULL,
  `support_link` varchar(250) DEFAULT NULL,
  `support_phone` varchar(50) DEFAULT NULL,
  `support_nick` varchar(100) DEFAULT NULL,
  `support_skype` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_permission`
--

CREATE TABLE `table_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `link` varchar(500) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tagsdetail`
--

CREATE TABLE `tagsdetail` (
  `tags_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `tags_name` varchar(250) DEFAULT NULL,
  `tags_link` varchar(350) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag_tmp`
--

CREATE TABLE `tag_tmp` (
  `tag_id` int(11) NOT NULL DEFAULT '0',
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_loginname` varchar(50) NOT NULL DEFAULT '-1',
  `user_password` varchar(100) NOT NULL DEFAULT '-1',
  `user_name` varchar(100) NOT NULL DEFAULT '-1',
  `user_birthday` date DEFAULT NULL,
  `user_note` text NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_date` datetime DEFAULT NULL,
  `user_modify` datetime DEFAULT NULL,
  `per` varchar(500) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_address` varchar(300) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `permission` text,
  `store_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_loginname`, `user_password`, `user_name`, `user_birthday`, `user_note`, `user_status`, `user_date`, `user_modify`, `per`, `user_email`, `user_address`, `user_phone`, `type`, `permission`, `store_id`) VALUES
(1, 'spadmin', '15490e55ddbff58b1a6d802949125e5c', 'Super Admin', '1988-09-02', '', 1, '2012-10-13 09:10:11', '2012-10-13 09:10:12', 'a:1:{i:0;s:4:"full";}', NULL, NULL, NULL, 2, 'view,add,edit,delete', 0),
(4, 'admin', 'df10ef8509dc176d733d59549e7dbfaf', 'Admin', '1988-09-02', '', 1, '2012-10-13 09:10:11', '2013-03-20 14:44:27', 'a:1:{i:0;s:4:"full";}', 'admin@yahoo.com', '0', '0', 2, 'dmlld19hcnRpY2xlXzEsYWRkX2FydGljbGVfMSxlZGl0X2FydGljbGVfMSxkZWxldGVfYXJ0aWNsZV8xLHZpZXdfYXJ0aWNsZV8yLGFkZF9hcnRpY2xlXzIsZWRpdF9hcnRpY2xlXzIsZGVsZXRlX2FydGljbGVfMix2aWV3X2Jhbm5lcixhZGRfYmFubmVyLGVkaXRfYmFubmVyLGRlbGV0ZV9iYW5uZXIsdmlld19ob3RlbCxhZGRfaG90ZWwsZWRpdF9ob3RlbCxkZWxldGVfaG90ZWwsdmlld190b3VyLGFkZF90b3VyLGVkaXRfdG91cixkZWxldGVfdG91cix2aWV3X2xvY2F0aW9uXzEsYWRkX2xvY2F0aW9uXzEsZWRpdF9sb2NhdGlvbl8xLGRlbGV0ZV9sb2NhdGlvbl8xLHZpZXdfc3VwcG9ydCxhZGRfc3VwcG9ydCxlZGl0X3N1cHBvcnQsZGVsZXRlX3N1cHBvcnQsdmlld19jb250YWN0LGFkZF9jb250YWN0LGVkaXRfY29udGFjdCxkZWxldGVfY29udGFjdCx2aWV3X3RhZ3MsYWRkX3RhZ3MsZWRpdF90YWdzLGRlbGV0ZV90YWdzLHZpZXdfdXRpbGl0eSxhZGRfdXRpbGl0eSxlZGl0X3V0aWxpdHksZGVsZXRlX3V0aWxpdHksdmlld19leHRyYV9zZXJ2aWNlcyxhZGRfZXh0cmFfc2VydmljZXMsZWRpdF9leHRyYV9zZXJ2aWNlcyxkZWxldGVfZXh0cmFfc2VydmljZXMsdmlld19vcmRlcixhZGRfb3JkZXIsZWRpdF9vcmRlcixkZWxldGVfb3JkZXIsdmlld19hbGJ1bSxhZGRfYWxidW0sZWRpdF9hbGJ1bSxkZWxldGVfYWxidW0sdmlld192aWRlb18xLGFkZF92aWRlb18xLGVkaXRfdmlkZW9fMSxkZWxldGVfdmlkZW9fMSx2aWV3X2NhdGVfdmlkZW9fMSxhZGRfY2F0ZV92aWRlb18xLGVkaXRfY2F0ZV92aWRlb18xLGRlbGV0ZV9jYXRlX3ZpZGVvXzEsdmlld19jYXRlZ29yeV8xLGFkZF9jYXRlZ29yeV8xLGVkaXRfY2F0ZWdvcnlfMSxkZWxldGVfY2F0ZWdvcnlfMSx2aWV3X2NhdGVnb3J5XzIsYWRkX2NhdGVnb3J5XzIsZWRpdF9jYXRlZ29yeV8yLGRlbGV0ZV9jYXRlZ29yeV8yLHZpZXdfaXRlbSxhZGRfaXRlbSxlZGl0X2l0ZW0sZGVsZXRlX2l0ZW0=', 0),
(7, 'phamphong', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Thanh Phong', NULL, '', 1, NULL, NULL, NULL, 'it.phamphong@gmail.com', '0', '0', 1, 'dmlld19hcnRpY2xlXzEsZWRpdF9hcnRpY2xlXzEsZGVsZXRlX2FydGljbGVfMSx2aWV3X2FydGljbGVfMix2aWV3X2FydGljbGVfMyxhZGRfYXJ0aWNsZV8zLHZpZXdfbG9jYXRpb25fMSx2aWV3X2NvbnRhY3Qsdmlld19vcmRlcixlZGl0X29yZGVy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `id` int(11) NOT NULL,
  `link` varchar(500) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `termdetail`
--

CREATE TABLE `termdetail` (
  `term_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `term_name` varchar(250) DEFAULT NULL,
  `term_link` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_banner`
--

CREATE TABLE `tmp_banner` (
  `id` int(11) NOT NULL,
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `banner_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tmp_banner`
--

INSERT INTO `tmp_banner` (`id`, `tmp_id`, `banner_id`) VALUES
(10, 10, 1),
(13, 9, 2),
(14, 9, 4),
(15, 7, 4),
(16, 6, 4),
(17, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_detail`
--

CREATE TABLE `tmp_detail` (
  `id` int(11) NOT NULL,
  `tmp_id` int(11) NOT NULL DEFAULT '0',
  `value` text COLLATE utf8_unicode_ci,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `title` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_item_status`
--

CREATE TABLE `tmp_item_status` (
  `status_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_item_status`
--

INSERT INTO `tmp_item_status` (`status_id`, `item_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_modules`
--

CREATE TABLE `tmp_modules` (
  `location_id` int(11) NOT NULL DEFAULT '0',
  `value` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone` int(11) NOT NULL,
  `landline` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `zip_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `sex` int(1) NOT NULL DEFAULT '0' COMMENT 'women->1, men->2',
  `buyer_id` int(11) NOT NULL DEFAULT '0' COMMENT 'buyer or recipient',
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_date_login` int(11) DEFAULT NULL,
  `count_login` int(11) NOT NULL DEFAULT '0',
  `code_member` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmnd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `special` int(11) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_graduated` text COLLATE utf8_unicode_ci,
  `certificate` int(1) NOT NULL DEFAULT '0',
  `hours` int(11) NOT NULL DEFAULT '0',
  `price_hours` int(11) NOT NULL DEFAULT '0',
  `type_teach` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `major` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `age` int(11) DEFAULT NULL,
  `user_repair` int(11) NOT NULL DEFAULT '0',
  `facebook` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usersdetail`
--

CREATE TABLE `usersdetail` (
  `users_id` int(11) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL DEFAULT '0',
  `info` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usersession`
--

CREATE TABLE `usersession` (
  `id` varchar(100) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `userAgent` varchar(255) NOT NULL,
  `ipAdd` varchar(20) NOT NULL,
  `ses_start` int(10) NOT NULL,
  `lastVisit` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_online`
--

CREATE TABLE `user_online` (
  `session` char(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `date_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_online`
--

INSERT INTO `user_online` (`session`, `time`, `date_time`) VALUES
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('f7cuqcmq09ok9a5ggqg7iaeil5', 1468915214, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('f7cuqcmq09ok9a5ggqg7iaeil5', 1468916971, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468916986, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468917030, '2016-07-19'),
('f7cuqcmq09ok9a5ggqg7iaeil5', 1468917250, '2016-07-19'),
('f7cuqcmq09ok9a5ggqg7iaeil5', 1468917270, '2016-07-19'),
('f7cuqcmq09ok9a5ggqg7iaeil5', 1468917314, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468919667, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468920280, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468920851, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468920881, '2016-07-19'),
('cli6hjl9vf47h6ng67jkti7fn6', 1468920901, '2016-07-19'),
('adku2gmara2soro4him1rtd2o7', 1468981239, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468983548, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468983556, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468983574, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468983577, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468983584, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468983683, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468990847, '2016-07-20'),
('adku2gmara2soro4him1rtd2o7', 1468990850, '2016-07-20'),
('6fftlfhr9qsurg17ehruontpc2', 1469068060, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469072817, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469078927, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469079193, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469079194, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469079196, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469079197, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469079198, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469081790, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469082894, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469083188, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469083190, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469083192, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469083194, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469083277, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469083279, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469088308, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469088311, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469088314, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469088322, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469089406, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469089437, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469089440, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469089458, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469089459, '2016-07-21'),
('6fftlfhr9qsurg17ehruontpc2', 1469089460, '2016-07-21'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160471, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160471, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160471, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160471, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160472, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160473, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160477, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469160479, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469162174, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469162745, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469169608, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469169610, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469169757, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469169758, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469170201, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469170203, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469171472, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469171473, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469171474, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469173453, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469173454, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469173507, '2016-07-22'),
('9bakb23k3f81hmjdp6lhdcenh2', 1469173510, '2016-07-22'),
('tpna6ll0onknu6la9emig4a5q1', 1469415299, '2016-07-25'),
('nldfabbrt5a5cu44q86so84l75', 1469517634, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517641, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517643, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517659, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517661, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517722, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517728, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517778, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517782, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469517784, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469525363, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469525483, '2016-07-26'),
('nldfabbrt5a5cu44q86so84l75', 1469527892, '2016-07-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_extra`
--
ALTER TABLE `company_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_language`
--
ALTER TABLE `config_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_letter`
--
ALTER TABLE `email_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `font_awesome`
--
ALTER TABLE `font_awesome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_doc`
--
ALTER TABLE `item_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_status`
--
ALTER TABLE `item_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tmp`
--
ALTER TABLE `item_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_seo`
--
ALTER TABLE `meta_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `od_order`
--
ALTER TABLE `od_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_permission`
--
ALTER TABLE `table_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_banner`
--
ALTER TABLE `tmp_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_detail`
--
ALTER TABLE `tmp_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersession`
--
ALTER TABLE `usersession`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `company_extra`
--
ALTER TABLE `company_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `config_language`
--
ALTER TABLE `config_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `email_letter`
--
ALTER TABLE `email_letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `font_awesome`
--
ALTER TABLE `font_awesome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=695;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_doc`
--
ALTER TABLE `item_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_status`
--
ALTER TABLE `item_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_tmp`
--
ALTER TABLE `item_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meta_seo`
--
ALTER TABLE `meta_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `od_order`
--
ALTER TABLE `od_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_permission`
--
ALTER TABLE `table_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmp_banner`
--
ALTER TABLE `tmp_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tmp_detail`
--
ALTER TABLE `tmp_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
