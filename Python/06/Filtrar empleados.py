'''
Ejercicio 3: Filtrar empleados activos
Crea un programa que reciba una lista de empleados de una empresa con su estado laboral (activo o inactivo). Utiliza filter() para filtrar solo a los empleados que están actualmente activos y luego imprime sus nombres.
'''

listalaboral = [
    {"nombre":"Jose","estado":"activo"},
    {"nombre":"Luis","estado":"inactivo"},
    {"nombre":"marta","estado":"inactivo"},
    {"nombre":"sara","estado":"activo"},
    {"nombre":"melanie","estado":"inactivo"},
    {"nombre":"rafa","estado":"activo"},
]

def estado_laboral(lista):
    return lista["estado"] == "activo"

resultado = list(filter(estado_laboral,listalaboral))

print(resultado)