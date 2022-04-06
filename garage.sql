-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 13 jun 2021 om 20:51
-- Serverversie: 5.7.31
-- PHP-versie: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garage`
--
CREATE DATABASE IF NOT EXISTS `garage` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `garage`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(45) NOT NULL,
  `model` varchar(45) NOT NULL,
  `construction_year` int(11) DEFAULT NULL,
  `registration` varchar(45) NOT NULL,
  `customerid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_UNIQUE` (`registration`),
  KEY `fk_customer_car_idx` (`customerid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `construction_year`, `registration`, `customerid`) VALUES
(1, 'Mazda', 'MX-5', 1992, 'THDR33', 1),
(2, 'Volkswagen', 'Golf 4', 2002, 'AABB01', 1),
(3, 'Subaru', 'Impreza WRX STI', 2004, 'AABB02', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `postalcode` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `address`, `postalcode`, `city`, `email`, `phone`) VALUES
(1, 'Richard', 'Swinkels', 'Straatnaam 1', '1111 AB', 'Eindhoven', 'ps197989@summacollege.nl', '0612345678'),
(2, 'Voornaam', 'Achternaam', 'Adres', '1111 AB', 'Woonplaats', 'klant@domein.nl', '0612345678');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `fk_customer_car` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
