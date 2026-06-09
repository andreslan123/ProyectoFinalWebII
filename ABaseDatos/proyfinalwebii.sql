-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2026 a las 22:29:33
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
(1, 2, 34, '2026-06-09 09:00:00'),
(2, 3, 34, '2026-06-09 09:05:00'),
(3, 4, 35, '2026-06-09 09:10:00'),
(4, 5, 34, '2026-06-09 09:15:00'),
(5, 6, 36, '2026-06-09 09:20:00'),
(6, 7, 34, '2026-06-09 09:25:00'),
(7, 8, 35, '2026-06-09 09:30:00'),
(8, 9, 34, '2026-06-09 09:35:00'),
(9, 10, 36, '2026-06-09 09:40:00'),
(10, 2, 34, '2026-06-09 09:45:00');

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
(1, 1, 1, 1),
(2, 2, 3, 2),
(3, 3, 5, 1),
(4, 4, 8, 1),
(5, 5, 10, 3),
(6, 6, 2, 1),
(7, 7, 7, 2),
(8, 8, 4, 1),
(9, 9, 9, 1),
(10, 10, 6, 1);

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
(9, 'Accesorios'),
(10, 'Cascos'),
(2, 'Filtros'),
(3, 'Frenos'),
(8, 'Iluminacion'),
(1, 'Lubricantes'),
(6, 'Neumaticos'),
(4, 'Sistema Electrico'),
(7, 'Suspension'),
(5, 'Transmision');

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
(1, 1, 21, 'Delivery local', 'ENV-0001', 'Racing10 Express', 15.00, '2026-06-01 12:00:00', '2026-06-01 18:00:00'),
(2, 2, 20, 'Encomienda', 'ENV-0002', 'Trans Copacabana', 25.00, '2026-06-02 13:00:00', NULL),
(3, 3, 19, 'Recojo en tienda', NULL, NULL, 0.00, NULL, NULL),
(4, 4, 20, 'Delivery local', 'ENV-0004', 'Racing10 Express', 15.00, '2026-06-04 15:00:00', NULL),
(5, 5, 19, 'Encomienda', 'ENV-0005', 'Bolivar Cargo', 30.00, NULL, NULL),
(6, 6, 21, 'Delivery local', 'ENV-0006', 'Racing10 Express', 15.00, '2026-06-06 17:00:00', '2026-06-06 20:00:00'),
(7, 7, 19, 'Recojo en tienda', NULL, NULL, 0.00, NULL, NULL),
(8, 8, 20, 'Encomienda', 'ENV-0008', 'Trans Azul', 28.00, '2026-06-08 19:00:00', NULL),
(9, 9, 19, 'Delivery local', 'ENV-0009', 'Racing10 Express', 15.00, NULL, NULL),
(10, 10, 20, 'Encomienda', 'ENV-0010', 'Bolivar Cargo', 30.00, '2026-06-09 20:00:00', NULL);

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
(5, 'Bajaj'),
(1, 'Honda'),
(8, 'Italika'),
(4, 'Kawasaki'),
(6, 'KTM'),
(9, 'Loncin'),
(10, 'NGK'),
(3, 'Suzuki'),
(7, 'TVS'),
(2, 'Yamaha');

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
(1, 1, 29, 50, 'Compra inicial de aceite Honda.', '2026-06-01 08:00:00'),
(2, 1, 30, 10, 'Ventas realizadas durante la semana.', '2026-06-07 18:00:00'),
(3, 2, 29, 40, 'Ingreso de filtros de aceite.', '2026-06-01 08:10:00'),
(4, 2, 30, 5, 'Salida por pedidos de clientes.', '2026-06-07 18:10:00'),
(5, 3, 29, 30, 'Ingreso de pastillas de freno.', '2026-06-01 08:20:00'),
(6, 3, 30, 5, 'Venta en tienda.', '2026-06-07 18:20:00'),
(7, 4, 29, 70, 'Ingreso de bujias NGK.', '2026-06-01 08:30:00'),
(8, 4, 30, 10, 'Salida por mantenimiento preventivo.', '2026-06-07 18:30:00'),
(9, 5, 29, 20, 'Ingreso de cadenas reforzadas.', '2026-06-01 08:40:00'),
(10, 5, 30, 2, 'Venta de cadenas.', '2026-06-07 18:40:00'),
(11, 6, 29, 25, 'Ingreso de coronas Bajaj.', '2026-06-01 08:50:00'),
(12, 6, 30, 5, 'Ventas de transmision.', '2026-06-07 18:50:00'),
(13, 7, 29, 15, 'Ingreso de llantas tubeless.', '2026-06-01 09:00:00'),
(14, 7, 30, 3, 'Ventas de llantas.', '2026-06-07 19:00:00'),
(15, 8, 29, 18, 'Ingreso de amortiguadores.', '2026-06-01 09:10:00'),
(16, 8, 30, 3, 'Venta de amortiguadores.', '2026-06-07 19:10:00'),
(17, 9, 29, 25, 'Ingreso de faros LED.', '2026-06-01 09:20:00'),
(18, 9, 30, 3, 'Venta de faros LED.', '2026-06-07 19:20:00'),
(19, 10, 29, 12, 'Ingreso de cascos integrales.', '2026-06-01 09:30:00'),
(20, 10, 30, 2, 'Venta de cascos.', '2026-06-07 19:30:00');

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
(1, 1, 16, 'QR', 235.00, 'comprobantes/pago-0001.jpg', '2026-06-01 10:15:00'),
(2, 2, 16, 'Transferencia bancaria', 250.00, 'comprobantes/pago-0002.jpg', '2026-06-02 11:15:00'),
(3, 3, 15, 'Efectivo contra entrega', 260.00, NULL, '2026-06-03 12:15:00'),
(4, 4, 16, 'QR', 460.00, 'comprobantes/pago-0004.jpg', '2026-06-04 13:15:00'),
(5, 5, 15, 'Transferencia bancaria', 400.00, NULL, '2026-06-05 14:15:00'),
(6, 6, 16, 'QR', 300.00, 'comprobantes/pago-0006.jpg', '2026-06-06 15:15:00'),
(7, 7, 16, 'Tarjeta', 210.00, 'comprobantes/pago-0007.jpg', '2026-06-07 16:15:00'),
(8, 8, 16, 'QR', 390.00, 'comprobantes/pago-0008.jpg', '2026-06-08 17:15:00'),
(9, 9, 15, 'Efectivo contra entrega', 255.00, NULL, '2026-06-09 18:15:00'),
(10, 10, 16, 'Transferencia bancaria', 500.00, 'comprobantes/pago-0010.jpg', '2026-06-09 19:15:00');

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
(1, 2, 13, 'PED-2026-0001', '2026-06-01 10:00:00', 235.00),
(2, 3, 12, 'PED-2026-0002', '2026-06-02 11:00:00', 250.00),
(3, 4, 10, 'PED-2026-0003', '2026-06-03 12:00:00', 260.00),
(4, 5, 11, 'PED-2026-0004', '2026-06-04 13:00:00', 460.00),
(5, 6, 9, 'PED-2026-0005', '2026-06-05 14:00:00', 400.00),
(6, 7, 13, 'PED-2026-0006', '2026-06-06 15:00:00', 300.00),
(7, 8, 10, 'PED-2026-0007', '2026-06-07 16:00:00', 210.00),
(8, 9, 12, 'PED-2026-0008', '2026-06-08 17:00:00', 390.00),
(9, 10, 9, 'PED-2026-0009', '2026-06-09 18:00:00', 255.00),
(10, 2, 10, 'PED-2026-0010', '2026-06-09 19:00:00', 500.00);

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
(2, 2, 3, 2),
(3, 3, 5, 1),
(4, 4, 8, 1),
(5, 5, 10, 3),
(6, 6, 2, 1),
(7, 7, 7, 2),
(8, 8, 4, 1),
(9, 9, 9, 1),
(10, 10, 6, 1);

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
(1, 1, 1, 4, 'MOT001', 'Aceite Honda 20W50 1L', 'Aceite mineral para motocicleta de uso diario.', 55.00, 80.00),
(2, 2, 1, 4, 'MOT002', 'Filtro de Aceite Honda CG', 'Filtro compatible con motores Honda CG y modelos similares.', 18.00, 35.00),
(3, 3, 2, 4, 'MOT003', 'Pastillas de Freno Yamaha FZ', 'Juego de pastillas delanteras de alto rendimiento.', 45.00, 75.00),
(4, 4, 10, 4, 'MOT004', 'Bujia NGK Iridium CR8EIX', 'Bujia iridium para mejor encendido y respuesta.', 35.00, 60.00),
(5, 5, 3, 4, 'MOT005', 'Cadena Reforzada 428H', 'Cadena reforzada para motocicletas urbanas y deportivas.', 80.00, 130.00),
(6, 6, 5, 4, 'MOT006', 'Corona Bajaj Pulsar 43T', 'Corona trasera compatible con Bajaj Pulsar.', 65.00, 110.00),
(7, 7, 4, 4, 'MOT007', 'Llanta Tubeless 90/90-18', 'Llanta para uso urbano con buena adherencia.', 180.00, 260.00),
(8, 8, 7, 4, 'MOT008', 'Amortiguador Trasero Universal', 'Amortiguador reforzado para motocicletas medianas.', 170.00, 250.00),
(9, 9, 8, 4, 'MOT009', 'Faro LED Auxiliar 12V', 'Faro LED auxiliar para mayor visibilidad nocturna.', 90.00, 150.00),
(10, 10, 6, 4, 'MOT010', 'Casco Integral Racing Negro', 'Casco integral con diseño deportivo y visor transparente.', 260.00, 390.00);

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
(1, 1, 'imagenes/productos/aceite-honda-20w50.jpg', 1),
(2, 2, 'imagenes/productos/filtro-aceite-honda-cg.jpg', 1),
(3, 3, 'imagenes/productos/pastillas-freno-yamaha-fz.jpg', 1),
(4, 4, 'imagenes/productos/bujia-ngk-iridium.jpg', 1),
(5, 5, 'imagenes/productos/cadena-reforzada-428h.jpg', 1),
(6, 6, 'imagenes/productos/corona-bajaj-pulsar.jpg', 1),
(7, 7, 'imagenes/productos/llanta-tubeless-9090-18.jpg', 1),
(8, 8, 'imagenes/productos/amortiguador-trasero.jpg', 1),
(9, 9, 'imagenes/productos/faro-led-auxiliar.jpg', 1),
(10, 10, 'imagenes/productos/casco-integral-racing.jpg', 1);

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
(1, 1, 4, 55.00, 'PROV-ACE-001', 1),
(2, 2, 3, 18.00, 'PROV-FIL-002', 1),
(3, 3, 5, 45.00, 'PROV-FRE-003', 1),
(4, 4, 8, 35.00, 'PROV-BUJ-004', 1),
(5, 5, 6, 80.00, 'PROV-CAD-005', 1),
(6, 6, 6, 65.00, 'PROV-COR-006', 1),
(7, 7, 7, 180.00, 'PROV-LLA-007', 1),
(8, 8, 2, 170.00, 'PROV-AMO-008', 1),
(9, 9, 8, 90.00, 'PROV-LED-009', 1),
(10, 10, 10, 260.00, 'PROV-CAS-010', 1);

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
(1, 23, 'porcentaje', 'Descuento en aceites Honda', 'Promocion especial en aceites para mantenimiento preventivo.', 10.00, '2026-06-01', '2026-06-30'),
(2, 23, 'porcentaje', 'Frenos seguros', 'Descuento para pastillas de freno seleccionadas.', 15.00, '2026-06-01', '2026-06-30'),
(3, 23, 'monto_fijo', 'Rebaja en casco racing', 'Precio especial para cascos integrales.', 40.00, '2026-06-01', '2026-06-25'),
(4, 23, 'porcentaje', 'Promo transmision', 'Descuento en cadena reforzada.', 12.00, '2026-06-05', '2026-07-05'),
(5, 24, 'porcentaje', 'Oferta futura en llantas', 'Promocion programada para llantas tubeless.', 8.00, '2026-07-01', '2026-07-31'),
(6, 23, 'monto_fijo', 'Faro LED en oferta', 'Descuento directo para faro LED auxiliar.', 20.00, '2026-06-01', '2026-06-20'),
(7, 23, 'porcentaje', 'Bujias NGK', 'Descuento por mantenimiento de encendido.', 10.00, '2026-06-01', '2026-06-30'),
(8, 25, 'porcentaje', 'Campaña pasada de filtros', 'Promocion vencida de filtros de aceite.', 5.00, '2026-05-01', '2026-05-31'),
(9, 23, 'monto_fijo', 'Amortiguador reforzado', 'Rebaja en suspension trasera.', 30.00, '2026-06-02', '2026-06-28'),
(10, 23, 'porcentaje', 'Corona Bajaj', 'Descuento para corona de transmision.', 10.00, '2026-06-03', '2026-06-30');

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
(1, 1, 1),
(2, 2, 3),
(3, 3, 10),
(4, 4, 5),
(5, 5, 7),
(6, 6, 9),
(7, 7, 4),
(8, 8, 2),
(9, 9, 8),
(10, 10, 6);

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
(1, 7, 'Importadora MotoParts Bolivia', '100001', 'ventas@motopartsbolivia.com', 'Av. Buenos Aires #120, La Paz'),
(2, 7, 'Repuestos Racing10 SRL', '100002', 'contacto@racing10.com', 'Av. Blanco Galindo Km 4, Cochabamba'),
(3, 7, 'Distribuidora Honda Sur', '100003', 'hondasur@gmail.com', 'Av. Santos Dumont #450, Santa Cruz'),
(4, 7, 'Lubricantes Max Moto', '100004', 'lubrimax@gmail.com', 'Zona Central #88, Oruro'),
(5, 7, 'Frenos y Pastillas Pro', '100005', 'frenospro@gmail.com', 'Mercado Campesino #25, Sucre'),
(6, 7, 'Transmision Moto Center', '100006', 'transmisioncenter@gmail.com', 'Av. Circunvalacion #340, Tarija'),
(7, 7, 'Neumaticos del Oriente', '100007', 'neumaticosoriente@gmail.com', '3er Anillo Interno #770, Santa Cruz'),
(8, 7, 'Electric Moto Bolivia', '100008', 'electricmoto@gmail.com', 'Calle Comercio #45, La Paz'),
(9, 7, 'Accesorios Rider Store', '100009', 'riderstore@gmail.com', 'Av. Aroma #210, Cochabamba'),
(10, 7, 'Cascos y Seguridad Total', '100010', 'seguridadtotal@gmail.com', 'Av. Panamericana #15, Potosi');

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
(1, 2, 1, 27, 5, 'Buen aceite, la moto trabaja mas suave.', '2026-06-02 09:00:00'),
(2, 3, 3, 27, 4, 'Las pastillas frenan bien y no hacen mucho ruido.', '2026-06-03 09:30:00'),
(3, 4, 7, 26, 5, 'La llanta se ve resistente, falta probar en ruta.', '2026-06-04 10:00:00'),
(4, 5, 10, 27, 5, 'El casco es comodo y tiene buen diseño.', '2026-06-05 10:30:00'),
(5, 6, 8, 27, 4, 'Buen amortiguador para uso urbano.', '2026-06-06 11:00:00'),
(6, 7, 6, 27, 5, 'La corona encajo perfecto en mi Pulsar.', '2026-06-07 11:30:00'),
(7, 8, 4, 27, 4, 'La bujia mejoro el arranque.', '2026-06-08 12:00:00'),
(8, 9, 5, 26, 5, 'Cadena fuerte y buen precio.', '2026-06-09 12:30:00'),
(9, 10, 9, 27, 4, 'El faro ilumina bastante bien de noche.', '2026-06-09 13:00:00'),
(10, 2, 2, 27, 5, 'Filtro correcto para mantenimiento.', '2026-06-09 13:30:00');

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
(1, 1, 40, 10),
(2, 2, 35, 8),
(3, 3, 25, 6),
(4, 4, 60, 10),
(5, 5, 18, 5),
(6, 6, 20, 5),
(7, 7, 12, 4),
(8, 8, 15, 4),
(9, 9, 22, 5),
(10, 10, 10, 3);

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
(1, 1, 'Aceites para motor'),
(2, 2, 'Filtros de aceite'),
(3, 3, 'Pastillas de freno'),
(4, 4, 'Bujias'),
(5, 5, 'Cadenas'),
(6, 5, 'Coronas y piñones'),
(7, 6, 'Llantas'),
(8, 7, 'Amortiguadores'),
(9, 8, 'Faros LED'),
(10, 10, 'Cascos integrales');

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
(1, 1, 1, '72000001', 1),
(2, 2, 1, '72000002', 1),
(3, 3, 3, '72000003', 1),
(4, 4, 1, '72000004', 1),
(5, 5, 3, '72000005', 1),
(6, 6, 1, '72000006', 1),
(7, 7, 1, '72000007', 1),
(8, 8, 3, '72000008', 1),
(9, 9, 2, '4402009', 1),
(10, 10, 1, '72000010', 1);

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
(1, 1, 1, '70100001', 1),
(2, 2, 1, '70100002', 1),
(3, 3, 3, '70100003', 1),
(4, 4, 1, '70100004', 1),
(5, 5, 3, '70100005', 1),
(6, 6, 1, '70100006', 1),
(7, 7, 3, '70100007', 1),
(8, 8, 1, '70100008', 1),
(9, 9, 2, '2401009', 1),
(10, 10, 1, '70100010', 1);

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
(1, 'celular'),
(2, 'fijo'),
(3, 'whatsapp');

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
(1, 1, 1, 'Administrador Racing10', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:00:00'),
(2, 2, 1, 'Carlos Mendoza', 'carlos@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:05:00'),
(3, 2, 1, 'Maria Flores', 'maria@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:10:00'),
(4, 2, 1, 'Jorge Aguilar', 'jorge@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:15:00'),
(5, 2, 1, 'Lucia Vargas', 'lucia@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:20:00'),
(6, 2, 1, 'Diego Rojas', 'diego@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:25:00'),
(7, 2, 1, 'Andrea Quispe', 'andrea@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:30:00'),
(8, 2, 1, 'Miguel Torres', 'miguel@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:35:00'),
(9, 3, 1, 'Valeria Choque', 'valeria@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:40:00'),
(10, 3, 1, 'Pedro Fernandez', 'pedro@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-06-09 08:45:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `promocion_productos`
--
ALTER TABLE `promocion_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `stock_productos`
--
ALTER TABLE `stock_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos_telefono`
--
ALTER TABLE `tipos_telefono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
