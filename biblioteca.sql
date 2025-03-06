-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2025 a las 19:52:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `lista_autores` varchar(100) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `num_ejemplares` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `materia` varchar(25) NOT NULL,
  `tipo` enum('libro','revista','multimedia') NOT NULL,
  `num_paginas` int(11) DEFAULT NULL,
  `frecuencia` int(11) DEFAULT NULL,
  `soporte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `titulo`, `lista_autores`, `fecha_publicacion`, `num_ejemplares`, `descripcion`, `materia`, `tipo`, `num_paginas`, `frecuencia`, `soporte`) VALUES
(1, 'El principito', 'Antoine de Saint-Exupéry', '1943-04-06', 5, 'Un cuento filosófico', 'Filosofía', 'libro', 96, NULL, NULL),
(2, '1984', 'George Orwell', '1949-06-08', 3, 'Novela distópica', 'Ciencia Ficción', 'libro', 328, NULL, NULL),
(3, 'Cien años de soledad', 'Gabriel García Márquez', '1967-05-30', 2, 'Realismo mágico', 'Literatura', 'libro', 417, NULL, NULL),
(4, 'National Geographic', 'Varios', '2024-01-01', 4, 'Revista científica', 'Ciencia', 'revista', NULL, 12, NULL),
(5, 'Curso de PHP', 'John Doe', '2023-09-15', 6, 'Curso en video sobre PHP', 'Programación', 'multimedia', NULL, NULL, 'DVD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar`
--

CREATE TABLE `ejemplar` (
  `id` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `localizacion` varchar(50) NOT NULL,
  `prestado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ejemplar`
--

INSERT INTO `ejemplar` (`id`, `id_documento`, `localizacion`, `prestado`) VALUES
(1, 1, 'Estante A1', 0),
(2, 1, 'Estante A2', 1),
(3, 2, 'Estante B1', 0),
(4, 3, 'Estante C1', 1),
(5, 4, 'Estante D1', 0),
(6, 5, 'Estante E1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestar`
--

CREATE TABLE `prestar` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_ejemplar` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestar`
--

INSERT INTO `prestar` (`id`, `id_usuario`, `id_ejemplar`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 1, 1, '2025-03-01 10:00:00', '2025-03-22 10:00:00'),
(2, 2, 3, '2025-03-02 11:00:00', '2025-03-23 11:00:00'),
(3, 3, 4, '2025-03-03 12:00:00', '2025-03-24 12:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `direccion`, `telefono`, `curso`, `email`, `clave`) VALUES
(1, 'Juan Pérez', 'Calle 123', 123456789, 1, 'juan@example.com', '1234'),
(2, 'María López', 'Avenida 456', 987654321, 2, 'maria@example.com', 'abcdef'),
(3, 'Carlos Sánchez', 'Plaza 789', 567890123, 3, 'carlos@example.com', 'qwerty');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ejemplar_documento` (`id_documento`);

--
-- Indices de la tabla `prestar`
--
ALTER TABLE `prestar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prestar_usuario` (`id_usuario`),
  ADD KEY `fk_prestar_ejemplar` (`id_ejemplar`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestar`
--
ALTER TABLE `prestar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD CONSTRAINT `fk_ejemplar_documento` FOREIGN KEY (`id_documento`) REFERENCES `documento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestar`
--
ALTER TABLE `prestar`
  ADD CONSTRAINT `fk_prestar_ejemplar` FOREIGN KEY (`id_ejemplar`) REFERENCES `ejemplar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prestar_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
