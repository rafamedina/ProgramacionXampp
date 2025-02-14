<?php
/*
Clase "Libro":
Crea una clase "Libro" con las propiedades título, autor y número de páginas.
Agrega un método mostrarInfo() que imprima la información completa del libro.
Crea una instancia de "Libro" y prueba el método.
*/

class Libro
{
    private $titulo;
    private $autor;
    private $numpag;


    public function settitulo($tituloexterior)
    {
        $this->titulo = $tituloexterior;
    }
    public function setautor($autorexterior)
    {
        $this->autor = $autorexterior;
    }
    public function setnumpag($numpagexterior)
    {
        $this->numpag = $numpagexterior;
    }
    public function gettitulo()
    {
        return $this->titulo;
    }
    public function getautor()
    {
        return $this->autor;
    }
    public function getnumpag()
    {
        return $this->numpag;
    }
    public function MostrarInfo()
    {
        echo "El libro: " . $this->titulo . "tiene este autor: " . $this->autor . " y tienes este numero de paginas: " . $this->numpag;
    }
}

$donquijote = new Libro();
$donquijote->settitulo("Don Quijote ");
$donquijote->setautor("Kiko Matamoros");
$donquijote->setnumpag("25");

$donquijote->MostrarInfo();
