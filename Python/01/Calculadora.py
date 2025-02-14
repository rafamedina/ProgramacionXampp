#creamos las variables de nuestro ejercicio, acto seguido pedimos al usuario que nos introduzca los dos num y le ponemos float para que sean numeros
#creamos 4 if con cada posibilidad e igualamos la operacion para saber que toca hacer, hacemos la operacion y la mostramos.




num1=0
num2=0
suma=0
resta=0
multiplicacion=0
division=0
num1 = float(input("introduce el primer número "))
num2 = float(input("introduce el segundo número "))
Operacion = int(input("selecciona que hacer con el numero, 1-sumar, 2-resta, 3-multiplicación, 4-división "))
if Operacion == 1:    
    suma = num1 + num2 
    print(f"el resultado es {suma}")

if Operacion == 2:
    resta = num1 - num2 
    print(f"elresultado es {resta}")

if Operacion == 3:
    multiplicacion = num1 * num2 
    print(f"el resultado es {multiplicacion}")

if Operacion == 4:
    division = num1 / num2 
    print(f"El resultado es {division}")

