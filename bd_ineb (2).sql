-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2022 a las 00:38:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_ineb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telpersonal` int(8) NOT NULL,
  `encargado` varchar(255) NOT NULL,
  `telencargado` int(8) NOT NULL,
  `grado` varchar(15) NOT NULL,
  `seccion` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `edad`, `direccion`, `telpersonal`, `encargado`, `telencargado`, `grado`, `seccion`) VALUES
('12334', 'alumno 2', 13, 'asd', 123, 'dsfg', 123, 'Segundo', 'A'),
('54234', 'alumno 3', 22, 'ahjsd', 1231234, 'asdsdaf', 13123, 'Tercero', 'A'),
('8273', 'alumno 1', 12, 'asd', 13123, 'asdfa', 12413, 'Primero', 'A'),
('C688HVR', 'Walter Samuel Gómez Monroy', 17, 'Pueblo Abajo, Sansare, El Progreso', 42360275, 'Paola Hernandez', 54862143, 'Primero', 'A'),
('D626THK', 'Gredys Mariam Rivas Rodas', 15, 'Aldea Los Cerritos, Sansare', 47396748, 'Hibeth Marroquín', 42419602, 'Primero', 'A'),
('E340QTI', 'Kery Gabriel Cacheo Pérez', 15, 'Barrio Pueblo Abajo, Sansare', 79243482, 'German Cacheo', 47780905, 'Segundo', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciencias_naturales-primero-a`
--

CREATE TABLE `ciencias_naturales-primero-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciencias_naturales-primero-a`
--

INSERT INTO `ciencias_naturales-primero-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('8273', 'alumno 1', 0, 0, 0, 0),
('C688HVR', 'Walter Samuel Gómez Monroy', 0, 0, 0, 0),
('D626THK', 'Gredys Mariam Rivas Rodas', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciencias_naturales-segundo-a`
--

CREATE TABLE `ciencias_naturales-segundo-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciencias_naturales-segundo-a`
--

INSERT INTO `ciencias_naturales-segundo-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('12334', 'alumno 2', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_maestro` varchar(255) NOT NULL,
  `grado` varchar(15) NOT NULL,
  `seccion` varchar(255) NOT NULL,
  `clase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_maestro`, `grado`, `seccion`, `clase`) VALUES
('1234567890123', 'Segundo', 'A', 'Idioma Materno'),
('1234567890123', 'Segundo', 'A', 'Cultura E Idioma'),
('1234567890123', 'Segundo', 'A', 'Ciencias Naturales'),
('4567890127325', 'Primero', 'A', 'Idioma Materno'),
('4567890127325', 'Primero', 'A', 'Cultura E Idioma'),
('4567890127325', 'Primero', 'A', 'Ciencias Naturales'),
('4567890127325', 'Tercero', 'A', 'Matemática'),
('4567890127325', 'Tercero', 'A', 'Tecnologías De Aprendizaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultura_e_idioma-primero-a`
--

CREATE TABLE `cultura_e_idioma-primero-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cultura_e_idioma-primero-a`
--

INSERT INTO `cultura_e_idioma-primero-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('8273', 'alumno 1', 0, 0, 0, 0),
('C688HVR', 'Walter Samuel Gómez Monroy', 0, 0, 0, 0),
('D626THK', 'Gredys Mariam Rivas Rodas', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultura_e_idioma-segundo-a`
--

CREATE TABLE `cultura_e_idioma-segundo-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cultura_e_idioma-segundo-a`
--

INSERT INTO `cultura_e_idioma-segundo-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('12334', 'alumno 2', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma_materno-primero-a`
--

CREATE TABLE `idioma_materno-primero-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `idioma_materno-primero-a`
--

INSERT INTO `idioma_materno-primero-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('8273', 'alumno 1', 66, 98, 64, 52),
('C688HVR', 'Walter Samuel Gómez Monroy', 62, 92, 86, 46),
('D626THK', 'Gredys Mariam Rivas Rodas', 42, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma_materno-segundo-a`
--

CREATE TABLE `idioma_materno-segundo-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `idioma_materno-segundo-a`
--

INSERT INTO `idioma_materno-segundo-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('12334', 'alumno 2', 89, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `dpi` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telpersonal` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`dpi`, `nombre`, `direccion`, `telpersonal`) VALUES
('1234567890123', 'Walter Samuel Gómez Monroy', 'Pueblo Abajo, Sansare, El Progreso', 42360275),
('4567890127325', 'Paola Yamileth Hernández Hernández', 'Los Cerritos, Sansare', 54862143);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matematica-tercero-a`
--

CREATE TABLE `matematica-tercero-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matematica-tercero-a`
--

INSERT INTO `matematica-tercero-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('54234', 'alumno 3', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE `plantilla` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL,
  `promedio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnologias_de_aprendizaje-tercero-a`
--

CREATE TABLE `tecnologias_de_aprendizaje-tercero-a` (
  `codPersonal` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b1` int(3) NOT NULL,
  `b2` int(3) NOT NULL,
  `b3` int(3) NOT NULL,
  `b4` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tecnologias_de_aprendizaje-tercero-a`
--

INSERT INTO `tecnologias_de_aprendizaje-tercero-a` (`codPersonal`, `nombre`, `b1`, `b2`, `b3`, `b4`) VALUES
('54234', 'alumno 3', 65, 32, 86, 97);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `rol`) VALUES
('1234567890123', 'director', '$2y$10$ocrMnakZ3FsRXfHxsDBczOJDkG3Qg4pg2oE53cZJp2cPmp4evfExu', '1'),
('4567890127325', 'maestro', '$2y$10$1HfjZfIdrWL2m01ImGMx5.YIhrB2vLlrWUy.DuP2duw9Q3vjgAlc6', '2'),
('C688HVR', 'alumno', '$2y$10$C5IioAms/t4REiLsqguA9eaIHyb/EzNQhAD9/GuurDTCDgsfimada', '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciencias_naturales-primero-a`
--
ALTER TABLE `ciencias_naturales-primero-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `ciencias_naturales-segundo-a`
--
ALTER TABLE `ciencias_naturales-segundo-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `cultura_e_idioma-primero-a`
--
ALTER TABLE `cultura_e_idioma-primero-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `cultura_e_idioma-segundo-a`
--
ALTER TABLE `cultura_e_idioma-segundo-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `idioma_materno-primero-a`
--
ALTER TABLE `idioma_materno-primero-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `idioma_materno-segundo-a`
--
ALTER TABLE `idioma_materno-segundo-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`dpi`);

--
-- Indices de la tabla `matematica-tercero-a`
--
ALTER TABLE `matematica-tercero-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `tecnologias_de_aprendizaje-tercero-a`
--
ALTER TABLE `tecnologias_de_aprendizaje-tercero-a`
  ADD PRIMARY KEY (`codPersonal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
