/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `alumnos` (
  `matricula` char(10) NOT NULL,
  `appaterno` varchar(30) DEFAULT NULL,
  `apmaterno` varchar(30) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `edad` tinyint(3) unsigned DEFAULT NULL,
  `latitud` decimal(18,12) DEFAULT NULL,
  `longitud` decimal(18,12) DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` (`matricula`, `appaterno`, `apmaterno`, `nombre`, `sexo`, `edad`, `latitud`, `longitud`) VALUES
	('200901004', 'EVERARDO', 'DEGAN', 'PEDRO LUIS', 'M', 9, 20.590964147804, -100.394879579544),
	('201901001', 'LARIOS', 'OSORIO', 'MARTIN', 'M', 51, NULL, NULL),
	('201901002', 'ARTEAGA', 'ARELLANO', 'MICHELLE', 'F', 24, 20.633010553739, -100.455089223609),
	('201901003', 'GALVAN', 'GOMEZ', 'ELENA', 'F', 44, 20.606805075276, -100.438900291534);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `calificaciones` (
  `matricula` char(10) NOT NULL,
  `idcalif` tinyint(4) NOT NULL,
  `calificacion` decimal(4,1) unsigned DEFAULT NULL,
  PRIMARY KEY (`matricula`,`idcalif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `calificaciones` DISABLE KEYS */;
INSERT INTO `calificaciones` (`matricula`, `idcalif`, `calificacion`) VALUES
	('200901004', 1, 6.0),
	('200901004', 2, 6.0),
	('200901004', 3, 7.0),
	('200901004', 4, 9.0),
	('200901004', 5, 9.8),
	('201901002', 1, 8.0),
	('201901002', 2, 5.0),
	('201901002', 3, 4.0),
	('201901002', 4, 10.0),
	('201901002', 5, 9.0),
	('201901003', 1, 8.0),
	('201901003', 2, 8.0),
	('201901003', 3, 2.0),
	('201901003', 4, 3.0),
	('201901003', 5, 10.0);
/*!40000 ALTER TABLE `calificaciones` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `meses` (
  `idmes` tinyint(4) NOT NULL,
  `nommes` char(3) DEFAULT NULL,
  PRIMARY KEY (`idmes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `meses` DISABLE KEYS */;
INSERT INTO `meses` (`idmes`, `nommes`) VALUES
	(1, 'Ene'),
	(2, 'Feb'),
	(3, 'Mar'),
	(4, 'Abr'),
	(5, 'May'),
	(6, 'Jun'),
	(7, 'Jul'),
	(8, 'Ago'),
	(9, 'Sep'),
	(10, 'Oct'),
	(11, 'Nov'),
	(12, 'Dic');
/*!40000 ALTER TABLE `meses` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nomproducto` varchar(100) DEFAULT NULL,
  `idtipoproducto` tinyint(4) NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`idproducto`, `nomproducto`, `idtipoproducto`) VALUES
	(1, 'COMPUTADORA PORTATIL', 1),
	(2, 'TELEFONO INTELIGENTE', 1),
	(3, 'BOCINAS', 1),
	(4, 'ALMOHADA', 2),
	(5, 'EDREDON', 2),
	(6, 'AGUA DE COLONIA', 3),
	(7, 'LOCION', 3),
	(8, 'PASTA DE DIENTES', 3),
	(9, 'MANZANA', 4),
	(10, 'AGUACATE', 4),
	(11, 'CAMISA DE FRANELA', 5),
	(12, 'FALDA', 6);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `promociones` (
  `idpromocion` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL DEFAULT 1,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `existencia` int(11) NOT NULL DEFAULT 0,
  `vigente` tinyint(4) NOT NULL DEFAULT 1,
  `descuento` decimal(4,1) DEFAULT NULL,
  `fecinicio` date DEFAULT NULL,
  PRIMARY KEY (`idpromocion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `promociones` DISABLE KEYS */;
INSERT INTO `promociones` (`idpromocion`, `idproducto`, `precio`, `existencia`, `vigente`, `descuento`, `fecinicio`) VALUES
	(3, 1, 3500.00, 20, 1, 45.0, '2020-08-04'),
	(4, 9, 50.00, 1000, 1, 23.0, '2020-08-04'),
	(5, 3, 0.00, 0, 0, 5.0, '2020-07-26');
/*!40000 ALTER TABLE `promociones` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `re_accesos` (
  `nomusuario` varchar(50) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `idsesion` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `re_accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_accesos` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `re_ciudades` (
  `ciudad` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `tma` decimal(6,1) DEFAULT NULL,
  `latitud` decimal(18,12) DEFAULT NULL,
  `longitud` decimal(18,12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `re_ciudades` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_ciudades` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `temperaturas` (
  `ciudad` varchar(50) NOT NULL,
  `idmes` tinyint(4) NOT NULL,
  `temperatura` decimal(6,1) DEFAULT NULL,
  PRIMARY KEY (`ciudad`,`idmes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `temperaturas` DISABLE KEYS */;
INSERT INTO `temperaturas` (`ciudad`, `idmes`, `temperatura`) VALUES
	('Anchorage', 1, -4.0),
	('Anchorage', 2, -3.0),
	('Anchorage', 3, -1.0),
	('Anchorage', 4, 0.0),
	('Anchorage', 5, 2.5),
	('Anchorage', 6, 1.5),
	('Anchorage', 7, 3.0),
	('Anchorage', 8, 2.0),
	('Anchorage', 9, 0.0),
	('Anchorage', 10, -1.0),
	('Anchorage', 11, -2.0),
	('Anchorage', 12, -3.0),
	('Londres', 1, 3.9),
	('Londres', 2, 4.2),
	('Londres', 3, 5.7),
	('Londres', 4, 8.5),
	('Londres', 5, 11.9),
	('Londres', 6, 15.2),
	('Londres', 7, 17.0),
	('Londres', 8, 16.6),
	('Londres', 9, 14.2),
	('Londres', 10, 10.3),
	('Londres', 11, 6.6),
	('Londres', 12, 4.8),
	('Querétaro', 1, 12.0),
	('Querétaro', 2, 14.0),
	('Querétaro', 3, 18.0),
	('Querétaro', 4, 20.0),
	('Querétaro', 5, 25.0),
	('Querétaro', 6, 23.0),
	('Querétaro', 7, 26.0),
	('Querétaro', 8, 24.0),
	('Querétaro', 9, 20.0),
	('Querétaro', 10, 18.0),
	('Querétaro', 11, 16.0),
	('Querétaro', 12, 14.0),
	('Tokio', 1, 7.0),
	('Tokio', 2, 6.9),
	('Tokio', 3, 9.5),
	('Tokio', 4, 14.5),
	('Tokio', 5, 18.4),
	('Tokio', 6, 21.5),
	('Tokio', 7, 25.2),
	('Tokio', 8, 26.5),
	('Tokio', 9, 23.3),
	('Tokio', 10, 18.3),
	('Tokio', 11, 13.9),
	('Tokio', 12, 9.6);
/*!40000 ALTER TABLE `temperaturas` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `idtipoproducto` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idtipoproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `tipoproducto` DISABLE KEYS */;
INSERT INTO `tipoproducto` (`idtipoproducto`, `descripcion`) VALUES
	(1, 'ELECTRONICOS'),
	(2, 'LINEA BLANCA'),
	(3, 'PERFUMERIA'),
	(4, 'FRUTAS Y VERDURAS'),
	(5, 'ROPA CABALLEROS'),
	(6, 'ROPA DAMA');
/*!40000 ALTER TABLE `tipoproducto` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture_url`, `profile_url`, `created`, `modified`) VALUES
	(1, 'google', '105142414385930099886', 'Martín', 'Larios Osorio', 'mlarios@uteq.edu.mx', '', 'es-419', 'https://lh3.googleusercontent.com/a-/AOh14Gj5ln8ThHiyilcVyuex-kVbjlbU_P77vfuzhsM7Qg', '', '2020-08-05 05:05:08', '2020-08-05 05:05:08'),
	(2, 'google', '116699536894715766640', 'Martin', 'Larios Osorio', 'evangelista.mexicano@gmail.com', '', 'es-419', 'https://lh3.googleusercontent.com/a-/AOh14GhXwUSHRLMa5hZtlIk6Ukfat1AjdlhJYbTz2awejg', '', '2020-08-05 05:05:14', '2020-08-05 05:05:14'),
	(3, 'google', '107076499268343602857', 'Martin', 'Larios Osorio', 'conferenciageneral2018@gmail.com', '', 'es-419', 'https://lh5.googleusercontent.com/-PAlDiK0r4N8/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclkUQUb6CujDicDRiNFAmwWqmq1pw/photo.jpg', '', '2020-08-05 05:05:21', '2020-08-05 05:05:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
