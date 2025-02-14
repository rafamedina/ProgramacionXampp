lista=(1,4,5,6,7,8,2,34)

def sumar_5(listas):
    return listas + 5


resultado=map(sumar_5,lista)

lista_final=list(resultado)
print(lista_final)