<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_vendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_site')->unsigned();
            $table->foreign('id_site')->references('id')->on('tbl_sites');
            // VALOR TOTAL DA VENDA
            $table->float('valor_total', 10, 2);

            // QUEM COMPROU
            $table->bigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');

            // SITUACAO ENTREGA
            $table->bigInteger('id_situacao')->unsigned();
            $table->foreign('id_situacao')->references('id')->on('tbl_situacoes_entregas');

            // DATA DA ENTREGA
            $table->date('data');

            // TURNO ENTREGA
            $table->bigInteger('id_turno')->unsigned();
            $table->foreign('id_turno')->references('id')->on('tbl_turnos_entregas');

            // ENDERECO PARA ENTREGA
            $table->string('cep');
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('complemento')->nullable();
            $table->string('num');

            $table->integer('oferta');

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
        Schema::dropIfExists('tbl_vendas');
    }
}
