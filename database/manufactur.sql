-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 09:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manufactur`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cusid` int(11) NOT NULL,
  `Number` varchar(255) NOT NULL,
  `Customer` varchar(255) NOT NULL,
  `Datee` date NOT NULL,
  `Reference` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusid`, `Number`, `Customer`, `Datee`, `Reference`, `Quantity`, `Amount`, `Status`) VALUES
(7, 'SD-00001', 'naveed', '2024-06-12', 'qq\r\n\r\n', 0, 0, 1),
(8, 'SD-00002', 'rohan', '2024-06-27', 'sa', 0, 0, 1),
(9, 'SD-21474', 'Ramish', '2024-06-27', 'a', 0, 0, 1);

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `before_insert_Customer` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_Number VARCHAR(10);

    -- Find the maximum numeric part of the existing custom_ids
    SELECT IFNULL(MAX(CAST(SUBSTRING(Number, 3) AS UNSIGNED)), 0) + 1 INTO max_id FROM Customer;

    -- Generate the new custom_id with the prefix 'pi' and zero-padded number
    SET new_Number = CONCAT('SD-', LPAD(max_id, 5, '0'));

    -- Assign the new custom_id to the new row
    SET NEW.Number = new_Number;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `befowre_insert_Customer` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_Number VARCHAR(10);

    -- Find the maximum numeric part of the existing custom_ids
    SELECT IFNULL(MAX(CAST(SUBSTRING(Number, 3) AS UNSIGNED)), 0) + 1 INTO max_id FROM Customer;

    -- Generate the new custom_id with the prefix 'pi' and zero-padded number
    SET new_Number = CONCAT('SD-', LPAD(max_id, 5, '0'));

    -- Assign the new custom_id to the new row
    SET NEW.Number = new_Number;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pro`
--

CREATE TABLE `pro` (
  `Id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pro`
--

INSERT INTO `pro` (`Id`, `sid`, `cod`, `Name`, `price`, `quantity`, `amount`, `status`) VALUES
(35, 18, 'SD-00001', 'HS Black', 111, 21, 11, 1),
(37, 19, 'SD-00002', 'HS Pink S', 310, 9, 2790, 1),
(41, 21, 'SD-00004', 'HS White', 1232, 3, 369, 1),
(42, 21, 'SD-00004', 'HS White', 1232, 3, 369, 1),
(43, 22, 'SD-00005', 'HS Navy Blue S', 23, 11, 46, 1),
(44, 22, 'SD-00005', 'HS Navy Blue S', 23, 11, 46, 1),
(46, 23, 'SD-00006', 'HS Black', 11, 2, 390, 1),
(47, 23, 'SD-00006', 'HS Navy Blue S', 8921, 1, 115, 1),
(48, 24, 'SD-00007', 'HS White', 194, 2, 388, 1),
(49, 24, 'SD-00007', '276', 23, 2, 46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Measurement` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Sales_Price` int(11) NOT NULL,
  `Purchase_Price` int(255) NOT NULL,
  `Status` tinyint(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Code`, `Name`, `Measurement`, `Category`, `Sales_Price`, `Purchase_Price`, `Status`) VALUES
(266, 'P-00001', 'HS White', 'Pc', 'Tshirt', 194, 168, 1),
(275, 'P-00002', 'HS Black', 'Pc', 'Tshirt', 390, 200, 1),
(276, 'P-00003', 'HS Navy Blue S', 'Pc', 'Tshirt', 23, 12, 1),
(277, 'P-00004', 'HS Yellow S', 'Pc', 'Tshirt', 100, 80, 1),
(278, 'P-00005', 'HS Pink S', 'Pc', 'Tshirt', 310, 280, 1),
(279, 'P-00006', 'HS Green', 'Kg', 'Hoodies', 390, 330, 1);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `before_insert_products` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_Code VARCHAR(210);

    -- Find the maximum numeric part of the existing custom_ids
    SELECT IFNULL(MAX(CAST(SUBSTRING(Code, 3) AS UNSIGNED)), 0) + 1 INTO max_id FROM products;

    -- Generate the new custom_id with the prefix 'pi' and zero-padded number
    SET new_Code = CONCAT('P-', LPAD(max_id, 5, '0'));

    -- Assigcn the new custom_id to the new row
    SET NEW.Code = new_Code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `Id` int(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` tinyint(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`Id`, `Username`, `Password`, `Status`) VALUES
(1, 'affan', '$2y$10$AROGV9mseP732RrzYK57XeLjs6kwXL7OPedZVgQm0JGfqkJmihkEW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `Id` int(11) NOT NULL,
  `P_id` int(11) NOT NULL,
  `SCode` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Reference` varchar(111) NOT NULL,
  `Cost` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`Id`, `P_id`, `SCode`, `Type`, `Date`, `Reference`, `Cost`, `Quantity`, `Amount`, `Status`) VALUES
(236, 277, 'SA-00004', 'Opening Stock', '2024-05-31', 'HS Yellow S', 280, 3, 840, 1),
(237, 275, 'SA-00005', 'Lost of Theft', '2024-05-31', 'HS Black', 280, 2, 560, 1),
(238, 276, 'SA-00006', 'Opening Stock', '2024-06-07', 'HS Navy Blue S', 12, 2, 24, 1),
(239, 275, 'SA-00007', 'Lost of Theft', '2024-06-07', 'HS Black', 280, 2, 560, 1),
(240, 278, 'SA-00008', 'Opening Stock', '2024-06-07', 'HS Pink S', 280, 2, 560, 1),
(241, 277, 'SA-00009', 'Opening Stock', '2024-06-07', 'HS Yellow S', 280, 2, 560, 1),
(242, 275, 'SA-00010', 'Inward Stock', '2024-06-13', 'HS Black', 280, 3, 840, 1),
(243, 278, 'SA-00011', 'Inward Stock', '2024-06-13', 'HS Pink S', 280, 22, 6160, 1),
(244, 278, 'SA-00012', 'Lost of Theft', '2024-06-01', 'HS Pink S', 280, 2, 560, 1),
(245, 276, 'SA-00013', 'Lost of Theft', '2024-06-01', 'HS Navy Blue S', 12, 1, 12, 1),
(246, 276, 'SA-00014', 'Lost of Theft', '2024-06-01', 'HS Navy Blue S', 12, 1, 12, 1),
(247, 266, 'SA-00015', 'Lost of Theft', '2024-06-01', 'HS White', 11, 1, 11, 1),
(248, 276, 'SA-00016', 'Inward Stock', '2024-06-05', 'HS Navy Blue S', 12, 12, 144, 1),
(249, 278, 'SA-00017', 'Inward Stock', '2024-06-05', 'HS Pink S', 280, 2, 560, 1),
(250, 276, 'SA-00018', 'Inward Stock', '2024-06-05', 'HS Navy Blue S', 12, 1, 12, 1),
(251, 266, 'SA-00019', 'Opening Stock', '2024-06-08', 'HS White', 11, 2, 22, 1),
(252, 279, 'SA-00020', 'Opening Stock', '2024-05-29', 'HS Green', 330, 2, 660, 1),
(253, 276, 'SA-00021', 'Opening Stock', '0002-02-01', 'HS Navy Blue S', 12, 1, 12, 1),
(254, 276, 'SA-00022', 'Opening Stock', '0002-02-01', 'HS Navy Blue S', 12, 1, 12, 1),
(264, 278, 'SA-00023', 'Opening Stock', '2024-06-07', 'HS Pink S', 280, 1, 280, 1),
(265, 275, 'SA-00024', 'Opening Stock', '2024-06-07', 'HS Black', 280, 2, 560, 1),
(266, 266, 'SA-00025', 'Opening Stock', '2024-06-07', 'HS White', 16, 1, 16, 1),
(267, 277, 'SA-00026', 'Opening Stock', '2024-06-07', 'HS Yellow S', 280, 1, 280, 1);

--
-- Triggers `stock`
--
DELIMITER $$
CREATE TRIGGER `before_insert_stock` BEFORE INSERT ON `stock` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_SCode VARCHAR(210);

    -- Find the maximum numeric part of the existing SCodes
    SELECT IFNULL(MAX(CAST(SUBSTRING(SCode, 4) AS UNSIGNED)), 0) + 1 INTO max_id FROM stock;

    -- Generate the new SCode with the prefix 'SA-' and zero-padded number
    SET new_SCode = CONCAT('SA-', LPAD(max_id, 5, '0'));

    -- Assign the new SCode to the new row
    SET NEW.SCode = new_SCode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `svaluation`
--

CREATE TABLE `svaluation` (
  `Id` int(11) NOT NULL,
  `Cid` int(11) NOT NULL,
  `Vcode` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Vreference` varchar(255) NOT NULL,
  `Vquantity` int(11) NOT NULL,
  `vamount` int(11) NOT NULL,
  `Address` text NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `svaluation`
--

INSERT INTO `svaluation` (`Id`, `Cid`, `Vcode`, `Date`, `Vreference`, `Vquantity`, `vamount`, `Address`, `Comment`, `Status`) VALUES
(18, 8, 'SD-00001', '2024-04-30', 'ko', 34, 112, '', '', 1),
(19, 8, 'SD-00002', '2024-06-04', 'ok', 17, 2974, '', '', 1),
(20, 8, 'SD-00003', '2024-06-14', 'asa', 8, 1381, '77', 'h', 1),
(21, 8, 'SD-00004', '2024-05-29', '12', 14, 501, '', '', 1),
(22, 8, 'SD-00005', '2024-06-04', 'qw', 5, 636, '', '', 1),
(23, 9, 'SD-00006', '2024-05-02', 'f', 211, 121, '', '', 1),
(24, 8, 'SD-00007', '2024-05-31', 'asa', 4, 434, '', '', 1);

--
-- Triggers `svaluation`
--
DELIMITER $$
CREATE TRIGGER `before_svaluation` BEFORE INSERT ON `svaluation` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_VCode VARCHAR(10);

    -- Find the maximum numeric part of the existing custom_ids
    SELECT IFNULL(MAX(CAST(SUBSTRING(VCode, 4) AS UNSIGNED)), 0) + 1 INTO max_id FROM svaluation;

    -- Generate the new custom_id with the prefix 'SD-' and zero-padded number
    SET new_VCode = CONCAT('SD-', LPAD(max_id, 5, '0'));

    -- Assign the new custom_id to the new row
    SET NEW.VCode = new_VCode;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusid`);

--
-- Indexes for table `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `P_id` (`P_id`);

--
-- Indexes for table `svaluation`
--
ALTER TABLE `svaluation`
  ADD PRIMARY KEY (`Id`,`Vcode`),
  ADD KEY `Cid` (`Cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pro`
--
ALTER TABLE `pro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `svaluation`
--
ALTER TABLE `svaluation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pro`
--
ALTER TABLE `pro`
  ADD CONSTRAINT `pro_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `svaluation` (`Id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `products` (`Id`);

--
-- Constraints for table `svaluation`
--
ALTER TABLE `svaluation`
  ADD CONSTRAINT `svaluation_ibfk_1` FOREIGN KEY (`Cid`) REFERENCES `customer` (`cusid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
