<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $linea = "$id,$nombre,$correo,$telefono\n";
    file_put_contents("../datos/clientes.csv", $linea, FILE_APPEND);

    header("Location: ../index.php?opcion=clientes");
    exit();
}
