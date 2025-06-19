-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 03:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmovies`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid` int(11) NOT NULL,
  `theaterid` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `timing` varchar(500) NOT NULL,
  `person` varchar(100) NOT NULL,
  `seats` text NOT NULL,
  `userid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `theaterid`, `booking_date`, `timing`, `person`, `seats`, `userid`, `status`) VALUES
(1, 8, '2025-06-26', '09:30', '5', 'G4,G5,G6,F6,E6', 2, 0),
(2, 8, '2025-06-26', '15:00', '3', 'D5,D6,D7', 2, 0),
(3, 9, '2025-06-24', '07:30', '2', 'D5,D6', 2, 0),
(4, 9, '2025-06-24', '12:30', '6', 'F5,F6,F7,D3,D2,D1', 2, 0),
(5, 7, '2025-06-20', '09:30', '5', 'D3,D4,D5,C3,C4', 2, 0),
(6, 7, '2025-06-20', '15:30', '7', 'E3,E4,D3,C2,H7,H8,H6', 2, 0),
(7, 6, '2025-06-22', '12:00', '6', 'H5,G5,F5,F6,G6,G7', 2, 1),
(8, 6, '2025-06-22', '17:30', '2', 'J4,J5', 2, 1),
(9, 1, '2025-06-22', '06:00', '3', 'G4,G5,G6', 6, 1),
(10, 5, '2025-06-24', '12:20', '5', 'F4,F5,E4,E5,D5', 6, 1),
(11, 4, '2025-06-25', '14:30', '4', 'D5,D6,D7,D8', 6, 1),
(12, 3, '2025-06-25', '12:30', '2', 'K5,K6', 6, 1),
(13, 2, '2025-06-22', '07:30', '6', 'K2,K3,J4,J5,J6,K7', 6, 1),
(14, 6, '2025-06-22', '12:00', '2', 'B5,B6', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
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
  `classid` int(11) NOT NULL,
  `classname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `release_date` date NOT NULL,
  `image` varchar(1000) NOT NULL,
  `trailer` varchar(1000) NOT NULL,
  `movie` varchar(1000) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `catid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieid`, `title`, `description`, `release_date`, `image`, `trailer`, `movie`, `rating`, `catid`) VALUES
(1, 'Animal', 'The son of a wealthy, powerful industrialist returns to India and undergoes a remarkable transformation as he becomes consumed by a quest for vengeance against those threatening his father\'s life.', '2025-06-25', 'animal.jpg', 'ANIMAL (OFFICIAL TRAILER)_ Ranbir Kapoor  Rashmika M, Anil K, Bobby D  Sandeep Vanga  Bhushan K.mp4', 'ANIMAL (OFFICIAL TRAILER)_ Ranbir Kapoor  Rashmika M, Anil K, Bobby D  Sandeep Vanga  Bhushan K.mp4', '6', 2),
(2, 'Fast X', 'Over many missions and against impossible odds, Dom Toretto and his family have outsmarted and outdriven every foe in their path. Now, they must confront the most lethal opponent they\'ve ever faced. Fueled by revenge, a terrifying threat emerges from the shadows of the past to shatter Dom\'s world and destroy everything -- and everyone -- he loves.', '2025-06-25', 'fast10.jpg', 'fast10.mp4', 'fast10.mp4', '8', 1),
(3, 'Ghampani', 'Childhood best friends Furba and Tara fall in love, but Tara\'s father wants her to marry someone else.', '2025-06-21', 'ghampani.jpg', 'GHAMPANI - New Nepali Movie Official Trailer 2017 Ft. Dayahang Rai, Keki Adhikari  Ultra 4K.mp4', 'GHAMPANI - New Nepali Movie Official Trailer 2017 Ft. Dayahang Rai, Keki Adhikari  Ultra 4K.mp4', '2', 3),
(4, 'Gladiator', 'Commodus takes over power and demotes Maximus, one of the preferred generals of his father, Emperor Marcus Aurelius. As a result, Maximus is relegated to fighting till death as a gladiator.', '2025-06-22', 'gladiator.jpg', 'GLADIATOR  Official Trailer  Paramount Movies.mp4', 'GLADIATOR  Official Trailer  Paramount Movies.mp4', '9', 1),
(5, 'Jawan', 'A man is driven by a personal vendetta to rectify the wrongs in society, while keeping a promise made years ago. He comes up against a monstrous outlaw with no fear, who has caused extreme suffering to many.', '2025-06-27', 'jawan.jpg', 'Jawan  Official Hindi Trailer  Shah Rukh Khan  Atlee  Nayanthara  Vijay S  Deepika P  Anirudh.mp4', 'Jawan  Official Hindi Trailer  Shah Rukh Khan  Atlee  Nayanthara  Vijay S  Deepika P  Anirudh.mp4', '6', 4),
(6, 'Oppenheimer', 'During World War II, Lt. Gen. Leslie Groves Jr. appoints physicist J. Robert Oppenheimer to work on the top-secret Manhattan Project. Oppenheimer and a team of scientists spend years developing and designing the atomic bomb. Their work comes to fruition on July 16, 1945, as they witness the world\'s first nuclear explosion, forever changing the course of history', '2025-06-21', 'oppenheimer.jpg', 'Oppenheimer  Official Trailer.mp4', 'Oppenheimer  Official Trailer.mp4', '9', 1),
(7, 'Jaari', 'Jaari is a 2023 Nepali social drama film written and directed by Upendra Subba. The film is produced by Ram Babu Gurung under the banner of Baasuri Films. Released on April 14, 2023, the film stars Dayahang Rai, Miruna Magar, Prem Subba, Bijay Baral, Roydeep Shrestha, and Rekha Limbu.', '2025-07-02', 'jaari.jpg', 'y2mate.com - JAARI  Nepali Movie Official Teaser  Dayahang Rai Miruna Magar Prem Subba Bijay Baral Rekha_v720P.mp4', 'y2mate.com - JAARI  Nepali Movie Official Teaser  Dayahang Rai Miruna Magar Prem Subba Bijay Baral Rekha_v720P.mp4', '4', 3),
(8, 'Pushpa 2: The Rule', 'A powerful smuggler goes head-to-head with a vengeful enemy while controlling politics and managing high-stakes confrontations. A public apology sparks a tense showdown, culminating in a challenge.', '2025-07-12', 'pushpa.jpg', 'y2mate.com - Pushpa 2 The Rule  Official Trailer  Allu Arjun Rashmika Mandanna  Netflix India_360P.mp4', 'y2mate.com - Pushpa 2 The Rule  Official Trailer  Allu Arjun Rashmika Mandanna  Netflix India_360P.mp4', '2', 4),
(9, 'Tamasha', 'Ved and Tara fall in love while on a holiday in Corsica and decide to keep their real identities undisclosed. Tara returns to Delhi and meets a new Ved, who is trying to discover his true self.', '2025-06-26', 'tamasha.jfif', 'y2mate.com - Tamasha Official Trailer  Ranbir Kapoor and Deepika Padukone  Sajid Nadiadwala  Imtiaz Ali_v720P.mp4', 'y2mate.com - Tamasha Official Trailer  Ranbir Kapoor and Deepika Padukone  Sajid Nadiadwala  Imtiaz Ali_v720P.mp4', '8', 2),
(10, 'Venom: The Last Dance', 'As Eddie and Venom are tirelessly pursued by forces from both of their worlds, they find themselves out of options and left with a shattering last resort.', '2025-06-21', 'venom3.jpg', 'y2mate.com - VENOM THE LAST DANCE  Official Trailer HD_v720P.mp4', 'y2mate.com - VENOM THE LAST DANCE  Official Trailer HD_v720P.mp4', '8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theaterid` int(11) NOT NULL,
  `theater_name` varchar(100) NOT NULL,
  `movieid` varchar(50) NOT NULL,
  `timing` varchar(50) NOT NULL,
  `timing2` varchar(500) NOT NULL,
  `timing3` varchar(50) NOT NULL,
  `timing4` varchar(50) NOT NULL,
  `days` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`theaterid`, `theater_name`, `movieid`, `timing`, `timing2`, `timing3`, `timing4`, `days`, `date`, `price`, `location`) VALUES
(1, 'Ranjhana Cineplex', '1', '06:00', '10:30', '12:00', '15:30', 'Sunday', '2025-06-22', 150, 'Kathmandu'),
(2, 'QFX Civil Mall', '2', '07:30', '10:30', '14:00', '20:00', 'Sunday', '2025-06-22', 200, 'Patan'),
(3, 'Movie Garden', '3', '09:30', '12:30', '16:00', '20:30', 'Wednesday', '2025-06-25', 200, 'Bhaktapur'),
(4, 'Ranjhana Cineplex', '4', '09:30', '12:00', '14:30', '21:00', 'Wednesday', '2025-06-25', 200, 'Kathmandu'),
(5, 'QFX Civil Mall', '5', '12:20', '14:00', '17:30', '20:00', 'Tuesday', '2025-06-24', 220, 'Kathmandu'),
(6, 'QFX Civil Mall', '6', '12:00', '15:00', '17:30', '21:30', 'Sunday', '2025-06-22', 200, 'Patan'),
(7, 'Movie Garden', '7', '09:30', '12:00', '15:30', '20:30', 'Friday', '2025-06-20', 150, 'Kathmandu'),
(8, 'QFX Labim Hall', '8', '09:30', '12:30', '15:00', '18:30', 'Thursday', '2025-06-26', 200, 'Patan'),
(9, 'QFX Labim Hall', '9', '07:30', '10:00', '12:30', '17:00', 'Tuesday', '2025-06-24', 250, 'Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_pw` varchar(100) NOT NULL,
  `roteype` int(11) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `date_of_birth` year(4) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `profile_pic` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`, `confirm_pw`, `roteype`, `phone_number`, `date_of_birth`, `gender`, `city`, `country`, `profile_pic`) VALUES
(1, 'admin', 'admin@gmail.com', '123', '', 1, '9876543323', '2000', 'Male', 'Delhi', 'India', ''),
(2, 'Ram Magar', 'ram@gmail.com', 'ram123', '', 2, '9812345667', '2000', 'Male', 'Patan', 'Nepal', '68428585dff7f.jpg'),
(3, 'Cristiano Ronaldo', 'ronaldo@gmail.com', 'ronaldo123', '', 2, '9876543332', '2004', 'Male', 'Bhaktapur', 'Nepal', '684285b65088a.jpg'),
(4, 'Lionel Messi', 'messi@gmail.com', 'messi123', '', 2, '9876554321', '2003', 'Male', 'Kathmandu', 'Nepal', '684285db6bef8.jpg'),
(5, 'Sita Kumari', 'sita@gmail.com', 'sita123', '', 2, '9873455567', '1999', 'Female', 'Kritipur', 'Nepal', '6842860577495.jpg'),
(6, 'Shyam Shrestha', 'shyam@gmail.com', 'shyam123', '', 2, '9877654453', '2002', 'Male', 'Patan', 'Nepal', '6842865f06f11.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `theaterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
