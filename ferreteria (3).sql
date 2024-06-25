-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2024 a las 05:06:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferreteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT 'XXAX000000XXX',
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `id_usuario`) VALUES
(1, 'Lopez', 'Gonzalez', 'Luis', 'XXAX000000XXX', 5),
(2, 'Susana', 'Oria', 'De la lu', 'SUOD101112XXX', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` bigint(20) UNSIGNED NOT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `rfc` varchar(13) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `fotografia` longblob DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `curp`, `fotografia`, `id_usuario`) VALUES
(1, 'Juan', 'Pablo', 'Garcia', 'GAVJ990201HGT', 'GAVJ990201HGTRN00', NULL, NULL),
(2, 'Elsa', 'Patito', 'Verde', 'PAVS18031402H', 'PAVS18031402HGTGN0', NULL, NULL),
(6, 'de pike', 'Oria', ' hola', 'PAVS180314AAH', 'PAVS18031402HGTGN0', NULL, NULL),
(7, 'Lopez', 'Obrador', 'Sofia', 'LLOS150703GRN', 'LLOS150703GRNAAAAA', NULL, NULL);
INSERT INTO `empleado` (`id_empleado`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `curp`, `fotografia`, `id_usuario`) VALUES
INSERT INTO `empleado` (`id_empleado`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `curp`, `fotografia`, `id_usuario`) VALUES
INSERT INTO `empleado` (`id_empleado`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `curp`, `fotografia`, `id_usuario`) VALUES
(10, 'de', 'internet', 'sistema', 'LLOS150703GRN', 'LLOS150703GRNAAAAA', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `fotografia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`, `fotografia`) VALUES
(1, 'Surtek', ''),
(2, 'Trupper', ''),
(3, 'DeWalt', 'fc3c1fe64f11efe062ff327544385887.jpg');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `orders`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `orders` (
`id_usuario` int(11)
,`id_venta` bigint(20) unsigned
,`fecha` date
,`cantidad` decimal(32,2)
,`monto` decimal(42,4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `order_detail`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `order_detail` (
`id_venta` bigint(20) unsigned
,`fecha` date
,`id_producto` int(11)
,`producto` varchar(100)
,`cantidad` decimal(32,2)
,`monto` decimal(42,4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `id_privilegio` int(11) NOT NULL,
  `privilegio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`id_privilegio`, `privilegio`) VALUES
(1, 'Producto'),
(2, 'Tienda'),
(3, 'Marca'),
(4, 'Empleado'),
(5, 'Comprar'),
(6, 'Ver');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `id_marca` int(11) NOT NULL,
  `fotografia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `producto`, `precio`, `id_marca`, `fotografia`) VALUES
(6, 'pinza', 200.00, 2, '9f99517d92388348fd3f543c8a85ea38.png'),
(11, 'foco', 20.00, 2, '847229259bf94990da04dc8d343766c1.png'),
(12, 'llave', 43.00, 2, '608a844b31cef681d34ea44a52eba2dc.png'),
(13, 'Rastrillo Cesped', 400.00, 3, '3aa4049d096d6be9ad902092fcd6d21f.png'),
(14, 'Desarmadores', 45.00, 1, 'c4e34c32d27e771e6db98122cd80af65.png'),
(15, 'cinta teflon', 15.00, 1, '828e55c30dc1d86e3426c747be120f9e.png'),
(19, 'Clavos', 20.00, 3, '1815ed62e434b1caa62b85a8f4335276.png'),
(20, 'Taladro', 440.00, 1, '9d28acc2c6f0c6478d18a8e3e6072815.png'),
(21, 'pinzas para lonja', 29.00, 2, '979dded804bf1f6b88dd0bedf64fc20e.png'),
(22, 'Desarmador', 79.00, 2, 'c589af1238d03cce8a07a6b52c79b279.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_privilegio`
--

CREATE TABLE `rol_privilegio` (
  `id_rol` int(11) NOT NULL,
  `id_privilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_privilegio`
--

INSERT INTO `rol_privilegio` (`id_rol`, `id_privilegio`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL,
  `tienda` varchar(100) DEFAULT NULL,
  `fotografia` varchar(100) DEFAULT 'default.jpg',
  `latitud` varchar(100) DEFAULT '20.5520915',
  `longitud` varchar(100) DEFAULT '-100.1525745'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `tienda`, `fotografia`, `latitud`, `longitud`) VALUES
(2, 'home depot', '59380fc5650b1086e965f9ed109e435a.jpg', NULL, '11111'),
(3, 'Ferreteria Modelo', 'default.jpg', '03903', '23930');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `password`, `token`) VALUES
(1, 'luislao@itcelya.edu.mx', '202cb962ac59075b964b07152d234b70', '096a348e4f8d29908e7c25850864682b6664c8f88c8c44ca5cecddccb8e778e4'),
(4, 'vargas.ana.1j@gmail.com', '202cb962ac59075b964b07152d234b70', '68dd47ae84dd16922c9ca80a9b86048f48aee3d65f7dbf9873cee55f3a5f08db'),
(5, 'ejemplocliente1@gmail.com', '202cb962ac59075b964b07152d234b70', NULL),
(6, 'ejemplocliente2@gmail.com', '202cb962ac59075b964b07152d234b70', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`) VALUES
(1, 1),
(4, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` bigint(20) UNSIGNED NOT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_tienda`, `id_empleado`, `id_cliente`, `fecha`) VALUES
(1, 1, 1, 1, '2024-09-04'),
(3, 1, 1, 1, '2024-09-04'),
(4, 1, 1, 1, '2024-09-04'),
(5, 1, 1, 1, '2024-09-04'),
(6, 1, 4, 1, '2024-06-06'),
(7, 2, 1, 1, '2024-06-06'),
(8, 1, 1, 1, '2024-06-06'),
(9, 1, 1, 1, '2024-06-06'),
(10, 1, 1, 1, '2024-06-06'),
(11, 1, 1, 1, '2023-06-06'),
(16, 1, 1, 1, '2022-06-06'),
(17, 1, 1, 1, '2024-06-06'),
(19, 1, 4, 1, '2024-06-06'),
(20, 1, 4, 1, '2024-06-06'),
(21, 1, 1, 1, '2024-06-06'),
(22, 1, 1, 1, '2024-06-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`id_venta`, `id_producto`, `cantidad`) VALUES
(1, 1, 6.00),
(1, 2, 7.00),
(1, 6, 1.00),
(1, 7, 2.00),
(6, 6, 42.00),
(6, 20, 43.00),
(6, 10, 2.00),
(6, 12, 2.00),
(16, 6, 2.00),
(17, 6, 1200.00),
(19, 6, 16.00),
(20, 6, 1300.00),
(21, 10, 100.00),
(22, 10, 100.00);

-- --------------------------------------------------------

--
-- Estructura para la vista `orders`
--
DROP TABLE IF EXISTS `orders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders`  AS SELECT `u`.`id_usuario` AS `id_usuario`, `v`.`id_venta` AS `id_venta`, `v`.`fecha` AS `fecha`, sum(`vd`.`cantidad`) AS `cantidad`, sum(`vd`.`cantidad` * `p`.`precio`) AS `monto` FROM ((((`venta_detalle` `vd` join `venta` `v` on(`vd`.`id_venta` = `v`.`id_venta`)) join `cliente` `c` on(`v`.`id_cliente` = `c`.`id_cliente`)) join `usuario` `u` on(`c`.`id_usuario` = `u`.`id_usuario`)) join `producto` `p` on(`p`.`id_producto` = `vd`.`id_producto`)) GROUP BY 1, 2, 3 ORDER BY `v`.`fecha` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `order_detail`
--
DROP TABLE IF EXISTS `order_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_detail`  AS SELECT `v`.`id_venta` AS `id_venta`, `v`.`fecha` AS `fecha`, `p`.`id_producto` AS `id_producto`, `p`.`producto` AS `producto`, sum(`vd`.`cantidad`) AS `cantidad`, sum(`vd`.`cantidad` * `p`.`precio`) AS `monto` FROM ((((`venta_detalle` `vd` join `venta` `v` on(`vd`.`id_venta` = `v`.`id_venta`)) join `cliente` `c` on(`c`.`id_cliente` = `v`.`id_cliente`)) join `usuario` `u` on(`u`.`id_usuario` = `c`.`id_usuario`)) join `producto` `p` on(`p`.`id_producto` = `vd`.`id_producto`)) GROUP BY `v`.`id_venta`, `v`.`fecha`, `p`.`id_producto`, `p`.`producto` ORDER BY `p`.`producto` ASC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  ADD PRIMARY KEY (`id_privilegio`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fkmarca` (`id_marca`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_privilegio`
--
ALTER TABLE `rol_privilegio`
  ADD PRIMARY KEY (`id_rol`,`id_privilegio`),
  ADD KEY `id_privilegio` (`id_privilegio`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  MODIFY `id_privilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fkmarca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

--
-- Filtros para la tabla `rol_privilegio`
--
ALTER TABLE `rol_privilegio`
  ADD CONSTRAINT `rol_privilegio_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `rol_privilegio_ibfk_2` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegio` (`id_privilegio`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;