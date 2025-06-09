-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 04:00:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `si_jubi_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `asunto` varchar(250) DEFAULT NULL,
  `estado` set('Pendiente','En proceso','Aprobado','Rechazada') DEFAULT NULL,
  `empleado_solicitud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `name`, `asunto`, `estado`, `empleado_solicitud`) VALUES
(1, 'Samuel Rosales', 'me quiero jubilar compa, deje jubilarme por favorme quiero jubilar compa, deje jubilarme por favor\r\nme quiero jubilar compa, deje jubilarme por favor\r\nme quiero jubilar compa, deje jubilarme por favor\r\nme quiero jubilar compa, deje jubilarme por favo', 'Pendiente', 31350493),
(3, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'En proceso', 31111417);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `CI` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `genero` set('masculino','femenino') DEFAULT NULL,
  `departamento` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`CI`, `name`, `lastname`, `password`, `rol`, `fecha_ingreso`, `edad`, `genero`, `departamento`) VALUES
(31350493, 'Samuel ', 'Rosales', 'arisita123', 'administrador', '2001-06-17', 25, 'masculino', 'Indefinido'),
(31111417, 'Marcos ', 'Castellanos', '123', 'empleado', '1999-06-11', 36, 'masculino', 'indefinido');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_solicitud` (`empleado_solicitud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `CI` (`CI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`empleado_solicitud`) REFERENCES `usuarios` (`CI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
