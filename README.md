# 📖 LibroScan — Sistema de Gestión Bibliotecaria

**LibroScan** es una plataforma web desarrollada para automatizar y gestionar el flujo de **préstamo, devolución y administración del catálogo de libros** de la **Institución Educativa Monseñor Ricardo Trujillo Gutiérrez**.

El sistema permite separar las responsabilidades de los **estudiantes** y del **personal administrativo/bibliotecario** mediante un sistema de roles, ofreciendo una interfaz moderna, intuitiva y adaptable a diferentes dispositivos.

---

## 🛠️ Tecnologías utilizadas

* **Framework Backend:** Laravel 10 / 11
* **Lenguaje:** PHP 8.2+
* **Frontend:** Blade Templates
* **Estilos:** Tailwind CSS
* **Compilación de assets:** Vite
* **Base de datos:** MySQL / MariaDB
* **Autenticación:** Laravel Breeze

---

## 🚀 Características principales

### 👨‍🎓 Módulo de estudiantes / usuarios

* 📚 **Catálogo de libros:** exploración visual de los libros disponibles.
* 📥 **Solicitud de préstamos:** solicitud de libros directamente desde el catálogo.
* 📖 **Mis préstamos:** consulta de libros actualmente prestados.
* 🔄 **Renovación:** solicitud de renovación del plazo de préstamo.
* 📋 **Historial de préstamos:** consulta de préstamos anteriores y libros devueltos.

### 🛡️ Módulo de administración / bibliotecario

* 📊 **Dashboard:** estadísticas generales del sistema.
* 📚 **Gestión de libros:** creación, consulta, edición y eliminación de libros.
* 👥 **Gestión de usuarios:** administración de usuarios y roles.
* 📦 **Logística y entregas:** control de solicitudes de préstamo y devolución.
* ✅ **Aprobación de préstamos:** confirmación de la entrega física de libros.
* 📑 **Informes:** consulta de información relacionada con el funcionamiento de la biblioteca.
* 🕐 **Últimos movimientos:** visualización de las actividades recientes.

---

## 📊 Dashboard administrativo

El panel administrativo permite consultar:

* 📚 Libros registrados.
* 📖 Préstamos activos.
* 👥 Usuarios registrados.
* 🔄 Devoluciones pendientes.
* 📋 Últimos movimientos realizados.

---

## 🔄 Flujo de préstamo de libros

```text
┌──────────────────────┐
│      ESTUDIANTE      │
└──────────┬───────────┘
           │
           ▼
┌────────────────────────────┐
│ Explora el catálogo        │
│ y solicita un libro        │
└────────────┬───────────────┘
             │
             ▼
       Estado: PENDIENTE
             │
             ▼
┌────────────────────────────┐
│      BIBLIOTECARIO         │
│ Revisa la solicitud        │
└────────────┬───────────────┘
             │
             ▼
┌────────────────────────────┐
│ Entrega físicamente        │
│ el libro al estudiante     │
└────────────┬───────────────┘
             │
             ▼
        Estado: ACTIVO
             │
             ▼
┌────────────────────────────┐
│ Estudiante consulta        │
│ "Mis préstamos"            │
└────────────┬───────────────┘
             │
             ▼
┌────────────────────────────┐
│ Fecha límite + renovación  │
└────────────┬───────────────┘
             │
             ▼
        DEVOLUCIÓN
             │
             ▼
       Estado: DEVUELTO
```

---

## 📥 Instalación y configuración local

### 1. Clonar el repositorio

```bash
git clone https://github.com/Jaider-Galvis/libroscan.git
cd libroscan
```

> Si el nombre real del repositorio es diferente, reemplaza `libroscan` por el nombre correspondiente.

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de JavaScript

```bash
npm install
```

### 4. Configurar el archivo `.env`

Copia el archivo de ejemplo:

```bash
cp .env.example .env
```

Configura la conexión a MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=libroscan
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generar la clave de Laravel

```bash
php artisan key:generate
```

### 6. Ejecutar migraciones y Seeders

```bash
php artisan migrate --seed
```

### 7. Iniciar Laravel

```bash
php artisan serve
```

### 8. Iniciar Vite

En otra terminal:

```bash
npm run dev
```

### 9. Acceder al sistema

```text
http://127.0.0.1:8000
```

---

## 📂 Estructura del proyecto

```text
libroscan/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   └── UserController.php
│   │       ├── LibroController.php
│   │       ├── PrestamoController.php
│   │       └── ProfileController.php
│   │
│   └── Models/
│       ├── Libro.php
│       ├── Prestamo.php
│       └── User.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── logistica/
│       │   ├── libros/
│       │   └── usuarios/
│       │
│       ├── dashboard.blade.php
│       └── prestamos/
│
├── routes/
│   └── web.php
│
├── public/
├── storage/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 👤 Roles del sistema

### 👨‍🎓 Estudiante

El estudiante puede:

* Consultar el catálogo de libros.
* Solicitar préstamos.
* Consultar préstamos activos.
* Solicitar renovaciones.
* Consultar su historial.

### 🛡️ Bibliotecario / Administrador

El administrador puede:

* Gestionar usuarios.
* Gestionar libros.
* Revisar solicitudes.
* Aprobar préstamos.
* Registrar entregas y devoluciones.
* Consultar estadísticas.
* Gestionar la logística.
* Consultar informes.

---

## 🔐 Autenticación y seguridad

LibroScan utiliza **Laravel Breeze** para la autenticación de usuarios.

El sistema implementa diferentes roles para controlar el acceso a las funcionalidades de estudiantes y administradores.

> **Importante:** las contraseñas, tokens, claves privadas y datos sensibles nunca deben incluirse en el repositorio ni en el archivo `README.md`.

---

## 🗃️ Estados de los préstamos

| Estado      | Descripción                                                      |
| ----------- | ---------------------------------------------------------------- |
| `pendiente` | El estudiante realizó una solicitud y está esperando aprobación. |
| `activo`    | El libro fue entregado físicamente al estudiante.                |
| `devuelto`  | El estudiante realizó la devolución del libro.                   |

---

## El mapa de navegación de LibroScan

                                  ┌─────────────────┐
                                  │   Página de     │
                                  │ Inicio / Landing│
                                  └────────┬────────┘
                                           │
                                  ┌────────┴────────┐
                                  │ Auth (Login /   │
                                  │  Registro)      │
                                  └────────┬────────┘
                                           │
                              ┌────────────┴────────────┐
                              │     Redirección /       │
                              │       Dashboard         │
                              └────────────┬────────────┘
                                           │
                ┌──────────────────────────┴──────────────────────────┐
                │                                                     │
      ▼ ROL: Estudiante                                     ▼ ROL: Administrador / Bibliotecario
┌───────────────────────────┐                         ┌─────────────────────────────────────────┐
│  PANEL ESTUDIANTE         │                         │  PANEL DE ADMINISTRACIÓN                │
├───────────────────────────┤                         ├─────────────────────────────────────────┤
│ • Catálogo de Libros      │                         │ • Dashboard (Métricas y Movimientos)    │
│   └─ Solicitud de préstamo│                         │ • Gestión de Usuarios (CRUD + Roles)    │
│ • Mis Préstamos Activos   │                         │ • Catálogo de Libros (CRUD + Inventario)│
│   └─ Solicitud renovación │                         │ • Logística y Entregas                  │
│ • Historial de Préstamos  │                         │   └─ Aprobación y Entrega física        │
│ • Perfil de Usuario       │                         │ • Informes y Reportes                   │
└───────────────────────────┘                         │ • Perfil de Usuario                     │
                                                      └─────────────────────────────────────────┘
                              
Estructura de Vistas y Rutas

Público / Autenticación

/ — Página de bienvenida

/login — Iniciar sesión

/register — Registro de usuarios

Área de Estudiantes (/)

/dashboard — Catálogo principal y vista de libros disponibles

/prestamos — Libros que tiene actualmente prestados

/historial — Historial de libros devueltos

/profile — Configuración de la cuenta

Área de Administración (/admin/)

/admin/dashboard — Resumen estadístico (libros totales, préstamos activos, pendientes)

/admin/usuarios — Lista, edición y asignación de roles a usuarios

/admin/libros — Registro, modificación y baja de libros

/admin/logistica — Panel de recepción de solicitudes y confirmación de entrega física

/admin/informes — Generación de reportes institucionales

## 🎯 Objetivo del proyecto

El objetivo de **LibroScan** es proporcionar una solución tecnológica para mejorar la gestión de los recursos bibliográficos de la institución.

El sistema busca reducir los procesos manuales y facilitar el control de:

* 📚 Inventario de libros.
* 👥 Usuarios.
* 📖 Préstamos.
* 🔄 Devoluciones.
* 📋 Solicitudes.
* 📊 Estadísticas e informes.

---

## 👨‍💻 Desarrollador

**Jaider Galvis**

GitHub: **Jaider-Galvis**

Correo de desarrollo: `jaiderd.galvisg@iemrtg.edu.co`

---

## 🏫 Créditos institucionales

**Institución Educativa Monseñor Ricardo Trujillo Gutiérrez**

### 📖 LibroScan

**Sistema Integrado de Control de Biblioteca**

Proyecto desarrollado para apoyar la gestión y administración del material bibliográfico institucional.

---

## 📄 Licencia

Este proyecto fue desarrollado con fines **académicos e institucionales**.

© 2026 — **LibroScan**
**Jaider Galvis**
