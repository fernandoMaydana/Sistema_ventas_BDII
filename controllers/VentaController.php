<?php
require_once "models/Venta.php";
require_once "models/Cliente.php";
require_once "models/Producto.php";

class VentaController {
    private $db;
    private $venta;

    public function __construct($db) {
        $this->db = $db;
        $this->venta = new Venta($db);
    }

    public function create() {
        // Procesar Venta
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_cliente = $_POST['id_cliente'];
            $cart_data_json = $_POST['cart_data'];
            
            $detalles = json_decode($cart_data_json, true);
            
            if (!$id_cliente || empty($detalles)) {
                $error = "Error: Faltan datos para la venta. Seleccione un cliente y agregue productos.";
            } else {
                // Calcular total_pagado por seguridad
                $total_pagado = 0;
                foreach($detalles as $det) {
                    $total_pagado += $det['subtotal'];
                }

                // Parámetros fijos por ahora (El cajero y sucursal que creamos en el script SQL)
                $id_empleado = 1; 
                $id_sucursal = 1;

                $id_venta = $this->venta->registrarVenta($id_cliente, $id_empleado, $id_sucursal, $total_pagado, $detalles);

                if ($id_venta) {
                    // Éxito, redirigir con flag de success
                    header("Location: index.php?controller=venta&action=create&success=1");
                    exit();
                } else {
                    $error = "Error al procesar la venta. Verifica que haya stock suficiente.";
                }
            }
        }

        // Cargar listas para la interfaz
        $clienteModel = new Cliente($this->db);
        $clientes = $clienteModel->listar();

        $productoModel = new Producto($this->db);
        $productos = $productoModel->listar();

        ob_start();
        require_once 'views/ventas/create.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';
    }
}
?>
