-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 01:40 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormitoryapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL COMMENT 'รหัสผู้ดูแลหอพัก',
  `a_name` varchar(100) NOT NULL COMMENT 'ชื่อผู้ดูแลหอพัก',
  `a_tel` varchar(20) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `a_idcard` varchar(20) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `username` varchar(100) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `password` text NOT NULL COMMENT 'รหัสผ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `a_name`, `a_tel`, `a_idcard`, `username`, `password`) VALUES
(1, 'a_admin', '0326', '1256', 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL COMMENT 'รหัสบิลค่าเช่าห้องพัก',
  `aid` int(11) NOT NULL COMMENT 'รหัสผู้ดูแลหอพัก',
  `invoice_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ออกบิล',
  `meters_wnew` int(11) NOT NULL COMMENT 'มิเตอร์น้ำล่าสุด',
  `meters_lnew` int(11) NOT NULL COMMENT 'มิเตอร์ไฟล่าสุด',
  `water_unit` int(11) NOT NULL COMMENT 'จำนวนน้ำที่ใช้',
  `light_unit` int(11) NOT NULL COMMENT 'จำนวนไฟที่ใช้',
  `total_wprice` int(11) NOT NULL COMMENT 'รวมค่าน้ำ',
  `total_lprice` int(11) NOT NULL COMMENT 'รวมค่าไฟ',
  `net_total` int(11) NOT NULL COMMENT 'ค่าเช่าห้องพักรวมสุทธิ',
  `Invoice_status` varchar(20) NOT NULL COMMENT 'สถานะบิล',
  `leases_id` int(11) NOT NULL COMMENT 'เลขที่สัญญาเช่า',
  `invoice_month` date NOT NULL COMMENT 'ใบเเจ้งบิลของเดือน',
  `pay_id` int(11) NOT NULL DEFAULT 0 COMMENT 'เลขที่การชำระเงิน ถ้า = 0 คือยังไม่ชำระ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางบิลค่าเช่าห้องพัก';

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `aid`, `invoice_date`, `meters_wnew`, `meters_lnew`, `water_unit`, `light_unit`, `total_wprice`, `total_lprice`, `net_total`, `Invoice_status`, `leases_id`, `invoice_month`, `pay_id`) VALUES
(17, 1, '2021-03-24', 46, 888, 78, 8, 78, 8, 8, '2', 3, '2021-02-10', 66);

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE `leases` (
  `leases_id` int(11) NOT NULL COMMENT 'เลขที่สัญญาเช่า',
  `aid` int(11) NOT NULL COMMENT 'รหัสผู้ดูแลหอพัก',
  `rid` int(11) NOT NULL COMMENT 'รหัสผู้เช่า',
  `room_id` int(11) NOT NULL COMMENT 'หมายเลขห้องพัก',
  `leases_date` date NOT NULL COMMENT 'วันที่ทำสัญญาเช่า',
  `expires_date` date NOT NULL COMMENT 'วันที่หมดสัญญา',
  `leases_status` varchar(20) NOT NULL COMMENT 'สถาานะสัญญาเช่า ',
  `l_c_e` int(11) NOT NULL COMMENT 'ค่าไฟต่อหน่วย',
  `l_c_w` int(11) NOT NULL COMMENT 'ค่าน้ำต่อหน่วย',
  `l_rent` int(11) NOT NULL COMMENT 'ค่าเช่า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางสัญญาเช่าห้องพัก';

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`leases_id`, `aid`, `rid`, `room_id`, `leases_date`, `expires_date`, `leases_status`, `l_c_e`, `l_c_w`, `l_rent`) VALUES
(3, 1, 6, 2, '2021-03-11', '2021-06-24', '1', 5, 21, 3000),
(4, 1, 7, 3, '2021-03-18', '2021-06-24', '1', 5, 21, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL COMMENT 'รหัสข่าวสาร',
  `aid` int(11) NOT NULL COMMENT 'รหัสผู้ดูแลหอพัก',
  `room_id` int(11) NOT NULL COMMENT 'หมายเลขห้องพัก',
  `news_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่แจ้งข่าวสาร',
  `news_title` text NOT NULL COMMENT 'หัวข้อข่าวสาร',
  `description` text NOT NULL COMMENT 'รายละเอียดข่าวสาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข่าวสาร';

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `aid`, `room_id`, `news_date`, `news_title`, `description`) VALUES
(2, 1, 0, '2021-03-23', 'ddf', 'ffffff'),
(3, 1, 0, '2021-03-23', 'fffffffffffffffffff', 'sdfsdfffffffffffffffffff'),
(4, 1, 0, '2021-03-23', 'fgf', 'dfg'),
(5, 1, 0, '2021-03-23', '1สสสสสส', 'ววววววววว'),
(6, 1, 0, '2021-03-23', '5545', '45654'),
(7, 1, 0, '2021-03-23', '456666666666', '4555555555555555555');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL COMMENT 'รหัสการชำระ',
  `room_id` int(11) NOT NULL COMMENT 'หมายเลขห้องพัก',
  `pay_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ชำระ',
  `pay_total` int(11) NOT NULL COMMENT 'จำนวนเงินทั้งหมด',
  `pay_pic` text NOT NULL COMMENT 'ภาพหลักฐานชำระเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางการชำระค่าเช่าห้องพัก';

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `room_id`, `pay_date`, `pay_total`, `pay_pic`) VALUES
(66, 2, '2021-03-24', 8, 'a86048ce907a3eab4cc1c92012a8e764944766052605b48c49375b4.47440825.png');

-- --------------------------------------------------------

--
-- Table structure for table `renter`
--

CREATE TABLE `renter` (
  `rid` int(11) NOT NULL COMMENT 'รหัสผู้เช่า',
  `r_name` varchar(100) NOT NULL COMMENT 'ชื่อ-สกุล ',
  `r_tel` varchar(20) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `r_idcard` varchar(20) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `r_add` text NOT NULL COMMENT 'ที่อยู่',
  `r_email` varchar(30) NOT NULL COMMENT 'อีเมล',
  `username` varchar(100) NOT NULL COMMENT 'รหัสผ่าน',
  `password` text NOT NULL COMMENT 'ชื่อผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางผู้เช่า ';

--
-- Dumping data for table `renter`
--

INSERT INTO `renter` (`rid`, `r_name`, `r_tel`, `r_idcard`, `r_add`, `r_email`, `username`, `password`) VALUES
(6, 'a', '032356', '14525', 'a', 'a@gmail.com', 'a', '7f8199312f2c0cf56ef85ad625be6aaa'),
(7, 'b', '56', '1656', 'bbb', 'b@gmail.com', 'b', '762f44c342a9580748ef0cfaa527adf5');

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `re_id` int(11) NOT NULL COMMENT 'รหัสการแจ้งซ่อม',
  `room_id` int(11) NOT NULL COMMENT 'หมายเลขห้องพัก',
  `re_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่แจ้งซ่อม',
  `cause` text NOT NULL COMMENT 'สาเหตุ',
  `description` text NOT NULL COMMENT 'รายละเอียด',
  `re_pic` text NOT NULL COMMENT 'รูปภาพ',
  `re_status` varchar(100) NOT NULL COMMENT 'สถานะการแจ้งซ่อม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางการแจ้งซ่อมห้องพัก';

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL COMMENT 'หมายเลขห้องพัก',
  `room_status` varchar(20) NOT NULL DEFAULT '0' COMMENT 'สถานะห้องพัก 0 ว่าง 1 ไม่ว่าง',
  `meters_water` int(11) NOT NULL COMMENT 'มิเตอร์น้ำตั้งต้น',
  `meters_light` int(11) NOT NULL COMMENT 'มิเตอร์ไฟตั้งต้น',
  `room_tid` int(11) NOT NULL COMMENT 'รหัสประเภทห้องพัก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางห้องพัก';

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_status`, `meters_water`, `meters_light`, `room_tid`) VALUES
(1, '1', 0, 0, 2),
(2, '1', 0, 0, 1),
(3, '1', 0, 0, 2),
(4, '0', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `room_tid` int(11) NOT NULL COMMENT 'รหัสประเภทห้องพัก',
  `room_tname` varchar(100) NOT NULL COMMENT 'ประเภทห้องพัก',
  `room_tprice` int(11) NOT NULL COMMENT 'ราคาห้องพัก',
  `price_water` int(11) NOT NULL COMMENT 'ค่าน้ำต่อหน่วย',
  `price_light` int(11) NOT NULL COMMENT 'ค่าไฟต่อหน่วย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางประเภทห้องพัก';

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`room_tid`, `room_tname`, `room_tprice`, `price_water`, `price_light`) VALUES
(1, 'ห้องพัดลม', 3000, 5, 21),
(2, 'ห้องเเอร์', 5000, 5, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `leases`
--
ALTER TABLE `leases`
  ADD PRIMARY KEY (`leases_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `renter`
--
ALTER TABLE `renter`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`re_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`room_tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ดูแลหอพัก', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบิลค่าเช่าห้องพัก', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `leases`
--
ALTER TABLE `leases`
  MODIFY `leases_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'เลขที่สัญญาเช่า', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข่าวสาร', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการชำระ', AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `renter`
--
ALTER TABLE `renter`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้เช่า', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการแจ้งซ่อม';

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขห้องพัก', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `room_tid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทห้องพัก', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
