<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * 登陆/登出
 */
Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@getLogout');
    });
});

/**
 * 后台管理 : 首页 | 用户管理 | 菜单管理 | 角色管理 | 权限管理
 */
Route::group(['namespace' => 'Backend', 'middleware' => ['auth','Entrust']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

    Route::resource('user', 'UserController');
    Route::resource('menu', 'MenuController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
});

/**
 * 数据管理 : 医院 | 科室 | 毕业院校 | 特长标签 | 医生数据 | 疾病 | 配置
 */
Route::group(['namespace' => 'Data', 'middleware' => ['auth','Entrust']], function () {
    Route::resource('hospital', 'HospitalController');
    Route::resource('dept', 'DeptStandardController');
    Route::resource('college', 'CollegeController');
    Route::resource('tag', 'TagController');
    Route::resource('core-doctor', 'CoreDoctorController');
    Route::resource('illness', 'IllnessController');

    /**
     * 配置管理：
     */
    Route::resource('config', 'ConfigController');
});

/**
 * 业务分组
 */
Route::group(['namespace' => 'Business', 'middleware' => ['auth','Entrust']], function () {
    /**
     * 用户管理 : 医生列表 | 患者列表
     */
    Route::resource('doctor', 'DoctorController');
    Route::resource('patient', 'PatientController');

    /**
     * 推送管理：Banner | Radio
     */
    Route::resource('banner', 'BannerController');
    Route::resource('radio', 'RadioController');

    /**
     * 名片申请
     */
    Route::group(['prefix' => 'card'], function () {
        Route::get('todo', ['as' => 'card.todo', 'uses' => 'CardController@todo']);
        Route::get('success', ['as' => 'card.success', 'uses' => 'CardController@success']);
        Route::get('failed', ['as' => 'card.failed', 'uses' => 'CardController@failed']);
    });
    Route::resource('card', 'CardController');

    /**
     * 医生认证 : 已认证 | 待审核 | 未认证 | 认证失败 | 拒绝认证
     */
    Route::group(['prefix' => 'verify'], function () {
        Route::get('already', ['as' => 'verify.already', 'uses' => 'VerifyController@already']);
        Route::get('todo', ['as' => 'verify.todo', 'uses' => 'VerifyController@todo']);
        Route::get('not', ['as' => 'verify.not', 'uses' => 'VerifyController@not']);
        Route::get('failed', ['as' => 'verify.failed', 'uses' => 'VerifyController@failed']);
        Route::get('edit', ['as' => 'verify.edit', 'uses' => 'VerifyController@edit']);
        Route::get('refuse/{verify}', ['as' => 'verify.refuse', 'uses' => 'VerifyController@refuse']);
    });
    Route::resource('verify', 'VerifyController'); // resource注册的路由需要放在自定义路由下方

    /**
     * 交易管理 : 待处理约诊 | 当面咨询 | 约诊-未完成 | 约诊-已完成 | 评价
     */
    Route::group(['prefix' => 'trade'], function () {
        Route::get('pending-appointment', ['as' => 'trade.pending-appointment', 'uses' => 'TradeController@pendingAppointment']);
        Route::get('face-to-face', ['as' => 'trade.face-to-face', 'uses' => 'TradeController@faceToFace']);
        Route::get('appointment-incomplete', ['as' => 'trade.appointment-incomplete', 'uses' => 'TradeController@appointmentIncomplete']);
        Route::get('appointment-completed', ['as' => 'trade.appointment-completed', 'uses' => 'TradeController@appointmentCompleted']);
        Route::get('evaluate', ['as' => 'trade.evaluate', 'uses' => 'TradeController@evaluate']);
    });

    /**
     * 代约管理 : 平台代约 | 确认平台代约
     */
    Route::group(['prefix' => 'appointment'], function () {
        Route::get('index', ['as' => 'appointment.index', 'uses' => 'AppointmentController@index']);
        Route::get('view/{appointment}', ['as' => 'appointment.view', 'uses' => 'AppointmentController@view']);
        Route::get('todo', ['as' => 'appointment.todo', 'uses' => 'AppointmentController@todo']);
        Route::get('processing', ['as' => 'appointment.processing', 'uses' => 'AppointmentController@processing']);
        Route::get('completed', ['as' => 'appointment.completed', 'uses' => 'AppointmentController@completed']);
        Route::get('failed', ['as' => 'appointment.failed', 'uses' => 'AppointmentController@failed']);
        Route::get('edit/{appointment}', ['as' => 'appointment.edit', 'uses' => 'AppointmentController@edit']);
        Route::get('refuse/{appointment}', ['as' => 'appointment.refuse', 'uses' => 'AppointmentController@refuse']);
    });
    Route::resource('appointment', 'AppointmentController'); // resource注册的路由需要放在自定义路由下方

    /**
     * 财务管理 : 税务管理（待缴税） / 结算管理（已结算） / 提现管理（申请提现/已提现） / 充值记录（患者）
     */
    Route::resource('tax', 'TaxController');
    Route::resource('settlement', 'SettlementController');
    Route::group(['prefix' => 'withdraw'], function () {
        Route::get('completed', ['as' => 'withdraw.completed', 'uses' => 'WithdrawController@completed']);
    });
    Route::resource('withdraw', 'WithdrawController');
    Route::resource('recharge', 'RechargeController');

    /**
     * 用户反馈 : 订单投诉 | 使用反馈
     */
    Route::group(['prefix' => 'feedback'], function () {
        Route::get('order-complaint', ['as' => 'feedback.order-complaint', 'uses' => 'FeedbackController@orderComplaint']);
        Route::get('app-use', ['as' => 'feedback.app-use', 'uses' => 'FeedbackController@appUse']);
    });
});
