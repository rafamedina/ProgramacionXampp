'''
Ejercicio 5: Añadir Texto a un Archivo Existente
Enunciado: Crea un archivo llamado diario.txt y escribe en él una breve entrada de diario (puedes hacerlo de forma manual). Luego, escribe un programa que pida al usuario que ingrese otra entrada de diario, abra diario.txt en modo de añadido (append), agregue la nueva entrada y luego cierre el archivo. Al finalizar, muestra el contenido completo del archivo en pantalla.
'''

def escribirarchivo():
    archivo = open("diario.txt","r+")
    archivo.close()

def appendenarchivo():
    with open("diario.txt", 'a') as archivo:
        archivo.write('\nDia2 hoy tampoco he hecho nada')
        archivo.close()
def main():
    appendenarchivo()

main()