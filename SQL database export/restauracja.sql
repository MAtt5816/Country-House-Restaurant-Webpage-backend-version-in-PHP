-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Gru 2021, 15:59
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `restauracja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `ID` int(10) UNSIGNED NOT NULL,
  `kategoria` enum('Dania główne','Dodatki obiadowe do wyboru','Zupy','Potrawy mączne') NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `cena` decimal(4,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`ID`, `kategoria`, `nazwa`, `cena`) VALUES
(1, 'Dania główne', 'Kotlet schabowy tradycyjny', '9.00'),
(2, 'Dania główne', 'Kotlet schabowy zapiekany serem i pieczarką', '11.00'),
(3, 'Dania główne', 'Pierś z kurczaka w panierce', '9.00'),
(4, 'Dania główne', 'Kotlet mielony', '9.00'),
(5, 'Dania główne', 'Żeberka wieprzowe', '13.00'),
(6, 'Dania główne', 'Bitka wołowa', '12.00'),
(7, 'Dania główne', 'Gołąbek', '11.00'),
(8, 'Dania główne', 'Udko pieczone', '9.00'),
(9, 'Dania główne', 'Kotlet de’volaille z serem i masłem', '11.00'),
(10, 'Dania główne', 'Gulasz wieprzowy warzywami', '11.00'),
(11, 'Dania główne', 'Placek po węgiersku', '20.00'),
(12, 'Dania główne', 'Filet z dorsza w delikatnej panierce', '12.00'),
(13, 'Dodatki obiadowe do wyboru', 'Frytki', '5.00'),
(14, 'Dodatki obiadowe do wyboru', 'Ziemniaki', '5.00'),
(15, 'Dodatki obiadowe do wyboru', 'Ziemniaki opiekane', '6.00'),
(16, 'Dodatki obiadowe do wyboru', 'Chleb (2 kromki)', '1.00'),
(17, 'Dodatki obiadowe do wyboru', 'Zestaw surówek', '5.00'),
(18, 'Dodatki obiadowe do wyboru', 'Kapusta zasmażana', '5.00'),
(19, 'Dodatki obiadowe do wyboru', 'Ketchup / musztarda', '1.00'),
(20, 'Zupy', 'Pomidorowa', '6.00'),
(21, 'Zupy', 'Żurek staropolski', '8.00'),
(22, 'Zupy', 'Flaki wołowe', '9.00'),
(23, 'Zupy', 'Barszcz ukraiński', '7.00'),
(24, 'Zupy', 'Barszcz czerwony z uszkami', '7.00'),
(25, 'Zupy', 'Grochowa', '7.00'),
(26, 'Zupy', 'Rosół domowy', '5.00'),
(27, 'Zupy', 'Ogórkowa', '7.00'),
(28, 'Zupy', 'Szczawiowa', '6.00'),
(29, 'Potrawy mączne', 'Pierogi z mięsem', '14.00'),
(30, 'Potrawy mączne', 'Pierogi z kapustą', '14.00'),
(31, 'Potrawy mączne', 'Pierogi ruskie', '14.00'),
(32, 'Potrawy mączne', 'Pierogi z serem', '14.00'),
(33, 'Potrawy mączne', 'Placki ziemniaczane ze śmietaną (3 szt.)', '9.00'),
(34, 'Potrawy mączne', 'Naleśniki z serem, bitą śmietaną i owocami (1 szt.)', '4.00'),
(35, 'Potrawy mączne', 'Kluski leniwe na słodko', '10.00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
