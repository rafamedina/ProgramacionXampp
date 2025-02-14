import DAO_eje15departamento as daoe
import DAO_eje16trabjadores as daot
import DAO_eje17Clientes as daoc
def menu():
    while True:
        opcion = input("Sobre que tabla quiere trabajar, 1 - Departamentos, 2 - Trabajadores, 3 - Clientes, 4 - Salir: ")
        if opcion == "1":
            daoe.menu()
        elif opcion == "2":
            daot.menu()
        elif opcion == "3":
            daoc.menu()
        elif opcion == "4":
            print("Gracias por utilizar el sistema")
            break
        else:
            print("Opción no válida, por favor ingrese una opción válida")