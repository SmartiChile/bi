-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-07-2015 a las 04:51:53
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

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
  KEY `idioma_fk` (`idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `circuito`
--

INSERT INTO `circuito` (`pk`, `nombre`, `icono`, `color`, `descripcion`, `imagen`, `posicion`, `idioma_fk`) VALUES
(2, 'DISEÑO Y DECO', 'B5e9GZzsfhBPSMDxWUpCkPecRvfL1RiR.png', '#009494', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'Xf_bgxa8GvfSmFiKdnWKiJwKtaKUU3cs.jpg', 1, 1),
(3, 'DESIGN & DECORATION', '2rEV65oxtqGO5i7WDpEfBvBUMnAY2HSg.png', '#009494', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'xd_Kjzz7JYej2DIIcnFzourbhxyYgT7p.jpg', 1, 2),
(4, 'CULTURAL', 'hCA1f0SqogibkRWMFr_I-UOVEwRb9i1M.png', '#59167d', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'i4tlCMpYGKcHiMHGeblcZCp2sPLTHcfJ.jpg', 2, 1),
(5, 'CULTURAL', 'yFDuyp1E0uECSBKfRXs7pJeNoxwlIKIn.png', '#59167d', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'vUDtj2OCj2rF7aflJQtxbSRVeMPky7ms.jpg', 2, 2),
(6, 'INDUMENTARIA', 'OQ2Me54mhK4-I5vJMGNSTSPWMCyIhk8z.png', '#d07aab', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'KfVTTYlvY3OmVyaNA4QRqwyeV1RSzO4K.jpg', 3, 1),
(7, 'COSTUME', 'Vjc7vTTACylwbPGvLQFYONmHVCRKhOcd.png', '#d07aab', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'GjVLfUMERhJcfkoHYY78P1Xy5voUfmIQ.jpg', 3, 2),
(8, 'GASTRONOMICO', 'q31WZ_TtqAIV0qvBJeZ90V0CG1xm-lBr.png', '#95680b', '<p><strong></strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'vXLE8Td6jHvmxCWJ4nbuo5T4rn0NcKhS.jpg', 4, 1),
(9, 'GOURMET', '8EumyMrXacCAAgz30sfIyfhm_DxdKhez.png', '#95680b', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'uJg9fSr2Or_R8CKABO3wzF2kAdSEfN-F.jpg', 4, 2),
(10, 'PATRIMONIAL', '3OmiW_13r1uZ08k2rDqL1uP4wJWzXIGT.png', '#8c4c0e', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', '_XXnhll8LJHXOceY4pWRQCtaI0cG3s6Z.jpg', 5, 1),
(11, 'HERITAGE', 'NUzG5kIHsTD3DJoZ02B1cdsHFmC-YL8I.png', '#8c4c0e', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'o7Y5yxicsqRRSBMMFs8a7rJfbGQGBeNj.jpg', 5, 2),
(12, 'TURISMO', 'dXK9s0OsaZkiZtnDArThqx-PIvyA0CS-.png', '#718627', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'aa9dzRKjgHVVIYh9IWxz0M1A38xRM8ME.jpg', 6, 1),
(13, 'TOURISM', 'DPK_MPsshrinPgD5MhGsIt7nS8SGQamC.png', '#718627', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id ante quis sem dignissim sodales. Morbi porttitor imperdiet velit, ut vulputate leo tincidunt ac. Vivamus et imperdiet lorem. Vivamus eget nisl dolor. Aliquam feugiat nisi eu nisi suscipit sagittis. Ut in pellentesque quam. Phasellus nec pellentesque ante, non aliquam lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi facilisis a turpis commodo imperdiet.</p><p>Pellentesque rutrum nibh ac laoreet viverra. Morbi hendrerit blandit elit, sed porta nisl condimentum quis. Donec luctus vestibulum ipsum in iaculis. Morbi ultrices sit amet tellus ac sollicitudin. Ut velit lacus, facilisis vitae eleifend in, faucibus finibus libero. Nunc tempor dapibus tincidunt. Nulla blandit bibendum lobortis.</p><p>Vestibulum id purus a erat convallis laoreet. Praesent et ullamcorper sem. Nam urna lorem, tempor nec diam eu, placerat facilisis sapien. Phasellus ultricies, nunc non lobortis ultricies, sapien sem maximus nulla, ut lacinia leo ipsum varius elit. In hac habitasse platea dictumst. Nulla id ullamcorper magna. Phasellus id purus magna. Nunc lobortis maximus nulla, eget feugiat nulla ullamcorper sed. Nulla odio mauris, pellentesque eleifend quam condimentum, maximus dapibus felis. Ut at tempus orci.</p>', 'ReXoIGDFioOOIVDSjhO77A1P5rbSJFps.jpg', 6, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`pk`, `nombre`, `abreviacion`, `posicion`, `activo`) VALUES
(1, 'Español', 'ES', 1, 1),
(2, 'Inglés', 'EN', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `coordenadas` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=83 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=53 ;

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
  `horario` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

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
  PRIMARY KEY (`pk`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pk`, `username`, `password`, `nombre`, `token`, `rol`) VALUES
(34, 'smenendez@icci.cl', '$2y$13$ebY9FH032lFohpLEEavzyuTw6.K9QuU0/ggs8qhdVgy0h37OWJYlu', 'Sebastián Menéndez', NULL, 3),
(40, 'dreck01@gmail.com', '$2y$13$2hQ5x6mrqkkZqPCbQen.uuKcZ/NRjalXBhaFtIdzOnnWxVx9SA.46', 'Jorge Ignacio Valdebenito Capdeville', NULL, 3),
(43, 'sibaceta@gmail.com', '$2y$13$9wFeS9sMwjjQco4mrm8lEOxcZlF2YK0UPrZh3uYAVYCGtrhoo3DaC', 'sergio ibaceta', NULL, 1),
(44, 'marcela.gaete@1893gourmet.com', '$2y$13$BuYyvIgEZ67itKnuTsaa0uLi28upryialN92qZRlD2dhbyClOH1le', 'Marcela Gaete', NULL, 2),
(45, 'ivan.meyer@gmail.com', '$2y$13$HVgFNoB0LZmhdg6BEI6O/uoJXVmcG.L4pUQy1ZF7yFOlMG/01nQMK', 'Ivan Meyer', NULL, 2),
(46, 'gdelatorre@vtr.net', '$2y$13$0hv3cPpDjRoEzUaEl32tne4bh9uLM50lggWuqB6FKbWIi5bmNMq8i', 'Gabriela De La Torre', NULL, 2),
(47, 'magadiseno@gmail.com', '$2y$13$YE7vD5Lt9KEy7.TfTF2KN..pp9h/fwJN6rZWvANHANOnKypcbMRGy', 'Marcela', NULL, 1),
(48, 'mediados.cl@gmail.com', '$2y$13$ufdi5yKkZKV2Y4niH8khGO8oEk4AQ1wn8biftMKOA4VVuUOSZfsKG', 'Gabriela De La Torre', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

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
