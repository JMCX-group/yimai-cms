<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['dept_id', 'dept_lv2_id', 'name', 'hot', 'status'];
}
