import DAO_eje16departamento as daoe
import DAO_eje16trabjadores as daot

def menu():
    while True:
        opcion = input("Sobre que tabla quiere trabajar, 1 - Departamentos, 2 - Trabajadores, 3 - Salir: ")
        if opcion == "1":
            daoe.menu()
        elif opcion == "2":
            daot.menu()
        elif opcion == "3":
            print("Gracias por utilizar el sistema")
            break
        else:
            print("Opción no válida, por favor ingrese una opción válida")