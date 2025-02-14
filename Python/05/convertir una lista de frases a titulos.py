'''
Ejercicio 2: Convertir una Lista de Frases a Títulos
Enunciado: Tienes una lista de frases y quieres que cada palabra empiece con mayúscula (convertir cada frase a título). Aplica la función title() a cada frase usando map().
Qué debes practicar:
Uso de la función map().
Aplicar métodos predefinidos de Python (.title()).
'''
lista=("hola", "sexy", "moco")

def palabra_mayuscula(listas):
    return listas.title()



resultado=(map(palabra_mayuscula,lista))

lista_final=list(resultado)

print(lista_final)