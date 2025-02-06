DROP DATABASE IF EXISTS Planner;
CREATE DATABASE IF NOT EXISTS Planner;
Use Planner;

CREATE TABLE IF NOT EXISTS Usuarios(
id_usuario int primary key auto_increment,
nombre Varchar(100) NOT NULL,
apellido Varchar(100) Not null,
correo varchar(100) NOT NULL UNIQUE,
telefono varchar(15) NOT NULL UNIQUE,
contraseña varchar(255) NOT NULL);

select * from usuarios;

CREATE TABLE IF NOT EXISTS Tareas (
    id_tarea INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario int,
    descripcion TEXT NOT NULL,
    estado ENUM('Pendiente', 'Completada') DEFAULT 'Pendiente',
    FOREIGN KEY (id_usuario) references Usuarios(id_usuario) on delete cascade on update cascade
);

select * from Tareas;



SELECT descripcion, estado from tareas where id_usuario = 1;
 