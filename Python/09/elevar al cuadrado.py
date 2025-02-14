'''
Ejercicio 5: Elevar al cuadrado cada elemento de un array
Enunciado: Crea un array de Numpy con 5 elementos enteros. Calcula el cuadrado de cada elemento y muestra el resultado.
Motivo para usar arrays: Numpy permite aplicar operaciones matemáticas, como la potenciación, a cada elemento de un array en una sola operación. Esto es mucho más eficiente que hacer un bucle para elevar cada elemento al cuadrado en una lista.'''
import numpy as np

array1 = np.array([1,2,3,4,5])

arraycuadrado= array1 ** 2

print(arraycuadrado)