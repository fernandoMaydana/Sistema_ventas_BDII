/*
PROYECTO: Base de Datos Kwik-E-Mart
AUTOR: Fernando
FECHA: Mayo 2026
*/

-- 0. Creación de la Base de Datos
CREATE DATABASE "kwik-E-mart";

-- IMPORTANTE: Si usas pgAdmin, después de ejecutar la línea de arriba, 
-- debes conectarte a la nueva base de datos para correr lo siguiente.

-- 1. Tabla de Categorías
CREATE TABLE categoria (
    id_categoria SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT
);

-- 2. Tabla de Sucursales
CREATE TABLE sucursal (
    id_sucursal SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    direccion TEXT
);

-- 3. Tabla de Clientes
CREATE TABLE cliente (
    id_cliente SERIAL PRIMARY KEY,
    nombre_razon_social VARCHAR(150) NOT NULL,
    nit_ci VARCHAR(20) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100)
);

-- 4. Tabla de Empleados
CREATE TABLE empleado (
    id_empleado SERIAL PRIMARY KEY,
    cedula_identidad VARCHAR(20) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    cargo_rol VARCHAR(50),
    id_sucursal INT REFERENCES sucursal(id_sucursal)
);

-- 5. Tabla de Productos
CREATE TABLE producto (
    id_producto SERIAL PRIMARY KEY,
    codigo_barra VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    precio_venta_actual DECIMAL(10,2) NOT NULL CHECK (precio_venta_actual > 0),
    stock_referencial INT DEFAULT 0,
    id_categoria INT REFERENCES categoria(id_categoria)
);

-- 6. Tabla de Ventas (Cabecera)
CREATE TABLE venta (
    id_venta SERIAL PRIMARY KEY,
    nro_factura VARCHAR(20) UNIQUE NOT NULL,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_pagado DECIMAL(10,2) DEFAULT 0 CHECK (total_pagado >= 0),
    id_cliente INT REFERENCES cliente(id_cliente),
    id_empleado INT REFERENCES empleado(id_empleado),
    id_sucursal INT REFERENCES sucursal(id_sucursal)
);

-- 7. Tabla de Detalle de Venta
CREATE TABLE detalle_venta (
    id_detalle SERIAL PRIMARY KEY,
    cantidad INT NOT NULL CHECK (cantidad > 0),
    precio_unitario_historico DECIMAL(10,2) NOT NULL CHECK (precio_unitario_historico > 0),
    subtotal DECIMAL(10,2) NOT NULL CHECK (subtotal >= 0),
    id_venta INT REFERENCES venta(id_venta) ON DELETE CASCADE,
    id_producto INT REFERENCES producto(id_producto)
);