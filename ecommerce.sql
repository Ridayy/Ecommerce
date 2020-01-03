-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2020 at 07:38 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'ridaarif20@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_class` varchar(255) NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_class`, `uploaded_at`) VALUES
(1, 'Health & beauty', 'health_and_beauty', '2019-12-30 11:05:21'),
(2, 'Watches, Bag & Jewellery', 'watches_bag_jewellery', '2019-12-30 11:05:21'),
(3, 'Women\'s fashion', 'women_fashion', '2019-12-30 11:51:20'),
(4, 'Men\'s fashion', 'men_fashion', '2019-12-30 11:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `product_summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_summary`)),
  `amount` float NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `city`, `state`, `phone`, `address`, `product_summary`, `amount`, `status`) VALUES
(9, 1, 'Hyderabad', 'Sindh', '03233046737', 'Memon Society', '{\"2\":1}', 780, 'confirmed'),
(10, 1, 'Hyderabad', 'Sindh', '03233046737', 'Memon Society', '{\"1\":1}', 900, 'confirmed'),
(11, 1, 'Hyderabad', 'Sindh', '03233046737', 'Memon Society, Near Wahdat Colony', '{\"3\":1}', 504, 'confirmed'),
(12, 1, 'Hyderabad', 'Sindh', '03233046737', 'Memon Society', '{\"2\":1}', 780, 'confirmed'),
(13, 1, 'Hyderabad', 'Sindh', '03233046737', 'Abc', '{\"1\":1}', 900, 'confirmed'),
(14, 1, 'Hyderabad', 'Sindh', '03233046737', 'Abc', '{\"3\":1}', 504, 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_image` text NOT NULL,
  `brand` varchar(50) NOT NULL,
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_description`, `product_cat`, `product_price`, `product_image`, `brand`, `discount`, `quantity`, `created_at`) VALUES
(1, 'Double Button Cardigan', 3, 900, 'assets/img/products/dress.jpg', 'Khaadi', 0, 2, '2019-12-30 12:04:03'),
(2, 'Makeup Mystery Box', 1, 780, 'assets/img/products/makeup.jpg', 'Rivaj', 0, 2, '2019-12-30 12:04:03'),
(3, 'STUNNING BLACK & SILKY', 1, 560, 'assets/img/products/shampoo.jpg', 'Sunsilk', 10, 2, '2019-12-30 12:06:23'),
(4, 'Doll Evening Dress', 3, 2789, 'assets/img/products/dress2.jpg', 'Black', 20, 1, '2019-12-30 12:29:14'),
(5, 'Check Shirt', 4, 1399, 'assets/img/products/shirt1.jpg', 'Black & Blue', 30, 2, '2019-12-30 12:29:14'),
(6, 'Cut Price Casual Shirt', 4, 1000, 'assets/img/products/shirt2.jpg', 'Outfitters', 10, 3, '2019-12-30 12:29:14'),
(7, 'Business Bag', 2, 7000, 'assets/img/products/bag1.jpg', 'Outfitters', 10, 2, '2019-12-30 12:33:06'),
(8, 'Golden Stainless Alphabet Locket ', 2, 900, 'assets/img/products/chain.jpg', 'teens', 10, 2, '2019-12-30 12:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Rida', 'ridaarif20@gmail.com', 'e1bdf3e39b509f41e818c7436fc8798e', '2019-12-30 09:48:24'),
(2, 'Muskan', 'muskan@gmail.com', 'e1bdf3e39b509f41e818c7436fc8798e', '2020-01-02 19:21:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
