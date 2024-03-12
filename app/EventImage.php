<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    protected $fillable = [
       'uid', 'image_name','event_id'
    ];
}
