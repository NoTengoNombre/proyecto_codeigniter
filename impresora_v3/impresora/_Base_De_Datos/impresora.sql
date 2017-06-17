-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2017 a las 20:22:02
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `impresora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL,
  `nombre_archivo` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`id_archivo`, `nombre_archivo`, `id_documento`) VALUES
(1, 'archivo nuevo', 30),
(4, 'archivo nuevo', 31),
(5, 'archivo nuevo', 32),
(6, 'archivo nuevo', 33),
(7, 'archivo nuevo', 34),
(8, 'archivo nuevo', 35),
(9, 'archivo nuevo', 36),
(9, 'archivo nuevo', 37),
(10, 'archivo nuevo', 38),
(12, 'Prueba 1', 54),
(13, 'Prueba2', 55),
(14, 'Prueba2', 56),
(15, 'otro archivo', 57),
(16, 'otro archivo', 58),
(17, 'otro archivo', 59),
(18, 'te', 60),
(19, 'te', 61),
(20, 'te', 62),
(21, 'te', 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `documento_id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_impresion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `notas` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(5) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_creacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`documento_id`, `titulo`, `fecha_impresion`, `notas`, `estado`, `usuario_id`, `fecha_creacion`) VALUES
(30, 'Druida6.pdf', '0000-00-00 00:00:00', 'notas del documento', 1, 2, '0000-00-00 00:00:00'),
(54, 'pdf_subir_proyecto.pdf', '17/06/2017', 'Esto es una prueba', 1, 4, '15/06/2017'),
(55, 'pdf_subir_proyecto1.pdf', 'Sin Imprimir', 'Subir otro archivo', 0, 4, '15/06/2017'),
(56, 'pdf_subir_proyecto2.pdf', 'Sin Imprimir', 'Subir otro archivo', 0, 4, '15/06/2017'),
(57, 'pdf_subir_proyecto3.pdf', 'Sin Imprimir', 'Otro archivo subido', 0, 4, '15/06/2017'),
(58, 'pdf_subir_proyecto4.pdf', 'Sin Imprimir', 'Otro archivo subido', 0, 4, '15/06/2017'),
(59, 'pdf_subir_proyecto5.pdf', 'Sin Imprimir', 'Otro archivo subido', 0, 4, '15/06/2017'),
(60, 'pdf_subir_proyecto1.pdf', 'Sin Imprimir', 'rere', 0, 4, '15/06/2017'),
(61, 'pdf_subir_proyecto2.pdf', 'Sin Imprimir', 'rere', 0, 4, '15/06/2017'),
(62, 'pdf_subir_proyecto3.pdf', 'Sin Imprimir', 'rere', 0, 4, '15/06/2017'),
(63, 'pdf_subir_proyecto4.pdf', 'Sin Imprimir', 'rere', 0, 4, '15/06/2017');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellidos`, `password`, `activo`, `email`, `tipo`) VALUES
(1, 'afr123', 'aref23', 'refe23', '1', 'eref23', 0),
(2, 'a', 'a', 'a', '1', 'grand@gmail.com', 0),
(4, 'u', 'u', 'u', '1', 'u', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id_archivo`,`id_documento`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`documento_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `documento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`documento_id`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
