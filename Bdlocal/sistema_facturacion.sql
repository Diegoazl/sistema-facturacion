-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2025 a las 23:52:31
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
-- Base de datos: `sistema_facturacion`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_factura_y_productos` (IN `fkidcliente` INT, IN `fkidvendedor` INT, IN `productos` JSON)   BEGIN
    -- Declaraciones de variables
    DECLARE nuevoNumeroFactura INT;
    DECLARE totalFactura DECIMAL(10,2) DEFAULT 0;
    DECLARE productoId VARCHAR(30);
    DECLARE cantidad INT;
    DECLARE subtotal DECIMAL(10,2);
    DECLARE i INT DEFAULT 0;
    DECLARE jsonLength INT;

    -- Obtener la longitud del JSON para iterar
    SET jsonLength = JSON_LENGTH(productos);

    -- Iniciar la transacción
    START TRANSACTION;

    -- Inserta la nueva factura
    INSERT INTO factura (fkidcliente, fkidvendedor)
    VALUES (fkidcliente, fkidvendedor);

    -- Obtener el ID de la factura recién insertada
    SET nuevoNumeroFactura = LAST_INSERT_ID();

    -- Iterar sobre los productos enviados en el JSON
    WHILE i < jsonLength DO
        -- Obtener el producto y la cantidad desde el JSON
        SET productoId = JSON_UNQUOTE(JSON_EXTRACT(productos, CONCAT('$[', i, '].fkcodproducto')));
        SET cantidad = JSON_UNQUOTE(JSON_EXTRACT(productos, CONCAT('$[', i, '].cantidad')));

        -- Calcular el subtotal de este producto
        SELECT valorunitario INTO subtotal
        FROM producto
        WHERE codigo = productoId;

        SET subtotal = cantidad * subtotal;

        -- Insertar el producto en productosporfactura
        INSERT INTO productosporfactura (fknumfactura, fkcodproducto, cantidad, subtotal)
        VALUES (nuevoNumeroFactura, productoId, cantidad, subtotal);

        -- Actualizar el total de la factura
        SET totalFactura = totalFactura + subtotal;

        -- Actualizar el stock de los productos en la tabla producto
        UPDATE producto
        SET stock = stock - cantidad
        WHERE codigo = productoId;

        -- Incrementar el índice
        SET i = i + 1;
    END WHILE;

    -- Actualizar el total en la factura
    UPDATE factura
    SET total = totalFactura
    WHERE numero = nuevoNumeroFactura;

    -- Confirmar la transacción
    COMMIT;

END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_subtotal_y_total` (`fknumfactura` INT, `fkcodproducto` VARCHAR(30), `cantidad` INT) RETURNS DECIMAL(10,2) DETERMINISTIC BEGIN
    DECLARE subtotal DECIMAL(10,2);
    DECLARE valorunitario DECIMAL(10,2);
    DECLARE stock INT;

    -- Obtener el valorunitario y el stock del producto
    SELECT valorunitario, stock INTO valorunitario, stock
    FROM producto
    WHERE codigo = fkcodproducto;

    -- Calcular el subtotal
    SET subtotal = cantidad * valorunitario;

    -- Verificar si el stock es suficiente
    IF cantidad > stock THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay suficiente existencia de productos en bodega';
    END IF;

    RETURN subtotal;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`) VALUES
(1, 'Empresa A'),
(2, 'Empresa B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `numero` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` double NOT NULL,
  `fkidcliente` int(11) DEFAULT NULL,
  `fkidvendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fk_id_rol` int(11) DEFAULT NULL,
  `fk_id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `email`, `telefono`, `fk_id_rol`, `fk_id_empresa`) VALUES
(1, 'Juan Admin', 'juanadmin@example.com', '3001112233', 1, 1),
(2, 'Carlos Vendedor', 'carlosvendedor@example.com', '3002233445', 2, 1),
(4, 'Pedro Cliente', 'pedrocliente@example.com', '3004455667', 3, 1),
(5, 'María Cliente', 'mariacliente@example.com', '3005566778', 3, 2),
(6, 'ana lopez', 'cliente3@empresa.com', '3015467890', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codigo` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `valorunitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo`, `nombre`, `stock`, `valorunitario`) VALUES
('P001', 'Producto 1', 100, 250),
('P002', 'Producto 2', 50, 40.75),
('P003', 'Producto 3', 200, 15),
('P004', 'Producto 4', 150, 22.3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosporfactura`
--

CREATE TABLE `productosporfactura` (
  `fknumfactura` int(11) NOT NULL,
  `fkcodproducto` varchar(30) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `productosporfactura`
--
DELIMITER $$
CREATE TRIGGER `calcular_subtotal_y_total_trigger` AFTER INSERT ON `productosporfactura` FOR EACH ROW BEGIN
    DECLARE subtotal DECIMAL(10,2);
    DECLARE total DECIMAL(10,2);

    -- Calcular el subtotal de cada producto insertado
    SET subtotal = calcular_subtotal_y_total(NEW.fknumfactura, NEW.fkcodproducto, NEW.cantidad);

    -- Actualizar el subtotal en productosporfactura
    UPDATE productosporfactura
    SET subtotal = subtotal
    WHERE fknumfactura = NEW.fknumfactura AND fkcodproducto = NEW.fkcodproducto;

    -- Actualizar el stock de los productos en la tabla producto
    UPDATE producto
    SET stock = stock - NEW.cantidad
    WHERE codigo = NEW.fkcodproducto;

    -- Actualizar el total de la factura
    SELECT SUM(subtotal) INTO total
    FROM productosporfactura
    WHERE fknumfactura = NEW.fknumfactura;

    UPDATE factura
    SET total = total
    WHERE numero = NEW.fknumfactura;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Cliente'),
(4, 'Administrador'),
(5, 'Vendedor'),
(6, 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `fkidcliente` (`fkidcliente`),
  ADD KEY `fkidvendedor` (`fkidvendedor`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_rol` (`fk_id_rol`),
  ADD KEY `fk_id_empresa` (`fk_id_empresa`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `productosporfactura`
--
ALTER TABLE `productosporfactura`
  ADD PRIMARY KEY (`fknumfactura`,`fkcodproducto`),
  ADD KEY `fkcodproducto` (`fkcodproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`fkidcliente`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`fkidvendedor`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`fk_id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`fk_id_empresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `productosporfactura`
--
ALTER TABLE `productosporfactura`
  ADD CONSTRAINT `productosporfactura_ibfk_1` FOREIGN KEY (`fknumfactura`) REFERENCES `factura` (`numero`),
  ADD CONSTRAINT `productosporfactura_ibfk_2` FOREIGN KEY (`fkcodproducto`) REFERENCES `producto` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
