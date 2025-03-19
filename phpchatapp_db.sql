-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 19 март 2025 в 20:53
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
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(62, '673844406', '1362537836', 'яй '),
(61, '673844406', '1362537836', 'що бе '),
(60, '1362537836', '673844406', 'я си гледай работата'),
(59, '673844406', '1362537836', 'дай пари уе'),
(58, '1362537836', '253090620', 'всичко е точно '),
(55, '253090620', '1362537836', 'добре криска '),
(56, '253090620', '1362537836', 'при теб как е '),
(57, '1362537836', '253090620', 'бива '),
(54, '1362537836', '253090620', 'как сме днес'),
(53, '999582579', '1362537836', 'Ще идваш ли на уни');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(9, '253090620', 'Stancho', 'Naydenov', 'stancho@gmail.com', '$2y$10$8qn1hC2VGJ8riyWhVV4FSeNQLlfM3AOnRt3cM1x21DgNIMizXGOKi', '1740681428_1.png', 'offline now'),
(10, '1071410374', 'Denkata', 'Kilima', 'denka@gmail.com', '$2y$10$xTqVMF31vKGrafT.NJMiYOzLvHHpVNE.6vknUbPPZSeiQvUawn1qW', '1741782829_Screenshot_2025-03-12-14-30-49-060_com.miui.gallery[1].jpg', 'offline now'),
(11, '545570754', 'Tosho', 'Dimitrov', 'tosho@gmail.com', '$2y$10$kKNns7g1LUxjZdEEHtjzduYsrPj8Du1ke8ww/G7TeX3AJtxjsDMwi', 'cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIyLTA4L2pvYjEwMzQtZWxlbWVudC0wNi0zOTcucG5n.webp', 'offline now'),
(12, '673844406', 'Димитър ', 'Димитров', 'batmitko@gmail.com', '$2y$10$CdGfdNGLvhhqJ0ZBdZxZiOV6kmZbQaot/.9rRVHtuITMeevmAkLQu', '488-4887957_facebook-teerasej-profile-ball-circle-circular-profile-picture.png', 'offline now'),
(8, '802616344', 'Gosho', 'Kostadinov', 'gosho@gmail.com', '$2y$10$PgfvVph8krMeAp0m7F59B.I30ygtD5IeO2dNAsLkSfVlZNxxi/r32', 'cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDI0LTExL3Jhd3BpeGVsX29mZmljZV8zMl9waG90b19wb3J0cmFpdF9zbWlsaW5nX2luZGlhbl9tYW5faW5fc2hpcnRfYV84MWNjZTNiZS03ZTVjLTRkMDgtODcwYS03OTBlNjhlYWMwNTktbTNwanoycG8ucG5n.webp', 'offline now'),
(14, '1362537836', 'KRIS', 'DIM', 'kdim@gmail.com', '$2y$10$dHrfIe6ShDJnFCJtErzTOup4Hkoa2xBE9dpjpBLuEiBA9WaA9q7ZO', 'images.jpg', 'offline now');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
