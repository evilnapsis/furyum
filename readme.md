# FURYUM - Foro Comunitario v.3.0

FURYUM es un motor de foros moderno, ligero y altamente personalizable, diseñado para crear comunidades vibrantes y seguras. Desarrollado con PHP y basado en una arquitectura MVC robusta, ofrece una experiencia de usuario fluida tanto para administradores como para miembros.

## 🚀 Características Principales

### 🌐 Interfaz Pública
- **Diseño Moderno:** Basado en Bootstrap 5 con una estética premium y responsiva.
- **Búsqueda Global:** Motor de búsqueda integrado en la barra de navegación para encontrar publicaciones rápidamente.
- **Sistema de Interacción:** Los usuarios pueden dar "Me gusta" (Hearts) a las publicaciones.
- **Perfiles Públicos:** Cada usuario tiene un perfil donde se muestra su actividad, publicaciones y su **Karma** acumulado (reputación).
- **Widgets de Actividad:** Visualización de publicaciones recientes y estadísticas globales del foro.
- **Categorización:** Organización clara por categorías con descripciones detalladas.

### 👤 Área de Usuario (Dashboard)
- **Gestión de Publicaciones:** Los usuarios pueden crear, editar y eliminar sus propios artículos.
- **Resumen de Cuenta:** Widgets informativos que muestran el total de posts, comentarios y karma total.
- **Edición de Perfil:** Posibilidad de cambiar nombre, correo y foto de perfil.

### 🛡️ Seguridad y Control
- **Moderación de Comentarios:** Los administradores pueden gestionar y aprobar comentarios.
- **Módulo de Administración:** Panel dedicado para la gestión de categorías, usuarios y contenidos.

## 🛠️ Requisitos del Sistema
- PHP 7.4 o superior (Compatible con PHP 8.2+).
- MySQL / MariaDB.
- Servidor Web (Apache, Nginx, XAMPP, Lando, etc.).

## 📦 Instalación

1.  **Clonar o descargar** el repositorio en tu servidor local o hosting.
2.  **Importar la base de datos:** Ejecuta el archivo `schema.sql` en tu gestor de base de datos (phpMyAdmin, MySQL Workbench, etc.).
3.  **Configuración de DB:** Edita el archivo `admin/core/controller/Database.php` con tus credenciales de base de datos.
4.  **Acceso Inicial:**
    - **URL:** `http://tu-servidor/furyum/`
    - **Admin por defecto:**
        - **Usuario:** `admin`
        - **Contraseña:** `admin`

## 👨‍💻 Autor
Desarrollado con pasión por **Evilnapsis**.

---
*© 2026 FURYUM. Todos los derechos reservados.*
