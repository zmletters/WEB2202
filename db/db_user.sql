-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 02:57 PM
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
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(6) NOT NULL,
  `status` enum('active','checked_out','','') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `status`) VALUES
(59, 11, 2, 2, 'checked_out'),
(60, 11, 3, 2, 'checked_out'),
(61, 11, 4, 2, 'checked_out'),
(62, 11, 5, 5, 'checked_out'),
(63, 11, 2, 1, 'active'),
(64, 11, 4, 1, 'active'),
(65, 14, 1, 11, 'checked_out'),
(66, 14, 2, 1, 'checked_out'),
(67, 14, 3, 1, 'checked_out'),
(69, 14, 6, 7, 'checked_out');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `description`) VALUES
(1, 'Lewis', 'lewis@gmail.com', 'Hi i would like to visit your location!'),
(2, 'Liew Jia Cheng', 'asdfasfasdfasd@mail.com', 'hch'),
(3, 'asdfasdf', 'asdf@sadf.com', 'sadf'),
(4, 'asdf', 'asdf@asdf.com', 'asdf'),
(5, 'asdf', 'asdf@asdf.com', 'adsf'),
(6, 'asdfas', 'asdf@asdf.com', 'asdf'),
(7, 'asdf', 'asdfa@asdf.com', 'asdf'),
(8, 'annoymous 1', 'and@mail.com', 'hi i need help'),
(9, 'annoy 2', 'and@gmail.com', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `message`, `created_at`, `is_read`) VALUES
(13, 11, 'Hey! The status of your order for Order ID: 5 is now shipped!', '2024-12-16 13:01:24', 1),
(15, 14, 'Hey! The status of your order for Order ID: 7 is now shipped!', '2024-12-16 21:30:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `shipping_address` varchar(255) NOT NULL,
  `status` enum('pending','completed','shipped','canceled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_date`, `shipping_address`, `status`) VALUES
(5, 11, 131.04, '2024-12-16 13:01:14', 'dylan', 'shipped'),
(7, 14, 235.88, '2024-12-16 21:18:59', '89, Jalan PJS8, Bandar SUnway, 47500 Selangor', 'shipped');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `unit`, `description`, `image_url`) VALUES
(1, 'Chives', 8.00, 'kg', 'Chives is widely grown in the tropical and subtropical countries in  Asia. Plant height is about 35cm and the edible leaves are about 30 x 0.5 cm in size. It has unique and strong aroma and its eating quality is good.', 'img/products/Chives.jpeg'),
(2, 'Yam', 16.02, 'kg', 'Yam is the common name for some plant species in the genus Dioscorea that form edible tubers. Yams are perennial herbaceous vines native to Africa, Asia, and the Americas and cultivated for the consumption of their starchy tubers in many temperate and tropical regions.', 'img/products/Yam.jpg'),
(3, 'Arugula', 20.00, 'kg', 'Rocket, eruca, or arugula is an edible annual plant in the family Brassicaceae used as a leaf vegetable for its fresh, tart, bitter, and peppery flavor. Its other common names include garden rocket, as well as colewort, roquette, ruchetta, rucola, rucoli, and rugula.', 'img/products/Arugula.jpg'),
(4, 'Courgette', 4.00, 'kg', 'Courgette is a summer squash that is also known as zucchini, marrow, or baby marrow. Courgettes can be green, yellow, or orange, and can grow up to 3 feet long. However, they are usually harvested when they are 6–10 inches long and their seeds and rind are still soft.', 'img/products/Courgette.jpg'),
(5, 'Endive', 10.20, 'kg', 'Endive is a leaf vegetable belonging to the genus Cichorium, which includes several similar bitter-leafed vegetables. Species include Cichorium endivia, Cichorium pumilum, and Cichorium intybus. Chicory includes types such as radicchio, puntarelle, and Belgian endive.\r\n', 'img/products/Endive.jpg'),
(6, 'Habanero', 15.98, 'kg', 'The habanero is a pungent cultivar of Capsicum chinense chili pepper. Unripe habaneros are green, and they color as they mature. The most common color variants are orange and red, but the fruit may also be white, brown, yellow, green, or purple. Typically, a ripe habanero is 2–6 centimetres long.', 'img/products/Habanero.jpg'),
(7, 'Kohlrabi', 31.25, 'kg', 'Kohlrabi, also called German turnip or turnip cabbage, is a biennial vegetable, a low, stout cultivar of wild cabbage. It is a cultivar of the same species as cabbage, broccoli, cauliflower, kale, Brussels sprouts, collard greens, Savoy cabbage, and gai lan. It can be eaten raw or cooked.', 'img/products/Kohlrabi.jpg'),
(8, 'Brussels sprout', 57.50, 'kg', 'The Brussels sprout is a member of the Gemmifera cultivar group of cabbages (Brassica oleracea), grown for its edible buds.', 'img/products/Brussels_sprout.jpg'),
(9, 'Water Spinach', 7.25, 'kg', 'Ipomoea aquatica, widely known as water spinach, is a semi-aquatic, tropical plant grown as a vegetable for its tender shoots. I. aquatica is generally believed to have been first domesticated in Southeast Asia. It is widely cultivated in Southeast Asia, East Asia, and South Asia.', 'img/products/Water_Spinach.jpg'),
(10, 'Corn', 8.99, 'kg', 'Maize, also known as corn in North American English, is a tall stout grass that produces cereal grain. It was domesticated by indigenous peoples in southern Mexico about 9,000 years ago from wild teosinte. Native Americans planted it alongside beans and squashes in the Three Sisters polyculture.', 'img/products/Corn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `reg_date` datetime NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `address` text NOT NULL,
  `phone_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `reg_date`, `role`, `address`, `phone_no`) VALUES
(11, 'admin', 'admin', 'admin@admin.com', '381211fee33898df3e960bc3d4c7c7c787599d7c', '2024-12-16 06:25:10', 'admin', '', ''),
(14, 'Zeng', 'Ong', 'zeming@mail.com', '233b70eeb460285af5ff01b22641025f68ab8366', '2024-12-16 20:59:24', 'customer', '', '012-4513211');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
