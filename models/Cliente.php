<?php

class Cliente {
    private $conn;
    private $table_name = "cliente";

    public $id_cliente;
    public $nombre_razon_social;
    public $nit_ci;
    public $telefono;
    public $email;
    
    public function __construct($db){
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_cliente ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre_razon_social, nit_ci, telefono, email) VALUES (:nombre_razon_social, :nit_ci, :telefono, :email)";
        $stmt = $this->conn->prepare($query);

        $this->nombre_razon_social = htmlspecialchars(strip_tags($this->nombre_razon_social));
        $this->nit_ci = htmlspecialchars(strip_tags($this->nit_ci));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":nombre_razon_social", $this->nombre_razon_social);
        $stmt->bindParam(":nit_ci", $this->nit_ci);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerPorId() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_cliente = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_cliente);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nombre_razon_social = $row['nombre_razon_social'];
            $this->nit_ci = $row['nit_ci'];
            $this->telefono = $row['telefono'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre_razon_social = :nombre_razon_social, nit_ci = :nit_ci, telefono = :telefono, email = :email WHERE id_cliente = :id_cliente";
        $stmt = $this->conn->prepare($query);

        $this->nombre_razon_social = htmlspecialchars(strip_tags($this->nombre_razon_social));
        $this->nit_ci = htmlspecialchars(strip_tags($this->nit_ci));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));

        $stmt->bindParam(':nombre_razon_social', $this->nombre_razon_social);
        $stmt->bindParam(':nit_ci', $this->nit_ci);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_cliente', $this->id_cliente);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $stmt->bindParam(1, $this->id_cliente);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}

?>