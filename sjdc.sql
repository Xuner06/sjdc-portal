-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 07:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sjdc`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `level` varchar(10) NOT NULL,
  `strand` int(11) NOT NULL,
  `section` varchar(10) NOT NULL,
  `sy` int(11) NOT NULL,
  `adviser` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `level`, `strand`, `section`, `sy`, `adviser`, `created_at`) VALUES
(107, 'Grade 11', 21, 'A', 71, 24, '2024-03-25'),
(108, 'Grade 11', 21, 'B', 71, 25, '2024-03-25'),
(109, 'Grade 11', 21, 'A', 70, 24, '2024-03-25'),
(110, 'Grade 11', 21, 'B', 70, 25, '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `enroll_student`
--

CREATE TABLE `enroll_student` (
  `enroll_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `sy` int(11) NOT NULL,
  `enroll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll_student`
--

INSERT INTO `enroll_student` (`enroll_id`, `student_id`, `class`, `sy`, `enroll_date`) VALUES
(137, 14, 109, 70, '2024-03-25'),
(138, 15, 109, 70, '2024-03-25'),
(139, 16, 109, 70, '2024-03-25'),
(140, 23, 109, 70, '2024-03-25'),
(141, 22, 109, 70, '2024-03-25'),
(142, 21, 109, 70, '2024-03-25'),
(143, 18, 109, 70, '2024-03-25'),
(144, 17, 109, 70, '2024-03-25'),
(145, 20, 109, 70, '2024-03-25'),
(146, 19, 109, 70, '2024-03-25'),
(147, 34, 110, 70, '2024-03-25'),
(148, 35, 110, 70, '2024-03-25'),
(149, 36, 110, 70, '2024-03-25'),
(150, 37, 110, 70, '2024-03-25'),
(151, 38, 110, 70, '2024-03-25'),
(152, 39, 110, 70, '2024-03-25'),
(153, 40, 110, 70, '2024-03-25'),
(154, 41, 110, 70, '2024-03-25'),
(155, 43, 110, 70, '2024-03-25'),
(156, 42, 110, 70, '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `sy` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student`, `sy`, `subject`, `grade`, `class`) VALUES
(140, 14, 71, 1025, 71, 107),
(141, 15, 71, 1025, 95, 107),
(142, 15, 71, 1026, 98, 107),
(143, 16, 71, 1025, 95, 107),
(144, 16, 71, 1026, 84, 107),
(145, 17, 71, 1025, 96, 107),
(146, 17, 71, 1026, 73, 107),
(147, 18, 71, 1025, 56, 107),
(148, 18, 71, 1026, 50, 107),
(149, 19, 71, 1025, 94, 108),
(150, 19, 71, 1026, 94, 108),
(151, 20, 71, 1025, 81, 108),
(152, 20, 71, 1026, 88, 108),
(153, 21, 71, 1025, 91, 108),
(154, 21, 71, 1026, 91, 108),
(155, 22, 71, 1025, 91, 108),
(156, 22, 71, 1026, 90, 108),
(157, 23, 71, 1025, 91, 108),
(158, 23, 71, 1026, 90, 108),
(159, 14, 70, 1020, 60, 109),
(160, 14, 70, 1021, 82, 109),
(161, 15, 70, 1020, 99, 109),
(162, 15, 70, 1021, 57, 109),
(163, 16, 70, 1020, 51, 109),
(164, 16, 70, 1021, 60, 109),
(165, 34, 70, 1020, 51, 110),
(166, 34, 70, 1021, 51, 110);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `sy_id` int(11) NOT NULL,
  `start_year` int(4) NOT NULL,
  `end_year` int(4) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`sy_id`, `start_year`, `end_year`, `semester`, `status`, `created_at`) VALUES
(70, 2024, 2025, 'First Semester', 'Active', '2024-03-13 00:00:00'),
(71, 2024, 2025, 'Second Semester', 'Inactive', '2024-03-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `strand`
--

CREATE TABLE `strand` (
  `strand_id` int(11) NOT NULL,
  `strand` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strand`
--

INSERT INTO `strand` (`strand_id`, `strand`, `description`, `date_created`) VALUES
(16, 'HE', 'Home Economics Strand', '2024-03-14'),
(17, 'GAS', 'General Academic Strand', '2024-03-14'),
(18, 'ABM', 'Accountancy, Business and Management Strand', '2024-03-18'),
(19, 'STEM', 'Science, Technology, Engineering, and Mathematics Strand', '2024-03-18'),
(20, 'HUMMS', 'Humanities and Social Science Strand', '2024-03-18'),
(21, 'ICT', 'Information and Communication Technology', '2024-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `strand` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `level`, `strand`, `semester`, `created_at`) VALUES
(1018, 'General Mathematics', 'Grade 11', 18, 'First Semester', '0000-00-00 00:00:00'),
(1019, 'English', 'Grade 11', 16, 'First Semester', '0000-00-00 00:00:00'),
(1020, 'Oral Communication', 'Grade 11', 21, 'First Semester', '0000-00-00 00:00:00'),
(1021, 'Reading and Writing', 'Grade 11', 21, 'First Semester', '0000-00-00 00:00:00'),
(1022, 'Earth and Life Science', 'Grade 11', 18, 'First Semester', '0000-00-00 00:00:00'),
(1023, 'Media and Information Literacy', 'Grade 11', 16, 'Second Semester', '0000-00-00 00:00:00'),
(1024, 'Understanding Culture, Politics, and Society', 'Grade 11', 16, 'Second Semester', '0000-00-00 00:00:00'),
(1025, 'Statistics and Probability', 'Grade 11', 21, 'Second Semester', '0000-00-00 00:00:00'),
(1026, 'Personal Development', 'Grade 11', 21, 'Second Semester', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lrn_number` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(4) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lrn_number`, `role`, `fname`, `lname`, `gender`, `birthday`, `age`, `contact`, `email`, `address`, `password`, `status`, `reg_date`) VALUES
(13, 'N/A', 'admin', 'Super', 'Admin', 'Male', '2009-01-29', 15, '09813043186', 'admin@gmail.com', '2809 Ruskin Road', '123', 0, '2022-07-09'),
(14, '201915079', 'student', 'Roi', 'Badayos', 'Male', '2016-05-29', 8, '09561068396', 'roibadayos@gmail.com', '201 Fairview Street', '123', 0, '2023-02-17'),
(15, '201915080', 'student', 'Reyna', 'Jervois', 'Female', '2006-07-14', 18, '09973974666', 'reynajervois@gmail.com', '0470 Cambridge Lane', 'reynajervois', 0, '2023-10-02'),
(16, '201915081', 'student', 'Hali', 'Biddlecombe', 'Female', '2003-11-14', 21, '09251438760', 'halibiddlecombe@gmail.com', '12724 Autumn Leaf Park', 'halibiddlecombe', 0, '2023-12-06'),
(17, '201915082', 'student', 'Vic', 'Pedel', 'Male', '2017-05-26', 7, '09627577594', 'vicpedel@gmail.com', '69 Anderson Drive', 'vicpedel', 0, '2021-03-10'),
(18, '201915083', 'student', 'Tades', 'Matchett', 'Male', '2002-11-28', 22, '09252427204', 'tadesmatchett@gmail.com', '58 Manufacturers Parkway', 'tadesmatchett', 0, '2020-03-18'),
(19, '201915084', 'student', 'Katinka', 'Burchall', 'Female', '2008-09-27', 16, '09370605229', 'katinkaburchall@gmail.com', '2016 Laurel Trail', 'katinkaburchall', 0, '2020-06-26'),
(20, '201915085', 'student', 'Lezlie', 'Knappe', 'Female', '2005-12-13', 19, '09338206492', 'lezlieknappe@gmail.com', '2259 Fordem Terrace', 'lezlieknappe', 0, '2023-02-28'),
(21, '201915086', 'student', 'Louisa', 'Pittham', 'Female', '2010-06-01', 14, '09376358485', 'louisapittham@gmail.com', '4256 Derek Alley', 'louisapittham', 0, '2023-09-27'),
(22, '201915087', 'student', 'Nerte', 'Cottrell', 'Female', '2003-10-19', 21, '09177827556', 'nertecottrell@gmail.com', '40993 Vernon Pass', 'nertecottrell', 0, '2021-09-03'),
(23, '201915088', 'student', 'Jeanelle', 'Kharchinski', 'Female', '2001-05-25', 23, '09493561986', 'jeanellekharchinski@gmail.com', '21 Warrior Avenue', 'jeanellekharchinski', 0, '2022-04-06'),
(24, 'N/A', 'teacher', 'Lharens', 'Indus', 'Male', '2011-08-13', 13, '09537569843', 'lharensindus@gmail.com', '273 Clarendon Park', '123', 0, '2021-10-15'),
(25, 'N/A', 'teacher', 'Ren', 'Dimabogte', 'Female', '2015-07-21', 9, '09740023383', 'rendimabogte@gmail.com', '9 Crescent Oaks Alley', 'ren', 0, '2022-04-09'),
(26, 'N/A', 'teacher', 'Ibby', 'Plaskitt', 'Female', '2022-07-11', 2, '09442354703', 'ibbyplaskitt@gmail.com', '851 Meadow Valley Pass', 'ibbyplaskitt', 0, '2023-10-02'),
(27, 'N/A', 'teacher', 'Alexine', 'Shemming', 'Female', '2019-07-03', 5, '09619585763', 'alexineshemming@gmail.com', '4882 Bowman Way', 'alexineshemming', 0, '2021-02-05'),
(28, 'N/A', 'teacher', 'Towney', 'Kitlee', 'Male', '2009-04-27', 15, '09432234506', 'towneykitlee@gmail.com', '9701 Buell Street', 'towneykitlee', 0, '2022-08-25'),
(29, 'N/A', 'teacher', 'Maurie', 'Tinklin', 'Male', '2015-07-13', 9, '09220036287', 'maurietinklin@gmail.com', '44 Florence Plaza', 'maurietinklin', 0, '2020-04-26'),
(30, 'N/A', 'teacher', 'Andrey', 'Abelson', 'Male', '2005-09-30', 19, '09150143864', 'andreyabelson@gmail.com', '49 Graceland Park', 'andreyabelson', 0, '2023-08-15'),
(31, 'N/A', 'teacher', 'Torry', 'Hyndman', 'Male', '2020-11-24', 4, '09090167032', 'torryhyndman@gmail.com', '33092 Ilene Crossing', 'torryhyndman', 0, '2021-07-20'),
(32, 'N/A', 'teacher', 'Yelena', 'Goldstone', 'Female', '2019-01-20', 5, '09373190318', 'yelenagoldstone@gmail.com', '69 Annamark Place', 'yelenagoldstone', 0, '2021-12-04'),
(33, 'N/A', 'teacher', 'Junie', 'Mosey', 'Female', '2005-07-19', 19, '09600587641', 'juniemosey@gmail.com', '5094 Bultman Road', 'juniemosey', 0, '2020-08-05'),
(34, '201915089', 'student', 'Quinn', 'Imort', 'Male', '2011-08-08', 13, '09291869863', 'quinnimort@gmail.com', '1 Ilene Junction', 'quinnimort', 0, '2022-08-21'),
(35, '201915090', 'student', 'Jess', 'Farady', 'Female', '2011-09-11', 13, '09243862244', 'jessfarady@gmail.com', '73 Kings Lane', 'jessfarady', 0, '2022-06-09'),
(36, '201915091', 'student', 'Renado', 'Nockolds', 'Male', '2023-07-09', 1, '09807720146', 'renadonockolds@gmail.com', '21501 Walton Lane', 'renadonockolds', 0, '2022-12-22'),
(37, '201915092', 'student', 'Gaby', 'Branson', 'Female', '2006-01-10', 18, '09417170310', 'gabybranson@gmail.com', '0 Meadow Vale Hill', 'gabybranson', 0, '2021-07-17'),
(38, '201915093', 'student', 'Addia', 'Guyon', 'Female', '2005-12-28', 19, '09880990625', 'addiaguyon@gmail.com', '4316 Muir Center', 'addiaguyon', 0, '2020-09-01'),
(39, '201915094', 'student', 'Amelia', 'Charlton', 'Female', '2010-08-27', 14, '09463418523', 'ameliacharlton@gmail.com', '4 Waxwing Pass', 'ameliacharlton', 0, '2024-02-03'),
(40, '201915095', 'student', 'Marquita', 'Brandli', 'Female', '2005-12-04', 19, '09014675386', 'marquitabrandli@gmail.com', '544 Brickson Park Point', 'marquitabrandli', 0, '2023-02-14'),
(41, '201915096', 'student', 'Constantine', 'Flucker', 'Female', '2008-06-29', 16, '09580062279', 'constantineflucker@gmail.com', '867 Artisan Avenue', 'constantineflucker', 0, '2022-04-22'),
(42, '201915097', 'student', 'Freeland', 'Emmanuel', 'Male', '2003-11-21', 21, '09946987574', 'freelandemmanuel@gmail.com', '1889 Caliangt Junction', 'freelandemmanuel', 0, '2023-12-09'),
(43, '201915098', 'student', 'Bill', 'Jentzsch', 'Male', '2013-12-11', 11, '09839976063', 'billjentzsch@gmail.com', '6 Raven Park', 'billjentzsch', 0, '2023-11-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `sy` (`sy`),
  ADD KEY `strand` (`strand`),
  ADD KEY `adviser` (`adviser`);

--
-- Indexes for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD PRIMARY KEY (`enroll_id`),
  ADD KEY `enroll_student_ibfk_2` (`class`),
  ADD KEY `enroll_student_ibfk_3` (`sy`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`),
  ADD KEY `grade_ibfk_1` (`student`),
  ADD KEY `sy` (`sy`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `strand`
--
ALTER TABLE `strand`
  ADD PRIMARY KEY (`strand_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `strand` (`strand`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`sy`) REFERENCES `school_year` (`sy_id`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`strand`) REFERENCES `strand` (`strand_id`),
  ADD CONSTRAINT `class_ibfk_4` FOREIGN KEY (`adviser`) REFERENCES `users` (`id`);

--
-- Constraints for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD CONSTRAINT `enroll_student_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_student_ibfk_3` FOREIGN KEY (`sy`) REFERENCES `school_year` (`sy_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_student_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `grade_ibfk_3` FOREIGN KEY (`sy`) REFERENCES `school_year` (`sy_id`),
  ADD CONSTRAINT `grade_ibfk_4` FOREIGN KEY (`student`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `grade_ibfk_5` FOREIGN KEY (`class`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`strand`) REFERENCES `strand` (`strand_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
