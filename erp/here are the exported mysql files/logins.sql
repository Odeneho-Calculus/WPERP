-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2024 at 07:04 AM
-- Server version: 5.7.40-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `submission`
--

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_unique_id` varchar(50) NOT NULL,
  `user_type` enum('admin','reseller','user') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `company` varchar(255) NOT NULL,
  `profilepic` text,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `parent_id` bigint(20) NOT NULL,
  `credit` double NOT NULL DEFAULT '0',
  `updated_at` varchar(30) DEFAULT NULL,
  `created_at` varchar(30) NOT NULL,
  `rollback` enum('Disable','Enable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `user_unique_id`, `user_type`, `full_name`, `username`, `email_id`, `pwd`, `mobile`, `company`, `profilepic`, `status`, `parent_id`, `credit`, `updated_at`, `created_at`, `rollback`) VALUES
(1, 'adm01', 'admin', 'Admin', 'admin', 'admin@gmail.com', '8008600008', '919384440735', 'WESEND', 'images_AH14Z8ZV.jpeg', 'Active', 0, 999596804, '2024-07-09 04:02:36', '2022-07-07 13:26:07', 'Disable'),
(6, 'WP-49855361', 'reseller', 'Amit', 'amit@gmail.com', 'amit@gmail.com', 'Erp5718', '9891230092', 'AravaDigitel', 'images_IRLHAAIZ.png', 'Active', 1, 7, '2023-04-07 02:07:12', '2022-08-25 12:38:18', 'Disable'),
(8, 'WP-47960889', 'user', 'Abhishek', 'Abhishek', 'lpalaw1234@gmail.com', 'Erp1424', '9891230092', 'ADW', '', 'Active', 6, 48119, '2023-02-24 01:32:43', '2022-08-25 12:55:02', 'Disable'),
(10, 'WP-81909867', 'user', 'CRSPL', 'CRSPL', 'mail.crspl@gmail.com', 'Crspl@2022', '9311911002', 'mail.crspl@gmail.com', 'images_TWTLERFU.png', 'Active', 6, -754530, '2023-02-24 01:13:20', '2022-08-26 10:22:19', 'Disable'),
(17, 'WP-60309437', 'reseller', 'VILVA NETWORKS', 'whatsapp@vilvabusiness.com', 'whatsapp@vilvabusiness.com', 'WhatSapp%$#Tool2022', '9791136945', 'IT COMPANY', '', 'Active', 1, 45, '2022-09-01 11:12:32', '2022-08-29 09:44:50', 'Disable'),
(50, 'WP-12036482', 'reseller', 'MOHANBABU', 'MOHAN', 'mohan@7soft.in', 'Erp3129', '9384440735', '7SOFT', '', 'Active', 1, 178000, '2023-01-24 12:59:22', '2022-09-29 08:39:24', 'Disable'),
(51, 'WP-85116414', 'user', 'RAMA KRISHNA YADA', 'ramakrishnayada1@gmail.com', 'ramakrishnayada1@gmail.com', 'Erp3933', '9398943955', 'VAASAVI ASSOCIATES', 'images_TAFMDZXM.jpeg', 'Active', 50, 71998, '2023-05-29 10:51:09', '2022-10-03 12:40:50', 'Disable'),
(53, 'WP-94197586', 'reseller', 'CHANDRA PRABHA', 'wesenddelivery7soft@gmail.com', 'wesenddelivery7soft@gmail.com', '@7SOFT1234', ' 9025442357', '7SOFT', 'images_NBLG2XJS.jpg', 'Active', 1, 31532, '2023-11-02 12:20:58', '2022-10-13 05:38:31', 'Enable'),
(96, 'WP-60400122', 'user', 'The Banyan Hotel Poonamallee', 'thebanyanhotel3@gmail.com', 'thebanyanhotel3@gmail.com', 'Erp4759', '9962902347', 'HOTEL', '', 'Active', 53, 1, '2023-07-18 05:00:28', '2022-10-14 05:05:24', 'Disable'),
(97, 'WP-23095517', 'user', 'SIVAKUMAR', '5sivakumar@gmail.com', '5sivakumar@gmail.com', 'Erp3650', '9789776461', 'LOAN', '', 'Active', 53, 1, '2023-07-26 03:43:10', '2022-10-14 05:06:11', 'Disable'),
(98, 'WP-19079372', 'user', 'FOTODIAL PHOTOGRAPHY', 'fotodial2021@gmail.com', 'fotodial2021@gmail.com', 'fotodial@123', '+91 95664 24243', 'PHOTOGRAPHY', '', 'Active', 53, 8505, '2023-08-30 12:16:34', '2022-10-14 05:07:26', 'Disable'),
(99, 'WP-11239089', 'user', 'JAGANATHAN', '5jaganathan@gmail.com', '5jaganathan@gmail.com', 'Erp9424', '8129918648', 'YOUTUBER', '', 'Inactive', 53, 1, '2023-04-12 02:40:50', '2022-10-14 05:08:27', 'Disable'),
(100, 'WP-17951893', 'user', 'JOHN AMIRTHARAJ', '5johnamirtharaj@gmail.com', '5johnamirtharaj@gmail.com', 'Erp1852', '9543437700', 'REAL EATATE', '', 'Active', 53, 21712, '2023-07-25 08:58:17', '2022-10-14 05:09:16', 'Disable'),
(101, 'WP-31667173', 'user', 'AASVATECH', '5aasvatech@gmail.com', '5aasvatech@gmail.com', 'Erp2699', '7708906669', 'AASVA TECHNOLOGIES PRIVATE LIMITED', '', 'Active', 53, 2159, '2023-04-25 06:09:24', '2022-10-14 05:10:26', 'Disable'),
(102, 'WP-55945170', 'user', 'PUGAZHENTHI', '5brightlearning4u@gmail.com', '5brightlearning4u@gmail.com', 'Erp3094', '9842285054', 'BRIGHT LEARNING', '', 'Inactive', 53, 1, '2023-04-12 02:43:45', '2022-10-14 05:12:25', 'Disable'),
(103, 'WP-51548927', 'user', 'MODALING PAINTING GROUP', '5saravanan994166@gmail.com', '5saravanan994166@gmail.com', 'Erp3600', '7871166900', 'PAINT', '', 'Inactive', 53, 1, '2023-04-12 02:46:32', '2022-10-14 05:14:12', 'Disable'),
(104, 'WP-70561606', 'user', 'NEETAI TECH', '5neetaitech@gmail.com', '5neetaitech@gmail.com', 'Erp4186', '7094400328', 'IT', '', 'Active', 53, 0, '2024-06-11 11:49:51', '2022-10-14 05:15:13', 'Disable'),
(105, 'WP-42187898', 'user', 'MILKYWAY', '5milkyway@gmail.com', '5milkyway@gmail.com', 'Erp3191', '7871166900', 'Icecream', '', 'Active', 53, 1876, '2023-08-25 01:03:23', '2022-10-14 05:15:59', 'Disable'),
(106, 'WP-95586863', 'user', 'CHANDRA MOHAN', '5chandru1.ta@gmail.com', '5chandru1.ta@gmail.com', 'Erp9750', '9042019042', 'LOAN', '', 'Active', 53, 1, '2023-06-01 05:01:56', '2022-10-14 05:16:45', 'Disable'),
(107, 'WP-89789232', 'user', 'CAPITAL LOANS', '5mepremcbe@gmail.com', '5mepremcbe@gmail.com', 'Erp4342', '9042059042', 'LOAN', '', 'Active', 53, 1, '2023-06-01 05:01:24', '2022-10-14 05:19:06', 'Disable'),
(108, 'WP-91790089', 'user', 'CBSE MATHS MANI', '5mani2u.2020@gmail.com', '5mani2u.2020@gmail.com', 'Erp2894', '9941669938', 'LOAN', '', 'Inactive', 53, 1, '2023-04-12 03:00:38', '2022-10-14 05:20:17', 'Disable'),
(109, 'WP-51558947', 'user', 'PRASATH', '5uvcon2003@gmail.com', '5uvcon2003@gmail.com', 'Erp4479', '8124757910', 'MARKETING', '', 'Inactive', 53, 2, '2023-03-06 11:04:36', '2022-10-14 05:21:47', 'Disable'),
(110, 'WP-94508852', 'user', 'SAJU THOMAS', '5saju.pt11@gmail.com', '5saju.pt11@gmail.com', 'Erp7400', '9995123811', 'SAJU CONSTRUCTION', '', 'Active', 53, 6308, '2023-08-25 01:02:41', '2022-10-14 05:22:30', 'Disable'),
(111, 'WP-71156351', 'user', 'ESKAY CLOTHINGS', 'sathishvpn286@gmail.com', 'sathishvpn286@gmail.com', 'Erp6213', '9843624486', 'TEXTILS', '', 'Active', 53, 7453, '2023-08-09 12:53:18', '2022-10-14 05:23:38', 'Disable'),
(112, 'WP-39165084', 'user', 'WILSON THOMAS', '5biodigesterkerala@gmail.com', '5biodigesterkerala@gmail.com', 'Erp5728', '9349236394', 'MARKETING', '', 'Inactive', 53, 1, '2023-07-26 03:40:34', '2022-10-14 05:25:00', 'Disable'),
(113, 'WP-91161519', 'user', 'LARS LIFE CARE', 'anurag@larslc.com', 'anurag@larslc.com', 'Erp3355', '919895021315', 'FURNITURES', '', 'Inactive', 53, 0, '2023-03-06 11:05:21', '2022-10-21 11:52:06', 'Disable'),
(114, 'WP-67593610', 'user', 'SREE RAJAGANAPATHY STORE', 'srs.sjp@gmail.com', 'srs.sjp@gmail.com', 'Erp1877', '9843076515', 'CLOTHES', 'images_WFFT17NB.jpg', 'Inactive', 53, 1, '2023-04-12 03:09:23', '2022-10-27 10:13:11', 'Disable'),
(115, 'WP-70553622', 'user', 'GOWRISHANKAR', 'Chellamnutritioncentre@gmail.com', 'Chellamnutritioncentre@gmail.com', 'Erp7743', '9962287488', 'NUTRITION', '', 'Active', 53, 3001, '2023-06-17 01:53:41', '2022-10-27 03:46:09', 'Disable'),
(116, 'WP-28223990', 'user', 'AMIT', 'Amit@gmail.com', 'Amit@gmail.com', 'Erp5570', '9891230092', 'MARKETING', '', 'Inactive', 53, 1, '2023-04-12 03:12:24', '2022-10-30 12:39:57', 'Disable'),
(117, 'WP-99058512', 'user', 'JAYA PAN CARD CONSULTANCY', 'jayapancard@gmail.com', 'jayapancard@gmail.com', 'Erp2724', '73387 91752', 'CONSULTANCY', '', 'Inactive', 53, 1, '2023-04-12 03:17:10', '2022-10-30 01:16:11', 'Disable'),
(118, 'WP-78954120', 'user', 'PRANAVAM LOAN CONSULTANCY', 'thiagarajandn@gmail.com', 'thiagarajandn@gmail.com', 'Erp9782', '99419 22943', 'LOAN CONSULTANCY', 'images_G6Y6G1TH.jpg', 'Active', 53, 3127, '2023-08-30 12:13:54', '2022-10-31 11:29:55', 'Disable'),
(119, 'WP-98680131', 'user', 'YOGGHHUM WEALTH CONSULTANT LLP', 'yogghhumindia@gmail.com', 'yogghhumindia@gmail.com', 'Erp6185', '95857 64999', 'WEALTH CONSULTANT', '', 'Inactive', 53, 1, '2023-04-13 03:31:43', '2022-10-31 04:16:35', 'Disable'),
(120, 'WP-73391125', 'user', 'NALAM ONLINE NOURISHMENT STATION', 'jk271584@gmail.com', 'jk271584@gmail.com', 'Erp2619', '7200224348', 'WELLNESS CENTER', '', 'Inactive', 53, 1, '2023-04-12 03:18:17', '2022-10-31 04:20:37', 'Disable'),
(121, 'WP-71524132', 'user', 'ROYAL BUILDERS', 'ansarin@gmail.com', 'ansarin@gmail.com', 'Erp5673', '7358345606', '', '', 'Inactive', 53, 3, '2023-03-06 11:06:41', '2022-11-01 12:12:47', 'Disable'),
(122, 'WP-52046036', 'user', 'COMPANIO', 'rssenthil_kumar@yahoo.com', 'rssenthil_kumar@yahoo.com', 'Erp3961', '9940282079', 'HEALTH', '', 'Inactive', 53, 1, '2023-04-12 03:21:41', '2022-11-02 11:57:20', 'Disable'),
(123, 'WP-20091534', 'user', 'VSA ASSOCIATES', 'vsaassociates17@gmail.com', 'vsaassociates17@gmail.com', 'Erp7649', '9047824962', 'PASSPORT SERVICES', '', 'Inactive', 53, 1, '2023-04-12 03:20:26', '2022-11-03 10:20:56', 'Disable'),
(124, 'WP-29313267', 'user', 'HEALTH LIFE WELLNESS CENTRE', 'nirmaladevia737@gmail.com', 'nirmaladevia737@gmail.com', 'Erp4788', '9043634823', 'HEALTH DEPARTMENT', 'images_FHK83NRY.jpg', 'Inactive', 53, 1, '2023-04-12 03:31:54', '2022-11-03 05:13:22', 'Disable'),
(125, 'WP-53573947', 'user', 'OLIVE AYURVEDIC CENTER', 'oliveayurvediccenter@gmail.com', 'oliveayurvediccenter@gmail.com', 'Erp2625', '8610522824', 'AYURVEDIC', '', 'Inactive', 53, 1, '2023-03-06 11:07:18', '2022-11-04 01:54:46', 'Disable'),
(126, 'WP-53128226', 'user', 'PRAVEEN KUMAR', 'praveengrj111@gmail.com', 'praveengrj111@gmail.com', 'Erp7474', '7094951177', 'SW', '', 'Inactive', 53, 1, '2023-04-12 03:33:08', '2022-11-08 11:53:39', 'Disable'),
(127, 'WP-16118552', 'user', 'ONE POINT', 'onepoint1989@gmail.com', 'onepoint1989@gmail.com', 'Erp9385', '7550048048', 'COMPANY', '', 'Inactive', 53, 1, '2023-04-12 03:34:04', '2022-11-09 12:51:08', 'Disable'),
(128, 'WP-23811024', 'user', 'VDR SUPER STORE', 'vdrsuperstores@gmail.com', 'vdrsuperstores@gmail.com', 'Erp7918', '9994508857', 'SHOP', '', 'Inactive', 53, 1, '2023-04-12 03:35:03', '2022-11-13 12:33:14', 'Disable'),
(129, 'WP-97265146', 'user', 'MURUGAN SOLUTION', 'gjeenathkumar@gmail.com', 'gjeenathkumar@gmail.com', 'Erp5970', '99402 07188', 'CCTV', '', 'Inactive', 53, 1, '2023-04-12 03:39:13', '2022-11-13 05:19:52', 'Disable'),
(130, 'WP-65117802', 'user', 'RADHIKA', 'radhikasenthil83@gmail.com', 'radhikasenthil83@gmail.com', 'Erp5515', '9942734583', 'WELLNESS', '', 'Inactive', 53, 1, '2023-04-12 03:40:23', '2022-11-16 09:52:40', 'Disable'),
(131, 'WP-85476944', 'user', 'MUTHUKUMAR', 'muthukumar@gmail.com', 'muthukumar@gmail.com', 'Erp8037', '9894018018', 'NAVANI MARKETING', '', 'Inactive', 53, 1, '2023-04-12 03:41:22', '2022-11-21 02:20:47', 'Disable'),
(132, 'WP-43868200', 'user', 'HUSSAIN', 'mminternational@gmail.com', 'mminternational@gmail.com', 'Erp2109', '+91 98956 13611', 'MM INTERNATIONAL', '', 'Inactive', 53, 1, '2023-04-12 03:42:44', '2022-11-21 02:33:01', 'Disable'),
(133, 'WP-32108526', 'user', 'JOSE MATHEW', 'josekerala@gmail.com', 'josekerala@gmail.com', 'Erp7027', '9447066266', 'JOSE MATHEW', '', 'Inactive', 53, 1, '2023-04-14 03:26:51', '2022-11-23 12:37:56', 'Disable'),
(134, 'WP-69149660', 'user', 'RAJ ASSOCIATES', 'rajukpta@gmail.com', 'rajukpta@gmail.com', 'Erp5159', '9447038998', 'S N Service Network Centre', 'images_K6ALUK8C.jpeg', 'Active', 53, 1, '2023-06-01 04:57:29', '2022-11-25 05:32:54', 'Disable'),
(135, 'WP-66774894', 'user', 'VENKATA SUBRAMANIAN', 'venkatasubramaniancb@gmail.com', 'venkatasubramaniancb@gmail.com', 'Erp3918', '9344586088', 'EDUCATION', 'images_Q9WDZSTX.jpg', 'Active', 53, 1, '2023-06-01 04:53:49', '2022-12-05 10:16:58', 'Disable'),
(136, 'WP-83883557', 'user', 'MIRTH HOLIDAYS', 'James@clubconnectholidays.com', 'James@clubconnectholidays.com', 'Erp8229', ' 7356980961', 'RESORT', '', 'Inactive', 53, 1, '2023-04-12 03:44:16', '2022-12-14 01:57:56', 'Disable'),
(137, 'WP-79182174', 'user', 'SHINIL', 'smax.k61@gmail.com', 'smax.k61@gmail.com', 'Erp6482', ' 9809666001', 'INSURANCE', '', 'Inactive', 53, 1, '2023-04-12 03:45:45', '2022-12-15 02:49:57', 'Disable'),
(138, 'WP-92342183', 'user', 'SUJANTH', 'greenecoindustry@gmail.com', 'greenecoindustry@gmail.com', 'Erp6893', '9047773111', 'Green Eco Industries', '', 'Inactive', 53, 1, '2023-04-14 03:23:46', '2022-12-17 04:24:11', 'Disable'),
(139, 'WP-73745417', 'user', 'MEIPORUL PROMOTERS', 'dhildeepan@gmail.com', 'dhildeepan@gmail.com', 'Erp8428', '9344844315', 'PROMOTERS', '', 'Inactive', 53, 1, '2023-04-12 03:47:05', '2022-12-18 09:37:11', 'Disable'),
(140, 'WP-77880866', 'user', 'NEETAI SALES', 'sales@neetai.com', 'sales@neetai.com', 'Erp3330', '9727262019', 'TECH SUPPORT', '', 'Active', 53, 5000, '2023-11-02 12:24:04', '2022-12-24 11:35:33', 'Disable'),
(141, 'WP-21221893', 'user', 'DHANALAKSHMI SRINIVASAN CHIT FUNDS PVT LTD', 'dhanalakshmi@gmail.com', 'dhanalakshmi@gmail.com', 'Erp5166', '9344844315', 'CHITS FUNDS', '', 'Inactive', 53, 1, '2023-04-12 03:48:21', '2022-12-30 03:20:33', 'Disable'),
(142, 'WP-46534762', 'user', 'EDISON ELECTRIC INDUSTRIES', 'edisonswitchgears@gmail.com', 'edisonswitchgears@gmail.com', 'Erp1703', '9750099600', 'ELECTRICALS', 'images_FZVGAZ3F.jpeg', 'Inactive', 53, 1, '2023-04-12 03:49:10', '2022-12-31 11:41:30', 'Disable'),
(143, 'WP-97208083', 'user', 'Agarwal Samaj', 'agarwalsamaj@gmail.com', 'agarwalsamaj@gmail.com', 'Erp5323', '9585524400', 'textile', '', 'Active', 53, 0, '2023-07-20 08:58:42', '2023-01-05 10:22:28', 'Enable'),
(144, 'WP-54068310', 'user', 'DINESH', 'r.dinesh4322@gmail.com', 'r.dinesh4322@gmail.com', 'Erp3871', '9962259540', 'PERSONAL', '', 'Active', 53, 3582, '2023-08-11 12:29:28', '2023-01-05 11:22:21', 'Disable'),
(145, 'WP-88795964', 'user', 'SUDHAKAR', 'sudhakarsudhakar10@yahoo.com', 'sudhakarsudhakar10@yahoo.com', 'Erp5262', '994493247', 'QUANTUM STUDY CENTER', '', 'Active', 53, 24, '2023-05-29 06:04:54', '2023-01-18 03:11:59', 'Disable'),
(146, 'WP-91069987', 'reseller', 'DigiKee Business Solutions', 'info.digikee@gmail.com', 'info.digikee@gmail.com', 'Erp7944', '9416267769', 'DigiKee Business Solutions', '', 'Active', 1, 9, '2023-04-07 02:07:43', '2023-01-18 05:04:26', 'Disable'),
(147, 'WP-55618855', 'user', 'SKY NET A To Z HOME SERVICES', 'skynetsaravanan@gmail.com', 'skynetsaravanan@gmail.com', 'Erp8694', '9994796643', 'SKY NET', '', 'Active', 53, 7260, '2023-08-09 12:54:14', '2023-01-31 04:13:12', 'Disable'),
(148, 'WP-99012582', 'user', 'SOLO ART GALLERY', 'soloartgallerypro@gmail.com', 'soloartgallerypro@gmail.com', 'Erp4260', '6383145322', 'ARTS', '', 'Inactive', 53, 1, '2023-04-12 03:50:26', '2023-02-02 03:00:28', 'Disable'),
(149, 'WP-73430193', 'user', 'COIRPITH MANUFACTURER', 'coirpithmanufacturerpro@gmail.com', 'coirpithmanufacturerpro@gmail.com', 'Erp2003', '6383086629', 'AGRICULTURE', '', 'Inactive', 53, 1, '2023-04-12 03:51:04', '2023-02-02 03:02:31', 'Disable'),
(150, 'WP-67371732', 'user', 'MUTHULAKSHMI', 'deekshanacastle23@gmail.com', 'deekshanacastle23@gmail.com', 'Erp9929', '9952645064', 'MUTHULAKSHMI', '', 'Inactive', 53, 1, '2023-04-12 03:51:44', '2023-02-03 10:28:56', 'Disable'),
(151, 'WP-79138037', 'user', 'DR.RAJENDRAN', 'drrajendranphysiopro@gmail.com', 'drrajendranphysiopro@gmail.com', 'Erp8668', '9994964508', 'DR.RAJENDRAN', '', 'Active', 53, 303, '2023-07-27 08:19:09', '2023-02-03 05:06:20', 'Disable'),
(152, 'WP-40263654', 'user', 'IMAGE BEAUTY SALON', 'imagebeautysalonpro@gmail.com', 'imagebeautysalonpro@gmail.com', 'Erp2622', '9047015880', 'IMAGE BEAUTY SALON', '', 'Inactive', 53, 1, '2023-04-14 03:29:57', '2023-02-07 02:47:46', 'Disable'),
(153, 'WP-54075175', 'user', 'MARIYAM WINDOWS', 'Innaciammalarockiadass@gmail.com', 'Innaciammalarockiadass@gmail.com', 'Erp3067', '9843394489', 'MARIYAM WINDOWS', '', 'Inactive', 53, 1, '2023-04-12 03:53:46', '2023-02-07 06:55:53', 'Disable'),
(154, 'WP-20667380', 'user', 'SOLO ART GALLERY PROJECT 2', 'soloart2023@gmail.com', 'soloart2023@gmail.com', 'Erp9839', '9494666685', 'SOLO ART GALLERY PROJECT 2', '', 'Inactive', 53, 1, '2023-04-12 03:54:46', '2023-02-14 12:41:51', 'Disable'),
(155, 'WP-33232332', 'user', 'FORTUNE RESORT', 'fortuneresortpro@gmail.com', 'fortuneresortpro@gmail.com', 'Erp9086', '9487944615', 'FORTUNE RESORT', '', 'Active', 53, 6104, '2023-08-25 01:08:26', '2023-02-14 12:57:16', 'Disable'),
(156, 'WP-67996667', 'user', 'EROCHEM\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'F', 'bmrayan2002@rediffmail.com', 'bmrayan2002@rediffmail.com', 'Erp3627', '9842707770', 'EROCHEM\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'F', '', 'Active', 53, 464, '2023-07-25 08:56:53', '2023-02-14 03:48:06', 'Disable'),
(157, 'WP-94063452', 'user', 'KAMARAJ', 'support@gobookingtrip.com', 'support@gobookingtrip.com', 'Erp1121', '9940260585', 'KAMARAJ', '', 'Inactive', 53, 1, '2023-04-13 03:21:23', '2023-02-15 12:20:32', 'Disable'),
(158, 'WP-32252862', 'user', 'DR RAJENDRAN 1WEEK PLAN', 'gchospital2001@gmail.com', 'gchospital2001@gmail.com', 'Erp3719', '09994964508', 'GC HOSPITAL', '', 'Active', 53, 803, '2023-05-29 11:58:21', '2023-02-19 02:21:39', 'Disable'),
(159, 'WP-96658562', 'user', 'Shubham', 'Shubham', 'Shubhamtak563@gmail.com', 'Erp5297', '9841187654', 'Shubham', 'images_59UFMHN5.png', 'Active', 6, 9, '2023-02-28 12:56:54', '2023-02-28 12:55:39', 'Disable'),
(160, 'WP-87901246', 'user', 'Indhu', 'ladycareindhu@gmail.com', 'ladycareindhu@gmail.com', 'Kani1986', '9043320999', 'Indhu', '', 'Active', 53, 1, '2023-06-01 04:52:29', '2023-03-01 05:04:36', 'Disable'),
(161, 'WP-34979954', 'user', 'NIMALAN', 'Nimalan@verirare.com', 'Nimalan@verirare.com', 'Erp9279', '9840077054', 'NIMALAN', '', 'Active', 53, 735, '2023-07-27 08:22:09', '2023-03-03 10:17:43', 'Disable'),
(162, 'WP-89235943', 'user', 'HEMAMALINI.G', 'Vallalar1977@gmail.com', 'Vallalar1977@gmail.com', 'Erp5465', '79043 63049', 'SHREE VENKATESWARA TUITION CENTRE', '', 'Active', 53, 31460, '2023-07-25 08:55:37', '2023-03-04 12:34:34', 'Disable'),
(163, 'WP-61621499', 'user', 'CAMPAIGNING', 'rk9.inn@gmail.com', 'rk9.inn@gmail.com', 'Erp6985', '7611172227', 'CAMPAIGNING', '', 'Active', 53, 1, '2023-03-09 11:19:53', '2023-03-09 10:58:17', 'Disable'),
(164, 'WP-97226206', 'user', 'SSK ENTERPRISES', 'sskenterprises@gmail.com', 'sskenterprises@gmail.com', 'Erp9779', '+91 99944 90786', 'INTERIOR DESIGNING', '', 'Active', 53, 4788, '2023-08-25 01:02:09', '2023-03-11 05:05:24', 'Disable'),
(165, 'WP-24320750', 'user', 'VENKAT', 'venkat@isbc.ac.in', 'venkat@isbc.ac.in', 'Erp7005', '9449061512', 'ISBC College, Bangalore', '', 'Active', 53, 102, '2023-03-18 02:30:57', '2023-03-14 03:56:03', 'Disable'),
(166, 'WP-30979362', 'user', 'PALANISWAMY & CO', 'palcocbe@gmail.com', 'palcocbe@gmail.com', 'Erp3801', '98430 32080', 'PALANISWAMY & CO', '', 'Active', 53, 1, '2023-06-01 04:52:01', '2023-03-20 02:24:24', 'Disable'),
(167, 'WP-78811706', 'user', 'C P THAMIL SELVI', 'cpthamil.selvi72@gmail.com', 'cpthamil.selvi72@gmail.com', 'Erp5439', '9600361114', 'C P THAMIL SELVI', '', 'Active', 53, 1, '2023-06-01 04:51:06', '2023-03-20 04:39:43', 'Disable'),
(168, 'WP-47167000', 'user', 'KENIL MOTORS', 'Kenilmotors@gmail.com', 'Kenilmotors@gmail.com', 'Erp8451', '9750314742', 'KENIL MOTORS', '', 'Active', 53, 5620, '2023-08-04 08:43:23', '2023-03-21 04:27:12', 'Disable'),
(169, 'WP-95974042', 'reseller', 'SUBHA S', 'subha@gmail.com', 'subha@gmail.com', 'Erp6468', '7904820385', 'ADDSTECH', '', 'Active', 53, 8, '2023-03-24 12:34:28', '2023-03-24 11:48:15', 'Disable'),
(172, 'WP-39195879', 'user', 'SAGAR COMPUTERS', 'skanted@gmail.com', 'skanted@gmail.com', 'Erp3926', '9840362400', 'SAGAR COMPUTERS', '', 'Active', 53, 1, '2023-06-01 04:49:04', '2023-03-27 03:06:12', 'Disable'),
(173, 'WP-33403523', 'user', 'KOVAI MAGALAVILAS', 'kovaimangalavilas@gmail.com', 'kovaimangalavilas@gmail.com', 'Erp5481', '9092590975', 'hotel', '', 'Active', 53, 1, '2023-07-20 11:37:45', '2023-04-01 02:44:29', 'Disable'),
(174, 'WP-39530699', 'user', 'MILKYWAY EXPRESS', 'milkywayexpress@gmail.com', 'milkywayexpress@gmail.com', 'Erp4476', '9841332040', 'ICE CREAM', '', 'Active', 53, 1, '2023-07-20 11:37:19', '2023-04-08 01:42:53', 'Disable'),
(175, 'WP-92284864', 'user', 'BENJAMIN', 'lakshapromoters@gmail.com', 'lakshapromoters@gmail.com', 'Erp1358', '6369088733', 'REAL ESTATE', '', 'Active', 53, 2263, '2023-08-04 08:43:52', '2023-04-10 01:07:34', 'Disable'),
(176, 'WP-74187145', 'user', 'LARS BIO BAGS', 'larsbiobags@gmail.com', 'larsbiobags@gmail.com', 'Erp1402', '+91 98950 21315', 'BIO PRODUCTS', '', 'Active', 53, 1909, '2023-07-19 09:13:27', '2023-04-19 12:18:32', 'Disable'),
(177, 'WP-19978357', 'user', 'REJI KUMAR', 'reji@gmail.com', 'reji@gmail.com', 'Erp8831', '+968 9509 6388', 'REAL ESTATE', '', 'Active', 53, 3002, '2023-07-25 08:55:57', '2023-04-20 12:38:40', 'Disable'),
(178, 'WP-35205888', 'user', 'SELVA', 'Redpanther19711@gmail.com', 'Redpanther19711@gmail.com', 'Erp5679', '7904820385', 'JK CONSULTANCY SERVICES', '', 'Active', 53, 3050, '2023-08-03 11:41:46', '2023-04-26 05:22:56', 'Disable'),
(179, 'WP-12782532', 'user', 'CRS EDUNEXT', 'rajaramkck@gmail.com', 'rajaramkck@gmail.com', 'Erp3749', '+91 90250 45851', 'EDUCATION', '', 'Active', 53, 918, '2023-06-30 04:31:21', '2023-04-28 10:36:29', 'Disable'),
(180, 'WP-77763291', 'user', 'NICE RETAILS', 'ramees2@hotmail.com', 'ramees2@hotmail.com', 'Erp8824', '+91 99405 40535', 'NICE RETAILS', '', 'Active', 53, 50000, '2023-05-01 10:24:29', '2023-05-01 10:12:05', 'Disable'),
(181, 'WP-21733721', 'user', 'RAJ KUMAR', 'palluyirkalam@gmail.com', 'palluyirkalam@gmail.com', 'Erp7277', '919843052580', 'PALLUYIR KALAM', '', 'Active', 53, 2269, '2023-06-08 08:26:06', '2023-05-09 01:37:39', 'Disable'),
(182, 'WP-90236201', 'user', 'JAYAM MATRIMONIAL INFORMATION CENTRE', 'jayammatrimony2023@gmail.com', 'jayammatrimony2023@gmail.com', 'Erp5266', '9789780765', 'MATRIMONIAL INFORMATION CENTRE', '', 'Active', 53, 79, '2023-08-11 12:35:17', '2023-05-11 03:17:17', 'Disable'),
(183, 'WP-57694347', 'user', 'SEA WIND REALTORS INDIA PVT.LTD', 'salestcr@desaihomes.com', 'salestcr@desaihomes.com', 'Erp8029', '8129000118', 'SEA WIND REALTORS INDIA PVT.LTD', '', 'Active', 53, 1, '2023-08-05 10:51:43', '2023-05-17 10:54:24', 'Disable'),
(184, 'WP-93182796', 'user', 'VIGNESH', 'remi.imb@gmail.com', 'remi.imb@gmail.com', 'Erp3314', '8144317309', 'MICROTECH CLINICAL LAB', 'images_KUZFTMEU.jpg', 'Active', 53, 536, '2023-07-26 12:34:02', '2023-05-24 12:11:31', 'Disable'),
(185, 'WP-81159122', 'user', 'Dr. M.Thirumal', 'Karthickshivam52@gmail.com', 'Karthickshivam52@gmail.com', 'Erp6289', '8778916165', 'START HEALTH INSURANCE', '', 'Active', 53, 0, '2023-08-11 12:32:56', '2023-05-24 12:28:55', 'Disable'),
(186, 'WP-35756583', 'user', 'AVANTI GOYAL', 'avantibansal@gmail.com', 'avantibansal@gmail.com', 'Erp5059', '9585524400', 'URMIL\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'S KITCHEN', '', 'Active', 53, 41, '2023-08-25 01:11:15', '2023-05-24 01:02:33', 'Disable'),
(187, 'WP-82064348', 'user', 'Senmathi Computers', 'senmathicomputers@gmail.com', 'senmathicomputers@gmail.com', 'Erp9591', '81228 53905', 'SENTHAMARAI COLLEGE OF ARTS AND SCIENCE', '', 'Active', 53, 4648, '2023-07-01 12:02:34', '2023-05-25 04:52:42', 'Disable'),
(188, 'WP-92480409', 'user', 'Government arts and science collage Gud', 'bscitgudalur2013@gmail.com', 'bscitgudalur2013@gmail.com', 'Gasc123', '9976180939', 'Government arts and science collage Gud', '', 'Active', 1, 1035, '2023-07-01 11:57:50', '2023-05-26 09:51:54', 'Disable'),
(189, 'WP-47293810', 'user', 'RONIR POWER LLP', 'Ronirpower@gmail.com', 'Ronirpower@gmail.com', 'Erp8223', '9500084478', 'RONIR POWER LLP', '', 'Active', 53, 1263, '2023-07-27 08:13:17', '2023-05-26 04:42:15', 'Disable'),
(190, 'WP-59852078', 'user', 'JOSHUA JAYAKUMAR', 'financialadvisorjoshua@gmail.com', 'financialadvisorjoshua@gmail.com', 'Erp5898', '9443373653', 'JOSHUA JAYAKMAR', '', 'Active', 53, 0, '2023-07-25 08:57:20', '2023-05-27 10:49:44', 'Disable'),
(191, 'WP-58507904', 'user', 'GLADYES MAKEOVER', 'info@gladyesmakeover.com', 'info@gladyesmakeover.com', 'Erp4137', '91 770-890-8917', 'MAKEOVER', '', 'Active', 53, 0, '2023-07-25 08:58:38', '2023-05-27 11:31:03', 'Disable'),
(192, 'WP-30070174', 'user', 'BRIGHTLEARNING', 'brightlearning4u123@gmail.com', 'brightlearning4u123@gmail.com', 'Erp9558', '98422 85054', 'NEW BRIGHT LEARNING', 'images_ZFHDGY1R.jpg', 'Active', 53, 46555, '2023-06-30 04:32:07', '2023-05-27 03:10:13', 'Disable'),
(193, 'WP-82907986', 'user', 'ARUN KUMAR', 'makumar85@gmail.com', 'makumar85@gmail.com', 'Erp3831', '8012265125', 'INSURANCE', '', 'Active', 53, 94, '2023-08-30 12:15:39', '2023-05-29 04:11:26', 'Disable'),
(194, 'WP-73587156', 'user', 'DHIYA HERBAL PRODUCTS', 'dhiyaherbalproducts@gmail.com', 'dhiyaherbalproducts@gmail.com', 'Erp3673', '8248838393', 'HERBAL PRODUCTS', '', 'Active', 53, 68, '2023-08-30 12:16:13', '2023-06-02 03:07:35', 'Disable'),
(195, 'WP-83526497', 'user', 'NEW ZEDA INSTITUTE OF  FASHION', '1Zedafashion25@gmail.com', '1Zedafashion25@gmail.com', 'Erp8288', '9791117242', 'fashion design', '', 'Active', 53, 1232, '2023-08-30 12:17:04', '2023-06-03 11:07:40', 'Disable'),
(196, 'WP-28529505', 'user', 'PRIYA', 'smiley.priya69111@gmail.com', 'smiley.priya69111@gmail.com', 'Erp3625', '9390206050', 'PRIYA', '', 'Active', 1, 1, '2024-06-12 01:37:06', '2023-06-14 12:26:27', 'Disable'),
(197, 'WP-98002434', 'user', 'SRI RAM ASTROLOGY', 'ramu.bkvp@gmail.com', 'ramu.bkvp@gmail.com', 'Erp2974', '8072271277', 'Sri Ram Astrology centre', '', 'Active', 53, 2809, '2023-08-09 12:51:46', '2023-06-18 03:51:49', 'Disable'),
(198, 'WP-37879074', 'user', 'RICHNESS AC SERVICE', 'Richnessac@gmail.com', 'Richnessac@gmail.com', 'Erp3051', ' 8489953798', 'AC SERVICES', 'images_WEHLZAQ8.jpg', 'Active', 53, 207, '2023-07-25 08:58:56', '2023-06-20 01:40:00', 'Disable'),
(199, 'WP-91803638', 'user', 'VIMAL KUMAR P', 'vimalkannan08@gmail.com', 'vimalkannan08@gmail.com', 'Erp9852', '+91 9633276613', 'VIMAL KUMAR P', '', 'Active', 53, 144, '2023-07-27 08:21:05', '2023-06-21 11:45:00', 'Disable'),
(200, 'WP-41861934', 'user', 'WEB GLITS', 'webglits@gmail.com', 'webglits@gmail.com', 'Erp5927', '8124177847', 'WEB GLITS', '', 'Active', 53, 4200, '2023-07-26 12:34:40', '2023-06-27 09:59:13', 'Disable'),
(201, 'WP-24238229', 'user', 'DR.K.R RAJAVEL', 'riohmrajavel@gmail.com', 'riohmrajavel@gmail.com', 'Erp4826', '9943923399', 'DR.K.R RAJAVEL', '', 'Active', 53, 2608, '2023-08-25 01:08:05', '2023-07-05 10:45:43', 'Disable'),
(202, 'WP-73230533', 'user', 'DR. KRISHNAMURTHY KILARU', 'kkmkilaru@gmail.com', 'kkmkilaru@gmail.com', 'Erp5205', '9440632658', 'DR. KRISHNAMURTHY KILARU', '', 'Active', 53, 6563, '2023-08-09 12:52:50', '2023-07-05 04:41:00', 'Disable'),
(203, 'WP-15673163', 'reseller', 'Gowtham', 'tl.sales@nextleveltechs.in', 'tl.sales@nextleveltechs.in', 'Erp2010', '9281041625', 'Next Level Techs', '', 'Active', 1, 100000, '2023-07-08 11:56:19', '2023-07-08 11:42:11', 'Disable'),
(204, 'WP-56698194', 'user', 'TIPTOP TREASURE', 'tiptoprspuram@gmail.com', 'tiptoprspuram@gmail.com', 'Erp1522', '9994633718', 'TEXTILES', '', 'Active', 53, 5585, '2023-08-09 12:50:12', '2023-07-18 03:13:48', 'Disable'),
(205, 'WP-60543620', 'user', 'SURESH VARMAKALAI TREATMENT', 'varmasuresh2019@gmail.com', 'varmasuresh2019@gmail.com', 'Erp6786', '9865401680', 'VARMAKALAI', '', 'Active', 53, 1391, '2023-08-09 12:49:12', '2023-07-18 04:56:56', 'Disable'),
(206, 'WP-55539757', 'user', 'KATHIR ASSOCIATES', 'tkathiresan1978@gmail.com', 'tkathiresan1978@gmail.com', 'Erp6875', ' 9585530300', 'PRIVATE FINANCIS', '', 'Active', 53, 3057, '2023-08-25 01:12:41', '2023-07-21 11:05:41', 'Disable'),
(207, 'WP-63736470', 'user', 'CANSAI INTERIORS', 'cansaiinteriors@gmail.com', 'cansaiinteriors@gmail.com', 'Erp6025', ' 9902925913', 'CANSAI INTERIORS', '', 'Active', 53, 10000, '2023-08-03 11:30:37', '2023-08-01 05:32:41', 'Disable'),
(208, 'WP-99644541', 'user', 'JAYAM EDUCATIONAL INFORMATION CENTRE', 'jayabalanvimala1947@gmail.com', 'jayabalanvimala1947@gmail.com', 'Erp1859', '9789780765', 'JAYAM EDUCATIONAL INFORMATION CENTRE', '', 'Active', 53, 5780, '2023-08-30 12:17:24', '2023-08-04 10:22:14', 'Disable'),
(209, 'WP-24347017', 'reseller', 'HARITHA', 'harithaaddstech@gmail.com', 'harithaaddstech@gmail.com', 'Erp1451', '6369718001', 'ADDSTECH', '', 'Active', 53, 998389, '2024-02-23 11:44:15', '2023-09-01 03:07:15', 'Disable'),
(210, 'WP-97451316', 'user', 'NEW MOUNT OPTICALS', 'newmountopticals@gmail.com', 'newmountopticals@gmail.com', 'Erp7078', '+91 9080018870', 'NEW MOUNT OPTICALS', '', 'Active', 53, 6800, '2023-09-19 04:49:07', '2023-09-19 04:43:46', 'Disable'),
(211, 'WP-49701172', 'user', 'DEMO', 'wesenddemo@gmail.com', 'wesenddemo@gmail.com', 'demo', '7904820385', 'ADDSTECH', 'images_DP11VJJ2.jpg', 'Active', 53, 390, '2023-10-18 04:12:09', '2023-10-18 01:36:00', 'Disable'),
(212, 'WP-66961783', 'user', 'SS FASHIONS', 'ashwarth.sekhar@gmail.com', 'ashwarth.sekhar@gmail.com', 'Erp9935', '9966339940', 'SS FASHIONS WHOLESALE HOUSE', '', 'Active', 53, 94379, '2023-10-20 12:09:47', '2023-10-20 12:06:23', 'Disable'),
(213, 'WP-32175576', 'user', 'sreedharscce1', 'greenmarkeredutechstudio1@gmail.com', 'greenmarkeredutechstudio1@gmail.com', 'Erp4769', '7680887701', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:57:18', '2023-11-06 04:57:40', 'Disable'),
(214, 'WP-66460880', 'user', 'sreedharscce2', 'greenmarkeredutechstudio2@gmail.com', 'greenmarkeredutechstudio2@gmail.com', 'Erp1176', '7680887702', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:57:42', '2023-11-06 05:01:36', 'Disable'),
(215, 'WP-97740338', 'user', 'sreedharscce3', 'greenmarkeredutechstudio3@gmail.com', 'greenmarkeredutechstudio3@gmail.com', 'Erp1511', '7680887703', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:58:13', '2023-11-06 05:04:31', 'Disable'),
(216, 'WP-97373578', 'user', 'sreedharscce4', 'greenmarkeredutechstudio4@gmail.com', 'greenmarkeredutechstudio4@gmail.com', 'Erp6035', '7680887705', 'sreedharscce', '', 'Active', 1, 20000, '2023-11-07 02:58:40', '2023-11-06 05:07:42', 'Disable'),
(217, 'WP-45440949', 'user', 'sreedharscce5', 'greenmarkeredutechstudio5@gmail.com', 'greenmarkeredutechstudio5@gmail.com', 'Erp6583', '7680887704', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:56:45', '2023-11-06 05:11:22', 'Disable'),
(218, 'WP-62526135', 'user', 'sreedharscce6', 'greenmarkeredutechstudio6@gmail.com', 'greenmarkeredutechstudio6@gmail.com', 'Erp5327', '7680887706', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:56:16', '2023-11-06 05:13:55', 'Disable'),
(219, 'WP-27871594', 'user', 'sreedharscce7', 'greenmarkeredutechstudio7@gmail.com', 'greenmarkeredutechstudio7@gmail.com', 'Erp4852', '7680887707', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:55:39', '2023-11-06 05:15:05', 'Disable'),
(220, 'WP-92169554', 'user', 'sreedharscce8', 'greenmarkeredutechstudio8@gmail.com', 'greenmarkeredutechstudio8@gmail.com', 'Erp3014', '7680887708', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:55:09', '2023-11-06 05:16:30', 'Disable'),
(221, 'WP-13071506', 'user', 'sreedharscce9', 'greenmarkeredutechstudio9@gmail.com', 'greenmarkeredutechstudio9@gmail.com', 'Erp6767', '7680887709', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:54:44', '2023-11-06 05:17:59', 'Disable'),
(222, 'WP-37352642', 'user', 'sreedharscce10', 'greenmarkeredutechstudio10@gmail.com', 'greenmarkeredutechstudio10@gmail.com', 'Erp5859', '7680887700', 'sreedharscce', '', 'Active', 1, 10000, '2023-11-07 02:54:19', '2023-11-06 05:19:32', 'Disable'),
(223, 'WP-73746991', 'reseller', 'teeja shree', 'teeja', 'saleshead@7it.in', 'Erp3456', '877874132', '7soft', '', 'Active', 1, 800, '2024-02-23 02:36:17', '2024-02-23 11:45:39', 'Disable'),
(224, 'WP-31522426', 'reseller', 'sudha', 'abc', 'sudha@gmail.com', 'Erp6169', '9380711172', '7soft', '', 'Active', 1, 300, '2024-02-23 02:37:10', '2024-02-23 02:35:04', 'Disable'),
(225, 'WP-52903869', 'user', 'SREENU S', 'SREENU S', 'sreealluarjun143@gmail.com', 'Erp9416', '7483017152', 'ROWDY', 'images_KBDWSLQK.png', 'Active', 1, 991, '2024-03-26 01:10:10', '2024-03-26 12:56:35', 'Disable'),
(226, 'WP-90121745', 'user', 'Sneha', 'SnehaS', 'snehashitole0806@gmail.com', 'Erp5542', '17', '', '', 'Active', 1, 991, '2024-03-26 01:10:27', '2024-03-26 12:56:56', 'Disable'),
(227, 'WP-76487293', 'reseller', 'rakesh gudasi', 'rakesh', 'gudasirakesh12@gmail.com', 'Erp2590', '6362123049', '7soft', 'images_5GVAD9PL.jpeg', 'Active', 1, 0, NULL, '2024-03-26 12:57:47', 'Disable'),
(228, 'WP-46078321', 'user', 'rakesh gudasi', 'rakeshgudasi', 'rakeshg1234@gmail.com', 'Erp5821', '9591320704', '7soft', 'images_BAMB16LJ.jpeg', 'Active', 1, 992, '2024-03-26 01:25:02', '2024-03-26 01:18:03', 'Disable'),
(229, 'WP-51232864', 'user', 'ravin', 'ravi', 'bshiftmanager@7it.in', 'Erp7745', '9686595916', 'ravi', 'images_2CW4B87D.png', 'Active', 1, 0, NULL, '2024-03-27 02:56:12', 'Disable'),
(230, 'WP-30847344', 'user', 'naveenreddy', 'naveenreddy', 'reddynaveen.svmr@gmail.com', 'naveenreddy@123', '9398296188', '', '', 'Active', 1, 1800, '2024-04-04 12:21:30', '2024-04-02 10:29:53', 'Disable'),
(231, 'WP-53641030', 'user', 'NEETAI TECH', '4neetaitech@gmail.com', '4neetaitech@gmail.com', 'Erp7288', '8008600006', 'IT', 'images_KLN8CAYU.jpg', 'Active', 1, 0, '2024-06-11 11:45:48', '2024-06-06 12:59:28', 'Disable'),
(232, 'WP-47840844', 'user', 'NEETAI TECH', '3neetaitech@gmail.com', '3neetaitech@gmail.com', 'Erp4023', '8008600007', 'IT', 'images_V7TJHXCB.jpg', 'Active', 1, 1795, '2024-06-11 11:45:12', '2024-06-06 01:00:45', 'Disable'),
(233, 'WP-97747295', 'user', 'TALK GLOBAL', 'TALK GLOBAL', 'shoba@talkglobal.in', 'Erp9849', '9349505060', 'TALK GLOBAL', '', 'Active', 1, 79974, '2024-06-18 01:24:02', '2024-06-18 01:22:09', 'Disable'),
(234, 'WP-13408149', 'user', 'NEETAI TECH6', '6neetaitech@gmail.com', '6neetaitech@gmail.com', 'Erp4158', '8008600012', 'NEETAI TECH6', '', 'Active', 1, 43000, '2024-07-05 06:17:37', '2024-07-05 06:13:10', 'Disable'),
(235, 'WP-17993869', 'user', 'NEETAI TECH7', '7netaitech@gmail.com', '7netaitech@gmail.com', 'Erp2145', '8008600013', 'NEETAI TECH7', '', 'Active', 1, 43000, '2024-07-05 06:21:35', '2024-07-05 06:19:42', 'Disable'),
(236, 'WP-56910453', 'user', 'NEETAI TECH8', '8neetaitech@gmail.com', '8neetaitech@gmail.com', 'Erp9986', '8008600014', 'NEETAI TECH8', '', 'Active', 1, 42000, '2024-07-05 06:33:41', '2024-07-05 06:27:16', 'Disable'),
(237, 'WP-53675910', 'user', 'NEETAI TECH9', '9neetaitech@gmail.com', '9neetaitech@gmail.com', 'Erp6145', '8008600015', 'NEETAI TECH9', '', 'Active', 1, 44000, '2024-07-05 06:43:35', '2024-07-05 06:35:37', 'Disable');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
