<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblInscricoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inscricoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('telefone');
            $table->bigInteger('id_evento')->unsigned();
            $table->foreign('id_evento')->references('id')->on('tbl_eventos');
            $table->boolean('cancelada')->default(false);
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
        Schema::dropIfExists('tbl__inscricoes');
    }
}
