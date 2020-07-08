-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2020 at 04:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restapi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `100_branches`
--

CREATE TABLE `100_branches` (
  `id_100` int(11) NOT NULL,
  `name_100` varchar(255) NOT NULL,
  `status_100` int(11) NOT NULL DEFAULT 1,
  `created_on_100` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `100_branches`
--

INSERT INTO `100_branches` (`id_100`, `name_100`, `status_100`, `created_on_100`) VALUES
(2, 'Electronics and Communication Engineering', 1, '2020-03-08 05:29:11'),
(4, 'Information Technology', 1, '2020-03-08 05:29:50'),
(5, 'Civil Engineering', 1, '2020-03-08 05:46:44'),
(7, 'Computer Sience and Engineering', 1, '2020-03-09 09:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `150_students`
--

CREATE TABLE `150_students` (
  `id_150` int(11) NOT NULL,
  `branch_id_100_150` int(11) NOT NULL DEFAULT 0,
  `name_150` varchar(100) NOT NULL,
  `gender_150` varchar(25) NOT NULL,
  `mobile_150` varchar(10) NOT NULL,
  `password_150` varchar(255) NOT NULL,
  `email_150` varchar(40) NOT NULL,
  `address_150` text NOT NULL,
  `status_150` int(11) NOT NULL DEFAULT 1,
  `created_on_150` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `150_students`
--

INSERT INTO `150_students` (`id_150`, `branch_id_100_150`, `name_150`, `gender_150`, `mobile_150`, `password_150`, `email_150`, `address_150`, `status_150`, `created_on_150`) VALUES
(1, 4, 'Rahul kiku Dogia', 'Male', '8016124552', '30ed9fbe2dd2f9be136a8acde940621c', 'kumarsanjit2k140@gmail.com', 'Kolkata, West Bengal-700084', 1, '2020-03-08 06:32:46'),
(2, 4, 'Rahul Kumar Mahato', 'M', '8016342121', '$2y$10$LS.fobiB7oWZ1fym.hBiqukvn4n6s2a1w9oE6D/.oaJX.iqQHnLa2', 'kumarsanjit24@gmail.com', 'Kolkata, West Bengal-700084', 1, '2020-03-08 06:38:49'),
(4, 7, 'Sanjit Kumar Mahato', 'Male', '8016342323', '$2y$10$FLAWAqOnIfTlmzLXCsqk/euQEoiocfvLT8ELXs0xcxtg9jxUnMz9W', 'kumarsanjit2k14@gmail.com', 'Kolkata, West Bengal-700084', 1, '2020-03-09 09:53:33'),
(5, 4, 'Rowdy Rathor', 'Male', '8056348121', '$2y$10$0eT7NbrFVCMfeepxIGLeReSDBbAa0u4uPshuKup.sbwSa53zSzYjK', 'kumarsan8it2k30@gmail.com', 'Bengalore,Karnataka', 1, '2020-06-06 11:10:52'),
(6, 4, 'Rowdy Rathor', 'Male', '8056324812', '$2y$10$JTNrO5Zc.7MuE.zGLOsNIOGzB.UPooI6Ww9wYYI4h5cticuGoOgEK', 'kumarsan8i2t2k30@gmail.com', 'Bengalore,Karnataka', 1, '2020-06-06 11:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `200_semester_projects`
--

CREATE TABLE `200_semester_projects` (
  `id_200` int(11) NOT NULL,
  `student_id_150_200` int(11) NOT NULL DEFAULT 0,
  `title_200` varchar(200) DEFAULT NULL,
  `level_200` enum('beginner','intermediate','expert') NOT NULL,
  `description_200` text NOT NULL,
  `complete_days` int(11) NOT NULL,
  `semester_200` varchar(100) DEFAULT NULL,
  `status_200` int(11) NOT NULL DEFAULT 1,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `200_semester_projects`
--

INSERT INTO `200_semester_projects` (`id_200`, `student_id_150_200`, `title_200`, `level_200`, `description_200`, `complete_days`, `semester_200`, `status_200`, `created_on`) VALUES
(2, 1, 'Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia reiciendis', 'intermediate', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta. Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.', 15, 'Semester 5th', 1, '2020-03-08 15:39:27'),
(3, 2, 'Mess Management Sysytem', 'intermediate', 'This is description of the this project this description is optional!', 15, 'Semester 5th', 1, '2020-03-09 10:15:20'),
(4, 2, 'Face-off China-India at LAC in Galvan Velly', 'intermediate', 'This is description of the this project this description is optional!\r\nThis is description of the this project this description is optional!\r\n\r\nThis is description of the this project this description is optional!\r\n\r\n', 15, 'Semester 5th', 1, '2020-03-09 10:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `Student_Details`
-- (See below for the actual view)
--
CREATE TABLE `Student_Details` (
`id_150` int(11)
,`name_150` varchar(100)
,`name_100` varchar(255)
,`gender_150` varchar(25)
,`mobile_150` varchar(10)
,`email_150` varchar(40)
,`address_150` text
);

-- --------------------------------------------------------

--
-- Structure for view `Student_Details`
--
DROP TABLE IF EXISTS `Student_Details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Student_Details`  AS  select `t150`.`id_150` AS `id_150`,`t150`.`name_150` AS `name_150`,`t100`.`name_100` AS `name_100`,`t150`.`gender_150` AS `gender_150`,`t150`.`mobile_150` AS `mobile_150`,`t150`.`email_150` AS `email_150`,`t150`.`address_150` AS `address_150` from (`150_students` `t150` left join `100_branches` `t100` on(`t150`.`branch_id_100_150` = `t100`.`id_100`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `100_branches`
--
ALTER TABLE `100_branches`
  ADD PRIMARY KEY (`id_100`);

--
-- Indexes for table `150_students`
--
ALTER TABLE `150_students`
  ADD PRIMARY KEY (`id_150`);

--
-- Indexes for table `200_semester_projects`
--
ALTER TABLE `200_semester_projects`
  ADD PRIMARY KEY (`id_200`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `100_branches`
--
ALTER TABLE `100_branches`
  MODIFY `id_100` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `150_students`
--
ALTER TABLE `150_students`
  MODIFY `id_150` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `200_semester_projects`
--
ALTER TABLE `200_semester_projects`
  MODIFY `id_200` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
