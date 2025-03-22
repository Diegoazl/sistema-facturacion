
CREATE DATABASE IF NOT EXISTS sistema_facturacion;
USE sistema_facturacion;

CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50),
    nombre VARCHAR(100)
);

CREATE TABLE personas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50),
    email VARCHAR(100),
    nombre VARCHAR(100),
    telefono VARCHAR(20),
    tipo ENUM('cliente', 'vendedor'),
    carnet VARCHAR(50),
    direccion VARCHAR(200),
    credito DECIMAL(10,2),
    empresa_id INT,
    tipo_persona VARCHAR(20),
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50),
    nombre VARCHAR(100),
    stock INT,
    valor_unitario DECIMAL(10,2)
);

CREATE TABLE facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    numero VARCHAR(50),
    total DECIMAL(10,2),
    cliente_id INT,
    vendedor_id INT,
    FOREIGN KEY (cliente_id) REFERENCES personas(id),
    FOREIGN KEY (vendedor_id) REFERENCES personas(id)
);

CREATE TABLE productos_por_factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_id INT,
    producto_id INT,
    cantidad INT,
    subtotal DECIMAL(10,2),
    FOREIGN KEY (factura_id) REFERENCES facturas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);
