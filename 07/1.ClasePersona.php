<?php
/*
1. Clase "Persona":
Crea una clase Persona con las propiedades nombre, edad y género.
Agrega un método presentar() que imprima una presentación con los datos de la persona.
Crea una instancia de Persona y prueba el método presentar().
*/

Class Persona{
    private $nombre;
    private $edad;
    private $genero;

    public function presentar(){

        echo "La persona " . $this->nombre . " tiene esta edad " . $this->edad . " y es de genero " . $this->genero;
    }

    public function setnombre($nombre_ext){
        $this->nombre = $nombre_ext;
    }
    public function setedad($edad_ext){
        $this->edad = $edad_ext;
    }
    public function setgenero($genero_ext){
        $this->genero = $genero_ext;
    }
    
}

$persona1 = new Persona();
$persona1-> setnombre("Marco");
$persona1-> setedad("19");
$persona1-> setgenero("Hombre");
$persona1-> presentar();