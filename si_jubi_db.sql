-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2025 a las 12:04:35
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
(1, 'PHP Avanzado', 'Profundiza en PDO, OOP y patrones de diseño.', 'updates/curso_685ebdaa168e80.06988185.png', 'Juan Pérez', '2025-06-15', '2025-06-12 13:59:07', '2025-06-27 18:50:48'),
(2, 'MySQL Desde Cero', 'Optimización de consultas, índices y seguridad.', '../src/img/cursos/curso_6854188c2729f8.25881552.jpg', 'María Gómez', '2025-07-01', '2025-06-12 13:59:07', '2025-06-19 14:02:52'),
(3, 'MySQL Desde Cero Parte II', 'Optimización de consultas, índices y seguridad.', '../src/img/cursos/img-1.jpg', 'María Gómez', '2025-07-01', '2025-06-12 13:59:07', '2025-06-14 14:59:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interfazadmin`
--

CREATE TABLE `interfazadmin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `texto_inicio` varchar(500) NOT NULL,
  `titulo_soli_gestion` varchar(200) NOT NULL,
  `texto_soli_gestion1` varchar(500) NOT NULL,
  `texto_soli_gestion2` varchar(500) NOT NULL,
  `titulo_lista_soli` varchar(100) NOT NULL,
  `titulo_curso_gestion` varchar(200) NOT NULL,
  `texto_curso_gestion1` varchar(500) NOT NULL,
  `texto_curso_gestion2` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `interfazadmin`
--

INSERT INTO `interfazadmin` (`id`, `id_user`, `texto_inicio`, `titulo_soli_gestion`, `texto_soli_gestion1`, `texto_soli_gestion2`, `titulo_lista_soli`, `titulo_curso_gestion`, `texto_curso_gestion1`, `texto_curso_gestion2`) VALUES
(1, 1, '¿Deseas hoy modificar las opciones de cursos para los trabajadores o revisar los estados de jubilación? ¡Vamos a ponernos al día!', 'Bienvenido al Sistema de Gestión de Solicitudes', 'Este sistema permite administrar las solicitudes de jubilación, como <span class=\"highlight\">Procesar</span> el estado de los trámites y gestionar toda la documentación de manera eficiente y segura.', 'Utilice el menú lateral para navegar por las diferentes opciones disponibles. Los botones de <span class=\"highlight\">Volver</span> y <span class=\"highlight\">Cerrar Sesión</span> se encuentran fijos en la parte inferior del menú para un acceso fácil y consistente.', 'Solicitudes de Jubilación', 'Sistema de <span class=\"highlight\">Gestión de Cursos', 'Este sistema permite agregar y realizar modificaciones a los cursos anteriormente agregados para que todos los usuarios empleados del sistema tengan acceso a ellos.', 'Utilice el menú lateral para navegar por las diferentes opciones disponibles. Los botones de <span class=\"highlight\">Volver</span> y <span class=\"highlight\">Cerrar Sesión</span> se encuentran fijos en la parte inferior del menú para un acceso fácil y consistente.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interfazempleado`
--

CREATE TABLE `interfazempleado` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `texto_inicio` varchar(250) NOT NULL,
  `texto_gestion1` varchar(500) NOT NULL,
  `texto_gestion2` varchar(500) NOT NULL,
  `titulo_gestion` varchar(500) NOT NULL,
  `texto_consultar1` varchar(500) NOT NULL,
  `titulo_consultar` varchar(200) NOT NULL,
  `texto_curso` varchar(500) NOT NULL,
  `texto_soli` varchar(500) NOT NULL,
  `titulo_soli` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `interfazempleado`
--

INSERT INTO `interfazempleado` (`id`, `id_user`, `texto_inicio`, `texto_gestion1`, `texto_gestion2`, `titulo_gestion`, `texto_consultar1`, `titulo_consultar`, `texto_curso`, `texto_soli`, `titulo_soli`) VALUES
(1, 1, 'Selecciona la opción de tu preferencia y accede a una variedad de cursos para que aprendas a llevar la vida después de la jubilación o puedes solicitar tu jubilación de manera fácil y rápida.', 'Este sistema permite realizar solicitudes de jubilación, consultar el estado de sus trámites y gestionar toda la documentación requerida de manera eficiente y segura.', 'Utilice el menú lateral para navegar por las diferentes opciones disponibles. Los botones de <span class=\"highlight\">Volver</span> y <span class=\"highlight\">Cerrar Sesión</span> se encuentran fijos en la parte inferior del menú para un acceso fácil y consistente.', 'Sistema de <span class=\"highlight\">Gestión de Jubilaciones</span>', 'Aquí se muestra el estado en el que se encuentra tu solicitud de jubilación,', 'Bienvenido al apartado para consultar tu estado', 'Accede a nuestra variedad de cursos desarrollados especialmente para tí, para que apredas a lidiar con tu post-jubilación. Te ofrecemos todo tipo de cursos y que estan a tu disposicón.', 'mamalo valeria', 'Bienvenido al apartado donde podrás solicitar tu jubilación');

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
  `empleado_solicitud` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `name`, `asunto`, `estado`, `fecha_creacion`, `empleado_solicitud`, `fecha_actualizacion`) VALUES
(76, 'Luis Rodriguez', 'Me quiero jubilar porque ya cumplí con la edad.', 'Rechazada', '2025-06-27', 31366204, '2025-06-27 17:01:27'),
(77, 'Marianny Torres', 'Me quiero jubilar porque ya cumplí con la edad.', 'Aprobado', '2025-06-27', 31350497, '2025-06-27 17:01:37'),
(79, 'Valeria Rosales', 'Me quiero jubilar porque ya cumplí con la edad.', 'Aprobado', '2025-06-28', 33499456, '2025-06-28 23:42:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superusuario`
--

CREATE TABLE `superusuario` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `superusuario`
--

INSERT INTO `superusuario` (`id`, `user`, `password`, `rol`) VALUES
(1, 'samu', '123', 'superuser');

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
  `departamento` varchar(250) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`CI`, `name`, `lastname`, `password`, `rol`, `fecha_ingreso`, `edad`, `genero`, `departamento`, `telefono`, `cargo`) VALUES
(31350493, 'Samuel ', 'Rosales', '123', 'administrador', '2001-06-17', 25, 'masculino', 'Departamento de Informática', '04125120548', 'Administrativo'),
(31111417, 'Marcos ', 'Castellanos', '123', 'empleado', '1999-09-15', 36, 'masculino', 'Decanato', '04123118580', 'Obrero'),
(31366204, 'Luis', 'Rodriguez', '123', 'empleado', '2005-12-02', 60, 'masculino', 'Mantenimiento Técnico', '04125129119', 'Técnico Superior'),
(31926265, 'Kamila', 'Alvarado', '123', 'empleado', '2007-01-17', 18, 'femenino', 'Relaciones Laborales', '04125120647', 'Administrativo'),
(31350497, 'Marianny', 'Torres', '123', 'empleado', '2007-01-17', 61, 'femenino', 'Departamento de Salud', '04123118580', 'Directora de Departamento '),
(31313131, 'Victor', 'Pargas', '123', 'empleado', '2007-01-17', 20, 'masculino', 'Musica', '04123118580', 'Vocalista'),
(33499456, 'Valeria', 'Rosales', '123', 'empleado', '2016-06-15', 60, 'femenino', 'cocina 34-r', '04122205304', 'limpia plato ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `interfazadmin`
--
ALTER TABLE `interfazadmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_super` (`id_user`);

--
-- Indices de la tabla `interfazempleado`
--
ALTER TABLE `interfazempleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_super1` (`id_user`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_solicitud` (`empleado_solicitud`);

--
-- Indices de la tabla `superusuario`
--
ALTER TABLE `superusuario`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `interfazadmin`
--
ALTER TABLE `interfazadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `interfazempleado`
--
ALTER TABLE `interfazempleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `superusuario`
--
ALTER TABLE `superusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `interfazadmin`
--
ALTER TABLE `interfazadmin`
  ADD CONSTRAINT `fk_id_super` FOREIGN KEY (`id_user`) REFERENCES `superusuario` (`id`);

--
-- Filtros para la tabla `interfazempleado`
--
ALTER TABLE `interfazempleado`
  ADD CONSTRAINT `fk_id_super1` FOREIGN KEY (`id_user`) REFERENCES `superusuario` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`empleado_solicitud`) REFERENCES `usuarios` (`CI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
