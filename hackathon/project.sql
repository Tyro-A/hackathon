-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 08:35 AM
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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
