-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2015 at 08:21 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airmodelsdb`
--
CREATE DATABASE IF NOT EXISTS `airmodelsdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `airmodelsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ProductId` int(4) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Code` char(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P000',
  `Price` double NOT NULL,
  `SupplierInfo` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `StockQuantity` int(5) NOT NULL,
  PRIMARY KEY (`ProductId`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductName`, `Code`, `Price`, `SupplierInfo`, `StockQuantity`) VALUES
(44, 'Taylorcraft cc ARF', 'A100', 149.99, 'clipped-wing T-Craft', 147),
(45, 'CHIPMUNK ARF', 'A101', 549.99, 'Super sport-scale aerobatics', 199),
(46, 'CORSAIR S ARF', 'A102', 330, '- Flying weight: 3000-3300gr\r\n- Wing area: 38.2 dm2', 500),
(47, 'MUSTANG ARF ', 'B100', 988, '\r\nWing span: 1560 mm\r\n', 510),
(48, 'AT TEXAN ARF', 'B101', 510, 'Wing loading: 82g/dm2', 300),
(49, 'ZERO ARF ', 'B102', 942.99, 'Macross Zero VF-0S Valkyrie 1/60 Scale', 400);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `NumofUnits` int(3) DEFAULT NULL,
  `TotalPayment` double NOT NULL,
  `UnitPrice` int(4) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `fkProductId` int(4) NOT NULL,
  `fkUserId` int(4) NOT NULL,
  PRIMARY KEY (`PurchaseDate`,`fkProductId`,`fkUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`NumofUnits`, `TotalPayment`, `UnitPrice`, `PurchaseDate`, `fkProductId`, `fkUserId`) VALUES
(14, 2099.86, 150, '2015-02-22', 44, 10),
(42, 23099.58, 550, '2015-02-22', 45, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(4) NOT NULL AUTO_INCREMENT,
  `usrlogin` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usrpwd` int(9) NOT NULL,
  `usractname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ShippingAddress` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usrTyp` char(1) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserId` (`UserId`),
  UNIQUE KEY `usrlogin` (`usrlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `usrlogin`, `usrpwd`, `usractname`, `ShippingAddress`, `usrTyp`) VALUES
(5, 'admin', 1234, 'admin', 'admin', 'a'),
(6, 'ipad', 123456, 'iphone', 'michigan', 'u'),
(7, 'galaxy', 123456, 'samsung', 'new york', 'u'),
(8, 'bob', 123456, 'bobi', 'tlv bbuur', 'u'),
(9, 'kamila', 123456, 'kami', 'jorden', 'u'),
(10, 'student1', 123456, 'haim', 'kfar saba', 'u');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
