<?php
require_once '../modelo/class_usuario.php';

class UsuarioController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Usuario();
    }

    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $contraseña)
    {
        return $this->modelo->agregarUsuario($nombre, $apellidos, $correo, $edad, $contraseña);
    }

    public function perfilUsuario($id_usuario)
    {
        return $this->modelo->obtenerUsuario($id_usuario);
    }

    public function obtenerUsuarioporid($id_usuario)
    {
        return $this->modelo->obtenerUsuarioporid($id_usuario);
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad)
    {
        $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad);
    }

    public function eliminarUsuario($id_usuario)
    {
        $this->modelo->eliminarUsuario($id_usuario);
    }

    public function iniciarSesion($correo, $contraseña)
    {
        return $this->modelo->iniciarSesion($correo, $contraseña);
    }
    public function filtrado_usuario($usuario)
    {
        return $this->modelo->filtrado_usuario($usuario);
    }
}
