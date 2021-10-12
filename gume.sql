-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 07:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gumepraktikum`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `idAnketa` int(10) NOT NULL,
  `pitanje` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`idAnketa`, `pitanje`, `aktivna`) VALUES
(1, 'Na koliko kilometara menjate gume?', 0),
(2, 'Da li kupujete nove ili polovne gume?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `idKontakt` int(255) NOT NULL,
  `ime` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `poruka` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`idKontakt`, `ime`, `prezime`, `email`, `naslov`, `poruka`) VALUES
(8, 'Nikola', 'Jockovic', 'nikolajockovic99@gmail.com', 'Michelin', 'DSADSADASDSADSADASDSADSADSASDADADA');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(255) NOT NULL,
  `ime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datum_kreiranja` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uloga_id` int(5) NOT NULL,
  `status` smallint(6) NOT NULL,
  `aktivacioni_kod` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `ime`, `prezime`, `email`, `lozinka`, `datum_kreiranja`, `uloga_id`, `status`, `aktivacioni_kod`) VALUES
(16, 'Nikola', 'Jockovic', 'nikolajockovic99@gmail.com', 'e985779f8a05e1e418f6a3e54368da0b', '2020-03-31 23:03:36', 1, 1, 'a2cc698004d545afb3233c4db9a0d814'),
(17, 'Milica', 'Jockovic', 'milicajockovic@gmail.com', 'c075e9b839641f3a908536d6e52cd0ef', '2020-04-01 15:00:37', 2, 1, '020eeaacf1224799cdfd70ea1487f37e'),
(19, 'Teodora', 'Jockovic', 'teki@gmail.com', '7b9b6d1742a88109879acea8125cded6', '2020-04-01 22:09:42', 1, 0, 'ccd546298ef40211c393fed43442b05f'),
(31, 'Stefa', 'Stefa', 'stefa@gmail.com', '6dadc7b22ffe106f757de76e09cace0a', '2020-04-02 01:35:41', 2, 1, '5e2617447247258ec432507cbbfd2b39'),
(32, 'Milos', 'Milosavljevic', 'milos@gmail.com', 'e517097802ff7ba0bbbfefb1bc13c3a9', '2020-04-02 01:36:27', 2, 1, '35c3432ac1b9b9ef84ed3900afdebe34'),
(33, 'Teodora', 'Ristic', 'tea@gmail.com', '448b4423a96b17d62ad061705fa03ea4', '2020-04-02 04:46:13', 2, 1, '93a3a8b971782381ad80c37a0012ba86'),
(34, 'Johan', 'Jovan', 'joca@gmail.com', 'fcc8664f19e05f5fdbf8bc3a5ef9cf4c', '2020-07-13 03:37:08', 2, 1, 'fcc8664f19e05f5fdbf8bc3a5ef9cf4c'),
(71, 'Korisnik', 'Nikola', 'korisnik@gmail.com', 'c8e7a4ec84cb168bf84acec1a218cacb', '2020-07-13 03:34:46', 2, 1, 'c1e9b38bcca8ef37b56f339418be34b5');

-- --------------------------------------------------------

--
-- Table structure for table `navigacija`
--

CREATE TABLE `navigacija` (
  `idNav` int(2) NOT NULL,
  `naziv` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigacija`
--

INSERT INTO `navigacija` (`idNav`, `naziv`, `putanja`) VALUES
(1, 'Početna', 'page=pocetna'),
(2, 'Gume ', 'page=gume'),
(3, 'O nama', 'page=onama'),
(4, 'Kontakt', 'page=kontakt');

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `idOdgovori` int(10) NOT NULL,
  `idAnkete` int(10) NOT NULL,
  `odgovori` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`idOdgovori`, `idAnkete`, `odgovori`) VALUES
(1, 1, '30.000-50.000km'),
(2, 1, '50.000-70.000km'),
(3, 2, 'Nove '),
(4, 2, 'Polovne');

-- --------------------------------------------------------

--
-- Table structure for table `precnik`
--

CREATE TABLE `precnik` (
  `idPrecnik` int(2) NOT NULL,
  `precnik` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `precnik`
--

INSERT INTO `precnik` (`idPrecnik`, `precnik`) VALUES
(1, 14),
(2, 15),
(3, 16),
(4, 17),
(5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `idProizvod` int(255) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(8,0) NOT NULL,
  `idSirina` int(10) NOT NULL,
  `idVisina` int(10) NOT NULL,
  `idPrecnik` int(2) NOT NULL,
  `idSezona` int(1) NOT NULL,
  `idProizvodjac` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`idProizvod`, `naziv`, `opis`, `slika`, `cena`, `idSirina`, `idVisina`, `idPrecnik`, `idSezona`, `idProizvodjac`) VALUES
(1, 'Bridgestone', 'BRIDGSTONE 175/60 R14 Blizzak LM001 91T(DOT2019)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '4350', 1, 6, 1, 2, 1),
(2, 'Bridgestone', 'BRIDGSTONE 175/65 R14 Blizzak LM002 93T(DOT2020)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '4400', 1, 7, 1, 2, 1),
(3, 'Bridgestone', 'BRIDGSTONE 195/50 R15 Blizzak LM003 90H(DOT2019)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '5100', 3, 4, 2, 2, 1),
(4, 'Bridgestone', 'BRIDGSTONE 195/60 R15 Blizzak LM004 94H(DOT2018)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '4890', 3, 6, 2, 2, 1),
(5, 'Bridgestone', 'BRIDGSTONE 205/60 R15 Blizzak LM005 94H(DOT2020)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '5990', 4, 6, 2, 2, 1),
(6, 'Bridgestone', 'BRIDGSTONE 205/45 R16 Blizzak LM006 93V(DOT2019)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '6400', 4, 3, 3, 2, 1),
(7, 'Bridgestone', 'BRIDGSTONE 205/45 R17 Blizzak LM007 93V(DOT2019)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '7100', 4, 3, 4, 2, 1),
(8, 'Bridgestone', 'BRIDGSTONE 205/45 R17 Blizzak LM008 93V(DOT2019)', 'assets/images/bridgstone/bridgestoneGuma.jpg\"', '7300', 4, 4, 4, 2, 1),
(9, 'Bridgestone', 'BRIDGSTONE 215/40 R17 Blizzak LM008 94V(DOT2019)', 'assets/images/bridgstone/bridgestoneGuma.jpg', '7530', 5, 2, 4, 2, 1),
(10, 'Michelin', 'MICHELIN 185/65 R14 Alpin 6 81T(DOT2018)', 'assets/images/micheline/michelinGumaWinter.png', '6430', 2, 7, 4, 2, 2),
(12, 'Michelin', 'MICHELIN 205/65 R15 Energy Saver+ 85V(DOT2020)', 'assets/images/micheline/michelinGuma.jpg', '7210', 4, 7, 2, 1, 2),
(13, 'Michelin', 'MICHELIN 205/55 R16 Alpin 6 91T(DOT2019)', 'assets/images/micheline/michelinGumaWinter.png', '7050', 4, 5, 3, 2, 2),
(15, 'Michelin', 'MICHELIN 225/45 R17 Energy Saver+ 83H(DOT2020)', 'assets/images/micheline/michelinGuma.jpg', '10000', 6, 3, 4, 1, 2),
(16, 'Michelin', 'MICHELIN 225/50 R17 Alpin 6 85H(DOT2018)', 'assets/images/micheline/michelinGumaWinter.png', '10000', 6, 4, 4, 2, 2),
(17, 'Michelin', 'MICHELIN 235/45 R17 Energy Saver+ 97H(DOT2019)', 'assets/images/micheline/michelinGuma.jpg', '1690', 7, 3, 4, 1, 2),
(18, 'Michelin', 'MICHELIN 235/45 R18 Energy Saver+ 90H(DOT2018)', 'assets/images/micheline/michelinGuma.jpg', '10000', 7, 3, 5, 1, 2),
(19, 'Pirelli', 'PIRELLI 175/65 R14 Cinturato p7 90H(DOT2019)', 'assets/images/pireli/pireliGuma.jpg', '5300', 1, 7, 1, 1, 3),
(20, 'Pirelli', 'PIRELLI 185/65 R14 Cinturato p7 90H(DOT2019)', 'assets/images/pireli/pireliGuma.jpg', '5630', 2, 7, 1, 1, 3),
(21, 'Pirelli', 'PIRELLI 185/55 R15 Winter 210 SottoZero 2 93H(DOT2020)', 'assets/images/pireli/pireliGumaWinter.jpg', '6400', 2, 5, 2, 2, 3),
(22, 'Pirelli', 'PIRELLI 195/60 R15 Winter 210 SottoZero 2 88T(DOT2020)', 'assets/images/pireli/pireliGumaWinter.jpg', '6740', 3, 6, 2, 2, 3),
(23, 'Pirelli', 'PIRELLI 195/65 R15 Cinturato p7 91H(DOT2019)', 'assets/images/pireli/pireliGuma.jpg', '6230', 3, 7, 2, 1, 3),
(24, 'Pirelli', 'PIRELLI 205/45 R16 Cinturato p7 92V(DOT2020)', 'assets/images/pireli/pireliGuma.jpg', '6990', 4, 3, 3, 1, 3),
(25, 'Pirelli', 'PIRELLI 215/55 R16 Winter 210 SottoZero 2 94V(DOT2020)', 'assets/images/pireli/pireliGumaWinter.jpg', '7420', 5, 5, 3, 2, 3),
(26, 'Pirelli', 'PIRELLI 215/40 R17 Cinturato p7 92V(DOT2019)', 'assets/images/pireli/pireliGuma.jpg', '7310', 5, 2, 4, 1, 3),
(27, 'Tigar', 'TIGAR 175/65 R14 Wintera 80T(DOT2019)', 'assets/images/tigar/tigarGumaWinter.jpg', '3400', 1, 7, 1, 2, 4),
(28, 'Tigar', 'TIGAR 185/65 R14 Sigura 80T(DOT2020)', 'assets/images/tigar/tigarGuma.jpg', '3930', 2, 7, 1, 1, 4),
(44, 'Tigar', 'TIGAR 185/55 R15 Sigura 87T(DOT2020)', 'assets/images/tigar/tigarGuma.jpg', '4030', 2, 5, 2, 1, 4),
(45, 'Tigar', 'TIGAR 195/50 R15 Sigura 88T(DOT2020)', 'assets/images/tigar/tigarGuma.jpg', '4730', 3, 4, 2, 1, 4),
(46, 'Tigar', 'TIGAR 195/55 R15 Sigura 90T(DOT2020)', 'assets/images/tigar/tigarGuma.jpg', '4630', 3, 5, 2, 1, 4),
(47, 'Tigar', 'TIGAR 195/60 R15 Wintera 88T(DOT2019)', 'assets/images/tigar/tigarGumaWinter.jpg', '3990', 3, 6, 2, 2, 4),
(48, 'Tigar', 'TIGAR 195/65 R15 Wintera 88T(DOT2020)', 'assets/images/tigar/tigarGumaWinter.jpg', '4400', 3, 7, 2, 2, 4),
(49, 'Tigar', 'TIGAR 205/60 R15 Sigura 93T(DOT2020)', 'assets/images/tigar/tigarGuma.jpg', '4340', 4, 6, 2, 1, 4),
(50, 'Tigar', 'TIGAR 205/55 R15 Sigura 94V(DOT2020)', 'assets/images/tigar/tigarGuma.jpg', '4800', 4, 5, 2, 1, 4),
(51, 'Hankook', 'HANKOOK 175/60 R14 Kinergy Eco2 K435 94V(DOT2020)', 'assets/images/hankook/hankookGuma.jpg', '5320', 1, 6, 1, 1, 5),
(52, 'Hankook', 'HANKOOK 175/65 R14 Winter i-cept RS2 W452 89T(DOT2020)', 'assets/images/hankook/hankookGumaWinter.jpg', '5520', 1, 7, 1, 2, 5),
(53, 'Hankook', 'HANKOOK 185/65 R14 Winter i-cept RS2 W452 90T(DOT2019)', 'assets/images/hankook/hankookGumaWinter.jpg', '5670', 1, 7, 1, 2, 5),
(54, 'Hankook', 'HANKOOK 195/65 R15 Kinergy Eco2 K435 92V(DOT2020)', 'assets/images/hankook/hankookGuma.jpg', '6930', 3, 7, 2, 1, 5),
(55, 'Hankook', 'HANKOOK 205/55 R16 Winter i-cept RS2 W452 92T(DOT2020)', 'assets/images/hankook/hankookGumaWinter.jpg', '7460', 4, 5, 3, 2, 5),
(56, 'Hankook', 'HANKOOK 205/45 R16 Kinergy Eco2 K435 94H(DOT2020)', 'assets/images/hankook/hankookGuma.jpg', '8010', 4, 3, 3, 2, 5),
(57, 'Hankook', 'HANKOOK 215/45 R16 Kinergy Eco2 K435 94H(DOT2020)', 'assets/images/hankook/hankookGuma.jpg', '8450', 5, 3, 3, 1, 5),
(58, 'Hankook', 'HANKOOK 225/45 R17 Kinergy Eco2 K435 94H(DOT2020)', 'assets/images/hankook/hankookGuma.jpg', '12010', 6, 3, 4, 1, 5),
(59, 'Hankook', 'HANKOOK 225/50 R17 Kinergy Eco2 K435 94H(DOT2020)', 'assets/images/hankook/hankookGuma.jpg', '11420', 6, 4, 4, 1, 5),
(60, 'Goodyear', 'GOODYEAR 185/65 R14 UltraGrip 9 M+S 92T(DOT2020)', 'assets/images/goodyear/goodyearGumaWinter.jpg', '6460', 2, 7, 1, 1, 6),
(61, 'Goodyear', 'GOODYEAR 205/45 R16 EfficientGrip Compact 92T(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '9860', 4, 3, 3, 1, 6),
(62, 'Goodyear', 'GOODYEAR 205/55 R16 UltraGrip 9 M+S 92T(DOT2020)', 'assets/images/goodyear/goodyearGumaWinter.jpg', '12350', 4, 5, 3, 2, 6),
(63, 'Goodyear', 'GOODYEAR 215/55 R16 EfficientGrip Compact 92T(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '11570', 5, 5, 3, 1, 6),
(64, 'Goodyear', 'GOODYEAR 225/50 R17 EfficientGrip Compact 93V(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '14670', 6, 4, 4, 1, 6),
(65, 'Goodyear', 'GOODYEAR 235/45 R17 EfficientGrip Compact 95H(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '16490', 7, 3, 4, 1, 6),
(66, 'Goodyear', 'GOODYEAR 235/45 R18 EfficientGrip Compact 93H(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '16690', 7, 3, 5, 1, 6),
(67, 'Goodyear', 'GOODYEAR 245/35 R18 EfficientGrip Compact 93H(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '17980', 8, 1, 5, 2, 6),
(68, 'Goodyear', 'GOODYEAR 245/40 R18 EfficientGrip Compact 96V(DOT2020)', 'assets/images/goodyear/goodyearGuma.jpg', '18930', 8, 2, 5, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodjac`
--

CREATE TABLE `proizvodjac` (
  `idProizvodjac` int(3) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logoSlika` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slika` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodjac`
--

INSERT INTO `proizvodjac` (`idProizvodjac`, `naziv`, `logoSlika`, `slika`) VALUES
(1, 'Bridgestone', 'bridgestoneLogo.jpg', 'bridgestone.png'),
(2, 'Michelin', 'michelinLogo.jpg', 'michelin.png'),
(3, 'Pirelli', 'pirelliLogo.jpg', 'pirelli.png'),
(4, 'Tigar', 'tigarLogo.jpg', 'tigar.png'),
(5, 'Hankook', 'hankookLogo.jpg', 'hankook.png'),
(6, 'Goodyear', 'goodyearLogo.jpg', 'goodyear.png'),
(7, 'Riken', '1594477588_riken.png', '1594477588_riken.png'),
(8, 'Test', '1594477875_hankook.png', '1594477875_hankook.png'),
(9, 'Test', '1594481305_hankook.png', '1594481305_hankook.png');

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--

CREATE TABLE `rezultat` (
  `idRezultat` int(10) NOT NULL,
  `idAnkete` int(10) NOT NULL,
  `idOdgovori` int(10) NOT NULL,
  `idKorisnika` int(255) DEFAULT NULL,
  `rezultat` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`idRezultat`, `idAnkete`, `idOdgovori`, `idKorisnika`, `rezultat`) VALUES
(3, 2, 3, 31, 1),
(4, 2, 3, 33, 1),
(6, 2, 3, 34, 1),
(7, 2, 3, 35, 1),
(8, 2, 4, 54, 1),
(9, 2, 4, 53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sezona`
--

CREATE TABLE `sezona` (
  `idSezona` int(1) NOT NULL,
  `sezona` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sezona`
--

INSERT INTO `sezona` (`idSezona`, `sezona`) VALUES
(1, 'leto'),
(2, 'zima');

-- --------------------------------------------------------

--
-- Table structure for table `sirina`
--

CREATE TABLE `sirina` (
  `idSirina` int(10) NOT NULL,
  `sirina` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sirina`
--

INSERT INTO `sirina` (`idSirina`, `sirina`) VALUES
(1, 175),
(2, 185),
(3, 195),
(4, 205),
(5, 215),
(6, 225),
(7, 235),
(8, 245);

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `idSlike` int(100) NOT NULL,
  `naziv` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlike`, `naziv`, `opis`, `putanja`) VALUES
(1, 'logo', 'Svet guma', 'assets\\images\\Logo\\logo.jpg'),
(2, 'slajderMichelin', 'Michelin akcija', 'assets\\images\\michelin.jpg'),
(3, 'slajderWinter', 'Winter gume po akcijskim cenama', 'assets\\images\\winter.jpg'),
(4, 'brendBridgestone', 'Bridgestone', 'assets/images/bridgstone/bridgestone.png'),
(5, 'brendMichelin', 'Michelin', 'assets/images/micheline/michelin.png'),
(6, 'brendPirelli', 'Pirelli', 'assets/images/pireli/pirelli.png'),
(7, 'brendTigar', 'Tigar', 'assets/images/tigar/tigar.png'),
(8, 'brendHankook', 'Hankook', 'assets/images/hankook/hankook.png'),
(9, 'brendGoodyear', 'Goodyear', 'assets/images/goodyear/goodyear.png'),
(10, 'O nama', 'O nama', 'assets/images/onama.jpg'),
(11, 'Pritisak u gumama', 'Bezbedna Guma', 'assets/images/pritisakGuma.jpg'),
(12, 'ZimskeVsLetnje', 'Zimske vs Letnje', 'assets/images/zimskeLetnje.jpg'),
(13, 'Autor', 'Nikola Jocković', 'assets/images/autor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_id` int(5) NOT NULL,
  `naziv` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_id`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `visina`
--

CREATE TABLE `visina` (
  `idVisina` int(10) NOT NULL,
  `visina` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visina`
--

INSERT INTO `visina` (`idVisina`, `visina`) VALUES
(1, 35),
(2, 40),
(3, 45),
(4, 50),
(5, 55),
(6, 60),
(7, 65);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`idAnketa`);

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`idKontakt`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `korisnikUloga` (`uloga_id`);

--
-- Indexes for table `navigacija`
--
ALTER TABLE `navigacija`
  ADD PRIMARY KEY (`idNav`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD PRIMARY KEY (`idOdgovori`),
  ADD KEY `odgovorAnketa` (`idAnkete`);

--
-- Indexes for table `precnik`
--
ALTER TABLE `precnik`
  ADD PRIMARY KEY (`idPrecnik`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `proizvodProizvodjac` (`idProizvodjac`),
  ADD KEY `proizvodSezona` (`idSezona`),
  ADD KEY `proizvodPrecnik` (`idPrecnik`),
  ADD KEY `proizvodVisina` (`idVisina`),
  ADD KEY `proizvodSirina` (`idSirina`);

--
-- Indexes for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  ADD PRIMARY KEY (`idProizvodjac`);

--
-- Indexes for table `rezultat`
--
ALTER TABLE `rezultat`
  ADD PRIMARY KEY (`idRezultat`),
  ADD KEY `rezAnketa` (`idAnkete`),
  ADD KEY `rezOdg` (`idOdgovori`);

--
-- Indexes for table `sezona`
--
ALTER TABLE `sezona`
  ADD PRIMARY KEY (`idSezona`);

--
-- Indexes for table `sirina`
--
ALTER TABLE `sirina`
  ADD PRIMARY KEY (`idSirina`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`idSlike`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `visina`
--
ALTER TABLE `visina`
  ADD PRIMARY KEY (`idVisina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `idAnketa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `idKontakt` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `navigacija`
--
ALTER TABLE `navigacija`
  MODIFY `idNav` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `idOdgovori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `precnik`
--
ALTER TABLE `precnik`
  MODIFY `idPrecnik` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `idProizvod` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  MODIFY `idProizvodjac` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rezultat`
--
ALTER TABLE `rezultat`
  MODIFY `idRezultat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sirina`
--
ALTER TABLE `sirina`
  MODIFY `idSirina` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `idSlike` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visina`
--
ALTER TABLE `visina`
  MODIFY `idVisina` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnikUloga` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`uloga_id`);

--
-- Constraints for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD CONSTRAINT `odgovorAnketa` FOREIGN KEY (`idAnkete`) REFERENCES `anketa` (`idAnketa`);

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvodPrecnik` FOREIGN KEY (`idPrecnik`) REFERENCES `precnik` (`idPrecnik`),
  ADD CONSTRAINT `proizvodProizvodjac` FOREIGN KEY (`idProizvodjac`) REFERENCES `proizvodjac` (`idProizvodjac`),
  ADD CONSTRAINT `proizvodSezona` FOREIGN KEY (`idSezona`) REFERENCES `sezona` (`idSezona`),
  ADD CONSTRAINT `proizvodSirina` FOREIGN KEY (`idSirina`) REFERENCES `sirina` (`idSirina`),
  ADD CONSTRAINT `proizvodVisina` FOREIGN KEY (`idVisina`) REFERENCES `visina` (`idVisina`);

--
-- Constraints for table `rezultat`
--
ALTER TABLE `rezultat`
  ADD CONSTRAINT `rezAnketa` FOREIGN KEY (`idAnkete`) REFERENCES `anketa` (`idAnketa`),
  ADD CONSTRAINT `rezOdg` FOREIGN KEY (`idOdgovori`) REFERENCES `odgovori` (`idOdgovori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
