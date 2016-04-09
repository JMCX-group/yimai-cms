<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['city', 'name', 'three_a', 'top_dept_num', 'status'];

    protected $table = "hospitals";
}
