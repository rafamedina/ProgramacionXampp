'''
Ejercicio 2: Multiplicar cada elemento de un array por un número
Enunciado: Crea un array de Numpy de tamaño 6 con valores enteros de tu elección. Luego, multiplica cada elemento del array por 3 y muestra el resultado.
Motivo para usar arrays: La multiplicación escalar con arrays es mucho más eficiente en Numpy, ya que la operación se aplica directamente a cada elemento sin necesidad de un bucle.'''
import numpy as np

array1 = np.array([1,2,3,4,5,7])

resultado = array1 * 3

print(resultado)