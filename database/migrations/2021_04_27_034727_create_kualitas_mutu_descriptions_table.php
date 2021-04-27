<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKualitasMutuDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kualitas_mutu_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kualitas_mutu_bulan_id')->constrained()->onDelete('cascade');
            $table->text('image');
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
        Schema::dropIfExists('kualitas_mutu_descriptions');
    }
}
