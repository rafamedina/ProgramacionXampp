<?php
/*
Crea una clase Carrito con la propiedad productos (un array de productos).
Agrega los métodos:
agregarProducto($nombre, $precio, $cantidad): Añade un producto al carrito.
quitarProducto($nombre): Elimina un producto del carrito por su nombre.
calcularTotal(): Devuelve el precio total de los productos en el carrito.
mostrarDetalleCarrito(): Imprime los detalles de todos los productos con sus precios y cantidades.
Simula agregar y quitar productos y muestra el total.
*/
class Carrito
{
    public $productos = [];

    public function agregarProducto($nombre, $precio, $cantidad)
    {
        if (empty($nombre) || $precio <= 0 || $cantidad <= 0) {
            throw new Exception("Datos inválidos para el producto.\n");
        }

        $this->productos[] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad
        ];
    }
    public function quitarProducto($nombre)
    {
        // Buscar el índice del producto en el array
        foreach ($this->productos as $indice => $producto) {
            if ($producto['nombre'] === $nombre) {
                // Eliminar el producto del array
                unset($this->productos[$indice]);
                // Reindexar el array
                $this->productos = array_values($this->productos);
                return;
            }
        }
        // Si no se encuentra el producto, lanzar excepción
        throw new Exception("Producto no encontrado: $nombre \n");
    }
    public function calcularTotal()
    {
        $total = 0;

        foreach ($this->productos as $producto) {
            // Calcular el subtotal multiplicando el precio por la cantidad
            $subtotal = $producto['precio'] * $producto['cantidad'];
            // Sumar el subtotal al total general
            $total += $subtotal;
        }

        echo "el total es de: " . $total . "€\n";
    }
    public function mostrarDetalleCarrito() {
        if (empty($this->productos)) {
            echo "El carrito está vacío.\n";
            return;
        }
    
        echo "Detalles del carrito:\n";
        echo "---------------------\n";
    
        foreach ($this->productos as $producto) {
            $nombre = $producto['nombre'];
            $precio = $producto['precio'];
            $cantidad = $producto['cantidad'];
            $subtotal = $precio * $cantidad;
    
            echo "Producto: $nombre\n";
            echo "Precio unitario: $$precio\n";
            echo "Cantidad: $cantidad\n";
            echo "Subtotal: $$subtotal\n";
            echo "---------------------\n";
        }
    
        $total = $this->calcularTotal();
        echo "Total general: $$total\n";
    }    
}
