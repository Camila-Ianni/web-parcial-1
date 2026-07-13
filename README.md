# Examen Final - Portales y Comercio Electrónico

Proyecto web desarrollado con Laravel 12.

## Tema

Boutique de outfits y accesorios inspirada en **Mean Girls**, con soporte para autenticación, roles de usuario, panel de administración protegido, subida de imágenes, circuito de compra completo con MercadoPago SDK, perfil de usuario editable y dashboard de estadísticas.

## Credenciales de Administrador

Para acceder al Panel de Administración protegido:
- **Email**: `admin@meangirls.com`
- **Contraseña**: `admin123`

## Credenciales de Usuario de Prueba (Común)

Usuario con pedidos e historial de compras ya generados por Seeder:
- **Email**: `test@example.com`
- **Contraseña**: `password`

## Credenciales Sandbox de MercadoPago

Para la prueba de la pasarela de pago en modo Sandbox, se preconfiguró la siguiente credencial de prueba:
- **Access Token**: `TEST-1448162810211929-071313-33ec00fcc792f42ad1b6a522325679e7-1274661593`

## Pasos para correr el proyecto

1. `composer install --ignore-platform-reqs`
2. Copiar `.env.example` a `.env` (ya preconfigura la base de datos SQLite y el token de MercadoPago)
3. `php artisan key:generate`
4. `php artisan migrate:fresh --seed`
5. `npm install`
6. `npm run build`
7. `php artisan serve`

## Características de la Entrega Final

1. **Circuito de Compra Completo**:
   - Carrito de compras funcional en el frontend.
   - Formulario de checkout interactivo solicitando dirección y teléfono (mínimo 5 campos propios en la base de datos).
   - Integración oficial con **MercadoPago SDK** redireccionando al checkout sandbox.
   - Callbacks oficiales de MercadoPago (`success`, `pending`, `failure`) para registrar el estado real del pedido.
2. **Perfil del Usuario**:
   - Página dedicada (`/perfil`) para modificar datos personales (Nombre, Email y Contraseña con validación).
   - Historial detallado de compras con desglose de ítems, precio histórico y estado del pago.
3. **Dashboard de Estadísticas en el Admin**:
   - Visualización de métricas del negocio: Facturación total acumulada, producto estrella (más vendido) y mes con mayor facturación.
   - Listado de usuarios con el total de compras realizadas y acceso a su ficha individual con el desglose de pedidos.
4. **Buenas Prácticas**:
   - Bloques PHPDocs estructurados en todos los controladores y modelos creados.
   - Suite de pruebas automatizadas completas en `tests/Feature/CheckoutTest.php` ejecutables mediante `vendor/bin/phpunit tests/Feature`.
