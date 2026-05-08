<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/CategoriaController.php';
require_once 'controllers/ProductoController.php';
require_once 'controllers/ClienteController.php';
require_once 'controllers/VentaController.php';
require_once 'controllers/AuthController.php';

// Inicializar conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Obtener el controlador y la acción de la URL (por defecto: categoria e index)
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'categoria';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Filtro de Seguridad: Si no hay sesión y no intenta hacer login, mandarlo al login
if (!isset($_SESSION['user']) && $controller !== 'auth') {
    $controller = 'auth';
    $action = 'login';
}

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
} elseif ($controller == 'cliente') {
    $clienteController = new ClienteController($db);

    if ($action == 'index') {
        $clienteController->index();
    } elseif ($action == 'create') {
        $clienteController->create();
    } elseif ($action == 'edit') {
        $clienteController->edit();
    } elseif ($action == 'delete') {
        $clienteController->delete();
    } else {
        echo "Acción no encontrada.";
    }
} elseif ($controller == 'venta') {
    $ventaController = new VentaController($db);

    if ($action == 'create') {
        $ventaController->create();
    } else {
        echo "Acción no encontrada.";
    }
} elseif ($controller == 'auth') {
    $authController = new AuthController();
    
    if ($action == 'login') {
        $authController->login();
    } elseif ($action == 'logout') {
        $authController->logout();
    } else {
        echo "Acción no encontrada.";
    }
} else {
    echo "Controlador no encontrado.";
}
?>