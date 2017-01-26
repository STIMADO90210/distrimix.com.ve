-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2016 at 06:27 PM
-- Server version: 5.5.46-0ubuntu0.12.04.2
-- PHP Version: 5.3.10-1ubuntu3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `j298279869_distrimix`
--

-- --------------------------------------------------------

--
-- Table structure for table `carro`
--

CREATE TABLE IF NOT EXISTS `carro` (
  `id` int(10) NOT NULL,
  `prod` varchar(50) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `cant` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(8, 'PAPELERIA'),
(9, 'ARTICULOS DE OFICINA'),
(10, 'ARTICULOS DE COMPUTACION'),
(11, 'ARTICULOS DE CAFETERIA'),
(12, 'ARTICULOS DE MANTENIMINETO');

-- --------------------------------------------------------

--
-- Table structure for table `clientepedido`
--

CREATE TABLE IF NOT EXISTS `clientepedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(8) NOT NULL,
  `nroPedido` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `clientepedido`
--

INSERT INTO `clientepedido` (`id`, `idcliente`, `nroPedido`, `fecha`, `status`) VALUES
(1, 10, 1, '2015-10-01 16:10:33', 2),
(2, 10, 2, '2015-10-01 16:52:32', 2),
(3, 1, 3, '2015-10-01 17:33:56', 2),
(4, 7, 4, '2015-10-02 12:54:28', 2),
(5, 1, 5, '2015-10-02 18:31:29', 1),
(6, 1, 6, '2015-10-03 01:48:14', 1),
(7, 1, 7, '2015-10-03 02:35:04', 2),
(8, 10, 8, '2015-10-03 06:05:57', 2),
(9, 10, 9, '2015-10-03 06:07:58', 2),
(10, 7, 10, '2015-10-03 06:50:20', 1),
(11, 7, 11, '2015-10-03 07:32:23', 1),
(12, 7, 12, '2015-10-03 07:40:12', 1),
(13, 7, 13, '2015-10-03 07:42:39', 1),
(14, 7, 14, '2015-10-03 07:43:16', 1),
(15, 7, 15, '2015-10-03 07:44:42', 1),
(16, 7, 16, '2015-10-03 08:01:48', 1),
(17, 7, 17, '2015-10-03 08:03:19', 1),
(18, 7, 18, '2015-10-03 08:10:08', 1),
(19, 7, 19, '2015-10-03 08:11:18', 1),
(20, 12, 20, '2015-10-03 19:58:13', 1),
(21, 1, 21, '2015-10-04 19:35:32', 1),
(22, 1, 22, '2015-10-04 20:08:20', 1),
(23, 1, 23, '2015-10-04 20:51:20', 1),
(24, 13, 24, '2015-10-04 21:17:49', 1),
(25, 1, 25, '2015-10-06 16:27:02', 1),
(26, 10, 26, '2015-10-06 22:02:20', 1),
(27, 1, 27, '2015-10-12 20:18:21', 1),
(28, 14, 28, '2015-10-12 21:01:50', 2),
(29, 10, 29, '2015-10-15 00:08:21', 1),
(30, 1, 30, '2015-10-15 00:12:25', 1),
(31, 1, 31, '2015-10-15 06:47:52', 1),
(32, 1, 32, '2015-10-15 06:51:26', 1),
(33, 1, 33, '2015-10-15 06:52:52', 1),
(34, 1, 34, '2015-10-15 06:53:21', 1),
(35, 1, 35, '2015-10-15 06:58:23', 1),
(36, 1, 36, '2015-10-15 06:59:05', 1),
(37, 1, 37, '2015-10-15 06:59:38', 1),
(38, 1, 38, '2015-10-15 07:01:04', 1),
(39, 1, 39, '2015-10-15 07:02:33', 1),
(40, 1, 40, '2015-10-15 07:03:39', 1),
(41, 1, 41, '2015-10-15 07:04:49', 1),
(42, 1, 42, '2015-10-15 07:06:12', 1),
(43, 1, 43, '2015-10-15 07:07:37', 1),
(44, 1, 44, '2015-10-15 07:07:47', 1),
(45, 1, 45, '2015-10-15 07:11:02', 1),
(46, 1, 46, '2015-10-15 07:11:48', 1),
(47, 1, 47, '2015-10-15 07:12:24', 1),
(48, 1, 48, '2015-10-15 07:14:16', 1),
(49, 10, 49, '2015-10-15 07:16:04', 1),
(50, 10, 50, '2015-10-15 07:16:59', 1),
(51, 15, 51, '2015-10-15 07:20:13', 1),
(52, 15, 52, '2015-10-15 07:23:12', 1),
(53, 15, 53, '2015-10-15 07:23:37', 1),
(54, 15, 54, '2015-10-15 07:25:03', 1),
(55, 15, 55, '2015-10-15 09:10:14', 1),
(56, 15, 56, '2015-10-15 09:12:06', 1),
(57, 15, 57, '2015-10-15 09:13:05', 1),
(58, 15, 58, '2015-10-15 09:14:57', 1),
(59, 15, 59, '2015-10-15 09:17:44', 1),
(60, 15, 60, '2015-10-15 09:44:13', 1),
(61, 15, 61, '2015-10-15 09:44:51', 1),
(62, 4, 62, '2015-12-10 17:21:20', 2),
(63, 4, 63, '2015-12-10 17:21:46', 1),
(64, 4, 64, '2015-12-10 17:24:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `envios`
--

CREATE TABLE IF NOT EXISTS `envios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_envio` varchar(50) NOT NULL,
  `costo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `envios`
--

INSERT INTO `envios` (`id`, `tipo_envio`, `costo`) VALUES
(1, 'Nacionales', '500'),
(3, 'Regionales', '300'),
(4, 'Internacionales', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nroPedido` int(10) NOT NULL,
  `idpro` int(10) NOT NULL,
  `produ` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `cant` int(11) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`id`, `nroPedido`, `idpro`, `produ`, `precio`, `cant`, `subtotal`) VALUES
(1, 1, 1, 'televisor', 12000, 1, 12000.00),
(2, 1, 2, 'aire acondicionado', 90000, 1, 90000.00),
(3, 1, 3, 'nevera', 45000, 1, 45000.00),
(4, 1, 1, 'televisor', 12000, 1, 12000.00),
(5, 1, 2, 'aire acondicionado', 90000, 1, 90000.00),
(6, 1, 11, 'telefono nokia', 90222, 1, 90222.00),
(7, 1, 13, 'chama amarra', 45345, 1, 45345.00),
(8, 1, 1, 'televisor', 12000, 1, 12000.00),
(9, 1, 6, 'microondas', 23444, 1, 23444.00),
(10, 2, 12, 'lampazo', 123, 2, 246.00),
(11, 2, 10, 'celular blackberry', 40994, 1, 40994.00),
(12, 3, 1, 'televisor', 12000, 1, 12000.00),
(13, 3, 10, 'celular blackberry', 40994, 1, 40994.00),
(14, 4, 8, 'abanico', 45544, 1, 45544.00),
(15, 4, 3, 'nevera', 45000, 1, 45000.00),
(16, 4, 6, 'microondas', 23444, 1, 23444.00),
(17, 5, 1, 'televisor', 12000, 1, 12000.00),
(18, 5, 3, 'nevera', 45000, 1, 45000.00),
(19, 5, 8, 'abanico', 45544, 1, 45544.00),
(20, 5, 5, 'equipo de sonido', 98234, 2, 196468.00),
(21, 6, 1, 'televisor', 12000, 4, 48000.00),
(22, 6, 9, 'computador', 323232, 1, 323232.00),
(23, 7, 2, 'aire acondicionado', 90000, 1, 90000.00),
(24, 7, 3, 'nevera', 45000, 2, 90000.00),
(25, 7, 7, 'juego de comerdor', 52524, 1, 52524.00),
(26, 7, 1, 'televisor', 12000, 2, 24000.00),
(27, 8, 1, 'televisor', 12000, 1, 12000.00),
(28, 8, 3, 'nevera', 45000, 1, 45000.00),
(29, 8, 8, 'abanico', 45544, 1, 45544.00),
(30, 9, 8, 'abanico', 45544, 1, 45544.00),
(31, 9, 7, 'juego de comerdor', 52524, 3, 157572.00),
(32, 9, 10, 'celular blackberry', 40994, 2, 81988.00),
(33, 10, 10, 'celular blackberry', 40994, 3, 122982.00),
(34, 10, 11, 'telefono nokia', 90222, 1, 90222.00),
(35, 10, 2, 'aire acondicionado', 90000, 1, 90000.00),
(36, 15, 1, 'televisor', 12000, 5, 60000.00),
(37, 16, 1, 'televisor', 12000, 5, 60000.00),
(38, 17, 2, 'aire acondicionado', 90000, 5, 450000.00),
(39, 18, 6, 'microondas', 23444, 5, 117220.00),
(40, 19, 7, 'juego de comerdor', 52524, 1, 52524.00),
(41, 19, 10, 'celular blackberry', 40994, 1, 40994.00),
(42, 19, 4, 'juego de cuarto', 12000, 1, 12000.00),
(43, 20, 2, 'aire acondicionado', 90000, 2, 180000.00),
(44, 20, 3, 'nevera', 45000, 1, 45000.00),
(45, 20, 8, 'abanico', 45544, 2, 91088.00),
(46, 21, 5, 'equipo de sonido', 98234, 1, 98234.00),
(47, 22, 1, 'televisor', 893.05, 1, 893.00),
(48, 23, 12, 'emgrapadora', 1220, 1, 1220.00),
(49, 23, 1, 'televisor', 893.05, 1, 893.05),
(50, 23, 3, 'nevera', 100.67, 1, 100.67),
(51, 24, 1, 'televisor', 893.05, 1, 893.05),
(52, 24, 9, 'computador', 323232, 1, 323232.00),
(53, 24, 11, 'telefono nokia', 90222, 1, 90222.00),
(54, 25, 1, 'televisor', 893.05, 2, 1786.10),
(55, 25, 3, 'nevera', 100.67, 3, 302.01),
(56, 26, 1, 'televisor', 893.05, 2, 1786.10),
(57, 26, 3, 'nevera', 100.67, 5, 503.35),
(58, 27, 1, 'televisor', 893.05, 2, 1786.10),
(59, 27, 10, 'celular blackberry', 4099, 1, 4099.00),
(60, 27, 7, 'juego de comerdor', 52524, 1, 52524.00),
(61, 28, 1, 'televisor', 893.05, 1, 893.05),
(62, 28, 8, 'abanico', 45544, 2, 91088.00),
(63, 28, 10, 'celular blackberry', 4099, 2, 8198.00),
(64, 29, 1, 'televisor', 893.05, 3, 2679.15),
(65, 29, 2, 'aire acondicionado', 999.99, 2, 1999.98),
(66, 30, 6, 'microondas', 23444, 1, 23444.00),
(67, 31, 11, 'telefono nokia', 90222, 1, 90222.00),
(68, 31, 10, 'celular blackberry', 4099, 3, 12297.00),
(69, 32, 5, 'equipo de sonido', 98234.2, 1, 98234.19),
(70, 49, 2, 'aire acondicionado', 999.99, 1, 999.99),
(71, 51, 10, 'celular blackberry', 4099, 2, 8198.00),
(72, 51, 8, 'abanico', 45544, 1, 45544.00),
(73, 52, 7, 'juego de comerdor', 52524, 1, 52524.00),
(74, 62, 1, 'televisor', 893.05, 2, 1786.10),
(75, 63, 1, 'televisor', 893.05, 1, 893.05),
(76, 64, 1, 'televisor', 893.05, 1, 893.05);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(50) NOT NULL,
  `categoria` int(4) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `stok` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `producto`, `categoria`, `imagen`, `precio`, `stok`) VALUES
(13, 'Rema Carta', 8, 'thumbnail_1450442657.jpg', '2700', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  `subcategoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `categoria`, `subcategoria`) VALUES
(2, '8', 'PAPEL FOTOCOPIA'),
(3, '8', 'PAPELES VARIOS');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(30) NOT NULL,
  `representante` varchar(30) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `nivel` int(1) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `dir_despacho` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `telf_movil` varchar(15) NOT NULL,
  `fax` varchar(16) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `razon_social`, `representante`, `cedula`, `email`, `clave`, `nivel`, `direccion`, `dir_despacho`, `telefono`, `telf_movil`, `fax`, `fecha`) VALUES
(11, 'Administrador', 'Administrador', '', 'master@distrimix.com.ve', 'master1234', 1, '', '', '', '', '', '2015-12-09 22:05:51'),
(12, 'Inversiones RdD, C.A.', 'Asnardo Palmar', 'J-29592989', 'asnaldo.jesus@gmail.com', 'eureka', 2, 'La Polar Calle 184 # 48D-45', 'La Polar Calle 184 # 48D-45', '0261-4226755', '0424-6402886', '0261-4226755', '2015-12-23 02:16:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
