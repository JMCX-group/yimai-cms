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
 * 数据管理 : 医院 | 科室 | 毕业院校 | 特长标签 | 医生数据 | 疾病
 */
Route::group(['namespace' => 'Data', 'middleware' => ['auth','Entrust']], function () {
    Route::resource('hospital', 'HospitalController');
    Route::resource('dept', 'DeptStandardController');
    Route::resource('college', 'CollegeController');
    Route::resource('tag', 'TagController');
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
     * 医生认证 : 已认证 | 待认证 | 未认证 | 待审核头像
     */
    Route::group(['prefix' => 'verify'], function () {
        Route::get('already', ['as' => 'verify.already', 'uses' => 'VerifyController@already']);
        Route::get('todo', ['as' => 'verify.todo', 'uses' => 'VerifyController@todo']);
        Route::get('not', ['as' => 'verify.not', 'uses' => 'VerifyController@not']);
        Route::get('pending', ['as' => 'verify.pending', 'uses' => 'VerifyController@pending']);
    });
    Route::resource('verify', 'VerifyController'); // resource注册的路由需要放在自定义路由下方

    /**
     * 数据管理 : 医院 | 新建医院 | 毕业院校 | 新建院校 | 特长标签 | 医生数据 | 疾病
     */
    Route::group(['prefix' => 'data'], function () {
        Route::get('doctor', ['as' => 'data.doctor', 'uses' => 'DataController@doctor']);
        Route::get('illness', ['as' => 'data.illness', 'uses' => 'DataController@illness']);
    });

    /**
     * 推送内容 : Banner | Share/fwd | 广播站 | 系统通知 | 服务协议 | 手动推送
     */
    Route::group(['prefix' => 'push'], function () {
        Route::get('banner', ['as' => 'push.banner', 'uses' => 'PushController@banner']);
        Route::get('share-fwd', ['as' => 'push.share-fwd', 'uses' => 'PushController@shareFwd']);
        Route::get('broadcast', ['as' => 'push.broadcast', 'uses' => 'PushController@broadcast']);
        Route::get('sys-msg', ['as' => 'push.sys-msg', 'uses' => 'PushController@sysMsg']);
        Route::get('service-agreement', ['as' => 'push.service-agreement', 'uses' => 'PushController@serviceAgreement']);
        Route::get('manual', ['as' => 'push.manual', 'uses' => 'PushController@manual']);
    });

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
     * 财务管理 : 收费设置 | 待结算 | 待报税 | 已结算 | 待提现 | 已提现 | 充值 | 资金报告 | 现金交易记录
     */
    Route::group(['prefix' => 'finance'], function () {
        Route::get('setting', ['as' => 'finance.setting', 'uses' => 'FinanceController@setting']);
        Route::get('pending-settlement', ['as' => 'finance.pending-settlement', 'uses' => 'FinanceController@pendingSettlement']);
        Route::get('pending-tax', ['as' => 'finance.pending-tax', 'uses' => 'FinanceController@pendingTax']);
        Route::get('settled', ['as' => 'finance.settled', 'uses' => 'FinanceController@settled']);
        Route::get('pending-withdrawals', ['as' => 'finance.pending-withdrawals', 'uses' => 'FinanceController@pendingWithdrawals']);
        Route::get('completed-withdrawals', ['as' => 'finance.completed-withdrawals', 'uses' => 'FinanceController@completedWithdrawals']);
        Route::get('recharge', ['as' => 'finance.recharge', 'uses' => 'FinanceController@recharge']);
        Route::get('report', ['as' => 'finance.report', 'uses' => 'FinanceController@report']);
        Route::get('cash-record', ['as' => 'finance.cash-record', 'uses' => 'FinanceController@cashRecord']);
    });

    /**
     * 用户反馈 : 订单投诉 | 使用反馈
     */
    Route::group(['prefix' => 'feedback'], function () {
        Route::get('order-complaint', ['as' => 'feedback.order-complaint', 'uses' => 'FeedbackController@orderComplaint']);
        Route::get('app-use', ['as' => 'feedback.app-use', 'uses' => 'FeedbackController@appUse']);
    });
});
