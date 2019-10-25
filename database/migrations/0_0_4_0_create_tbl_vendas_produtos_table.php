<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVendasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_vendas_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');

            // VENDA
            $table->bigInteger('id_venda')->unsigned();
            $table->foreign('id_venda')->references('id')->on('tbl_vendas');

            // PRODUTO VENDIDO
            $table->bigInteger('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id')->on('tbl_produtos');

            // TIPO DE VENDA
            $table->bigInteger('id_tipo_venda')->unsigned();
            $table->foreign('id_tipo_venda')->references('id')->on('tbl_tipos_vendas');

            // VALOR NA VENDA DO PRODUTO
            $table->float('valor', 10, 2);

            // DESCONTO % NO VALOR
            $table->integer('oferta')->default(0);

            $table->integer('qtd');

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
        Schema::dropIfExists('tbl_vendas_produtos');
    }
}
