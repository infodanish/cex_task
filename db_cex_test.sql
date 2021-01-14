-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 11:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cex_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_users`
--

CREATE TABLE `tbl_admin_users` (
  `user_id` int(11) NOT NULL,
  `frecord_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=admin user',
  `user_name` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `zipcode` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mail_agree` tinyint(4) DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL,
  `trusted_user` tinyint(4) NOT NULL DEFAULT 0,
  `chorip` varchar(150) NOT NULL,
  `status` enum('Active','In-active') NOT NULL DEFAULT 'Active',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT current_timestamp(),
  `delete_row` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_users`
--

INSERT INTO `tbl_admin_users` (`user_id`, `frecord_id`, `user_type`, `user_name`, `email_id`, `password`, `first_name`, `last_name`, `phone`, `address`, `state`, `city`, `zipcode`, `dob`, `mail_agree`, `role_id`, `trusted_user`, `chorip`, `status`, `created_on`, `created_by`, `updated_by`, `updated_on`, `delete_row`) VALUES
(1, 0, 1, 'admin', 'infodanish@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Danish', 'Akhtar', '8149212749', 'dadar', 'maharastra', 'mumbai', NULL, NULL, 1, 1, 1, '', 'Active', '2017-06-05 00:00:00', 0, 1, '2020-02-04 06:15:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_session` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `product_image` text NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_session`, `user_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `quantity`, `total_amount`, `created_on`, `updated_on`) VALUES
(1, 'chheda-temp-cartM0J73G0HFC', 3, 5, 1, 'GTA', 'http://localhost/cex_task/images/product_images/6d279052c0834dddaa468579a98544b9.jpg', '500.00', 2, '1000.00', '2021-01-03 08:12:58', '2021-01-03 07:12:58'),
(2, 'chheda-temp-cartM0J73G0HFC', 3, 5, 2, 'PUBG', 'http://localhost/cex_task/images/product_images/f9fda6d1817ce6c881fe22f82d0f453e.jpg', '1000.00', 5, '5000.00', '2021-01-03 08:13:07', '2021-01-03 07:13:07'),
(4, 'chheda-temp-cartM0J73G0HFC', 3, 5, 1, 'GTA', 'http://localhost/cex_task/images/product_images/6d279052c0834dddaa468579a98544b9.jpg', '500.00', 1, '500.00', '2021-01-11 10:54:16', '2021-01-11 09:54:16'),
(5, 'chheda-temp-cartVYNOL3SKWH', 0, 0, 3, 'RAM', 'http://localhost/cex_task/images/product_images/3e8d11899de7ec437b6b16744f129bff.jpg', '1500.00', 1, '1500.00', '2021-01-14 11:04:24', '2021-01-14 10:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `link` varchar(500) NOT NULL,
  `status` enum('Active','In-active') NOT NULL DEFAULT 'Active',
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `category_image`, `link`, `status`, `meta_title`, `meta_description`, `meta_keywords`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'Games', '', 'games', 'Active', 'Games', 'Games', 'Games', '2021-01-02 17:15:03', 1, '2021-01-02 11:45:44', 1),
(2, 'Movies', '', 'movies', 'Active', 'Movies', 'Movies', 'Movies', '2021-01-02 17:15:58', 1, '2021-01-02 11:45:58', 1),
(3, 'Electronics', '', 'electronics', 'Active', 'Electronics', 'Electronics', 'Electronics', '2021-01-02 17:16:15', 1, '2021-01-02 11:46:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `netpayment` decimal(10,2) NOT NULL,
  `status` enum('Success','Aborted','Failure','Pending') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `user_id`, `invoice`, `name`, `mobile`, `email_id`, `address`, `pincode`, `city`, `state`, `netpayment`, `status`, `created_on`, `updated_on`) VALUES
(1, 3, 'Order1', 'Danish Akhtar', '8149212749', 'infodanish@gmail.com', 'Address', '400014', 'Mumbai', 'MH', '6000.00', 'Success', '2021-01-03 08:13:43', '2021-01-03 07:13:43'),
(5, 3, 'Order5', 'Danish Akhtar', '8149212749', 'infodanish@gmail.com', 'Address', '425001', 'J', 'M', '500.00', 'Success', '2021-01-11 10:55:10', '2021-01-11 09:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` text NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `status` enum('Active','In-active') NOT NULL DEFAULT 'Active',
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `category_id`, `product_name`, `product_description`, `product_image`, `product_price`, `status`, `created_on`, `updated_on`, `created_by`, `updated_by`) VALUES
(1, 1, 'GTA', '&lt;strong style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&amp;nbsp;&lt;/span&gt;', '6d279052c0834dddaa468579a98544b9.jpg', 500.00, 'Active', '2021-01-03 09:36:14', '2021-01-02 13:13:44', 1, 1),
(2, 1, 'PUBG', '&lt;strong style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&amp;nbsp;&lt;/span&gt;', 'f9fda6d1817ce6c881fe22f82d0f453e.jpg', 1000.00, 'Active', '2021-01-03 09:36:14', '2021-01-02 13:15:29', 1, 1),
(3, 3, 'RAM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '3e8d11899de7ec437b6b16744f129bff.jpg', 1500.00, 'Active', '2021-01-03 12:56:52', '2021-01-03 07:28:10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` bigint(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_no` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','In-active') NOT NULL DEFAULT 'Active',
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `full_name`, `email_id`, `password`, `phone_no`, `address`, `status`, `created_on`, `updated_on`) VALUES
(1, 'Aniket', 'aniket@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8888888888', 'Address', 'Active', '2021-01-03 07:48:59', '2021-01-03 06:48:59'),
(3, 'Danish Akhtar', 'infodanish@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8149212749', 'Address\n', 'Active', '2021-01-03 08:05:13', '2021-01-03 07:05:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
