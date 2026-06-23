# taskflow-mvc-php

<p>
  <a href="#-español">Español</a> | 
  <a href="#-english">English</a>
</p>

---

## 🇪🇸 ESPAÑOL

[![PHP Version](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

Plataforma web orientada a la gestión de tareas personales, desarrollada bajo el patrón de arquitectura **MVC (Modelo-Vista-Controlador)** en PHP nativo. El sistema implementa un flujo completo de autenticación, autorización y persistencia de datos relacionales, garantizando un entorno privado y seguro para cada usuario.

### 🚀 Características Destacadas

* **Arquitectura MVC Robusta:** Separación estricta de responsabilidades (Modelos, Vistas y Controladores).
* **Seguridad y Autenticación:** * Registro e inicio de sesión seguro con encriptación de contraseñas mediante `password_hash()`.
  * Control de acceso y persistencia de estado a través de sesiones nativas de PHP (`session_start()`).
  * Protección de rutas críticas mediante un **Middleware de Autenticación** (`sessionAuthMiddleware`).
* **Operaciones CRUD Multi-usuario:** Gestión completa de tareas con aislamiento estricto de datos; cada usuario tiene acceso exclusivo a sus registros mediante relaciones en la base de datos (`id_usuario`).
* **Sistema de Prioridades y Estados:** Clasificación de tareas (escala 1-5) y control de estado (Pendiente / Completada).
* **Interfaz Responsiva:** UI limpia y minimalista construida con **Bootstrap**.

### 🛠️ Stack Tecnológico

* **Backend:** PHP (Programación Orientada a Objetos)
* **Base de Datos:** MySQL / MariaDB (Persistencia mediante **PDO** para mitigar ataques de inyección SQL)
* **Frontend:** HTML5, CSS3, Bootstrap

## 📐 Estructura de Ruteo, Seguridad y URLs Semánticas

El proyecto implementa un enrutador central dinámico que procesa las peticiones HTTP. Esta arquitectura permite el manejo de **URLs semánticas** (o amigables), lo que mejora la legibilidad de las rutas, abstrae los archivos físicos del servidor y delega el control de forma limpia según las reglas de negocio y los niveles de autorización requeridos:

| Acción (`action`) | Controlador / Método | Propósito | Acceso |
| :--- | :--- | :--- | :--- |
| `showLogin` | `AuthController -> showLogin()` | Renderiza la vista de inicio de sesión | Público |
| `signIn` | `AuthController -> createLogin()` | Procesa el registro de nuevos usuarios | Público |
| `login` | `AuthController -> login()` | Valida credenciales e inicia sesión | Público |
| `list` | `TaskController -> showTasks()` | Lista las tareas del usuario activo | 🔒 Autenticado |
| `new` | `TaskController -> addTask()` | Registra una nueva tarea en el sistema | 🔒 Autenticado |
| `edit` | `TaskController -> changeTask()` | Modifica los detalles de una tarea | 🔒 Autenticado |
| `done` | `TaskController -> finishTask()` | Marca una tarea como completada | 🔒 Autenticado |
| `delete` | `TaskController -> deleteTask()` | Elimina una tarea de forma permanente | 🔒 Autenticado |
| `seeMore` | `TaskController -> seeTask()` | Visualiza detalles de una tarea específica | Público / Autenticado |
| `logout` | `AuthController -> logout()` | Destruye la sesión activa | 🔒 Autenticado |


## 🔧 Configuración Local
1. Clonar el proyecto en la carpeta raíz de tu servidor local (htdocs o www).
2. Importar la Base de Datos: Crea una base de datos llamada db_tareas e importa el archivo ubicado en db/db_tareas.sql.
3. Configurar Conexión: Asegúrate de ajustar las credenciales de tu conexión PDO:  

```php
 $this->db = new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', ''); 
 ```  
4. Ejecutar: Inicia Apache y MySQL, luego accede a http://localhost/taskflow-mvc-php.


-----------------

## 🇬🇧 English

A web platform designed for personal task management, developed from scratch using the MVC (Model–View–Controller) architectural pattern in native PHP. The application implements a complete authentication, authorization, and relational data persistence workflow, providing a secure and private environment for every user.

### 🚀 Key Features

- **Robust MVC Architecture**
  - Clear separation of concerns through Models, Views, and Controllers.

- **Security & Authentication**
  - Secure user registration and login using password hashing with `password_hash()`.
  - Session-based authentication and state persistence via PHP native sessions (`session_start()`).
  - Protected routes enforced through a custom authentication middleware (`sessionAuthMiddleware`).

- **Multi-User CRUD Operations**
  - Complete task management system with strict user data isolation.
  - Users can only access and manage their own tasks through relational database ownership (`id_usuario`).

- **Priority & Status Management**
  - Task prioritization using a 1–5 scale.
  - Status tracking with **Pending** and **Completed** states.

- **Responsive User Interface**
  - Clean, modern, and responsive design built with Bootstrap.

### 🛠️ Tech Stack

- **Backend:** PHP (Object-Oriented Programming)
- **Database:** MySQL / MariaDB (PDO for secure database access and SQL injection prevention)
- **Frontend:** HTML5, CSS3, Bootstrap

## 📐 Centralized Routing, Security & Semantic URLs

The project implements a dynamic central router to handle HTTP requests. This architecture enables **semantic (user-friendly) URLs**, which enhances route readability, abstracts physical server files, and cleanly delegates control based on business logic and specific authorization levels:

| Action (`action`) | Controller / Method | Purpose | Access |
| :--- | :--- | :--- | :--- |
| `showLogin` | `AuthController -> showLogin()` | Renders the login view | Public |
| `signIn` | `AuthController -> createLogin()` | Processes new user registration | Public |
| `login` | `AuthController -> login()` | Validates credentials and starts session | Public |
| `list` | `TaskController -> showTasks()` | Lists tasks for the active user | 🔒 Authenticated |
| `new` | `TaskController -> addTask()` | Registers a new task in the system | 🔒 Authenticated |
| `edit` | `TaskController -> changeTask()` | Modifies task details | 🔒 Authenticated |
| `done` | `TaskController -> finishTask()` | Marks a task as completed | 🔒 Authenticated |
| `delete` | `TaskController -> deleteTask()` | Permanently deletes a task | 🔒 Authenticated |
| `seeMore` | `TaskController -> seeTask()` | Views details of a specific task | Public / Authenticated |
| `logout` | `AuthController -> logout()` | Destroys the active session | 🔒 Authenticated |

### 🔧 Local Setup

1. Clone the repository into your local server root directory (`htdocs` or `www`).

2. Create a database named `db_tareas` and import the SQL file located at:
db/db_tareas.sql

3. Configure the PDO database connection:

```php
$this->db = new PDO(
    'mysql:host=localhost;dbname=db_tareas;charset=utf8',
    'root',
    ''
);
```

Start the Apache and MySQL services.

Open the application in your browser:  http://localhost/taskflow-mvc-php