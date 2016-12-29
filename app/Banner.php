<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";

    protected $fillable = [
        'title',
        'focus_img_url',
        'content',
        'location',
        'd_or_p',
        'status'
    ];
}
