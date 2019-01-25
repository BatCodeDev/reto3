-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2019 a las 12:55:42
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

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
  `telephone` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `name`, `telephone`) VALUES
(1, 'admin', 'admin', 'Alejandro', '999999999'),
(2, 'admin2', 'admin2', 'Rafa', '888888888'),
(3, 'admin3', 'admin3', 'Alfonso', '777777777');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `client_email` varchar(30) NOT NULL,
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
(9, 'a', '2019-01-23 12:50:43', 'a', 'a', 'a', 'alexddo122@gmail.com', 'ORDERED');

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
(2, 2, 2),
(2, 3, 4),
(3, 2, 4),
(3, 3, 4),
(4, 2, 1),
(5, 2, 1),
(6, 2, 1),
(7, 2, 1),
(8, 2, 1),
(9, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prize` double NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `prize`, `img`) VALUES
(2, 'plato1', 'nada', 2.3, '5c46cf6baa3b8.png'),
(3, 'plato2', 'nada2', 3.4, '5c46d10d74718.png'),
(4, 'plato3', 'nada3', 3.4, '5c46da83b6293.png'),
(5, 'plato4', 'nada4', 4.3, '5c46daef26c06.jpeg'),
(6, 'plato5', 'nadaaa', 2.3, '5c499a97c7912.jpeg'),
(7, 'corequetas', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(8, 'pasta', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(9, 'paella', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(10, 'arroz', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(11, 'nachos', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(12, 'totilla', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(13, 'galletas', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(14, 'pate', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(15, 'helado', 'ricas', 2.3, '5c499a97c7912.jpeg'),
(16, 'pollo', 'nada', 2.3, 'pollo.jpeg'),
(17, 'espagueti', 'nada', 4.5, 'espagueti.jpeg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientorder`
--
ALTER TABLE `clientorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `fk_order_orderProduct` FOREIGN KEY (`idOrder`) REFERENCES `clientorder` (`id`),
  ADD CONSTRAINT `fk_product_orderProduct` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

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
