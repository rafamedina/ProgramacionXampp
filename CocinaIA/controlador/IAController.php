<?php
require_once '../modelo/class_IA.php';

class IAController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new IA();
    }


    public function PedirIngredientes($prompt)
    {
        return $this->modelo->PedirIngredientes($prompt);
    }
    public function PedirDesarrollo()
    {
        return $this->modelo->PedirDesarrollo();
    }
    public function PedirResumen($prompt)
    {
        return $this->modelo->PedirResumen($prompt);
    }
    public function GuardarReceta($nombre, $descripcion, $preparacion, $ingredientes)
    {
        return $this->modelo->GuardarReceta($nombre, $descripcion, $preparacion, $ingredientes);
    }
    public function obtenerRecetaPorNombre($nombre)
    {
        return $this->modelo->obtenerRecetaPorNombre($nombre);
    }
    public function obtenerNombre($prompt)
    {
        return $this->modelo->obtenerNombre($prompt);
    }
}
