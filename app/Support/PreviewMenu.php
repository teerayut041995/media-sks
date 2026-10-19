<?php

namespace App\Support;

class PreviewMenu
{
    public static function all()
    {
        static $categories;

        if ($categories === null) {
            $categories = json_decode(file_get_contents(resource_path('data/category-menu-preview.json')), true);
        }

        return collect($categories);
    }
}
