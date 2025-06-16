-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 03:23:02
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
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(225) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `instructor` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `descripcion`, `imagen`, `instructor`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 'PHP Avanzado', 'Profundiza en PDO, OOP y patrones de diseño.', '../src/img/cursos/img-1.jpg', 'Juan Pérez', '2025-06-15', '2025-06-12 13:59:07', '2025-06-14 14:46:28'),
(2, 'MySQL Desde Cero', 'Optimización de consultas, índices y seguridad.', '../src/img/cursos/img-1.jpg', 'María Gómez', '2025-07-01', '2025-06-12 13:59:07', '2025-06-14 14:59:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `asunto` varchar(250) DEFAULT NULL,
  `estado` set('Pendiente','En proceso','Aprobado','Rechazada') DEFAULT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `empleado_solicitud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `name`, `asunto`, `estado`, `fecha_creacion`, `empleado_solicitud`) VALUES
(8, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(9, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(10, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(11, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(12, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(13, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(14, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(15, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(16, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(17, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(18, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(19, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(20, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(21, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(22, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(23, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(24, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(25, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(26, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(27, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(28, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(29, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(30, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(31, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(33, 'Marcos ', 'Me quiero jubilar porque ya cumpli con los años de servicio', 'Pendiente', '2025-06-14', 31111417),
(34, 'Kamila', 'Me quiero jubilar porque NI IDEA', 'Pendiente', '2025-06-14', 31926265);

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
(31350493, 'Samuel ', 'Rosales', '123', 'administrador', '2001-06-17', 25, 'masculino', 'Indefinido'),
(31111417, 'Marcos ', 'Castellanos', '123', 'empleado', '1999-06-11', 36, 'masculino', 'indefinido'),
(31366204, 'Luis', 'Rodriguez', '123', 'empleado', '2005-12-02', 19, 'masculino', 'Mantenimiento Técnico'),
(31926265, 'Kamila', 'Alvarado', '123', 'empleado', '2007-01-17', 18, 'femenino', 'Relaciones Laborales');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
