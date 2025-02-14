'''
Ejercicio 3: Escribir Múltiples Líneas en un Archivo
Enunciado: Escribe un programa que cree un archivo de texto llamado notas.txt. El programa debe solicitar al usuario ingresar tres notas (como texto) y escribir cada una en una nueva línea del archivo. Luego, cierra el archivo.
'''

def escribirarchivo():
    archivo = open("notas.txt","w")
    archivo.close()

def pedirlasnotas():
    archivo = open("notas.txt","r+")
    nota1 = input("que nota quiere meter:\n ")
    archivo.write(f"{nota1}\n")
    nota2 = input(f"que nota quiere meter:\n ")
    archivo.write(f"{nota2}\n")
    nota3 = input(f"que nota quiere meter:\n ")
    archivo.write(f"{nota3}\n")
    archivo.close()

def main():
    escribirarchivo()
    pedirlasnotas()

main()