<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->datetime('dados_horario_inicio');
            $table->datetime('dados_horario_fim');
            $table->string('dados_local');
            $table->bigInteger('id_igreja')->unsigned();
            $table->foreign('id_igreja')->references('id')->on('tbl_igrejas');
            $table->string('foto')->nullable();
            $table->text('descricao')->nullable();
            //$table->boolean('banner')->default(false);
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
        Schema::dropIfExists('tbl_eventos');
    }
}
