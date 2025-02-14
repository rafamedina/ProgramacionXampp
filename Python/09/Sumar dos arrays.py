'''
Ejercicio 1: Sumar dos arrays elemento por elemento
Enunciado: Crea dos arrays de Numpy de tamaño 5, llenos de números enteros. Luego, calcula la suma de ambos arrays elemento por elemento y muestra el resultado.
Motivo para usar arrays: Con Numpy, podemos sumar directamente dos arrays usando la operación +, sin necesidad de recorrer cada elemento manualmente como tendríamos que hacer con listas.'''

import numpy as np

array1 = np.array([1,2,3,4,5])
array2 = np.array([6,7,8,9,10])

sumaarray = array1 + array2

print(sumaarray)