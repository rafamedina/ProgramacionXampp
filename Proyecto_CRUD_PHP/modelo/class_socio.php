<?php
require_once '../config/class_conexion.php';

class Socio
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function agregarSocio($nombre, $apellido, $email, $telefono, $fecha_nacimiento)
    {
        $query = "INSERT INTO socios (nombre, apellido, email, telefono, fecha_nacimiento) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $fecha_nacimiento);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al agregar socio: " . $stmt->error);
            return false;
        }

        $stmt->close();
    }

    public function obtenerSocios()
    {
        $query = "SELECT * FROM socios";
        $resultado = $this->conexion->conexion->query($query);
        $socios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $socios[] = $fila;
        }
        return $socios;
    }

    public function obtenerSocioPorId($id_socio)
    {
        $query = "SELECT * FROM socios WHERE id_socio = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_socio);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function actualizarSocio($id_socio, $nombre, $apellido, $email, $telefono, $fecha_nacimiento)
    {
        $query = "UPDATE socios SET nombre = ?, apellido = ?, email = ?, telefono = ?, fecha_nacimiento = ? WHERE id_socio = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $fecha_nacimiento, $id_socio);

        if ($stmt->execute()) {
            echo "Socio actualizado con éxito.";
        } else {
            echo "Error al actualizar socio: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarSocio($id_socio)
    {
        $query = "DELETE FROM socios WHERE id_socio = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_socio);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al eliminar socio: " . $stmt->error);
            return false;
        }

        $stmt->close();
    }
}
