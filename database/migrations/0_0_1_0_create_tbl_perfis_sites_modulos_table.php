<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPerfisSitesModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_perfis_sites_modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id')->on('tbl_perfis');
            $table->bigInteger('id_modulo_site')->unsigned();
            $table->foreign('id_modulo_site')->references('id')->on('tbl_sites_modulos');
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
        Schema::dropIfExists('tbl_perfis_sites_modulos');
    }
}
