'''
Una funcion es un bloque de codigo que reutilizamos
utilizamos "def" seguida del nombre y u parentesis def ejemplo_nombre() y debajo el codigo
'''
'''
def saludar():
    print("Hola")
def despedir():
    print("adios")



def saludovip(nombrevip):
    print(f"Hola {nombrevip}")

####################################
nombre = "RAFA"
apellido= "medina"
def saludovip(nombrevip, apellidovip):
    print(f"Hola {nombrevip}{apellidovip}")

#saludovip(nombre,apellido)

######################################

#def pinta(numero):
#  print('*'*numero)


#pinta(30)

#####################################

def suma(numero1, numero2):
    resultado = numero1 + numero2
    return resultado

#numero1 = int(input("pimer numero "))
#numero2 = int(input("segundo numero "))



#calculo=suma(numero1,numero2)

#print(calculo * 5)

#########################################

"Librerias"
#import math 
from random import randint
import datetime

#fecha_actual = datetime.datetime.now()
'''
#Instalar las librerias que no estan
'''
#pip install x
'''
import requests 

def cuadrado(numero):
 return numero **2

lista = [1,2,3,4,5]
resultado = map(cuadrado, lista)

lista_resultado = list(resultado)
print(lista_resultado)