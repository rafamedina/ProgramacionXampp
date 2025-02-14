'''
Ejercicio 5: Calcular la Longitud de Cada Palabra en una Lista
Enunciado: Tienes una lista de palabras y quieres saber cuántas letras tiene cada una. Crea una función que calcule la longitud y úsala junto con map().
Qué debes practicar:
Uso de la función map().
Definir funciones que trabajen con cadenas de texto (en este caso, calcular la longitud con len()).
Procesar listas de cadenas de texto para obtener información sobre sus elementos.
'''

lista=("hola", "sexy", "moco")

def calcular(listas):

    return len(listas)

resultado = list(map(calcular,lista))
print (resultado) 