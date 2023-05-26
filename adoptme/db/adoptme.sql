-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: host.docker.internal:3306
-- Tiempo de generación: 26-05-2023 a las 19:39:04
-- Versión del servidor: 10.11.3-MariaDB-1:10.11.3+maria~ubu2204
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adoptme`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES
(2, 'antonio', 'fwsfewewwe', 'fsfsfsdf@gmail.com'),
(3, 'fran', 'fran1234', 'primoscabrera06@gmail.com'),
(4, 'antonio', 'fran1234', 'antonio3@gmail.com'),
(5, 'Manuel', '12345678', 'manuel@gmail.com'),
(6, 'Juan', '12345678', 'juan@gmail.com'),
(7, 'Juanito', '12345678', 'juanito@gmail.com'),
(8, 'Pablo', '12345678', 'pablo@gmail.com'),
(9, 'sebas', 'sebas', 'sebas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sexo` enum('M','H') DEFAULT 'M',
  `color` varchar(50) DEFAULT '-',
  `tamano` enum('P','M','G') DEFAULT 'P',
  `peso` tinyint(3) UNSIGNED DEFAULT 0,
  `provincia` varchar(100) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id`, `nombre`, `sexo`, `color`, `tamano`, `peso`, `provincia`) VALUES
(1, 'Ricky', 'M', 'Rojo', 'M', 15, 'Córdoba'),
(2, 'Kira', 'H', 'Rosa', 'M', 35, 'Huelva'),
(3, 'Lulu', 'H', 'Blanco', 'P', 15, 'Teruel'),
(6, 'Nube', 'M', 'Blanco', 'P', 6, 'Málaga'),
(10, 'Kleiner', 'M', 'Blanco', 'P', 12, 'Cadiz');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
