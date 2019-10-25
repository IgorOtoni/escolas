<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblReunioesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_reunioes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descricao');
            $table->text('observacao')->nullable();
            $table->datetime('inicio');
            $table->datetime('fim')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('complemento')->nullable();
            $table->string('num')->nullable();
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
        Schema::dropIfExists('tbl_reunioes');
    }
}
