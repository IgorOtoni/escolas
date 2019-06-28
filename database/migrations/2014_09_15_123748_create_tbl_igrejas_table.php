<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblIgrejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_igrejas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('cep');
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('complemento')->nullable();
            $table->string('num');
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status')->default(0);
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        //DB::statement('ALTER TABLE tbl_igrejas ADD logo MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_igrejas');
    }
}
