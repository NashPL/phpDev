-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2019 at 03:03 AM
-- Server version: 10.4.6-MariaDB-1:10.4.6+maria~bionic-log
-- PHP Version: 7.3.7-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpDev`
--
CREATE DATABASE IF NOT EXISTS `phpDev` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phpDev`;

-- --------------------------------------------------------

--
-- Table structure for table `phpDev_goods`
--

CREATE TABLE `phpDev_goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_per_item` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpDev_goods`
--

INSERT INTO `phpDev_goods` (`id`, `name`, `price_per_item`) VALUES
(1, 'Book 1', '30.00'),
(2, 'Book 2', '45.00');

-- --------------------------------------------------------

--
-- Table structure for table `phpDev_quote`
--

CREATE TABLE `phpDev_quote` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `json_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `phpDev_quote`
--

INSERT INTO `phpDev_quote` (`id`, `user_id`, `reference`, `json_data`) VALUES
(4, 2, 'd95e5ba566464cf824fb846a72eff39e', '{\"services\":[{\"hours\":0,\"date\":{\"name\":\"0\",\"date\":{\"day\":\"Monday\",\"time\":{\"from\":\"09:00\",\"till\":\"09:00\"},\"recurring\":\"1\"}},\"total\":0}],\"goods\":[{\"id\":1,\"name\":\"Book 1\",\"price_per_item\":\"30.00\",\"total\":0,\"quantity\":\"0\"},{\"id\":2,\"name\":\"Book 2\",\"price_per_item\":\"45.00\",\"total\":0,\"quantity\":\"0\"}],\"subscription\":{\"id\":1,\"name\":\"Subscription 1\",\"price_per_day\":\"25.00\",\"date\":\"07\\/02\\/2019 - 07\\/19\\/2019\",\"days\":14,\"total\":350},\"userEmail\":\"test@test.org\"}'),
(57, 3, 'f6e8d14f601db4b22cb1cd6437dea7c6', '{\"services\":[{\"hours\":0,\"data\":{\"name\":\"0\",\"date\":{\"day\":\"Monday\",\"time\":{\"from\":\"09:00\",\"till\":\"09:00\"},\"recurring\":\"1\"}},\"total\":0}],\"goods\":[{\"id\":1,\"name\":\"Book 1\",\"price_per_item\":\"30.00\",\"total\":300,\"quantity\":\"10\"},{\"id\":2,\"name\":\"Book 2\",\"price_per_item\":\"45.00\",\"total\":0,\"quantity\":\"0\"}],\"subscription\":{\"id\":1,\"name\":\"Subscription 1\",\"price_per_day\":\"25.00\",\"date\":\"07\\/02\\/2019 - 07\\/16\\/2019\",\"days\":11,\"total\":275},\"userEmail\":\"kb@kb.com\"}'),
(58, 4, '17517dafb18cf1dd8415edd891ade8e7', '{\"services\":[{\"hours\":2,\"data\":{\"name\":\"0\",\"date\":{\"day\":\"Monday\",\"time\":{\"from\":\"09:00\",\"till\":\"11:00\"},\"recurring\":\"1\"}},\"total\":0}],\"goods\":[{\"id\":1,\"name\":\"Book 1\",\"price_per_item\":\"30.00\",\"total\":0,\"quantity\":\"0\"},{\"id\":2,\"name\":\"Book 2\",\"price_per_item\":\"45.00\",\"total\":0,\"quantity\":\"0\"}],\"subscription\":{\"id\":1,\"name\":\"Subscription 1\",\"price_per_day\":\"25.00\",\"date\":\"07\\/12\\/2019 - 07\\/16\\/2019\",\"days\":3,\"total\":75},\"userEmail\":\"testingtest@test.com\"}');

-- --------------------------------------------------------

--
-- Table structure for table `phpDev_service`
--

CREATE TABLE `phpDev_service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_per_hour` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpDev_service`
--

INSERT INTO `phpDev_service` (`id`, `name`, `price_per_hour`) VALUES
(1, 'Service 1', '10.00'),
(2, 'Service 2', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `phpDev_subscription`
--

CREATE TABLE `phpDev_subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_per_day` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpDev_subscription`
--

INSERT INTO `phpDev_subscription` (`id`, `name`, `price_per_day`) VALUES
(1, 'Subscription 1', '25.00'),
(2, 'Subscription 2', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `phpDev_user`
--

CREATE TABLE `phpDev_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpDev_user`
--

INSERT INTO `phpDev_user` (`id`, `name`, `password`, `email_address`, `phone_number`) VALUES
(1, 'Test User 1', 'non encoded password', 'test@test.com', '+44123456789'),
(2, 'Mr Test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.org', '+1234'),
(3, 'Mr K B', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'kb@kb.com', '1234567890'),
(4, 'Mr Testing Test', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'testingtest@test.com', '1234sdl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phpDev_goods`
--
ALTER TABLE `phpDev_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpDev_quote`
--
ALTER TABLE `phpDev_quote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `phpDev_service`
--
ALTER TABLE `phpDev_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpDev_subscription`
--
ALTER TABLE `phpDev_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpDev_user`
--
ALTER TABLE `phpDev_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phpDev_goods`
--
ALTER TABLE `phpDev_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `phpDev_quote`
--
ALTER TABLE `phpDev_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `phpDev_service`
--
ALTER TABLE `phpDev_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `phpDev_subscription`
--
ALTER TABLE `phpDev_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `phpDev_user`
--
ALTER TABLE `phpDev_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `phpDev_quote`
--
ALTER TABLE `phpDev_quote`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `phpDev_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
