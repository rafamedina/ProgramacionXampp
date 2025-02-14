'''
Ejercicio 1: Crear una Matriz de Ceros y Cambiar Valores
Enunciado: Crea una matriz de 3x3 llena de ceros. Luego, cambia el valor del elemento en la posición central a 1 y muestra la matriz resultante.
Ayuda:
Utiliza np.zeros((3, 3)) para crear una matriz de 3x3 con todos los elementos en cero.
Recuerda que en una matriz de 3x3, el elemento central está en la posición [1, 1]. Cambia el valor de ese elemento accediendo a la posición con la notación de índice.
'''


import numpy as np 


matriz = np.zeros((3,3))

print(matriz)

matriz[1,1]=1
print(matriz)