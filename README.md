# SISTEMA DE VENTAS 🛒

Un sistema de ventas moderno es un ecosistema digital diseñado para el **Procesamiento de Transacciones (TPS)**. Su funcionamiento se basa en un ciclo de vida de datos que garantiza que cada intercambio de bienes por dinero quede registrado bajo estándares de integridad.

---

## 🏛️ Componentes del Sistema
Para que la investigación sea completa, el sistema se divide en sus pilares fundamentales:

### 1. Componentes Tecnológicos
* **El Motor de Base de Datos (DBMS):** Es el corazón. Debe soportar transacciones **ACID** (Atomicidad, Consistencia, Aislamiento y Durabilidad) para evitar que una venta se registre a medias si falla la energía.
* **Lógica de Aplicación (Backend):** Actúa como el intermediario que aplica las reglas antes de que el SQL toque las tablas.
* **Interfaz de Usuario (Frontend):** Diseñada para la rapidez; el cajero necesita procesar ítems en milisegundos.

### 2. Componentes de Datos (Entidades Maestras)
* **Catálogo de Productos:** Información estática y dinámica de lo que se vende.
* **Maestro de Clientes y Proveedores:** Identificación legal y de contacto.
* **Estructura Organizacional:** Definición de sucursales, almacenes y roles de empleados.

---

## ⚖️ Reglas de Negocio 
Las reglas de negocio son las "leyes" que rigen el comportamiento del sistema. En **Base de Datos II**, estas reglas se traducen luego en:
* **Constraints:** (Check, Unique, Not Null).
* **Triggers:** Para automatizar procesos y auditorías.

---
*Proyecto desarrollado para la materia de Base de Datos II.*