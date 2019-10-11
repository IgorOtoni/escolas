<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTemplateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_template_fotos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_template')->unsigned();
            $table->foreign('id_template')->references('id')->on('tbl_templates');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tbl_template_fotos ADD foto MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_template_fotos');
    }
}
