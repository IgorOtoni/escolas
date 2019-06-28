<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPerfisIgrejasModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_perfis_igrejas_modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id')->on('tbl_perfis');
            $table->bigInteger('id_modulo_igreja')->unsigned();
            $table->foreign('id_modulo_igreja')->references('id')->on('tbl_igrejas_modulos');
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
        Schema::dropIfExists('tbl_perfis_igrejas_modulos');
    }
}
