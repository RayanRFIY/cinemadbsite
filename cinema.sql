-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 04, 2024 alle 23:13
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attori`
--

CREATE TABLE `attori` (
  `CodAttore` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `AnnoNascita` int(11) NOT NULL,
  `Nazionalita` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `attori`
--

INSERT INTO `attori` (`CodAttore`, `Nome`, `AnnoNascita`, `Nazionalita`) VALUES
(1, 'timothee chalamet', 1995, 'francia'),
(2, 'zendaya', 1996, 'usa'),
(3, 'saroirse ronan', 1994, 'usa'),
(4, 'omar sy', 1978, 'francia'),
(5, 'emma watson', 1990, 'inghilterra'),
(6, 'toni servillo', 1959, 'italia'),
(7, 'ryan reynolds', 1976, 'usa'),
(8, 'matthew mc', 1969, 'usa'),
(9, 'anne hathaway', 1982, 'usa'),
(10, 'michael caine', 1933, 'inghilterra'),
(11, 'leonardo dicaprio', 1974, 'usa'),
(12, 'vera farmiga', 1973, 'usa'),
(13, 'patrick wilson', 1973, 'usa'),
(14, 'ethan hawke', 1970, 'usa'),
(15, 'roberto benigni', 1952, 'italia'),
(16, 'audrey tautou', 1976, 'francia'),
(17, 'christoph waltz', 1956, 'germania'),
(18, 'daniel craig', 1968, 'inghilterra'),
(19, 'jamie foxx', 1967, 'usa'),
(20, 'brad pitt', 1963, 'usa'),
(21, 'tom hardy', 1977, 'inghilterra'),
(22, 'cillian murphy', 1976, 'irlanda'),
(23, 'massimo troisi', 1953, 'italia'),
(24, 'daniel radcliffe', 1989, 'inghilterra'),
(25, 'rupert grint', 1988, 'inghilterra'),
(26, 'stefano accorsi', 1971, 'italia'),
(27, 'pierfrancesco favino', 1969, 'italia'),
(28, 'natalie portman', 1981, 'usa'),
(29, 'shailene woodley', 1991, 'usa'),
(30, 'raul bova', 1971, 'italia'),
(31, 'jennifer aniston', 1969, 'usa'),
(32, 'gwyneth paltrow', 1972, 'usa');

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE `film` (
  `CodFilm` int(11) NOT NULL,
  `Titolo` varchar(30) NOT NULL,
  `AnnoProduzione` int(11) NOT NULL,
  `Nazionalita` varchar(30) NOT NULL,
  `Regista` varchar(30) NOT NULL,
  `Genere` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`CodFilm`, `Titolo`, `AnnoProduzione`, `Nazionalita`, `Regista`, `Genere`) VALUES
(1, 'dune', 2021, 'usa', 'villenueve', 'azione'),
(2, 'lady bird', 2017, 'usa', 'gerwig', 'drammatico'),
(3, 'quasi amici', 2011, 'francia', 'nakache', 'drammatico'),
(4, 'piccole donne', 2019, 'usa', 'gerwig', 'drammatico'),
(5, 'la grande bellezza', 2013, 'italia', 'sorrentino', 'drammatico'),
(6, 'free guy', 2021, 'usa', 'levy', 'commedia'),
(7, 'cena con delitto', 2019, 'usa', 'johnson', 'commedia'),
(8, 'interstellar', 2014, 'usa', 'nolan', 'fantascienza'),
(9, 'inception', 2010, 'usa', 'nolan', 'fantascienza'),
(10, 'the conjuring', 2013, 'usa', 'wan', 'horror'),
(11, 'sinister', 2012, 'usa', 'derrickson', 'horror'),
(12, 'la vita Ã¨ bella', 1997, 'italia', 'benigni', 'storico'),
(13, 'il favoloso mondo di amelie', 2001, 'francia', 'jeunet', 'commedia'),
(14, 'no time to die', 2021, 'usa', 'fukunaga', 'azione'),
(15, 'django unchained', 2012, 'usa', 'tarantino', 'western'),
(16, 'bastardi senza gloria', 2009, 'usa', 'tarantino', 'storico'),
(17, 'dunkirk', 2017, 'usa', 'nolan', 'storico'),
(18, 'revenant', 2015, 'usa', 'inarrutu', 'drammatico'),
(19, 'ricomincio da tre', 1981, 'italia', 'troisi', 'commedia'),
(20, 'the departed', 2006, 'usa', 'scorsese', 'azione');

-- --------------------------------------------------------

--
-- Struttura della tabella `proiezioni`
--

CREATE TABLE `proiezioni` (
  `CodProiezione` int(11) NOT NULL,
  `CodFilm` int(11) NOT NULL,
  `CodSala` int(11) NOT NULL,
  `Incasso` decimal(10,2) DEFAULT NULL,
  `OraProiezione` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `proiezioni`
--

INSERT INTO `proiezioni` (`CodProiezione`, `CodFilm`, `CodSala`, `Incasso`, `OraProiezione`) VALUES
(1, 1, 1, 3000.00, '18:30:00'),
(2, 1, 2, 400.00, '20:40:00'),
(3, 1, 4, 1000.00, '20:45:00'),
(4, 2, 5, 2300.00, '22:40:00'),
(5, 2, 7, 1000.00, '19:30:00'),
(6, 2, 14, 700.00, '20:25:00'),
(7, 3, 15, 900.00, '20:55:00'),
(8, 3, 10, 1100.00, '22:05:00'),
(9, 3, 4, NULL, '21:05:00'),
(10, 4, 7, NULL, '21:15:00'),
(11, 4, 9, 400.00, '18:40:00'),
(12, 4, 11, NULL, '19:40:00'),
(13, 5, 1, 1100.00, '20:45:00'),
(14, 5, 2, 2400.00, '22:40:00'),
(15, 5, 4, 1300.00, '19:30:00'),
(16, 6, 8, 800.00, '20:25:00'),
(17, 6, 6, 700.00, '20:55:00'),
(18, 6, 7, 1100.00, '22:05:00'),
(19, 7, 7, NULL, '21:05:00'),
(20, 7, 8, NULL, '21:15:00'),
(21, 7, 9, 300.00, '18:40:00'),
(22, 8, 8, NULL, '19:40:00'),
(23, 8, 9, NULL, '19:40:00'),
(24, 8, 10, NULL, '19:40:00'),
(25, 9, 9, 1100.00, '20:55:00'),
(26, 9, 10, 2400.00, '22:30:00'),
(27, 9, 11, 1300.00, '19:20:00'),
(28, 10, 10, 800.00, '20:15:00'),
(29, 10, 11, 700.00, '20:45:00'),
(30, 10, 12, 1100.00, '22:05:00'),
(31, 11, 11, NULL, '21:15:00'),
(32, 11, 12, NULL, '21:25:00'),
(33, 11, 13, 300.00, '18:30:00'),
(34, 12, 12, NULL, '19:50:00'),
(35, 12, 11, NULL, '19:40:00'),
(36, 13, 10, NULL, '19:20:00'),
(37, 13, 14, 1100.00, '20:55:00'),
(38, 14, 4, 2400.00, '22:30:00'),
(39, 14, 5, 1300.00, '19:20:00'),
(40, 14, 8, 800.00, '20:15:00'),
(41, 14, 9, 700.00, '20:45:00'),
(42, 15, 1, 1100.00, '22:05:00'),
(43, 15, 2, NULL, '21:15:00'),
(44, 15, 4, NULL, '21:25:00'),
(45, 16, 7, 300.00, '18:30:00'),
(46, 16, 8, NULL, '19:50:00'),
(47, 16, 2, NULL, '19:40:00'),
(48, 17, 8, NULL, '19:20:00'),
(49, 17, 9, 1100.00, '20:55:00'),
(50, 17, 10, 2400.00, '22:30:00'),
(51, 17, 11, 1300.00, '19:20:00'),
(52, 18, 9, 800.00, '20:15:00'),
(53, 18, 10, 700.00, '20:45:00'),
(54, 18, 14, 1100.00, '22:05:00'),
(55, 19, 7, NULL, '21:15:00'),
(56, 19, 8, NULL, '21:25:00'),
(57, 19, 14, 300.00, '18:30:00'),
(58, 20, 1, NULL, '19:50:00'),
(59, 20, 2, NULL, '19:40:00'),
(60, 20, 4, NULL, '19:40:00'),
(61, 20, 8, NULL, '19:20:00'),
(62, 1, 5, 4000.00, '20:55:00'),
(63, 2, 15, 3000.00, '19:20:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `IDRecensione` int(11) NOT NULL,
  `Voto` int(11) NOT NULL,
  `CodFilm` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `recensioni`
--

INSERT INTO `recensioni` (`IDRecensione`, `Voto`, `CodFilm`, `Username`) VALUES
(1, 3, 1, 'Ut1'),
(2, 5, 1, 'Ut2'),
(3, 1, 1, 'Ut3'),
(4, 5, 1, 'Ut4'),
(5, 5, 8, 'Ut5'),
(6, 5, 8, 'Ut5'),
(7, 2, 11, 'Ut2'),
(8, 4, 16, 'Ut3'),
(9, 5, 16, 'Ut4'),
(10, 1, 17, 'Ut1'),
(11, 4, 17, 'Ut5'),
(12, 1, 6, 'Ut3'),
(13, 1, 6, 'Ut1'),
(14, 4, 9, 'Ut5'),
(15, 3, 13, 'Ut6'),
(16, 5, 12, 'Ut2'),
(17, 5, 12, 'Ut3'),
(18, 5, 18, 'Ut2'),
(19, 1, 1, 'rayan2426');

-- --------------------------------------------------------

--
-- Struttura della tabella `recita`
--

CREATE TABLE `recita` (
  `CodAttore` int(11) NOT NULL,
  `CodFilm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `recita`
--

INSERT INTO `recita` (`CodAttore`, `CodFilm`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 8),
(2, 1),
(3, 2),
(3, 4),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 8),
(9, 8),
(10, 8),
(10, 9),
(11, 9),
(11, 15),
(11, 18),
(11, 20),
(12, 10),
(12, 20),
(13, 10),
(14, 11),
(15, 12),
(15, 19),
(16, 13),
(17, 14),
(17, 15),
(17, 16),
(18, 7),
(18, 14),
(19, 15),
(20, 16),
(21, 9),
(21, 17),
(21, 18),
(22, 9),
(22, 17),
(23, 19);

-- --------------------------------------------------------

--
-- Struttura della tabella `sale`
--

CREATE TABLE `sale` (
  `CodSala` int(11) NOT NULL,
  `Posti` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Citta` varchar(30) NOT NULL,
  `DataApertura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `sale`
--

INSERT INTO `sale` (`CodSala`, `Posti`, `Nome`, `Citta`, `DataApertura`) VALUES
(1, 100, 'the space pisa', 'pisa', '2023-03-08'),
(2, 70, 'pisamovie', 'pisa', '2022-03-05'),
(3, 200, 'ucipisa', 'pisa', '2022-03-01'),
(4, 500, 'the space novoli', 'firenze', '2022-02-28'),
(5, 300, 'firenze movie', 'firenze', '2022-02-23'),
(6, 50, 'uci cinema fir', 'firenze', '2021-05-02'),
(7, 90, 'firenze film', 'firenze', '2000-09-06'),
(8, 290, 'the space salerno', 'salerno', '2001-07-05'),
(9, 300, 'happi maxi nap', 'napoli', '2002-04-16'),
(10, 60, 'napmovie', 'napoli', '2021-03-07'),
(11, 100, 'cinemavell', 'avellino', '2021-03-07'),
(12, 200, 'milamovie', 'milano', '2003-02-22'),
(13, 350, 'the space mi', 'milano', '2004-05-05'),
(14, 120, 'uci cinema tor', 'torino', '2005-06-05'),
(15, 40, 'cinema torino', 'torino', '2005-02-04');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nome` varchar(48) NOT NULL,
  `cognome` varchar(48) NOT NULL,
  `dataRegistrazione` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `email`, `username`, `password`, `nome`, `cognome`, `dataRegistrazione`) VALUES
(4, 'rayan@mohd.com', 'rayan2426', '51f4d0163955c57bbc21742b9f848dca9b5115544a5a58582ad4d3b256ee17dd', 'Rayan', 'Mohd', '2024-03-03');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `attori`
--
ALTER TABLE `attori`
  ADD PRIMARY KEY (`CodAttore`);

--
-- Indici per le tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`CodFilm`);

--
-- Indici per le tabelle `proiezioni`
--
ALTER TABLE `proiezioni`
  ADD PRIMARY KEY (`CodProiezione`),
  ADD KEY `fk_proiezioni_film` (`CodFilm`),
  ADD KEY `fk_proiezione_sala` (`CodSala`);

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`IDRecensione`),
  ADD KEY `fk_recensioni_film` (`CodFilm`);

--
-- Indici per le tabelle `recita`
--
ALTER TABLE `recita`
  ADD PRIMARY KEY (`CodAttore`,`CodFilm`),
  ADD KEY `fk_film_recita` (`CodFilm`);

--
-- Indici per le tabelle `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`CodSala`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attori`
--
ALTER TABLE `attori`
  MODIFY `CodAttore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2851;

--
-- AUTO_INCREMENT per la tabella `film`
--
ALTER TABLE `film`
  MODIFY `CodFilm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `proiezioni`
--
ALTER TABLE `proiezioni`
  MODIFY `CodProiezione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `IDRecensione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `sale`
--
ALTER TABLE `sale`
  MODIFY `CodSala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `proiezioni`
--
ALTER TABLE `proiezioni`
  ADD CONSTRAINT `fk_proiezione_sala` FOREIGN KEY (`CodSala`) REFERENCES `sale` (`CodSala`),
  ADD CONSTRAINT `fk_proiezioni_film` FOREIGN KEY (`CodFilm`) REFERENCES `film` (`CodFilm`);

--
-- Limiti per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  ADD CONSTRAINT `fk_recensioni_film` FOREIGN KEY (`CodFilm`) REFERENCES `film` (`CodFilm`);

--
-- Limiti per la tabella `recita`
--
ALTER TABLE `recita`
  ADD CONSTRAINT `fk_attori_recita` FOREIGN KEY (`CodAttore`) REFERENCES `attori` (`CodAttore`),
  ADD CONSTRAINT `fk_film_recita` FOREIGN KEY (`CodFilm`) REFERENCES `film` (`CodFilm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
