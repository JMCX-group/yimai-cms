<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['city', 'name', 'three_a', 'top_dept_num'];

    protected $table = "hospitals";
}
