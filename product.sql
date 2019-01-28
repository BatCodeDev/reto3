-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2019 a las 12:09:57
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
