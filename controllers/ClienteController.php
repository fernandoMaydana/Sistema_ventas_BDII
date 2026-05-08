<?php
require_once "models/Cliente.php";

class ClienteController {
    private $db;
    private $clientes;

    public function __construct($db) {
        $this ->db=$db;
        $this->clientes = new Cliente($db);
    }

    public function index() {
        $cliente = $this->clientes->listar();

        ob_start();
        require_once 'views/cliente/index.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';      
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->clientes->nombre_razon_social = $_POST['nombre_razon_social'];
            $this->clientes->nit_ci = $_POST['nit_ci'];
            $this->clientes->telefono = $_POST['telefono'];
            $this->clientes->email = $_POST['email'];

            if ($this->clientes->crear()) {
                header("Location: index.php?controller=cliente&action=index");
                exit();
            } else {
                $error = "Error al crear el cliente.";
            }
        }

        ob_start();
        require_once 'views/cliente/create.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=cliente&action=index");
            exit();
        }

        $this->clientes->id_cliente = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->clientes->nombre_razon_social = $_POST['nombre_razon_social'];
            $this->clientes->nit_ci = $_POST['nit_ci'];
            $this->clientes->telefono = $_POST['telefono'];
            $this->clientes->email = $_POST['email'];

            if ($this->clientes->actualizar()) {
                header("Location: index.php?controller=cliente&action=index");
                exit();
            } else {
                $error = "Error al actualizar el cliente.";
            }
        } else {
            $this->clientes->obtenerPorId();
        }

        ob_start();
        require_once 'views/cliente/edit.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->clientes->id_cliente = $_GET['id'];
            $this->clientes->eliminar();
        }
        header("Location: index.php?controller=cliente&action=index");
        exit();
    }
}


?>