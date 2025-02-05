<?php
require_once '../controlador/SociosController.php';

$sociosController = new SociosController();

if (isset($_GET['id'])) {
    $id_socio = $_GET['id'];
    $socio = $sociosController->obtenerSocioPorId($id_socio);


    if (!$socio) {
        echo "Socio no encontrado.";
        exit();
    }
} else {
    header("Location: lista_socios.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $sociosController->actualizarSocio($id_socio, $nombre, $apellido, $email, $telefono, $fecha_nacimiento);
    header("Location: lista_socios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Socio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Editar Socio</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($socio['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" name="apellido" class="form-control" value="<?php echo htmlspecialchars($socio['apellido']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($socio['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($socio['telefono']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" class="form-control" value="<?php echo htmlspecialchars($socio['fecha_nacimiento']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Socio</button>
        </form>
        <a href="lista_socios.php" class="btn btn-secondary mt-3">Volver a la lista de socios</a>
    </div>