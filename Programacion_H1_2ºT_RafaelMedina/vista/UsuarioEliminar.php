<?php
require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: ../index.php");  // Si no está logueado, lo envío al login
    exit();
}
$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario);


if (!$idusuario) { // Si no encuentro el usuario, muestro un mensaje y corto la ejecución
    echo "Usuario no encontrado.";
    exit();
}


// Si el formulario fue enviado, elimino el plan del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminarUsuario($usuario["id_usuario"]); // Llamo al método para eliminar el plan del usuario
    header("Location: ../index.php"); // Redirijo a la página de gestión de usuarios
    exit();
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
    <a href="../UsuarioMenu.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>

</html>