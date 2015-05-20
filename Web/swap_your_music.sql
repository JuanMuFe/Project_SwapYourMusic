-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2015 a las 14:23:00
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
  `itemID` int(11) NOT NULL,
  `startPrice` decimal(4,2) NOT NULL,
  `actualPrice` decimal(4,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `finishDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `bids`
--

INSERT INTO `bids` (`bidID`, `itemID`, `startPrice`, `actualPrice`, `duration`, `startDate`, `finishDate`) VALUES
(3, 21, '0.30', '0.70', 4, '2015-05-12', NULL),
(6, 19, '0.50', '0.50', 6, '2015-05-12', '2015-05-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bids_participation`
--

CREATE TABLE IF NOT EXISTS `bids_participation` (
  `userID` int(11) NOT NULL,
  `bidID` int(11) NOT NULL,
  `offeredMoney` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `bids_participation`
--

INSERT INTO `bids_participation` (`userID`, `bidID`, `offeredMoney`) VALUES
(6, 3, '0.60'),
(8, 3, '0.70');

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
  `content` text COLLATE utf8_spanish2_ci NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0'
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
(0, 'Pop'),
(1, 'Rock'),
(2, 'Hip-Hop'),
(3, 'Jazz-Blues'),
(4, 'Classical'),
(5, 'Childrens music'),
(6, 'Opera'),
(7, 'Heavy metal'),
(8, 'Country'),
(9, 'New age'),
(10, 'Singer-songwriter'),
(11, 'Electronic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bidID` int(11) DEFAULT NULL,
  `itemType` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `artist` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `releaseYear` int(11) NOT NULL,
  `genreID` int(2) NOT NULL,
  `conditionID` int(2) NOT NULL,
  `image` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `available` int(11) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`itemID`, `userID`, `bidID`, `itemType`, `title`, `artist`, `releaseYear`, `genreID`, `conditionID`, `image`, `available`, `uploadDate`) VALUES
(19, 5, 6, 'Cassette', 'Veneno en la piel', 'Radio Futura', 1990, 1, 2, 'img/items/item0.jpg', 1, '2015-05-13 09:59:06'),
(20, 6, NULL, 'Cassette', 'No es pecado', 'Alaska y Dinarama', 1986, 1, 1, 'img/items/item1.jpg', 1, '2015-05-19 12:39:10'),
(21, 5, 3, 'Cassette', 'Lo mejor de…', 'Leño', 1990, 1, 2, 'img/items/item2.jpg', 1, '2015-05-13 09:57:40'),
(22, 8, NULL, 'Vinyl', 'The very best of', 'Enya', 2009, 9, 1, 'img/items/item3.jpg', 1, '2015-05-19 12:39:18'),
(23, 9, NULL, 'Vinyl', 'Rumours', 'Fleetwood Mac', 1977, 1, 1, 'img/items/item4.jpg', 1, '2015-05-19 12:39:22'),
(24, 7, NULL, 'Vinyl', 'Chariots of fire', 'Vangelis', 1981, 11, 1, 'img/items/item5.jpg', 1, '2015-05-19 12:39:56'),
(25, 10, NULL, 'CD', 'Kvelertak', 'Kvelertak', 2010, 7, 2, 'img/items/item6.jpg', 1, '2015-05-19 12:39:26'),
(27, 10, 0, 'CD', 'De vuelta y vuelta', 'Jarabe de Palo', 2001, 1, 1, 'img/items/item8.jpg', 1, '2015-05-11 11:37:54'),
(31, 11, NULL, 'CD', 'Andy Warhol', 'Andy', 2051, 3, 2, 'img/items/AndyWarhol9.jpg', 1, '2015-05-12 08:57:05'),
(62, 9, NULL, 'Cassete', 'Furia', 'AC/DC', 1998, 0, 0, 'img/items/Furia9.jpg', 1, '2015-05-07 08:40:32'),
(63, 9, NULL, 'Cassete', 'Juan', 'Juan', 2015, 4, 2, 'img/items/Juan9.jpg', 1, '2015-05-09 22:37:22'),
(103, 11, NULL, 'CD', 'Endangered Species', 'Big Pun', 2015, 2, 2, 'img/items/EndangeredSpecies9.jpg', 1, '2015-05-12 08:58:31'),
(104, 11, NULL, 'Vinyl', 'Júñçaïn', 'Juan', 2015, 3, 0, 'img/items/juncain11.jpg', 1, '2015-05-12 13:22:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userID`, `userType`, `userName`, `password`, `email`, `registerDate`, `unsubscribeDate`, `image`, `provinceID`) VALUES
(1, 0, 'irene', 'a11900e7a864e78aa0e5982debdf3078', 'ireneblancofabregat@gmail.com', '2015-05-04', '0000-00-00', 'img/users/irene.jpg', 7),
(2, 0, 'juan', '640f03b862944def762b9c7153124388', 'juanmf1894@gmail.com', '2015-05-04', '0000-00-00', 'img/users/juan.jpg', 7),
(4, 0, 'admin', '62f04a011fbb80030bb0a13701c20b41', 'admin@gmail.com', '2015-05-04', '0000-00-00', 'img/users/admin.jpg', 27),
(5, 1, 'Roberto', 'a3e05197fe322842fd86207db9e0040d', 'user1@gmail.com', '2015-05-04', '0000-00-00', 'img/users/Roberto.png', 7),
(6, 1, 'Juana', '6ecf8922b47157c32daa0c36430d00e6', 'user2@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user2.png', 35),
(7, 1, 'Paco', 'b0ccb9315cedd35de6e52571fd99a86f', 'user3@gmail.com', '2015-05-04', '2015-05-07', 'img/users/user3.png', 9),
(8, 1, 'Sara', '69a5b3d9c31e8554e9f588d884371faa', 'user4@gmail.com', '2015-05-04', '2015-05-08', 'img/users/Sara.png', 17),
(9, 1, 'Marcos', 'c5e3539121c4944f2bbe097b425ee774', 'user5@gmail.com', '2015-05-04', '0000-00-00', 'img/users/user5.png', 28),
(10, 1, 'Carla', '8495ea21c436e051a2a7878bfb1b7992', 'user6@gmail.com', '2015-05-04', '2015-05-08', 'img/users/Carla.png', 28),
(11, 1, 'Pepa', '3e0469fb134991f8f75a2760e409c6ed', 'user7@gmail.com', '2015-05-04', '0000-00-00', 'img/users/Pepa.png', 12),
(14, 1, 'Jordi', '14e1b600b1fd579f47433b88e8d85291', 'jordipm@gmail.com', '2015-05-06', '0000-00-00', 'img/users/jordi.png', 8),
(15, 1, 'Lydia', 'e10adc3949ba59abbe56e057f20f883e', 'lydia@gmail.com', '2015-05-11', '0000-00-00', 'img/users/Lydia.png', 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warnings`
--

CREATE TABLE IF NOT EXISTS `warnings` (
  `warningID` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `warnings`
--

INSERT INTO `warnings` (`warningID`, `description`, `active`) VALUES
(1, 'Remember to cancel all exchanges that don''t interest you anymore!', 1),
(2, 'You tried to upload an item that violates the term conditions.', 1),
(3, 'Hey!  You have too much negative evaluations. If it lasts your account will be deleted soon.', 1),
(7, 'Your account will be deleted in 3 days.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warnings_users`
--

CREATE TABLE IF NOT EXISTS `warnings_users` (
  `userID` int(11) NOT NULL,
  `warningID` int(11) NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `warnings_users`
--

INSERT INTO `warnings_users` (`userID`, `warningID`, `read`) VALUES
(5, 2, 0),
(6, 3, 0),
(8, 2, 0),
(14, 3, 0),
(15, 3, 0);

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
  ADD PRIMARY KEY (`bidID`), ADD KEY `itemID` (`itemID`);

--
-- Indices de la tabla `bids_participation`
--
ALTER TABLE `bids_participation`
  ADD PRIMARY KEY (`userID`,`bidID`), ADD KEY `userID` (`userID`), ADD KEY `bidID` (`bidID`), ADD KEY `bidID_2` (`bidID`), ADD KEY `userID_2` (`userID`);

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
  ADD PRIMARY KEY (`itemID`), ADD KEY `userID` (`userID`), ADD KEY `userID_2` (`userID`);

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
  MODIFY `bidID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
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
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
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
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `warnings`
--
ALTER TABLE `warnings`
  MODIFY `warningID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bids_participation`
--
ALTER TABLE `bids_participation`
ADD CONSTRAINT `bids_participation_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
ADD CONSTRAINT `bids_participation_ibfk_2` FOREIGN KEY (`bidID`) REFERENCES `bids` (`bidID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
