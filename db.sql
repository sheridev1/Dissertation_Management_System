-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 07:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `usprj` varchar(100) NOT NULL,
  `src` varchar(100) NOT NULL,
  `uploadedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `usprj`, `src`, `uploadedon`) VALUES
(27, 'supervisor_Project 223', 'logo (1).jpg', '2023-08-02 21:31:06'),
(30, 'supervisor_Project ', 'logo__1_-removebg-preview (1).png', '2023-08-02 22:03:27'),
(31, 'supervisor_Project ', 'logo (1).png', '2023-08-02 22:03:27'),
(32, 'supervisor_Project ', 'logo__1_-removebg-preview.png', '2023-08-02 22:03:27'),
(33, 'supervisor_Project ', 'logo (1).jpg', '2023-08-02 22:03:27'),
(34, 'supervisor_Project ', 'logo.jpg', '2023-08-02 22:03:27'),
(35, 'student_Project ', 'logo__1_-removebg-preview (1).png', '2023-08-02 22:04:43'),
(36, 'student_Project ', 'logo (1).png', '2023-08-02 22:04:43'),
(37, 'student_Project ', 'logo.png', '2023-08-02 22:04:43'),
(38, '_Project ', 'logo__1_-removebg-preview (1).png', '2023-08-02 22:20:18'),
(39, '_Project ', 'logo (1).png', '2023-08-02 22:20:18'),
(40, '_Project ', 'logo.png', '2023-08-02 22:20:18'),
(41, '_Project ', 'logo__1_-removebg-preview.png', '2023-08-02 22:20:18'),
(42, '_Project ', 'logo (1).jpg', '2023-08-02 22:20:18'),
(43, '_Project ', 'logo.jpg', '2023-08-02 22:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `date_sended` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_name` varchar(50) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `message_status` varchar(100) NOT NULL,
  `reciever_is_teacher` tinyint(1) NOT NULL,
  `sender_is_teacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `msg` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message_sent`
--

CREATE TABLE `message_sent` (
  `message_sent_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `date_sended` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_name` varchar(100) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_is_teacher` tinyint(1) NOT NULL,
  `reciever_is_teacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `pid` int(11) NOT NULL,
  `studentid` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `overview` longtext NOT NULL,
  `details` longtext NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `type` varchar(20) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT current_timestamp(),
  `type2` varchar(20) NOT NULL,
  `members` varchar(15) NOT NULL,
  `scope` varchar(10) NOT NULL,
  `projectfile` varchar(255) NOT NULL,
  `supervisorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pid`, `studentid`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`, `dateadded`, `type2`, `members`, `scope`, `projectfile`, `supervisorId`) VALUES
(62, 26, 'Project ', 'Engineering', 'Project ', 0, '8', '', 'kjb jn      ', 'members      ', 1, '', '2023-08-02', '2023-08-30', '2023-08-02 21:30:18', '', '26', 'Public', '_Project .zip', 8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `university` varchar(250) NOT NULL,
  `country` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` text NOT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `qualifications` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `lname`, `university`, `country`, `username`, `pass`, `regdate`, `img`, `approve`, `active`, `email`, `gender`, `qualifications`) VALUES
(26, 'student', '1', 'student', 'Pakistan', 'student', 'cd73502828457d15655bbd7a63fb0bc8', '2023-08-02 02:44:44', '../images/users/26student.jpg', 1, 1, 'student@gmail.com', 'male', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `university` varchar(250) NOT NULL,
  `country` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` text NOT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `qualifications` varchar(100) NOT NULL,
  `areaofinterest` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`fname`, `lname`, `university`, `country`, `username`, `pass`, `regdate`, `img`, `approve`, `active`, `email`, `gender`, `qualifications`, `areaofinterest`, `id`) VALUES
('supervisor', '1', 'supervisor', 'Pakistan', 'supervisor', '09348c20a019be0318387c08df7a783d', '2023-08-02 02:44:11', '../images/users/8supervisor.png', 1, 1, 'supervisor@gmail.com', 'male', 'supervisor', 'supervisor', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_sent`
--
ALTER TABLE `message_sent`
  ADD PRIMARY KEY (`message_sent_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message_sent`
--
ALTER TABLE `message_sent`
  MODIFY `message_sent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
