-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 07:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(1, 'Category 1'),
(2, 'Category 2'),
(3, 'Category 3'),
(4, 'Category 4');

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
(1, 'image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg'),
(2, 'image5.jpg', 'image6.jpg', 'image7.jpg', 'image8.jpg'),
(3, 'image9.jpg', 'image10.jpg', 'image11.jpg', 'image12.jpg'),
(4, 'image13.jpg', 'image14.jpg', 'image15.jpg', 'image16.jpg');

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
(1, 'Member 1', 'Member 2', 'Member 3', 'Member 4'),
(2, 'Member 5', 'Member 6', 'Member 7', 'Member 8'),
(3, 'Member 9', 'Member 10', 'Member 11', 'Member 12'),
(4, 'Member 13', 'Member 14', 'Member 15', 'Member 16');

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
(1, 'عنوان المشروع 1', 'Project Title 1', 'المشرف 1', 'وصف المشروع 1', 50, 'جهة التبني 1', 'توثيق المشروع 1', 1, 1, 1, 1, 1),
(2, 'عنوان المشروع 2', 'Project Title 2', 'المشرف 2', 'وصف المشروع 2', 75, 'جهة التبني 2', 'توثيق المشروع 2', 0, 2, 2, 2, 2),
(3, 'عنوان المشروع 3', 'Project Title 3', 'المشرف 3', 'وصف المشروع 3', 30, 'جهة التبني 3', 'توثيق المشروع 3', 1, 3, 3, 3, 3),
(4, 'عنوان المشروع 4', 'Project Title 4', 'المشرف 4', 'وصف المشروع 4', 90, 'جهة التبني 4', 'توثيق المشروع 4', 0, 4, 4, 4, 4);

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
(1, 'John', 'Doe', 'john.doe@example.com', '123456789', 'College A', 'Department X', 0, '2023-05-15', 'password1', NULL),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '987654321', 'College B', 'Department Y', 1, '2022-12-20', 'password2', NULL),
(3, 'Alice', 'Johnson', 'alice.j@example.com', '456789123', 'College C', 'Department Z', 0, '2024-01-10', 'password3', NULL),
(4, 'Bob', 'Brown', 'bob.brown@example.com', '369258147', 'College D', 'Department W', 1, '2021-08-05', 'password4', NULL);

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
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
