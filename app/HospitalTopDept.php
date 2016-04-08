<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HospitalTopDept extends Model
{
    protected $fillable = ['hospital_id', 'dept_standard_id'];

    protected $table = "hospital_top_dept";

    public $timestamps = false;
}
