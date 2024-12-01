-- phpMyAdmin SQL Dump
-- version 5.2.1-5.fc41
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-12-2024 a las 00:38:06
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sanatorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `estado` enum('leido','pendiente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `email`, `comentario`, `fecha_creacion`, `estado`) VALUES
(1, 'horacio.alejandro.piccolo@gmail.com', 'test', '2024-11-27 20:53:28', 'pendiente'),
(2, 'horacio.alejandro.piccolo@gmail.com', 'test2', '2024-11-27 20:56:07', 'pendiente'),
(3, 'horacio.alejandro.piccolo@gmail.com', 'test3', '2024-11-27 20:57:40', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `nombre_especialidad` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre_especialidad`) VALUES
(1, 'Cirugia general'),
(6, 'Clinico'),
(5, 'Ecografia'),
(2, 'Laboratorio'),
(4, 'Pediatria'),
(3, 'Radiologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

CREATE TABLE `profesionales` (
  `id_dni` int(11) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `dias_laborales` set('lunes','martes','miercoles','jueves','viernes') DEFAULT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_turno` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_profesional` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `estado` enum('agendado','confirmado','cancelado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_dni` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `tipo_usuario` enum('paciente','profesional') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_dni`, `nombre`, `apellido`, `contrasenia`, `tipo_usuario`) VALUES
(32405036, 'Horacio Alejandro', 'Piccolo', '$2y$10$ITU4gnVX4KsrYAQKSqSfm.S/TufrQszZgiYlKj5vt2DUiSmhWKFHG', 'profesional'),
(54468644, 'Francesco', 'Piccolo', '$2y$10$eYyFMfW81gEbe8CJlQQQ5eSSl9K0IiHi9ZBXbhKa5kbIfPbLdbxee', 'paciente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`),
  ADD KEY `nombre_especialidad` (`nombre_especialidad`);

--
-- Indices de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`id_dni`),
  ADD KEY `especialidad` (`especialidad`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_turno`),
  ADD KEY `fk_usuario` (`id_usuario`),
  ADD KEY `fk_profesional` (`id_profesional`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD CONSTRAINT `profesionales_ibfk_1` FOREIGN KEY (`id_dni`) REFERENCES `usuarios` (`id_dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesionales_ibfk_2` FOREIGN KEY (`especialidad`) REFERENCES `especialidades` (`nombre_especialidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `fk_profesional` FOREIGN KEY (`id_profesional`) REFERENCES `usuarios` (`id_dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_dni`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
