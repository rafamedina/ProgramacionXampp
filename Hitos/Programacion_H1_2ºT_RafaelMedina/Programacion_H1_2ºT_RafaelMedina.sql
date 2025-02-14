DROP DATABASE if exists Streamweb;
CREATE DATABASE Streamweb;
USE Streamweb;


-- Tabla Planes con precios actualizados
CREATE TABLE Plan (
    id_plan INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    dispositivos INT,  -- Número de dispositivos permitidos
    precio DECIMAL(10, 2),
    duracion_suscripcion ENUM("Mensual","Anual")
);

-- Insertar los datos en la tabla Plan
INSERT INTO Plan (nombre, dispositivos, precio, duracion_suscripcion) VALUES 
('Básico', 1, 9.99, "Mensual"),
('Básico', 1, 9.99*12, "Anual"),
('Estándar', 2, 13.99, "Mensual"),
('Estándar', 2, 13.99*12, "Anual"),
('Premium', 4, 17.99, "Mensual"),
('Premium', 4, 17.99*12, "Anual")
;


-- Tabla Paquetes con precios actualizados
CREATE TABLE Paquetes (
    id_paquete INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    precio DECIMAL(10, 2),
    descripcion text
);

-- Insertar los datos en la tabla Paquetes
INSERT INTO Paquetes (nombre, precio, descripcion) VALUES 
('Deporte', 6.99, "Solo con Plan Anual"),
('Cine', 7.99,NULL),
('Infantil', 4.99, "Para menores de edad");

-- Tabla Usuarios
CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    edad INT NOT NULL CHECK (edad >= 0),
    telefono int not null
);
INSERT INTO Usuarios (nombre, apellidos, correo, edad, telefono) 
VALUES ('Juan', 'Pérez', 'juan.perez@example.com', 30, 123456789),
('Iker', 'Pérez', 'Iker.perez@example.com', 15, 63263276);

CREATE TABLE Administrador (
    id_admin varchar(50) Primary key,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
	contraseña VARCHAR(255)
);
insert into Administrador (id_admin, nombre, apellidos, correo, contraseña) values ("admin", "Rafa", "Medina", "rafa@gmail.com", "$2a$12$Bq8.wXhaOlVM/k0etLLBouTchF20x3LxOsf2Q1jVcIXPPOhn6PpEi"); -- contraseña "1234"
select * from administrador;

-- Tabla Resumen (Relación entre Usuarios, Paquetes y Planes)
CREATE TABLE Resumen (
	id_resumen int auto_increment primary key,
    id_usuario INT,
    id_plan INT,
    id_paquete1 INT null,
    id_paquete2 INT null,
    id_paquete3 INT null,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE ON update CASCADE,
    FOREIGN KEY (id_paquete1) REFERENCES Paquetes(id_paquete) ON DELETE CASCADE ON update CASCADE,
    FOREIGN KEY (id_paquete2) REFERENCES Paquetes(id_paquete) ON DELETE CASCADE ON update CASCADE,
    FOREIGN KEY (id_paquete3) REFERENCES Paquetes(id_paquete) ON DELETE CASCADE ON update CASCADE,
    FOREIGN KEY (id_plan) REFERENCES Plan(id_plan) ON DELETE CASCADE  ON update CASCADE
);



