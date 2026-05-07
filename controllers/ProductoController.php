<?php
require_once 'models/Producto.php';
require_once 'models/Categoria.php';

class ProductoController {
    private $db;
    private $producto;
    private $categoria;

    public function __construct($db) {
        $this->db = $db;
        $this->producto = new Producto($db);
        $this->categoria = new Categoria($db);
    }

    public function index() {
        $productos = $this->producto->listar();

        ob_start();
        require_once 'views/productos/index.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';
    }

    public function create() {
        $categorias = $this->categoria->listar();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->producto->codigo_barra      = $_POST['codigo_barra'];
            $this->producto->nombre            = $_POST['nombre'];
            $this->producto->precio_venta_actual = $_POST['precio_venta_actual'];
            $this->producto->stock_referencial = $_POST['stock_referencial'];
            $this->producto->id_categoria      = $_POST['id_categoria'];

            if ($this->producto->crear()) {
                header("Location: index.php?controller=producto&action=index");
                exit();
            } else {
                $error = "Error al crear el producto.";
            }
        }

        ob_start();
        require_once 'views/productos/create.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=producto&action=index");
            exit();
        }

        $this->producto->id_producto = $_GET['id'];
        $categorias = $this->categoria->listar();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->producto->codigo_barra       = $_POST['codigo_barra'];
            $this->producto->nombre             = $_POST['nombre'];
            $this->producto->precio_venta_actual = $_POST['precio_venta_actual'];
            $this->producto->stock_referencial  = $_POST['stock_referencial'];
            $this->producto->id_categoria       = $_POST['id_categoria'];

            if ($this->producto->actualizar()) {
                header("Location: index.php?controller=producto&action=index");
                exit();
            } else {
                $error = "Error al actualizar el producto.";
            }
        } else {
            $this->producto->obtenerPorId();
        }

        ob_start();
        require_once 'views/productos/edit.php';
        $content = ob_get_clean();

        require_once 'views/layouts/main.php';
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->producto->id_producto = $_GET['id'];
            $this->producto->eliminar();
        }
        header("Location: index.php?controller=producto&action=index");
        exit();
    }
}
?>
