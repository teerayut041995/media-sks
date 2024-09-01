<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Post extends Model implements ViewableContract
{
    use Viewable;
	use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'post_slug' => [
                'source' => 'post_title',
                'onUpdate' => true,
            ]
        ];
    }
    protected $fillable = [
       'uid', 'user_id', 'category_id', 'sub_category_id','post_title','post_slug', 'post_youtube_embed', 'post_youtube_link', 'post_image', 'post_image_thumbnail_file_name', 'post_detail','post_content','post_status'
    ];
}
