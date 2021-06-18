-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2021 m. Bir 18 d. 03:19
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faceboek`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `jausmazenkliai`
--

CREATE TABLE `jausmazenkliai` (
  `Jausmazenklis` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Jausmazenklio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `jausmazenkliai`
--

INSERT INTO `jausmazenkliai` (`Jausmazenklis`, `Jausmazenklio_id`) VALUES
('Like', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `komentarai`
--

CREATE TABLE `komentarai` (
  `Komentaro_id` int(11) NOT NULL,
  `Tekstas` text COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Sukurimo_data` datetime NOT NULL,
  `Redagavimo_data` datetime NOT NULL DEFAULT '2011-01-26 14:30:00',
  `Pranesimas` int(11) NOT NULL,
  `Autorius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `komentaru_reakcijos`
--

CREATE TABLE `komentaru_reakcijos` (
  `Jausmazenklio_id` int(11) NOT NULL,
  `Komentaro_id` int(11) NOT NULL,
  `Vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pranesimai`
--

CREATE TABLE `pranesimai` (
  `Pranesimo_id` int(11) NOT NULL,
  `Autorius` int(11) NOT NULL,
  `Tekstas` text COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Sukurimo_data` datetime NOT NULL,
  `Redagavimo_data` datetime NOT NULL,
  `Nuotrauka` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pranesimu_reakcijos`
--

CREATE TABLE `pranesimu_reakcijos` (
  `Jausmazenklio_id` int(11) NOT NULL,
  `Pranesimo_id` int(11) NOT NULL,
  `Vartotojo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `vartotojai`
--

CREATE TABLE `vartotojai` (
  `Vartotojo_id` int(11) NOT NULL,
  `Vardas` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Pavarde` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Slaptazodis` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Profilio_nuotrauka` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Telefono_nr` int(11) NOT NULL,
  `Bio` varchar(101) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `Virselio_nuotrauka` varchar(255) COLLATE utf8mb4_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `vartotojai`
--

INSERT INTO `vartotojai` (`Vartotojo_id`, `Vardas`, `Pavarde`, `Email`, `Slaptazodis`, `Profilio_nuotrauka`, `Telefono_nr`, `Bio`, `Virselio_nuotrauka`) VALUES
(1, 'Brandonas', 'Novakas', 'nova@nova.com', 'Nova1234', '60cb6c935844a6.4817845352782fe60df34b5c977728d06d1a2c80 (1).png', 123123, '', '60cb6ca69ffc21.34949009IMG-7bd44e196cbadd87a925d10915ed114a-V.jpg'),
(22, 'Lukas', 'Enco', 'lukas@lukas.lt', 'Lukas123', '', 12, '', '60cbf3d95d9a84.69989489pexels-christian-domingues-731022 (1).jpg'),
(123, 'Simonas', 'Donskovas', 'gmail@gmail.com', 'Gmail333', '60cb9672d95854.64170844pexels-christian-domingues-731022 (1).jpg', 12345, 'abc', '60cb95f47ea831.99901068undraw_connected_world_wuay.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jausmazenkliai`
--
ALTER TABLE `jausmazenkliai`
  ADD PRIMARY KEY (`Jausmazenklio_id`);

--
-- Indexes for table `komentarai`
--
ALTER TABLE `komentarai`
  ADD PRIMARY KEY (`Komentaro_id`),
  ADD KEY `Komentarai_fk1` (`Autorius`),
  ADD KEY `Pranesimas` (`Pranesimas`),
  ADD KEY `Pranesimas_2` (`Pranesimas`),
  ADD KEY `pranesimo_idx` (`Pranesimas`);

--
-- Indexes for table `komentaru_reakcijos`
--
ALTER TABLE `komentaru_reakcijos`
  ADD KEY `Komentaru_reakcijos_fk0` (`Jausmazenklio_id`),
  ADD KEY `Komentaru_reakcijos_fk2` (`Vartotojas`),
  ADD KEY `Komentaru_reakcijos_fk1` (`Komentaro_id`);

--
-- Indexes for table `pranesimai`
--
ALTER TABLE `pranesimai`
  ADD PRIMARY KEY (`Pranesimo_id`),
  ADD KEY `Pranesimai_fk0` (`Autorius`);

--
-- Indexes for table `pranesimu_reakcijos`
--
ALTER TABLE `pranesimu_reakcijos`
  ADD KEY `Pranesimu_reakcijos_fk0` (`Jausmazenklio_id`),
  ADD KEY `Pranesimo_id` (`Pranesimo_id`),
  ADD KEY `pranesimo_inx` (`Pranesimo_id`),
  ADD KEY `Pranesimu_reakcijos_fk2` (`Vartotojo_id`);

--
-- Indexes for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD PRIMARY KEY (`Vartotojo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `Vartotojo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `komentarai`
--
ALTER TABLE `komentarai`
  ADD CONSTRAINT `Komentarai_fk0` FOREIGN KEY (`Pranesimas`) REFERENCES `pranesimai` (`Pranesimo_id`),
  ADD CONSTRAINT `Komentarai_fk1` FOREIGN KEY (`Autorius`) REFERENCES `vartotojai` (`Vartotojo_id`);

--
-- Apribojimai lentelei `komentaru_reakcijos`
--
ALTER TABLE `komentaru_reakcijos`
  ADD CONSTRAINT `Komentaru_reakcijos_fk0` FOREIGN KEY (`Jausmazenklio_id`) REFERENCES `jausmazenkliai` (`Jausmazenklio_id`),
  ADD CONSTRAINT `Komentaru_reakcijos_fk1` FOREIGN KEY (`Komentaro_id`) REFERENCES `komentarai` (`Komentaro_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Komentaru_reakcijos_fk2` FOREIGN KEY (`Vartotojas`) REFERENCES `vartotojai` (`Vartotojo_id`);

--
-- Apribojimai lentelei `pranesimai`
--
ALTER TABLE `pranesimai`
  ADD CONSTRAINT `Pranesimai_fk0` FOREIGN KEY (`Autorius`) REFERENCES `vartotojai` (`Vartotojo_id`);

--
-- Apribojimai lentelei `pranesimu_reakcijos`
--
ALTER TABLE `pranesimu_reakcijos`
  ADD CONSTRAINT `Pranesimu_reakcijos_fk0` FOREIGN KEY (`Jausmazenklio_id`) REFERENCES `jausmazenkliai` (`Jausmazenklio_id`),
  ADD CONSTRAINT `Pranesimu_reakcijos_fk1` FOREIGN KEY (`Pranesimo_id`) REFERENCES `pranesimai` (`Pranesimo_id`),
  ADD CONSTRAINT `Pranesimu_reakcijos_fk2` FOREIGN KEY (`Vartotojo_id`) REFERENCES `vartotojai` (`Vartotojo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
