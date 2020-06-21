-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2020 at 03:25 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` bigint(20) NOT NULL,
  `id_project` bigint(20) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_project`, `comment`, `id_user`, `created_date`, `updated_date`) VALUES
(1, 0, 'testing', 4, '2020-05-20', '0000-00-00'),
(2, 23, 'test', 4, '2020-05-20', '0000-00-00'),
(3, 0, 'test', 3, '2020-05-23', '0000-00-00'),
(4, 0, '0', 0, '2020-05-23', '0000-00-00'),
(5, 31, 'test', 3, '2020-05-23', '0000-00-00'),
(6, 31, 'comment', 3, '2020-05-23', '0000-00-00'),
(7, 31, 'loh kok', 3, '2020-05-23', '0000-00-00'),
(8, 31, 'satu', 3, '2020-05-23', '0000-00-00'),
(9, 31, 'dua', 3, '2020-05-23', '0000-00-00'),
(10, 31, 'tiga', 3, '2020-05-23', '0000-00-00'),
(11, 31, 'test satu', 4, '2020-05-23', '0000-00-00'),
(12, 31, 'test dua', 4, '2020-05-23', '0000-00-00'),
(13, 33, 'satu', 4, '2020-05-23', '0000-00-00'),
(14, 33, 'dua', 4, '2020-05-23', '0000-00-00'),
(15, 33, 'tiga', 4, '2020-05-23', '0000-00-00'),
(16, 33, 'empat', 4, '2020-05-23', '0000-00-00'),
(17, 33, 'hi', 1, '2020-05-23', '0000-00-00'),
(18, 33, 'nyoba', 4, '2020-05-23', '0000-00-00'),
(19, 33, 'aja', 3, '2020-05-23', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` bigint(20) NOT NULL,
  `nama_product` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `nama_product`, `created_date`, `updated_date`, `description`) VALUES
(1, 'MOTORCYCLE', '2020-03-27', '2020-05-23', '---Brief descriptions about the product---'),
(2, 'LIFE', '2020-03-28', '2020-05-23', '---Brief descriptions about the product---'),
(4, 'MAID', '2020-04-26', '2020-05-23', '---Brief descriptions about the product---'),
(5, 'CAR', '2020-04-26', '2020-05-23', '---Brief descriptions about the product---'),
(6, 'TRAVEL', '2020-05-23', '2020-05-23', '---Brief descriptions about the product---');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` bigint(20) NOT NULL,
  `nama_project` varchar(200) NOT NULL,
  `description` varchar(60000) NOT NULL,
  `id_product` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `release` varchar(10) DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `files` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `nama_project`, `description`, `id_product`, `start_date`, `end_date`, `created_date`, `updated_date`, `status`, `release`, `created_by`, `files`) VALUES
(30, 'Title 1', '<p>testung alala gh</p>\n', 1, '2020-03-01', '2020-04-22', '2020-05-23', '2020-06-04', 2, NULL, 3, '30-90-1-SM.pdf'),
(31, 'Title 2', '<p style=\"text-align:justify\">In Singapore, FWD aims to change the way people feel about insurance by leveraging technology to deliver products that are relevant, easy to understand and well-priced. Our portfolio includes group insurance and a direct-to-consumer business focusing on life and general insurance.</p>\n\n<p style=\"text-align:justify\">Our group insurance business provides companies with cost-effective employee benefit solutions to over 80,000 members. We are the fifth largest group medical insurer in Singapore with a strong track record across a diverse range of industries. FWD will continue to expand its footprint and reach to corporations in Singapore with a focus on offering customers a differentiated client experience through a robust medical network and excellent service levels.</p>\n\n<p style=\"text-align:justify\">Our direct-to-consumer business provides life and general insurance for individuals. At FWD, we believe that insurance doesn&rsquo;t need to be complex, sold through expensive middlemen, or take up vast amounts of your time.</p>\n\n<p style=\"text-align:justify\">A customer-led brand, we are constantly developing new products for individuals and businesses alike, with the aim to help our customers embrace and celebrate every day, and feel safe and secure knowing that FWD has their back if something unexpected happens</p>\n', 1, '2020-02-17', '2020-04-15', '2020-05-23', '2020-06-04', 2, '1.0', 4, ''),
(32, 'Title 3', '<p>kkasbfkadbkfbad</p>\n', 2, '2020-04-29', '2020-05-02', '2020-05-23', '2020-06-04', 2, NULL, 3, ''),
(33, 'Title 4', '<p>stesting title 4<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p>In Singapore, FWD aims to change the way people feel about insurance by leveraging technology to deliver products that are relevant, easy to understand and well-priced. Our portfolio includes group insurance and a direct-to-consumer business focusing on life and general insurance.</p>\r\n\r\n<p>Our group insurance business provides companies with cost-effective employee benefit solutions to over 80,000 members. We are the fifth largest group medical insurer in Singapore with a strong track record across a diverse range of industries. FWD will continue to expand its footprint and reach to corporations in Singapore with a focus on offering customers a differentiated client experience through a robust medical network and excellent service levels.</p>\r\n\r\n<p>Our direct-to-consumer business provides life and general insurance for individuals. At FWD, we believe that insurance doesn&rsquo;t need to be complex, sold through expensive middlemen, or take up vast amounts of your time.</p>\r\n\r\n<p>A customer-led brand, we are constantly developing new products for individuals and businesses alike, with the aim to help our customers embrace and celebrate every day, and feel safe and secure knowing that FWD has their back if something unexpected happens.</p>\r\n', 5, '2020-05-01', '2020-05-30', '2020-05-23', '2020-06-04', 2, NULL, 4, '26-Article Text-60-1-10-20171129.pdf'),
(36, 'Title 4', '<p>lalaalla</p>\n', 5, '2020-05-24', '2020-06-06', '2020-05-23', '2020-06-04', 1, NULL, 4, ''),
(39, 'Title 5', '<p>Title 5</p>\r\n', 5, '2020-05-01', '2020-05-30', '2020-05-24', '2020-06-04', 2, NULL, 3, '47-95-1-PB.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `team` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `team`, `position`, `role`, `created_date`, `updated_date`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Tejo', 'admin@gmail.com', 'IT', 'Admin', 1, '2020-01-26', '2020-05-23'),
(3, 'staff', '827ccb0eea8a706c4c34a16891f84e7b', 'lina', 'staff@gmail.com', 'IT', 'Non Supervisor', 3, '2020-02-27', '2020-05-23'),
(4, 'supervisor', '827ccb0eea8a706c4c34a16891f84e7b', 'Manik', 'supervisor@gmail.com', 'IT', 'Supervisor', 2, '2020-03-23', '2020-05-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
