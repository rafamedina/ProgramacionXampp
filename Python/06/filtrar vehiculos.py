'''
Ejercicio 2: Filtrar vehículos con revisión pasada
Tienes una lista de vehículos con su estado de revisión técnica (aprobada o pendiente). Usa filter() para crear una lista con los vehículos que ya han pasado la revisión y luego muestra los resultados.
'''
vehiculos = [
    {"modelo": "Toyota Corolla", "estado": "aprobada"},
    {"modelo": "Ford Fiesta", "estado": "pendiente"},
    {"modelo": "Honda Civic", "estado": "aprobada"},
    {"modelo": "Chevrolet Spark", "estado": "pendiente"},
    {"modelo": "Nissan Altima", "estado": "aprobada"},
    {"modelo": "Hyundai Elantra", "estado": "pendiente"},
]

def estado_itv(lista):
    return lista["estado"] == "aprobada"


resultado = list(filter(estado_itv,vehiculos))

print (resultado)