-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 03:49 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(12, 'Development');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `images_id` int(11) NOT NULL,
  `image_1` text DEFAULT NULL,
  `image_2` text DEFAULT NULL,
  `image_3` text DEFAULT NULL,
  `image_4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`images_id`, `image_1`, `image_2`, `image_3`, `image_4`) VALUES
(26, 'uploads/project-1.png', 'uploads/project1b.png', 'uploads/project1c.png', 'uploads/project1d.png'),
(28, 'uploads/project2.webp', '', '', ''),
(29, 'uploads/project3.webp', '', '', ''),
(30, 'uploads/project4.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `members_id` int(11) NOT NULL,
  `name_1` varchar(200) DEFAULT NULL,
  `name_2` varchar(200) DEFAULT NULL,
  `name_3` varchar(200) DEFAULT NULL,
  `name_4` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`members_id`, `name_1`, `name_2`, `name_3`, `name_4`) VALUES
(24, '', '', '', ''),
(26, '', '', '', ''),
(27, '', '', '', ''),
(28, 'someone', 'someone', 'someone', 'someone');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `title_ar` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `progress` int(11) DEFAULT NULL,
  `adoption_authority` varchar(50) DEFAULT NULL,
  `documintation` text DEFAULT NULL,
  `approval` tinyint(1) DEFAULT NULL,
  `members_id` int(11) DEFAULT NULL,
  `images_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `title_ar`, `title_en`, `supervisor`, `description`, `progress`, `adoption_authority`, `documintation`, `approval`, `members_id`, `images_id`, `user_id`, `cat_id`) VALUES
(22, 'اداره مشاريع', 'project management ', 'Dr.Zaid ', 'to make the project management easy with this full responsive web application ', 100, '', NULL, 1, 24, 26, 10, 12),
(24, 'استطلاع', 'survey form', 'Dr.Saif', 'take your survey in just few second with web responsive design', 100, '', NULL, 1, 26, 28, 11, 12),
(25, 'المكتبة الإلكترونية', 'e-liberary', 'Dr.Mohammed', 'sell your book online with ', 100, '', NULL, 1, 27, 29, 12, 12),
(26, 'الطقس', 'weather ', 'someone', 'something about weather ', 40, '', NULL, 0, 28, 30, 13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `is_graduated` tinyint(1) DEFAULT NULL,
  `graduated_year` date DEFAULT NULL,
  `password` text DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `college`, `department`, `is_graduated`, `graduated_year`, `password`, `is_admin`) VALUES
(1, 'admin', NULL, 'admin@mail.ouk', '1', 'CS & IT', 'IT', 0, '0000-00-00', '1234', 1),
(10, 'ahmed', 'shaker', 'tyro@gmail.com', '07721391051', 'CS & IT', 'IT', 0, '0000-00-00', '1234', NULL),
(11, 'Ali', 'Sami', 'zicko@gmail.com', '2', 'CS & IT', 'IT', 0, '0000-00-00', '1234', NULL),
(12, 'Mohammed', 'Ali', 'Mohammed@gmail.com', '3', 'CS & IT', 'IT', 0, '0000-00-00', '1234', NULL),
(13, 'some', 'one', 'someone@gmail.com', '5', 'CS & IT', 'IT', 0, '0000-00-00', '1234', NULL),
(14, 'ali', '', 'ali@gmail.com', '6', 'CS & IT', 'IT', 0, '0000-00-00', '1234', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`images_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`members_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `fk_members` (`members_id`),
  ADD KEY `fk_images` (`images_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_cat` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `fk_images` FOREIGN KEY (`images_id`) REFERENCES `images` (`images_id`),
  ADD CONSTRAINT `fk_members` FOREIGN KEY (`members_id`) REFERENCES `members` (`members_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
