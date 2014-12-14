-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2014 at 06:55 PM
-- Server version: 5.5.40-MariaDB-1~precise-log
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u514918493_sys`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `siguiente`(datos int) RETURNS int(11)
    DETERMINISTIC
RETURN datos+1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `actividades`
--
CREATE TABLE IF NOT EXISTS `actividades` (
`id_evaluando` int(11)
,`pdf` varchar(150)
,`porcentaje` decimal(3,2)
,`numero_practica` int(11)
,`version` char(1)
,`nombre_evaluando` char(10)
,`prefijo` char(1)
,`idgrupo` int(11)
,`fecha_liberacion` date
,`fecha_limite` date
,`liberado` bit(1)
);
-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `codigo` char(9) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `escuela_procedencia` varchar(50) DEFAULT NULL,
  `promedio_escuela_procedencia` decimal(3,2) DEFAULT '0.00',
  `id_usuario` int(11) DEFAULT NULL,
  `carrera` char(6) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumno`
--

INSERT INTO `alumno` (`codigo`, `nombre`, `escuela_procedencia`, `promedio_escuela_procedencia`, `id_usuario`, `carrera`) VALUES
('1', 'jovanny zepeda roque', NULL, NULL, 15, NULL),
('1111', '6 6 6', NULL, NULL, 29, NULL),
('123', '123 123 123', NULL, NULL, 26, NULL),
('1234', 'marco jose de jesus', NULL, NULL, 2, NULL),
('123456', '123456 123456 123456', NULL, NULL, 31, NULL),
('123456789', 'luis alberto munoz', NULL, NULL, 44, NULL),
('156', '156 156 156', NULL, NULL, 42, NULL),
('2084', 'luis fernando jose', NULL, NULL, 1, NULL),
('216532', 'mayra tejeda a', NULL, NULL, 40, NULL),
('5', '5 5 5', NULL, NULL, 18, NULL),
('6', '6 6 6', NULL, NULL, 28, NULL),
('as', 'as as as', NULL, NULL, 32, NULL),
('C', 'c C C', NULL, NULL, 23, NULL),
('d', 'd dd dd', NULL, NULL, 22, NULL),
('fd', 'jose migle ala', NULL, NULL, 30, NULL),
('maico', 'maico maico maico', NULL, NULL, 43, NULL),
('q', 'nombre(s) q q', NULL, NULL, 14, NULL),
('w', 'w w w', NULL, NULL, 20, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `alumno_grupo`
--
CREATE TABLE IF NOT EXISTS `alumno_grupo` (
`nombre` varchar(120)
,`carrera` char(6)
,`codigo` char(9)
,`materia` varchar(100)
,`equipo` char(2)
,`prefijo` char(6)
,`seccion` char(3)
,`clave` char(8)
,`idgrupo` int(11)
,`horario` varchar(50)
,`id_curso` int(11)
,`clave_materia` char(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `alumno_inscrito`
--

CREATE TABLE IF NOT EXISTS `alumno_inscrito` (
  `id_alumno_inscrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) DEFAULT NULL,
  `equipo` char(2) DEFAULT NULL,
  `codigo` char(9) DEFAULT NULL,
  `activo` char(1) DEFAULT '0',
  PRIMARY KEY (`id_alumno_inscrito`),
  KEY `id_grupo` (`id_grupo`),
  KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `alumno_inscrito`
--

INSERT INTO `alumno_inscrito` (`id_alumno_inscrito`, `id_grupo`, `equipo`, `codigo`, `activo`) VALUES
(1, 1, '2', '123456789', '0'),
(2, 1, NULL, '123456789', '0'),
(3, 12, NULL, '123456789', '0'),
(4, 1, NULL, '123456789', '0');

-- --------------------------------------------------------

--
-- Table structure for table `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno_inscrito` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `asistencia` char(1) NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `id_alumno_inscrito` (`id_alumno_inscrito`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_alumno_inscrito`, `fecha`, `asistencia`) VALUES
(1, 0, '2014-11-02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ciclo`
--

CREATE TABLE IF NOT EXISTS `ciclo` (
  `id_ciclo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `prefijo` char(6) NOT NULL,
  PRIMARY KEY (`id_ciclo`),
  UNIQUE KEY `prefijo` (`prefijo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ciclo`
--

INSERT INTO `ciclo` (`id_ciclo`, `fecha_inicio`, `fecha_fin`, `prefijo`) VALUES
(2, '2014-11-20', '2015-04-19', '2014-A'),
(3, '2015-06-08', '2015-11-05', '2015-B');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `clave` char(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave_materia` char(10) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `clave`, `nombre`, `clave_materia`) VALUES
(1, 'I5988', 'Seminario de Bases de Datos', 'SBDA1');

-- --------------------------------------------------------

--
-- Table structure for table `entregable`
--

CREATE TABLE IF NOT EXISTS `entregable` (
  `id_entregable` int(11) NOT NULL,
  `id_evaluando` int(11) DEFAULT NULL,
  `fecha_liberacion` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `version_actividad` char(1) DEFAULT NULL,
  `liberado` bit(1) NOT NULL,
  `puntos_calificacion_final` decimal(3,2) DEFAULT '0.00',
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_plan_entrega` date DEFAULT '2014-06-06',
  PRIMARY KEY (`id_entregable`),
  KEY `id_evaluando` (`id_evaluando`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `entregable`
--

INSERT INTO `entregable` (`id_entregable`, `id_evaluando`, `fecha_liberacion`, `fecha_limite`, `version_actividad`, `liberado`, `puntos_calificacion_final`, `id_grupo`, `fecha_plan_entrega`) VALUES
(1, 4, '2014-11-29', '2014-11-02', '1', b'1', NULL, 1, '2014-06-06'),
(2, 3, '2014-11-28', '2014-11-30', '1', b'1', NULL, 1, '2014-06-06'),
(3, 2, '2014-11-30', '2014-12-10', '1', b'1', NULL, 1, '2014-06-06'),
(4, 3, '2014-11-30', '2014-12-03', '1', b'1', NULL, 8, '2014-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno_inscrito` int(11) NOT NULL,
  `id_evaluando` int(11) NOT NULL,
  `fecha_entrega_personalizada` date DEFAULT NULL,
  `ultima_version_entregada` char(1) DEFAULT NULL,
  `autorizar_fecha_entrega` date DEFAULT NULL,
  `puntos_merito` int(11) DEFAULT '0',
  `notas_merito` varchar(300) DEFAULT NULL,
  `puntos_demerito` int(11) DEFAULT '0',
  `notas_demerito` varchar(300) DEFAULT NULL,
  `id_entregable` int(11) NOT NULL,
  `puntos_totales` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evaluacion`),
  KEY `id_alumno_inscrito` (`id_alumno_inscrito`),
  KEY `id_evaluando` (`id_evaluando`),
  KEY `id_entregable` (`id_entregable`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `evaluacion`
--

INSERT INTO `evaluacion` (`id_evaluacion`, `id_alumno_inscrito`, `id_evaluando`, `fecha_entrega_personalizada`, `ultima_version_entregada`, `autorizar_fecha_entrega`, `puntos_merito`, `notas_merito`, `puntos_demerito`, `notas_demerito`, `id_entregable`, `puntos_totales`) VALUES
(1, 1, 2, '2014-11-29', '1', '2014-11-30', 0, NULL, 0, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluando`
--

CREATE TABLE IF NOT EXISTS `evaluando` (
  `id_evaluando` int(11) NOT NULL AUTO_INCREMENT,
  `pdf` varchar(150) NOT NULL,
  `codigo` char(10) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_tipo_evaluando` int(11) NOT NULL,
  `porcentaje` decimal(3,2) NOT NULL,
  `version` char(1) DEFAULT NULL,
  `numero_practica` int(11) NOT NULL,
  PRIMARY KEY (`id_evaluando`),
  KEY `codigo` (`codigo`),
  KEY `id_curso` (`id_curso`),
  KEY `id_tipo_evaluando` (`id_tipo_evaluando`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `evaluando`
--

INSERT INTO `evaluando` (`id_evaluando`, `pdf`, `codigo`, `id_curso`, `id_tipo_evaluando`, `porcentaje`, `version`, `numero_practica`) VALUES
(2, 'pdf/practica.pdf', '1234', 1, 1, 9.99, '1', 1),
(3, 'pdf/practica.pdf', '1234', 1, 2, 2.00, '1', 1),
(4, 'pdf/v2,pdf', '1234', 1, 1, 5.00, '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(10) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `seccion` char(3) DEFAULT NULL,
  `id_ciclo` int(11) NOT NULL,
  `horario` varchar(50) DEFAULT NULL,
  `pdf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_grupo`),
  KEY `codigo` (`codigo`),
  KEY `id_ciclo` (`id_ciclo`),
  KEY `id_curso` (`id_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `codigo`, `id_curso`, `seccion`, `id_ciclo`, `horario`, `pdf`) VALUES
(1, '123', 1, 'D03', 3, 'martes-jueves 7-9 am', NULL),
(8, '1234', 1, '156', 3, '156', 'pdf/datos.pdf'),
(9, '1234', 1, '45', 3, '45', 'pdf/materias.txt'),
(10, '1234', 1, 'aaa', 3, 'aaaaa', 'pdf/temporal.txt'),
(11, '1234', 1, '7', 3, '7', 'pdf/README.txt'),
(12, '1234', 1, '156', 3, '165', 'pdf/configuraciones dhcp.txt'),
(13, '1234', 1, '6', 3, '6', 'pdf/bussqueda de conceptos.txt'),
(14, '1234', 1, 'D06', 3, 'x - 20 miercoles viernes 1-9 pm', 'pdf/linux-el-editor-de-vi-318-k8u3gj.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `codigo` char(9) NOT NULL,
  `nombre` varchar(120) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `carrera` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`codigo`, `nombre`, `id_usuario`, `carrera`) VALUES
('123', 'munoz', 1, 'quimica'),
('1234', 'alberto', 2, 'nk');

-- --------------------------------------------------------

--
-- Stand-in structure for view `relacionciclo`
--
CREATE TABLE IF NOT EXISTS `relacionciclo` (
`profesor` varchar(120)
,`seccion` char(3)
,`clave` char(8)
,`materia` varchar(100)
,`prefijo` char(6)
,`idgrupo` int(11)
,`horario` varchar(50)
,`pdf` varchar(50)
,`id_curso` int(11)
,`clave_materia` char(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `tipo_evaluando`
--

CREATE TABLE IF NOT EXISTS `tipo_evaluando` (
  `id_tipo_evaluando` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(10) NOT NULL,
  `prefijo` char(1) NOT NULL,
  PRIMARY KEY (`id_tipo_evaluando`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `prefijo` (`prefijo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipo_evaluando`
--

INSERT INTO `tipo_evaluando` (`id_tipo_evaluando`, `nombre`, `prefijo`) VALUES
(1, 'Examen', 'E'),
(2, 'Practica', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `activo` bit(1) DEFAULT b'0',
  `nickname` varchar(100) NOT NULL,
  `privilegio` int(11) DEFAULT '3',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `codigo`, `password`, `activo`, `nickname`, `privilegio`) VALUES
(1, '2084', '', b'0', 'luis fernando jose', 3),
(2, '1234', '1234', b'1', 'alberto', 2),
(4, '9999', '1111', b'0', 'peter patrick jason', 3),
(5, '7', '7', b'0', 'ol l l', 3),
(6, '7', '7', b'0', 'ol l l', 3),
(7, '5', '5', b'0', '5 5 5', 3),
(8, '208495874', '123', b'0', 'jovanny israel zepeda', 3),
(9, '208495874', '123', b'0', 'jovanny israel zepeda', 3),
(10, 'o', 'o', b'0', 'o o o', 3),
(11, 'o', 'o', b'0', 'o o o', 3),
(12, 'q', 'q', b'0', 'nombre(s) q q', 3),
(13, 'q', 'q', b'0', 'nombre(s) q q', 3),
(14, 'q', 'q', b'0', 'nombre(s) q q', 3),
(15, '1', '1', b'0', 'jovanny zepeda roque', 3),
(16, '1', '1', b'0', 'jovanny zepeda roque', 3),
(17, '1', '1', b'0', 'jovanny zepeda roque', 3),
(18, '5', '5', b'0', '5 5 5', 3),
(19, '5', '5', b'0', '5 5 5', 3),
(20, 'w', 'w', b'0', 'w w w', 3),
(21, 'w', 'w', b'0', 'w w w', 3),
(22, 'd', 'd', b'0', 'd dd dd', 3),
(23, 'C', 'C', b'0', 'c C C', 3),
(24, 'C', 'C', b'0', 'c C C', 3),
(25, 'C', 'C', b'0', 'c C C', 3),
(26, '123', '123', b'0', '123 123 123', 3),
(27, '123', '123', b'0', '123 123 123', 3),
(28, '6', '6', b'0', '6 6 6', 3),
(29, '6', '6', b'0', '6 6 6', 3),
(30, 'fd', '111', b'0', 'jose migle ala', 3),
(31, '123456', '123456', b'0', '123456 123456 123456', 3),
(32, 'as', 'as', b'0', 'as as as', 3),
(33, 'as', 'as', b'0', 'as as as', 3),
(34, 'as', 'as', b'0', 'as as as', 3),
(35, 'as', 'as', b'0', 'as as as', 3),
(36, 'as', 'as', b'0', 'as as as', 3),
(40, '216532', '2', b'0', 'mayra tejeda a', 3),
(42, '156', '156', b'0', '156 156 156', 3),
(43, 'maico', 'maico', b'0', 'maico maico maico', 3),
(44, '123456789', '123456789', b'1', 'luis alberto munoz ', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vaciado_asistencia`
--
CREATE TABLE IF NOT EXISTS `vaciado_asistencia` (
`alumno` varchar(120)
,`codigo` char(9)
,`materia` varchar(100)
,`calendario` char(6)
,`seccion` char(3)
,`fecha` date
,`asistencia` char(1)
,`id_curso` int(11)
,`profesor` varchar(120)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vaciado_practicas`
--
CREATE TABLE IF NOT EXISTS `vaciado_practicas` (
`materia` varchar(100)
,`seccion` char(3)
,`calendario` char(6)
,`profesor` varchar(120)
,`alumno` varchar(120)
,`codigo` char(9)
,`nombre_evaluando` char(10)
,`prefijo_actividad` char(1)
,`puntos_totales` int(11)
,`porcentaje` decimal(3,2)
,`id_evaluando` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `actividades`
--
DROP TABLE IF EXISTS `actividades`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `actividades` AS select `evaluando`.`id_evaluando` AS `id_evaluando`,`evaluando`.`pdf` AS `pdf`,`evaluando`.`porcentaje` AS `porcentaje`,`evaluando`.`numero_practica` AS `numero_practica`,`evaluando`.`version` AS `version`,`tipo_evaluando`.`nombre` AS `nombre_evaluando`,`tipo_evaluando`.`prefijo` AS `prefijo`,`entregable`.`id_grupo` AS `idgrupo`,`entregable`.`fecha_liberacion` AS `fecha_liberacion`,`entregable`.`fecha_limite` AS `fecha_limite`,`entregable`.`liberado` AS `liberado` from ((`evaluando` join `entregable` on((`evaluando`.`id_evaluando` = `entregable`.`id_evaluando`))) join `tipo_evaluando` on((`tipo_evaluando`.`id_tipo_evaluando` = `evaluando`.`id_tipo_evaluando`)));

-- --------------------------------------------------------

--
-- Structure for view `alumno_grupo`
--
DROP TABLE IF EXISTS `alumno_grupo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alumno_grupo` AS select `alumno`.`nombre` AS `nombre`,`alumno`.`carrera` AS `carrera`,`alumno_inscrito`.`codigo` AS `codigo`,`relacionciclo`.`materia` AS `materia`,`alumno_inscrito`.`equipo` AS `equipo`,`relacionciclo`.`prefijo` AS `prefijo`,`relacionciclo`.`seccion` AS `seccion`,`relacionciclo`.`clave` AS `clave`,`relacionciclo`.`idgrupo` AS `idgrupo`,`relacionciclo`.`horario` AS `horario`,`relacionciclo`.`id_curso` AS `id_curso`,`relacionciclo`.`clave_materia` AS `clave_materia` from ((`alumno_inscrito` join `alumno` on((`alumno`.`codigo` = `alumno_inscrito`.`codigo`))) join `relacionciclo` on((`relacionciclo`.`idgrupo` = `alumno_inscrito`.`id_grupo`)));

-- --------------------------------------------------------

--
-- Structure for view `relacionciclo`
--
DROP TABLE IF EXISTS `relacionciclo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `relacionciclo` AS select `profesor`.`nombre` AS `profesor`,`grupo`.`seccion` AS `seccion`,`curso`.`clave` AS `clave`,`curso`.`nombre` AS `materia`,`ciclo`.`prefijo` AS `prefijo`,`grupo`.`id_grupo` AS `idgrupo`,`grupo`.`horario` AS `horario`,`grupo`.`pdf` AS `pdf`,`curso`.`id_curso` AS `id_curso`,`curso`.`clave_materia` AS `clave_materia` from (((`grupo` join `curso` on((`curso`.`id_curso` = `grupo`.`id_curso`))) join `ciclo` on((`ciclo`.`id_ciclo` = `grupo`.`id_ciclo`))) join `profesor` on((`profesor`.`codigo` = `grupo`.`codigo`)));

-- --------------------------------------------------------

--
-- Structure for view `vaciado_asistencia`
--
DROP TABLE IF EXISTS `vaciado_asistencia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vaciado_asistencia` AS select `alumno_grupo`.`nombre` AS `alumno`,`alumno_grupo`.`codigo` AS `codigo`,`alumno_grupo`.`materia` AS `materia`,`alumno_grupo`.`prefijo` AS `calendario`,`alumno_grupo`.`seccion` AS `seccion`,`asistencia`.`fecha` AS `fecha`,`asistencia`.`asistencia` AS `asistencia`,`relacionciclo`.`id_curso` AS `id_curso`,`relacionciclo`.`profesor` AS `profesor` from (((`alumno_inscrito` join `alumno_grupo` on((`alumno_grupo`.`codigo` = `alumno_inscrito`.`codigo`))) join `relacionciclo` on((`relacionciclo`.`idgrupo` = `alumno_inscrito`.`id_grupo`))) join `asistencia` on((`asistencia`.`id_alumno_inscrito` = `alumno_inscrito`.`id_alumno_inscrito`)));

-- --------------------------------------------------------

--
-- Structure for view `vaciado_practicas`
--
DROP TABLE IF EXISTS `vaciado_practicas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vaciado_practicas` AS select `vaciado_asistencia`.`materia` AS `materia`,`vaciado_asistencia`.`seccion` AS `seccion`,`vaciado_asistencia`.`calendario` AS `calendario`,`vaciado_asistencia`.`profesor` AS `profesor`,`vaciado_asistencia`.`alumno` AS `alumno`,`vaciado_asistencia`.`codigo` AS `codigo`,`tipo_evaluando`.`nombre` AS `nombre_evaluando`,`tipo_evaluando`.`prefijo` AS `prefijo_actividad`,`evaluacion`.`puntos_totales` AS `puntos_totales`,`evaluando`.`porcentaje` AS `porcentaje`,`evaluacion`.`id_evaluando` AS `id_evaluando` from (((`evaluando` join `vaciado_asistencia` on((`vaciado_asistencia`.`id_curso` = `evaluando`.`id_curso`))) join `tipo_evaluando` on((`tipo_evaluando`.`id_tipo_evaluando` = `evaluando`.`id_tipo_evaluando`))) join `evaluacion` on((`evaluacion`.`id_evaluando` = `evaluando`.`id_evaluando`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno_inscrito`
--
ALTER TABLE `alumno_inscrito`
  ADD CONSTRAINT `alumno_inscrito_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `alumno_inscrito_ibfk_2` FOREIGN KEY (`codigo`) REFERENCES `alumno` (`codigo`);

--
-- Constraints for table `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_alumno_inscrito`) REFERENCES `alumno_inscrito` (`id_alumno_inscrito`);

--
-- Constraints for table `entregable`
--
ALTER TABLE `entregable`
  ADD CONSTRAINT `entregable_ibfk_1` FOREIGN KEY (`id_evaluando`) REFERENCES `evaluando` (`id_evaluando`),
  ADD CONSTRAINT `entregable_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Constraints for table `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `evaluacion_ibfk_1` FOREIGN KEY (`id_alumno_inscrito`) REFERENCES `alumno_inscrito` (`id_alumno_inscrito`),
  ADD CONSTRAINT `evaluacion_ibfk_2` FOREIGN KEY (`id_evaluando`) REFERENCES `evaluando` (`id_evaluando`),
  ADD CONSTRAINT `evaluacion_ibfk_3` FOREIGN KEY (`id_entregable`) REFERENCES `entregable` (`id_entregable`);

--
-- Constraints for table `evaluando`
--
ALTER TABLE `evaluando`
  ADD CONSTRAINT `evaluando_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `profesor` (`codigo`),
  ADD CONSTRAINT `evaluando_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `evaluando_ibfk_3` FOREIGN KEY (`id_tipo_evaluando`) REFERENCES `tipo_evaluando` (`id_tipo_evaluando`);

--
-- Constraints for table `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `profesor` (`codigo`),
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`id_ciclo`) REFERENCES `ciclo` (`id_ciclo`),
  ADD CONSTRAINT `grupo_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
