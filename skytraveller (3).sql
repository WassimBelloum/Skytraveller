-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 apr 2021 om 12:54
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skytraveller`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `id` int(128) NOT NULL,
  `voornaam` varchar(128) NOT NULL,
  `achternaam` varchar(128) NOT NULL,
  `geslacht` enum('m','v') NOT NULL,
  `email` varchar(128) NOT NULL,
  `wachtwoord` varchar(20) NOT NULL,
  `telefoonnummer` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`id`, `voornaam`, `achternaam`, `geslacht`, `email`, `wachtwoord`, `telefoonnummer`) VALUES
(13, 'Wassim', 'Belloum', 'm', 'w.y.belloum@hotmail.com', 'test12345', 612345678),
(14, 'Fatine', 'Belloum', 'v', 'f.r.belloum@hotmail.com', 'fatine123', 612345678),
(15, 'noha', 'Belloum', 'v', 'n.a.belloum@hotmail.com', 'noha123', 612345678),
(16, 'adam', 'Belloum', 'm', 'a.s,z.belloum@hotmail.com', 'test12345', 612345656),
(17, 'salima', 'Aissaoui', 'v', 's.aissaoui@hotmail.com', 'test12345', 612345678),
(18, 'yahya', 'Belloum', 'm', 'yahya.belloum@hotmail.com', 'test12345', 626574845),
(19, 'ranime', 'Belloum', 'v', 'ranime.belloum@hotmail.com', 'test12345', 612345678),
(20, 'Henk', 'de Steen', 'm', 'HenkSteen@gmail.com', 'HenkSteen', 634354562),
(22, 'Mark', 'Rutte', 'm', 'MarkRutte@govern.nl', 'avondklok', 626574845),
(23, 'Monkey', 'Black', 'm', 'BlackMonk@gmail.uk', 'MOnk', 643443456),
(24, 'Geert', 'Wilders', 'v', 'Geertje@stupid.com', 'Geertje', 0),
(25, 'Lorenzo', 'Horden', 'm', 'LorenzoHorden@gmail.com', 'Lorenzo12345', 612345678),
(26, 'Soraya', 'Oranje', 'v', 'SorayaOranje@gmail.com', 'Soraya12345', 665748392),
(27, 'Laila', 'Gransjean', 'v', 'L.Gransjean@gmail.com', 'Laila12345', 612345678);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vliegticket`
--

CREATE TABLE `vliegticket` (
  `id` int(128) NOT NULL,
  `klant_id` int(128) NOT NULL,
  `vluchtheen_id` int(255) NOT NULL,
  `vluchtterug_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `vliegticket`
--

INSERT INTO `vliegticket` (`id`, `klant_id`, `vluchtheen_id`, `vluchtterug_id`) VALUES
(7, 14, 1, 3),
(10, 19, 1, 3),
(18, 20, 1, 3),
(19, 22, 1, -1),
(20, 23, 1, 3),
(21, 24, 1, -1),
(22, 25, 1, 3),
(23, 26, 1, 3),
(24, 27, 1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vluchten`
--

CREATE TABLE `vluchten` (
  `id` int(128) NOT NULL,
  `vliegticket_id` int(128) NOT NULL,
  `plaatsvertrek` varchar(128) NOT NULL,
  `plaatsaankomst` varchar(128) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time(6) NOT NULL,
  `prijs` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `vluchten`
--

INSERT INTO `vluchten` (`id`, `vliegticket_id`, `plaatsvertrek`, `plaatsaankomst`, `datum`, `tijd`, `prijs`) VALUES
(1, 0, 'Parijs', 'Rome', '2021-02-27', '09:00:00.000000', 100),
(2, 0, 'Parijs', 'Rome', '2021-03-26', '12:00:00.000000', 150),
(3, 0, 'Rome', 'Parijs', '2021-03-08', '13:00:00.000000', 125),
(4, 0, 'Amsterdam', 'Madrid', '2021-02-21', '08:00:00.000000', 50),
(5, 0, 'Amsterdam', 'Lissabon', '2021-03-22', '19:00:00.000000', 800),
(7, 0, 'Lissabon', 'London', '2021-03-30', '10:00:00.000000', 80),
(8, 0, 'London', 'Lissabon', '2021-04-07', '19:00:00.000000', 90),
(9, 0, 'Berlijn', 'Barcelona', '2021-04-14', '20:00:00.000000', 89),
(10, 0, 'Barcelona', 'Berlijn', '2021-04-21', '08:00:00.000000', 78),
(11, 0, 'Amsterdam', 'London', '2021-04-21', '15:00:00.000000', 50),
(12, 0, 'London', 'Amsterdam', '2021-04-30', '23:00:00.000000', 40),
(13, 0, 'Parijs', 'Moskou', '2021-04-07', '09:00:00.000000', 90),
(14, 0, 'Moskou', 'Parijs', '2021-04-23', '15:00:00.000000', 92),
(15, 0, 'Londen', 'Madrid', '2021-04-12', '14:00:00.000000', 87),
(16, 0, 'Madrid', 'London', '2021-04-07', '02:00:00.000000', 89),
(17, 0, 'Athene', 'Rome', '2021-04-14', '16:00:00.000000', 30),
(18, 0, 'Rome', 'Barcelona', '2021-04-09', '20:00:00.000000', 100),
(19, 0, 'Helsinki', 'Brussel', '2021-04-27', '23:00:00.000000', 81),
(20, 0, 'Stockholm', 'Moskou', '2021-04-29', '07:00:00.000000', 79),
(21, 0, 'Amsterdam', 'Barcelona', '2021-04-07', '18:00:00.000000', 78),
(22, 0, 'Barcelona', 'Amsterdam', '2021-04-14', '11:00:00.000000', 69),
(23, 0, 'Athene', 'Berlijn', '2021-04-21', '10:00:00.000000', 87),
(24, 0, 'Berlijn', 'Athene', '2021-05-11', '04:00:00.000000', 90),
(25, 0, 'Dublin', 'Wenen', '2021-04-29', '16:00:00.000000', 110),
(26, 0, 'Wenen', 'Dublin', '2021-06-03', '23:00:00.000000', 100),
(27, 0, 'Zagreb', 'Kopenhagen', '2021-04-26', '18:00:00.000000', 113),
(28, 0, 'Kopenhagen', 'Zagreb', '2021-04-12', '20:00:00.000000', 100),
(29, 0, 'Zagreb', 'Kopenhagen', '2021-04-13', '07:00:00.000000', 87),
(30, 0, 'Monaco', 'Stockholm', '2021-05-21', '14:00:00.000000', 120),
(31, 0, 'Stockholm', 'Monaco', '2021-04-13', '21:00:00.000000', 100),
(32, 0, 'Madrid', 'Helsinki', '2021-04-14', '14:00:00.000000', 88),
(33, 0, 'Helsinki', 'Madrid', '2021-04-23', '03:00:00.000000', 93),
(34, 0, 'Lissabon', 'Istanbul', '2021-04-11', '17:00:00.000000', 70),
(35, 0, 'Istanbul', 'Lissabon', '2021-04-30', '00:00:00.000000', 80),
(36, 0, 'Algiers', 'Amsterdam', '2021-04-19', '20:00:00.000000', 130),
(37, 0, 'Amsterdam', 'Algiers', '2021-05-04', '18:00:00.000000', 170),
(38, 0, 'Budapest', 'Warschau', '2021-04-12', '14:00:00.000000', 92),
(39, 0, 'Sofia', 'Manchester ', '2021-04-29', '12:00:00.000000', 89),
(40, 0, 'Manchester ', 'Sofia', '2021-04-30', '20:00:00.000000', 98),
(41, 0, 'Praag', 'Dubrovnik', '2021-05-04', '07:00:00.000000', 97),
(42, 0, 'Dubrovnik', 'Praag', '2021-04-12', '10:00:00.000000', 98),
(43, 0, 'Aarhus', 'Luxemburg', '2021-05-19', '22:00:00.000000', 70),
(44, 0, 'Luxemburg', 'Aarhus', '2021-04-14', '09:00:00.000000', 90),
(45, 0, 'Milaan', 'Warschau', '2021-04-14', '18:00:00.000000', 80),
(46, 0, 'Warschau', 'Milaan', '2021-04-14', '05:00:00.000000', 90),
(47, 0, 'Amsterdam', 'Athene', '2021-04-12', '05:00:00.000000', 90),
(48, 0, 'Athene', 'Amsterdam', '2021-04-13', '17:00:00.000000', 80),
(49, 0, 'London', 'Madrid', '2021-04-20', '09:00:00.000000', 87),
(50, 0, 'Madrid', 'London', '2021-05-03', '14:00:00.000000', 86);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vliegticket`
--
ALTER TABLE `vliegticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vluchten`
--
ALTER TABLE `vluchten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `vliegticket`
--
ALTER TABLE `vliegticket`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `vluchten`
--
ALTER TABLE `vluchten`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
