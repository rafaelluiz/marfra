<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoCorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_cor', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('Código identificador único da tabela');
            $table->integer('produto')->unsigned()->comment('Código identificador da tabela produto');
            $table->integer('cor')->unsigned()->comment('Código identificador da tabela cor');
            
            $table->foreign('produto')->references('id')->on('produto');
            $table->foreign('cor')->references('id')->on('cor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produto_cor');
    }
}
