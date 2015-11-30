<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_grupo', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->integer('usuario')->unsigned()->comment('Código identificador da tabela usuario');
            $table->integer('grupo')->unsigned()->comment('Código identificador da tabela grupo');
            
            $table->foreign('usuario')->references('id')->on('usuario');
            $table->foreign('grupo')->references('id')->on('grupo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuario_grupo');
    }
}
