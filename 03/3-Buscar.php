<?php
/**
Ejercicio 3: Buscar Elemento en un Array
Crea una función llamada buscarElemento que reciba dos parámetros: un array y un valor a buscar.
Si el valor está en el array, devuelve su posición.
Si no está, lanza un error personalizado indicando que no se encontró el elemento.
Usa un manejador personalizado de errores para mostrar el mensaje.
Ejemplo de uso:
$array = ["manzana", "naranja", "pera"];
echo buscarElemento($array, "pera"); // Resultado: 2
echo buscarElemento($array, "plátano"); // Resultado: Error: El elemento no se encuentra en el array.
*/

function buscarElemento($array,$busqueda){
    if ($array[$busqueda]){
        for($i = 0; $i > strlen($array); $i++){
            
        }
        
    } else {return "Error: El elemento no se encuentra en el array. ";}



}