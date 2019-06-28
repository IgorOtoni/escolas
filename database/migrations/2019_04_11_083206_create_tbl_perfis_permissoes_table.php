<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPerfisPermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_perfis_permissoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_perfil_igreja_modulo')->unsigned()->nullable();
            $table->foreign('id_perfil_igreja_modulo')->references('id')->on('tbl_perfis_igrejas_modulos');
            $table->bigInteger('id_permissao')->unsigned()->nullable();
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
        Schema::dropIfExists('tbl_perfis_igrejas_modulos_permissoes');
    }
}
