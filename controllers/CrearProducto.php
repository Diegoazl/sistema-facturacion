<?php
// Incluir la clase de Producto
include_once '../models/Producto.php';

// Crear una instancia del modelo Producto
$producto = new Producto();
$producto->codigo = $_POST['codigo'];
$producto->nombre = $_POST['nombre'];
$producto->precio = $_POST['precio'];
$producto->stock = $_POST['stock'];

// Llamar a la función para crear el producto
if($producto->crearProducto()){
    echo "Producto creado exitosamente.";
} else {
    echo "Error al crear el producto.";
}
?>
