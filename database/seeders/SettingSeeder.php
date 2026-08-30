<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Todos los valores acá provienen del sitio actual (nygtransporte.com.ar).
     * Los marcados "A CONFIRMAR" tienen una inconsistencia detectada en la
     * investigación y deben validarse con NYG antes de publicar (ver
     * docs/01-checklists-y-pendientes.md).
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'contact_email', 'value' => 'info@nygtransporte.com.ar', 'type' => 'text', 'group' => 'contacto', 'label' => 'Correo de contacto'],
            ['key' => 'contact_phone_display', 'value' => '+54 9 11 7063 9810', 'type' => 'text', 'group' => 'contacto', 'label' => 'Teléfono visible (A CONFIRMAR: difiere del número usado en el enlace tel: del sitio actual)'],
            ['key' => 'whatsapp_number', 'value' => env('WHATSAPP_NUMBER', '5491178560714'), 'type' => 'text', 'group' => 'contacto', 'label' => 'WhatsApp (formato internacional, sin signos)'],
            ['key' => 'address', 'value' => 'José Cubas 3999, Devoto, Cap. Fed.', 'type' => 'text', 'group' => 'contacto', 'label' => 'Dirección de oficina'],
            ['key' => 'business_hours', 'value' => '', 'type' => 'text', 'group' => 'contacto', 'label' => 'Horario de atención (pendiente de confirmar, no publicado por NYG)'],
            ['key' => 'facebook_url', 'value' => 'https://www.facebook.com/nygtransporteok/', 'type' => 'text', 'group' => 'redes', 'label' => 'Facebook'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/nyg_transporte/', 'type' => 'text', 'group' => 'redes', 'label' => 'Instagram'],
            ['key' => 'rnpsp', 'value' => '1117', 'type' => 'text', 'group' => 'institucional', 'label' => 'N° de registro R.N.P.S.P'],
            ['key' => 'operating_since', 'value' => '2018', 'type' => 'text', 'group' => 'institucional', 'label' => 'Operando desde'],
            ['key' => 'hero_tagline', 'value' => 'Soluciones de logística integral', 'type' => 'text', 'group' => 'home', 'label' => 'Etiqueta superior del hero'],
            ['key' => 'hero_title', 'value' => 'Logística bajo control. De principio a fin.', 'type' => 'text', 'group' => 'home', 'label' => 'Título del hero'],
            ['key' => 'hero_text', 'value' => 'Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.', 'type' => 'textarea', 'group' => 'home', 'label' => 'Texto del hero'],

            // Logo y slides del hero. Las imágenes de flota/tecnología son ilustraciones
            // generadas para maquetar el diseño (no son fotos reales de la flota de NYG):
            // reemplazar por fotografía real desde el panel apenas esté disponible
            // (ver docs/01-checklists-y-pendientes.md).
            ['key' => 'brand_logo_url', 'value' => 'https://d8j0ntlcm91z4.cloudfront.net/user_3Gn0d8P6RXU669yyC14C6pUmlZr/hf_20260801_220647_4a5a91cb-6694-4ae6-958a-31709d360285.svg', 'type' => 'text', 'group' => 'marca', 'label' => 'Isotipo (recreación provisoria del logo — reemplazar por el archivo oficial)'],
            ['key' => 'hero_slide_1_image', 'value' => 'https://d8j0ntlcm91z4.cloudfront.net/user_3Gn0d8P6RXU669yyC14C6pUmlZr/hf_20260801_220649_c3789dd6-387b-43ca-8d3d-a71e2798e4fc.png', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 1 — Imagen (flota, ilustrativa)'],
            ['key' => 'hero_slide_1_tagline', 'value' => 'Soluciones de logística integral', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 1 — Etiqueta'],
            ['key' => 'hero_slide_1_title', 'value' => 'Logística bajo control. De principio a fin.', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 1 — Título'],
            ['key' => 'hero_slide_1_text', 'value' => 'Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.', 'type' => 'textarea', 'group' => 'home', 'label' => 'Slide 1 — Texto'],
            ['key' => 'hero_slide_2_image', 'value' => 'https://d8j0ntlcm91z4.cloudfront.net/user_3Gn0d8P6RXU669yyC14C6pUmlZr/hf_20260801_220651_c4d07235-3302-47c2-ae08-446f2c67b66c.png', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 2 — Imagen (unidad, ilustrativa)'],
            ['key' => 'hero_slide_2_tagline', 'value' => 'Flota preparada para cada carga', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 2 — Etiqueta'],
            ['key' => 'hero_slide_2_title', 'value' => 'La unidad correcta para cada operación.', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 2 — Título'],
            ['key' => 'hero_slide_2_text', 'value' => 'Desde cargas completas hasta transporte refrigerado: coordinamos la unidad y el equipo adecuados para cada tipo de mercadería.', 'type' => 'textarea', 'group' => 'home', 'label' => 'Slide 2 — Texto'],
            ['key' => 'hero_slide_3_image', 'value' => '/images/mapa_argentina_red.jpg', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 3 — Imagen (tecnología, ilustrativa)'],
            ['key' => 'hero_slide_3_tagline', 'value' => 'Tecnología', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 3 — Etiqueta'],
            ['key' => 'hero_slide_3_title', 'value' => 'Cada envío visible. Cada decisión respaldada.', 'type' => 'text', 'group' => 'home', 'label' => 'Slide 3 — Título'],
            ['key' => 'hero_slide_3_text', 'value' => 'Seguimiento satelital con recupero, visible en tiempo real, para que sepas siempre en qué etapa está tu operación.', 'type' => 'textarea', 'group' => 'home', 'label' => 'Slide 3 — Texto'],
            ['key' => 'social_action_text', 'value' => 'Ofrecemos fletes sin cargo a entidades benéficas, previa confirmación de la operación.', 'type' => 'textarea', 'group' => 'home', 'label' => 'Texto de acción social'],
            ['key' => 'cookie_banner_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'legales', 'label' => 'Mostrar aviso de cookies'],
        ];

        foreach ($settings as $setting) {
            Setting::query()->updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
