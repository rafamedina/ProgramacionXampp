import random  #importamos la libreria random
contador = 3 #numero de veces que se necesita para ganar (persona)
contador2 = 3 #numero de veces que se necesita para ganar (máquina)
nombres = {
    1: "Piedra",
    2: "Papel",
    3: "Tijera"
} #se crea un diccionario para especificar que 1 es piedra, 2 es papel y 3 es tijera, asi la mostrarlo eleccion y resultado nos dice el nombre y no el numero

while contador>0 and contador2>0: #mientras las veces que necesiten ganar no sean 0
      eleccion=int(input("Elige 1-Piedra | 2-Papel | 3-Tijera ")) #escoge la opción
      resultado=random.randint(1,3) #dentro del bucle se crea el numero random del 1 al 3 que esta asociado con el diccionario
      if eleccion >=1 and eleccion <=3: #filtro para que solo se pueda coger del 1 al 3
            print(f"El jugador ha elegido {nombres[eleccion]}") #muestra la eleccion
            print(f"La máquina ha escogido {nombres[resultado]}")
            if eleccion == 1 and resultado == 1:
                  print("Empataste")
            elif eleccion == 1 and resultado == 2:
                  print("Perdiste")
                  contador2=contador2-1
            elif eleccion == 1 and resultado == 3:
                  print("Ganaste")
                  contador=contador-1
            elif eleccion == 2 and resultado == 1:
                  print("Ganaste")
                  contador=contador-1
            elif eleccion == 2 and resultado == 2:
                  print("Empataste")
            elif eleccion == 2 and resultado == 3:
                  print("Perdiste")
                  contador2=contador2-1
            elif eleccion == 3 and resultado == 1:
                  print("Perdiste")
                  contador2=contador2-1
            elif eleccion == 3 and resultado == 2:
                  print("Ganaste")
                  contador=contador-1
            elif eleccion == 3 and resultado == 3:
                  print("empataste")
#utilizamos bucles if para decirle al programa cuales son los posibles resultados
      elif eleccion > 3:
            print("numero no valido")
if contador == 0:
      print("Felicidades, ganaste")
elif contador2 == 0:
      print("perdiste, más suerte la próxima vez")
#mensaje para especificar si has ganado la partida o las has perdido