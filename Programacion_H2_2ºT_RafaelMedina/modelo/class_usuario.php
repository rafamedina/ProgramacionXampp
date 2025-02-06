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
            $query = "UPDATE Usuarios SET nombre = ?, apellido = ?, correo = ?, telefono = ?, contraseña = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("sssssi", $nombre, $apellidos, $correo, $telefono, $contraseñaHashed, $id_usuario);
            $stmt->execute();
            return true;
        } else {
            // Si la contraseña está vacía, no se actualiza ese campo
            $query = "UPDATE Usuarios SET nombre = ?, apellido = ?, correo = ?, telefono = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("ssssi", $nombre, $apellidos, $correo, $telefono, $id_usuario);
            $stmt->execute();
            return true;
        }
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

    public function agregarTarea($usuario, $descripcion)
    {
        $query = "INSERT INTO Tareas (descripcion) VALUES (?)";

        $stmt = $this->conexion->conexion->prepare($query);

        // Asegurar que los tipos de datos coincidan
        $stmt->bind_param("s", $descripcion);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            $query2 = "UPDATE Tareas SET id_usuario = ? WHERE id_tarea = LAST_INSERT_ID()";
            $stmt = $this->conexion->conexion->prepare($query2);
            $stmt->bind_param("i", $usuario);
            $stmt->execute();
            return true;
        } else {
            error_log("Error al eliminar usuario: " . $stmt->error);
            return false;
        }
    }
    public function ResumenTareasUsuario($usuario)
    {
        $query = "SELECT id_tarea, descripcion, estado from tareas where id_usuario = ?";

        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Retorna todos los resultados como un array asociativo.
        $planes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $planes;
    }
    public function ResumenTareas($usuario)
    {
        $query = "SELECT * from tareas where id_usuario = ?";

        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Retorna todos los resultados como un array asociativo.
        $planes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $planes;
    }

    public function actualizarEstadoTarea($id_tarea, $Completada)
    {
        $query = "UPDATE Tareas SET estado = ? where id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("si", $Completada, $id_tarea);
        $stmt->execute();
        return true;
    }
    public function eliminarTarea($id_tarea)
    {
        $query = "DELETE FROM Tareas WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);

        $stmt->execute();
        $stmt->close();
        return true;
    }
}
