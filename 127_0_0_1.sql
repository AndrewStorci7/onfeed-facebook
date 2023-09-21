-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 07, 2023 alle 00:58
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_soft_pres_on`
--
CREATE DATABASE IF NOT EXISTS `my_soft_pres_on` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `my_soft_pres_on`;

-- --------------------------------------------------------

--
-- Struttura della tabella `diapositiva`
--

CREATE TABLE `diapositiva` (
  `id` int(11) NOT NULL,
  `id_img` int(11) DEFAULT NULL,
  `id_presentazione` int(11) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `ordine` int(11) NOT NULL COMMENT 'Posizione della diapositiva (es: 1a, 2a, 3a ...)',
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `diapositiva`
--

INSERT INTO `diapositiva` (`id`, `id_img`, `id_presentazione`, `nome`, `ordine`, `visible`) VALUES
(1, 1, 1, 'Prima slide', 1, 1),
(2, 2, 1, 'Seconda slide', 2, 1),
(3, 3, 1, 'Terza slide', 3, 1),
(4, 4, 1, 'Quarta slide', 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`id`, `nome`, `path`) VALUES
(1, 'Logo ON con scritta', 'images\\images-uploaded\\Immagine1.png'),
(2, 'Logo ON con immagini intorno', 'images\\images-uploaded\\Immagine2.png'),
(3, 'Immagine di messaggistica', 'images\\images-uploaded\\Immagine3.png'),
(4, 'Immagine degli orari dell\'apertura dell\'ufficio', 'images\\images-uploaded\\Immagine4.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `presentazione`
--

CREATE TABLE `presentazione` (
  `id` int(11) NOT NULL,
  `titolo` varchar(256) NOT NULL,
  `data_last_mod` datetime NOT NULL DEFAULT current_timestamp(),
  `id_utente` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `animazione` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `presentazione`
--

INSERT INTO `presentazione` (`id`, `titolo`, `data_last_mod`, `id_utente`, `descrizione`, `active`, `animazione`) VALUES
(1, 'Presentazione vetrina', '2023-02-03 20:07:12', 3, 'Presentazione per la visualizzazioen degli orari e delle immagini per la vetrina', 1, NULL),
(2, 'Presentazione nuova apertura', '2023-02-06 16:20:16', 3, 'Presentazione di prova', 0, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `password`) VALUES
(1, 'gianluca', '99a02c392d77d35051663b808fc6ee9a'),
(2, 'isabella', '99a02c392d77d35051663b808fc6ee9a'),
(3, 'andrea', '99a02c392d77d35051663b808fc6ee9a');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `diapositiva`
--
ALTER TABLE `diapositiva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_presentazione` (`id_presentazione`) USING BTREE,
  ADD KEY `FK_img` (`id_img`) USING BTREE;

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `presentazione`
--
ALTER TABLE `presentazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_utente` (`id_utente`) USING BTREE;

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `diapositiva`
--
ALTER TABLE `diapositiva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `presentazione`
--
ALTER TABLE `presentazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `diapositiva`
--
ALTER TABLE `diapositiva`
  ADD CONSTRAINT `diapositiva_ibfk_1` FOREIGN KEY (`id_presentazione`) REFERENCES `presentazione` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `diapositiva_ibfk_2` FOREIGN KEY (`id_img`) REFERENCES `immagine` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `presentazione`
--
ALTER TABLE `presentazione`
  ADD CONSTRAINT `presentazione_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
