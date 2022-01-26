-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Sty 2022, 20:26
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
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `ulica` varchar(100) NOT NULL,
  `numer` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`ID`, `user_ID`, `ulica`, `numer`) VALUES
(1, 1, 'Nowa', '12/1a'),
(3, 3, 'Nowa', '1a'),
(4, 5, 'Stara', '1/12'),
(5, 6, 'Fajna', '13'),
(6, 7, 'Tut', '2'),
(7, 8, 'Werty', '1a/103'),
(8, 9, 'Loki', '10/2'),
(10, 9, 'Nowa', '11c');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_klienta`
--

CREATE TABLE `dane_klienta` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `nr_tel` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dane_klienta`
--

INSERT INTO `dane_klienta` (`ID`, `user_ID`, `imie`, `nazwisko`, `nr_tel`) VALUES
(1, 1, 'Alina', 'Nowak', '444333222'),
(3, 3, 'Jan', 'Kowalski', '555444333'),
(4, 5, 'Anna', 'Nowak', '444555666'),
(5, 6, 'Ada', 'Lada', '111222369'),
(6, 7, 'Kasia', 'Bak', '444999000'),
(7, 8, 'Kamil', 'Stanowski', '111000999'),
(8, 9, 'Mat', 'Lex', '339888777'),
(9, 1, 'Janina', 'Nowak-Janik', '444999222');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lista_pozycji`
--

CREATE TABLE `lista_pozycji` (
  `zamowienie_ID` int(11) NOT NULL,
  `menu_ID` int(10) UNSIGNED NOT NULL,
  `ilosc` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `lista_pozycji`
--

INSERT INTO `lista_pozycji` (`zamowienie_ID`, `menu_ID`, `ilosc`) VALUES
(66, 1, 2),
(66, 5, 3),
(68, 1, 2),
(68, 5, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `ID` int(10) UNSIGNED NOT NULL,
  `kategoria` enum('Dania główne','Dodatki obiadowe do wyboru','Zupy','Potrawy mączne') NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `cena` decimal(4,2) UNSIGNED NOT NULL,
  `name_tag` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`ID`, `kategoria`, `nazwa`, `cena`, `name_tag`) VALUES
(1, 'Dania główne', 'Kotlet schabowy tradycyjny', '9.00', 'tradycyjny'),
(2, 'Dania główne', 'Kotlet schabowy zapiekany serem i pieczarką', '11.00', 'zapiekany'),
(3, 'Dania główne', 'Pierś z kurczaka w panierce', '9.00', 'piers'),
(4, 'Dania główne', 'Kotlet mielony', '9.00', 'mielony'),
(5, 'Dania główne', 'Żeberka wieprzowe', '13.00', 'zeberka'),
(6, 'Dania główne', 'Bitka wołowa', '12.00', 'bitka'),
(7, 'Dania główne', 'Gołąbek', '11.00', 'golabek'),
(8, 'Dania główne', 'Udko pieczone', '9.00', 'udko'),
(9, 'Dania główne', 'Kotlet de’volaille z serem i masłem', '11.00', 'devolaille'),
(10, 'Dania główne', 'Gulasz wieprzowy warzywami', '11.00', 'gulasz'),
(11, 'Dania główne', 'Placek po węgiersku', '20.00', 'wegierski'),
(12, 'Dania główne', 'Filet z dorsza w delikatnej panierce', '12.00', 'filet'),
(13, 'Dodatki obiadowe do wyboru', 'Frytki', '5.00', 'frytki'),
(14, 'Dodatki obiadowe do wyboru', 'Ziemniaki', '5.00', 'ziemniaki'),
(15, 'Dodatki obiadowe do wyboru', 'Ziemniaki opiekane', '6.00', 'opiekane'),
(16, 'Dodatki obiadowe do wyboru', 'Chleb (2 kromki)', '1.00', 'chleb'),
(17, 'Dodatki obiadowe do wyboru', 'Zestaw surówek', '5.00', 'surowki'),
(18, 'Dodatki obiadowe do wyboru', 'Kapusta zasmażana', '5.00', 'kapusta'),
(19, 'Dodatki obiadowe do wyboru', 'Ketchup / musztarda', '1.00', 'ketchup'),
(20, 'Zupy', 'Pomidorowa', '6.00', 'pomidorowa'),
(21, 'Zupy', 'Żurek staropolski', '8.00', 'zurek'),
(22, 'Zupy', 'Flaki wołowe', '9.00', 'flaki'),
(23, 'Zupy', 'Barszcz ukraiński', '7.00', 'ukrainski'),
(24, 'Zupy', 'Barszcz czerwony z uszkami', '7.00', 'barszcz'),
(25, 'Zupy', 'Grochowa', '7.00', 'grochowa'),
(26, 'Zupy', 'Rosół domowy', '5.00', 'rosol'),
(27, 'Zupy', 'Ogórkowa', '7.00', 'ogorek'),
(28, 'Zupy', 'Szczawiowa', '6.00', 'szczawiowa'),
(29, 'Potrawy mączne', 'Pierogi z mięsem', '14.00', 'pierogiMiesne'),
(30, 'Potrawy mączne', 'Pierogi z kapustą', '14.00', 'pierogiKapustne'),
(31, 'Potrawy mączne', 'Pierogi ruskie', '14.00', 'ruskie'),
(32, 'Potrawy mączne', 'Pierogi z serem', '14.00', 'pierogiSerowe'),
(33, 'Potrawy mączne', 'Placki ziemniaczane ze śmietaną (3 szt.)', '9.00', 'placki'),
(34, 'Potrawy mączne', 'Naleśniki z serem, bitą śmietaną i owocami (1 szt.)', '4.00', 'nalesniki'),
(35, 'Potrawy mączne', 'Kluski leniwe na słodko', '10.00', 'leniwe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `login` varchar(35) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`ID`, `login`, `password`) VALUES
(1, 'ama', '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5'),
(3, 'jankowalski', 'b0b448826f1be73e57628aababa7c4a9ef0609ef4eec150a28e716813022cfeb'),
(5, 'annanowak', '7091bfb2bac8a2b9995c510177b3bf8a638e58bd6de0bda9535b62269134a362'),
(6, 'adalada', '7dc41009205afa21baaad63f74ba67e9bddfd780c5510ef1b47e6fa98007135d'),
(7, 'kasiabak', 'fcc99c4b667a6bd873176d77599611718961592804aa2a63c08cca81abe194da'),
(8, 'kamilstan', 'c75d17da3db16bf0530e46c64af1f9cca53bd4fc98e016082afc8565f6eb8064'),
(9, 'matlex', 'db2d5c8379a30a98a13d91890c97e33806733580480dbd8bf600a3a4650ee10c');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `typ` enum('takeaway','delivery') NOT NULL,
  `daneKlienta_ID` int(11) NOT NULL,
  `czasRealizacji_typ` enum('ASAP','date') NOT NULL,
  `dataRealizacji` datetime DEFAULT NULL,
  `adres_ID` int(11) DEFAULT NULL,
  `uwagi` varchar(150) NOT NULL,
  `platnosc` enum('cash','card','voucher') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienie`
--

INSERT INTO `zamowienie` (`ID`, `user_ID`, `data`, `typ`, `daneKlienta_ID`, `czasRealizacji_typ`, `dataRealizacji`, `adres_ID`, `uwagi`, `platnosc`) VALUES
(65, 1, '2022-01-07 10:21:18', 'delivery', 1, 'date', '2022-01-20 15:54:00', 1, 'XASslkajld', 'cash'),
(66, 1, '2022-01-07 10:26:30', 'delivery', 1, 'date', '2022-01-20 15:54:00', 1, 'XASslkajld', 'cash'),
(68, 1, '2022-01-07 10:30:48', 'delivery', 1, 'date', '2022-01-20 15:54:00', 1, 'XASslkajld', 'cash');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indeksy dla tabeli `dane_klienta`
--
ALTER TABLE `dane_klienta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indeksy dla tabeli `lista_pozycji`
--
ALTER TABLE `lista_pozycji`
  ADD KEY `zamowienie_ID` (`zamowienie_ID`),
  ADD KEY `menu_ID` (`menu_ID`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name_tag` (`name_tag`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `dane_klienta`
--
ALTER TABLE `dane_klienta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD CONSTRAINT `adres_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `dane_klienta`
--
ALTER TABLE `dane_klienta`
  ADD CONSTRAINT `dane_klienta_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `lista_pozycji`
--
ALTER TABLE `lista_pozycji`
  ADD CONSTRAINT `lista_pozycji_ibfk_1` FOREIGN KEY (`zamowienie_ID`) REFERENCES `zamowienie` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lista_pozycji_ibfk_2` FOREIGN KEY (`menu_ID`) REFERENCES `menu` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `zamowienie_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
