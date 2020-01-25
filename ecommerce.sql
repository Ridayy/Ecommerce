-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2020 at 04:08 PM
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
(3, 'Women\'s fashion', 'womens_fashion', '2019-12-30 11:51:20'),
(4, 'Men\'s fashionss', 'mens_fashionss', '2020-01-05 14:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `answer` text NOT NULL,
  `posted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `answer`, `posted_at`) VALUES
(1, 'What are my shipping options?', 'Cash on delivery only', '2020-01-11 09:54:30'),
(2, 'When will my order ship?', 'Lorem ipsum dolor sit amet.', '2020-01-11 09:54:30'),
(3, 'How do I track my order?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '2020-01-11 09:54:30'),
(4, 'What is your exchange and return policy?', 'Lorem ipsum dolor ', '2020-01-11 09:54:30'),
(8, 'How do I cancel or change my order?', 'Email us as soon as possible. We\'ll see what we can do', '2020-01-11 11:43:57');

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
  `status` varchar(11) NOT NULL,
  `ordered_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `city`, `state`, `phone`, `address`, `product_summary`, `amount`, `status`, `ordered_at`) VALUES
(10, 1, 'Hyderabad', 'Sindh', '03233046737', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias eaque quas optio tempora repellat ea illum, perspiciatis incidunt possimus.', '{\"1\":1}', 900, 'pending', '2019-12-30 11:05:21'),
(13, 1, 'Hyderabad', 'Sindh', '03233046737', 'Quo molestias eaque quas optio tempora repellat ea illum, perspiciatis incidunt possimus.', '{\"1\":1}', 900, 'completed', '2020-01-05 19:51:14'),
(16, 1, 'Hyderabad', 'Sindh', '03233046737', 'Street 2, Memon Society', '{\"7\":1}', 6300, 'confirmed', '2020-01-05 23:37:58'),
(17, 1, 'Hyderabad', 'Sindh', '03233046737', 'Lorem ipsum dolor sit amet consectetur adipis', '{\"9\":1,\"4\":1}', 2995.6, 'confirmed', '2020-01-05 23:39:39'),
(18, 1, 'Hyderabad', 'Sindh', '03233046737', 'eaque quas optio tempora repellat ea illum, perspiciatis incidunt possimus.', '{\"3\":1,\"4\":3}', 7197.6, 'confirmed', '2020-01-06 08:30:38');

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
  `product_desc_detailed` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_description`, `product_cat`, `product_price`, `product_image`, `brand`, `discount`, `quantity`, `product_desc_detailed`, `created_at`) VALUES
(3, 'STUNNING BLACK & SILKY', 1, 560, 'assets/img/products/shampoo.jpg', 'Sunsilk', 10, 2, 'Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular', '2019-12-30 12:06:23'),
(4, 'Doll Evening Dress', 3, 2789, 'assets/img/products/dress2.jpg', 'Black', 20, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud', '2019-12-30 12:29:14'),
(5, 'Check Shirt', 4, 1399, 'assets/img/products/shirt1.jpg', 'Black & Blue', 30, 2, 'Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules', '2019-12-30 12:29:14'),
(6, 'Cut Price Casual Shirt', 4, 1000, 'assets/img/products/shirt2.jpg', 'Outfitters', 10, 3, ' Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores', '2019-12-30 12:29:14'),
(7, 'Business Bag', 2, 7000, 'assets/img/products/bag1.jpg', 'Outfitters', 10, 2, 'At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', '2019-12-30 12:33:06'),
(8, 'Golden Stainless Alphabet Locket ', 2, 900, 'assets/img/products/chain.jpg', 'teens', 10, 2, 'Meta komentofrazo ci cis, negativa antaŭmetado la oni, havi frida aga ac. Jeso senforte iam ci', '2020-01-11 09:54:30'),
(9, 'Double Button Cardigan', 3, 780, 'assets/img/products/5e10de77993be5e104b625677cimg2.jpg', 'Khaadi', 2, 4, 'One of the best products available with over 5000 customers', '2020-01-04 20:37:10'),
(13, 'Makeup Mystery Box', 1, 890, 'assets/img/products/5e10de51747a0makeup.jpg', 'Rivaj', 8, 6, 'abc', '2020-01-11 11:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_posted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_text`, `rating`, `user_id`, `product_id`, `review_posted_at`) VALUES
(5, 'Best Product', 4, 1, 9, '2020-01-24 19:29:13'),
(15, 'Best Experience', 5, 2, 9, '2020-01-24 23:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_pic` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `num_orders` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_pic`, `password`, `num_orders`, `created_at`) VALUES
(1, 'Rida Arif', 'ridaarif20@gmail.com', 'assets/img/profile_pics/12ba8934ead97e9303071564f336f0c95n.jpeg', 'e1bdf3e39b509f41e818c7436fc8798e', 6, '2019-12-30 09:48:24'),
(2, 'Muskan', 'muskan@gmail.com', 'assets/img/profile_pic/defaults/image_3.png', 'e1bdf3e39b509f41e818c7436fc8798e', 0, '2020-01-02 19:21:49');

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
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
