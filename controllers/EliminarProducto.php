<?php
// Incluir el modelo de Producto
include_once '../models/Producto.php';

// Crear una instancia del modelo Producto
$producto = new Producto();

// Obtener el ID del producto a eliminar
$producto->id = $_GET['id'];

// Llamar al método para eliminar el producto
if($producto->eliminarProducto()){
    echo "Producto eliminado exitosamente.";
} else {
    echo "Error al eliminar el producto.";
}
?>
