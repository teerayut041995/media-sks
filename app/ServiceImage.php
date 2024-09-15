<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $fillable = [
        'uid',
        'service_uid',
        'service_image_name',
        'service_image_file_name',
        'service_image_type',
        'service_image_sequence',
        'service_image_status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
        'service_uid' => 'string',
    ];
}
