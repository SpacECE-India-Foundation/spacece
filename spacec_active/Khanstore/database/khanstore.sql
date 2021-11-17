-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 08:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khanstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`) VALUES
(3, 'Rizwan', 'rizwan@gmail.com', '$2y$10$Z1DnKbJRDFUTHMI7y1vSqeU3.Y9cgDyC4AeWx4.ucH34z/mkzL2E.', '0'),
(4, 'ajay', 'ajay@gmail.com', '$2y$10$UGzx/ODNB4ZSFruRF8BN2eC/NNE.6MBhfTTYKtUo.k4ZVHZFD85DO', '0'),
(5, 'Rizwan', 'rizwankhan@gmail.com', '$2y$10$qZ0OoyX8bhAVxDFM/fx8leZSZwlyq15c1C/KTnaqDLSx6eCDJ0VpC', '0'),
(6, 'Faizan', 'faizan@gmail.com', '$2y$10$Ll2.sETLuB8sdhh1LRK4e.cQqn4CtTEudFg.exhf76D6rGzSOwWNm', '0'),
(12, 'kirti Salunkhe', 'kirtisalunkhe15@gmail.com', '$2y$10$4BWUERSUilQmqLzKrZUH2exH20mBY1SL0268rzmM4S1sMPpIbmxDu', '0'),
(13, 'Kirti Salunkhe', 'chetansalunkhe18@gmail.com', '$2y$10$3/Ykc/m5nXj1X4nj4jrcge1saHantJdtPoGNRLMR67hhkSZEDBzj6', '0');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(11, 'p'),
(15, 'Barbieq'),
(31, 'fd'),
(32, 'kirti'),
(33, 'phwretjuyj');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `start_date` date DEFAULT curdate(),
  `end_date` date DEFAULT NULL,
  `total_duration` int(11) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `exchange_product` int(11) DEFAULT 0,
  `exchange_price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`, `start_date`, `end_date`, `total_duration`, `status`, `exchange_product`, `exchange_price`) VALUES
(2, 6, '::1', 8, 1, '2021-09-22', '2021-09-24', 2, 'Exchange', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(16, 'fg'),
(17, 'fgdgr'),
(21, 'fgygh'),
(22, 'fgyghfdg'),
(23, 'hjkjk');

-- --------------------------------------------------------

--
-- Table structure for table `cust_products`
--

CREATE TABLE `cust_products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `product_cat` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `product_brand` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `product_des` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `product_image` varchar(250) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `cust_products`
--

INSERT INTO `cust_products` (`product_id`, `user_id`, `product_name`, `product_cat`, `product_brand`, `product_des`, `product_image`) VALUES
(1, 9, 'barbie', 'sdf', 'barbie', 'H', 'images/barbie.jpg'),
(2, 9, 'barbie', 'sdf', 'barbie', 'dsfd', 'images/barbie.jpg'),
(3, 9, 'puzzle', 'sdf', 'puzzle', 'dg', 'images/puzzle.jpg'),
(4, 8, 'puzzle', 'HGJ', 'puzzle', 'good', 'images/puzzle.jpg'),
(5, 9, 'barbie', 'sdf', 'barbie', 'k,', 'images/barbie.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `user_id` int(11) DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  `exchange_price` int(11) DEFAULT NULL,
  `rent_price` int(11) DEFAULT 0,
  `deposit` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`user_id`, `product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_qty`, `product_desc`, `product_image`, `product_keywords`, `exchange_price`, `rent_price`, `deposit`) VALUES
(8, 1, 17, 11, 'puzzle', 2, 2, 'fyh', '1632248994_puzzle.jpg', 'puzzle', 3, 4, 5),
(8, 2, 17, 15, 'barbie', 1, 1, 'we', '1632251955_barbie.jpg', 'bar', 1, 1, 2),
(8, 3, 17, 15, 'barbie', 1, 1, 'we', '1632251983_barbie.jpg', 'bar', 1, 1, 3),
(0, 6, 16, 15, 'Samsung Galaxy S6', 3, 3, '5rt', '1632292598_barbie.jpg', 'puzzle', 3, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(1, 'Rizwan', 'Khan', 'rizwankhan.august16@gmail.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', 'Rahmat Nagar Burnpur Asansol', 'Asansol'),
(2, 'Rizwan', 'Khan', 'rizwankhan.august16@yahoo.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', 'Rahmat Nagar Burnpur Asansol', 'Asa'),
(3, 'Kirti', 'Salunkhe', 'kirtisalunkhe15@gmail.com', 'aad7eaf8d9211f3115c5a94b17a7f478', '8329475486', 'Shivajinagar,pune, Shivajinagar,pune', 'Shivajinaga'),
(4, 'mansi', 'Salunkhe', 'kanchanwaghkop@gmail.com', 'bbabcc4d7e9ffbdf941f09e3ede169e0', '8329475486', 'Shivajinagar,pune, Shivajinagar,pune', 'Shivajinaga'),
(6, '', 'Salunkhe', '', '6a13bdfc27460fe492d2ae7ba60448b6', '', '', ''),
(7, 'swati', 'Rupnwar', 'poojasalunkhe189@gmail.com', '6155fc03415fcf69eb7d1d3df90e4ec3', '1234567895', 'shivaji nagar', 'shivaji nag'),
(8, 'Yukta', 'Salunkhe', 'yuktasalunkhe15@gmail.com', 'c62b4fdb0786ce07a31526d408384587', '8329475486', 'Shivajinagar,pune,', 'Shivajinaga'),
(9, 'Neha', 'shelar', 'manesalunkhe189@gmail.com', '97eff39267741b6473576151b9480a75', '1234567887', 'shivaji', 'pune');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cust_products`
--
ALTER TABLE `cust_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_cat` (`product_cat`),
  ADD KEY `fk_product_brand` (`product_brand`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cust_products`
--
ALTER TABLE `cust_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `fk_product_cat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
