# 🚀 API REST - Gestión de Productos y Categorías (Backend)

Backend desarrollado en **Laravel** con arquitectura RESTful para la gestión de inventario, productos y categorías, incluyendo validación de integridad referencial y registro de actividad.

> 🔗 **Repositorio Frontend asociado:** [https://github.com/JOANYA/fulstack-fronted](https://github.com/JOANYA/fulstack-fronted)

---

## 🛠️ Tecnologías Utilizadas

* **PHP** >= 8.1
* **Laravel** 10 / 11
* **MySQL** / MariaDB
* **Spatie Activitylog** (Auditoría de cambios)
* **Swagger / L5-Swagger** (Documentación de API)

---

## 📋 Requisitos Previos

Asegúrate de tener instalado en tu entorno local o servidor:
* PHP y Composer
* Servidor de base de datos MySQL (XAMPP, Laragon, Docker o servicio nativo)
* Git

---

## ⚙️ Instalación y Ejecución Local

Sigue estos pasos para levantar el proyecto en tu máquina local:

### 1. Clonar el repositorio
```bash
git clone https://github.com/JOANYA/fullsctack-backend.git
cd fullsctack-backend
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar las variables de entorno
Copia el archivo de ejemplo `.env.example` para crear tu archivo `.env`:
```bash
cp .env.example .env
```

Abre el archivo `.env` y configura los datos de conexión a tu base de datos MySQL:
```env
APP_NAME="Gestion Productos API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_gestion_productos
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5. Ejecutar migraciones (o importar el script SQL)
Si utilizas migraciones de Laravel:
```bash
php artisan migrate --seed
```
*(Opcional)* Si vas a utilizar el script SQL manual proporcionado, crea la base de datos `db_gestion_productos` en tu gestor MySQL e importa el archivo `.sql`.

### 6. Configurar CORS (Importante para conectar con Vue)
Asegúrate de que en `config/cors.php` estén permitidas las peticiones desde tu frontend:
```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_origins' => ['http://localhost:5173', '*'], // En producción, coloca la URL exacta de tu frontend
```

### 7. Levantar el servidor de desarrollo
```bash
php artisan serve
```
La API estará disponible en: `http://127.0.0.1:8000/api`

---

## 📡 Endpoints Principales

| Método | Endpoint | Descripción |
| :--- | :--- | :--- |
| `GET` | `/api/dashboard` | Obtiene métricas generales y productos con bajo stock. |
| `GET` | `/api/products` | Lista todos los productos con su categoría asociada. |
| `POST` | `/api/products` | Crea un nuevo producto. |
| `PUT` | `/api/products/{id}` | Actualiza un producto existente. |
| `DELETE` | `/api/products/{id}` | Elimina un producto. |
| `GET` | `/api/categories` | Lista todas las categorías con el conteo de productos. |
| `POST` | `/api/categories` | Crea una nueva categoría. |
| `PUT` | `/api/categories/{id}` | Edita una categoría existente. |
| `DELETE` | `/api/categories/{id}` | Elimina una categoría (bloqueado si tiene productos asociados). |

---

## 🌐 Notas para Despliegue (Deploy)

1. Cambia `APP_ENV=production` y `APP_DEBUG=false` en el archivo `.env` del servidor.
2. Ejecuta los comandos de optimización de Laravel:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. Asegúrate de que el servidor web (Nginx o Apache) apunte a la carpeta `/public` del proyecto.