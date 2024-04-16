-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 04:16 AM
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
(111, 'Grade 11', 21, 'A', 79, 68, '2024-04-16'),
(112, 'Grade 11', 21, 'B', 79, 69, '2024-04-16');

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
(168, 58, 112, 79, '2024-04-16'),
(169, 59, 112, 79, '2024-04-16'),
(170, 60, 112, 79, '2024-04-16'),
(171, 61, 112, 79, '2024-04-16'),
(172, 62, 112, 79, '2024-04-16'),
(173, 63, 112, 79, '2024-04-16'),
(174, 64, 112, 79, '2024-04-16'),
(175, 65, 112, 79, '2024-04-16'),
(176, 66, 112, 79, '2024-04-16'),
(177, 67, 112, 79, '2024-04-16'),
(178, 48, 111, 79, '2024-04-16'),
(179, 49, 111, 79, '2024-04-16'),
(180, 50, 111, 79, '2024-04-16'),
(181, 51, 111, 79, '2024-04-16'),
(182, 52, 111, 79, '2024-04-16'),
(183, 53, 111, 79, '2024-04-16'),
(184, 54, 111, 79, '2024-04-16'),
(185, 55, 111, 79, '2024-04-16'),
(186, 56, 111, 79, '2024-04-16'),
(187, 57, 111, 79, '2024-04-16');

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
(169, 48, 79, 1020, 96, 111),
(170, 48, 79, 1021, 96, 111);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `sy_id` int(11) NOT NULL,
  `start_year` int(4) NOT NULL,
  `end_year` int(4) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`sy_id`, `start_year`, `end_year`, `semester`, `status`, `created_at`) VALUES
(79, 2024, 2025, 'First Semester', 'Active', '2024-04-16 09:58:42');

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

INSERT INTO `users` (`id`, `lrn_number`, `role`, `fname`, `lname`, `gender`, `birthday`, `contact`, `email`, `address`, `password`, `status`, `reg_date`) VALUES
(13, 'N/A', 'admin', 'Super', 'Admin', 'Male', '2009-01-29', '09813043186', 'admin@gmail.com', '2809 Ruskin Road', '123', 0, '2022-07-09'),
(48, '201915079', 'student', 'Roi', 'Badayos', 'Male', '1999-12-06', '09579046364', 'roibadayos@gmail.com', '3751 Forest Run Hill', 'roibadayos', 0, '2021-03-12'),
(49, '201915080', 'student', 'Maia', 'Chettoe', 'Female', '1999-07-29', '09365114462', 'maiachettoe@gmail.com', '7 Lerdahl Crossing', 'maiachettoe', 0, '2021-11-01'),
(50, '201915081', 'student', 'Sidnee', 'Luff', 'Male', '2002-05-25', '09580696997', 'sidneeluff@gmail.com', '9925 Hauk Drive', 'sidneeluff', 0, '2020-12-24'),
(51, '201915082', 'student', 'Julissa', 'Attree', 'Female', '2011-03-29', '09919056507', 'julissaattree@gmail.com', '742 La Follette Junction', 'julissaattree', 0, '2021-10-17'),
(52, '201915083', 'student', 'Sari', 'Sinderson', 'Female', '2011-01-19', '09209808962', 'sarisinderson@gmail.com', '639 Summerview Hill', 'sarisinderson', 0, '2024-02-11'),
(53, '201915084', 'student', 'Anitra', 'Sulman', 'Female', '2007-01-28', '09305726942', 'anitrasulman@gmail.com', '866 Reindahl Lane', 'anitrasulman', 0, '2022-04-23'),
(54, '201915085', 'student', 'Cecilio', 'Bateson', 'Male', '2000-05-27', '09443930766', 'ceciliobateson@gmail.com', '6087 David Parkway', 'ceciliobateson', 0, '2020-03-07'),
(55, '201915086', 'student', 'Rorke', 'Du Plantier', 'Male', '2018-09-20', '09081143104', 'rorkedu plantier@gmail.com', '8672 Caliangt Lane', 'rorkedu plantier', 0, '2022-12-22'),
(56, '201915087', 'student', 'Ashlee', 'Allnatt', 'Female', '2003-08-07', '09684359983', 'ashleeallnatt@gmail.com', '574 Burning Wood Parkway', 'ashleeallnatt', 0, '2023-03-02'),
(57, '201915088', 'student', 'Frederico', 'Heighway', 'Male', '2011-08-26', '09701684185', 'fredericoheighway@gmail.com', '01 Hanson Circle', 'fredericoheighway', 0, '2021-07-08'),
(58, '201915089', 'student', 'Arabelle', 'Brazer', 'Female', '2002-04-23', '09529547156', 'arabellebrazer@gmail.com', '86 Judy Street', 'arabellebrazer', 0, '2020-08-31'),
(59, '201915090', 'student', 'Anderson', 'Croxton', 'Male', '2002-11-01', '09238324930', 'andersoncroxton@gmail.com', '300 Wayridge Hill', 'andersoncroxton', 0, '2022-06-14'),
(60, '201915091', 'student', 'Kurtis', 'Franchi', 'Male', '2002-12-31', '09595590186', 'kurtisfranchi@gmail.com', '8 Petterle Street', 'kurtisfranchi', 0, '2022-11-16'),
(61, '201915092', 'student', 'Jared', 'Tuny', 'Male', '2013-08-13', '09902952494', 'jaredtuny@gmail.com', '9 Scott Lane', 'jaredtuny', 0, '2023-11-24'),
(62, '201915093', 'student', 'Lazaro', 'O\'Cannan', 'Male', '2018-06-07', '09881419531', 'lazaroo\'cannan@gmail.com', '43 Muir Court', 'lazaroo\'cannan', 0, '2020-09-27'),
(63, '201915094', 'student', 'Rosamond', 'Jovey', 'Female', '2020-01-10', '09091050196', 'rosamondjovey@gmail.com', '14 Sugar Hill', 'rosamondjovey', 0, '2021-06-11'),
(64, '201915095', 'student', 'Neilla', 'Paulo', 'Female', '2010-07-03', '09064122120', 'neillapaulo@gmail.com', '9903 Scott Circle', 'neillapaulo', 0, '2021-12-24'),
(65, '201915096', 'student', 'Dot', 'Daile', 'Female', '2007-03-12', '09534951530', 'dotdaile@gmail.com', '16300 Talmadge Circle', 'dotdaile', 0, '2023-05-02'),
(66, '201915097', 'student', 'Dulcia', 'Durtnel', 'Female', '2015-10-19', '09540561362', 'dulciadurtnel@gmail.com', '1564 Sunfield Terrace', 'dulciadurtnel', 0, '2023-01-04'),
(67, '201915098', 'student', 'Taddeo', 'Hurcombe', 'Male', '2013-02-15', '09832554098', 'taddeohurcombe@gmail.com', '342 Bultman Circle', 'taddeohurcombe', 0, '2020-04-17'),
(68, 'N/A', 'teacher', 'Lharens', 'Indus', 'Male', '1994-08-13', '09596577717', 'lharensindus@gmail.com', '65537 Mandrake Plaza', 'lharensindus', 0, '2021-05-05'),
(69, 'N/A', 'teacher', 'Ren', 'Dimabogte', 'Male', '1993-05-03', '09328439014', 'rendimabogte@gmail.com', '9778 Westport Road', 'rendimabogte', 0, '2022-09-09'),
(70, 'N/A', 'teacher', 'Neville', 'O\' Molan', 'Male', '2023-11-10', '09604315113', 'nevilleo\' molan@gmail.com', '09939 Armistice Crossing', 'nevilleo\' molan', 0, '2020-06-13'),
(71, 'N/A', 'teacher', 'Fern', 'Klinck', 'Female', '2022-02-13', '09274587814', 'fernklinck@gmail.com', '6 Kipling Hill', 'fernklinck', 0, '2020-08-31'),
(72, 'N/A', 'teacher', 'Carla', 'Joplin', 'Female', '2005-04-11', '09104965312', 'carlajoplin@gmail.com', '9 Novick Hill', 'carlajoplin', 0, '2020-11-09'),
(73, 'N/A', 'teacher', 'Roze', 'Baysting', 'Female', '2002-03-16', '09238815492', 'rozebaysting@gmail.com', '3587 Warrior Circle', 'rozebaysting', 0, '2022-03-28'),
(74, 'N/A', 'teacher', 'Monro', 'Fripps', 'Male', '2015-09-25', '09756933464', 'monrofripps@gmail.com', '19 Monica Junction', 'monrofripps', 0, '2020-12-24'),
(75, 'N/A', 'teacher', 'Valry', 'Pigden', 'Female', '2009-04-25', '09227836818', 'valrypigden@gmail.com', '34540 Talmadge Hill', 'valrypigden', 0, '2022-04-01'),
(76, 'N/A', 'teacher', 'Andras', 'Harmes', 'Male', '2013-12-18', '09051539457', 'andrasharmes@gmail.com', '48 Randy Road', 'andrasharmes', 0, '2024-01-18'),
(77, 'N/A', 'teacher', 'Susette', 'Alton', 'Female', '2002-11-26', '09921456652', 'susettealton@gmail.com', '425 Burning Wood Pass', 'susettealton', 0, '2023-11-27');

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
