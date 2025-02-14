numeros = [4,9,16,25,1,7,12]

def mayor_a_10(numero):
    return numero > 10


numero_mayor_10=filter(mayor_a_10,numeros)

lista_final=list(numero_mayor_10)

print(lista_final)