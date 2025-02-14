'''
Ejercicio 4: Filtrar libros por categoría
En una librería online, tienes una lista de libros con diferentes categorías (novela, ensayo, poesía, etc.). Usa filter() para filtrar solo los libros de la categoría "novela" y muestra los resultados.
'''

listalibros=[
    {"nombre":"el temor de un hombre sabio","categoria":"Novela"},
    {"nombre":"Frankestein","categoria":"Poesia"},
    {"nombre":"Eragon","categoria":"Novela"},
    {"nombre":"It","categoria":"Novela"},
    {"nombre":"Brisingr","categoria":"ensayo"},
    {"nombre":"terrifier","categoria":"Novela"},
]

def tipo_libro(listas):
    return listas["categoria"]=="Novela"

resultado=list(filter(tipo_libro,listalibros))

print(resultado)