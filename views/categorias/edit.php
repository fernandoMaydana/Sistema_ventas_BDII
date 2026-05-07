<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Editar Categoría</h3>
    </div>
    <div class="card-body">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=categoria&action=edit&id=<?php echo htmlspecialchars($this->categoria->id_categoria); ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($this->categoria->nombre); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required><?php echo htmlspecialchars($this->categoria->descripcion); ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=categoria&action=index" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
