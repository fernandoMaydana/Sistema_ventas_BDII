<div class="card shadow">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Catálogo de Productos</h2>
        <a href="index.php?controller=producto&action=create" class="btn btn-dark btn-sm">+ Nuevo Producto</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Código Barra</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio (Bs.)</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $productos->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_producto']); ?></td>
                            <td><code><?php echo htmlspecialchars($row['codigo_barra']); ?></code></td>
                            <td><?php echo htmlspecialchars($row['producto']); ?></td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($row['categoria_nombre']); ?></span></td>
                            <td><?php echo number_format($row['precio'], 2); ?></td>
                            <td>
                                <?php
                                    $stock = (int)$row['stock'];
                                    $badge = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
                                ?>
                                <span class="badge <?php echo $badge; ?>"><?php echo $stock; ?></span>
                            </td>
                            <td>
                                <a href="index.php?controller=producto&action=edit&id=<?php echo $row['id_producto']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <a href="index.php?controller=producto&action=delete&id=<?php echo $row['id_producto']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
