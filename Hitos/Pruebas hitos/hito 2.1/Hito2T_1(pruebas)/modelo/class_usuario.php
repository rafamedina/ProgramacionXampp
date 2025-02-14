<?php
require_once '../config/class_conexion.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $contraseña)
    {
        // Hashea la contraseña con password_hash
        $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);

        $query = "INSERT INTO Usuarios (nombre, apellidos, correo, edad, contraseña) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssis", $nombre, $apellidos, $correo, $edad, $contraseñaHashed);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Usuarios: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function obtenerUsuario($id_usuario)
    {
        $query = "SELECT * FROM Usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        $stmt->close();
        return $usuarios;
    }

    public function obtenerUsuarioporid($id_usuario)
    {
        $query = "SELECT * FROM Usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad)
    {
        $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo = ?, edad = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $apellidos, $correo, $edad, $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarUsuario($id_usuario)
    {
        $query = "DELETE FROM Usuarios WHERE id_usuario = ?";
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

    public function iniciarSesion($correo, $password)
    {
        $query = "SELECT * FROM Usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        // Verifica la contraseña
        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            // Inicia la sesión
            session_start(); // Asegúrate de llamar a session_start al inicio del script

            // Guarda los datos del usuario en la sesión
            $_SESSION['id_usuario'] = $usuario['id'];
            $stmt->close();

            return $usuario; // Inicio de sesión exitoso
        } else {
            return false; // Contraseña o correo incorrectos
        }
    }
    public function filtrado_usuario($usuario)
    {
        $query = "SELECT * FROM resumen WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si hay al menos un resultado, devuelve true; de lo contrario, false
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row ? true : false;
    }
}
