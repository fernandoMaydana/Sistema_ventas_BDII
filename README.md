# 🏪 Minimarket Kwik-E-Mart - Sistema de Ventas
> **Proyecto Académico:** Base de Datos II  
> **Estado:** En Desarrollo 🛠️

---

## 📝 Descripción del Proyecto
El sistema de venta para el **Kwik-E-Mart** es una solución diseñada para la gestión operativa de un minimarket de alta rotación. El objetivo principal es garantizar la **consistencia de los datos** en un entorno transaccional, permitiendo un control preciso del flujo de ventas y la integridad referencial de la información.

A diferencia de sistemas administrativos complejos, este proyecto se enfoca específicamente en la eficiencia del **punto de venta (POS)**, optimizando la interacción entre el catálogo de productos y el registro final de transacciones.

## 🛠️ Especificaciones Técnicas y Alcance
* **Motor de Base de Datos:** Se utiliza **PostgreSQL**, aprovechando su capacidad para manejar transacciones ACID y asegurar la fiabilidad de los datos financieros.
* **Arquitectura:** Diseñado bajo principios de normalización de datos para evitar redundancias y asegurar la integridad referencial.
* **Alcance Delimitado:** Para esta fase del proyecto, el sistema se centra exclusivamente en el flujo **Ventas -> Clientes**.
    * **Incluye:** Gestión de categorías, catálogo de productos y procesamiento transaccional de ventas.
    * **Excluye:** No se contempla la gestión de inventarios (stock dinámico), auditorías de almacén ni relación con proveedores.

## 📖 Enunciado del Caso de Estudio
El Kwik-E-Mart requiere un sistema para automatizar su flujo principal de ventas. El catálogo se organiza por Categorías (como Snacks o Bebidas), las cuales agrupan diversos Productos. Cada producto tiene un precio de venta definido y un stock de referencia.

El proceso central ocurre cuando un Empleado (cajero) registra una Venta para un Cliente. Esta transacción genera una cabecera con los datos generales (fecha, total, factura) y se desglosa en un Detalle de Venta, donde se vinculan los productos adquiridos, las cantidades y el precio capturado en el momento de la operación. El sistema garantiza que cada venta impacte en el historial del cliente y sea procesada por un empleado responsable en una Sucursal específica, manteniendo la integridad referencial en todo el flujo transaccional."

## ⚖️ Reglas de Negocio
Para asegurar el correcto funcionamiento del minimarket, el sistema implementa las siguientes reglas:

**Integridad de Precios:** Ninguna venta puede procesarse si el producto no tiene un precio de venta definido y vigente.
**Inmutabilidad del Detalle:** Una vez registrada la venta, el precio almacenado en el `Detalle_Venta` debe permanecer fijño, protegiendo el registro contra futuros cambios en el catálogo de productos.
**Identificación Obligatoria:** Toda transacción debe estar vinculada a un cliente (pudiendo ser un "Cliente Genérico") y a un empleado responsable para fines de auditoría.
**Consistencia Transaccional:** El registro de la cabecera de venta y sus detalles debe ocurrir de forma atómica; si falla un renglón del detalle, la venta completa se revierte para evitar datos huérfanos.
**Unicidad de Categorías:** Los productos solo pueden pertenecer a una categoría principal para simplificar la navegación y organización en el punto de venta.

---
*Proyecto desarrollado para la materia de Base de Datos II.*