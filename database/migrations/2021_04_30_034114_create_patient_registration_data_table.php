<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientRegistrationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_registration_data', function (Blueprint $table) {
            $table->id();
            $table->string('kode_daftar');
            $table->text('answare');
            $table->foreignId('patient_registration_id')->constrained();
            $table->foreignId('patient_registration_form_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('department_doctor_id')->constrained();
            $table->foreignId('doctor_schedule_id')->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('patient_registration_data');
    }
}
