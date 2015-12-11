-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2014 at 02:11 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(40) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `relevent` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `label`, `link`, `parent`, `relevent`) VALUES
(2, 'Mens', '?filter=Mens', 0, 1),
(3, 'Womens', '?filter=Womens', 0, 1),
(4, 'Accessories', '?filter=Accessories', 0, 1),
(5, 'T-Shirts', '?filter=T-Shirts', 2, 0),
(6, 'Shirts', '?filter=Shirts', 2, 0),
(8, 'Jeans', '?filter=Jeans', 2, 0),
(12, 'iPhone Cases', '?filter=iPhonecases', 4, 0),
(15, 'DVDs', '?filter=DVDs', 4, 0),
(17, 'Dresses', '?filter=Dresses', 3, 0),
(18, 'Tops', '?filter=Tops', 3, 0),
(46, 'world', '?filter=world', 45, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `colour` varchar(30) DEFAULT NULL,
  `description` text,
  `category` varchar(45) NOT NULL,
  `subcategory` varchar(45) NOT NULL,
  `stockNo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `colour`, `description`, `category`, `subcategory`, `stockNo`) VALUES
(1, 'L/S Job Shirt', 65.00, 'Pecan', '100% Cotton Corduroy, 6 oz\n\nShirt with two chest pockets\nFlag label at chest pocket\n\n', 'Mens', 'Shirts', 76),
(4, 'L/S Harrison Shirt', 75.00, 'Blue / Navy', '100% Cotton Color Chambray, 3.9 oz\nSlim fit\nContrast top insert\nTwo chest pockets with button closure\nEasy angle pen pocket\nFlag label at chest pocket\nLoop label inside neck', 'Mens', 'Shirts', 56),
(11, 'L/S Military Shirt', 60.00, 'Pecan', '100% Cotton Twill, 7.3 oz\nShirt with two chest pockest\nShoulder straps\nMilitary label on bottom', 'Mens', 'Shirts', 86),
(15, 'L/S Rushmore Shirt', 80.00, 'Cranberry Heather', '100% Cotton Poplin Flannel, 5.6 oz\nBrushed on both sides\nButton-down collar\nChest pocket\nFlag label at chest pocket\nLoop label inside neck', 'Mens', 'Shirts', 69),
(21, ' S/S Brickwall T-Shir', 30.00, 'Red / Saffron', ' 100% Cotton Single Jersey, 173 g/m\n\n    graphic print\n    sports label on hem\n    size print inside neck\n', 'Mens', 'T-Shirts', 38),
(22, ' S/S Canned C T-Shirt', 30.00, 'White', '', 'Mens', 'T-Shirts', 9),
(23, 'S/S Channel C T-Shirt', 30.00, 'Grey Heather / Black', ' 100% Cotton Single Jersey, 173 g/m%B2\r\n\r\n    graphic print\r\n    sports label on hem\r\n    size print inside neck\r\n', 'Mens', 'T-Shirts', 65),
(34, 'Klondike Pant', 75.00, '', '100% Cotton ''Nihon'' japanese Blue Denim, 13 oz\r\n\r\nslim fit, low waist\r\ntapered leg\r\nback yoke\r\nmetal rivets or bartack stitching at vital stress points\r\nleather square label\r\nbutton fly', 'Mens', 'Jeans', 50),
(35, 'Skill Pant', 80.00, 'Blue (coast washed)', '100% Cotton ''Broderick'' Denim, 10.5 oz\r\n\r\nslim fit, low waist\r\nstraight leg\r\nback yoke\r\ntriple stitched\r\nbartack stitching at vital stress points\r\nsquare label\r\nzip fly', 'Mens', 'Jeans', 50),
(36, 'Rebel Pant', 95.00, 'Blue (coast washed)', '99/1% Cotton/Elasthan ''Malibu'' Blue stretch Denim, 10 oz\r\n\r\nsuper slim fit, low waist\r\ntapered leg\r\nback yoke\r\nmetal rivets or bartack stitching at vital stress points\r\nleather square label\r\nzip fly', 'Mens', 'Jeans', 50);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
