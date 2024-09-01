<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'uid',
        'banner_name',
        'banner_file_name',
        'banner_title',
        'banner_description',
        'banner_first_link',
        'banner_first_link_text',
        'banner_second_link',
        'banner_second_link_text',
        'banner_sequence',
        'banner_status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];
}
