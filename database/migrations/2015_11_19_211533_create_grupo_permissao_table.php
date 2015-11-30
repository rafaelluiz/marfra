<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoPermissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_permissao', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->integer('grupo')->unsigned()->comment('Código identificador da tabela grupo');
            $table->integer('menu')->unsigned()->comment('Código identificador da tabela menu');
            
            $table->foreign('grupo')->references('id')->on('grupo');
            $table->foreign('menu')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grupo_permissao');
    }
}
