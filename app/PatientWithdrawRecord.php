<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PatientWithdrawRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient_withdraw_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'total',
        'status', //提现状态，是否已提现；start为未提现，completed为成功，end为关闭
        'withdraw_bank_id', //提现的银行ID
        'withdraw_request_date', //提现申请日期
        'withdraw_confirm_date' //确认提现日期
    ];

    /**
     * 已经提现或已申请提现的
     *
     * @param $patientId
     * @return array
     */
    public static function alreadyWithdraw($patientId)
    {
        return DB::select("
            SELECT SUM(`total`) AS total 
            FROM `patient_withdraw_records` 
            WHERE patient_id=$patientId AND `status`!='end';
        ");
    }

    /**
     * @return mixed
     */
    public static function application()
    {
        return self::basicQuery('start');
    }

    /**
     * @return mixed
     */
    public static function completed()
    {
        return self::basicQuery('completed');
    }

    /**
     * @return mixed
     */
    public static function finish()
    {
        return self::basicQuery('end');
    }

    /**
     * @param $status
     * @return mixed
     */
    public static function basicQuery($status)
    {
        return PatientWithdrawRecord::select('patient_withdraw_records.*', 'patients.name AS patient_name')
            ->leftJoin('patients', 'patients.id', '=', 'patient_withdraw_records.patient_id')
            ->where('patient_withdraw_records.status', $status)//提现状态：start为未提现，completed为成功，end为关闭
            ->paginate(15);
    }
}
