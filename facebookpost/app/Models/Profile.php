<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [

        'name',
        'email',
        'description',
        'hashtags',
        'tags',
        'status',
        'schedule_time',
        'images',
        'videos',
        'platforms',
        'facebook_post_id',
        'facebook_post_url',

    ];
}