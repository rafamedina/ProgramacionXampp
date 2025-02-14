num=3
contador=0
suma=0
media=0
print("Introduce de que numeros quieres el promedio, si introduces 0 se para ")

while num!=0:
    num = int(input("Introduce en numero aqui "))
    for i in range (1,num + 1):
        suma=suma+num
        contador = contador + 1
        
media=suma/contador

print(f"la media es {media}")