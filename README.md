# 🏡 Aloja Plus

**Aloja Plus** es una plataforma web desarrollada en PHP y MySQL que permite a los usuarios explorar y seleccionar alojamientos, mientras que un usuario administrador puede gestionar la base de datos de alojamientos.  

El proyecto está diseñado para correr en **XAMPP** y es ideal para proyectos educativos y demostrativos de CRUD y gestión de usuarios.

---

## ✨ Características Principales

### Para usuarios normales:
- Registro e inicio de sesión seguro con contraseña encriptada.
- Explorar la lista de alojamientos disponibles.
- Agregar alojamientos a su cuenta y gestionarlos en un listado personal.
- Recibir notificaciones tipo **toast** al agregar o eliminar alojamientos.
- Logout seguro.

### Para usuarios administradores:
- Acceso exclusivo a la página de administración (`admin.php`).
- Crear nuevos alojamientos que se agregan directamente a la base de datos.
- Toast de confirmación al agregar un alojamiento.
- No pueden eliminar ni seleccionar alojamientos, solo gestión de la base de datos.

### Seguridad:
- Contraseñas almacenadas con **hash seguro**.
- Validación para impedir registros duplicados.
- Sesiones seguras para mantener estado de usuario y permisos.

---

## 🛠 Tecnologías Utilizadas

- **Backend:** PHP 8+
- **Base de datos:** MySQL Workbench
- **Frontend:** HTML5, CSS3, JavaScript
- **Servidor local:** XAMPP

---

## ⚡ Funcionalidades Extras

- Toasts personalizados para notificaciones.
- Listado de alojamientos responsive y compacto.
- Validaciones para usuarios duplicados.
- Diferenciación de permisos entre usuarios comunes y administradores.

---
## 👩🏻‍💻 Desarrollado por
- Rocio Guadalupe Martínez Hernández
---
## 📄 Licencia y créditos
© Todos los derechos reservados. Este proyecto fue creado con fines académicos para el programa Kodigo-FSJ-28. Todos los recursos gráficos son de uso educativo. No se distribuye con fines comerciales.
