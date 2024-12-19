<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambiar si tu servidor es distinto
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "pegasos"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($password != $confirm_password) {
        echo '<div class="alert alert-danger text-center">Las contraseñas no coinciden.</div>';
    } else {
        // Encriptar la contraseña antes de guardarla en la base de datos
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta para insertar los datos en la base de datos
        $sql = "INSERT INTO usuarios (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashed_password);
        
        // Ejecutar la consulta y verificar si se insertó correctamente
        if ($stmt->execute()) {
            echo '<div class="alert alert-success text-center">Registro exitoso. <a href="login.php">Inicia sesión aquí</a></div>';
        } else {
            echo '<div class="alert alert-danger text-center">Hubo un error al registrar. Intenta nuevamente.</div>';
        }

        // Cerrar la conexión
        $stmt->close();
    }
}

// Cerrar la conexión
$conn->close();
?>
