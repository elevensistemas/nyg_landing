<?php

namespace App\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Helpers\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::published();
        
        foreach ($categories as &$category) {
            $category['services'] = Service::getByCategory($category['id']);
        }
        unset($category);

        $this->render('servicios/index', compact('categories'));
    }

    public function show(string $servicioSlug)
    {
        $service = Service::findBySlug($servicioSlug);
        if (!$service || empty($service['is_published'])) {
            \Flight::notFound();
            return;
        }

        $categoryId = $service['service_category_id'];
        $serviceId = $service['id'];
        
        $related = DB::select("
            SELECT * FROM services 
            WHERE is_published = 1 
              AND id != :service_id 
              AND service_category_id = :category_id 
              AND deleted_at IS NULL 
            ORDER BY `order` ASC, `name` ASC 
            LIMIT 3
        ", ['service_id' => $serviceId, 'category_id' => $categoryId]);

        $this->render('servicios/show', [
            'service' => $service,
            'related' => $related
        ], $service['name'] . ' — NYG Transporte', $service['short_description']);
    }
}
