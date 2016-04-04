-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2016 at 08:49 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_framework`
--
CREATE DATABASE IF NOT EXISTS `my_framework` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_framework`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_sign` datetime NOT NULL,
  `actif` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `lastname`, `firstname`, `password`, `email`, `token`, `date_sign`, `actif`) VALUES
(1, 'lysa', 'ylol', 'chouh', '', '', '', '0000-00-00 00:00:00', 0),
(2, 'alice', 'lol', 'lolololol', '', '', '', '0000-00-00 00:00:00', 0),
(3, 'mamou', 'panda', 'chou', '', '', '', '0000-00-00 00:00:00', 0),
(11, 'njjbhb', 'njjbhb', 'njjbhb', '', '', '', '0000-00-00 00:00:00', 0),
(12, 'njjbhb', 'njjbhb', 'njjbhb', '', '', '', '0000-00-00 00:00:00', 0),
(13, 'njjbhb', 'njjbhb', 'njjbhb', '', '', '', '0000-00-00 00:00:00', 0),
(14, 'jooo', 'njjbhb', 'kooo', '', '', '', '0000-00-00 00:00:00', 0),
(15, 'jooo', 'njjbhb', 'kooo', '', '', '', '0000-00-00 00:00:00', 0),
(16, 'k', '', '', 'gg', '', '', '0000-00-00 00:00:00', 0),
(17, 'ok', '', '', 'jnj', 'lysa.fichot@epitech.eu', 'f8f80066ead0511f6697f1b47e3179d1', '0000-00-00 00:00:00', 0),
(18, 'i', '', '', 'l', 'lysafichot@hotmail.fr', '5936777cf0d8919d9225306851803534', '0000-00-00 00:00:00', 0),
(19, 'op', '', '', 'lo', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(20, 'njnj', '', '', 'jj', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(21, 'i', '', '', 'l', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(22, 'k', '', '', 'g', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(23, 'y', '', '', 'h', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(24, 'u', '', '', 'f', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(25, 'u', '', '', 'f', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(26, 'h', '', '', 'd', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(27, 'I', '', '', 'I', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(28, 'O', '', '', 'O', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(29, 'k', '', '', 'k', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(30, 'm', '', '', 'm', 'lysafichot@hotmail.fr', '3300c3fa12d526ab16ea2328636eaf43', '0000-00-00 00:00:00', 0),
(31, 'k', '', '', 'k', 'lysafichot@hotmail.fr', '', '0000-00-00 00:00:00', 1),
(32, 'k', '', '', 'l', 'l', 'aa8cd29d8cf7d915f3b475b21745f907', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
