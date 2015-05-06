-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2015 a las 09:03:08
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `swap_your_music`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `userID` int(11) NOT NULL,
  `swapID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
  `bidID` int(11) NOT NULL,
  `startPrice` decimal(4,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `finishDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bids_participation`
--

CREATE TABLE IF NOT EXISTS `bids_participation` (
  `userID` int(11) NOT NULL,
  `bidID` int(11) NOT NULL,
  `offeredMoney` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conditions`
--

CREATE TABLE IF NOT EXISTS `conditions` (
  `conditionID` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `conditions`
--

INSERT INTO `conditions` (`conditionID`, `name`) VALUES
(1, 'New'),
(2, 'Used'),
(3, 'Rarely used');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direct_message`
--

CREATE TABLE IF NOT EXISTS `direct_message` (
  `messageID` int(11) NOT NULL,
  `swapID` int(11) NOT NULL,
  `date` date NOT NULL,
  `content` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluations`
--

CREATE TABLE IF NOT EXISTS `evaluations` (
  `evaluationID` int(11) NOT NULL,
  `itemAsDescribed` int(11) NOT NULL,
  `comunication` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `date` date NOT NULL,
  `place` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`eventID`, `name`, `description`, `date`, `place`) VALUES
(1, 'Fira del Disc de Barcelona', 'Saturday from 10.00h to 21.00h', '2015-05-18', 'Estació del Nord(Barcelona)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events_assistance`
--

CREATE TABLE IF NOT EXISTS `events_assistance` (
  `userID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `userID` int(11) NOT NULL,
  `friendID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `friends`
--

INSERT INTO `friends` (`userID`, `friendID`) VALUES
(0, 6),
(0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `genreID` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`genreID`, `name`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Hip-Hop'),
(4, 'Jazz-Blues'),
(5, 'Classical'),
(6, 'Childrens music'),
(7, 'Opera'),
(8, 'Heavy metal'),
(9, 'Country'),
(10, 'New age'),
(11, 'Singer-songwriter'),
(12, 'Electronic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemType` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `artist` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `releaseYear` int(11) NOT NULL,
  `genreID` int(2) NOT NULL,
  `conditionID` int(2) NOT NULL,
  `image` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`itemID`, `userID`, `itemType`, `title`, `artist`, `releaseYear`, `genreID`, `conditionID`, `image`, `available`) VALUES
(19, 1, 'Cassette', 'Veneno en la piel', 'Radio Futura', 1990, 1, 2, 'img/items/item0.jpg', 1),
(20, 2, 'Cassette', 'No es pecado', 'Alaska y Dinarama', 1986, 0, 1, 'img/items/item1.jpg', 1),
(21, 3, 'Cassette', 'Lo mejor de…', 'Leño', 1990, 1, 2, 'img/items/item2.jpg', 1),
(22, 1, 'Vinyl', 'The very best of', 'Enya', 2009, 9, 0, 'img/items/item3.jpg', 1),
(23, 2, 'Vinyl', 'Rumours', 'Fleetwood Mac', 1977, 1, 1, 'img/items/item4.jpg', 1),
(24, 4, 'Vinyl', 'Chariots of fire', 'Vangelis', 1981, 11, 1, 'img/items/item5.jpg', 1),
(25, 1, 'CD', 'Kvelertak', 'Kvelertak', 2010, 7, 0, 'img/items/item6.jpg', 1),
(26, 9, 'CD', '19 días y 500 noches', 'Joaquín Sabina', 1990, 10, 2, 'img/items/item7.jpg', 1),
(27, 10, 'CD', 'De vuelta y vuelta', 'Jarabe de Palo', 2001, 1, 1, 'img/items/item8.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `provinceID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `regionID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`provinceID`, `name`, `regionID`) VALUES
(1, 'Araba/Álava', 0),
(2, 'Albacete', 1),
(3, 'Alicante/Alacant', 2),
(4, 'Almeria', 3),
(5, 'Ávila', 4),
(6, 'Badajoz', 5),
(7, 'Balears(Illes)', 6),
(8, 'Barcelona', 7),
(9, 'Burgos', 4),
(10, 'Cáceres', 5),
(11, 'Cádiz', 3),
(12, 'Castellón/Castelló', 2),
(13, 'Ciudad Real', 1),
(14, 'Córdoba', 3),
(15, 'Coruña (A)', 8),
(16, 'Cuenca', 1),
(17, 'Girona', 7),
(18, 'Granada', 3),
(19, 'Guadalajara', 1),
(20, 'Gipuzkoa', 0),
(21, 'Huelva', 3),
(22, 'Huesca', 9),
(23, 'Jaén', 3),
(24, 'León', 4),
(25, 'Lleida', 7),
(26, 'Rioja (La)', 10),
(27, 'Lugo', 8),
(28, 'Madrid', 11),
(29, 'Malaga', 3),
(30, 'Murcia', 12),
(31, 'Navarra', 13),
(32, 'Ourense', 8),
(33, 'Asturias', 14),
(34, 'Palencia', 4),
(35, 'Palmas (Las)', 15),
(42, 'Pontevedra', 8),
(43, 'Salamanca', 4),
(44, 'Santa Cruz de Tenerife', 15),
(45, 'Cantabria', 16),
(46, 'Segovia', 4),
(47, 'Sevilla', 3),
(48, 'Soria', 4),
(49, 'Tarragona', 7),
(50, 'Teruel', 9),
(51, 'Toledo', 1),
(52, 'Valencia/València', 2),
(53, 'Valladolid', 4),
(54, 'Bizkaia', 0),
(55, 'Zamora', 4),
(56, 'Zaragoza', 9),
(57, 'Ceuta', 17),
(58, 'Melilla', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `regionID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `regions`
--

INSERT INTO `regions` (`regionID`, `name`) VALUES
(0, 'País Vasco'),
(1, 'Castilla-La Mancha'),
(2, 'Comunitat Valenciana'),
(3, 'Andalucía'),
(4, 'Castilla y León'),
(5, 'Extremadura'),
(6, 'Balears (Illes)'),
(7, 'Cataluña'),
(8, 'Galicia'),
(9, 'Aragón'),
(10, 'Rioja (La)'),
(11, 'Madrid (Comunidad de)'),
(12, 'Murcia (Región de)'),
(13, 'Navarra (Comunidad Foral de)'),
(14, 'Asturias (Principado de)'),
(15, 'Canarias'),
(16, 'Cantabria'),
(17, 'Ceuta (Ciudad de)'),
(18, 'Melilla (Ciudad de)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `swaps`
--

CREATE TABLE IF NOT EXISTS `swaps` (
  `swapID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `finishDate` date NOT NULL,
  `success` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL,
  `userType` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `registerDate` date NOT NULL,
  `unsubscribeDate` date NOT NULL,
  `image` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `provinceID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userID`, `userType`, `userName`, `password`, `email`, `registerDate`, `unsubscribeDate`, `image`, `provinceID`) VALUES
(1, 0, 'irene', 'a11900e7a864e78aa0e5982debdf3078', 'ireneblancofabregat@gmail.com', '2015-05-04', '0000-00-00', 'img/users/irene.jpg', 7),
(2, 0, 'juan', '640f03b862944def762b9c7153124388', 'juanmf1894@gmail.com', '2015-05-04', '0000-00-00', 'img/users/juan.png', 7),
(4, 0, 'admin', '62f04a011fbb80030bb0a13701c20b41', 'admin@gmail.com', '2015-05-04', '0000-00-00', 'img/users/admin.jpg', 27),
(5, 1, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user1@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user1.jpg', 7),
(6, 1, 'user2', '7e58d63b60197ceb55a1c487989a3720', 'user2@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user2.jpg', 18),
(7, 1, 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 'user3@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user3.jpg', 9),
(8, 1, 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'user4@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user4.jpg', 5),
(9, 1, 'user5', '0a791842f52a0acfbb3a783378c066b8', 'user5@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user5.jpg', 23),
(10, 1, 'user6', 'affec3b64cf90492377a8114c86fc093', 'user6@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user6.jpg', 10),
(11, 1, 'user7', '3e0469fb134991f8f75a2760e409c6ed', 'user7@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user7.jpg', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warnings`
--

CREATE TABLE IF NOT EXISTS `warnings` (
  `warningID` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warnings_users`
--

CREATE TABLE IF NOT EXISTS `warnings_users` (
  `userID` int(11) NOT NULL,
  `warningID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`userID`,`swapID`), ADD KEY `userID` (`userID`), ADD KEY `swapID` (`swapID`), ADD KEY `itemID` (`itemID`);

--
-- Indices de la tabla `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bidID`);

--
-- Indices de la tabla `bids_participation`
--
ALTER TABLE `bids_participation`
  ADD PRIMARY KEY (`userID`,`bidID`), ADD KEY `userID` (`userID`), ADD KEY `bidID` (`bidID`);

--
-- Indices de la tabla `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`conditionID`);

--
-- Indices de la tabla `direct_message`
--
ALTER TABLE `direct_message`
  ADD PRIMARY KEY (`messageID`), ADD KEY `swapID` (`swapID`);

--
-- Indices de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`evaluationID`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`);

--
-- Indices de la tabla `events_assistance`
--
ALTER TABLE `events_assistance`
  ADD PRIMARY KEY (`userID`,`eventID`), ADD KEY `userID` (`userID`), ADD KEY `eventID` (`eventID`);

--
-- Indices de la tabla `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`userID`,`friendID`), ADD KEY `friendID` (`friendID`), ADD KEY `userID` (`userID`);

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreID`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`), ADD KEY `userID` (`userID`);

--
-- Indices de la tabla `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`), ADD KEY `regionID` (`regionID`);

--
-- Indices de la tabla `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`regionID`);

--
-- Indices de la tabla `swaps`
--
ALTER TABLE `swaps`
  ADD PRIMARY KEY (`swapID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`), ADD KEY `provinceID` (`provinceID`);

--
-- Indices de la tabla `warnings`
--
ALTER TABLE `warnings`
  ADD PRIMARY KEY (`warningID`);

--
-- Indices de la tabla `warnings_users`
--
ALTER TABLE `warnings_users`
  ADD PRIMARY KEY (`userID`,`warningID`), ADD KEY `userID` (`userID`), ADD KEY `warningID` (`warningID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bids`
--
ALTER TABLE `bids`
  MODIFY `bidID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `conditions`
--
ALTER TABLE `conditions`
  MODIFY `conditionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `direct_message`
--
ALTER TABLE `direct_message`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `evaluationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `genres`
--
ALTER TABLE `genres`
  MODIFY `genreID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `regions`
--
ALTER TABLE `regions`
  MODIFY `regionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `swaps`
--
ALTER TABLE `swaps`
  MODIFY `swapID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `warnings`
--
ALTER TABLE `warnings`
  MODIFY `warningID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
