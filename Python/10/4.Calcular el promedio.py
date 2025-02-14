'''
Ejercicio 4: Calcular el Promedio de Cada Fila
Enunciado: Crea una matriz de 3x4 con valores enteros de tu elección. Calcula y muestra el promedio de los valores en cada fila de la matriz.
Ayuda:
Puedes crear la matriz con np.array([[..], [..], [..]]).
Para calcular el promedio de cada fila, utiliza np.mean(matriz, axis=1), donde axis=1 especifica que queremos el promedio por fila.
'''
import numpy as np
matriz1 = np.array([[1, 2, 3, 4], [4, 5, 6, 5], [7, 8, 9, 10]])


print(np.mean(matriz1, axis=1))
