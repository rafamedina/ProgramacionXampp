<?php

do {
$eleccion = readline("Selecciona que operaciones quiere hacer 1 - Sumar, 2 - Restar, 3 - multiplicar, 4 - dividir, 5 - Salir: ");
if ($eleccion != 5){
    $primernum = readline("Cual es el primer numero: ");
    $segundonum = readline("Cual es el segundo numero: ");
    if ($eleccion == 1){
        echo $primernum + $segundonum . "\n";
    } elseif ($eleccion == 2){
        echo $primernum - $segundonum . "\n";
    } elseif ($eleccion == 3){
        echo $primernum * $segundonum . "\n";
    } elseif ($eleccion == 4){
        echo $primernum / $segundonum . "\n";
    } else {echo "Numero no valido";};}
    }while ($eleccion != 5);

echo "adios";