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
    "poción mágica",
    "hechizo",
    "espada",
    "escudo",
    "armadura",
    "anillo mágico",
]
switch = True    #Booleano para el resultado final
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

print("¡Bienvenido a la caza de monstruos de Halloween!")
while intentos != 0: #Bucle while para que se repita mientras haya intentos

    bicho2=random.randint(1,5)   #numero random de 1 a 5 para seleccionar un monstruo random

    dificultad=random.randint(1,5)  #numero random de 1 a 5 para seleccionar una dificultad


    while intentos != 0: #Bucle while para que se repita con el mismo monstruo y dificultad
        print("\n")
        print(f"Tienes {intentos} intentos restantes")
        print((f"te has encontrado con {monstruos[bicho2]} con un nivel de diciultad {dificultad}"))
        print(f"Elige un objeto para intentar capturar al {monstruos[bicho2]}: {objetos_sin_comillas}")
        opcion_objeto=input("Escribe el nombre del objeto: ")
        resultado_captura = probabilidad(dificultad)
        if opcion_objeto in objetos:
            if resultado_captura == True:
                print(f"¡Has capturado al {monstruos[bicho2]} con un/a {opcion_objeto}!")
                intentos = 0
                switch = True
            elif resultado_captura == False:
                switch = False
                intentos -= 1
                print(f"Fallaste al intentar capturar al {monstruos[bicho2]} con un/a {opcion_objeto}.")
        else:
            print("No tenemos ese objeto señor")
    
if switch == True:
    print("¡Has gando eres el mejor!")
elif switch == False:
    print(f"Has perdido el {monstruos[bicho2]} de nivel {dificultad} se ha escapado!")