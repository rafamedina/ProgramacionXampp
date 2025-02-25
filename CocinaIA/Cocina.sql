-- Active: 1739545017843@@127.0.0.1@3306@librodecocina
DROP database LibrodeCocina;
Create database LibrodeCocina;

Use LibrodeCocina;

Create Table LibroRecetas(
    id_receta int primary key AUTO_INCREMENT,
    nombre VARCHAR(255) UNIQUE,
    descripcion text,
    preparacion text,
    ingredientes text
    );


Insert into librorecetas (nombre, descripcion, preparacion, ingredientes) VALUES (?,?,?,?)
desc librorecetas;


Select * from librorecetas;