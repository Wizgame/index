-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:80
-- Generation Time: Feb 15, 2015 at 09:17 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wizgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `home_chat`
--

CREATE TABLE IF NOT EXISTS `home_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` text NOT NULL,
  `content` text NOT NULL,
  `home_type` text NOT NULL,
  `home_id` int(11) NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `home_chat`
--

INSERT INTO `home_chat` (`id`, `by`, `content`, `home_type`, `home_id`, `date`) VALUES
(1, 'masu', 'Hallo', '0', 1, '2015-01-04 13:17:48'),
(2, 'masu', 'test', '0', 1, '2015-01-04 19:44:17'),
(3, 'masu', 'Andre ganteng', '0', 1, '2015-01-06 06:47:30'),
(4, 'masu', 'test', '0', 1, '2015-01-17 03:23:47'),
(5, 'masu', 'hohoho', '0', 1, '2015-01-26 08:19:06'),
(6, 'masu', 'Sesuatu', '0', 1, '2015-02-06 10:03:57'),
(7, 'masu', 'jj', '0', 1, '2015-02-06 10:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE IF NOT EXISTS `hostel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `energy_per_hour` int(11) NOT NULL DEFAULT '100',
  `total_occupants` int(11) NOT NULL,
  `max_occupants` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`id`, `name`, `energy_per_hour`, `total_occupants`, `max_occupants`, `type`) VALUES
(1, 'Asrama Nomor 1', 100, 2, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hostel_occupant`
--

CREATE TABLE IF NOT EXISTS `hostel_occupant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occupant` text NOT NULL,
  `hostel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hostel_occupant`
--

INSERT INTO `hostel_occupant` (`id`, `occupant`, `hostel`) VALUES
(1, 'masu', 1),
(2, 'arief', 1);

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `owner` int(11) NOT NULL,
  `max_photos` int(11) NOT NULL,
  `energy_per_hour` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `house_occupant`
--

CREATE TABLE IF NOT EXISTS `house_occupant` (
  `id` int(11) NOT NULL,
  `occupant` int(11) NOT NULL,
  `house` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `level`) VALUES
('masu', '$login=m2a9s5u1997;', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by_user` text NOT NULL,
  `for_user` text NOT NULL,
  `content` text NOT NULL,
  `datetime` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `by_user`, `for_user`, `content`, `datetime`, `status`) VALUES
(1, 'arief', 'masu', 'hallo', '2015-01-04 13:17:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_status`
--

CREATE TABLE IF NOT EXISTS `online_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_active` text NOT NULL,
  `time_now` text NOT NULL,
  `initial` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `master` text NOT NULL,
  `max_member` int(11) NOT NULL,
  `energy` int(11) NOT NULL,
  `max_photos` int(11) NOT NULL,
  `logo` text NOT NULL,
  `date_created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization_member`
--

CREATE TABLE IF NOT EXISTS `organization_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `job` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initial` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL,
  `birthday` text NOT NULL,
  `level` int(5) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '200',
  `energy` int(11) NOT NULL DEFAULT '100',
  `max_energy` int(11) NOT NULL DEFAULT '100',
  `avatar_photo` text NOT NULL,
  `date_created` text NOT NULL,
  `time_active` text NOT NULL,
  `online_status` text NOT NULL,
  `lv_mtk` int(11) NOT NULL DEFAULT '1',
  `exp_mtk` int(11) NOT NULL,
  `lv_fisika` int(11) NOT NULL DEFAULT '1',
  `exp_fisika` int(11) NOT NULL,
  `lv_biologi` int(11) NOT NULL DEFAULT '1',
  `exp_biologi` int(11) NOT NULL,
  `lv_komputer_Informatika` int(11) NOT NULL DEFAULT '1',
  `exp_komputer_Informatika` int(11) NOT NULL,
  `lv_sejarah` int(11) NOT NULL DEFAULT '1',
  `exp_sejarah` int(11) NOT NULL,
  `lv_kimia` int(11) NOT NULL DEFAULT '1',
  `exp_kimia` int(11) NOT NULL,
  `lv_antropologi` int(11) NOT NULL DEFAULT '1',
  `exp_antropologi` int(11) NOT NULL,
  `lv_ilmu_bumi` int(11) NOT NULL DEFAULT '1',
  `exp_ilmu_bumi` int(11) NOT NULL,
  `lv_ekonomi` int(11) NOT NULL DEFAULT '1',
  `exp_ekonomi` int(11) NOT NULL,
  `lv_ilmu_politik` int(11) NOT NULL DEFAULT '1',
  `exp_ilmu_politik` int(11) NOT NULL,
  `lv_sosiologi` int(11) NOT NULL DEFAULT '1',
  `exp_sosiologi` int(11) NOT NULL,
  `lv_psikologi` int(11) NOT NULL DEFAULT '1',
  `exp_psikologi` int(11) NOT NULL,
  `lv_teknik_rekayasa` int(11) NOT NULL DEFAULT '1',
  `exp_teknik_rekayasa` int(11) NOT NULL,
  `quote` longtext NOT NULL,
  `about` mediumtext NOT NULL,
  `show_info` int(11) NOT NULL DEFAULT '0',
  `rank_mtk` int(11) NOT NULL,
  `rank_fisika` int(11) NOT NULL,
  `rank_biologi` int(11) NOT NULL,
  `rank_komputer_informatika` int(11) NOT NULL,
  `rank_sejarah` int(11) NOT NULL,
  `rank_kimia` int(11) NOT NULL,
  `rank_antropologi` int(11) NOT NULL,
  `rank_ilmu_bumi` int(11) NOT NULL,
  `rank_ekonomi` int(11) NOT NULL,
  `rank_ilmu_politik` int(11) NOT NULL,
  `rank_sosiologi` int(11) NOT NULL,
  `rank_psikologi` int(11) NOT NULL,
  `rank_teknik_rekayasa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `initial`, `email`, `password`, `name`, `gender`, `birthday`, `level`, `exp`, `gold`, `energy`, `max_energy`, `avatar_photo`, `date_created`, `time_active`, `online_status`, `lv_mtk`, `exp_mtk`, `lv_fisika`, `exp_fisika`, `lv_biologi`, `exp_biologi`, `lv_komputer_Informatika`, `exp_komputer_Informatika`, `lv_sejarah`, `exp_sejarah`, `lv_kimia`, `exp_kimia`, `lv_antropologi`, `exp_antropologi`, `lv_ilmu_bumi`, `exp_ilmu_bumi`, `lv_ekonomi`, `exp_ekonomi`, `lv_ilmu_politik`, `exp_ilmu_politik`, `lv_sosiologi`, `exp_sosiologi`, `lv_psikologi`, `exp_psikologi`, `lv_teknik_rekayasa`, `exp_teknik_rekayasa`, `quote`, `about`, `show_info`, `rank_mtk`, `rank_fisika`, `rank_biologi`, `rank_komputer_informatika`, `rank_sejarah`, `rank_kimia`, `rank_antropologi`, `rank_ilmu_bumi`, `rank_ekonomi`, `rank_ilmu_politik`, `rank_sosiologi`, `rank_psikologi`, `rank_teknik_rekayasa`) VALUES
(1, 'masu', 'masu.programmer@gmail.com', 'e23bdc15f6bbfbebe9fb5ff1ee0b7128', 'arief setyo', 'male', '1997-5-29', 1, 70, 450, 10, 100, 'WZ9QWRAO0A', '30-12-2014 19:56', '2015-02-15 20:56:31', '', 2, 10, 1, 0, 1, 10, 1, 0, 1, 30, 1, 0, 1, 0, 1, 10, 1, 10, 1, 0, 1, 10, 1, 0, 1, 0, '"Bukan untuk mejadi yang terbaik melainkan untuk melakukan yang terbaik"', 'Seorang pelajar SMA yang punya hobi ngoding', 1, 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'arief', 'masu.programmer@gmail.com', 'e23bdc15f6bbfbebe9fb5ff1ee0b7128', 'arief setyo', 'male', '', 1, 0, 0, 100, 100, 'V2EFQD7VHS', '01-01-2015 12:20', '2015-01-04 07:59:21', '', 3, 100, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, '', '', 0, 1, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

CREATE TABLE IF NOT EXISTS `quest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` text NOT NULL,
  `quest` text NOT NULL,
  `answer` text NOT NULL,
  `created_by` text NOT NULL,
  `exp` int(11) NOT NULL DEFAULT '10',
  `gold` int(11) NOT NULL DEFAULT '10',
  `energy` int(11) NOT NULL DEFAULT '10',
  `winner` text NOT NULL,
  `wrong` int(11) NOT NULL,
  `datetime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`id`, `category`, `quest`, `answer`, `created_by`, `exp`, `gold`, `energy`, `winner`, `wrong`, `datetime`) VALUES
(1, 'komputer_informatika', 'Siapa Pendiri Apple?                                        ', 'Steve Jobs', 'masu', 10, 10, 10, 'masu', 2, '2015-01-22 21:26:28'),
(2, 'komputer_informatika', ' Siapa pembuat linux?                                      ', 'linus trovalds', 'masu', 10, 10, 10, 'masu', 2, '2015-01-24 07:36:25'),
(3, 'mtk', '2+3=...?', '5', 'masu', 10, 10, 10, 'masu', 3, '2015-01-24 07:52:26'),
(4, 'mtk', '7x2=...?', '14', 'masu', 10, 10, 10, 'masu', 2, '2015-01-24 08:09:29'),
(5, 'mtk', '7+2=...?                                        ', '9', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 14:52:53'),
(6, 'mtk', '7+7=..?                                        ', '14', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 14:56:52'),
(7, 'mtk', '8+8                                       ', '16', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 14:59:27'),
(8, 'mtk', '9+9=..?                                        ', '18', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:00:21'),
(9, 'mtk', '20+20=..?                                        ', '40', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:02:12'),
(10, 'mtk', '7+7=..?                                        ', '14', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:07:28'),
(11, 'mtk', '7+7=..?                                        ', '14', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:11:34'),
(12, 'mtk', '7+7=..?                                        ', '14', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:38:19'),
(13, 'mtk', '7+7                                        ', '14', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:40:16'),
(14, 'mtk', '8+8                                        ', '16', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:41:31'),
(15, 'mtk', '5+5                                        ', '10', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:42:56'),
(16, 'mtk', ' 2+2=..?                                      ', '4', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:44:01'),
(17, 'mtk', '  2+3                                      ', '5', 'masu', 10, 10, 10, 'masu', 0, '2015-01-26 15:45:32'),
(18, 'mtk', '     8-9x2/1=...?                                   ', '-10', 'masu', 10, 10, 10, 'masu', 1, '2015-01-30 14:05:40'),
(19, 'sosiologi', 'siapakah yang menjadi agen utama dalam sosiologi ?', 'manusia', 'masu', 10, 10, 10, 'masu', 0, '2015-02-02 09:04:36'),
(20, 'sejarah', 'siapa penemu benua amerika?\r\n', 'christoper colombus', 'masu', 10, 10, 10, 'masu', 0, '2015-02-02 09:07:28'),
(21, 'sejarah', 'kapan indonesia merdeka?                                        ', '17 agustus 1945', 'masu', 10, 10, 10, 'masu', 0, '2015-02-02 09:11:19'),
(22, 'biologi', 'unit terkecil dalam kehidupan adalah ?                                        ', 'sel', 'masu', 10, 10, 10, 'masu', 0, '2015-02-02 09:13:18'),
(23, 'ilmu_bumi', 'apakah bumi itu bulat?                                        ', 'tidak', 'masu', 10, 10, 10, 'masu', 1, '2015-02-02 09:15:28'),
(24, 'ekonomi', 'Siapa bapak  ekonomi?                                    ', 'tanco', 'masu', 10, 10, 10, 'masu', 1, '2015-02-06 09:58:20'),
(25, 'sejarah', ' Siapa manusia pertama?                                       ', 'berkat', 'masu', 10, 10, 10, 'masu', 1, '2015-02-06 10:06:07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
