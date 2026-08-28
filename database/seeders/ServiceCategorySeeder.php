<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Transporte', 'Almacenamiento y distribución', 'Comercio exterior'] as $i => $name) {
            ServiceCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'order' => $i, 'is_published' => true]
            );
        }
    }
}
