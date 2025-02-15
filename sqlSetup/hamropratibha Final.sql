-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 05:44 PM
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
-- Database: `hamropratibha`
--

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

CREATE TABLE `boxes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `name`, `description`, `image_url`, `price`) VALUES
(1, 'Small Box ', 'small in size ', '../assets/images/67ae22969f756.jpg', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `package_id` decimal(5,0) DEFAULT NULL,
  `boxes_id` decimal(5,0) DEFAULT NULL,
  `package_quantity` decimal(2,0) DEFAULT NULL,
  `boxes_quantity` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `product_quantity`, `added_at`, `package_id`, `boxes_id`, `package_quantity`, `boxes_quantity`) VALUES
(40, 1, 31, 3, '2025-02-15 16:26:35', NULL, NULL, NULL, NULL),
(41, 1, 12, 2, '2025-02-15 16:31:26', NULL, NULL, NULL, NULL),
(42, 7, NULL, NULL, '2025-02-15 16:39:51', 3, NULL, 2, NULL),
(43, 7, NULL, NULL, '2025-02-15 16:39:59', NULL, 1, NULL, 4),
(44, 7, 12, 2, '2025-02-15 16:40:10', NULL, NULL, NULL, NULL),
(46, 7, 15, 3, '2025-02-15 16:40:18', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `price`, `order_date`) VALUES
(1, 1, 6, 1, 50.00, '2025-02-12 17:53:09'),
(2, 1, 6, 5, 50.00, '2025-02-12 17:56:25'),
(3, 1, 6, 5, 50.00, '2025-02-12 17:57:29'),
(4, 1, 3, 2, 3250.00, '2025-02-12 17:58:05'),
(5, 1, 6, 1, 50.00, '2025-02-12 17:58:05'),
(6, 1, 3, 3, 3250.00, '2025-02-13 05:20:22'),
(7, 1, 6, 9, 50.00, '2025-02-13 15:18:27'),
(8, 1, 6, 4, 50.00, '2025-02-13 17:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `price`, `image_url`, `description`, `created_at`) VALUES
(3, 'First Package ', 5000.00, '../assets/images/67ae239be0799.jpg', 'very good ', '2025-02-13 16:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Prayer Flag', 'Prayer Flag', 50.00, '../assets\\images\\Prayerflag.png', '2025-02-11 15:55:39', '2025-02-11 17:25:17'),
(3, 'Ganesh Ji Statue', 'Very Good', 3250.00, '../assets/images/67ab769a05e6b0.45516654.jpg', '2025-02-11 16:11:06', '2025-02-11 16:28:17'),
(6, 'Buddhist Incense', 'nice smell', 50.00, '../assets/images/67ab77c79fe165.42922699.jpg', '2025-02-11 16:16:07', '2025-02-11 16:16:07'),
(7, 'key chain', 'very nice product', 1000.00, '../assets/images/67ad81aaac5105.51744142.jpg', '2025-02-13 05:22:50', '2025-02-13 05:22:50'),
(9, 'Lokta Paper Journal', 'Handmade paper products made from the bark of the lokta plant, known for durability and eco-friendliness.', 500.00, '../assets/images/67b0449684e2a1.61505534.png', '2025-02-15 07:39:02', '2025-02-15 07:39:02'),
(10, 'Supreme Buddhas of wisdom statue', 'Intricately carved Buddhist in copper with electro gold plating.', 1100.00, '../assets/images/67b044c411deb8.74816471.jpeg', '2025-02-15 07:39:48', '2025-02-15 07:39:48'),
(11, 'Ceramic Tea Pot', 'Traditional ceramic tea pot made in nepal, perfect for home decor.', 2200.00, '../assets/images/67b044df07fcc1.09123959.jpg', '2025-02-15 07:40:15', '2025-02-15 07:40:15'),
(12, 'Beaded Brass Bracelet', 'Hand-strung bracelets with ethnic patterns and symbolic charms.', 195.00, '../assets/images/67b044fc72b5f7.11571142.jpg', '2025-02-15 07:40:44', '2025-02-15 07:40:44'),
(13, 'Nepali Wooden earrings', 'Sustainable, handmade earrings crafted from bamboo, easy to wear and can be worn at any occasion.', 70.00, '../assets/images/67b0451b826945.61110603.png', '2025-02-15 07:41:15', '2025-02-15 07:41:15'),
(14, 'Dhaka Purse', 'Wallet made from handwoven Dhaka fabric with unique Nepali designs.', 2800.00, '../assets/images/67b04533015c40.86736564.png', '2025-02-15 07:41:39', '2025-02-15 07:41:39'),
(15, 'Pashmina Shawl', 'Soft, high-quality shawl made from fine Pashmina wool.', 3000.00, '../assets/images/67b045966e37d8.61552681.png', '2025-02-15 07:43:18', '2025-02-15 07:43:18'),
(16, 'Handmade Pure Copper Bracelet', 'Hammered and intricately cut with a wire saw. Handmade from start to finish. They are adjustable and have been designed to fit most adult wrist sizes. This bracelet has a base metal of pure copper, which you can see on the inside which will be the part touching your skin. The outside is plated from white metal alloy. No part is machine made!', 1500.00, '../assets/images/67b045b05c5731.24384496.png', '2025-02-15 07:43:44', '2025-02-15 07:43:44'),
(17, 'Hand Rolled Incense', 'It is made from highly scented herbal medicinal ingredients from the Solukhumbu (Everest Region) of the Himalayas. This incense has no chemicals and is non-toxic. Suitable for meditation, yoga studios and whomever enjoys refreshing the smell of their space!\r\nRhododendron Forest Ingredients: Juniper, Rhododendron, Himalayan Cedar, Kaulo\r\n\r\nLotus Blossom: Juniper, Cedarwood, Sandalwood, Agura, Basil, Kaulo\r\n\r\nMedicine Buddha: White Sandalwood, Cardamom, Cloves, Asura, Sal Doop, Yellow Jasmine, Agura, Safflower, Long Pepper, Spikenard, Khempa, Nutmeg, Sweet Flag.', 600.00, '../assets/images/67b045cda3c4d9.95584859.png', '2025-02-15 07:44:13', '2025-02-15 07:44:13'),
(18, 'Hemp Oil Soap', 'Handmade the traditional cold pressed way by Heaven Hemp in Nepal and cured for 60 days. Using only pure, natural, high grade ingredients with a selection of essential oils.\r\n\r\nEach bar weighs 95 grams.\r\n\r\nSo why choose Hemp oil? It\'s really gentle on your skin, great for those with sensitive skin. It\'s an antioxidant and rich in vitamins A, C and E. It promotes healthy toned skin and helps prevent acne and dry skin.\r\n\r\nLavender Hemp Soap: Made with the best British lavender essential oil. The soothing scent of lavender will bring a smile to your face it is also believed to help with various skin disorders such as acne and eczema.', 500.00, '../assets/images/67b045eb6463f3.46598280.png', '2025-02-15 07:44:43', '2025-02-15 07:44:43'),
(19, 'Bamboo toothbrush', 'A bamboo toothbrush provides a natural and gentle way to brush your teeth on a a daily basis.  Soft nylon bristles provide a natural and deep clean into those hard to reach places. \r\nSafely sourced and eco-friendly bamboo which is sustainable and environmentally friendly compared to plastic toothbrushes.  Bamboo is biodegradable and naturally anti-microbial.\r\n\r\nDepending on your use, on average we recommend using and replacing every 30 days.  The lifespan of a bamboo toothbrush can vary depending on how often it is used and how well it is taken care of.', 120.00, '../assets/images/67b0460078f167.59719012.png', '2025-02-15 07:45:04', '2025-02-15 07:45:04'),
(20, 'Bamboo cutlery set', 'Eco-friendly and sustainable, this Bamboo Cutlery Set is the perfect alternative to plastic utensils. Handcrafted from 100% natural bamboo, it includes a fork, spoon, knife, chopsticks, and a reusable straw with a cleaning brush. The smooth, lightweight design ensures a comfortable dining experience while being durable enough for daily use. Ideal for home, travel, office lunches, or outdoor adventures, this set is biodegradable, non-toxic, and free from harmful chemicals. Packaged in a stylish, washable fabric pouch, it\'s easy to carry and store.\r\n\r\nFeatures:\r\n✔ Made from 100% organic bamboo\r\n✔ Lightweight, durable, and travel-friendly\r\n✔ BPA-free, non-toxic, and biodegradable\r\n✔ Includes a fabric pouch for portability\r\n✔ Easy to clean and reusable', 800.00, '../assets/images/67b04616d20322.78052525.png', '2025-02-15 07:45:26', '2025-02-15 07:45:26'),
(21, 'Pustakari Nepali Sweet', 'Pustakari is a beloved traditional Nepali sweet made from a delightful blend of molasses (chaku), ghee, milk solids, and nuts. This chewy, caramel-like treat has a rich, deep sweetness with a slightly nutty flavor, making it a favorite snack for all ages. Often enjoyed during winter for its warmth and energy-boosting properties, Pustakari is also a popular offering during festivals and special occasions.\r\nHandcrafted using age-old techniques, this sweet is free from artificial preservatives and embodies the rich heritage of Nepali confectionery. Whether paired with tea, gifted to loved ones, or savored as a nostalgic treat, Pustakari offers a taste of Nepal’s cultural essence in every bite.\r\nFeatures:\r\n✔ Made from natural ingredients – chaku, ghee, and nuts\r\n✔ Rich caramel-like flavor with a chewy texture\r\n✔ No artificial preservatives or additives\r\n✔ Traditionally handcrafted in Nepal\r\n✔ Perfect as a snack, festival treat, or gift', 125.00, '../assets/images/67b04645591ac7.22198685.png', '2025-02-15 07:46:13', '2025-02-15 07:46:13'),
(22, 'Yeju Chocolate Bar', 'A heavenly fusion of coffee and milk chocolate for the connoisseurs.\r\nOur chocolate bars are a testament to quality and flavor, making them ideal for corporate gifting, client appreciation, or employee recognition.\r\nWe ensure every bar embodies excellence and is crafted with precision\r\nBest for gift for you love one\r\nBar gram: 80gm\r\nBreath size : 5.5 mm\r\nLength size: 142 mm', 300.00, '../assets/images/67b0465de25309.76655245.png', '2025-02-15 07:46:37', '2025-02-15 07:46:37'),
(23, 'Bamboo Plate', 'Enhance your dining experience with our eco-friendly Bamboo Plate, crafted from 100% natural and sustainable bamboo. Lightweight yet durable, this plate is a perfect alternative to plastic and ceramic dinnerware. The smooth, polished surface and minimalist design make it ideal for serving a variety of foods, from daily meals to special occasions.\r\nBamboo is naturally antibacterial, biodegradable, and free from harmful chemicals, ensuring a safe and toxin-free dining experience. Whether you\'re hosting a gathering, enjoying an outdoor picnic, or looking for a stylish addition to your kitchen, this plate is a sustainable choice that complements any setting.\r\nFeatures:\r\n✔ Made from 100% natural bamboo – biodegradable and eco-friendly\r\n✔ Durable and lightweight – perfect for everyday use or special events\r\n✔ Non-toxic & antibacterial – free from plastic and harmful chemicals\r\n✔ Versatile design – suitable for serving snacks, meals, and desserts\r\n✔ Easy to clean – handwash recommended for long-lasting use', 800.00, '../assets/images/67b0468213a002.21550105.jpg', '2025-02-15 07:47:14', '2025-02-15 07:47:14'),
(24, 'Organic Green Tea', 'Enjoy the refreshing taste and health benefits of Organic Green Tea, sourced from the lush, high-altitude tea gardens of Nepal. Each tea bag is filled with pure, handpicked tea leaves, free from additives or artificial flavors, ensuring a smooth, earthy taste with delicate floral and grassy notes.\r\n\r\nRich in antioxidants and natural catechins, this green tea helps boost immunity, metabolism, and overall well-being. Its mild caffeine content provides a gentle energy lift without the jitters, making it a perfect choice for a morning refresh or a calming evening ritual.\r\n\r\nFeatures:\r\n✔ 100% organic & natural – free from chemicals and additives\r\n✔ Rich in antioxidants – supports immunity and detoxification\r\n✔ Smooth & refreshing flavor – with delicate floral and grassy notes\r\n✔ Convenient & mess-free – comes in 50 individually wrapped tea bags\r\n✔ Sourced from Nepal – grown in high-altitude organic tea gardens\r\n\r\nBrewing Instructions:\r\n\r\nSteep 1 tea bag in hot water (80-85°C) for 2-3 minutes.\r\nEnjoy plain or with honey and lemon for added taste.', 950.00, '../assets/images/67b046c191f311.60972958.png', '2025-02-15 07:48:17', '2025-02-15 07:48:17'),
(25, 'Ceramic Cups', 'Experience the artistry of Nepal with these handmade ceramic cups, crafted by skilled artisans using traditional pottery techniques. Each cup is individually molded and hand-glazed, making every piece unique with its own natural texture and slight variations in color and design.\r\nMade from high-quality clay, these cups are durable, heat-resistant, and lead-free, ensuring a safe and enjoyable drinking experience. Perfect for tea, coffee, or herbal drinks, they add a touch of authenticity and warmth to your everyday rituals.\r\nFeatures:\r\n✔ Handcrafted in Nepal – made by local artisans using traditional methods\r\n✔ Eco-friendly & lead-free – safe for daily use\r\n✔ Unique textures & designs – no two cups are exactly the same\r\n✔ Durable & heat-resistant – suitable for hot and cold beverages\r\n✔ Elegant & timeless – perfect for home, office, or as a thoughtful gift', 800.00, '../assets/images/67b046d88b5956.90923146.png', '2025-02-15 07:48:40', '2025-02-15 07:48:40'),
(26, 'Bamboo Hair Brush', 'Upgrade your hair care routine with this eco-friendly Bamboo Hair Brush, designed for smooth and gentle detangling. Made from 100% natural bamboo, this brush features anti-static, rounded bristles that glide effortlessly through your hair, reducing breakage and promoting healthy scalp circulation.\r\nThe ergonomic bamboo handle provides a comfortable grip, while the durable bristles help distribute natural oils evenly, leaving your hair shiny, soft, and frizz-free. Suitable for all hair types, including curly, straight, thick, and fine hair, this sustainable alternative to plastic brushes is perfect for daily use.\r\nFeatures:\r\n✔ Eco-friendly & sustainable – made from biodegradable bamboo\r\n✔ Gentle on hair & scalp – reduces breakage and promotes healthy hair growth\r\n✔ Anti-static & frizz-reducing – helps maintain smooth and shiny hair\r\n✔ Ergonomic & durable – comfortable grip for easy styling\r\n✔ Suitable for all hair types – perfect for men, women, and children', 350.00, '../assets/images/67b046fde53921.52059990.png', '2025-02-15 07:49:17', '2025-02-15 07:49:17'),
(27, 'Bamboo bottles', 'Stay hydrated in style with this eco-friendly Bamboo Bottle, crafted from 100% natural bamboo with a stainless steel interior for durability and insulation. Designed to keep your drinks hot or cold for hours, this bottle is perfect for daily use, whether you\'re at work, traveling, or enjoying the outdoors.\r\nThe lightweight yet sturdy design makes it easy to carry, while the leak-proof lid ensures spill-free convenience. With a sleek and minimalist aesthetic, this bamboo bottle is not only functional but also a sustainable alternative to plastic bottles, reducing waste and promoting an eco-conscious lifestyle.\r\nFeatures:\r\n✔ Made from natural bamboo – biodegradable and sustainable\r\n✔ Double-wall insulation – keeps beverages hot or cold for up to 12 hours\r\n✔ Leak-proof & durable – stainless steel interior for long-lasting use\r\n✔ Lightweight & portable – perfect for travel, work, and daily hydration\r\n✔ Eco-friendly alternative – reduce plastic waste and embrace sustainability', 600.00, '../assets/images/67b047124a86f5.95684755.png', '2025-02-15 07:49:38', '2025-02-15 07:49:38'),
(28, 'Scented Candles', 'Description- Add a touch of tranquility to your space with Scented Candles made in Nepal, crafted from 100% natural beeswax and pure essential oils. Hand-poured by skilled artisans, these candles offer soothing fragrances like sandalwood, jasmine, and rose, creating a calming ambiance. Eco-friendly and sustainable, they burn cleanly and are packaged in recyclable materials, making them a perfect addition to any home.\r\nFeatures:\r\n✔ Made with natural beeswax – eco-friendly and biodegradable\r\n✔ Pure essential oils – calming scents from local herbs and flowers\r\n✔ Eco-friendly packaging – minimal waste, 100% recyclable\r\n✔ Long-lasting burn time – enjoy the fragrance for hours', 195.00, '../assets/images/67b0474a0e4ed5.70300474.png', '2025-02-15 07:50:34', '2025-02-15 07:50:34'),
(29, 'Key rings', 'Add a personal touch to your keys with our stylish key rings, crafted from high-quality materials. Perfect for organizing keys or as a thoughtful gift, these key rings are durable, lightweight, and come in a variety of designs to suit any style.', 100.00, '../assets/images/67b047621f9751.83221143.png', '2025-02-15 07:50:58', '2025-02-15 07:50:58'),
(30, 'Mini Bajra Key Rings', 'Inspired by the sacred Bajra (Vajra), these handcrafted key rings symbolize strength and wisdom in Nepali Buddhist culture. Made from brass or alloy, they are lightweight, durable, and intricately designed, making them a meaningful accessory or souvenir.', 120.00, '../assets/images/67b0477cae93f6.40646154.png', '2025-02-15 07:51:24', '2025-02-15 07:51:24'),
(31, 'Handwoven baskets', 'Beautifully crafted by Nepali artisans, these eco-friendly, handwoven baskets are made from natural fibers like bamboo, cane, and rattan. Perfect for storage, decor, or gifting, they combine durability with rustic charm. Lightweight yet sturdy, they offer a sustainable and stylish touch to any space.', 700.00, '../assets/images/67b04798517e32.99504589.png', '2025-02-15 07:51:52', '2025-02-15 07:51:52'),
(32, 'Medium Royal Diamond Oil Lamp Diyo Akhanda Batti', 'This is a medium sized Royal Diamond Oil Lamp or Diyo or also called Akhanda Batti made up of brass. This product is used for offering the light for the gods and goddesses or in temple. It can also be used as a decorative item or candle. This oil lamp has a very unique and attractive design which consists of 3 parts. It has a vessel for putting the oil and light, a outer cover consisting of the diamonds (not real) and a top cover. It has the oil capacity of 30 ml. The height of this product is 12 cm whereas the width is 7.2 cm. The net weight is 210 grams approximately. This lamp has an excellent craftsmanship.', 900.00, '../assets/images/67b047b92aaae3.84479143.png', '2025-02-15 07:52:25', '2025-02-15 07:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `terms_agreed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `dob`, `gender`, `password_hash`, `terms_agreed`, `created_at`, `updated_at`, `role`, `reset_token`, `token_expiry`) VALUES
(1, 'Aayush', 'Agrawal', 'aayushagrawal4572@gmail.com', '9823199038', '2003-06-11', 'male', '$2y$10$whzo4Hcu6Ldl08n4yyLsLO0vi0AH2Fisi.azGwIfi23w.wO8jCUhm', 1, '2025-02-09 15:52:12', '2025-02-11 17:34:08', 'user', 'd0383141857fa5d530727f790dced10e717ec6c1dc6a3a45c5b580d959c08a9f07d59f16b93d8c673927c0541b2057900a99', '2025-02-11 21:27:11'),
(2, 'Aayush ', 'Second ', 'aayush2@gmail.com', '7485961236', '2002-07-17', 'female', '$2y$10$So3OpzuKqzOiHiGOPQNnsO0A/iOMTuqHSCURyFtUABMGN8QvHH1Lq', 1, '2025-02-09 16:12:10', '2025-02-11 16:48:11', 'user', NULL, NULL),
(5, 'admin', 'admin', 'admin@admin.com', '9848454545', '2002-06-13', 'male', '$2y$10$zp1cwnuAUJXZMfsKRyTfMuSgd9O2BzDuEOLvDmbDHJ5y0383h45ui', 1, '2025-02-10 16:09:50', '2025-02-10 16:10:34', 'admin', NULL, NULL),
(7, 'test', 'user', 'testuser@gmail.com', '9845152632', '2005-02-09', 'female', '$2y$10$max2ANMYaZ3a06MI8Julx.Xz8FFTspXHbJlBT1Qz67.NSVaQC6L8a', 1, '2025-02-15 16:39:17', '2025-02-15 16:39:17', 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `address`, `city`, `province`, `postal_code`, `latitude`, `longitude`, `is_default`) VALUES
(1, 1, 'Chhetrapati ', 'kathmandu ', 'Bagmati', '3006', 0, 0, 1),
(2, 7, 'Chhetrapati ', 'Kathmandu', 'Bagmati', '3006', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boxes`
--
ALTER TABLE `boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boxes`
--
ALTER TABLE `boxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
