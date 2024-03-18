<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Event extends Model implements ViewableContract
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
            'event_slug' => [
                'source' => 'event_name',
                'onUpdate' => true,
            ]
        ];
    }
    protected $fillable = [
        'uid', 'event_name', 'event_slug', 'event_image','event_date','event_location','event_description','publishing_status','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
