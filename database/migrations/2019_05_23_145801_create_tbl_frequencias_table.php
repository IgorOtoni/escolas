<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblFrequenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_frequencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ausente');
            $table->bigInteger('id_membro_comunidade')->unsigned();
            $table->foreign('id_membro_comunidade')->references('id')->on('tbl_membros_comunidades');
            $table->bigInteger('id_reuniao')->unsigned();
            $table->foreign('id_reuniao')->references('id')->on('tbl_reunioes');
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
        Schema::dropIfExists('tbl_frequencias');
    }
}
