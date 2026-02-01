# 🖥️ Frontend - Calculator UI

Interfaz de usuario moderna y reactiva, construida con **Angular 19** y **TailwindCSS**. Ofrece una experiencia de usuario fluida con soporte para temas, historial en tiempo real y teclado.

---

## 🛠️ Requisitos

*   **Node.js:** >= 18 (LTS recomendado)
*   **NPM:** Generalmente incluido con Node.js
*   **Angular CLI:** (Opcional, se puede usar `npx ng`)

---

## 🚀 Instalación y Desarrollo

1.  **Instalar dependencias:**
    \`\`\`bash
    npm install
    \`\`\`

2.  **Iniciar servidor de desarrollo:**
    \`\`\`bash
    npm start
    \`\`\`
    La aplicación se abrirá en `http://localhost:4200`.

---

## 🏗️ Arquitectura de Componentes

La aplicación sigue una estructura modular limpia:

*   **`src/app/components/calculator`**: Componente principal.
    *   Maneja la lógica de entrada (teclado/botones).
    *   Gestiona el estado visual y alertas de error.
*   **`src/app/components/history`**: Vista de historial.
    *   Consume el API para listar operaciones pasadas.
*   **`src/app/services`**:
    *   `calculator.service.ts`: Comunicación HTTP con el Backend.
    *   `theme.service.ts`: Gestión del Modo Oscuro/Claro y persistencia en LocalStorage.

---



## 🎨 Personalización

El diseño visual está centralizado en `tailwind.config.js`. Puedes ajustar la paleta de colores o el modo oscuro editando las clases `dark:` en los templates HTML.
