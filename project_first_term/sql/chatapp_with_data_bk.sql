-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2021 a las 23:41:14
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
(1, 'root --test-chat', './assets/files/img/default/pfp_default.jpg'),
(2, 'chat de prueba', './assets/files/img/default/pfp_default.jpg'),
(3, 'chat de prueba', './assets/files/img/default/pfp_default.jpg'),
(4, 'chat de prueba', './assets/files/img/default/pfp_default.jpg'),
(5, 'chat de prueba', './assets/files/img/default/pfp_default.jpg'),
(6, 'chat de prueba', './assets/files/img/default/pfp_default.jpg'),
(7, 'perdona luis <3', './assets/files/img/default/pfp_default.jpg'),
(8, 'asdasd', './assets/files/img/default/pfp_default.jpg'),
(9, 'pepe', './assets/files/img/default/pfp_default.jpg'),
(10, 'si', './assets/files/img/default/pfp_default.jpg'),
(11, 'si', './assets/files/img/default/pfp_default.jpg'),
(12, 'skeree', './assets/files/img/default/pfp_default.jpg'),
(13, 'sadasdsadadsadas', './assets/files/img/default/pfp_default.jpg'),
(14, 'pruebesitas', './assets/files/img/default/pfp_default.jpg'),
(15, 'funciona pls', './assets/files/img/default/pfp_default.jpg'),
(16, 'funciona pls', './assets/files/img/default/pfp_default.jpg'),
(17, 'luis xdd', './assets/files/img/default/pfp_default.jpg'),
(18, 'kskskskks', './assets/files/img/default/pfp_default.jpg'),
(19, 'alberto tonto', './assets/files/img/default/pfp_default.jpg'),
(20, 'valencia', './assets/files/img/default/pfp_default.jpg'),
(21, 'valencia2', './assets/files/img/default/pfp_default.jpg'),
(22, 'valencia3', './assets/files/img/default/pfp_default.jpg'),
(23, 'grasias luis <3', './assets/files/img/default/pfp_default.jpg'),
(24, 'aaaaaaaaaaa', './assets/files/img/default/pfp_default.jpg'),
(25, 'sdsdsd', './assets/files/img/default/pfp_default.jpg'),
(26, '', './assets/files/img/default/pfp_default.jpg'),
(27, '', './assets/files/img/default/pfp_default.jpg'),
(28, '', './assets/files/img/default/pfp_default.jpg'),
(29, '', './assets/files/img/default/pfp_default.jpg'),
(30, '', './assets/files/img/default/pfp_default.jpg'),
(31, '', './assets/files/img/default/pfp_default.jpg'),
(32, '', './assets/files/img/default/pfp_default.jpg'),
(33, '', './assets/files/img/default/pfp_default.jpg'),
(34, '', './assets/files/img/default/pfp_default.jpg'),
(35, '', './assets/files/img/default/pfp_default.jpg'),
(36, '', './assets/files/img/default/pfp_default.jpg'),
(37, '', './assets/files/img/default/pfp_default.jpg'),
(38, '', './assets/files/img/default/pfp_default.jpg'),
(39, '', './assets/files/img/default/pfp_default.jpg'),
(40, '', './assets/files/img/default/pfp_default.jpg'),
(41, '', './assets/files/img/default/pfp_default.jpg');

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
(1, 9, 1, 'adasd', '2021-11-21 04:47:47', 0),
(2, 2, 1, 'sda', '2021-11-21 04:51:46', 0),
(3, 2, 1, 'aaaa', '2021-11-21 04:51:49', 0),
(4, 2, 1, 'aaaa', '2021-11-21 04:51:50', 0),
(5, 2, 1, 'aaaa', '2021-11-21 04:51:51', 0),
(6, 2, 1, 'aaaa', '2021-11-21 04:52:19', 0),
(7, 2, 1, 'asdasdasd', '2021-11-21 04:52:23', 0),
(8, 2, 1, 'tremendo maricon', '2021-11-21 04:52:30', 0),
(9, 2, 1, 'tremendo maricon', '2021-11-21 04:54:23', 0),
(10, 2, 1, 'tremendo maricon', '2021-11-21 04:54:24', 0),
(11, 2, 1, 'tremendo maricon', '2021-11-21 04:54:24', 0),
(12, 2, 1, 'tremendo maricon', '2021-11-21 04:54:26', 0),
(13, 2, 1, 'tremendo maricon', '2021-11-21 04:54:26', 0),
(14, 2, 1, 'tremendo maricon', '2021-11-21 04:55:10', 0),
(15, 2, 1, 'tremendo maricon', '2021-11-21 04:55:38', 0),
(16, 2, 1, 'tremendo maricon', '2021-11-21 04:55:38', 0),
(17, 2, 1, 'tremendo maricon', '2021-11-21 04:55:38', 0),
(18, 2, 1, 'tremendo maricon', '2021-11-21 04:55:47', 0),
(19, 2, 1, 'tremendo maricon', '2021-11-21 04:55:47', 0),
(20, 2, 1, 'tremendo maricon', '2021-11-21 04:55:47', 0),
(21, 2, 1, 'tremendo maricon', '2021-11-21 04:56:06', 0),
(22, 2, 1, 'tremendo maricon', '2021-11-21 04:56:07', 0),
(23, 2, 1, 'tremendo maricon', '2021-11-21 04:56:07', 0),
(24, 2, 1, 'tremendo maricon', '2021-11-21 04:56:07', 0),
(25, 2, 1, 'tremendo maricon', '2021-11-21 04:56:29', 0),
(26, 2, 1, 'tremendo maricon', '2021-11-21 04:56:29', 0),
(27, 2, 1, 'tremendo maricon', '2021-11-21 04:58:04', 0),
(28, 2, 1, 'a', '2021-11-21 04:58:13', 0),
(29, 2, 1, 'a', '2021-11-21 04:58:16', 0),
(30, 2, 1, 'a', '2021-11-21 05:00:37', 0),
(31, 2, 1, 'a', '2021-11-21 05:00:40', 0),
(32, 2, 1, 'a', '2021-11-21 05:00:54', 0),
(33, 2, 1, 'a', '2021-11-21 05:00:54', 0),
(34, 2, 1, 'asda', '2021-11-21 05:00:57', 0),
(35, 2, 1, 'asda', '2021-11-21 05:00:59', 0),
(36, 2, 1, 'asda', '2021-11-21 05:01:47', 0),
(37, 2, 1, 'asda', '2021-11-21 05:01:50', 0),
(38, 2, 1, 'asda', '2021-11-21 05:02:05', 0),
(39, 2, 1, 'asda', '2021-11-21 05:02:09', 0),
(40, 2, 1, 'asda', '2021-11-21 05:02:09', 0),
(41, 2, 1, 'rererere', '2021-11-21 05:02:15', 0),
(42, 2, 1, 'rererere', '2021-11-21 05:02:16', 0),
(43, 2, 1, 'rererere', '2021-11-21 05:03:06', 0),
(44, 2, 1, 'rererere', '2021-11-21 05:03:13', 0),
(45, 2, 1, 'xdddddddddd', '2021-11-21 05:04:22', 0),
(46, 2, 1, 'xdddddddddd', '2021-11-21 05:04:26', 0),
(47, 2, 1, 'xdddddddddd', '2021-11-21 05:04:33', 0),
(48, 2, 1, 's', '2021-11-21 05:04:36', 0),
(49, 2, 1, 's', '2021-11-21 05:05:13', 0),
(50, 2, 1, 's', '2021-11-21 05:05:13', 0),
(51, 2, 1, 's', '2021-11-21 05:05:48', 0),
(52, 2, 1, 's', '2021-11-21 05:05:48', 0),
(53, 2, 1, 's', '2021-11-21 05:05:48', 0),
(54, 2, 1, 's', '2021-11-21 05:07:35', 0),
(55, 2, 1, 's', '2021-11-21 05:07:35', 0),
(56, 2, 1, 's', '2021-11-21 05:08:02', 0),
(57, 2, 1, 's', '2021-11-21 05:08:11', 0),
(58, 2, 1, 's', '2021-11-21 05:08:12', 0),
(59, 2, 1, 's', '2021-11-21 05:11:35', 0),
(60, 2, 1, 's', '2021-11-21 05:11:35', 0),
(61, 2, 1, 's', '2021-11-21 05:11:53', 0),
(62, 2, 1, 's', '2021-11-21 05:11:54', 0),
(63, 2, 1, 'ad', '2021-11-21 14:14:21', 0),
(64, 2, 1, 'ad', '2021-11-21 14:14:22', 0),
(65, 2, 1, 'ad', '2021-11-21 14:14:22', 0),
(66, 2, 1, 'ad', '2021-11-21 14:14:23', 0),
(67, 2, 1, 'ad', '2021-11-21 14:14:23', 0),
(68, 2, 1, 'ad', '2021-11-21 14:14:23', 0),
(69, 2, 1, 'ad', '2021-11-21 14:15:38', 0),
(70, 2, 1, 'ad', '2021-11-21 14:15:38', 0),
(71, 2, 1, 'ad', '2021-11-21 14:15:39', 0),
(72, 2, 1, 'ad', '2021-11-21 14:15:51', 0),
(73, 2, 1, 'ad', '2021-11-21 14:15:52', 0),
(74, 2, 1, 'ad', '2021-11-21 14:15:52', 0),
(75, 2, 1, 'ad', '2021-11-21 14:16:07', 0),
(76, 2, 1, 'ad', '2021-11-21 14:16:07', 0),
(77, 2, 1, 'ad', '2021-11-21 14:16:08', 0),
(78, 2, 1, 'ad', '2021-11-21 14:16:14', 0),
(79, 2, 1, 'ad', '2021-11-21 14:16:14', 0),
(80, 2, 1, 'ad', '2021-11-21 14:16:14', 0),
(81, 2, 1, 'ad', '2021-11-21 14:16:38', 0),
(82, 2, 1, 'ad', '2021-11-21 14:16:38', 0),
(83, 2, 1, 'ad', '2021-11-21 14:16:52', 0),
(84, 2, 1, 'ad', '2021-11-21 14:16:52', 0),
(85, 2, 1, 'ad', '2021-11-21 14:17:18', 0),
(86, 2, 1, 'ad', '2021-11-21 14:17:18', 0),
(87, 2, 1, 'ad', '2021-11-21 14:17:26', 0),
(88, 2, 1, 'ad', '2021-11-21 14:17:26', 0),
(89, 2, 1, 'ad', '2021-11-21 14:17:27', 0),
(90, 2, 1, 'ad', '2021-11-21 14:17:27', 0),
(91, 2, 1, 'ad', '2021-11-21 14:17:53', 0),
(92, 2, 1, 'ad', '2021-11-21 14:17:53', 0),
(93, 2, 1, 'ad', '2021-11-21 14:18:00', 0),
(94, 2, 1, 'ad', '2021-11-21 14:18:00', 0),
(95, 2, 1, 'ad', '2021-11-21 14:18:09', 0),
(96, 2, 1, 'ad', '2021-11-21 14:18:10', 0),
(97, 2, 1, 'ad', '2021-11-21 14:18:10', 0),
(98, 2, 1, 'ad', '2021-11-21 14:18:34', 0),
(99, 2, 1, 'ad', '2021-11-21 14:18:34', 0),
(100, 2, 1, 'ad', '2021-11-21 14:18:37', 0),
(101, 2, 1, 'ad', '2021-11-21 14:18:37', 0),
(102, 2, 1, 'ad', '2021-11-21 14:19:04', 0),
(103, 2, 1, 'ad', '2021-11-21 14:19:05', 0),
(104, 2, 1, 'ad', '2021-11-21 14:19:05', 0),
(105, 2, 1, 'ad', '2021-11-21 14:19:12', 0),
(106, 2, 1, 'ad', '2021-11-21 14:19:12', 0),
(107, 2, 1, 'ad', '2021-11-21 14:19:13', 0),
(108, 2, 1, 'ad', '2021-11-21 14:19:13', 0),
(109, 2, 1, 'ad', '2021-11-21 14:19:26', 0),
(110, 2, 1, 'ad', '2021-11-21 14:19:26', 0),
(111, 2, 1, 'ad', '2021-11-21 14:19:26', 0),
(112, 2, 1, 'ad', '2021-11-21 14:19:32', 0),
(113, 2, 1, 'ad', '2021-11-21 14:19:32', 0),
(114, 2, 1, 'ad', '2021-11-21 14:19:56', 0),
(115, 2, 1, 'ad', '2021-11-21 14:19:56', 0),
(116, 2, 1, 'ad', '2021-11-21 14:19:56', 0),
(117, 2, 1, 'ad', '2021-11-21 14:20:07', 0),
(118, 2, 1, 'ad', '2021-11-21 14:20:07', 0),
(119, 2, 1, 'ad', '2021-11-21 14:20:22', 0),
(120, 2, 1, 'ad', '2021-11-21 14:20:23', 0),
(121, 2, 1, 'ad', '2021-11-21 14:20:23', 0),
(122, 2, 1, 'ad', '2021-11-21 14:20:36', 0),
(123, 2, 1, 'ad', '2021-11-21 14:20:37', 0),
(124, 2, 1, 'ad', '2021-11-21 14:20:37', 0),
(125, 2, 1, 'ad', '2021-11-21 14:20:51', 0),
(126, 2, 1, 'ad', '2021-11-21 14:20:51', 0),
(127, 2, 1, 'ad', '2021-11-21 14:20:51', 0),
(128, 2, 1, 'xcxzc', '2021-11-21 20:05:34', 0),
(129, 2, 1, 'xcxzc', '2021-11-21 20:06:45', 0),
(130, 2, 1, 'xcxzc', '2021-11-21 20:06:45', 0),
(131, 2, 1, 'xcxzc', '2021-11-21 20:06:47', 0),
(132, 2, 1, 'xcxzc', '2021-11-21 20:06:47', 0),
(133, 2, 1, 'asdasda', '2021-11-21 21:02:02', 0),
(134, 2, 1, 'dasdasdasdsad', '2021-11-21 21:03:54', 0),
(135, 2, 1, 'ola', '2021-11-21 21:04:04', 0),
(136, 2, 1, 'ola', '2021-11-21 21:04:08', 0),
(137, 2, 1, 'ola', '2021-11-21 23:36:40', 0),
(138, 2, 1, 'ola', '2021-11-21 23:37:04', 0),
(139, 2, 1, 'ola', '2021-11-21 23:37:04', 0),
(140, 2, 1, 'ola', '2021-11-21 23:37:05', 0),
(141, 2, 1, 'ola', '2021-11-21 23:37:05', 0),
(142, 2, 1, 'adsad', '2021-11-21 23:37:09', 0),
(143, 2, 1, 'dasdasdasd', '2021-11-21 23:40:19', 0);

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
(1, 1),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(2, 1),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 25),
(6, 20),
(6, 21);

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
  `pfp` varchar(100) DEFAULT './assets/files/img/default/pfp_default.jpg',
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usName`, `usSurname`, `username`, `email`, `age`, `telephone`, `passwd`, `pfp`, `isActive`) VALUES
(1, 'root', 'root', 'root', 'root', 0, '', 'root', './assets/files/img/default/pfp_default.jpg', 0),
(2, 'Alfredo', 'Puerta Gallego', 'alfreeznx', 'apgalle03@gmail.com', 19, '', '$2y$10$ZDLlW85Ga3akqZHhpZB//.dIymNiZ1SH1B8bymDddl/Xr6CQYk.b.', 'kakashi.jpg', 0),
(4, 'qwe', 'qwe', 'pepe', 'qwe@gmail.com', 20, '', '$2y$10$MtHFrBAXX9mPtCtSrd3NeuS4y2NWHHLXAP3121AGPAOQvv/s1uDRO', 'assets/files/img/', 0),
(5, 'qwer', 'qwer', 'pepe2', 'qwer@qwer.qwer', 18, '', '$2y$10$E8iRaySgvgH8TPXr3ndel.mdliohwPM.BK.twLl0AiIsZIEiGMv4S', 'assets/files/img/', 0),
(6, 'asd', 'asd', 'asd', 'asd@asd.asd', 17, '', '$2y$10$d61H/RzuHCaBuNjJemf4COo1kXLBpIyXRibbq.8l01qrpefV1klbi', '', 0),
(7, 'ewq', 'ewq', 'eqw', 'ewq@gmail.com', 17, '', '$2y$10$qayzt1kulnvtwYC1oJgUJ.5/SvkIimo6V8dV4qyE6RJ9j4EWcHHY.', '', 0),
(8, 'eewq', 'eewq', 'eewq', 'eewq@gmail.com', 17, '', '$2y$10$yi1ki9pKlL/F3PAnGN0YqOvkrh05tpJHJJHTTXUhaWHSGXQ2xP/Ua', '', 0),
(9, 'qwr', 'qwr', 'qwr', 'qwr@gmail.com', 16, '', '$2y$10$KQTR.2Qh7/cNufSbM2oueuPYo5qxyX..DxlIRTp215dmY.9ejmkQ2', 'kakashi.jpg', 0),
(11, 'miguel', 'diaz diaz', 'miguel', 'miguel@gmail.com', 19, '', '$2y$10$V6pZDcRpq5D0O9/KBfqfB.IQYE9//B3KE5T24fN6k6cxDq3xdCSjq', 'wallpaper itachi.jpg', 0),
(12, 'jose', 'jose', 'jose', 'jose@jose.jose', 17, '', '$2y$10$vvHOEGb1pEODAv1//nfV.O4gu5jZwLfJ6GbbgLTKH/8I2M0X0UtPe', 'uploads/wallpaper itachi.jpg', 0),
(13, 'luis', 'luis', 'luis', 'luis@luis.luis', 16, '', '$2y$10$3LJ7dJHWZrARiEkqCl3eM.GiNNURrcb1JPQlBl75o0Gye7OKsGOKG', './assets/files/img/default/pfp_default.jpg', 0),
(14, 'adri', 'adri', 'adri', 'adri@adri.adri', 17, '', '$2y$10$tN8AkY/mLL.R1Z7OJE2IhOnqSxgcHrEysFfN11DDmH9zwTyDLUlc2', 'assets/files/uploads/wallpaper kakashi.jpg', 0);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
