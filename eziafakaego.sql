-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2017 at 02:18 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bar`
--

CREATE TABLE `bar` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `drink_name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `recieved_by` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL,
  `recieved_from` varchar(32) NOT NULL,
  `dept_recieved_from` varchar(30) NOT NULL,
  `time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bar`
--

INSERT INTO `bar` (`id`, `category`, `drink_name`, `description`, `recieved_by`, `quantity`, `recieved_from`, `dept_recieved_from`, `time`, `date`) VALUES
(7, 'coca cola', 'coke', '  beverage drink', 'aneke okeychukwu', 10, 'vivian', 'store', '12:49:pm', '31/Mar/2017'),
(8, 'coca cola', 'eva water', '  drinking water', 'aneke okeychukwu', 6, 'vivian', 'store', '10:57:am', '31/Mar/2017'),
(9, 'beer', 'life', '  lager beer', 'aneke okeychukwu', 10, 'charles', 'Store', '01:16:pm', '01/Apr/2017');

-- --------------------------------------------------------

--
-- Table structure for table `bar_categories`
--

CREATE TABLE `bar_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bar_categories`
--

INSERT INTO `bar_categories` (`id`, `category`) VALUES
(5, 'beer'),
(6, 'wine'),
(7, 'coca cola');

-- --------------------------------------------------------

--
-- Table structure for table `bar_products`
--

CREATE TABLE `bar_products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `drink_name` varchar(70) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `added_by` varchar(70) NOT NULL,
  `time` varchar(70) NOT NULL,
  `date` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bar_products`
--

INSERT INTO `bar_products` (`id`, `category`, `drink_name`, `description`, `unit_price`, `quantity`, `total`, `added_by`, `time`, `date`) VALUES
(1, 'coca cola', 'eva water', 'drinking water', 250, 10, 2500, 'victus nnagozie', '10:47:am', '31/Mar/2017'),
(2, 'coca cola', 'coke', 'beverage drink', 250, 3, 750, 'victus nnagozie', '10:48:am', '31/Mar/2017'),
(3, 'beer', 'life', 'lager beer', 300, 50, 15000, 'victus nnagozie', '01:15:pm', '01/Apr/2017');

-- --------------------------------------------------------

--
-- Table structure for table `bar_sales`
--

CREATE TABLE `bar_sales` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `bar_product` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `customer_code` varchar(11) NOT NULL,
  `customer_name` varchar(64) NOT NULL,
  `sold_by` varchar(64) NOT NULL,
  `time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bar_sales`
--

INSERT INTO `bar_sales` (`id`, `category`, `bar_product`, `description`, `quantity`, `unit_price`, `total`, `customer_code`, `customer_name`, `sold_by`, `time`, `date`) VALUES
(1, '', 'mineral', 'coke bottel 50 cl', 4, 250, 1000, '0', 'sab ude chu chu', 'uche emeka', '07:14:pm', '12/Feb/2017'),
(2, '', 'beer', '4 bottles of star radler', 3, 350, 1050, '0', 'sab udeh chu chu', 'uche emeka', '07:19:pm', '12/Feb/2017'),
(3, '', 'mineral', '2 bottles', 3, 250, 750, '0', 'ugwu murphy', 'uche emeka', '09:01:pm', '16/Feb/2017'),
(4, '', 'mineral', '2 bottle of coke', 1, 250, 250, '0', 'uche', 'aneke okeychukwu', '02:38:pm', '15/Mar/2017'),
(5, 'coca cola', 'coke', '  beverage drink', 2, 250, 500, '2029', '', 'aneke okeychukwu', '10:58:am', '31/Mar/2017');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `date_time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL,
  `approval` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_id`, `customer_id`, `customer_name`, `category`, `description`, `amount`, `date_time`, `date`, `approval`) VALUES
(1, 2, '', 'soft_drink', 'COKE', 250, '11:28:am - 02/Feb/2017', '02/Feb/2017', 'manager'),
(2, 2, '', 'label', 'magic moment', 2500, '11:28:am - 02/Feb/2017', '02/Feb/2017', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen`
--

CREATE TABLE `kitchen` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `recieved_by` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL,
  `recieved_from` varchar(64) NOT NULL,
  `dept_recieved_from` varchar(64) NOT NULL,
  `time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen`
--

INSERT INTO `kitchen` (`id`, `category`, `food_name`, `description`, `recieved_by`, `quantity`, `recieved_from`, `dept_recieved_from`, `time`, `date`) VALUES
(4, 'swallow', 'semo-vita', '  5kg bag', 'ify anti', 5, 'vivian', 'Store', '08:50:am', '29/Mar/2017');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_categories`
--

CREATE TABLE `kitchen_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen_categories`
--

INSERT INTO `kitchen_categories` (`id`, `category`) VALUES
(1, 'swallow'),
(3, 'snacks');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_products`
--

CREATE TABLE `kitchen_products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `food_name` varchar(70) NOT NULL,
  `food_type` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `added_by` varchar(70) NOT NULL,
  `time` varchar(70) NOT NULL,
  `date` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen_products`
--

INSERT INTO `kitchen_products` (`id`, `category`, `food_name`, `food_type`, `description`, `unit_price`, `quantity`, `total`, `added_by`, `time`, `date`) VALUES
(1, 'swallow', 'semo-vita', 'raw', '5kg bag', 8000, 4, 32000, 'victus nnagozie', '07:24:pm', '27/Mar/2017'),
(2, 'snacks', 'meat pie', 'prepared', 'meat pie', 500, 15, 7500, 'victus nnagozie', '10:42:am', '31/Mar/2017');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_sales`
--

CREATE TABLE `kitchen_sales` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `customer_code` varchar(10) NOT NULL,
  `customer_name` varchar(40) NOT NULL,
  `sold_by` varchar(40) NOT NULL,
  `time` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen_sales`
--

INSERT INTO `kitchen_sales` (`id`, `category`, `food_name`, `description`, `unit_price`, `quantity`, `total`, `customer_code`, `customer_name`, `sold_by`, `time`, `date`) VALUES
(1, 'swallow', 'semo-vita', '  5kg bag', 8000, 1, 8000, '', '', 'ify anti', '08:49:am', '29/Mar/2017'),
(2, 'snacks', 'meat pie', '  meat pie', 500, 1, 500, '2029', '', 'ify anti', '10:43:am', '31/Mar/2017');

-- --------------------------------------------------------

--
-- Table structure for table `new_customer`
--

CREATE TABLE `new_customer` (
  `customer_id` int(6) NOT NULL,
  `customer_code` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `car_reg` varchar(11) NOT NULL,
  `country` varchar(15) NOT NULL DEFAULT 'nigerian',
  `state` varchar(15) NOT NULL,
  `check_out` int(1) NOT NULL DEFAULT '0',
  `room_type` varchar(20) NOT NULL,
  `room_number` int(4) NOT NULL,
  `no_of_days` int(3) NOT NULL,
  `room_rate` int(7) NOT NULL,
  `room_description` varchar(100) NOT NULL,
  `security_deposite` int(7) NOT NULL,
  `administrator` varchar(50) NOT NULL,
  `time` varchar(15) NOT NULL,
  `date` varchar(32) NOT NULL,
  `total` int(7) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_customer`
--

INSERT INTO `new_customer` (`customer_id`, `customer_code`, `customer_name`, `address`, `phone_number`, `occupation`, `email`, `gender`, `car_reg`, `country`, `state`, `check_out`, `room_type`, `room_number`, `no_of_days`, `room_rate`, `room_description`, `security_deposite`, `administrator`, `time`, `date`, `total`, `quantity`) VALUES
(23, 2023, 'stella emeli', 'nnokwa', '08033114586', 'bizness woman', 'uchehjubgw@yahoo.com', 'female', '', 'nigerian', 'enugu', 1, 'Exclusive', 1, 2, 18000, '  A room and Parlor with 2 Toilet and Bathroom', 0, 'chukwu manuel', '02:54:pm', '30/Mar/2017', 36000, 0),
(28, 2028, 'Godwin James', 'hhfjghj', '08063635454', 'jhdtjudtude', '', 'male', '', 'nigerian', 'anambra', 0, '', 0, 0, 0, '', 0, 'chukwu manuel', '03:29:pm', '30/Mar/2017', 0, 0),
(29, 2029, 'uche emmanuel', 'abakpa nike enugu', '07037183185', 'computer engineer', 'uche@chukwuict.com', 'male', '', 'nigerian', 'enugu', 0, 'executive', 12, 3, 32000, '  family size room', 0, 'chukwu manuel', '10:23:am', '31/Mar/2017', 96000, 0),
(30, 2030, 'Dr. Mathew', '1 new layout enugu', '08035756251', 'Doctor', 'mathew@gmail.com', 'male', 'EU352UA', 'nigerian', 'enugu', 1, 'Exclusive', 4, 1, 8000, '  a room self con with jacuzy', 4000, 'kaego Eziafa', '01:40:pm', '01/Apr/2017', 8000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_available`
--

CREATE TABLE `rooms_available` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `available` varchar(2) NOT NULL DEFAULT '1',
  `customer_code` int(11) NOT NULL,
  `added_by` varchar(70) NOT NULL,
  `time` varchar(15) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms_available`
--

INSERT INTO `rooms_available` (`id`, `category`, `room_number`, `description`, `unit_price`, `available`, `customer_code`, `added_by`, `time`, `date`) VALUES
(1, 'Exclusive', '1', 'A room and Parlor with 2 Toilet and Bathroom', 18000, '0', 0, 'victus nnagozie', '01:28:pm', '28/Mar/2017'),
(2, 'executive', '11', 'Self contain with bath tub accessories', 15000, '0', 2004, 'victus nnagozie', '01:36:pm', '28/Mar/2017'),
(3, 'executive', '12', 'family size room', 32000, '0', 2029, 'victus nnagozie', '10:21:am', '31/Mar/2017'),
(4, 'Exclusive', '4', 'a room self con with jacuzy', 8000, '0', 0, 'victus nnagozie', '01:48:pm', '01/Apr/2017');

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id`, `category`) VALUES
(1, 'executive'),
(2, 'Exclusive');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `item` varchar(32) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `sales_deposite` int(11) NOT NULL,
  `date_time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL,
  `sales_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `customer_id`, `customer_name`, `phone_number`, `item`, `unit_price`, `quantity`, `credit`, `sales_deposite`, `date_time`, `date`, `sales_total`) VALUES
(1, 2, 'victus mba', '07023455432', 'stout', 32, 24, 0, 13133, '11:45:am - 02/Feb/2017', '02/Feb/2017', 768),
(2, 2, 'uche emmanuel', '07037183185', 'stout', 23, 22, 0, 221, '11:45:am - 02/Feb/2017', '02/Feb/2017', 506),
(3, 2, 'ugochukwu ezeh', '08056789012', 'water', 123, 232, 0, 11221, '11:45:am - 02/Feb/2017', '02/Feb/2017', 28536),
(4, 0, 'samuel chukwumabili', '08033110584', 'juice', 700, 4, 0, 4000, '11:45:am - 02/Feb/2017', '02/Feb/2017', 2800);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `store_product` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `recieved_by` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `recieved_from` varchar(100) NOT NULL,
  `dept_recieved_from` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `category`, `store_product`, `description`, `recieved_by`, `quantity`, `unit_price`, `recieved_from`, `dept_recieved_from`, `total`, `time`, `date`) VALUES
(5, 'provision', 'milo', '  1000mg of satchet milo', 'amaka vivian', 10, 4000, '', '', 40000, '12:17:pm', '31/Mar/2017'),
(6, 'food', 'garri', '  5kg bag', 'amaka vivian', 2, 2, 'mama nkechi', 'ogbete main market', 8, '01:12:pm', '31/Mar/2017');

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE `store_products` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `product_name` varchar(70) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `added_by` varchar(70) NOT NULL,
  `time` varchar(70) NOT NULL,
  `date` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_requisition`
--

CREATE TABLE `store_requisition` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `store_product` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `request_dept` varchar(64) NOT NULL,
  `requested_by` varchar(50) NOT NULL,
  `sold_by` varchar(255) NOT NULL,
  `time` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_requisition`
--

INSERT INTO `store_requisition` (`id`, `category`, `store_product`, `description`, `quantity`, `request_dept`, `requested_by`, `sold_by`, `time`, `date`) VALUES
(7, 'food', 'garri', '  5kg bag', 2, 'kitchen', 'anti ify', 'amaka vivian', '01:14:pm', '31/Mar/2017');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `department` varchar(32) NOT NULL,
  `salary` int(11) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `address`, `department`, `salary`, `email`, `active`) VALUES
(1, 'chukwu', 'b77eef4512a6fcf21fcd11531bca6e20', 'manuel', 'chukwu', '0', '', 'reception', 0, 'uchemanuel1@gmail.com', 1),
(2, 'vivian', 'b77eef4512a6fcf21fcd11531bca6e20', 'vivian', 'amaka', '0', '', 'store', 0, 'priscaoluchi67@gmail.com', 1),
(3, 'emeka', 'b77eef4512a6fcf21fcd11531bca6e20', 'emeka', 'uche', '0', '', 'bar', 0, 'uche@gmail.com', 1),
(4, 'okey', 'b77eef4512a6fcf21fcd11531bca6e20', 'okeychukwu', 'aneke', '0', '', 'bar', 0, 'okey@gmail.com', 1),
(5, 'miriam', 'b77eef4512a6fcf21fcd11531bca6e20', 'anti', 'ify', '0', '', 'kitchen', 0, 'anti-ify@yahoo.com', 1),
(6, 'tukor', 'b77eef4512a6fcf21fcd11531bca6e20', 'nnagozie', 'victus', '0', '', 'admin', 0, 'tukorbenedictor@gmail.com', 1),
(7, 'chubbyfobbs', 'b77eef4512a6fcf21fcd11531bca6e20', 'onyeka', 'efobi', '08045456767', '', 'admin', 0, 'chubbyfobbs@live.co.uk', 1),
(8, 'ginika', 'b77eef4512a6fcf21fcd11531bca6e20', 'ginika', 'nwachukwu', '09088778854', 'trans ekulu nike way', 'reception', 0, 'ginika@hotmail.com', 1),
(9, 'ego', '60dc498c838e842e2789a6fb7ea6cdf2', 'Eziafa', 'kaego', '08035756255', '17 ego street awka road', 'reception', 10000, 'ego@yahoo.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bar_categories`
--
ALTER TABLE `bar_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bar_products`
--
ALTER TABLE `bar_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bar_sales`
--
ALTER TABLE `bar_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `kitchen`
--
ALTER TABLE `kitchen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchen_categories`
--
ALTER TABLE `kitchen_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchen_products`
--
ALTER TABLE `kitchen_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchen_sales`
--
ALTER TABLE `kitchen_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_customer`
--
ALTER TABLE `new_customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_code` (`customer_code`);

--
-- Indexes for table `rooms_available`
--
ALTER TABLE `rooms_available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_requisition`
--
ALTER TABLE `store_requisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bar`
--
ALTER TABLE `bar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bar_categories`
--
ALTER TABLE `bar_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bar_products`
--
ALTER TABLE `bar_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bar_sales`
--
ALTER TABLE `bar_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kitchen`
--
ALTER TABLE `kitchen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kitchen_categories`
--
ALTER TABLE `kitchen_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kitchen_products`
--
ALTER TABLE `kitchen_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kitchen_sales`
--
ALTER TABLE `kitchen_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `new_customer`
--
ALTER TABLE `new_customer`
  MODIFY `customer_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `rooms_available`
--
ALTER TABLE `rooms_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_requisition`
--
ALTER TABLE `store_requisition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
