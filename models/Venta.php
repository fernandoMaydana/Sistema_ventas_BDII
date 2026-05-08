<?php
class Venta {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarVenta($id_cliente, $id_empleado, $id_sucursal, $total_pagado, $detalles) {
        try {
            $this->conn->beginTransaction();

            // 1. Generar número de factura (básico para este ejemplo)
            $nro_factura = "FAC-" . time() . rand(10, 99);

            // 2. Insertar la cabecera de la Venta. Usamos RETURNING id_venta (PostgreSQL) para obtener el ID insertado
            $query_venta = "INSERT INTO venta (nro_factura, total_pagado, id_cliente, id_empleado, id_sucursal) 
                            VALUES (:nro_factura, :total_pagado, :id_cliente, :id_empleado, :id_sucursal) RETURNING id_venta";
            $stmt_venta = $this->conn->prepare($query_venta);
            $stmt_venta->bindParam(":nro_factura", $nro_factura);
            $stmt_venta->bindParam(":total_pagado", $total_pagado);
            $stmt_venta->bindParam(":id_cliente", $id_cliente);
            $stmt_venta->bindParam(":id_empleado", $id_empleado);
            $stmt_venta->bindParam(":id_sucursal", $id_sucursal);
            $stmt_venta->execute();
            
            $result = $stmt_venta->fetch(PDO::FETCH_ASSOC);
            $id_venta = $result['id_venta'];

            // Preparar consultas para el ciclo
            $query_detalle = "INSERT INTO detalle_venta (cantidad, precio_unitario_historico, subtotal, id_venta, id_producto) 
                              VALUES (:cantidad, :precio, :subtotal, :id_venta, :id_producto)";
            $stmt_detalle = $this->conn->prepare($query_detalle);

            $query_stock = "UPDATE producto SET stock_referencial = stock_referencial - :cantidad WHERE id_producto = :id_producto";
            $stmt_stock = $this->conn->prepare($query_stock);

            // 3. Iterar sobre los productos y registrar detalles + actualizar stock
            foreach ($detalles as $detalle) {
                // Insertar Detalle
                $stmt_detalle->bindParam(":cantidad", $detalle['cantidad']);
                $stmt_detalle->bindParam(":precio", $detalle['precio']);
                $stmt_detalle->bindParam(":subtotal", $detalle['subtotal']);
                $stmt_detalle->bindParam(":id_venta", $id_venta);
                $stmt_detalle->bindParam(":id_producto", $detalle['id_producto']);
                $stmt_detalle->execute();

                // Descontar Stock
                $stmt_stock->bindParam(":cantidad", $detalle['cantidad']);
                $stmt_stock->bindParam(":id_producto", $detalle['id_producto']);
                $stmt_stock->execute();
            }

            // Confirmar transacción
            $this->conn->commit();
            return $id_venta; // Devolver el ID para imprimir factura si es necesario

        } catch (Exception $e) {
            // Si algo falla, revertimos todos los inserts/updates
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            // Puedes usar error_log($e->getMessage()) para debuggear
            return false;
        }
    }
}
?>
