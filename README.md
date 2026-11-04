# NexusX - Frontend Module

## 💡 Contexto y Arquitectura del Proyecto

Este módulo frontend está construido bajo el patrón de arquitectura **MVC (Modelo-Vista-Controlador)** en PHP puro, diseñado para mantener una separación clara entre la lógica de la aplicación y la presentación visual. A continuación se detalla el propósito de cada componente clave dentro del sistema:

- **Controladores (`controllers/`):** Encargados de procesar la lógica de la aplicación. Manejan las peticiones del usuario y gestionan la comunicación con los servicios del Backend, preparando la información necesaria sin mezclar código de interfaz gráfica.
- **Vistas (`src/` o raíz):** Archivos dedicados exclusivamente a la presentación de la información proporcionada por los controladores. Se enfocan en estructurar el contenido de manera semántica y limpia, minimizando dependencias complejas del lado del cliente.
- **Servicios (`services/apiGateway.php`):** Actúa como el puente de integración del sistema. Conecta el frontend con el **API Gateway** del ecosistema de microservicios, interactuando con el backend como un servicio externo para el intercambio fluido de datos en formato JSON.
- **Estándares de Código:** Todo el proyecto mantiene convenciones estándar de nomenclatura (como `camelCase`) y limpieza estructural para facilitar su lectura, escalabilidad y mantenimiento a largo plazo.

---

## 📦 Repositorios Relacionados (Ecosistema NexusX)

Para que este frontend funcione en su totalidad, es necesario levantar el ecosistema completo (servicios y base de datos). Cada uno de estos repositorios cuenta con su propio archivo `README.md` detallado que explica paso a paso cómo ejecutarlos y utilizarlos:

- **Backend (Microservicios & API Gateway):** [https://github.com/Abr10chino/Backend_NexusX](https://github.com/Abr10chino/Backend_NexusX)
- **Base de Datos (NexusXDB):** [https://github.com/Abr10chino/NexusXDB](https://github.com/Abr10chino/NexusXDB)

---

## 🚀 Opciones de Despliegue

Tienes dos formas de ejecutar y desplegar este proyecto según tus necesidades y entorno de trabajo:

---

### Opción 1: Despliegue Automatizado con Docker Compose (Recomendado)

Esta opción construye y levanta todo el entorno del frontend de manera automática utilizando la configuración de tu archivo.

#### 📋 Requisitos para Docker:
- Docker y Docker Compose instalados e iniciados en tu sistema.
- Asegurarte de que el ecosistema de base de datos y backend (Gateway en el puerto `8080`) estén corriendo para que el frontend pueda consumir las APIs.

#### 🛠️ Instrucciones:
1. Ubícate en la raíz del proyecto frontend desde tu terminal.
2. Ejecuta el siguiente comando para construir y levantar el servicio en segundo plano:
   ```bash
   docker compose up --build -d
   ```
3. Verifica que el contenedor esté corriendo correctamente:
   ```bash
   docker compose ps
   ```
4. ¡Listo! Ya puedes acceder a la aplicación desde tu navegador ingresando a **http://localhost:8090**.

*(Nota: Para detener el servicio cuando dejes de trabajar, simplemente ejecuta `docker compose down`)*

---

### Opción 2: Desarrollo Local (PHP Server / XAMPP)

Esta opción te permite ejecutar el proyecto de forma nativa utilizando el servidor integrado de PHP o herramientas como XAMPP/WAMP.

#### 📋 Requisitos:
- Tener instalado PHP (versión 7.4 o superior).
- El ecosistema backend corriendo localmente (API Gateway en `http://localhost:8080`).

#### 🛠️ Instrucciones (Servidor Integrado de PHP):
1. Ubícate en la carpeta raíz del proyecto frontend desde tu terminal.
2. Levanta el servidor local ejecutando:
   ```bash
   php -S localhost:8090
   ```
3. El proyecto quedará en escucha y listo para procesar peticiones.

---

## 📂 Estructura de Vistas (Módulos Principales)

El sistema se compone de los siguientes módulos, todos consumiendo sus respectivos controladores:

- **Inicio (`index.php`):**
  Página principal que funciona como panel de bienvenida y punto de navegación central hacia los módulos de importación y catálogo de productos.

- **Carga de Importación (`import.php`):**
  Interfaz para ingresar un identificador y subir un archivo CSV. Convierte el archivo a JSON y lo envía al `import-service` del backend para su carga masiva.

- **Historial de Importaciones (`importData.php`):**
  Muestra una cuadrícula estructurada con el registro histórico de importaciones, resumiendo el total de filas aceptadas, rechazadas y la fecha de procesamiento.

- **Detalle de Importación (`importDataDetail.php`):**
  Vista que recibe el ID de una importación específica y muestra su desglose completo, incluyendo una sub-sección con el listado detallado de errores generados durante la validación del backend.

- **Catálogo de Productos (`products.php`):**
  Vista dinámica multipropósito del inventario que maneja:
  1. **Listado General:** Renderiza la cuadrícula completa del catálogo.
  2. **Búsqueda por Código:** Formulario integrado que filtra dinámicamente un único producto recargando la vista visualmente.
  3. **Detalle (Ventana Flotante):** Despliega una vista emergente que muestra las especificaciones completas (precio, stock, categoría) de un producto al consultar su ID.

---

## 🌐 Panel de Control y Endpoints

Una vez que el frontend esté en marcha, puedes acceder a la interfaz gráfica desde tu navegador en el siguiente enlace:

- **URL de la Aplicación Frontend:** [http://localhost:8090](http://localhost:8090)

*(Asegúrate de que la variable de conexión en `apiGateway.php` esté apuntando correctamente a `http://localhost:8080` para comunicarse con el Backend).*

---

## 📄 Licencia

Distribuido bajo la licencia MIT. Consulta el archivo `LICENSE` para más información.