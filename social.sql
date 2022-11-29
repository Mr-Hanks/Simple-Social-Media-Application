-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 10:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--
CREATE DATABASE IF NOT EXISTS `social` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `social`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(64, 'How\'s it going?', 'collin', 'Test', '2022-11-25 15:18:22', 'no', 145),
(65, 'fgsdg', 'collin', 'collin', '2022-11-25 15:33:08', 'no', 152);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(115, 'collin', 145),
(120, 'collin', 152);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `date_added`, `deleted`, `likes`) VALUES
(105, 'hi', 'collin', '2022-11-23 04:45:58', 'no', 0),
(143, 'hey', 'collin', '2022-11-25 14:51:28', 'no', 0),
(145, 'Hey, what\'s up guys?', 'Test', '2022-11-25 15:09:02', 'no', 1),
(146, 'What did y\'all do today? ', 'Test', '2022-11-25 15:10:03', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `profile_pic`, `num_posts`, `num_likes`, `friend_array`) VALUES
(7, 'Collin', 'Hanks', 'collin', 'collinnhankss@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'images/profile_pics/head_red.png', 65, 7, ',Test,'),
(13, 'Test', 'User', 'Test', 'testuser@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'images/profile_pics/head_deep_blue.png', 2, 1, ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
