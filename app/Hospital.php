<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['city', 'name', 'three_a', 'top_dept_num', 'status'];

    protected $table = "hospitals";

    /**
     * @return mixed
     */
    public static function hospitalInfo()
    {
        return Hospital::select('hospitals.*', 'citys.name AS city')
            ->leftJoin('citys', 'citys.id', '=', 'hospitals.city_id')
            ->paginate(15);
    }
}
