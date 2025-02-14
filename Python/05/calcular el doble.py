'''
Ejercicio 3: Calcular el Doble de Cada Número en una Lista
Enunciado: Quieres calcular el doble de cada número en una lista. Crea una función que calcule el doble y úsala junto con map().
Qué debes practicar:
Uso de la función map().
Definir funciones matemáticas básicas (en este caso, multiplicar por 2).
Transformar elementos de una lista.
'''

lista=(1,2,4,5,6,7,8)

def calcular_doble(listas):
    return listas *2


resultado=list(map(calcular_doble,lista))
print(resultado)