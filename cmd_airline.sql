-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 12:06 PM
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

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`id`, `name`, `model`, `passenger_capacity`, `status`) VALUES
(2, 'Airbus319', 'Boeing 747', 40, 'active'),
(3, 'Airbus321', 'Boeing 747', 85, 'active'),
(4, 'Airbus322', 'Boeing 777', 90, 'active'),
(5, 'test', '', 0, 'inactive'),
(7, 'test', 'Boeing 747', 85, 'active');

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

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_code`, `name`, `address`, `type`, `airport_status`) VALUES
('CVC', 'Cleve Airport', 'Cleve, South Australia, Australia', 'International', 'active'),
('LAM', 'Los Alamos County Airport', 'Los Alamos, New Mexico, United Statess', 'International', 'active'),
('LAX', 'Los Angeles International Airport', 'Los Angeles, California, United States', 'International', 'active'),
('MNL', 'Ninoy Aquino International Airport', 'Manila, Philippines', 'Local', 'active'),
('MRQ', 'Marinduque Airport', 'Marinduque Island, Philippines', 'Local', 'active'),
('SAM', 'New Airport', 'New Sample Address', 'International', 'inactive'),
('TAK', 'Takamatsu Airport', 'Takamatsu, Shikoku, Japan', 'International', 'active'),
('TBB', 'Dong Tac Airport', 'Tuy Hoa, Vietnam', 'International', 'active'),
('TCO', 'La Florida Airport', 'Tumaco, Colombia', 'International', 'active'),
('TCP', 'Taba International Airport', 'Taba, Egypt', 'International', 'active'),
('TDW', 'Tradewind Airport', 'Amarillo, Texas, United States', 'International', 'active'),
('TEL', 'Test Airport modify', 'Test', 'Local', 'inactive'),
('tes', 'test', 'test', 'International', 'inactive'),
('TES1', 'Test Airport mod', 'sample111', 'International', 'inactive'),
('testtt', 'test', 'test', 'Local', 'inactive'),
('THU', 'Thule Air Base', 'Pituffik, Greenland', 'International', 'active');

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

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `email`, `password`, `position`, `account_status`) VALUES
(1, 'jovi', '', 'isorena', '', 'admin@gmail.com', '$2y$10$h6uknYaNX7.Bm/h23SbLl.UD4gjWrREyP92s.bySr7mDOgJ.6oUHa', '1', 'active'),
(2, 'testadmi', '', 'adminnn', '', 'admin2@gmail.com', '$2y$10$UznUZRan2C8rtV1aUYy9I.FBjVGUdUsAV3bN6.hhYKXT8cq0Cnn8i', '1', 'active'),
(3, 'admin', 'admin', 'adminlast', '', 'admin3@gmail.com', '$2y$10$R9FQrZljcBW8JFI0lxiqTeL/tlYTS1M1LBeCxL1X1.klNE2ShyO2q', '1', 'active');

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

--
-- Dumping data for table `extra`
--

INSERT INTO `extra` (`id`, `type`, `name`, `description`, `price`, `extra_status`) VALUES
(1, 'Baggage', 'Prepaid Baggage 5KG', 'prepaid baggage 5kg', '40.00', 'active'),
(2, 'Baggage', 'Prepaid Baggage 10KG', 'prepaid baggage 10kg', '80.00', 'active'),
(3, 'Baggage', 'Prepaid Baggage 15KG', 'prepaid baggage 15kg', '120.00', 'active'),
(4, 'Baggage', 'Prepaid Baggage 20KG', 'prepaid baggage 20kg', '160.00', 'active'),
(5, 'Meal', 'Sushi Bento Box', 'bento box ', '8.00', 'active'),
(6, 'Meal', 'One Meal Pinoy Signature Meal', 'pinoy lang sakalam', '8.00', 'active'),
(7, 'Roaming Service', 'myPAL Roam 3Days', '3days roaming service', '24.00', 'active'),
(8, 'Roaming Service', 'myPAL Roam 5Days', '5days roaming service', '40.00', 'active'),
(9, 'Roaming Service', 'myPAL Roam 7Days', '7days roaming service', '56.00', 'active'),
(10, 'Roaming Service', 'myPAL Roam 10Days', '10days roaming service', '80.00', 'active'),
(11, 'Roaming Service', 'myPAL Roam 15Days', '15days roaming service', '120.00', 'active'),
(12, 'Roaming Service', 'myPAL Roam 20Days', '20days roaming service', '160.00', 'active'),
(13, 'Roaming Service', 'myPAL Roam 30Days', '30days roaming service', '240.00', 'active'),
(14, 'Baggage', 'tesss', 'tesst lamang', '100.00', 'active'),
(15, 'Baggage', 'test test', 'test test', '10.00', 'inactive'),
(16, 'Roaming Service', 'Sample Roam', 'Sample Only', '280.00', 'active');

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

--
-- Dumping data for table `fare`
--

INSERT INTO `fare` (`id`, `name`, `class`, `checked_baggage`, `flight_date_change`, `cancellation_before_depart`, `no_show_fee`, `mileage_accrual`, `fare_status`) VALUES
(1, 'Economy Supersaver', 'Economy', 'âœ“ with a FEE', '*No charge', 'âœ•', 'âœ•', 11, 'active'),
(2, 'Economy Saver', 'Economy', '10kg', '*No charge', 'âœ“ with a FEE', 'âœ“ with a FEE', 50, 'active'),
(3, 'Economy Value', 'Economy', '20kg on Jet services or 10kg on Q400 turbo prop aircraft', '*No charge', 'âœ“ with a FEE', 'âœ“ with a FEE', 75, 'active'),
(4, 'Economy Flex', 'Economy', '20kg on Jet services or 10kg on Q400 turbo prop aircraft', '*No charge', 'âœ“ with a FEE', 'âœ“ with a FEE', 100, 'active'),
(5, 'Test fare', 'Economy', 'âœ“ with a FEE', 'âœ“', 'âœ•', 'âœ•', 0, 'active'),
(6, 'Premium Economy', 'Premium Economy', '25kg', '*No charge', 'âœ“ with a FEE', 'âœ“ with a FEE', 100, 'active'),
(7, 'Business Value', 'Business', '30kg', '*No charge', 'âœ“ with a FEE', 'âœ“ with a FEE', 125, 'active'),
(8, 'Business Flex', 'Business', '35kg', 'âœ“', 'âœ“ with a FEE', 'âœ“ with a FEE', 150, 'active'),
(9, 'test fare', 'Premium Economy', 'âœ“ with a FEE', '*No charge', 'with a FEE', 'Yes', 13, 'active');

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

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_no`, `duration_minutes`, `airport_origin`, `airport_destination`, `type`, `flight_status`) VALUES
('11111', 125, 'TDW', 'LAM', 'International', 'active'),
('11114', 140, 'TAK', 'MNL', 'International', 'inactive'),
('11123', 120, 'LAX', 'MNL', 'International', 'active'),
('12134', 120, 'LAX', 'MNL', 'International', 'active'),
('12222', 170, 'TAK', 'TCO', 'International', 'active'),
('12345', 140, 'MNL', 'LAX', 'International', 'active'),
('55555', 150, 'MNL', 'MRQ', 'Local', 'active'),
('78888', 160, 'MNL', 'MRQ', 'Local', 'active'),
('85654', 1, 'LAM', 'LAX', 'International', 'active'),
('87667', 360, 'LAX', 'MNL', 'International', 'active'),
('PR1332', 300, 'MNL', 'MRQ', 'Local', 'active'),
('test', 69, 'CVC', 'LAM', 'International', 'inactive');

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

--
-- Dumping data for table `flight_extra`
--

INSERT INTO `flight_extra` (`id`, `flight_no`, `extra_id`, `status`) VALUES
(2, '11111', 2, 'active'),
(4, '11111', 3, 'active'),
(5, '11111', 4, 'active'),
(7, '11111', 5, 'active'),
(8, '11111', 6, 'active'),
(13, '11111', 7, 'active'),
(14, '11111', 8, 'active'),
(15, '11111', 9, 'active'),
(17, '11123', 2, 'active'),
(18, '11123', 5, 'active'),
(19, '11123', 10, 'active'),
(21, 'PR1332', 5, 'active'),
(22, 'PR1332', 6, 'active'),
(23, 'PR1332', 1, 'active'),
(24, 'PR1332', 2, 'active'),
(25, 'PR1332', 3, 'active'),
(26, 'PR1332', 7, 'active');

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

--
-- Dumping data for table `flight_fare`
--

INSERT INTO `flight_fare` (`id`, `flight_no`, `fare_id`, `price`, `available_slots`, `status`) VALUES
(1, '11111', 5, '900.00', 2, 'inactive'),
(2, '11111', 6, '2500.00', 20, 'active'),
(3, '11111', 8, '3700.00', 60, 'active'),
(4, '11111', 1, '1400.00', 10, 'active'),
(5, '11111', 3, '1500.00', 20, 'active'),
(6, '11111', 7, '3300.00', 20, 'active'),
(7, '11111', 2, '1200.00', 10, 'active'),
(8, '11123', 2, '1300.00', 20, 'active'),
(9, '11123', 7, '3000.00', 10, 'active'),
(10, '11111', 5, '140.00', 20, 'inactive'),
(11, 'PR1332', 1, '1300.00', 15, 'active'),
(12, 'PR1332', 2, '1600.00', 20, 'active'),
(13, 'PR1332', 3, '2000.00', 25, 'active'),
(14, 'PR1332', 6, '2500.00', 10, 'active'),
(15, 'PR1332', 8, '3000.00', 10, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `flight_reservation`
--

CREATE TABLE `flight_reservation` (
  `reservation_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
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

--
-- Dumping data for table `flight_schedule`
--

INSERT INTO `flight_schedule` (`schedule_id`, `flight_no`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `departure_time`, `gate`, `effective_start_date`, `effective_end_date`, `schedule_status`) VALUES
(1, '12345', 1, 1, 1, 1, 1, 1, 0, '05:30:00', 'A2', '2021-05-20', '2021-07-01', 'Scheduled'),
(2, '12222', 1, 0, 0, 0, 0, 0, 0, '18:00:00', 'A4', '2021-05-18', '2024-01-01', 'Scheduled'),
(3, '12345', 1, 1, 0, 0, 0, 0, 0, '08:00:00', 'L3', '2021-05-18', '2024-01-01', 'Scheduled'),
(4, '78888', 1, 0, 0, 0, 0, 0, 0, '12:00:00', 'L1', '2021-05-18', '2024-01-01', 'Scheduled'),
(5, '87667', 1, 1, 0, 0, 0, 0, 0, '09:00:00', 'J2', '2021-05-18', '2024-01-01', 'Scheduled'),
(6, '12345', 1, 0, 0, 0, 0, 0, 0, '17:42:00', 'A10', '2021-05-18', '2024-01-01', 'Scheduled'),
(7, '11111', 1, 1, 1, 1, 1, 1, 1, '03:00:00', 'L10', '2021-05-21', '2024-01-01', 'Delayed'),
(8, '11111', 1, 0, 0, 0, 0, 0, 0, '18:00:00', 'A14', '2021-05-18', '2024-01-01', 'Inactive'),
(9, '12222', 1, 1, 1, 0, 0, 0, 0, '00:30:00', 'A10', '2021-05-18', '2024-01-01', 'Scheduled'),
(10, '12345', 1, 1, 1, 0, 0, 0, 0, '22:40:00', 'L1', '2021-06-01', '2024-01-01', 'Inactive'),
(11, '11111', 1, 0, 0, 0, 0, 0, 1, '17:22:00', 'A18', '2021-05-25', '2024-01-01', 'Inactive'),
(12, '78888', 0, 0, 1, 0, 1, 0, 0, '11:25:00', 'A12', '2021-05-27', '2024-01-01', 'Scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `valid_id` varchar(50) NOT NULL,
  `valid_id_no` varchar(50) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
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
-- Table structure for table `scheduled_aircraft`
--

CREATE TABLE `scheduled_aircraft` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `aircraft_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scheduled_aircraft`
--

INSERT INTO `scheduled_aircraft` (`id`, `schedule_id`, `day`, `aircraft_id`, `layout_id`) VALUES
(1, 2, 'Monday', 2, 1),
(2, 9, 'Monday', 2, 1),
(3, 9, 'Tuesday', 2, 1),
(4, 9, 'Wednesday', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_seat`
--

CREATE TABLE `scheduled_seat` (
  `scheduled_seat_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `seat_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `seat_no` varchar(10) NOT NULL,
  `flight_no` varchar(10) NOT NULL,
  `class` varchar(30) NOT NULL,
  `seat_status` varchar(10) NOT NULL
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

--
-- Dumping data for table `seat_layout`
--

INSERT INTO `seat_layout` (`id`, `name`, `layout`, `aircraft_id`, `status`) VALUES
(1, 'TestLayout', '[[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"]]', 2, 'active'),
(2, 'TestLayout2', '[[\"3\",\"0\",\"3\",\"3\",\"0\",\"3\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"]]', 2, 'active'),
(3, 'TestLayout3', '[[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"]]', 2, 'active'),
(4, 'TestLayout4', '[[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"]]', 2, 'active'),
(5, 'f', '[[\"0\",\"3\",\"0\"],[\"0\",\"3\",\"0\"],[\"0\",\"3\",\"0\"]]', 2, 'active'),
(9, 'hehehe', '[[\"0\",\"1\",\"0\",\"0\"],[\"0\",\"1\",\"0\",\"0\"],[\"0\",\"1\",\"0\",\"0\"],[\"0\",\"1\",\"0\",\"0\"]]', 2, 'active'),
(10, 'Test2', '[[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"],[\"1\",\"0\",\"0\",\"0\",\"0\",\"1\"]]', 3, 'active'),
(11, 'SampleLayout1', '[[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"0\",\"3\",\"0\",\"0\",\"3\",\"0\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"0\",\"3\",\"0\",\"0\",\"3\",\"0\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"2\",\"0\",\"2\",\"2\",\"0\",\"2\"],[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"],[\"1\",\"0\",\"1\",\"1\",\"0\",\"1\"]]', 4, 'active');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `email`, `password`, `mobile_no`, `birthdate`, `account_status`) VALUES
(1, 'JOVI', 'JR.', 'ISORENA', '', 'JOVITO.ISORENA.JR@GMAIL.COM', '$2y$10$C4pjlTaDQ4OznRcKkmuQ5uAVsS2yCKk1wPmQKb762W4Y/YYJB6bXi', '09123456789', '2021-05-05', 'active'),
(2, 'jovito', 'briones', 'isorena', 'jr', 'jovi.freelance@gmail.com', '$2y$10$jZ6otoMN7Tnt9qnL6QKqjOzZcGBHC7Q76NHVA5KsUbg8kiKVIg/Oi', '0919233333', '1992-07-09', 'active'),
(3, 'dummy', 'dummy', 'dummy', '', 'dummy@gmail.com', '$2y$10$fepwKIO4puDgT3LOGZ9c6.YpKlnCUTE2A788Liv97HtepeiBNqT4e', '', '0000-00-00', 'active'),
(4, 'dada', 'briones', 'dsdsd', 'jr', 'dsdsdsds@dd.com', '$2y$10$fCYSttgbHS6DxqnCaNA28uVC0aiXVeMJekULzpPKPLSKaMW3Bf4mS', '09123131', '2002-02-12', 'active'),
(6, 'dada', 'briones', 'dsdsd', 'jr', 'dsdsdsds2@dd.com', '$2y$10$isUcdWBeFj0v.kfk9oYlmOxpS3VgLH7I/MeAGhxAxNjy3SMLZhhIi', '09123131', '2002-02-12', 'active'),
(7, 'jovi', 'briones', 'isorena', 'jr', 'jovi.freelance20@gmail.com', '$2y$10$RUrAs.vAuCW9UIaCouvkbu0HhkcHYEcL5eriQfQm1qXGdKSigC2Ty', '09123131', '1992-09-07', 'active'),
(8, 'jovito', 'briones', 'isorena', '', 'test@gmail.com', '$2y$10$IDLxXDt779tNu6T3XVUgV.4HDys7safStB55iqs9EUOUsLIjIk4rm', '0919233333', '2021-05-18', 'active'),
(9, 'First', 'Middle', 'Last', '', 'email@yahoo.com', '$2y$10$cnKI/yRGvM6avPK6mrgkcua.qg9Wt7b95uuSQAHKGYfiGiE0G5IGi', '0912343555', '2021-05-05', 'active');

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
-- Structure for view `vw_flight_info`
--
DROP TABLE IF EXISTS `vw_flight_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_flight_info`  AS  select `s`.`schedule_id` AS `schedule_id`,`s`.`flight_no` AS `flight_no`,`s`.`monday` AS `monday`,`s`.`tuesday` AS `tuesday`,`s`.`wednesday` AS `wednesday`,`s`.`thursday` AS `thursday`,`s`.`friday` AS `friday`,`s`.`saturday` AS `saturday`,`s`.`sunday` AS `sunday`,`s`.`departure_time` AS `departure_time`,`s`.`gate` AS `gate`,`s`.`effective_start_date` AS `effective_start_date`,`s`.`effective_end_date` AS `effective_end_date`,`s`.`schedule_status` AS `schedule_status`,`f`.`duration_minutes` AS `duration_minutes`,`f`.`airport_origin` AS `airport_origin`,(select `a`.`name` from `airport` `a` where `a`.`airport_code` = `f`.`airport_origin`) AS `origin_name`,(select `a`.`address` from `airport` `a` where `a`.`airport_code` = `f`.`airport_origin`) AS `origin_address`,`f`.`airport_destination` AS `airport_destination`,(select `a`.`name` from `airport` `a` where `a`.`airport_code` = `f`.`airport_destination`) AS `destination_name`,(select `a`.`address` from `airport` `a` where `a`.`airport_code` = `f`.`airport_destination`) AS `destination_address`,`f`.`type` AS `type`,`f`.`flight_status` AS `flight_status` from (`flight_schedule` `s` left join `flight` `f` on(`s`.`flight_no` = `f`.`flight_no`)) ;

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
  ADD KEY `schedule_id` (`schedule_id`),
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
  ADD KEY `seat_id` (`seat_id`);

--
-- Indexes for table `purchased_extra`
--
ALTER TABLE `purchased_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passenger_id` (`passenger_id`),
  ADD KEY `extra_id` (`extra_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `scheduled_aircraft`
--
ALTER TABLE `scheduled_aircraft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `aircraft_id` (`aircraft_id`),
  ADD KEY `layout_id` (`layout_id`);

--
-- Indexes for table `scheduled_seat`
--
ALTER TABLE `scheduled_seat`
  ADD PRIMARY KEY (`scheduled_seat_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_no` (`flight_no`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fare`
--
ALTER TABLE `fare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `flight_extra`
--
ALTER TABLE `flight_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `flight_fare`
--
ALTER TABLE `flight_fare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `scheduled_aircraft`
--
ALTER TABLE `scheduled_aircraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scheduled_seat`
--
ALTER TABLE `scheduled_seat`
  MODIFY `scheduled_seat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat_layout`
--
ALTER TABLE `seat_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `flight_reservation_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `flight_schedule` (`schedule_id`),
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
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `flight_reservation` (`reservation_id`),
  ADD CONSTRAINT `passenger_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `scheduled_seat` (`scheduled_seat_id`);

--
-- Constraints for table `purchased_extra`
--
ALTER TABLE `purchased_extra`
  ADD CONSTRAINT `purchased_extra_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`id`),
  ADD CONSTRAINT `purchased_extra_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`),
  ADD CONSTRAINT `purchased_extra_ibfk_3` FOREIGN KEY (`reservation_id`) REFERENCES `flight_reservation` (`reservation_id`);

--
-- Constraints for table `scheduled_aircraft`
--
ALTER TABLE `scheduled_aircraft`
  ADD CONSTRAINT `scheduled_aircraft_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `flight_schedule` (`schedule_id`),
  ADD CONSTRAINT `scheduled_aircraft_ibfk_2` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`),
  ADD CONSTRAINT `scheduled_aircraft_ibfk_3` FOREIGN KEY (`layout_id`) REFERENCES `seat_layout` (`id`);

--
-- Constraints for table `scheduled_seat`
--
ALTER TABLE `scheduled_seat`
  ADD CONSTRAINT `scheduled_seat_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `flight_schedule` (`schedule_id`),
  ADD CONSTRAINT `scheduled_seat_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`);

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`flight_no`) REFERENCES `flight` (`flight_no`);

--
-- Constraints for table `seat_layout`
--
ALTER TABLE `seat_layout`
  ADD CONSTRAINT `seat_layout_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
