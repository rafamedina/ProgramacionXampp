'''
Ejercicio 4: Uso de if-elif-else
Descripción:
Crea un programa que solicite al usuario su edad y determine en qué etapa de la vida se encuentra.
Instrucciones:
Solicita al usuario que ingrese su edad.
Utiliza estructuras if-elif-else para determinar la etapa:
Si la edad es menor que 13, muestra "Eres un niño/a."
Si la edad está entre 13 y 17, muestra "Eres un/a adolescente."
Si la edad está entre 18 y 64, muestra "Eres un/a adulto/a."
Si la edad es 65 o mayor, muestra "Eres un/a adulto/a mayor."
'''


edad = int(input("Introduce una edad: "))

if edad < 13:
    print("eres un niño")

elif edad >= 13 and edad <=17:
    print("eres un adolescente")

elif edad > 17 and edad <= 64:
    print("eres un adulto")

else:
    print("eres un anciano")