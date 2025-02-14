calificaiones = {}

while True:
    asignatura = input("Ingresa el nombre de la asignatura: (o 'fin' para terminar)")
    if asignatura.lower()=="fin":
        break

    calificaion = float(input(f"Ingresa la calificación de {asignatura}"))

    calificaiones[asignatura] = calificaion

    print("\nResumen de calificaciones: ")
for asignatura, calificaion in calificaiones.items():
    print(f"-{asignatura}: {calificaion}")

if calificaiones:
    media = sum(calificaiones.values()) / len(calificaiones)

    print(f"\nCalificaion media: {media}")
else:
    print("No hay calificaciones")