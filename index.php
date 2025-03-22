<?php
// Este archivo sirve como la página de inicio del sistema.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/estilos.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        h1 {
            font-size: 3rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 50px;
        }
        .btn {
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-info {
            background-color: #17a2b8;
            border: none;
        }
        .btn-info:hover {
            background-color: #138496;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .container {
            max-width: 900px;
            padding: 20px;
            margin-top: 100px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card {
            border-radius: 10px;
            padding: 30px;
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-size: 1.5rem;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <!-- Título de la página -->
        <h1>Bienvenido al Sistema de Facturación</h1>

        <!-- Card de navegación -->
        <div class="card">
            <div class="card-header">Selecciona una opción</div>
            <div class="card-body">
                <a href="views/FrmPersona.php" class="btn btn-primary m-2">Personas</a>
                <a href="views/FrmProducto.php" class="btn btn-secondary m-2">Productos</a>
                <a href="views/FrmFactura.php" class="btn btn-info m-2">Facturas</a>
                <a href="views/FrmRol.php" class="btn btn-success m-2">Roles</a>
                <a href="views/FrmUsuario.php" class="btn btn-warning m-2">Usuarios</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
