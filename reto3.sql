-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-02-2019 a las 03:46:27
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `retotres`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `clientorders` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `name`, `telephone`, `clientorders`) VALUES
(1, 'admin', 'Alejandro', 'Alejandro', '999999999', NULL),
(2, 'admin2', 'Rafa', 'Rafa', '888888888', NULL),
(3, 'admin3', 'Alfonso', 'Alfonso', '777777777', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(6, 'Pescados'),
(7, 'Carne'),
(8, 'Entrantes'),
(10, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientorder`
--

CREATE TABLE `clientorder` (
  `id` int(11) NOT NULL,
  `commentary` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `client_surname` varchar(30) NOT NULL,
  `client_number` varchar(30) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientorder`
--

INSERT INTO `clientorder` (`id`, `commentary`, `date`, `client_name`, `client_surname`, `client_number`, `client_email`, `status`) VALUES
(47, '', '2019-02-06 11:30:29', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ENTREGADO'),
(48, '', '2019-02-06 11:31:36', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ENTREGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE `options` (
  `noOrders` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`noOrders`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderproduct`
--

CREATE TABLE `orderproduct` (
  `idOrder` int(5) NOT NULL,
  `idProduct` int(5) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orderproduct`
--

INSERT INTO `orderproduct` (`idOrder`, `idProduct`, `quantity`) VALUES
(47, 32, 2),
(47, 24, 1),
(47, 28, 2),
(48, 25, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prize` double NOT NULL,
  `img` varchar(100) NOT NULL,
  `id_category` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `prize`, `img`, `id_category`) VALUES
(24, 'Canelones', 'Canelones de atún con bechamel.', 5.5, 'Canelones.jpeg', 6),
(25, 'Lasaña', 'Lasaña de carne picada de 4 pisos.', 3.4, 'Lasaña.jpeg', 7),
(26, 'Menestra', 'Menestra de verduras.', 3.6, 'Menestra.png', 8),
(27, 'Shushi', 'Shushi con pescado de alta calidad.', 7.95, 'Shushi.jpeg', 6),
(28, 'Ensalada', 'Ensalada de pepino con alguna decoración.', 6.5, 'ensalada.jpeg', NULL),
(29, 'Tarta', 'Tarta de chocolate.', 9.5, 'Tarta.png', 10),
(30, 'Escalope', 'Escalope con salsa tropical.', 4.5, 'Escalope.jpeg', 6),
(31, 'Tortilla', 'Tortilla de verduras.', 5.5, 'Tortilla.jpeg', 8),
(32, 'Bombones', 'Bombones variados de chocolate.', 3.2, 'Bombones.jpeg', 10),
(33, 'Empanada', 'Empanada de atún.', 7.6, 'Empanada.jpeg', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientorder`
--
ALTER TABLE `clientorder`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD KEY `fk_order_orderProduct` (`idOrder`),
  ADD KEY `fk_product_orderProduct` (`idProduct`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categor_product` (`id_category`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientorder`
--
ALTER TABLE `clientorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `fk_order_orderProduct` FOREIGN KEY (`idOrder`) REFERENCES `clientorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_orderProduct` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_categor_product` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
