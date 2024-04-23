-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 06:55 AM
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
  `mname` varchar(50) NOT NULL,
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

INSERT INTO `users` (`id`, `lrn_number`, `role`, `fname`, `lname`, `mname`, `gender`, `birthday`, `contact`, `email`, `address`, `password`, `status`, `reg_date`) VALUES
(13, 'N/A', 'admin', 'Super', 'Admin', 'Hot', 'Male', '2009-01-29', '09813043186', 'admin@gmail.com', '2809 Ruskin Road', '123', 0, '2022-07-09'),
(140, '201915079101', 'student', 'Roi', 'Badayos', 'Espela', 'Male', '1995-03-12', '09158000879', 'roibadayos@gmail.com', '015 Lakewood Street', 'roibadayos', 0, '2020-11-27'),
(141, '201915079102', 'student', 'Rita', 'Marsden', 'Fawltey', 'Female', '1994-03-03', '09148315224', 'ritamarsden@gmail.com', '823 Lake View Terrace', 'ritamarsden', 0, '2021-06-07'),
(142, '201915079103', 'student', 'Sheena', 'Conner', 'Yannoni', 'Female', '1995-09-23', '09835395381', 'sheenaconner@gmail.com', '80 Di Loreto Road', 'sheenaconner', 0, '2020-12-01'),
(143, '201915079104', 'student', 'Sella', 'Alfonsetti', 'Kubal', 'Female', '1996-06-02', '09769379663', 'sellaalfonsetti@gmail.com', '943 David Crossing', 'sellaalfonsetti', 0, '2020-06-22'),
(144, '201915079105', 'student', 'Emmott', 'Penton', 'Gunby', 'Male', '1995-04-18', '09551724446', 'emmottpenton@gmail.com', '49 Erie Hill', 'emmottpenton', 0, '2022-01-31'),
(145, '201915079106', 'student', 'Maxim', 'Gurnett', 'Joder', 'Male', '1997-11-08', '09803506465', 'maximgurnett@gmail.com', '843 Esker Terrace', 'maximgurnett', 0, '2023-05-16'),
(146, '201915079107', 'student', 'Putnam', 'Clemmen', 'Deeman', 'Male', '1998-11-24', '09758568402', 'putnamclemmen@gmail.com', '75 Bowman Place', 'putnamclemmen', 0, '2020-04-25'),
(147, '201915079108', 'student', 'Bertie', 'Metschke', 'Rozzell', 'Male', '1997-04-27', '09825110143', 'bertiemetschke@gmail.com', '022 Commercial Point', 'bertiemetschke', 0, '2020-12-27'),
(148, '201915079109', 'student', 'Leland', 'Foystone', 'Hartop', 'Male', '1994-04-17', '09587133393', 'lelandfoystone@gmail.com', '6539 Sommers Terrace', 'lelandfoystone', 0, '2022-03-11'),
(149, '201915079110', 'student', 'Pryce', 'Bertot', 'Barnfather', 'Male', '1999-10-17', '09409313670', 'prycebertot@gmail.com', '6129 Truax Plaza', 'prycebertot', 0, '2022-10-08'),
(150, '201915079111', 'student', 'Antoni', 'Causton', 'Kemer', 'Male', '1995-08-18', '09457315251', 'antonicauston@gmail.com', '9 Service Crossing', 'antonicauston', 0, '2022-05-22'),
(151, '201915079112', 'student', 'Trude', 'Wrighton', 'Barnett', 'Female', '1996-07-23', '09225548950', 'trudewrighton@gmail.com', '3 Kim Point', 'trudewrighton', 0, '2023-05-08'),
(152, '201915079113', 'student', 'Lauryn', 'Rycraft', 'Tellenbroker', 'Female', '1996-02-21', '09096680494', 'laurynrycraft@gmail.com', '2 Saint Paul Terrace', 'laurynrycraft', 0, '2022-04-01'),
(153, '201915079114', 'student', 'Goran', 'Molineaux', 'Biagi', 'Male', '1998-11-22', '09618537765', 'goranmolineaux@gmail.com', '1 Hintze Trail', 'goranmolineaux', 0, '2023-06-16'),
(154, '201915079115', 'student', 'Faye', 'Filipson', 'Chopin', 'Female', '1996-10-06', '09414754231', 'fayefilipson@gmail.com', '46126 1st Street', 'fayefilipson', 0, '2020-09-06'),
(155, '201915079116', 'student', 'Tansy', 'Eakly', 'Bampkin', 'Female', '1998-02-08', '09206533015', 'tansyeakly@gmail.com', '9224 Ridgeview Drive', 'tansyeakly', 0, '2020-07-13'),
(156, '201915079117', 'student', 'Rodolfo', 'Jauncey', 'Devany', 'Male', '1994-12-01', '09856927617', 'rodolfojauncey@gmail.com', '82749 Lighthouse Bay Court', 'rodolfojauncey', 0, '2020-09-10'),
(157, '201915079118', 'student', 'Brigham', 'Santen', 'Reyson', 'Male', '1998-06-02', '09537931345', 'brighamsanten@gmail.com', '292 Heffernan Pass', 'brighamsanten', 0, '2021-06-26'),
(158, '201915079119', 'student', 'Mendel', 'Wells', 'Farman', 'Male', '1998-02-22', '09902548404', 'mendelwells@gmail.com', '9224 Hayes Point', 'mendelwells', 0, '2020-06-28'),
(159, '201915079120', 'student', 'Ginny', 'Lundbech', 'Costar', 'Female', '1997-12-18', '09364232879', 'ginnylundbech@gmail.com', '7754 Florence Lane', 'ginnylundbech', 0, '2023-05-05'),
(170, 'N/A', 'teacher', 'Euell', 'Rostron', 'Allard', 'Male', '1995-06-15', '09361523979', 'euellrostron@gmail.com', '555 Eagle Crest Circle', 'euellrostron', 0, '2023-06-21'),
(171, 'N/A', 'teacher', 'Georgine', 'Dunbar', 'Venn', 'Female', '1995-10-22', '09370056737', 'georginedunbar@gmail.com', '115 Pepper Wood Junction', 'georginedunbar', 0, '2021-05-11'),
(172, 'N/A', 'teacher', 'Daven', 'Staker', 'Bollans', 'Male', '1999-02-17', '09517938569', 'davenstaker@gmail.com', '290 Ilene Parkway', 'davenstaker', 0, '2021-08-02'),
(173, 'N/A', 'teacher', 'Regine', 'Budgeon', 'Yakubov', 'Female', '1998-06-22', '09212032672', 'reginebudgeon@gmail.com', '5 Tony Crossing', 'reginebudgeon', 0, '2022-11-22'),
(174, 'N/A', 'teacher', 'Mareah', 'Thies', 'Pawling', 'Female', '1998-08-18', '09496819537', 'mareahthies@gmail.com', '49 Spohn Lane', 'mareahthies', 0, '2023-07-14'),
(175, 'N/A', 'teacher', 'Lucille', 'Wisson', 'Licari', 'Female', '1999-02-08', '09619811115', 'lucillewisson@gmail.com', '8 Longview Lane', 'lucillewisson', 0, '2022-09-22'),
(176, 'N/A', 'teacher', 'Row', 'Done', 'Anderl', 'Female', '1994-07-12', '09392119935', 'rowdone@gmail.com', '63 Eastlawn Lane', 'rowdone', 0, '2023-05-08'),
(177, 'N/A', 'teacher', 'Erwin', 'Kingaby', 'Myner', 'Male', '1996-02-12', '09739496694', 'erwinkingaby@gmail.com', '7 Thierer Hill', 'erwinkingaby', 0, '2021-02-08'),
(178, 'N/A', 'teacher', 'Hannis', 'Pauletti', 'Brisland', 'Female', '1999-10-27', '09288386420', 'hannispauletti@gmail.com', '9 Briar Crest Hill', 'hannispauletti', 0, '2023-12-03'),
(179, 'N/A', 'teacher', 'Jackson', 'Duthy', 'Sloss', 'Male', '1996-04-20', '09507613517', 'jacksonduthy@gmail.com', '9047 Granby Hill', 'jacksonduthy', 0, '2022-02-03');

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

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
