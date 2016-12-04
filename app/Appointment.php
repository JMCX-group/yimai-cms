<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'locums_id',
        'confirm_locums_time',
        'patient_name',
        'patient_phone',
        'patient_gender',
        'patient_age',
        'patient_history',
        'patient_imgs',
        'doctor_id',
        'patient_id',
        'doctor_or_patient',
        'expect_visit_date',
        'expect_am_pm',
        'visit_time',
        'am_pm',
        'remark',
        'transaction_id',
        'confirm_admissions_time',
        'completed_rescheduled_time',
        'rescheduled_time',
        'new_visit_time',
        'new_am_pm',
        'confirm_rescheduled_time',
        'status'
    ];

    /**
     * 获得wait的
     *
     * @return mixed
     */
    public static function getWait()
    {
        return Appointment::select(
            'appointments.id', 'appointments.locums_id', 'appointments.doctor_id',
            'appointments.patient_name', 'appointments.patient_phone', 'appointments.patient_history',
            'appointments.price', 'appointments.status',
            'appointments.created_at', 'appointments.updated_at',
            'doctors.name AS doctor')
            ->leftJoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->whereIn('appointments.status', ['wait-0', 'wait-1', 'wait-2', 'wait-3', 'wait-4', 'wait-5'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }

    /**
     * 获得close和cancel的
     *
     * @return mixed
     */
    public static function getCloseAndCancel()
    {
        return Appointment::select(
            'appointments.id', 'appointments.locums_id', 'appointments.doctor_id',
            'appointments.patient_name', 'appointments.patient_phone', 'appointments.patient_history',
            'appointments.price', 'appointments.status',
            'appointments.created_at', 'appointments.updated_at',
            'doctors.name AS doctor')
            ->leftJoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->whereIn('appointments.status', ['close-1', 'close-2', 'close-3', 'cancel-1', 'cancel-2', 'cancel-3', 'cancel-4', 'cancel-5', 'cancel-6', 'cancel-7'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }

    /**
     * 获得completed的
     *
     * @return mixed
     */
    public static function getCompleted()
    {
        return Appointment::select(
            'appointments.id', 'appointments.locums_id', 'appointments.doctor_id',
            'appointments.patient_name', 'appointments.patient_phone', 'appointments.patient_history',
            'appointments.price', 'appointments.status',
            'appointments.created_at', 'appointments.updated_at',
            'doctors.name AS doctor')
            ->leftJoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->whereIn('appointments.status', ['completed-1', 'completed-2'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }
}
