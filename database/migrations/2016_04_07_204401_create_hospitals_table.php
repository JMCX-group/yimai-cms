<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area');
            $table->string('province');
            $table->string('city');
            $table->string('name');
            $table->string('three_a');
            $table->string('address');
            $table->integer('top_dept_num')->default(0); // 顶级科室数量
            $table->string('status'); // 状态:已核实/待核实/已拒绝/已删除
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hospitals');
    }
}
