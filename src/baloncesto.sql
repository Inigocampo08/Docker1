-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2019 a las 08:46:07
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baloncesto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `cod_equipo` char(3) NOT NULL,
  `nombre_equipo` varchar(50) DEFAULT NULL,
  `localidad` varchar(20) NOT NULL,
  `entrenador` varchar(50) NOT NULL,
  `Estadio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`cod_equipo`, `nombre_equipo`, `localidad`, `entrenador`, `Estadio`) VALUES
('BB', 'Bilbao Basket ', 'Bilbao', 'Rafael Pueyo Mena', 'Bilbao Arena. Aforo: 10000'),
('CBE', 'Club Baloncesto Estudiantes', 'Madrid', 'Josep Maria Berrocal', 'Palacio de Deportes. Aforo: 15000'),
('CBG', 'Club Baloncesto Granada', 'Granada', 'Francisco Segura Gomez', 'Palacio Municipal de los Deportes de Granada. Afor'),
('FCB', 'Futbol Club Barcelona', 'Barcelona', 'Xavier Vidal', 'Palau Blaugrana. Aforo: 7585'),
('SSB', 'San Sebastian Gipuzkoa Basket Club', 'Donosti', 'Sergio Valdeolmillos Moreno', 'Donostia Arena 2016. Aforo: 11000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `cod_jugador` int(4) NOT NULL,
  `nombre_jugador` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `posicion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `cod_equipo` varchar(3) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`cod_jugador`, `nombre_jugador`, `posicion`, `foto`, `cod_equipo`) VALUES
(1, 'Rodrigo De la Fuente Morgado', 'ala', 'fuente.jpg', 'FCB'),
(2, 'Juan Carlos Navarro Feijoo', 'escolta', 'navarro.jpg', 'FCB'),
(3, 'Roberto Duenas Hernandez', 'pivot', 'duenas.jpg', 'FCB'),
(4, 'Roger Esteller Juyol', 'ala', 'esteller.jpg', 'FCB'),
(5, 'Roger Grimau Gragera', 'escolta', 'grimau.jpg', 'BB'),
(6, 'Raul Lopez Molist', 'base', 'molist.jpg', 'BB'),
(7, 'Francisco Vazquez Duckitt', 'escolta', 'Duckitt.jpg', 'BB'),
(8, 'Cesar Sanmartin Aban', 'ala', 'sanmartin.jpg', 'BB'),
(9, 'Mikel Uriz Ancizu', 'base', 'uriz.jpg', 'BB'),
(10, 'Borja Mendia Sangroniz', 'ala', 'mendia.jpg', 'BB'),
(11, 'Aitor Gonzalez de Zarate Apinaniz', 'base', 'zarate.jpg', 'BB'),
(12, 'Jose Luis Galilea Vidaurreta', 'base', 'galilea.jpg', 'FCB'),
(13, 'Jordi Trias Feliu', 'Pivot', 'trias.jpg', 'FCB'),
(14, 'Daniel Romero Oliva', 'escolta', 'romero.jpg', 'CBG'),
(15, 'Jose Ignacio Martin Monzon', 'ala', 'martin.jpg', 'CBG'),
(16, 'Carlos Montes Garcia', 'ala', 'montes.jpg', 'CBG'),
(17, 'Jose Miguel Antunez Melero', 'base', 'antunez.jpg', 'CBG'),
(18, 'Bernardo Castillo Olmo', 'ala', 'castillo.jpg', 'CBG'),
(19, 'Gonzalo Martinez Martinez', 'base', 'martinez.jpg', 'CBE'),
(20, 'Iker Iturbe Martinez de Lecea', 'Ala-Pivot', 'iturbe.jpg', 'CBE'),
(21, 'Victor Jesus Arteaga Gonzalez', 'ala-pivot', 'arteaga.jpg', 'CBE'),
(22, 'Javier Beiran Amigo', 'ala', 'beiran.jpg', 'CBE'),
(23, 'Asier Garcia Regueiro', 'pivot', 'asier.jpg', 'CBE'),
(24, 'Ivan Cruz Uceda', 'pivot', 'cruz.jpg', 'CBE'),
(25, 'Daniel Perez Otero', 'base', 'perez.jpg', 'SSB'),
(26, 'Miquel Salvo Llambrich', 'pivot', 'salvo.jpg', 'SSB'),
(27, 'Javier Salgado Martin', 'base', 'salgado.jpg', 'SSB'),
(28, 'Xabier Oroz Uria', 'ala', 'oroz.jpg', 'SSB'),
(29, 'Urko Otegui Esnaola', 'ala-pivot', 'otegui.jpg', 'SSB'),
(30, 'Asier De la Iglesia Bragado', 'ala-pivot', 'iglesia.jpg', 'SSB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `usuario` varchar(250) DEFAULT NULL,
  `password` varchar(250) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `usuario`, `password`) VALUES
(1, 'Administrador', 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`cod_equipo`),
  ADD UNIQUE KEY `nombre_equipo` (`nombre_equipo`) USING BTREE;

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`cod_jugador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `cod_jugador` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
