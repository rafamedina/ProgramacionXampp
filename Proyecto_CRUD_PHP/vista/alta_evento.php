<?php
require_once '../controlador/EventosController.php';
$controller = new EventosController();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_evento = $_POST['nombre_evento'];
    $fecha = $_POST['fecha'];
    $lugar = $_POST['lugar'];

    $evento = $controller->agregarEvento($nombre_evento, $fecha, $lugar);
    if (!$evento) {
        $error_message = "Error al agregar evento. Por favor, verifica los datos.";
    } else {
        $success_message = "Evento agregado con éxito.";
        header("Location: lista_eventos.php"); 
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Agregar Evento</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="nombre_evento">Nombre:</label>
                <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="lugar">Lugar:</label>
                <input type="text" class="form-control" id="lugar" name="lugar" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Evento</button>
        </form>
    </div>
</body>

</html>
