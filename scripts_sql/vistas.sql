-- Vista de Productos con su Categoría
-- Esta vista nos permite obtener los detalles de los productos sin tener que hacer JOINs en el código PHP.

CREATE OR REPLACE VIEW vista_productos_detallados AS
SELECT 
    p.id_producto,
    p.codigo_barra,
    p.nombre AS producto,
    p.precio_venta_actual AS precio,
    p.stock_referencial AS stock,
    p.id_categoria,
    c.nombre AS categoria_nombre
FROM producto p
JOIN categoria c ON p.id_categoria = c.id_categoria;
