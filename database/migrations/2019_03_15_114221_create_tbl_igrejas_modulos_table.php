<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblIgrejasModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_igrejas_modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_igreja');
            $table->bigInteger('id_modulo');
            $table->string('icone')->nullable();
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
        Schema::dropIfExists('tbl_igrejas_modulos');
    }
}
