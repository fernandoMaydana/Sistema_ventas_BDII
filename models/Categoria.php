<?php
class Categoria {
    private $conn;
    private $table_name = "categoria";

    public $id_categoria;
    public $nombre;
    public $descripcion;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_categoria ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerPorId() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_categoria = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_categoria);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            return true;
        }
        return false;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, descripcion = :descripcion WHERE id_categoria = :id_categoria";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id_categoria', $this->id_categoria);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_categoria = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));
        $stmt->bindParam(1, $this->id_categoria);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>