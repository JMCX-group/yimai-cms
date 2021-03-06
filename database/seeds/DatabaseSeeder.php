<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Menu;
use App\Role;
use App\User;
use App\Permission;
use App\RoleUser;
use App\PermissionRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        Model::reguard();
    }
}

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("permission_role")->delete();

        for ($j = 1; $j < 37; $j++) {
            PermissionRole::create(["permission_id" => $j, "role_id" => 1]);
        }

        for ($i = 2; $i < 3; $i++) {
            for ($j = 12; $j < 37; $j++) {
                PermissionRole::create(["permission_id" => $j, "role_id" => 2]);
            }
        }
    }
}

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("role_user")->delete();

        RoleUser::create(["user_id" => 1, "role_id" => 1]);
        RoleUser::create(["user_id" => 2, "role_id" => 2]);
        RoleUser::create(["user_id" => 3, "role_id" => 2]);
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("users")->delete();

        User::create(["name" => "admin", "email" => "admin@admin.com", "password" => bcrypt(123456)]);
        User::create(["name" => "xiaoyi", "email" => "xiaoyi@admin.com", "password" => bcrypt(123456)]);
        User::create(["name" => "xiaomai", "email" => "xiaomai@admin.com", "password" => bcrypt(123456)]);
    }
}

class MenuTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("menus")->delete();

//        Menu::create(["parent_id" => "0", "name" => "权限管理", "url" => "permission.index", "description" => "管理权限的新增、编辑、删除"]);
//        Menu::create(["parent_id" => "7", "name" => "权限列表", "url" => "permission.index", "description" => "管理权限的新增、编辑、删除"]);
//        Menu::create(["parent_id" => "7", "name" => "新增权限", "url" => "permission.create", "description" => "新增权限的页面"]);
//        Menu::create(["parent_id" => "7", "name" => "编辑权限", "url" => "permission.edit", "description" => "编辑权限的页面", "is_hide" => 1]);

        Menu::create(["parent_id" => "0", "name" => "首页管理", "url" => "index", "description" => "展示系统的各项基础数据"]);

        Menu::create(["parent_id" => "0", "name" => "系统管理", "url" => "role.index", "description" => "管理角色的新增、编辑、删除"]); // id:2
        Menu::create(["parent_id" => "2", "name" => "角色列表", "url" => "role.index", "description" => "管理角色的新增、编辑、删除"]);
        Menu::create(["parent_id" => "2", "name" => "新增角色", "url" => "role.create", "description" => "新增角色的页面", "is_hide" => 1]);
        Menu::create(["parent_id" => "2", "name" => "编辑角色", "url" => "role.edit", "description" => "编辑角色的页面", "is_hide" => 1]);
        Menu::create(["parent_id" => "2", "name" => "角色赋权", "url" => "role.show", "description" => "编辑角色的页面", "is_hide" => 1]);

        Menu::create(["parent_id" => "2", "name" => "用户列表", "url" => "user.index", "description" => "管理用户的新增、编辑、删除"]);
        Menu::create(["parent_id" => "2", "name" => "新增用户", "url" => "user.create", "description" => "新增用户的页面", "is_hide" => 1]);
        Menu::create(["parent_id" => "2", "name" => "编辑用户", "url" => "user.edit", "description" => "编辑用户的页面", "is_hide" => 1]);

        Menu::create(["parent_id" => "0", "name" => "用户管理", "url" => "doctor.index", "description" => "管理用户信息"]); // id:10
        Menu::create(["parent_id" => "10", "name" => "医生列表", "url" => "doctor.index", "description" => "管理医生的新增、编辑、删除"]);
        Menu::create(["parent_id" => "10", "name" => "患者列表", "url" => "patient.index", "description" => "管理患者的新增、编辑、删除"]);

        Menu::create(["parent_id" => "0", "name" => "医生认证", "url" => "verify.index", "description" => "管理医生认证情况"]); // id:13
        Menu::create(["parent_id" => "13", "name" => "已认证", "url" => "verify.already", "description" => "已认证的医生列表"]);
        Menu::create(["parent_id" => "13", "name" => "待认证", "url" => "verify.todo", "description" => "待认证的医生列表"]);
        Menu::create(["parent_id" => "13", "name" => "未认证", "url" => "verify.not", "description" => "未认证的医生列表"]);
        Menu::create(["parent_id" => "13", "name" => "待审核", "url" => "verify.pending", "description" => "有待审核的医生列表"]);

        Menu::create(["parent_id" => "0", "name" => "数据管理", "url" => "data.index", "description" => "数据管理"]); // id:18
        Menu::create(["parent_id" => "18", "name" => "医院", "url" => "hospital.index", "description" => "医院数据"]);
        Menu::create(["parent_id" => "18", "name" => "科室", "url" => "dept.index", "description" => "科室数据"]);
        Menu::create(["parent_id" => "18", "name" => "毕业院校", "url" => "college.index", "description" => "毕业院校数据"]);
        Menu::create(["parent_id" => "18", "name" => "特长标签", "url" => "tag.index", "description" => "医生的特长和标签"]);
        Menu::create(["parent_id" => "18", "name" => "医生数据", "url" => "core-doctor.index", "description" => "此处指医生用户在医脉中点“添加”后第三方数据库返回的医生数据"]);
        Menu::create(["parent_id" => "18", "name" => "疾病", "url" => "data.illness", "description" => "疾病数据管理"]);

        Menu::create(["parent_id" => "0", "name" => "推送内容", "url" => "push.index", "description" => "推送内容"]); // id:25
        Menu::create(["parent_id" => "25", "name" => "Banner", "url" => "push.banner", "description" => "医院数据"]);
        Menu::create(["parent_id" => "25", "name" => "Share/fwd", "url" => "push.share-fwd", "description" => "毕业院校数据"]);
        Menu::create(["parent_id" => "25", "name" => "广播站", "url" => "push.broadcast", "description" => "新增毕业院校"]);
        Menu::create(["parent_id" => "25", "name" => "系统通知", "url" => "push.sys-msg", "description" => "医生的特长和标签"]);
        Menu::create(["parent_id" => "25", "name" => "服务协议", "url" => "push.service-agreement", "description" => "编辑医生端、患者端服务协议的内容，且可查历史版本内容和修改时间"]);
        Menu::create(["parent_id" => "25", "name" => "手动推送", "url" => "push.manual", "description" => "手动推送内容"]);

        Menu::create(["parent_id" => "0", "name" => "交易管理", "url" => "trade.index", "description" => "交易管理"]); // id:32
        Menu::create(["parent_id" => "32", "name" => "待处理约诊", "url" => "trade.pending-appointment", "description" => "患者通过“找专家-没找到”下的订单"]);
        Menu::create(["parent_id" => "32", "name" => "当面咨询", "url" => "trade.face-to-face", "description" => "付费加号"]);
        Menu::create(["parent_id" => "32", "name" => "约诊-未完成", "url" => "trade.appointment-incomplete", "description" => "未完成约诊列表"]);
        Menu::create(["parent_id" => "32", "name" => "约诊-已完成", "url" => "trade.appointment-completed", "description" => "已完成约诊列表"]);
        Menu::create(["parent_id" => "32", "name" => "评价", "url" => "trade.evaluate", "description" => "约诊列表评价"]);

        Menu::create(["parent_id" => "0", "name" => "财务管理", "url" => "finance.index", "description" => "财务管理"]); // id:38
        Menu::create(["parent_id" => "38", "name" => "收费设置", "url" => "finance.setting", "description" => "交易设置收费费率"]);
        Menu::create(["parent_id" => "38", "name" => "待结算", "url" => "finance.pending-settlement", "description" => "待结算"]);
        Menu::create(["parent_id" => "38", "name" => "待报税", "url" => "finance.pending-tax", "description" => "待报税"]);
        Menu::create(["parent_id" => "38", "name" => "已结算", "url" => "finance.settled", "description" => "已结算"]);
        Menu::create(["parent_id" => "38", "name" => "待提现", "url" => "finance.pending-withdrawals", "description" => "待提现"]);
        Menu::create(["parent_id" => "38", "name" => "已提现", "url" => "finance.completed-withdrawals", "description" => "已提现"]);
        Menu::create(["parent_id" => "38", "name" => "充值", "url" => "finance.recharge", "description" => "直接充值给某选定用户的钱包(不发生实际银行付款)，充值时须说明事由，须Approver审批"]);
        Menu::create(["parent_id" => "38", "name" => "资金报告", "url" => "finance.report", "description" => "本月、累计[交易金额/医生收入/医生完税/医生提现/平台收入/平台支出]"]);
        Menu::create(["parent_id" => "38", "name" => "现金交易记录", "url" => "finance.cash-record", "description" => "每项实际发生资金往来事项（患者付款、退款、提现）的流水明细（至少包含时间、交易方、交易号、事项）"]);

        Menu::create(["parent_id" => "0", "name" => "用户反馈", "url" => "feedback.index", "description" => "推送内容"]); // id:48
        Menu::create(["parent_id" => "48", "name" => "订单投诉", "url" => "feedback.order-complaint", "description" => "订单投诉"]);
        Menu::create(["parent_id" => "48", "name" => "使用反馈", "url" => "feedback.app-use", "description" => "APP使用反馈"]);
    }
}

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("roles")->delete();

        Role::create(["name" => "admin", "display_name" => "User Administrator", "description" => "User is allowed to manage and edit other users"]);
        Role::create(["name" => "owner", "display_name" => "Project Owner", "description" => "User is the owner of a given project"]);
    }
}

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("permissions")->delete();

        Permission::create(["display_name" => "首页管理", "name" => "index"]); // id:1

        Permission::create(["display_name" => "角色列表", "name" => "role.index"]); // id:2
        Permission::create(["display_name" => "新增角色", "name" => "role.create"]);
        Permission::create(["display_name" => "编辑角色", "name" => "role.edit"]);
        Permission::create(["display_name" => "角色赋权", "name" => "role.show"]);

        Permission::create(["display_name" => "用户列表", "name" => "user.index"]); // id:6
        Permission::create(["display_name" => "新增用户", "name" => "user.create"]);
        Permission::create(["display_name" => "编辑用户", "name" => "user.edit"]);
        Permission::create(["display_name" => "编辑用户", "name" => "user.store"]);

        Permission::create(["display_name" => "医生列表", "name" => "doctor.index"]); // id:10
        Permission::create(["display_name" => "患者列表", "name" => "patient.index"]);

        Permission::create(["display_name" => "数据管理", "name" => "data.index"]); // id:12

        Permission::create(["display_name" => "医院", "name" => "hospital.index"]); // id:13
        Permission::create(["display_name" => "新建医院", "name" => "hospital.create"]);
        Permission::create(["display_name" => "新建医院", "name" => "hospital.store"]);
        Permission::create(["display_name" => "删除医院", "name" => "hospital.destroy"]);
        Permission::create(["display_name" => "编辑医院", "name" => "hospital.edit"]);
        Permission::create(["display_name" => "编辑医院", "name" => "hospital.update"]);

        Permission::create(["display_name" => "科室", "name" => "dept.index"]); // id:19
        Permission::create(["display_name" => "新建科室页面", "name" => "dept.create"]);
        Permission::create(["display_name" => "新建科室信息", "name" => "dept.store"]);
        Permission::create(["display_name" => "删除科室信息", "name" => "dept.destroy"]);
        Permission::create(["display_name" => "编辑科室页面", "name" => "dept.edit"]);
        Permission::create(["display_name" => "编辑科室信息", "name" => "dept.update"]);

        Permission::create(["display_name" => "毕业院校", "name" => "college.index"]); // id:25
        Permission::create(["display_name" => "新建院校页面", "name" => "college.create"]);
        Permission::create(["display_name" => "新建院校信息", "name" => "college.store"]);
        Permission::create(["display_name" => "删除院校信息", "name" => "college.destroy"]);
        Permission::create(["display_name" => "编辑院校页面", "name" => "college.edit"]);
        Permission::create(["display_name" => "编辑院校信息", "name" => "college.update"]);

        Permission::create(["display_name" => "特长标签", "name" => "tag.index"]); // id:31
        Permission::create(["display_name" => "新建标签页面", "name" => "tag.create"]);
        Permission::create(["display_name" => "新建标签信息", "name" => "tag.store"]);
        Permission::create(["display_name" => "删除标签信息", "name" => "tag.destroy"]);
        Permission::create(["display_name" => "编辑标签页面", "name" => "tag.edit"]);
        Permission::create(["display_name" => "编辑标签信息", "name" => "tag.update"]);
        
        // id:37
    }
}
