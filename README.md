# 🧮 Calculator App Monolith

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Angular](https://img.shields.io/badge/frontend-Angular%2019-red.svg)
![Laravel](https://img.shields.io/badge/backend-Laravel%2011-red.svg)
![TailwindCSS](https://img.shields.io/badge/style-TailwindCSS-38bdf8.svg)

Bienvenido a **Calc App Monolith**, una solución completa de calculadora web desarrollada como prueba técnica de alto nivel. Este proyecto demuestra una arquitectura monolítica moderna, integrando un backend robusto en Laravel con un frontend reactivo de última generación en Angular.

---

## 📚 Documentación

Para facilitar la navegación y el despliegue, la documentación se ha dividido en secciones especializadas:

### 🖥️ [Frontend (Angular)](./frontend/README.md)
*   **Tecnologías:** Angular 19, TailwindCSS, TypeScript.
*   **Características:** Modo Oscuro, Soporte de Teclado, Historial en Tiempo Real.
*   **Guía de Despliegue:** Instrucciones específicas para compilar y subir a servidores como GoDaddy.

### ⚙️ [Backend (Laravel)](./backend/README.md)
*   **Tecnologías:** Laravel 11, PHP 8.2+, MySQL.
*   **API REST:** Documentación detallada de los Endpoints (`POST /calculate`, `GET /history`).
*   **Instalación:** Configuración de base de datos y migraciones.

---

## ✨ Características Principales

*   **Experiencia de Usuario (UX) Premium:** Diseño inspirado en iOS con efectos de vidrio y transiciones suaves.
*   **Persistencia de Datos:** Todo cálculo queda registrado en base de datos.
*   **Accesibilidad:** Navegación completa por teclado (Numpad, Enter, Esc).
*   **Internacionalización:** Formatos de fecha y número adaptados a español (`es-ES`).
*   **Switch de Tema:** Modo Claro y Oscuro persistente.

---

## 🚀 Inicio Rápido (Local)

Para ejecutar todo el proyecto rápidamente en un entorno local:

1.  **Clonar el repositorio:**
    \`\`\`bash
    git clone https://github.com/D13G0ARJ/calc-app-monolith.git
    \`\`\`

2.  **Levantar el Backend:**
    \`\`\`bash
    cd backend
    composer install
    cp .env.example .env
    # Configurar la DB en .env
    php artisan migrate
    php artisan serve
    \`\`\`

3.  **Levantar el Frontend:**
    \`\`\`bash
    cd frontend
    npm install
    npm start
    \`\`\`

4.  **¡Listo!** Abrir `http://localhost:4200` en el navegador.

---

## 🚀 Guía de Despliegue (GoDaddy / cPanel)

Esta aplicación utiliza una estrategia de despliegue "Monorepo Seguro". El código del Backend (Laravel) se aloja fuera del directorio público por seguridad, mientras que el Frontend (Angular) se sirve desde la raíz, comunicándose a través de una carpeta puente `/api`.

### 📂 Estructura del Servidor
El objetivo es organizar los archivos en el hosting de la siguiente manera:

```text
/home/usuario/
├── backend_final/       <-- Código fuente de Laravel (Privado/Oculto)
└── public_html/         <-- Directorio Público (Accesible vía Web)
    ├── api/             <-- Carpeta puente (Punto de entrada al Backend)
    ├── index.html       <-- Archivo principal de Angular
    └── (otros archivos del frontend...)
```

### Paso 1: Base de Datos (MySQL)
1.  En cPanel, ir a "Bases de datos MySQL".
2.  Crear una nueva base de datos y un nuevo usuario.
3.  ⚠️ **CRÍTICO:** Asignar el usuario a la base de datos marcando la opción "Todos los Privilegios" (All Privileges).
4.  Ir a phpMyAdmin, seleccionar la base de datos vacía e importar el archivo `.sql` de la estructura.

### Paso 2: Backend (Laravel)
1.  **Preparación:** Comprimir la carpeta `backend` completa (asegurando incluir la carpeta `vendor`) en un archivo llamado `backend.zip`.
2.  **Subida:** En el Administrador de Archivos de cPanel, ir a la raíz del servidor (un nivel arriba de `public_html`) y crear la carpeta `backend_final`. Subir y descomprimir el zip allí.
3.  **Configuración:** Renombrar `.env.example` a `.env` y configurar las credenciales de la base de datos del Paso 1.

**Crear el Puente API:**
1.  Ir a `public_html` y crear una carpeta llamada `api`.
2.  Copiar el contenido de `backend_final/public/` (`index.php`, `.htaccess`, etc.) y pegarlo dentro de `public_html/api/`.
3.  Editar `public_html/api/index.php` para apuntar a la carpeta privada, modificando las rutas `require` para subir dos niveles:

```php
// public_html/api/index.php

// 1. Ajustar Maintenance Mode
if (file_exists($maintenance = __DIR__.'/../../backend_final/storage/framework/maintenance.php')) {
    require $maintenance;
}

// 2. Ajustar Autoload
require __DIR__.'/../../backend_final/vendor/autoload.php';

// 3. Ajustar Bootstrap App
$app = require_once __DIR__.'/../../backend_final/bootstrap/app.php';
```

### Paso 3: Frontend (Angular)
1.  **Compilación:** En tu entorno local, ejecutar el build de producción:
    ```bash
    cd frontend
    ng build --configuration production
    ```
2.  **Subida:** Ir a la carpeta generada `dist/nombre-proyecto/browser`.
3.  Subir únicamente el contenido de esa carpeta (archivos sueltos como `index.html`, `main.js`, `styles.css`) directamente a la raíz de `public_html`.
    *Nota: Ten cuidado de no borrar la carpeta `api` creada en el paso anterior.*

### Paso 4: Enrutamiento (SPA Fix)
Para que Angular maneje las rutas (como `/history`) sin generar errores 404 en el servidor, crear o editar el archivo `.htaccess` en la raíz de `public_html` con este contenido:

```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  
  # 1. Permitir acceso a la API (Backend) sin redirigir
  RewriteRule ^api/ - [L]

  # 2. Redirigir cualquier otra ruta al index.html (Angular)
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^ index.html [L]
</IfModule>
```

---


Desarrollado con ❤️ por **D13G0ARJ** para demostración técnica.
