-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 07:16 AM
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
(144, 'Grade 11', 19, '12', 85, 273, '2024-06-12'),
(145, 'Grade 11', 21, '1', 85, 277, '2024-06-12'),
(146, 'Grade 11', 21, '1', 86, 287, '2024-06-13'),
(147, 'Grade 11', 19, '1', 86, 290, '2024-06-13'),
(148, 'Grade 11', 17, '1', 85, 284, '2024-06-13'),
(149, 'Grade 11', 18, '1', 85, 292, '2024-06-13'),
(150, 'Grade 11', 20, '1', 85, 288, '2024-06-13'),
(151, 'Grade 12', 21, '2', 85, 286, '2024-06-14'),
(152, 'Grade 11', 16, '21', 85, 289, '2024-06-14'),
(153, 'Grade 12', 17, '1000', 85, 290, '2024-06-14'),
(154, 'Grade 12', 21, '1', 87, 280, '2024-06-14'),
(155, 'Grade 12', 21, '2', 87, 284, '2024-06-14'),
(156, 'Grade 11', 21, '1', 87, 277, '2024-06-14'),
(157, 'Grade 12', 18, '1', 87, 291, '2024-06-17'),
(158, 'Grade 11', 21, '2', 85, 275, '2024-06-18');

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
(762, 305, 145, 85, '2024-06-18'),
(763, 295, 145, 85, '2024-06-18'),
(764, 264, 145, 85, '2024-06-18'),
(765, 263, 145, 85, '2024-06-18'),
(766, 250, 145, 85, '2024-06-18'),
(767, 271, 145, 85, '2024-06-18'),
(768, 251, 145, 85, '2024-06-18'),
(769, 244, 145, 85, '2024-06-18'),
(770, 260, 145, 85, '2024-06-18'),
(771, 245, 145, 85, '2024-06-18'),
(772, 235, 145, 85, '2024-06-18'),
(773, 240, 145, 85, '2024-06-18'),
(774, 241, 145, 85, '2024-06-18'),
(775, 258, 145, 85, '2024-06-18'),
(776, 253, 145, 85, '2024-06-18'),
(777, 268, 145, 85, '2024-06-18'),
(778, 237, 145, 85, '2024-06-18'),
(779, 267, 145, 85, '2024-06-18'),
(780, 257, 145, 85, '2024-06-18'),
(781, 233, 145, 85, '2024-06-18'),
(782, 261, 145, 85, '2024-06-18'),
(783, 239, 145, 85, '2024-06-18'),
(784, 234, 145, 85, '2024-06-18'),
(785, 269, 145, 85, '2024-06-18'),
(786, 249, 145, 85, '2024-06-18'),
(787, 254, 145, 85, '2024-06-18'),
(788, 236, 145, 85, '2024-06-18'),
(789, 238, 145, 85, '2024-06-18'),
(790, 259, 145, 85, '2024-06-18'),
(791, 265, 145, 85, '2024-06-18'),
(792, 266, 145, 85, '2024-06-18'),
(793, 243, 145, 85, '2024-06-18'),
(794, 247, 145, 85, '2024-06-18'),
(795, 246, 145, 85, '2024-06-18'),
(796, 270, 145, 85, '2024-06-18'),
(797, 252, 145, 85, '2024-06-18'),
(798, 255, 145, 85, '2024-06-18'),
(799, 242, 145, 85, '2024-06-18'),
(800, 256, 145, 85, '2024-06-18'),
(801, 248, 145, 85, '2024-06-18'),
(802, 262, 145, 85, '2024-06-18'),
(803, 272, 145, 85, '2024-06-18');

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
(606, 305, 85, 1276, 99, 145),
(607, 295, 85, 1276, 99, 145),
(608, 264, 85, 1276, 99, 145),
(609, 263, 85, 1276, 99, 145);

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
(85, 2024, 2025, 'First Semester', 'Active', '2024-05-14 02:28:03'),
(86, 2023, 2024, 'First Semester', 'Inactive', '2024-05-14 02:28:18'),
(87, 2024, 2025, 'Second Semester', 'Inactive', '2024-06-14 10:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `strand`
--

CREATE TABLE `strand` (
  `strand_id` int(11) NOT NULL,
  `track` varchar(255) NOT NULL,
  `strand` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strand`
--

INSERT INTO `strand` (`strand_id`, `track`, `strand`, `description`, `date_created`) VALUES
(16, 'Academic Track', 'HK', 'Housekeeping', '2024-03-14'),
(17, 'Academic Track', 'GAS', 'General Academic Strand', '2024-03-14'),
(18, 'Academic Track', 'ABM', 'Accountancy, Business and Management Strand', '2024-03-18'),
(19, 'Academic Track', 'STEM', 'Science, Technology, Engineering, and Mathematics Strand', '2024-03-18'),
(20, 'Academic Track', 'HUMMS', 'Humanities and Social Science Strand', '2024-03-18'),
(21, 'Technical-Vocational-Livelihood Track', 'ICT', 'Information and Communication Technology', '2024-03-18'),
(27, 'Technical-Vocational-Livelihood Track', 'CK', 'Cookery', '2024-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `level`, `strand`, `semester`) VALUES
(1274, 'Oral Communication', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1275, 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1276, '21st Century Literature from the Philippines and the World', 'Grade 11', '16,17,18,20,21,27', 'First Semester'),
(1277, 'General Mathematics', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1278, 'Earth and Life Science', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1279, 'Personal Development/Pansariling Kaunlaran', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1280, 'Understanding Culture, Society and Politics', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1281, 'Physical Education and Health', 'Grade 11', '16,17,18,19,20,21,27', 'First Semester'),
(1282, 'English for Academic and Professional Purposes', 'Grade 11', '16,17,18,20,21,27', 'First Semester'),
(1283, 'Pre-Calculus', 'Grade 11', '19', 'First Semester'),
(1284, 'General Biology 1', 'Grade 11', '19', 'First Semester'),
(1285, 'Reading and Writing', 'Grade 11', '16,17,18,19,20,21,27', 'Second Semester'),
(1286, 'Contemporary Philippine Arts from the Regions', 'Grade 11', '16,17,20,21,27', 'Second Semester'),
(1287, 'Statistics and Probability', 'Grade 11', '16,17,18,19,20,21,27', 'Second Semester'),
(1288, 'Media and Information Literacy', 'Grade 11', '16,17,18,19,20,21,27', 'Second Semester'),
(1289, 'Physical Education and Health', 'Grade 11', '16,17,18,19,20,21,27', 'Second Semester'),
(1290, 'Practical Research 1', 'Grade 11', '16,17,18,19,20,21,27', 'Second Semester'),
(1291, 'Filipino sa Piling Larang', 'Grade 11', '16,21,27', 'Second Semester'),
(1292, 'Housekeeping NC II', 'Grade 11', '16', 'Second Semester'),
(1293, 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 'Grade 11', '17,19,20', 'Second Semester'),
(1294, 'Introduction to World Religions and Beliefs', 'Grade 11', '17', 'Second Semester'),
(1295, 'Applied Economics', 'Grade 11', '17,18', 'Second Semester'),
(1296, 'Organization and Management', 'Grade 11', '18', 'Second Semester'),
(1297, 'Fundamentals of Accountancy, Business and Management 1', 'Grade 11', '18', 'Second Semester'),
(1298, 'Physical Science', 'Grade 11', '18', 'Second Semester'),
(1299, 'Basic Calculus', 'Grade 11', '19', 'Second Semester'),
(1300, 'General Biology 2', 'Grade 11', '19', 'Second Semester'),
(1301, 'General Chemistry 1', 'Grade 11', '19', 'Second Semester'),
(1302, 'Philippine Politics and Governance', 'Grade 11', '20', 'Second Semester'),
(1303, 'Disciplines and Ideas in the Social Sciences', 'Grade 11', '20', 'Second Semester'),
(1304, 'Computer Programming NC II', 'Grade 11', '21', 'Second Semester'),
(1305, 'Cookery NC II', 'Grade 11', '27', 'Second Semester'),
(1306, 'Physical Science', 'Grade 12', '16,17,20,21,27', 'First Semester'),
(1307, 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 'Grade 12', '16,18,19,20,21,27', 'First Semester'),
(1308, 'Physical Education and Health', 'Grade 12', '16,17,18,19,20,21,27', 'First Semester'),
(1309, 'Practical Research 2', 'Grade 12', '16,17,18,19,20,21,27', 'First Semester'),
(1310, 'Empowerment Technologies', 'Grade 12', '16,17,19,21,27', 'First Semester'),
(1311, 'Entrepreneurship', 'Grade 12', '16,18,20,21,27', 'First Semester'),
(1312, 'Front Office Services NC II', 'Grade 12', '16', 'First Semester'),
(1313, 'Filipino sa Piling Larang', 'Grade 12', '17,18', 'First Semester'),
(1314, 'Philippine Politics and Governance', 'Grade 12', '17', 'First Semester'),
(1315, 'Organization and Management', 'Grade 12', '17', 'First Semester'),
(1316, 'Elective 1: Creative Writing', 'Grade 12', '17', 'First Semester'),
(1317, 'Contemporary Philippine Arts from the Regions', 'Grade 12', '18', 'First Semester'),
(1318, 'Business Math', 'Grade 12', '18', 'First Semester'),
(1319, 'Fundamentals of Accountancy, Business and Management 2', 'Grade 12', '18', 'First Semester'),
(1320, '21st Century Literature from the Philippines and the World', 'Grade 12', '19', 'First Semester'),
(1321, 'English for Academic and Professional Purposes', 'Grade 12', '19', 'First Semester'),
(1322, 'General Physics 1', 'Grade 12', '19', 'First Semester'),
(1323, 'General Chemistry 2', 'Grade 12', '19', 'First Semester'),
(1324, 'Computer Programming NC II', 'Grade 12', '21', 'First Semester'),
(1325, 'Cookery NC II', 'Grade 12', '27', 'First Semester'),
(1326, 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 'Grade 12', '16,18,21,27', 'Second Semester'),
(1327, 'Physical Education and Health', 'Grade 12', '16,17,18,19,20,21,27', 'Second Semester'),
(1328, 'Inquiries, Investigations and Immersion', 'Grade 12', '16,17,18,20,21,27', 'Second Semester'),
(1329, 'Tourism Promotion Services NC II', 'Grade 12', '16', 'Second Semester'),
(1330, 'Food and Beverage Production NC II', 'Grade 12', '16,27', 'Second Semester'),
(1331, 'Work Immersion/Research/Career Advocacy/Culminal Activity', 'Grade 12', '16,17,18,20,21,27', 'Second Semester'),
(1332, 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 'Grade 12', '17', 'Second Semester'),
(1333, 'Entrepreneurship', 'Grade 12', '17,19', 'Second Semester'),
(1334, 'Elective 2: Common Engagement', 'Grade 12', '17', 'Second Semester'),
(1335, 'Humanities 2: Trend Network and Critical Thinking in 21st Century', 'Grade 12', '17', 'Second Semester'),
(1336, 'Disaster Readiness and Risk Reduction', 'Grade 12', '17,19', 'Second Semester'),
(1337, 'Empowerment Technologies', 'Grade 12', '18,20', 'Second Semester'),
(1338, 'Principles of Marketing', 'Grade 12', '18', 'Second Semester'),
(1339, 'Business Ethics and Social Responsibility', 'Grade 12', '18', 'Second Semester'),
(1340, 'Business Finance', 'Grade 12', '18', 'Second Semester'),
(1341, 'Contemporary Philippine Arts from the Regions', 'Grade 12', '19', 'Second Semester'),
(1342, 'Filipino sa Piling Larang', 'Grade 12', '19,20', 'Second Semester'),
(1343, 'Research Project', 'Grade 12', '19', 'Second Semester'),
(1344, 'General Physics 2', 'Grade 12', '19', 'Second Semester'),
(1345, 'Research/Capstone Project', 'Grade 12', '19', 'Second Semester'),
(1346, 'Creative Nonfiction', 'Grade 12', '20', 'Second Semester'),
(1347, 'Trends, Networks and Critical Thinking in the 21st Century', 'Grade 12', '20', 'Second Semester'),
(1348, 'Community Engagement, Solidarity and Citizenship', 'Grade 12', '20', 'Second Semester'),
(1349, 'Creative Writing', 'Grade 12', '20', 'First Semester'),
(1350, 'Introduction to World Religions and Belief Systems', 'Grade 12', '20', 'First Semester'),
(1351, 'Disciplines and Ideas in the Applied Social Sciences', 'Grade 12', '20', 'First Semester'),
(1352, 'Computer Programming NC II', 'Grade 12', '21', 'Second Semester'),
(1353, 'Bread and Pastry Production NC II', 'Grade 12', '27', 'Second Semester');

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
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `reg_date` date NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '../image/image.png',
  `token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lrn_number`, `role`, `fname`, `lname`, `mname`, `gender`, `birthday`, `contact`, `email`, `address`, `password`, `status`, `reg_date`, `picture`, `token`, `token_expiration`) VALUES
(229, 'N/A', 'admin', 'Khufra', 'Hylos', 'Atlas', 'Male', '1122-12-12', '12323233233', 'admin@gmail.com', 'Tanza, Cavite', '$2y$10$U4000mPsBSymVmvaaPLOQeiLNkm2LP2982rIJJKfsLBMHnBT40UZW', 0, '2024-06-12', '../image/image.png', NULL, NULL),
(233, '201915079101', 'student', 'Lynett', 'Hoyer', '', 'Female', '1999-03-13', '09882918067', 'lynetthoyer@gmail.com', '5333 Mendota Terrace', '$2y$10$E3P30jdHRTC5HY6a.hs1D.sr8tWbjGl9OiAFyG6YWOykLz0ycaVKi', 0, '2020-12-25', '../image/image.png', NULL, NULL),
(234, '201915079102', 'student', 'Gillie', 'Johnson', 'Cattroll', 'Female', '1995-12-14', '09729552723', 'gilliejohnson@gmail.com', '01247 Moulton Crossing', '$2y$10$kYWVfb4xlolHiLkXPjeRM.7G3OCnsUymnOlJD.elMOQZQfi.7Xm8e', 0, '2023-12-23', '../image/image.png', NULL, NULL),
(235, '201915079103', 'student', 'Jordana', 'Eliff', 'Cheers', 'Female', '1999-01-30', '09698666904', 'jordanaeliff@gmail.com', '286 Bunting Hill', '$2y$10$C6WsOlCxe6HzlmTuvhE5Vu83mxPNmoYOhaueGyTMR5Rdd14bYqmea', 0, '2022-06-08', '../image/image.png', NULL, NULL),
(236, '201915079104', 'student', 'Porter', 'McPhilemy', 'Sneyd', 'Male', '1994-11-22', '09841956185', 'portermcphilemy@gmail.com', '4 Mandrake Terrace', '$2y$10$o81uuZe.xDX47/KvH68vy.KiKtgbm4T1xrNRzdVqxiYnbCR/tOj6a', 0, '2023-10-25', '../image/image.png', NULL, NULL),
(237, '201915079105', 'student', 'Aldrich', 'Gilcrist', 'Swetman', 'Male', '1999-10-19', '09685912031', 'aldrichgilcrist@gmail.com', '328 Laurel Plaza', '$2y$10$bk5B5X5vmMcTdMmN1VYCQ.cTipzS9dlDWCghXyua1u1.tWpvFhHE.', 0, '2020-07-07', '../image/image.png', NULL, NULL),
(238, '201915079106', 'student', 'Derril', 'Mence', 'Meech', 'Male', '1996-04-03', '09722504351', 'derrilmence@gmail.com', '59458 Merchant Street', '$2y$10$7kmrLNbQLRlbt0ZXLcAY4eumEMN/qpdClaH1NFbPvvWzKTVYkKIzS', 0, '2022-08-04', '../image/image.png', NULL, NULL),
(239, '201915079107', 'student', 'Bryn', 'Jeffry', 'Lyster', 'Female', '1994-11-04', '09834262612', 'brynjeffry@gmail.com', '657 Truax Point', '$2y$10$04kZDuJWVQsAGlaR6SYvi.PE0r8AEjdSBHXynO0ncf7qjpPCzCaWi', 0, '2022-05-08', '../image/image.png', NULL, NULL),
(240, '201915079108', 'student', 'Laurella', 'Ellerby', 'Botton', 'Female', '1996-08-03', '09884654034', 'laurellaellerby@gmail.com', '89660 Hallows Pass', '$2y$10$WMtVy2aynr70qubHv2qM0Ob8faOaV2SO7FixZOx5XqqycOWFetT/m', 0, '2023-12-26', '../image/image.png', NULL, NULL),
(241, '201915079109', 'student', 'Benedicto', 'Ellsbury', 'Wiersma', 'Male', '1998-04-16', '09779675560', 'benedictoellsbury@gmail.com', '52 Spaight Hill', '$2y$10$Thn8.poKWHCAogCQiVUWVeYDYwUmAXQdsL/LycO.dQDZbcH2ZrDVS', 0, '2020-04-17', '../image/image.png', NULL, NULL),
(242, '201915079110', 'student', 'Katti', 'Slisby', 'McIlwraith', 'Female', '1997-05-10', '09594483191', 'kattislisby@gmail.com', '15 Comanche Place', '$2y$10$QSAwl2jYFCY.zx0o9z7gKOEdHlFLfZqylTKMcU5/zMlDTh6IdqG9W', 0, '2020-05-27', '../image/image.png', NULL, NULL),
(243, '201915079111', 'student', 'Lonnie', 'Pinshon', 'Pering', 'Female', '1994-10-05', '09636176056', 'lonniepinshon@gmail.com', '2366 Nobel Point', '$2y$10$4GLcbnukqEG5TJ7Ggkzm5uRn8Oor.UtJei1lq1ZEJ6r5OdTJ4lGH6', 0, '2023-05-08', '../image/image.png', NULL, NULL),
(244, '201915079112', 'student', 'Fanny', 'Denziloe', 'Scanterbury', 'Female', '1997-12-04', '09217488968', 'fannydenziloe@gmail.com', '69838 Mosinee Lane', '$2y$10$2IpO81e9cgDqr0z/5f4g8.F/eR38hjSK5yeMZqcDeA.Wy7UMtGm3W', 0, '2020-11-16', '../image/image.png', NULL, NULL),
(245, '201915079113', 'student', 'Dolley', 'Edgeley', 'Scorer', 'Female', '1997-09-03', '09493809287', 'dolleyedgeley@gmail.com', '8 Pankratz Hill', '$2y$10$i3rk7Om5LXNR/npGyis7DObAcdnQFuLRy6Zt6ysoQGBuUToOCV1pG', 0, '2022-09-27', '../image/image.png', NULL, NULL),
(246, '201915079114', 'student', 'Briana', 'Ronald', 'Griswaite', 'Female', '1994-10-30', '09936309280', 'brianaronald@gmail.com', '49671 Pleasure Hill', '$2y$10$0G4KoSTZy4gJCZ455lrzSOn.dQqfd4mmFfswKTpUAcP7DW0D19W6C', 0, '2022-04-29', '../image/image.png', NULL, NULL),
(247, '201915079115', 'student', 'Orville', 'Radage', 'Halladay', 'Male', '1998-08-24', '09900857614', 'orvilleradage@gmail.com', '59 Hoffman Road', '$2y$10$H7nCj2dy6n62s.c6M.y9iufhQ2P4vqCPEcuOVzp4VxQtUdqBHP5SK', 0, '2023-12-19', '../image/image.png', NULL, NULL),
(248, '201915079116', 'student', 'Ulrica', 'Ubsdale', 'Witcher', 'Female', '1997-05-23', '09725000580', 'ulricaubsdale@gmail.com', '0 Onsgard Parkway', '$2y$10$Ln7BHxL.zOUnJdIko7U.e.lbjY.b/UCQID5n78.psmTc6fogznPOe', 0, '2020-05-16', '../image/image.png', NULL, NULL),
(249, '201915079117', 'student', 'Gabriella', 'Kunneke', 'Diboll', 'Female', '1994-06-12', '09846904395', 'gabriellakunneke@gmail.com', '3 Norway Maple Hill', '$2y$10$NsKgqcMjjS45ntnRbxBjSu89ajP8sYoyYrCH89w4FQNsz/UmxmvES', 0, '2021-02-20', '../image/image.png', NULL, NULL),
(250, '201915079118', 'student', 'Shellie', 'Boorer', 'Siggin', 'Female', '1998-09-05', '09762206961', 'shellieboorer@gmail.com', '79646 Grasskamp Street', '$2y$10$Xvus.AcDtsozK5sHln0ErOj0rzKQcShASWZC0xDme3Vab4VPLfYV6', 0, '2023-03-24', '../image/image.png', NULL, NULL),
(251, '201915079119', 'student', 'My', 'Castanho', 'Mogenot', 'Male', '1998-03-05', '09002896734', 'mycastanho@gmail.com', '78 Dunning Crossing', '$2y$10$5UEca.5VKpoAIjOngNGjy.UHrSBLOWNHE4a/eOuUpGNl/fKS.5jT.', 0, '2022-08-19', '../image/image.png', NULL, NULL),
(252, '201915079120', 'student', 'Ferdie', 'Rushe', 'Elloit', 'Male', '1997-07-14', '09336592609', 'ferdierushe@gmail.com', '17271 Ridge Oak Lane', '$2y$10$USr9xK.yoR.XiRBB3Tyu4OuxaU0b0FFQEUiPQykO9YfN9cSeI0HzW', 0, '2021-08-19', '../image/image.png', NULL, NULL),
(253, '201915079121', 'student', 'Stewart', 'Gebuhr', 'Beccles', 'Male', '1997-12-07', '09576262758', 'stewartgebuhr@gmail.com', '604 1st Circle', '$2y$10$JYIv7j4BokH.XyWfcdv/d.ZbD9FF4ZsVXm88HE7OwdYfc/0eXhypO', 0, '2022-06-28', '../image/image.png', NULL, NULL),
(254, '201915079122', 'student', 'Karoly', 'Lindermann', 'Behnecke', 'Female', '1999-11-03', '09038339329', 'karolylindermann@gmail.com', '2299 Towne Plaza', '$2y$10$gCDvHusbNAh7961LXlgedOIGd6YB/EJxlGV2FpO93fsj79cZcPMC6', 0, '2020-06-13', '../image/image.png', NULL, NULL),
(255, '201915079123', 'student', 'Pierce', 'Sharland', 'Mordey', 'Male', '1999-09-01', '09020367104', 'piercesharland@gmail.com', '68 Rigney Trail', '$2y$10$YmHIGTJXDSjPQrTto18svOlt6OyS2zRPxpPFSr15CcS17BuE7zXHe', 0, '2021-04-27', '../image/image.png', NULL, NULL),
(256, '201915079124', 'student', 'Cleo', 'Tomsen', 'Panchen', 'Female', '1994-05-29', '09599714066', 'cleotomsen@gmail.com', '81 Warner Park', '$2y$10$6NIeIwWFlQuetUH9/NvLoehvB60uU4NimiOSqJmCuo5I99ZPWqCw.', 0, '2022-05-14', '../image/image.png', NULL, NULL),
(257, '201915079125', 'student', 'Xerxes', 'Heisham', 'Lowdyane', 'Male', '1997-04-19', '09689917393', 'xerxesheisham@gmail.com', '0 Sutteridge Point', '$2y$10$Wz5y0LR/wSol1YFQR5ocN.Cvfumvta5uYzK0Pvexy8.JThIiSmqsO', 0, '2021-01-01', '../image/image.png', NULL, NULL),
(258, '201915079126', 'student', 'Derwin', 'Furze', 'Chritchlow', 'Male', '1997-04-03', '09136358676', 'derwinfurze@gmail.com', '97 Declaration Trail', '$2y$10$FVW0hpbfZiqAAVYFm7sfnu3NObzyZOI2H6q0Al5Xi4ZtoDFXF3U2m', 0, '2023-09-22', '../image/image.png', NULL, NULL),
(259, '201915079127', 'student', 'Eva', 'Merrilees', 'Wickmann', 'Female', '1997-09-23', '09482457565', 'evamerrilees@gmail.com', '2199 Di Loreto Road', '$2y$10$EMOxEsBtmtx4FpbkJlBa2uAk77YNBtoQO4GxeYdz0Z8nS2CbzzVDK', 0, '2021-02-10', '../image/image.png', NULL, NULL),
(260, '201915079128', 'student', 'Kincaid', 'Dwelly', 'Coiley', 'Male', '1999-07-18', '09188849440', 'kincaiddwelly@gmail.com', '7173 Kim Plaza', '$2y$10$5dp0fvPg3SzP6U2R5.qnveA9OccV4IzrKJ1P0N1nHLVS.m..ZfH8i', 0, '2022-07-31', '../image/image.png', NULL, NULL),
(261, '201915079129', 'student', 'Whittaker', 'Jefferys', 'Abelovitz', 'Male', '1996-01-25', '09749536184', 'whittakerjefferys@gmail.com', '87 Ridgeway Junction', '$2y$10$/FbSTZDzs/gl5VaI6SguzOkN1ijjCXjlNxtAs9yMrZbgBU5MOF1cG', 0, '2023-04-04', '../image/image.png', NULL, NULL),
(262, '201915079130', 'student', 'Chalmers', 'Vasilchenko', 'Bircher', 'Male', '1999-04-19', '09111106902', 'chalmersvasilchenko@gmail.com', '95415 Mosinee Plaza', '$2y$10$G8ag.0wAHlJALzKXc.kw.OAg8AmW4B06Yas2JUZa6PDqVapOJ3QZq', 0, '2022-06-06', '../image/image.png', NULL, NULL),
(263, '201915079131', 'student', 'Brent', 'Binstead', 'Middle', 'Male', '1997-02-09', '09138089159', 'brentbinstead@gmail.com', '32 Gerald Street', '$2y$10$1h70UqjHjD0KigzFnEb0d.xAaJcBBHq4zhMG0LWeSkK6bBK3aPzPS', 0, '2021-06-12', '../image/image.png', NULL, NULL),
(264, '201915079132', 'student', 'Pearline', 'Beeck', 'Pavek', 'Female', '1994-08-26', '09165006400', 'pearlinebeeck@gmail.com', '3 Carpenter Court', '$2y$10$6xOEClzTPE/y5UvpmOXobeW4uiE5CNyDEd/CkazJbRWUKJF9hMVfm', 0, '2023-10-25', '../image/image.png', NULL, NULL),
(265, '201915079133', 'student', 'Chase', 'Patman', 'MacTrustram', 'Male', '1999-07-12', '09614659365', 'chasepatman@gmail.com', '92949 North Hill', '$2y$10$doeawRMufSw1OwZcxSLuheddJnv3OWr3i13fjOdghHUKwAoJFuHwO', 0, '2021-10-25', '../image/image.png', NULL, NULL),
(266, '201915079134', 'student', 'Adlai', 'Pavie', 'Allsopp', 'Male', '1997-02-15', '09431891969', 'adlaipavie@gmail.com', '7055 Thierer Circle', '$2y$10$MeLlpD0QHOUMfwN2ATr7hu7KNU3Igw9bgHwuaIERmb94lG9OOcrwS', 0, '2020-09-27', '../image/image.png', NULL, NULL),
(267, '201915079135', 'student', 'Heida', 'Gillon', 'Otson', 'Female', '1996-08-13', '09810282464', 'heidagillon@gmail.com', '06639 Huxley Way', '$2y$10$Z3IWhwootgpEAVEKFmpzmeg9OrFOKKPyq9UKkVMnoI1FRPOc1xBSW', 0, '2020-10-30', '../image/image.png', NULL, NULL),
(268, '201915079136', 'student', 'Carmel', 'Giabucci', 'McGettigan', 'Female', '1996-03-15', '09457314742', 'carmelgiabucci@gmail.com', '60881 Fuller Pass', '$2y$10$1NhIO1kafR3XSq4/pgwE7.q./rCOOW5YHE2eeDgk0wwe70mc7g0zC', 0, '2021-10-01', '../image/image.png', NULL, NULL),
(269, '201915079137', 'student', 'Kimball', 'Jury', 'Oldershaw', 'Male', '1995-02-17', '09285386866', 'kimballjury@gmail.com', '0 Welch Park', '$2y$10$o9sdUWoYf2Y3NHHacEjS7OVNXH91X0DsveaQyTwCkQboaOQaKWVJ6', 0, '2020-08-10', '../image/image.png', NULL, NULL),
(270, '201915079138', 'student', 'Valentino', 'Rumble', 'Casley', 'Male', '1996-06-20', '09331974690', 'valentinorumble@gmail.com', '63478 Aberg Terrace', '$2y$10$V3xVR7VRK8qmfwkMwZZumu1MqR7Ga1DXYUXYCzVMmiVDsrQZ8qotS', 0, '2023-08-11', '../image/image.png', NULL, NULL),
(271, '201915079139', 'student', 'Myles', 'Brome', 'Kuscha', 'Male', '1997-06-16', '09903670801', 'mylesbrome@gmail.com', '92 Muir Crossing', '$2y$10$Q3XzLmyssnoniC6VGDet.epAISffU0oo5YWsLjGK4zavnjl607hvK', 0, '2024-02-18', '../image/image.png', NULL, NULL),
(272, '201915079140', 'student', 'Derward', 'Zaniolo', 'Cheale', 'Male', '1996-09-10', '09308801171', 'derwardzaniolo@gmail.com', '3592 Aberg Street', '$2y$10$GgkkMmRMy69nRSxrtvUvJu26nWNv1saYbrrZgIINqwFiklFcddQzG', 0, '2022-09-09', '../image/image.png', NULL, NULL),
(273, 'N/A', 'teacher', 'Bale', 'Jochens', 'Darcey', 'Male', '1995-10-19', '09447485866', 'balejochens@gmail.com', '26356 Old Shore Lane', '$2y$10$rPOxlwmzDijkFKm34DfyreZT59mHeE4asUjtNXT1FnfmztPrTZyLi', 0, '2021-12-20', '../image/image.png', NULL, NULL),
(274, 'N/A', 'teacher', 'Culley', 'Shearwood', 'Dougan', 'Male', '1995-01-07', '09773672188', 'culleyshearwood@gmail.com', '154 Emmet Junction', '$2y$10$/pQuGQQjmyLNRWRP9xPeeuKwCkb2iWICvhwxBBSe9vjD9pWsCCB8.', 0, '2020-09-03', '../image/image.png', NULL, NULL),
(275, 'N/A', 'teacher', 'Ruthanne', 'Moakson', 'Huddleston', 'Female', '1996-12-13', '09587382828', 'ruthannemoakson@gmail.com', '973 Corry Parkway', '$2y$10$ojVGRC66GDcXx3nwrL3ZMO0kl0oJdRgOEO3FjLqR/55ExCbK2.1CS', 0, '2022-09-17', '../image/image.png', NULL, NULL),
(276, 'N/A', 'teacher', 'Natale', 'Sutherland', 'Timeby', 'Male', '1996-03-16', '09713503564', 'natalesutherland@gmail.com', '85763 Anzinger Alley', '$2y$10$L/qIzVGOPIGNcbH8u920vOazvQn0p3y1Y.ZTgiFWqFsPd.7lna6Um', 0, '2020-07-02', '../image/image.png', NULL, NULL),
(277, 'N/A', 'teacher', 'Ren', 'Dimabogte', 'Capacio', 'Male', '1996-03-05', '09710456241', 'rendimabogte@gmail.com', '583 Utah Court', '$2y$10$wKV9nC1rgTobLuZDB27VW.Nc34VgzUkBrmCVVkqFiuD/oNSX6WcDS', 0, '2021-10-21', '../image/image.png', NULL, NULL),
(278, 'N/A', 'teacher', 'Benyamin', 'Duhig', 'Draysey', 'Male', '1999-08-04', '09014100369', 'benyaminduhig@gmail.com', '23 Messerschmidt Lane', '$2y$10$Lh8h3DgeBaMqZqD0zTcZ3.6ocJHHczrj7USGSa1DJ4qCrRP/6DEVi', 0, '2023-11-05', '../image/image.png', NULL, NULL),
(279, 'N/A', 'teacher', 'Nicholas', 'Lehenmann', 'McTaggart', 'Male', '1998-10-06', '09602051355', 'nicholaslehenmann@gmail.com', '028 Northland Pass', '$2y$10$Fn8I8TUVhjOdTDAwzmJBkeNASxY25zVA96pLR6OAvo32PshPyEB/e', 0, '2022-08-31', '../image/image.png', NULL, NULL),
(280, 'N/A', 'teacher', 'Myca', 'Thomazin', 'Rubbens', 'Male', '1999-11-11', '09474649640', 'mycathomazin@gmail.com', '4519 Meadow Valley Road', '$2y$10$ynwsZXhUZbulJuJVF1orT.5axlJUVIVI2iLEK4.rlOdAMAEiohrl6', 0, '2023-08-17', '../image/image.png', NULL, NULL),
(281, 'N/A', 'teacher', 'Winnie', 'Odcroft', 'Wafer', 'Female', '1995-12-14', '09436978314', 'winnieodcroft@gmail.com', '38 Mallard Street', '$2y$10$t3mF9pehs1752vcqV67.f.bY1L6Dcb0Y3D0BZ4CIxvYGgGDSBeNli', 0, '2021-01-19', '../image/image.png', NULL, NULL),
(282, 'N/A', 'teacher', 'Malynda', 'Scuse', 'Amyes', 'Female', '1999-10-14', '09225644726', 'malyndascuse@gmail.com', '9 Jay Point', '$2y$10$e3bktyyADJsBCI1emuKRmOSV.sFzSML.7SREcaeW7kbdQWYW/n/M2', 0, '2022-09-28', '../image/image.png', NULL, NULL),
(283, 'N/A', 'teacher', 'Laurice', 'Mityashin', 'Sutlieff', 'Female', '1999-08-31', '09614467261', 'lauricemityashin@gmail.com', '38 Coolidge Plaza', '$2y$10$gwzpUD4eNf/NJrO2c87X1.4vFrYCcIHZLUiv2WKBkNlozS8gnYuPi', 0, '2022-06-25', '../image/image.png', NULL, NULL),
(284, 'N/A', 'teacher', 'Giordano', 'Pund', 'Rutt', 'Male', '1994-08-29', '09983548609', 'giordanopund@gmail.com', '89345 Straubel Parkway', '$2y$10$XQNW9EyIuQbe13HzKYk5AOJoDlvHsDGoGmCOjqixUrT4HaY9DT2xy', 0, '2021-03-05', '../image/image.png', NULL, NULL),
(285, 'N/A', 'teacher', 'Grantham', 'Lempke', 'Strafford', 'Male', '1996-09-04', '09428972544', 'granthamlempke@gmail.com', '1 Coolidge Center', '$2y$10$SvfcTqGkoJMQfdvc8Nc34uNjGKq2ZdO04M5DXeh3Ll0YtxESFc8L2', 0, '2021-03-28', '../image/image.png', NULL, NULL),
(286, 'N/A', 'teacher', 'Kurtis', 'Jennings', 'Hasling', 'Male', '1999-11-24', '09554191492', 'kurtisjennings@gmail.com', '7324 Golf Course Point', '$2y$10$qYyagqI4xFASR7fcy6HChuT/eZDzvavfDqzEA5sJ5uEaEVRrOtui.', 0, '2023-08-19', '../image/image.png', NULL, NULL),
(287, 'N/A', 'teacher', 'Davey', 'Swatridge', 'Giacopelo', 'Male', '1997-04-30', '09464616860', 'daveyswatridge@gmail.com', '56 Walton Crossing', '$2y$10$n3lRQHno20KXVFh1zzqy2e/NOdIFmSFVHZ3kracQTFk83fmQ.J6n6', 0, '2021-03-23', '../image/image.png', NULL, NULL),
(288, 'N/A', 'teacher', 'Sharyl', 'Forseith', 'Crosfeld', 'Female', '1998-04-05', '09146376161', 'sharylforseith@gmail.com', '31823 Commercial Circle', '$2y$10$MTvGFi4GlgC5C63yGrzK3.V268FDHOnFTc9.B0ahfvwsU3fMLd5dS', 0, '2022-12-21', '../image/image.png', NULL, NULL),
(289, 'N/A', 'teacher', 'Malina', 'Shawley', 'Trunkfield', 'Female', '1995-10-13', '09693696945', 'malinashawley@gmail.com', '3 Judy Drive', '$2y$10$vMKNSbrGwyG8wNipgv4jHOumkdcrWqLUej2KqFv8EnuQCn5ipL0aS', 0, '2021-05-08', '../image/image.png', NULL, NULL),
(290, 'N/A', 'teacher', 'Huey', 'Franklyn', 'McCaughey', 'Male', '1995-06-16', '09332040995', 'hueyfranklyn@gmail.com', '900 Mesta Trail', '$2y$10$d5SpQYaHAUziRFDMBxN64u35QwNIs9q0OTmyTtcephsRrg0b2azPG', 0, '2021-09-20', '../image/image.png', NULL, NULL),
(291, 'N/A', 'teacher', 'Rollie', 'Duce', 'Leetham', 'Male', '1998-08-10', '09186859403', 'rollieduce@gmail.com', '1528 Oakridge Way', '$2y$10$pWlAAD.UlypTJGzLPkj6U..rnVh04qj4Ono72g3hGqBFp.dnWEjVi', 0, '2020-11-20', '../image/image.png', NULL, NULL),
(292, 'N/A', 'teacher', 'Zebulon', 'Creber', 'Espela', 'Male', '1995-11-06', '09448530468', 'zebuloncreber@gmail.com', '295 Roxbury Way', '$2y$10$trBq9rttiEcIbmBb0ywRquXqnAS0SF0WVW0kVDCeMsv5OE9qriAXi', 0, '2023-02-11', '../image/image.png', NULL, NULL),
(295, '123123123221', 'student', 'Jeshua', 'Bay', 'Espela', 'Male', '1999-12-06', '09284310661', 'jeshuabay@gmail.com', 'Tanza, Cavite', '$2y$10$jQVCYNlIAn1iqDkWjHU8B.tPwNSU2y.UOpMB3z65f5xov0ZuopmSG', 0, '2024-06-14', '../image/image.png', NULL, NULL),
(305, '555555555555', 'student', 'Roi', 'Badayos', 'Espela', 'Male', '1999-12-06', '09284310661', 'roibadayos@gmail.com', 'Tanza, Cavite', '$2y$10$jh8cMSsXsTp/bNwzCm8nOOaAgbeGKlUUWWZIJSbAQgAGGZUZBRANK', 0, '2024-06-18', '../image/image.png', NULL, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `enroll_student`
--
ALTER TABLE `enroll_student`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=804;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1362;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
