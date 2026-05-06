<?php
require_once 'config/database.php';
require_once 'models/Categoria.php';

$database = new Database();
$db = $database->getConnection();
$categoria = new Categoria($db);
$stmt = $categoria->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SISTEM VENTA - Kwik-E-Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h2>Gestión Kwik-E-Mart</h2>
            </div>
            <div class="card-body">
                <h4>Listado de Categorías</h4>
                <table class="table table-striped">
                    <thead>
                        <tr><th>ID</th><th>Nombre</th><th>Descripción</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo $row['id_categoria']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>