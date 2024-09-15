<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'uid',
        'service_name',
        'service_type',
        'service_description',
        'service_mission',
        'service_learning_activity',
        'service_contact_phone_number',
        'service_contact_name',
        'service_address',
        'service_embed_map',
        'service_sequence',
        'service_status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];
}