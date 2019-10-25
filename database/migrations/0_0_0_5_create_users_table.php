<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id')->on('tbl_perfis');
            $table->bigInteger('id_membro')->unsigned()->nullable();
            $table->foreign('id_membro')->references('id')->on('tbl_membros');
            $table->boolean('status')->default(false);
            //$table->bigInteger('id_membro');
            //$table->foreign('id_membro')->references('id')->on('tbl_membros');
            $table->datetime('ultimo_acesso')->nullable();
            $table->string('ultima_url')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
