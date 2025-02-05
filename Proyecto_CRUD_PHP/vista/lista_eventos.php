<?php
require_once '../controlador/EventosController.php';
$controller = new EventosController();
$eventos = $controller->listarEventos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Eventos Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= $evento['id_evento'] ?></td>
                        <td><?= $evento['nombre_evento'] ?></td>
                        <td><?= $evento['fecha'] ?></td>
                        <td><?= $evento['lugar'] ?></td>
                        <td>
                            <a href="editar_evento.php?id=<?= $evento['id_evento'] ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar_evento.php?id=<?= $evento['id_evento'] ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <a href="alta_evento.php" class="btn btn-primary">Agregar un nuevo evento</a>
    </div>
</body>

</html>