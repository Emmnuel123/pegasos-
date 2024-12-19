<?php
session_start();

// Verificar que el usuario esté logueado y tenga el rol de 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Si no está logueado o no es admin, redirigir al index
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #52904c; /* Color verde */
            font-size: 2.5rem;
            font-weight: bold;
        }
        p {
            font-size: 1.1rem;
            color: #555;
        }
        .btn-custom {
            background-color: #52904c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn-custom:hover {
            background-color: #407237; /* Un verde más oscuro */
        }
        .card {
            margin-top: 20px;
        }
        .card-header {
            background-color: #f7ee3b; /* Color amarillo */
            color: #16333d; /* Color oscuro */
            font-weight: bold;
        }
        .card-body {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Panel de Administración</h2>
    <p>Bienvenido al panel de administración. Aquí puedes gestionar usuarios, contenido y más.</p>
    
    <!-- Botón para agregar funcionalidad adicional -->
    <a href="agregar_usuario.php" class="btn btn-custom">Agregar Nuevo Usuario</a>

    <!-- Ejemplo de tarjeta de administración -->
    <div class="card">
        <div class="card-header">
            Gestión de Usuarios
        </div>
        <div class="card-body">
            <p>En esta sección podrás ver y gestionar los usuarios registrados.</p>
            <a href="ver_usuarios.php" class="btn btn-custom">Ver Usuarios</a>
        </div>
    </div>

    <!-- Aquí puedes agregar más tarjetas o funcionalidades -->

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
