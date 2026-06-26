# Segundo Parcial - Portales y Comercio Electrónico

Proyecto web desarrollado con Laravel 12.

## Tema

Boutique de outfits y accesorios inspirada en **Mean Girls**, con soporte para autenticación, roles de usuario, panel de administración protegido, subida de imágenes y visualización de compras/servicios contratados.

## Credenciales de Administrador

Para acceder al Panel de Administración protegido:
- **Email**: `admin@meangirls.com`
- **Contraseña**: `admin123`

## Credenciales de Usuario de Prueba (Común)

Usuario con un servicio/compra ya contratado por Seeder:
- **Email**: `test@example.com`
- **Contraseña**: `password`

## Pasos para correr el proyecto

1. `composer install --ignore-platform-reqs`
2. Copiar `.env.example` a `.env`
3. Configurar la base de datos en `.env` (por defecto se incluye soporte SQLite portable)
4. `php artisan key:generate`
5. `php artisan migrate:fresh --seed`
6. `php artisan serve`

## Características Principales (Segundo Parcial)

1. **Autenticación y Roles**: Registro de usuarios comunes (Sign Up), inicio y cierre de sesión.
2. **Panel de Administración Protegido**: Rutas administrativas accesibles únicamente por usuarios administradores mediante el middleware personalizado `AdminMiddleware`.
3. **ABM de Blog con Upload de Imágenes**: Permite crear, editar y eliminar notas del blog. El formulario admite subir y cambiar imágenes reales que se guardan en la carpeta `public/uploads`.
4. **Relación de Base de Datos (Eloquent)**: Tabla pivot `purchases` para relacionar `users` con `products` (servicios/compras). El detalle individual de compras se puede ver en la ficha de cada usuario en el panel admin.
5. **Barra de Navegación Unificada**: Header coherente en todo el sitio con links a Home, Outfits, Blog, Login/Registro/Salir y botón de carrito interactivo 🛒 que funciona en tiempo real.
