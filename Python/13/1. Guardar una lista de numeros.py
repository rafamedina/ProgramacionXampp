'''
Enunciado: Escribe un programa que genere un array de Numpy con 10 números enteros aleatorios entre 1 y 100. Guarda estos números en un archivo de texto llamado numeros.txt, escribiendo cada número en una nueva línea. Luego, escribe otro programa que abra el archivo numeros.txt, lea los números y los almacene en un array de Numpy. Muestra en pantalla el array leído.
'''

import numpy as np
array = np.random.randint(1, 100, size=10)
def creararchivo():
    try:
        with open('numeros.txt', 'w') as archivo:
            for numeros in array:
                archivo.write(f"{numeros}\n")
    except FileNotFoundError:
        print('El archivo no fue encontrado.')
creararchivo()

def leerarchivo():
    try:
        with open('numeros.txt', 'r') as archivo:
            numeros = [int(linea.strip()) for linea in archivo]
            array_leido = np.array(numeros)
            print("Array leído desde el archivo:", array_leido)
    except FileNotFoundError:
        print('El archivo no fue encontrado.')

leerarchivo()