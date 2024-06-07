-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 02:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `order_status`) VALUES
(1, '2023-05-08', 'Test', '123213', '20.00', '2.60', '22.60', '0', '22.60', '0', '22.60', 2, 3, 2),
(2, '2023-05-10', 'AAA', '01', '1800.00', '234.00', '2034.00', '0', '2034.00', '1000', '1034.00', 2, 1, 2),
(3, '2023-05-24', 'Audace', '07885541159', '12.00', '1.56', '13.56', '2', '11.56', '11.56', '-1.7763568394003E-15', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 1, 1, '1', '20', '20.00', 2),
(6, 2, 1, '90', '10', '900.00', 2),
(7, 2, 2, '90', '10', '900.00', 2),
(8, 3, 9, '12', '1', '12.00', 2);

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
(266, 'P-00001', 'HS White', 'Pc', 'Polo', 19, 16, 1),
(275, 'P-00002', 'HS Black', 'Pc', 'Tshirt', 390, 280, 1),
(276, 'P-00003', 'HS Navy Blue S', 'Pc', 'Tshirt', 23, 12, 1),
(277, 'P-00004', 'HS Yellow S', 'Pc', 'Tshirt', 310, 280, 1),
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
(233, 276, 'SA-00001', 'Opening Stock', '2024-07-04', 'HS Navy Blue S', 12, 2, 24, 1),
(234, 278, 'SA-00002', 'Inward Stock', '2024-06-07', 'HS Navy Blue S', 12, 2, 24, 1),
(235, 276, 'SA-00003', 'Inward Stock', '2024-06-11', 'HS Navy Blue S', 12, 21, 252, 1),
(236, 277, 'SA-00004', 'Lost of Theft', '2024-05-31', 'HS Yellow S', 280, 1, 280, 1),
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
(254, 276, 'SA-00022', 'Opening Stock', '0002-02-01', 'HS Navy Blue S', 12, 1, 12, 1);

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
  `Vcode` varchar(255) NOT NULL,
  `P_id` int(11) NOT NULL,
  `Customer` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Vreference` varchar(255) NOT NULL,
  `Pname` varchar(255) NOT NULL,
  `Vcost` int(11) NOT NULL,
  `Vquantity` int(11) NOT NULL,
  `vamount` int(11) NOT NULL,
  `Address` text NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `svaluation`
--

INSERT INTO `svaluation` (`Id`, `Vcode`, `P_id`, `Customer`, `Date`, `Vreference`, `Pname`, `Vcost`, `Vquantity`, `vamount`, `Address`, `Comment`, `Status`) VALUES
(55, 'SD-00008', 266, 'subhan', '2024-06-13', '2', 'HS White', 19, 2, 38, 'way on', 'best!', 1);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

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
  ADD PRIMARY KEY (`Id`),
  ADD KEY `P_id` (`P_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `svaluation`
--
ALTER TABLE `svaluation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `products` (`Id`);

--
-- Constraints for table `svaluation`
--
ALTER TABLE `svaluation`
  ADD CONSTRAINT `svaluation_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `products` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
