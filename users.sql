-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 03:51 AM
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
