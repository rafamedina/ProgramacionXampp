<?php
/**
1Define una función que reciba un array de números y devuelva el mayor de ellos.
2Crea una función que reciba un nombre y devuelva un saludo personalizado.
3Escribe una función recursiva que calcule la suma de los primeros n números naturales.
*/

$array = [1, 2, 3, 4, 5, 6];

function mayor($array){
    return max($array);
}
//echo mayor($array);
///////////////////////////////////////////////////
$saludo = function($nombre){
    echo "Hola $nombre";
};

//$nombre = readline("Cual es tu nombre: ");

//$saludo($nombre);

//////////////////////////////////////////////////

function suma($num){
    $contador = 0;
    for ($i = 1; $i <= $num; $i++){
        $contador += $i;
    }
    return $contador;
}
//$num = readline("Hasta que numero quieres sumar: ");
//$cifra = suma($num);
//echo $cifra;