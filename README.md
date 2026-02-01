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

## 🌐 Guía de Despliegue (GoDaddy / Shared Hosting)

Esta aplicación está lista para desplegarse en servidores compartidos como GoDaddy (cPanel).

### Paso 1: Backend (Laravel)
1.  Subir el contenido de la carpeta `backend` a una carpeta privada en el hosting (ej: `/home/usuario/backend_calc`).
2.  Mover el contenido de `backend/public` a la carpeta pública del dominio (ej: `/home/usuario/public_html`).
3.  Editar `public_html/index.php` para apuntar a las rutas correctas:
    \`\`\`php
    require __DIR__.'/../backend_calc/vendor/autoload.php';
    $app = require __DIR__.'/../backend_calc/bootstrap/app.php';
    \`\`\`
4.  Configurar el archivo `.env` en producción con las credenciales de base de datos del hosting.

### Paso 2: Frontend (Angular)
1.  En el entorno local, construir la aplicación para producción:
    \`\`\`bash
    cd frontend
    npm run build
    \`\`\`
    *Esto generará la carpeta `dist/frontend/browser`.*
2.  Subir el contenido de `dist/frontend/browser` a una subcarpeta en el hosting (ej: `/public_html/app`) o al directorio raíz si se desea que sea la app principal.
3.  Si se usa una subcarpeta, asegurarse de construir con la base href correcta:
    \`\`\`bash
    npm run build -- --base-href=/app/
    \`\`\`

### Paso 3: Base de Datos
1.  Crear la base de datos en el Panel del hosting.
2.  Importar el esquema o ejecutar las migraciones si se tiene acceso SSH.

---

## 📸 Capturas de Pantalla

*(Espacio reservado para capturas del Modo Oscuro, Modo Claro y Historial)*

---

Desarrollado con ❤️ por **D13G0ARJ** para demostración técnica.
