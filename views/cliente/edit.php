<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>Editar Cliente</h2>
        <a href="index.php?controller=cliente&action=index" class="btn btn-secondary">Volver</a>
    </div>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-body">
        <form action="index.php?controller=cliente&action=edit&id=<?php echo htmlspecialchars($this->clientes->id_cliente); ?>" method="POST">
            <div class="mb-3">
                <label for="nombre_razon_social" class="form-label">Nombre / Razón Social *</label>
                <input type="text" class="form-control" id="nombre_razon_social" name="nombre_razon_social" value="<?php echo htmlspecialchars($this->clientes->nombre_razon_social); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="nit_ci" class="form-label">NIT / CI *</label>
                <input type="text" class="form-control" id="nit_ci" name="nit_ci" value="<?php echo htmlspecialchars($this->clientes->nit_ci); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($this->clientes->telefono); ?>">
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($this->clientes->email); ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        </form>
    </div>
</div>
