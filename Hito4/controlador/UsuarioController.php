<?php
require_once '../modelo/class_usuario.php';

class UsuarioController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Usuario();
    }
    public function agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        return $this->modelo->agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña);
    }
    public function iniciarSesionUsuarios($correo, $password)
    {
        return $this->modelo->iniciarSesionUsuarios($correo, $password);
    }
    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        return $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $telefono, $contraseña);
    }
    public function obtenerUsuarioporid($id_usuario)
    {
        return $this->modelo->obtenerUsuarioporid($id_usuario);
    }
    public function eliminarUsuario($id_usuario)
    {
        $this->modelo->eliminarUsuario($id_usuario);
    }
    public function agregarTarea($usuario, $descripcion)
    {
        return $this->modelo->agregarTarea($usuario, $descripcion);
    }
    public function ResumenTareasUsuario($usuario)
    {
        return $this->modelo->ResumenTareasUsuario($usuario);
    }
    public function ResumenTareas($usuario)
    {
        return $this->modelo->ResumenTareas($usuario);
    }
    public function actualizarEstadoTarea($id_tarea, $Completada)
    {
        return $this->modelo->actualizarEstadoTarea($id_tarea, $Completada);
    }
    public function eliminarTarea($id_tarea)
    {
        return $this->modelo->eliminarTarea($id_tarea);
    }
}
