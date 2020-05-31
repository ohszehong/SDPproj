-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2019 at 03:06 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newapmeal`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `Comment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `Meal_ID` int(11) NOT NULL,
  `Comment_Text` varchar(150) NOT NULL,
  `Comment_Datetime` datetime NOT NULL,
  `Comment_Ban` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Comment_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `comment_ibfk_2` (`Meal_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Comment_ID`, `User_ID`, `Meal_ID`, `Comment_Text`, `Comment_Datetime`, `Comment_Ban`) VALUES
(109, 'TP000001', 65, 'Hehehe, I buy KFC, You buy Mcd', '2019-04-16 08:10:50', 'N'),
(110, 'TP000004', 65, 'No sir. Auntie Anne is better', '2019-04-16 08:19:44', 'N'),
(111, 'TP000002', 69, 'Expensive tho', '2019-04-16 08:48:41', 'N'),
(112, 'TP000002', 77, 'Red bean with pearl.... weird', '2019-04-16 08:49:50', 'N'),
(113, 'TP000003', 73, 'Can you update your food\'s pic? I can\'t see it properly', '2019-04-16 08:52:14', 'N'),
(114, 'TP000004', 84, 'I like sweet!', '2019-04-16 08:55:48', 'N'),
(115, 'TP000006', 76, 'Although I\'m old, I love milk tea', '2019-04-16 08:58:30', 'N'),
(116, 'TP000008', 68, 'Chocolate is love', '2019-04-16 11:03:27', 'N'),
(117, 'TP000003', 68, 'Thanks! How bout me?', '2019-04-16 11:05:39', 'N'),
(118, 'TP000013', 61, 'sad\n', '2019-04-18 12:14:13', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

DROP TABLE IF EXISTS `meal`;
CREATE TABLE IF NOT EXISTS `meal` (
  `Meal_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stall_ID` int(11) NOT NULL,
  `Meal_Name` varchar(255) NOT NULL,
  `Meal_Category_1` varchar(30) NOT NULL,
  `Meal_Category_2` varchar(30) NOT NULL,
  `Meal_Price` double NOT NULL,
  `Meal_Availability` char(1) NOT NULL,
  `Meal_Description` text NOT NULL,
  `Meal_Discount` double DEFAULT '0',
  `Meal_Image` varchar(250) DEFAULT NULL,
  `Meal_Accept` char(1) NOT NULL DEFAULT 'N',
  `Meal_Notify` char(1) NOT NULL DEFAULT 'Y',
  `Meal_Delete` char(1) DEFAULT 'N',
  PRIMARY KEY (`Meal_ID`),
  KEY `Stall_ID` (`Stall_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`Meal_ID`, `Stall_ID`, `Meal_Name`, `Meal_Category_1`, `Meal_Category_2`, `Meal_Price`, `Meal_Availability`, `Meal_Description`, `Meal_Discount`, `Meal_Image`, `Meal_Accept`, `Meal_Notify`, `Meal_Delete`) VALUES
(60, 4, 'McChicken', 'sets', 'western', 10, 'Y', 'Your favorite chicken burger cooked to golden perfection topped with lettuce and special sauce.', 5, 'SDP materials/McChicken.png', 'Y', 'Y', 'N'),
(61, 4, 'Spicy Chicken McDeluxe', 'sets', 'western', 15, 'Y', 'Specially marinated whole chicken thigh meat with a delightfully crispy coat, layered with fresh lettuce and special sauce in a corn meal bun.', 0, 'SDP materials/SpicyChickenMcDeluxe.png', 'Y', 'Y', 'N'),
(62, 4, 'Double Cheeseburger', 'sets', 'western', 15, 'N', 'Two slices of cheese coupled with two tasty beef patties, the Double Cheeseburger is always a delight', 0, 'SDP materials/DoubleCheeseburger.png', 'Y', 'Y', 'N'),
(63, 4, 'GCB - Grilled Chicken Burger', 'sets', 'western', 15, 'Y', 'A delicious grilled chicken thigh, topped with crunchy iceberg lettuce and smoky chargrilled sauce, served in a toasted sesame seed bun', 0, 'SDP materials/GCB.png', 'Y', 'Y', 'N'),
(64, 4, 'Ayam Goreng McD', 'sets', 'western', 15, 'Y', 'Juicy and tasty!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', 0, 'SDP materials/AyamGorengMcd.png', 'Y', 'Y', 'N'),
(65, 5, 'SNACKER BOX', 'sets', 'western', 9.2, 'Y', '1 piece of chicken, cheezy wedges, fries, drink', 0, 'SDP materials/sjb-snacker-box.png', 'Y', 'Y', 'N'),
(66, 5, 'TWISTER BOX', 'sets', 'western', 13.9, 'Y', '1 piece of chicken, wrap, fries, drink.', 0, 'SDP materials/sjb-twister-box.png', 'Y', 'Y', 'N'),
(67, 5, 'SIGNATURE BOX', 'sets', 'western', 15.5, 'N', '1 piece of chicken, burger, fries, drink.', 0, 'SDP materials/sjb-signature-box.png', 'Y', 'Y', 'N'),
(68, 6, 'Chocolate', 'desserts', 'western', 8, 'Y', 'Our extra rich chocolate ice cream.', 0, 'SDP materials/Chocolate.png', 'Y', 'Y', 'N'),
(69, 6, 'Chocolate Chip', 'desserts', 'western', 9, 'Y', 'Vanilla ice cream with lots of bittersweet chocolate chips.', 0, 'SDP materials/ChocolateChips.png', 'Y', 'Y', 'N'),
(70, 6, 'Mint Chocolate Chip', 'desserts', 'western', 10, 'Y', 'Mint ice cream with lots of chocolate chips.', 0, 'SDP materials/MintChocolateChips.jpg', 'Y', 'Y', 'N'),
(71, 6, 'Cookies `n Cream', 'desserts', 'western', 10, 'Y', 'Vanilla ice cream with lots of cookie chunks throughout.', 0, 'SDP materials/CookiesAndCream.png', 'Y', 'Y', 'N'),
(72, 7, 'Original pretzel', 'western', 'western', 5, 'Y', 'The pretzel that built an empire.', 0, 'SDP materials/_.._.._.._files_editor_files_images_Original_small.jpg', 'Y', 'Y', 'N'),
(73, 7, 'Cinnamon Sugar pretzels', 'western', 'western', 7, 'Y', 'What better way to spoil dinner than this sweet treat. Classic and all-time favourite. Blend of fine cinnamon powder with sugar coating the buttered pretzel.', 0, 'SDP materials/_.._.._.._files_editor_files_images_cinnamon_small.jpg', 'Y', 'Y', 'N'),
(74, 7, 'Almond pretzels', 'western', 'western', 6, 'Y', 'Tastefully coated with toasted Almond toffee crunch, together with signature Caramel dip.', 0, 'SDP materials/_.._.._.._files_editor_files_images_Almond.jpg', 'Y', 'Y', 'N'),
(75, 8, 'Signature Brown Sugar Pearl Milk Tea', 'drinks', 'desserts', 8, 'Y', 'A locally-upgraded version of the Original Milk Tea, now with brown sugar! Combined with the irresistible chew of pearls and the rich, toffee-like flavor of brown sugar, this drink is unforgettable.', 0, 'SDP materials/download.png', 'Y', 'Y', 'N'),
(76, 8, 'Original Pearl Milk Tea', 'drinks', 'desserts', 8, 'Y', 'The Original Pearl Milk Tea tops the chart as the most famous type of milk tea in the world. A must-try for everyone!', 0, 'SDP materials/download (1).png', 'Y', 'Y', 'N'),
(77, 8, 'Red Bean Pearl Milk Tea', 'drinks', 'desserts', 9, 'Y', 'The full grains of Japanese Tokachi redbeans are paired with our pearls in this milk tea to make one very enjoyable drink.', 0, 'SDP materials/download (2).png', 'Y', 'Y', 'N'),
(78, 9, 'Summer Party', 'sets', 'asians', 20, 'Y', 'Soft shell crab, tempura nugget, salmon teriyaki, takoyaki & deep-fried chicken dumplings, served with spicy mayo &mayonnaise', 0, 'SDP materials/haru.jpg', 'Y', 'Y', 'N'),
(79, 10, 'HAINAN TOAST WITH BUTTER + KAYA', 'breakfast', 'sets', 10, 'Y', 'Rise and shine with two slices of our well-toasted, fluffy roti. Coated with a generous spread of kaya and a right touch of rich buttery finish, two is never quite enough.', 0, 'SDP materials/3-hainan-toast-with-butter-kaya.jpg', 'Y', 'Y', 'N'),
(80, 10, 'HAINAN FRENCH TOAST WITH KAYA + PEANUT BUTTER', 'breakfast', 'sets', 10, 'Y', 'Get the best of both worlds with the sweet taste of kaya and savory crunch of peanut butter all lovingly spread in between two slices of our perfectly toasted and fluffy roti. Itâ€™s one bite you canâ€™t resist!', 0, 'SDP materials/4-hainan-french-toast-with-kaya-peanut-butter.jpg', 'Y', 'Y', 'N'),
(81, 10, 'HAINAN FRENCH TOAST WITH SAMBAL + CHICKEN FLOSS (SPICY)', 'breakfast', 'sets', 10, 'Y', 'Your favourite classic French Toast now comes with an extra spicy kick, with our signature sambal and spicy chicken floss! Perfect for those who canâ€™t get enough of hot stuff!', 0, 'SDP materials/sambal-spicy-chicken-floss-1.jpg', 'Y', 'Y', 'N'),
(82, 10, 'NAAN WITH MINCED CHICKEN', 'breakfast', 'sets', 10, 'Y', 'Minced chicken, cucumber slices, tomato slices, onion slices and the ever beautiful cheddar cheese, toasted in a sandwich marriage with our signature naan.', 0, 'SDP materials/naan-with-minced-chicken-1.jpg', 'Y', 'Y', 'N'),
(83, 11, 'Style Chinese Chicken Fried Rice', 'asians', 'asians', 10, 'Y', 'When cooked rice is stir-fried with egg, but without meat or seafood, it is called plain fried rice, and it often has greater appeal than boiled rice to those who are not used to eating rice as a staple as the stir-frying process adds so much taste and fragrance.', 0, 'SDP materials/maxresdefault.jpg', 'Y', 'Y', 'N'),
(84, 12, 'Honey Wafito', 'desserts', 'western', 7, 'Y', 'A waffle is a dish made from leavened batter or dough that is cooked between two plates that are patterned to give a characteristic size, shape, and surface impression.', 0, 'SDP materials/IMG_9113-best-waffle-recipe-square.jpg', 'Y', 'Y', 'N'),
(85, 4, 'this is real fries', 'breakfast', 'sets', 55, 'Y', 'Believe or not, this is definitely a real fries or perhaps , more than one real fries ', 0, 'SDP materials/chips.png', 'Y', 'Y', 'N'),
(86, 4, 'this is real fries', 'sets', 'western', 55.5, 'Y', 'This is the real fries, believe or not, this is definitely the real fries', 20, 'SDP materials/chips.png', 'N', 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `order_meal`
--

DROP TABLE IF EXISTS `order_meal`;
CREATE TABLE IF NOT EXISTS `order_meal` (
  `OM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Meal_ID` int(11) NOT NULL,
  `Order_ID` varchar(50) NOT NULL,
  `OM_Price` double NOT NULL DEFAULT '0',
  `OM_Quantity` int(11) NOT NULL,
  `OM_Status` varchar(50) NOT NULL,
  `OM_Notify` char(1) NOT NULL,
  PRIMARY KEY (`OM_ID`),
  KEY `Order_ID` (`Order_ID`),
  KEY `order_meal_ibfk_2` (`Meal_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=391 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_meal`
--

INSERT INTO `order_meal` (`OM_ID`, `Meal_ID`, `Order_ID`, `OM_Price`, `OM_Quantity`, `OM_Status`, `OM_Notify`) VALUES
(366, 68, '130', 8, 1, 'completed', 'Y'),
(367, 68, '130', 8, 1, 'completed', 'Y'),
(368, 73, '130', 21, 3, 'completed', 'Y'),
(369, 73, '130', 21, 3, 'completed', 'Y'),
(370, 61, '131', 45, 3, 'completed', 'Y'),
(371, 61, '131', 60, 4, 'completed', 'Y'),
(372, 61, '131', 60, 4, 'completed', 'Y'),
(373, 73, '132', 21, 3, 'completed', 'Y'),
(374, 73, '132', 21, 3, 'completed', 'Y'),
(375, 74, '133', 18, 3, 'completed', 'Y'),
(376, 74, '133', 18, 3, 'completed', 'Y'),
(377, 74, '133', 6, 1, 'completed', 'Y'),
(378, 74, '134', 18, 3, 'completed', 'Y'),
(379, 74, '134', 18, 3, 'completed', 'Y'),
(380, 63, '135', 45, 3, 'completed', 'N'),
(381, 63, '135', 45, 3, 'completed', 'N'),
(382, 65, '136', 27.6, 3, 'completed', 'Y'),
(383, 65, '136', 27.6, 3, 'completed', 'Y'),
(386, 69, '137', 9, 1, 'pending', 'Y'),
(387, 69, '137', 9, 1, 'accepted', 'Y'),
(388, 60, '138', 5, 1, 'completed', 'Y'),
(389, 60, '139', 5, 1, 'accepted', 'Y'),
(390, 61, '140', 15, 1, 'in-cart', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `Report_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `Report_Reason` varchar(50) NOT NULL,
  `Report_Text` longtext NOT NULL,
  `Report_Date` date NOT NULL,
  PRIMARY KEY (`Report_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stall`
--

DROP TABLE IF EXISTS `stall`;
CREATE TABLE IF NOT EXISTS `stall` (
  `Stall_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `Stall_Name` varchar(50) NOT NULL,
  `Stall_Contract` date NOT NULL,
  `Stall_Description` varchar(150) NOT NULL,
  `Stall_Image` varchar(250) DEFAULT 'SDP materials/no-image.jpg',
  PRIMARY KEY (`Stall_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stall`
--

INSERT INTO `stall` (`Stall_ID`, `User_ID`, `Stall_Name`, `Stall_Contract`, `Stall_Description`, `Stall_Image`) VALUES
(4, 'TP000001', 'McDonald\'s', '2022-01-01', 'Im lovin\' it ', 'SDP Materials/mcd-logo-1-e1481149763622.jpg'),
(5, 'TP000002', 'KFC', '2022-03-05', 'failed 1009 times , and finally success one time', 'SDP Materials/KFC_logo.svg.png'),
(6, 'TP000003', 'Baskin\' Robin ', '2022-01-01', 'Delicious ice creams ', 'SDP Materials/fdd1eb6525d0adf7d0720ef31b59bc07.jpg'),
(7, 'TP000004', 'Auntie Anne\'s ', '2022-01-01', 'Biscuit deliyocious ', 'SDP Materials/1.jpg'),
(8, 'TP000005', 'Tealive', '2022-01-01', 'Bubble tea, not the best, but is the best', 'SDP Materials/tealive_logo_desktop17Feb2017152559.jpg'),
(9, 'TP000006', 'Sakae sushi ', '2022-01-01', 'Sushi sushi ', 'SDP Materials/download.jpg'),
(10, 'TP000007', 'Paparich', '2022-01-01', 'Im your papa , and u r my child', 'SDP Materials/papparich.jpg'),
(11, 'TP000008', 'Auntie Mixed Rice', '2022-01-01', 'Mixed Rice must eat with family ', 'SDP Materials/bibimbap_2012955.jpg'),
(12, 'TP000009', 'JM Bistro', '2019-03-19', 'Mamak is the best ', 'SDP Materials/download (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

DROP TABLE IF EXISTS `topup`;
CREATE TABLE IF NOT EXISTS `topup` (
  `Topup_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `Topup_Amount` double NOT NULL,
  `Topup_Date` date NOT NULL,
  PRIMARY KEY (`Topup_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`Topup_ID`, `User_ID`, `Topup_Amount`, `Topup_Date`) VALUES
(10, 'TP000001', 1000, '2019-04-16'),
(11, 'TP000010', 1000, '2019-04-16'),
(12, 'TP000007', 1000, '2019-04-16'),
(13, 'TP000002', 1000, '2019-04-16'),
(14, 'TP000003', 12345, '2019-04-16'),
(15, 'TP000004', 1000, '2019-04-16'),
(16, 'TP000005', 1000, '2019-04-16'),
(17, 'TP000006', 1500, '2019-04-16'),
(18, 'TP000008', 1200, '2019-04-16'),
(19, 'TP000012', 5000, '2019-04-16'),
(20, 'TP000001', 2000.2, '2019-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `User_ID` varchar(50) NOT NULL,
  `User_Passwords` varchar(50) NOT NULL,
  `User_FN` varchar(50) NOT NULL,
  `User_LN` varchar(50) NOT NULL,
  `User_DOB` date NOT NULL,
  `User_Email` varchar(50) NOT NULL,
  `User_Gender` char(1) NOT NULL,
  `User_Phone` varchar(30) NOT NULL,
  `User_Role` int(1) NOT NULL,
  `User_Balance` double NOT NULL DEFAULT '0',
  `User_Image` varchar(250) DEFAULT 'SDP materials/user.png',
  PRIMARY KEY (`User_ID`),
  KEY `User_Role` (`User_Role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Passwords`, `User_FN`, `User_LN`, `User_DOB`, `User_Email`, `User_Gender`, `User_Phone`, `User_Role`, `User_Balance`, `User_Image`) VALUES
('TP000001', 'sadsad123', 'Henry', 'Chanelle', '1999-05-24', 'Chanelle1234@gmail.com', 'F', '0112471785', 1, 3682, 'SDP Materials/trauma-biologist-a-profile-of-israel-liberzon-t.jpg'),
('TP000002', 'sadsad123', 'Meyer', 'Ruth', '1989-08-11', 'Ruthless25@gmail.com', 'M', '0185726174', 1, 1230.5, 'SDP Materials/images.jpg'),
('TP000003', 'TP000003', 'Liu', 'Brittney', '1994-03-01', 'Liuney198@gmail.com', 'F', '0197583719', 1, 11872.6, 'SDP Materials/shin-Yeeun-cover-profile.jpg'),
('TP000004', 'TP000004', 'Plummer', 'Haider', '1990-01-22', 'Plummerers12@gmail.com', 'M', '0172861726', 1, 735.2, 'SDP Materials/1522108716_8_stylish-cool-boys-dp-profile-pictures-for-facebook.jpg'),
('TP000005', 'TP000005', 'Hardin', 'Jace', '1988-09-09', 'JaceNotJayce22@gmail.com', 'M', '0142285871', 1, 890, 'SDP Materials/Brian-Jones-Profile.jpg'),
('TP000006', 'TP000006', 'Bredford ', 'Kadeem', '1976-07-11', 'KadeemKadoom129@gmail.com', 'F', '0192847182', 1, 1420, 'SDP Materials/390150.jpg'),
('TP000007', 'TP000007', 'Rosa', 'Nathalie', '1993-02-11', 'RosaRose958@gmail.com', 'F', '0198291727', 1, 735, 'SDP Materials/download (2).jpg'),
('TP000008', 'TP000008', 'Phelps', 'Reilly', '2000-03-01', 'ReilyPheply58@hotmail.com', 'M', '0166772888', 1, 1160, 'SDP Materials/Kieran-Kenny-profile-1.jpg'),
('TP000009', 'TP000009', 'Harold', 'Gentry', '1983-01-01', 'HaroldnessGem29@gmail.com', 'F', '0182657265', 1, 0, 'SDP Materials/Osman-Khalid-Butt-Profile-Biography-Dramas-Pictures.jpg'),
('TP000010', 'TP000010', 'Terri ', 'Coles', '1995-09-01', 'Coleslin124@gmail.com', 'M', '0185626281', 0, 930, 'SDP Materials/Profile photo - JBouyer.jpg'),
('TP000011', 'TP000011', 'Varun', 'Bean', '1998-02-05', 'MrBean24@gmail.com', 'M', '0182747181', 0, 0, 'SDP Materials/dalibor-matura_1.jpg'),
('TP000012', 'TP000012', 'Arwa', 'Rosas', '1978-11-11', 'Rosalia24Arwa@gmail.com', 'F', '0112847181', 2, 4800, 'SDP Materials/cute-girls-profile-pics-1024x724.jpg'),
('TP000013', 'TP000013', 'Leen', 'Herring', '1996-12-04', 'HerringnotHearing49@gmail.com', 'M', '0198757281', 3, 0, 'SDP materials/user.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

DROP TABLE IF EXISTS `user_order`;
CREATE TABLE IF NOT EXISTS `user_order` (
  `Order_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `Order_Date` date NOT NULL,
  `Order_Month` varchar(10) NOT NULL,
  `Order_Price` double DEFAULT '0',
  `Order_Status` varchar(10) NOT NULL,
  `Order_Notify` char(1) NOT NULL,
  PRIMARY KEY (`Order_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`Order_ID`, `User_ID`, `Order_Date`, `Order_Month`, `Order_Price`, `Order_Status`, `Order_Notify`) VALUES
(130, 'TP000003', '2019-03-12', '04', 58, 'passive', 'Y'),
(131, 'TP000003', '2019-03-15', '04', 165, 'passive', 'Y'),
(132, 'TP000003', '2019-03-14', '04', 42, 'passive', 'Y'),
(133, 'TP000004', '2019-03-06', '04', 42, 'passive', 'Y'),
(134, 'TP000003', '2019-04-16', '04', 36, 'passive', 'Y'),
(135, 'TP000001', '2019-04-16', '04', 90, 'passive', 'Y'),
(136, 'TP000002', '2019-04-16', '04', 55.2, 'passive', 'Y'),
(137, 'TP000003', '2019-04-16', '04', 18, 'passive', 'Y'),
(138, 'TP000001', '2019-04-18', '04', 5, 'passive', 'Y'),
(139, 'TP000001', '2019-04-18', '04', 5, 'passive', 'Y'),
(140, 'TP000013', '2019-04-18', '04', 15, 'active', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `User_Role` int(1) NOT NULL,
  `Role_Name` varchar(20) NOT NULL,
  PRIMARY KEY (`User_Role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`User_Role`, `Role_Name`) VALUES
(0, 'Normal User'),
(1, 'Stallholder'),
(2, 'Accountant'),
(3, 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`Meal_ID`) REFERENCES `meal` (`Meal_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal`
--
ALTER TABLE `meal`
  ADD CONSTRAINT `meal_ibfk_1` FOREIGN KEY (`Stall_ID`) REFERENCES `stall` (`Stall_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_meal`
--
ALTER TABLE `order_meal`
  ADD CONSTRAINT `order_meal_ibfk_2` FOREIGN KEY (`Meal_ID`) REFERENCES `meal` (`Meal_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stall`
--
ALTER TABLE `stall`
  ADD CONSTRAINT `stall_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topup`
--
ALTER TABLE `topup`
  ADD CONSTRAINT `topup_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`User_Role`) REFERENCES `user_role` (`User_Role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
