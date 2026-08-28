<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;

class LegalPageSeeder extends Seeder
{
    /**
     * Contenido legal base, genérico y adaptable. IMPORTANTE: debe ser
     * revisado y validado por un profesional legal antes de su publicación
     * definitiva (ver docs/01-checklists-y-pendientes.md).
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'politica-de-privacidad',
                'title' => 'Política de privacidad',
                'content' => "<p>Esta política describe cómo NYG Transporte recolecta, utiliza y protege los datos personales enviados a través de este sitio web (formularios de contacto y de cotización).</p>".
                    "<h2>Datos que recolectamos</h2><p>Nombre, empresa, correo electrónico, teléfono y demás datos que el usuario decida incluir en los formularios, incluyendo archivos adjuntos opcionales.</p>".
                    "<h2>Uso de los datos</h2><p>Los datos se utilizan exclusivamente para responder consultas comerciales y elaborar propuestas de servicio. No se comparten con terceros salvo obligación legal.</p>".
                    "<h2>Conservación</h2><p>Los datos se conservan mientras exista una relación comercial vigente o potencial, y pueden eliminarse a pedido del titular.</p>".
                    "<p><em>Este texto es una base editable y debe ser revisado por un profesional legal antes de su publicación definitiva.</em></p>",
            ],
            [
                'slug' => 'politica-de-cookies',
                'title' => 'Política de cookies',
                'content' => "<p>Este sitio utiliza cookies técnicas necesarias para su funcionamiento (por ejemplo, mantener la sesión del panel administrativo) y, opcionalmente, cookies de análisis.</p>".
                    "<p>Podés gestionar o deshabilitar las cookies desde la configuración de tu navegador.</p>".
                    "<p><em>Este texto es una base editable y debe ser revisado por un profesional legal antes de su publicación definitiva.</em></p>",
            ],
            [
                'slug' => 'terminos-y-condiciones',
                'title' => 'Términos y condiciones',
                'content' => "<p>El uso de este sitio web implica la aceptación de los presentes términos. La información publicada tiene fines informativos y comerciales; las condiciones definitivas de cada servicio se establecen en la cotización y/o contrato correspondiente.</p>".
                    "<p><em>Este texto es una base editable y debe ser revisado por un profesional legal antes de su publicación definitiva.</em></p>",
            ],
        ];

        foreach ($pages as $page) {
            LegalPage::query()->updateOrCreate(['slug' => $page['slug']], array_merge($page, [
                'is_published' => true,
            ]));
        }
    }
}
