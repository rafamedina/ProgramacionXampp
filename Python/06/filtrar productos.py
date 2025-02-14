'''
Ejercicio 1: Filtrar productos perecederos
Tienes una lista de productos en un almacén y algunos de ellos son perecederos (frutas, vegetales, etc.) mientras que otros no (enlatados, productos secos). Crea un programa que utilice filter() para obtener solo los productos perecederos y luego imprímelos.
'''

productos = [
    "manzana", "plátano", "tomate", "arroz", "lentejas",
    "zanahoria", "sopa enlatada", "espinaca", "pasta",
    "fresa", "aceite", "cebolla", "frijoles enlatados"
]

perecederos = ["manzana", "plátano", "tomate", "zanahoria", "espinaca", "fresa"]


def perecederos_si(lista):
    return lista in perecederos

resultado=list(filter(perecederos_si,productos))


print(resultado)

