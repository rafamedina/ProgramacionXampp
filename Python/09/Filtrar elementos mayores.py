'''
Ejercicio 4: Filtrar elementos mayores a un valor dado
Enunciado: Crea un array de Numpy con 8 números enteros. Luego, crea un nuevo array que solo contenga los elementos mayores a 5 y muéstralo.
Motivo para usar arrays: Con Numpy, puedes aplicar filtros de manera muy rápida usando operaciones de comparación en una sola línea. Filtrar listas de esta forma requeriría escribir bucles y condicionales adicionales.'''

import numpy as np

array1 = np.array([1,2,3,4,5,7,9,15])
array2 = array1[array1 > 5]


print(array2)



