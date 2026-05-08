<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kwik-E-Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.1);
        }
        .brand-logo {
            font-size: 3.5rem;
            text-align: center;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<div class="card login-card border-0">
    <div class="card-body p-5">
        <div class="brand-logo">🏪</div>
        <h3 class="text-center mb-1 text-dark fw-bold">Kwik-E-Mart</h3>
        <p class="text-center text-muted mb-4">Acceso Seguro al Sistema POS</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center py-2 shadow-sm">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?controller=auth&action=login" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label text-secondary fw-bold small text-uppercase">Usuario</label>
                <input type="text" class="form-control form-control-lg bg-light" id="username" name="username" placeholder="Ingrese 'admin'" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-secondary fw-bold small text-uppercase">Contraseña</label>
                <input type="password" class="form-control form-control-lg bg-light" id="password" name="password" placeholder="Ingrese 'admin123'" required>
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow">
                🔒 Entrar al Sistema
            </button>
        </form>
        
        <div class="text-center mt-4 pt-3 border-top">
            <small class="text-muted">Desarrollado para gestión de BD</small><br>
            <span class="badge bg-secondary mt-1">Usuario: admin | Clave: admin123</span>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
