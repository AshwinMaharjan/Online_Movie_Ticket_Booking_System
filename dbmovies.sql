-- phpMyAdmin SQL Dump
-- DBMovies - Database Schema (Structure Only)
-- All personal/sensitive data has been removed for public distribution.
-- --------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Database: `dbmovies`
-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid`    int(11) NOT NULL,
  `theaterid`    int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `timing`       varchar(500) NOT NULL,
  `person`       varchar(100) NOT NULL,
  `seats`        text NOT NULL,
  `userid`       int(11) NOT NULL,
  `status`       tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid`   int(11) NOT NULL,
  `catname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Reference data for table `category` (non-sensitive)
--

INSERT INTO `category` (`catid`, `catname`) VALUES
(1, 'Hollywood'),
(2, 'Bollywood'),
(3, 'Kollywood'),
(4, 'Tollywood'),
(5, 'Nollywood'),
(6, 'United Kingdom'),
(7, 'Cinema of China');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid`   int(11) NOT NULL,
  `classname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieid`      int(11) NOT NULL,
  `title`        varchar(100) NOT NULL,
  `description`  varchar(500) NOT NULL,
  `release_date` date NOT NULL,
  `image`        varchar(1000) NOT NULL,
  `trailer`      varchar(1000) NOT NULL,
  `movie`        varchar(1000) NOT NULL,
  `rating`       varchar(100) NOT NULL,
  `catid`        int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theaterid`    int(11) NOT NULL,
  `theater_name` varchar(100) NOT NULL,
  `movieid`      varchar(50) NOT NULL,
  `timing`       varchar(50) NOT NULL,
  `timing2`      varchar(500) NOT NULL,
  `timing3`      varchar(50) NOT NULL,
  `timing4`      varchar(50) NOT NULL,
  `days`         varchar(50) NOT NULL,
  `date`         date NOT NULL,
  `price`        int(11) NOT NULL,
  `location`     varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid`        int(11) NOT NULL,
  `name`          varchar(100) NOT NULL,
  `email`         varchar(100) NOT NULL,
  `password`      varchar(100) NOT NULL,
  `confirm_pw`    varchar(100) NOT NULL,
  `roteype`       int(11) NOT NULL,
  `phone_number`  varchar(100) NOT NULL,
  `date_of_birth` year(4) NOT NULL,
  `gender`        varchar(100) NOT NULL,
  `city`          varchar(100) NOT NULL,
  `country`       varchar(100) NOT NULL,
  `profile_pic`   varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ========================================================
-- PRIMARY KEYS & INDEXES
-- ========================================================

ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingid`);

ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieid`);

ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

-- ========================================================
-- AUTO_INCREMENT VALUES
-- ========================================================

ALTER TABLE `booking`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `class`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `movies`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `theater`
  MODIFY `theaterid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;