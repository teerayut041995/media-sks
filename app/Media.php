<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Media extends Model implements ViewableContract
{
	use Viewable;

    protected $fillable = [
        'uid', 'project_name', 'topics', 'lecturer','description','embed_video','live_status','publishing_status','user_id'
    ];
}
