<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->text('descricao');
            $table->string('link')->nullable();
            $table->bigInteger('id_site')->unsigned();
            $table->foreign('id_site')->references('id')->on('tbl_sites');
            $table->bigInteger('ordem');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tbl_banners ADD foto MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_banners');
    }
}
