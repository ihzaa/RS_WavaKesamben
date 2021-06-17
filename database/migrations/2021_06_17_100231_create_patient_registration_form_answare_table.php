<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientRegistrationFormAnswareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_registration_form_answare', function (Blueprint $table) {
            $table->id();
            $table->text('answare');
            $table->unsignedBigInteger('patient_registration_form_id');
            $table->foreign('patient_registration_form_id', 'prfa-prf_id_foreign')->references('id')->on('patient_registration_forms');
            $table->unsignedBigInteger('patient_registration_data_id');
            $table->foreign('patient_registration_data_id', 'prd_id_foreign')->references('id')->on('patient_registration_data');
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
        Schema::dropIfExists('patient_registration_form_answare');
    }
}
