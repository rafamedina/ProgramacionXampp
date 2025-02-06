<?php
require_once '../config/class_conexion.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);
        $query = "INSERT INTO Usuarios (nombre, apellido, correo, telefono, contraseña) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexion->conexion->prepare($query);

        // Asegurar que los tipos de datos coincidan
        $stmt->bind_param("sssss", $nombre, $apellidos, $correo, $telefono, $contraseñaHashed);

        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Usuarios: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }
    
    public function iniciarSesionUsuarios($correo, $password)
    {
        $query = "SELECT * FROM Usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        // Verifica la contraseña y gestiona la sesión.
        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            session_start(); // Inicio de sesión.
            $_SESSION['id_usuario'] = $usuario['usuario'];
            $stmt->close();
            return $usuario; // Devuelve los datos del administrador si es correcto.
        } else {
            return false; // Credenciales incorrectas.
        }
    }
    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        // Verificar si la contraseña está vacía
        if (!empty($contraseña)) {
            // Si la contraseña no está vacía, se actualiza también
            $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);
            $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo = ?, telefono = ?, contraseña = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("sssiisi", $nombre, $apellidos, $correo, $telefono, $contraseñaHashed, $id_usuario);
        } else {
            // Si la contraseña está vacía, no se actualiza ese campo
            $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo = ?, telefono = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("sssiii", $nombre, $apellidos, $correo, $telefono, $id_usuario);
        }
    }

}
