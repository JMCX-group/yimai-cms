<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'password',
        'name',
        'nickname',
        'gender',
        'birthday',
        'province_id',
        'city_id',
        'tag_list',
        'my_doctors',
    ];

    /**
     * Get patients.
     *
     * @return mixed
     */
    public static function getPatients()
    {
        return Patient::select(
            'patients.id', 'patients.name', 'patients.phone', 'patients.gender',
            'patients.province_id', 'patients.city_id',
            'provinces.name AS province', 'citys.name AS city')
            ->leftJoin('provinces', 'provinces.id', '=', 'patients.province_id')
            ->leftJoin('citys', 'citys.id', '=', 'patients.city_id')
            ->paginate(15);
    }
}
