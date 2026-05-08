-- Script para insertar la Sucursal y el Cajero por defecto
-- Ejecuta este script en tu gestor de base de datos (ej. pgAdmin o phpMyAdmin)

-- 1. Insertar una Sucursal Principal
INSERT INTO sucursal (nombre, ciudad, direccion) 
VALUES ('Kwik-E-Mart Central', 'Springfield', 'Av. Siempreviva 742');

-- 2. Insertar un Empleado (Cajero) asociado a esa sucursal
-- Asumimos que la sucursal recién creada obtuvo el id_sucursal = 1
INSERT INTO empleado (cedula_identidad, nombre, apellido, cargo_rol, id_sucursal)
VALUES ('12345678', 'Apu', 'Nahasapeemapetilon', 'Cajero', 1);

-- 3. Insertar Categorías
INSERT INTO categoria (nombre, descripcion) VALUES 
('Bebidas', 'Sodas, cervezas y energizantes'),
('Snacks', 'Papas fritas, galletas y dulces'),
('Comida Rápida', 'Hot dogs, donas y comida preparada');

-- 4. Insertar Productos (Asumiendo que las categorías anteriores tomaron ID 1, 2 y 3)
INSERT INTO producto (codigo_barra, nombre, precio_venta_actual, stock_referencial, id_categoria) VALUES 
('7701001', 'Squishee Sabor Cereza', 2.50, 50, 1),
('7701002', 'Cerveza Duff (Lata)', 3.00, 120, 1),
('7701003', 'Rosquilla Glaseada Rosa', 1.50, 30, 3),
('7701004', 'Hot Dog Kwik-E-Mart', 1.00, 15, 3),
('7701005', 'Cereal Krusty-O''s', 4.50, 20, 2);

-- 5. Insertar Clientes
INSERT INTO cliente (nombre_razon_social, nit_ci, telefono, email) VALUES 
('Homer Simpson', '5551234', '555-7334', 'chunkylover53@aol.com'),
('Ned Flanders', '5554321', '555-8904', 'ned@lefthorium.com'),
('Montgomery Burns', '1000000', '555-0001', 'mburns@powerplant.com');

-- Nota: Si los IDs autoincrementables no empiezan en 1 porque borraste datos antes, 
-- asegúrate de verificar el ID de la sucursal y ponerlo correctamente en el INSERT del empleado.
