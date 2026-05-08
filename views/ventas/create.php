<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        <strong>¡Venta Exitosa!</strong> Se ha registrado y procesado correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm">
        <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Columna Izquierda: Productos -->
    <div class="col-md-7">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📦 Catálogo de Productos</h5>
                <span class="badge bg-light text-primary rounded-pill">Haz clic para agregar</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $productos->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td><small class="text-muted"><?php echo htmlspecialchars($row['codigo_barra']); ?></small></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($row['producto']); ?></td>
                                    <td>
                                        <?php if ($row['stock'] > 5): ?>
                                            <span class="badge bg-success"><?php echo htmlspecialchars($row['stock']); ?></span>
                                        <?php elseif ($row['stock'] > 0): ?>
                                            <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($row['stock']); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">0</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-primary fw-bold">$<?php echo number_format($row['precio'], 2); ?></td>
                                    <td class="text-center">
                                        <?php if ($row['stock'] > 0): ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" 
                                                onclick="agregarAlCarrito(
                                                    <?php echo $row['id_producto']; ?>, 
                                                    '<?php echo addslashes($row['producto']); ?>', 
                                                    <?php echo $row['precio']; ?>,
                                                    <?php echo $row['stock']; ?>
                                                )">
                                                + Agregar
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-secondary disabled">Agotado</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Columna Derecha: Carrito -->
    <div class="col-md-5">
        <div class="card shadow border-0" style="border-top: 4px solid #198754 !important;">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-success fw-bold">🛒 Resumen de Venta</h5>
            </div>
            <div class="card-body bg-light">
                <form action="index.php?controller=venta&action=create" method="POST" id="formVenta">
                    <div class="mb-4 bg-white p-3 rounded shadow-sm border">
                        <label for="id_cliente" class="form-label fw-bold text-secondary">Seleccionar Cliente:</label>
                        <select class="form-select border-primary" name="id_cliente" id="id_cliente" required>
                            <option value="">-- Elige un Cliente --</option>
                            <?php while ($cli = $clientes->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $cli['id_cliente']; ?>">
                                    <?php echo htmlspecialchars($cli['nombre_razon_social']) . " (NIT: " . htmlspecialchars($cli['nit_ci']) . ")"; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="table-responsive bg-white rounded shadow-sm border mb-4">
                        <table class="table table-borderless table-sm mb-0" id="tablaCarrito">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <th class="ps-3">Producto</th>
                                    <th class="text-center" style="width: 60px;">Cant.</th>
                                    <th class="text-end">Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- JS llenará esto -->
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">El carrito está vacío</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="bg-white p-3 rounded shadow-sm border mb-4 d-flex justify-content-between align-items-center">
                        <span class="fs-5 fw-bold text-secondary">TOTAL:</span>
                        <span class="fs-3 fw-bold text-success" id="lblTotal">$0.00</span>
                    </div>

                    <!-- Input oculto para enviar el array JSON al backend -->
                    <input type="hidden" name="cart_data" id="cart_data">
                    
                    <button type="submit" class="btn btn-success btn-lg w-100 shadow fw-bold" id="btnCobrar" disabled>
                        💳 Procesar Pago
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let carrito = [];

    function agregarAlCarrito(id, nombre, precio, stockMaximo) {
        // Verificar si ya existe
        let item = carrito.find(p => p.id_producto === id);
        if (item) {
            if (item.cantidad < stockMaximo) {
                item.cantidad++;
                item.subtotal = item.cantidad * precio;
            } else {
                alert("⚠️ No hay suficiente stock disponible de " + nombre);
            }
        } else {
            carrito.push({
                id_producto: id,
                nombre: nombre,
                precio: parseFloat(precio),
                cantidad: 1,
                subtotal: parseFloat(precio)
            });
        }
        renderizarCarrito();
    }

    function removerDelCarrito(id) {
        carrito = carrito.filter(p => p.id_producto !== id);
        renderizarCarrito();
    }

    function cambiarCantidad(id, btn, precio, stockMaximo) {
        let item = carrito.find(p => p.id_producto === id);
        let nuevaCant = parseInt(btn.value);
        if(isNaN(nuevaCant) || nuevaCant <= 0) {
             nuevaCant = 1;
             btn.value = 1;
        }
        if(nuevaCant > stockMaximo) {
             alert("⚠️ Solo hay " + stockMaximo + " unidades disponibles.");
             nuevaCant = stockMaximo;
             btn.value = stockMaximo;
        }
        item.cantidad = nuevaCant;
        item.subtotal = nuevaCant * precio;
        renderizarCarrito();
    }

    function renderizarCarrito() {
        const tbody = document.querySelector('#tablaCarrito tbody');
        tbody.innerHTML = '';
        let total = 0;

        if (carrito.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">El carrito está vacío</td></tr>';
        } else {
            carrito.forEach(item => {
                total += item.subtotal;
                let tr = document.createElement('tr');
                tr.className = 'border-bottom';
                tr.innerHTML = `
                    <td class="ps-3 fw-bold align-middle">${item.nombre}</td>
                    <td class="text-center align-middle">
                        <span class="badge bg-light text-dark border px-2 py-1 fs-6">${item.cantidad}</span>
                    </td>
                    <td class="text-end text-primary fw-bold align-middle">$${item.subtotal.toFixed(2)}</td>
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 rounded-circle" onclick="removerDelCarrito(${item.id_producto})" title="Eliminar">
                            &times;
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        document.getElementById('lblTotal').innerText = '$' + total.toFixed(2);
        
        // Actualizar hidden input con el JSON
        document.getElementById('cart_data').value = JSON.stringify(carrito);

        // Habilitar/Deshabilitar botón de cobrar
        document.getElementById('btnCobrar').disabled = carrito.length === 0;
    }

    // Validar antes de enviar
    document.getElementById('formVenta').addEventListener('submit', function(e) {
        if(carrito.length === 0) {
            e.preventDefault();
            alert("Agregue al menos un producto al carrito antes de cobrar.");
        }
    });
</script>
