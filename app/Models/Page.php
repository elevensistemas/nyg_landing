<?php

namespace App\Models;

use App\Helpers\DB;

class Page
{
    public static function findBySlug(string $slug): ?array
    {
        $page = DB::selectOne("SELECT * FROM pages WHERE slug = :slug LIMIT 1", ['slug' => $slug]);
        if ($page) {
            $page['sections'] = DB::select("SELECT * FROM page_sections WHERE page_id = :page_id ORDER BY `order` ASC", ['page_id' => $page['id']]);
        }
        return $page;
    }
}
