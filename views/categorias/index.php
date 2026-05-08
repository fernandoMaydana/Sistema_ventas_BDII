<div class="card shadow">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Gestión de Categorías</h2>
        <a href="index.php?controller=categoria&action=create" class="btn btn-dark btn-sm">Nueva Categoría</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $categorias->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_categoria']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                        <td>
                            <!-- Acciones para futuros CRUD -->
                            <a href="index.php?controller=categoria&action=edit&id=<?php echo $row['id_categoria']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                            <a href="index.php?controller=categoria&action=delete&id=<?php echo $row['id_categoria']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
