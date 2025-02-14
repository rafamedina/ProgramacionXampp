import numpy as np
'''
#para crear un array 

mi_lista=[1,2,3,4]
mi_array = np.array(mi_lista)

print(mi_array)
'''

'''

mi_matriz = np.array([[ 1, 2, 3 ],[ 4, 5, 6 ]])

print(mi_matriz)
'''
# Salida:
# [[1 2 3]    #El valor 2 sería el elemento (0, 1) de mi array - fila 0 columna 1
#  [4 5 6]]   #El valor 6 sería el elemento (1, 2) de mi array - fila 1 columna 2
'''
ceros = np.zeros((3, 4))
print(ceros)
'''

'''
array1 = np.array([1, 2, 3, 4])
array2 = np.array([10, 20, 30, 40])


suma = array1 + array2
print(suma)  # Salida: [11 22 33 44]


producto = array1 * array2
print(producto)  # Salida: [10 40 90 160]

valores = np.array([1, 4, 9, 16])
raices = np.sqrt(valores)
print(raices)  # Salida: [1. 2. 3. 4.]

También puedes calcular el promedio de un array usando np.mean():
promedio = np.mean(valores)
print(promedio)  # Salida: 7.5
'''
'''
mi_array = np.array([10, 20, 30, 40])
print(mi_array[2])  # Salida: 30
Para arrays multidimensionales, puedes acceder a los elementos especificando los índices de cada dimensión:
mi_matriz = np.array([[1, 2, 3], [4, 5, 6]])
print(mi_matriz[1, 2])  # Salida: 6
4.2 Modificar Elementos
También puedes modificar los valores de un array de forma similar a como lo harías con listas:
mi_array[0] = 100
print(mi_array)  # Salida: [100  20  30  40]
'''