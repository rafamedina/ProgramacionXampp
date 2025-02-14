'''
Ejercicio 3: Bucle while con condición
Descripción:
Escribe un programa que solicite al usuario un número y luego imprima todos los números desde ese número hasta cero.
Instrucciones:
Solicita al usuario que ingrese un número entero positivo.
Utiliza un bucle while que continúe mientras el número sea mayor o igual a cero.
En cada iteración, imprime el número actual y luego decrementa su valor en 1.
'''


palabra =int(input("Escribe el numero deseado, si escibres 0 se para: "))
while palabra > 0:
    print(palabra)
    palabra -= 1
    