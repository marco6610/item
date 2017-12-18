-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-12-2017 a las 01:08:42
-- Versión del servidor: 10.1.25-MariaDB-1
-- Versión de PHP: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `item`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprado`
--

CREATE TABLE `comprado` (
  `comprado_id` int(11) NOT NULL,
  `precion_compra` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comprado`
--

INSERT INTO `comprado` (`comprado_id`, `precion_compra`, `nombre`, `valor`, `peso`) VALUES
(1, 150, 'sabritas', 150, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conservado`
--

CREATE TABLE `conservado` (
  `conservado_id` int(11) NOT NULL,
  `dias_conversacion` int(11) DEFAULT NULL,
  `precion_compra` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `item_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricado`
--

CREATE TABLE `fabricado` (
  `fabricado_id` int(11) NOT NULL,
  `cantidad_horas_hombre` int(11) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fabricado`
--

INSERT INTO `fabricado` (`fabricado_id`, `cantidad_horas_hombre`, `nombres`, `valor`, `peso`) VALUES
(1256, 150, 'fabriaca sabritas ', 20, 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `comprado_comprado_id` int(11) NOT NULL,
  `pedido_pedido_id` int(11) NOT NULL,
  `fabricado_fabricado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`item_id`, `cantidad`, `comprado_comprado_id`, `pedido_pedido_id`, `fabricado_fabricado_id`) VALUES
(2, 6, 1, 1, 1256);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `fecha_pedido` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `fecha_pedido`) VALUES
(1, '2017-12-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comprado`
--
ALTER TABLE `comprado`
  ADD PRIMARY KEY (`comprado_id`);

--
-- Indices de la tabla `conservado`
--
ALTER TABLE `conservado`
  ADD PRIMARY KEY (`conservado_id`),
  ADD KEY `fk_conservado_item1_idx` (`item_item_id`);

--
-- Indices de la tabla `fabricado`
--
ALTER TABLE `fabricado`
  ADD PRIMARY KEY (`fabricado_id`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_item_comprado_idx` (`comprado_comprado_id`),
  ADD KEY `fk_item_pedido1_idx` (`pedido_pedido_id`),
  ADD KEY `fk_item_fabricado1_idx` (`fabricado_fabricado_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conservado`
--
ALTER TABLE `conservado`
  ADD CONSTRAINT `fk_conservado_item1` FOREIGN KEY (`item_item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_comprado` FOREIGN KEY (`comprado_comprado_id`) REFERENCES `comprado` (`comprado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_fabricado1` FOREIGN KEY (`fabricado_fabricado_id`) REFERENCES `fabricado` (`fabricado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_pedido1` FOREIGN KEY (`pedido_pedido_id`) REFERENCES `pedido` (`pedido_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
