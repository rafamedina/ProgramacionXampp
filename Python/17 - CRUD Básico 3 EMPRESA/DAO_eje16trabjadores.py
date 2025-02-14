import ConectaBBDD

def insertar():
    try:    
        conexion = ConectaBBDD.conectaBBDD('empresa')
        cursor = conexion.cursor()
        print("Vamos a insertar el trabajadores")
        dni = input("Que dni quiere insertar: ")
        nombre = input("Que nombre quiere insertar: ")
        ciudad= input("Que ciudad quiere insertar: ")
        antiguedad = input("Inserta la antiguedad: ")
        salario = input("Inserta el salario: ")
        departamento = input("a que departamento esta asociado: ")
        insertarempresa = f'''Insert into trabajadores (dni, nombre, ciudad, antiguedad, salario, departamento) values ('{dni}','{nombre}','{ciudad}',{antiguedad},{salario},{departamento});'''    
        cursor.execute(insertarempresa)
        conexion.commit()
    except Exception as e:
        print(f"Ocurrió un error inesperado: {e}")
        cursor.close()
        conexion.close()


def listarvalores():
    conexion = ConectaBBDD.conectaBBDD('empresa')
    cursor = conexion.cursor()
    ver_registros_trabajadores='''Select * from trabajadores;'''
    cursor.execute(ver_registros_trabajadores)
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
        cambiodni = input("Inserte el dni del trabajador que quiere cambiar: ")
        dni2 = input("Que dni quiere insertar: ")
        nombre2 = input("Que nombre quiere insertar: ")
        ciudad2= input("Que ciudad quiere insertar: ")
        antiguedad2 = input("Inserta la antiguedad: ")
        salario2 = input("Inserta el salario: ")
        departamento2 = input("a que departamento esta asociado: ")
        actualizar2 = f'''UPDATE trabajadores SET dni = '{dni2}', nombre = '{nombre2}', ciudad = '{ciudad2}', antiguedad = {antiguedad2}, salario = {salario2}, departamento = {departamento2} WHERE DNI = {cambiodni};'''
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
        DNIeliminar= input("que DNI quiere borrar: ")
        eliminar = f'''DELETE FROM trabajadores WHERE dni = {DNIeliminar};'''
        cursor.execute(eliminar)
    except Exception as e:
        cursor.close()
        conexion.close()
        listarvalores()


def menu():

    while True:
            print("Menú BBDD empresa.trabajadores")
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



