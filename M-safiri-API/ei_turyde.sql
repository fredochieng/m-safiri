-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2019 at 09:16 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ei_turyde`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `last_logintime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email_id`, `password`, `last_logintime`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-07-30 10:56:00'),
(2, 'Ronak@thecaseflick.com', '8e5281442c6ae7e5073f4b6f41094929', '2018-05-31 11:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_driver`
--

CREATE TABLE `tbl_assign_driver` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assign_driver`
--

INSERT INTO `tbl_assign_driver` (`id`, `company_id`, `driver_id`, `vehicle_id`, `created_date`) VALUES
(4, 1, 2, 3, '2019-05-10 06:20:10'),
(5, 1, 3, 4, '2019-05-10 13:13:05'),
(6, 1, 4, 5, '2019-05-15 10:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `authentication_code` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `email_code` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `fullname`, `email`, `authentication_code`, `password`, `zipcode`, `photo`, `contact`, `address`, `status`, `email_code`, `created_date`) VALUES
(1, 'company', 'company@mailinator.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '325416', '', '8795123221', 'new company ', 'active', '82040', '2019-04-24 09:59:15'),
(2, 'ele', 'ele@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '7842021', '', '561378923', 'DDev aarcc', 'active', '', '2019-04-29 05:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `id` int(10) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Algeria'),
(3, 'Antigua & Barbuda'),
(4, 'Argentina'),
(5, 'Australia'),
(6, 'Austria'),
(7, 'Bangladesh'),
(8, 'Belgium'),
(9, 'Bermuda'),
(10, 'Bhutan'),
(11, 'Brazil'),
(12, 'Bulgaria'),
(13, 'Myanmar'),
(14, 'Cambodia'),
(15, 'Cameroon'),
(16, 'Canada'),
(17, 'China'),
(18, 'Colombia'),
(19, 'Congo'),
(20, 'Costa Rica'),
(21, 'Croatia'),
(22, 'Cuba'),
(23, 'Czech Republic'),
(24, 'Denmark'),
(25, 'Ecuador'),
(26, 'Egypt'),
(27, 'El Salvador'),
(28, 'Fiji'),
(29, 'Finland'),
(30, 'France'),
(31, 'Georgia'),
(32, 'Germany'),
(33, 'Ghana'),
(34, 'Greece'),
(35, 'Guyana'),
(36, 'Hungary'),
(37, 'Iceland'),
(38, 'India'),
(39, 'Indonesia'),
(40, 'Iran'),
(41, 'Iraq'),
(42, 'Italy'),
(43, 'Jamaica'),
(44, 'Japan'),
(45, 'Jordan'),
(46, 'Kazakhstan'),
(47, 'Kenya'),
(48, 'Kuwait'),
(49, 'Latvia'),
(51, 'Jamaica'),
(52, 'Japan'),
(53, 'Jordan'),
(54, 'Kazakhstan'),
(56, 'Kuwait'),
(57, 'Latvia'),
(58, 'Libya'),
(59, 'Madagascar'),
(60, 'Malaysia'),
(61, 'Maldives'),
(62, 'Mali'),
(63, 'Mauritius'),
(64, 'Mexico'),
(65, 'Mongolia'),
(66, 'Morocco'),
(67, 'Namibia'),
(68, 'Nepal'),
(69, 'Netherlands'),
(70, 'New Zealand'),
(71, 'North Korea'),
(72, 'Norway'),
(73, 'Oman'),
(74, 'Pakistan'),
(75, 'Papua New Guinea'),
(76, 'Philippines'),
(77, 'Poland'),
(78, 'Portugal'),
(79, 'Qatar'),
(80, 'Romania'),
(81, 'Saint Lucia'),
(82, 'Saudi Arabia'),
(83, 'Sierra Leone'),
(84, 'Singapore'),
(85, 'Somalia'),
(86, 'South Africa'),
(87, 'South Korea'),
(88, 'South Sudan'),
(89, 'Spain'),
(90, 'Sri Lanka'),
(91, 'Suriname'),
(92, 'Sweden'),
(93, 'Switzerland'),
(94, 'Syria'),
(95, 'Tajikistan'),
(96, 'Tanzania'),
(97, 'Thailand'),
(98, 'Trinidad & Tobago'),
(99, 'Turkey'),
(100, 'Uganda'),
(101, 'Ukraine'),
(102, 'United Arab Emirates'),
(103, 'United States of America (USA)'),
(104, 'Uruguay'),
(105, 'Venezuela'),
(106, 'Vietnam'),
(107, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driverdata`
--

CREATE TABLE `tbl_driverdata` (
  `id` int(11) NOT NULL,
  `type` enum('individual','company') NOT NULL,
  `company_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `old_password` varchar(100) NOT NULL,
  `sentcode` varchar(50) NOT NULL,
  `authentication_code` varchar(50) DEFAULT NULL,
  `device_id` varchar(100) NOT NULL,
  `device_token` varchar(200) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `online_status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `approvel` enum('0','no','yes') NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driverdata`
--

INSERT INTO `tbl_driverdata` (`id`, `type`, `company_id`, `fullname`, `email`, `password`, `old_password`, `sentcode`, `authentication_code`, `device_id`, `device_token`, `status`, `online_status`, `approvel`, `created_date`) VALUES
(2, 'company', 1, 'halak', 'halak@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '123456', '', '', 'active', 'active', 'yes', '2019-05-10 06:13:28'),
(3, 'company', 1, 'heli', 'heli@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'd41d8cd98f00b204e9800998ecf8427e', '', '123456', '', '', 'active', 'active', 'yes', '2019-05-10 13:08:57'),
(4, 'company', 1, 'akash', 'Ashu@mailinator.com', 'd41d8cd98f00b204e9800998ecf8427e', 'd41d8cd98f00b204e9800998ecf8427e', '', '123456', '', '', 'active', 'active', 'yes', '2019-05-15 10:03:44'),
(6, 'individual', 0, 'Sai Sri Mourya Gudladona ', 'mourya.gudladona@gmail.com', 'b7113566a4b22ab38dabe7a4333dc7ab', 'b7113566a4b22ab38dabe7a4333dc7ab', '', '', 'android', 'cFpKCnAvoJ0:APA91bG0QTchjdhVWuQkdJn-8VNddUlG1AH5WxQHU0qhsa3kwJhAoayTRkuIr20O3X85JSbqIRyOFX-bLLHxHAryfMkEo1JinM6pRShHpclwOfPBR46ucPkKhtsqqEQcGr2h9VbgQW94', 'active', 'deactive', 'yes', '2019-05-16 00:45:32'),
(7, 'individual', 0, 'Teddy', 'muteshiteddy@gmail.com', '970d939d7687b1d8f4caaa9c8beb7931', '970d939d7687b1d8f4caaa9c8beb7931', '', '', 'android', 'cooEAfdFexk:APA91bG7KCgZIlTcuLXI8vDHRLTefgSv5z6zLZpPTX1QaobatqG1ReJA3BSH7L8EYBCHTz410XbAaSXBwO9WlvAkAETxedOCj1nvFL6RGb8K45bN_3Roqo_T23ZzS7b0fKTclxigj3O2', 'active', 'deactive', '0', '2019-05-18 09:03:43'),
(8, 'individual', 0, 'ramona magotsi', 'rmagotsi@gmail.com', '247a877d574469337b67ff116e7e68b7', '247a877d574469337b67ff116e7e68b7', '', '', 'ios', 'C58326DD6B26E36C5557759522063E42C074D9A947DE85CCB182B0E5ED1EE798', 'active', 'deactive', '0', '2019-05-30 12:35:34'),
(9, 'individual', 0, 'ramona magotsi', 'rmagotsi@gmail.com', '247a877d574469337b67ff116e7e68b7', '247a877d574469337b67ff116e7e68b7', '', '', 'ios', 'C58326DD6B26E36C5557759522063E42C074D9A947DE85CCB182B0E5ED1EE798', 'active', 'deactive', '0', '2019-05-30 12:35:34'),
(10, 'individual', 0, 'Tony Stark ', 'tonys@yahoo.com', 'faf32cc2671abb31953050b25f5772f8', 'faf32cc2671abb31953050b25f5772f8', '', '', 'android', 'd5d1pHaPbk8:APA91bFVvStmrlwwW8XuXuwXgRG2lhGAkj9fficzc54dv3iH4L2vPITTxaQcSoBTP8jg0FWLN837GX6fZm2FPnqSwhQf1G6hTcSd4A_kAcVkdt1UUVEKzz1Vjbp_J5xxxmQwerL6T5lk', 'active', 'deactive', 'no', '2019-05-31 13:14:45'),
(11, 'individual', 0, 'Fjjdjjfjd', 'fnfjdjjdjd@hdjddh.com', '5f4dcc3b5aa765d61d8327deb882cf99', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 'android', 'd5d1pHaPbk8:APA91bFVvStmrlwwW8XuXuwXgRG2lhGAkj9fficzc54dv3iH4L2vPITTxaQcSoBTP8jg0FWLN837GX6fZm2FPnqSwhQf1G6hTcSd4A_kAcVkdt1UUVEKzz1Vjbp_J5xxxmQwerL6T5lk', 'active', 'deactive', '0', '2019-06-15 02:34:16'),
(12, 'individual', 0, 'Zahir Mala ', 'zahir.eleganzit@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'android', 'fTj9WipBm1I:APA91bFkyBJN2n_fuxgg6uB8ULQ1i2pFfhIzQ-Pm1BN_UpVyQFTE9fo92fuAnbFfI-0QdvCUhNLv1vPLXRSlk3n4u_uTcTVudNRWZ5I4zxzDreEKyLaf-cOAc08TKSt6l8TW9QNS6jeS', 'active', 'deactive', 'yes', '2019-07-02 05:23:18'),
(13, 'individual', 0, 'Nirav', 'niravchauhan64@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'e807f1fcf82d132f9bb018ca6738a19f', '', '', 'android', 'dLA3FjblHLE:APA91bFSX2xg2g5Bh-NxqgZVT8BlS9q7bUO7txGFN2ygzvVpzScBu74yVCAo8-3wrjK26cfQ-XmU5RpCxrZAWFq9iMFxp-j71N5r7p8DsyztyOqUMFxRrjxF9fsT2tE3AcqLSlFeoGcU', 'active', 'deactive', 'no', '2019-07-24 06:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driverdetails`
--

CREATE TABLE `tbl_driverdetails` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `vehicle_profile` text NOT NULL,
  `licence` text NOT NULL,
  `ratting` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driverdetails`
--

INSERT INTO `tbl_driverdetails` (`id`, `driver_id`, `gender`, `dob`, `street`, `city`, `state`, `postal_code`, `country`, `mobile_number`, `photo`, `vehicle_profile`, `licence`, `ratting`) VALUES
(2, 2, 'Female', '2019-05-01', 'Shivranjni', 'Ahmedabad', 'Gujarat', '380009', 'India', '1234567890', '21564130938.png', '', '', ''),
(3, 3, 'Female', '2019-05-10', 'E - 802 Titanium City Center', 'Ahmedabad', 'Kerala', '380015', 'India', '1234567890', '1_20190510130857D.jpeg', '', '', ''),
(4, 4, 'Male', '2019-02-24', 'near iskon mega mall', 'Bombay', 'Maharashtra', '639780', 'India', '952200', '1_20190515100344D.png', '', '', ''),
(5, 5, 'male', '0000-00-00', 'asdfs', 'gfg', 'Kisumu', 'foggy', 'Kenya', '8555555666', '', '', '', ''),
(6, 6, 'Male', '1992-02-29', '1652 Lismore Terrace NE', 'Leesburg', 'VA', '20176', 'USA', '703626352', '61557967554.jpg', '', '', ''),
(7, 7, '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(8, 8, '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(9, 9, 'female', '1995-05-12', '2210 Oxford rd.', 'tallahassee', 'Florida', '32403', 'United States of America (USA)', '6142354236', '', '', '', ''),
(10, 10, 'Male', '1983-04-02', 'P.o box 18', 'Nai', 'Nairobi', '23', 'Kenya', '5558896666', '101559309066.jpg', '', '', ''),
(11, 11, '', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(12, 12, 'male', '2019-07-02', 'Gcdgc', 'Abad', 'Gujarat', '595785', 'India', '254-797-237467', '121563888188.png', '', '', ''),
(13, 13, 'male', '2000-07-24', '', 'Nairobi', '', '0020', 'Kenya', '254-222-222222', '131563949714.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driverdocuments`
--

CREATE TABLE `tbl_driverdocuments` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `photo_type` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driverdocuments`
--

INSERT INTO `tbl_driverdocuments` (`id`, `driver_id`, `photo_type`, `photo`, `created_date`) VALUES
(6, 2, 'proof', '1_20190510061328DOC0.jpg', '2019-05-10 06:13:28'),
(5, 2, 'licence', '1_20190510061328LIC.jpeg', '2019-05-10 06:13:28'),
(7, 3, 'licence', '1_20190510130857LIC.jpg', '2019-05-10 13:08:57'),
(8, 3, 'proof', '1_20190510130857DOC0.jpg', '2019-05-10 13:08:57'),
(9, 4, 'licence', '1_20190515100344LIC.jpeg', '2019-05-15 10:03:44'),
(10, 4, 'proof', '1_20190515100344DOC0.jpg', '2019-05-15 10:03:44'),
(16, 5, 'proof', '1557967856-2137926448.png', '2019-05-16 00:50:55'),
(14, 6, 'proof', '15579678110.jpg', '2019-05-16 00:50:10'),
(13, 6, 'licence', '15579678110L.jpg', '2019-05-16 00:50:10'),
(15, 5, 'licence', '1557967856-2138032880L.png', '2019-05-16 00:50:55'),
(34, 13, 'passportid', '156414679061917632.png', '2019-07-26 13:13:09'),
(22, 10, 'proof', '15593088750.jpg', '2019-05-31 13:21:14'),
(21, 10, 'licence', '15593088750L.jpg', '2019-05-31 13:21:14'),
(35, 13, 'passportid', '156414869164089296.png', '2019-07-26 13:44:50'),
(26, 12, 'proof', '15620451230.jpg', '2019-07-02 05:25:23'),
(25, 12, 'licence', '15620451230L.jpg', '2019-07-02 05:25:23'),
(28, 13, 'licence', '156396868217060880L.png', '2019-07-24 11:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_bankdetails`
--

CREATE TABLE `tbl_driver_bankdetails` (
  `bank_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_payee` varchar(150) NOT NULL,
  `bank_account` varchar(50) NOT NULL,
  `bank_ifsc` varchar(15) NOT NULL,
  `street1` text NOT NULL,
  `street2` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `country` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_bankdetails`
--

INSERT INTO `tbl_driver_bankdetails` (`bank_id`, `driver_id`, `bank_name`, `bank_payee`, `bank_account`, `bank_ifsc`, `street1`, `street2`, `city`, `state`, `postal_code`, `country`, `birthday`, `status`, `created_date`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-24 06:21:09'),
(2, 2, 'Sbi', 'Niyati', '35484816', 'KKAAQ72727', 'Nsw', 'Near CG road', 'Hamilton', 'Hamilton ', '649484', 'Bermuda', '0000-00-00', '', '2019-04-24 06:24:39'),
(3, 3, 'Test', 'Test', '6464643434', 'JDJSJ7373', 'Hshs', 'Jdjd', 'Hshs', 'Gujarat', '646467', 'India', '0000-00-00', '', '2019-04-24 06:25:14'),
(4, 4, 'Union', 'Ritu', '64645757643767', 'HDHS737373', 'Sarkhej', 'Vishala', 'Ahbad', 'Gujarat', '385058', 'India', '0000-00-00', '', '2019-04-24 06:31:24'),
(5, 5, 'Icici', 'Akshansh', '6761361676464', 'JSJS732888JDJD', 'Vish', 'Sar', 'Ahhad', 'Gujarat', '875445', 'India', '0000-00-00', '', '2019-04-24 06:36:53'),
(6, 7, 'Test', 'Test', '2125454545', 'HSHSH7272', 'Hsh', 'Jdjs', 'Abad', 'Gujarat', '646466', 'India', '0000-00-00', '', '2019-04-24 11:16:24'),
(7, 8, 'Icici', 'Shreyance', '0987456321', 'FHBIHGV', 'Satellite', 'Sg highway', 'Ahmedabad', 'Gujarat', '380015', 'India', '0000-00-00', '', '2019-04-25 11:08:45'),
(8, 10, 'Ashok', 'Ashok Tyagi', '64667679467976', 'JSJSND', 'B-11-12', 'Kznzjsk', 'Ahmedabad', 'Gujarat', '380008', 'India', '0000-00-00', '', '2019-04-26 14:23:55'),
(9, 11, 'SBI', 'Amit', '1425866959', 'SBI36743GJJ', 'Abhijit complex', 'Near bank', 'Goa', 'Goa', '663888', 'India', '0000-00-00', '', '2019-04-27 06:07:21'),
(10, 13, 'Nirav', 'Akshansh', '8723648723468234', '435464', 'Surat', 'Ahmedabad ', 'patan', 'Arunachal Pradesh', '543546', 'India', '2016-07-23', '', '2019-04-29 09:28:04'),
(11, 14, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-29 11:38:48'),
(12, 15, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-29 11:41:03'),
(13, 16, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-29 11:46:11'),
(14, 17, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-29 11:54:56'),
(15, 18, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-29 11:58:00'),
(16, 19, 'ICICI', 'Akshansh', '989898878787', 'ICICI0002', 'STA 1', 'STA 2', 'Patan', 'Gujarat', '989898', 'India', '2002-01-19', '', '2019-04-29 12:13:50'),
(17, 20, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-04-29 12:14:54'),
(18, 21, 'Sbi', 'Test Payee', '54870706764', '72828292', 'Str 1', 'Str 2', 'Ahmadabad', 'Gujarat', '648484', 'India', '1999-07-16', '', '2019-04-29 12:25:48'),
(19, 22, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-01 00:18:50'),
(20, 23, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-01 10:06:35'),
(21, 24, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-01 10:46:35'),
(22, 25, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-01 10:49:04'),
(23, 27, 'SBI', 'Test individual ', '322145678920', 'SBI87348343', 'Dev arc ', 'Iskon cross road', 'Ahmedabad', 'Gujarat', '383322', 'India', '0000-00-00', '', '2019-05-01 11:36:05'),
(24, 28, 'Sbi', 'Test ind', '49652486390', 'SBI9843430', 'Dev arc', 'Id Cross road', 'Ahmedabad', 'Gujarat', '385542', 'India', '0000-00-00', '', '2019-05-01 12:14:12'),
(26, 30, 'Sbi', 'Test', '25566589', '68874774', 'Str one', 'Str two ', 'Cut', 'Sylhet', '8767', 'Bangladesh', '0000-00-00', '', '2019-05-02 08:51:16'),
(27, 31, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-02 09:11:45'),
(28, 33, 'ICICI', 'Akshansh', '909090909090', 'ICICI9090', '1', '2', 'patan', 'Kabul', '656565', 'Afghanistan', '2018-04-02', '', '2019-05-02 09:51:04'),
(29, 34, 'ishsb', 'babd', '5184348767', 'bzhajs', 'babs', 'babsh', 'snjxz', 'Constantine', '9497', 'Algeria', '2016-03-30', '', '2019-05-03 13:43:17'),
(30, 35, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-06 06:11:56'),
(31, 36, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-06 10:31:24'),
(32, 37, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-07 01:47:29'),
(33, 38, 'Some Bank', 'Test User', '123456123456', '12344', '18 kitanga dr', '12', 'Nai', 'Nairobi', '25', 'Kenya', '0000-00-00', '', '2019-05-07 01:53:02'),
(34, 39, 'Sbi', 'Nick', '04846464616', 'SBI818181', 'Iskon cross road', 'Near wide angle', 'Ahmedabad', 'Gujarat', '380015', 'India', '0000-00-00', '', '2019-05-07 11:47:43'),
(35, 5, 'Icici', 'Akshansh', '6761361676464', 'JSJS732888JDJD', 'Vish', 'Sar', 'Ahhad', 'Gujarat', '875445', 'India', '0000-00-00', '', '2019-05-16 00:37:30'),
(36, 6, 'Hhbb', 'Jjfv', '99555', 'VFJJ', '1652 Lismore Terrace NE', 'Hyg', 'Leesburg', 'VA', '20176', 'USA', '0000-00-00', '', '2019-05-16 00:45:32'),
(37, 7, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-18 09:03:43'),
(38, 9, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-30 12:35:34'),
(39, 8, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-05-30 12:35:34'),
(40, 10, 'Ashok', 'Ashok Tyagi', '64667679467976', 'JSJSND', 'B-11-12', 'Kznzjsk', 'Ahmedabad', 'Gujarat', '380008', 'India', '0000-00-00', '', '2019-05-31 13:14:45'),
(41, 11, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '2019-06-15 02:34:16'),
(42, 12, 'Test', 'Test', '5487542466454', 'GSHS73737', 'Hshs', 'Gssh', 'Jdhs', 'Gujarat', '659464', 'India', '0000-00-00', '', '2019-07-02 05:23:18'),
(43, 13, 'Nirav', 'Akshansh', '8723648723468234', '435464', 'Surat', 'Ahmedabad ', 'patan', 'Arunachal Pradesh', '543546', 'India', '2016-07-23', '', '2019-07-24 06:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_logs`
--

CREATE TABLE `tbl_driver_logs` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_setlocation`
--

CREATE TABLE `tbl_driver_setlocation` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `from_title` varchar(200) NOT NULL,
  `from_lat` varchar(50) NOT NULL,
  `from_lng` varchar(50) NOT NULL,
  `from_address` text NOT NULL,
  `to_title` varchar(200) NOT NULL,
  `to_lat` varchar(50) NOT NULL,
  `to_lng` varchar(50) NOT NULL,
  `to_address` text NOT NULL,
  `datetime` datetime NOT NULL,
  `last_lat` text NOT NULL,
  `last_lng` text NOT NULL,
  `trip_price` varchar(100) DEFAULT NULL,
  `trip_map_screenshot` text NOT NULL,
  `cancel_reason` text NOT NULL,
  `end_datetime` datetime NOT NULL,
  `notify_datetime` datetime NOT NULL,
  `notify_count` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','active','deactive','ongoing','cancel') NOT NULL DEFAULT 'pending',
  `estimate_datetime` datetime NOT NULL,
  `estimate_end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_setlocation`
--

INSERT INTO `tbl_driver_setlocation` (`id`, `driver_id`, `from_title`, `from_lat`, `from_lng`, `from_address`, `to_title`, `to_lat`, `to_lng`, `to_address`, `datetime`, `last_lat`, `last_lng`, `trip_price`, `trip_map_screenshot`, `cancel_reason`, `end_datetime`, `notify_datetime`, `notify_count`, `created_date`, `status`, `estimate_datetime`, `estimate_end_datetime`) VALUES
(2, 1, 'Ranip, Ahmedabad, Gujarat, India', '23.0810287', '72.5768002', 'Ranip, Ahmedabad, Gujarat, India', 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '23.017124', '23.017124', 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '2019-05-10 12:30:30', '', '', NULL, '', '', '2019-05-10 14:25:00', '0000-00-00 00:00:00', 0, '2019-05-10 05:46:05', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', '23.0120338', '72.51075399999999', 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', 'Isanpur, Ahmedabad, Gujarat 380043, India', '22.9782583', '22.9782583', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2019-05-10 15:45:25', '', '', '50', '', '', '2019-05-10 17:45:45', '0000-00-00 00:00:00', 0, '2019-05-10 06:15:03', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 6, 'Ranip, Ahmedabad, Gujarat, India', '23.0810287', '72.5768002', 'Ranip, Ahmedabad, Gujarat, India', 'Maninagar, Ahmedabad, Gujarat, India', '22.9961698', '72.5995843', 'Maninagar, Ahmedabad, Gujarat, India', '2019-05-15 21:55:00', '', '', NULL, '', '', '2019-05-16 20:56:00', '2019-05-15 21:55:00', 0, '2019-05-16 00:56:06', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 12, 'Ranip, Ahmedabad, Gujarat, India', '23.0810287', '72.57680019999999', 'Ranip, Ahmedabad, Gujarat, India', 'Gota, Ahmedabad, Gujarat 382481, India', '23.0977347', '72.54912379999999', 'Gota, Ahmedabad, Gujarat 382481, India', '2019-07-23 16:25:22', '', '', '100', '', 'no pass availble', '2019-07-24 00:01:00', '2019-07-23 16:25:22', 0, '2019-07-22 10:55:13', 'cancel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 12, 'Gota, Ahmedabad, Gujarat 382481, India', '23.0977347', '72.54912379999999', 'Gota, Ahmedabad, Gujarat 382481, India', 'Ranip, Ahmedabad, Gujarat, India', '23.0810287', '72.57680019999999', 'Ranip, Ahmedabad, Gujarat, India', '2019-07-22 18:00:44', '', '', '100', '', '', '2019-07-22 19:29:07', '2019-07-22 18:00:44', 0, '2019-07-22 10:59:28', 'deactive', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 12, 'Mondeal Heights, Ramdev Nagar, Ahmedabad, Gujarat 380015, India', '23.0230532', '72.50676709999999', 'Mondeal Heights, Ramdev Nagar, Ahmedabad, Gujarat 380015, India', 'Gota, Ahmedabad, Gujarat 382481, India', '23.0977347', '72.54912379999999', 'Gota, Ahmedabad, Gujarat 382481, India', '2019-07-24 18:00:46', '', '', '100', '', 'something wrong....', '2019-07-24 18:30:00', '1970-01-01 00:38:39', 1, '2019-07-23 06:58:54', 'cancel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 13, 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '23.017124', '72.53305329999999', 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', 'Maninagar, Ahmedabad, Gujarat, India', '22.9961698', '72.5995843', 'Maninagar, Ahmedabad, Gujarat, India', '2019-07-27 20:00:00', '', '', NULL, '', 'nsajkdfcawsdf', '2019-07-27 21:20:00', '2019-07-27 19:00:00', 0, '2019-07-25 06:50:34', 'cancel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 12, 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', '23.0120338', '72.51075399999999', 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', 'Kalupur, Ahmedabad, Gujarat, India', '23.0282975', '72.59367929999999', 'Kalupur, Ahmedabad, Gujarat, India', '2019-07-27 05:49:00', '', '', NULL, '', '', '2019-07-30 20:49:00', '1970-01-01 00:38:39', 1, '2019-07-26 10:01:28', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 12, 'Ranip, Ahmedabad, Gujarat, India', '23.0810287', '72.57680019999999', 'Ranip, Ahmedabad, Gujarat, India', 'Mondeal Heights, Ramdev Nagar, Ahmedabad, Gujarat 380015, India', '23.0230532', '72.50676709999999', 'Mondeal Heights, Ramdev Nagar, Ahmedabad, Gujarat 380015, India', '2019-07-31 11:47:29', '', '', '50', '', '', '2019-07-31 15:59:00', '2019-07-31 11:47:29', 0, '2019-07-29 06:18:14', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 12, 'Shyamal Cross Road, Shyamal, Ahmedabad, Gujarat 380015, India', '23.0119849', '72.5284264', 'Shyamal Cross Road, Shyamal, Ahmedabad, Gujarat 380015, India', 'Juhapura, Ahmedabad, Gujarat, India', '22.9940437', '72.5277471', 'Juhapura, Ahmedabad, Gujarat, India', '2019-07-29 16:00:50', '', '', '100', '', '', '2019-07-29 17:32:11', '1970-01-01 00:38:39', 1, '2019-07-29 10:02:25', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_vehicle`
--

CREATE TABLE `tbl_driver_vehicle` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `vehicle_name` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `vehicle_profile` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_vehicle`
--

INSERT INTO `tbl_driver_vehicle` (`id`, `driver_id`, `company_id`, `vehicle_name`, `vehicle_type`, `vehicle_number`, `seats`, `vehicle_profile`, `created_date`) VALUES
(3, 2, 1, 'SUV', 'CAR', 'GJ-9048-TEYR', 5, '1_20190510061650VehPhoto.jpg', '2019-05-10 06:16:50'),
(4, 3, 1, 'sports', 'BMW', 'GJ-01 HZ-6789', 4, '1_20190510131036VehPhoto.jpg', '2019-05-10 13:10:36'),
(5, 4, 1, 'nano', 'seedan', 'YE0-029-UI99', 3, '1_20190515100506VehPhoto.jpeg', '2019-05-15 10:05:06'),
(8, 6, 0, 'Hhfgj', 'Car', 'QJGVH', 5, '', '2019-05-16 00:45:32'),
(10, 7, 0, '', '', '', 0, '', '2019-05-18 09:03:43'),
(11, 9, 0, '', '', '', 0, '', '2019-05-30 12:35:34'),
(12, 8, 0, '', '', '', 0, '', '2019-05-30 12:35:34'),
(13, 10, 0, 'Fasty', 'Van', 'KAJ470', 2, '', '2019-05-31 13:14:45'),
(14, 11, 0, '', '', '', 0, '', '2019-06-15 02:34:16'),
(15, 12, 0, 'Test', 'Buses', 'ABC 567Q', 25, '', '2019-07-02 05:23:18'),
(17, 13, 0, 'Nirav Matatu', 'Matatu', 'KEB 789J', 10, '', '2019-07-24 11:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `address`, `latitude`, `longitude`, `status`, `created_date`) VALUES
(1, 'Ranip, Ahmedabad, Gujarat, India', '23.0810287', '72.5768002', 'active', '2019-04-15 06:28:14'),
(2, 'Gota, Ahmedabad, Gujarat 382481, India', '23.0977347', '72.54912379999999', 'active', '2019-04-15 06:28:25'),
(3, 'Chandkheda, Ahmedabad, Gujarat, India', '23.109098', '72.5849179', 'active', '2019-04-15 06:28:35'),
(4, 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '23.017124', '72.53305329999999', 'active', '2019-04-15 06:28:49'),
(5, 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', '23.0120338', '72.51075399999999', 'active', '2019-04-15 06:29:02'),
(6, 'Maninagar, Ahmedabad, Gujarat, India', '22.9961698', '72.5995843', 'active', '2019-04-15 06:29:17'),
(7, 'Isanpur, Ahmedabad, Gujarat 380043, India', '22.9782583', '72.6002263', 'active', '2019-04-15 06:29:35'),
(8, 'Nava Vadaj, Ahmedabad, Gujarat, India', '23.0675934', '72.5667133', 'active', '2019-04-15 06:30:03'),
(9, 'Shivranjani, Jodhpur, Ahmedabad, Gujarat 380015, India', '23.0235018', '72.5289864', 'active', '2019-04-15 06:30:23'),
(10, 'Kalupur, Ahmedabad, Gujarat, India', '23.0282975', '72.59367929999999', 'active', '2019-04-15 06:31:09'),
(11, 'Mondeal Heights, Ramdev Nagar, Ahmedabad, Gujarat 380015, India', '23.0230532', '72.50676709999999', 'active', '2019-04-29 13:32:58'),
(12, 'sect-4,near jantanagar railway crossing, Sumti Vidhya Vihar, Vishwas City 1, Chanakyapuri, Ahmedabad, Gujarat 380061, India', '23.0735129', '72.53360789999999', 'active', '2019-04-29 13:33:17'),
(13, 'Juhapura, Ahmedabad, Gujarat, India', '22.9940437', '72.5277471', 'active', '2019-04-29 13:42:19'),
(14, 'Shyamal Cross Road, Shyamal, Ahmedabad, Gujarat 380015, India', '23.0119849', '72.5284264', 'active', '2019-04-29 13:42:33'),
(15, 'Rockville, MD, USA', '39.0839973', '-77.1527578', 'active', '2019-05-16 00:57:30'),
(16, 'Herndon, VA 20170, USA', '38.9695545', '-77.3860976', 'active', '2019-05-16 00:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_my_address`
--

CREATE TABLE `tbl_my_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_my_address`
--

INSERT INTO `tbl_my_address` (`id`, `user_id`, `title`, `lat`, `lng`, `address`, `created_date`) VALUES
(6, 6, 'Home', '23.0810287', '72.5768002', 'Ranip, Ahmedabad, Gujarat, India', '2019-04-27 11:58:10'),
(7, 13, 'Home', '23.0810287', '72.5768002', 'Ranip, Ahmedabad, Gujarat, India', '2019-04-29 06:25:22'),
(9, 15, 'Home', '72.53305329999999', '23.017124', 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '2019-04-29 13:26:56'),
(10, 15, 'Work', '72.5995843', '22.9961698', 'Maninagar, Ahmedabad, Gujarat, India', '2019-04-29 13:27:08'),
(11, 33, 'Home', '72.53305329999999', '23.017124', 'Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '2019-04-30 09:49:12'),
(13, 33, 'Work', '72.6002263', '22.9782583', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2019-04-30 09:50:26'),
(14, 1, 'Home', '22.9940437', '72.5277471', 'Juhapura, Ahmedabad, Gujarat, India', '2019-04-30 15:21:51'),
(15, 1, 'Work', '23.0230532', '72.50676709999999', 'Mondeal Heights, Ramdev Nagar, Ahmedabad, Gujarat 380015, India', '2019-04-30 15:21:56'),
(16, 39, 'Home', '23.0675934', '72.5667133', 'Nava Vadaj, Ahmedabad, Gujarat, India', '2019-05-04 14:07:34'),
(18, 44, 'Home', '39.0839973', '-77.1527578', 'Rockville, MD, USA', '2019-05-31 13:37:17'),
(19, 44, 'Work', '38.9695545', '-77.3860976', 'Herndon, VA 20170, USA', '2019-05-31 13:37:21'),
(20, 42, 'Home', '22.9782583', '72.6002263', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2019-06-11 16:31:07'),
(21, 42, 'Work', '23.0675934', '72.5667133', 'Nava Vadaj, Ahmedabad, Gujarat, India', '2019-06-11 16:31:15'),
(22, 48, 'Home', '72.5849179', '23.109098', 'Chandkheda, Ahmedabad, Gujarat, India', '2019-07-16 08:37:54'),
(23, 48, 'Work', '72.54912379999999', '23.0977347', 'Gota, Ahmedabad, Gujarat 382481, India', '2019-07-16 08:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preferences`
--

CREATE TABLE `tbl_preferences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `music` varchar(250) NOT NULL,
  `medical` varchar(250) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_preferences`
--

INSERT INTO `tbl_preferences` (`id`, `user_id`, `trip_id`, `music`, `medical`, `driver_id`, `created_date`) VALUES
(1, 8, 60, 'koi bhi', 'pagal ', 3, '2019-04-26 14:12:58'),
(2, 10, 65, 'jazz', 'Heart ', 11, '2019-04-27 08:22:10'),
(3, 15, 110, 'Sufi', 'heart disease ', 21, '2019-04-30 11:35:21'),
(4, 36, 118, 'Sufi', 'Headache', 28, '2019-05-01 12:27:40'),
(5, 10, 121, 'sufi', 'heart', 28, '2019-05-02 06:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repairs`
--

CREATE TABLE `tbl_repairs` (
  `repair_id` int(15) NOT NULL,
  `mechanic_id` int(15) NOT NULL,
  `vehicle_id` int(15) NOT NULL,
  `repair_comment` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_repairs`
--

INSERT INTO `tbl_repairs` (`repair_id`, `mechanic_id`, `vehicle_id`, `repair_comment`) VALUES
(1, 1, 1, 'test1'),
(2, 1, 1, 'test2'),
(3, 2, 2, 'CAR WASH'),
(4, 2, 3, 'Tyre change'),
(5, 2, 3, 'engine service'),
(6, 4, 4, 'WASH'),
(7, 4, 4, 'ENGINE REPAIR'),
(8, 6, 5, 'breck fail'),
(9, 6, 5, 'back camara not working'),
(10, 7, 6, 'wash'),
(11, 7, 6, 'tyre change'),
(12, 7, 6, 'oil change');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `pickup_location` varchar(250) NOT NULL,
  `pickup_lat` varchar(250) NOT NULL,
  `pickup_lng` varchar(250) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `destination_location` varchar(250) NOT NULL,
  `destination_lat` varchar(250) NOT NULL,
  `destination_lng` varchar(250) NOT NULL,
  `destination_datetime` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `country_id`, `state`) VALUES
(1, 1, 'Kabul'),
(2, 1, 'Kandahar'),
(3, 1, 'Herat'),
(4, 1, 'Mazar-i-Sharif'),
(5, 2, 'Algiers'),
(6, 2, 'Algiers'),
(7, 2, 'Constantine'),
(8, 2, 'Annaba'),
(9, 2, 'Blida'),
(10, 3, 'Bolans'),
(11, 3, 'Carlisle'),
(12, 3, 'Codrington'),
(13, 3, 'Freetown'),
(14, 3, 'Jennings'),
(15, 3, 'Liberta'),
(16, 3, 'Parham'),
(17, 3, 'Swetes'),
(18, 3, 'Willikies'),
(19, 4, 'Moreno '),
(20, 4, 'La Rioja '),
(21, 4, 'Río Cuarto'),
(22, 4, 'Ituzaingo '),
(23, 5, 'New South Wales'),
(24, 5, 'Norfolk Island'),
(25, 5, 'Northern Territory'),
(26, 5, 'Queensland'),
(27, 5, 'South Australia'),
(28, 5, 'Tasmania'),
(29, 5, 'Victoria'),
(30, 6, 'Burgenland '),
(31, 6, 'Kärnten '),
(32, 6, 'Niederösterreich '),
(33, 6, 'Oberösterreich '),
(34, 6, 'Salzburg '),
(35, 6, 'Tirol '),
(36, 7, 'Dhaka'),
(37, 7, 'Chittagong'),
(38, 7, 'Khulna'),
(39, 7, 'Rajshahi'),
(40, 7, 'Barisal'),
(41, 7, 'Sylhet'),
(42, 7, 'Rangpur'),
(43, 7, 'Comilla'),
(44, 8, 'Antwerp'),
(45, 8, 'Ghent'),
(46, 8, 'Charleroi'),
(47, 8, 'Liege.'),
(48, 8, 'Brussels'),
(49, 8, 'Bruges'),
(50, 8, 'Namur.'),
(51, 9, 'Saint George '),
(52, 9, 'Hamilton '),
(53, 10, 'Chhukha'),
(54, 10, 'Daga'),
(55, 10, 'Damphu'),
(56, 10, 'Geylegphug'),
(57, 10, 'Jakar'),
(58, 10, 'Lhuntshi'),
(59, 10, 'Mongar'),
(60, 11, 'Amazonas'),
(61, 11, 'Para'),
(62, 11, 'Mato Grosso'),
(63, 11, 'Minas Gerais'),
(64, 12, 'Sofia'),
(65, 12, 'Plovdiv'),
(66, 12, 'Varna'),
(67, 12, 'Burgas'),
(68, 13, 'Kachin '),
(69, 13, 'Kayah '),
(70, 13, 'Kayin '),
(71, 13, 'Chin '),
(72, 13, 'Mon '),
(73, 13, 'Rakhine '),
(74, 14, 'Phnom Penh'),
(75, 14, 'Ta Khmau'),
(76, 14, 'Battambang'),
(77, 14, 'Serei Saophoan'),
(78, 14, 'Poipet'),
(79, 14, 'Kampot'),
(80, 15, 'Douala'),
(81, 16, 'Alberta'),
(82, 16, 'British Columbia'),
(83, 16, 'Manitoba'),
(84, 17, 'Guangzhou'),
(85, 17, 'Shanghai'),
(86, 17, 'Chongqing'),
(87, 17, 'Beijing'),
(88, 17, 'Hangzhou'),
(89, 18, 'Bolívar'),
(90, 18, 'Boyaca'),
(91, 18, 'Cauca'),
(92, 18, 'Cundinamarca'),
(93, 19, 'Niangara'),
(94, 19, 'Shabunda'),
(95, 20, 'Alajuela'),
(96, 20, 'Cartago'),
(97, 20, 'Guanacaste'),
(98, 21, 'Zagreb'),
(99, 21, 'Sisak'),
(100, 21, 'Samobor'),
(101, 22, 'Pinar del Río.'),
(102, 22, 'Havana.'),
(103, 22, 'Mayabeque.'),
(104, 22, 'Matanzas.'),
(105, 22, 'Cienfuegos.'),
(106, 23, 'Bratislava'),
(107, 23, 'Copenhagen'),
(108, 23, 'Aarhus'),
(109, 23, 'Odense'),
(110, 23, 'Aalborg'),
(111, 24, 'Carchi'),
(112, 25, 'Imbabura'),
(113, 25, 'Pichincha'),
(114, 26, 'Cairo'),
(115, 26, 'Alexandria'),
(116, 26, 'Giza'),
(117, 26, 'Shubra El Kheima'),
(118, 27, 'Acajutla '),
(119, 27, 'Apopa '),
(120, 27, 'Ilopango '),
(121, 27, 'Mejicanos '),
(122, 28, 'Lautoka'),
(123, 28, 'Suva'),
(124, 28, 'Nadi'),
(125, 29, 'Helsinki'),
(126, 29, 'Espoo'),
(127, 29, 'Tampere'),
(128, 29, 'Vantaa'),
(129, 30, 'Paris'),
(130, 30, 'Marseille'),
(131, 30, 'Lyon'),
(132, 30, 'Toulouse'),
(133, 31, 'Creed'),
(134, 32, 'Bavaria'),
(135, 32, 'Berlin'),
(136, 32, 'Bremen'),
(137, 32, 'Thuringia'),
(138, 33, 'Accra'),
(139, 33, 'Kumasi'),
(140, 33, 'Sekondi-Takoradi'),
(141, 33, 'Ashiaman'),
(142, 34, 'Athens '),
(143, 34, 'Sparta '),
(144, 34, 'Corinth '),
(145, 34, 'Syracuse '),
(146, 35, 'Georgetown'),
(147, 36, 'Budapest'),
(148, 36, 'Debrecen'),
(149, 36, 'Szeged'),
(150, 38, 'Andhra Pradesh'),
(151, 38, 'Arunachal Pradesh'),
(152, 38, 'Assam'),
(153, 38, 'Bihar'),
(154, 38, 'Chhattisgarh'),
(155, 38, 'Goa'),
(156, 38, 'Gujarat'),
(157, 38, 'Haryana'),
(158, 38, 'Himachal Pradesh'),
(159, 38, 'Jammu and Kashmir'),
(160, 38, 'Jharkhand'),
(161, 38, 'Karnataka'),
(162, 38, 'Kerala'),
(163, 38, 'Madhya Pradesh'),
(164, 38, 'Maharashtra'),
(165, 38, 'Manipur'),
(166, 38, 'Meghalaya'),
(167, 38, 'Mizoram'),
(168, 38, 'Nagaland'),
(169, 38, 'Odisha'),
(170, 38, 'Punjab'),
(171, 38, 'Rajasthan'),
(172, 38, 'Sikkim'),
(173, 38, 'Tamil Nadu'),
(174, 38, 'Telangana'),
(175, 38, 'Tripura'),
(176, 38, 'Uttar Pradesh'),
(177, 38, 'Uttarakhand'),
(178, 38, 'West Bengal'),
(179, 39, 'Bali'),
(180, 39, 'Java'),
(181, 39, 'Kalimantan'),
(182, 39, 'Timor'),
(183, 39, 'Sumatra'),
(184, 40, 'Tehran'),
(185, 40, 'Mashhad'),
(186, 40, 'Isfahan'),
(187, 40, 'Karaj'),
(188, 40, 'Tabriz'),
(189, 41, 'Baghdad'),
(190, 41, 'Fallujah'),
(191, 41, 'Najaf'),
(192, 41, 'Ramadi'),
(193, 42, 'Rome'),
(194, 42, 'Milan'),
(195, 42, 'Naples'),
(196, 42, 'Naples'),
(197, 43, 'Kingston'),
(198, 43, 'Montego Bay'),
(199, 44, 'Saitama'),
(200, 44, 'Sapporo'),
(201, 44, 'Sendai'),
(202, 44, 'Tokyo '),
(203, 45, 'Irbid'),
(204, 45, 'Russeifa'),
(205, 45, 'Al-Quwaysimah'),
(206, 45, 'Wadi as-Ser'),
(207, 46, 'Almaty'),
(208, 46, 'Arkalyk'),
(209, 47, 'Nairobi'),
(210, 47, 'Mombasa'),
(211, 47, 'Kisumu'),
(212, 48, 'Bayan'),
(213, 48, 'harq Al-Jabriya'),
(214, 49, 'Daugavpils'),
(215, 50, 'Tripoli'),
(216, 50, 'Benghazi'),
(217, 50, 'Derna'),
(218, 50, 'Ghadames'),
(219, 60, 'Selangor'),
(220, 60, ' Kuala Lumpur'),
(221, 60, 'Sabah'),
(222, 63, 'Beau Bassin-Rose Hill'),
(223, 63, 'Curepipe'),
(224, 64, 'Chihuahua'),
(225, 64, 'Sonora'),
(226, 64, 'Coahuila'),
(227, 65, 'Khamag Mongol Khanate'),
(228, 66, 'Souss Massa Draa'),
(229, 66, 'Gharb Chrarda Beni Hssen'),
(230, 66, 'Chaouia Ouardigha'),
(231, 67, 'Khomas'),
(232, 67, 'Erongo'),
(233, 68, 'Kathmandu'),
(234, 68, 'Pokhara Lekhnath'),
(235, 68, 'Lalitpur'),
(236, 69, 'Drenthe'),
(237, 69, 'Flevoland'),
(238, 69, 'Friesland'),
(239, 69, 'Gelderland'),
(240, 70, 'Auckland.'),
(241, 70, 'Wellington'),
(242, 70, 'Christchurch'),
(243, 70, 'Hamilton'),
(244, 70, 'Napier-Hastings.'),
(245, 70, 'Dunedin'),
(246, 71, 'South Pyongan'),
(247, 71, 'North Hamgyong'),
(248, 72, 'Oslo '),
(249, 72, 'Bergen'),
(250, 72, 'Trondheim'),
(251, 73, 'Adam'),
(252, 73, 'Bahla'),
(253, 74, 'Balochistan'),
(254, 74, 'Sindh'),
(255, 74, 'Karachi'),
(256, 74, 'Islamabad'),
(257, 74, 'Ravalpindi'),
(258, 74, 'Lahore'),
(259, 75, 'Port Moresby'),
(260, 75, 'Lae'),
(261, 76, 'Manila'),
(262, 76, 'Navotas'),
(263, 77, 'Lublin'),
(264, 77, 'Torun'),
(265, 78, 'Lisbon '),
(266, 78, 'Oporto '),
(267, 78, 'Braga'),
(268, 78, 'Amadora'),
(269, 79, 'Doha'),
(270, 79, 'Abu Thaylah'),
(271, 79, 'Al Ghanim.'),
(272, 82, 'Riyadh'),
(273, 82, 'Jeedah'),
(274, 82, 'Macca'),
(275, 84, 'Alexandra'),
(276, 84, 'Tanjong Pagar '),
(277, 86, 'Cape Town'),
(278, 86, 'Johannesburg'),
(279, 86, 'Durban'),
(280, 86, 'Port Elizabeth'),
(281, 86, 'Kimberley'),
(282, 87, 'Changwon'),
(283, 87, 'Goyang'),
(284, 87, 'Icheon'),
(285, 89, 'Badajoz'),
(286, 89, 'Barcelona'),
(287, 89, 'Cantabria'),
(288, 90, 'Colombo'),
(289, 90, 'Moratuwa'),
(290, 90, 'Kandy'),
(291, 90, 'Galle'),
(292, 90, 'Jaffna'),
(293, 92, 'Stockholm'),
(294, 92, 'Gothenburg'),
(295, 92, 'Linköping'),
(296, 93, 'Zürich'),
(297, 93, 'Geneva'),
(298, 94, 'Al-Qutayfah'),
(299, 94, 'Ras al-Ayn'),
(300, 94, 'Al-Safira'),
(301, 95, 'Dushanbe1'),
(302, 95, 'Khujand2'),
(303, 95, 'Kulob'),
(304, 97, 'Bangkok'),
(305, 97, 'Pattaya'),
(306, 97, 'Phuket'),
(307, 99, 'Mersin'),
(308, 99, 'Istanbul'),
(309, 99, 'Kars'),
(310, 102, 'Abu Dhabi'),
(311, 102, 'Sharjah '),
(312, 102, 'Dubai '),
(313, 103, 'Alabama'),
(314, 103, 'Alaska'),
(315, 103, 'Arizona'),
(316, 103, 'Arkansas'),
(317, 103, 'California'),
(318, 103, 'Colorado'),
(319, 103, 'Connecticut'),
(320, 103, 'Delaware'),
(321, 103, 'Florida'),
(322, 103, 'Georgia'),
(323, 103, 'Hawaii'),
(324, 103, 'Idaho'),
(325, 103, 'Illinois'),
(326, 103, 'Indiana'),
(327, 103, 'Iowa'),
(328, 103, 'Kansas'),
(329, 103, 'Kentucky'),
(330, 106, 'Louisiana'),
(331, 106, 'Maine'),
(332, 106, 'Maryland'),
(333, 103, 'Michigan'),
(334, 103, 'Mississippi'),
(335, 103, 'Montana'),
(336, 103, 'Nevada'),
(337, 105, 'Caracas '),
(338, 106, 'Can Tho'),
(339, 106, 'Da Nang'),
(340, 107, 'Bulawayo'),
(341, 107, 'Harare ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip_passanger`
--

CREATE TABLE `tbl_trip_passanger` (
  `passanger_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `passanger_name` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trip_passanger`
--

INSERT INTO `tbl_trip_passanger` (`passanger_id`, `trip_id`, `passanger_name`, `status`, `book_id`, `created_date`) VALUES
(1, 3, 'Ritu', 'completed', 1, '2019-04-24 10:03:50'),
(2, 1, 'Niyati', 'booked', 2, '2019-04-24 10:03:56'),
(3, 5, 'Zahir', 'cancel', 19, '2019-04-24 12:31:14'),
(4, 5, 'ahmed', 'cancel', 19, '2019-04-24 12:31:14'),
(5, 5, 'test1', 'cancel', 20, '2019-04-24 12:59:05'),
(6, 5, 'test2', 'cancel', 20, '2019-04-24 12:59:05'),
(7, 5, 'Shreyu', 'cancel', 21, '2019-04-24 13:03:59'),
(8, 5, 'Shishir', 'cancel', 21, '2019-04-24 13:03:59'),
(9, 5, 'abc', 'cancel', 22, '2019-04-24 13:06:58'),
(10, 5, 'xyz', 'cancel', 22, '2019-04-24 13:06:58'),
(11, 5, 'zahir', 'cancel', 26, '2019-04-24 13:27:12'),
(12, 5, 'ahmed', 'cancel', 26, '2019-04-24 13:27:12'),
(13, 5, 'akku', 'cancel', 27, '2019-04-25 06:48:45'),
(14, 5, 'shreyu', 'cancel', 33, '2019-04-25 07:22:42'),
(15, 5, 'priyal', 'cancel', 33, '2019-04-25 07:22:42'),
(16, 5, 'priyal1', 'cancel', 34, '2019-04-25 07:25:27'),
(17, 5, 'priyal2', 'cancel', 34, '2019-04-25 07:25:27'),
(18, 5, 'priyal3', 'cancel', 34, '2019-04-25 07:25:27'),
(19, 5, 'priyal4', 'cancel', 34, '2019-04-25 07:25:27'),
(20, 5, 'Ritu', 'cancel', 35, '2019-04-25 07:33:54'),
(21, 8, 'test', 'cancel', 36, '2019-04-25 08:45:19'),
(22, 8, 'Ritu', 'cancel', 37, '2019-04-25 09:27:49'),
(23, 11, 'shrihu', 'completed', 38, '2019-04-25 10:05:22'),
(24, 19, 'Ritu', 'cancel', 39, '2019-04-25 11:20:46'),
(25, 19, 'Prince', 'cancel', 40, '2019-04-25 11:27:19'),
(26, 19, 'Princy', 'cancel', 40, '2019-04-25 11:27:19'),
(27, 19, 'Rituu', 'cancel', 41, '2019-04-25 11:41:24'),
(28, 19, 'rituuu', 'cancel', 41, '2019-04-25 11:41:24'),
(29, 19, 'Ritu', 'booked', 43, '2019-04-25 11:46:20'),
(30, 47, 'Ritu', 'cancel', 44, '2019-04-26 07:07:26'),
(31, 48, 'Ritu', 'completed', 45, '2019-04-26 07:18:27'),
(32, 48, 'Zahir', 'completed', 45, '2019-04-26 07:18:27'),
(33, 48, 'Ahmed', 'completed', 45, '2019-04-26 07:18:27'),
(34, 49, 'shreyu', 'cancel', 46, '2019-04-26 08:27:15'),
(35, 49, 'priyal', 'cancel', 46, '2019-04-26 08:27:15'),
(36, 58, 'Test 1 ', 'cancel', 49, '2019-04-26 10:54:08'),
(37, 58, 'Test 2', 'cancel', 49, '2019-04-26 10:54:08'),
(38, 59, 'R1', 'booked', 50, '2019-04-26 11:02:43'),
(39, 59, 'R2', 'cancel', 50, '2019-04-26 11:02:43'),
(40, 59, 'R3', 'cancel', 50, '2019-04-26 11:02:43'),
(41, 59, 'Ritu', 'cancel', 51, '2019-04-26 11:07:19'),
(42, 59, 'piyu', 'cancel', 51, '2019-04-26 11:07:19'),
(43, 59, 'shikha', 'cancel', 51, '2019-04-26 11:07:19'),
(44, 59, 'Ritu', 'cancel', 52, '2019-04-26 11:10:42'),
(45, 59, 'piyu', 'cancel', 52, '2019-04-26 11:10:42'),
(46, 59, 'shreyu', 'cancel', 52, '2019-04-26 11:10:42'),
(47, 59, 'Ritu', 'cancel', 53, '2019-04-26 11:16:06'),
(48, 59, 'piyu', 'cancel', 53, '2019-04-26 11:16:06'),
(49, 59, 'shikha', 'cancel', 53, '2019-04-26 11:16:06'),
(50, 59, 'Ritu', 'cancel', 54, '2019-04-26 11:22:58'),
(51, 59, 'piyu', 'cancel', 54, '2019-04-26 11:22:58'),
(52, 59, 'shikha', 'cancel', 54, '2019-04-26 11:22:58'),
(53, 59, 'Ritu', 'cancel', 55, '2019-04-26 11:30:21'),
(54, 59, 'piyu', 'cancel', 55, '2019-04-26 11:30:21'),
(55, 59, 'rrr', 'cancel', 55, '2019-04-26 11:30:21'),
(56, 59, 'Ritu', 'cancel', 56, '2019-04-26 11:32:59'),
(57, 59, 'tg', 'cancel', 56, '2019-04-26 11:32:59'),
(58, 59, 'snfxjg', 'cancel', 56, '2019-04-26 11:32:59'),
(59, 59, 'Ritu', 'cancel', 57, '2019-04-26 11:52:30'),
(60, 59, 'piyu', 'cancel', 57, '2019-04-26 11:52:30'),
(61, 59, 'Prabhat', 'cancel', 58, '2019-04-26 12:03:56'),
(62, 59, 'ashok', 'cancel', 58, '2019-04-26 12:03:56'),
(63, 59, 'kangna', 'cancel', 58, '2019-04-26 12:03:56'),
(64, 62, 'test 1', 'completed', 59, '2019-04-26 12:32:59'),
(65, 62, 'test 2', 'completed', 59, '2019-04-26 12:32:59'),
(66, 62, 'test 3', 'completed', 59, '2019-04-26 12:32:59'),
(67, 61, 'Test', 'completed', 60, '2019-04-26 13:12:11'),
(68, 60, 'Ashok', 'cancel', 62, '2019-04-26 14:12:34'),
(69, 60, 'ritu', 'cancel', 62, '2019-04-26 14:12:34'),
(70, 60, 'harsh', 'cancel', 62, '2019-04-26 14:12:34'),
(71, 60, 'prabhat', 'cancel', 62, '2019-04-26 14:12:34'),
(72, 63, 'Ashok', 'completed', 65, '2019-04-26 14:47:35'),
(73, 64, 'Ritu', 'completed', 66, '2019-04-27 06:53:48'),
(74, 64, 'priyal', 'completed', 66, '2019-04-27 06:53:48'),
(75, 64, 'Ritu', 'completed', 68, '2019-04-27 07:06:36'),
(76, 64, 'yoo', 'completed', 68, '2019-04-27 07:06:36'),
(77, 64, 'Test', 'completed', 70, '2019-04-27 07:35:34'),
(78, 64, 'test2', 'completed', 70, '2019-04-27 07:35:34'),
(79, 64, 'Test', 'completed', 71, '2019-04-27 07:43:54'),
(80, 64, 'Test3', 'completed', 71, '2019-04-27 07:43:54'),
(81, 66, 'Nidhi', 'cancel', 72, '2019-04-27 07:57:53'),
(82, 66, 'Niyati', 'cancel', 72, '2019-04-27 07:57:53'),
(83, 65, 'Nidhi', 'completed', 74, '2019-04-27 08:18:55'),
(84, 65, 'Niyati', 'completed', 74, '2019-04-27 08:18:55'),
(85, 65, 'Bhavya', 'completed', 74, '2019-04-27 08:18:55'),
(86, 65, 'Palak', 'completed', 74, '2019-04-27 08:18:55'),
(87, 67, 'Nidhi', 'completed', 75, '2019-04-27 08:32:51'),
(88, 67, 'Niyati', 'completed', 75, '2019-04-27 08:32:51'),
(89, 67, 'Rutva', 'completed', 75, '2019-04-27 08:32:51'),
(90, 65, 'Nidhi', 'completed', 76, '2019-04-27 09:31:28'),
(91, 65, 'Nidhi', 'completed', 76, '2019-04-27 09:32:03'),
(92, 68, 'Nidhi', 'booked', 78, '2019-04-27 11:19:18'),
(93, 68, 'niyati', 'booked', 78, '2019-04-27 11:19:18'),
(94, 68, 'vidhi', 'booked', 78, '2019-04-27 11:19:18'),
(95, 70, 'Akshansh', 'completed', 79, '2019-04-27 11:34:53'),
(96, 70, 'nikhil', 'completed', 79, '2019-04-27 11:34:53'),
(97, 64, 'Ritu', 'onboard', 80, '2019-04-27 12:29:46'),
(98, 64, 'Akshansh', 'onboard', 81, '2019-04-27 12:32:15'),
(99, 69, 'Nidhi', 'cancel', 82, '2019-04-27 12:38:44'),
(100, 69, 'Niyati', 'cancel', 82, '2019-04-27 12:38:44'),
(101, 69, 'Meshwa', 'cancel', 82, '2019-04-27 12:38:44'),
(102, 69, 'Halak', 'cancel', 82, '2019-04-27 12:38:44'),
(103, 71, 'Nidhi', 'completed', 83, '2019-04-27 13:26:07'),
(104, 71, 'Nidhi', 'completed', 84, '2019-04-27 13:28:58'),
(105, 71, 'ritu', 'completed', 84, '2019-04-27 13:28:58'),
(106, 71, 'halak', 'completed', 84, '2019-04-27 13:28:58'),
(107, 71, 'test 1', 'completed', 85, '2019-04-27 13:37:32'),
(108, 71, 'test 2', 'completed', 85, '2019-04-27 13:37:32'),
(109, 71, 'test 3', 'completed', 85, '2019-04-27 13:37:32'),
(110, 71, 'Ritu', 'completed', 86, '2019-04-27 13:38:06'),
(111, 71, 'zahir', 'completed', 86, '2019-04-27 13:38:06'),
(112, 71, 'ahmed', 'completed', 86, '2019-04-27 13:38:06'),
(113, 73, 'Nidhi', 'completed', 87, '2019-04-27 13:42:39'),
(114, 73, 'nikhil', 'completed', 87, '2019-04-27 13:42:39'),
(115, 73, 'halak', 'completed', 87, '2019-04-27 13:42:39'),
(116, 73, 'heli', 'completed', 87, '2019-04-27 13:42:39'),
(117, 73, 'Test', 'completed', 88, '2019-04-27 13:44:02'),
(118, 74, 'Nidhi', 'completed', 89, '2019-04-27 13:52:28'),
(119, 74, 'bhargavi', 'completed', 89, '2019-04-27 13:52:28'),
(120, 74, 'dipa', 'completed', 89, '2019-04-27 13:52:28'),
(121, 74, 'erica', 'completed', 89, '2019-04-27 13:52:28'),
(122, 75, 'Test', 'completed', 90, '2019-04-27 14:06:48'),
(123, 75, 'test2', 'completed', 90, '2019-04-27 14:06:48'),
(124, 75, 'test3', 'completed', 90, '2019-04-27 14:06:48'),
(125, 75, 'test4', 'completed', 90, '2019-04-27 14:06:48'),
(126, 72, 'Ritu', 'completed', 91, '2019-04-27 14:14:57'),
(127, 72, 'zahir', 'completed', 91, '2019-04-27 14:14:57'),
(128, 72, 'ahmed', 'completed', 91, '2019-04-27 14:14:57'),
(129, 72, 'test A', 'completed', 92, '2019-04-27 14:15:52'),
(130, 72, 'test B', 'completed', 92, '2019-04-27 14:15:52'),
(131, 72, 'test C', 'completed', 92, '2019-04-27 14:15:52'),
(132, 76, 'Ritu', 'completed', 93, '2019-04-29 05:16:15'),
(133, 76, 'zahir', 'completed', 93, '2019-04-29 05:16:15'),
(134, 76, 'ahmed', 'completed', 93, '2019-04-29 05:16:15'),
(135, 78, 'Ritu', 'completed', 94, '2019-04-29 05:37:19'),
(136, 78, 'Piyu', 'completed', 94, '2019-04-29 05:37:19'),
(137, 28, '', 'booked', 1, '2019-04-29 05:37:38'),
(138, 54, '', 'booked', 1, '2019-04-29 05:38:48'),
(139, 49, '', 'booked', 1, '2019-04-29 05:39:37'),
(140, 49, '', 'booked', 1, '2019-04-29 05:41:17'),
(141, 79, 'Ritu', 'cancel', 95, '2019-04-29 05:50:43'),
(142, 79, 'zahir', 'cancel', 95, '2019-04-29 05:50:43'),
(143, 79, 'ahmed', 'cancel', 95, '2019-04-29 05:50:43'),
(144, 79, 'Ritu', 'cancel', 97, '2019-04-29 08:16:34'),
(145, 79, 'zahir', 'cancel', 97, '2019-04-29 08:16:34'),
(146, 91, 'Nidhi', 'cancel', 98, '2019-04-29 12:36:12'),
(147, 91, 'niyati', 'cancel', 98, '2019-04-29 12:36:12'),
(148, 91, 'juhi', 'cancel', 98, '2019-04-29 12:36:12'),
(149, 91, 'rahi', 'cancel', 98, '2019-04-29 12:36:12'),
(150, 92, 'Nidhi', 'completed', 99, '2019-04-29 12:49:07'),
(151, 92, 'heli', 'completed', 99, '2019-04-29 12:49:07'),
(152, 92, 'ayushi', 'completed', 99, '2019-04-29 12:49:07'),
(153, 92, 'test', 'cancel', 99, '2019-04-29 12:49:07'),
(154, 93, 'akash', 'cancel', 100, '2019-04-29 13:11:02'),
(155, 93, 'akshansh', 'completed', 100, '2019-04-29 13:11:02'),
(156, 93, 'Nidhi', 'completed', 101, '2019-04-29 13:12:59'),
(157, 93, 'mansi', 'completed', 101, '2019-04-29 13:12:59'),
(158, 93, 'juhi', 'cancel', 101, '2019-04-29 13:12:59'),
(159, 97, 'Ritu', 'completed', 102, '2019-04-29 14:20:35'),
(160, 99, 'Ritu', 'completed', 104, '2019-04-30 04:57:15'),
(161, 100, 'Ritu', 'completed', 105, '2019-04-30 05:06:40'),
(162, 101, 'Ritu', 'completed', 106, '2019-04-30 05:17:15'),
(163, 101, 'Anjali', 'cancel', 106, '2019-04-30 05:17:15'),
(164, 102, 'Ritu', 'completed', 107, '2019-04-30 05:23:10'),
(165, 103, 'Ritu', 'completed', 108, '2019-04-30 05:36:47'),
(166, 103, 'Priyal', 'completed', 108, '2019-04-30 05:36:47'),
(167, 103, 'shreyu', 'cancel', 108, '2019-04-30 05:36:47'),
(168, 104, 'Ritu', 'completed', 109, '2019-04-30 05:44:33'),
(169, 104, 'zahir', 'completed', 109, '2019-04-30 05:44:33'),
(170, 104, 'ahmed', 'completed', 109, '2019-04-30 05:44:33'),
(171, 104, 'hello', 'completed', 110, '2019-04-30 05:45:41'),
(172, 105, 'Ritu', 'completed', 111, '2019-04-30 05:53:15'),
(173, 105, 'piyu', 'completed', 111, '2019-04-30 05:53:15'),
(174, 105, 'shreyu', 'cancel', 111, '2019-04-30 05:53:15'),
(175, 107, 'test', 'completed', 112, '2019-04-30 06:14:07'),
(176, 109, 'Ritu', 'completed', 113, '2019-04-30 06:17:29'),
(177, 109, 'Ritu', 'completed', 113, '2019-04-30 06:18:03'),
(178, 109, 'Ritu', 'completed', 113, '2019-04-30 06:18:51'),
(179, 109, 'Ritu', 'completed', 113, '2019-04-30 06:19:01'),
(180, 106, 'akku', 'completed', 114, '2019-04-30 06:28:50'),
(181, 108, 'test', 'cancel', 115, '2019-04-30 10:25:06'),
(182, 110, 'test', 'cancel', 134, '2019-04-30 11:31:20'),
(183, 110, 'Nidhi', 'cancel', 135, '2019-04-30 11:37:48'),
(184, 110, 'test one', 'cancel', 136, '2019-04-30 11:49:15'),
(185, 110, 'Nidhi', 'cancel', 137, '2019-04-30 11:50:53'),
(186, 110, 'Nidhi', 'cancel', 138, '2019-04-30 11:57:27'),
(187, 110, 'test three', 'cancel', 139, '2019-04-30 11:57:29'),
(188, 114, 'Testpassenger', 'booked', 141, '2019-05-01 11:48:37'),
(189, 118, 'testone', 'completed', 142, '2019-05-01 12:23:37'),
(190, 118, 'testtwo', 'cancel', 142, '2019-05-01 12:23:37'),
(191, 121, 'Ritu', 'cancel', 143, '2019-05-02 06:22:02'),
(192, 122, 'Ritu', 'cancel', 146, '2019-05-02 06:26:12'),
(193, 121, 'Nidhi', 'booked', 145, '2019-05-02 06:47:09'),
(194, 124, 'Nidhi', 'booked', 147, '2019-05-02 11:21:43'),
(195, 128, 'gavufebid dazbusyk ', 'completed', 148, '2019-05-02 13:03:31'),
(196, 126, 'test', 'completed', 149, '2019-05-02 13:18:22'),
(197, 126, 'test 1', 'completed', 149, '2019-05-02 13:18:22'),
(198, 126, 'test 2', 'completed', 149, '2019-05-02 13:18:22'),
(199, 126, 'test 3', 'completed', 149, '2019-05-02 13:18:22'),
(200, 126, 'Nidhi', 'completed', 150, '2019-05-02 13:36:43'),
(201, 130, 'test', 'cancel', 151, '2019-05-03 06:06:03'),
(202, 130, 'test1', 'cancel', 152, '2019-05-03 06:08:01'),
(203, 130, 'test2', 'cancel', 152, '2019-05-03 06:08:01'),
(204, 130, 'test3', 'cancel', 152, '2019-05-03 06:08:01'),
(205, 131, 'test', 'completed', 153, '2019-05-03 07:10:19'),
(206, 134, 'akku', 'completed', 154, '2019-05-06 13:04:49'),
(207, 134, 'test', 'booked', 154, '2019-05-06 13:04:49'),
(208, 135, 'akku', 'completed', 155, '2019-05-07 10:19:38'),
(209, 135, 'pkku', 'booked', 155, '2019-05-07 10:19:38'),
(210, 135, 'Nidhi', 'completed', 156, '2019-05-07 10:20:16'),
(211, 135, 'heli', 'booked', 156, '2019-05-07 10:20:16'),
(212, 135, 'halak', 'completed', 156, '2019-05-07 10:20:16'),
(213, 136, 'Nidhi', 'completed', 157, '2019-05-07 12:13:45'),
(214, 136, 'ritu', 'completed', 157, '2019-05-07 12:13:45'),
(215, 136, 'rutu', 'booked', 157, '2019-05-07 12:13:45'),
(216, 138, 'Nidhi', 'completed', 158, '2019-05-08 06:47:00'),
(217, 138, 'test', 'completed', 158, '2019-05-08 06:47:00'),
(218, 138, 'testtwo', 'completed', 158, '2019-05-08 06:47:00'),
(219, 138, 'testthree', 'booked', 158, '2019-05-08 06:47:00'),
(220, 139, 'Nidhi', 'cancel', 159, '2019-05-08 09:11:39'),
(221, 139, 'test', 'cancel', 159, '2019-05-08 09:11:39'),
(222, 139, 'data', 'cancel', 159, '2019-05-08 09:11:39'),
(223, 6, 'Akshansh', 'booked', 161, '2019-07-22 11:05:48'),
(224, 6, 'Akku', 'booked', 162, '2019-07-22 12:44:21'),
(225, 5, 'akku', 'cancel', 163, '2019-07-23 05:20:41'),
(226, 7, 'Test 1', 'cancel', 164, '2019-07-23 07:02:32'),
(227, 7, 'Test 2', 'cancel', 164, '2019-07-23 07:02:32'),
(228, 7, 'Test 3', 'cancel', 164, '2019-07-23 07:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userdata`
--

CREATE TABLE `tbl_userdata` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `old_password` varchar(100) DEFAULT NULL,
  `sentcode` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `photo` text NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `status` enum('active','deactive') DEFAULT 'active',
  `device_id` varchar(250) DEFAULT NULL,
  `device_token` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_type` varchar(50) DEFAULT NULL,
  `getcode` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_userdata`
--

INSERT INTO `tbl_userdata` (`id`, `fname`, `lname`, `user_email`, `username`, `password`, `old_password`, `sentcode`, `mobile_number`, `gender`, `photo`, `country`, `status`, `device_id`, `device_token`, `created_date`, `login_type`, `getcode`, `token`) VALUES
(1, 'Ritu', 'Rajan', 'ritu@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '11556540912.png', '', 'active', 'android', '', '2019-04-24 06:27:37', '', '', ''),
(2, 'Ritu', 'Rajan', 'ritunambath@gmail.com', '', '', '', '', '', '', '21556192718.png', 'ritunambath@gmail.com', 'active', 'android', '', '2019-04-24 06:50:41', 'glogin', '', '108773921941236667329'),
(5, 'Prabhat', 'Tyagi', 'harshtyagi26@gmail.com', '', '', '', '', '', '', '51556280144.png', 'harshtyagi26@gmail.com', 'active', 'android', 'c58fgM6wM1g:APA91bFZU5kvj2UCTRdHkKzSoh3s6ThNi9sJiys9DwkC_m9NOPiqxTdqz6aBSsM5UQ5OIcpWffVksIZKEYbCGbjYUJVXSE0UrziFTUUlK1CsseaFxR7LLCdia5JXDqd0IkAfoOGv1Pq4', '2019-04-24 06:56:39', 'glogin', '', '112394502836774014807'),
(7, 'AKKU', 'test', 'akshansh.eleganzit@gmail.com', '', '7694f4a66316e53c8cdd9d9954bd611d', '7694f4a66316e53c8cdd9d9954bd611d', '', '1234567890', 'male', '', '', 'active', 'ios', '', '2019-04-26 08:52:36', 'glogin', '', 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjZlNTUwOGQyNzk2NWFkNz'),
(8, 'Ashok', 'Tyagi', 'ashok.ashu.tyagi@gmail.com', '', '', '', '', '9662737788', '', '', '', 'active', 'android', 'fft4Pb8h5No:APA91bHvTIvleaImiFSFBt15eLtQGU6WL9UY2KJC6Jn1G3JBkN0d2xTUzv05LmccQX_2voHTf-BefZ2LByBAfX1G_FXaROWuUBfhL3VTbOQzkRu08sjnL-UJTZ28F_i25LDXOW24tf4D', '2019-04-26 14:01:54', 'glogin', '', '117745640496158841707'),
(9, 'Ritu', 'Rajan', 'ritu.eleganzit@gmail.com', '', '', '', '', '', 'male', '', '', 'active', 'android', 'ec8bYBPbVP8:APA91bEoV_4tr7UpHVEMru6YvsKKePWe5FWSPI_Or20cfxzPMwUngOq82GjzO_l7dUI3jO1TneZuhYKe2_AXL2T52OGZiQvDEQpl-g935jz1q2-Gm4N7Y6CxKStdOMRpyUAIaCnAsneK', '2019-04-26 14:06:25', 'glogin', '', '101211109454086516332'),
(10, 'Nidhi', 'Mehta', 'Nidhi@mailinator.com', '', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', '', '1782239', '', '101556348248.jpg', '', 'active', 'android', '', '2019-04-27 06:55:39', '', '', ''),
(11, 'Test', 'Sober', 'sobertest1@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', '', '', 'male', '', '', 'active', 'android', 'cprvNw60WU0:APA91bGxNCOLeikp7zXoW2TlDFxS5xEdm-ASiMQWVejl5K7G-FWYf55SjnX0NLH7_1Fa8LNgcd4GyV-aJcR-qTyezduHF-y2RV63f1-tl1Poer7Zs5nJSJJojWlhcKtzqd_tm44IM5UJ', '2019-04-27 07:34:55', 'glogin', '', '116721264669760383284'),
(12, 'Test', 'app', 'ele.testapp@gmail.com', '', '', '', '', '', 'male', '', '', 'active', 'android', 'f38z0xD3T_A:APA91bGMQ6PvAYmfonGI5j6m1qxbMwpShmXZN8X1njXvTVp3Zs5rOuRkk2MFI8EtwPUpuXjfA0guOOqZSqhy0g1JS2INPKo1RbmohMqVYps18CNV0WluJgz13aGpQgLEAjTLFe3VYd99', '2019-04-27 13:42:30', 'glogin', '', '105117778958343633647'),
(14, 'Testdata', 'test', 'testdata@gmail.com', '', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', '', '9494942727', 'male', '141556521407.png', '', 'active', 'ios', '0F3BF7093BBD40B52BCF0886C683A9CBA725AC911C8F0E31B9A4981284F3D449', '2019-04-29 06:37:56', '', '', ''),
(15, 'test', 'ios', 'testios@mailinator.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '72882282', 'male', '151556542606.png', '', 'active', 'ios', 'C10D34FEDCA47418F5C55F3254A044E9D491A7D18DFF715F3FF10F88C15E85D2', '2019-04-29 12:55:45', '', '', ''),
(16, 'ios', 'app test', 'ios@mailinator.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '728828282', 'male', '161556610447.png', '', 'active', 'ios', '', '2019-04-30 07:45:25', '', '', ''),
(17, 'ios', 'one', 'iosone@mailinator.com', '', 'fcea920f7412b5da7be0cf42b8c93759', 'fcea920f7412b5da7be0cf42b8c93759', '', '467768383', 'male', '171556612403.png', '', 'active', 'android', '', '2019-04-30 08:14:49', '', '', ''),
(25, 'Khushbu', 'bhatt', 'rjkhushi4u@gmail.com', '', '', '', '', '', 'male', '', '', 'active', 'ios', '0F3BF7093BBD40B52BCF0886C683A9CBA725AC911C8F0E31B9A4981284F3D449', '2019-04-30 08:53:06', 'glogin', '', 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjVkODg3ZjI2Y2UzMjU3N2'),
(33, 'Akshansh', 'Modi', 'akshanshmodi@gmail.com', '', '', '', '', '254-794-567485', 'male', '331556617236.png', '', 'active', 'ios', '', '2019-04-30 09:40:02', 'glogin', '', 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImFmZGU4MGViMWVkZjlmM2'),
(34, 'testing', 'yasham', 'testyasham@gmail.com', '', '', '', '', '', 'male', '', '', 'active', 'android', 'c8eUe1pU4d0:APA91bHenmclaOCgHfUF40WlSECB1xjgr2Iva3370Jg12zKFxO3SvZdlferbxLWqMo0uMaMPX6p_Y5Lu7uwW9snLoroJyn92nL32lzs3AuulfYqk3mIYrj8CEBD2lcVI9XZhfQktW8-5', '2019-04-30 23:27:44', 'glogin', '', '107333919063265747082'),
(36, 'Test', 'User', 'testu@gmail.com', '', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', '', '2589631470', '', '361556713324.jpg', '', 'active', 'android', '', '2019-05-01 12:21:41', '', '', ''),
(38, 'test', 'user', 'testuser@mailinatot.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '89746513', '', '381556863311.png', '', 'active', 'android', '', '2019-05-03 06:01:18', '', '', ''),
(39, 'Sai Sri Mourya', 'Gudladona', 'mourya.gudladona@gmail.com', '', 'b7113566a4b22ab38dabe7a4333dc7ab', 'b7113566a4b22ab38dabe7a4333dc7ab', '', ',N,*;N;N,,*;*+*+', '', '', '', 'active', '', 'ePRpw44U7u0:APA91bHgHKnP4SF83z6LqS6GjTlX1mzt53TFw6axCrLsqD25UMCjBbiHEeOz0u20yUgtjeIXfeUU_O7sKt6vWdExqWVRgj4MI5HwseVyBS0yG8SiLKb-lgc7jYZX9zrvi4YLZeXxVXSj', '2019-05-04 13:56:25', '', '', ''),
(40, 'Pat', 'Test', 'patih4@yahoo.com', '', 'f8d9edde7646636132bbd3b03b1a6e1b', 'f8d9edde7646636132bbd3b03b1a6e1b', '', '12345678945', '', '401557193373.jpg', 'patih4@yahoo.com', 'active', '', 'epYMpKXMPkg:APA91bFzTnH05ACMHIhX0MVAjcIQwNjbEUropasYc5zZGSUq5EXzZHybWwacdxTMMvXa0l6tav0XEe64qMDPeikiSWRXDDgHQBkeiXBQr8b-LN515YYdIpPLyLr5xV451f48f9Nnjavi', '2019-05-07 01:40:59', '', '', ''),
(41, 'Patrick ', '2nd-User', 'bogus.b@yahoo.com', '', '2a1adca1ea33d9cae445e7aef36f855b', '2a1adca1ea33d9cae445e7aef36f855b', '', '763456798', 'male', '411557876741.png', '', 'active', 'ios', '804579F36EFA5D641FC58AC0D856931046D72DB6D18932CD0BC77FA844D0BC6C', '2019-05-14 23:30:14', '', '', ''),
(42, 'John', 'Musonye', 'johnmusonye@gmail.com', '', '973e323052fe975becef433d13c23aa1', '973e323052fe975becef433d13c23aa1', '', '0722429667', '', '', '', 'active', '', 'fOe9-2pGzlA:APA91bH_N4hp63LMYLTDJr9zbpRu9e5_xz1Ds2ToygtU4FB3qaWgVuLFL4nie4TbsNwuJ_ThFcQUymJ9ZfocB99XmoDOEnZqY50cblb0x0TYhRDQYNLSOInc7aGJClvl9m4ArietRQm6', '2019-05-19 17:58:23', '', '', ''),
(43, 'Teddy', 'Muteshi', 'muteshiteddy@gmail.com', '', '970d939d7687b1d8f4caaa9c8beb7931', '970d939d7687b1d8f4caaa9c8beb7931', '', '', '', '', '', 'active', 'android', 'escVL85YXtU:APA91bFKS3JmgSwdwJ6DDa0uaBonp10RUmaRPJoXCS9B2jNfq6i8o8hBRObCsS2p0f1MhZBQ0VDyJtHyy2WvBL4y0qsDZx5Hirvx0udcyiBwVHt_rE4na3_mG9QpqY9F-UjRXOXDToyV', '2019-05-20 09:09:40', '', '', ''),
(44, 'Blahblah', 'Blah', 'blah.gov@gmail.com', '', '', '', '', '2025890752', '', '441559309934.jpg', '', 'active', 'android', 'dTt8nzY6HPc:APA91bGopnq9olhdublXO9oMCCrLQcP4ogSr6UYBXXdAPbkYrd6GTp2SPPUzIBA4NfpJO1-cWnSrgP63jTC5dN8CF0eJRfX0rdeY05C4RhUukzCKSH43drcd1TaAvitGUitfyosZpZkk', '2019-05-31 13:26:46', 'glogin', '', '108181462159810622897'),
(45, 'Pat', 'Mwai', 'patproemail83@gmail.com', '', '', '', '', '', 'male', '', '', 'active', 'android', 'dTt8nzY6HPc:APA91bGopnq9olhdublXO9oMCCrLQcP4ogSr6UYBXXdAPbkYrd6GTp2SPPUzIBA4NfpJO1-cWnSrgP63jTC5dN8CF0eJRfX0rdeY05C4RhUukzCKSH43drcd1TaAvitGUitfyosZpZkk', '2019-06-15 02:29:16', 'glogin', '', '115058395898480157416'),
(46, 'Tom', 'Ferton', 'allnationsrestndlounge@gmail.com', '', '', '', '', '', '', '461560640788.jpg', 'allnationsrestndlounge@gmail.com', 'active', 'android', 'dTt8nzY6HPc:APA91bGopnq9olhdublXO9oMCCrLQcP4ogSr6UYBXXdAPbkYrd6GTp2SPPUzIBA4NfpJO1-cWnSrgP63jTC5dN8CF0eJRfX0rdeY05C4RhUukzCKSH43drcd1TaAvitGUitfyosZpZkk', '2019-06-15 02:29:47', 'glogin', '', '114937645307974684601'),
(47, 'Ritu', 'Rj', 'riturj@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', 'active', 'android', 'cP9L9LzbFpg:APA91bF-SukufESthF8pz32cypoYcSRwK8ub6w8QoPeV86oqmyE_eFPL4P_AX9t5KBgl3M5RGtyf0lSgurY7z_G9iYSnaUo4Q4gEQ3qyHLgvrKRchklWDSfW4uKTkWUptz0hawZohLLf', '2019-07-02 05:38:49', '', '', ''),
(48, 'Akshansh', 'Modi', 'akku@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '9427272794', 'male', '481563264414.png', '', 'active', 'android', '', '2019-07-16 08:05:35', '', '', ''),
(49, 'AKKU', 'MODI', 'akshansh@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '', '9887988798', 'male', '491563268262.png', '', 'active', 'ios', '', '2019-07-16 09:10:17', '', '', ''),
(52, 'Test-First', 'Test-Last', 'Test@gmail.com', '', '', '', '1234', ' 254987654321', 'male', '', '', 'active', '', '', '2019-07-25 12:54:34', '', '', ''),
(53, 'Akshansh', 'modi', 'akshansh@gmail.com', '', '', '', '1234', '254111222333', 'male', '', '', 'active', '', '', '2019-07-25 13:05:07', '', '', ''),
(54, '', '', 'nirav', '', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 'male', '', '', 'active', 'android', '1235', '2019-07-25 13:35:15', '', '', ''),
(55, '', '', 'ajay', '', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 'male', '', '', 'active', 'android', '', '2019-07-25 13:43:19', '', '', ''),
(56, '', '', 'ajay@gmail.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', '', '', 'male', '', '', 'active', 'android', '123', '2019-07-26 05:29:02', '', '', ''),
(57, 'Akshansh', 'Modi', 'akshanshmodi@gmail.com', '', '', '', '1234', '254111222333', 'male', '', '', 'active', '', '', '2019-07-26 06:02:35', '', '', ''),
(59, 'Test1', 'Eleganzit1', 'TestEleganzit@gmail.com', '', '', '', '1234', '254111111111', 'male', '591564131866.png', '', 'active', '', '', '2019-07-26 06:20:01', '', '', ''),
(62, 'test', 'test', 'test@gmail.com', '', '', '', '1234', '254123123123', 'male', '', '', 'active', '', '', '2019-07-26 06:26:25', '', '', ''),
(63, 'test', 'test', 'test@gmail.com', '', '', '', '1234', '254123123123', 'male', '', '', 'active', '', '', '2019-07-26 06:28:32', '', '', ''),
(66, NULL, NULL, '123', NULL, '8d2d83e9c0481bdbd7dbaaed63ce10bc', '8d2d83e9c0481bdbd7dbaaed63ce10bc', NULL, NULL, NULL, '', NULL, 'active', 'android', NULL, '2019-07-26 07:00:12', NULL, NULL, NULL),
(67, NULL, NULL, 'aku@gmail.com', NULL, 'b91d16cd195b61d2c81339e7b0f0ea78', 'b91d16cd195b61d2c81339e7b0f0ea78', NULL, NULL, NULL, '', NULL, 'active', 'android', '123', '2019-07-26 07:18:23', NULL, NULL, NULL),
(68, NULL, NULL, 'nirav@gmail.com', NULL, '18cd727dd441031553e0b72235e1c6d5', '18cd727dd441031553e0b72235e1c6d5', NULL, NULL, NULL, '', NULL, 'active', 'android', '123', '2019-07-26 08:58:27', NULL, NULL, NULL),
(69, NULL, NULL, 'nirav12@gmail.com', NULL, '5d92770f0458e66d145252ad34feee40', '5d92770f0458e66d145252ad34feee40', NULL, NULL, NULL, '', NULL, 'active', 'android', '123', '2019-07-26 09:02:42', NULL, NULL, NULL),
(70, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '96385225810', NULL, '', NULL, 'active', NULL, NULL, '2019-07-26 09:06:48', NULL, NULL, NULL),
(71, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '96385225811', NULL, '', NULL, 'active', NULL, NULL, '2019-07-26 09:10:55', NULL, NULL, NULL),
(72, NULL, NULL, 'niravchauhan64@gmail.com', NULL, '48db259f96b057dfa826d505aac7cbec', '48db259f96b057dfa826d505aac7cbec', NULL, NULL, NULL, '', NULL, 'active', 'android', '123', '2019-07-26 10:11:45', NULL, NULL, NULL),
(73, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '9898098980', NULL, '', NULL, 'active', NULL, NULL, '2019-07-26 11:48:19', NULL, NULL, NULL),
(74, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '*', NULL, '', NULL, 'active', NULL, NULL, '2019-07-26 11:51:57', NULL, NULL, NULL),
(75, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '989809898', NULL, '', NULL, 'active', NULL, NULL, '2019-07-26 12:56:01', NULL, NULL, NULL),
(76, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '222222222', NULL, '', NULL, 'active', NULL, NULL, '2019-07-26 13:08:16', NULL, NULL, NULL),
(77, NULL, NULL, '91priyansh@gmail.com', NULL, 'ed2c1eddbb439112963437606570958f', 'ed2c1eddbb439112963437606570958f', NULL, NULL, NULL, '', NULL, 'active', 'android', '123', '2019-07-28 05:57:22', NULL, NULL, NULL),
(78, NULL, NULL, 'nik@gmail.com', NULL, 'a69db5ed603b69408305d19006e144bf', 'a69db5ed603b69408305d19006e144bf', NULL, NULL, NULL, '', NULL, 'active', 'android', '123', '2019-07-29 07:39:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `mechanic_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `con_pwd` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date_time` date NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'deactive',
  `email_code` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`mechanic_id`, `full_name`, `phone_no`, `email_id`, `pwd`, `con_pwd`, `street`, `city`, `state`, `country`, `date_time`, `status`, `email_code`) VALUES
(1, 'Mechanic one', '5678999910', 'mechanic@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Happy Street', 'Ahmedabad', 'Gujarat', 'India', '2019-04-29', 'deactive', ''),
(2, 'Niyati', '1234567890', 'niyati.eleganzit@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', 'Novotel hotel lane', 'Ahmedabad', 'Gujarat', 'India', '2019-05-10', 'deactive', '78590'),
(3, 'meet', '7896562352', 'meet@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'R-401 Grren city ', 'Ahmedabad', 'Gujarat', 'India', '2019-05-14', 'deactive', ''),
(4, 'Niyati', '1236547890', 'niyati@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', 'Jodhpur gam', 'Ahmedabad', 'Gujarat', 'India', '2019-05-14', 'deactive', ''),
(5, 'Niyati', '1236547890', 'niyatione@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', 'Jodhpur gam', 'Ahmedabad', 'Gujarat', 'India', '2019-05-14', 'deactive', ''),
(6, 'testhalak', '5685965263', 'testhalak@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'fgjdfgdjkgjkdgkjdgj', 'Ahmedabad', 'Codrington', 'Antigua & Barbuda', '2019-05-15', 'deactive', ''),
(7, 'Test', '3698524710', 'testone@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'iskon cross road', 'Ajmer', 'Gujarat', 'India', '2019-05-15', 'deactive', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_devicedata`
--

CREATE TABLE `tbl_user_devicedata` (
  `devicedata_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(10) NOT NULL,
  `device_token` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_trips`
--

CREATE TABLE `tbl_user_trips` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `comments` text NOT NULL,
  `cancel_reason` text NOT NULL,
  `status` enum('0','confirm','cancel','booked','onboard','missed','completed') NOT NULL DEFAULT '0',
  `trip_screenshot` text NOT NULL,
  `datetime` datetime NOT NULL,
  `notify_datetime` datetime NOT NULL,
  `notify_count` tinyint(4) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_trips`
--

INSERT INTO `tbl_user_trips` (`id`, `trip_id`, `user_id`, `driver_id`, `rating`, `comments`, `cancel_reason`, `status`, `trip_screenshot`, `datetime`, `notify_datetime`, `notify_count`, `created_date`) VALUES
(1, 1, 2, 3, '1.0', 'noo', '', 'booked', 'no_map.png', '2019-04-24 15:33:40', '0000-00-00 00:00:00', 0, '2019-04-24 10:03:40'),
(2, 1, 4, 3, '', '', 'test', 'cancel', 'no_map.png', '2019-04-24 15:33:44', '0000-00-00 00:00:00', 0, '2019-04-24 10:03:44'),
(3, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:15:21', '0000-00-00 00:00:00', 0, '2019-04-24 11:45:21'),
(4, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:16:58', '0000-00-00 00:00:00', 0, '2019-04-24 11:46:58'),
(5, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:23:05', '0000-00-00 00:00:00', 0, '2019-04-24 11:53:05'),
(6, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:25:47', '0000-00-00 00:00:00', 0, '2019-04-24 11:55:47'),
(7, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:29:23', '0000-00-00 00:00:00', 0, '2019-04-24 11:59:23'),
(8, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:31:24', '0000-00-00 00:00:00', 0, '2019-04-24 12:01:24'),
(9, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:35:10', '0000-00-00 00:00:00', 0, '2019-04-24 12:05:10'),
(10, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:38:14', '0000-00-00 00:00:00', 0, '2019-04-24 12:08:14'),
(11, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:40:57', '0000-00-00 00:00:00', 0, '2019-04-24 12:10:57'),
(12, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:42:38', '0000-00-00 00:00:00', 0, '2019-04-24 12:12:38'),
(13, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:44:06', '0000-00-00 00:00:00', 0, '2019-04-24 12:14:06'),
(14, 4, 2, 7, '', '', '', '0', '', '2019-04-24 17:45:40', '0000-00-00 00:00:00', 0, '2019-04-24 12:15:40'),
(15, 5, 2, 3, '', '', '', '0', '', '2019-04-24 17:48:47', '0000-00-00 00:00:00', 0, '2019-04-24 12:18:47'),
(16, 5, 2, 3, '', '', '', '0', '', '2019-04-24 17:49:43', '0000-00-00 00:00:00', 0, '2019-04-24 12:19:43'),
(17, 5, 2, 3, '', '', '', '0', '', '2019-04-24 17:51:30', '0000-00-00 00:00:00', 0, '2019-04-24 12:21:30'),
(18, 5, 2, 3, '', '', '', '0', '', '2019-04-24 17:56:22', '0000-00-00 00:00:00', 0, '2019-04-24 12:26:22'),
(19, 5, 2, 3, '', '', 'no', 'cancel', 'no_map.png', '2019-04-24 18:00:51', '0000-00-00 00:00:00', 0, '2019-04-24 12:30:51'),
(20, 5, 6, 3, '', '', 'test', 'cancel', 'no_map.png', '2019-04-24 18:28:36', '0000-00-00 00:00:00', 0, '2019-04-24 12:58:36'),
(21, 5, 2, 3, '', '', 'jj', 'cancel', 'no_map.png', '2019-04-24 18:33:28', '0000-00-00 00:00:00', 0, '2019-04-24 13:03:28'),
(22, 5, 6, 3, '', '', 'test cancel', 'cancel', 'no_map.png', '2019-04-24 18:35:44', '0000-00-00 00:00:00', 0, '2019-04-24 13:05:44'),
(23, 5, 2, 3, '', '', '', '0', '', '2019-04-24 18:45:17', '0000-00-00 00:00:00', 0, '2019-04-24 13:15:17'),
(24, 5, 2, 3, '', '', '', '0', '', '2019-04-24 18:51:45', '0000-00-00 00:00:00', 0, '2019-04-24 13:21:45'),
(25, 5, 2, 3, '', '', '', '0', '', '2019-04-24 18:54:40', '0000-00-00 00:00:00', 0, '2019-04-24 13:24:40'),
(26, 5, 2, 3, '', '', 'reason', 'cancel', 'no_map.png', '2019-04-24 18:55:24', '0000-00-00 00:00:00', 0, '2019-04-24 13:25:24'),
(27, 5, 6, 3, '', '', 'test', 'cancel', 'no_map.png', '2019-04-25 12:18:29', '0000-00-00 00:00:00', 0, '2019-04-25 06:48:29'),
(28, 5, 2, 3, '', '', '', '0', '', '2019-04-25 12:25:22', '0000-00-00 00:00:00', 0, '2019-04-25 06:55:22'),
(29, 5, 2, 3, '', '', '', '0', '', '2019-04-25 12:29:51', '0000-00-00 00:00:00', 0, '2019-04-25 06:59:51'),
(30, 5, 2, 3, '', '', '', '0', '', '2019-04-25 12:37:38', '0000-00-00 00:00:00', 0, '2019-04-25 07:07:38'),
(31, 5, 2, 3, '', '', '', '0', '', '2019-04-25 12:41:32', '0000-00-00 00:00:00', 0, '2019-04-25 07:11:32'),
(32, 5, 2, 3, '', '', '', '0', '', '2019-04-25 12:43:05', '0000-00-00 00:00:00', 0, '2019-04-25 07:13:05'),
(33, 5, 2, 3, '', '', 'no', 'cancel', 'no_map.png', '2019-04-25 12:52:18', '0000-00-00 00:00:00', 0, '2019-04-25 07:22:18'),
(34, 5, 2, 3, '', '', 'testing reason', 'cancel', 'no_map.png', '2019-04-25 12:54:48', '0000-00-00 00:00:00', 0, '2019-04-25 07:24:48'),
(35, 5, 2, 3, '', '', '', 'cancel', '21556177634.png', '2019-04-25 13:03:39', '0000-00-00 00:00:00', 0, '2019-04-25 07:33:39'),
(36, 8, 6, 3, '', '', '', 'completed', '61556181919.png', '2019-04-25 14:12:15', '0000-00-00 00:00:00', 0, '2019-04-25 08:42:15'),
(37, 8, 2, 3, '3.0', '', '', 'completed', '21556184469.png', '2019-04-25 14:57:01', '0000-00-00 00:00:00', 0, '2019-04-25 09:27:01'),
(38, 11, 2, 3, '1.0', 'nokojg', '', 'completed', '21556186722.png', '2019-04-25 15:34:30', '0000-00-00 00:00:00', 0, '2019-04-25 10:04:30'),
(39, 19, 2, 8, '', '', '', 'cancel', '21556191246.png', '2019-04-25 16:49:57', '0000-00-00 00:00:00', 0, '2019-04-25 11:19:57'),
(40, 19, 2, 8, '', '', '', 'cancel', '21556191639.png', '2019-04-25 16:54:06', '0000-00-00 00:00:00', 0, '2019-04-25 11:24:06'),
(41, 19, 2, 8, '', '', '', 'cancel', '21556192484.png', '2019-04-25 17:10:58', '0000-00-00 00:00:00', 0, '2019-04-25 11:40:58'),
(42, 19, 2, 8, '', '', '', '0', '', '2019-04-25 17:14:45', '0000-00-00 00:00:00', 0, '2019-04-25 11:44:45'),
(43, 19, 2, 8, '', '', '', 'booked', '21556192780.png', '2019-04-25 17:15:54', '0000-00-00 00:00:00', 0, '2019-04-25 11:45:54'),
(44, 47, 2, 3, '', '', 'no', 'cancel', 'no_map.png', '2019-04-26 12:37:17', '0000-00-00 00:00:00', 0, '2019-04-26 07:07:17'),
(45, 48, 2, 3, '', '', '', 'completed', '21556263107.png', '2019-04-26 12:47:32', '0000-00-00 00:00:00', 0, '2019-04-26 07:17:32'),
(46, 49, 2, 3, '', '', 'no', 'cancel', 'no_map.png', '2019-04-26 13:56:08', '0000-00-00 00:00:00', 0, '2019-04-26 08:26:08'),
(47, 58, 6, 3, '', '', '', '0', '', '2019-04-26 16:18:05', '0000-00-00 00:00:00', 0, '2019-04-26 10:48:05'),
(48, 58, 6, 3, '', '', '', '0', '', '2019-04-26 16:23:22', '0000-00-00 00:00:00', 0, '2019-04-26 10:53:22'),
(49, 58, 6, 3, '', '', 'test', 'cancel', 'no_map.png', '2019-04-26 16:23:41', '0000-00-00 00:00:00', 0, '2019-04-26 10:53:41'),
(50, 59, 2, 3, '', '', 'no', 'cancel', 'no_map.png', '2019-04-26 16:31:58', '0000-00-00 00:00:00', 0, '2019-04-26 11:01:58'),
(51, 59, 2, 3, '', '', 'gug', 'cancel', 'no_map.png', '2019-04-26 16:36:38', '0000-00-00 00:00:00', 0, '2019-04-26 11:06:38'),
(52, 59, 2, 3, '', '', 'no', 'cancel', 'no_map.png', '2019-04-26 16:40:20', '0000-00-00 00:00:00', 0, '2019-04-26 11:10:20'),
(53, 59, 2, 3, '', '', 'cjvu', 'cancel', 'no_map.png', '2019-04-26 16:45:35', '0000-00-00 00:00:00', 0, '2019-04-26 11:15:35'),
(54, 59, 2, 3, '', '', 'cjv', 'cancel', 'no_map.png', '2019-04-26 16:52:37', '0000-00-00 00:00:00', 0, '2019-04-26 11:22:37'),
(55, 59, 2, 3, '', '', 'fhzfzut', 'cancel', 'no_map.png', '2019-04-26 17:00:03', '0000-00-00 00:00:00', 0, '2019-04-26 11:30:03'),
(56, 59, 2, 3, '', '', 'cjcjc', 'cancel', 'no_map.png', '2019-04-26 17:02:39', '0000-00-00 00:00:00', 0, '2019-04-26 11:32:39'),
(57, 59, 2, 3, '', '', '', 'cancel', '21556279550.png', '2019-04-26 17:22:18', '0000-00-00 00:00:00', 0, '2019-04-26 11:52:18'),
(58, 59, 5, 3, '', '', '', 'cancel', '51556280236.png', '2019-04-26 17:33:13', '0000-00-00 00:00:00', 0, '2019-04-26 12:03:13'),
(59, 62, 6, 3, '1.0', '', '', 'completed', '61556281979.png', '2019-04-26 18:02:32', '0000-00-00 00:00:00', 0, '2019-04-26 12:32:32'),
(60, 61, 6, 3, '4.0', '', '', 'completed', '61556284331.png', '2019-04-26 18:41:43', '0000-00-00 00:00:00', 0, '2019-04-26 13:11:43'),
(61, 60, 8, 3, '', '', '', '0', '', '2019-04-26 19:41:25', '0000-00-00 00:00:00', 0, '2019-04-26 14:11:25'),
(62, 60, 8, 3, '', '', 'nzjdjdndkdn', 'cancel', 'no_map.png', '2019-04-26 19:42:12', '0000-00-00 00:00:00', 0, '2019-04-26 14:12:12'),
(63, 60, 8, 3, '', '', '', '0', '', '2019-04-26 19:46:15', '0000-00-00 00:00:00', 0, '2019-04-26 14:16:15'),
(64, 63, 8, 10, '', '', '', '0', '', '2019-04-26 20:07:47', '0000-00-00 00:00:00', 0, '2019-04-26 14:37:47'),
(65, 63, 8, 10, '', '', '', 'completed', '81556290055.png', '2019-04-26 20:08:10', '0000-00-00 00:00:00', 0, '2019-04-26 14:38:10'),
(66, 64, 2, 3, '', '', 'nooo', 'cancel', 'no_map.png', '2019-04-27 12:21:41', '0000-00-00 00:00:00', 0, '2019-04-27 06:51:41'),
(67, 64, 2, 3, '', '', '', '0', '', '2019-04-27 12:36:03', '0000-00-00 00:00:00', 0, '2019-04-27 07:06:03'),
(68, 64, 2, 3, '', '', 'fghh', 'cancel', 'no_map.png', '2019-04-27 12:36:15', '0000-00-00 00:00:00', 0, '2019-04-27 07:06:15'),
(69, 64, 11, 3, '', '', '', '0', '', '2019-04-27 13:05:07', '0000-00-00 00:00:00', 0, '2019-04-27 07:35:07'),
(70, 64, 11, 3, '', '', 'fgghu', 'cancel', 'no_map.png', '2019-04-27 13:05:21', '0000-00-00 00:00:00', 0, '2019-04-27 07:35:21'),
(71, 64, 11, 3, '', '', '', 'completed', '111556351034.png', '2019-04-27 13:13:24', '0000-00-00 00:00:00', 0, '2019-04-27 07:43:24'),
(72, 66, 10, 11, '', '', 'test', 'cancel', 'no_map.png', '2019-04-27 13:27:20', '0000-00-00 00:00:00', 0, '2019-04-27 07:57:20'),
(73, 65, 10, 11, '', '', '', '0', '', '2019-04-27 13:45:53', '0000-00-00 00:00:00', 0, '2019-04-27 08:15:53'),
(74, 65, 10, 11, '', '', 'Trip is delay one hour', 'cancel', 'no_map.png', '2019-04-27 13:47:03', '0000-00-00 00:00:00', 0, '2019-04-27 08:17:03'),
(75, 67, 10, 11, '3.5', '', '', 'completed', '101556353971.png', '2019-04-27 14:02:25', '0000-00-00 00:00:00', 0, '2019-04-27 08:32:25'),
(76, 65, 10, 11, '3.0', 'comfortable ride', '', 'completed', '101556357523.png', '2019-04-27 15:00:34', '0000-00-00 00:00:00', 0, '2019-04-27 09:30:34'),
(77, 68, 10, 12, '', '', '', '0', '', '2019-04-27 16:43:47', '0000-00-00 00:00:00', 0, '2019-04-27 11:13:47'),
(78, 68, 10, 12, '', '', '', 'booked', '101556363958.png', '2019-04-27 16:45:07', '0000-00-00 00:00:00', 0, '2019-04-27 11:15:07'),
(79, 70, 6, 11, '', '', '', 'completed', '61556364893.png', '2019-04-27 17:04:28', '0000-00-00 00:00:00', 0, '2019-04-27 11:34:28'),
(80, 64, 2, 3, '', '', '', 'onboard', '21556368186.png', '2019-04-27 17:59:36', '0000-00-00 00:00:00', 0, '2019-04-27 12:29:36'),
(81, 64, 6, 3, '', 'great', '', 'onboard', '61556368335.png', '2019-04-27 18:01:51', '0000-00-00 00:00:00', 0, '2019-04-27 12:31:51'),
(82, 69, 10, 12, '', '', 'noo', 'cancel', 'no_map.png', '2019-04-27 18:05:35', '0000-00-00 00:00:00', 0, '2019-04-27 12:35:35'),
(83, 71, 10, 3, '', '', 'noo', 'cancel', 'no_map.png', '2019-04-27 18:55:56', '0000-00-00 00:00:00', 0, '2019-04-27 13:25:56'),
(84, 71, 10, 3, '', '', 'test', 'cancel', 'no_map.png', '2019-04-27 18:58:31', '0000-00-00 00:00:00', 0, '2019-04-27 13:28:31'),
(85, 71, 11, 3, '', '', '', 'completed', '111556372252.png', '2019-04-27 19:06:56', '0000-00-00 00:00:00', 0, '2019-04-27 13:36:56'),
(86, 71, 1, 3, '', '', '', 'completed', '11556372286.png', '2019-04-27 19:07:45', '0000-00-00 00:00:00', 0, '2019-04-27 13:37:45'),
(87, 73, 10, 11, '3.5', 'enjoyed', '', 'completed', '101556372559.png', '2019-04-27 19:11:52', '0000-00-00 00:00:00', 0, '2019-04-27 13:41:52'),
(88, 73, 12, 11, '', '', '', 'completed', '121556372642.png', '2019-04-27 19:13:52', '0000-00-00 00:00:00', 0, '2019-04-27 13:43:52'),
(89, 74, 10, 11, '', '', '', 'completed', '101556373148.png', '2019-04-27 19:21:36', '0000-00-00 00:00:00', 0, '2019-04-27 13:51:36'),
(90, 75, 12, 11, '', '', '', 'completed', '121556374008.png', '2019-04-27 19:36:23', '0000-00-00 00:00:00', 0, '2019-04-27 14:06:23'),
(91, 72, 1, 3, '5.0', 'great ride', '', 'completed', '11556374497.png', '2019-04-27 19:44:14', '0000-00-00 00:00:00', 0, '2019-04-27 14:14:14'),
(92, 72, 11, 3, '', '', '', 'completed', '111556374552.png', '2019-04-27 19:44:40', '0000-00-00 00:00:00', 0, '2019-04-27 14:14:40'),
(93, 76, 2, 3, '', '', '', 'completed', '21556514975.png', '2019-04-29 10:45:42', '0000-00-00 00:00:00', 0, '2019-04-29 05:15:42'),
(94, 78, 1, 3, '3.5', 'good', '', 'completed', '11556516239.png', '2019-04-29 11:07:01', '0000-00-00 00:00:00', 0, '2019-04-29 05:37:01'),
(95, 79, 1, 3, '', '', 'hjji', 'cancel', 'no_map.png', '2019-04-29 11:20:30', '0000-00-00 00:00:00', 0, '2019-04-29 05:50:30'),
(96, 79, 1, 3, '', '', '', '0', '', '2019-04-29 13:46:01', '0000-00-00 00:00:00', 0, '2019-04-29 08:16:01'),
(97, 79, 1, 3, '', '', 'sh', 'cancel', 'no_map.png', '2019-04-29 13:46:20', '0000-00-00 00:00:00', 0, '2019-04-29 08:16:20'),
(98, 91, 10, 21, '', '', '', 'cancel', '101556541372.png', '2019-04-29 18:05:33', '0000-00-00 00:00:00', 0, '2019-04-29 12:35:33'),
(99, 92, 10, 21, '3.5', 'good trip', '', 'completed', '101556542147.png', '2019-04-29 18:18:10', '0000-00-00 00:00:00', 0, '2019-04-29 12:48:10'),
(100, 93, 15, 21, '1.95', 'average ', '', 'completed', '151556543462.png', '2019-04-29 18:40:31', '0000-00-00 00:00:00', 0, '2019-04-29 13:10:31'),
(101, 93, 10, 21, '3.0', 'best trip ever', '', 'completed', '101556543579.png', '2019-04-29 18:42:26', '0000-00-00 00:00:00', 0, '2019-04-29 13:12:26'),
(102, 97, 1, 3, '5.0', 'great work developers', '', 'completed', '11556547635.png', '2019-04-29 19:50:22', '0000-00-00 00:00:00', 0, '2019-04-29 14:20:22'),
(103, 98, 1, 3, '', '', '', '0', '', '2019-04-30 10:24:53', '0000-00-00 00:00:00', 0, '2019-04-30 04:54:53'),
(104, 99, 1, 3, '5.0', 'good', '', 'completed', '11556600235.png', '2019-04-30 10:27:07', '0000-00-00 00:00:00', 0, '2019-04-30 04:57:07'),
(105, 100, 1, 3, '4.5', '', '', 'completed', '11556600800.png', '2019-04-30 10:36:30', '0000-00-00 00:00:00', 0, '2019-04-30 05:06:30'),
(106, 101, 1, 3, '4.5', 'xbxb', '', 'completed', '11556601435.png', '2019-04-30 10:46:59', '0000-00-00 00:00:00', 0, '2019-04-30 05:16:59'),
(107, 102, 1, 3, '0.5', 'non AC car', '', 'completed', '11556601790.png', '2019-04-30 10:53:01', '0000-00-00 00:00:00', 0, '2019-04-30 05:23:01'),
(108, 103, 1, 3, '1.5', 'driver\'s behaviour was not proper', '', 'completed', '11556602607.png', '2019-04-30 11:06:28', '0000-00-00 00:00:00', 0, '2019-04-30 05:36:28'),
(109, 104, 1, 3, '5.0', 'jjjjj', '', 'completed', '11556603073.png', '2019-04-30 11:14:18', '0000-00-00 00:00:00', 0, '2019-04-30 05:44:18'),
(110, 104, 15, 3, '', '', '', 'completed', '151556603141.png', '2019-04-30 11:15:24', '0000-00-00 00:00:00', 0, '2019-04-30 05:45:24'),
(111, 105, 1, 3, '4.5', '', '', 'completed', '11556603595.png', '2019-04-30 11:22:55', '0000-00-00 00:00:00', 0, '2019-04-30 05:52:55'),
(112, 107, 15, 21, '', '', '', 'completed', '151556604847.png', '2019-04-30 11:43:42', '0000-00-00 00:00:00', 0, '2019-04-30 06:13:42'),
(113, 109, 1, 3, '3.5', '', '', 'completed', '11556605141.png', '2019-04-30 11:46:48', '0000-00-00 00:00:00', 0, '2019-04-30 06:16:48'),
(114, 106, 15, 21, '2.525', 'nice trip', '', 'completed', '151556605730.png', '2019-04-30 11:58:38', '0000-00-00 00:00:00', 0, '2019-04-30 06:28:38'),
(115, 108, 17, 21, '', '', 'test reason', 'cancel', 'no_map.png', '2019-04-30 15:54:39', '0000-00-00 00:00:00', 0, '2019-04-30 10:24:39'),
(116, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:28:34', '0000-00-00 00:00:00', 0, '2019-04-30 10:58:34'),
(117, 110, 10, 21, '', '', '', '0', '', '2019-04-30 16:33:04', '0000-00-00 00:00:00', 0, '2019-04-30 11:03:04'),
(118, 110, 10, 21, '', '', '', '0', '', '2019-04-30 16:33:26', '0000-00-00 00:00:00', 0, '2019-04-30 11:03:26'),
(119, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:34:19', '0000-00-00 00:00:00', 0, '2019-04-30 11:04:19'),
(120, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:35:14', '0000-00-00 00:00:00', 0, '2019-04-30 11:05:14'),
(121, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:35:25', '0000-00-00 00:00:00', 0, '2019-04-30 11:05:25'),
(122, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:36:17', '0000-00-00 00:00:00', 0, '2019-04-30 11:06:17'),
(123, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:44:37', '0000-00-00 00:00:00', 0, '2019-04-30 11:14:37'),
(124, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:45:18', '0000-00-00 00:00:00', 0, '2019-04-30 11:15:18'),
(125, 110, 9, 21, '', '', '', '0', '', '2019-04-30 16:49:21', '0000-00-00 00:00:00', 0, '2019-04-30 11:19:21'),
(126, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:52:50', '0000-00-00 00:00:00', 0, '2019-04-30 11:22:50'),
(127, 110, 9, 21, '', '', '', '0', '', '2019-04-30 16:53:44', '0000-00-00 00:00:00', 0, '2019-04-30 11:23:44'),
(128, 110, 9, 21, '', '', '', '0', '', '2019-04-30 16:54:47', '0000-00-00 00:00:00', 0, '2019-04-30 11:24:47'),
(129, 110, 9, 21, '', '', '', '0', '', '2019-04-30 16:55:09', '0000-00-00 00:00:00', 0, '2019-04-30 11:25:09'),
(130, 110, 10, 21, '', '', '', '0', '', '2019-04-30 16:56:15', '0000-00-00 00:00:00', 0, '2019-04-30 11:26:15'),
(131, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:56:21', '0000-00-00 00:00:00', 0, '2019-04-30 11:26:21'),
(132, 110, 15, 21, '', '', '', '0', '', '2019-04-30 16:57:23', '0000-00-00 00:00:00', 0, '2019-04-30 11:27:23'),
(133, 110, 9, 21, '', '', '', '0', '', '2019-04-30 16:57:24', '0000-00-00 00:00:00', 0, '2019-04-30 11:27:24'),
(134, 110, 15, 21, '', '', 'sick', 'cancel', 'no_map.png', '2019-04-30 16:59:46', '0000-00-00 00:00:00', 0, '2019-04-30 11:29:46'),
(135, 110, 10, 21, '', '', 'there is no reason to cancel this ride', 'cancel', 'no_map.png', '2019-04-30 17:06:39', '0000-00-00 00:00:00', 0, '2019-04-30 11:36:39'),
(136, 110, 15, 21, '', '', 'hi ', 'cancel', 'no_map.png', '2019-04-30 17:18:47', '0000-00-00 00:00:00', 0, '2019-04-30 11:48:47'),
(137, 110, 10, 21, '', '', 'hello', 'cancel', 'no_map.png', '2019-04-30 17:20:38', '0000-00-00 00:00:00', 0, '2019-04-30 11:50:38'),
(138, 110, 10, 21, '', '', '', 'cancel', '101556625447.png', '2019-04-30 17:25:27', '0000-00-00 00:00:00', 0, '2019-04-30 11:55:27'),
(139, 110, 15, 21, '', '', '', 'cancel', '151556625449.png', '2019-04-30 17:27:03', '0000-00-00 00:00:00', 0, '2019-04-30 11:57:03'),
(140, 111, 17, 21, '', '', '', '0', '', '2019-04-30 18:28:43', '0000-00-00 00:00:00', 0, '2019-04-30 12:58:43'),
(141, 114, 35, 27, '', '', '', 'booked', '351556711317.png', '2019-05-01 17:18:09', '0000-00-00 00:00:00', 0, '2019-05-01 11:48:09'),
(142, 118, 36, 28, '', '', '', 'completed', '361556713417.png', '2019-05-01 17:53:07', '0000-00-00 00:00:00', 0, '2019-05-01 12:23:07'),
(143, 121, 9, 28, '', '', 'noo', 'cancel', 'no_map.png', '2019-05-02 11:38:25', '0000-00-00 00:00:00', 0, '2019-05-02 06:08:25'),
(144, 121, 10, 28, '', '', '', '0', '', '2019-05-02 11:48:45', '0000-00-00 00:00:00', 0, '2019-05-02 06:18:45'),
(145, 121, 10, 28, '', '', '', 'booked', '101556779629.png', '2019-05-02 11:53:20', '0000-00-00 00:00:00', 0, '2019-05-02 06:23:20'),
(146, 122, 9, 8, '', '', 'noo', 'cancel', 'no_map.png', '2019-05-02 11:55:51', '0000-00-00 00:00:00', 0, '2019-05-02 06:25:51'),
(147, 124, 10, 30, '', '', '', 'booked', '101556796103.png', '2019-05-02 16:51:29', '0000-00-00 00:00:00', 0, '2019-05-02 11:21:29'),
(148, 128, 17, 21, '', '', '', 'completed', '171556802211.png', '2019-05-02 18:33:13', '0000-00-00 00:00:00', 0, '2019-05-02 13:03:13'),
(149, 126, 17, 33, '3.45', 'nice ', '', 'completed', '171556803102.png', '2019-05-02 18:47:42', '0000-00-00 00:00:00', 0, '2019-05-02 13:17:42'),
(150, 126, 10, 33, '', '', '', 'completed', '101556804203.png', '2019-05-02 19:06:10', '0000-00-00 00:00:00', 0, '2019-05-02 13:36:10'),
(151, 130, 38, 21, '', '', 'test reason', 'cancel', 'no_map.png', '2019-05-03 11:35:25', '0000-00-00 00:00:00', 0, '2019-05-03 06:05:25'),
(152, 130, 38, 21, '', '', 'test', 'cancel', 'no_map.png', '2019-05-03 11:37:29', '0000-00-00 00:00:00', 0, '2019-05-03 06:07:29'),
(153, 131, 38, 21, '5.0', 'nice trip', '', 'completed', '381556867419.png', '2019-05-03 12:39:59', '0000-00-00 00:00:00', 0, '2019-05-03 07:09:59'),
(154, 134, 17, 33, '', '', '', 'completed', '171557147889.png', '2019-05-06 18:34:36', '0000-00-00 00:00:00', 0, '2019-05-06 13:04:36'),
(155, 135, 17, 21, '', '', '', 'completed', '171557224378.png', '2019-05-07 15:49:10', '0000-00-00 00:00:00', 0, '2019-05-07 10:19:10'),
(156, 135, 10, 21, '3.0', 'test missed', '', 'completed', '101557224416.png', '2019-05-07 15:49:47', '0000-00-00 00:00:00', 0, '2019-05-07 10:19:47'),
(157, 136, 10, 39, '4.5', 'good trip', '', 'completed', '101557231225.png', '2019-05-07 17:43:27', '0000-00-00 00:00:00', 0, '2019-05-07 12:13:27'),
(158, 138, 10, 21, '5.0', 'nice trip\nhshshsjajjajsjsjsjsjjakakhsbsjskskshshskhkagjsgjsgjgajgjaggajgajgajajgajgjsgkgkgakcakakggaogakgakgakakgagkagkagkagkagkagakgakgagkagigakgaigakagoagoagoagogsosgoaosogsgosogaogoggosog\n\nkgskgsgsogksvgosgsoggskgsgosgosogsgosgogsgosgosogskgksgkgskgskgskgksgogsgsogskgkgsogsogsogosggosgksgsogaogwhowhowohaohhwlhwlhwowgoowgohhwooowywiywiyslhahkakgagk\n', '', 'completed', '101557298020.png', '2019-05-08 12:16:17', '0000-00-00 00:00:00', 0, '2019-05-08 06:46:17'),
(159, 139, 10, 21, '', '', '', 'cancel', '101557306699.png', '2019-05-08 14:40:55', '0000-00-00 00:00:00', 0, '2019-05-08 09:10:55'),
(160, 6, 33, 12, '', '', '', '0', '', '2019-07-22 16:35:12', '0000-00-00 00:00:00', 0, '2019-07-22 11:05:12'),
(161, 6, 33, 12, '', '', '', 'completed', '331563793548.png', '2019-07-22 16:35:28', '0000-00-00 00:00:00', 0, '2019-07-22 11:05:28'),
(162, 6, 48, 12, '', '', '', 'completed', '481563799461.png', '2019-07-22 18:13:59', '0000-00-00 00:00:00', 0, '2019-07-22 12:43:59'),
(163, 5, 33, 12, '', '', '', 'cancel', '331563859240.png', '2019-07-23 10:47:52', '0000-00-00 00:00:00', 0, '2019-07-23 05:17:52'),
(164, 7, 33, 12, '', '', 'something wrong select trip', 'cancel', 'no_map.png', '2019-07-23 12:31:42', '0000-00-00 00:00:00', 0, '2019-07-23 07:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `id` int(10) NOT NULL,
  `mechanic_id` int(50) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `car_type` varchar(50) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `plate_no` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `filename1` varchar(50) NOT NULL,
  `status` enum('Pending','Accept','Decline') NOT NULL DEFAULT 'Pending',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`id`, `mechanic_id`, `driver_name`, `contact_no`, `car_type`, `model_name`, `plate_no`, `filename`, `filename1`, `status`, `created_date`) VALUES
(1, 1, 'halak', '1234567890', 'i10 ', 'sports', 'GJ-01 CT-6790', '1120190514103010file.jpg', '1120190514102838file1.jpeg', 'Pending', '2019-05-08 05:55:13'),
(2, 2, 'halak', '1234567890', 'Car', 'SUV', 'GJ-098-OJH', '2220190510090318.jpeg', '2220190510090318.pdf', 'Pending', '2019-05-10 07:22:20'),
(3, 2, 'AK', '7845963210', 'Van', 'Echo', 'RT-99483-UR', '3220190510084632.jpg', '3220190510084632.pdf', 'Pending', '2019-05-10 08:45:51'),
(4, 4, 'Nick', '1236547809', 'sports', 'SPORTS', 'SUV-8787-OK', '4420190514114611file.jpg', '4420190514114648file1.pdf', 'Accept', '2019-05-14 11:30:14'),
(5, 6, 'testdriver', '1485963521', 'bmw', '5678', 'GJ-01 CT-67900', '5620190515060253file.jpg', '5620190515060253file1.pdf', 'Accept', '2019-05-15 06:02:29'),
(6, 7, 'Akash', '7892654685', 'sedan', 'accent', 'GU-0943-IUTY', '6720190515092046file.jpg', '6720190515092046file1.jpeg', 'Pending', '2019-05-15 09:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicledetails`
--

CREATE TABLE `tbl_vehicledetails` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `photo_type` enum('photo','plate') NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicledetails`
--

INSERT INTO `tbl_vehicledetails` (`id`, `vehicle_id`, `driver_id`, `photo_type`, `photo`) VALUES
(3, 3, 2, 'plate', '1_20190510061650PL0.jpg'),
(4, 4, 3, 'plate', '1_20190510131036PL0.jpg'),
(5, 5, 4, 'plate', '1_20190515100506PL0.jpg'),
(6, 8, 6, 'photo', '15579679130P.jpg'),
(7, 8, 6, 'plate', '15579679130.jpg'),
(8, 13, 10, 'photo', '15593089800P.jpg'),
(9, 13, 10, 'plate', '15593089800.jpg'),
(10, 15, 12, 'photo', '15620451880P.jpg'),
(11, 15, 12, 'plate', '15620451880.jpg'),
(12, 17, 13, 'photo', '156396888218701632P.png'),
(13, 17, 13, 'plate', '156396888218696352.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_platephoto`
--

CREATE TABLE `tbl_vehicle_platephoto` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `plate_photo` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assign_driver`
--
ALTER TABLE `tbl_assign_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driverdata`
--
ALTER TABLE `tbl_driverdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driverdetails`
--
ALTER TABLE `tbl_driverdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driverdocuments`
--
ALTER TABLE `tbl_driverdocuments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_bankdetails`
--
ALTER TABLE `tbl_driver_bankdetails`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tbl_driver_logs`
--
ALTER TABLE `tbl_driver_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_setlocation`
--
ALTER TABLE `tbl_driver_setlocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_vehicle`
--
ALTER TABLE `tbl_driver_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_my_address`
--
ALTER TABLE `tbl_my_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_preferences`
--
ALTER TABLE `tbl_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_repairs`
--
ALTER TABLE `tbl_repairs`
  ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_trip_passanger`
--
ALTER TABLE `tbl_trip_passanger`
  ADD PRIMARY KEY (`passanger_id`);

--
-- Indexes for table `tbl_userdata`
--
ALTER TABLE `tbl_userdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`mechanic_id`);

--
-- Indexes for table `tbl_user_devicedata`
--
ALTER TABLE `tbl_user_devicedata`
  ADD PRIMARY KEY (`devicedata_id`);

--
-- Indexes for table `tbl_user_trips`
--
ALTER TABLE `tbl_user_trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicledetails`
--
ALTER TABLE `tbl_vehicledetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle_platephoto`
--
ALTER TABLE `tbl_vehicle_platephoto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_assign_driver`
--
ALTER TABLE `tbl_assign_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_driverdata`
--
ALTER TABLE `tbl_driverdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_driverdetails`
--
ALTER TABLE `tbl_driverdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_driverdocuments`
--
ALTER TABLE `tbl_driverdocuments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_driver_bankdetails`
--
ALTER TABLE `tbl_driver_bankdetails`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_driver_logs`
--
ALTER TABLE `tbl_driver_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_driver_setlocation`
--
ALTER TABLE `tbl_driver_setlocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_driver_vehicle`
--
ALTER TABLE `tbl_driver_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_my_address`
--
ALTER TABLE `tbl_my_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_preferences`
--
ALTER TABLE `tbl_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_repairs`
--
ALTER TABLE `tbl_repairs`
  MODIFY `repair_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `tbl_trip_passanger`
--
ALTER TABLE `tbl_trip_passanger`
  MODIFY `passanger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `tbl_userdata`
--
ALTER TABLE `tbl_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_devicedata`
--
ALTER TABLE `tbl_user_devicedata`
  MODIFY `devicedata_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_trips`
--
ALTER TABLE `tbl_user_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_vehicledetails`
--
ALTER TABLE `tbl_vehicledetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_vehicle_platephoto`
--
ALTER TABLE `tbl_vehicle_platephoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
