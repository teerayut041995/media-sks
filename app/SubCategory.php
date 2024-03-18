<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class SubCategory extends Model
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
            'sub_category_slug' => [
                'source' => 'sub_category_name',
                'onUpdate' => true,
            ]
        ];
    }
    protected $fillable = [
        'uid', 'sub_category_name', 'sub_category_slug', 'sub_category_ranking','sub_category_status','category_id'
    ];
}
