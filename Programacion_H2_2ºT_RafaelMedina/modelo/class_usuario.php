<?php
// Incluyo el archivo de conexión a la base de datos
require_once '../config/class_conexion.php';

class Usuario
{
    private $conexion; // Variable para manejar la conexión a la base de datos

    public function __construct()
    {
        // Al crear un objeto de esta clase, inicializo la conexión
        $this->conexion = new Conexion();
    }

    public function ComprobarCorreo($correo)
    {
        $query = "SELECT * FROM usuarios WHERE correo = ?";

        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        if (!$resultado) {
            return True;
        } else {
            return false;
        }
    }

    public function agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        if ($this->ComprobarCorreo($correo) == false) {
            return false;
        } else {
            // Encripto la contraseña antes de guardarla en la base de datos
            $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);
            $query = "INSERT INTO Usuarios (nombre, apellido, correo, telefono, contraseña) VALUES (?, ?, ?, ?, ?)";

            // Preparo la consulta para evitar inyecciones SQL
            $stmt = $this->conexion->conexion->prepare($query);

            // Asigno los valores a la consulta con los tipos adecuados
            $stmt->bind_param("sssss", $nombre, $apellidos, $correo, $telefono, $contraseñaHashed);

            // Ejecuto la consulta y verifico si tuvo éxito
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                // Si hay un error, lo registro en el log
                error_log("Error al agregar Usuarios: " . $stmt->error);
                $stmt->close();
                return false;
            }
        }
    }

    public function iniciarSesionUsuarios($correo, $password)
    {
        // Busco un usuario por su correo
        $query = "SELECT * FROM Usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        // Verifico que el usuario exista y que la contraseña sea correcta
        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            session_start(); // Inicio la sesión
            $_SESSION['id_usuario'] = $usuario['usuario']; // Guardo el ID del usuario en la sesión
            $stmt->close();
            return $usuario; // Devuelvo los datos del usuario si la autenticación es correcta
        } else {
            return false; // Retorno falso si las credenciales no coinciden
        }
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        // Si se proporciona una nueva contraseña, la actualizo junto con los demás datos
        if (!empty($contraseña)) {
            $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);
            $query = "UPDATE Usuarios SET nombre = ?, apellido = ?, correo = ?, telefono = ?, contraseña = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("sssssi", $nombre, $apellidos, $correo, $telefono, $contraseñaHashed, $id_usuario);
        } else {
            // Si no hay nueva contraseña, actualizo solo los otros datos
            $query = "UPDATE Usuarios SET nombre = ?, apellido = ?, correo = ?, telefono = ? WHERE id_usuario = ?";
            $stmt = $this->conexion->conexion->prepare($query);
            $stmt->bind_param("ssssi", $nombre, $apellidos, $correo, $telefono, $id_usuario);
        }
        $stmt->execute();
        return true;
    }

    public function obtenerUsuarioporid($id_usuario)
    {
        // Obtengo un usuario por su ID
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
        // Elimino un usuario por su ID
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
        // Agrego una nueva tarea con su descripción
        $query = "INSERT INTO Tareas (descripcion) VALUES (?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $descripcion);

        if ($stmt->execute()) {
            // Después de agregar la tarea, asigno el usuario correspondiente
            $query2 = "UPDATE Tareas SET id_usuario = ? WHERE id_tarea = LAST_INSERT_ID()";
            $stmt = $this->conexion->conexion->prepare($query2);
            $stmt->bind_param("i", $usuario);
            $stmt->execute();
            return true;
        } else {
            error_log("Error al agregar tarea: " . $stmt->error);
            return false;
        }
    }

    public function ResumenTareasUsuario($usuario)
    {
        // Obtengo el resumen de tareas de un usuario específico
        $query = "SELECT id_tarea, descripcion, estado FROM Tareas WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelvo todas las tareas en un array asociativo
        $planes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $planes;
    }

    public function ResumenTareas($usuario)
    {
        // Obtengo todas las tareas de un usuario
        $query = "SELECT * FROM Tareas WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Devuelvo las tareas en un array asociativo
        $planes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $planes;
    }

    public function actualizarEstadoTarea($id_tarea, $Completada)
    {
        // Cambio el estado de una tarea (por ejemplo, de "pendiente" a "completada")
        $query = "UPDATE Tareas SET estado = ? WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("si", $Completada, $id_tarea);
        $stmt->execute();
        return true;
    }

    public function eliminarTarea($id_tarea)
    {
        // Elimino una tarea por su ID
        $query = "DELETE FROM Tareas WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
