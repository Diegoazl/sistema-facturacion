<?php include_once('header.php'); ?>

<div class="container">
    <h2>Bienvenido al Sistema de Facturación</h2>
    <p>Elija una opción para gestionar:</p>
    
    <div class="options">
        <a href="index.php?action=producto_index">Gestionar Productos</a>
        <a href="index.php?action=cliente_index">Gestionar Clientes</a>
        <a href="index.php?action=vendedor_index">Gestionar Vendedores</a>
        <a href="index.php?action=factura_index">Gestionar Facturas</a>
        <a href="index.php?action=empresa_index">Gestionar Empresas</a> <!-- Nuevo enlace para Empresas -->
    </div>
</div>

<?php include_once('footer.php'); ?>
