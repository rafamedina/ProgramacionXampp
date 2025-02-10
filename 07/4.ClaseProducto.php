<?php
/*
4. Herencia - Clase "Producto" y "Electrodoméstico":
Crea una clase Producto con propiedades nombre y precio.
Crea un método mostrarDetalles() que imprima los datos del producto.
Crea una clase hija Electrodoméstico que añada la propiedad consumo y sobrescriba el método mostrarDetalles().
Instancia un Producto y un Electrodoméstico y muestra sus detalles.
*/


class Producto
{

    private $nombre;
    private $precio;

    public function mostrarDetalles()
    {
        echo "el producto " . $this->nombre . " tiene un precio de. " . $this->precio . "€";
    }

    public function setnombre($newnombre)
    {

        $this->nombre = $newnombre;
    }

    public function getnombre()
    {
        return $this->nombre;
    }

    public function setprecio($newprecio)
    {
        $this->precio = $newprecio;
    }
    public function getprecio()
    {
        return $this->precio;
    }
}


class Electrodomestico extends Producto
{

    private $consumo;

    public function setconsumo($newconsumo)
    {
        $this->consumo = $newconsumo;
    }

    public function getconsumo()
    {
        return $this->consumo;
    }
    public function mostrarDetalles()
    {
        echo "el producto " . $this->getnombre() . " tiene un precio de " . $this->getprecio() . "€ y un consumo de: " . $this->consumo;
    }
}

$lavaplatos = new Electrodomestico;
$lavaplatos->setnombre("Lavavajillas LG");
$lavaplatos->setprecio(1500);
$lavaplatos->setconsumo(120000);
$lavaplatos->mostrarDetalles();
