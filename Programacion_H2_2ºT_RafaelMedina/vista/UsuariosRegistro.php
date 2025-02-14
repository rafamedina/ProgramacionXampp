<?php
require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios

$controller = new UsuarioController(); // Instancio el controlador
$error_message = ''; // Variable para manejar errores

// Verifico si se ha enviado el formulario mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['password'];

    // Intento agregar un nuevo usuario con los datos proporcionados
    $usuario = $controller->agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña);

    if (!$usuario) {
        // Si el proceso falla, muestro un mensaje de error
        $error_message = "Error al agregar Usuario. Por favor, verifica los datos.";
    } else {
        // Si el usuario se agrega correctamente, redirijo a la página principal
        header("location: ../index.php");
        exit(); // Finalizo la ejecución del script tras la redirección
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrarse Usuario</title>
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
        <h1 class="mt-4">Registrarte</h1>
        <?php if (!empty($error_message)): ?>
            <div class="alert custom-alert-sandybrown">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellidos:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>