<?php
require_once '../modelo/class_socio.php';

class SociosController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Socio();
    }

    public function agregarSocio($nombre, $apellido, $email, $telefono, $fecha_nacimiento)
    {
        return $this->modelo->agregarSocio($nombre, $apellido, $email, $telefono, $fecha_nacimiento);
    }

    public function listarSocios()
    {
        return $this->modelo->obtenerSocios();
    }

    public function obtenerSocioPorId($id_socio)
    {
        return $this->modelo->obtenerSocioPorId($id_socio);
    }

    public function actualizarSocio($id_socio, $nombre, $apellido, $email, $telefono, $fecha_nacimiento)
    {
        $this->modelo->actualizarSocio($id_socio, $nombre, $apellido, $email, $telefono, $fecha_nacimiento);
    }

    public function eliminarSocio($id_socio)
    {
        $this->modelo->eliminarSocio($id_socio);
    }
}
