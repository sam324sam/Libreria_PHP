-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2025 a las 20:35:06
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
(5, 'Curso de PHP', 'John Doe', '2023-09-15', 6, 'Curso en video sobre PHP', 'Programación', 'multimedia', NULL, NULL, 'DVD'),
(6, 'Don Quijote de la Mancha', 'Miguel de Cervantes', '1605-01-16', 2, 'Novela clásica de la literatura española', 'Literatura', 'libro', 863, NULL, NULL),
(7, 'Crónica de una muerte anunciada', 'Gabriel García Márquez', '1981-03-10', 3, 'Novela de realismo mágico', 'Literatura', 'libro', 144, NULL, NULL),
(8, 'El origen de las especies', 'Charles Darwin', '1859-11-24', 2, 'Libro sobre la evolución de las especies', 'Ciencia', 'libro', 502, NULL, NULL),
(9, 'Cálculo: Trascendentes tempranas', 'James Stewart', '2015-02-01', 3, 'Libro de cálculo universitario', 'Matemáticas', 'libro', 1350, NULL, NULL);

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
(1, 1, 'Estante A1', 1),
(2, 1, 'Estante A2', 1),
(3, 2, 'Estante B1', 1),
(4, 3, 'Estante C1', 0),
(5, 4, 'Estante D1', 0),
(6, 5, 'Estante E1', 0),
(7, 1, 'Mi casa', 1),
(8, 6, 'Estante A3', 0),
(9, 6, 'Estante A4', 0),
(10, 7, 'Estante B2', 1),
(11, 7, 'Estante B3', 0),
(12, 7, 'Estante B4', 0),
(13, 8, 'Estante C2', 0),
(14, 8, 'Estante C3', 1),
(15, 9, 'Estante D1', 0);

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
(11, 4, 3, '2025-03-10 17:46:32', '2025-03-31 17:46:32'),
(12, 4, 1, '2025-03-10 17:48:26', '2025-03-31 17:48:26'),
(13, 4, 7, '2025-03-10 18:02:11', '2025-03-31 18:02:11'),
(14, 4, 2, '2025-03-10 18:02:55', '2025-03-31 18:02:55'),
(15, 4, 1, '2025-03-10 18:05:29', '2025-03-31 18:05:29');

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
(3, 'Carlos Sánchez', 'Plaza 789', 567890123, 3, 'carlos@example.com', 'qwerty'),
(4, 'admin', 'Calle admin', 1234567, 1, 'admin@domenico.es', '1234');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `prestar`
--
ALTER TABLE `prestar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
