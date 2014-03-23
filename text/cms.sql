-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2014 at 11:10 AM
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
  `link` varchar(20) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `relevent` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `label`, `link`, `parent`, `relevent`) VALUES
(1, 'Home', './index.php', 0, 0),
(2, 'Mens', '#', 0, 1),
(3, 'Womens', '#', 0, 1),
(4, 'Accessories', '#', 0, 1),
(5, 'T-Shirts', '#', 2, 0),
(6, 'Shirts', '#', 2, 0),
(7, 'Shorts', '#', 2, 2),
(8, 'Jeans', '#', 2, 0),
(9, 'Jackets', '#', 2, 0),
(10, 'Trousers', '#', 2, 0),
(11, 'Shoes', '#', 2, 0),
(12, 'iPhone Cases', '#', 4, 0),
(13, 'Headphones', '#', 4, 0),
(14, 'CDs', '#', 4, 0),
(15, 'DVDs', '#', 4, 0),
(16, 'Mugs', '#', 4, 0),
(17, 'Dresses', '#', 3, 0),
(18, 'Tops', '#', 3, 0),
(19, 'Jackets', '#', 3, 0),
(20, 'Jeans', '#', 3, 0),
(21, 'Skirts', '#', 3, 0),
(22, 'Trousers & Leggings', '#', 3, 0),
(23, 'Knitwear', '#', 3, 0),
(24, 'Your Basket', '../basket.php', 0, 0);

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
  `sub-category` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `colour`, `description`, `category`, `sub-category`) VALUES
(1, 'L/S Job Shirt', 65.00, 'Pecan', '100% Cotton Corduroy, 6 oz\n\nShirt with two chest pockets\nFlag label at chest pocket\n\n', 'Clothing', 'Shirts'),
(2, 'L/S Job Shirt', 65.00, 'Imperial Blue', '100% Cotton Corduroy, 6 oz\n\nShirt with two chest pockets\nFlag label at chest pocket\n\n', 'Clothing', 'Shirts'),
(3, 'L/S Harrison Shirt', 75.00, 'Beige / Tobacco', '100% Cotton Color Chambray, 3.9 oz\nSlim fit\nContrast top insert\nTwo chest pockets with button closure\nEasy angle pen pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(4, 'L/S Harrison Shirt', 75.00, 'Blue / Navy', '100% Cotton Color Chambray, 3.9 oz\nSlim fit\nContrast top insert\nTwo chest pockets with button closure\nEasy angle pen pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(5, 'L/S Harrison Shirt', 75.00, 'Grey / Dark Grey', '100% Cotton Color Chambray, 3.9 oz\nSlim fit\nContrast top insert\nTwo chest pockets with button closure\nEasy angle pen pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(6, 'L/S Military Shirt', 70.00, 'Camo Isle', '100% Cotton Twill, 7.3 oz\nShirt with two chest pockest\nShoulder straps\nMilitary label on bottom', 'Clothing', 'Shirts'),
(7, 'L/S Military Shirt', 60.00, 'Dark Navy', '100% Cotton Twill, 7.3 oz\nShirt with two chest pockest\nShoulder straps\nMilitary label on bottom', 'Clothing', 'Shirts'),
(8, 'L/S Military Shirt', 60.00, 'Bog', '100% Cotton Twill, 7.3 oz\nShirt with two chest pockest\nShoulder straps\nMilitary label on bottom', 'Clothing', 'Shirts'),
(10, 'L/S Military Shirt', 60.00, 'Prune', '100% Cotton Twill, 7.3 oz\nShirt with two chest pockest\nShoulder straps\nMilitary label on bottom', 'Clothing', 'Shirts'),
(11, 'L/S Military Shirt', 60.00, 'Pecan', '100% Cotton Twill, 7.3 oz\nShirt with two chest pockest\nShoulder straps\nMilitary label on bottom', 'Clothing', 'Shirts'),
(12, 'L/S Kinston Shirt', 80.00, 'Black / Sky', '100% Cotton Twill Flannel, 6 oz\nYarn dyed\nGarment washed\nButton-down collar\nChest pocket\nContrast back\nFlag label at chest pocket\nLabel inside neck', 'Clothing', 'Shirts'),
(13, 'L/S Grant Shirt', 65.00, 'Black', '100% Cotton Oxford Flannel, 5 oz\nYarn dyed\nGarment washed\nButton-down collar\nChest pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(14, 'L/S Rushmore Shirt', 80.00, 'Navy Heather', '100% Cotton Poplin Flannel, 5.6 oz\nBrushed on both sides\nButton-down collar\nChest pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(15, 'L/S Rushmore Shirt', 80.00, 'Cranberry Heather', '100% Cotton Poplin Flannel, 5.6 oz\nBrushed on both sides\nButton-down collar\nChest pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(16, 'L/S Rushmore Shirt', 80.00, 'Grey Heather', '100% Cotton Poplin Flannel, 5.6 oz\nBrushed on both sides\nButton-down collar\nChest pocket\nFlag label at chest pocket\nLoop label inside neck', 'Clothing', 'Shirts'),
(17, 'L/S Bradford Shirt', 70.00, 'Sub Blue', '100% Cotton Twill, 5.9 oz\nYarn dyed\nGarment washed\nButton-down collar\nSports label on hem\nLoop label inside neck', 'Clothing', 'Shirts'),
(18, 'L/S Bradford Shirt', 70.00, 'Snow', '100% Cotton Twill, 5.9 oz\nYarn dyed\nGarment washed\nButton-down collar\nSports label on hem\nLoop label inside neck', 'Clothing', 'Shirts');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Josh', 'ferrari'),
(3, 'admin', 'password');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
