'''
Enunciado: Escribe un programa que cree una matriz de 3x3 con valores enteros aleatorios entre 1 y 10 utilizando Numpy. Guarda la matriz en un archivo llamado matriz.txt, escribiendo cada fila en una línea separada, con los valores separados por comas (por ejemplo, 1,2,3). Luego, escribe otro programa que lea el archivo matriz.txt, convierta los datos en un array bidimensional de Numpy y muestre la matriz resultante en pantalla.
'''
import numpy as np


matriz = np.random.randint(1, 11, size=(3, 3))

np.savetxt('matriz.txt', matriz, delimiter=',', fmt='%d')

matriz_leida = np.loadtxt('matriz.txt', delimiter=',')

print(matriz_leida)


#profre me has tenido mirando foros un rato, no se si podiamos utilizar el savetxt y el loadtxt pero es como lo he mirado

