-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 03:08 PM
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
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `level`, `strand`, `section`, `sy`, `adviser`, `created_at`) VALUES
(68, 'Grade 11', 3, 'A', 61, 33, '2024-02-21 02:39:47'),
(69, 'Grade 11', 3, 'A', 62, 33, '2024-02-21 03:12:57'),
(70, 'Grade 12', 3, 'A', 63, 33, '2024-02-21 03:15:12'),
(71, 'Grade 11', 3, 'A', 64, 33, '2024-02-24 21:50:49');

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
(37, 1, 68, 61, '2024-02-24'),
(38, 2, 68, 61, '2024-02-24'),
(39, 1, 69, 62, '2024-02-24');

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

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `student`, `sy`, `subject`, `grade`) VALUES
(38, 1, 61, 1000, 78),
(39, 1, 61, 1001, 78),
(40, 1, 61, 1002, 90),
(41, 1, 61, 1005, 85),
(42, 1, 62, 1003, 93),
(43, 1, 62, 1004, 93);

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
(61, 2024, 2025, 'First Semester', 'Inactive', '2024-02-11 00:48:24'),
(62, 2024, 2025, 'Second Semester', 'Active', '2024-02-11 16:54:07'),
(63, 2025, 2026, 'First Semester', 'Inactive', '2024-02-21 03:14:22'),
(64, 2020, 2021, 'First Semester', 'Inactive', '2024-02-24 21:50:12');

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
(2, 'GAS', 'General Academic Strand', '2024-02-06'),
(3, 'ICT', 'Information and Communication Technology', '2024-02-06'),
(4, 'STEM', 'Science, Technology, Engineering, and Mathematics', '2024-02-07'),
(5, 'HE', 'Home Economics', '2024-02-07');

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
(1, '201915079', 'Roi', 'Badayos', 'Male', '1999-12-06', 24, '09605718250', 'roibadayos@gmail.com', '6911 Duke Lane', 'roibadayos', 0, '2023-02-26'),
(2, '201915080', 'Reagen', 'Charlon', 'Male', '2014-01-07', 10, '09407786167', 'reagencharlon@gmail.com', '107 Jackson Avenue', 'reagencharlon', 0, '2023-12-01'),
(3, '201915081', 'Stillmann', 'Bowhey', 'Male', '2010-04-21', 14, '09154127932', 'stillmannbowhey@gmail.com', '41 Twin Pines Circle', 'stillmannbowhey', 0, '2024-01-03'),
(4, '201915082', 'Daune', 'Elflain', 'Female', '1999-09-23', 25, '09959648352', 'dauneelflain@gmail.com', '6 Ilene Crossing', 'dauneelflain', 0, '2023-07-23'),
(5, '201915083', 'Armando', 'Kleuer', 'Male', '2013-10-10', 11, '09134543264', 'armandokleuer@gmail.com', '07199 Mcbride Trail', 'armandokleuer', 0, '2023-12-17'),
(6, '201915084', 'Elysia', 'O\' Faherty', 'Female', '2012-08-15', 12, '09586763931', 'elysiao\' faherty@gmail.com', '213 Sheridan Trail', 'elysiao\' faherty', 0, '2023-11-15'),
(7, '201915085', 'Noe', 'Zienkiewicz', 'Male', '2006-10-24', 18, '09328155851', 'noezienkiewicz@gmail.com', '9 Norway Maple Crossing', 'noezienkiewicz', 0, '2023-09-24'),
(8, '201915086', 'Joe', 'Layne', 'Male', '2021-01-22', 3, '09173716139', 'joelayne@gmail.com', '283 Tomscot Circle', 'joelayne', 0, '2023-07-08'),
(9, '201915087', 'Pearle', 'Yeardsley', 'Female', '2003-11-18', 21, '09001997408', 'pearleyeardsley@gmail.com', '3 Warner Trail', 'pearleyeardsley', 0, '2023-04-06'),
(10, '201915088', 'Sunny', 'Cleere', 'Female', '2008-06-17', 16, '09139344384', 'sunnycleere@gmail.com', '8 Blue Bill Park Center', 'sunnycleere', 0, '2023-05-09'),
(11, '201915089', 'Eveleen', 'Crickmore', 'Female', '2013-04-24', 11, '09069287816', 'eveleencrickmore@gmail.com', '76753 6th Trail', 'eveleencrickmore', 0, '2023-08-06'),
(12, '201915090', 'Helenelizabeth', 'Tramel', 'Female', '2020-01-04', 4, '09726187811', 'helenelizabethtramel@gmail.com', '51 Ramsey Drive', 'helenelizabethtramel', 0, '2024-02-17'),
(13, '201915091', 'Anthia', 'Kightly', 'Female', '1999-09-02', 25, '09014636864', 'anthiakightly@gmail.com', '00425 Eastlawn Parkway', 'anthiakightly', 0, '2023-03-31'),
(14, '201915092', 'Nessi', 'Blakeston', 'Female', '2005-11-25', 19, '09845458769', 'nessiblakeston@gmail.com', '2 School Alley', 'nessiblakeston', 0, '2024-01-03'),
(15, '201915093', 'Andonis', 'Rein', 'Male', '2013-09-22', 11, '09251566797', 'andonisrein@gmail.com', '036 Lakeland Trail', 'andonisrein', 0, '2023-09-09'),
(16, '201915094', 'Rorke', 'Bouttell', 'Male', '2010-10-26', 14, '09449859109', 'rorkebouttell@gmail.com', '3606 Sauthoff Terrace', 'rorkebouttell', 0, '2023-07-12'),
(17, '201915095', 'Findlay', 'Vynehall', 'Male', '2018-04-15', 6, '09559823061', 'findlayvynehall@gmail.com', '576 Bluestem Point', 'findlayvynehall', 0, '2023-12-22'),
(18, '201915096', 'Armando', 'Risely', 'Male', '2022-05-22', 2, '09085981416', 'armandorisely@gmail.com', '62886 Sycamore Avenue', 'armandorisely', 0, '2023-09-14'),
(19, '201915097', 'Brenn', 'Clementel', 'Female', '2003-10-13', 21, '09736895520', 'brennclementel@gmail.com', '52 Sage Court', 'brennclementel', 0, '2023-06-16'),
(20, '201915098', 'Abie', 'Noddings', 'Male', '2001-10-01', 23, '09104262076', 'abienoddings@gmail.com', '88657 Jay Road', 'abienoddings', 0, '2023-10-28');

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
(1000, 'Oral Communictaion', 'Grade 11', 3, 'First Semester', '2024-02-10 17:04:35'),
(1001, 'Reading and Writing', 'Grade 11', 3, 'First Semester', '2024-02-10 17:04:47'),
(1002, 'English', 'Grade 11', 3, 'First Semester', '2024-02-10 23:55:54'),
(1003, 'Amazing', 'Grade 11', 3, 'Second Semester', '2024-02-13 03:20:19'),
(1004, 'Awesome', 'Grade 11', 3, 'Second Semester', '2024-02-19 00:20:32'),
(1005, 'Math', 'Grade 11', 3, 'First Semester', '2024-02-24 21:53:01');

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
(33, 'Roi', 'Badayos', 'Male', '2022-06-22', 2, '09317191988', 'roibadayos@gmail.com', '3399 Kropf Court', 'roibadayos', 0, '2023-03-31'),
(34, 'Lharens', 'Indus', 'Male', '2014-08-04', 10, '09277475502', 'lharensindus@gmail.com', '971 Golf Course Trail', 'josselynkuhnert', 0, '2023-11-03'),
(35, 'Kevon', 'Koene', 'Male', '2003-04-22', 21, '09801768574', 'kevonkoene@gmail.com', '08336 Comanche Trail', 'kevonkoene', 0, '2023-07-12'),
(36, 'Baird', 'Sawford', 'Male', '2018-02-27', 6, '09724012221', 'bairdsawford@gmail.com', '669 Beilfuss Park', 'bairdsawford', 0, '2023-09-09'),
(37, 'Abbe', 'Pocke', 'Female', '2014-08-04', 10, '09523780419', 'abbepocke@gmail.com', '49 Pine View Way', 'abbepocke', 0, '2023-12-10'),
(38, 'Eilis', 'Boyes', 'Female', '2003-01-21', 21, '09029030379', 'eilisboyes@gmail.com', '880 Rusk Court', 'eilisboyes', 0, '2023-05-20'),
(39, 'Amitie', 'Shrimplin', 'Female', '2018-08-23', 6, '09330168834', 'amitieshrimplin@gmail.com', '9087 Nevada Hill', 'amitieshrimplin', 0, '2024-01-29'),
(40, 'Effie', 'Barhem', 'Female', '2000-11-06', 24, '09507960986', 'effiebarhem@gmail.com', '05574 Garrison Hill', 'effiebarhem', 0, '2023-07-13'),
(41, 'Davon', 'Wylam', 'Male', '2013-06-23', 11, '09594823592', 'davonwylam@gmail.com', '507 Lighthouse Bay Point', 'davonwylam', 0, '2023-08-25'),
(42, 'Hirsch', 'Featherstonhaugh', 'Male', '2021-01-06', 3, '09960999496', 'hirschfeatherstonhaugh@gmail.com', '97008 Pierstorff Hill', 'hirschfeatherstonhaugh', 0, '2023-11-15'),
(43, 'Aviva', 'Myers', 'Female', '2014-06-12', 10, '09626672248', 'avivamyers@gmail.com', '19 Maple Wood Way', 'avivamyers', 0, '2023-07-10'),
(44, 'Moore', 'Watson-Brown', 'Male', '1999-03-08', 25, '09110069291', 'moorewatson-brown@gmail.com', '28 Melvin Parkway', 'moorewatson-brown', 0, '2023-12-13'),
(45, 'Ibby', 'Casale', 'Female', '2023-07-09', 1, '09928895721', 'ibbycasale@gmail.com', '1005 Forster Junction', 'ibbycasale', 0, '2024-01-17'),
(46, 'Weston', 'Dollimore', 'Male', '2001-06-16', 23, '09346915060', 'westondollimore@gmail.com', '5615 Superior Point', 'westondollimore', 0, '2023-07-29'),
(47, 'Luci', 'Cater', 'Female', '2001-04-26', 23, '09626913583', 'lucicater@gmail.com', '6636 Clyde Gallagher Court', 'lucicater', 0, '2023-04-06'),
(48, 'Maressa', 'Howgego', 'Female', '2003-11-28', 21, '09026781144', 'maressahowgego@gmail.com', '2826 Hooker Point', 'maressahowgego', 0, '2023-07-17'),
(49, 'Cristian', 'Churn', 'Male', '2021-11-28', 3, '09904413073', 'cristianchurn@gmail.com', '1 Monterey Road', 'cristianchurn', 0, '2023-11-01'),
(50, 'Chico', 'Wilshin', 'Male', '2021-04-24', 3, '09784604829', 'chicowilshin@gmail.com', '4228 Mallory Plaza', 'chicowilshin', 0, '2023-05-14'),
(51, 'Thorn', 'Koeppe', 'Male', '2012-04-12', 12, '09407196342', 'thornkoeppe@gmail.com', '264 Burning Wood Road', 'thornkoeppe', 0, '2023-11-27'),
(52, 'Patton', 'Renols', 'Male', '2020-01-15', 4, '09141363124', 'pattonrenols@gmail.com', '3 Arapahoe Center', 'pattonrenols', 0, '2023-12-27');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subject` (`subject_id`),
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
