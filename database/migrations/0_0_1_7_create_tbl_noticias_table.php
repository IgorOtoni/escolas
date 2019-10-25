<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_noticias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->bigInteger('id_site')->unsigned();
            $table->foreign('id_site')->references('id')->on('tbl_sites');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tbl_noticias ADD foto MEDIUMBLOB null');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_noticias');
    }
}
