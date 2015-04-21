-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-04-2015 a las 21:01:46
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `barrioitalia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arriendo`
--

CREATE TABLE IF NOT EXISTS `arriendo` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_contacto` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen1` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen2` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen3` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idioma_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `circuito`
--

CREATE TABLE IF NOT EXISTS `circuito` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `posicion` int(2) NOT NULL,
  `idioma_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `color` (`color`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT '127.0.0.1',
  `fechayhora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `idioma_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `idioma_fk` (`idioma_fk`),
  KEY `idioma_fk_2` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE IF NOT EXISTS `favorito` (
  `usuario_fk` int(11) NOT NULL,
  `tienda_fk` int(11) NOT NULL,
  KEY `usuario_fk` (`usuario_fk`,`tienda_fk`),
  KEY `tienda_fk` (`tienda_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `abreviacion` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `posicion` int(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `posicion` (`posicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`pk`, `nombre`, `abreviacion`, `posicion`, `activo`) VALUES
(1, 'Español', 'ES', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `coordenadas` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `referencia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `destacada` tinyint(1) NOT NULL,
  `idioma_fk` int(11) NOT NULL,
  `prensa` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_fk` int(11) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `idioma_fk` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `termino` datetime NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `tienda_fk` (`tienda_fk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrimonio`
--

CREATE TABLE IF NOT EXISTS `patrimonio` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `coordenadas` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `circuito_fk` int(11) DEFAULT NULL,
  `idioma_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `circuito_fk` (`circuito_fk`,`idioma_fk`),
  KEY `circuito_fk_2` (`circuito_fk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_fk` int(11) NOT NULL,
  `terminada` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `usuario_fk` (`usuario_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_contenido`
--

CREATE TABLE IF NOT EXISTS `ruta_contenido` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `ruta_fk` int(11) NOT NULL,
  `tienda_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `ruta_fk` (`ruta_fk`,`tienda_fk`),
  KEY `tienda_fk` (`tienda_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idioma_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `palabra` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `frecuencia` int(11) NOT NULL DEFAULT '0',
  `idioma_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`pk`, `palabra`, `frecuencia`, `idioma_fk`) VALUES
(1, 'business', 13, 1),
(2, 'cases', 5, 1),
(3, 'cloud', 1, 1),
(4, 'cloud foundry', 1, 1),
(5, 'cobia', 25, 1),
(6, 'cobiacomm', 20, 1),
(7, 'compare', 14, 1),
(8, 'comparison', 9, 1),
(9, 'criteria', 20, 1),
(10, 'enterprise', 5, 1),
(11, 'api', 20, 1),
(12, 'application', 10, 1),
(13, 'architecture', 2, 1),
(14, 'aurea best', 8, 1),
(15, 'blog', 1, 1),
(16, 'capuccino', 13, 1),
(17, 'sillas', 10, 1),
(19, 'Cultura', 10, 1),
(20, 'Ciclovia', 14, 1),
(21, 'Patrimonio', 18, 1),
(22, 'palabra1', 10, 1),
(23, 'palabra2', 9, 1),
(24, 'palabra3', 1, 1),
(27, 'palabra4', 2, 1),
(34, 'tienda1', 4, 1),
(35, 'uno', 4, 1),
(36, 'dos', 4, 1),
(37, 'tres', 4, 1),
(38, 'cuatro', 4, 1),
(39, 'sdasda', 1, 1),
(40, 'sdasad', 1, 1),
(41, 'sadsad', 1, 1),
(42, 'saasddsa', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE IF NOT EXISTS `tienda` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `numeracion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `rating` float(10,2) DEFAULT '0.00',
  `tags` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen1` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen2` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen3` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen4` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen5` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logotipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fin` time NOT NULL,
  `sitio_web` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `googleplus` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tripadvisor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `local_fk` int(11) DEFAULT NULL,
  `circuito_fk` int(11) DEFAULT NULL,
  `idioma_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `oferta_fk` (`circuito_fk`,`idioma_fk`),
  KEY `local_fk` (`local_fk`),
  KEY `local_fk_2` (`local_fk`),
  KEY `idioma_fk` (`idioma_fk`),
  KEY `idioma_fk_2` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendaxservicio`
--

CREATE TABLE IF NOT EXISTS `tiendaxservicio` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_fk` int(11) NOT NULL,
  `servicio_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `tienda_fk` (`tienda_fk`,`servicio_fk`),
  KEY `servicio_fk` (`servicio_fk`),
  KEY `tienda_fk_2` (`tienda_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol` int(2) NOT NULL,
  PRIMARY KEY (`pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pk`, `username`, `password`, `nombre`, `token`, `rol`) VALUES
(31, 'crack_seba@hotmail.com', '$2y$13$poDB4X52DqZcuoYCvXNjA.R.f5rEDuExnLaAxrZWCU/gO0d47bC4q', 'Sebastián', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vitrina`
--

CREATE TABLE IF NOT EXISTS `vitrina` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idioma_fk` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arriendo`
--
ALTER TABLE `arriendo`
  ADD CONSTRAINT `arriendo_ibfk_1` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `circuito`
--
ALTER TABLE `circuito`
  ADD CONSTRAINT `circuito_ibfk_3` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuario` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`tienda_fk`) REFERENCES `tienda` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`tienda_fk`) REFERENCES `tienda` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oferta_ibfk_2` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `patrimonio`
--
ALTER TABLE `patrimonio`
  ADD CONSTRAINT `patrimonio_ibfk_1` FOREIGN KEY (`circuito_fk`) REFERENCES `circuito` (`pk`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `patrimonio_ibfk_3` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`usuario_fk`) REFERENCES `usuario` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ruta_contenido`
--
ALTER TABLE `ruta_contenido`
  ADD CONSTRAINT `ruta_contenido_ibfk_1` FOREIGN KEY (`ruta_fk`) REFERENCES `ruta` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ruta_contenido_ibfk_2` FOREIGN KEY (`tienda_fk`) REFERENCES `tienda` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD CONSTRAINT `tienda_ibfk_1` FOREIGN KEY (`local_fk`) REFERENCES `local` (`pk`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tienda_ibfk_2` FOREIGN KEY (`circuito_fk`) REFERENCES `circuito` (`pk`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tienda_ibfk_5` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiendaxservicio`
--
ALTER TABLE `tiendaxservicio`
  ADD CONSTRAINT `tiendaxservicio_ibfk_1` FOREIGN KEY (`tienda_fk`) REFERENCES `tienda` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiendaxservicio_ibfk_2` FOREIGN KEY (`servicio_fk`) REFERENCES `servicio` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vitrina`
--
ALTER TABLE `vitrina`
  ADD CONSTRAINT `vitrina_ibfk_2` FOREIGN KEY (`idioma_fk`) REFERENCES `idioma` (`pk`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
