#Para hacer este ejercicio importamos la libreria random y le añdimos a la variable nsscreto = random.randint(1.100), luego hacemos un bucle while para que mientras falle siga pudiendo intentar adivinar
#Para las opciones usamos if 


nsecreto = 0
num=0
import random
nsecreto = random.randint(1,100)

while num != nsecreto:
    num = int(input("Introduce tu intento "))
    if num < nsecreto:
            print("el numero secreto es mayor")
    if num > nsecreto: 
            print("el numero secreto es menor")
if num == nsecreto: 
    print("Felicidades")




