'r es modo lectura es solo para leerlo'
'w es modo escritura, si no existe lo crea y si existe lo borra y lo crea'
'a es modo anexar es para añadir sin sobreescribir, si no existe lo crea'
'r+ es modo lectura y escritura leer y escribir pero debe existir previamente'
'archivo=open("mi_archivo.txt","r")'
'contenido=archivo.read()'

##################################################
'''
def ejercicio():
    archivo=open("mi_archivo.txt","r+")
    contenido=archivo.read()
    print(contenido)
    archivo.close()

def main():
    ejercicio()

main()
'''
###################################################
'''
with open ("mi_archivo.txt","r+") as archivo:
    contenido= archivo.read()
    print(contenido)
'''
###################################################

def ejercicioconwith():
    with open ("mi_archivo.txt","r+") as archivo:
        contenido= archivo.read()
        print(contenido)

def ejercicio():
    archivo=open("mi_archivo.txt","r+")
    contenido=archivo.read()
    print(contenido)
    archivo.close()

#def main():



def leerlineasindividuales():
        with open ("mi_archivo.txt","r+") as archivo:
            linea=archivo.readline()
            while linea:
                print(linea.strip())
                print("Voy a leer otra linea")
                linea=archivo.readline()

def leerlineasindividualesyañadirenunalista():
        with open ("mi_archivo.txt","r+") as archivo:
            lineas=archivo.readlines()
            for linea in lineas:
                print(linea.strip())

def escribirenarchivo():
    with open ("mi_archivo.txt","w") as archivo:
        archivo.write("Podemos ecribir varias lineas asi1")


#main()