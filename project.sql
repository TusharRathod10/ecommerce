-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 07:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `login_mail` varchar(100) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_price` varchar(100) NOT NULL,
  `pro_discount` int(11) NOT NULL,
  `pro_image` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categories` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categories`, `img`) VALUES
(1, 'Electronic', '1687169136.png'),
(2, 'Clothes', '1687169157.png'),
(3, 'Toy', '1687169165.png'),
(4, 'Beauty', '1687169180.png'),
(6, 'Fashion', '1687169224.png'),
(7, 'Book', '1687169260.png'),
(8, 'Sports', '1687169273.png'),
(9, 'Grocery', '1687169282.png'),
(10, 'Other', '1687169288.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `login_mail` varchar(200) NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `login_mail`, `create`) VALUES
(1, 'Jermaine Baker', 'pudeva@mailinator.com', 'Et et eveniet do no', 'Pariatur Consequatu', 'abc@gmail.com', '2023-06-21 09:35:10'),
(2, 'Florence Pickett', 'bibylyx@mailinator.com', 'Qui aut eum quia mag', 'Mollit nostrud incid', 'user@gmail.com', '2023-06-21 09:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `number` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `state` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `image` varchar(300) NOT NULL,
  `payment` varchar(200) NOT NULL,
  `total_product` varchar(300) NOT NULL,
  `total_price` varchar(200) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp(),
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `firstname`, `lastname`, `email`, `number`, `address`, `state`, `district`, `pincode`, `date`, `image`, `payment`, `total_product`, `total_price`, `order_status`, `create`, `update`) VALUES
(2, 8281526, 'user', 'Hinton', 'user@gmail.com', '9638527410', 'Excepteur rerum non ', 'Jharkhand', 'Ramgarh', '123245', '2023-06-23', '16298606.png,84371077.png', 'credit/debit', 'Sneakers For Men (1) , 2 Minute Meggie (1) ', '4518', 'Delivery Complete', '2023-06-23 09:21:09', '2023-06-23 09:38:45'),
(3, 8477833, 'user', 'Hinton', 'user@gmail.com', '9638527410', 'Aut tempore ducimus', 'Nagaland', 'Kohima', '321545', '2023-06-23', '16227176.png,39529368.png,13978459.png', 'cash-on-delivery', 'Lenovo Latitude (1) , MRF Cricket Kit  (1) , Red Bull (250ml) (4) ', '47457', 'Delivery Soon', '2023-06-23 09:27:22', '2023-06-23 09:31:20'),
(4, 4972297, 'abc', 'Sparks', 'abc@gmail.com', '8797564212', 'Aliquam eos sed vol', 'Maharashtra', 'Dhule', '124356', '2023-06-23', '17599010.jpg,84371077.png', 'credit/debit', 'My Glam Lipstick Combo (2) , 2 Minute Meggie (5) ', '2641', 'Delivery Soon', '2023-06-23 09:30:32', '2023-06-23 09:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `discount` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `subcategory` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp(),
  `update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `image`, `price`, `discount`, `category`, `subcategory`, `description`, `create`, `update`) VALUES
(1, 'Lenovo Latitude', '16227176.png', '45000', 12, 'Electronic', 'laptop', 'Find & buy the right laptop with AMD Ryzen Processors direct From Lenovo India. Free Shipping, Easy Returns & Financing Options On The Best Laptop Deals.', '2023-06-19 09:13:50', '2023-06-19 09:13:50'),
(2, '2 Minute Meggie', '84371077.png', '20', 5, 'Grocery', 'Meggie', 'Maggi® 2 Minute Masala Noodles are so simple to make and are ready in just two minutes.', '2023-06-19 09:15:28', '2023-06-21 06:16:30'),
(3, 'Bhagavad Gita', '93083009.png', '300', 5, 'Book', 'Bhagavad Gita', 'Lord Krishna is trying to say only two words in the Gita.', '2023-06-19 09:16:59', '2023-06-19 09:16:59'),
(4, 'Cloths Combo (NightDress)', '19113039.png', '2000', 11, 'Clothes', 'Combo', 'THE FUNDAMENTALS OF GREAT CASUAL OUTFITS', '2023-06-19 09:21:51', '2023-06-19 09:21:51'),
(5, 'New Latest Saari', '95798883.png', '1755', 7, 'Fashion', 'Saari', 'Huge collection of women sarees at low offer price & discounts at COD, Easy Returns & Exchanges.', '2023-06-19 09:28:41', '2023-06-19 09:28:41'),
(6, 'Toy ', '88216542.png', '1200', 6, 'Toy', 'Kid toy', 'Latest New Kids Toy', '2023-06-19 09:30:56', '2023-06-21 05:57:06'),
(7, 'Pink Lipstick', '88574541.png', '799', 10, 'Beauty', 'Lipstick', ' a cosmetic product used to apply coloration and texture to lips, often made of wax and oil.', '2023-06-19 09:32:02', '2023-06-19 09:32:02'),
(8, 'MRF Cricket Kit ', '39529368.png', '8900', 17, 'Sports', 'Cricket-Kit', 'Batting Pads\r\nThigh Pads\r\nAbdominal Guard\r\nChest Guard\r\nCricket Bat\r\nBatting Gloves\r\nElbow Guard\r\nHelmet\r\nA Kit Bag', '2023-06-19 09:33:55', '2023-06-19 09:33:55'),
(9, 'My Glam Lipstick Combo', '17599010.jpg', '1399', 9, 'Beauty', 'Lipstick', 'Limited Combo For You..', '2023-06-19 10:22:12', '2023-06-20 10:24:45'),
(10, 'New LCD TV', '94891606.png', '65000', 14, 'Electronic', 'Tv', 'LCD is an electronically modulated optical device which includes segments filled with liquid crystals.', '2023-06-19 11:55:32', '2023-06-19 11:55:32'),
(11, 'IPhone 6', '2333357.png', '35000', 8, 'Electronic', 'Mobile', 'Apple iPhone 6 ; Type, IPS LCD ; Size, 4.7 inches, 60.9 cm2 (~65.8% screen-to-body ratio) ; Resolution, 750 x 1334 pixels, 16:9 ratio (~326 ppi density).', '2023-06-19 11:57:01', '2023-06-19 12:10:05'),
(12, 'Hair Shaver Trimmer ', '90672074.png', '1199', 10, 'Electronic', 'Trimmer', 'A trimmer, or preset, is a miniature adjustable electrical component.\r\n', '2023-06-19 11:58:32', '2023-06-19 11:58:32'),
(13, 'Pink Teddy Bear', '51851851.png', '1999', 15, 'Toy', 'Teddy-bear', 'A teddy bear is a children toy, made from soft or furry material, which looks like a friendly bear.', '2023-06-19 12:04:32', '2023-06-19 12:04:32'),
(14, 'Bible', '75128336.png', '600', 8, 'Book', 'Bible', 'Buy Holy Bible: King James Version book online at best prices.', '2023-06-19 12:05:58', '2023-06-19 12:05:58'),
(15, 'Red Bull (250ml)', '13978459.png', '120', 2, 'Grocery', 'Energy Drink', 'Red Bull is a utility drink to be taken against mental or physical weariness or exhaustion.', '2023-06-19 12:07:18', '2023-06-19 12:07:18'),
(16, 'HP Laptop', '58382973.png', '37000', 7, 'Electronic', 'laptop', 'HP NoteBook is a Windows 10 laptop with a 15.60-inch display that has a resolution of 1366x768 pixels. It is powered by a Core i5 processor and it comes with 8GB of RAM. The HP NoteBook packs 256GB of', '2023-06-20 09:54:18', '2023-06-20 09:54:18'),
(17, 'Dell Laptop', '21216115.png', '23000', 11, 'Electronic', 'laptop', 'Processor-i5\r\nCondition-New\r\nBrand-Dell\r\nSize	-15 Inch\r\nEver since the evolution of our company, we have been counted as one of the favorite dealing name owing to which we have been capable of providi', '2023-06-20 10:08:48', '2023-06-20 10:08:48'),
(18, 'Samsung Galaxy S21 FE 5G ', '12745995.png', '60000', 7, 'Electronic', 'Mobile', 'Samsung Galaxy S21 FE 5G ; Type, Dynamic AMOLED 2X, 120Hz, HDR10+ ; Size, 6.4 inches, 100.5 cm2 (~86.7% screen-to-body ratio) ; Resolution, 1080 x 2340 pixels, ...\nDimensions: 155.7 x 74.5 x 7.9 mm.', '2023-06-20 10:14:21', '2023-06-20 12:44:09'),
(19, 'Shirt For Men', '99554473.png', '799', 4, 'Clothes', 'Shirt', 'a long- or short-sleeved garment for the upper part of the body, usually lightweight and having a collar and a front opening.', '2023-06-20 10:20:01', '2023-06-20 10:20:01'),
(20, 'Shirt Combo For Men', '92508960.png', '1799', 3, 'Clothes', 'Combo', 'Zombom Mens Combo Regular Fit Cotton Casual Shirts Pack of 3 · Helly-Hansen Mens Club Long Sleeve Shirt · FINIVO FASHION Mens Combo Regular Fit Cotton Shirt.', '2023-06-20 10:21:09', '2023-06-20 10:25:10'),
(21, 'Denim Jeans For Men', '93862679.png', '1599', 5, 'Clothes', 'Pent', 'denim, durable twill-woven fabric with coloured (usually blue) warp and white filling threads; it is also woven in coloured stripes. ', '2023-06-21 05:53:55', '2023-06-21 05:53:55'),
(22, 'Snail Toy For Baby', '61234927.png', '999', 10, 'Toy', 'Kid toy', 'The snail toy is equipped with colorful LED lights inside, when it is opened, it will emit colored lights.', '2023-06-21 05:58:28', '2023-06-21 05:58:28'),
(23, 'Brown pressed powder with makeup brush', '39769193.png', '899', 8, 'Beauty', 'Powder', 'Cosmetics Face powder Make-up artist, Makeup powder, face, cosmetology product.', '2023-06-21 05:59:51', '2023-06-21 05:59:51'),
(24, 'Red Wedding dress', '12990939.png', '1799', 11, 'Fashion', 'Dress', 'A wedding dress or bridal gown is the dress worn by the bride during a wedding ceremony. ', '2023-06-21 06:01:41', '2023-06-21 06:01:41'),
(25, 'Sneakers For Men', '16298606.png', '4999', 10, 'Fashion', 'Shoes', ' an outer covering for your foot that usually has a stiff bottom part called a sole with a thicker part called a heel attached to it and an upper part that covers part or all of the top of your foot.', '2023-06-21 06:02:46', '2023-06-21 06:02:46'),
(26, 'CEAT Cricket Bat', '61964519.png', '3899', 7, 'Sports', 'Bat', 'CEAT exclusive collection is designed with superior quality willow, perfect for ardent cricket players', '2023-06-21 06:10:33', '2023-06-21 06:10:33'),
(27, 'Red Cricket Ball', '40431116.png', '499', 6, 'Sports', 'Ball', 'A cricket ball is a hard, solid ball used to play cricket. In men cricket the ball must weigh between 5.5 and 5.75 ounces (137.5 and 143.8 g)', '2023-06-21 06:11:42', '2023-06-21 06:11:42'),
(28, 'Office Chair', '8269758.png', '6999', 12, 'Other', 'Other', 'Our Celinichair provides an excellent fit and support for working all day. Stylish and comfortable ergonomic task chair.', '2023-06-21 06:12:57', '2023-06-21 06:12:57'),
(29, 'Smart Watch', '78357486.png', '2599', 13, 'Fashion', 'Watch', 'Duas Collection T-500 Smart Watch Sleep Monitor, Distance Tracker, Calendaring, Sedentary Reminder, Text Messaging, Pedometer, Calorie Tracker, Heart Rate Monitor Smartwatch (Black) Pack of 1', '2023-06-21 06:34:37', '2023-06-21 06:34:37'),
(30, 'Red Fashion Handbag ', '1258754.png', '1199', 10, 'Fashion', 'Female Purse', 'It comes with dual flat shoulder straps. comfortable to put shoulder. Selected 100% genuine leather material, soft and skin-friendly.', '2023-06-21 06:39:02', '2023-06-21 06:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `phone_no`, `password`, `role`, `create_at`, `update_at`) VALUES
(1, 'admin', 'admin@gmail.com', '9876543210', '12345678', 'admin', '2023-06-16 07:31:59', '2023-06-16 07:32:09'),
(2, 'user', 'user@gmail.com', '9638527410', '11111111', 'user', '2023-06-16 07:32:42', '2023-06-16 07:32:42'),
(3, 'abc', 'abc@gmail.com', '8797564212', '123123123', 'user', '2023-06-21 09:20:00', '2023-06-21 09:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `login_mail` varchar(200) NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `message`, `rating`, `login_mail`, `create`) VALUES
(1, 'Denise Ruiz', 'ticuwup@mailinator.com', 'Excepteur laborum A', 2, 'user@gmail.com', '2023-06-21 10:04:42'),
(2, 'Yardley Marshall', 'siqof@mailinator.com', 'Molestiae enim sapie', 3, 'user@gmail.com', '2023-06-21 10:04:48'),
(3, 'Isadora Mccarty', 'wycudiv@mailinator.com', 'Nihil facere a sed a fghdf dfgdghb fghszdws', 1, 'user@gmail.com', '2023-06-21 10:05:03'),
(4, 'Judith Hodges', 'xutarirati@mailinator.com', ' eos dolores sit no ut diam consetetur duo justo est', 4, 'user@gmail.com', '2023-06-21 10:05:20'),
(8, 'Ciara Ferguson', 'bove@mailinator.com', 'Harum accusamus debi', 3, 'user@gmail.com', '2023-06-21 10:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `sub_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`sub_id`, `title`, `cat_id`) VALUES
(1, 'laptop', 1),
(3, 'Dress', 6),
(4, 'Tv', 1),
(5, 'Mobile', 1),
(6, 'Pent', 6),
(7, 'Lipstick', 4),
(9, 'Shoes', 6),
(10, 'Teddy-bear', 3),
(11, 'Bhagavad Gita', 7),
(12, 'Shirt', 2),
(13, 'Trimmer', 1),
(14, 'Mouse', 1),
(15, 'Keyboard', 1),
(16, 'Powder', 4),
(17, 'Bat', 8),
(18, 'Ball', 8),
(19, 'Cricket-Kit', 8),
(20, 'Energy Drink', 9),
(21, 'Meggie', 9),
(22, 'Bible', 7),
(23, 'The Great Indian Novel', 7),
(24, 'Other', 10),
(25, 'Combo', 2),
(26, 'Saari', 6),
(27, 'Kid toy', 3),
(28, 'Watch', 6),
(29, 'Female Purse', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
