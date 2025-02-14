'''
Ejercicio 4: Leer un Archivo Línea por Línea
Enunciado: Crea un archivo de texto llamado alumnos.txt con una lista de nombres de alumnos (puedes crear este archivo manualmente con al menos 5 nombres, cada uno en una línea). Escribe un programa que abra el archivo y muestre cada nombre en pantalla, uno por línea.
'''
def listacontodaslaslineas():
    with open('alumnos.txt', 'r') as archivo:
        lineas = archivo.readlines()
        print(lineas)
        for linea in lineas:
            print(linea.strip())

listacontodaslaslineas()
