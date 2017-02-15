<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'citys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['province_id', 'name', 'code'];
    
    /**
     * @var bool
     */
    public $timestamps = false;
}
