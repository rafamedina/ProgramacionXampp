'''
Ejercicio 4: Redondear una Lista de Números Decimales
Enunciado: Tienes una lista de números decimales y quieres redondear cada uno de ellos. Utiliza la función map() y la función predefinida round().
Qué debes practicar:
Uso de la función map().
Aplicar funciones predefinidas de Python (round()).
Trabajar con números decimales y redondeo.
'''

lista=(1.3231,3.32131,342.312)

def redondear(listas):
    return round(listas)


resultado=list(map(redondear,lista))

print(resultado)