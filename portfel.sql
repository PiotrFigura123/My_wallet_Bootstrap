-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Lis 2021, 20:19
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `portfel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bilans`
--

CREATE TABLE `bilans` (
  `balanceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `value` float NOT NULL,
  `date` date NOT NULL,
  `incomeFrom` text COLLATE utf8_polish_ci NOT NULL,
  `paidBy` text COLLATE utf8_polish_ci NOT NULL,
  `paidFor` text COLLATE utf8_polish_ci NOT NULL,
  `comment` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `bilans`
--

INSERT INTO `bilans` (`balanceId`, `userId`, `value`, `date`, `incomeFrom`, `paidBy`, `paidFor`, `comment`) VALUES
(3, 2, 620.2, '2021-04-01', '', 'Cash', 'Auto', 'trzeci wydaek'),
(127, 1, 677, '2021-11-06', '', 'Different', 'Auto', 'bbb'),
(128, 1, 111, '2021-11-05', 'Salary', '', '', '111'),
(132, 1, 55, '2021-11-05', '', 'Cash', 'Allegro', 'fgg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logownie`
--

CREATE TABLE `logownie` (
  `userId` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `surename` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `logownie`
--

INSERT INTO `logownie` (`userId`, `name`, `surename`, `email`, `password`) VALUES
(1, 'piotr', 'figa', 'pf@wp.pl', '$2y$10$dWVD2dKuEvzZaE0CHsXaHubWxpnsaMxPkoqX5lkQcsSDkIY9vB6SG'),
(12, 'asdq', 'asdw', 'a@wp.pl', '$2y$10$G.mW5bjpMPg0AjFUM9ejBOSqA4JdRyEW.IK3PWGcsjs95GBhmhaga'),
(13, 'piotr', 'figura', 'a@a.a', '$2y$10$9TSwsoma6.YTwJs6sFlxluCqxSbk4fgVISo307Vek8e/dBBOMsdey');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bilans`
--
ALTER TABLE `bilans`
  ADD PRIMARY KEY (`balanceId`);

--
-- Indeksy dla tabeli `logownie`
--
ALTER TABLE `logownie`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `bilans`
--
ALTER TABLE `bilans`
  MODIFY `balanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT dla tabeli `logownie`
--
ALTER TABLE `logownie`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
