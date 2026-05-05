# 🏪 Minimarket Kwik-E-Mart - Sistema de Ventas
> **Proyecto Académico:** Base de Datos II  
> **Estado:** En Desarrollo 

---

## Descripción del Proyecto
El sistema de venta para el **Kwik-E-Mart** es una solución diseñada para la gestión operativa de un minimarket de alta rotación. El objetivo principal es garantizar la **consistencia de los datos** en un entorno transaccional, permitiendo un control preciso del flujo de ventas y la integridad referencial de la información.

A diferencia de sistemas administrativos complejos, este proyecto se enfoca específicamente en la eficiencia del **punto de venta (POS)**, optimizando la interacción entre el catálogo de productos y el registro final de transacciones.

## Especificaciones Técnicas y Alcance
* **Motor de Base de Datos:** Se utiliza **PostgreSQL**, aprovechando su capacidad para manejar transacciones ACID y asegurar la fiabilidad de los datos financieros.
* **Arquitectura:** Diseñado bajo principios de normalización de datos para evitar redundancias y asegurar la integridad referencial.
* **Alcance Delimitado:** Para esta fase del proyecto, el sistema se centra exclusivamente en el flujo **Ventas -> Clientes**.
    * **Incluye:** Gestión de categorías, catálogo de productos y procesamiento transaccional de ventas.
    * **Excluye:** No se contempla la gestión de inventarios (stock dinámico), auditorías de almacén ni relación con proveedores.

## Enunciado del Caso de Estudio
El Kwik-E-Mart requiere un sistema para automatizar su flujo principal de ventas. El catálogo se organiza por Categorías (como Snacks o Bebidas), las cuales agrupan diversos Productos. Cada producto tiene un precio de venta definido y un stock de referencia.

El proceso central ocurre cuando un Empleado (cajero) registra una Venta para un Cliente. Esta transacción genera una cabecera con los datos generales (fecha, total, factura) y se desglosa en un Detalle de Venta, donde se vinculan los productos adquiridos, las cantidades y el precio capturado en el momento de la operación. El sistema garantiza que cada venta impacte en el historial del cliente y sea procesada por un empleado responsable en una Sucursal específica, manteniendo la integridad referencial en todo el flujo transaccional."

## Reglas de Negocio
Para asegurar el correcto funcionamiento del minimarket, el sistema implementa las siguientes reglas:

**Integridad de Precios:** Ninguna venta puede procesarse si el producto no tiene un precio de venta definido y vigente.
**Inmutabilidad del Detalle:** Una vez registrada la venta, el precio almacenado en el `Detalle_Venta` debe permanecer fijño, protegiendo el registro contra futuros cambios en el catálogo de productos.
**Identificación Obligatoria:** Toda transacción debe estar vinculada a un cliente (pudiendo ser un "Cliente Genérico") y a un empleado responsable para fines de auditoría.
**Consistencia Transaccional:** El registro de la cabecera de venta y sus detalles debe ocurrir de forma atómica; si falla un renglón del detalle, la venta completa se revierte para evitar datos huérfanos.
**Unicidad de Categorías:** Los productos solo pueden pertenecer a una categoría principal para simplificar la navegación y organización en el punto de venta.
___

## Estructura de Datos (Entidades y Atributos)

A continuación se detallan las entidades que componen el sistema del **Kwik-E-Mart**, junto con sus atributos principales (omitiendo claves foráneas para esta sección):

* **CATEGORÍA**: Clasificación lógica para organizar el catálogo.
    * `id_categoria` (PK), `nombre`, `descripcion`.
* **PRODUCTO**: Bienes disponibles para la venta.
    * `id_producto` (PK), `codigo_barra`, `nombre`, `precio_venta_actual`, `stock_referencial`.
* **CLIENTE**: Personas que realizan compras en el minimarket.
    * `id_cliente` (PK), `nombre_razon_social`, `nit_ci`, `telefono`, `email`.
* **EMPLEADO**: Personal responsable de la atención en cajas y gestión.
    * `id_empleado` (PK), `cedula_identidad`, `nombre`, `apellido`, `cargo_rol`.
* **SUCURSAL**: Puntos de venta físicos de la franquicia.
    * `id_sucursal` (PK), `nombre`, `ciudad`, `direccion`.
* **VENTA (Cabecera)**: Registro principal de la transacción comercial.
    * `id_venta` (PK), `nro_factura`, `fecha_hora`, `total_pagado`.
* **DETALLE_VENTA**: Desglose individual de cada artículo procesado en una venta.
    * `id_detalle` (PK), `cantidad`, `precio_unitario_historico`, `subtotal`.

---

## Relaciones y Cardinalidad

El modelo sigue las siguientes reglas de asociación para garantizar la integridad del flujo de ventas:

1.  **CATEGORÍA — PRODUCTO (1:N)**: Una categoría agrupa múltiples productos.
2.  **SUCURSAL — EMPLEADO (1:N)**: Cada sucursal cuenta con un equipo de empleados asignados.
3.  **CLIENTE — VENTA (1:N)**: Un cliente puede figurar en múltiples registros de venta.
4.  **EMPLEADO — VENTA (1:N)**: Un empleado es responsable de procesar numerosas ventas.
5.  **SUCURSAL — VENTA (1:N)**: Una sucursal genera un historial de múltiples ventas.
6.  **VENTA — DETALLE_VENTA (1:N)**: Una venta se compone de uno o varios registros de detalle.
7.  **PRODUCTO — DETALLE_VENTA (1:N)**: Un producto puede estar presente en los detalles de múltiples ventas.

---

## Modelo Entidad-Relación (DER)
A continuación se presenta la arquitectura lógica del sistema, detallando las conexiones entre las entidades descritas anteriormente.

![Diagrama Entidad Relación](./diagramas/diagrama_er.png)

---

## Modelo Relacional 
A continuación, se detalla el esquema lógico con llaves foráneas y cardinalidades finales, diseñado para garantizar la integridad referencial en PostgreSQL.
![Modelo Relacional](./diagramas/esquema_BD_Kwik-E-Mart.png)
---
*Proyecto desarrollado para la materia de Base de Datos II.*