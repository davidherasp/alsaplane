-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2016 a las 12:41:33
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `user` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`user`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviones`
--

CREATE TABLE `aviones` (
  `idAvion` int(5) NOT NULL,
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numAsientos` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviones`
--

INSERT INTO `aviones` (`idAvion`, `modelo`, `numAsientos`) VALUES
(1, 'Boeing B737', 300),
(2, 'Airbus A319', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombreCli` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacCli` date NOT NULL,
  `emailCli` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipoCli` enum('premium','standard') NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dni`, `nombreCli`, `fechaNacCli`, `emailCli`, `tipoCli`, `password`) VALUES
('60606060r', 'guilleeee', '1991-01-01', 'guille3@test.com', 'premium', 'guille2'),
('70707070r', 'actualizado', '1995-11-05', 'actualizado@gmail.com', 'standard', 'cliente1'),
('70707071r', 'Cliente2', '1992-12-12', 'cliente2@email.com', 'premium', 'cliente2'),
('70707072r', 'Cliente3', '1990-12-11', 'cliente3@email.com', 'standard', 'cliente3'),
('70707074r', 'clientee', '0000-00-00', 'email@cliente4.com', 'premium', 'cliente4'),
('90909090r', 'guille', '1991-11-01', 'guille2@email.com', 'premium', 'guille');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaTripulacion`
--

CREATE TABLE `lineaTripulacion` (
  `idTrabajador` int(5) NOT NULL,
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineaTripulacion`
--

INSERT INTO `lineaTripulacion` (`idTrabajador`, `idVuelo`) VALUES
(1, 'IBE2525'),
(2, 'IBE2525'),
(3, 'IBE2525');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idCliente` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precioR` decimal(6,2) NOT NULL,
  `asiento` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idVuelo`, `idCliente`, `precioR`, `asiento`) VALUES
('IBE2525', '70707070r', '90.00', 150),
('IBE2525', '70707071r', '81.00', 100),
('RAY4040', '70707070r', '120.99', 12),
('RAY4040', '70707072r', '120.99', 10),
('RAY4040', '70707074r', '108.89', 11);

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

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`idTrabajador`, `nombreTra`, `apellidosTra`, `fechaNacTra`, `rolTra`) VALUES
(1, 'Trabajador1 Piloto', 'Apellidos1', '1989-12-07', 'piloto'),
(2, 'Trabajador2 Copiloto', 'Apellidos2', '1991-11-09', 'copiloto'),
(3, 'Trabajador3 Auxiliar', 'Apellidos3', '1986-09-21', 'auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idAvion` int(5) NOT NULL,
  `origen` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaVuelo` date NOT NULL,
  `precioV` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`idVuelo`, `idAvion`, `origen`, `destino`, `fechaVuelo`, `precioV`) VALUES
('IBE2525', 1, 'Madrid', 'Barcelona', '2017-01-03', '90.00'),
('IBE9090', 2, 'Madrid', 'Paris', '2017-01-04', '130.00'),
('RAY4040', 2, 'Londres', 'Valladolid', '2016-12-29', '120.99');

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
  MODIFY `idAvion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `idTrabajador` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
