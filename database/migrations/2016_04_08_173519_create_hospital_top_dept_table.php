<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalTopDeptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_top_dept', function (Blueprint $table) {
            $table->integer('hospital_id')->unsigned();
            $table->integer('dept_standard_id')->unsigned();

            $table->foreign('hospital_id')->references('id')->on('hospitals')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('dept_standard_id')->references('id')->on('dept_standards')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['hospital_id', 'dept_standard_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hospital_top_dept');
    }
}
