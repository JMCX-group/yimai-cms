<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeptStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dept_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dept_id')->default(0); // 一级科室id
            $table->integer('parent_id')->default(0); // 属于哪个一级科室
            $table->string('name');
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
        Schema::drop('dept_standards');
    }
}
