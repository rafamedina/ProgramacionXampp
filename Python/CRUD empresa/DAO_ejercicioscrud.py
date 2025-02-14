import ConectaBBDD

def listar_miembros():
    conexion = ConectaBBDD.conectaBBDD("prueba1")
    cursor = conexion.cursor()

    consulta='''
    SELECT nombre FROM clientes
    '''

    cursor.execute(consulta)

    resultados= cursor.fetchall()
    for nombre in resultados:
        print(f"el nombre es {nombre}")

    cursor.close()
    conexion.close

def insertar_cliente():
    conexion = ConectaBBDD.conectaBBDD("prueba1")
    cursor = conexion.cursor()

    insertarcliente='''
    Insert ignore into clientes(id,nombre, email, telefono, puntos, fecha_registro)
    values(15,'Iker', 'marcos@gmail.com', '654864533', 5000, '2024-11-19');
    '''
    cursor.execute(insertarcliente)
    conexion.commit()
    print("Insertado correctamente")

    cursor.close()
    conexion.close()
