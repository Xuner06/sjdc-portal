-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 05:24 AM
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
(116, 'Grade 11', 21, '1', 79, 106, '2024-04-22'),
(117, 'Grade 11', 21, '2', 79, 107, '2024-04-22'),
(118, 'Grade 11', 21, '1', 80, 106, '2024-04-22'),
(119, 'Grade 11', 20, '1', 80, 107, '2024-04-22');

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
(212, 86, 116, 79, '2024-04-22'),
(213, 87, 116, 79, '2024-04-22'),
(214, 88, 116, 79, '2024-04-22'),
(215, 89, 116, 79, '2024-04-22'),
(216, 90, 116, 79, '2024-04-22'),
(217, 91, 116, 79, '2024-04-22'),
(218, 92, 116, 79, '2024-04-22'),
(219, 93, 116, 79, '2024-04-22'),
(220, 94, 116, 79, '2024-04-22'),
(221, 95, 116, 79, '2024-04-22'),
(222, 96, 117, 79, '2024-04-22'),
(223, 97, 117, 79, '2024-04-22'),
(224, 98, 117, 79, '2024-04-22'),
(225, 99, 117, 79, '2024-04-22'),
(226, 100, 117, 79, '2024-04-22'),
(227, 101, 117, 79, '2024-04-22'),
(228, 102, 117, 79, '2024-04-22'),
(229, 103, 117, 79, '2024-04-22'),
(230, 104, 117, 79, '2024-04-22'),
(231, 105, 117, 79, '2024-04-22');

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
(79, 2024, 2025, 'First Semester', 'Active', '2024-04-16 09:58:42'),
(80, 2024, 2025, 'Second Semester', 'Inactive', '2024-04-21 04:23:27');

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
(21, 'ICT', 'Information and Communication Technology', '2024-03-18'),
(24, 'TEST', 'test', '2024-04-18'),
(25, '123', '123', '2024-04-18'),
(26, 'WEWS', 'wew', '2024-04-19');

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
(1026, 'Personal Development', 'Grade 11', 21, 'Second Semester', '0000-00-00 00:00:00'),
(1028, 'Test', 'Grade 11', 20, 'First Semester', '0000-00-00 00:00:00'),
(1029, 'Test2', 'Grade 11', 20, 'Second Semester', '0000-00-00 00:00:00');

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
(86, '201915078011', 'student', 'Roi', 'Badayos', 'Male', '1999-12-06', '09381666941', 'roibadayos@gmail.com', '2117 Monument Parkway', 'roibadayos', 0, '2023-08-21'),
(87, '201915078012', 'student', 'Helaine', 'Calfe', 'Female', '1994-08-13', '09572272179', 'helainecalfe@gmail.com', '3 Center Pass', 'helainecalfe', 0, '2022-06-02'),
(88, '201915078013', 'student', 'Reggis', 'Wooler', 'Male', '1991-10-22', '09276999250', 'reggiswooler@gmail.com', '89 Westport Park', 'reggiswooler', 0, '2021-05-17'),
(89, '201915078014', 'student', 'Lizzie', 'Brittian', 'Female', '1997-05-03', '09468644998', 'lizziebrittian@gmail.com', '0137 Lotheville Point', 'lizziebrittian', 0, '2023-07-23'),
(90, '201915078015', 'student', 'Hagen', 'De Francesco', 'Male', '1991-11-06', '09773271875', 'hagende francesco@gmail.com', '506 Nevada Avenue', 'hagende francesco', 0, '2023-01-15'),
(91, '201915078016', 'student', 'Marco', 'Maciejewski', 'Male', '1992-05-08', '09239827986', 'marcomaciejewski@gmail.com', '7 Steensland Avenue', 'marcomaciejewski', 0, '2020-12-03'),
(92, '201915078017', 'student', 'Valentijn', 'Branton', 'Male', '1993-06-13', '09678537962', 'valentijnbranton@gmail.com', '7504 Hazelcrest Plaza', 'valentijnbranton', 0, '2023-01-23'),
(93, '201915078018', 'student', 'Udell', 'Dacre', 'Male', '1995-01-29', '09733426417', 'udelldacre@gmail.com', '593 Summit Place', 'udelldacre', 0, '2023-07-28'),
(94, '201915078019', 'student', 'Tynan', 'Pettingill', 'Male', '1993-12-12', '09710941915', 'tynanpettingill@gmail.com', '6 Little Fleur Hill', 'tynanpettingill', 0, '2021-01-21'),
(95, '201915078020', 'student', 'Llewellyn', 'Atley', 'Male', '1997-01-19', '09194960696', 'llewellynatley@gmail.com', '45 Clemons Pass', 'llewellynatley', 0, '2021-02-14'),
(96, '201915078021', 'student', 'Farrand', 'Miettinen', 'Female', '1994-04-10', '09967413624', 'farrandmiettinen@gmail.com', '64745 Gerald Lane', 'farrandmiettinen', 0, '2023-02-07'),
(97, '201915078022', 'student', 'Vernor', 'Anniwell', 'Male', '1992-04-29', '09187701720', 'vernoranniwell@gmail.com', '566 Clove Hill', 'vernoranniwell', 0, '2020-05-27'),
(98, '201915078023', 'student', 'Price', 'Astupenas', 'Male', '1996-11-04', '09503132280', 'priceastupenas@gmail.com', '211 Browning Circle', 'priceastupenas', 0, '2020-09-16'),
(99, '201915078024', 'student', 'Babbette', 'Wozencroft', 'Female', '1990-05-10', '09182894697', 'babbettewozencroft@gmail.com', '39 Luster Park', 'babbettewozencroft', 0, '2022-02-23'),
(100, '201915078025', 'student', 'Amelie', 'Ellum', 'Female', '1998-11-22', '09708056930', 'amelieellum@gmail.com', '93 Londonderry Trail', 'amelieellum', 0, '2020-12-09'),
(101, '201915078026', 'student', 'Pepita', 'Rumney', 'Female', '1998-05-07', '09393486708', 'pepitarumney@gmail.com', '75958 Pankratz Hill', 'pepitarumney', 0, '2023-10-18'),
(102, '201915078027', 'student', 'Jessalin', 'Nicklin', 'Female', '1991-06-07', '09831680510', 'jessalinnicklin@gmail.com', '736 Northfield Terrace', 'jessalinnicklin', 0, '2023-09-04'),
(103, '201915078028', 'student', 'Cordy', 'Gambie', 'Male', '1997-02-20', '09845821819', 'cordygambie@gmail.com', '5 Oak Way', 'cordygambie', 0, '2022-04-18'),
(104, '201915078029', 'student', 'Roseline', 'Eddis', 'Female', '1996-07-14', '09985800193', 'roselineeddis@gmail.com', '9 Eggendart Junction', 'roselineeddis', 0, '2023-02-03'),
(105, '201915078030', 'student', 'Brooks', 'Abelson', 'Female', '1990-12-16', '09682401812', 'brooksabelson@gmail.com', '2846 Reinke Alley', 'brooksabelson', 0, '2020-10-16'),
(106, 'N/A', 'teacher', 'Lharens', 'Indus', 'Male', '1990-03-26', '09070748329', 'lharensindus@gmail.com', '61772 Comanche Avenue', '123', 0, '2022-03-03'),
(107, 'N/A', 'teacher', 'Ren', 'Dimabogte', 'Male', '1991-01-09', '09699476662', 'rendimabogte@gmail.com', '33557 Arizona Court', 'rendimabogte', 0, '2023-06-23'),
(108, 'N/A', 'teacher', 'Moll', 'Leteve', 'Female', '1993-03-11', '09251153501', 'mollleteve@gmail.com', '15 Columbus Alley', 'mollleteve', 0, '2023-11-28'),
(109, 'N/A', 'teacher', 'Shae', 'Lyte', 'Male', '1997-01-05', '09405562879', 'shaelyte@gmail.com', '903 Mosinee Parkway', 'shaelyte', 0, '2023-10-19'),
(110, 'N/A', 'teacher', 'Bobine', 'Fleote', 'Female', '1995-04-15', '09450480279', 'bobinefleote@gmail.com', '5817 Florence Park', 'bobinefleote', 0, '2022-07-14'),
(111, 'N/A', 'teacher', 'Lothaire', 'Caukill', 'Male', '1996-05-02', '09921337833', 'lothairecaukill@gmail.com', '41 Village Crossing', 'lothairecaukill', 0, '2021-05-15'),
(112, 'N/A', 'teacher', 'Ramon', 'Garstang', 'Male', '1999-06-29', '09006928858', 'ramongarstang@gmail.com', '8409 Charing Cross Road', 'ramongarstang', 0, '2021-01-08'),
(113, 'N/A', 'teacher', 'Rafa', 'Dake', 'Female', '1996-05-19', '09926724307', 'rafadake@gmail.com', '0 Milwaukee Place', 'rafadake', 0, '2023-01-07'),
(114, 'N/A', 'teacher', 'Jorgan', 'Penton', 'Male', '1998-08-09', '09407892244', 'jorganpenton@gmail.com', '25 Fallview Way', 'jorganpenton', 0, '2023-09-27'),
(115, 'N/A', 'teacher', 'Adamo', 'Gregoli', 'Male', '1996-01-18', '09066619061', 'adamogregoli@gmail.com', '2753 Gina Hill', 'adamogregoli', 0, '2022-02-28');

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1030;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
