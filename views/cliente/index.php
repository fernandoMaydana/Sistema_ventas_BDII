<div class="card shadow">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Gestión de Clientes</h2>
        <a href="index.php?controller=cliente&action=create" class="btn btn-dark btn-sm">Nuevo Cliente</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre / Razón Social</th>
                    <th>NIT/CI</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $cliente->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_razon_social']); ?></td>
                        <td><?php echo htmlspecialchars($row['nit_ci']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <a href="index.php?controller=cliente&action=edit&id=<?php echo $row['id_cliente']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                            <a href="index.php?controller=cliente&action=delete&id=<?php echo $row['id_cliente']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>