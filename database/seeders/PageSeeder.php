<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Crea las páginas institucionales con sus bloques editables. El texto de
     * "Empresa" reescribe, en tono comercial, el contenido ya publicado en el
     * sitio actual (quiénes somos, por qué elegirnos). No se agregan datos
     * numéricos ni certificaciones no confirmadas.
     */
    public function run(): void
    {
        $empresa = Page::query()->updateOrCreate(
            ['slug' => 'empresa'],
            ['title' => 'Empresa', 'template' => 'empresa', 'is_published' => true]
        );

        $empresaSections = [
            'historia' => [
                'title' => 'Trayectoria y Compromiso',
                'body' => 'NYG Transporte nació en 2018 con la convicción de ir más allá del traslado convencional de mercaderías. Nos propusimos redefinir la logística integral a través de un servicio que combina rigurosidad operativa, tecnología aplicada y una profunda vocación humana. Crecimos entendiendo que cada carga representa la confianza de un cliente, y respondemos a ella con dedicación absoluta.',
            ],
            'como-trabajamos' => [
                'title' => 'Cuidado Absoluto en Cada Kilómetro',
                'body' => 'En NYG, entendemos la logística como una cadena de valor donde las personas son lo primero. Cuidamos a nuestros choferes, colaboradores y comunidades en la ruta con la misma exigencia y esmero con los que custodiamos su producto. La seguridad, el respeto y la puntualidad no son variables negociables; son la base de cada viaje que emprendemos.',
            ],
            'mision' => [
                'title' => 'Misión',
                'body' => 'Brindar soluciones logísticas integrales y de alta eficiencia mediante una flota moderna y un monitoreo en tiempo real constante. Nos esforzamos por facilitar el crecimiento de nuestros clientes, garantizando tranquilidad, profesionalismo y trazabilidad total en cada etapa del camino.',
            ],
            'vision' => [
                'title' => 'Visión',
                'body' => 'Consolidarnos como el socio estratégico de logística integral de referencia en la región, reconocidos por nuestra integridad ética, la excelencia en la ejecución y nuestra capacidad de adaptarnos a los desafíos más complejos del mercado logístico nacional.',
            ],
            'valores' => [
                'title' => 'Valores Fundamentales',
                'body' => 'La confianza mutua, el comportamiento ético transparente y el compromiso con la sustentabilidad guían nuestras decisiones. Priorizamos la seguridad humana en el transporte terrestre, la flexibilidad ante imprevistos y la eficiencia operativa diaria para honrar la palabra dada a cada uno de nuestros socios comerciales.',
            ],
            'accion-social' => [
                'title' => 'Compromiso Social',
                'body' => 'Creemos firmemente en generar un impacto positivo en nuestro entorno. Por ello, colaboramos activamente facilitando fletes solidarios sin costo para entidades de bien público y organizaciones comunitarias acreditadas, aportando nuestra estructura logística al desarrollo social del país.',
            ],
        ];

        foreach ($empresaSections as $key => $data) {
            $empresa->sections()->updateOrCreate(['key' => $key], array_merge($data, ['is_published' => true]));
        }

        $tecnologia = Page::query()->updateOrCreate(
            ['slug' => 'tecnologia-y-seguimiento'],
            ['title' => 'Tecnología y seguimiento', 'template' => 'tecnologia', 'is_published' => true]
        );

        $tecnologia->sections()->updateOrCreate(['key' => 'intro'], [
            'title' => 'Cada envío visible. Cada decisión respaldada.',
            'body' => 'Todas las unidades de nuestra flota cuentan con sistemas de seguimiento satelital con recupero, que el cliente puede visualizar en tiempo real. Esto permite mantener informado al cliente sobre el estado de su envío durante toda la operación y reaccionar rápido ante cualquier imprevisto.',
            'is_published' => true,
        ]);
    }
}
