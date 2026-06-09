-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2026 a las 03:49:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Tabla carritos, guarda el carrito principal de cada usuario
--

CREATE TABLE `carritos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Detalle del carrito, aqui van los productos agregados
--

CREATE TABLE `carrito_detalles` (
  `id` int(11) NOT NULL,
  `carrito_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Catalogos generales para estados y tipos del sistema
--

CREATE TABLE `catalogos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Datos iniciales de catalogos, no borrar porque se usan como estados
--

INSERT INTO `catalogos` (`id`, `tipo`, `nombre`) VALUES
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
-- Categorias principales de los repuestos
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Envios de los pedidos realizados
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

-- --------------------------------------------------------

--
-- Marcas de los productos o repuestos
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Movimientos del stock, entradas salidas y ajustes
--

CREATE TABLE `movimientos_stock` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `tipo_movimiento_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `motivo` varchar(300) DEFAULT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Pagos de los pedidos
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

-- --------------------------------------------------------

--
-- Pedidos hechos por los usuarios
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `codigo_pedido` varchar(50) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(14,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Detalle de cada pedido, productos y subtotales
--

CREATE TABLE `pedido_detalles` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(12,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(14,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Productos de la tienda de motorepuestos
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

-- --------------------------------------------------------

--
-- Imagenes de los productos
--

CREATE TABLE `producto_imagenes` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Relacion entre productos y proveedores
--

CREATE TABLE `producto_proveedor` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `precio_compra` decimal(12,2) NOT NULL DEFAULT 0.00,
  `codigo_proveedor` varchar(100) DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Promociones o descuentos de la tienda
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

-- --------------------------------------------------------

--
-- Productos que entran en una promocion
--

CREATE TABLE `promocion_productos` (
  `id` int(11) NOT NULL,
  `promocion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Proveedores que abastecen los repuestos
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `nombre_empresa` varchar(200) NOT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `correo` varchar(191) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Reseñas y calificaciones de los productos
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

-- --------------------------------------------------------

--
-- Roles del sistema
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Datos iniciales para roles
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'cliente'),
(3, 'vendedor');

-- --------------------------------------------------------

--
-- Stock actual y minimo de cada producto
--

CREATE TABLE `stock_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_actual` int(11) NOT NULL DEFAULT 0,
  `stock_minimo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Subcategorias que dependen de categorias
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Telefonos de los proveedores
--

CREATE TABLE `telefonos_proveedores` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `tipo_telefono_id` int(11) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Telefonos de los usuarios
--

CREATE TABLE `telefonos_usuarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tipo_telefono_id` int(11) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tipos de telefono que se pueden registrar
--

CREATE TABLE `tipos_telefono` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Datos iniciales para tipos de telefono
--

INSERT INTO `tipos_telefono` (`id`, `nombre`) VALUES
(1, 'celular'),
(2, 'fijo'),
(3, 'whatsapp');

-- --------------------------------------------------------

--
-- Usuarios registrados en el sistema
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
-- Indices de las tablas, importante para llaves y busquedas
--

--
-- Indices de `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrito_user` (`user_id`),
  ADD KEY `fk_carrito_estado` (`estado_id`);

--
-- Indices de `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_carrito_prod` (`carrito_id`,`producto_id`),
  ADD KEY `fk_cd_prod` (`producto_id`);

--
-- Indices de `catalogos`
--
ALTER TABLE `catalogos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_catalogo` (`tipo`,`nombre`),
  ADD KEY `idx_catalogos_tipo` (`tipo`);

--
-- Indices de `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_cat` (`nombre`);

--
-- Indices de `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_env_estado` (`estado_id`),
  ADD KEY `idx_envios_pedido` (`pedido_id`);

--
-- Indices de `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_marca` (`nombre`);

--
-- Indices de `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mov_tipo` (`tipo_movimiento_id`),
  ADD KEY `idx_movstock_producto` (`producto_id`);

--
-- Indices de `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pago_estado` (`estado_id`),
  ADD KEY `idx_pagos_pedido` (`pedido_id`);

--
-- Indices de `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_codigo_pedido` (`codigo_pedido`),
  ADD KEY `idx_pedidos_user` (`user_id`),
  ADD KEY `idx_pedidos_estado` (`estado_id`);

--
-- Indices de `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pdet_prod` (`producto_id`),
  ADD KEY `idx_pedido_det_pedido` (`pedido_id`);

--
-- Indices de `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_prod_codigo` (`codigo`),
  ADD KEY `fk_prod_estado` (`estado_id`),
  ADD KEY `idx_productos_subcategoria` (`subcategoria_id`),
  ADD KEY `idx_productos_marca` (`marca_id`);

--
-- Indices de `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_img_prod` (`producto_id`);

--
-- Indices de `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_prod_prov` (`producto_id`,`proveedor_id`),
  ADD KEY `fk_pp_prov` (`proveedor_id`);

--
-- Indices de `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_promo_estado` (`estado_id`);

--
-- Indices de `promocion_productos`
--
ALTER TABLE `promocion_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_promo_prod` (`promocion_id`,`producto_id`),
  ADD KEY `fk_pp2_prod` (`producto_id`);

--
-- Indices de `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prov_estado` (`estado_id`);

--
-- Indices de `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_res_user` (`user_id`),
  ADD KEY `fk_res_estado` (`estado_id`),
  ADD KEY `idx_resenas_producto` (`producto_id`);

--
-- Indices de `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_rol` (`nombre`);

--
-- Indices de `stock_productos`
--
ALTER TABLE `stock_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_stock_prod` (`producto_id`);

--
-- Indices de `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcat_cat` (`categoria_id`);

--
-- Indices de `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_telprov_prov` (`proveedor_id`),
  ADD KEY `fk_telprov_tipo` (`tipo_telefono_id`);

--
-- Indices de `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teluser_user` (`user_id`),
  ADD KEY `fk_teluser_tipo` (`tipo_telefono_id`);

--
-- Indices de `tipos_telefono`
--
ALTER TABLE `tipos_telefono`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_tipo_tel` (`nombre`);

--
-- Indices de `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`),
  ADD KEY `fk_user_rol` (`rol_id`),
  ADD KEY `fk_user_estado` (`estado_id`);

--
-- Auto increment de las tablas
--

--
-- Auto incremental para `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `catalogos`
--
ALTER TABLE `catalogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Auto incremental para `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `promocion_productos`
--
ALTER TABLE `promocion_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Auto incremental para `stock_productos`
--
ALTER TABLE `stock_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Auto incremental para `tipos_telefono`
--
ALTER TABLE `tipos_telefono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Auto incremental para `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Llaves foraneas y relaciones entre tablas
--

--
-- Relaciones de `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `fk_carrito_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_carrito_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Relaciones de `carrito_detalles`
--
ALTER TABLE `carrito_detalles`
  ADD CONSTRAINT `fk_cd_carrito` FOREIGN KEY (`carrito_id`) REFERENCES `carritos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cd_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Relaciones de `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `fk_env_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_env_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Relaciones de `movimientos_stock`
--
ALTER TABLE `movimientos_stock`
  ADD CONSTRAINT `fk_mov_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_mov_tipo` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `catalogos` (`id`);

--
-- Relaciones de `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pago_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_pago_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Relaciones de `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_ped_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_ped_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Relaciones de `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD CONSTRAINT `fk_pdet_ped` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pdet_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Relaciones de `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_prod_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_prod_marca` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `fk_prod_subcat` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategorias` (`id`);

--
-- Relaciones de `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `fk_img_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Relaciones de `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD CONSTRAINT `fk_pp_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_pp_prov` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Relaciones de `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `fk_promo_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`);

--
-- Relaciones de `promocion_productos`
--
ALTER TABLE `promocion_productos`
  ADD CONSTRAINT `fk_pp2_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_pp2_promo` FOREIGN KEY (`promocion_id`) REFERENCES `promociones` (`id`) ON DELETE CASCADE;

--
-- Relaciones de `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `fk_prov_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`);

--
-- Relaciones de `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `fk_res_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_res_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_res_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Relaciones de `stock_productos`
--
ALTER TABLE `stock_productos`
  ADD CONSTRAINT `fk_stock_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Relaciones de `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcat_cat` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Relaciones de `telefonos_proveedores`
--
ALTER TABLE `telefonos_proveedores`
  ADD CONSTRAINT `fk_telprov_prov` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_telprov_tipo` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipos_telefono` (`id`);

--
-- Relaciones de `telefonos_usuarios`
--
ALTER TABLE `telefonos_usuarios`
  ADD CONSTRAINT `fk_teluser_tipo` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipos_telefono` (`id`),
  ADD CONSTRAINT `fk_teluser_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Relaciones de `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_estado` FOREIGN KEY (`estado_id`) REFERENCES `catalogos` (`id`),
  ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;