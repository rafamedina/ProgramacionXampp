import random  # Importamos la librería random para generar números aleatorios

# Creamos un diccionario para registrar los clientes con su DNI y nombre
listaregistro = {
    "12345678A": "Juan",
    "87654321B": "Ana",
    "11223344C": "Luis",
    "33445566D": "María",
    "99887766E": "Carlos"
}
carritocompra = []  # Lista para guardar los productos que el cliente quiere comprar
seguimientocompra = {}  # Diccionario para seguir los pedidos realizados
listadeproductos = [  # Lista de productos disponibles en la tienda con su precio
    {"nombre": "manzana", "precio": 25},
    {"nombre": "pera", "precio": 20},
    {"nombre": "jamon", "precio": 300},
    {"nombre": "cochino", "precio": 250},
    {"nombre": "mermelada", "precio": 15},
    {"nombre": "montadito del solarino", "precio": 2},
    {"nombre": "panini", "precio": 3},
    {"nombre": "leche", "precio": 2},
    {"nombre": "juguete", "precio": 45.00},
    {"nombre": "movil", "precio": 800}
]
productos = []

# Función para registrar o iniciar sesión de un cliente
def registro(lista):
    while True:
        idcliente = input('Ingrese su DNI para el inicio de sesión o registro: ')
        if idcliente in lista:  # Si el DNI ya está registrado
            print(f"Bienvenido de nuevo, {lista[idcliente]}!")
            return idcliente
        else:  # Si el DNI no está registrado
            print('Número no registrado, procedemos con el registro.')
            nombrecliente = input('Introduce tu nombre: ')
            lista[idcliente] = nombrecliente  # Registramos al nuevo cliente
            print(f"Cliente registrado con éxito: {nombrecliente}")
            return idcliente

# Función para mostrar todos los clientes registrados
def visualizarclientes(lista):
    if lista:  # Si hay clientes registrados
        print("Lista de clientes registrados:")
        for dni, nombre in lista.items():
            print(f"DNI: {dni}, Nombre: {nombre}")
    else:
        print("No hay clientes registrados.")

# Función para buscar un cliente por su DNI
def buscarclientes(lista):    
    while True:
        busqueda = input('¿Qué DNI quiere buscar? Ingrese "fin" para salir de la búsqueda: ')
        if busqueda.lower() == 'fin':  # Si el usuario quiere salir
            print("Saliendo de la búsqueda.")
            break
        elif busqueda in lista:  # Si el DNI está en la lista
            print(f'Cliente encontrado: {lista[busqueda]}')
        else:
            print('DNI no encontrado en la lista de clientes.')

# Función para mostrar los productos disponibles
def mostrarproductos():
    print("\nProductos disponibles:")
    for item in listadeproductos:
        print(f"{item['nombre']} - Precio: {item['precio']}€")

# Función para añadir productos al carrito de compras
def añadirproductoacarrito():
    mostrarproductos()  # Mostramos los productos
    while True:
        añadiracarro = input('Selecciona qué quieres añadir al carrito (escribe "fin" para salir): ')
        if añadiracarro.lower() == 'fin':  # Si el usuario quiere salir
            print("Saliendo de la compra.")
            break
        for item in listadeproductos:  # Buscamos el producto en la lista
            if item['nombre'].lower() == añadiracarro.lower():
                carritocompra.append(item)  # Añadimos el producto al carrito
                print(f"{item['nombre']} ha sido añadido al carrito.")
                break
        else:
            print(f"Producto '{añadiracarro}' no encontrado. Inténtalo nuevamente.")

# Función para mostrar el contenido del carrito
def mostrarcarrito():
    if not carritocompra:  # Si el carrito está vacío
        print("El carrito está vacío.")
    else:
        print("\nContenido del carrito:")
        total = sum(item['precio'] for item in carritocompra)  # Calculamos el total
        for item in carritocompra:
            print(f"{item['nombre']} - Precio: {item['precio']}€")
        print(f"Total de la compra: {total}€")

# Función para realizar la compra
def realizar_compra(dni_cliente):
    # Comprobar si el carrito está vacío
    if len(carritocompra) == 0:
        print("El carrito está vacío. No se puede realizar la compra.")
        return
    
    # Generar un número aleatorio de pedido
    numero_pedido = random.randint(1000, 9999)
    
    # Calcular el total de productos
    total = 0
    for item in carritocompra:
        productos.append(item['nombre'])
        total = total + item['precio']
    
    # Guardar la información del pedido en el seguimiento de compras
    seguimientocompra[numero_pedido] = {
        "cliente_dni": dni_cliente,
        "productos": productos,
        "total": total
    }
    
    # Mostrar mensaje de éxito y limpiar el carrito
    print(f"Pedido realizado con éxito. Número de pedido: {numero_pedido}")
    carritocompra.clear()

def seguimiento_pedido():
    try:
        # Solicitar el número de pedido al usuario
        numero_pedido = int(input("Ingrese el número de pedido para realizar el seguimiento: "))
        
        # Verificar si el número de pedido existe en el seguimiento
        if numero_pedido in seguimientocompra:
            # Obtener detalles del pedido
            pedido = seguimientocompra[numero_pedido]
            dni_cliente = pedido["cliente_dni"]
            nombre_cliente = listaregistro[dni_cliente]
            
            # Mostrar la información del pedido
            print(f"\nDetalles del Pedido #{numero_pedido}:")
            print(f"Cliente: {nombre_cliente}, DNI: {dni_cliente}")
            print("Productos comprados:")
            for producto in pedido["productos"]:
                print(f"- {producto}")
            print(f"Total: {pedido['total']}€")
        else:
            print("Pedido no encontrado.")
    except ValueError:
        print("Número de pedido no válido.")


# Función principal para ejecutar el programa
def menu():
    dni_cliente_actual = 0

    # Requerir inicio de sesión o registro antes de acceder al menú
    while dni_cliente_actual == 0:
        dni_cliente_actual = registro(listaregistro)

    # Mostrar el menú solo si se ha registrado o iniciado sesión
    while True:
        print("\n--- Menú de la tienda ---\n1. Lista clientes registrados\n2. Buscar cliente por DNI\n3. Ver productos disponibles\n4. Añadir producto al carrito\n5. Ver carrito de compras\n6. Realizar compra\n7. Seguimiento de pedido\n8. Salir")
        opcion = input("Seleccione una opción: ")
        if opcion == '1':
            visualizarclientes(listaregistro)
        elif opcion == '2':
            buscarclientes(listaregistro)
        elif opcion == '3':
            mostrarproductos()
        elif opcion == '4':
            añadirproductoacarrito()
        elif opcion == '5':
            mostrarcarrito()
        elif opcion == '6':
            realizar_compra(dni_cliente_actual)
        elif opcion == '7':
            seguimiento_pedido()
        elif opcion == '8':
            print("Saliendo de la aplicación.")
            break
        else:
            print("Opción no válida. Intente nuevamente.")
# Ejecutamos el programa
menu()  