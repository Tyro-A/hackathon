-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:04 AM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`images_id`, `image_1`, `image_2`, `image_3`, `image_4`) VALUES
(26, 'uploads/project-1.png', 'uploads/project1b.png', 'uploads/project1c.png', 'uploads/project1d.png'),
(28, 'uploads/project2.webp', 'uploads/none.jpg', 'uploads/none.jpg', 'uploads/none.jpg'),
(29, 'uploads/project3.webp', 'uploads/unnamed.jpg', 'uploads/none.jpg', 'uploads/none.jpg'),
(30, 'uploads/project4.png', 'uploads/none.jpg', 'uploads/none.jpg', 'uploads/none.jpg'),
(41, 'uploads/1.png', 'uploads/2.png', 'uploads/3.png', 'uploads/4.png'),
(42, 'uploads/5355078977317889492.jpg', 'uploads/5354960818472610026.jpg', 'uploads/5355078977317889496.jpg', 'uploads/5355078977317889499.jpg'),
(43, 'uploads/14ff128a-d898-4dd6-9227-97ff5221e33e.jpeg', 'uploads/556fbc25-03e8-4fa7-938d-2cd2cf35bb80.jpeg', 'uploads/96f3540f-0551-451c-a31f-864dabbbd9f9.jpeg', 'uploads/none.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`members_id`, `name_1`, `name_2`, `name_3`, `name_4`) VALUES
(24, 'ali', 'sami', 'abdulameer', 'ali'),
(26, 'ahmed', 'shaker', 'hussain', 'muhammed'),
(27, 'mohammed', 'musa', 'adm', 'isacc'),
(28, 'someone', 'someone', 'someone', 'someone'),
(39, 'Zainab Hazem Hassan', 'bent alhuda assad abdulcareem', 'jabar', ''),
(40, 'Islam Amer Sharif ', ' Hanin Hassan Hadi', ' Nour Al-Hoda Louay Amin', ''),
(41, 'Abbas Fadhel Kazim', 'Dhu al-Fiqar Abdul Hussein Jalil', 'Murtada Mohammed Abdul Redha', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `title_ar`, `title_en`, `supervisor`, `description`, `progress`, `adoption_authority`, `documintation`, `approval`, `members_id`, `images_id`, `user_id`, `cat_id`) VALUES
(22, 'اداره مشاريع', 'project management ', 'Dr.Zaid ', 'to make the project management easy with this full responsive web application ', 100, '', NULL, 0, 24, 26, 10, 12),
(24, 'استطلاع', 'survey form', 'Dr.Saif', 'take your survey in just few second with web responsive design', 100, '', NULL, NULL, 26, 28, 11, 12),
(25, 'المكتبة الإلكترونية', 'e-liberary', 'Dr.Mohammed', 'An innovative online platform designed to transform the way people access, buy, and sell books. The E-Library provides a digital space where authors, publishers, and readers can connect seamlessly, fostering a vibrant community of literary enthusiasts.', 100, '', NULL, 1, 27, 29, 12, 12),
(26, 'الطقس', 'weather ', 'someone', 'something about weather ', 40, '', NULL, NULL, 28, 30, 13, 12),
(27, 'موقع (واصل) الذكي لخطوط نقل الطلاب والموظفين', 'Wasil smart website for student and employee trans', 'Eng. Ahmed Ali Karim', 'Wasil Smart Project provides a platform to organize daily transportation for students and staff to the University of Karbala, with dedicated lines and regular schedules to ensure a comfortable and safe means of transportation.', 64, '', NULL, 1, 39, 41, 14, 12),
(28, 'داري ', 'Dari ', 'Dr. A.M. Mohammed Mohsen Al-Abbadi', 'At Dary, we offer an innovative real estate experience that combines modern technology and smart solutions. We seek to facilitate the search for properties through artificial intelligence and provide specialized tools.\r\nOur services include:\r\n1. VR technology to display the property with furniture.\r\n2. Virtual reality to explore properties with 360 cameras.', 34, 'Al Zarifi Real Estate Company', NULL, 1, 40, 42, 15, 12),
(29, 'خدمة توصيل الوقود', 'FuelMate', 'Mr. Ali Mohammed Reda', 'Project Idea: A reliable fuel delivery service in Iraq, delivering fuel directly to the customer’s doorstep quickly and easily. With a focus on safety and customer satisfaction, the service aims to save users time and effort, while ensuring peace of mind. It is the ideal choice for convenience and reliability in fuel delivery.', 40, '', NULL, 1, 41, 43, 10, 12);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `college`, `department`, `is_graduated`, `graduated_year`, `password`, `is_admin`) VALUES
(1, 'admin', NULL, 'admin@gmail.com', '1', 'CS & IT', 'IT', 0, '0000-00-00', 'admin', 1),
(10, 'ahmed', 'shaker', 'user@gmail.com', '07721391051', 'CS & IT', 'IT', 0, '0000-00-00', 'user', NULL),
(11, 'Ali', 'Sami', 'user1@gmail.com', '2', 'CS & IT', 'IT', 0, '0000-00-00', 'user', NULL),
(12, 'Mohammed', 'Ali', 'user2@gmail.com', '3', 'CS & IT', 'IT', 0, '0000-00-00', 'user', NULL),
(13, 'some', 'one', 'user3@gmail.com', '5', 'CS & IT', 'IT', 0, '0000-00-00', 'user', NULL),
(14, 'ali', '', 'user4@gmail.com', '6', 'CS & IT', 'IT', 0, '0000-00-00', 'user', NULL),
(15, 'Zainab', 'Hazem', 'user5@gmail.com', '07711111111', 'cs&it', 'cs', 0, '0000-00-00', 'user', NULL);

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
  MODIFY `images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
