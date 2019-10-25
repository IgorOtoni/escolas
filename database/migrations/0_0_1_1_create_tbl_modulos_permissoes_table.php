<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblModulosPermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_modulos_permissoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_modulo')->unsigned();
            $table->foreign('id_modulo')->references('id')->on('tbl_modulos');
            $table->bigInteger('id_permissao')->unsigned();
            $table->foreign('id_permissao')->references('id')->on('tbl_permissoes');
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
        Schema::dropIfExists('tbl_modulos_permissoes');
    }
}
