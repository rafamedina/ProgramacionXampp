'''
Ejercicio 2: Leer el Contenido de un Archivo de Texto
Enunciado: Crea un archivo de texto llamado frase.txt y escribe en él una frase de tu elección (puedes hacerlo de forma manual). Luego, escribe un programa que abra y lea el contenido de frase.txt y lo muestre en pantalla.
'''

def escribirenarchivo():
        archivo=open("frase.txt","w")
        archivo.write("¡Hola, bienvenidos al curso de Python!")
        archivo.close()
def leeracrchivo():
    archivo=open("frase.txt","r")
    contenido=archivo.read()
    print(contenido)
    archivo.close()
def main():
    escribirenarchivo()
    leeracrchivo()

main()
