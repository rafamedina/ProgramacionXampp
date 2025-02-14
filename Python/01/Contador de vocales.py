#creamos la variable texto y un contador
#pedimos el texto que desea contar el cliente y hacemos un bucle para para que itere entre el texto contando vocales


texto = " "
contador = 0

texto = input("dame una cadena de texto: ").lower()

for caracter in texto:
    if caracter == "a" or caracter == "e" or caracter == "i" or caracter == "o" or caracter == "u":
        contador = contador + 1
print(f"La cadena tiene {contador} vocales")