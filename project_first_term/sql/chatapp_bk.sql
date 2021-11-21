-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2021 a las 23:55:18
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chatapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id` int(10) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `pfp` varchar(100) DEFAULT './assets/files/img/default/pfp_default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id`, `alias`, `pfp`) VALUES
(1, 'root --test-chat', './assets/files/img/default/pfp_default.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `senderID` int(10) NOT NULL,
  `chatID` int(10) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `msgTime` datetime NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `senderID`, `chatID`, `content`, `msgTime`, `isRead`) VALUES
(6, 2, 1, 'asdsaddasd', '2021-11-20 23:54:29', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participate_users_chats`
--

CREATE TABLE `participate_users_chats` (
  `userID` int(10) NOT NULL,
  `chatID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `participate_users_chats`
--

INSERT INTO `participate_users_chats` (`userID`, `chatID`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `usName` varchar(30) NOT NULL,
  `usSurname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `telephone` varchar(16) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usName`, `usSurname`, `username`, `email`, `age`, `telephone`, `passwd`, `isActive`) VALUES
(1, 'root', 'root', 'root', 'root', 0, '', 'root', 0),
(2, 'Alfredo', 'Puerta Gallego', 'alfreeznx', 'apgalle03@gmail.com', 19, '', '$2y$10$qoDuP/dIvAgwEOzZX6M7BenVViZUwWpndyJf7njDNbaoX1g9v.smK', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `chatID` (`chatID`);

--
-- Indices de la tabla `participate_users_chats`
--
ALTER TABLE `participate_users_chats`
  ADD PRIMARY KEY (`userID`,`chatID`),
  ADD KEY `chatID` (`chatID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`chatID`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participate_users_chats`
--
ALTER TABLE `participate_users_chats`
  ADD CONSTRAINT `participate_users_chats_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participate_users_chats_ibfk_2` FOREIGN KEY (`chatID`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
