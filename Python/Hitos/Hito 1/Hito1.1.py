eleccion=0 #igualamos la eleccion a 0 para poder entrar en el bucle

while eleccion != 3: #creamos un bucle while para que continue siempre que no seleccione la opcion 3
    print("Menu")
    eleccion = int(input("1-Cuadrado\n2-Rectangulo\n3-salir\nDime una opción: ")) #creamos un input para que elija su elección
    if eleccion >= 1 and eleccion <= 3: #acotamos posibles respuestas
        if eleccion == 1: 
            ladocuadrado=int(input("Dime el lado del cuadrado: "))
            areacuadrado=ladocuadrado*ladocuadrado/2
            perimetrocuadrado=ladocuadrado*4
            print(f"su area es {areacuadrado}")
            print(f"su perimetro es {perimetrocuadrado}")
            for i in range (ladocuadrado):
                print("*"*ladocuadrado)
# un if que si escoge 1 (Cuadrado), le pide el lado y con eso calcula el area y el perimetro, se lo muestra
#para ejemplificarlo con los asteriscos se crea un bucle para que por cada lado del cuadrado se multiplique por "*"
        
        elif eleccion == 2:
            baserectangulo=int(input("dime la base del rectangulo: "))
            alturarectangulo=int(input("dime la altura del rectangulo: "))
            arearectangulo=baserectangulo*alturarectangulo/2
            perimetrorectangulo=(baserectangulo*2)+(alturarectangulo*2)
            print(f"Su area es {arearectangulo}")
            print(f"Su perimetro es {perimetrorectangulo}")
            for i in range (alturarectangulo):
                print("*"*baserectangulo)
# un if que si escoge 2 (Rectangulo), le pide el lado y la base, con eso calcula el area y el perimetro, se lo muestra
#para ejemplificarlo con los asteriscos se crea un bucle para que por cada numero en la altura del rectanfulo se multiplique por "*" en la base
        elif eleccion == 3:
            print("Programa terminado")
            #con esto se sale del bucle
    else:
        print("Opción incorrecta")




