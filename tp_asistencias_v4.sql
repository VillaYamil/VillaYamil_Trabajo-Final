-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-11-2024 a las 21:51:00
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_asistencias_v4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_nacimiento` text COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`) VALUES
(1, 'Valentino', 'Andrade', '35123456', '1935-12-03'),
(2, 'Lucas', 'Cedres', '34876543', '1934-08-25'),
(3, 'Facundo', 'Figun', '40123789', '1940-06-15'),
(4, 'Luca', 'Giordano', '32456789', '1932-11-02'),
(5, 'Bruno', 'Godoy', '36789123', '1936-07-14'),
(6, 'Agustin', 'Gomez', '33567890', '1933-09-20'),
(7, 'Brian', 'Gonzalez', '35678901', '1935-04-10'),
(8, 'Federico', 'Guigou Scottini', '37890123', '1937-02-12'),
(9, 'Luna', 'Marrano', '38901234', '1938-10-09'),
(10, 'Giuliana', 'Mercado Aviles', '33345678', '1933-03-25'),
(11, 'Lucila', 'Mercado Ruiz', '32567890', '1932-12-14'),
(12, 'Angel', 'Murillo', '34890123', '1934-09-05'),
(13, 'Juan', 'Nissero', '36123456', '1936-12-11'),
(14, 'Fausto', 'Parada', '35234567', '1935-01-23'),
(15, 'Ignacio', 'Piter', '32789012', '1932-06-07'),
(16, 'Tomas', 'Planchon', '40456789', '1940-05-19'),
(17, 'Elisa', 'Ronconi', '31678123', '1931-07-15'),
(18, 'Exequiel', 'Sanchez', '33234567', '1933-08-21'),
(19, 'Melina', 'Schimpf Baldo', '33789456', '1933-04-17'),
(20, 'Diego', 'Segovia', '34567890', '1934-05-06'),
(21, 'Camila', 'Sittner', '36456789', '1936-02-01'),
(24, 'Andres', 'Villa', '22847527', '19/10/2006'),
(26, 'Sofia', 'Villa', '22333444', '2006-12-18'),
(29, 'Mauri', 'bent', '22555444', '1986-07-15'),
(30, 'angel', 'bent', '45687444', '2011-07-12'),
(31, 'carmen', 'ro', '11222888', '2000-02-18'),
(32, 'Yamil', 'Villa', '42487108', '2000-04-15'),
(33, 'oslvado', 'bent', '55444222', '1785-04-16'),
(34, 'mic', 'BENT', '44555879', '1988-04-15'),
(35, 'ROQUE', 'BENT', '14555333', '1999-05-14'),
(36, 'coco', 'villa', '48566555', '2016-04-14'),
(37, 'Yamil', 'bent', '15444666', '2000-04-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int NOT NULL,
  `alumno_id` int DEFAULT NULL,
  `materia_id` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` enum('presente','ausente') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `profesor_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `alumno_id`, `materia_id`, `fecha`, `estado`, `profesor_id`) VALUES
(103, 1, 23, '2024-11-14', 'presente', NULL),
(104, 2, 23, '2024-11-14', 'presente', NULL),
(105, 3, 23, '2024-11-14', 'presente', NULL),
(106, 4, 23, '2024-11-14', '', NULL),
(107, 5, 23, '2024-11-14', '', NULL),
(108, 6, 23, '2024-11-14', '', NULL),
(109, 7, 23, '2024-11-14', '', NULL),
(110, 8, 23, '2024-11-14', '', NULL),
(111, 9, 23, '2024-11-14', '', NULL),
(112, 10, 23, '2024-11-14', '', NULL),
(113, 11, 23, '2024-11-14', '', NULL),
(114, 12, 23, '2024-11-14', '', NULL),
(115, 13, 23, '2024-11-14', '', NULL),
(116, 14, 23, '2024-11-14', '', NULL),
(117, 15, 23, '2024-11-14', '', NULL),
(118, 16, 23, '2024-11-14', '', NULL),
(119, 17, 23, '2024-11-14', '', NULL),
(120, 18, 23, '2024-11-14', '', NULL),
(121, 19, 23, '2024-11-14', '', NULL),
(122, 20, 23, '2024-11-14', '', NULL),
(123, 21, 23, '2024-11-14', '', NULL),
(124, 24, 23, '2024-11-14', '', NULL),
(125, 26, 23, '2024-11-14', '', NULL),
(126, 29, 23, '2024-11-14', '', NULL),
(127, 30, 23, '2024-11-14', '', NULL),
(128, 31, 23, '2024-11-14', '', NULL),
(129, 32, 23, '2024-11-14', '', NULL),
(130, 33, 23, '2024-11-14', '', NULL),
(131, 34, 23, '2024-11-14', '', NULL),
(132, 35, 23, '2024-11-14', '', NULL),
(133, 36, 23, '2024-11-14', 'presente', NULL),
(134, 37, 23, '2024-11-14', 'presente', NULL),
(136, 1, 1, '2024-11-14', 'presente', NULL),
(137, 2, 1, '2024-11-14', 'presente', NULL),
(138, 3, 1, '2024-11-14', '', NULL),
(139, 4, 1, '2024-11-14', 'presente', NULL),
(140, 5, 1, '2024-11-14', 'presente', NULL),
(141, 6, 1, '2024-11-14', 'presente', NULL),
(142, 7, 1, '2024-11-14', '', NULL),
(143, 8, 1, '2024-11-14', '', NULL),
(144, 9, 1, '2024-11-14', 'presente', NULL),
(145, 10, 1, '2024-11-14', '', NULL),
(146, 11, 1, '2024-11-14', 'presente', NULL),
(147, 12, 1, '2024-11-14', 'presente', NULL),
(148, 13, 1, '2024-11-14', '', NULL),
(149, 14, 1, '2024-11-14', '', NULL),
(150, 15, 1, '2024-11-14', '', NULL),
(151, 16, 1, '2024-11-14', '', NULL),
(152, 17, 1, '2024-11-14', '', NULL),
(153, 18, 1, '2024-11-14', '', NULL),
(154, 19, 1, '2024-11-14', '', NULL),
(155, 20, 1, '2024-11-14', '', NULL),
(156, 21, 1, '2024-11-14', '', NULL),
(157, 24, 1, '2024-11-14', '', NULL),
(158, 26, 1, '2024-11-14', '', NULL),
(159, 29, 1, '2024-11-14', '', NULL),
(160, 30, 1, '2024-11-14', '', NULL),
(161, 31, 1, '2024-11-14', '', NULL),
(162, 32, 1, '2024-11-14', 'presente', NULL),
(163, 33, 1, '2024-11-14', '', NULL),
(164, 34, 1, '2024-11-14', '', NULL),
(165, 35, 1, '2024-11-14', '', NULL),
(166, 36, 1, '2024-11-14', '', NULL),
(167, 37, 1, '2024-11-14', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id`, `nombre`) VALUES
(23, 'Analisis y Diseño de Sistemas 1'),
(25, 'base de datos'),
(22, 'geografia'),
(24, 'Legislacion 3'),
(1, 'programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int NOT NULL,
  `alumno_id` int NOT NULL,
  `materia_id` int NOT NULL,
  `nota1` int NOT NULL,
  `nota2` int NOT NULL,
  `nota3` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `alumno_id`, `materia_id`, `nota1`, `nota2`, `nota3`) VALUES
(5, 1, 1, 9, 9, 9),
(6, 1, 23, 6, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `nombre`, `apellido`, `dni`, `email`, `telefono`, `password`) VALUES
(1, 'Yamil', 'Villa', '42487107', 'yamil.gchu@gmail.com', '3446372465', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_materia`
--

CREATE TABLE `profesor_materia` (
  `profesor_id` int NOT NULL,
  `materia_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ram`
--

CREATE TABLE `ram` (
  `id` int NOT NULL,
  `porcentaje_asistencia_promocion` decimal(5,2) NOT NULL,
  `porcentaje_asistencia_regularizar` decimal(5,2) NOT NULL,
  `nota_promocion` decimal(3,2) NOT NULL,
  `nota_regularizar` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ram`
--

INSERT INTO `ram` (`id`, `porcentaje_asistencia_promocion`, `porcentaje_asistencia_regularizar`, `nota_promocion`, `nota_regularizar`) VALUES
(1, 70.00, 60.00, 7.00, 6.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`),
  ADD KEY `asistencia_ibfk_2` (`materia_id`),
  ADD KEY `asistencia_ibfk_1` (`alumno_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nombre` (`nombre`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `profesor_materia`
--
ALTER TABLE `profesor_materia`
  ADD PRIMARY KEY (`profesor_id`,`materia_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indices de la tabla `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_3` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);

--
-- Filtros para la tabla `profesor_materia`
--
ALTER TABLE `profesor_materia`
  ADD CONSTRAINT `profesor_materia_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`),
  ADD CONSTRAINT `profesor_materia_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
