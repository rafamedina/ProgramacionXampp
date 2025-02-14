<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $linea = "$id,$nombre,$precio,$stock\n";
    file_put_contents("../datos/articulos.csv", $linea, FILE_APPEND);

    header("Location: ../index.php?opcion=articulos");
    exit();
}
