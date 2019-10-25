<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblConfiguracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_configuracoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_site')->unsigned();
            $table->foreign('id_site')->references('id')->on('tbl_sites');
            $table->bigInteger('id_template')->default(1)->unsigned();
            $table->string('cor')->nullable();
            $table->foreign('id_template')->references('id')->on('tbl_templates');
            $table->string('url')->nullable();
            $table->text('texto_apresentativo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tbl_configuracoes ADD custom_style MEDIUMBLOB null');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_configuracoes');
    }
}
