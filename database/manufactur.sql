-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 12:35 PM
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
(266, 'P-00001', 'HS White', 'Kg', 'Tshirt', 12, 11, 1),
(275, 'P-00002', 'HS Black', 'Pc', 'Tshirt', 390, 280, 1),
(276, 'P-00003', 'HS Navy Blue S', 'Pc', 'Tshirt', 23, 12, 1),
(277, 'P-00004', 'HS Yellow S', 'Pc', 'Tshirt', 310, 280, 1);

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
(1, 'affan', '$2y$10$AROGV9mseP732RrzYK57XeLjs6kwXL7OPedZVgQm0JGfqkJmihkEW', 1),
(2, 'affan siddiui', '$2y$10$t7EXt6FoDrPjmssMOcRh6uI3bdOOAuwDxf.AE.J9qG2FYBYGK1dVm', 1),
(3, 'ahmed', '$2y$10$p9r.R/2K7LXVDQ30e/m12enO6GIcbHnbpPQWY7oBjrevuiFaXM01W', 1),
(4, 'affan22', '$2y$10$VERr3k47JCHQENCJGgqZiOEbSW0JBAmpuv7.3IZdkbXULX58uFXSW', 1);

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
(150, 266, 'SA-00001', 'Opening Stock', '2024-06-06', '', 11, 1, 11, 1),
(171, 275, 'SA-00002', 'Opening Stock', '2024-06-07', 'HS Black', 280, 1, 280, 1),
(172, 266, 'SA-00003', 'Opening Stock', '2024-06-14', 'HS White', 11, 1, 11, 1),
(173, 266, 'SA-00004', 'Lost of Theft', '2024-06-04', 'HS White', 11, 1, 11, 1),
(174, 275, 'SA-00005', 'Lost of Theft', '2024-06-13', 'HS Black', 280, 1, 280, 1),
(175, 266, 'SA-00006', 'Inward Stock', '2024-06-12', 'HS White', 11, 1, 11, 1),
(176, 266, 'SA-00007', 'Lost of Theft', '2024-05-30', 'HS White', 11, 1, 11, 1),
(177, 266, 'SA-00008', 'Opening Stock', '2024-06-01', 'HS White', 11, 1, 11, 1),
(178, 276, 'SA-00009', 'Opening Stock', '2024-06-06', 'HS Navy Blue S', 12, 1, 12, 1),
(179, 275, 'SA-00010', 'Lost of Theft', '2024-05-31', 'HS Black', 280, 3, 840, 1),
(180, 266, 'SA-00011', 'Lost of Theft', '2024-06-06', 'HS Black', 11, 1, 1, 1),
(182, 266, 'SA-00012', 'Lost of Theft', '2024-06-06', 'HS Black', 11, 1, 1, 1),
(183, 266, 'SA-00013', 'Inward Stock', '2024-06-07', 'HS White', 11, 1, 11, 1),
(184, 276, 'SA-00014', 'Opening Stock', '0001-02-01', 'HS Navy Blue S', 12, 2, 24, 1),
(185, 266, 'SA-00015', 'Lost of Theft', '2024-06-14', 'HS White', 11, 1, 11, 1),
(186, 266, 'SA-00016', 'Opening Stock', '2024-05-02', 'HS Black', 1, 2, 2, 1),
(187, 266, 'SA-00017', 'Lost of Theft', '2024-06-01', 'HS Black', 2, 2, 1, 1),
(189, 266, 'SA-00018', 'Lost of Theft', '2024-06-01', 'HS Black', 2, 2, 1, 1),
(191, 266, 'SA-00019', 'Lost of Theft', '2024-06-01', 'HS Black', 2, 2, 1, 1),
(192, 266, 'SA-00020', 'Inward Stock', '0001-01-01', 'HS White', 11, 2, 22, 1),
(193, 275, 'SA-00021', 'Opening Stock', '2024-06-13', 'HS Black', 280, 2, 560, 1),
(194, 275, 'SA-00022', 'Opening Stock', '0002-02-01', 'HS Black', 280, 2, 560, 1),
(195, 275, 'SA-00023', 'Inward Stock', '2024-06-08', 'HS Black', 280, 2, 560, 1),
(196, 275, 'SA-00024', 'Opening Stock', '2024-06-05', 'HS Black', 280, 2, 560, 1),
(197, 266, 'SA-00025', 'Opening Stock', '2024-06-05', 'HS White', 11, 1, 11, 1),
(198, 277, 'SA-00026', 'Opening Stock', '2024-06-03', 'HS Yellow S', 280, 100, 28000, 1),
(199, 277, 'SA-00027', 'Opening Stock', '2024-06-03', 'HS Yellow S', 280, 100, 28000, 1),
(200, 275, 'SA-00028', 'Inward Stock', '2024-05-30', 'HS Black', 280, 1, 280, 1),
(201, 275, 'SA-00029', 'Opening Stock', '0011-02-01', 'HS Black', 280, 22, 6160, 1);

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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `products` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
