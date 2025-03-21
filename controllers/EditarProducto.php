<?php
// Incluir el modelo de Producto
include_once '../models/Producto.php';

// Crear una instancia del modelo Producto
$producto = new Producto();

// Obtener el producto por su ID
$producto->id = $_GET['id'];
$producto->obtenerProductoPorId();

// Actualizar el producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto->codigo = $_POST['codigo'];
    $producto->nombre = $_POST['nombre'];
    $producto->precio = $_POST['precio'];
    $producto->stock = $_POST['stock'];

    if($producto->editarProducto()){
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>
