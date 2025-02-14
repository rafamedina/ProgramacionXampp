'''
Ejercicio 5: Encontrar el Valor Máximo en Cada Columna
Enunciado: Crea una matriz de 4x3 con valores enteros aleatorios entre 1 y 50. Encuentra y muestra el valor máximo de cada columna.
Ayuda:
Usa np.random.randint(1, 51, size=(4, 3)) para crear la matriz de 4x3 con valores aleatorios entre 1 y 50.
Para encontrar el valor máximo de cada columna, utiliza np.max(matriz, axis=0), donde axis=0 indica que queremos el máximo de cada columna.
'''
import numpy as np

matriz = np.random.randint(1, 51, size=(4, 3))

print(matriz)
print(np.max(matriz, axis=0))
