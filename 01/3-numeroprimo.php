<?php
/** 
Ejercicio 3: Número Primo
Objetivo: Determinar si un número ingresado por el usuario es primo.
Pasos:
Pedir al usuario que ingrese un número.
Utilizar un bucle for para verificar si el número es divisible por algún número entre 2 y la mitad del número ingresado.
Si el número solo es divisible por 1 y por sí mismo, es primo.
*/
$numero = readline("Que Numero quieres saber si es primo: ");
$primo = true;
if ($numero < 2 ) {$primo = false;}
else {for($i = 2; $i < $numero / 2; $i++)
    {if ($numero % $i == 0)
    {$primo = false;}}}

if($primo == false) {
    echo "El numero $numero no es primo\n";
}else{
    echo "El numero $numero es primo\n";
}