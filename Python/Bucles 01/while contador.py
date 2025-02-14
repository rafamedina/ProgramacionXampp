'''
Ejercicio 6: Bucle while con contador
Descripción:
Crea un programa que cuente cuántas veces el usuario ingresa un número negativo antes de ingresar un número positivo.
Instrucciones:
Inicializa un contador en 0.
Utiliza un bucle while que continúe hasta que el usuario ingrese un número positivo.
En cada iteración, solicita al usuario que ingrese un número.
Si el número es negativo, incrementa el contador.
Cuando el usuario ingrese un número positivo, imprime cuántos números negativos ingresó.
'''
numero = -1
contador=0
while numero < 0:
    numero = int(input("INgrese un numero: "))
    contador += 1

print(f"el numero total de numeros negativos ha sido de {contador}")