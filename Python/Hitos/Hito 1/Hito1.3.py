
saldo=-15 #creamos la variable saldo en negativo para entrar en el bucle
eleccion=0 
contador_ingresos=0 #creamos dos contadores uno para ingresos y otro para retiradas
contador_retiradas=0

while saldo < 0: #si el saldo es menor que 0, esto es para que se repita el bucle hasta que meta un saldo válido
    saldo = float(input("por favor introduce el saldo: "))#float para que puedan ser décimales
while eleccion != 5: #mientras la elección no sea 5 (salida)
    eleccion = int(input("Elige una opción 1-ingresar dinero, 2-retirar dinero, 3- mostrar saldo, 4 estadísticas y 5-salir "))#pedimos la elección
    if eleccion >=1 and eleccion <= 5: #acotamos posibles resultados
        if eleccion == 5:
            print("Vuelva proto") #con el 5 salimos
        elif eleccion == 1:
            while True:
                cantidadingresada = float(input("Que cantidad va a ingresar: "))
                if cantidadingresada > 0:
                    saldo=saldo+cantidadingresada
                    print(f"Tu nuevo saldo es {saldo}")
                    contador_ingresos = contador_ingresos + 1
                    break    
                    #hacemos un bucle while true y le pedimos la cantidad a ingresar, esta será válida mientras sea positiva, utilizamos break para salir al menú principal
                else:
                    print("Cantidad no válida") 
        elif eleccion == 2:
            while True:
                cantidadretirada= float(input("Cuanto dinero desea retirar: "))
                if cantidadretirada > 0:
                    if cantidadretirada <= saldo:
                        saldo=saldo-cantidadretirada
                        print(f"TU nuevo saldo es {saldo}")
                        contador_retiradas=contador_retiradas+1
                        break
                    #hacemos otro buycle while true para retirar el dinero hacemos dos flitros con if, esta cantidad tiene que ser mayo a 0 y menor que el saldo
                    #con los contadores +1 contamos las veces que se utilizan tanto el ingreso como la retirada
                    #utilizamos break para volver al menu principal
                    else:
                        print("la cantidad a retirar no puede ser mayor a tu saldo")
                else:
                    print("Cantidad no válida")        
        elif eleccion == 3:
                        print(f"Tu saldo es: {saldo}") #mostramos el saldo actual
        elif eleccion == 4:
            print(f"la cantidad de veces que has retirado es de {contador_retiradas}")
            print(f"la cantidad de veces que has ingresado es de {contador_ingresos}")
        #si nos piden esta opcion mostramos la cantidad de movimientos realizados
    else:
        print("opción lo válida")

