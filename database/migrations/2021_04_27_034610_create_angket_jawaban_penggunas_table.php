<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngketJawabanPenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angket_jawaban_penggunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('angket_id')->constrained()->onDelete('cascade');
            $table->foreignId('angket_jawaban_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('angket_jawaban_penggunas');
    }
}
