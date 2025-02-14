<?php
require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Instancio el controlador

session_start(); // Inicio sesión

// Verifico si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    session_destroy(); // Cierro la sesión si no hay usuario autenticado
    header("Location: ../index.php");  // Redirijo al login
    exit(); // Detengo la ejecución del script
}

// Obtengo el ID del usuario desde la sesión
$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario); // Obtengo la información del usuario

// Verifico si el usuario existe
if (!$idusuario) { 
    echo "Usuario no encontrado."; // Muestro un mensaje si no se encuentra el usuario
    exit(); // Detengo la ejecución del script
}

// Si el formulario fue enviado, elimino el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminarUsuario($usuario["id_usuario"]); // Llamo al método para eliminar al usuario
    session_destroy(); // Cierro la sesión tras eliminar el usuario
    header("Location: ../index.php"); // Redirijo a la página principal
    exit(); // Detengo la ejecución para evitar procesamiento adicional
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Elimnar Usuario</h1>
        <form method="POST">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario["id_usuario"]) ?>">

    </div>
    <h3>Atencion! no hay vuelta atras.</h3>
    <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
    </form>
    <a href="../MenuUsuario.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>

</html>