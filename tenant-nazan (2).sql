-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2024 at 01:26 PM
-- Server version: 11.2.2-MariaDB
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenant-nazan`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `id` int(11) NOT NULL,
  `backup` varchar(255) NOT NULL,
  `size` int(11) NOT NULL DEFAULT 0 COMMENT 'in mbs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`id`, `backup`, `size`, `created_at`, `updated_at`) VALUES
(5, '2024-02-20-12-43-19.zip', 0, '2024-02-20 07:43:20', '2024-02-20 07:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `base_permissions`
--

CREATE TABLE `base_permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `owner` tinyint(1) NOT NULL DEFAULT 0,
  `super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `manager` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `base_permissions`
--

INSERT INTO `base_permissions` (`id`, `permission`, `owner`, `super_admin`, `admin`, `manager`) VALUES
(1, 'add category', 0, 0, 0, 0),
(2, 'add certification', 0, 0, 0, 0),
(3, 'add client', 0, 0, 0, 0),
(4, 'add company', 0, 0, 0, 0),
(5, 'add people', 0, 0, 0, 0),
(6, 'add people document', 0, 0, 0, 0),
(7, 'add project', 0, 0, 0, 0),
(8, 'add site', 0, 0, 0, 0),
(9, 'add subcontractor', 0, 0, 0, 0),
(10, 'add subcontractor team', 0, 0, 0, 0),
(11, 'add suboperative', 0, 0, 0, 0),
(12, 'add training', 0, 0, 0, 0),
(13, 'add user', 0, 0, 0, 0),
(14, 'backup all companies data', 0, 0, 0, 0),
(15, 'backup company data', 0, 0, 0, 0),
(16, 'change project status', 0, 0, 0, 0),
(17, 'delete category', 0, 0, 0, 0),
(18, 'delete certification', 0, 0, 0, 0),
(19, 'delete client', 0, 0, 0, 0),
(20, 'delete people', 0, 0, 0, 0),
(21, 'delete people document', 0, 0, 0, 0),
(22, 'delete project', 0, 0, 0, 0),
(23, 'delete site', 0, 0, 0, 0),
(24, 'delete subcontractor', 0, 0, 0, 0),
(25, 'delete subcontractor team', 0, 0, 0, 0),
(26, 'delete suboperative', 0, 0, 0, 0),
(27, 'delete suboperative document', 0, 0, 0, 0),
(28, 'delete training', 0, 0, 0, 0),
(29, 'delete user', 0, 0, 0, 0),
(30, 'edit people document', 0, 0, 0, 0),
(31, 'edit subcontractor team', 0, 0, 0, 0),
(32, 'people listing', 0, 0, 0, 0),
(33, 'people search', 0, 0, 0, 0),
(34, 'restore company data', 0, 0, 0, 0),
(35, 'site listing', 0, 0, 0, 0),
(36, 'site search', 0, 0, 0, 0),
(37, 'subcontractor listing', 0, 0, 0, 0),
(38, 'suspend company account', 0, 0, 0, 0),
(39, 'update category', 0, 0, 0, 0),
(40, 'update certification', 0, 0, 0, 0),
(41, 'update client', 0, 0, 0, 0),
(42, 'update people', 0, 0, 0, 0),
(43, 'update project', 0, 0, 0, 0),
(44, 'update settings', 0, 0, 0, 0),
(45, 'update site', 0, 0, 0, 0),
(46, 'update subcontractor', 0, 0, 0, 0),
(47, 'update suboperative', 0, 0, 0, 0),
(48, 'update training', 0, 0, 0, 0),
(49, 'update user', 0, 0, 0, 0),
(50, 'upload suboperative document', 0, 0, 0, 0),
(51, 'view category listing', 0, 0, 0, 0),
(52, 'view certification', 0, 0, 0, 0),
(53, 'view clients', 0, 0, 0, 0),
(54, 'view companies', 0, 0, 0, 0),
(55, 'view dashboard', 0, 0, 0, 0),
(56, 'view people document', 0, 0, 0, 0),
(57, 'view projects', 0, 0, 0, 0),
(58, 'view settings', 0, 0, 0, 0),
(59, 'view subcontractor teams', 0, 0, 0, 0),
(60, 'view suboperative document', 0, 0, 0, 0),
(61, 'view suboperatives of a subcontractor', 0, 0, 0, 0),
(62, 'view training', 0, 0, 0, 0),
(63, 'view user listing', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'CSCS'),
(2, 'NPORS / CPCS'),
(3, 'Occupational Health'),
(4, 'Driving License'),
(5, 'Confined Space'),
(6, 'EUSR'),
(7, 'EUSR Excavations'),
(8, 'Safety Internal'),
(9, 'SMSTS'),
(10, 'SSSTS'),
(11, 'The Faraday Centre'),
(12, 'Cable Installation'),
(13, 'CITB'),
(14, 'CPCS'),
(15, 'City & Guilds'),
(16, 'PASMA - Prefabricated Access Suppliers and Manufacturers Association');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `certification` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `category_id`, `certification`, `created_at`, `updated_at`) VALUES
(1, 1, 'GREEN Labourer', '2023-08-03 09:48:32', '2023-09-06 12:45:20'),
(3, 2, '180 excavator above 5 ton', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(4, 2, '180 excavator below 5 ton', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(5, 2, '360 Excavator (Tracked / Below 5T)', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(6, 2, '360 Excavator < 10T Tracked', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(7, 2, '360 Excavator < 10T Wheel', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(8, 2, '360 Excavator > 10T Tracked', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(9, 2, '360 Excavator > 10T Wheel', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(10, 2, '360 Lifting Operations', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(11, 2, 'Abrasive Wheels', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(12, 2, 'Agricultural Tractor', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(13, 2, 'Cable Avoidance Tools', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(14, 2, 'Crusher/ Screener', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(15, 2, 'Dozer', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(16, 2, 'Dump Truck (Articulated)', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(17, 2, 'Dump Truck (Rigid) Track', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(18, 2, 'Dump Truck (Rigid) Wheel', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(19, 2, 'Excavation Marshall - Banksperson', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(20, 2, 'Excavator as a crane', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(21, 2, 'Forward tipping dumper', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(22, 2, 'Forward Tipping Dumper (Tracked/Wheeled)', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(23, 2, 'Lift Supervisor', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(24, 2, 'Lorry Loader Clamshell Bucket N107A', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(25, 2, 'Rear Dump Truck (Rigid/Tracked/Below 10T)', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(26, 2, 'Ride on Roller N214RV', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(27, 2, 'Roller', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(28, 2, 'Slinger Signaller', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(29, 2, 'Streetworks', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(30, 2, 'Telescopic Handler EX360 Slew', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(31, 2, 'Telescopic Handler Suspended N138', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(32, 2, 'Telescopic Handler Up to 9 metres (N010B)', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(33, 2, 'Temporary Works Coordinator', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(34, 2, 'Temporary Works Supervisor', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(35, 2, 'Tracked Dumper', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(36, 2, 'Vehicle Marshall', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(37, 2, 'Wheeled Loading Shovel', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(38, 2, 'Winch Grundowinch KW5000', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(39, 2, 'Winches P009', '2023-09-06 12:42:55', '2023-09-06 12:42:55'),
(40, 1, 'BESC & Persons', '2023-09-06 12:44:24', '2023-09-06 12:44:24'),
(41, 1, 'BLACK Site Manager', '2023-09-06 12:44:24', '2023-09-06 12:44:24'),
(42, 1, 'BLUE Skilled Worker', '2023-09-06 12:44:24', '2023-09-06 12:44:24'),
(45, 1, 'Health and Safety Test', '2023-09-06 12:44:24', '2023-09-06 12:44:24'),
(46, 1, 'RED Trainee', '2023-09-06 12:44:24', '2023-09-06 12:44:24'),
(47, 1, 'SEQOHS', '2023-09-06 12:44:24', '2023-09-06 12:44:24'),
(51, 1, 'Gold Supervisor', '2023-09-06 12:44:32', '2023-09-06 12:44:32'),
(52, 1, 'GREY Const. Occupation', '2023-09-06 12:44:32', '2023-09-06 12:44:32'),
(57, 1, 'SMSTS', '2023-09-06 12:46:43', '2023-09-06 12:46:43'),
(58, 1, 'SSSTS', '2023-09-06 12:46:43', '2023-09-06 12:46:43'),
(59, 1, 'SWQR', '2023-09-06 12:46:43', '2023-09-06 12:46:43'),
(60, 3, 'Chartered Member of IOSH', '2023-09-06 14:15:06', '2023-09-06 14:21:59'),
(61, 3, 'Confined Space', '2023-09-06 14:15:06', '2023-09-06 14:21:23'),
(62, 3, 'COSS', '2023-09-06 14:15:06', '2023-09-06 14:23:10'),
(63, 3, 'COSS Assessment', '2023-09-06 14:15:06', '2023-09-06 14:23:22'),
(64, 3, 'CPCS card', '2023-09-06 14:15:06', '2023-09-06 14:19:24'),
(65, 3, 'Emergency First Aid', '2023-09-06 14:15:06', '2023-09-06 14:18:37'),
(66, 3, 'First Aid', '2023-09-06 14:15:06', '2023-09-06 14:20:57'),
(67, 3, 'Graduate Member of IOSH', '2023-09-06 14:15:06', '2023-09-06 14:22:13'),
(68, 1, 'IWA Assessment', '2023-09-06 14:15:06', '2023-09-06 14:15:06'),
(69, 3, 'Lookout / Site Warden', '2023-09-06 14:15:06', '2023-09-06 14:24:14'),
(70, 3, 'Manual Handling', '2023-09-06 14:15:06', '2023-09-06 14:23:39'),
(71, 3, 'NEBOSH Construction', '2023-09-06 14:15:06', '2023-09-06 14:24:55'),
(72, 3, 'NEBOSH Diploma', '2023-09-06 14:15:06', '2023-09-06 14:25:07'),
(73, 3, 'NPORS', '2023-09-06 14:15:07', '2023-09-06 14:26:33'),
(74, 3, 'Qualified First Aider (3 day)', '2023-09-06 14:15:07', '2023-09-06 14:24:38'),
(75, 3, 'Safe System of Work (SSoW) Planner', '2023-09-06 14:15:07', '2023-09-06 14:23:58'),
(76, 3, 'Streetworks', '2023-09-06 14:15:07', '2023-09-06 14:25:57'),
(77, 3, 'Tech IOSH', '2023-09-06 14:15:07', '2023-09-06 14:25:36'),
(78, 3, 'Working at Height', '2023-09-06 14:15:07', '2023-09-06 14:22:44'),
(80, 5, 'Control Entry', '2023-09-06 14:17:01', '2023-09-06 14:17:01'),
(81, 5, 'High Risk Confined Space', '2023-09-06 14:17:01', '2023-09-06 14:17:01'),
(82, 5, 'Low Risk Confined Space', '2023-09-06 14:17:01', '2023-09-06 14:17:01'),
(83, 5, 'Medium Risk Confined Space', '2023-09-06 14:17:01', '2023-09-06 14:17:01'),
(84, 5, 'Recovery Of Casualties', '2023-09-06 14:17:01', '2023-09-06 14:17:01'),
(85, 5, 'Teams In Confined Space', '2023-09-06 14:17:01', '2023-09-06 14:17:01'),
(86, 4, 'Standard License', '2023-09-06 14:17:23', '2023-09-06 14:17:23'),
(87, 6, 'Access, Movement & Egress - Substations', '2023-09-06 14:29:21', '2023-09-06 14:30:16'),
(88, 6, 'HSG47', '2023-09-06 14:29:21', '2023-09-06 14:30:31'),
(89, 6, 'Nat Grid Persons', '2023-09-06 14:29:21', '2023-09-06 14:34:23'),
(90, 6, 'SHEA Gas', '2023-09-06 14:29:21', '2023-09-06 14:33:41'),
(91, 6, 'SHEA Power', '2023-09-06 14:29:21', '2023-09-06 14:33:51'),
(92, 6, 'SHEA Telecommunications', '2023-09-06 14:29:21', '2023-09-06 14:34:07'),
(93, 6, 'TP137', '2023-09-06 14:29:21', '2023-09-06 14:34:38'),
(94, 6, 'Water Hygiene', '2023-09-06 14:29:21', '2023-09-06 14:34:51'),
(95, 7, 'EUSR Category 1 Locate Utility', '2023-09-06 14:35:52', '2023-09-06 14:35:52'),
(96, 7, 'EUSR Category 2 Safe Digging', '2023-09-06 14:35:52', '2023-09-06 14:35:52'),
(97, 7, 'EUSR Category 3 Timber Supports', '2023-09-06 14:35:52', '2023-09-06 14:35:52'),
(98, 7, 'USR Category 4 Steel Supports', '2023-09-06 14:35:52', '2023-09-06 14:35:52'),
(99, 7, 'EUSR Category 5 Proprietary Supports', '2023-09-06 14:35:52', '2023-09-06 14:35:52'),
(100, 8, 'Asbestoss Awareness', '2023-09-06 14:36:40', '2023-09-06 14:36:40'),
(101, 8, 'Fire Warden', '2023-09-06 14:36:40', '2023-09-06 14:36:40'),
(102, 8, 'First Aider', '2023-09-06 14:36:40', '2023-09-06 14:36:40'),
(103, 8, 'Manual Handling', '2023-09-06 14:36:40', '2023-09-06 14:36:40'),
(104, 9, 'Site Management Safety Training Scheme (Site Manager)', '2023-09-06 14:37:20', '2023-09-06 14:37:20'),
(105, 10, 'Site Supervision Safety Training Scheme', '2023-09-06 14:41:15', '2023-09-06 14:41:15'),
(106, 11, 'High Voltage Cable Sheath Testing (T1E)', '2023-09-21 13:48:59', '2023-09-21 13:48:59'),
(107, 12, 'Cable Installers and Layers Course including winch safety', '2023-09-21 15:56:31', '2023-09-21 15:56:31'),
(108, 2, 'Agricultural Tractor - Towing only', '2023-09-21 16:17:00', '2023-09-21 16:17:00'),
(109, 5, 'IPAF - Powered Access License', '2023-09-21 16:35:16', '2023-09-21 16:35:16'),
(110, 13, 'Health and Safety Awareness', '2023-09-22 09:54:10', '2023-09-22 09:56:47'),
(113, 2, 'Plant and Machinery Marshall', '2023-09-25 13:10:21', '2023-09-25 13:10:21'),
(114, 12, 'Correct and Safe Use of Winch Grundowinch KW5000', '2023-09-25 13:52:38', '2023-09-25 13:52:38'),
(115, 2, 'Mobile Crane - Blocked Duties Only', '2023-09-26 09:39:13', '2023-09-26 09:39:13'),
(116, 1, 'CISRS - Construction Industry Scaffolders Record Scheme', '2023-09-26 09:54:47', '2023-09-26 09:54:47'),
(118, 15, 'Level 2 Award in Communications Cabling', '2023-09-26 16:16:13', '2023-09-26 16:16:13'),
(119, 16, 'Tower', '2023-09-27 10:41:05', '2023-09-27 10:41:05'),
(120, 13, 'Temporary Works Coordinator', '2023-09-27 11:01:10', '2023-09-27 11:01:10'),
(121, 2, 'Crane Supervisor (Lifting Operations)', '2023-11-08 11:28:05', '2023-11-08 11:28:05'),
(122, 2, 'Crane/ Lifting Operations Supervisor', '2023-11-08 11:34:04', '2023-11-08 11:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `contact_email`, `contact_name`, `contact_number`, `created_at`, `updated_at`) VALUES
(2, 'Jason', 'Boune', 'ds', 'sd', 'ds', NULL, NULL),
(3, 'New Client', 'House 32', 'Bas@gmail.com', 'Jason', '34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_class` int(11) NOT NULL,
  `doc_path` text NOT NULL,
  `batch` varchar(255) NOT NULL,
  `expire_at` date NOT NULL,
  `status` enum('Active','Expiring','Expired','Archived','Critical') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `people_id`, `user_id`, `doc_class`, `doc_path`, `batch`, `expire_at`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 2, 1, 110, '436994968-1519294252333289-5916693965914580355-n-66337b270a0de.jpg', 'RrRu1APVJq', '2024-05-13', 'Critical', '2024-05-07 10:52:27', '2024-05-07 05:52:27', NULL),
(17, 2, 1, 118, '434471147-122139643028145099-946713275191737839-n-66337b5eb77fb.jpg', 'pO3efcILBB', '2024-05-20', 'Critical', '2024-05-07 10:52:27', '2024-05-07 05:52:27', NULL),
(31, 1, 1, 107, '438145263-25591660793765569-7610211610851610991-n-663b045162265.jpg', 'KzOxojN6PJ', '2024-05-01', 'Expired', '2024-05-08 04:49:22', '2024-05-07 23:49:22', NULL),
(35, 1, 1, 84, '8p45xe-665ee8d11d573.jpg', 'cEOVpLKMTa', '2025-04-17', 'Active', '2024-06-04 10:13:38', '2024-06-04 05:13:38', NULL),
(38, 1, 1, 114, 'City-Guilds-1-1-664357ce883e9.pdf', 'PaDY4DSju7', '2024-06-29', 'Expiring', '2024-05-14 12:23:51', '2024-05-14 07:23:51', NULL),
(42, 1, 1, 105, 'Certificate-6644522336fa7.PDF', 'MmVzUrRvuE', '2024-10-23', 'Active', '2024-05-15 06:54:24', '2024-05-15 01:11:48', NULL),
(43, 1, 1, 83, '438169731-949487913217305-2830138770246909568-n-66445aa291662.jpg', 'WSNWp1TGzy', '2024-08-01', 'Expiring', '2024-05-15 06:48:07', '2024-05-15 01:48:07', NULL),
(44, 1, 1, 104, 'fa-66445ca0a7c7b.pdf,First-Aid-Certificate-1-7-664357ea7249c-66445ca0a7e52.jpeg', 'BSZ7LrB6pH', '2024-07-26', 'Expiring', '2024-05-15 06:56:40', '2024-05-15 01:56:40', NULL),
(45, 1, 1, 17, '8p45xe-665eeb6041bc0.jpg', 'Ur0C2eJHsl', '2024-06-01', 'Expired', '2024-06-04 11:21:41', '2024-06-04 06:21:41', NULL),
(46, 5, 1, 107, '444960032-8608111202548574-521912676586181008-n-666c38d159dd9.jpg', 'kLvgbJnqYK', '2025-01-03', 'Active', '2024-06-14 12:34:48', '2024-06-14 07:34:48', NULL),
(47, 5, 1, 114, 'GQx2abcXkAA2yef-667ab44d23f31.jpeg', 'ysOwS0pnVS', '2024-09-19', 'Expiring', '2024-06-25 12:13:01', '2024-06-25 07:13:01', NULL),
(48, 3, 1, 107, 'GScKXU4XgAAELF1-6698ff8ecdfc1.jpeg', 'eDLAtGxSP2', '2025-01-16', 'Active', '2024-07-18 11:42:28', '2024-07-18 06:42:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_07_04_065027_create_activity_log_table', 1),
(2, '2023_07_04_065027_create_categories_table', 1),
(3, '2023_07_04_065027_create_certifications_table', 1),
(4, '2023_07_04_065027_create_documents_table', 1),
(5, '2023_07_04_065027_create_failed_jobs_table', 1),
(6, '2023_07_04_065027_create_holidays_table', 1),
(7, '2023_07_04_065027_create_model_has_permissions_table', 1),
(8, '2023_07_04_065027_create_model_has_roles_table', 1),
(9, '2023_07_04_065027_create_monitors_table', 1),
(10, '2023_07_04_065027_create_oauth_access_tokens_table', 1),
(11, '2023_07_04_065027_create_oauth_auth_codes_table', 1),
(12, '2023_07_04_065027_create_oauth_clients_table', 1),
(13, '2023_07_04_065027_create_oauth_personal_access_clients_table', 1),
(14, '2023_07_04_065027_create_oauth_refresh_tokens_table', 1),
(15, '2023_07_04_065027_create_permissions_table', 1),
(16, '2023_07_04_065027_create_personal_access_tokens_table', 1),
(17, '2023_07_04_065027_create_project_assignments_table', 1),
(18, '2023_07_04_065027_create_projects_table', 1),
(19, '2023_07_04_065027_create_role_has_permissions_table', 1),
(20, '2023_07_04_065027_create_roles_table', 1),
(21, '2023_07_04_065027_create_settings_table', 1),
(22, '2023_07_04_065027_create_site_contacts_table', 1),
(23, '2023_07_04_065027_create_subcontractor_contacts_table', 1),
(24, '2023_07_04_065027_create_subcontractors_table', 1),
(25, '2023_07_04_065027_create_suboperative_documents_table', 1),
(26, '2023_07_04_065027_create_suboperatives_table', 1),
(27, '2023_07_04_065027_create_teams_table', 1),
(28, '2023_07_04_065027_create_telescope_entries_table', 1),
(29, '2023_07_04_065027_create_telescope_entries_tags_table', 1),
(30, '2023_07_04_065027_create_telescope_monitoring_table', 1),
(31, '2023_07_04_065027_create_users_table', 1),
(32, '2023_07_04_065030_add_foreign_keys_to_model_has_permissions_table', 1),
(33, '2023_07_04_065030_add_foreign_keys_to_model_has_roles_table', 1),
(34, '2023_07_04_065030_add_foreign_keys_to_role_has_permissions_table', 1),
(35, '2023_07_04_065030_add_foreign_keys_to_telescope_entries_tags_table', 1),
(36, '2023_07_06_124247_create_sites_table', 1),
(37, '2023_07_08_094024_create_people_table', 1),
(38, '2023_09_18_060959_create_trainings_table', 1),
(39, '2023_10_04_111246_create_base_permissions_table', 1),
(40, '2023_10_04_134848_create_clients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `monitors`
--

CREATE TABLE `monitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `uptime_check_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `look_for_string` varchar(255) NOT NULL DEFAULT '',
  `uptime_check_interval_in_minutes` varchar(255) NOT NULL DEFAULT '5',
  `uptime_status` varchar(255) NOT NULL DEFAULT 'not yet checked',
  `uptime_check_failure_reason` text DEFAULT NULL,
  `uptime_check_times_failed_in_a_row` int(11) NOT NULL DEFAULT 0,
  `uptime_status_last_change_date` timestamp NULL DEFAULT NULL,
  `uptime_last_check_date` timestamp NULL DEFAULT NULL,
  `uptime_check_failed_event_fired_on_date` timestamp NULL DEFAULT NULL,
  `uptime_check_method` varchar(255) NOT NULL DEFAULT 'get',
  `uptime_check_payload` text DEFAULT NULL,
  `uptime_check_additional_headers` text DEFAULT NULL,
  `uptime_check_response_checker` varchar(255) DEFAULT NULL,
  `certificate_check_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `certificate_status` varchar(255) NOT NULL DEFAULT 'not yet checked',
  `certificate_expiration_date` timestamp NULL DEFAULT NULL,
  `certificate_issuer` varchar(255) DEFAULT NULL,
  `certificate_check_failure_reason` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_log`
--

CREATE TABLE `notification_log` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `doc_type` enum('people','subop') NOT NULL DEFAULT 'people',
  `channel` enum('email','sms') NOT NULL DEFAULT 'email',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_log`
--

INSERT INTO `notification_log` (`id`, `entity_id`, `type`, `doc_type`, `channel`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 1, '90doc', 'people', 'email', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(11, 2, '60doc', 'people', 'email', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(12, 3, '30doc', 'people', 'email', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(13, 3, '30doc', 'people', 'sms', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(14, 4, '0doc', 'people', 'email', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(15, 4, '0doc', 'people', 'sms', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(16, 1, '60subdoc', 'subop', 'email', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(17, 1, '30subdoc', 'subop', 'email', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(18, 1, '30subdoc', 'subop', 'sms', '2024-03-11 08:59:14', '2024-03-11 08:59:14', NULL),
(19, 16, '30doc', 'people', 'email', '2024-05-07 05:52:27', '2024-05-07 05:52:27', NULL),
(20, 17, '30doc', 'people', 'email', '2024-05-07 05:52:27', '2024-05-07 05:52:27', NULL),
(21, 26, '30doc', 'people', 'email', '2024-05-07 05:52:27', '2024-05-07 05:52:27', NULL),
(22, 16, '30doc', 'people', 'sms', '2024-05-07 05:52:27', '2024-05-07 05:52:27', NULL),
(23, 17, '30doc', 'people', 'sms', '2024-05-07 05:52:27', '2024-05-07 05:52:27', NULL),
(24, 26, '30doc', 'people', 'sms', '2024-05-07 05:52:27', '2024-05-07 05:52:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jasonstatham9483@gmail.com', 'be67c5ea8d77ed20bb857b5800324688', '2024-02-23 01:50:16'),
('jasonstatham9483@gmail.com', '4715cf17be29be7fb39c674cb2b8194f', '2024-03-11 09:15:33'),
('jasonstatham9483@gmail.com', '14299b5e4081a48ca119d0f23a0f2cf3', '2024-03-11 09:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nok` varchar(255) DEFAULT NULL,
  `nok_contact` varchar(255) DEFAULT NULL,
  `is_fit` enum('Yes','No') DEFAULT NULL,
  `medically_fit` varchar(255) DEFAULT NULL,
  `medical_reason` text DEFAULT NULL,
  `ni_number` varchar(255) DEFAULT NULL,
  `cpcs_number` varchar(255) DEFAULT NULL,
  `eusr_number` varchar(255) DEFAULT NULL,
  `nposr_number` varchar(255) DEFAULT NULL,
  `utr_number` varchar(255) DEFAULT NULL,
  `is_valid_driving_license` enum('Yes','No') DEFAULT NULL,
  `bank_detail` varchar(255) DEFAULT NULL,
  `sort_code` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `available_from` date DEFAULT NULL,
  `employ_start` date DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `driving_license_path` varchar(255) DEFAULT NULL,
  `dl_expire` date DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `cv_expire` date DEFAULT NULL,
  `dl_status` enum('New','Expiring','Expired') DEFAULT 'New',
  `rating` tinyint(4) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `added_by`, `first_name`, `last_name`, `address1`, `address2`, `postcode`, `country`, `county`, `mobile`, `email`, `nok`, `nok_contact`, `is_fit`, `medically_fit`, `medical_reason`, `ni_number`, `cpcs_number`, `eusr_number`, `nposr_number`, `utr_number`, `is_valid_driving_license`, `bank_detail`, `sort_code`, `category`, `cat_id`, `dob`, `available_from`, `employ_start`, `admin_notes`, `photo_path`, `driving_license_path`, `dl_expire`, `cv_path`, `cv_expire`, `dl_status`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jason', 'Bourne', NULL, NULL, NULL, NULL, NULL, '03223', 'jason@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-14', NULL, '1970-01-01', NULL, '436994968-1519294252333289-5916693965914580355-n-66210720373b0.jpg', NULL, NULL, NULL, NULL, 'Expired', NULL, 'Inactive', '2023-10-05 02:03:10', '2024-05-09 05:59:38'),
(2, 1, 'hem', 'ds', NULL, NULL, NULL, NULL, NULL, '2332', 'sds@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, '1970-01-01', NULL, '436994968-1519294252333289-5916693965914580355-n.jpg', NULL, NULL, NULL, NULL, 'Expired', NULL, 'Inactive', '2023-10-09 12:51:06', '2024-04-18 06:10:32'),
(3, 1, 'noah', 'sd', 'sd', NULL, NULL, NULL, NULL, 'sd', 'sdds@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1977-02-23', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 'New', NULL, 'Inactive', '2023-12-07 00:13:25', '2023-12-07 00:13:36'),
(4, 1, 'lerda', 'ds', NULL, NULL, NULL, NULL, NULL, 'sd', 'ds@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 'New', NULL, 'Inactive', '2023-12-07 00:14:33', '2023-12-07 00:14:33'),
(5, 1, 'Luka', 'Luka', NULL, NULL, NULL, NULL, NULL, 'Luka', 'Luka@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-22', NULL, '1970-01-01', NULL, 'GScKXU4XgAAELF1-6698f8ca89db1.jpeg', NULL, NULL, NULL, NULL, 'New', NULL, 'Inactive', '2024-02-29 06:33:33', '2024-07-21 01:55:19'),
(6, 1, 'soka', 'sd', NULL, NULL, NULL, NULL, NULL, '43', 'dsds@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-18', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 'New', NULL, 'Inactive', '2024-06-14 06:59:13', '2024-06-14 06:59:13'),
(7, 1, 'sd', 'ds', NULL, NULL, NULL, NULL, NULL, 'ds', 'hi@toddmmyarnold.co.uk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-11', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 'New', NULL, 'Inactive', '2024-06-14 07:45:42', '2024-06-14 07:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add category', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(2, 'add certification', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(3, 'add client', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(4, 'add company', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(5, 'add people', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(6, 'add people document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(7, 'add project', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(8, 'add site', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(9, 'add subcontractor', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(10, 'add subcontractor team', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(11, 'add suboperative', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(12, 'add training', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(13, 'add user', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(14, 'backup all companies data', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(15, 'backup company data', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(16, 'change project status', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(17, 'delete category', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(18, 'delete certification', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(19, 'delete client', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(20, 'delete people', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(21, 'delete people document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(22, 'delete project', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(23, 'delete site', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(24, 'delete subcontractor', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(25, 'delete subcontractor team', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(26, 'delete suboperative', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(27, 'delete suboperative document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(28, 'delete training', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(29, 'delete user', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(30, 'edit people document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(31, 'edit subcontractor team', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(32, 'people listing', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(33, 'people search', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(34, 'restore company data', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(35, 'site listing', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(36, 'site search', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(37, 'subcontractor listing', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(38, 'suspend company account', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(39, 'update category', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(40, 'update certification', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(41, 'update client', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(42, 'update people', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(43, 'update project', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(44, 'update settings', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(45, 'update site', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(46, 'update subcontractor', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(47, 'update suboperative', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(48, 'update training', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(49, 'update user', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(50, 'upload suboperative document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(51, 'view category listing', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(52, 'view certification', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(53, 'view clients', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(54, 'view companies', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(55, 'view dashboard', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(56, 'view people document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(57, 'view projects', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(58, 'view settings', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(59, 'view subcontractor teams', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(60, 'view suboperative document', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(61, 'view suboperatives of a subcontractor', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(62, 'view training', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(63, 'view user listing', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `job_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brief` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `sheet_url` varchar(255) DEFAULT NULL,
  `status` enum('Planning','Active','Complete','Handover','Archived') DEFAULT 'Planning',
  `status_changed_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `site_id`, `job_no`, `name`, `brief`, `start_date`, `due_date`, `sheet_url`, `status`, `status_changed_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'MT', 'Project Manhattan', 'sd', '2023-11-01', '2024-06-14', 'sd', 'Handover', NULL, '2023-10-09 12:48:23', '2024-06-07 07:50:17'),
(2, 3, 1, 'klj', 'jkl', 'jh', '2023-12-06', '2024-09-13', 'test', 'Archived', '2024-07-27', '2023-12-19 07:16:03', '2024-07-27 08:15:08'),
(3, 2, 1, 'sd', 'ds', 'ds', '2024-02-08', '2024-02-27', 'ds', 'Active', '2024-06-24', '2024-02-15 07:41:03', '2024-06-24 09:21:39'),
(4, 2, 1, 'sd', 'ds', 'ds', '2024-02-08', '2024-02-27', 'ds', 'Handover', NULL, '2024-02-15 07:44:05', '2024-06-06 06:07:27'),
(5, 2, 1, 'sds', 'ds', 'ds', '2024-02-06', '2024-02-13', 'ds', 'Handover', NULL, '2024-02-15 07:57:11', '2024-06-24 09:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `project_assignments`
--

CREATE TABLE `project_assignments` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_assignments`
--

INSERT INTO `project_assignments` (`id`, `doc_id`, `project_id`, `people_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 46, 1, 5, '2024-03-01', '2024-07-19', '2024-02-29 06:34:40', '2024-06-24 08:39:43'),
(3, 47, 2, 5, '2023-12-07', '2023-12-21', '2024-07-18 06:41:06', '2024-07-18 06:41:06'),
(4, 48, 1, 3, '2024-06-04', '2024-06-06', '2024-07-18 06:43:03', '2024-07-18 06:43:03'),
(5, 42, 1, 1, '2024-06-12', '2024-06-14', '2024-07-27 07:29:59', '2024-07-27 07:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `project_links`
--

CREATE TABLE `project_links` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_links`
--

INSERT INTO `project_links` (`id`, `project_id`, `title`, `link`, `created_at`, `updated_at`) VALUES
(1, 10, 'klj', 'jkl', '2023-12-19 07:15:43', '2023-12-19 07:15:43'),
(2, 10, 'ytg', 'ytf', '2023-12-19 07:15:43', '2023-12-19 07:15:43'),
(3, 10, 'op', 'poi', '2023-12-19 07:15:43', '2023-12-19 07:15:43'),
(10, 4, 'ds', 'ds', '2024-02-15 07:44:05', '2024-02-15 07:44:05'),
(11, 5, 'ds', 'ds', '2024-02-15 07:57:11', '2024-02-15 07:57:11'),
(21, 2, 'Jason', 'Bourne', '2024-06-14 07:36:03', '2024-06-14 07:36:03'),
(22, 2, 'Ka', 'Laka', '2024-06-14 07:36:03', '2024-06-14 07:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(2, 'admin', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18'),
(3, 'manager', 'web', '2023-10-05 01:57:18', '2023-10-05 01:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(1, 2),
(2, 2),
(3, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(35, 2),
(36, 2),
(37, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(55, 2),
(56, 2),
(57, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(32, 3),
(33, 3),
(37, 3),
(52, 3),
(55, 3),
(56, 3),
(57, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `splash_heading` varchar(255) DEFAULT NULL,
  `splash_small_text` varchar(255) DEFAULT NULL,
  `logo_img_path` varchar(255) NOT NULL,
  `splash_img_path` varchar(200) DEFAULT NULL,
  `splash_bg_img_path` varchar(200) DEFAULT NULL,
  `favicon_img_path` varchar(200) DEFAULT NULL,
  `alert_emails` varchar(255) DEFAULT NULL,
  `alert_phone_numbers` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `splash_heading`, `splash_small_text`, `logo_img_path`, `splash_img_path`, `splash_bg_img_path`, `favicon_img_path`, `alert_emails`, `alert_phone_numbers`, `created_at`, `updated_at`) VALUES
(1, 'nazan', 'nazan', '', '', NULL, NULL, NULL, 'jasonbourne501@gmail.com,huzairahmalik@gmail.com', 'ii', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `site` varchar(255) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `site`, `location`, `address`, `address2`, `postcode`, `lat`, `lng`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'TEst', NULL, 'sd', NULL, '23', '32', '32', NULL, '2023-10-09 12:47:46', '2023-10-09 12:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `site_contacts`
--

CREATE TABLE `site_contacts` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_contacts`
--

INSERT INTO `site_contacts` (`id`, `site_id`, `name`, `mobile`, `email`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'sd', 'ds', 'jason@gmal.c', 'sd', '2023-10-09 12:47:46', '2023-10-09 12:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `subcontractors`
--

CREATE TABLE `subcontractors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) NOT NULL,
  `company_number` varchar(255) NOT NULL,
  `gross_status_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcontractors`
--

INSERT INTO `subcontractors` (`id`, `name`, `address1`, `address2`, `postcode`, `company_number`, `gross_status_path`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'test', '32@#F', 'test', 'c7dbed0d0f7dab39a8c685aee1e0043da1589e3c.png', '2023-10-30 01:04:33', '2023-10-30 01:04:33'),
(2, 'sd', 'ds', 'ds', 'dds', 'ds', 'a79dcc68e6b62b3f5a835f89a1fa327fcdf96b87.png', '2023-12-23 07:56:45', '2023-12-23 07:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `subcontractor_contacts`
--

CREATE TABLE `subcontractor_contacts` (
  `id` int(11) NOT NULL,
  `subcontractor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcontractor_contacts`
--

INSERT INTO `subcontractor_contacts` (`id`, `subcontractor_id`, `name`, `email`, `mobile`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', 'test@gmail.com', 'test', 'test', '2023-10-30 01:04:33', '2023-10-30 01:04:33'),
(2, 2, 'ds', 'ds@gmail.com', 'ds', 'sd', '2023-12-23 07:56:45', '2023-12-23 07:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `suboperatives`
--

CREATE TABLE `suboperatives` (
  `id` int(11) NOT NULL,
  `subcontractor_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suboperatives`
--

INSERT INTO `suboperatives` (`id`, `subcontractor_id`, `added_by`, `first_name`, `last_name`, `mobile`, `photo_path`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'jame', 'jkh', '23', 'high-angle-delicious-arrangement-noodles-table-6698f800040fc.jpg', 'sd@gmail.com', 'Inactive', '2023-12-26 01:07:42', '2024-07-26 04:41:11', NULL),
(2, 2, 1, 'saaaa', 'fsd', 'dsf', NULL, 'sdf', 'Active', '2024-06-07 08:19:06', '2024-07-26 04:44:48', NULL),
(3, 1, 1, 'ututu', 'sdf', 'dfs', NULL, 'fsd', 'Inactive', '2024-06-07 08:19:34', '2024-06-07 08:19:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suboperative_documents`
--

CREATE TABLE `suboperative_documents` (
  `id` int(11) NOT NULL,
  `suboperative_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doc_class` int(11) NOT NULL,
  `doc_path` text NOT NULL,
  `batch` varchar(255) NOT NULL,
  `expire_at` date NOT NULL,
  `status` enum('Active','Expiring','Expired','Archived','Critical') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suboperative_documents`
--

INSERT INTO `suboperative_documents` (`id`, `suboperative_id`, `user_id`, `doc_class`, `doc_path`, `batch`, `expire_at`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 120, '441534697-1174089443940296-6771786783738299950-n-66502df5e8197.jpg', 'QjhdKB2xjh', '2024-06-20', 'Critical', '2024-06-12 07:24:21', '2024-06-12 02:24:21', NULL),
(6, 2, 1, 110, 'Screenshot-2024-07-25-at-4-10-43?PM-66a36fe3a18db.png,Screenshot-2024-07-22-at-11-28-30?PM-66a36fe8cb35e.png', '52IbMtBkoH', '2024-11-15', 'Active', '2024-07-26 11:52:09', '2024-07-26 06:52:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_suboperatives`
--

CREATE TABLE `task_suboperatives` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `suboperative_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `subcontractor_id` int(11) NOT NULL,
  `team` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `subcontractor_id`, `team`, `created_at`, `updated_at`) VALUES
(1, 2, 'Team 1', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(2, 2, 'Team 2', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(3, 2, 'Team 3', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(4, 2, 'Team 4', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(5, 2, 'Team 5', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(6, 2, 'Team 6', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(7, 2, 'Team 7', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(8, 2, 'Team 8', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(9, 2, 'Team 9', '2023-12-23 07:56:45', '2023-12-23 07:56:45'),
(10, 2, 'Team 10', '2023-12-23 07:56:45', '2023-12-23 07:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `team_tasks`
--

CREATE TABLE `team_tasks` (
  `id` int(11) NOT NULL,
  `subcontractor_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `team_id` int(11) NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_tasks`
--

INSERT INTO `team_tasks` (`id`, `subcontractor_id`, `project_id`, `team_id`, `task`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, 'sd', '2023-11-06', '2023-12-12', '2023-12-27 01:38:54', '2023-12-27 01:38:54'),
(3, 2, 1, 11, 'sd', '2023-11-06', '2023-12-12', '2023-12-27 01:39:06', '2023-12-27 01:39:06'),
(4, 3, 1, 21, 'Testing aj', '2023-11-09', '2023-12-12', '2023-12-27 01:42:42', '2023-12-28 00:28:11'),
(19, 2, 1, 2, 'sds', '2024-07-18', '2024-08-26', '2024-07-26 04:44:42', '2024-07-26 04:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `batch_id` char(36) NOT NULL,
  `family_hash` varchar(255) DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telescope_entries`
--

INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
(1, '9b60fc36-777d-4e32-87f5-97653f12c4fd', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `tenants` where exists (select * from `domains` where `tenants`.`id` = `domains`.`tenant_id` and `domain` = \'nazan.site-manager.local\') limit 1\",\"time\":\"2.13\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"ef04b2665f9f870bfe4720a86d013766\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(2, '9b60fc36-77c3-4633-bd92-55ac015d421f', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\Tenant\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(3, '9b60fc36-7814-4637-ab52-496dd1cd58d4', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `domains` where `domains`.`tenant_id` in (\'nazan\')\",\"time\":\"0.42\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"7afe50b8430f2cc40011bb87de86546b\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(4, '9b60fc36-7820-4a9d-961e-b48e6714cfab', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"Stancl\\\\Tenancy\\\\Database\\\\Models\\\\Domain\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(5, '9b60fc36-7863-4c88-a75a-02b2b72a6411', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\InitializingTenancy\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":false}}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(6, '9b60fc36-7885-49e9-bc71-30c1ab640176', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\BootstrappingTenancy\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(7, '9b60fc36-78e3-408c-a0c2-66145d300cc8', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = \'tenant-nazan\'\",\"time\":\"0.40\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"3989bea99ea70eac8da2c8ab0a83c7a6\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(8, '9b60fc36-791d-4b42-afd3-fbf55b916160', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\TenancyBootstrapped\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[{\"name\":\"Closure at \\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/app\\/Providers\\/TenancyServiceProvider.php[91:93]\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(9, '9b60fc36-7935-48f5-a642-b9a8302723ee', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\TenancyInitialized\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[{\"name\":\"Stancl\\\\Tenancy\\\\Listeners\\\\BootstrapTenancy@handle\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(10, '9b60fc36-7a8a-4292-8a7a-57c9c42f4b83', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'query', '{\"connection\":\"tenant\",\"bindings\":[],\"sql\":\"select * from `users` where `id` = 1 limit 1\",\"time\":\"1.55\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"082e27d9c4fc4a40315cae2c646c0509\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(11, '9b60fc36-7a9a-4be3-8c0f-43d8b06db5c7', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\User\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 05:55:05'),
(12, '9b60fc36-8235-4e53-bc8a-5fb6c37f47a7', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\DumpingDatabase\",\"payload\":{\"dbDumper\":{\"class\":\"Spatie\\\\DbDumper\\\\Databases\\\\MySql\",\"properties\":[]}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:05'),
(13, '9b60fc36-c9a2-46a3-a958-e22fe58f9d57', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupManifestWasCreated\",\"payload\":{\"manifest\":{\"class\":\"Spatie\\\\Backup\\\\Tasks\\\\Backup\\\\Manifest\",\"properties\":[]}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(14, '9b60fc36-caf2-407d-b55e-144b05078e52', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupZipWasCreated\",\"payload\":{\"pathToZip\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/storage\\/app\\/backup-temp\\/temp\\/2024-02-20-05-55-05.zip\"},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(15, '9b60fc36-ce3b-45dc-b1d2-40b83cc80c60', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"notifications::email\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Notifications\\/resources\\/views\\/email.blade.php\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(16, '9b60fc36-ce60-4af8-9a4c-20e70e8bf3d8', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::message\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/message.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(17, '9b60fc36-ce79-4e76-b565-9c3387f3380e', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::header\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/header.blade.php\",\"data\":[\"url\",\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(18, '9b60fc36-ce90-4e01-8429-fc9edb8b56b2', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::footer\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/footer.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(19, '9b60fc36-cf72-4a56-8b25-c1b21a954773', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::layout\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/layout.blade.php\",\"data\":[\"attributes\",\"slot\",\"header\",\"footer\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(20, '9b60fc36-cff0-402d-b7d6-2543c1faa62f', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::themes.default\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/themes\\/default.css\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(21, '9b60fc36-d186-40c2-bd7c-9e891be2f176', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"notifications::email\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Notifications\\/resources\\/views\\/email.blade.php\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(22, '9b60fc36-d198-4fb4-9d43-29140ec2496b', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::message\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/message.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(23, '9b60fc36-d1ac-489b-8e88-daaaa771fb19', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::header\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/header.blade.php\",\"data\":[\"url\",\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(24, '9b60fc36-d1bc-4dc3-9a9d-f5541de7ed67', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::footer\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/footer.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(25, '9b60fc36-d1c8-4044-95b4-4ec0b561b57f', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'view', '{\"name\":\"mail::layout\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/layout.blade.php\",\"data\":[\"attributes\",\"slot\",\"header\",\"footer\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:06'),
(26, '9b60fc3b-17ba-46a1-82e8-575ff1d8b0c8', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'mail', '{\"mailable\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifications\\\\BackupWasSuccessfulNotification\",\"queued\":false,\"from\":{\"smtpemail913@gmail.com\":\"Site Manager\"},\"replyTo\":[],\"to\":{\"your@example.com\":\"\"},\"cc\":[],\"bcc\":[],\"subject\":\"Successful new backup of Site Manager (local)\",\"html\":\"<!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Transitional\\/\\/EN\\\" \\\"http:\\/\\/www.w3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-transitional.dtd\\\">\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\">\\n<head>\\n<title>Site Manager<\\/title>\\n<meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=UTF-8\\\">\\n<meta name=\\\"color-scheme\\\" content=\\\"light\\\">\\n<meta name=\\\"supported-color-schemes\\\" content=\\\"light\\\">\\n<style>\\n@media only screen and (max-width: 600px) {\\n.inner-body {\\nwidth: 100% !important;\\n}\\n\\n.footer {\\nwidth: 100% !important;\\n}\\n}\\n\\n@media only screen and (max-width: 500px) {\\n.button {\\nwidth: 100% !important;\\n}\\n}\\n<\\/style>\\n<\\/head>\\n<body style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;\\\">\\n\\n<table class=\\\"wrapper\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;\\\">\\n<tr>\\n<td align=\\\"center\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\\\">\\n<table class=\\\"content\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\\\">\\n<tr>\\n<td class=\\\"header\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; padding: 25px 0; text-align: center;\\\">\\n<a href=\\\"http:\\/\\/localhost\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;\\\">\\nSite Manager\\n<\\/a>\\n<\\/td>\\n<\\/tr>\\n\\n<!-- Email Body -->\\n<tr>\\n<td class=\\\"body\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%; border: hidden !important;\\\">\\n<table class=\\\"inner-body\\\" align=\\\"center\\\" width=\\\"570\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\\\">\\n<!-- Body content -->\\n<tr>\\n<td class=\\\"content-cell\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\\\">\\n<h1 style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\\\">Hello!<\\/h1>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Great news, a new backup of Site Manager (local) was successfully created on the disk named local.<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Application name: Site Manager (local)<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Backup name: Site Manager<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Disk: local<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest backup size: 9.42 KB<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Number of backups: 1<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Total storage used: 9.42 KB<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest backup date: 2024\\/02\\/20 05:55:05<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Oldest backup date: 2024\\/02\\/20 05:55:05<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Regards,<br>\\nSite Manager<\\/p>\\n\\n\\n\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n\\n<tr>\\n<td style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\\\">\\n<table class=\\\"footer\\\" align=\\\"center\\\" width=\\\"570\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\\\">\\n<tr>\\n<td class=\\\"content-cell\\\" align=\\\"center\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\\\">\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\\\">\\u00a9 2024 Site Manager. All rights reserved.<\\/p>\\n\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/body>\\n<\\/html>\",\"raw\":\"From: Site Manager <smtpemail913@gmail.com>\\r\\nTo: your@example.com\\r\\nSubject: Successful new backup of Site Manager (local)\\r\\nMIME-Version: 1.0\\r\\nDate: Tue, 20 Feb 2024 05:55:08 +0000\\r\\nMessage-ID: <96b52d8d4c998eabf662f8a7313282a7@gmail.com>\\r\\nContent-Type: multipart\\/alternative; boundary=aJxGZYCN\\r\\n\\r\\n--aJxGZYCN\\r\\nContent-Type: text\\/plain; charset=utf-8\\r\\nContent-Transfer-Encoding: quoted-printable\\r\\n\\r\\n[Site Manager](http:\\/\\/localhost)\\r\\n\\r\\n# Hello!\\r\\n\\r\\nGreat news, a new backu=\\r\\np of Site Manager (local) was successfully created on the disk named local.=\\r\\n\\r\\n\\r\\nApplication name: Site Manager (local)\\r\\n\\r\\nBackup name: Site Manager=\\r\\n\\r\\n\\r\\nDisk: local\\r\\n\\r\\nNewest backup size: 9.42 KB\\r\\n\\r\\nNumber of backups: =\\r\\n1\\r\\n\\r\\nTotal storage used: 9.42 KB\\r\\n\\r\\nNewest backup date: 2024\\/02\\/20 05:5=\\r\\n5:05\\r\\n\\r\\nOldest backup date: 2024\\/02\\/20 05:55:05\\r\\n\\r\\nRegards,\\r\\nSite Mana=\\r\\nger\\r\\n\\r\\n=C2=A9 2024 Site Manager. All rights reserved.\\r\\n\\r\\n--aJxGZYCN\\r\\nContent-Type: text\\/html; charset=utf-8\\r\\nContent-Transfer-Encoding: quoted-printable\\r\\n\\r\\n<!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Transitional\\/\\/EN\\\" \\\"http:\\/\\/www.=\\r\\nw3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-transitional.dtd\\\">\\r\\n<html xmlns=3D\\\"http:\\/\\/www.=\\r\\nw3.org\\/1999\\/xhtml\\\">\\r\\n<head>\\r\\n<title>Site Manager<\\/title>\\r\\n<meta name=3D\\\"=\\r\\nviewport\\\" content=3D\\\"width=3Ddevice-width, initial-scale=3D1.0\\\">\\r\\n<meta ht=\\r\\ntp-equiv=3D\\\"Content-Type\\\" content=3D\\\"text\\/html; charset=3DUTF-8\\\">\\r\\n<meta n=\\r\\name=3D\\\"color-scheme\\\" content=3D\\\"light\\\">\\r\\n<meta name=3D\\\"supported-color-sch=\\r\\nemes\\\" content=3D\\\"light\\\">\\r\\n<style>\\r\\n@media only screen and (max-width: 600=\\r\\npx) {\\r\\n.inner-body {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n\\r\\n.footer {\\r\\nwidth:=\\r\\n 100% !important;\\r\\n}\\r\\n}\\r\\n\\r\\n@media only screen and (max-width: 500px) {=\\r\\n\\r\\n.button {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n}\\r\\n<\\/style>\\r\\n<\\/head>\\r\\n<body=\\r\\n style=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyste=\\r\\nmFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji=\\r\\n\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-text-si=\\r\\nze-adjust: none; background-color: #ffffff; color: #718096; height: 100%; l=\\r\\nine-height: 1.4; margin: 0; padding: 0; width: 100% !important;\\\">\\r\\n\\r\\n<tab=\\r\\nle class=3D\\\"wrapper\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" rol=\\r\\ne=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-sys=\\r\\ntem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, =\\r\\n\'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relativ=\\r\\ne; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: =\\r\\n100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;\\\">\\r\\n<t=\\r\\nr>\\r\\n<td align=3D\\\"center\\\" style=3D\\\"box-sizing: border-box; font-family: -ap=\\r\\nple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-=\\r\\nserif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: =\\r\\nrelative;\\\">\\r\\n<table class=3D\\\"content\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cel=\\r\\nlspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-=\\r\\nfamily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, A=\\r\\nrial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\';=\\r\\n position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; =\\r\\n-premailer-width: 100%; margin: 0; padding: 0; width: 100%;\\\">\\r\\n<tr>\\r\\n<td =\\r\\nclass=3D\\\"header\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-syste=\\r\\nm, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'A=\\r\\npple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;=\\r\\n padding: 25px 0; text-align: center;\\\">\\r\\n<a href=3D\\\"http:\\/\\/localhost\\\" styl=\\r\\ne=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont=\\r\\n, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'S=\\r\\negoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font=\\r\\n-size: 19px; font-weight: bold; text-decoration: none; display: inline-bloc=\\r\\nk;\\\">\\r\\nSite Manager\\r\\n<\\/a>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n\\r\\n<!-- Email Body -->\\r\\n<tr>=\\r\\n\\r\\n<td class=3D\\\"body\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" st=\\r\\nyle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\\r\\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\\r\\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpad=\\r\\nding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-colo=\\r\\nr: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7=\\r\\n; margin: 0; padding: 0; width: 100%; border: hidden !important;\\\">\\r\\n<table=\\r\\n class=3D\\\"inner-body\\\" align=3D\\\"center\\\" width=3D\\\"570\\\" cellpadding=3D\\\"0\\\" cell=\\r\\nspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-f=\\r\\namily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ar=\\r\\nial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; =\\r\\nposition: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -=\\r\\npremailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; b=\\r\\norder-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0=\\r\\n.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width:=\\r\\n 570px;\\\">\\r\\n<!-- Body content -->\\r\\n<tr>\\r\\n<td class=3D\\\"content-cell\\\" style=\\r\\n=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\\r\\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\\r\\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; pad=\\r\\nding: 32px;\\\">\\r\\n<h1 style=3D\\\"box-sizing: border-box; font-family: -apple-sy=\\r\\nstem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif,=\\r\\n \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relati=\\r\\nve; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text=\\r\\n-align: left;\\\">Hello!<\\/h1>\\r\\n<p style=3D\\\"box-sizing: border-box; font-famil=\\r\\ny: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial,=\\r\\n sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posi=\\r\\ntion: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-al=\\r\\nign: left;\\\">Great news, a new backup of Site Manager (local) was successful=\\r\\nly created on the disk named local.<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-bo=\\r\\nx; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helv=\\r\\netica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI =\\r\\nSymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-to=\\r\\np: 0; text-align: left;\\\">Application name: Site Manager (local)<\\/p>\\r\\n<p st=\\r\\nyle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\\r\\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\\r\\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; l=\\r\\nine-height: 1.5em; margin-top: 0; text-align: left;\\\">Backup name: Site Mana=\\r\\nger<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, B=\\r\\nlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple=\\r\\n Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; fon=\\r\\nt-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Disk: l=\\r\\nocal<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, =\\r\\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\\r\\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; fo=\\r\\nnt-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest=\\r\\n backup size: 9.42 KB<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family=\\r\\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\\r\\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\\r\\nion: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-ali=\\r\\ngn: left;\\\">Number of backups: 1<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; f=\\r\\nont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetic=\\r\\na, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symb=\\r\\nol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0=\\r\\n; text-align: left;\\\">Total storage used: 9.42 KB<\\/p>\\r\\n<p style=3D\\\"box-sizi=\\r\\nng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\',=\\r\\n Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji=\\r\\n\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5=\\r\\nem; margin-top: 0; text-align: left;\\\">Newest backup date: 2024\\/02\\/20 05:55:=\\r\\n05<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, Bl=\\r\\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\\r\\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font=\\r\\n-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Oldest b=\\r\\nackup date: 2024\\/02\\/20 05:55:05<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; f=\\r\\nont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetic=\\r\\na, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symb=\\r\\nol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0=\\r\\n; text-align: left;\\\">Regards,<br>\\r\\nSite Manager<\\/p>\\r\\n\\r\\n\\r\\n\\r\\n<\\/td>\\r\\n<\\/t=\\r\\nr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n\\r\\n<tr>\\r\\n<td style=3D\\\"box-sizing: border-b=\\r\\nox; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Hel=\\r\\nvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI=\\r\\n Symbol\'; position: relative;\\\">\\r\\n<table class=3D\\\"footer\\\" align=3D\\\"center\\\" =\\r\\nwidth=3D\\\"570\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" sty=\\r\\nle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\\r\\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\\r\\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadd=\\r\\ning: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto;=\\r\\n padding: 0; text-align: center; width: 570px;\\\">\\r\\n<tr>\\r\\n<td class=3D\\\"cont=\\r\\nent-cell\\\" align=3D\\\"center\\\" style=3D\\\"box-sizing: border-box; font-family: -a=\\r\\npple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans=\\r\\n-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position:=\\r\\n relative; max-width: 100vw; padding: 32px;\\\">\\r\\n<p style=3D\\\"box-sizing: bor=\\r\\nder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto=\\r\\n, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Seg=\\r\\noe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: 0; color=\\r\\n: #b0adc5; font-size: 12px; text-align: center;\\\">=C2=A9 2024 Site Manager. =\\r\\nAll rights reserved.<\\/p>\\r\\n\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/=\\r\\ntable>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/body>\\r\\n<\\/html>\\r\\n--aJxGZYCN--\\r\\n\",\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:08'),
(27, '9b60fc3b-1804-4f17-92a1-1a3fabd54dbb', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'notification', '{\"notification\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifications\\\\BackupWasSuccessfulNotification\",\"queued\":false,\"notifiable\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifiable\",\"channel\":\"mail\",\"response\":{},\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:08'),
(28, '9b60fc3b-1834-4ad3-8b3f-bea4040734ca', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupWasSuccessful\",\"payload\":{\"backupDestination\":{\"class\":\"Spatie\\\\Backup\\\\BackupDestination\\\\BackupDestination\",\"properties\":{\"connectionError\":null}}},\"listeners\":[{\"name\":\"Closure at \\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/vendor\\/spatie\\/laravel-backup\\/src\\/Notifications\\/EventHandler.php[25:31]\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:08'),
(29, '9b60fc3b-1b55-420a-a771-94c438d8e986', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'command', '{\"command\":\"backup:run\",\"exit_code\":0,\"arguments\":{\"command\":\"backup:run\",\"0\":\"backup:run\"},\"options\":{\"filename\":null,\"only-db\":true,\"db-name\":[],\"only-files\":false,\"only-to-disk\":null,\"disable-notifications\":false,\"timeout\":null,\"tries\":null,\"isolated\":false,\"help\":false,\"quiet\":false,\"verbose\":false,\"version\":false,\"ansi\":null,\"no-interaction\":false,\"env\":null},\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:08'),
(30, '9b60fc3b-1ccd-477c-a86b-8f9b81e1edea', '9b60fc3b-1d7a-47b4-a575-c9dd0271e93a', NULL, 1, 'request', '{\"ip_address\":\"127.0.0.1\",\"uri\":\"\\/admin\\/backup\",\"method\":\"GET\",\"controller_action\":\"App\\\\Http\\\\Controllers\\\\Backend\\\\BackupController@backup\",\"middleware\":[\"web\",\"Stancl\\\\Tenancy\\\\Middleware\\\\InitializeTenancyByDomain\",\"Stancl\\\\Tenancy\\\\Middleware\\\\PreventAccessFromCentralDomains\",\"auth\"],\"headers\":{\"host\":\"nazan.site-manager.local\",\"connection\":\"keep-alive\",\"cache-control\":\"max-age=0\",\"upgrade-insecure-requests\":\"1\",\"user-agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\",\"accept-encoding\":\"gzip, deflate\",\"accept-language\":\"en-GB,en-US;q=0.9,en;q=0.8\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6IjFuc2pyVzFUeDVUcDMwWENrQmhVa1E9PSIsInZhbHVlIjoiZW9zeVUwY25kOU9sUWtMYnA3a0ZrRW95aEpRelQwUGpRNkdaOUVSa3VXNkNEVSs3TGd5YithRXR0MVcxMmNWWnRzS09qTkZqVTdRek5EWk1EbXVzUkZTYStYbFJiRDRsSzg0a3NNbG16eDVlMm5HMWw0Y0dpSjA4eW1iUnR3MGoiLCJtYWMiOiI1NGY1NDEwNDk4YzQzNGNhMGNhZDM5ZGEyOWM0NTEwYjc3MDMwNzAxMDRjNDFmMzAxMzRjMjMzNTM5M2JjMWIxIiwidGFnIjoiIn0%3D; site_manager_session=eyJpdiI6IklVOXc0anBtOVpMUllTb3hMQXdlYUE9PSIsInZhbHVlIjoiQ2NjQjFvOTJ2UmhHQUJCcGs3clkyVUlETXJ0ZVN2T1RPcWxvdzJLcEN6ZmxXL1c3NUVmWDk1cCtGbmRrYjY0aDRZdTYxSU1GaHg5SW1Xenp4Y1p4RnkvS2g1SzQ5cjZsQkVnOTRLaXd6MTg2aG5OVmg2QTdjYjhBL09UV1loWGciLCJtYWMiOiI1NGQ3ZDBlOTI1ZGEzYTdkOWQ5MGY0OGY2ZTA2Y2UwNzc4ZTEzN2Q1YThkMDk3YTBlOTU3NWYxNDcyYmM5YmVlIiwidGFnIjoiIn0%3D\"},\"payload\":[],\"session\":{\"_token\":\"90ZN0MhDN3GDXYDHR6Pl8tfbbGPu78gdkELNnW5O\",\"_previous\":{\"url\":\"http:\\/\\/nazan.site-manager.local\\/admin\\/backup\"},\"_flash\":{\"old\":[],\"new\":[]},\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1},\"response_status\":200,\"response\":\"Empty Response\",\"duration\":3082,\"memory\":6,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 05:55:08'),
(31, '9b610009-a9b6-4d9d-b252-f7367f725423', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `tenants` where exists (select * from `domains` where `tenants`.`id` = `domains`.`tenant_id` and `domain` = \'nazan.site-manager.local\') limit 1\",\"time\":\"2.36\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"ef04b2665f9f870bfe4720a86d013766\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(32, '9b610009-a9ec-4854-93fd-7499332192c2', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\Tenant\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(33, '9b610009-aa41-4c3b-aff7-3e8bf83962e1', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `domains` where `domains`.`tenant_id` in (\'nazan\')\",\"time\":\"0.44\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"7afe50b8430f2cc40011bb87de86546b\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(34, '9b610009-aa4e-4186-b140-a4db60604c26', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"Stancl\\\\Tenancy\\\\Database\\\\Models\\\\Domain\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(35, '9b610009-aaa7-443e-8cba-b2aedda569e5', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\InitializingTenancy\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":false}}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(36, '9b610009-aac9-47c5-86e0-2faa57b644e6', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\BootstrappingTenancy\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(37, '9b610009-ab29-4a68-94f7-2a91601bdd9e', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = \'tenant-nazan\'\",\"time\":\"0.51\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"3989bea99ea70eac8da2c8ab0a83c7a6\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(38, '9b610009-ab67-4fe1-bbf1-fe0f171af321', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\TenancyBootstrapped\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[{\"name\":\"Closure at \\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/app\\/Providers\\/TenancyServiceProvider.php[91:93]\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(39, '9b610009-ab80-47e0-8f20-e19249d44cf1', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\TenancyInitialized\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[{\"name\":\"Stancl\\\\Tenancy\\\\Listeners\\\\BootstrapTenancy@handle\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(40, '9b610009-ae0a-4efe-b511-6a0b77dfa7f2', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'query', '{\"connection\":\"tenant\",\"bindings\":[],\"sql\":\"select * from `users` where `id` = 1 limit 1\",\"time\":\"1.23\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"082e27d9c4fc4a40315cae2c646c0509\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(41, '9b610009-ae16-4b02-93d0-665c43987ac1', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\User\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:05:47'),
(42, '9b610009-b621-4ade-bb84-6b6a54be8d94', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\DumpingDatabase\",\"payload\":{\"dbDumper\":{\"class\":\"Spatie\\\\DbDumper\\\\Databases\\\\MySql\",\"properties\":[]}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:47'),
(43, '9b61000a-aead-44c1-94ae-6b1e74af8bbb', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupManifestWasCreated\",\"payload\":{\"manifest\":{\"class\":\"Spatie\\\\Backup\\\\Tasks\\\\Backup\\\\Manifest\",\"properties\":[]}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:48'),
(44, '9b610014-2de3-49c1-a6f9-3798ac6663e9', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupZipWasCreated\",\"payload\":{\"pathToZip\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/storage\\/app\\/backup-temp\\/temp\\/2024-02-20-06-05-47.zip\"},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:54'),
(45, '9b610015-aef8-440c-b746-5c8fc985c817', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"notifications::email\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Notifications\\/resources\\/views\\/email.blade.php\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(46, '9b610015-af96-43c9-bf6b-aa5d47e8c049', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::message\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/message.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(47, '9b610015-afa5-4909-84ad-704ea3903ca1', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::header\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/header.blade.php\",\"data\":[\"url\",\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(48, '9b610015-afb3-46c3-a07e-a805d2f0bee4', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::footer\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/footer.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55');
INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
(49, '9b610015-b05b-46c9-af7f-022bd52df4fc', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::layout\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/layout.blade.php\",\"data\":[\"attributes\",\"slot\",\"header\",\"footer\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(50, '9b610015-b0ab-4ff1-b18d-01f131d89020', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::themes.default\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/themes\\/default.css\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(51, '9b610015-b3ed-4e30-b995-91894108ce5a', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"notifications::email\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Notifications\\/resources\\/views\\/email.blade.php\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(52, '9b610015-b3f7-4f51-aaa6-47fafb89dd36', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::message\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/message.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(53, '9b610015-b402-44f6-a6ea-21c8653ea0e7', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::header\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/header.blade.php\",\"data\":[\"url\",\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(54, '9b610015-b40a-40d7-9879-d972fa546774', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::footer\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/footer.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(55, '9b610015-b410-438f-95d0-ea71ddf2597f', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'view', '{\"name\":\"mail::layout\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/layout.blade.php\",\"data\":[\"attributes\",\"slot\",\"header\",\"footer\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:55'),
(56, '9b610019-db50-4fcb-8a4a-4ce728ead4c3', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'mail', '{\"mailable\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifications\\\\BackupWasSuccessfulNotification\",\"queued\":false,\"from\":{\"smtpemail913@gmail.com\":\"Site Manager\"},\"replyTo\":[],\"to\":{\"your@example.com\":\"\"},\"cc\":[],\"bcc\":[],\"subject\":\"Successful new backup of Site Manager (local)\",\"html\":\"<!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Transitional\\/\\/EN\\\" \\\"http:\\/\\/www.w3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-transitional.dtd\\\">\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\">\\n<head>\\n<title>Site Manager<\\/title>\\n<meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=UTF-8\\\">\\n<meta name=\\\"color-scheme\\\" content=\\\"light\\\">\\n<meta name=\\\"supported-color-schemes\\\" content=\\\"light\\\">\\n<style>\\n@media only screen and (max-width: 600px) {\\n.inner-body {\\nwidth: 100% !important;\\n}\\n\\n.footer {\\nwidth: 100% !important;\\n}\\n}\\n\\n@media only screen and (max-width: 500px) {\\n.button {\\nwidth: 100% !important;\\n}\\n}\\n<\\/style>\\n<\\/head>\\n<body style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;\\\">\\n\\n<table class=\\\"wrapper\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;\\\">\\n<tr>\\n<td align=\\\"center\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\\\">\\n<table class=\\\"content\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\\\">\\n<tr>\\n<td class=\\\"header\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; padding: 25px 0; text-align: center;\\\">\\n<a href=\\\"http:\\/\\/localhost\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;\\\">\\nSite Manager\\n<\\/a>\\n<\\/td>\\n<\\/tr>\\n\\n<!-- Email Body -->\\n<tr>\\n<td class=\\\"body\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%; border: hidden !important;\\\">\\n<table class=\\\"inner-body\\\" align=\\\"center\\\" width=\\\"570\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\\\">\\n<!-- Body content -->\\n<tr>\\n<td class=\\\"content-cell\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\\\">\\n<h1 style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\\\">Hello!<\\/h1>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Great news, a new backup of Site Manager (local) was successfully created on the disk named local.<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Application name: Site Manager (local)<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Backup name: Site Manager<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Disk: local<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest backup size: 257.55 MB<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Number of backups: 1<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Total storage used: 257.55 MB<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest backup date: 2024\\/02\\/20 06:05:47<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Oldest backup date: 2024\\/02\\/20 06:05:47<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Regards,<br>\\nSite Manager<\\/p>\\n\\n\\n\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n\\n<tr>\\n<td style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\\\">\\n<table class=\\\"footer\\\" align=\\\"center\\\" width=\\\"570\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\\\">\\n<tr>\\n<td class=\\\"content-cell\\\" align=\\\"center\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\\\">\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\\\">\\u00a9 2024 Site Manager. All rights reserved.<\\/p>\\n\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/body>\\n<\\/html>\",\"raw\":\"From: Site Manager <smtpemail913@gmail.com>\\r\\nTo: your@example.com\\r\\nSubject: Successful new backup of Site Manager (local)\\r\\nMIME-Version: 1.0\\r\\nDate: Tue, 20 Feb 2024 06:05:58 +0000\\r\\nMessage-ID: <a1995afdf1b3446f8be5bd62fb84d72d@gmail.com>\\r\\nContent-Type: multipart\\/alternative; boundary=gcHgnssh\\r\\n\\r\\n--gcHgnssh\\r\\nContent-Type: text\\/plain; charset=utf-8\\r\\nContent-Transfer-Encoding: quoted-printable\\r\\n\\r\\n[Site Manager](http:\\/\\/localhost)\\r\\n\\r\\n# Hello!\\r\\n\\r\\nGreat news, a new backu=\\r\\np of Site Manager (local) was successfully created on the disk named local.=\\r\\n\\r\\n\\r\\nApplication name: Site Manager (local)\\r\\n\\r\\nBackup name: Site Manager=\\r\\n\\r\\n\\r\\nDisk: local\\r\\n\\r\\nNewest backup size: 257.55 MB\\r\\n\\r\\nNumber of backups=\\r\\n: 1\\r\\n\\r\\nTotal storage used: 257.55 MB\\r\\n\\r\\nNewest backup date: 2024\\/02\\/20 =\\r\\n06:05:47\\r\\n\\r\\nOldest backup date: 2024\\/02\\/20 06:05:47\\r\\n\\r\\nRegards,\\r\\nSite =\\r\\nManager\\r\\n\\r\\n=C2=A9 2024 Site Manager. All rights reserved.\\r\\n\\r\\n--gcHgnssh\\r\\nContent-Type: text\\/html; charset=utf-8\\r\\nContent-Transfer-Encoding: quoted-printable\\r\\n\\r\\n<!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Transitional\\/\\/EN\\\" \\\"http:\\/\\/www.=\\r\\nw3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-transitional.dtd\\\">\\r\\n<html xmlns=3D\\\"http:\\/\\/www.=\\r\\nw3.org\\/1999\\/xhtml\\\">\\r\\n<head>\\r\\n<title>Site Manager<\\/title>\\r\\n<meta name=3D\\\"=\\r\\nviewport\\\" content=3D\\\"width=3Ddevice-width, initial-scale=3D1.0\\\">\\r\\n<meta ht=\\r\\ntp-equiv=3D\\\"Content-Type\\\" content=3D\\\"text\\/html; charset=3DUTF-8\\\">\\r\\n<meta n=\\r\\name=3D\\\"color-scheme\\\" content=3D\\\"light\\\">\\r\\n<meta name=3D\\\"supported-color-sch=\\r\\nemes\\\" content=3D\\\"light\\\">\\r\\n<style>\\r\\n@media only screen and (max-width: 600=\\r\\npx) {\\r\\n.inner-body {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n\\r\\n.footer {\\r\\nwidth:=\\r\\n 100% !important;\\r\\n}\\r\\n}\\r\\n\\r\\n@media only screen and (max-width: 500px) {=\\r\\n\\r\\n.button {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n}\\r\\n<\\/style>\\r\\n<\\/head>\\r\\n<body=\\r\\n style=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyste=\\r\\nmFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji=\\r\\n\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-text-si=\\r\\nze-adjust: none; background-color: #ffffff; color: #718096; height: 100%; l=\\r\\nine-height: 1.4; margin: 0; padding: 0; width: 100% !important;\\\">\\r\\n\\r\\n<tab=\\r\\nle class=3D\\\"wrapper\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" rol=\\r\\ne=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-sys=\\r\\ntem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, =\\r\\n\'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relativ=\\r\\ne; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: =\\r\\n100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;\\\">\\r\\n<t=\\r\\nr>\\r\\n<td align=3D\\\"center\\\" style=3D\\\"box-sizing: border-box; font-family: -ap=\\r\\nple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-=\\r\\nserif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: =\\r\\nrelative;\\\">\\r\\n<table class=3D\\\"content\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cel=\\r\\nlspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-=\\r\\nfamily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, A=\\r\\nrial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\';=\\r\\n position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; =\\r\\n-premailer-width: 100%; margin: 0; padding: 0; width: 100%;\\\">\\r\\n<tr>\\r\\n<td =\\r\\nclass=3D\\\"header\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-syste=\\r\\nm, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'A=\\r\\npple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;=\\r\\n padding: 25px 0; text-align: center;\\\">\\r\\n<a href=3D\\\"http:\\/\\/localhost\\\" styl=\\r\\ne=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont=\\r\\n, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'S=\\r\\negoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font=\\r\\n-size: 19px; font-weight: bold; text-decoration: none; display: inline-bloc=\\r\\nk;\\\">\\r\\nSite Manager\\r\\n<\\/a>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n\\r\\n<!-- Email Body -->\\r\\n<tr>=\\r\\n\\r\\n<td class=3D\\\"body\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" st=\\r\\nyle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\\r\\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\\r\\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpad=\\r\\nding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-colo=\\r\\nr: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7=\\r\\n; margin: 0; padding: 0; width: 100%; border: hidden !important;\\\">\\r\\n<table=\\r\\n class=3D\\\"inner-body\\\" align=3D\\\"center\\\" width=3D\\\"570\\\" cellpadding=3D\\\"0\\\" cell=\\r\\nspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-f=\\r\\namily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ar=\\r\\nial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; =\\r\\nposition: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -=\\r\\npremailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; b=\\r\\norder-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0=\\r\\n.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width:=\\r\\n 570px;\\\">\\r\\n<!-- Body content -->\\r\\n<tr>\\r\\n<td class=3D\\\"content-cell\\\" style=\\r\\n=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\\r\\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\\r\\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; pad=\\r\\nding: 32px;\\\">\\r\\n<h1 style=3D\\\"box-sizing: border-box; font-family: -apple-sy=\\r\\nstem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif,=\\r\\n \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relati=\\r\\nve; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text=\\r\\n-align: left;\\\">Hello!<\\/h1>\\r\\n<p style=3D\\\"box-sizing: border-box; font-famil=\\r\\ny: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial,=\\r\\n sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posi=\\r\\ntion: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-al=\\r\\nign: left;\\\">Great news, a new backup of Site Manager (local) was successful=\\r\\nly created on the disk named local.<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-bo=\\r\\nx; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helv=\\r\\netica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI =\\r\\nSymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-to=\\r\\np: 0; text-align: left;\\\">Application name: Site Manager (local)<\\/p>\\r\\n<p st=\\r\\nyle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\\r\\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\\r\\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; l=\\r\\nine-height: 1.5em; margin-top: 0; text-align: left;\\\">Backup name: Site Mana=\\r\\nger<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, B=\\r\\nlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple=\\r\\n Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; fon=\\r\\nt-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Disk: l=\\r\\nocal<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, =\\r\\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\\r\\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; fo=\\r\\nnt-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest=\\r\\n backup size: 257.55 MB<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-fami=\\r\\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\\r\\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\\r\\nition: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-a=\\r\\nlign: left;\\\">Number of backups: 1<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box;=\\r\\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\\r\\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\\r\\nmbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top:=\\r\\n 0; text-align: left;\\\">Total storage used: 257.55 MB<\\/p>\\r\\n<p style=3D\\\"box-=\\r\\nsizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe =\\r\\nUI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI E=\\r\\nmoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height:=\\r\\n 1.5em; margin-top: 0; text-align: left;\\\">Newest backup date: 2024\\/02\\/20 06=\\r\\n:05:47<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system=\\r\\n, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Ap=\\r\\nple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; =\\r\\nfont-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Olde=\\r\\nst backup date: 2024\\/02\\/20 06:05:47<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-bo=\\r\\nx; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helv=\\r\\netica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI =\\r\\nSymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-to=\\r\\np: 0; text-align: left;\\\">Regards,<br>\\r\\nSite Manager<\\/p>\\r\\n\\r\\n\\r\\n\\r\\n<\\/td>=\\r\\n\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n\\r\\n<tr>\\r\\n<td style=3D\\\"box-sizing: bo=\\r\\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\\r\\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\\r\\ngoe UI Symbol\'; position: relative;\\\">\\r\\n<table class=3D\\\"footer\\\" align=3D\\\"ce=\\r\\nnter\\\" width=3D\\\"570\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" role=3D\\\"presentatio=\\r\\nn\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSys=\\r\\ntemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emo=\\r\\nji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-ce=\\r\\nllpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0=\\r\\n auto; padding: 0; text-align: center; width: 570px;\\\">\\r\\n<tr>\\r\\n<td class=\\r\\n=3D\\\"content-cell\\\" align=3D\\\"center\\\" style=3D\\\"box-sizing: border-box; font-fa=\\r\\nmily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ari=\\r\\nal, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; p=\\r\\nosition: relative; max-width: 100vw; padding: 32px;\\\">\\r\\n<p style=3D\\\"box-siz=\\r\\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\\r\\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\\r\\ni\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: =\\r\\n0; color: #b0adc5; font-size: 12px; text-align: center;\\\">=C2=A9 2024 Site M=\\r\\nanager. All rights reserved.<\\/p>\\r\\n\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/=\\r\\ntr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/body>\\r\\n<\\/html>\\r\\n--gcHgnssh--\\r\\n\",\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:58'),
(57, '9b610019-db9a-4aca-89e6-49d8eca7d146', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'notification', '{\"notification\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifications\\\\BackupWasSuccessfulNotification\",\"queued\":false,\"notifiable\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifiable\",\"channel\":\"mail\",\"response\":{},\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:58'),
(58, '9b610019-dbcd-42dc-8bba-36b4ec1a7112', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupWasSuccessful\",\"payload\":{\"backupDestination\":{\"class\":\"Spatie\\\\Backup\\\\BackupDestination\\\\BackupDestination\",\"properties\":{\"connectionError\":null}}},\"listeners\":[{\"name\":\"Closure at \\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/vendor\\/spatie\\/laravel-backup\\/src\\/Notifications\\/EventHandler.php[25:31]\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:58'),
(59, '9b610019-eaa9-4764-a731-1e6b2b7aec86', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'command', '{\"command\":\"backup:run\",\"exit_code\":0,\"arguments\":{\"command\":\"backup:run\"},\"options\":{\"filename\":null,\"only-db\":false,\"db-name\":[],\"only-files\":false,\"only-to-disk\":null,\"disable-notifications\":false,\"timeout\":null,\"tries\":null,\"isolated\":false,\"help\":false,\"quiet\":false,\"verbose\":false,\"version\":false,\"ansi\":null,\"no-interaction\":false,\"env\":null},\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:58'),
(60, '9b610019-eb5e-4a6d-8d1f-44569f109c71', '9b610019-ebb4-4bf0-9fe3-5edf38ceeada', NULL, 1, 'request', '{\"ip_address\":\"127.0.0.1\",\"uri\":\"\\/admin\\/backup\",\"method\":\"GET\",\"controller_action\":\"App\\\\Http\\\\Controllers\\\\Backend\\\\BackupController@backup\",\"middleware\":[\"web\",\"Stancl\\\\Tenancy\\\\Middleware\\\\InitializeTenancyByDomain\",\"Stancl\\\\Tenancy\\\\Middleware\\\\PreventAccessFromCentralDomains\",\"auth\"],\"headers\":{\"host\":\"nazan.site-manager.local\",\"connection\":\"keep-alive\",\"cache-control\":\"max-age=0\",\"upgrade-insecure-requests\":\"1\",\"user-agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\",\"accept-encoding\":\"gzip, deflate\",\"accept-language\":\"en-GB,en-US;q=0.9,en;q=0.8\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6IitCVkNadkVnVkh4OEcrdndiU09GVHc9PSIsInZhbHVlIjoiYkxkM3ZZZDNVbEZaVTR1TkZsTWo1c2VJNjJmT1gwMDFQR0tUWEEzMlZwMHE2b0NDbk4wRldGcVJNdUJhTCtBZVhGZEZ0bVdydElHLzl4aFlNQy83YVhsQ2lQQXFGYnQrUmRsMEhWQVJiV2JxK1NFdnRDZ1RBS0UrS1ZpWVNpMHEiLCJtYWMiOiJlMzRkOTdkMWFmZDU4NzUyMWQwM2Y5OTAwNjEzNmY4ZjIxMDk3NTZlOTVjZTRjYTUzNzQ1MDNmYjZhNWRjOTc5IiwidGFnIjoiIn0%3D; site_manager_session=eyJpdiI6InlpZHF0VEE3T1dvWnlTQWhneWNDeEE9PSIsInZhbHVlIjoiL0E2YWNUcGV3emRJbkNSSHhNS3VRdkNSdUY3YndDZmhGMU1iTmo5bW5ncnZBblFHNHRvYlZFQ2pJWE90cVZjQUZIRnh3SmJnSmlMM3haMkc3azVWRGVLM3BBcmhWNWozWnNlaVJFNm9MaExlMUxOQUJVVHFnZnR0a2lvei9GRGUiLCJtYWMiOiI0MTdiNjk0NjNlMDY4MmNiNWFjOTdkMjQxNTU5Njk0OTY4ZmVmODNlMjViNmIwMTU5NWJlOWUxOWQ1YTYzNTRjIiwidGFnIjoiIn0%3D\"},\"payload\":[],\"session\":{\"_token\":\"90ZN0MhDN3GDXYDHR6Pl8tfbbGPu78gdkELNnW5O\",\"_previous\":{\"url\":\"http:\\/\\/nazan.site-manager.local\\/admin\\/backup\"},\"_flash\":{\"old\":[],\"new\":[]},\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1},\"response_status\":200,\"response\":\"Empty Response\",\"duration\":10694,\"memory\":6,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:05:58'),
(61, '9b61007a-0de2-4505-89bb-6ffa7d64d149', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `tenants` where exists (select * from `domains` where `tenants`.`id` = `domains`.`tenant_id` and `domain` = \'nazan.site-manager.local\') limit 1\",\"time\":\"16.10\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"ef04b2665f9f870bfe4720a86d013766\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(62, '9b61007a-0e1f-4eea-9421-2de9cf53c91b', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\Tenant\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(63, '9b61007a-0e99-4bf7-83d8-2c976dbe43a3', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `domains` where `domains`.`tenant_id` in (\'nazan\')\",\"time\":\"0.74\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"7afe50b8430f2cc40011bb87de86546b\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(64, '9b61007a-0ea7-4660-822f-04b20da99a8d', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"Stancl\\\\Tenancy\\\\Database\\\\Models\\\\Domain\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(65, '9b61007a-0f02-4723-a6ed-755169a02de9', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\InitializingTenancy\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":false}}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(66, '9b61007a-0f24-4ed5-866c-14819e803544', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\BootstrappingTenancy\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(67, '9b61007a-0fc0-4d85-b547-645beb19218e', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = \'tenant-nazan\'\",\"time\":\"1.07\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"3989bea99ea70eac8da2c8ab0a83c7a6\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(68, '9b61007a-1004-4e47-ba3e-7d1fce8a99e9', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\TenancyBootstrapped\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[{\"name\":\"Closure at \\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/app\\/Providers\\/TenancyServiceProvider.php[91:93]\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(69, '9b61007a-101d-45e6-b62c-ec72aa5b2d79', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Stancl\\\\Tenancy\\\\Events\\\\TenancyInitialized\",\"payload\":{\"tenancy\":{\"class\":\"Stancl\\\\Tenancy\\\\Tenancy\",\"properties\":{\"tenant\":{\"id\":\"nazan\",\"status\":\"Active\",\"created_at\":\"2023-10-05T06:57:17.000000Z\",\"updated_at\":\"2023-10-05T06:57:17.000000Z\",\"data\":null,\"tenancy_db_name\":\"tenant-nazan\",\"domains\":[{\"id\":28,\"domain\":\"nazan.site-manager.local\",\"tenant_id\":\"nazan\",\"created_at\":\"2023-10-05T06:57:18.000000Z\",\"updated_at\":\"2023-10-05T06:57:18.000000Z\"}]},\"getBootstrappersUsing\":null,\"initialized\":true}}},\"listeners\":[{\"name\":\"Stancl\\\\Tenancy\\\\Listeners\\\\BootstrapTenancy@handle\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(70, '9b61007a-11fb-4b39-9eef-e0e051602191', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'query', '{\"connection\":\"tenant\",\"bindings\":[],\"sql\":\"select * from `users` where `id` = 1 limit 1\",\"time\":\"1.42\",\"slow\":false,\"file\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/public\\/index.php\",\"line\":52,\"hash\":\"082e27d9c4fc4a40315cae2c646c0509\",\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(71, '9b61007a-1207-4d78-bc99-dc6e3aefbccc', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'model', '{\"action\":\"retrieved\",\"model\":\"App\\\\Models\\\\User\",\"count\":1,\"hostname\":\"Muhammads-iMac.local\"}', '2024-02-20 06:07:01'),
(72, '9b61007a-1921-481e-9bf3-68dfa70a1275', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\DumpingDatabase\",\"payload\":{\"dbDumper\":{\"class\":\"Spatie\\\\DbDumper\\\\Databases\\\\MySql\",\"properties\":[]}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:01'),
(73, '9b61007a-6efb-4dae-96e8-01ac0110b63e', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupManifestWasCreated\",\"payload\":{\"manifest\":{\"class\":\"Spatie\\\\Backup\\\\Tasks\\\\Backup\\\\Manifest\",\"properties\":[]}},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:01'),
(74, '9b61007e-53a9-427f-880a-41996d2259d7', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupZipWasCreated\",\"payload\":{\"pathToZip\":\"\\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/storage\\/app\\/backup-temp\\/temp\\/2024-02-20-06-07-01.zip\"},\"listeners\":[],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(75, '9b61007e-6439-4124-a275-031007531a4e', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"notifications::email\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Notifications\\/resources\\/views\\/email.blade.php\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(76, '9b61007e-6463-4af6-921f-ee2b265ac0b4', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::message\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/message.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(77, '9b61007e-6476-436d-af27-8402d8fa5e0e', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::header\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/header.blade.php\",\"data\":[\"url\",\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(78, '9b61007e-6482-4e1b-a3a5-963c433d208c', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::footer\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/footer.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(79, '9b61007e-6560-4c04-ac1e-806dbba7c166', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::layout\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/layout.blade.php\",\"data\":[\"attributes\",\"slot\",\"header\",\"footer\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(80, '9b61007e-65c2-4e44-ada1-d7a422f6824f', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::themes.default\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/html\\/themes\\/default.css\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(81, '9b61007e-6747-4df8-8ad2-07b9b968a456', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"notifications::email\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Notifications\\/resources\\/views\\/email.blade.php\",\"data\":[\"level\",\"subject\",\"greeting\",\"salutation\",\"introLines\",\"outroLines\",\"actionText\",\"actionUrl\",\"displayableActionUrl\",\"__laravel_notification_id\",\"__laravel_notification\",\"__laravel_notification_queued\",\"mailer\",\"message\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(82, '9b61007e-6751-40ae-9f19-f7b549681a7a', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::message\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/message.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(83, '9b61007e-675c-45e5-8fa3-f5ef483525c1', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::header\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/header.blade.php\",\"data\":[\"url\",\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(84, '9b61007e-6765-4959-bcd5-138e5e62a6db', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::footer\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/footer.blade.php\",\"data\":[\"attributes\",\"slot\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04'),
(85, '9b61007e-676b-4aea-a17d-779c30dc3636', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'view', '{\"name\":\"mail::layout\",\"path\":\"\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Mail\\/resources\\/views\\/text\\/layout.blade.php\",\"data\":[\"attributes\",\"slot\",\"header\",\"footer\",\"__laravel_slots\"],\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:04');
INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
(86, '9b610082-aee9-458c-bd24-2c219258fc85', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'mail', '{\"mailable\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifications\\\\BackupWasSuccessfulNotification\",\"queued\":false,\"from\":{\"smtpemail913@gmail.com\":\"Site Manager\"},\"replyTo\":[],\"to\":{\"your@example.com\":\"\"},\"cc\":[],\"bcc\":[],\"subject\":\"Successful new backup of Site Manager (local)\",\"html\":\"<!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Transitional\\/\\/EN\\\" \\\"http:\\/\\/www.w3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-transitional.dtd\\\">\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\">\\n<head>\\n<title>Site Manager<\\/title>\\n<meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=UTF-8\\\">\\n<meta name=\\\"color-scheme\\\" content=\\\"light\\\">\\n<meta name=\\\"supported-color-schemes\\\" content=\\\"light\\\">\\n<style>\\n@media only screen and (max-width: 600px) {\\n.inner-body {\\nwidth: 100% !important;\\n}\\n\\n.footer {\\nwidth: 100% !important;\\n}\\n}\\n\\n@media only screen and (max-width: 500px) {\\n.button {\\nwidth: 100% !important;\\n}\\n}\\n<\\/style>\\n<\\/head>\\n<body style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;\\\">\\n\\n<table class=\\\"wrapper\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;\\\">\\n<tr>\\n<td align=\\\"center\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\\\">\\n<table class=\\\"content\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\\\">\\n<tr>\\n<td class=\\\"header\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; padding: 25px 0; text-align: center;\\\">\\n<a href=\\\"http:\\/\\/localhost\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; display: inline-block;\\\">\\nSite Manager\\n<\\/a>\\n<\\/td>\\n<\\/tr>\\n\\n<!-- Email Body -->\\n<tr>\\n<td class=\\\"body\\\" width=\\\"100%\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%; border: hidden !important;\\\">\\n<table class=\\\"inner-body\\\" align=\\\"center\\\" width=\\\"570\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\\\">\\n<!-- Body content -->\\n<tr>\\n<td class=\\\"content-cell\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\\\">\\n<h1 style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\\\">Hello!<\\/h1>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Great news, a new backup of Site Manager (local) was successfully created on the disk named local.<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Application name: Site Manager (local)<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Backup name: Site Manager<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Disk: local<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest backup size: 134.59 MB<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Number of backups: 1<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Total storage used: 134.59 MB<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest backup date: 2024\\/02\\/20 06:07:01<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Oldest backup date: 2024\\/02\\/20 06:07:01<\\/p>\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Regards,<br>\\nSite Manager<\\/p>\\n\\n\\n\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n\\n<tr>\\n<td style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\\\">\\n<table class=\\\"footer\\\" align=\\\"center\\\" width=\\\"570\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" role=\\\"presentation\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\\\">\\n<tr>\\n<td class=\\\"content-cell\\\" align=\\\"center\\\" style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\\\">\\n<p style=\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\\\">\\u00a9 2024 Site Manager. All rights reserved.<\\/p>\\n\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/td>\\n<\\/tr>\\n<\\/table>\\n<\\/body>\\n<\\/html>\",\"raw\":\"From: Site Manager <smtpemail913@gmail.com>\\r\\nTo: your@example.com\\r\\nSubject: Successful new backup of Site Manager (local)\\r\\nMIME-Version: 1.0\\r\\nDate: Tue, 20 Feb 2024 06:07:06 +0000\\r\\nMessage-ID: <9419271484824c95a891a737c3e79097@gmail.com>\\r\\nContent-Type: multipart\\/alternative; boundary=JjCMqTwT\\r\\n\\r\\n--JjCMqTwT\\r\\nContent-Type: text\\/plain; charset=utf-8\\r\\nContent-Transfer-Encoding: quoted-printable\\r\\n\\r\\n[Site Manager](http:\\/\\/localhost)\\r\\n\\r\\n# Hello!\\r\\n\\r\\nGreat news, a new backu=\\r\\np of Site Manager (local) was successfully created on the disk named local.=\\r\\n\\r\\n\\r\\nApplication name: Site Manager (local)\\r\\n\\r\\nBackup name: Site Manager=\\r\\n\\r\\n\\r\\nDisk: local\\r\\n\\r\\nNewest backup size: 134.59 MB\\r\\n\\r\\nNumber of backups=\\r\\n: 1\\r\\n\\r\\nTotal storage used: 134.59 MB\\r\\n\\r\\nNewest backup date: 2024\\/02\\/20 =\\r\\n06:07:01\\r\\n\\r\\nOldest backup date: 2024\\/02\\/20 06:07:01\\r\\n\\r\\nRegards,\\r\\nSite =\\r\\nManager\\r\\n\\r\\n=C2=A9 2024 Site Manager. All rights reserved.\\r\\n\\r\\n--JjCMqTwT\\r\\nContent-Type: text\\/html; charset=utf-8\\r\\nContent-Transfer-Encoding: quoted-printable\\r\\n\\r\\n<!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Transitional\\/\\/EN\\\" \\\"http:\\/\\/www.=\\r\\nw3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-transitional.dtd\\\">\\r\\n<html xmlns=3D\\\"http:\\/\\/www.=\\r\\nw3.org\\/1999\\/xhtml\\\">\\r\\n<head>\\r\\n<title>Site Manager<\\/title>\\r\\n<meta name=3D\\\"=\\r\\nviewport\\\" content=3D\\\"width=3Ddevice-width, initial-scale=3D1.0\\\">\\r\\n<meta ht=\\r\\ntp-equiv=3D\\\"Content-Type\\\" content=3D\\\"text\\/html; charset=3DUTF-8\\\">\\r\\n<meta n=\\r\\name=3D\\\"color-scheme\\\" content=3D\\\"light\\\">\\r\\n<meta name=3D\\\"supported-color-sch=\\r\\nemes\\\" content=3D\\\"light\\\">\\r\\n<style>\\r\\n@media only screen and (max-width: 600=\\r\\npx) {\\r\\n.inner-body {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n\\r\\n.footer {\\r\\nwidth:=\\r\\n 100% !important;\\r\\n}\\r\\n}\\r\\n\\r\\n@media only screen and (max-width: 500px) {=\\r\\n\\r\\n.button {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n}\\r\\n<\\/style>\\r\\n<\\/head>\\r\\n<body=\\r\\n style=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyste=\\r\\nmFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji=\\r\\n\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-text-si=\\r\\nze-adjust: none; background-color: #ffffff; color: #718096; height: 100%; l=\\r\\nine-height: 1.4; margin: 0; padding: 0; width: 100% !important;\\\">\\r\\n\\r\\n<tab=\\r\\nle class=3D\\\"wrapper\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" rol=\\r\\ne=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-sys=\\r\\ntem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, =\\r\\n\'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relativ=\\r\\ne; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: =\\r\\n100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;\\\">\\r\\n<t=\\r\\nr>\\r\\n<td align=3D\\\"center\\\" style=3D\\\"box-sizing: border-box; font-family: -ap=\\r\\nple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-=\\r\\nserif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: =\\r\\nrelative;\\\">\\r\\n<table class=3D\\\"content\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cel=\\r\\nlspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-=\\r\\nfamily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, A=\\r\\nrial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\';=\\r\\n position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; =\\r\\n-premailer-width: 100%; margin: 0; padding: 0; width: 100%;\\\">\\r\\n<tr>\\r\\n<td =\\r\\nclass=3D\\\"header\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-syste=\\r\\nm, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'A=\\r\\npple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;=\\r\\n padding: 25px 0; text-align: center;\\\">\\r\\n<a href=3D\\\"http:\\/\\/localhost\\\" styl=\\r\\ne=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont=\\r\\n, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'S=\\r\\negoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852; font=\\r\\n-size: 19px; font-weight: bold; text-decoration: none; display: inline-bloc=\\r\\nk;\\\">\\r\\nSite Manager\\r\\n<\\/a>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n\\r\\n<!-- Email Body -->\\r\\n<tr>=\\r\\n\\r\\n<td class=3D\\\"body\\\" width=3D\\\"100%\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" st=\\r\\nyle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\\r\\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\\r\\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpad=\\r\\nding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-colo=\\r\\nr: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7=\\r\\n; margin: 0; padding: 0; width: 100%; border: hidden !important;\\\">\\r\\n<table=\\r\\n class=3D\\\"inner-body\\\" align=3D\\\"center\\\" width=3D\\\"570\\\" cellpadding=3D\\\"0\\\" cell=\\r\\nspacing=3D\\\"0\\\" role=3D\\\"presentation\\\" style=3D\\\"box-sizing: border-box; font-f=\\r\\namily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ar=\\r\\nial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; =\\r\\nposition: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -=\\r\\npremailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; b=\\r\\norder-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0=\\r\\n.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width:=\\r\\n 570px;\\\">\\r\\n<!-- Body content -->\\r\\n<tr>\\r\\n<td class=3D\\\"content-cell\\\" style=\\r\\n=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\\r\\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\\r\\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; pad=\\r\\nding: 32px;\\\">\\r\\n<h1 style=3D\\\"box-sizing: border-box; font-family: -apple-sy=\\r\\nstem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif,=\\r\\n \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relati=\\r\\nve; color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0; text=\\r\\n-align: left;\\\">Hello!<\\/h1>\\r\\n<p style=3D\\\"box-sizing: border-box; font-famil=\\r\\ny: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial,=\\r\\n sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posi=\\r\\ntion: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-al=\\r\\nign: left;\\\">Great news, a new backup of Site Manager (local) was successful=\\r\\nly created on the disk named local.<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-bo=\\r\\nx; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helv=\\r\\netica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI =\\r\\nSymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-to=\\r\\np: 0; text-align: left;\\\">Application name: Site Manager (local)<\\/p>\\r\\n<p st=\\r\\nyle=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\\r\\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\\r\\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; l=\\r\\nine-height: 1.5em; margin-top: 0; text-align: left;\\\">Backup name: Site Mana=\\r\\nger<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, B=\\r\\nlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple=\\r\\n Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; fon=\\r\\nt-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Disk: l=\\r\\nocal<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system, =\\r\\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\\r\\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; fo=\\r\\nnt-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Newest=\\r\\n backup size: 134.59 MB<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-fami=\\r\\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\\r\\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\\r\\nition: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-a=\\r\\nlign: left;\\\">Number of backups: 1<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box;=\\r\\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\\r\\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\\r\\nmbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top:=\\r\\n 0; text-align: left;\\\">Total storage used: 134.59 MB<\\/p>\\r\\n<p style=3D\\\"box-=\\r\\nsizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe =\\r\\nUI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI E=\\r\\nmoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height:=\\r\\n 1.5em; margin-top: 0; text-align: left;\\\">Newest backup date: 2024\\/02\\/20 06=\\r\\n:07:01<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-box; font-family: -apple-system=\\r\\n, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Ap=\\r\\nple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; =\\r\\nfont-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\\\">Olde=\\r\\nst backup date: 2024\\/02\\/20 06:07:01<\\/p>\\r\\n<p style=3D\\\"box-sizing: border-bo=\\r\\nx; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helv=\\r\\netica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI =\\r\\nSymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-to=\\r\\np: 0; text-align: left;\\\">Regards,<br>\\r\\nSite Manager<\\/p>\\r\\n\\r\\n\\r\\n\\r\\n<\\/td>=\\r\\n\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n\\r\\n<tr>\\r\\n<td style=3D\\\"box-sizing: bo=\\r\\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\\r\\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\\r\\ngoe UI Symbol\'; position: relative;\\\">\\r\\n<table class=3D\\\"footer\\\" align=3D\\\"ce=\\r\\nnter\\\" width=3D\\\"570\\\" cellpadding=3D\\\"0\\\" cellspacing=3D\\\"0\\\" role=3D\\\"presentatio=\\r\\nn\\\" style=3D\\\"box-sizing: border-box; font-family: -apple-system, BlinkMacSys=\\r\\ntemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emo=\\r\\nji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-ce=\\r\\nllpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0=\\r\\n auto; padding: 0; text-align: center; width: 570px;\\\">\\r\\n<tr>\\r\\n<td class=\\r\\n=3D\\\"content-cell\\\" align=3D\\\"center\\\" style=3D\\\"box-sizing: border-box; font-fa=\\r\\nmily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ari=\\r\\nal, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; p=\\r\\nosition: relative; max-width: 100vw; padding: 32px;\\\">\\r\\n<p style=3D\\\"box-siz=\\r\\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\\r\\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\\r\\ni\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: =\\r\\n0; color: #b0adc5; font-size: 12px; text-align: center;\\\">=C2=A9 2024 Site M=\\r\\nanager. All rights reserved.<\\/p>\\r\\n\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/=\\r\\ntr>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<\\/body>\\r\\n<\\/html>\\r\\n--JjCMqTwT--\\r\\n\",\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:06'),
(87, '9b610082-af40-420d-b727-b9c27b2c172c', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'notification', '{\"notification\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifications\\\\BackupWasSuccessfulNotification\",\"queued\":false,\"notifiable\":\"Spatie\\\\Backup\\\\Notifications\\\\Notifiable\",\"channel\":\"mail\",\"response\":{},\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:06'),
(88, '9b610082-af72-4dc2-abbd-65ac1a6bc14a', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'event', '{\"name\":\"Spatie\\\\Backup\\\\Events\\\\BackupWasSuccessful\",\"payload\":{\"backupDestination\":{\"class\":\"Spatie\\\\Backup\\\\BackupDestination\\\\BackupDestination\",\"properties\":{\"connectionError\":null}}},\"listeners\":[{\"name\":\"Closure at \\/Users\\/muhammadiqbal\\/Sites\\/site-manager\\/vendor\\/spatie\\/laravel-backup\\/src\\/Notifications\\/EventHandler.php[25:31]\",\"queued\":false}],\"broadcast\":false,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:06'),
(89, '9b610082-b5b4-40dc-8f9f-b8630ce5c464', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'command', '{\"command\":\"backup:run\",\"exit_code\":0,\"arguments\":{\"command\":\"backup:run\"},\"options\":{\"filename\":null,\"only-db\":false,\"db-name\":[],\"only-files\":false,\"only-to-disk\":null,\"disable-notifications\":false,\"timeout\":null,\"tries\":null,\"isolated\":false,\"help\":false,\"quiet\":false,\"verbose\":false,\"version\":false,\"ansi\":null,\"no-interaction\":false,\"env\":null},\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:06'),
(90, '9b610082-b6a9-4b04-a522-145bcf47e99e', '9b610082-b71a-477e-83ee-6629b26e1759', NULL, 1, 'request', '{\"ip_address\":\"127.0.0.1\",\"uri\":\"\\/admin\\/backup\",\"method\":\"GET\",\"controller_action\":\"App\\\\Http\\\\Controllers\\\\Backend\\\\BackupController@backup\",\"middleware\":[\"web\",\"Stancl\\\\Tenancy\\\\Middleware\\\\InitializeTenancyByDomain\",\"Stancl\\\\Tenancy\\\\Middleware\\\\PreventAccessFromCentralDomains\",\"auth\"],\"headers\":{\"host\":\"nazan.site-manager.local\",\"connection\":\"keep-alive\",\"cache-control\":\"max-age=0\",\"upgrade-insecure-requests\":\"1\",\"user-agent\":\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7\",\"accept-encoding\":\"gzip, deflate\",\"accept-language\":\"en-GB,en-US;q=0.9,en;q=0.8\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6ImFQQjhWYm1uSHh3eGdqTmorc3pOK1E9PSIsInZhbHVlIjoiUXBWaVBwWmYwL1NNRWZMRDJ3d1Q3WnZtWmVCYkpSUWxaUUlkTGFGV2lPQUp6WmhmVDg5OW9zaHZHcnhuTThjZlZ3SVBBVGp5aUxkNnVIRUUxZEFyVExaWnNkWXJsRGZtQXZtc2NQUEdjRFd0VnNOQ2hubmY2WFpDSTBnYjZoL3AiLCJtYWMiOiJiZGY1NTUwOGY1YTQwNTg5MTdhZGMyNGEyZjk1ZmNiMmE3Njg4Mjk1ZDcxZDJmYzJhN2MyZTcyYjJiMGY0NjE4IiwidGFnIjoiIn0%3D; site_manager_session=eyJpdiI6IjFsNzkxSGtCWXFENy9Hb3RIMWdDZnc9PSIsInZhbHVlIjoiem1rRDhSWTlOV3MrU1dUd2RTZ1VzbmVzSmU2SC9iemZhaTJKV3AzVjErQjRrTHA4bzZNMGhKOTV2ZVlLNUl2UDg4Q2JwL09MUUIvV1RRNU5GRkNPWDNJRzE3RGpJTi9kR2pBM3hKUkFjVkhsaFI5SGF3cm1uSEtVU2gzSk9MMnoiLCJtYWMiOiI1MTNjNjQ4MWVkZGNhYWViZjExNDBiYWU4MDExMWJmMmY3MzM1NDI2NjVhZTUzZDQ3Y2NjNTg1ODM1MTM4OTlmIiwidGFnIjoiIn0%3D\"},\"payload\":[],\"session\":{\"_token\":\"90ZN0MhDN3GDXYDHR6Pl8tfbbGPu78gdkELNnW5O\",\"_previous\":{\"url\":\"http:\\/\\/nazan.site-manager.local\\/admin\\/backup\"},\"_flash\":{\"old\":[],\"new\":[]},\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1},\"response_status\":200,\"response\":\"Empty Response\",\"duration\":5729,\"memory\":6,\"hostname\":\"Muhammads-iMac.local\",\"user\":{\"id\":1,\"name\":null,\"email\":\"huzairahmalik@gmail.com\"}}', '2024-02-20 06:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telescope_entries_tags`
--

INSERT INTO `telescope_entries_tags` (`entry_uuid`, `tag`) VALUES
('9b60fc36-77c3-4633-bd92-55ac015d421f', 'App\\Models\\Tenant'),
('9b60fc36-7820-4a9d-961e-b48e6714cfab', 'Stancl\\Tenancy\\Database\\Models\\Domain'),
('9b60fc36-7a9a-4be3-8c0f-43d8b06db5c7', 'App\\Models\\User'),
('9b60fc36-8235-4e53-bc8a-5fb6c37f47a7', 'Auth:1'),
('9b60fc36-c9a2-46a3-a958-e22fe58f9d57', 'Auth:1'),
('9b60fc36-caf2-407d-b55e-144b05078e52', 'Auth:1'),
('9b60fc36-ce3b-45dc-b1d2-40b83cc80c60', 'Auth:1'),
('9b60fc36-ce60-4af8-9a4c-20e70e8bf3d8', 'Auth:1'),
('9b60fc36-ce79-4e76-b565-9c3387f3380e', 'Auth:1'),
('9b60fc36-ce90-4e01-8429-fc9edb8b56b2', 'Auth:1'),
('9b60fc36-cf72-4a56-8b25-c1b21a954773', 'Auth:1'),
('9b60fc36-cff0-402d-b7d6-2543c1faa62f', 'Auth:1'),
('9b60fc36-d186-40c2-bd7c-9e891be2f176', 'Auth:1'),
('9b60fc36-d198-4fb4-9d43-29140ec2496b', 'Auth:1'),
('9b60fc36-d1ac-489b-8e88-daaaa771fb19', 'Auth:1'),
('9b60fc36-d1bc-4dc3-9a9d-f5541de7ed67', 'Auth:1'),
('9b60fc36-d1c8-4044-95b4-4ec0b561b57f', 'Auth:1'),
('9b60fc3b-17ba-46a1-82e8-575ff1d8b0c8', 'Auth:1'),
('9b60fc3b-17ba-46a1-82e8-575ff1d8b0c8', 'your@example.com'),
('9b60fc3b-1804-4f17-92a1-1a3fabd54dbb', 'Auth:1'),
('9b60fc3b-1804-4f17-92a1-1a3fabd54dbb', 'Spatie\\Backup\\Notifications\\Notifiable'),
('9b60fc3b-1834-4ad3-8b3f-bea4040734ca', 'Auth:1'),
('9b60fc3b-1b55-420a-a771-94c438d8e986', 'Auth:1'),
('9b60fc3b-1ccd-477c-a86b-8f9b81e1edea', 'Auth:1'),
('9b610009-a9ec-4854-93fd-7499332192c2', 'App\\Models\\Tenant'),
('9b610009-aa4e-4186-b140-a4db60604c26', 'Stancl\\Tenancy\\Database\\Models\\Domain'),
('9b610009-ae16-4b02-93d0-665c43987ac1', 'App\\Models\\User'),
('9b610009-b621-4ade-bb84-6b6a54be8d94', 'Auth:1'),
('9b61000a-aead-44c1-94ae-6b1e74af8bbb', 'Auth:1'),
('9b610014-2de3-49c1-a6f9-3798ac6663e9', 'Auth:1'),
('9b610015-aef8-440c-b746-5c8fc985c817', 'Auth:1'),
('9b610015-af96-43c9-bf6b-aa5d47e8c049', 'Auth:1'),
('9b610015-afa5-4909-84ad-704ea3903ca1', 'Auth:1'),
('9b610015-afb3-46c3-a07e-a805d2f0bee4', 'Auth:1'),
('9b610015-b05b-46c9-af7f-022bd52df4fc', 'Auth:1'),
('9b610015-b0ab-4ff1-b18d-01f131d89020', 'Auth:1'),
('9b610015-b3ed-4e30-b995-91894108ce5a', 'Auth:1'),
('9b610015-b3f7-4f51-aaa6-47fafb89dd36', 'Auth:1'),
('9b610015-b402-44f6-a6ea-21c8653ea0e7', 'Auth:1'),
('9b610015-b40a-40d7-9879-d972fa546774', 'Auth:1'),
('9b610015-b410-438f-95d0-ea71ddf2597f', 'Auth:1'),
('9b610019-db50-4fcb-8a4a-4ce728ead4c3', 'Auth:1'),
('9b610019-db50-4fcb-8a4a-4ce728ead4c3', 'your@example.com'),
('9b610019-db9a-4aca-89e6-49d8eca7d146', 'Auth:1'),
('9b610019-db9a-4aca-89e6-49d8eca7d146', 'Spatie\\Backup\\Notifications\\Notifiable'),
('9b610019-dbcd-42dc-8bba-36b4ec1a7112', 'Auth:1'),
('9b610019-eaa9-4764-a731-1e6b2b7aec86', 'Auth:1'),
('9b610019-eb5e-4a6d-8d1f-44569f109c71', 'Auth:1'),
('9b61007a-0e1f-4eea-9421-2de9cf53c91b', 'App\\Models\\Tenant'),
('9b61007a-0ea7-4660-822f-04b20da99a8d', 'Stancl\\Tenancy\\Database\\Models\\Domain'),
('9b61007a-1207-4d78-bc99-dc6e3aefbccc', 'App\\Models\\User'),
('9b61007a-1921-481e-9bf3-68dfa70a1275', 'Auth:1'),
('9b61007a-6efb-4dae-96e8-01ac0110b63e', 'Auth:1'),
('9b61007e-53a9-427f-880a-41996d2259d7', 'Auth:1'),
('9b61007e-6439-4124-a275-031007531a4e', 'Auth:1'),
('9b61007e-6463-4af6-921f-ee2b265ac0b4', 'Auth:1'),
('9b61007e-6476-436d-af27-8402d8fa5e0e', 'Auth:1'),
('9b61007e-6482-4e1b-a3a5-963c433d208c', 'Auth:1'),
('9b61007e-6560-4c04-ac1e-806dbba7c166', 'Auth:1'),
('9b61007e-65c2-4e44-ada1-d7a422f6824f', 'Auth:1'),
('9b61007e-6747-4df8-8ad2-07b9b968a456', 'Auth:1'),
('9b61007e-6751-40ae-9f19-f7b549681a7a', 'Auth:1'),
('9b61007e-675c-45e5-8fa3-f5ef483525c1', 'Auth:1'),
('9b61007e-6765-4959-bcd5-138e5e62a6db', 'Auth:1'),
('9b61007e-676b-4aea-a17d-779c30dc3636', 'Auth:1'),
('9b610082-aee9-458c-bd24-2c219258fc85', 'Auth:1'),
('9b610082-aee9-458c-bd24-2c219258fc85', 'your@example.com'),
('9b610082-af40-420d-b727-b9c27b2c172c', 'Auth:1'),
('9b610082-af40-420d-b727-b9c27b2c172c', 'Spatie\\Backup\\Notifications\\Notifiable'),
('9b610082-af72-4dc2-abbd-65ac1a6bc14a', 'Auth:1'),
('9b610082-b5b4-40dc-8f9f-b8630ce5c464', 'Auth:1'),
('9b610082-b6a9-4b04-a522-145bcf47e99e', 'Auth:1');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `doc_class` int(11) NOT NULL,
  `course_provider` text DEFAULT NULL,
  `course_date` date NOT NULL,
  `course_location` varchar(255) NOT NULL,
  `status` enum('Active','Confirmed','Pending','Abandoned') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `people_id`, `doc_id`, `doc_class`, `course_provider`, `course_date`, `course_location`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 114, 'a', '2024-05-29', 'c', 'Active', '2024-05-09 07:39:50', '2024-05-09 07:54:12'),
(2, 1, 32, 114, 'd', '2024-05-29', 'sd', 'Active', '2024-05-09 07:44:14', '2024-05-09 07:44:14'),
(3, 1, 32, 114, 'd', '2024-05-29', 'sd', 'Active', '2024-05-09 07:47:31', '2024-05-09 07:47:31'),
(4, 1, 31, 107, 'sd', '2024-05-22', 'sd', 'Active', '2024-05-09 07:54:35', '2024-05-09 07:54:35'),
(5, 1, 34, 86, 'loksasas', '2024-05-20', 'loksasas', 'Pending', '2024-05-09 07:54:59', '2024-06-04 04:49:42'),
(6, 1, 35, 84, 'sd', '2024-05-27', 'ds', 'Confirmed', '2024-05-31 09:10:38', '2024-06-04 05:22:35'),
(7, 1, 42, 105, 'df', '2024-06-11', 'fd', 'Active', '2024-06-04 05:23:24', '2024-06-04 05:23:24'),
(8, 1, 45, 17, 'fds', '2024-06-12', 'ds', 'Confirmed', '2024-06-04 05:24:02', '2024-06-04 05:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `global_id` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `two_fact_auth` enum('email','phone') DEFAULT NULL,
  `photo_path` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `global_id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `status`, `two_fact_auth`, `photo_path`, `created_at`, `updated_at`) VALUES
(1, '1696489038', 'Nazan', 'Khan', 'huzairahmalik@gmail.com', NULL, '$2y$10$/6saSz6.OYABWUf8vkMN7eyfgbuR2hsKVoLQgKyGS2A3jAaIIrkyG', 'bveMZAP2miHbsMCdbLmRlrP8Q391huxIE6S1RxbDy4L3aYmGBvLJ1gqP4c1U', '+923363274033', 'Active', NULL, NULL, '2023-10-05 01:57:21', '2024-02-23 00:47:35'),
(2, 'bc3a1373-0861-425e-a96a-6815afeb5542', 'manager', 'manager', 'managera@gmail.com', NULL, '$2y$10$/6saSz6.OYABWUf8vkMN7eyfgbuR2hsKVoLQgKyGS2A3jAaIIrkyG', NULL, '233', 'Active', NULL, NULL, '2023-10-09 13:40:22', '2023-10-09 13:40:22'),
(7, 'e86061a7-1cbf-4eda-8edf-4a34cc353867', 'loka', 'loka', 'loka@gmail.com', NULL, '$2y$10$N6cU8LPmEkczr3GJwW7mReSL97tqgpUF98/K1iAQ/wVXQLOSpmirS', NULL, '+443363274039', 'Active', 'email', NULL, '2024-02-22 03:32:01', '2024-02-22 03:45:58'),
(9, '47c7dc3e-ba60-43f1-a126-960db8582202', 'jason', 'statham', 'jasonstatham9483@gmail.com', NULL, '$2y$10$MMQDCT/WFhclnJR6kBqpkeChojrrdDIWgnkE5v84ghPEG98PEPu0S', '340350', '+4423323', 'Active', 'email', NULL, '2024-02-23 01:42:38', '2024-02-23 02:01:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_permissions`
--
ALTER TABLE `base_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission` (`permission`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `monitors`
--
ALTER TABLE `monitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monitors_url_unique` (`url`);

--
-- Indexes for table `notification_log`
--
ALTER TABLE `notification_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_assignments`
--
ALTER TABLE `project_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_links`
--
ALTER TABLE `project_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_contacts`
--
ALTER TABLE `site_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcontractors`
--
ALTER TABLE `subcontractors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcontractor_contacts`
--
ALTER TABLE `subcontractor_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suboperatives`
--
ALTER TABLE `suboperatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suboperative_documents`
--
ALTER TABLE `suboperative_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_suboperatives`
--
ALTER TABLE `task_suboperatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_tasks`
--
ALTER TABLE `team_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `telescope_entries_created_at_index` (`created_at`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `base_permissions`
--
ALTER TABLE `base_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `monitors`
--
ALTER TABLE `monitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_log`
--
ALTER TABLE `notification_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_assignments`
--
ALTER TABLE `project_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_links`
--
ALTER TABLE `project_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_contacts`
--
ALTER TABLE `site_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcontractors`
--
ALTER TABLE `subcontractors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcontractor_contacts`
--
ALTER TABLE `subcontractor_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suboperatives`
--
ALTER TABLE `suboperatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suboperative_documents`
--
ALTER TABLE `suboperative_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task_suboperatives`
--
ALTER TABLE `task_suboperatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team_tasks`
--
ALTER TABLE `team_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
