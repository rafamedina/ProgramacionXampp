<?php
// Ruta al archivo CSV en la carpeta 'datos'
$archivo = "../datos/clientes.csv"; // Asegúrate de que esta sea la ruta correcta

// Datos enviados desde el formulario para el nuevo cliente
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Leer todos los clientes existentes
$clientes = [];
if (($handle = fopen($archivo, "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $clientes[] = $data;
    }
    fclose($handle);
}

// Determinar el próximo ID (el último ID + 1)
$id = (count($clientes) > 1) ? $clientes[count($clientes) - 1][0] + 1 : 1;

// Agregar el nuevo cliente al array
$clientes[] = [$id, $nombre, $correo, $telefono];

// Sobrescribir el archivo CSV con el nuevo cliente incluido
$handle = fopen($archivo, "w");
foreach ($clientes as $cliente) {
    fputcsv($handle, $cliente);
}
fclose($handle);

// Redirigir a la lista de clientes
header("Location: ../index.php?opcion=clientes&subopcion=listar");
exit;
