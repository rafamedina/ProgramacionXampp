<?php

require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: ../index.php");  // Redirijo al login si no está logueado
    exit();
}

$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario);
if (!$idusuario) { // Verifico si el usuario existe
    echo "Usuario no encontrado.";
    exit();
}
$error_message = null; // Inicializo la variable de error

// Verifico si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero los datos del formulario
    $descripcion = $_POST['descripcion'];

    // Llamo al método para actualizar los datos del usuario
    $NuevaTarea = $controller->agregarTarea($descripcion);
    if (!$NuevaTarea) {
        $error_message = "Error al añadir tarea";
    } else {
        $error_message = "Tarea añadida con exito";
        header("Location: ../MenuUsuario.php");
    } // Redirijo a la página de edición

}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="mt-4">Editar Perfil</h1>

        <?php if (!empty($error_message)): ?>
            <div class="alert custom-alert-sandybrown">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="descripcion">Describe la tarea a realizar</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Agregar Tarea</button>
        </form>
        <button><a href="../MenuUsuario.php" class="list-group-item list-group-item-action">Volver</a></button>
    </div>
</body>

</html>