-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-02-2019 a las 17:37:07
-- Versión del servidor: 10.1.38-MariaDB-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `futbol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(12) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(1, 'Madrid'),
(2, 'Manchester'),
(3, 'Buenos Aires');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE `entrenador` (
  `id` int(12) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrenador`
--

INSERT INTO `entrenador` (`id`, `nombre`) VALUES
(1, 'Santiago Solari'),
(2, 'Diego Simeone'),
(3, 'Gustavo Alfaro'),
(4, 'Marcelo Gallardo'),
(5, 'Ole Gunnar Solskjær'),
(6, 'Pep Guardiola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(12) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_ciudad` int(12) NOT NULL,
  `id_entrenador` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `id_ciudad`, `id_entrenador`) VALUES
(1, 'Atlético de Madrid', 1, 2),
(2, 'Real Madrid', 1, 1),
(3, 'Manchester United', 2, 5),
(4, 'Manchester City', 2, 6),
(5, 'Boca Juniors', 3, 3),
(6, 'River Plate', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `posicion` varchar(255) NOT NULL,
  `id_equipo` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`id`, `nombre`, `posicion`, `id_equipo`) VALUES
(4, 'Antoine Griezmann', 'Delantero', 1),
(5, 'Álvaro Morata', 'Delantero', 1),
(6, 'Diego Godín', 'Defensa', 1),
(7, 'Sergio Ramos', 'Defensa', 2),
(8, 'Karim Benzema', 'Delantero', 2),
(9, 'Marcelo Vieira', 'Lateral', 2),
(10, 'Alexis Sánchez', 'Delantero', 3),
(11, 'David De Gea', 'Arquero', 3),
(12, 'Romelu Lukaku', 'Delantero', 3),
(13, 'Sergio Agüero', 'Delantero', 4),
(14, 'Kevin De Bruyne', 'Mediocampista', 4),
(15, 'Leroy Sané', 'Delantero', 4),
(17, 'Dario Benedetto', 'Delantero', 5),
(18, 'Cristian Pavón', 'Delantero', 5),
(19, 'Exequiel Palacios', 'Mediocampista', 6),
(20, 'Lucas Pratto', 'Delantero', 6),
(21, 'Enzo Pérez', 'Mediocampista', 6),
(26, 'Diego Costa', 'Delantero', 1),
(28, 'Juan Román Riquelme', 'Delantero', 5),
(29, 'David Silva', 'Mediocampista', 4),
(31, 'Dixon Ortiz', 'Delantero', 3),
(32, 'efsdfsdf', 'Delantero', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ciudad` (`id_ciudad`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipo` (`id_equipo`),
  ADD KEY `id_equipo_2` (`id_equipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenador` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
