# ⚙️ Backend - Calculator API

Este directorio contiene la lógica del servidor, construida con **Laravel 11**. Se encarga de procesar los cálculos matemáticos para garantizar la precisión y de persistir el historial de operaciones en MySQL.

---

## 🛠️ Requisitos del Sistema

*   **PHP:** >= 8.2
*   **Composer:** Última versión
*   **Base de Datos:** MySQL o MariaDB

---

## 🚀 Instalación y Configuración

1.  **Instalar dependencias:**
    \`\`\`bash
    composer install
    \`\`\`

2.  **Configurar entorno:**
    \`\`\`bash
    cp .env.example .env
    php artisan key:generate
    \`\`\`

3.  **Configurar Base de Datos (`.env`):**
    Asegurarse de crear una base de datos vacía (ej: `calc_app_db`) y configurar las credenciales:
    \`\`\`env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=calc_app_db
    DB_USERNAME=root
    DB_PASSWORD=
    \`\`\`

4.  **Correr Migraciones:**
    Esto creará la tabla `calculations` necesaria.
    \`\`\`bash
    php artisan migrate
    \`\`\`

5.  **Iniciar Servidor:**
    \`\`\`bash
    php artisan serve
    \`\`\`
    El API estará disponible en `http://127.0.0.1:8000`.

---

## 📡 Documentación de Endpoints (API)

La API expone los siguientes endpoints RESTful para consumo del frontend.

### 1. Realizar Cálculo
Procesa una operación matemática y la guarda en el historial.

*   **Método:** `POST`
*   **URL:** `/api/calculate`
*   **Headers:** `Content-Type: application/json`
*   **Cuerpo (JSON):**
    \`\`\`json
    {
        "num1": 10,
        "operator": "+",
        "num2": 5
    }
    \`\`\`
    *Operadores soportados: `+`, `-`, `*`, `/`*

*   **Respuesta Exitosa (200 OK):**
    \`\`\`json
    {
        "id": 1,
        "num1": 10,
        "operator": "+",
        "num2": 5,
        "result": 15,
        "created_at": "2026-01-31T22:00:00.000000Z",
        "updated_at": "2026-01-31T22:00:00.000000Z"
    }
    \`\`\`

*   **Errores Comunes:**
    *   `422 Unprocessable Entity`: Si falta algún dato o el formato es inválido.
    *   `400 Bad Request`: División por cero.

### 2. Obtener Historial
Recupera las últimas operaciones realizadas.

*   **Método:** `GET`
*   **URL:** `/api/history`
*   **Respuesta Exitosa (200 OK):**
    \`\`\`json
    [
        {
            "id": 2,
            "num1": 100,
            "operator": "/",
            "num2": 2,
            "result": 50,
            "created_at": "..."
        },
        {
            "id": 1,
            "num1": 10,
            "operator": "+",
            "num2": 5,
            "result": 15,
            "created_at": "..."
        }
    ]
    \`\`\`

---

## 📂 Estructura Clave

*   `app/Http/Controllers/CalculatorController.php`: Lógica principal de los endpoints.
*   `routes/api.php`: Definición de rutas.
*   `database/migrations/xxxx_create_calculations_table.php`: Definición del esquema de BD.
