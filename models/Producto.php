<?php
class Producto {
    private $conn;
    private $table_name = "producto";
    private $view_name = "vista_productos_detallados";

    public $id_producto;
    public $codigo_barra;
    public $nombre;
    public $precio_venta_actual;
    public $stock_referencial;
    public $id_categoria;
    public $categoria_nombre;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        // Hacemos el SELECT a la VISTA, no a la tabla
        $query = "SELECT * FROM " . $this->view_name . " ORDER BY id_producto ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (codigo_barra, nombre, precio_venta_actual, stock_referencial, id_categoria) 
                  VALUES (:codigo_barra, :nombre, :precio_venta_actual, :stock_referencial, :id_categoria)";
        $stmt = $this->conn->prepare($query);

        $this->codigo_barra = htmlspecialchars(strip_tags($this->codigo_barra));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->precio_venta_actual = htmlspecialchars(strip_tags($this->precio_venta_actual));
        $this->stock_referencial = htmlspecialchars(strip_tags($this->stock_referencial));
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));

        $stmt->bindParam(":codigo_barra", $this->codigo_barra);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":precio_venta_actual", $this->precio_venta_actual);
        $stmt->bindParam(":stock_referencial", $this->stock_referencial);
        $stmt->bindParam(":id_categoria", $this->id_categoria);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerPorId() {
        // Aquí también usamos la vista para tener el nombre de la categoría si hiciera falta
        $query = "SELECT * FROM " . $this->view_name . " WHERE id_producto = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_producto);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->codigo_barra = $row['codigo_barra'];
            $this->nombre = $row['producto']; // La vista devuelve 'producto'
            $this->precio_venta_actual = $row['precio']; // La vista devuelve 'precio'
            $this->stock_referencial = $row['stock']; // La vista devuelve 'stock'
            $this->id_categoria = $row['id_categoria'];
            $this->categoria_nombre = $row['categoria_nombre'];
            return true;
        }
        return false;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET codigo_barra = :codigo_barra, nombre = :nombre, precio_venta_actual = :precio_venta_actual, 
                      stock_referencial = :stock_referencial, id_categoria = :id_categoria 
                  WHERE id_producto = :id_producto";
        $stmt = $this->conn->prepare($query);

        $this->codigo_barra = htmlspecialchars(strip_tags($this->codigo_barra));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->precio_venta_actual = htmlspecialchars(strip_tags($this->precio_venta_actual));
        $this->stock_referencial = htmlspecialchars(strip_tags($this->stock_referencial));
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));
        $this->id_producto = htmlspecialchars(strip_tags($this->id_producto));

        $stmt->bindParam(':codigo_barra', $this->codigo_barra);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precio_venta_actual', $this->precio_venta_actual);
        $stmt->bindParam(':stock_referencial', $this->stock_referencial);
        $stmt->bindParam(':id_categoria', $this->id_categoria);
        $stmt->bindParam(':id_producto', $this->id_producto);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_producto = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id_producto = htmlspecialchars(strip_tags($this->id_producto));
        $stmt->bindParam(1, $this->id_producto);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
