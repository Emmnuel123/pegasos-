<?php
session_start();

// Si el usuario ya está logueado, redirigirlo al index.php
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pegasos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que el correo no exista
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = 'El correo electrónico ya está registrado.';
    } else {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        $role = 'usuario'; // Establecer el rol por defecto
        $sql = "INSERT INTO usuarios (email, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $hashed_password, $role);

        if ($stmt->execute()) {
            // Guardar el correo en la sesión y redirigir al index
            $_SESSION['user_id'] = $conn->insert_id; // Guardar el ID del usuario
            $_SESSION['email'] = $email; // Guardar el correo electrónico
            $_SESSION['role'] = $role; // Guardar el rol

            // Redirigir al index.php después de un registro exitoso
            header("Location: index.php");
            exit;
        } else {
            $error_message = 'Hubo un error al registrar al usuario.';
        }
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
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Registrar un Nuevo Usuario</h2>

    <!-- Mostrar mensajes de error o éxito -->
    <?php
    if (isset($error_message)) {
        echo '<div class="alert alert-danger">' . $error_message . '</div>';
    }

    if (isset($success_message)) {
        echo '<div class="alert alert-success">' . $success_message . '</div>';
    }
    ?>

    <form method="POST" action="registro.php">
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

    <p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
