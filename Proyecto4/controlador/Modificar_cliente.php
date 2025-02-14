<?php
require_once("../modelo/tablas.php");  // Asegúrate de que el archivo 'tablas.php' está correctamente incluido

$archivo = "datos/clientes.csv";  // Asegúrate de que la ruta sea correcta y que el archivo 'clientes.csv' exista.
$id = $_POST['id'] ?? null;  // Obtener el ID del formulario (puede ser un GET si es necesario)

if ($id !== null) {
    // Leer todos los clientes
    $clientes = [];
    if (($handle = fopen($archivo, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $clientes[] = $data;
        }
        fclose($handle);
    }

    // Buscar el cliente por ID
    $clienteSeleccionado = null;
    foreach ($clientes as $cliente) {
        if ($cliente[0] == $id) {
            $clienteSeleccionado = $cliente;
            break;
        }
    }

    if ($clienteSeleccionado !== null) {
        // Mostrar el formulario de modificación
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modificar Cliente</title>
        </head>

        <body>
            <h1>Modificar Cliente</h1>
            <form action="actualizar_cliente.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($clienteSeleccionado[0]) ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($clienteSeleccionado[1]) ?>" required><br>

                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($clienteSeleccionado[2]) ?>" required><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($clienteSeleccionado[3]) ?>" required><br>

                <button type="submit">Actualizar</button>
            </form>
        </body>

        </html>
<?php
    } else {
        echo "Cliente no encontrado.";
    }
} else {
    echo "No se ha proporcionado un ID.";
}
?>