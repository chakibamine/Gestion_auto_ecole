-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 11:40 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_ae_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `role` varchar(80) DEFAULT 'user',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dossier`
--

CREATE TABLE `dossier` (
  `id` int(6) NOT NULL,
  `category` varchar(2) NOT NULL,
  `price` int(10) NOT NULL,
  `ref` int(6) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_user` varchar(50) NOT NULL,
  `student_id` int(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `resultat` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dossier`
--

INSERT INTO `dossier` (`id`, `category`, `price`, `ref`, `date_inscription`, `insert_user`, `student_id`, `status`, `resultat`) VALUES
(13, 'B', 1212, 111, '2024-01-04 18:24:51', '', 4, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(6) NOT NULL,
  `date_exam` date NOT NULL,
  `type_exam` varchar(25) NOT NULL,
  `resultat` varchar(1) NOT NULL DEFAULT '0',
  `date_insertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_user` varchar(50) DEFAULT NULL,
  `dossier_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `id` int(6) NOT NULL,
  `date_reg` date NOT NULL,
  `price` int(10) NOT NULL,
  `motif` varchar(50) NOT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_du_payeur` varchar(75) NOT NULL,
  `insert_user` varchar(50) NOT NULL,
  `dossier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(6) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `date_birth` date DEFAULT NULL,
  `place_birth` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `a_firstname` varchar(30) NOT NULL,
  `a_lastname` varchar(30) NOT NULL,
  `a_place_birth` varchar(50) NOT NULL,
  `a_address` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insert_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `gender`, `cin`, `firstname`, `lastname`, `date_birth`, `place_birth`, `address`, `city`, `phone`, `a_firstname`, `a_lastname`, `a_place_birth`, `a_address`, `reg_date`, `insert_user`) VALUES
(2, 'masculin', 'I4567', 'yasine', 'ouhadi', '2003-11-29', 'hjbhb', 'bbhbhb', 'hbbh', '0613951020', 'a', 'a', 'jhbj', 'hbhb', '2023-12-29 07:03:17', ''),
(3, 'feminin', 'I553555', 'hansa', 'chakib ', '1979-05-13', 'bm', 'bm ', 'bm ', '0666072805', 'hasna a', 'chakib a', 'bm a', 'bm a', '2023-12-30 17:09:43', ''),
(4, 'masculin', 'gjh', 'tgfcf', 'fgd', '2023-10-10', 'khkj', 'jhg', 'yujg', '0613951020', 'fx', 'gfdty', 'gvh', 'ukjgh', '2023-12-30 21:31:06', ''),
(5, 'masculin', 'i207240', 'mohamed', 'chakib', '1969-02-13', 'beni mellal', 'el massira 1 beni mellal', 'beni mellal', '0613951020', 'Ù…Ø­Ù…Ø¯', 'Ø´ÙƒÙŠØ¨', 'Ø¨Ù†ÙŠ Ù…Ù„Ø§Ù„', 'Ø§Ù„Ù…Ø³ÙŠØ±Ø© 1 Ø¨Ù†ÙŠ Ù…Ù„Ø§Ù„', '2023-12-31 19:19:51', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dossier_id` (`dossier_id`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dossier_id` (`dossier_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cin` (`cin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `fk_dossier_for_exam` FOREIGN KEY (`dossier_id`) REFERENCES `dossier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reg`
--
ALTER TABLE `reg`
  ADD CONSTRAINT `fk_dossier_for_reg` FOREIGN KEY (`dossier_id`) REFERENCES `dossier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
