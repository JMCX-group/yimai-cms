<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreDoctor extends Model
{
    protected $fillable = ['name', 'phone', 'city', 'hospital', 'dept', 'level', 'invite', 'online_status', 'online_time'];

    protected $table = "core_doctors";
}
