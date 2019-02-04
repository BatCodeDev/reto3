-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2019 a las 13:34:14
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reto3`
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
(1, 'admin', 'admin', 'Alejandro', '999999999', NULL),
(2, 'admin2', 'admin2', 'Rafa', '888888888', NULL),
(3, 'admin3', 'admin3', 'Alfonso', '777777777', NULL);

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
(1, 'aaaarroz'),
(2, 'aaaatrox'),
(3, 'penbe'),
(4, 'alejandro'),
(5, 'alejandroalejandro');

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
(2, 'aa', '2019-01-23 12:21:01', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(3, 'Hola como estamos', '2019-01-23 12:22:46', 'Alejandro', 'Diaz de Otalora', '987654321', 'alexddo122@gmail.com', 'ORDERED'),
(4, 'aa', '2019-01-23 12:31:59', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(5, 'hola', '2019-01-23 12:34:10', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(6, 'aa', '2019-01-23 12:34:32', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(7, 'a', '2019-01-23 12:36:50', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(8, 'a', '2019-01-23 12:40:33', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(9, 'a', '2019-01-23 12:50:43', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED'),
(10, '', '2019-01-30 10:30:47', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(11, '', '2019-01-30 10:31:50', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(12, '', '2019-01-30 10:33:30', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(13, '', '2019-01-30 10:43:58', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(14, '', '2019-01-30 10:48:04', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(15, '', '2019-01-30 10:49:00', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(16, '', '2019-01-30 10:49:24', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(17, '', '2019-01-31 09:01:53', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(18, '', '2019-01-31 09:04:24', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(19, '', '2019-01-31 09:04:52', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(20, '', '2019-01-31 09:05:04', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(21, '', '2019-01-31 09:06:47', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(22, '', '2019-01-31 09:10:49', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(23, '', '2019-01-31 09:11:13', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(24, '', '2019-01-31 09:11:54', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(25, '', '2019-01-31 09:12:31', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(26, '', '2019-01-31 09:13:51', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(27, '', '2019-01-31 09:15:40', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(28, '', '2019-01-31 09:16:22', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(29, '', '2019-01-31 09:21:34', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(30, '', '2019-01-31 09:22:06', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(31, '', '2019-01-31 09:23:28', 'alejandro', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED'),
(32, '', '2019-01-31 09:24:45', 'JULIAAAN', 'de otalora', '626032542', 'alexddo122@gmail.com', 'ORDERED');

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
(15, 10, 1),
(15, 9, 1),
(16, 10, 1),
(16, 9, 1),
(17, 10, 3),
(18, 10, 1),
(19, 10, 1),
(20, 10, 1),
(21, 10, 1),
(22, 10, 1),
(23, 10, 1),
(24, 10, 1),
(25, 10, 1),
(26, 10, 1),
(27, 10, 1),
(28, 10, 1),
(29, 10, 1),
(30, 10, 1),
(31, 10, 1),
(32, 10, 1);

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
  `id_category` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `prize`, `img`, `id_category`) VALUES
(7, 'croquetas', 'muy ricas', 2.3, 'croquetas.jpeg', 0),
(8, 'pasta', 'ricas', 2.3, 'pasta.jpeg', 0),
(9, 'paella', 'ricas', 2.3, 'paella.jpeg', 0),
(10, 'arroz', 'ricas', 2.3, 'arroz.jpeg', 0),
(11, 'nachos', 'ricas', 2.3, 'nachos.jpeg', 0),
(12, 'totilla', 'ricas', 2.3, 'tortilla.jpeg', 0),
(13, 'galletas', 'ricas', 2.3, 'galletas.jpeg', 0),
(14, 'pate', 'ricas', 2.3, 'pate.jpeg', 0),
(15, 'helado', 'ricas', 2.3, 'helado.jpeg', 0),
(16, 'pollo', 'nada', 2.3, 'pollo.jpeg', 0),
(17, 'espagueti', 'nada', 4.1, 'espagueti.jpeg', 0),
(18, 'ensalada', 'rica', 2.1, 'ensalada.jpeg', 0),
(19, 'alejandro', 'alejandro', 12, 'alejandro.jpeg', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productcategory`
--

CREATE TABLE `productcategory` (
  `idProduct` int(5) NOT NULL,
  `idCategory` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productcategory`
--
ALTER TABLE `productcategory`
  ADD KEY `fk_product_productCategory` (`idProduct`),
  ADD KEY `fk_category_productCategory` (`idCategory`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientorder`
--
ALTER TABLE `clientorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Filtros para la tabla `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `fk_category_productCategory` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_product_productCategory` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
