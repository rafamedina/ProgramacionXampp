'''
Ejercicio 5: Filtrar tareas urgentes
Tienes una lista de tareas de un gestor de proyectos, y algunas de ellas están marcadas como urgentes. Utiliza filter() para obtener una lista de tareas urgentes y luego imprímelas.
'''

Tareas=[
    {"tarea": "barrer", "estado": "urgente"},
    {"tarea": "fregar", "estado": "no urgente"},
    {"tarea": "limpiar polvo", "estado": "urgente"},
    {"tarea": "cristales", "estado": "no urgente"},
    {"tarea": "coser", "estado": "urgente"},
]


def lista_prioridades(listas):
    return listas["estado"]=="urgente"

resultado=list(filter(lista_prioridades, Tareas))

print(resultado)