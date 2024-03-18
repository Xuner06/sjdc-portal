-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 04:23 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fname`, `lname`, `gender`, `birthday`, `age`, `contact`, `email`, `address`, `password`, `date_created`) VALUES
(1, 'Super', 'Admin', 'Male', '1999-03-03', 24, '09284310661', 'admin@gmail.com', 'Tanza, Cavite', 'superadmin', '2024-03-14');

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
(100, 'Grade 11', 21, 'A', 70, 59, '2024-03-18');

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

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `sy` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `grade` int(11) NOT NULL
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
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `lrn_number` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `lrn_number`, `fname`, `lname`, `gender`, `birthday`, `age`, `contact`, `email`, `address`, `password`, `status`, `reg_date`) VALUES
(49, '201915079', 'Roi', 'Badayos', 'Male', '2007-01-15', 24, '09364218046', 'roibadayos@gmail.com', '499 Surrey Pass', 'roibadayos', 0, '2023-07-31'),
(50, '201915080', 'Hubert', 'Geertje', 'Male', '2001-07-04', 23, '09800036715', 'hubertgeertje@gmail.com', '73898 Continental Place', 'hubertgeertje', 0, '2023-10-23'),
(51, '201915081', 'Bamby', 'Melburg', 'Female', '2017-01-16', 7, '09342079186', 'bambymelburg@gmail.com', '094 Sunbrook Plaza', 'bambymelburg', 0, '2023-12-03'),
(52, '201915082', 'Tony', 'Hannis', 'Female', '2008-09-13', 16, '09650990623', 'tonyhannis@gmail.com', '3 Carey Court', 'tonyhannis', 0, '2023-06-27'),
(53, '201915083', 'Andrew', 'Braiden', 'Male', '2023-12-19', 1, '09672252063', 'andrewbraiden@gmail.com', '77201 Ruskin Way', 'andrewbraiden', 0, '2024-01-11'),
(54, '201915084', 'Lilllie', 'Crisp', 'Female', '2021-03-09', 3, '09321572428', 'lillliecrisp@gmail.com', '26952 Sloan Parkway', 'lillliecrisp', 0, '2024-02-07'),
(55, '201915085', 'Mona', 'Wardhaugh', 'Female', '2013-08-12', 11, '09510888792', 'monawardhaugh@gmail.com', '682 Hoffman Circle', 'monawardhaugh', 0, '2023-04-01'),
(56, '201915086', 'Karlyn', 'Lisciandri', 'Female', '2023-03-14', 1, '09731272370', 'karlynlisciandri@gmail.com', '004 Hazelcrest Junction', 'karlynlisciandri', 0, '2023-04-16'),
(57, '201915087', 'Deedee', 'Paulich', 'Female', '2010-11-30', 14, '09367316449', 'deedeepaulich@gmail.com', '6 West Place', 'deedeepaulich', 0, '2023-07-22'),
(58, '201915088', 'Giacomo', 'Wheble', 'Male', '2018-03-01', 6, '09630471187', 'giacomowheble@gmail.com', '400 Menomonie Crossing', 'giacomowheble', 0, '2023-07-26');

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
(1022, 'Earth and Life Science', 'Grade 11', 18, 'First Semester', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `fname`, `lname`, `gender`, `birthday`, `age`, `contact`, `email`, `address`, `password`, `status`, `reg_date`) VALUES
(59, 'Lharens', 'Indus', 'Male', '2023-04-04', 1, '09159684468', 'lharensindus@gmail.com', '98437 Morning Junction', 'lharensindus', 0, '2023-11-07'),
(60, 'Roldan', 'Godmar', 'Male', '2014-02-23', 10, '09703476841', 'roldangodmar@gmail.com', '6 Mallory Pass', 'roldangodmar', 0, '2023-11-12'),
(61, 'Keane', 'Garvie', 'Male', '2017-10-03', 7, '09989117648', 'keanegarvie@gmail.com', '3669 Pankratz Point', 'keanegarvie', 0, '2023-03-19'),
(62, 'Mame', 'Trillo', 'Female', '1999-05-14', 25, '09679497694', 'mametrillo@gmail.com', '617 Washington Terrace', 'mametrillo', 0, '2023-10-15'),
(63, 'Loreen', 'Creagh', 'Female', '2009-12-24', 15, '09524133854', 'loreencreagh@gmail.com', '1 Milwaukee Trail', 'loreencreagh', 0, '2023-08-02'),
(64, 'Kariotta', 'Streetley', 'Female', '2016-04-01', 8, '09841650139', 'kariottastreetley@gmail.com', '73013 Steensland Terrace', 'kariottastreetley', 0, '2024-01-15'),
(65, 'Jacob', 'Wagner', 'Male', '2004-02-01', 20, '09275789585', 'jacobwagner@gmail.com', '70 Delaware Center', 'jacobwagner', 0, '2023-10-22'),
(66, 'Carleen', 'Kolodziejski', 'Female', '2023-08-26', 1, '09434420243', 'carleenkolodziejski@gmail.com', '4 Sunfield Park', 'carleenkolodziejski', 0, '2023-03-12'),
(67, 'Thomasina', 'Hantusch', 'Female', '2002-01-02', 22, '09966189634', 'thomasinahantusch@gmail.com', '489 Kingsford Terrace', 'thomasinahantusch', 0, '2023-04-29'),
(68, 'Cleavland', 'Papaccio', 'Male', '2015-09-15', 9, '09996885926', 'cleavlandpapaccio@gmail.com', '870 Laurel Crossing', 'cleavlandpapaccio', 0, '2023-07-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `sy` (`sy`),
  ADD KEY `adviser` (`adviser`),
  ADD KEY `strand` (`strand`);

--
-- Indexes for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD PRIMARY KEY (`enroll_id`),
  ADD KEY `enroll_student_ibfk_1` (`student_id`),
  ADD KEY `enroll_student_ibfk_2` (`class`),
  ADD KEY `enroll_student_ibfk_3` (`sy`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`),
  ADD KEY `grade_ibfk_1` (`student`),
  ADD KEY `sy` (`sy`);

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
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `strand` (`strand`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

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
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`sy`) REFERENCES `school_year` (`sy_id`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`adviser`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`strand`) REFERENCES `strand` (`strand_id`);

--
-- Constraints for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD CONSTRAINT `enroll_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_student_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_student_ibfk_3` FOREIGN KEY (`sy`) REFERENCES `school_year` (`sy_id`) ON DELETE CASCADE;

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`student`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grade_ibfk_3` FOREIGN KEY (`sy`) REFERENCES `school_year` (`sy_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`strand`) REFERENCES `strand` (`strand_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
