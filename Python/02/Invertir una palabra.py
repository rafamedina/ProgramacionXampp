texto = " "
palabra_invertida=" "
texto = input("escribe la palabra para invertir ")
for i in range(len(texto) - 1, - 1, - 1):
    palabra_invertida += texto[i]

    print(f"la palbra invertida es: {palabra_invertida}")