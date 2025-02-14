<?php 
/** 
Ejercicio 4: Generador de Nombres Aleatorios
Enunciado: Crea un programa que genere nombres aleatorios a partir de listas de nombres y apellidos.
Objetivo: Practicar el manejo de arrays y la generación de números aleatorios.
Pasos:
Crear dos arrays, uno con nombres y otro con apellidos.
Generar un número aleatorio para seleccionar un nombre y otro para seleccionar un apellido.
Concatenar el nombre y el apellido para formar un nombre completo aleatorio.

*/


$nombres = ["Carlos", "Ana", "Luis", "María", "Jorge"];
$apellidos = ["García", "Pérez", "Martínez", "Rodríguez", "López"];


$numnombre = rand(0, 4);
$numapellido = rand(0, 4);

echo $nombres[$numnombre] . " " . $apellidos[$numapellido];

