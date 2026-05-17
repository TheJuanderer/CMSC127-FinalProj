-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 07:54 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lf_db`
--

-- --------------------------------------------------------

--
-- Table structure for `categories`
--


CREATE TABLE `categories` (
    `category_id` int(11) NOT NULL,
    `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `categories`
--

INSERT INTO `categories`(`category_id`,`category_name`)
VALUES
(1, 'Electronics'),
(2, 'Jewelry'),
(3, 'Wallets'),
(4, 'Umbrella'),
(5, 'Documents'),
(6, 'Stationary'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `user_id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `contact_no` varchar(20) NOT NULL,
    `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`,`name`, `password_hash`,`contact_no`,`role`)
VALUES
(1, 'Tung Tung Tung Sahur', SHA2('pass67', 512), '09195557410', 'admin'),
(2, 'Tralalero Tralala', SHA2('agoodpassword', 512), '09285554502', 'user'),
(3, 'Fros Lass', SHA2('thebesticetype', 512), '9095556395', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
    `report_id` int(11) NOT NULL,
    `category_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `item_id` int(11) NOT NULL,
    `description` text,
    `type` varchar(50) NOT NULL,
    `status` varchar(50) NOT NULL,
    `image_url` varchar(255),
    `last_seen_date` date,
    `last_seen_location` varchar(255),
    `when_made` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `category_id`, `user_id`, `item_id`, `description`, `type`, `status`, `image_url`, `last_seen_date`, `last_seen_location`)
VALUES
(1, 1, 2, 1, 'black color, cracked screen', 'Lost', 'OPEN', 'uploads/iphone.jpg', '2026-10-01', 'CUB'),
(2, 3, 3, 2, 'brown leather', 'Found', 'OPEN', 'uploads/wallet.jpg', '2025-10-02', 'CAS CL2');


--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
    `claim_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `report_id` int(11) NOT NULL,
    `claim_date` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`claim_id`, `user_id`, `report_id`, `claim_date`)
VALUES
(1, 3, 1, '2026-05-10');


-- create items table
CREATE TABLE `items` (
    `item_id` INT(11) NOT NULL,
    `item_name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `items` (`item_id`, `item_name`)
VALUES (1, 'iPhone 13'),
(2, 'CLN Wallet');



--
-- Indexes for dumped tables
--
-- added keys to all the tables
ALTER TABLE `categories`
    ADD PRIMARY KEY (`category_id`);

ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`);

ALTER TABLE `reports`
    ADD PRIMARY KEY (`report_id`),
    ADD KEY `category_id` (`category_id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `item_id` (`item_id`);

ALTER TABLE `claims`
    ADD  PRIMARY KEY (`claim_id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `report_id` (`report_id`);


ALTER TABLE `items`
    ADD PRIMARY KEY (`item_id`),
    MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- defined where to increment the IDs
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4; -- bc i defined new ids already when i inserted

ALTER TABLE `reports`
    MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3; -- same reasons here po

ALTER TABLE `claims`
    MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- make sure that some keys always has references to other tables' keys
ALTER TABLE `reports`
    ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
    ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    ADD CONSTRAINT `reports_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

ALTER TABLE `claims`
    ADD CONSTRAINT `claims_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    ADD CONSTRAINT `claims_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `reports` (`report_id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;