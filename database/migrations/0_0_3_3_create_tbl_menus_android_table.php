<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMenusAndroidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_menus_android', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('link');
            $table->bigInteger('id_configuracao')->unsigned();
            $table->foreign('id_configuracao')->references('id')->on('tbl_configuracoes');
            $table->bigInteger('ordem');
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
        Schema::dropIfExists('tbl_menus_android');
    }
}
