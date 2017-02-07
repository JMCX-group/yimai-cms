<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PatientRechargeRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient_recharge_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'out_trade_no',
        'total_fee',
        'body',
        'detail',
        'time_start',
        'time_expire',
        'ret_data',
        'source',
        'status',
        'settlement_status'
    ];

    /**
     * 获取某用户充值总额
     *
     * @param $userId
     * @return mixed
     */
    public static function rechargeTotal($userId)
    {
        return DB::select("
            SELECT SUM(`total_fee`) AS total 
            FROM `patient_recharge_records` 
            WHERE patient_id=$userId AND `status`='end';
        ");
    }

    /**
     * 分页取充值记录
     *
     * @return mixed
     */
    public static function getRecords()
    {
        return PatientRechargeRecord::select('patient_recharge_records.*', 'patients.name AS patient', 'patients.phone AS phone')
            ->leftJoin('patients', 'patients.id', '=', 'patient_recharge_records.patient_id')
            ->paginate(15);
    }
}
