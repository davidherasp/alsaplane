-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2016 a las 13:39:16
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alsaplane`
--
CREATE DATABASE IF NOT EXISTS `alsaplane` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `alsaplane`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviones`
--

CREATE TABLE `aviones` (
  `idAvion` int(5) NOT NULL,
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numAsientos` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombreCli` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacCli` date NOT NULL,
  `emailCli` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipoCli` tinyint(1) NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaTripulacion`
--

CREATE TABLE `lineaTripulacion` (
  `idTrabajador` int(5) NOT NULL,
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idCliente` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precioR` decimal(4,2) NOT NULL,
  `asiento` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `idTrabajador` int(5) NOT NULL,
  `nombreTra` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidosTra` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacTra` date NOT NULL,
  `rolTra` enum('piloto','copiloto','auxiliar') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idAvion` int(5) NOT NULL,
  `origen` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precioV` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviones`
--
ALTER TABLE `aviones`
  ADD PRIMARY KEY (`idAvion`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `emailCli` (`emailCli`);

--
-- Indices de la tabla `lineaTripulacion`
--
ALTER TABLE `lineaTripulacion`
  ADD PRIMARY KEY (`idTrabajador`,`idVuelo`),
  ADD KEY `idVuelo` (`idVuelo`),
  ADD KEY `idTrabajador` (`idTrabajador`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idVuelo`,`idCliente`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idVuelo` (`idVuelo`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`idTrabajador`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`idVuelo`),
  ADD UNIQUE KEY `idVuelo` (`idVuelo`),
  ADD KEY `idAvion` (`idAvion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviones`
--
ALTER TABLE `aviones`
  MODIFY `idAvion` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `idTrabajador` int(5) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaTripulacion`
--
ALTER TABLE `lineaTripulacion`
  ADD CONSTRAINT `lineatripulacion_ibfk_1` FOREIGN KEY (`idTrabajador`) REFERENCES `trabajadores` (`idTrabajador`),
  ADD CONSTRAINT `lineatripulacion_ibfk_2` FOREIGN KEY (`idVuelo`) REFERENCES `vuelos` (`idVuelo`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idVuelo`) REFERENCES `vuelos` (`idVuelo`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`dni`);

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `vuelos_ibfk_1` FOREIGN KEY (`idAvion`) REFERENCES `aviones` (`idAvion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
