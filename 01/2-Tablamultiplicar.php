<?php
/**
Ejercicio 2: Tabla de Multiplicar
Objetivo: Generar la tabla de multiplicar de un número ingresado por el usuario.
Pasos:
Pedir al usuario que ingrese un número.
Utilizar un bucle for para iterar desde 1 hasta un número determinado (por ejemplo, 10) y mostrar la multiplicación del número ingresado por cada número de la iteración.
*/

$numero = readline("Que Numero quieres multiplicar: ");

for($i = 1; $i <= 10; $i++)
{echo "$i x $numero = " . $i * $numero . "\n";}