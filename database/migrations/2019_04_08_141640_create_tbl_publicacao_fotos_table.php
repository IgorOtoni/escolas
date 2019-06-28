<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPublicacaoFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_publicacao_fotos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_publicacao')->unsigned();
            $table->foreign('id_publicacao')->references('id')->on('tbl_publicacoes');
            $table->string('foto');
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
        Schema::dropIfExists('tbl_publicacao_fotos');
    }
}
