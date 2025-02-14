<?php
class Mascota {
    public $nombre;
    public $tipo;

    // Método para presentar la mascota
    public function presentar() {
        echo "Hola, soy " . $this->nombre . " y soy un(a) " . $this->tipo . ".
";
    }

    // Método para emitir un sonido
    public function emitirSonido() {
        if ($this->tipo == "perro") {
            echo "Guau guau!
";
        } elseif ($this->tipo == "gato") {
            echo "Miau miau!
";
        } else {
            echo "Este animal no tiene un sonido definido.
";
        }
    }
}

// Crear una instancia de Mascota
$miMascota = new Mascota();
$miMascota->nombre = "Tovi";
$miMascota->tipo = "perro";

// Usar los métodos
$miMascota->presentar();
$miMascota->emitirSonido();

