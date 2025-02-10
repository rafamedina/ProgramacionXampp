<?php
/**
1Contar las líneas de un archivo: Escribe un programa en PHP que lea un archivo de texto y cuente cuántas líneas tiene.
2Buscar una palabra en un archivo: Crea un script que busque una palabra específica en un archivo y muestre cuántas veces aparece.
3Crear un registro de eventos: Diseña un programa que agregue una nueva línea con la fecha y hora actual cada vez que se ejecute. Usa un archivo llamado log.txt para almacenar el historial. */
function bby(){
$archivo = fopen("datos.txt", "r");

if ($archivo) {
    $contador = 0;
    while (($linea = fgets($archivo)) !== false) {
        $contador++;
    }
    fclose($archivo);
} else {
    echo "No se pudo abrir el archivo.";
}
echo $contador;
};
//////////////////////////////////////////////////////////

function buscar_palabra_en_archivo($nombre_archivo, $palabra) {
    $contador = 0; // Contador de apariciones

    // Abrir el archivo en modo lectura
    $archivo = fopen($nombre_archivo, "r");

    if ($archivo) {
        // Leer línea por línea
        while (($linea = fgets($archivo)) !== false) {
            // Contar cuántas veces aparece la palabra en la línea (insensible a mayúsculas)
            $contador += substr_count(strtolower($linea), strtolower($palabra));
        }
        fclose($archivo);

        echo "La palabra '{$palabra}' aparece {$contador} veces en el archivo '{$nombre_archivo}'.\n";
    } else {
        echo "Error al abrir el archivo '{$nombre_archivo}'.\n";
    }
}
//$nombre_archivo = readline("Ingrese el nombre del archivo: ");
//$palabra = readline("Ingrese la palabra a buscar: ");
//buscar_palabra_en_archivo($nombre_archivo, $palabra);

////////////////////////////////////////////////////////////////////////

function eje3(){
$archivo = fopen('log.txt','a+');
if($archivo){
    $fecha_actual = date("Y-m-d H:i:s");
    fwrite($archivo, "fecha_actual" . $fecha_actual ." \n");
    fclose($archivo);
} 
}

//eje3();