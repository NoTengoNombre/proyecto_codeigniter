-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2017 a las 17:12:30
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ciproyecto2`
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
(0, 'archivo nuevo', 28),
(1, 'archivo nuevo', 30),
(2, 'archivo nuevo', 29),
(4, 'archivo nuevo', 31),
(5, 'archivo nuevo', 32),
(6, 'archivo nuevo', 33),
(7, 'archivo nuevo', 34),
(8, 'archivo nuevo', 35),
(9, 'archivo nuevo', 36),
(9, 'archivo nuevo', 37),
(10, 'archivo nuevo', 38),
(10, 'archivo nuevo', 39),
(11, 'archivo nuevo', 40);

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
(28, 'Druida4.pdf', '0000-00-00 00:00:00', 'notas del documento', 1, 1, '0000-00-00 00:00:00'),
(29, 'Druida5.pdf', '0000-00-00 00:00:00', 'notas del documento', 1, 1, '0000-00-00 00:00:00'),
(30, 'Druida6.pdf', '0000-00-00 00:00:00', 'notas del documento', 1, 2, '0000-00-00 00:00:00'),
(31, 'cv_alberto2.pdf', '0000-00-00 00:00:00', 'notas del documento', 1, 1, '0000-00-00 00:00:00'),
(32, 'cv_alberto3.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(33, 'cv_alberto4.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(34, 'cv_alberto5.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(35, 'cv_alberto6.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(36, 'cv_alberto7.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(37, 'CV6.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(38, 'CV7.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(39, 'cv_alberto8.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '0000-00-00 00:00:00'),
(40, 'cv_alberto9.pdf', '0000-00-00 00:00:00', 'notas del documento', 0, 1, '24/05/2017'),
(41, 'Luminarias_Effregy_Energía.pdf', '', 'Escribe alguna nota...', 0, 1, '03/06/2017'),
(42, 'Luminarias_Effregy_Energía1.pdf', '', 'Escribe alguna nota...', 0, 1, '03/06/2017'),
(43, 'Luminarias_Effregy_Energía2.pdf', '', 'Escribe alguna nota...', 0, 1, '03/06/2017'),
(44, 'Luminarias_Effregy_Energía3.pdf', '', 'Escribe alguna nota...', 0, 1, '03/06/2017'),
(45, 'Luminarias_Effregy_Energía4.pdf', '', 'Escribe alguna nota...', 0, 1, '03/06/2017'),
(46, 'Luminarias_Effregy_Energía5.pdf', '', 'Escribe alguna nota...', 0, 1, '03/06/2017'),
(47, 'Luminarias_Effregy_Energía7.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017'),
(48, 'Luminarias_Effregy_Energía8.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017'),
(49, 'Luminarias_Effregy_Energía9.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017'),
(50, 'Luminarias_Effregy_Energía10.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017'),
(51, 'Luminarias_Effregy_Energía11.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017'),
(52, 'Luminarias_Effregy_Energía12.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017'),
(53, 'Luminarias_Effregy_Energía13.pdf', '', 'Escribe alguna nota...', 0, 1, '04/06/2017');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fotografia` varchar(250) NOT NULL,
  `telefono` int(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellidos`, `password`, `fotografia`, `telefono`, `email`, `tipo`) VALUES
(1, 'u', 'u', 'u', 'foto2', 950123456, 'grand@gmail.com', 1),
(2, 'a', 'a', 'a', 'foto1', 950123456, 'aa@gmail.com', 0),
(3, 'z', 'a2', 'a', 'foto3', 956123456, 'zaa@gmail.com', 1),
(4, 'cat', 'dog', 'a', 'foto4', 950123456, 'gran@gmail.com', 0),
(6, 'gato1z', 'perro1zx', 'a', 'foto6', 950123456, 'grandz@gmail.com', 0),
(8, 'juan', 'perico', '1234', 'jauna@gmail.xom', 600123456, 'fotografia_por_defecto', 0),
(10, 'goku', 'saiyan', '1234', 'gk@gmail.com', 662123456, 'fotografia_por_defecto', 1),
(13, 'aaaa', 'aaaa', 'aaaa', 'aaaa', 0, 'fotografia_por_defecto', 0);

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
  MODIFY `documento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
