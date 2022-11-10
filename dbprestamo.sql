-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 04-11-2022 a las 04:30:06
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbprestamo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `idarea` int(11) NOT NULL,
  `area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`idarea`, `area`) VALUES
(1, 'Laboratorio de Sistemas programable'),
(2, 'Laboratorio de idiomas'),
(3, 'Laboratorio de arquitectura de coputadoras'),
(4, 'Laboratorio de redes de computadoras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idcarrera` int(11) NOT NULL,
  `carrera` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idcarrera`, `carrera`) VALUES
(1, 'ISC'),
(2, 'IGE'),
(3, 'IA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `categoria`) VALUES
(1, 'Material consumible'),
(2, 'Reutilizable'),
(3, 'Herramienta o equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `numeroserie` varchar(50) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `area`, `descripcion`, `cantidad`, `marca`, `modelo`, `numeroserie`, `observaciones`, `categoria`, `foto`) VALUES
(41, 1, 'ESTACIONES DE SOLDADO WELLER WES51 CON CONTROL DE TEMPERATURA', 10, 'WELLER', 'WES51', 'SN', '9 NUEVAS Y 1 USADO', 3, 'img_7e5fdab168aadc2c01ca38fb6693e45f.jpg'),
(42, 1, 'BATERÃA LIPO IAH 11.1V', 19, 'LITHIUM POLYMER', 'YUNTONG', '903-0143-000', '17 NUEVAS, 2 USADAS', 2, 'img_72c75837407604891fb8b2f24eca7d9a.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `numerocontrol` bigint(11) DEFAULT NULL,
  `carrera` int(11) DEFAULT NULL,
  `semestre` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `telefono` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `numerocontrol`, `carrera`, `semestre`, `nombre`, `telefono`) VALUES
(49, 16970111, 1, '9', 'Selso Ramirez de la Cruz', 7411252000),
(66, 12345678, 1, '9', 'Sandra Santiago Santiago', 7411252000),
(67, 16970138, 2, '9', 'Edgar Vidal Narciso', 7411252000),
(68, 16970136, 3, '8', 'chencho Ramirez de la cruz', 7411252000),
(69, 16970137, 1, '9', 'Sergio Rescalvo Romano', 7411252000),
(70, 16970135, 1, '7', 'Jesus Hernandez reyes', 7411252000),
(71, 16970120, 1, 'TESISTA', 'Rocio Sanchez Tacle', 7411252000),
(72, 16970100, 1, 'TESISTA', 'jose dario salazar', 7411252000),
(73, 16970121, 1, 'tesista', 'David Ramos Garcia', 7411252000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idhistorial` int(11) NOT NULL,
  `equipo` int(11) DEFAULT NULL,
  `estudiante` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `cantidadprestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`idhistorial`, `equipo`, `estudiante`, `usuario`, `fecha`, `cantidadprestado`) VALUES
(10, 42, 49, 1, '2021-10-10 13:12:10', 1),
(11, 41, 49, 1, '2021-10-10 14:01:58', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `idmaterial` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`idmaterial`, `area`, `descripcion`, `unidad`, `cantidad`, `observaciones`, `foto`) VALUES
(2, 3, 'Mesas', 'mesa para pc', 9, 'En buenas condiciones ', 'img_e18e4e367f80da1d62f9a45a22b03c87.jpg'),
(3, 1, 'PizarrÃ³n color blanco para marcadores de agua', 'PizarrÃ³n', 12, 'En buenas condiciones ', 'img_c497fb503334ce3d556ace0a70378587.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practica`
--

CREATE TABLE `practica` (
  `idpractica` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaentrada` time DEFAULT NULL,
  `horasalida` time DEFAULT NULL,
  `materia` text DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `grupo` varchar(50) DEFAULT NULL,
  `carrera` varchar(100) DEFAULT NULL,
  `numeropractica` int(11) DEFAULT NULL,
  `nombrepractica` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `practica`
--

INSERT INTO `practica` (`idpractica`, `area`, `fecha`, `horaentrada`, `horasalida`, `materia`, `usuario`, `grupo`, `carrera`, `numeropractica`, `nombrepractica`) VALUES
(18, 1, '2021-08-11', '18:27:45', '18:38:04', 'fundamento de bases de datos ', 1, '2 D', 'ISC', 1, 'poo'),
(20, 3, '2021-08-11', '16:09:53', '16:10:16', 'Matematicas discretas', 1, '4 D', 'ISC', 2, 'Tabla de verdad'),
(23, 2, '2021-08-14', '20:06:11', '20:06:29', 'fundamentos de circuito ', 1, '2 D', 'ISC', 9, 'programacion de un circuito ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` int(11) NOT NULL,
  `equipo` int(11) DEFAULT NULL,
  `estudiante` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidadprestado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idreporte` int(11) NOT NULL,
  `encargado` varchar(50) NOT NULL,
  `periodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idreporte`, `encargado`, `periodo`) VALUES
(1, 'Ing. Bernardo Torres HernÃ¡ndez ', 'agosto-diciembre 2021');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Docente'),
(3, 'Residente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `rol` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `rol`, `nombre`, `correo`, `usuario`, `clave`) VALUES
(1, 1, 'Daniel Sixta De la Cruz', 'dany@gmail.com', 'daniel', '$2y$10$oBjn7vhyWohdH8K/Fue8EuKGJmMT5F9bjr3vtRzMShPaod0vdpzIm'),
(37, 2, 'Lic. Edwin Manuel Yam Cauich', 'edwin@gmail.com', 'edwuin', '$2y$10$QxXMR7HoEDVIAB8thz/I9OHfP9DT5ckO3QEOqbS0Syca/w5QZ260m');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`idarea`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idcarrera`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `area` (`area`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idhistorial`),
  ADD KEY `equipo` (`equipo`),
  ADD KEY `estudiante` (`estudiante`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`idmaterial`),
  ADD KEY `area` (`area`);

--
-- Indices de la tabla `practica`
--
ALTER TABLE `practica`
  ADD PRIMARY KEY (`idpractica`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `area` (`area`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `equipo` (`equipo`),
  ADD KEY `estudiante` (`estudiante`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `estudiante_2` (`estudiante`),
  ADD KEY `usuario_2` (`usuario`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`idreporte`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `idarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idcarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `idhistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `idmaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `practica`
--
ALTER TABLE `practica`
  MODIFY `idpractica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idreporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`area`) REFERENCES `area` (`idarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`idcarrera`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`estudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`area`) REFERENCES `area` (`idarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `practica`
--
ALTER TABLE `practica`
  ADD CONSTRAINT `practica_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `practica_ibfk_2` FOREIGN KEY (`area`) REFERENCES `area` (`idarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`estudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
