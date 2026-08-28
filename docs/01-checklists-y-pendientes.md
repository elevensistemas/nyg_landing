# NYG Transporte — Checklists y pendientes

## 1. Checklist de despliegue

- [ ] Servidor con PHP 8.2+ y extensiones requeridas (ver README, sección 1).
- [ ] Base de datos MySQL creada y usuario con permisos configurado.
- [ ] `.env` completado con datos reales (dominio, SMTP, WhatsApp, credenciales de admin).
- [ ] `composer install --no-dev --optimize-autoloader` ejecutado sin errores.
- [ ] `npm install && npm run build` ejecutado, `public/build` generado.
- [ ] `php artisan migrate --force` ejecutado.
- [ ] `php artisan db:seed --force` ejecutado (o carga manual de contenido real).
- [ ] `php artisan storage:link` ejecutado.
- [ ] Permisos de `storage/` y `bootstrap/cache/` correctos para el usuario del servidor web.
- [ ] Certificado SSL activo y `APP_URL` en `https://`.
- [ ] Envío de correo probado (formulario de contacto y de cotización).
- [ ] Contraseña del administrador cambiada desde el valor por defecto.
- [ ] `php artisan config:cache route:cache view:cache` ejecutados en producción.
- [ ] Cron de Laravel configurado (`schedule:run` cada minuto).
- [ ] Backup de base de datos y `storage/app/public` programado.
- [ ] Verificación de que `/admin` no aparece indexado (robots.txt + `noindex` en las vistas admin).

## 2. Checklist de contenido pendiente

- [ ] Reemplazar el isotipo provisorio (recreación vectorial del águila) por el archivo oficial del logo de NYG en Configuración → `brand_logo_url`, usado en header, footer y favicon.
- [ ] Reemplazar las 3 imágenes del hero y de la sección de tecnología (`hero_slide_1_image`, `hero_slide_2_image`, `hero_slide_3_image` en Configuración) — hoy son ilustraciones generadas para maquetar el diseño, no fotos reales de la flota de NYG.
- [ ] Reemplazar los 12 logos placeholder de clientes por los archivos reales (Panel → Clientes → Editar).
- [ ] Confirmar y cargar fotografías reales de NYG (ver lista de fotografías recomendadas más abajo).
- [ ] Completar el horario de atención (`business_hours`) si NYG decide publicarlo.
- [ ] Revisar y, si corresponde, ampliar las respuestas de preguntas frecuentes con casos reales de consulta.
- [ ] Cargar sectores/industrias atendidas únicamente si son confirmados por NYG (tabla `industries`, queda vacía
      por defecto).
- [ ] Validar legalmente el contenido de privacidad, cookies y términos antes de publicar (textos base incluidos,
      marcados como editables).
- [ ] Decidir si se activa el banner de cookies (`cookie_banner_enabled` en Configuración) y su texto final.
- [ ] Revisar el copy de todas las páginas de servicio con el equipo de NYG antes de la publicación definitiva.

## 3. Datos a confirmar con NYG antes de publicar

1. **Teléfono/WhatsApp:** el sitio actual muestra "+54 9 11 7063 9810" como número visible, pero el enlace `tel:`
   apunta a "+54 9 11 3009-1907". Definir cuál es el número correcto y actualizarlo en Configuración → Contacto.
2. **Dirección:** el sitio actual indica oficina en "Blanco Encalada 1362, 2° 6°, Villa Madero", pero el mapa
   embebido apunta a "José Cubas 3999, Devoto". Confirmar si son dos ubicaciones distintas (oficina vs. depósito)
   o un error, y actualizar la dirección y el mapa según corresponda.
3. Horario de atención (no publicado actualmente).
4. Cantidad de vehículos, empleados, provincias cubiertas, certificaciones, porcentajes de entrega u otras métricas,
   en caso de que NYG quiera comenzar a comunicarlas (actualmente no se publica ninguna, y no se debe inventar).
5. Sectores/industrias atendidas, si se quiere publicar esa sección.
6. Condición y alcance exacto de "fletes sin cargo a entidades benéficas" (qué implica la "confirmación previa").
7. Alcance real del servicio de "transporte y gestión aduanera" (documentación requerida, tipos de operación).

## 4. Fotografías recomendadas para producir

Con foco en imágenes reales de la operación de NYG (sin matrículas legibles, sin rostros identificables sin
permiso, sin marcas de terceros visibles sin autorización):

1. Unidades de transporte de NYG (exterior), en ruta o en el depósito.
2. Interior de una unidad refrigerada / de carga, mostrando el tipo de mercadería habitual.
3. Conductores o equipo operativo en tareas de carga/descarga (con consentimiento para uso de imagen).
4. Depósito: vista general de estanterías/zona de almacenamiento.
5. Preparación de pedidos (picking) antes del despacho.
6. Operación de carga o descarga en un vehículo.
7. Panel o proceso de seguimiento de unidades (pantalla, sin datos sensibles de clientes visibles).
8. Oficinas de NYG (fachada o espacio de trabajo).
9. Atención al cliente (llamada, reunión o mostrador).
10. Momento de entrega final de mercadería.

Estas fotografías reemplazarían los espacios visuales del sitio (hero, sección de presentación, páginas de
servicio) que hoy usan composiciones tipográficas y de color en lugar de imágenes, a la espera del material real.
