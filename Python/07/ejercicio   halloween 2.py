import random
monstruos = {    #Lista de monstruos posibles
    1 : "vampiro",
    2 : "zombie",
    5 : "dragon",
    4 : "sucubo",
    3 : "payaso",
}

objetos = [        #Lista de objetos
    "estaca",
    "hechizo",
    "espada",
]
switch = False    #Booleano para el resultado final
intentos = 3  #Numero de intentos
objetos_sin_comillas = ", ".join(objetos) #para que al mostrar la lista no se vea con comillas

def probabilidad(nivel_monstruo):  #funcion para crear un sistema de probabilidad para capturar al monstruo
    probcap = random.randint(1,6)
    if nivel_monstruo == 1:
        if probcap == 1 or probcap == 2 or probcap == 3 or probcap == 4 or probcap == 5:
            return True
        else:
            return False
    elif nivel_monstruo == 2:
        if probcap == 1 or probcap == 2 or probcap == 3 or probcap == 4:
            return True
        else:
            return False
    elif nivel_monstruo == 3:
        if probcap == 1 or probcap == 2 or probcap == 3:
            return True
        else:
            return False    
    elif nivel_monstruo == 4:
            if probcap == 1 or probcap == 2:
                return True
            else:
                return False  
    elif nivel_monstruo == 5:
        if probcap == 1:
            return True
        else:
            return False  

def probabilidad_objeto(objeto):  #funcion para crear un sistema de probabilidad para capturar al monstruo
    prob_objeto = random.randint(1,4)
    if objeto == 3:
        if prob_objeto == 1 or prob_objeto == 2 or prob_objeto == 3:
            return True
        else:
            return False
    elif objeto == 2:
        if prob_objeto == 1 or prob_objeto == 2 or prob_objeto:
            return True
        else:
            return False
    elif objeto == 1:
        if prob_objeto == 1 or prob_objeto:
            return True
        else:
            return False    

print("¡Bienvenido a la caza de monstruos de Halloween!")
while intentos != 0: #Bucle while para que se repita mientras haya intentos

    bicho2=random.randint(1,5)   #numero random de 1 a 5 para seleccionar un monstruo random

    dificultad=random.randint(1,5)  #numero random de 1 a 5 para seleccionar una dificultad

    dificultad_objeto=random.randint(1,3)

    while intentos != 0: #Bucle while para que se repita con el mismo monstruo y dificultad
        print("\n")
        print(f"Tienes {intentos} intentos restantes")
        print((f"te has encontrado con {monstruos[bicho2]} con un nivel de diciultad {dificultad}"))
        print(f"Elige un objeto para intentar capturar al {monstruos[bicho2]}: {objetos_sin_comillas}")
        opcion_objeto=input("Escribe el nombre del objeto: ")
        print(f'has seleccionado un {opcion_objeto} con un nivel de fuerza {dificultad_objeto}')
        resultado_captura = probabilidad(dificultad)
        resultado_objeto=probabilidad_objeto(dificultad_objeto)
        if opcion_objeto in objetos:
            if resultado_captura == True and resultado_objeto == True:
                print(f"¡Has capturado al {monstruos[bicho2]} con un/a {opcion_objeto}!")
                intentos = 0
                switch = True
            else:
                print(f"Fallaste al intentar capturar al {monstruos[bicho2]} con un/a {opcion_objeto}.")
                if resultado_captura == False:
                    print(' el monstruo era demasiado fuerte ')
                    intentos -= 1

                elif resultado_objeto == False:
                    print('el objeto que seleccionaste no ha sido lo suficientemente poderoso')
                    intentos -= 1
                elif resultado_objeto == False and resultado_captura == False:
                    print('No has dado ni una jefe')
                    intentos -= 1
                
        else:
            print("No tenemos ese objeto señor")
    
if switch == True:
    print("¡Has gando eres el mejor!")
elif switch == False:
    print(f"Has perdido el {monstruos[bicho2]} de nivel {dificultad} se ha escapado!")