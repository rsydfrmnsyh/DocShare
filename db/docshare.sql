-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 06:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`) VALUES
(1, 'Science Fiction'),
(2, 'Novel'),
(3, 'Mathematics'),
(4, 'Economics'),
(5, 'Accounting'),
(6, 'Programming'),
(7, 'Nutrition and Health'),
(8, 'Pharmacology'),
(9, 'Finance'),
(10, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE `tbl_documents` (
  `document_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_upload_id` int(11) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_documents`
--

INSERT INTO `tbl_documents` (`document_id`, `title`, `author`, `description`, `img`, `category_id`, `user_upload_id`, `page`, `created_at`, `updated_at`, `url`) VALUES
(1, '01. Pharmacology author Luca Gallelli', 'Luca Gallelli', 'About Pharmacology', NULL, 8, 2, 44, '2024-06-14 14:30:19', '2024-06-14 14:30:19', './uploads/documents/1/1.pdf'),
(2, '01. Principles for the Management of Credit Risk Author BIS - Bank for International Settlements', 'Jhon', 'principle for the management', NULL, 5, 2, 65, '2024-06-14 14:31:39', '2024-06-14 14:31:39', './uploads/documents/2/2.pdf'),
(3, '02. Basics of Finance Authors GÃ¡bor KÃ¼rthy, JÃ³zsef Varga, TamÃ¡s Pesuth', 'Gabor', 'Basics of Finance', NULL, 9, 2, 44, '2024-06-14 14:32:48', '2024-06-14 14:32:48', './uploads/documents/3/3.pdf'),
(4, '02. Pharmacology author Christa van Tellingen', 'Christa', 'Pharmacology ', NULL, 8, 2, 24, '2024-06-14 14:33:28', '2024-06-14 14:33:28', './uploads/documents/4/4.pdf'),
(5, '03. Pharmacology Basics author Elizabeth Boldon', 'Elizabeth', 'Pharmacology Basics', NULL, 8, 2, 23, '2024-06-14 14:34:04', '2024-06-14 14:34:04', './uploads/documents/5/5.pdf'),
(6, '04. Drug Prescribing For Dentistry author Scottish Dental Clinical Effectiveness Programme (SDCEP)', 'Scottish', 'Drug Prescribing For Dentistry', NULL, 7, 2, 22, '2024-06-14 14:34:50', '2024-06-14 14:34:50', './uploads/documents/6/6.pdf'),
(7, '04. How Unique are US Banks - The Role of Banks in Five Major Financial Systems Author Andreas Hackethal. How Unique are US Banks - The Role of Banks in Five Major Financial Systems Author Andreas Hackethal', 'Andreas Hackethal', 'How Unique are US Banks', NULL, 9, 2, 20, '2024-06-14 14:35:27', '2024-06-14 14:35:27', './uploads/documents/7/7.pdf'),
(8, '05. Clinical Guide to Ophthalmic Drugs author Ron Melton and Randall Thomas', 'Randall Thomas', 'Clinical Guide to Ophthalmic', NULL, 8, 2, 21, '2024-06-14 14:35:52', '2024-06-14 14:35:52', './uploads/documents/8/8.pdf'),
(9, '05. Financial Investments and Stock Markets Author Capital Market Authority', 'Capital Market ', 'Financial Investments', NULL, 9, 2, 23, '2024-06-14 14:36:26', '2024-06-14 14:36:26', './uploads/documents/9/9.pdf'),
(10, 'AccountingBasicsPart1', 'Jhon', 'Accounting about', NULL, 5, 2, 24, '2024-06-14 14:37:04', '2024-06-14 14:37:04', './uploads/documents/10/10.pdf'),
(11, 'keac101', 'Jhon', 'Super class admin', NULL, 7, 2, 24, '2024-06-14 14:37:45', '2024-06-14 14:37:45', './uploads/documents/11/11.pdf'),
(12, 'MIPS Assembly Language Programming using QtSpim, Ed Jorgensen', 'QtSpim, Ed Jorgensen', 'MIPS Assembly Language ', NULL, 6, 2, 24, '2024-06-14 14:38:15', '2024-06-14 14:38:15', './uploads/documents/12/12.pdf'),
(13, 'Principles of Programming Languages, Mike Grant, Zachary Palmer, Scott Smith', 'Mike Grant, Zachary Palmer, Scott Smith', 'rinciples of Programming Languages,', NULL, 6, 2, 23, '2024-06-14 14:38:54', '2024-06-14 14:38:54', './uploads/documents/13/13.pdf'),
(14, 'Programming Persistent Memory, Steve Scargall', 'Steve Scargall', 'Programming Persistent Memory', NULL, 6, 2, 24, '2024-06-14 14:39:24', '2024-06-14 14:39:24', './uploads/documents/14/14.pdf'),
(15, 'Understanding Programming Languages, M. Ben-Ari (1)', 'M. Ben-Ari (1)', 'Understanding Programming Languages', NULL, 6, 2, 24, '2024-06-14 14:39:58', '2024-06-14 14:39:58', './uploads/documents/15/15.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plans`
--

CREATE TABLE `tbl_plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriptions`
--

CREATE TABLE `tbl_subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `role` enum('admin','member') DEFAULT 'member',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `profile_photo`, `role`, `password`) VALUES
(2, 'admin', 'muhammadidris@students.esqbs.ac.id', './uploads/profile_photo/1.jpeg', 'admin', '$2y$10$IJg3FEoCNHWvrqTuMrEvxOuUJOs1SlY2cUDdep7iuY79iC4nTboXO'),
(3, 'idris', 'muhmmadidris15@gmail.com', NULL, 'admin', '$2y$10$sl4QJUyeLTPvURYxq64eE.H1FAo2VEK4p/Gpy40wGJ.y/h4zANZFa'),
(4, 'rasyad', 'rasyadfirmansyah@students.esqbs.ac.id', './uploads/profile_photo/anak main.png', 'member', '$2y$10$SJlD5vt2i2nMU58BXoNQ0uJecQ1xzwn922f4zJQ7sAvwaHXD3pn2G'),
(5, 'tara almanda', 'tara.almanda@students.esqbs.ac.id', NULL, 'member', '$2y$10$m/K/1mQPPeQBI/zI8aP2b.y.R3F47BjKgrhq/D7b4Rqs2Dzsd6HG6'),
(8, 'raihan', 'raihan@gmail.com', NULL, 'member', '$2y$10$lv/OFNMYDrrU9H.6PnCSROO/xotgy5Leseekcz47lBr6Vb5zInSUe'),
(9, 'dede', 'dede@gmail.com', './uploads/profile_photo/4ca988f244c907a7b0c10c3454650011.jpg', 'member', '$2y$10$o3cXrDXDF2mw7fTPffknoOCgAF/3xBgygcO6ejo7N6FZb7iJa8J.S'),
(10, 'member', 'member@gmail.com', NULL, 'member', '$2y$10$PyTvYJbTNLrY3Xpnw3xoJOO3eM6Wvqio8fKcmb/J9vGTuVsDTeR/e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `user_upload_id` (`user_upload_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_plans`
--
ALTER TABLE `tbl_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `tbl_subscriptions`
--
ALTER TABLE `tbl_subscriptions`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_plans`
--
ALTER TABLE `tbl_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subscriptions`
--
ALTER TABLE `tbl_subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD CONSTRAINT `tbl_documents_ibfk_1` FOREIGN KEY (`user_upload_id`) REFERENCES `tbl_users` (`user_id`),
  ADD CONSTRAINT `tbl_documents_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
