<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptStandard extends Model
{
    protected $fillable = ['parent_id', 'name'];
    
    protected $table = "dept_standards";

    public function scopeParentDept($query)
    {
        return $query->where('parent_id', '=', 0);
    }
}
