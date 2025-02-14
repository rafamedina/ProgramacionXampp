'''
Ejercicio 1: Crear y Escribir en un Archivo de Texto
Enunciado: Escribe un programa que cree un archivo de texto llamado saludo.txt y escriba en él la frase "¡Hola, bienvenidos al curso de Python!". Luego, cierra el archivo.
'''

def escribirenarchivo():
        archivo=open("saludo.txt","w")
        archivo.write("¡Hola, bienvenidos al curso de Python!")
        archivo.close()
def leeracrchivo():
    archivo=open("saludo.txt","r")
    contenido=archivo.read()
    print(contenido)
    archivo.close()
def main():
    escribirenarchivo()
    leeracrchivo()

main()

    


