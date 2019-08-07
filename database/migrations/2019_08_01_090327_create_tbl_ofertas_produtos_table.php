<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOfertasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ofertas_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->bigInteger('id_igreja')->unsigned();
            $table->foreign('id_igreja')->references('id')->on('tbl_igrejas');

            $table->bigInteger('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id')->on('tbl_produtos');

            // %
            $table->integer('desconto');

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
        Schema::dropIfExists('tbl_ofertas_produtos');
    }
}
