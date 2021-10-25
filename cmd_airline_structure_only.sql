-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 02:50 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmd_airline`
--
CREATE DATABASE IF NOT EXISTS `cmd_airline` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cmd_airline`;

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `passenger_capacity` int(4) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `airport_code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `airport_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL,
  `account_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE `extra` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `extra_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fare`
--

CREATE TABLE `fare` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `checked_baggage` varchar(150) NOT NULL,
  `flight_date_change` varchar(50) NOT NULL,
  `cancellation_before_depart` varchar(50) NOT NULL,
  `no_show_fee` varchar(50) NOT NULL,
  `mileage_accrual` int(11) NOT NULL,
  `fare_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flight_no` varchar(10) NOT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `airport_origin` varchar(10) DEFAULT NULL,
  `airport_destination` varchar(10) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `flight_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flight_extra`
--

CREATE TABLE `flight_extra` (
  `id` int(11) NOT NULL,
  `flight_no` varchar(10) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flight_fare`
--

CREATE TABLE `flight_fare` (
  `id` int(11) NOT NULL,
  `flight_no` varchar(10) NOT NULL,
  `fare_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available_slots` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flight_reservation`
--

CREATE TABLE `flight_reservation` (
  `reservation_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `total_fare` decimal(10,2) NOT NULL,
  `cabin_class` varchar(30) NOT NULL,
  `creator_account_id` int(11) NOT NULL,
  `reservation_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flight_schedule`
--

CREATE TABLE `flight_schedule` (
  `schedule_id` int(11) NOT NULL,
  `flight_no` varchar(10) NOT NULL,
  `monday` tinyint(1) DEFAULT NULL,
  `tuesday` tinyint(1) DEFAULT NULL,
  `wednesday` tinyint(1) DEFAULT NULL,
  `thursday` tinyint(1) DEFAULT NULL,
  `friday` tinyint(1) DEFAULT NULL,
  `saturday` tinyint(1) DEFAULT NULL,
  `sunday` tinyint(1) DEFAULT NULL,
  `departure_time` time NOT NULL,
  `gate` varchar(10) NOT NULL,
  `effective_start_date` date NOT NULL,
  `effective_end_date` date DEFAULT NULL,
  `schedule_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `valid_id` varchar(50) NOT NULL,
  `valid_id_no` varchar(50) NOT NULL,
  `issuing_country` varchar(25) NOT NULL,
  `expiration_date` date NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `reserved_flight_id` int(11) NOT NULL,
  `passenger_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_extra`
--

CREATE TABLE `purchased_extra` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `purchased_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_flight`
--

CREATE TABLE `reserved_flight` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `fare_id` int(11) NOT NULL,
  `flight_date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_seat`
--

CREATE TABLE `reserved_seat` (
  `reserved_seat_id` int(11) NOT NULL,
  `reserved_flight_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `seat_number` varchar(5) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_aircraft`
--

CREATE TABLE `scheduled_aircraft` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `aircraft_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seat_layout`
--

CREATE TABLE `seat_layout` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `layout` longtext DEFAULT NULL,
  `aircraft_id` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `account_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_flight_info`
-- (See below for the actual view)
--
CREATE TABLE `vw_flight_info` (
`schedule_id` int(11)
,`flight_no` varchar(10)
,`monday` tinyint(1)
,`tuesday` tinyint(1)
,`wednesday` tinyint(1)
,`thursday` tinyint(1)
,`friday` tinyint(1)
,`saturday` tinyint(1)
,`sunday` tinyint(1)
,`departure_time` time
,`gate` varchar(10)
,`effective_start_date` date
,`effective_end_date` date
,`schedule_status` varchar(10)
,`duration_minutes` int(11)
,`airport_origin` varchar(10)
,`origin_name` varchar(100)
,`origin_address` varchar(200)
,`airport_destination` varchar(10)
,`destination_name` varchar(100)
,`destination_address` varchar(200)
,`type` varchar(20)
,`flight_status` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_flight_prices`
-- (See below for the actual view)
--
CREATE TABLE `vw_flight_prices` (
`schedule_id` int(11)
,`flight_no` varchar(10)
,`monday` tinyint(1)
,`tuesday` tinyint(1)
,`wednesday` tinyint(1)
,`thursday` tinyint(1)
,`friday` tinyint(1)
,`saturday` tinyint(1)
,`sunday` tinyint(1)
,`departure_time` time
,`gate` varchar(10)
,`effective_start_date` date
,`effective_end_date` date
,`schedule_status` varchar(10)
,`duration_minutes` int(11)
,`airport_origin` varchar(10)
,`origin_name` varchar(100)
,`origin_address` varchar(200)
,`airport_destination` varchar(10)
,`destination_name` varchar(100)
,`destination_address` varchar(200)
,`type` varchar(20)
,`flight_status` varchar(10)
,`id` int(11)
,`fare_id` int(11)
,`price` decimal(10,2)
,`available_slots` int(11)
,`status` varchar(10)
,`name` varchar(50)
,`class` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_flight_info`
--
DROP TABLE IF EXISTS `vw_flight_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_flight_info`  AS  select `s`.`schedule_id` AS `schedule_id`,`s`.`flight_no` AS `flight_no`,`s`.`monday` AS `monday`,`s`.`tuesday` AS `tuesday`,`s`.`wednesday` AS `wednesday`,`s`.`thursday` AS `thursday`,`s`.`friday` AS `friday`,`s`.`saturday` AS `saturday`,`s`.`sunday` AS `sunday`,`s`.`departure_time` AS `departure_time`,`s`.`gate` AS `gate`,`s`.`effective_start_date` AS `effective_start_date`,`s`.`effective_end_date` AS `effective_end_date`,`s`.`schedule_status` AS `schedule_status`,`f`.`duration_minutes` AS `duration_minutes`,`f`.`airport_origin` AS `airport_origin`,(select `a`.`name` from `airport` `a` where `a`.`airport_code` = `f`.`airport_origin`) AS `origin_name`,(select `a`.`address` from `airport` `a` where `a`.`airport_code` = `f`.`airport_origin`) AS `origin_address`,`f`.`airport_destination` AS `airport_destination`,(select `a`.`name` from `airport` `a` where `a`.`airport_code` = `f`.`airport_destination`) AS `destination_name`,(select `a`.`address` from `airport` `a` where `a`.`airport_code` = `f`.`airport_destination`) AS `destination_address`,`f`.`type` AS `type`,`f`.`flight_status` AS `flight_status` from (`flight_schedule` `s` left join `flight` `f` on(`s`.`flight_no` = `f`.`flight_no`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_flight_prices`
--
DROP TABLE IF EXISTS `vw_flight_prices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_flight_prices`  AS  select `s`.`schedule_id` AS `schedule_id`,`s`.`flight_no` AS `flight_no`,`s`.`monday` AS `monday`,`s`.`tuesday` AS `tuesday`,`s`.`wednesday` AS `wednesday`,`s`.`thursday` AS `thursday`,`s`.`friday` AS `friday`,`s`.`saturday` AS `saturday`,`s`.`sunday` AS `sunday`,`s`.`departure_time` AS `departure_time`,`s`.`gate` AS `gate`,`s`.`effective_start_date` AS `effective_start_date`,`s`.`effective_end_date` AS `effective_end_date`,`s`.`schedule_status` AS `schedule_status`,`f`.`duration_minutes` AS `duration_minutes`,`f`.`airport_origin` AS `airport_origin`,(select `a`.`name` from `airport` `a` where `a`.`airport_code` = `f`.`airport_origin`) AS `origin_name`,(select `a`.`address` from `airport` `a` where `a`.`airport_code` = `f`.`airport_origin`) AS `origin_address`,`f`.`airport_destination` AS `airport_destination`,(select `a`.`name` from `airport` `a` where `a`.`airport_code` = `f`.`airport_destination`) AS `destination_name`,(select `a`.`address` from `airport` `a` where `a`.`airport_code` = `f`.`airport_destination`) AS `destination_address`,`f`.`type` AS `type`,`f`.`flight_status` AS `flight_status`,`ff`.`id` AS `id`,`ff`.`fare_id` AS `fare_id`,`ff`.`price` AS `price`,`ff`.`available_slots` AS `available_slots`,`ff`.`status` AS `status`,`fr`.`name` AS `name`,`fr`.`class` AS `class` from (((`flight_schedule` `s` join `flight` `f`) join `flight_fare` `ff`) join `fare` `fr`) where `s`.`schedule_status` <> 'inactive' and `f`.`flight_status` <> 'inactive' and `ff`.`status` <> 'inactive' and `fr`.`fare_status` <> 'inactive' and `s`.`flight_no` = `f`.`flight_no` and `f`.`flight_no` = `ff`.`flight_no` and `ff`.`fare_id` = `fr`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`airport_code`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fare`
--
ALTER TABLE `fare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_no`),
  ADD KEY `airport_origin` (`airport_origin`),
  ADD KEY `airport_destination` (`airport_destination`);

--
-- Indexes for table `flight_extra`
--
ALTER TABLE `flight_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_no` (`flight_no`),
  ADD KEY `extra_id` (`extra_id`);

--
-- Indexes for table `flight_fare`
--
ALTER TABLE `flight_fare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_no` (`flight_no`),
  ADD KEY `fare_id` (`fare_id`);

--
-- Indexes for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `creator_account_id` (`creator_account_id`);

--
-- Indexes for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `flight_no` (`flight_no`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `pass_res_flight_ibfk_1` (`reserved_flight_id`);

--
-- Indexes for table `purchased_extra`
--
ALTER TABLE `purchased_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passenger_id` (`passenger_id`),
  ADD KEY `extra_id` (`extra_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reserved_flight`
--
ALTER TABLE `reserved_flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `reserved_seat`
--
ALTER TABLE `reserved_seat`
  ADD PRIMARY KEY (`reserved_seat_id`),
  ADD KEY `passenger_id` (`passenger_id`),
  ADD KEY `reserved_seat_ibfk_1` (`reserved_flight_id`);

--
-- Indexes for table `scheduled_aircraft`
--
ALTER TABLE `scheduled_aircraft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `aircraft_id` (`aircraft_id`),
  ADD KEY `layout_id` (`layout_id`);

--
-- Indexes for table `seat_layout`
--
ALTER TABLE `seat_layout`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `aircraft_id` (`aircraft_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fare`
--
ALTER TABLE `fare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flight_extra`
--
ALTER TABLE `flight_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flight_fare`
--
ALTER TABLE `flight_fare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchased_extra`
--
ALTER TABLE `purchased_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserved_flight`
--
ALTER TABLE `reserved_flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserved_seat`
--
ALTER TABLE `reserved_seat`
  MODIFY `reserved_seat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scheduled_aircraft`
--
ALTER TABLE `scheduled_aircraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat_layout`
--
ALTER TABLE `seat_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`airport_origin`) REFERENCES `airport` (`airport_code`),
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`airport_destination`) REFERENCES `airport` (`airport_code`);

--
-- Constraints for table `flight_extra`
--
ALTER TABLE `flight_extra`
  ADD CONSTRAINT `flight_extra_ibfk_1` FOREIGN KEY (`flight_no`) REFERENCES `flight` (`flight_no`),
  ADD CONSTRAINT `flight_extra_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`);

--
-- Constraints for table `flight_fare`
--
ALTER TABLE `flight_fare`
  ADD CONSTRAINT `flight_fare_ibfk_1` FOREIGN KEY (`flight_no`) REFERENCES `flight` (`flight_no`),
  ADD CONSTRAINT `flight_fare_ibfk_2` FOREIGN KEY (`fare_id`) REFERENCES `fare` (`id`);

--
-- Constraints for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  ADD CONSTRAINT `flight_reservation_ibfk_2` FOREIGN KEY (`creator_account_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  ADD CONSTRAINT `flight_schedule_ibfk_1` FOREIGN KEY (`flight_no`) REFERENCES `flight` (`flight_no`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `pass_res_flight_ibfk_1` FOREIGN KEY (`reserved_flight_id`) REFERENCES `reserved_flight` (`id`),
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `flight_reservation` (`reservation_id`);

--
-- Constraints for table `purchased_extra`
--
ALTER TABLE `purchased_extra`
  ADD CONSTRAINT `purchased_extra_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`id`),
  ADD CONSTRAINT `purchased_extra_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`),
  ADD CONSTRAINT `purchased_extra_ibfk_3` FOREIGN KEY (`reservation_id`) REFERENCES `flight_reservation` (`reservation_id`);

--
-- Constraints for table `reserved_flight`
--
ALTER TABLE `reserved_flight`
  ADD CONSTRAINT `reserved_flight_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `flight_reservation` (`reservation_id`),
  ADD CONSTRAINT `reserved_flight_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `flight_schedule` (`schedule_id`);

--
-- Constraints for table `reserved_seat`
--
ALTER TABLE `reserved_seat`
  ADD CONSTRAINT `reserved_seat_ibfk_1` FOREIGN KEY (`reserved_flight_id`) REFERENCES `reserved_flight` (`id`),
  ADD CONSTRAINT `reserved_seat_ibfk_2` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`id`);

--
-- Constraints for table `scheduled_aircraft`
--
ALTER TABLE `scheduled_aircraft`
  ADD CONSTRAINT `scheduled_aircraft_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `flight_schedule` (`schedule_id`),
  ADD CONSTRAINT `scheduled_aircraft_ibfk_2` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`),
  ADD CONSTRAINT `scheduled_aircraft_ibfk_3` FOREIGN KEY (`layout_id`) REFERENCES `seat_layout` (`id`);

--
-- Constraints for table `seat_layout`
--
ALTER TABLE `seat_layout`
  ADD CONSTRAINT `seat_layout_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
