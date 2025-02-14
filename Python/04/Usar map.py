
alturas_metros=[1.60, 1.75, 1.80, 1.50]

def metros_a_centimetros(lista):
    return lista *100

resultado = map(metros_a_centimetros, alturas_metros)


lista_resultado = list(resultado)
print(lista_resultado)