<?php
require_once '../controlador/EventosController.php';
$controller = new EventosController();
$error_message = '';

if (isset($_GET['id'])) {
    $id_evento = $_GET['id'];
    $evento = $controller->obtenerEventoPorId($id_evento);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $lugar = $_POST['lugar'];

    $controller->actualizarEvento($id_evento, $nombre, $fecha, $lugar);
    header("Location: lista_eventos.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Editar Evento</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="nombre_evento">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $evento['nombre_evento'] ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $evento['fecha'] ?>" required>
            </div>

            <div class="form-group">
                <label for="lugar">Lugar:</label>
                <input type="text" class="form-control" id="lugar" name="lugar" value="<?= $evento['lugar'] ?>" required>
            </div>


            <button type="submit" class="btn btn-primary">Actualizar Evento</button>
        </form>
    </div>
</body>

</html>