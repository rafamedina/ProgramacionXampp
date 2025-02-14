import mysql.connector

def conectaBBDD(basedatos):
# Establecer conexión con la base de datos
    conexion = mysql.connector.connect(
        host="localhost",       # Dirección del servidor (localhost para base de datos local)
        user="root",         # Usuario de la base de datos
        password="1234",  # Contraseña del usuario
        database=basedatos    # Nombre de la base de datos
    )
    return conexion 