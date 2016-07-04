
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2016 at 02:33 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a9882281_dbtest`
--

-- --------------------------------------------------------
--
-- Table structure for table `blocks`
--
--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` VALUES('home', 15);
INSERT INTO `blocks` VALUES('work', 13);
INSERT INTO `blocks` VALUES('pharmacy', 18);

--
-- Table structure for table `devices`
--


--
-- Dumping data for table `devices`
--

INSERT INTO `devices` VALUES('tv', 'off', 1);
INSERT INTO `devices` VALUES('lamp', 'off', 1);
INSERT INTO `devices` VALUES('aircondition', 'off', 1);
INSERT INTO `devices` VALUES('fishbox', 'off', 1);

INSERT INTO `devices` VALUES('Pc', 'off', 2);
INSERT INTO `devices` VALUES('fan', 'off', 2);
INSERT INTO `devices` VALUES('rauter', 'off', 2);

INSERT INTO `devices` VALUES('fan', 'off', 3);
INSERT INTO `devices` VALUES('microwave', 'off', 3);
INSERT INTO `devices` VALUES('coller', 'off', 3);

INSERT INTO `devices` VALUES('boiler', 'off', 4);
INSERT INTO `devices` VALUES('fridge', 'off', 4);

INSERT INTO `devices` VALUES('dishmachine', 'off', 5);
INSERT INTO `devices` VALUES('washmachine', 'off', 5);

INSERT INTO `devices` VALUES('xbox', 'off', 6);
INSERT INTO `devices` VALUES('ps4', 'off', 6);
INSERT INTO `devices` VALUES('pc', 'on', 6);
INSERT INTO `devices` VALUES('lamp', 'on', 6);

INSERT INTO `devices` VALUES('aircondition', 'on', 7);
INSERT INTO `devices` VALUES('fan', 'off', 7);

INSERT INTO `devices` VALUES('drill', 'off', 8);
INSERT INTO `devices` VALUES('metalcutter', 'off', 8);
INSERT INTO `devices` VALUES('oscilliscobe', 'off', 8);

INSERT INTO `devices` VALUES('aircondition', 'on', 9);
INSERT INTO `devices` VALUES('fan', 'off', 9);
INSERT INTO `devices` VALUES('pc', 'on', 9);
INSERT INTO `devices` VALUES('lamp', 'on', 9);

INSERT INTO `devices` VALUES('lamp', 'off', 10);
INSERT INTO `devices` VALUES('Pc', 'off', 10);
INSERT INTO `devices` VALUES('fans', 'on', 10);

INSERT INTO `devices` VALUES('lamp', 'off', 11);
INSERT INTO `devices` VALUES('pc', 'on', 11);
INSERT INTO `devices` VALUES('aircondition', 'on', 11);
INSERT INTO `devices` VALUES('lamp2', 'off', 11);

INSERT INTO `devices` VALUES('mesuerment', 'off', 12);
INSERT INTO `devices` VALUES('HEATER', 'on', 12);
INSERT INTO `devices` VALUES('FRIDGE', 'on', 12);

INSERT INTO `devices` VALUES('pc', 'off', 13);
INSERT INTO `devices` VALUES('lamp', 'on', 13);
INSERT INTO `devices` VALUES('aircondition', 'off', 13);

INSERT INTO `devices` VALUES('lamp', 'on', 14);
INSERT INTO `devices` VALUES('pc', 'on', 14);
INSERT INTO `devices` VALUES('aircondition', 'on', 14);

--
-- Table structure for table `nodes`
--


--
-- Dumping data for table `nodes`
--

INSERT INTO `nodes` VALUES(233109, 'false', '1983-11-19 13:17:26', 1);
INSERT INTO `nodes` VALUES(170184, 'true', '1972-02-18 12:41:56', 1);
INSERT INTO `nodes` VALUES(88233, 'true', '1980-04-29 02:01:43', 2);
INSERT INTO `nodes` VALUES(202103, 'false', '2011-06-22 20:44:15', 2);
INSERT INTO `nodes` VALUES(17517, 'true', '1970-07-23 12:24:41', 2);
INSERT INTO `nodes` VALUES(77220, 'false', '2010-02-16 10:49:31', 3);
INSERT INTO `nodes` VALUES(183247, 'false', '1991-11-28 14:59:33', 3);
INSERT INTO `nodes` VALUES(204228, 'true', '1975-06-17 04:59:54', 4);
INSERT INTO `nodes` VALUES(19282, 'true', '1983-02-25 05:49:55', 4);
INSERT INTO `nodes` VALUES(111187, 'true', '1976-11-07 04:52:07', 5);
INSERT INTO `nodes` VALUES(189115, 'true', '2007-09-22 01:05:16', 6);
INSERT INTO `nodes` VALUES(11788, 'true', '1979-08-20 10:56:43', 7);
INSERT INTO `nodes` VALUES(1710, 'false', '1977-12-25 16:37:23', 7);
INSERT INTO `nodes` VALUES(197216, 'true', '1992-04-07 19:18:40', 8);

--
-- Table structure for table `phones`
--


--
-- Dumping data for table `phones`
--

INSERT INTO `phones` VALUES('01006739539', 1);
INSERT INTO `phones` VALUES('01062727205', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` VALUES('livingroom', 1);
INSERT INTO `rooms` VALUES('kitchen', 1);
INSERT INTO `rooms` VALUES('kidsroom', 1);
INSERT INTO `rooms` VALUES('lab', 2);
INSERT INTO `rooms` VALUES('office', 2);
INSERT INTO `rooms` VALUES('mainpart', 3);
INSERT INTO `rooms` VALUES('lab', 3);
INSERT INTO `rooms` VALUES('storage', 3);



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES('Ahmed Mohammed', 'Ahmed12345', 'ahmed@yahoo.com', '2016-06-28 15:00:00', 'c');
INSERT INTO `users` VALUES('Alaa Ahmed', 'Alaa12345','mohammed@yahoo.com','2016-05-27 00:00:00', 'b');
