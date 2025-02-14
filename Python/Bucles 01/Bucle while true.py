
palabra= " "
palabra_secreta = "python"
swicth = True

while True:
    palabra = (input("introduce una palabra "))
    if palabra != palabra_secreta:
        print(f"error vuelve a interntarlo")
    else: 
        print(f"felicidades acertaste")
        break
