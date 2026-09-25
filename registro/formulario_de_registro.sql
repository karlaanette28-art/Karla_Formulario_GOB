-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2026 a las 22:54:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `formulario_de_registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_de_registro`
--

CREATE TABLE `formulario_de_registro` (
  `id_Formulario_de_Registro` int(10) NOT NULL,
  `Apellido_Paterno` varchar(15) DEFAULT NULL,
  `Apellido_Materno` varchar(15) DEFAULT NULL,
  `Nombre` varchar(15) DEFAULT NULL,
  `RFC` varchar(15) DEFAULT NULL,
  `CURP` varchar(15) DEFAULT NULL,
  `Fecha_de_Nacimineto` date DEFAULT NULL,
  `Escolaridad` varchar(15) DEFAULT NULL,
  `Estado_Civil` varchar(15) DEFAULT NULL,
  `Colonia` varchar(15) DEFAULT NULL,
  `Municipio` varchar(15) DEFAULT NULL,
  `Codigo_Postal` varchar(15) DEFAULT NULL,
  `Telefono` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario_de_registro`
--

INSERT INTO `formulario_de_registro` (`id_Formulario_de_Registro`, `Apellido_Paterno`, `Apellido_Materno`, `Nombre`, `RFC`, `CURP`, `Fecha_de_Nacimineto`, `Escolaridad`, `Estado_Civil`, `Colonia`, `Municipio`, `Codigo_Postal`, `Telefono`) VALUES
(1, 'nava', 'de la cruz', 'karla', 'yg74g75y', '6hy6hnbyh56', '1997-09-24', 'universidad', 'soltera', 'juarez', 'toluca', '4464646', 2147483647),
(2, 'edgr', 'ehtrhtr', 'rhtrsh', 'rhbrh', 'rhtrhtr', '2006-09-20', 'htrtrjytj', 'htrhtrjytrjh', 'ttyrjyjyj', 'jhjtyjny', 'jytjyt', 0),
(3, 'fshserhh', 'egrhgrs', 'shrn', 'njtwu6wjm', 'jytjytj', '2007-04-11', 'ghtrjh', 'rdyjytdjyt', 'rthjhjt', 'tmtjyjy', 'jytjtjyj', 1254863568);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formulario_de_registro`
--
ALTER TABLE `formulario_de_registro`
  ADD PRIMARY KEY (`id_Formulario_de_Registro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formulario_de_registro`
--
ALTER TABLE `formulario_de_registro`
  MODIFY `id_Formulario_de_Registro` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
