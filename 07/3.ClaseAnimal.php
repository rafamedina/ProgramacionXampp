<?php
/*
3. Herencia - Clase "Animal" y "Perro":
Crea una clase Animal con la propiedad especie y un método emitirSonido().
Crea una clase hija Perro que herede de Animal y agregue la propiedad raza.
Instancia un objeto Perro y prueba los métodos y propiedades.
*/

Class Animal{

    private $especie;

    public function emitirSonido(){

        echo "El " . $this->especie . " Emite un sonido";
    }

    public function setespecie($newespecie){
        $this->especie = $newespecie;
    }
    public function getespecie(){
        return $this->especie;
    }
}

Class Perro extends Animal{
    private $raza;
    private $especie = "perro";


    public function setraza($newraza){

    $this->raza = $newraza;
    }

    public function emitirSonido()
    {
        echo "El " . $this->especie . " De la Raza " . $this->raza .  " hace guau guau";
    }

}

$perro1 = new Perro();
$perro1->setraza("galgo");
$perro1->emitirSonido();

