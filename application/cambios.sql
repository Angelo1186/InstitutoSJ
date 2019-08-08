-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-01-2019 a las 00:02:05
-- Versión del servidor: 5.0.77
-- Versión de PHP: 5.3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `id_actividad` int(11) NOT NULL auto_increment,
  `fecha_hora` datetime NOT NULL,
  `url` varchar(255) collate utf8_spanish2_ci NOT NULL,
  `actividad` text collate utf8_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_actividad`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE IF NOT EXISTS `contratos` (
  `id_contrato` int(11) NOT NULL auto_increment,
  `id_inmueble` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tipo_contrato` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `monto_alquiler` decimal(6,2) NOT NULL,
  `plazo_alquiler` int(11) NOT NULL,
  `duracion_alquiler` int(11) NOT NULL,
  `bonificacion` decimal(6,2) NOT NULL,
  `dia_desde` int(11) NOT NULL,
  `dia_hasta` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `estado` varchar(16) collate utf8_spanish2_ci NOT NULL default 'Activo',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_contrato`),
  KEY `id_inmueble` (`id_inmueble`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_aumentos`
--

CREATE TABLE IF NOT EXISTS `contratos_aumentos` (
  `id_contrato_aumento` int(11) NOT NULL auto_increment,
  `id_contrato` int(11) NOT NULL,
  `importe_anterior` decimal(6,2) NOT NULL,
  `porcentaje_aumento` int(11) default NULL,
  `importe` decimal(6,2) default NULL,
  `fecha` date default NULL,
  `estado` varchar(125) collate utf8_spanish2_ci default NULL,
  `numero_trimestre` int(11) default NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_contrato_aumento`),
  KEY `id_contrato` (`id_contrato`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_servicios`
--

CREATE TABLE IF NOT EXISTS `contratos_servicios` (
  `id_contrato_servicio` int(11) NOT NULL auto_increment,
  `id_contrato` int(11) NOT NULL default '0',
  `id_servicio` int(11) NOT NULL default '0',
  `porcentaje` int(11) default NULL,
  `observacion` varchar(125) collate utf8_spanish2_ci default NULL,
  `monto` decimal(6,2) default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_contrato_servicio`),
  KEY `id_contrato` (`id_contrato`,`id_servicio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios`
--

CREATE TABLE IF NOT EXISTS `domicilios` (
  `id_domicilio` int(11) NOT NULL auto_increment,
  `direccion` varchar(255) collate utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(124) collate utf8_spanish2_ci default NULL,
  `provincia` varchar(124) collate utf8_spanish2_ci default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_domicilio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id_grupo` int(11) NOT NULL auto_increment,
  `nombre` varchar(125) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id_grupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_permisos`
--

CREATE TABLE IF NOT EXISTS `grupos_permisos` (
  `id_grupo_permiso` int(11) NOT NULL auto_increment,
  `id_grupo` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY  (`id_grupo_permiso`),
  KEY `id_grupo` (`id_grupo`,`id_permiso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE IF NOT EXISTS `inmuebles` (
  `id_inmueble` int(11) NOT NULL auto_increment,
  `nombre` varchar(125) collate utf8_spanish2_ci default NULL,
  `descripcion` varchar(125) collate utf8_spanish2_ci default NULL,
  `observacion` varchar(125) collate utf8_spanish2_ci default NULL,
  `id_tipo_inmueble` int(11) NOT NULL,
  `piso` varchar(125) collate utf8_spanish2_ci default NULL,
  `departamento` varchar(125) collate utf8_spanish2_ci default NULL,
  `edificio` varchar(125) collate utf8_spanish2_ci default NULL,
  `direccion` varchar(125) collate utf8_spanish2_ci default NULL,
  `padron` varchar(64) collate utf8_spanish2_ci default NULL,
  `padron_nuevo` varchar(64) collate utf8_spanish2_ci default NULL,
  `unidad_funcional` varchar(64) collate utf8_spanish2_ci default NULL,
  `matricula` varchar(64) collate utf8_spanish2_ci default NULL,
  `superficie` varchar(64) collate utf8_spanish2_ci default NULL,
  `numero_medidor_gas` varchar(64) collate utf8_spanish2_ci default NULL,
  `numero_medidor_luz` varchar(64) collate utf8_spanish2_ci default NULL,
  `numero_medidor_agua` varchar(64) collate utf8_spanish2_ci default NULL,
  `estado` varchar(125) collate utf8_spanish2_ci default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_persona_propietario` int(11) NOT NULL default '0',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_inmueble`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int(11) NOT NULL auto_increment,
  `id_contrato` int(11) NOT NULL default '0',
  `id_servicio` int(11) NOT NULL default '0',
  `periodo` date NOT NULL,
  `numero_factura` varchar(64) collate utf8_spanish2_ci NOT NULL,
  `fecha_pago` date NOT NULL,
  `importe` decimal(6,2) NOT NULL,
  `consumo` varchar(64) collate utf8_spanish2_ci default NULL,
  `estado` varchar(64) collate utf8_spanish2_ci default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `vencimiento` date default NULL,
  `recargo` decimal(6,2) default NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_pago`),
  KEY `id_contrato` (`id_contrato`,`id_servicio`,`periodo`,`fecha_pago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int(11) NOT NULL auto_increment,
  `descripcion` varchar(125) collate utf8_spanish2_ci default NULL,
  `controlador` varchar(125) collate utf8_spanish2_ci default NULL,
  `label` varchar(125) collate utf8_spanish2_ci default NULL,
  `espadre` tinyint(1) NOT NULL default '1',
  `padre` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_permiso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id_persona` int(11) NOT NULL auto_increment,
  `nombre` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `apellido` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `sigla` varchar(8) collate utf8_spanish2_ci default NULL,
  `dni` varchar(16) collate utf8_spanish2_ci default NULL,
  `cuil` varchar(16) collate utf8_spanish2_ci default NULL,
  `email` varchar(64) collate utf8_spanish2_ci default NULL,
  `regimen_impositivo` varchar(125) collate utf8_spanish2_ci default NULL,
  `id_domicilio` int(11) default '0' COMMENT 'ultimo domicilio',
  `id_telefono` int(11) default '0' COMMENT 'ultimo telefono',
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) default NULL,
  `fecha_carga` datetime default NULL,
  PRIMARY KEY  (`id_persona`),
  KEY `id_domicilio` (`id_domicilio`),
  KEY `id_telefono` (`id_telefono`),
  KEY `nombre` (`nombre`),
  KEY `apellido` (`apellido`),
  KEY `dni` (`dni`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_contratos`
--

CREATE TABLE IF NOT EXISTS `personas_contratos` (
  `id_persona_contrato` int(11) NOT NULL auto_increment,
  `id_persona` int(11) NOT NULL default '0',
  `id_contrato` int(11) NOT NULL default '0',
  `id_inmueble` int(11) NOT NULL default '0',
  `tipo` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `id_domicilio` int(11) NOT NULL default '0',
  `fecha` date NOT NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_persona_contrato`),
  KEY `id_persona` (`id_persona`,`id_contrato`,`id_inmueble`,`id_domicilio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_tipos`
--

CREATE TABLE IF NOT EXISTS `personas_tipos` (
  `id_persona_tipo` int(11) NOT NULL auto_increment,
  `id_persona` int(11) NOT NULL,
  `tipo` varchar(125) collate utf8_spanish2_ci default NULL,
  `regimen_impositivo` varchar(125) collate utf8_spanish2_ci default NULL,
  `fecha` date default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_persona_tipo`),
  KEY `id_persona` (`id_persona`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` int(11) NOT NULL auto_increment,
  `nombre` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `observacion` varchar(125) collate utf8_spanish2_ci default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) default NULL,
  `fecha_carga` datetime default NULL,
  PRIMARY KEY  (`id_servicio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE IF NOT EXISTS `telefonos` (
  `id_telefono` int(11) NOT NULL auto_increment,
  `numero` varchar(124) collate utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_telefono`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inmuebles`
--

CREATE TABLE IF NOT EXISTS `tipos_inmuebles` (
  `id_tipo_inmueble` int(11) NOT NULL auto_increment,
  `descripcion` varchar(125) collate utf8_spanish2_ci default NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `id_usuario` int(11) NOT NULL,
  `fecha_carga` datetime NOT NULL,
  PRIMARY KEY  (`id_tipo_inmueble`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(125) collate utf8_spanish2_ci default NULL,
  `apellido` varchar(125) collate utf8_spanish2_ci default NULL,
  `email` varchar(125) collate utf8_spanish2_ci default NULL,
  `usuario` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `clave` varchar(125) collate utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL default '1',
  `fecha_carga` datetime default NULL,
  `usuario_carga` int(11) default NULL,
  PRIMARY KEY  (`id_usuario`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;



-- --------------------------------------------------------

--
-- Insertas datos de tablas maestras
--

INSERT INTO grupos (id_grupo, nombre) VALUES
(1, 'administrador');


INSERT INTO servicios (id_servicio, nombre, observacion, activo, id_usuario, fecha_carga) VALUES
(1, 'Agua', NULL, 1, 1, '2019-01-16 21:23:07'),
(2, 'Luz', NULL, 1, 1, '2019-01-16 21:23:07'),
(3, 'Gas', NULL, 1, 1, '2019-01-16 21:23:07'),
(4, 'Inmobiliaria', NULL, 1, 1, '2019-01-16 21:23:07');

INSERT INTO usuarios (id_usuario, id_grupo, nombre, apellido, email, usuario, clave, activo, fecha_carga, usuario_carga) VALUES
(1, 1, 'admin', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, NULL);



INSERT INTO tipos_inmuebles (id_tipo_inmueble, descripcion, activo, id_usuario, fecha_carga) VALUES
(1, 'Departamento', 1, 1, '2019-01-14 21:22:34'),
(2, 'Cochera', 1, 1, '2019-01-14 21:22:38');

---- cambios para las tablas
ALTER TABLE `contratos_aumentos` CHANGE `fecha` `fecha_desde` DATE NULL DEFAULT NULL;
ALTER TABLE `contratos_aumentos` ADD `fecha_hasta` DATE NULL AFTER `fecha_desde` ;
ALTER TABLE `pagos` ADD `periodo_texto` VARCHAR( 64 ) NULL AFTER `periodo` ;

--
ALTER TABLE `contratos` ADD `interes` DECIMAL( 3,2 ) NULL AFTER `dia_hasta` ;
ALTER TABLE `contratos` ADD `interes_mora` DECIMAL( 3,2 ) NULL AFTER `dia_hasta` ;