'''
Ejercicio 7: Uso de if-elif-else con opciones
Descripción:
Escribe un programa que muestre un menú de opciones simples al usuario y realice una acción según la opción seleccionada.
Instrucciones:
Muestra las siguientes opciones al usuario:
Saludar
Despedirse
Preguntar cómo está
Solicita al usuario que seleccione una opción ingresando el número correspondiente.
Utiliza estructuras if-elif-else para manejar cada opción y mostrar un mensaje adecuado.
Si el usuario ingresa una opción inválida, informa al usuario.
'''
opciones= int(input("selecciona una opcion 1-Saludar, 2-Despedirse, 3-Preguntar como está"))
if opciones >= 1 and opciones <=3:
    if opciones == 1:
        print("Hola")
    elif opciones == 2:
        print("Adios")
    elif opciones ==3:
        print("Como te encuentras?")
else:
    print("Opcion no valida")
