-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-07-2023 a las 20:15:07
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_virtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `cantidad`, `id_producto`, `id_cliente`) VALUES
(1, 4, 4, 13),
(2, 3, 7, 13),
(3, 5, 11, 13),
(4, 4, 4, 1),
(5, 4, 5, 1),
(6, 5, 6, 1),
(7, 5, 7, 1),
(8, 5, 3, 1),
(9, 4, 9, 1),
(10, 4, 11, 1),
(11, 3, 10, 1),
(12, 4, 8, 1),
(13, 5, 4, 18),
(14, 4, 3, 20),
(15, 3, 4, 20),
(16, 4, 12, 21),
(17, 4, 13, 21),
(18, 3, 14, 21),
(19, 4, 3, 19),
(20, 3, 4, 19),
(21, 3, 5, 19),
(22, 5, 4, 21),
(23, 4, 3, 21),
(24, 2, 6, 21),
(25, 4, 7, 21),
(26, 2, 9, 21),
(27, 4, 3, 23),
(28, 3, 4, 23),
(29, 4, 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `imagen`, `estado`) VALUES
(1, 'Electronica', 'assets/images/categorias/20230527191055.jpg', 1),
(2, 'Mascotas', 'assets/images/categorias/20230527191130.jpg', 1),
(3, 'Fitness', 'assets/images/categorias/20230527191210.jpg', 1),
(4, 'Comestibles', 'assets/images/categorias/20230527191326.jpg', 1),
(5, 'Medicinas', 'assets/images/categorias/20230527191351.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `perfil` varchar(100) NOT NULL DEFAULT 'default.png',
  `token` varchar(100) DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `correo`, `clave`, `perfil`, `token`, `verify`) VALUES
(1, 'Administrador', 'juanzg2.0.2.5@gmail.com', '$2y$10$lExskCZpc3Eon8maUmViaOEdsZJ3JQmWwwPA430IGaK0ejC0rYeQa', 'default.png', NULL, 1),
(2, 'Juan Andrés', 'zapatagiraldojuanandres731@gmail.com', '$2y$10$R4iP.augniidxbUXP2sY7OHmXXbe8SFxZgpPBdV/xUAdi4S8Dv8y.', 'default.png', NULL, 1),
(7, 'definitiva', 'juanandres0371@gmail.com', '$2y$10$ux1Ey4NvX215giTxM4OgaeMWJFNnOvy0gHV4lw/hHihtF.u3iTM4G', 'default.png', NULL, 1),
(12, 'Pachito', 'pachito1234@gmail.com', '$2y$10$A65xIicpywPhPVj4lXagjupTcYAts5tNEUUg4xHxEYZJ4r58PKsCC', 'default.png', NULL, 1),
(13, 'Zapatata', 'kinonones123@gmail.com', '$2y$10$uV0yWTCiaGlwQfWIhLgV9.nvlbGunP83PfLvurMxVWwSic98eviR6', 'default.png', NULL, 1),
(16, 'Zapata Giraldo Juan', 'kinononones1234@gmail.com', '$2y$10$izpa.5Dpbav9/jmoiJfszOFX3uaQqVwKCqAJaHfyaXqA1lM9C8C9a', 'default.png', NULL, 1),
(18, 'Juan AZG', 'jazapata879@misena.edu.co', '$2y$10$fRR3pDSIwZTWnwSc4BkTg.ea.BOEDU7G5NwsPvr/tHkux25fVm5zy', 'default.png', NULL, 1),
(19, 'JUAN AZG123', 'juanzg2.1.2.5@gmail.com', '$2y$10$kDUCxoVohxg7LxpHkZlNI.ekBtV5dKSXE.//gnbXyVziDEvcLM99K', 'default.png', NULL, 1),
(20, 'Usuario30', 'zapatagiraldojuanandres73@gmail.com', '$2y$10$ojzXZCphbXo/18G76/sN.Oi4a5VImg/Iy/KF9DYr6clEcMtrNE/qC', 'default.png', NULL, 1),
(21, 'CompradorC', 'kinononones123@gmail.com', '$2y$10$SvRKo3ZXs0PJ94Obsg2jXu.rZZkgOwT1MOfhwjo9XbjCQ4gY75hF.', 'default.png', NULL, 1),
(23, 'Usuario de prueba', 'juanzg1.5.02@gmail.com', '$2y$10$tpwtm2qHMDksTZSGfFtu6OL8vluO7s6hyglq140gnDahN.EdaLaf.', 'default.png', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `producto` varchar(250) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `producto`, `precio`, `cantidad`, `id_pedido`, `id_producto`) VALUES
(1, 'Laptop HP Pavilion 15', 799.99, 2, 1, 4),
(2, 'Auriculares inalámbricos Sony WH-1000XM4', 349.99, 1, 1, 5),
(3, 'Collar para perros', 15.99, 1, 1, 6),
(4, 'Juguete interactivo para gatos', 9.99, 3, 1, 7),
(5, 'Laptop HP Pavilion 15', 799.99, 2, 2, 4),
(6, 'Juguete interactivo para gatos', 9.99, 1, 2, 7),
(7, 'Pelota de ejercicio', 19.99, 1, 2, 11),
(8, 'Laptop HP Pavilion 15', 799.99, 3, 3, 4),
(9, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 6, 4, 3),
(10, 'Laptop HP Pavilion 15', 850.00, 6, 4, 4),
(11, 'Pesas ajustables', 49.99, 2, 5, 9),
(12, 'Pelota de ejercicio', 19.99, 2, 5, 11),
(13, 'Alimento para perros adultos', 29.99, 3, 6, 8),
(14, 'Banda de resistencia', 12.99, 1, 6, 10),
(15, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 6, 7, 3),
(16, 'Laptop HP Pavilion 15', 850.00, 1, 8, 4),
(17, 'Auriculares inalámbricos Sony WH-1000XM4', 349.99, 7, 8, 5),
(18, 'Laptop HP Pavilion 15', 850.00, 1, 9, 4),
(19, 'Laptop HP Pavilion 15', 850.00, 1, 10, 4),
(20, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 2, 11, 3),
(21, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 1, 12, 3),
(22, 'Laptop HP Pavilion 15', 850.00, 2, 12, 4),
(23, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 2, 13, 3),
(24, 'Auriculares inalámbricos Sony WH-1000XM4', 349.99, 1, 13, 5),
(25, 'Ibuprofeno', 19.99, 5, 13, 15),
(26, 'Laptop HP Pavilion 15', 850.00, 2, 14, 4),
(27, 'Auriculares inalámbricos Sony WH-1000XM4', 349.99, 1, 14, 5),
(28, ' Arroz integral', 5.90, 3, 14, 13),
(29, ' Arroz integral', 5.90, 3, 15, 13),
(30, 'Manzanas', 7.94, 3, 15, 12),
(31, 'Aceite de oliva extra virgen', 9.99, 1, 15, 14),
(32, 'Laptop HP Pavilion 15', 850.00, 1, 16, 4),
(33, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 1, 16, 3),
(34, 'Auriculares inalámbricos Sony WH-1000XM4', 349.99, 1, 16, 5),
(35, 'Juguete interactivo para gatos', 9.99, 3, 17, 7),
(36, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 3, 17, 3),
(37, 'Laptop HP Pavilion 15', 850.00, 1, 17, 4),
(38, 'Pesas ajustables', 49.99, 2, 17, 9),
(39, 'Collar para perros', 15.99, 1, 17, 6),
(40, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 1, 18, 3),
(41, 'Laptop HP Pavilion 15', 850.00, 4, 19, 4),
(42, 'Teléfono inteligente Samsung Galaxy S21', 899.99, 1, 19, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(80) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `email` varchar(80) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `proceso` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_transaccion`, `monto`, `estado`, `fecha`, `email`, `nombre`, `apellido`, `direccion`, `ciudad`, `id_cliente`, `proceso`) VALUES
(1, '7FV68128N7982400P', 1995.93, 'COMPLETED', '2023-05-27 19:54:41', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '3'),
(2, '6C051925L7292954S', 1629.96, 'COMPLETED', '2023-06-04 17:07:19', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 13, '3'),
(3, '192495608S210431X', 2399.97, 'COMPLETED', '2023-06-22 20:08:13', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '3'),
(4, '8BU59972PJ8351001', 10499.94, 'COMPLETED', '2023-06-22 20:16:51', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '2'),
(5, '766860499C697083V', 139.96, 'COMPLETED', '2023-06-24 14:29:06', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '3'),
(6, '7PG67021NU098742M', 102.96, 'COMPLETED', '2023-06-24 15:39:28', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '2'),
(7, '9U471059XX3135340', 5399.94, 'COMPLETED', '2023-06-27 16:55:34', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '2'),
(8, '2UT62104288530203', 3299.93, 'COMPLETED', '2023-06-28 06:09:04', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '3'),
(9, '5Y068865GK257984M', 850.00, 'COMPLETED', '2023-06-28 17:57:16', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 18, '3'),
(10, '03P67977R6781542F', 850.00, 'COMPLETED', '2023-06-29 14:41:04', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Cra 76 #40-50', 'Bello', 1, '3'),
(11, '8G305408MJ884100Y', 1799.98, 'COMPLETED', '2023-06-29 18:40:43', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '3'),
(12, '364274064V1413140', 2599.99, 'COMPLETED', '2023-06-29 18:45:19', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 20, '3'),
(13, '31R6462082316090W', 2249.92, 'COMPLETED', '2023-06-29 19:02:36', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 1, '3'),
(14, '6PA80815L6165660Y', 2067.69, 'COMPLETED', '2023-06-29 19:05:11', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 18, '1'),
(15, '22S66487N9529280S', 51.51, 'COMPLETED', '2023-06-29 19:07:23', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 21, '3'),
(16, '5YY52003RC640325C', 2099.98, 'COMPLETED', '2023-06-29 19:18:53', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 19, '3'),
(17, '84625761EL4052324', 3695.91, 'COMPLETED', '2023-06-30 02:23:14', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 21, '3'),
(18, '4MK78482WX569343U', 899.99, 'COMPLETED', '2023-06-30 02:28:29', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 21, '1'),
(19, '7R618883YG959842K', 4299.99, 'COMPLETED', '2023-07-04 17:01:18', 'sb-juobf24602040@personal.example.com', 'John', 'Doe', 'Free Trade Zone', 'Bogota', 23, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`, `estado`, `id_categoria`) VALUES
(3, 'Teléfono inteligente Samsung Galaxy S21', 'Producto de prueba', 175.10, 13, 'assets/images/productos/20230527191707.jpg', 1, 1),
(4, 'Laptop HP Pavilion 15', 'Portátil versátil con procesador Intel Core, pantalla táctil de 15 pulgadas y almacenamiento SSD de alta velocidad.', 850.00, 5, 'assets/images/productos/20230527191820.jpg', 1, 1),
(5, 'Auriculares inalámbricos Sony WH-1000XM4', 'Auriculares con cancelación de ruido líder en su categoría, sonido envolvente y larga duración de la batería.', 349.99, 6, 'assets/images/productos/20230527192000.jpg', 1, 1),
(6, 'Collar para perros', 'Collar ajustable de cuero resistente para perros de tamaño mediano.', 15.99, 24, 'assets/images/productos/20230527192118.jpg', 1, 2),
(7, 'Juguete interactivo para gatos', 'Juguete interactivo con plumas y ratón de peluche para mantener entretenidos a los gatos.', 9.99, 47, 'assets/images/productos/20230527192230.jpg', 1, 2),
(8, 'Alimento para perros adultos', ' Alimento balanceado y nutritivo para perros adultos de todas las razas.', 29.99, 42, 'assets/images/productos/20230527192319.jpg', 1, 2),
(9, 'Pesas ajustables', 'Set de pesas ajustables para ejercicios de fuerza y tonificación.', 49.99, 17, 'assets/images/productos/20230527192456.jpg', 1, 3),
(10, 'Banda de resistencia', 'Banda de resistencia elástica para entrenamientos de resistencia y estiramientos.', 12.99, 53, 'assets/images/productos/20230527192628.jpg', 1, 3),
(11, 'Pelota de ejercicio', 'Pelota de ejercicio para fortalecer el core y mejorar el equilibrio y la estabilidad.', 19.99, 30, 'assets/images/productos/20230527192707.jpg', 1, 3),
(12, 'Manzanas', 'Manzanas frescas y jugosas', 7.94, 17, 'assets/images/productos/20230527192835.jpg', 1, 4),
(13, ' Arroz integral', 'Arroz integral de grano largo', 5.90, 37, 'assets/images/productos/20230527192943.jpg', 1, 4),
(14, 'Aceite de oliva extra virgen', 'Aceite de oliva de primera calidad, 1litro', 9.99, 17, 'assets/images/productos/20230527193041.jpg', 1, 4),
(15, 'Ibuprofeno', 'Medicamento para aliviar dolores de cabeza', 19.99, 65, 'assets/images/productos/20230527203354.jpg', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `perfil` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `correo`, `clave`, `perfil`, `estado`) VALUES
(1, 'JUAN ANDRES', 'ZAPATA GIRALDO', 'juanzg2.0.2.5@gmail.com', '$2y$10$eFXTle5zHGJk/EXqjEkaauJIP7JqV9PcbT7gutVwHz//E9quOolGS', NULL, 1),
(5, 'JUAN PABLO', 'SALAZAR CEBALLOS', 'salabet@gmail.com', '$2y$10$lqq58./Eri1sufSBpGcPNuUMQeb82fHHif8fuNJAVxdEb0pAJ4lAm', NULL, 1),
(6, 'Angelico', 'Momoa22', 'Angelico1@gmail.com', '$2y$10$.haFEJOEyXglCCOhlxLT7eZpcuHYoOoh0NajG/PjYkUoS.6RDj8XC', NULL, 1),
(16, 'María Angelica ', 'Sanchez', 'maria@gmail.com', '$2y$10$/rpQB6xp1VtXsBH6ePAA0uGgQqq9wjLoiqPkO1RCdoeRZqeHdypZC', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
