-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 07:39 PM
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
(2, 'Paper Packaging  ', 'A brown paper wrapping that gives off a rustic, natural vibe. It’s finished off with a delicate flower, adding a simple yet thoughtful touch. Perfect for wrapping gifts or items with a down-to-earth, charming look.', '../assets/images/67b34e4171b0c.jpg', 50.00),
(3, 'Clothed Box Packaging ', 'A tightly knotted cloth packaging with a clean and secure finish, layered over a paper box underneath. A small flower is added for that perfect finishing touch, giving it a simple yet charming and elegant look. ', '../assets/images/67b34ee632d7d.jpg', 450.00),
(4, 'Triangle Box Packaging', 'A triangle-shaped packaging that stands out with its unique design. It\'s neatly tied with a ribbon, with a flower added for a charming touch. Simple, stylish, and perfect for gifting or special occasions.', '../assets/images/67b34fbd7065e.jpg', 90.00),
(5, 'Bamboo box packaging ', 'A bamboo box packaging that brings a natural, eco-friendly touch to your gift. The box is beautifully decorated with ribbons and delicate flowers, adding a soft and charming finish. Perfect for presenting gifts in a way that\'s both stylish and sustainable', '../assets/images/67b34fd43e075.jpg', 300.00),
(6, 'Zigzag Pattern Packaging ', 'A rectangular-shaped box featuring a subtle zigzag pattern for a touch of texture and style. A small flower is tied to it with a ribbon, adding a delicate and charming detail. Simple yet eye-catching, this box is perfect for gifting or special occasions.', '../assets/images/67b34febc91a6.jpg', 90.00),
(7, 'Roll Packaging ', 'A rolled cloth packaging designed to resemble a chocolate or candy wrap. It\'s neatly tied with ribbons on both ends, giving it a charming and playful look. Simple yet stylish, this packaging is great for gifts, small accessories, or special occasions.', '../assets/images/67b35000cb0bb.jpg', 250.00),
(8, 'Simple brown box packaging ', 'A simple, rectangular box with a clean and minimal design. It\'s wrapped with a neat ribbon, with a small flower tied to it for a subtle, decorative touch. Perfect for gifting, it keeps things stylish without being over-the-top', '../assets/images/67b3501885a65.jpg', 150.00),
(9, 'Pouch only packaging ', 'A durable and stylish pouch made from high-quality fabric, designed for secure and elegant packaging. This cloth pouch provides a protective and reusable solution for storing and presenting various items, making it ideal for gifts, accessories, and other small essentials.', '../assets/images/67b3502c921ed.jpg', 60.00),
(10, 'Cloth Pouch Packaging ', 'A beautifully designed gift box that opens to reveal a stylish cloth pouch inside. Inside, the soft and durable fabric pouch adds an extra layer of protection and charm, making it perfect for presenting delicate or valuable items. This thoughtful packaging enhances the gifting experience, combining elegance with functionality.', '../assets/images/67b350b514ed8.jpg', 250.00),
(11, 'Square box packaging  ', 'A beautifully crafted, square-shaped box designed for elegance and charm. It features a delicate ribbon tied gracefully around it, adding a touch of sophistication. A small, decorative charm is attached to the ribbon, enhancing its aesthetic appeal and making it perfect for gifting or special occasions.', '../assets/images/67b350c6a3ce8.jpg', 150.00);

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
(42, 7, NULL, NULL, '2025-02-15 16:39:51', 3, NULL, 2, NULL),
(43, 7, NULL, NULL, '2025-02-15 16:39:59', NULL, 1, NULL, 4),
(44, 7, 12, 2, '2025-02-15 16:40:10', NULL, NULL, NULL, NULL),
(46, 7, 15, 3, '2025-02-15 16:40:18', NULL, NULL, NULL, NULL),
(49, 1, NULL, NULL, '2025-02-17 15:06:22', NULL, 9, NULL, 1),
(54, 8, 3, 4, '2025-02-17 16:34:58', NULL, NULL, NULL, NULL),
(55, 8, NULL, NULL, '2025-02-17 16:37:56', 5, NULL, 2, NULL),
(56, 8, NULL, NULL, '2025-02-17 16:41:58', 4, NULL, 1, NULL),
(57, 1, NULL, NULL, '2025-02-17 17:56:57', 4, NULL, 3, NULL),
(58, 1, 6, 2, '2025-02-17 17:57:07', NULL, NULL, NULL, NULL),
(59, 1, 9, 1, '2025-02-17 17:57:10', NULL, NULL, NULL, NULL),
(60, 1, NULL, NULL, '2025-02-17 17:57:23', NULL, 3, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','paypal','cash_on_delivery') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','processing','completed','canceled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `shipping_address`, `city`, `province`, `postal_code`, `latitude`, `longitude`, `total_cost`, `payment_method`, `order_date`, `status`) VALUES
(1, 1, 'Chhetrapati ', 'kathmandu ', 'Bagmati', '3006', 0.000000, 0.000000, 0.00, '', '2025-02-17 17:54:42', 'completed'),
(2, 1, 'Chhetrapati ', 'kathmandu ', 'Bagmati', '3006', 0.000000, 0.000000, 0.00, '', '2025-02-17 17:56:25', 'processing'),
(3, 1, 'Chhetrapati ', 'kathmandu ', 'Bagmati', '3006', 0.000000, 0.000000, 0.00, '', '2025-02-17 17:57:39', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `box_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `box_id`, `package_id`, `product_name`, `quantity`, `price`, `total`) VALUES
(1, 1, NULL, NULL, NULL, 'Pouch only packaging ', 1, 60.00, 60.00),
(2, 2, NULL, NULL, NULL, 'Pouch only packaging ', 1, 60.00, 60.00),
(3, 3, NULL, NULL, NULL, 'Pouch only packaging ', 1, 60.00, 60.00),
(4, 3, NULL, NULL, NULL, 'Sajilo Gift Box (सजिलो)', 3, 500.00, 1500.00),
(5, 3, NULL, NULL, NULL, 'Buddhist Incense', 2, 50.00, 100.00),
(6, 3, NULL, NULL, NULL, 'Lokta Paper Journal', 1, 500.00, 500.00),
(7, 3, NULL, NULL, NULL, 'Clothed Box Packaging ', 2, 450.00, 900.00);

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
(4, 'Sajilo Gift Box (सजिलो)', 500.00, '../assets/images/67b353fea865c.webp', 'Sajilo means easy, and this box offers a curated selection of simple, thoughtful gifts that bring comfort and a touch of Nepali culture to everyday life. From local snacks to sustainable, practical items, it\'s the perfect pick-me-up for anyone looking to experience Nepal in a meaningful way.\r\n\r\nPackaging: Simple Paper Pouch Packaging (Rs. 50) \r\n• Masala Peanuts (Rs. 150)\r\nThese crunchy peanuts are coated in a flavorful blend of spices, perfect for snacking during a busy day. A savory and spicy treat!\r\n• Handmade Lokta Paper Notebook (Rs. 200) \r\nCrafted from traditional Nepali Lokta paper, this notebook features a soft, durable cover and blank pages, making it ideal for journaling, sketching, or note-taking.\r\n• Herbal Lip Balm (Rs. 100) \r\nA soothing lip balm made with organic ingredients such as beeswax and essential oils, providing moisture and protection for your lips.\r\n', '2025-02-17 15:21:34'),
(5, 'Mitho Gift Box (मिठो) ', 1000.00, '../assets/images/67b3541e420de.jpg', 'Mitho means sweet, and this box is a celebration of life\'s little luxuries! Filled with relaxing and indulgent gifts, it offers a blend of cultural and wellness items that give you a taste of Nepali luxury. Perfect for those who enjoy handmade goods and traditional treats.\r\nPackaging: Handmade Lokta Paper Box (Rs. 150) \r\n• Organic Honey (Rs. 300) \r\nHarvested from the Himalayan region, this organic honey is rich in flavor, perfect for tea or as a natural sweetener in your favorite recipes.\r\n• Handwoven Cotton Shawl (Rs. 400) \r\nSoft and cozy, this traditional cotton shawl is handwoven with intricate patterns, adding warmth and elegance to any outfit.\r\n• Clay Aroma Diffuser (Rs. 150) \r\nThis handmade diffuser uses essential oils to create a soothing atmosphere in your home, helping you relax and unwind after a busy day.\r\n• Handmade Ceramic Cup (Rs. 200) \r\nA beautifully crafted ceramic cup, perfect for enjoying your favorite tea or coffee. The unique design adds a touch of Nepali artistry to your collection.\r\n', '2025-02-17 15:22:06'),
(6, 'Sampanna Gift Box (सम्पन्न) ', 1500.00, '../assets/images/67b3543c1ff1a.jpg', 'Sampanna means affluent, and this box is crafted to make you feel just that! Filled with cultural treasures, spiritual artifacts, and wellness essentials, it’s the perfect gift for those who appreciate luxury and Nepal’s rich traditions. Ideal for anyone who loves indulging in the finer things in life.\r\nPackaging: Bamboo Box Packaging (Rs. 300) \r\n• Special Thamel Blend Coffee (Rs. 400) \r\nA special blend of coffee beans sourced from the foothills of the Himalayas, offering a rich, full-bodied flavor that’s perfect for any time of day.\r\n• Dhaka Handwoven Scarf (Rs. 600) \r\nThis premium scarf is woven with traditional Dhaka fabric, showcasing exquisite craftsmanship and adding a touch of elegance to any wardrobe.\r\n• Scented Candle Set (Rs. 200) \r\nA set of aromatic candles made from natural wax, designed to create a calming atmosphere in your home with their soothing fragrances.\r\n• Nepali Herbal Bath Salt (Rs. 150) \r\nInfused with Himalayan salts and essential oils, this bath salt helps to detoxify and relax the body after a long day.\r\n', '2025-02-17 15:22:36'),
(7, 'Paramparik Gift Box (पारम्परिक) ', 2000.00, '../assets/images/67b3545a2da2d.jpg', 'Paramparik means tradition, and this box offers a luxurious blend of cultural and artisanal items that showcase the essence of Nepali heritage and craftsmanship. Perfect for gifting or indulging yourself in a premium Nepali experience, it’s a true celebration of tradition and luxury.\r\nPackaging: Embroidered Fabric Box (Rs. 400) \r\n• Yak Cheese (Rs. 600) \r\nA unique and flavorful cheese made from yak milk, a traditional delicacy from the Himalayas. Rich in nutrients, it’s a delicacy enjoyed by many in Nepal.\r\n• Prayer Wheel (Rs. 700) \r\nA beautifully crafted prayer wheel made from brass, often used in Tibetan Buddhist practice, and believed to bring blessings and good karma.\r\n• Wooden Incense Burner (Rs. 300) \r\nA traditional wooden incense holder designed to burn incense sticks, filling the room with soothing fragrances and promoting tranquility.\r\n• Himalayan Essential Oils Set (Rs. 200) \r\nA set of essential oils derived from Himalayan plants, ideal for aromatherapy and relaxation.\r\n', '2025-02-17 15:23:06'),
(8, 'Sanskriti Gift Box (संस्कृति)', 2500.00, '../assets/images/67b354743da31.jpg', 'Sanskriti represents culture, and this box is for those who appreciate the blend of tradition and luxury. It combines exquisite Nepali craftsmanship with wellness and culinary delights, offering a luxurious selection of traditional art, handcrafted items, and wellness products. Perfect for those who cherish fine craftsmanship and the spiritual essence of Nepali heritage.\r\n\r\nPackaging: Wooden Box Packaging (Rs. 500) \r\n• Mini Hand-Painted Thangka Art (Rs. 800) \r\nA miniature version of a traditional Thangka painting, this artwork reflects intricate Buddhist designs, believed to bring peace and tranquility to your surroundings.\r\n• Brass Ganesha Statue (Rs. 700) \r\nA beautifully crafted brass statue of Lord Ganesha, the remover of obstacles, making it a perfect addition to any home or temple space.\r\n• Bamboo and Copper Incense Holder (Rs. 400) \r\nA natural bamboo incense holder, paired with a copper base, designed to hold incense sticks while allowing their aroma to fill your space.\r\n• Handmade Cotton Shawl (Rs. 600) \r\nSoft and elegant, this shawl is handwoven from cotton, perfect for both everyday use and formal occasions, showcasing Nepali textile artistry.\r\n', '2025-02-17 15:23:32'),
(9, 'Maharani Gift Box (महारानी) ', 3000.00, '../assets/images/67b35499a8cd7.jpg', 'The Maharani box is a luxurious, royal-inspired gift featuring gourmet treats, skincare, and cultural artifacts. Blending opulence, wellness, and Nepali craftsmanship, it\'s perfect for those who appreciate exquisite, handcrafted items and the elegance of Nepali royalty.\r\nPackaging: Golden Box Packaging (Rs. 600)\r\n • Nepali Gold-Plated Necklace (Rs. 1000) \r\nA beautifully crafted gold-plated necklace, featuring traditional Nepali designs, perfect for adding a regal touch to any outfit.\r\n• Copper and Brass Puja Thali (Rs. 800) \r\nA traditional puja thali (plate) made from copper and brass, used for religious rituals, adding an authentic spiritual touch to your prayers.\r\n• Handcrafted Wooden Mirror (Rs. 400) \r\nA decorative wooden mirror with intricate carvings, ideal for both functionality and adding a cultural touch to your home decor.\r\n• Aromatic Incense Set (Rs. 400) \r\nA premium collection of Nepali incense, designed to fill your space with a rich and calming fragrance, ideal for meditation or relaxation.\r\n', '2025-02-17 15:24:09');

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
(27, 'Bamboo bottles', 'Stay hydrated in style with this eco-friendly Bamboo Bottle, crafted from 100% natural bamboo with a stainless steel interior for durability and insulation. Designed to keep your drinks hot or cold for hours, this bottle is perfect for daily use, whether you\'re at work, traveling, or enjoying the outdoors.\r\nThe lightweight yet sturdy design makes it easy to carry, while the leak-proof lid ensures spill-free convenience. With a sleek and minimalist aesthetic, this bamboo bottle is not only functional but also a sustainable alternative to plastic bottles, reducing waste and promoting an eco-conscious lifestyle.\r\nFeatures:\r\n✔ Made from natural bamboo – biodegradable and sustainable\r\n✔ Double-wall insulation – keeps beverages hot or cold for up to 12 hours\r\n✔ Leak-proof & durable – stainless steel interior for long-lasting use\r\n✔ Lightweight & portable – perfect for travel, work, and daily hydration\r\n✔ Eco-friendly alternative – reduce plastic waste and embrace sustainability', 600.00, '../assets/images/67b047124a86f5.95684755.png', '2025-02-15 07:49:38', '2025-02-17 17:13:57'),
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
(5, 'admin', 'admin', 'admin@admin.com', '9848454545', '2002-06-13', 'male', '$2y$10$zp1cwnuAUJXZMfsKRyTfMuSgd9O2BzDuEOLvDmbDHJ5y0383h45ui', 1, '2025-02-10 16:09:50', '2025-02-10 16:10:34', 'admin', NULL, NULL),
(7, 'test', 'user', 'testuser@gmail.com', '9845152632', '2005-02-09', 'female', '$2y$10$max2ANMYaZ3a06MI8Julx.Xz8FFTspXHbJlBT1Qz67.NSVaQC6L8a', 1, '2025-02-15 16:39:17', '2025-02-15 16:39:17', 'user', NULL, NULL),
(8, 'test', '5', 'test5@gmail.com', '554541215', '2004-06-08', 'male', '$2y$10$Joo5bYkiSWjNPm9umAqYH.qo7bAdP2Ok5sohmUnKRqYId9xfD8KzK', 1, '2025-02-17 16:21:30', '2025-02-17 16:48:31', 'admin', NULL, NULL);

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
(2, 7, 'Chhetrapati ', 'Kathmandu', 'Bagmati', '3006', 0, 0, 1),
(3, 8, 'Dhalko', 'ktm', 'Bagmati', '3006', 0, 0, 1);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `box_id` (`box_id`),
  ADD KEY `package_id` (`package_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`id`),
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
