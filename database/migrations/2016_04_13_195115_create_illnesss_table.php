<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIllnesssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * 总疾病名称、疾病名称、科室、症状、病因、临床表现、诊断、治疗、预后、预防
         */
        Schema::create('illnesss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('general_name');
            $table->integer('dept1_id')->unsigned();
            $table->integer('dept2_id')->unsigned();
            $table->string('symptom_1');
            $table->string('symptom_2');
            $table->string('symptom_3');
            $table->string('symptom_4');
            $table->string('symptom_5');
            $table->string('pathogen'); // 病因
            $table->string('clinical_manifestations'); // 临床表现
            $table->string('diagnosis'); // 诊断
            $table->string('treatment'); // 治疗
            $table->string('prognosis'); // 预后
            $table->string('prevention'); // 预防
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
        Schema::drop('illnesss');
    }
}
