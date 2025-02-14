import ConectaBBDD

def insertar():
    try:    
        conexion = ConectaBBDD.conectaBBDD('empresa')
        cursor = conexion.cursor()
        print("Vamos a insertar el Cliente")
        nombre = input("Que nombre quiere insertar: ")
        email= input("Que ciudad quiere insertar: ")
        edad = input("Inserta la antiguedad: ")
        insertarcliente = f'''Insert into Clientes ( nombre, email, edad) values ('{nombre}','{email}',{edad});'''    
        cursor.execute(insertarcliente)
        conexion.commit()
    except Exception as e:
        print(f"Ocurrió un error inesperado: {e}")
        cursor.close()
        conexion.close()


def listarvalores():
    conexion = ConectaBBDD.conectaBBDD('empresa')
    cursor = conexion.cursor()
    ver_registros_clientes='''Select * from clientes;'''
    cursor.execute(ver_registros_clientes)
    registros = cursor.fetchall()
    for registro in registros:
        print(registro)
    cursor.close
    conexion.close

def modificarregistro():
    try:
        conexion = ConectaBBDD.conectaBBDD('empresa')
        cursor = conexion.cursor()
        print("Vamos a actualizar un dato")
        cambioid = input("Inserte el id del trabajador que quiere cambiar: ")
        nombre2 = input("Que nombre quiere insertar: ")
        email2= input("Que ciudad quiere insertar: ")
        edad2 = input("Inserta la antiguedad: ")
        actualizar2 = f'''UPDATE trabajadores SET nombre = '{nombre2}', email = '{email2}', edad = {edad2} WHERE DNI = {cambioid};'''
        cursor.execute(actualizar2)
        conexion.commit()
    except Exception as e:   
        cursor.close()
        conexion.close()
        listarvalores()


def Eliminarregistro():
    try:
        conexion = ConectaBBDD.conectaBBDD('empresa')
        cursor = conexion.cursor()
        ideliminar= input("que cliente quiere borrar, inserta su id: ")
        eliminar = f'''DELETE FROM Clientes WHERE id = {ideliminar};'''
        cursor.execute(eliminar)
    except Exception as e:
        cursor.close()
        conexion.close()
        listarvalores()


def menu():
    while True:
            print("Menú BBDD empresa.Clientes")
            print("1. Insertar registro")
            print("2. Listar registros")
            print("3. Modificar registro")
            print("4. Eliminar registro")
            print("5. Salir")
            opcion = input("Elige una opción: ")
            if opcion == "1":
                insertar()
            elif opcion == "2":
                listarvalores()
            elif opcion == "3":
                modificarregistro()
            elif opcion == "4":
                Eliminarregistro()
            elif opcion == "5":
                print("adiós")
                break
            else:
                print("Opción no válida, por favor elige una opción del menú")



