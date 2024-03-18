<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'category_slug' => [
                'source' => 'category_name',
                'onUpdate' => true,
            ]
        ];
    }
    protected $fillable = [
        'uid', 'category_name', 'category_slug', 'category_ranking','category_status'
    ];
}
