-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2026 a las 23:35:27
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
-- Base de datos: `proyfinalwebii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carritos`
--

INSERT INTO `carritos` (`id`, `user_id`, `estado_id`, `created_at`) VALUES
(1, 1, 1, '2026-06-10 21:32:46'),
(2, 2, 1, '2026-06-10 21:32:46'),
(3, 3, 1, '2026-06-10 21:32:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_detalles`
--

CREATE TABLE `carrito_detalles` (
  `id` int(11) NOT NULL,
  `carrito_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_detalles`
--

INSERT INTO `carrito_detalles` (`id`, `carrito_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 1, 2),
(2, 1, 3, 1),
(3, 2, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(10, 'Accesorios'),
(5, 'Direccion'),
(9, 'Filtros'),
(2, 'Frenos'),
(7, 'Iluminacion'),
(8, 'Lubricantes'),
(1, 'Motores'),
(6, 'Sistema Electrico'),
(3, 'Suspension'),
(4, 'Transmision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `metodo_envio` varchar(50) NOT NULL,
  `codigo_seguimiento` varchar(100) DEFAULT NULL,
  `empresa_envio` varchar(150) DEFAULT NULL,
  `costo_envio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_envio` timestamp NULL DEFAULT NULL,
  `fecha_entrega` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`id`, `pedido_id`, `estado_id`, `metodo_envio`, `codigo_seguimiento`, `empresa_envio`, `costo_envio`, `fecha_envio`, `fecha_entrega`) VALUES
(1, 1, 1, 'Delivery', 'ENV001', 'TransBol', 20.00, NULL, NULL),
(2, 2, 1, 'Delivery', 'ENV002', 'TransBol', 25.00, NULL, NULL),
(3, 3, 1, 'Recojo', NULL, NULL, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_general`
--

CREATE TABLE `estados_general` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_general`
--

INSERT INTO `estados_general` (`id`, `tipo`, `nombre`) VALUES
(36, 'estado_carrito', 'abandonado'),
(34, 'estado_carrito', 'activo'),
(35, 'estado_carrito', 'procesado'),
(21, 'estado_envio', 'entregado'),
(20, 'estado_envio', 'en_camino'),
(22, 'estado_envio', 'fallido'),
(19, 'estado_envio', 'pendiente'),
(16, 'estado_pago', 'aprobado'),
(15, 'estado_pago', 'pendiente'),
(17, 'estado_pago', 'rechazado'),
(18, 'estado_pago', 'reembolsado'),
(14, 'estado_pedido', 'cancelado'),
(10, 'estado_pedido', 'confirmado'),
(13, 'estado_pedido', 'entregado'),
(12, 'estado_pedido', 'enviado'),
(11, 'estado_pedido', 'en_proceso'),
(9, 'estado_pedido', 'pendiente'),
(4, 'estado_producto', 'activo'),
(6, 'estado_producto', 'agotado'),
(5, 'estado_producto', 'inactivo'),
(23, 'estado_promocion', 'activa'),
(24, 'estado_promocion', 'inactiva'),
(25, 'estado_promocion', 'vencida'),
(7, 'estado_proveedor', 'activo'),
(8, 'estado_proveedor', 'inactivo'),
(27, 'estado_resena', 'aprobada'),
(26, 'estado_resena', 'pendiente'),
(28, 'estado_resena', 'rechazada'),
(1, 'estado_usuario', 'activo'),
(2, 'estado_usuario', 'inactivo'),
(3, 'estado_usuario', 'suspendido'),
(33, 'tipo_descuento', 'monto_fijo'),
(32, 'tipo_descuento', 'porcentaje'),
(31, 'tipo_movimiento_stock', 'ajuste'),
(29, 'tipo_movimiento_stock', 'entrada'),
(30, 'tipo_movimiento_stock', 'salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(4, 'Chevrolet'),
(5, 'Ford'),
(2, 'Honda'),
(6, 'Hyundai'),
(7, 'Kia'),
(8, 'Mazda'),
(3, 'Nissan'),
(10, 'Suzuki'),
(1, 'Toyota'),
(9, 'Volkswagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_stock`
--

CREATE TABLE `movimientos_stock` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `tipo_movimiento_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `motivo` varchar(300) DEFAULT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_stock`
--

INSERT INTO `movimientos_stock` (`id`, `producto_id`, `tipo_movimiento_id`, `cantidad`, `motivo`, `fecha_movimiento`) VALUES
(1, 1, 1, 50, 'Ingreso inicial', '2026-06-10 21:32:47'),
(2, 2, 1, 40, 'Ingreso inicial', '2026-06-10 21:32:47'),
(3, 3, 2, 5, 'Venta', '2026-06-10 21:32:47'),
(4, 4, 2, 3, 'Venta', '2026-06-10 21:32:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `monto` decimal(14,2) NOT NULL DEFAULT 0.00,
  `comprobante` varchar(500) DEFAULT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `pedido_id`, `estado_id`, `metodo_pago`, `monto`, `comprobante`, `fecha_pago`) VALUES
(1, 1, 1, 'QR', 450.00, NULL, '2026-06-10 21:32:47'),
(2, 2, 1, 'Tarjeta', 320.00, NULL, '2026-06-10 21:32:47'),
(3, 3, 1, 'Efectivo', 170.00, NULL, '2026-06-10 21:32:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `codigo_pedido` varchar(50) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(14,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `estado_id`, `codigo_pedido`, `fecha_pedido`, `total`) VALUES
(1, 1, 1, 'PED001', '2026-06-10 21:32:47', 450.00),
(2, 2, 1, 'PED002', '2026-06-10 21:32:47', 320.00),
(3, 3, 1, 'PED003', '2026-06-10 21:32:47', 170.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalles`
--

CREATE TABLE `pedido_detalles` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_detalles`
--

INSERT INTO `pedido_detalles` (`id`, `pedido_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 6, 1),
(4, 3, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_compra` decimal(12,2) NOT NULL DEFAULT 0.00,
  `precio_venta` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `subcategoria_id`, `marca_id`, `estado_id`, `codigo`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`) VALUES
(1, 1, 1, 1, 'AUT001', 'Piston Toyota Corolla', 'Piston original Toyota', 120.00, 180.00),
(2, 2, 2, 1, 'AUT002', 'Culata Honda Civic', 'Culata completa Honda', 300.00, 450.00),
(3, 3, 3, 1, 'AUT003', 'Pastillas de Freno Nissan', 'Juego completo', 50.00, 90.00),
(4, 4, 4, 1, 'AUT004', 'Disco de Freno Chevrolet', 'Disco delantero', 80.00, 130.00),
(5, 5, 5, 1, 'AUT005', 'Amortiguador Ford', 'Amortiguador trasero', 110.00, 170.00),
(6, 6, 6, 1, 'AUT006', 'Kit Embrague Hyundai', 'Kit completo', 220.00, 320.00),
(7, 7, 7, 1, 'AUT007', 'Rotula Kia', 'Rotula superior', 40.00, 75.00),
(8, 8, 8, 1, 'AUT008', 'Bateria Mazda', 'Bateria 12V', 100.00, 160.00),
(9, 9, 9, 1, 'AUT009', 'Faro Volkswagen', 'Faro delantero', 90.00, 145.00),
(10, 10, 10, 1, 'AUT010', 'Filtro Aceite Suzuki', 'Filtro original', 20.00, 45.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_imagenes`
--

INSERT INTO `producto_imagenes` (`id`, `producto_id`, `imagen`, `principal`) VALUES
(1, 1, 'piston.jpg', 1),
(2, 2, 'culata.jpg', 1),
(3, 3, 'pastillas.jpg', 1),
(4, 4, 'disco.jpg', 1),
(5, 5, 'amortiguador.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedor`
--

CREATE TABLE `producto_proveedor` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `precio_compra` decimal(12,2) NOT NULL DEFAULT 0.00,
  `codigo_proveedor` varchar(100) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_proveedor`
--

INSERT INTO `producto_proveedor` (`id`, `producto_id`, `proveedor_id`, `precio_compra`, `codigo_proveedor`, `principal`) VALUES
(1, 1, 1, 0.00, NULL, 0),
(2, 2, 2, 0.00, NULL, 0),
(3, 3, 3, 0.00, NULL, 0),
(4, 4, 4, 0.00, NULL, 0),
(5, 5, 5, 0.00, NULL, 0),
(6, 6, 6, 0.00, NULL, 0),
(7, 7, 7, 0.00, NULL, 0),
(8, 8, 8, 0.00, NULL, 0),
(9, 9, 9, 0.00, NULL, 0),
(10, 10, 10, 0.00, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `tipo_descuento` varchar(20) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `valor_descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `estado_id`, `tipo_descuento`, `titulo`, `descripcion`, `valor_descuento`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 1, 'PORCENTAJE', 'Promo Frenos', 'Descuento especial en frenos', 10.00, '2026-06-01', '2026-06-30'),
(2, 1, 'PORCENTAJE', 'Promo Motores', 'Descuento especial en motores', 15.00, '2026-06-01', '2026-07-15'),
(3, 1, 'PORCENTAJE', 'Promo Baterias', 'Descuento especial en baterias', 20.00, '2026-06-05', '2026-06-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion_productos`
--

CREATE TABLE `promocion_productos` (
  `id` int(11) NOT NULL,
  `promocion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promocion_productos`
--

INSERT INTO `promocion_productos` (`id`, `promocion_id`, `producto_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 1),
(4, 2, 2),
(5, 3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `nombre_empresa` varchar(200) NOT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `correo` varchar(191) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `estado_id`, `nombre_empresa`, `nit`, `correo`, `direccion`) VALUES
(1, 1, 'AutoPartes Bolivia', '100001', 'contacto@autopartes.com', 'La Paz'),
(2, 1, 'Motores Express', '100002', 'ventas@motores.com', 'Santa Cruz'),
(3, 1, 'Repuestos Toyota', '100003', 'toyota@repuestos.com', 'Cochabamba'),
(4, 1, 'Importadora Automotriz', '100004', 'importadora@gmail.com', 'Oruro'),
(5, 1, 'Frenos Center', '100005', 'frenos@gmail.com', 'Tarija'),
(6, 1, 'Suspension Pro', '100006', 'suspension@gmail.com', 'Beni'),
(7, 1, 'Lubricantes Max', '100007', 'lubricantes@gmail.com', 'Pando'),
(8, 1, 'Electric Auto', '100008', 'electric@gmail.com', 'La Paz'),
(9, 1, 'Faros y Accesorios', '100009', 'faros@gmail.com', 'Santa Cruz'),
(10, 1, 'Mega Repuestos', '100010', 'mega@gmail.com', 'Cochabamba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `calificacion` tinyint(4) NOT NULL CHECK (`calificacion` between 1 and 5),
  `comentario` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resenas`
--

INSERT INTO `resenas` (`id`, `user_id`, `producto_id`, `estado_id`, `calificacion`, `comentario`, `created_at`) VALUES
(1, 1, 1, 1, 5, 'Excelente calidad', '2026-06-10 21:32:47'),
(2, 2, 3, 1, 4, 'Muy buen producto', '2026-06-10 21:32:47'),
(3, 3, 5, 1, 5, 'Recomendado', '2026-06-10 21:32:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'cliente'),
(3, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_productos`
--

CREATE TABLE `stock_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_actual` int(11) NOT NULL DEFAULT 0,
  `stock_minimo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock_productos`
--

INSERT INTO `stock_productos` (`id`, `producto_id`, `cantidad_actual`, `stock_minimo`) VALUES
(1, 1, 50, 10),
(2, 2, 40, 10),
(3, 3, 35, 10),
(4, 4, 60, 15),
(5, 5, 25, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `categoria_id`, `nombre`) VALUES
(1, 1, 'Pistones'),
(2, 1, 'Culatas'),
(3, 2, 'Pastillas de Freno'),
(4, 2, 'Discos de Freno'),
(5, 3, 'Amortiguadores'),
(6, 4, 'Embragues'),
(7, 5, 'Rotulas'),
(8, 6, 'Baterias'),
(9, 7, 'Faros'),
(10, 9, 'Filtros de Aceite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos_proveedores`
--

CREATE TABLE `telefonos_proveedores` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `tipo_telefono_id` int(11) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `telefonos_proveedores`
--

INSERT INTO `telefonos_proveedores` (`id`, `proveedor_id`, `tipo_telefono_id`, `numero`, `principal`) VALUES
(1, 1, 1, '72000001', 0),
(2, 2, 1, '72000002', 0),
(3, 3, 1, '72000003', 0),
(4, 4, 1, '72000004', 0),
(5, 5, 1, '72000005', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos_usuarios`
--

CREATE TABLE `telefonos_usuarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tipo_telefono_id` int(11) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `telefonos_usuarios`
--

INSERT INTO `telefonos_usuarios` (`id`, `user_id`, `tipo_telefono_id`, `numero`, `principal`) VALUES
(1, 1, 1, '70111111', 0),
(2, 2, 1, '70222222', 0),
(3, 3, 1, '70333333', 0),
(4, 4, 1, '70444444', 0),
(5, 5, 1, '70555555', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_telefono`
--

CREATE TABLE `tipos_telefono` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_telefono`
--

INSERT INTO `tipos_telefono` (`id`, `nombre`) VALUES
(2, 'Casa'),
(1, 'Celular'),
(3, 'Trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol_id`, `estado_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 1, 1, 'Administrador', 'admin@gmail.com', '$2y$10$KKrrvSnn8PcM4mZu6HVZ2eGF2kJwXYUBLXw9qTcCkYylZ6SmA4DaG', '2026-06-10 21:32:45'),
(2, 3, 1, 'Vendedor', 'vendedor@gmail.com', '$2y$10$ZzsG8EPZzIJ6j1iVE5ApYuXFNewjvrK/wT1AMeEHhKxTjVu2RrZUu', '2026-06-10 21:32:45'),
(3, 2, 1, 'Carlos Perez', 'carlos@gmail.com', '$2y$10$rRdY8afxT0G8AQxl3SrM8ufyaaDxlOV.nps4x/fjEI8al9T3phYxm', '2026-06-10 21:32:45'),
(4, 2, 1, 'Juan Flores', 'juan@gmail.com', '$2y$10$UAl0QdKnofPyUc/UGr0Wpe4wCTBuQNXtNiwElfIr5/K3v1lK89U0m', '2026-06-10 21:32:45'),
(5, 2, 1, 'Maria Lopez', 'maria@gmail.com', '$2y$10$leYNnX2lkC5ldY7LzJLD.OkGdWVcgcGpANomw/.VO82VAR7ROWrU.', '2026-06-10 21:32:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrito_user` (`user_id`),
  ADD KEY `fk_carrito_estado` (`estado_id`);

--
-- Indices de la tabla `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_carrito_prod` (`carrito_id`,`producto_id`),
  ADD KEY `fk_cd_prod` (`producto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_cat` (`nombre`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_env_estado` (`estado_id`),
  ADD KEY `idx_envios_pedido` (`pedido_id`);

--
-- Indices de la tabla `estados_general`
--
ALTER TABLE `estados_general`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_catalogo` (`tipo`,`nombre`),
  ADD KEY `idx_catalogos_tipo` (`tipo`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_marca` (`nombre`);

--
-- Indices de la tabla `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mov_tipo` (`tipo_movimiento_id`),
  ADD KEY `idx_movstock_producto` (`producto_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pago_estado` (`estado_id`),
  ADD KEY `idx_pagos_pedido` (`pedido_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_codigo_pedido` (`codigo_pedido`),
  ADD KEY `idx_pedidos_user` (`user_id`),
  ADD KEY `idx_pedidos_estado` (`estado_id`);

--
-- Indices de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pdet_prod` (`producto_id`),
  ADD KEY `idx_pedido_det_pedido` (`pedido_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_prod_codigo` (`codigo`),
  ADD KEY `fk_prod_estado` (`estado_id`),
  ADD KEY `idx_productos_subcategoria` (`subcategoria_id`),
  ADD KEY `idx_productos_marca` (`marca_id`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_img_prod` (`producto_id`);

--
-- Indices de la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_prod_prov` (`producto_id`,`proveedor_id`),
  ADD KEY `fk_pp_prov` (`proveedor_id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_promo_estado` (`estado_id`);

--
-- Indices de la tabla `promocion_productos`
--
ALTER TABLE `promocion_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_promo_prod` (`promocion_id`,`producto_id`),
  ADD KEY `fk_pp2_prod` (`producto_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prov_estado` (`estado_id`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_res_user` (`user_id`),
  ADD KEY `fk_res_estado` (`estado_id`),
  ADD KEY `idx_resenas_producto` (`producto_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_rol` (`nombre`);

--
-- Indices de la tabla `stock_productos`
--
ALTER TABLE `stock_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_stock_prod` (`producto_id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcat_cat` (`categoria_id`);

--
-- Indices de la tabla `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_telprov_prov` (`proveedor_id`),
  ADD KEY `fk_telprov_tipo` (`tipo_telefono_id`);

--
-- Indices de la tabla `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teluser_user` (`user_id`),
  ADD KEY `fk_teluser_tipo` (`tipo_telefono_id`);

--
-- Indices de la tabla `tipos_telefono`
--
ALTER TABLE `tipos_telefono`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_tipo_tel` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`),
  ADD KEY `fk_user_rol` (`rol_id`),
  ADD KEY `fk_user_estado` (`estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados_general`
--
ALTER TABLE `estados_general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `promocion_productos`
--
ALTER TABLE `promocion_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `stock_productos`
--
ALTER TABLE `stock_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_telefono`
--
ALTER TABLE `tipos_telefono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `fk_carrito_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_carrito_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  ADD CONSTRAINT `fk_cd_carrito` FOREIGN KEY (`carrito_id`) REFERENCES `carritos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cd_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `fk_env_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_env_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  ADD CONSTRAINT `fk_mov_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_mov_tipo` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `estados_general` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pago_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_pago_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_ped_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_ped_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD CONSTRAINT `fk_pdet_ped` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pdet_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_prod_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_prod_marca` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `fk_prod_subcat` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategorias` (`id`);

--
-- Filtros para la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `fk_img_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD CONSTRAINT `fk_pp_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_pp_prov` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `fk_promo_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`);

--
-- Filtros para la tabla `promocion_productos`
--
ALTER TABLE `promocion_productos`
  ADD CONSTRAINT `fk_pp2_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_pp2_promo` FOREIGN KEY (`promocion_id`) REFERENCES `promociones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `fk_prov_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`);

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `fk_res_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_res_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_res_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `stock_productos`
--
ALTER TABLE `stock_productos`
  ADD CONSTRAINT `fk_stock_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcat_cat` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  ADD CONSTRAINT `fk_telprov_prov` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_telprov_tipo` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipos_telefono` (`id`);

--
-- Filtros para la tabla `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  ADD CONSTRAINT `fk_teluser_tipo` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipos_telefono` (`id`),
  ADD CONSTRAINT `fk_teluser_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_general` (`id`),
  ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
