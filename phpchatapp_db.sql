-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 28 фев 2025 в 21:09
-- Версия на сървъра: 9.1.0
-- Версия на PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `phpchatapp_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` varchar(255) DEFAULT NULL,
  `outgoing_msg_id` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, '763849130', '802616344', 'hello'),
(2, '802616344', '763849130', 'go'),
(3, '802616344', '763849130', 'с'),
(4, '802616344', '763849130', 'как е брат ми'),
(5, '763849130', '802616344', 'бива'),
(6, '763849130', '802616344', 'само така'),
(7, '763849130', '802616344', 'има ме ли домашна'),
(8, '802616344', '763849130', 'не'),
(9, '802616344', '763849130', 'кккккк'),
(10, '802616344', '763849130', 'пмцпям лмацс  поммммм'),
(11, '1071410374', '763849130', 'ko '),
(12, '1071410374', '763849130', 'sh ei'),
(13, '763849130', '1071410374', 'ko be '),
(14, '763849130', '1071410374', 'q ma ostai'),
(15, '1071410374', '763849130', 'nqma '),
(16, '763849130', '1071410374', 'mama ti'),
(17, '1071410374', '763849130', 'ei bokluk'),
(18, '763849130', '1071410374', 'dd'),
(19, '802616344', '763849130', 'knwc'),
(20, '253090620', '763849130', 'как сме '),
(21, '763849130', '253090620', 'бива '),
(22, '763849130', '253090620', 'цъкам spider man'),
(23, '253090620', '763849130', 'оооо супер'),
(24, '253090620', '763849130', 'готина игричка '),
(25, '253090620', '763849130', 'за тез пари толкоз'),
(26, '763849130', '253090620', 'да '),
(27, '763849130', '253090620', 'ко да се прави '),
(28, '253090620', '763849130', 'ами ай брат до после'),
(29, '763849130', '253090620', 'ай'),
(30, '253090620', '763849130', 'ko stawa'),
(31, '763849130', '545570754', 'как е криска'),
(32, '545570754', '763849130', 'бива братчето ми '),
(33, '763849130', '673844406', 'дай ми пари'),
(34, '673844406', '763849130', 'не');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT 'Offline now, Online',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(9, '253090620', 'Stancho', 'Naydenov', 'stancho@gmail.com', '$2y$10$8qn1hC2VGJ8riyWhVV4FSeNQLlfM3AOnRt3cM1x21DgNIMizXGOKi', '1740681428_1.png', 'online'),
(10, '1071410374', 'Denkata', 'Kilima', 'denka@gmail.com', '$2y$10$xTqVMF31vKGrafT.NJMiYOzLvHHpVNE.6vknUbPPZSeiQvUawn1qW', '1740681492_1.png', 'online'),
(11, '545570754', 'Slav', 'Dimitrov', 'slav@gmail.com', '$2y$10$kKNns7g1LUxjZdEEHtjzduYsrPj8Du1ke8ww/G7TeX3AJtxjsDMwi', '1740756298_1.png', 'offline now'),
(12, '673844406', 'Димитър ', 'Димитров', 'batmitko@gmail.com', '$2y$10$CdGfdNGLvhhqJ0ZBdZxZiOV6kmZbQaot/.9rRVHtuITMeevmAkLQu', '1740761243_1.png', 'Online'),
(8, '802616344', 'Gosho', 'Kostadinov', 'gosho@gmail.com', '$2y$10$X3p7CNM0OlOViK7F1DJFVOwvIhCgrOcCD538rDnaKvSI1j1BskC6W', '1740681384_1.png', 'online'),
(7, '763849130', 'Kris', 'Dim', 'kdim@gmail.com', '$2y$10$mqGiRT/4TTm3l6uyW99I7OkUKLVdpz3Viuljd6OrIXbRk2FI7nzCO', '1740681291_1.png', 'offline now');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
