-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 26, 2025 at 08:12 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cartelements`
--

CREATE TABLE `cartelements` (
  `elementId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `musicId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `konta`
--

INSERT INTO `konta` (`id`, `login`, `haslo`) VALUES
(1, 'admin', 'admin'),
(2, 'root', 'root'),
(93, 'Pawel', 'pawel');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `musicsale`
--

CREATE TABLE `musicsale` (
  `id` int(11) NOT NULL,
  `title` varchar(70) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `track` varchar(125) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `PTS` time DEFAULT NULL,
  `PTE` time DEFAULT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `musicsale`
--

INSERT INTO `musicsale` (`id`, `title`, `author`, `track`, `image`, `PTS`, `PTE`, `cost`, `publisher`) VALUES
(1, 'Ustable Abstraction', 'PolanaZ', 'Music/PolanaZ - Ustable Abstraction.mp3', NULL, '00:00:43', '00:01:04', 10.00, 'admin'),
(2, 'Simple me', 'PolanaZ', 'Music/PolanaZ - Simple me.mp3', NULL, '00:00:57', '00:01:18', 10.00, 'admin'),
(3, 'A little bit lost', 'PolanaZ', 'Music/PolanaZ - A little bit lost.mp3', 'Images/Allitle.png', '00:01:21', '00:01:36', 10.00, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shopcart`
--

CREATE TABLE `shopcart` (
  `cartId` int(11) NOT NULL,
  `ownerLogin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cartelements`
--
ALTER TABLE `cartelements`
  ADD PRIMARY KEY (`elementId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `musicId` (`musicId`);

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `haslo` (`haslo`);

--
-- Indeksy dla tabeli `musicsale`
--
ALTER TABLE `musicsale`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `shopcart`
--
ALTER TABLE `shopcart`
  ADD PRIMARY KEY (`cartId`),
  ADD UNIQUE KEY `ownerLogin` (`ownerLogin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartelements`
--
ALTER TABLE `cartelements`
  MODIFY `elementId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konta`
--
ALTER TABLE `konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `musicsale`
--
ALTER TABLE `musicsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shopcart`
--
ALTER TABLE `shopcart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartelements`
--
ALTER TABLE `cartelements`
  ADD CONSTRAINT `cartelements_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `shopcart` (`cartId`) ON DELETE CASCADE,
  ADD CONSTRAINT `cartelements_ibfk_2` FOREIGN KEY (`musicId`) REFERENCES `musicsale` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
