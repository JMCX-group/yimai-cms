<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dept_id')->unsigned();
            $table->integer('dept_lv2_id')->unsigned();
            $table->string('name');
            $table->integer('hot')->unsigned();
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
        Schema::drop('tags');
    }
}
