<?php
require_once 'models/Categoria.php';

class CategoriaController {
    private $db;
    private $categoria;

    public function __construct($db) {
        $this->db = $db;
        $this->categoria = new Categoria($db);
    }

    public function index() {
        $categorias = $this->categoria->listar();
        
        ob_start();
        require_once 'views/categorias/index.php';
        $content = ob_get_clean();
        
        require_once 'views/layouts/main.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->categoria->nombre = $_POST['nombre'];
            $this->categoria->descripcion = $_POST['descripcion'];

            if ($this->categoria->crear()) {
                header("Location: index.php?controller=categoria&action=index");
                exit();
            } else {
                $error = "Error al crear la categoría.";
            }
        }
        
        ob_start();
        require_once 'views/categorias/create.php';
        $content = ob_get_clean();
        
        require_once 'views/layouts/main.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=categoria&action=index");
            exit();
        }

        $this->categoria->id_categoria = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->categoria->nombre = $_POST['nombre'];
            $this->categoria->descripcion = $_POST['descripcion'];

            if ($this->categoria->actualizar()) {
                header("Location: index.php?controller=categoria&action=index");
                exit();
            } else {
                $error = "Error al actualizar la categoría.";
            }
        } else {
            // Cargar datos actuales
            $this->categoria->obtenerPorId();
        }

        ob_start();
        require_once 'views/categorias/edit.php';
        $content = ob_get_clean();
        
        require_once 'views/layouts/main.php';
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->categoria->id_categoria = $_GET['id'];
            $this->categoria->eliminar();
        }
        header("Location: index.php?controller=categoria&action=index");
        exit();
    }
}
?>
