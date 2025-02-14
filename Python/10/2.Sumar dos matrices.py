'''
Ejercicio 2: Sumar dos Matrices
Enunciado: Crea dos matrices de 2x3 con valores enteros de tu elección. Suma ambas matrices elemento por elemento y muestra el resultado.
Ayuda:
Usa np.array() para crear las matrices manualmente, por ejemplo, np.array([[1, 2, 3], [4, 5, 6]]).
'''
import numpy as np
matriz1 = np.array([[1, 2, 3], [4, 5, 6]])

matriz2= np.array([[7, 6, 8], [10, 11, 12]])

print(matriz1)
print(matriz2)

matriz3 = matriz1 + matriz2

print(matriz3)