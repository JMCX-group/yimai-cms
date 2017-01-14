<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettlementRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settlement_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'total',
        'tax_payment',
        'tax_time',
        'year',
        'month',
        'status', //结算状态； 0：未缴税；1：已完成结算，可提现
        'withdraw_status', //提现状态，是否已提现；0为未提现，1为申请提现，9为成功
        'withdraw_bank_no',
        'withdraw_request_date',
        'withdraw_confirm_date'
    ];

    /**
     * 获取缴税和结算
     *
     * @param $status
     * @return mixed
     */
    public static function getSettlementRecord($status = 0)
    {
        return SettlementRecord::select('settlement_records.*', 'doctors.name AS doctor')
            ->leftJoin('doctors', 'doctors.id', '=', 'settlement_records.doctor_id')
            ->where('settlement_records.status', $status)//结算状态； 0：未缴税；1：已完成结算，可提现
            ->where('settlement_records.withdraw_status', 0)//提现状态：是否已提现；0为未提现，1为申请提现，9为成功
            ->where('doctors.auth', 'completed')//医生认证状态：completed：已认证；空：未认证；processing：认证中；fail：认证失败。
            ->paginate(15);
    }

    /**
     * 获取提现
     *
     * @param int $status
     * @return mixed
     */
    public static function getWithdrawRecord($status = 1)
    {
        return SettlementRecord::select('settlement_records.*', 'doctors.name AS doctor')
            ->leftJoin('doctors', 'doctors.id', '=', 'settlement_records.doctor_id')
            ->where('settlement_records.withdraw_status', $status)//提现状态：是否已提现；0为未提现，1为申请提现，9为成功
            ->where('doctors.auth', 'completed')//医生认证状态：completed：已认证；空：未认证；processing：认证中；fail：认证失败。
            ->paginate(15);
    }
}
