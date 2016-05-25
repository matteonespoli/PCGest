-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mag 23, 2016 alle 13:55
-- Versione del server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pcgest`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `campo`
--

CREATE TABLE IF NOT EXISTS `campo` (
`id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fill` varchar(6) NOT NULL,
  `label` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `campo`
--

INSERT INTO `campo` (`id`, `x`, `y`, `w`, `h`, `tipo`, `fill`, `label`) VALUES
(32, 0, 0, 45, 45, 0, '', 'S1'),
(33, 2, 0, 225, 135, 4, '', 'S2'),
(34, 0, 4, 90, 90, 2, '', 'S3'),
(35, 2, 6, 90, 90, 2, '', 'S4'),
(36, 5, 4, 135, 135, 3, '', 'S5');

-- --------------------------------------------------------

--
-- Struttura della tabella `personali`
--

CREATE TABLE IF NOT EXISTS `personali` (
`id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `tessera` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `value` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'Hcampo', '10'),
(2, 'Wcampo', '25');

-- --------------------------------------------------------

--
-- Struttura della tabella `sfollati`
--

CREATE TABLE IF NOT EXISTS `sfollati` (
`id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `datanascita` date NOT NULL,
  `codicefiscale` varchar(16) NOT NULL,
  `indirizzo` varchar(40) NOT NULL,
  `comune` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sfollati`
--

INSERT INTO `sfollati` (`id`, `nome`, `cognome`, `datanascita`, `codicefiscale`, `indirizzo`, `comune`) VALUES
(1, 'Matteo', 'Nespoli', '1997-12-23', 'NSPMTT97T23I628Z', 'Via Liberta', 'Zanica');

-- --------------------------------------------------------

--
-- Struttura della tabella `specializzazioni`
--

CREATE TABLE IF NOT EXISTS `specializzazioni` (
`id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `codicefiscale` varchar(16) NOT NULL,
  `codicesanitario` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `codicefiscale`, `codicesanitario`) VALUES
(1, 'Matteo', 'Nespoli', 'NSPMTT97T23I628Z', '030509TF524');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campo`
--
ALTER TABLE `campo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personali`
--
ALTER TABLE `personali`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sfollati`
--
ALTER TABLE `sfollati`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializzazioni`
--
ALTER TABLE `specializzazioni`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campo`
--
ALTER TABLE `campo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `personali`
--
ALTER TABLE `personali`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sfollati`
--
ALTER TABLE `sfollati`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `specializzazioni`
--
ALTER TABLE `specializzazioni`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
