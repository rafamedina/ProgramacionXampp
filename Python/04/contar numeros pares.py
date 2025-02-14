

def contar_pares(listanumeros):
    contador=0
    for numero in listanumeros:
        if numero%2==0:
            contador = contador + 1
    return contador


lista=list(range(20))
lista2=list(range(5))


numeros_pares = contar_pares(lista)

print(f"la cantidad de numeros pares en la lista es de {numeros_pares}") 