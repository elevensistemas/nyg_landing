# NYG Transporte — Sitio web y panel administrativo

Proyecto Laravel 11 del sitio corporativo de NYG Transporte: sitio público (institucional + comercial, orientado a
generar cotizaciones) y panel administrativo para gestionar servicios, clientes, FAQ, consultas y configuración
sin tocar código.

Ver también:
- `docs/00-resumen-ejecutivo-y-estrategia.md` — investigación, diagnóstico, propuesta y sistema visual.
- `docs/01-checklists-y-pendientes.md` — checklist de despliegue, contenido pendiente, datos a confirmar con NYG
  y fotografías recomendadas.

## 1. Requisitos del servidor

- PHP 8.2 o superior.
- Extensiones PHP: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd` (o `imagick`), `curl`.
- MySQL 8 (o MariaDB 10.6+).
- Composer 2.x.
- Node.js 18+ y NPM (solo para compilar assets; no se necesita en el servidor si se sube `public/build` ya compilado).
- Servidor web Apache o Nginx con `mod_rewrite` (Apache) o bloque de reescritura equivalente (Nginx).
- Certificado SSL (Let's Encrypt u otro).

## 2. Instalación paso a paso

```bash
# 1. Clonar/copiar el proyecto en el servidor
cd /var/www/nyg-transporte

# 2. Instalar dependencias PHP
composer install --no-dev --optimize-autoloader

# 3. Instalar dependencias de Node y compilar assets de producción
npm install
npm run build

# 4. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 5. Editar .env con los datos reales:
#    - APP_URL, DB_*, MAIL_*, WHATSAPP_NUMBER, ADMIN_EMAIL, ADMIN_PASSWORD

# 6. Crear la base de datos en MySQL
mysql -u root -p -e "CREATE DATABASE nyg_transporte CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 7. Crear el usuario de base de datos (ajustar credenciales)
mysql -u root -p -e "CREATE USER 'nyg_transporte'@'localhost' IDENTIFIED BY 'una-clave-segura';
GRANT ALL PRIVILEGES ON nyg_transporte.* TO 'nyg_transporte'@'localhost'; FLUSH PRIVILEGES;"

# 8. Ejecutar migraciones
php artisan migrate --force

# 9. Cargar datos iniciales (usuario admin, configuración, servicios, FAQ, legales)
php artisan db:seed --force

# 10. Crear el enlace simbólico de almacenamiento público
php artisan storage:link

# 11. Ajustar permisos de carpetas (usuario del servidor web, ej. www-data)
sudo chown -R www-data:www-data storage bootstrap/cache
sudo find storage bootstrap/cache -type d -exec chmod 775 {} \;
sudo find storage bootstrap/cache -type f -exec chmod 664 {} \;
```

## 3. Primer administrador

El seeder `AdminUserSeeder` crea el primer usuario administrador usando las variables `ADMIN_EMAIL` y
`ADMIN_PASSWORD` del `.env` (si no se definen, usa `admin@nygtransporte.com.ar` / `CambiarEstaClave123!`).

**Importante:** cambiá la contraseña por defecto apenas ingreses al panel (`/admin`), o definí `ADMIN_EMAIL` y
`ADMIN_PASSWORD` en el `.env` antes de correr el seeder en producción.

## 4. Configuración de Apache (VirtualHost de ejemplo)

```apache
<VirtualHost *:80>
    ServerName nygtransporte.com.ar
    ServerAlias www.nygtransporte.com.ar
    DocumentRoot /var/www/nyg-transporte/public

    <Directory /var/www/nyg-transporte/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/nyg-error.log
    CustomLog ${APACHE_LOG_DIR}/nyg-access.log combined
</VirtualHost>
```

Con Certbot: `sudo certbot --apache -d nygtransporte.com.ar -d www.nygtransporte.com.ar`

## 5. Configuración de Nginx (ejemplo)

```nginx
server {
    listen 80;
    server_name nygtransporte.com.ar www.nygtransporte.com.ar;
    root /var/www/nyg-transporte/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known) {
        deny all;
    }
}
```

Con Certbot: `sudo certbot --nginx -d nygtransporte.com.ar -d www.nygtransporte.com.ar`

## 6. Configuración de dominio y SSL

1. Apuntar el registro A del dominio al servidor.
2. Configurar el VirtualHost/server block (arriba).
3. Emitir certificado SSL con Certbot (Let's Encrypt) o el proveedor elegido.
4. Verificar `APP_URL=https://nygtransporte.com.ar` en `.env` y `SESSION_SECURE_COOKIE=true`.

## 7. Configuración de SMTP

Completar en `.env`: `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`,
`MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME` y `MAIL_NOTIFY_ADDRESS` (correo interno que recibe copia de cada consulta).
Probar el envío con `php artisan tinker` → `Mail::raw('prueba', fn($m) => $m->to('vos@ejemplo.com')->subject('test'));`.

## 8. Comandos de caché para producción

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

Para limpiar todo (por ejemplo antes de una actualización):

```bash
php artisan optimize:clear
```

## 9. Cron de Laravel (programador de tareas)

Agregar al crontab del usuario del servidor web:

```
* * * * * cd /var/www/nyg-transporte && php artisan schedule:run >> /dev/null 2>&1
```

Actualmente no hay tareas programadas críticas, pero se deja el cron configurado para futuras necesidades
(por ejemplo, limpieza periódica de adjuntos o reportes).

## 10. Colas (queues)

El proyecto usa `QUEUE_CONNECTION=database` en `.env.example`. Si se decide procesar el envío de correos en
segundo plano (recomendado para no demorar el formulario en caso de SMTP lento), correr:

```bash
php artisan queue:work --tries=3 --daemon
```

y gestionarlo con Supervisor para que se reinicie automáticamente. Como alternativa, los `Mailable` actuales se
envían de forma síncrona con manejo de errores (ver `App\Http\Controllers\QuoteController` y `ContactController`),
por lo que el formulario funciona igual sin colas activas.

## 11. Procedimiento de actualización

```bash
php artisan down
git pull   # o el mecanismo de despliegue que corresponda
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan up
```

## 12. Backups

- **Base de datos:** `mysqldump -u nyg_transporte -p nyg_transporte > backup-$(date +%F).sql`, programado diariamente
  vía cron y almacenado fuera del servidor (ej. bucket S3 u otro almacenamiento externo).
- **Archivos:** respaldar `storage/app/public` (logos de clientes, adjuntos de cotizaciones, imágenes de servicios)
  con la misma frecuencia.
- Mantener al menos 7 backups diarios y 4 semanales.

## 13. Solución de problemas comunes

| Problema | Causa probable | Solución |
|---|---|---|
| Error 500 al abrir el sitio | `APP_KEY` vacía o permisos de `storage/` | Correr `php artisan key:generate` y revisar permisos |
| Imágenes/logos no se ven | Falta el enlace simbólico de storage | Correr `php artisan storage:link` |
| El formulario no envía correos | SMTP mal configurado | Revisar `.env` y probar con `php artisan tinker` |
| Estilos o JS no cargan | Assets no compilados | Correr `npm run build` y verificar `public/build` |
| "419 Page Expired" al enviar formularios | Sesión expirada / caché de config vieja | `php artisan config:clear` y reintentar |
| Cambios de código no se reflejan | Caché de vistas/rutas de producción | `php artisan optimize:clear` y volver a cachear |

## 14. Arquitectura del proyecto

- **Backend:** Laravel 11, PHP 8.2+, Eloquent ORM, Blade.
- **Base de datos:** MySQL (ver migraciones en `database/migrations`).
- **Frontend:** Bootstrap 5, SCSS (`resources/css`), JavaScript modular sin frameworks pesados (`resources/js/modules`).
- **Panel administrativo:** rutas bajo `/admin`, protegidas por los middleware `auth` + `admin`
  (`App\Http\Middleware\EnsureUserIsAdmin`).
- **Formularios:** `App\Http\Requests\StoreQuoteRequestRequest` y `StoreContactRequestRequest` validan en el
  servidor; el JavaScript solo mejora la experiencia (formulario por pasos, envío por fetch), nunca reemplaza la
  validación backend.
- **Correo:** `App\Mail\QuoteRequestReceived`, `QuoteRequestConfirmation` y `ContactRequestReceived`, con plantillas
  Markdown en `resources/views/emails`.
- **SEO:** metadatos por página en cada vista Blade, sitemap dinámico en `/sitemap.xml`
  (`App\Http\Controllers\SitemapController`), `robots.txt` estático, datos estructurados `schema.org` en el layout
  principal y en la página de preguntas frecuentes.

## 15. Datos de demostración

El seeder `DatabaseSeeder` carga: un usuario administrador, la configuración base (contacto, redes, textos del
hero), las categorías y los 8 servicios descritos en el sitio actual de NYG, los 12 clientes ya publicados (con
logos placeholder a reemplazar desde el panel), 10 preguntas frecuentes y 3 páginas legales base. Todo el contenido
proviene de lo verificado en `nygtransporte.com.ar`; no incluye métricas, certificaciones ni testimonios inventados.
