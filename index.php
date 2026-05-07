<?php
require_once 'config/database.php';
require_once 'controllers/CategoriaController.php';
require_once 'controllers/ProductoController.php';

// Inicializar conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Obtener el controlador y la acción de la URL (por defecto: categoria e index)
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'categoria';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Enrutador básico
if ($controller == 'categoria') {
    $categoriaController = new CategoriaController($db);
    
    if ($action == 'index') {
        $categoriaController->index();
    } elseif ($action == 'create') {
        $categoriaController->create();
    } elseif ($action == 'edit') {
        $categoriaController->edit();
    } elseif ($action == 'delete') {
        $categoriaController->delete();
    } else {
        echo "Acción no encontrada.";
    }
} elseif ($controller == 'producto') {
    $productoController = new ProductoController($db);

    if ($action == 'index') {
        $productoController->index();
    } elseif ($action == 'create') {
        $productoController->create();
    } elseif ($action == 'edit') {
        $productoController->edit();
    } elseif ($action == 'delete') {
        $productoController->delete();
    } else {
        echo "Acción no encontrada.";
    }
} else {
    echo "Controlador no encontrado.";
}
?>