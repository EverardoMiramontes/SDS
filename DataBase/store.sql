-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2020 a las 20:03:40
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Nombre` varchar(30) NOT NULL,
  `Clave` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Nombre`, `Clave`) VALUES
('Paulo', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CodigoCat` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodigoCat`, `Nombre`, `Descripcion`) VALUES
('Cod_Arete', 'Aretes', 'Categoria para identificar aretes'),
('Cod_Blusa', 'Blusas', 'Categoria para identificar blusas'),
('Cod_Lente', 'Lentes', 'Categoria para identificar lentes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `NIT` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Apellido` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`NIT`, `Nombre`, `NombreCompleto`, `Apellido`, `Clave`, `Direccion`, `Telefono`, `Email`) VALUES
('1111-1111-1111-1111', 'JohnDoe', 'John', 'Doe', '25d55ad283aa400af464c76d713c07ad', '123 Main St Anytown, USA', 1234567890, 'JohnDoe@email.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `NumPedido` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `CantidadProductos` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`NumPedido`, `CodigoProd`, `CantidadProductos`) VALUES
(5, 'Are-1', 1),
(6, 'Are-1', 1),
(9, 'Are-1', 1),
(10, 'Are-1', 1),
(10, 'Are-2', 1),
(10, 'Blus-1', 1),
(11, 'Are-1', 1),
(11, 'Are-2', 1),
(11, 'Blus-1', 1),
(12, 'Are-1', 1),
(12, 'Are-2', 1),
(12, 'Blus-1', 1),
(13, 'Len-1', 1),
(13, 'Are-2', 1),
(13, 'Blus-1', 1),
(13, 'Are-1', 1),
(14, 'Are-2', 1),
(15, 'Are-2', 1),
(16, 'Len-1', 1),
(17, 'Blus-1', 1),
(18, 'Are-2', 1),
(19, 'Len-1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `CodigoProd` varchar(30) NOT NULL,
  `NombreProd` varchar(30) NOT NULL,
  `CodigoCat` varchar(30) NOT NULL,
  `Precio` decimal(30,2) NOT NULL,
  `Modelo` varchar(30) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Stock` int(20) NOT NULL,
  `NITProveedor` varchar(30) NOT NULL,
  `Imagen` varchar(150) NOT NULL,
  `Nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`CodigoProd`, `NombreProd`, `CodigoCat`, `Precio`, `Modelo`, `Marca`, `Stock`, `NITProveedor`, `Imagen`, `Nombre`) VALUES
('Are-1', 'Aretes Esqueleto', 'Cod_Arete', '25.00', 'Esqueleto', 'King Monster ', 98, 'BOAJ990913AQ', '8.jpeg', 'Paulo'),
('Are-2', 'Aretes Redes', 'Cod_Arete', '25.00', 'Redes Negras', 'King Monster ', 18, 'BOAJ990913AQ5', '10.jpeg', 'Paulo'),
('Blus-1', 'Blusa Simpsons', 'Cod_Blusa', '100.00', 'Bart', 'Simpsons', 95, 'BOAJ990913AQ5', '3.jpeg', 'Paulo'),
('Len-1', 'Lentes Obscuros con corte', 'Cod_Lente', '50.00', 'Playero', 'Catzilla', 97, 'BOAJ990913AQ5', '1.jpeg', 'Paulo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `NITProveedor` varchar(30) NOT NULL,
  `NombreProveedor` varchar(30) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `PaginaWeb` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`NITProveedor`, `NombreProveedor`, `Direccion`, `Telefono`, `PaginaWeb`) VALUES
('BOAJ990913AQ', 'Raul', 'P. Sherman Whalaby #135, Sydney, Australia', 2147483647, 'https://www.youtube.com'),
('BOAJ990913AQ5', 'Juan Paulo Bolaños Arambula', 'P. Sherman Whalaby #135, Sydney, Australia', 2147483647, 'https://www.youtube.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `NumPedido` int(20) NOT NULL,
  `Fecha` varchar(150) NOT NULL,
  `NIT` varchar(30) NOT NULL,
  `Descuento` int(20) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`NumPedido`, `Fecha`, `NIT`, `Descuento`, `TotalPagar`, `Estado`) VALUES
(5, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(6, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(7, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(8, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(9, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(10, '26-03-2020', '1111-1111-1111-1111', 0, '150.00', 'Pendiente'),
(11, '26-03-2020', '1111-1111-1111-1111', 0, '150.00', 'Pendiente'),
(12, '26-03-2020', '1111-1111-1111-1111', 0, '150.00', 'Pendiente'),
(13, '26-03-2020', '1111-1111-1111-1111', 0, '200.00', 'Pendiente'),
(14, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(15, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(16, '26-03-2020', '1111-1111-1111-1111', 0, '50.00', 'Pendiente'),
(17, '26-03-2020', '1111-1111-1111-1111', 0, '100.00', 'Pendiente'),
(18, '26-03-2020', '1111-1111-1111-1111', 0, '25.00', 'Pendiente'),
(19, '26-03-2020', '1111-1111-1111-1111', 0, '50.00', 'Pendiente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodigoCat`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`NIT`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD KEY `NumPedido` (`NumPedido`),
  ADD KEY `CodigoProd` (`CodigoProd`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`CodigoProd`),
  ADD KEY `CodigoCat` (`CodigoCat`),
  ADD KEY `NITProveedor` (`NITProveedor`),
  ADD KEY `Agregado` (`Nombre`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`NITProveedor`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`NumPedido`),
  ADD KEY `NIT` (`NIT`),
  ADD KEY `NIT_2` (`NIT`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `NumPedido` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_8` FOREIGN KEY (`CodigoProd`) REFERENCES `producto` (`CodigoProd`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ibfk_9` FOREIGN KEY (`NumPedido`) REFERENCES `venta` (`NumPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_7` FOREIGN KEY (`CodigoCat`) REFERENCES `categoria` (`CodigoCat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_8` FOREIGN KEY (`NITProveedor`) REFERENCES `proveedor` (`NITProveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_9` FOREIGN KEY (`Nombre`) REFERENCES `administrador` (`Nombre`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`NIT`) REFERENCES `cliente` (`NIT`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
