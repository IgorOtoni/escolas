<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMembrosComunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_membros_comunidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ativo')->default(true);
            $table->boolean('lider');
            $table->bigInteger('id_membro')->unsigned();
            $table->foreign('id_membro')->references('id')->on('tbl_membros');
            $table->bigInteger('id_comunidade')->unsigned();
            $table->foreign('id_comunidade')->references('id')->on('tbl_comunidades');
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
        Schema::dropIfExists('tbl_membros_comunidades');
    }
}
