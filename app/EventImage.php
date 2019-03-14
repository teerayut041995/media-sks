<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    protected $fillable = [
        'image_name','event_id'
    ];
}
