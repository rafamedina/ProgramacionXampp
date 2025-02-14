lista=list(range(20))



def encontrar_maximo(listanumero):
    max=0
    for numero in listanumero:
        if (numero > max):
            max = numero
        
    return max
    

numero_alto= encontrar_maximo(lista)



print(numero_alto)







