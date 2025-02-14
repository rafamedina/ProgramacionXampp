<?php
require_once '../config/class_conexion.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function agregarUsuario($nombre, $apellidos, $correo_email, $edad, $telefono)
    {
        $query = "INSERT INTO usuarios (nombre, apellidos, correo_email, edad, id_plan, duracion_suscripcion) VALUES (?, ?, ?, ?, 'Básico', 'Mensual')";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssis", $nombre, $apellidos, $correo_email, $edad, $telefono);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Usuario: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function obtenerUsuario()
    {
        $query = "SELECT * FROM usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $socios = [];

        while ($fila = $resultado->fetch_assoc()) {
            $socios[] = $fila;
        }
        return $socios;
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo_email, $edad, $telefono)
    {
        $query = "UPDATE usuarios SET nombre = ?, apellidos = ?, correo_email = ?, edad = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $apellidos, $correo_email, $edad, $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }
        $stmt->close();
    }

    public function eliminarUsuario($id_usuario)
    {
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al eliminar usuario: " . $stmt->error);
            return false;
        }
        $stmt->close();
    }

    // Otros métodos se mantienen igual, pero asegúrate de cambiar 'correo' a 'correo_email' donde sea necesario.
}