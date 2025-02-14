#creamos la variable NNN para saber que numero es 
#igualamos NNN a un input con int para que sea entero y luego creamos un if para asegurarnos de que es positivo
#un bucle para que vaya por el rango desde 1 hasta NNN 
#para cada valor de i en el rango se suma a la variable suma

nnn=0
suma=0

nnn = int(input("por favor escribe el numero que le interesa saber "))
if nnn > 0:
    for i in range (1, nnn):
        suma = suma + i

print(f"la suma de los digitos es {suma}")