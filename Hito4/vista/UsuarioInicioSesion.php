<?php
session_start(); // Inicio sesión para gestionar la autenticación

require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Instancio el controlador
$error_message = null; // Variable para manejar errores

// Verifico si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo']; // Obtengo el correo ingresado
    $contraseña = $_POST['contraseña']; // Obtengo la contraseña ingresada

    // Intento iniciar sesión con las credenciales proporcionadas
    $usuario = $controller->iniciarSesionUsuarios($correo, $contraseña);

    if (!$usuario) {
        // Si las credenciales son incorrectas, muestro un mensaje de error
        $error_message = "Datos equivocados, prueba de nuevo.";
    } else {
        // Si son correctas, guardo la sesión del usuario
        $_SESSION['usuario'] = $usuario;
        $success_message = "Usuario reconocido con éxito.";
        header("location: ../MenuUsuario.php"); // Redirijo al menú del usuario si tiene un plan
    }
}
?>


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .custom-alert-sandybrown {
            color: #fff;
            background-color: sandybrown;
            border-color: sandybrown;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">INICIAR SESION</h1>

        <?php if (!empty($error_message)): ?>
            <div class="alert custom-alert-sandybrown">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>

        </form>
    </div>
</body>

</html>