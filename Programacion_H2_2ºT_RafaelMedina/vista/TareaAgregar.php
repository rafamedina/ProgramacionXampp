<?php

require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    session_destroy(); // Cierro la sesión en caso de que no haya usuario autenticado
    header("Location: ../index.php");  // Redirijo al login si no está logueado
    exit(); // Finalizo la ejecución del script
}

// Verifico si se ha solicitado marcar una tarea como completada
if (isset($_GET['action']) && $_GET['action'] == 'completar' && isset($_GET['id_tarea'])) {
    $id_tarea = intval($_GET['id_tarea']); // Convierto el ID a un número entero por seguridad

    // Llamo al método para actualizar el estado de la tarea a 'Completada'
    if ($controller->actualizarEstadoTarea($id_tarea, 'Completada')) {
        header("Location: TareaAgregar.php"); // Redirijo para reflejar cambios en la página
        exit();
    } else {
        $error_message = "Error al marcar la tarea como completada."; // Mensaje de error si falla
    }
}

// Verifico si se ha solicitado eliminar una tarea
if (isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id_tarea'])) {
    $id_tarea = intval($_GET['id_tarea']); // Convierto el ID a un número entero por seguridad

    // Llamo al método para eliminar la tarea
    if ($controller->eliminarTarea($id_tarea)) {
        header("Location: TareaAgregar.php"); // Redirijo para reflejar cambios
        exit();
    } else {
        $error_message = "Error al eliminar la tarea."; // Mensaje de error si falla
    }
}

// Obtengo el ID del usuario desde la sesión
$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario); // Obtengo la información del usuario
$tabla = $controller->ResumenTareasUsuario($usuario["id_usuario"]); // Obtengo el listado de tareas del usuario

// Verifico si el usuario existe
if (!$idusuario) { 
    echo "Usuario no encontrado."; // Muestro un mensaje si no se encuentra el usuario
    exit(); // Detengo la ejecución del script
}

$error_message = null; // Inicializo la variable para mensajes de error

// Verifico si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero y limpio los datos del formulario
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

    // Verifico que la descripción de la tarea no esté vacía
    if (empty($descripcion)) {
        $error_message = "La descripción de la tarea no puede estar vacía."; // Mensaje de error si está vacía
    } else {
        // Llamo al método para agregar la nueva tarea
        $NuevaTarea = $controller->agregarTarea($usuario["id_usuario"], $descripcion);

        if (!$NuevaTarea) {
            $error_message = "Error al añadir tarea."; // Mensaje de error si falla la inserción
        } else {
            $success_message = "Tarea añadida con éxito."; // Mensaje de éxito
            header("Location: TareaAgregar.php"); // Redirijo para reflejar los cambios en la página
            exit(); // Aseguro que el script se detenga después de redirigir
        }
    }
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
        <h1 class="mt-4">Mis Tareas</h1>

        <?php if (!empty($error_message)): ?>
            <div class="alert custom-alert-sandybrown">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <h4>Nueva Tarea</h4>
            <div class="form-group">
                <label for="descripcion">Describe una nueva tarea a realizar</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Agregar Tarea</button>
        </form>
        <br>
        <button><a href="../MenuUsuario.php" class="list-group-item list-group-item-action">Volver</a></button>
    </div>
    <div class="container">
        <h1 class="mt-4">Usuarios Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($tabla as $tarea): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                        <td><?= htmlspecialchars($tarea['estado']) ?></td>
                        <td>
                            <?php if ($tarea['estado'] !== 'Completada') : ?>
                                <a href="?action=completar&id_tarea=<?= $tarea['id_tarea'] ?>" class="btn btn-info"
                                    onclick="return confirm('¿Estás seguro de que deseas marcar esta tarea como completada?');">
                                    Marcar como Completada
                                </a>
                            <?php endif; ?>

                            <!-- Enlace para eliminar -->
                            <a href="?action=eliminar&id_tarea=<?= $tarea['id_tarea'] ?>" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.');">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <br>
    </div>
</body>

</html>