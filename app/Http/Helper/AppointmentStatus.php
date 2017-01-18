<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/8/18
 * Time: 下午5:00
 */
namespace App\Http\Helper;

/**
 * 约诊状态翻译
 *
 * Class GetDoctor
 * @package App\Api\Helper
 */
class AppointmentStatus
{
    /**
     * 约诊消息推送文案
     *
     * @param $data
     * @return bool|string
     */
    public static function appointmentMsgContent($data)
    {
        switch ($data->status) {
            /**
             * wait:
             * wait-0: 待代约医生确认
             * wait-1: 待患者付款
             * wait-2: 患者已付款，待医生确认
             * wait-3: 医生确认接诊，待面诊
             * wait-4: 医生改期，待患者确认
             * wait-5: 患者确认改期，待面诊
             */
            case 'wait-0':
                $retText = '患者' . $data['patient_name'] . '请求您代约';
                break;

            case 'wait-1':
                $retText = '您替' . $data['patient_name'] . '约诊' . $data['doctor_name'] . '医生的信息已发送至' . $data['patient_name'] . '，等待确认及支付。若12小时内未完成支付则约诊失效。';
                break;

            case 'wait-2':
                $retText = '患者' . $data['patient_name'] . '已付款。';
                break;

            case 'wait-3':
                break;

            case 'wait-4':
                break;

            case 'wait-5':
                break;

            /**
             * close:
             * close-1: 待患者付款
             * close-2: 医生过期未接诊,约诊关闭
             * close-3: 医生拒绝接诊
             */
            case 'close-1':
                break;

            case 'close-2':
                break;

            case 'close-3':
                $retText = '医生' . $data['doctor_name'] . '拒绝了接诊。';
                break;

            /**
             * cancel:
             * cancel-1: 患者取消约诊; 未付款
             * cancel-2: 医生取消约诊
             * cancel-3: 患者取消约诊; 已付款后
             * cancel-4: 医生改期之后,医生取消约诊;
             * cancel-5: 医生改期之后,患者取消约诊;
             * cancel-6: 医生改期之后,患者确认之后,患者取消约诊;
             * cancel-7: 医生改期之后,患者确认之后,医生取消约诊;
             */
            case 'cancel-2':
            case 'cancel-4':
            case 'cancel-7':
                $retText = '医生' . $data['doctor_name'] . '取消了约诊请求。';
                break;

            case 'cancel-1':
            case 'cancel-3':
            case 'cancel-5':
            case 'cancel-6':
                $retText = '患者' . $data['patient_name'] . '取消了约诊请求。';
                break;

            /**
             * completed:
             * completed-1:最简正常流程
             * completed-2:改期后完成
             */
            case 'completed-1':
                break;

            case 'completed-2':
                break;

            default:
                $retText = false;
                break;
        }

        return $retText;
    }

    /**
     * 接诊消息推送文案
     *
     * @param $data
     * @return bool|string
     */
    public static function admissionsMsgContent($data)
    {
        switch ($data->status) {
            /**
             * wait:
             * wait-0: 待代约医生确认
             * wait-1: 待患者付款
             * wait-2: 患者已付款，待医生确认
             * wait-3: 医生确认接诊，待面诊
             * wait-4: 医生改期，待患者确认
             * wait-5: 患者确认改期，待面诊
             */
            case 'wait-0':
                $retText = '患者' . $data['patient_name'] . '请求您代约。';
                break;

            case 'wait-1':
                break;

            case 'wait-2':
                $retText = '您收到一条'.$data['locums_name'].'替患者'.$data['patient_name'].'发起的约诊请求（预约号'.$data['appointment_id'].'），请在48小时内处理.';
                break;

            case 'wait-3':
                $retText = '患者' . $data['patient_name'] . '已付款。';
                break;

            case 'wait-4':
                break;

            case 'wait-5':
                break;

            /**
             * close:
             * close-1: 待患者付款
             * close-2: 医生过期未接诊,约诊关闭
             * close-3: 医生拒绝接诊
             */
            case 'close-1':
                break;

            case 'close-2':
                break;

            case 'close-3':
                break;

            /**
             * cancel:
             * cancel-1: 患者取消约诊; 未付款
             * cancel-2: 医生取消约诊
             * cancel-3: 患者取消约诊; 已付款后
             * cancel-4: 医生改期之后,医生取消约诊;
             * cancel-5: 医生改期之后,患者取消约诊;
             * cancel-6: 医生改期之后,患者确认之后,患者取消约诊;
             * cancel-7: 医生改期之后,患者确认之后,医生取消约诊;
             */
            case 'cancel-2':
            case 'cancel-4':
            case 'cancel-7':
                break;

            case 'cancel-1':
            case 'cancel-3':
            case 'cancel-5':
            case 'cancel-6':
                $retText = '患者' . $data['patient_name'] . '取消了约诊请求。';
                break;

            /**
             * completed:
             * completed-1:最简正常流程
             * completed-2:改期后完成
             */
            case 'completed-1':
                break;

            case 'completed-2':
                break;

            default:
                $retText = false;
                break;
        }

        return $retText;
    }

    /**
     * 约诊状态文案
     *
     * @param $status
     * @return string
     */
    public static function content($status)
    {

        switch ($status) {
            case 'wait-0':
                $retData = '待代约医生确认';
                break;
            case 'wait-1':
                $retData = '待患者付款';
                break;
            case 'wait-2':
                $retData = '患者已付款，待医生确认';
                break;
            case 'wait-3':
                $retData = '医生确认接诊，待面诊';
                break;
            case 'wait-4':
                $retData = '医生改期，待患者确认';
                break;
            case 'wait-5':
                $retData = '患者确认改期，待面诊';
                break;

            case 'close-1':
                $retData = '待患者付款';
                break;
            case 'close-2':
                $retData = '医生过期未接诊,约诊关闭';
                break;
            case 'close-3':
                $retData = '医生拒绝接诊';
                break;

            case 'cancel-1':
                $retData = '患者取消约诊; 未付款';
                break;
            case 'cancel-2':
                $retData = '医生取消约诊';
                break;
            case 'cancel-3':
                $retData = '患者取消约诊; 已付款后';
                break;
            case 'cancel-4':
                $retData = '医生改期之后,医生取消约诊';
                break;
            case 'cancel-5':
                $retData = '医生改期之后,患者取消约诊';
                break;
            case 'cancel-6':
                $retData = '医生改期之后,患者确认之后,患者取消约诊';
                break;
            case 'cancel-7':
                $retData = '医生改期之后,患者确认之后,医生取消约诊';
                break;

            case 'completed-1':
                $retData = '已完成';
                break;
            case 'completed-2':
                $retData = '改期后完成';
                break;

            default:
                $retData = '';
                break;
        }

        return $retData;
    }

    /**
     * 约诊推送文案
     *
     * @param $status
     * @return string
     */
    public static function pushContent($status)
    {

        switch ($status) {
            case 'wait-0':
                $retData = '有患者请求您代约';
                break;
            case 'wait-1':
                $retData = '您有新的约诊订单需要支付';
                break;
            case 'wait-2':
                $retData = '患者已付款，待医生确认';
                break;
            case 'wait-3':
                $retData = '医生确认接诊，待面诊';
                break;
            case 'wait-4':
                $retData = '医生改期，待患者确认';
                break;
            case 'wait-5':
                $retData = '患者确认改期，待面诊';
                break;

            case 'close-1':
                $retData = '待患者付款';
                break;
            case 'close-2':
                $retData = '医生过期未接诊,约诊关闭';
                break;
            case 'close-3':
                $retData = '医生拒绝接诊';
                break;

            case 'cancel-1':
                $retData = '患者取消约诊; 未付款';
                break;
            case 'cancel-2':
                $retData = '医生取消约诊';
                break;
            case 'cancel-3':
                $retData = '患者取消约诊; 已付款后';
                break;
            case 'cancel-4':
                $retData = '医生改期之后,医生取消约诊';
                break;
            case 'cancel-5':
                $retData = '医生改期之后,患者取消约诊';
                break;
            case 'cancel-6':
                $retData = '医生改期之后,患者确认之后,患者取消约诊';
                break;
            case 'cancel-7':
                $retData = '医生改期之后,患者确认之后,医生取消约诊';
                break;

            case 'completed-1':
                $retData = '已完成';
                break;
            case 'completed-2':
                $retData = '改期后完成';
                break;

            default:
                $retData = '';
                break;
        }

        return $retData;
    }
}
