-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 02:39 AM
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
(127, 'Grade 11', 21, '1', 86, 212, '2024-05-14');

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
(256, 182, 127, 86, '2024-05-14'),
(257, 183, 127, 86, '2024-05-14'),
(258, 184, 127, 86, '2024-05-14'),
(259, 185, 127, 86, '2024-05-14'),
(260, 186, 127, 86, '2024-05-14'),
(261, 187, 127, 86, '2024-05-14'),
(262, 188, 127, 86, '2024-05-14'),
(263, 189, 127, 86, '2024-05-14'),
(264, 190, 127, 86, '2024-05-14'),
(265, 191, 127, 86, '2024-05-14'),
(266, 192, 127, 86, '2024-05-14'),
(267, 193, 127, 86, '2024-05-14'),
(268, 194, 127, 86, '2024-05-14'),
(269, 195, 127, 86, '2024-05-14'),
(270, 196, 127, 86, '2024-05-14'),
(271, 197, 127, 86, '2024-05-14'),
(272, 198, 127, 86, '2024-05-14'),
(273, 199, 127, 86, '2024-05-14'),
(274, 200, 127, 86, '2024-05-14'),
(275, 201, 127, 86, '2024-05-14');

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
(236, 182, 86, 1025, 99, 127),
(237, 183, 86, 1025, 100, 127),
(238, 184, 86, 1025, 100, 127),
(239, 185, 86, 1025, 100, 127),
(240, 185, 86, 1026, 100, 127);

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
(83, 2022, 2023, 'First Semester', 'Inactive', '2024-05-14 02:21:47'),
(84, 2022, 2023, 'Second Semester', 'Inactive', '2024-05-14 02:23:05'),
(85, 2023, 2024, 'First Semester', 'Inactive', '2024-05-14 02:28:03'),
(86, 2023, 2024, 'Second Semester', 'Active', '2024-05-14 02:28:18');

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
(182, '201915079101', 'student', 'Roi', 'Badayos', 'Espela', 'Male', '1999-12-06', '09284310661', 'roibadayos@gmail.com', '7 Kropf Circle', 'roibadayos', 0, '2022-09-10'),
(183, '201915079102', 'student', 'Jeanie', 'Dissman', 'Izkoveski', 'Female', '1998-06-06', '09339675135', 'jeaniedissman@gmail.com', '5 Corben Court', 'jeaniedissman', 0, '2023-11-03'),
(184, '201915079103', 'student', 'Shawn', 'Brosoli', 'Rainard', 'Female', '1997-02-07', '09915939387', 'shawnbrosoli@gmail.com', '706 Reinke Alley', 'shawnbrosoli', 0, '2022-08-01'),
(185, '201915079104', 'student', 'Krystal', 'Bladge', 'McDade', 'Female', '1998-01-08', '09686512331', 'krystalbladge@gmail.com', '50653 Warner Park', 'krystalbladge', 0, '2022-04-06'),
(186, '201915079105', 'student', 'Claudia', 'Shuttle', 'Thorsen', 'Female', '1996-01-10', '09649200868', 'claudiashuttle@gmail.com', '359 Anderson Plaza', 'claudiashuttle', 0, '2021-09-01'),
(187, '201915079106', 'student', 'Papagena', 'Dumingo', 'Gonzales', 'Female', '1999-08-24', '09513486662', 'papagenadumingo@gmail.com', '31 Little Fleur Point', 'papagenadumingo', 0, '2023-10-28'),
(188, '201915079107', 'student', 'Kendall', 'Groundwator', 'Winwright', 'Male', '1998-03-13', '09833463216', 'kendallgroundwator@gmail.com', '44 Debs Crossing', 'kendallgroundwator', 0, '2020-06-29'),
(189, '201915079108', 'student', 'Derwin', 'Lessmare', 'Pipping', 'Male', '1998-08-31', '09897753490', 'derwinlessmare@gmail.com', '796 American Trail', 'derwinlessmare', 0, '2022-09-04'),
(190, '201915079109', 'student', 'Lavinia', 'Edyson', 'Frostdicke', 'Female', '1996-12-30', '09876100781', 'laviniaedyson@gmail.com', '94054 Thompson Circle', 'laviniaedyson', 0, '2023-06-02'),
(191, '201915079110', 'student', 'Tiffie', 'McPhelimy', 'Whyborn', 'Female', '1998-03-31', '09783739636', 'tiffiemcphelimy@gmail.com', '158 Moose Parkway', 'tiffiemcphelimy', 0, '2023-06-07'),
(192, '201915079111', 'student', 'Tara', 'Caddies', 'Wisher', 'Female', '1997-02-13', '09558993074', 'taracaddies@gmail.com', '675 Bay Terrace', 'taracaddies', 0, '2021-05-15'),
(193, '201915079112', 'student', 'Darill', 'Endricci', 'Jouandet', 'Male', '1994-03-14', '09346193806', 'darillendricci@gmail.com', '4926 American Way', 'darillendricci', 0, '2022-07-19'),
(194, '201915079113', 'student', 'Davina', 'Crosgrove', 'Ludlom', 'Female', '1997-04-09', '09723389831', 'davinacrosgrove@gmail.com', '2 Declaration Plaza', 'davinacrosgrove', 0, '2020-11-19'),
(195, '201915079114', 'student', 'Sim', 'Bernini', 'Windrum', 'Male', '1997-05-31', '09143816717', 'simbernini@gmail.com', '13319 Tennessee Road', 'simbernini', 0, '2020-09-11'),
(196, '201915079115', 'student', 'Hardy', 'Minihan', 'Georgiev', 'Male', '1994-12-27', '09368329698', 'hardyminihan@gmail.com', '47 Armistice Alley', 'hardyminihan', 0, '2022-10-28'),
(197, '201915079116', 'student', 'Pippo', 'Willavize', 'Brendish', 'Male', '1997-01-04', '09410741781', 'pippowillavize@gmail.com', '29 Carey Plaza', 'pippowillavize', 0, '2022-03-16'),
(198, '201915079117', 'student', 'Arther', 'Krates', 'Onn', 'Male', '1998-10-30', '09665227116', 'artherkrates@gmail.com', '465 Holmberg Street', 'artherkrates', 0, '2022-12-26'),
(199, '201915079118', 'student', 'Wilmar', 'Coultar', 'Mawford', 'Male', '1996-09-29', '09068819776', 'wilmarcoultar@gmail.com', '1 Main Center', 'wilmarcoultar', 0, '2023-11-12'),
(200, '201915079119', 'student', 'Rudolfo', 'Cozens', 'Bootyman', 'Male', '1995-12-12', '09875865504', 'rudolfocozens@gmail.com', '996 Fordem Center', 'rudolfocozens', 0, '2023-07-25'),
(201, '201915079120', 'student', 'Robers', 'Kynaston', 'McAmish', 'Male', '1996-12-27', '09411757267', 'roberskynaston@gmail.com', '9022 Mccormick Alley', 'roberskynaston', 0, '2020-08-12'),
(212, 'N/A', 'teacher', 'Lharens', 'Indus', 'Edmonston', 'Male', '1996-08-20', '09036155709', 'lharensindus@gmail.com', '63932 Manitowish Junction', 'lharensindus', 0, '2022-03-10'),
(213, 'N/A', 'teacher', 'Sharlene', 'Lindley', 'Stormouth', 'Female', '1999-03-27', '09890439998', 'sharlenelindley@gmail.com', '0 Kingsford Plaza', 'sharlenelindley', 0, '2020-12-26'),
(214, 'N/A', 'teacher', 'Monroe', 'Yokel', 'McClure', 'Male', '1995-03-14', '09128172990', 'monroeyokel@gmail.com', '340 Vernon Crossing', 'monroeyokel', 0, '2021-06-09'),
(215, 'N/A', 'teacher', 'Andris', 'Douthwaite', 'O\'Currane', 'Male', '1996-01-26', '09178404024', 'andrisdouthwaite@gmail.com', '05527 Sutherland Plaza', 'andrisdouthwaite', 0, '2022-09-28'),
(216, 'N/A', 'teacher', 'Bowie', 'Urvoy', 'Ricketts', 'Male', '1999-09-15', '09931466010', 'bowieurvoy@gmail.com', '42 Main Point', 'bowieurvoy', 0, '2023-08-05'),
(217, 'N/A', 'teacher', 'Jamie', 'Kanwell', 'Clausner', 'Female', '1999-09-02', '09056779465', 'jamiekanwell@gmail.com', '91285 Jay Parkway', 'jamiekanwell', 0, '2021-04-11'),
(218, 'N/A', 'teacher', 'Truda', 'Redparth', 'Synan', 'Female', '1996-09-14', '09169304430', 'trudaredparth@gmail.com', '506 Del Sol Place', 'trudaredparth', 0, '2024-01-07'),
(219, 'N/A', 'teacher', 'Kirk', 'Daniaud', 'Denniss', 'Male', '1998-05-01', '09356377784', 'kirkdaniaud@gmail.com', '02380 Green Terrace', 'kirkdaniaud', 0, '2022-02-20'),
(220, 'N/A', 'teacher', 'Annnora', 'Valentine', 'Neaverson', 'Female', '1996-12-22', '09564751727', 'annnoravalentine@gmail.com', '3258 Old Shore Junction', 'annnoravalentine', 0, '2022-02-26'),
(221, 'N/A', 'teacher', 'Andrew', 'Gooms', 'Ingray', 'Male', '1996-11-11', '09948204889', 'andrewgooms@gmail.com', '1347 Quincy Point', 'andrewgooms', 0, '2020-11-14');

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

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
