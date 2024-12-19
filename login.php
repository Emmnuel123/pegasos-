<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pegasos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Guardar el usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; // Guardar el rol
            
            // Redirigir según el rol
            if ($user['role'] == 'admin') {
                header("Location: admin.php"); // Redirigir al panel de administración
            } else {
                header("Location: index.php"); // Redirigir al index
            }
            exit;
        } else {
            $error_message = 'Contraseña incorrecta.';
        }
    } else {
        $error_message = 'El correo electrónico no está registrado.';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Iniciar sesión</h2>

    <!-- Mostrar mensajes de error -->
    <?php
    if (isset($error_message)) {
        echo '<div class="alert alert-danger">' . $error_message . '</div>';
    }
    ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>

    <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Registrar</a></p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
