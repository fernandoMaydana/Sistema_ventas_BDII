<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h3 class="mb-0">Nuevo Producto</h3>
    </div>
    <div class="card-body">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=producto&action=create" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: Coca Cola 600ml" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="codigo_barra" class="form-label">Código de Barra</label>
                    <input type="text" name="codigo_barra" id="codigo_barra" class="form-control" placeholder="Ej: 7501234567890" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="precio_venta_actual" class="form-label">Precio de Venta (Bs.)</label>
                    <input type="number" step="0.01" min="0.01" name="precio_venta_actual" id="precio_venta_actual" class="form-control" placeholder="Ej: 5.50" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock_referencial" class="form-label">Stock Referencial</label>
                    <input type="number" min="0" name="stock_referencial" id="stock_referencial" class="form-control" placeholder="Ej: 100" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoría</label>
                    <select name="id_categoria" id="id_categoria" class="form-select" required>
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $cat['id_categoria']; ?>">
                                <?php echo htmlspecialchars($cat['nombre']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=producto&action=index" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>
